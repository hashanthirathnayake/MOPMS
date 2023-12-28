<?php
   
require_once('../incl/dbconnection.php');

$type = $_GET["type"];

switch($type) {


    
    

    case "loadEditForm": 
        $vehId = $_POST['id'];
        
        $sql = "select * from vehicle where veh_id = '$vehId'";
        
        $result = mysqli_query($con,$sql);
        
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode($data);
    break;  

    // case "addVehicle":
       

    //         $vehId = $_POST['vehId'];  //id not visible to user but have to indicate
    //         $vehNo = $_POST['vehNo'];    
    //         $vehType = $_POST['vehType'];
    //         $vehBrand = $_POST['vehBrand'];

    //         $vehColor = $_POST['vehColor'];
          
    //         $vehYear = $_POST['vehYear'];
          
    //         $vehEngCapa = $_POST['vehEngCapa'];
          
    //         $vehStatus = $_POST['vehStatus'];
    //         // $vehAvailability = $_POST['vehAvailability'];

    //         $has_errors = FALSE;
    //         $error_messages = array();
            
    //                     // form txt box name
    //         if($vehNo == '' || $vehNo == NULL){
    //             $has_errors = TRUE;
    //             array_push($error_messages,'Username is required');
    //         }

    //         if($vehType == '' || $vehType == NULL){
    //             $has_errors = TRUE;
    //             array_push($error_messages,'Password is required');
    //         }
    //         if($vehYear == '' || $vehYear == NULL){
    //             $has_errors = TRUE;
    //             array_push($error_messages,'CreatedDate is required');
    //         }
            
    //         if($vehEngCapa == '' || $vehEngCapa == NULL){
    //             $has_errors = TRUE;
    //             array_push($error_messages,'CreatedDate is required');
    //         }
        
        
    //         if($has_errors == TRUE)
    //         {
    //             echo json_encode($error_messages);
    //         }
            
    //     else{     

        

    //         $sql = "INSERT INTO vehicle(veh_no,veh_type,veh_brand, veh_color,veh_year,veh_eng_capa,veh_status) 
    //         VALUES ('$vehNo','$vehType','$vehBrand','$vehColor','$vehYear','$vehEngCapa','$vehStatus')";
                           

    //         $result = mysqli_query($con,$sql);

    //         echo $sql;

    //         if($result) {
    //             echo "success";
    //         } else {
    //             echo "error";
    //         }

    //     }
    //     // else {                           //db column name //txt box name  
    //     //     // $sql = "UPDATE tbl_user SET (div_name =$config_divName , div_est_date=$config_divName , div_head = $config_divHo, div_address1 = $config_divAddress1, div_address2=$config_divAddress2, div_contact =$config_divContact, div_fax=$config_divFax, div_email=$config_divEmail, div_tagline =$config_divTag) WHERE div_id= $config_divId";
    //     //     $sql = "UPDATE tbl_user SET (usr_name =$userName , user_cat_id=$userCatDes , user_password = $userPass, user_created_date = $userCreatedDate,
    //     //      user_status=$userStatus) WHERE div_id= $user_id";

    //     //     $result = mysqli_query($con,$sql);

    //     //     if($result) {
    //     //         echo "success";
    //     //     } else {
    //     //         echo "error";
    //     //     } 
    //     //     // echo "id not null"
    //     //  } 
    //     break;
   

        case "saveVehicle":
            
            $vehId = $_POST['vehId'];  //id not visible to user but have to indicate
            $vehNo = $_POST['vehNo'];    
            $vehType = $_POST['vehType'];
            $vehBrand = $_POST['vehBrand'];

            $vehColor = $_POST['vehColor'];
          
            $vehYear = $_POST['vehYear'];
          
            $vehEngCapa = $_POST['vehEngCapa'];
          
            $vehStatus = $_POST['vehStatus'];
            // $vehAvailability = $_POST['vehAvailability'];
            $mode = $_POST['mode'];


            $has_errors = FALSE;
            $error_messages = array();
            
                        // form txt box name
            if($vehNo == '' || $vehNo == NULL){
                $has_errors = TRUE;
                array_push($error_messages,'Username is required');
            }

            if($vehType == '' || $vehType == NULL){
                $has_errors = TRUE;
                array_push($error_messages,'Password is required');
            }
            if($vehYear == '' || $vehYear == NULL){
                $has_errors = TRUE;
                array_push($error_messages,'CreatedDate is required');
            }
            
            if($vehEngCapa == '' || $vehEngCapa == NULL){
                $has_errors = TRUE;
                array_push($error_messages,'CreatedDate is required');
            }
        
    
            if($has_errors == TRUE) {
                echo json_encode($error_messages);
                
            } else {
                
                if($mode == "add") {
                    $sql = "INSERT INTO vehicle(veh_no,veh_type,veh_brand, veh_color,veh_year,veh_eng_capa,veh_status) 
            VALUES ('$vehNo','$vehType','$vehBrand','$vehColor','$vehYear','$vehEngCapa','$vehStatus')";
                
                } else if($mode == "edit") {
                    $sql = "update vehicle set veh_no = '$vehNo',veh_type='$vehType',veh_brand='$vehBrand',veh_color='$vehColor', veh_year='$vehYear',veh_eng_capa='$vehEngCapa',veh_status = '$vehStatus' where veh_id = '$vehId'";
                }
    
                $result = mysqli_query($con,$sql);
                
                if($result) {
                    echo "success";
                    
                } else {
                    echo "error";
                }
            }
    
            break;
        

    case "retrieveVehicle":
        

        
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
                $search_query.=" WHERE(veh_id LIKE '%{$search_str}%')";
            }

            $ord_column=$columns[$ord_col_id]['data'];
            $order_by=" ORDER BY {$ord_column} ".$ord_dir;

            $sql="SELECT COUNT(veh_no) FROM vehicle".$search_query;
            $c_result=mysqli_query($con, $sql);
            $rec=mysqli_fetch_row($c_result);
            $count=0;

            if(isset($rec[0])){
                $count=$rec[0];
            }

            $sql="SELECT * FROM vehicle".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
            $result=mysqli_query($con,$sql);

            $data=array();
            $ajax_response=array();

            if(mysqli_num_rows($result)>0){

                while($row=mysqli_fetch_assoc($result)){

                    $tmp=array(

                        'veh_id'=>$row['veh_id'],
                        'veh_no'=>$row['veh_no'],
                        'veh_type'=>$row['veh_type'],
                        'veh_brand'=>$row['veh_brand'],

                        'veh_color'=>$row['veh_color'],
                        'veh_year'=>$row['veh_year'],
                       
                        'veh_eng_capa'=>$row['veh_eng_capa'],

                        'veh_status'=>$row['veh_status'],
                        // 'veh_availability'=>$row['veh_availability'],
                        

                        'veh_id'=>$row['veh_id']  //option

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

        case "deleteVehicle":

            $veh_id= $_POST['veh_id'];
            
            $sql = "UPDATE vehicle  SET veh_status=FALSE WHERE veh_id=$veh_id";

           
            $result = mysqli_query($con, $sql);

            if($result) {
                echo "deleted";
            }
            break;

            
        //    case "deleteProductCategory":
   
        //     $pro_cat_code= $_POST['pro_cat_code'];
            
        //     $sql = "UPDATE product_category  SET pro_cat_status=FALSE WHERE pro_cat_code=$pro_cat_code";

       

        //     $result = mysqli_query($con, $sql);

        //     if($result) {
        //         echo "deleted";
        //     }
        //     break;
}

?>


