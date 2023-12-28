  
<?php
   
   require_once('../incl/dbconnection.php');
   
   $type = $_GET["type"];
   
   switch($type) {


    case "loadDesignation": 
        $sql = "SELECT * FROM designation  ";
        $result = mysqli_query($con,$sql);
         while($row = mysqli_fetch_assoc($result)) {
             $data[] = $row;
         }
         echo json_encode($data);
         break; 



       case "loadEditForm": 
           $employeeId = $_POST['id'];
           
           $sql = "select * from employee2 where emp_no = '$employeeId'";
           
           $result = mysqli_query($con,$sql);
           
           while ($row = mysqli_fetch_assoc($result)) {
               $data[] = $row;
           }
           echo json_encode($data);
       break;  
           
       case "saveEmployee":
           $employeeId = $_POST['employeeId'];

           $empFname = $_POST['empFname'];
           $empLname = $_POST['empLname'];
           $empDesig = $_POST['empDesig'];
          
           $empJdate = $_POST['empJdate'];
           $empAddress = $_POST['empAddress'];
           $empNic = $_POST['empNic'];
           $empEmail = $_POST['empEmail'];
           $empContactNo = $_POST['empContactNo'];
           $remark = $_POST['remark'];
           $empStatus = $_POST['empStatus'];
       
           $mode = $_POST['mode'];
   
           $has_errors = FALSE;
           $error_messages = array();
           
           // form txt box name
           if($empFname == '' || $empFname == NULL){
               $has_errors = TRUE;
               array_push($error_messages,'Username is required');
           }
   
           if($has_errors == TRUE) {
               echo json_encode($error_messages);
               
           } else {
               
               if($mode == "add") {
                //    $sql = "INSERT INTO product_category (pro_cat_name, pro_cat_status) VALUES ('$productCatName','$productCatStatus')";

                   $sql = "INSERT INTO employee2 ( emp_fname, emp_lname, desig_id, emp_jdate, emp_address,emp_nic,emp_email,emp_contact_no,emp_remark,emp_status) 
            VALUES ('$empFname','$empLname','$empDesig','$empJdate','$empAddress','$empNic','$empEmail','$empContactNo','$remark','$empStatus')";
               
                    echo($sql);

               } else if($mode == "edit") {

                   $sql = "update employee2 set emp_fname = '$empFname', emp_lname = '$empLname' ,desig_id = '$empDesig' ,
                   emp_jdate = '$empJdate' , emp_address = '$empAddress' , emp_nic = '$empNic' ,emp_email = '$empEmail' , emp_contact_no= '$empContactNo' ,emp_remark='$remark',
                   emp_status = '$empStatus'  where emp_no = '$employeeId' ";
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
   
               $sql="SELECT COUNT(pro_cat_code) FROM product_category".$search_query;
               $c_result=mysqli_query($con, $sql);
               $rec=mysqli_fetch_row($c_result);
               $count=0;
   
               if(isset($rec[0])){
                   $count=$rec[0];
               }
   
               $sql="SELECT e.* ,d.desig_name FROM employee2 e LEFT JOIN designation d ON
               e.desig_id=d.desig_id ".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
               $result=mysqli_query($con,$sql);
   
               $data=array();
               $ajax_response=array();
   
               if(mysqli_num_rows($result)>0){
   
                   while($row=mysqli_fetch_assoc($result)){
   
                       $tmp=array(
   
                       
                                               
                        'emp_no'=>$row["emp_no"],
                        'emp_fname'=>$row["emp_fname"],
                        'emp_lname'=>$row["emp_lname"],
                        'desig_id'=>$row["desig_name"],

                        'emp_jdate'=>$row["emp_jdate"],
                        'emp_address'=>$row["emp_address"],
                        'emp_nic'=>$row["emp_nic"],
                        'emp_email'=>$row["emp_email"],

                        'emp_contact_no'=>$row["emp_contact_no"],
                        'emp_remark'=>$row["emp_remark"],
                        'emp_status'=>$row["emp_status"],

                        // 'edit_id'=>$row["emp_no"],
                        'emp_no'=>$row["emp_no"] 
   
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
   
               $employeeId= $_POST['empId'];
               
               $sql = "UPDATE employee2  SET emp_status=FALSE WHERE emp_no=$employeeId";
   
          
   
               $result = mysqli_query($con, $sql);
   
               if($result) {
                   echo "deleted";
               }
               break;
   


               case "viewEmployee":

                $emp_no = $_POST["emp_no"];
                
                $sql = "SELECT * FROM employee2 where emp_no = $emp_no";
                $result = mysqli_query($con,$sql);
                while($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                }
                echo json_encode($data);
            break; 
           
   }
   
   ?>