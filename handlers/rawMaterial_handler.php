<?php
   
require_once('../incl/dbconnection.php');

$type = $_GET["type"];

switch($type) {
    case "addRawMaterial":
       

            $rawMatId = $_POST['rawMatId'];  //id not visible to user but have to indicate
            $rawMatName = $_POST['rawMatName'];    
            $rawMatDes = $_POST['rawMatDes'];

            $rawMatMsrmnt = $_POST['rawMatMsrmnt'];
            // $rawMatStock = $_POST['rawMatStock'];
            $rawMatReorderQty = $_POST['rawMatReorderQty'];
          
            $rawMatStatus = $_POST['rawMatStatus'];
          

        $has_errors = FALSE;
        $error_messages = array();
        
                    // form txt box name
        if($rawMatName == '' || $rawMatName == NULL){
            $has_errors = TRUE;
            array_push($error_messages,'Username is required');
        }

        if($rawMatDes == '' || $rawMatDes == NULL){
            $has_errors = TRUE;
            array_push($error_messages,'Password is required');
        }
        
        if($rawMatMsrmnt == '' || $rawMatMsrmnt == NULL){
            $has_errors = TRUE;
            array_push($error_messages,'CreatedDate is required');
        }
        
        
        if($rawMatReorderQty == '' || $rawMatReorderQty == NULL){
            $has_errors = TRUE;
            array_push($error_messages,'Status  is required');
        }
    
        if($has_errors == TRUE)
        {
            echo json_encode($error_messages);
        }
        
        else{     

            // $sql = "INSERT INTO user(userr_name, user_pwd, ucat_id)
            //  VALUES ('$config_user_uname', '$config_user_pwd','$config_userCatRole')";
            // $result = mysqli_query($con,$sql);



            $sql = "INSERT INTO raw_material ( raw_mat_name,raw_mat_des,raw_mat_msrmnt, raw_mat_reorder_qty,raw_mat_status) 
            VALUES ('$rawMatName','$rawMatDes','$rawMatMsrmnt','$rawMatReorderQty','$rawMatStatus')";

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
    
    // case "getUserCategory": 
    //        $sql = "SELECT * FROM user_category";
    //        $result = mysqli_query($con,$sql);
    //         while($row = mysqli_fetch_assoc($result)) {
    //             $data[] = $row;
    //         }
    //         echo json_encode($data);
    //         break; 

    case "retrieveRawMaterial":
        

        
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
                $search_query.=" WHERE(raw_mat_name LIKE '%{$search_str}%')";
            }

            $ord_column=$columns[$ord_col_id]['data'];
            $order_by=" ORDER BY {$ord_column} ".$ord_dir;

            $sql="SELECT COUNT(raw_mat_id) FROM raw_material".$search_query;
            $c_result=mysqli_query($con, $sql);
            $rec=mysqli_fetch_row($c_result);
            $count=0;

            if(isset($rec[0])){
                $count=$rec[0];
            }

            $sql="SELECT * FROM raw_material".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
            $result=mysqli_query($con,$sql);

            $data=array();
            $ajax_response=array();

            if(mysqli_num_rows($result)>0){

                while($row=mysqli_fetch_assoc($result)){

                    $tmp=array(

                        'raw_mat_id'=>$row['raw_mat_id'],

                        'raw_mat_name'=>$row['raw_mat_name'],
                        'raw_mat_des'=>$row['raw_mat_des'],
                        'raw_mat_msrmnt'=>$row['raw_mat_msrmnt'],

                        // 'raw_mat_stock'=>$row['raw_mat_stock'],
                        'raw_mat_reorder_qty'=>$row['raw_mat_reorder_qty'],
                        'raw_mat_status'=>$row['raw_mat_status'],

                        'raw_mat_id'=>$row['raw_mat_id']

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

        case "deleteRawMaterial":

            $raw_mat_id= $_POST['raw_mat_id'];
            
            $sql = "UPDATE raw_material  SET raw_mat_status=FALSE WHERE raw_mat_id =$raw_mat_id";

          

            $result = mysqli_query($con, $sql);

            if($result) {
                echo "deleted";
            }
            break;

   
}

?>


