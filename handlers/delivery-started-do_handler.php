<?php
   
require_once('../incl/dbconnection.php');

$type = $_GET["type"];

switch($type) {
 
    case "completeDelivery" : 
    
        $deliId=$_POST['deli_id'];
        $deliveryRecord = null;
        $orderRecord = null; 
        
        //select relevant delivery record
        $sql = "select * from delivery4 where deli_id = '$deliId' limit 1";
        $result=mysqli_query($con,$sql);
        
        if($result) {
            $deliveryRecord = mysqli_fetch_assoc($result);
            
            $orderId = $deliveryRecord['ord_id'];
            
            //select relevant order record
            $sql = "select * from tbl_orders3 where ord_id = '$orderId' limit 1";
            $result=mysqli_query($con,$sql);
            
            if($result) {
                //update delivery
                $sql = "update delivery4 set status = 'delivery completed' where deli_id = '$deliId'";
                $result=mysqli_query($con,$sql);
                
                if($result) {
                    //update order
                    $sql = "update tbl_orders3 set ord_status = 'completed' where ord_id = '$orderId'";
                    $result=mysqli_query($con,$sql);
                    
                    if($result) {
                        //check order details for stock update
                        $sql = "select * from order_detail3 where ord_id = '$orderId'";
                        $result=mysqli_query($con,$sql);
                        
                        if($result) {
                            if(mysqli_num_rows($result) > 0){
                                while($orderDetailRecord = mysqli_fetch_assoc($result)) {
                                    
                                    //check for normal orders and update stock
                                    if($orderDetailRecord['ord_type'] == 'Normal') {
                                        $proCode = $orderDetailRecord['pro_code'];
                                        
                                        $sql = "select * from stock3 where pro_code = '$proCode' limit 1";
                                        $result=mysqli_query($con,$sql);
                                        
                                        if($result) {
                                            $stockRecord = mysqli_fetch_assoc($result);
                                            
                                            $itemQty = $orderDetailRecord['item_qty'];
                                            $actualQty = $stockRecord['actual_qty'];
                                            
                                            $actualQty = floatval($actualQty) - floatval($itemQty);
                                            
                                            //update stock
                                            $sql = "update stock3 set actual_qty = '$actualQty' where pro_code = '$proCode'";
                                            $result=mysqli_query($con,$sql);
                                            
                                            if($result) {
                                                echo "stock updated";
                                            } else {
                                                echo "stock update failed";
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        
        break;


    case "onholdDelivery" : 
    
        $deliId=$_POST['deli_id'];
        
        $sql = "update delivery4 set status = 'delivery on hold' where deli_id = '$deliId'";
        
        $result=mysqli_query($con,$sql);
        
        if($result) {
            echo "success";
            
        } else {
            echo "error";
        }
        
        break;

    // case "addComentgg":


    //        $proQtyId =time();
    //        $orderDetailId = $_POST['orderDetailId'];
    //        $produceQty = $_POST['pq'];
    //        $wasteQty = $_POST['wq'];
    //       // variable name         //html text area name
    //        $labelcomment = $_POST['cmnt'];
   
    //        $has_errors = FALSE;
    //        $error_messages = array();
           
    //        // form txt box name
    //        if($produceQty == '' || $produceQty == NULL){
    //            $has_errors = TRUE;
    //            array_push($error_messages,'pro qty is required');
    //        }
   
    //        if($has_errors == TRUE) {
    //            echo json_encode($error_messages);
               
    //        } else {
               
             
    //         $sql = "INSERT INTO produce_quantity(pro_qty_id, ord_detail_id,actual_produce_qty,waste_qty,remark) 
    //         VALUES ('$proQtyId','$orderDetailId','$produceQty','$wasteQty','$labelcomment')";

    //            echo($sql);
               
    //            $result = mysqli_query($con,$sql);
               
    //            if($result) {
    //                echo "success";
                   
    //            } else {
    //                echo "error";
    //            }
    //        }
    // break;
        
        case "retrieveDeliveryStartedOrders":

            
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

      
    //   $sql="SELECT od.ord_detail_id AS ORDER_DETAIL_ID, od.ord_id AS ORDER_ID, p.pro_code AS PRO_CODE, p.pro_name AS PRODUCT_NAME, od.ord_type AS  ORDER_TYPE, od.item_qty AS QTY, ms.reserved_from AS RESERVED_FROM ,ms.reserved_to AS RESERVED_TO, 
    //     od.ord_detail_status AS ORD_DETAIL_STATUS FROM order_detail3 od 
    //     LEFT JOIN machine_schedule3 ms ON  ms.`ord_detail_id`= od.`ord_detail_id` 
    //     LEFT JOIN product3 p ON od.pro_code = p.pro_code 
    //     WHERE 
    //     od.ord_type IN ('customize','restock','balance request') AND ord_detail_status='completed' AND ms.mac_sche_status='1' ".$search_query.$order_by." LIMIT ".$offset.",".$limit."";

    $sql="SELECT d.`deli_id`,d.`ord_id`,v.veh_no ,v.`veh_type`,CONCAT(e.emp_fname,' ',e.emp_lname) AS employee_name ,d.`start_date`,d.end_date , d.status

    FROM delivery4 d
    
    LEFT JOIN vehicle v ON d.`veh_id`=v.veh_id 
    LEFT JOIN employee2 e ON d.`emp_no`=e.`emp_no`  WHERE d.status='delivery started' ".$search_query.$order_by." LIMIT ".$offset.",".$limit."";




        $result=mysqli_query($con,$sql);

        $data=array();
        $ajax_response=array();
        $count = mysqli_num_rows($result);   //to fix datatable entry count display
        if(mysqli_num_rows($result)>0){

            while($row=mysqli_fetch_assoc($result)){

                $tmp=array(
                    //.php  name='' side sql column name        //sql side
                    'deli_id'=>$row['deli_id'], 
                    'ord_id'=>$row['ord_id'],
                    'veh_no'=>$row['veh_no'],
                   

                  
                    'veh_type'=>$row['veh_type'],     
                    'emp_no'=>$row['employee_name'],
                    'start_date'=>$row['start_date'],
                    'end_date'=>$row['end_date'],
                    // 'remark'=>$row['remark'],
                
                    'status'=>$row['status'] ,
                    'deli_id'=>$row['deli_id'] //for option column

                   

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


       
                      


    }
    
    ?>
