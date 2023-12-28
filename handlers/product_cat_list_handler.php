<?php
   
require_once('../incl/dbconnection.php');

$type = $_GET["type"];

switch($type) {
   
    

    case "retrieveProductCategoryList":
        

        
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
                $search_query.=" WHERE(pro_cat_name LIKE '%{$search_str}%')";
            }

            $ord_column=$columns[$ord_col_id]['data'];
            $order_by=" ORDER BY {$ord_column} ".$ord_dir;

            $sql="SELECT COUNT(pro_cat_code) FROM product_category".$search_query;
            $c_result=mysqli_query($con, $sql);
            $rec=mysqli_fetch_row($c_result);
            $count=0;

            if(isset($rec[0])){
                $count=$rec[0];
            }

            $sql="SELECT * FROM product_category".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
            $result=mysqli_query($con,$sql);

            $data=array();
            $ajax_response=array();

            if(mysqli_num_rows($result)>0){

                while($row=mysqli_fetch_assoc($result)){

                    $tmp=array(

                    
                                            
                        'pro_cat_code'=>$row['pro_cat_code'],
                        'pro_cat_name'=>$row['pro_cat_name'],
                        'pro_cat_status'=>$row['pro_cat_status'],

                        // 'pro_cat_code'=>$row['pro_cat_code']    //option colmn

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


