<?php 
	require('../incl/dbconnection.php');
    /*require_once('../incl/config.php');
*/
$cus_firstname = $_POST['customer'];

    if (isset($_GET['type'])) {

        $status = $_POST['order_status'];


/*
        echo $status;*/
    $db = new Db();
    $con = $db->get_connection();
    $sql = "SELECT * FROM shp_customer,shp_order WHERE `cus_firstname` =? AND `ord_status`=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('si',$cus_firstname,$status);
    $stmt->execute();
    $result = $stmt->get_result();

    
    $data = array();
    $ajax_response = array();

    if($result->num_rows > 0)
    {
        while ($rec = $result->fetch_assoc()) {
                
            $tmp = array(

                                                                                 cus_name=   cus_firstname+ cus_lastname
                'cus_name'=>$rec['cus_firstname']." ".$rec['cus_lastname'] ,   //how to combining 2 text boxes values in to one text box
                'ord_date'=>$rec['ord_date'],
                'ord_no'=>$rec['ord_id'],
                'net_total'=>$rec['ord_net_total'], 
                'ord_address'=>$rec['ord_ship_add1']." ".$rec['ord_ship_add2']." ".$rec['ord_ship_city']." ".$rec['ord_ship_zipcode']." ".$rec['ord_ship_country']
            );

            array_push($data,$tmp);
        }
       echo json_encode($data);


    }

    while ($rec = $result->fetch_assoc()) {
        $response = $rec;
    }
 
    $stmt->close();
    $con->close();
}




	
	
 