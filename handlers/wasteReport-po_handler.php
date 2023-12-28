<?php
  
    require_once('../incl/dbconnection.php');

    $type = $_GET["type"];

    switch($type) {
       case "retrieveReportDetails":
        $sql = "SELECT tbl.ord_id, od.ord_detail_id, p.`pro_name` , pq.actual_produce_qty,pq.waste_qty
        FROM  produce_quantity pq   
        
        
        LEFT JOIN order_detail3  od  ON pq.ord_detail_id=od.ord_detail_id
        
        LEFT JOIN tbl_orders3 tbl ON od.ord_id= tbl.ord_id
        
        LEFT JOIN product3 p ON p.`pro_code`=od.pro_code   ";
        // $sql = "SELECT YEAR(ord_place_date) 
        // AS 'Year',MONTH(ord_place_date) AS 'Month',COUNT(ord_id) 
        // AS 'num of orders',SUM(ord_net_total) AS 'Total Income' FROM order_report GROUP BY YEAR(ord_place_date)";

        $result = mysqli_query($con,$sql);
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode($data);
    
    break;
    case "retrieve":
        

        
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
                $search_query.=" WHERE(pro_name LIKE '%{$search_str}%')";
            }

            $ord_column=$columns[$ord_col_id]['data'];
            $order_by=" ORDER BY {$ord_column} ".$ord_dir;

            $sql="SELECT COUNT(pro_code) FROM product3".$search_query;
            // $sql="SELECT COUNT(pro_code) FROM product INNER JOIN product_category ON product.pro_cat_code= product_category.pro_cat_code".$search_query;


            $c_result=mysqli_query($con, $sql);
            $rec=mysqli_fetch_row($c_result);
            $count=0;

            if(isset($rec[0])){
                $count=$rec[0];
            }


                 
        // $sql="SELECT * from order_report ".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
           
        // $sql="SELECT p3.pro_code,pc.pro_cat_name,p3.pro_name,p3.pro_des,p3.pro_unit_price FROM product3  p3 INNER JOIN product_category  pc
        // ON p3.`pro_cat_code`=pc.`pro_cat_code` ORDER BY pc.`pro_cat_code` ".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
        
        
       
        $sql="SELECT tbl.ord_id, od.ord_detail_id, p.`pro_name` , pq.actual_produce_qty,pq.waste_qty
        FROM  produce_quantity pq   
        
        
        LEFT JOIN order_detail3  od  ON pq.ord_detail_id=od.ord_detail_id
        
        LEFT JOIN tbl_orders3 tbl ON od.ord_id= tbl.ord_id
        
        LEFT JOIN product3 p ON p.`pro_code`=od.pro_code  ".$search_query.$order_by." LIMIT ".$offset.",".$limit."";

        // ORDER BY product.`pro_cat_code`
            $result=mysqli_query($con,$sql);                                                                            

      

            $data=array();
            $ajax_response=array();

            if(mysqli_num_rows($result)>0){

                while($row=mysqli_fetch_assoc($result)){

                    $tmp=array(
                   
                    //  
                        'ord_id'=>$row['ord_id'],
                        'ord_detail_id'=>$row['ord_detail_id'],
                     
                        'pro_code'=>$row['pro_name'],
                       'actual_produce_qty'=>$row['actual_produce_qty'],
                     
                        'waste_qty'=>$row['waste_qty']
                      
                      
                    


                      
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