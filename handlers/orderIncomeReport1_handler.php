<?php
  
    require_once('../incl/dbconnection.php');

    $type = $_GET["type"];

    switch($type) {
       case "retrieveReportDetails":
        // $sql = "SELECT * FROM product";
        $sql = "SELECT YEAR(ord_place_date) 
        AS 'Year',MONTH(ord_place_date) AS 'Month',COUNT(ord_id) 
        AS 'num of orders',SUM(ord_net_total) AS 'Total Income' FROM order_report GROUP BY YEAR(ord_place_date)";

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
                $search_query.=" WHERE(ord_id LIKE '%{$search_str}%')";
            }

            $ord_column=$columns[$ord_col_id]['data'];
            $order_by=" ORDER BY {$ord_column} ".$ord_dir;

            $sql="SELECT COUNT(ord_id) FROM order_report".$search_query;
            // $sql="SELECT COUNT(pro_code) FROM product INNER JOIN product_category ON product.pro_cat_code= product_category.pro_cat_code".$search_query;


            $c_result=mysqli_query($con, $sql);
            $rec=mysqli_fetch_row($c_result);
            $count=0;

            if(isset($rec[0])){
                $count=$rec[0];
            }


                 
        $sql="SELECT ord_id,ord_place_date,ord_net_total from order_report ".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
           
        // $sql="SELECT pro_code,pro_cat_name,pro_name,pro_des,pro_unit_price FROM product INNER JOIN product_category 
        // ON product.`pro_cat_code`=product_category.`pro_cat_code` ORDER BY product.`pro_cat_code` ".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
            $result=mysqli_query($con,$sql);                                                                            

      

            $data=array();
            $ajax_response=array();

            if(mysqli_num_rows($result)>0){

                while($row=mysqli_fetch_assoc($result)){

                    $tmp=array(
                   
                     
                        'ord_id'=>$row['ord_id'],
                        // 'pro_cat_name'=>$row['pro_cat_name'],
                        // 'employee_name'=>$row['employee_name'],
                        // {data:"ord_place_date",name:"ord_place_date"},
                        'ord_place_date'=>$row['ord_place_date'],
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