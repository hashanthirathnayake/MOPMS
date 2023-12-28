

<?php
require_once('../incl/dbconnection.php');

$type = $_GET["type"];

switch($type) {

    case "loadEditForm": 
        $userCatId = $_POST['id'];
        
        $sql = "select * from user_category where user_cat_id = '$userCatId'";
        
        $result = mysqli_query($con,$sql);
        
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode($data);
    break;  


    case "saveUserCategory":


        $userCatId = $_POST['userCatId'];  
        $userCatDes = $_POST['userCatDes'];    
        $userCatStatus = $_POST['userCatStatus']; 
        $mode = $_POST['mode']; 
            

        $has_errors = FALSE;
        $error_messages = array();
        
                    // form txt box name
        if($userCatDes == '' || $userCatDes == NULL){
            $has_errors = TRUE;
            array_push($error_messages,'Username is required');
        }
        
        if($userCatStatus == '' || $userCatStatus == NULL){
            $has_errors = TRUE;
            array_push($error_messages,'User cat status is required');
        }

    
        if($has_errors == TRUE)
        {
            echo json_encode($error_messages);
        }
        
        else{     

           
            if($mode == "add") {
                $sql = "INSERT INTO user_category ( user_cat_des,user_cat_status) VALUES ('$userCatDes','$userCatStatus')";
            
            } else if($mode == "edit") {
                $sql = "update user_category set user_cat_des = '$userCatDes', user_cat_status = '$userCatStatus' where user_cat_id = '$userCatId'";
            }

            $result = mysqli_query($con,$sql);
            
            if($result) {
                echo "success";
                
            } else {
                echo "error";
            }

        }
    break;
    
    
    // case "getUserCategory": 
    //        $sql = "SELECT * FROM user_category";
    //        $result = mysqli_query($con,$sql);
    //         while($row = mysqli_fetch_assoc($result)) {
    //             $data[] = $row;
    //         }
    //         echo json_encode($data);
    // break; 
    

    case "retrieveUserCat":
        
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
                $search_query.=" WHERE(user_cat_des LIKE '%{$search_str}%')";
            }

            $ord_column=$columns[$ord_col_id]['data'];
            $order_by=" ORDER BY {$ord_column} ".$ord_dir;

            $sql="SELECT COUNT(user_cat_id) FROM user_category ".$search_query;
            $c_result=mysqli_query($con, $sql);
            $rec=mysqli_fetch_row($c_result);
            $count=0;

            if(isset($rec[0])){
                $count=$rec[0];
            }

            $sql="SELECT * FROM user_category ".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
            $result=mysqli_query($con,$sql);

            $data=array();
            $ajax_response=array();

            if(mysqli_num_rows($result)>0){

                while($row=mysqli_fetch_assoc($result)){

                    $tmp=array(

                     
                        'user_cat_id'=>$row['user_cat_id'],
                        'user_cat_des'=>$row['user_cat_des'],
                        // 'user_cat_status'=>$row[' user_cat_status'],
                        'user_cat_status'=>$row['user_cat_status'],
                        'user_cat_id'=>$row['user_cat_id']

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

        case "deleteUserCat":

            // $user_cat_id= $_POST['user_cat_id'];
            
            // // $sql = "DELETE FROM user_category  WHERE user_cat_id=$user_cat_id";
            // $sql = "UPDATE user_category  SET user_cat_status=FALSE WHERE user_cat_id=$user_cat_id";
            // $result = mysqli_query($con, $sql);

            // if($result) {
            //     echo "deleted";
            // }


            $user_cat_id= $_POST['user_cat_id'];
               
               $sql = "UPDATE user_category  SET user_cat_status=FALSE WHERE user_cat_id=$user_cat_id";
   
          
   
               $result = mysqli_query($con, $sql);
   
               if($result) {
                   echo "deleted";
               }
        break;
}

?>


