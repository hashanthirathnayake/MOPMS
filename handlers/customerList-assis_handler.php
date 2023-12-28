  
<?php
   
   require_once('../incl/dbconnection.php');
   
   $type = $_GET["type"];
   
   switch($type) {
      
       
       
   
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
                   $search_query.=" WHERE(cus_id LIKE '%{$search_str}%')";
               }
   
               $ord_column=$columns[$ord_col_id]['data'];
               $order_by=" ORDER BY {$ord_column} ".$ord_dir;
   
               $sql="SELECT cus_fname,cus_lname or cus_city FROM customer".$search_query;
               $c_result=mysqli_query($con, $sql);
               $rec=mysqli_fetch_row($c_result);
               $count=0;
   
               if(isset($rec[0])){
                   $count=$rec[0];
               }
   
               $sql="SELECT cus_id, cus_fname ,cus_lname,cus_nic,cus_address,cus_city,cus_phone_no,cus_whatsap_no ,cus_email 

               FROM customer WHERE cus_status='1' ".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
               $result=mysqli_query($con,$sql);
   
               $data=array();
               $ajax_response=array();
   
               if(mysqli_num_rows($result)>0){
   
                   while($row=mysqli_fetch_assoc($result)){
   
                       $tmp=array(
   
                       
                                               
                           'cus_id'=>$row['cus_id'],
                           'cus_fname'=>$row['cus_fname'],
                           'cus_lname'=>$row['cus_lname'],
                           'cus_nic'=>$row['cus_nic'],
                           'cus_address'=>$row['cus_address'],
                           'cus_city'=>$row['cus_city'],
                           'cus_phone_no'=>$row['cus_phone_no'],
                           'cus_whatsap_no'=>$row['cus_whatsap_no'],
                           'cus_email'=>$row['cus_email'],
   
                        //    'pro_cat_code'=>$row['pro_cat_code']    //option colmn
   
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