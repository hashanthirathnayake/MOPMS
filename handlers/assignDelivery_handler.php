<?php
   
    require_once('../incl/dbconnection.php');

    $type = $_GET["type"];

    switch($type) {
        
        case "retrieveOrderDetails":
            $orderId = $_POST["order_id"];
            
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
                $search_query.=" WHERE(ord_detail_id LIKE '%{$search_str}%')";
            }

            $ord_column=$columns[$ord_col_id]['data'];
            $order_by=" ORDER BY {$ord_column} ".$ord_dir;

            $sql="SELECT COUNT(ord_detail_id) FROM order_detail3".$search_query;
            $c_result=mysqli_query($con, $sql);
            $rec=mysqli_fetch_row($c_result);
            $count=0;

            if(isset($rec[0])){
                $count=$rec[0];
            }
         
            $sql="select p.pro_name, p.pro_des, d.* from order_detail3 d 
                left join product3 p on p.pro_code = d.pro_code 
                where 
                d.ord_id = '".$orderId."' order by p.pro_name";

            $result=mysqli_query($con,$sql);

            $data=array();
            $ajax_response=array();

            if(mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){

                    $tmp=array(
                        'pro_name'=>$row['pro_name'], 
                        'pro_des'=>$row['pro_des'],
                        'item_qty'=>$row['item_qty'],
                        'item_subtotal'=>$row['item_subtotal'],     
                        'ord_type'=>$row['ord_type'],
                        'ord_detail_status'=>$row['ord_detail_status']
                    );
                    array_push($data,$tmp);
                }
            }
            
            $count = mysqli_num_rows($result);

            $ajax_response['data']= $data;
            $ajax_response['draw']= $_POST['draw'];
            $ajax_response['recordsTotal']=$count;
            $ajax_response['recordsFiltered']=$count;

            echo json_encode($ajax_response);
            
            break;
            
        case "retrieveVehicleSchedules":
            $vehicleId = $_POST["vehicle_id"];
            
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
                $search_query.=" WHERE(deli_id LIKE '%{$search_str}%')";
            }

            $ord_column=$columns[$ord_col_id]['data'];
            $order_by=" ORDER BY {$ord_column} ".$ord_dir;

            $sql="SELECT COUNT(deli_id) FROM delivery4".$search_query;
            $c_result=mysqli_query($con, $sql);
            $rec=mysqli_fetch_row($c_result);
            $count=0;

            if(isset($rec[0])){
                $count=$rec[0];
            }
         
            $sql="select d.start_date, d.end_date, d.status from delivery4 d 
                where 
                d.veh_id = '".$vehicleId."' order by d.start_date asc";

            $result=mysqli_query($con,$sql);

            $data=array();
            $ajax_response=array();

            if(mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){

                    $tmp=array(
                        'start_date'=>$row['start_date'], 
                        'end_date'=>$row['end_date'],
                        'status'=>$row['status']
                    );
                    array_push($data,$tmp);
                }
            }
            
            $count = mysqli_num_rows($result);

            $ajax_response['data']= $data;
            $ajax_response['draw']= $_POST['draw'];
            $ajax_response['recordsTotal']=$count;
            $ajax_response['recordsFiltered']=$count;

            echo json_encode($ajax_response);
            
            break;
            
        case "retrieveDriverSchedules":
            $driverId = $_POST["driver_id"];
            
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
                $search_query.=" WHERE(deli_id LIKE '%{$search_str}%')";
            }

            $ord_column=$columns[$ord_col_id]['data'];
            $order_by=" ORDER BY {$ord_column} ".$ord_dir;

            $sql="SELECT COUNT(deli_id) FROM delivery4".$search_query;
            $c_result=mysqli_query($con, $sql);
            $rec=mysqli_fetch_row($c_result);
            $count=0;

            if(isset($rec[0])){
                $count=$rec[0];
            }
         
            $sql="select d.start_date, d.end_date, d.status from delivery4 d 
                where 
                d.emp_no = '".$driverId."' order by d.start_date asc";

            $result=mysqli_query($con,$sql);

            $data=array();
            $ajax_response=array();

            if(mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){

                    $tmp=array(
                        'start_date'=>$row['start_date'], 
                        'end_date'=>$row['end_date'],
                        'status'=>$row['status']
                    );
                    array_push($data,$tmp);
                }
            }
            
            $count = mysqli_num_rows($result);

            $ajax_response['data']= $data;
            $ajax_response['draw']= $_POST['draw'];
            $ajax_response['recordsTotal']=$count;
            $ajax_response['recordsFiltered']=$count;

            echo json_encode($ajax_response);
            
            break;
        
        case "getVehicle": 
            $sql = "select * from vehicle where veh_status = 1  ";
                
            $result = mysqli_query($con,$sql);
            
            while($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
                    
            echo json_encode($data);
            
            break;

        case "getDriver": 
            $sql = "SELECT * FROM employee2 where desig_id='6' and emp_status='1' ";
            
            $result = mysqli_query($con,$sql);
            
            while($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            
            echo json_encode($data);
            
            break;
            
        case "saveDelivery":
            
            $delivery_pk = time();
            $ord_id = $_POST['ordId'];
            $veh_id = $_POST['deliVehicle'];
            $emp_no = $_POST['deliDriver'];
            $status = "delivery scheduled";
            $start_date = $_POST['startDate'];
            $end_date = $_POST['endDate'];
            
            $sql = "INSERT INTO delivery4 (deli_id, ord_id, veh_id, emp_no, status, start_date, end_date) 
                    VALUES ('$delivery_pk', '$ord_id', '$veh_id', '$emp_no', '$status', '$start_date', '$end_date')";
            
            echo $sql;

            $result = mysqli_query($con, $sql);

            if($result) {
                $sql2 = "UPDATE tbl_orders3 SET ord_status = '$status' where ord_id = '$ord_id'";
                
                $result2 = mysqli_query($con, $sql2);
                
                if($result2) {
                    echo "success";
                    
                } else {
                    echo "error";
                }

            } else {
                echo "error";
            }
            
            break;

            case "selectMachine": 

               
           
                $productCode = $_POST["product_id"];
        
                $sql = "select m.mac_id as MACHINE_ID, m.mac_name as MACHINE_NAME from machine3 m 
                        left join machine_config3 mc on mc.mac_id = m.mac_id 
                        where 
                        mc.pro_code = '$productCode' and m.mac_status = 1  ";
                  
                  $result = mysqli_query($con,$sql);
                    while($row = mysqli_fetch_assoc($result)) {
                        $data[] = $row;
                    }
                    
                    echo json_encode($data);
            break;

        case "viewOrderDetail":
            
            $order_id = $_POST["id"];
             
            $sql = "SELECT tor.`ord_id` AS ORD_ID, lpad(tor.`ord_code`, 6, 0) as ORD_CODE, tor.`ord_place_date` AS PLACE_ON, tor.`ord_deli_date` AS DELIVERY_REQUIRED_ON,
                    CONCAT(cus.cus_fname, '  ', cus.cus_lname)  AS CUS_NAME, cus.`cus_address` AS ADDRESS,   cus.`cus_city` AS CITY
                    FROM tbl_orders3 tor 
                    LEFT JOIN customer cus ON tor.cus_id=cus.cus_id WHERE tor.ord_status='pending' 
                    AND tor.`ord_id` = '$order_id' group by tor.`ord_id` limit 1";
                    
            $data= array();
                    
            $result = mysqli_query($con,$sql);
            
            while($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            
            echo json_encode($data);
            break; 
               
         
            

            case "retrieveSchedule":
                $machineId = $_POST['machineId'];        
        
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
                    $search_query.=" WHERE(mac_sche_id LIKE '%{$search_str}%')";
                }

                $ord_column=$columns[$ord_col_id]['data'];
                $order_by=" ORDER BY {$ord_column} ".$ord_dir;

                $sql="SELECT COUNT(mac_sche_id) FROM machine_schedule3".$search_query;
                $c_result=mysqli_query($con, $sql);
                $rec=mysqli_fetch_row($c_result);
                $count=0;

                if(isset($rec[0])){
                    $count=$rec[0];
                }

                $sql="SELECT * FROM machine_schedule3 WHERE mac_id = '$machineId' ".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
                $result=mysqli_query($con,$sql);

                $data=array();
                $ajax_response=array();

                if(mysqli_num_rows($result)>0){

                    while($row=mysqli_fetch_assoc($result)){

                        $tmp=array(

                            'mac_sche_id'=>$row['mac_sche_id'],
                            'ord_detail_id'=>$row['ord_detail_id'],
                            'mac_id'=>$row['mac_id'],
                            'reserved_from'=>$row['reserved_from'],
                            'reserved_to'=>$row['reserved_to'],
                            
                            'mac_sche_status'=>$row['mac_sche_status'],

                            'mac_sche_id'=>$row['mac_sche_id']   //option colmn

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


        case "addScheduleList":
        
            $ordDETAILid= $_POST["ID"];  
            // $productCode = $_POST["product_id"];
        // $ord_detail_id = $_POST['ord_detail_id'];
        $mac_id = $_POST['mac_id'];
        
        $macReservedFrom = $_POST['macReservedFrom'];
        $macReservedTo = $_POST['macReservedTo'];
        // $macScheStatus=$_POST['macScheStatus'];
        
       

    $has_errors = FALSE;
    $error_messages = array();
    
                // form txt box name
    
    if($macReservedFrom == '' || $macReservedFrom == NULL){
        $has_errors = TRUE;
        array_push($error_messages,'from date is required');
    }

    if($macReservedTo == '' || $macReservedTo == NULL){
        $has_errors = TRUE;
        array_push($error_messages,'to date is required');
    }


    if($has_errors == TRUE)
    {
        echo json_encode($error_messages);
    }
    
    else{     

        // $sql = "INSERT INTO machine_schedule3 (reserved_from,reserved_to) 
        // VALUES ('$macReservedFrom','$macReservedTo')";

        
        $sql = "INSERT INTO machine_schedule3 (ord_detail_id,mac_id,reserved_from,reserved_to,mac_sche_status) 
        VALUES ('$ordDETAILid','$mac_id','$macReservedFrom','$macReservedTo','1')";


        $result = mysqli_query($con,$sql);

        echo $sql;

        if($result) {
            echo "success";
                //                                 //change order status pending ->  machine scheduled
                $sql2 = "update order_detail3 set  ord_detail_status='machine scheduled' where ord_detail_id = '$ordDETAILid' ";
                echo $sql2;
                                                                                                
                $result1 = mysqli_query($con,$sql2) or die ("Error!-" .mysqli_error($con));



        } else {
            echo "error";
        }

    }

    break;


    
   
    case "loadMachineConfigDetails":
    
        $machineId = $_POST["machine_id"];
        $productId = $_POST["product_id"];
       
        $sql = "SELECT mac_min_qty as MIN_QTY, mac_max_qty_per_day as MAX_QTY_PER_DAY FROM machine_config3 
                where 
                mac_id = '$machineId' and pro_code = '$productId' limit 1";

        $result = mysqli_query($con,$sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode($data);

    break;


    
    case "removeMachineSchedule":
   
        $machineSheduleId= $_POST['mac_sche_id'];
        
        $sql = "UPDATE machine_schedule3  SET mac_sche_status='0' WHERE mac_sche_id='$machineSheduleId' ";
        // $sql = "DELETE machine_schedule3   WHERE mac_sche_status=$machineSheduleId";
   

        $result = mysqli_query($con, $sql);

        if($result) {
            echo "deleted";
        }

        break;

}




    ?>
