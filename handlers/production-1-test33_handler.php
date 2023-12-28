<?php
   
require_once('../incl/dbconnection.php');

$type = $_GET["type"];

switch($type) {

   
    case "retrieveProductionOwn":
            
        $offset=$_POST['start'];
        $limit=$_POST['length'];
        $search=$_POST['search'];
        $columns=$_POST['columns'];
        $order=$_POST['order'];
        $ord_col_id=$order['0']['column'];
        $ord_dir=$order['0']['dir'];
        $search_str=$search['value'];

        $search_query='';

         if($search_str!=""){      //coumn name - db
            $search_query.=" WHERE(ord_detail_id LIKE '%{$search_str}%')";
        }

        $ord_column=$columns[$ord_col_id]['data'];
        $order_by=" ORDER BY {$ord_column} ".$ord_dir;

        $sql="SELECT COUNT(ord_detail_id) FROM order_detail3".$search_query;
        $c_result=mysqli_query($con, $sql);
        $rec=mysqli_fetch_row($c_result);
        $count=0;

        if(isset($rec[0])){
            $count=$rec[0];
        }
        
        $search_query = "";
        $order_by = "";

         
$sql="select od.ord_detail_id as ORDER_DETAIL_ID, od.ord_id as ORDER_ID, concat('ORD-',lpad(tor.`ord_code`, 6, 0)) as ORDER_CODE, 
p.pro_code as PRO_CODE, p.pro_name as PRODUCT_NAME, od.ord_type as ORDER_TYPE, od.item_qty as QTY, tor.ord_deli_date as DELI_DATE 
from order_detail3 od 
left join product3 p on od.pro_code = p.pro_code 
left join tbl_orders3 tor on tor.ord_id = od.ord_id 
where 
od.ord_type in ('Customize','restock','Balance Request','Domestic')  and od.ord_detail_status='pending'
order by tor.ord_deli_date, tor.ord_code ".$search_query.$order_by." LIMIT ".$offset.",".$limit."";



        $result=mysqli_query($con,$sql);

        $data=array();
        $ajax_response=array();
        $count = mysqli_num_rows($result);   //to fix datatable entry count display

        if(mysqli_num_rows($result)>0){

            while($row=mysqli_fetch_assoc($result)){

                $tmp=array(
                    //.php  name='' side sql column name        //sql side
                    'ord_id'=>$row['ORDER_ID'], 
                    'ord_code'=>$row['ORDER_CODE'], 
                    'ord_type'=>$row['ORDER_TYPE'],
                    'pro_code'=>$row['PRO_CODE'],
                    'deli_date'=>$row['DELI_DATE'],
                 
                    'pro_name'=>$row['PRODUCT_NAME'],     
                    'item_qty'=>$row['QTY'],
                   
                
                    'ord_detail_id'=>$row['ORDER_DETAIL_ID']  //for option column

                   

                );
                array_push($data,$tmp);
            }
        }

        $ajax_response['data']= $data;
        $ajax_response['draw']= $_POST['draw'];
        $ajax_response['recordsTotal']=$count;
        $ajax_response['recordsFiltered']=$count;

        echo json_encode($ajax_response);
    break;

                 
 
          

    }
    
    ?>
