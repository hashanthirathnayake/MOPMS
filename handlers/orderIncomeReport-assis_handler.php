<?php
  
    require_once('../incl/dbconnection.php');

    $type = $_GET["type"];

    switch($type) {
       case "retrieveReportDetails":
        // $sql = "SELECT * FROM product";
        $sql = "SELECT  tbo.ord_id,CONCAT(c.cus_fname,'  ' ,c.cus_lname) AS customer_name, tbo.ord_place_date,tbo.ord_net_total
        FROM tbl_orders3 tbo
        LEFT JOIN customer c
        ON tbo.`cus_id`=c.`cus_id` WHERE c.`cus_status`='1' ";

        $result = mysqli_query($con,$sql);
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode($data);
    
    break;
    case "retrieveOrder":
        

        
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
                $search_query.=" WHERE(ord_id LIKE '%{$search_str}%' or employee_name LIKE '%{$search_str}%' or ord_place_date LIKE '%{$search_str}%' or  ord_net_total LIKE '%{$search_str}%')";
            }

            $ord_column=$columns[$ord_col_id]['data'];
            $order_by=" ORDER BY {$ord_column} ".$ord_dir;

            $sql="SELECT COUNT(tbo.ord_id) ,CONCAT(c.cus_fname,'   ' ,c.cus_lname) AS customer_name, tbo.ord_place_date,tbo.ord_net_total
            FROM tbl_orders3 tbo
            LEFT JOIN customer c
            ON tbo.`cus_id`=c.`cus_id` WHERE c.`cus_status`='1'".$search_query;

            // $sql="SELECT COUNT(pro_code) FROM product INNER JOIN product_category ON product.pro_cat_code= product_category.pro_cat_code".$search_query;


            $c_result=mysqli_query($con, $sql);
            $rec=mysqli_fetch_row($c_result);
            $count=0;

            if(isset($rec[0])){
                $count=$rec[0];
            }


                 
        $sql="SELECT  tbo.ord_id,CONCAT(c.cus_fname,'   ' ,c.cus_lname) AS customer_name, tbo.ord_place_date,tbo.ord_net_total
        FROM tbl_orders3 tbo
        LEFT JOIN customer c
        ON tbo.`cus_id`=c.`cus_id` WHERE c.`cus_status`='1' ".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
           
        // $sql="SELECT pro_code,pro_cat_name,pro_name,pro_des,pro_unit_price FROM product INNER JOIN product_category 
        // ON product.`pro_cat_code`=product_category.`pro_cat_code` ORDER BY product.`pro_cat_code` ".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
            $result=mysqli_query($con,$sql);                                                                            

      

            $data=array();
            $ajax_response=array();

            if(mysqli_num_rows($result)>0){

                while($row=mysqli_fetch_assoc($result)){

                    $tmp=array(
                   
                     
                        'ord_id'=>$row['ord_id'],
                        
                        'customer_name'=>$row['customer_name'],
                        'ord_place_date'=>$row['ord_place_date'],
                        'ord_net_total'=>$row['ord_net_total']
                      
                      
                    


                      
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