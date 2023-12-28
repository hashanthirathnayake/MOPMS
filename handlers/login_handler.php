<?php

require_once('../incl/dbconnection.php');
require_once('config.php');
$type = $_GET["type"];

switch($type) {
    case "userLogin":
        $loginUsername = $_POST['loginUsername'];
        $loginPassword = $_POST['loginPassword'];
        $password = md5($loginPassword);

        $sql = "SELECT * FROM tbl_user WHERE usr_name='$loginUsername' AND user_password='$password' AND user_status=1 LIMIT 1";
        $result = mysqli_query($con,$sql);
        $count  = mysqli_num_rows($result);
       
        if($count>0){
            $row=mysqli_fetch_assoc($result);           
            if($row['user_status']==1)
            {
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['usr_name'] = $row['usr_name'];
                $_SESSION['user_cat_id'] = $row['user_cat_id'];

               $userId1 = $row['user_id'];
                $userName1 = $row['usr_name'];
                $userCatId1 = $row['user_cat_id'];
                
                if($row['user_cat_id']==1)
                    {
                        $response = array(
                            'status'=>'success',
                            'redirect'=>$root_path.'admin_dash.php',   // header for admin is - just "header"
                            'userId'=>$userId1,
                            'username'=>$userName1,
                            'usecatid'=>$userCatId1,

                        );                            
                    }
                // else if($row['user_cat_id'] == 2)
                //     {
                //         $response = array(
                //             'status'=>'success',
                //             'redirect'=>$root_path.'manager_dash.php'
                //         );                            
                //     }
                else if($row['user_cat_id']== 5)
                    {
                        $response = array(
                            'status'=>'success',
                            'redirect'=>$root_path.'assistant_dash.php',
                            'userId'=>$userId1,
                            'username'=>$userName1,
                            'usecatid'=>$userCatId1,
                        );
                    }
                else if($row['user_cat_id']== 6)
                    {
                        $response = array(
                            'status'=>'success',
                            'redirect'=>$root_path.'productionOfficer_dash.php',
                            'userId'=>$userId1,
                            'username'=>$userName1,
                            'usecatid'=>$userCatId1,
                        );
                    }
                else if($row['user_cat_id'] == 7)
                    {
                        $response = array(
                            'status'=>'success',
                            'redirect'=>$root_path.'deliveryOfficer_dash.php',
                            'userId'=>$userId1,
                            'username'=>$userName1,
                            'usecatid'=>$userCatId1,
                        );
                    }
             
                else {
                    $response = array(
                        'status'=>'error',
                        'redirect'=>$root_path.'access_denied.php'
                    );
                }              
            }
            else
            {
                $response = array(
                    'status'=>'error',
                    'message'=>'Your account is deactivated'
                );
            }
        }
        
        else
        {
            $response = array(
                'status'=>'error',
                'message'=>'Invalid username or password. Please recheck your login details'
            );
        }

        echo json_encode($response);
    break;

    case "userLogout":
       
            session_destroy();
            unset($_SESSION['user_id']); 
            unset($_SESSION['usr_name']);
            unset($_SESSION['user_cat_id']);

            $response = array(
                'status'=>'success',
                'redirect'=>$root_path.'login2.php'
            );
            echo json_encode($response);
    break;    
}

?>
