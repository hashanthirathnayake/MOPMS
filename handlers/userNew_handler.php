<?php
   
   require_once('../incl/dbconnection.php');
   
   $type = $_GET["type"];
   
   switch($type) {

       case "loadEditForm": 
           $user_id = $_POST['id'];
           
           $sql = "select * from tbl_user where user_id = '$user_id'";
           
           $result = mysqli_query($con,$sql);
           
           while ($row = mysqli_fetch_assoc($result)) {
               $data[] = $row;
           }
           echo json_encode($data);

       break;  

       case "view":

        $userId = $_POST["userId"];
        
        $sql = "SELECT u.user_id,uc.user_cat_des, u.usr_name, u.user_created_date,u.user_status
        FROM tbl_user u
        LEFT JOIN  user_category uc
        ON u.user_cat_id=uc.user_cat_id where user_id = $userId"; 
        
        $result = mysqli_query($con,$sql);
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode($data);

        break; 



       case "getUserCategory": 
        $sql = "SELECT * FROM user_category";
        $result = mysqli_query($con,$sql);
         while($row = mysqli_fetch_assoc($result)) {
             $data[] = $row;
         }
         echo json_encode($data);

         break; 

           
       case "save":
         

        $userId = $_POST['userId'];  //id not visible to user but have to indicate
        $userCatDes = $_POST['userCatDes'];    
        $userName = $_POST['userName'];
        $userPass = $_POST['userPass'];

      
        $userCreatedDate = $_POST['userCreatedDate'];
        $userStatus = $_POST['userStatus'];

        $mode = $_POST['mode'];

        $has_errors = FALSE;
        $error_messages = array();
        
                    // form txt box name
        if($userName == '' || $userName == NULL){
            $has_errors = TRUE;
            array_push($error_messages,'Username is required');
        }

        if($userPass == '' || $userPass == NULL){
            $has_errors = TRUE;
            array_push($error_messages,'Password is required');
        }
        
        if($userCreatedDate == '' || $userCreatedDate == NULL){
            $has_errors = TRUE;
            array_push($error_messages,'CreatedDate is required');
        }
        
        if($userStatus == '' || $userStatus == NULL){
            $has_errors = TRUE;
            array_push($error_messages,'Status  is required');
        }

        if($has_errors == TRUE)
        {
            echo json_encode($error_messages);
        }
            
           
           else {

            $userHashPass = md5($userPass);  //to conver to hash value
               
               if($mode == "add") {

                // $userHashPass = md5($userPass);

                   $sql = "INSERT INTO tbl_user ( usr_name,user_cat_id,user_password, user_created_date, user_status) 
            VALUES ('$userName','$userCatDes','$userHashPass','$userCreatedDate','$userStatus')";

               } else if($mode == "edit") {

                   $sql = "update tbl_user set usr_name = '$userName', user_cat_id = '$userCatDes', user_password = '$userHashPass', 
                   
                   user_created_date = '$userCreatedDate',   user_status = '$userStatus'  where user_id = '$userId'";

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
                   $search_query.=" WHERE(usr_name LIKE '%{$search_str}%' or user_status LIKE '%{$search_str}%' or  user_created_date LIKE '%{$search_str}%')";
               }
               
               $ord_column=$columns[$ord_col_id]['data'];
               $order_by=" ORDER BY {$ord_column} ".$ord_dir;
   
               $sql="SELECT * FROM tbl_user".$search_query;
               $c_result=mysqli_query($con, $sql);
               $rec=mysqli_fetch_row($c_result);
               $count=0;
   
               if(isset($rec[0])){
                   $count=$rec[0];
               }
   
            //    $sql="SELECT * FROM tbl_user".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
               $sql="SELECT u.user_id,uc.user_cat_des, u.usr_name, u.user_created_date,u.user_status
               FROM tbl_user u
               LEFT JOIN  user_category uc
               ON u.user_cat_id=uc.user_cat_id".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
    


               $result=mysqli_query($con,$sql);
   
               $data=array();
               $ajax_response=array();
   
               if(mysqli_num_rows($result)>0){
   
                   while($row=mysqli_fetch_assoc($result)){
   
                       $tmp=array(
                                                                        
                        'user_id'=>$row['user_id'],
                        'user_cat_id'=>$row['user_cat_des'],
                        'usr_name'=>$row['usr_name'],
                        'user_created_date'=>$row['user_created_date'],
                        'user_status'=>$row['user_status'],

                        'user_id'=>$row['user_id']
   
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
   
               $usr_code= $_POST['usr_code'];
               
               $sql = "UPDATE tbl_user  SET user_status=FALSE WHERE user_id =$usr_code";
   
          
   
               $result = mysqli_query($con, $sql);
   
               if($result) {
                   echo "deleted";
               }
               break;
   
           
   }
   
   ?>
