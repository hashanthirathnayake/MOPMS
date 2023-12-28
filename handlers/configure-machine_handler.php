  
<?php
   
   require_once('../incl/dbconnection.php');
   
   $type = $_GET["type"];
   
   switch($type) {



    case "getMachineName": 

        $sql = "SELECT * FROM machine3 ";
        $result = mysqli_query($con,$sql);
            while($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            echo json_encode($data);
            break; 

    case "getProductName": 

        $sql = "SELECT * FROM product3 ";
        $result = mysqli_query($con,$sql);
            while($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            echo json_encode($data);
            break;  



       case "loadEditForm": 
           $macConfigId = $_POST['id'];
           
           $sql = "select * from machine_config3 where mac_config_id = '$macConfigId'";
           
           $result = mysqli_query($con,$sql);
           
           while ($row = mysqli_fetch_assoc($result)) {
               $data[] = $row;
           }
           echo json_encode($data);
       break;  
           
       case "saveMachineConfiguration":
           $macConfigId = $_POST['macConfigId'];
           $macName = $_POST['macName'];
           $productName = $_POST['productName'];
           $minQty = $_POST['minQty'];
           $maxQty = $_POST['maxQty'];
           $macConfigStatus = $_POST['macConfigStatus'];

            $mode = $_POST['mode'];
   
           $has_errors = FALSE;
           $error_messages = array();
           
           // form txt box name
           if($minQty == '' || $minQty == NULL){
               $has_errors = TRUE;
               array_push($error_messages,'qty is required');
           }
   
           if($has_errors == TRUE) {
               echo json_encode($error_messages);
               
           } else {
               
               if($mode == "add") {
                $sql = "INSERT INTO machine_config3 ( mac_id,pro_code,mac_min_qty,mac_max_qty_per_day, mac_config_status) 
                VALUES ('$macName','$productName','$minQty','$maxQty','$macConfigStatus')";
               echo($sql);
               } else if($mode == "edit") {
                $sql = "UPDATE machine_config3 SET mac_id='$macName',pro_code ='$productName' , mac_min_qty='$minQty',
                mac_max_qty_per_day='$maxQty', mac_config_status='$macConfigStatus' WHERE mac_config_id= '$macConfigId'";
               echo($sql);
            }
   
               $result = mysqli_query($con,$sql);
               
               if($result) {
                   echo "success";
                   
               } else {
                   echo "error";
               }
           }
   
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
                   $search_query.=" WHERE(pro_cat_name LIKE '%{$search_str}%')";
               }
   
               $ord_column=$columns[$ord_col_id]['data'];
               $order_by=" ORDER BY {$ord_column} ".$ord_dir;
   
               $sql="SELECT COUNT(mac_config_id) FROM machine_config3".$search_query;
               $c_result=mysqli_query($con, $sql);
               $rec=mysqli_fetch_row($c_result);
               $count=0;
   
               if(isset($rec[0])){
                   $count=$rec[0];
               }
   
               $sql="SELECT mc.`mac_config_id`,m.mac_name,p.pro_name , mc.mac_min_qty, mc.`mac_max_qty_per_day`,mc.mac_config_status FROM ((machine_config3 mc   LEFT JOIN machine3 m  ON mc.`mac_id`=m.`mac_id`) 
            LEFT JOIN product3 p ON mc.`pro_code`=p.pro_code)".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
               $result=mysqli_query($con,$sql);
   
               $data=array();
               $ajax_response=array();
   
               if(mysqli_num_rows($result)>0){
   
                   while($row=mysqli_fetch_assoc($result)){
   
                       $tmp=array(
   
                       
                                               
                           'mac_config_id'=>$row['mac_config_id'],
                           'mac_id'=>$row['mac_name'],
                           'pro_code'=>$row['pro_name'],
                           'mac_min_qty'=>$row['mac_min_qty'],
                           'mac_max_qty_per_day'=>$row['mac_max_qty_per_day'],
                           'mac_config_status'=>$row['mac_config_status'],
   
                           'mac_config_id'=>$row['mac_config_id']    //option colmn

                        
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
   
           case "delete":
   
               $macConfigId= $_POST['macConfigId'];
               
               $sql = "UPDATE machine_config3  SET mac_config_status=FALSE WHERE mac_config_id=$macConfigId";
   
            
               $result = mysqli_query($con, $sql);
   
               if($result) {
                   echo "deleted";
               }
               break;
   
           
   }
   
   ?>