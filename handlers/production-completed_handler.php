<?php
   
require_once('../incl/dbconnection.php');

$type = $_GET["type"];

switch($type) {

    case "addProduceWasteQty":


           $proQtyId =time();
           $orderDetailId = $_POST['orderDetailId'];
           $produceQty = $_POST['pq'];
           $wasteQty = $_POST['wq'];
          // variable name         //html text area name
           $labelcomment = $_POST['cmnt'];
   
           $has_errors = FALSE;
           $error_messages = array();
           
           // form txt box name
           if($produceQty == '' || $produceQty == NULL){
               $has_errors = TRUE;
               array_push($error_messages,'pro qty is required');
           }
   
           if($has_errors == TRUE) {
               echo json_encode($error_messages);
               
           } else {
               
             
            $sql = "INSERT INTO produce_quantity(pro_qty_id, ord_detail_id,actual_produce_qty,waste_qty,remark) 
            VALUES ('$proQtyId','$orderDetailId','$produceQty','$wasteQty','$labelcomment')";

               echo($sql);
               
               $result = mysqli_query($con,$sql);
               
               if($result) {
                   echo "success";
                   
               } else {
                   echo "error";
               }
           }
    break;
        
        case "retrieveProductionCompletedOrders":

            
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


       //concat('ORD-',lpad(o.`ord_code`, 6, 0)) as ORDER_CODE,

    //   $sql="SELECT od.ord_detail_id AS ORDER_DETAIL_ID, od.ord_id AS ORDER_ID,concat('ORD-',lpad(o.`ord_code`, 6, 0)) as ORDER_CODE, p.pro_code AS PRO_CODE, p.pro_name AS PRODUCT_NAME, od.ord_type AS  ORDER_TYPE, od.item_qty AS QTY, ms.reserved_from AS RESERVED_FROM ,ms.reserved_to AS RESERVED_TO, 
    //     od.ord_detail_status AS ORD_DETAIL_STATUS FROM order_detail3 od 

    //     LEFT JOIN machine_schedule3 ms ON  ms.`ord_detail_id`= od.`ord_detail_id` 
    //     LEFT JOIN product3 p ON od.pro_code = p.pro_code 
    //     WHERE 
    //     od.ord_type IN ('customize','restock','balance request') AND ord_detail_status='completed' AND ms.mac_sche_status='1' ".$search_query.$order_by." LIMIT ".$offset.",".$limit."";




        
      $sql="

      SELECT od.ord_detail_id AS ORDER_DETAIL_ID, tbo.ord_id AS ORDER_ID,CONCAT('ORD-',LPAD(tbo.`ord_code`, 6, 0)) AS ORDER_CODE, p.pro_code AS PRO_CODE, p.pro_name AS PRODUCT_NAME, od.ord_type AS  ORDER_TYPE, od.item_qty AS QTY, ms.reserved_from AS RESERVED_FROM ,ms.reserved_to AS RESERVED_TO, 
              od.ord_detail_status AS ORD_DETAIL_STATUS FROM order_detail3 od 
              LEFT JOIN machine_schedule3 ms ON  ms.`ord_detail_id`= od.`ord_detail_id` 
              LEFT JOIN product3 p ON od.pro_code = p.pro_code 
              LEFT JOIN tbl_orders3 tbo ON tbo.ord_id=od.ord_id
              WHERE 
              od.ord_type IN ('customize','restock','balance request','domestic') AND ord_detail_status='completed' AND ms.mac_sche_status='1' ".$search_query.$order_by." LIMIT ".$offset.",".$limit."";





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
                   

                  
                    'pro_name'=>$row['PRODUCT_NAME'],     
                    'item_qty'=>$row['QTY'],
                    'ord_detail_status'=>$row['ORD_DETAIL_STATUS'],
                    'mac_reserved_from'=>$row['RESERVED_FROM'],
                    'mac_reserved_to'=>$row['RESERVED_TO'],
                
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
