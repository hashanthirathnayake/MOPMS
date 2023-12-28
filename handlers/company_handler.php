<?php
   
require_once('../incl/dbconnection.php');

$type = $_GET["type"];

switch($type) {
    case "addCompany":
       

            // $userId = $_POST['userId'];  //id not visible to user but have to indicate
            $companyId = $_POST['companyId'];  
                      
            $companyName = $_POST['companyName'];
            $companyRegNo = $_POST['companyRegNo'];
           
            $companyAddress = $_POST['companyAddress'];
            $companyCity = $_POST['companyCity'];
            $companyHot = $_POST['companyHot'];
        
            $companyWhats = $_POST['companyWhats'];
            $companyEmail = $_POST['companyEmail'];
            $companyWeb = $_POST['companyWeb'];
            $companyStatus = $_POST['companyStatus'];

        $has_errors = FALSE;
        $error_messages = array();
        
                    // form txt box name
                    if($companyName == '' || $companyName == NULL){
                        $has_errors = TRUE;
                        array_push($error_messages,'Username is required');
                    }
            
                    if($companyRegNo == '' || $companyRegNo == NULL){
                        $has_errors = TRUE;
                        array_push($error_messages,'Password is required');
                    }
                    
                    if($companyAddress == '' || $companyAddress == NULL){
                        $has_errors = TRUE;
                        array_push($error_messages,'address is required');
                    }
                    
                    if($companyCity == '' || $companyCity == NULL){
                        $has_errors = TRUE;
                        array_push($error_messages,'city  is required');
                    }
    
        if($has_errors == TRUE)
        {
            echo json_encode($error_messages);
        }
        
        else{     

            // $sql = "INSERT INTO user(userr_name, user_pwd, ucat_id)
            //  VALUES ('$config_user_uname', '$config_user_pwd','$config_userCatRole')";
            // $result = mysqli_query($con,$sql);



            $sql = "INSERT INTO company ( com_name,com_reg_no, com_address, com_city,com_hotline,com_whatsap,com_email,com_website,com_status) 
            VALUES ('$companyName','$companyRegNo','$companyAddress','$companyCity', '$companyHot', '$companyWhats','$companyEmail','$companyWeb','$companyStatus')"; 

            $result = mysqli_query($con,$sql);

            echo $sql;

            if($result) {
                echo "success";
            } else {
                echo "error";
            }

        }
        // else {                           //db column name //txt box name  
        //     // $sql = "UPDATE tbl_user SET (div_name =$config_divName , div_est_date=$config_divName , div_head = $config_divHo, div_address1 = $config_divAddress1, div_address2=$config_divAddress2, div_contact =$config_divContact, div_fax=$config_divFax, div_email=$config_divEmail, div_tagline =$config_divTag) WHERE div_id= $config_divId";
        //     $sql = "UPDATE tbl_user SET (usr_name =$userName , user_cat_id=$userCatDes , user_password = $userPass, user_created_date = $userCreatedDate,
        //      user_status=$userStatus) WHERE div_id= $user_id";

        //     $result = mysqli_query($con,$sql);

        //     if($result) {
        //         echo "success";
        //     } else {
        //         echo "error";
        //     } 
        //     // echo "id not null"
        //  } 
        break;
    
   

    case "retrieveCompany":
        

        
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
                $search_query.=" WHERE(com_name LIKE '%{$search_str}%')";
            }

            $ord_column=$columns[$ord_col_id]['data'];
            $order_by=" ORDER BY {$ord_column} ".$ord_dir;

            $sql="SELECT COUNT(com_id) FROM company".$search_query;
            $c_result=mysqli_query($con, $sql);
            $rec=mysqli_fetch_row($c_result);
            $count=0;

            if(isset($rec[0])){
                $count=$rec[0];
            }

            $sql="SELECT * FROM company".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
            $result=mysqli_query($con,$sql);

            $data=array();
            $ajax_response=array();

            if(mysqli_num_rows($result)>0){

                while($row=mysqli_fetch_assoc($result)){

                    $tmp=array(

                        'com_id'=>$row['com_id'],
                        'com_name'=>$row['com_name'],
                        'com_reg_no'=>$row['com_reg_no'],
                        'com_address'=>$row['com_address'],

                        'com_city'=>$row['com_city'],
                        'com_hotline'=>$row['com_hotline'],
                        'com_whatsap'=>$row['com_whatsap'],

                        'com_email'=>$row['com_email'],
                        'com_website'=>$row['com_website'],
                        'com_status'=>$row['com_status'],

                   

                        'com_id'=>$row['com_id']  //option


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




        case "deleteCompany":

            $com_id= $_POST['com_id'];
            
            $sql = "UPDATE company  SET com_status=FALSE WHERE com_id=$com_id";

            // $sql = 'UPDATE shp_sub_category SET
            //  cat_id=? , sub_cat_name=? , sub_cat_display_name=?, sub_cat_status=?, sub_category_code=? WHERE sub_cat_id=?';

            $result = mysqli_query($con, $sql);

            if($result) {
                echo "deleted";
            }
            break;

            case "getCompany":

                $com_id= $_POST['com_id'];
           
            $sql = "SELECT * FROM company where com_id = $com_id";
             
        //  echo  $sql;
        //  exit();
                $result = mysqli_query($con, $sql);
                $result = mysqli_fetch_assoc($result);
               
                    if($result) {
                    echo json_encode( $result);
                }
                break;



                case "editMachine":
       
                    $companyId = $_POST['companyId'];  
                      
                    $companyName = $_POST['companyName'];
                    $companyRegNo = $_POST['companyRegNo'];
                   
                    $companyAddress = $_POST['companyAddress'];
                    $companyCity = $_POST['companyCity'];
                    $companyHot = $_POST['companyHot'];
                
                    $companyWhats = $_POST['companyWhats'];
                    $companyEmail = $_POST['companyEmail'];
                    $companyWeb = $_POST['companyWeb'];
                    $companyStatus = $_POST['companyStatus'];
        
                $has_errors = FALSE;
                $error_messages = array();
                
                            // form txt box name
                            if($companyName == '' || $companyName == NULL){
                                $has_errors = TRUE;
                                array_push($error_messages,'Username is required');
                            }
                    
                            if($companyRegNo == '' || $companyRegNo == NULL){
                                $has_errors = TRUE;
                                array_push($error_messages,'Password is required');
                            }
                            
                            if($companyAddress == '' || $companyAddress == NULL){
                                $has_errors = TRUE;
                                array_push($error_messages,'address is required');
                            }
                            
                            if($companyCity == '' || $companyCity == NULL){
                                $has_errors = TRUE;
                                array_push($error_messages,'city  is required');
                            }
            
                if($has_errors == TRUE)
                {
                    echo json_encode($error_messages);
                }
                
                else{     
        
                //     company ( com_name,com_reg_no, com_address, com_city,com_hotline,com_whatsap,com_email,com_website,) 
                //     VALUES ('$companyName','$companyRegNo','$companyAddress','$companyCity', '$companyHot', '$companyWhats','$companyEmail','$companyWeb','$')";
        
                // //  $sql = "INSERT INTO machine (mac_name,emp_no,mac_min_qty, mac_max_qty_per_day,mac_status ,mac_availability) 
                // // VALUES ('$macName','$macSupName','$macMinQty','$macMaxQty','$macStatus','$macAvailability')";

         $sql = "UPDATE company SET  com_name='$companyName', com_reg_no='$companyRegNo',com_address='$companyAddress',com_city='$companyCity',com_hotline='$companyHot',com_whatsap='$companyWhats',com_email='$companyEmail',
         com_status='$comStatus' WHERE com_id= '$companyId' ";

        //  $sql = "UPDATE division SET (div_name =$config_divName , div_est_date=$config_divName , div_head = $config_divHo, div_address1 = $config_divAddress1, 
        //  div_address2=$config_divAddress2, div_contact =$config_divContact, div_fax=$config_divFax, div_email=$config_divEmail, div_tagline =$config_divTag) 
        //  WHERE div_id= $config_divId";
                
        // $companyId = $_POST['companyId'];  
                      
        // $companyName = $_POST['companyName'];
        // $companyRegNo = $_POST['companyRegNo'];
       
        // $companyAddress = $_POST['companyAddress'];
        // $companyCity = $_POST['companyCity'];
        // $companyHot = $_POST['companyHot'];
    
        // $companyWhats = $_POST['companyWhats'];
        // $companyEmail = $_POST['companyEmail'];
        // $companyWeb = $_POST['companyWeb'];
        // $companyStatus 


                    $result = mysqli_query($con,$sql) or die("Error! - ".mysqli_error($con));
        
                    echo $sql;
        
                    if($result) {
                        echo "success";
                    } else {
                        echo "error";
                    }
        
                }


}

?>
