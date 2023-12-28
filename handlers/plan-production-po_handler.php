<?php
   
require_once('../incl/dbconnection.php');

$type = $_GET["type"];

switch($type) {
          
           
            
              

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
               
               
   
                $ordDetailId= $_POST["id"];
            
              
                $sql = "SELECT concat('ORD-',lpad(o.`ord_code`, 6, 0)) as ORDER_CODE, od.ord_detail_id as ORD_DETAIL_ID, od.ord_id AS ORDER_ID,  p.pro_name AS PRODUCT_NAME, p.`pro_des` AS DES,p.`pro_wastage` AS WASTE,p.`pro_unit_price` AS PRICE, p.pro_code as PRODUCT_CODE, 
                od.ord_type AS ORDER_TYPE, od.item_qty AS QTY ,o.ord_place_date AS ORD_PLACE_DATE, o.ord_deli_date AS CUS_REQ_DATE FROM ((order_detail3 od 
                LEFT JOIN product3 p 
                ON od.pro_code = p.pro_code )
                 LEFT JOIN tbl_orders3 o
                 ON    od.ord_id=o.ord_id)
                WHERE 
                od.ord_type IN ('customize','restock','balance request', 'domestic')  and od.ord_detail_id='$ordDetailId' LIMIT 1";
                
               $data= array();
               $result = mysqli_query($con,$sql);
                while($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                  
                }
                array_push($data,'dhsgdhds');
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
