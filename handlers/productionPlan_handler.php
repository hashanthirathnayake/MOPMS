<?php
   
require_once('../incl/dbconnection.php');

$type = $_GET["type"];

switch($type) {
    // case "addUser":
       

    //         $userId = $_POST['userId'];  //id not visible to user but have to indicate
    //         $userCatDes = $_POST['userCatDes'];    
    //         $userName = $_POST['userName'];
    //         $userPass = $_POST['userPass'];
          
    //         $userCreatedDate = $_POST['userCreatedDate'];
    //         $userStatus = $_POST['userStatus'];

    //     $has_errors = FALSE;
    //     $error_messages = array();
        
    //                 // form txt box name
    //     if($userName == '' || $userName == NULL){
    //         $has_errors = TRUE;
    //         array_push($error_messages,'Username is required');
    //     }

    //     if($userPass == '' || $userPass == NULL){
    //         $has_errors = TRUE;
    //         array_push($error_messages,'Password is required');
    //     }
        
    //     if($userCreatedDate == '' || $userCreatedDate == NULL){
    //         $has_errors = TRUE;
    //         array_push($error_messages,'CreatedDate is required');
    //     }
        
    //     if($userStatus == '' || $userStatus == NULL){
    //         $has_errors = TRUE;
    //         array_push($error_messages,'Status  is required');
    //     }
    
    //     if($has_errors == TRUE)
    //     {
    //         echo json_encode($error_messages);
    //     }
        
    //     else{     

    //         // $sql = "INSERT INTO user(userr_name, user_pwd, ucat_id)
    //         //  VALUES ('$config_user_uname', '$config_user_pwd','$config_userCatRole')";
    //         // $result = mysqli_query($con,$sql);



    //         $sql = "INSERT INTO tbl_user ( usr_name,user_cat_id,user_password, user_created_date, user_status) 
    //         VALUES ('$userName','$userCatDes','$userPass','$userCreatedDate','$userStatus')";

    //         $result = mysqli_query($con,$sql);

    //         echo $sql;

    //         if($result) {
    //             echo "success";
    //         } else {
    //             echo "error";
    //         }

    //     }
      
    //     break;
    
    // case "getUserCategory": 
    //        $sql = "SELECT * FROM user_category";
    //        $result = mysqli_query($con,$sql);
    //         while($row = mysqli_fetch_assoc($result)) {
    //             $data[] = $row;
    //         }
    //         echo json_encode($data);
    //         break; 

    case "retrieveProductionPlan":
        

        
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
                $search_query.=" WHERE(prod_plan_id LIKE '%{$search_str}%')";
            }

            $ord_column=$columns[$ord_col_id]['data'];
            $order_by=" ORDER BY {$ord_column} ".$ord_dir;

            $sql="SELECT COUNT(prod_plan_id) FROM production_plan".$search_query;
            $c_result=mysqli_query($con, $sql);
            $rec=mysqli_fetch_row($c_result);
            $count=0;

            if(isset($rec[0])){
                $count=$rec[0];
            }

            //with production type column
            // $sql="SELECT production_plan.`prod_plan_id` ,production.`production_type` ,production_plan.`prod_plan_start_date`,production_plan.`prod_plan_end_date`,
            // production_plan.`prod_plan_remarks` FROM production_plan INNER JOIN production ON production_plan.`production_id`=production.`production_id`".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
            
            $sql="SELECT * from production_plan ".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
           
            $result=mysqli_query($con,$sql);

            $data=array();
            $ajax_response=array();

            if(mysqli_num_rows($result)>0){

                while($row=mysqli_fetch_assoc($result)){

                    $tmp=array(

                        'prod_plan_id'=>$row['prod_plan_id'],
                        // 'production_type'=>$row['production_type'],
                        'prod_plan_start_date'=>$row['prod_plan_start_date'],
                        'prod_plan_end_date'=>$row['prod_plan_end_date'],
                        'prod_plan_remarks'=>$row['prod_plan_remarks'],

                        'prod_plan_id'=>$row['prod_plan_id']  //changing staus of production plan- not started", completd, 

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

        // case "deleteUser":

        //     $user_id= $_POST['user_id'];
            
        //     $sql = "UPDATE tbl_user  SET user_status=FALSE WHERE user_id=$user_id";

        //     // $sql = 'UPDATE shp_sub_category SET
        //     //  cat_id=? , sub_cat_name=? , sub_cat_display_name=?, sub_cat_status=?, sub_category_code=? WHERE sub_cat_id=?';

        //     $result = mysqli_query($con, $sql);

        //     if($result) {
        //         echo "deleted";
        //     }
        //     break;
}

?>


