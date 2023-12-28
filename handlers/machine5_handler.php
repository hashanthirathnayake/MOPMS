  
<?php
   
   require_once('../incl/dbconnection.php');
   
   $type = $_GET["type"];
   
   switch($type) {

    case "getDesignation": 
        $sql = "SELECT * FROM employee2 where desig_id='3' ";
        $result = mysqli_query($con,$sql);
         while($row = mysqli_fetch_assoc($result)) {
             $data[] = $row;
         }
         echo json_encode($data);
         break; 


         case "getPlantName": 

            $sql = "SELECT * FROM plant ";
            $result = mysqli_query($con,$sql);
             while($row = mysqli_fetch_assoc($result)) {
                 $data[] = $row;
             }
             echo json_encode($data);
             break; 

       case "loadEditForm": 
           $macId = $_POST['id'];
           
           $sql = "select * from machine3 where mac_id = '$macId'";
           
           $result = mysqli_query($con,$sql);
           
           while ($row = mysqli_fetch_assoc($result)) {
               $data[] = $row;
           }
           echo json_encode($data);
       break;  
           
       case "saveMachine":
        
           $macId = $_POST['macId'];
           $macName = $_POST['macName'];
           $macSupName = $_POST['macSupName'];
           $plantName = $_POST['plantName'];
           $macStatus = $_POST['macStatus'];
          
           $mode = $_POST['mode'];
   
           $has_errors = FALSE;
           $error_messages = array();
           
           // form txt box name
           if($macName == '' || $macName == NULL){
               $has_errors = TRUE;
               array_push($error_messages,'name is required');
           }
   
           if($has_errors == TRUE) {
               echo json_encode($error_messages);
               
           } else {
               
               if($mode == "add") {
                   $sql = "INSERT INTO machine3 (emp_no,plant_no,mac_name,mac_status) 
                   VALUES ('$macSupName','$plantName','$macName','$macStatus')";
               
               } else if($mode == "edit") {
                   $sql = "update machine3 set emp_no = '$macSupName', 
                   plant_no = '$plantName',mac_name = '$macName', mac_status='$macStatus'  where mac_id = '$macId'";
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
                   $search_query.=" WHERE(mac_name LIKE '%{$search_str}%')";
               }
   
               $ord_column=$columns[$ord_col_id]['data'];
               $order_by=" ORDER BY {$ord_column} ".$ord_dir;
   
               $sql="SELECT COUNT(mac_id) FROM machine3".$search_query;
               $c_result=mysqli_query($con, $sql);
               $rec=mysqli_fetch_row($c_result);
               $count=0;
   
               if(isset($rec[0])){
                   $count=$rec[0];
               }
   
               $sql="SELECT machine3.mac_id,machine3.mac_name,plant.`plant_name`,CONCAT (employee2.emp_fname ,' ',employee2.emp_lname) AS employee_name,machine3.mac_status
               FROM ((machine3 INNER JOIN employee2 ON machine3.emp_no = employee2.emp_no)  LEFT JOIN plant ON machine3.plant_no= plant.plant_no )".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
               $result=mysqli_query($con,$sql);
   
               $data=array();
               $ajax_response=array();
   
               if(mysqli_num_rows($result)>0){
   
                   while($row=mysqli_fetch_assoc($result)){
   
                       $tmp=array(
   
                       
                                               
                           'mac_id'=>$row['mac_id'],
                           'mac_name'=>$row['mac_name'],
                           'emp_no'=>$row['employee_name'],
                           'plant_no'=>$row['plant_name'],
                           'mac_status'=>$row['mac_status'] ,
                           'mac_id'=>$row['mac_id'],  //option colmn
   
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
   
           case "deleteMachine":
   
               $mac_id= $_POST['mac_id'];
               
               $sql = "UPDATE machine3  SET mac_status=FALSE WHERE mac_id=$mac_id";
   
          
   
               $result = mysqli_query($con, $sql);
   
               if($result) {
                   echo "deleted";
               }
               break;
   
           
   }
   
   ?>