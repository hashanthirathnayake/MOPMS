  
<?php
   
   require_once('../incl/dbconnection.php');
   
   $type = $_GET["type"];
   
   switch($type) {
       case "loadEditForm": 
           $productCatCode = $_POST['id'];
           
           $sql = "select * from product_category where pro_cat_code = '$productCatCode'";
           
           $result = mysqli_query($con,$sql);
           
           while ($row = mysqli_fetch_assoc($result)) {
               $data[] = $row;
           }
           echo json_encode($data);
       break;  
           
       case "saveProductCategory":
           $productCatCode = $_POST['productCatCode'];
           $productCatName = $_POST['productCatName'];
           $productCatStatus = $_POST['productCatStatus'];
           $mode = $_POST['mode'];
   
           $has_errors = FALSE;
           $error_messages = array();
           
           // form txt box name
           if($productCatName == '' || $productCatName == NULL){
               $has_errors = TRUE;
               array_push($error_messages,'Username is required');
           }
   
           if($has_errors == TRUE) {
               echo json_encode($error_messages);
               
           } else {
               
               if($mode == "add") {
                   $sql = "INSERT INTO product_category (pro_cat_name, pro_cat_status) VALUES ('$productCatName','$productCatStatus')";
               
               } else if($mode == "edit") {
                   $sql = "update product_category set pro_cat_name = '$productCatName', pro_cat_status = '$productCatStatus' where pro_cat_code = '$productCatCode'";
               }
   
               $result = mysqli_query($con,$sql);
               
               if($result) {
                   echo "success";
                   
               } else {
                   echo "error";
               }
           }
   
           break;
       
       
   
       case "retrieveProductCategory":
           
   
           
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
   
                           'pro_cat_code'=>$row['pro_cat_code']    //option colmn
   
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
   
           case "deleteProductCategory":
   
               $pro_cat_code= $_POST['pro_cat_code'];
               
               $sql = "UPDATE product_category  SET pro_cat_status=FALSE WHERE pro_cat_code=$pro_cat_code";
   
          
   
               $result = mysqli_query($con, $sql);
   
               if($result) {
                   echo "deleted";
               }
               break;
   
           
   }
   
   ?>