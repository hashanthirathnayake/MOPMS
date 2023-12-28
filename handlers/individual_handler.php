<?php
   
require_once('../incl/dbconnection.php');

$type = $_GET["type"];

switch($type) {
    case "addIndividualCustomer":
       

            $cusId = $_POST['cusId'];  //id not visible to user but have to indicate
            $cusFname = $_POST['cusFname'];    
            $cusLname = $_POST['cusLname'];
            $cusNic = $_POST['cusNic'];
            $cusCity = $_POST['cusCity'];

            $cusAddress = $_POST['cusAddress'];
            $cusPhoneNo = $_POST['cusPhoneNo'];
            $cusWhatsapNo = $_POST['cusWhatsapNo'];
            $cusEmail = $_POST['cusEmail'];

            // $cusLname = $_POST['cusLname'];
            

        $has_errors = FALSE;
        $error_messages = array();
        
                    // form txt box name
        if($cusFname == '' || $cusFname == NULL){
            $has_errors = TRUE;
            array_push($error_messages,'Username is required');
        }

        if($cusAddress == '' || $cusAddress == NULL){
            $has_errors = TRUE;
            array_push($error_messages,'Password is required');
        }
        
        if($cusPhoneNo == '' || $cusPhoneNo == NULL){
            $has_errors = TRUE;
            array_push($error_messages,'CreatedDate is required');
        }
        
         
        if($has_errors == TRUE)
        {
            echo json_encode($error_messages);
        }
        
        else{     

           


            $sql = "INSERT INTO customer (cus_fname,cus_lname,cus_nic,cus_city, cus_address, cus_phone_no,cus_whatsap_no,cus_email )
            VALUES ('$cusFname','$cusLname','$cusNic','$cusCity','$cusAddress','$cusPhoneNo','$cusWhatsapNo','$cusEmail')";

            $result = mysqli_query($con,$sql);

            echo $sql;

            if($result) {
                echo "success";
            } else {
                echo "error";
            }

        }
    
        break;
    
   

    

}

?>


