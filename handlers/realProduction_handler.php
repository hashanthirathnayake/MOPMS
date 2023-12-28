<?php
   
require_once('../incl/dbconnection.php');

$type = $_GET["type"];

switch($type) {

       
    case "startProduction" :   //realProduction.php
        
        $orderDetailId=$_POST['orderDetailId'];
        
        $sql = "update order_detail3 set ord_detail_status = 'production started' where ord_detail_id = '$orderDetailId'";
        
        $result=mysqli_query($con,$sql);
        
        if($result) {
            echo "success";
            
        } else {
            echo "error";
        }
        
        break;
    
    case "completeProduction" :   //for real-production-started.php file
    
        $orderDetailId=$_POST['orderDetailId'];
        
        //update order detail record
        $sql = "update order_detail3 set ord_detail_status = 'completed' where ord_detail_id = '$orderDetailId'";
        $result=mysqli_query($con,$sql);
        
        if($result) {
            
            //select order detail
            $sql = "select pro_code, item_qty, ord_type from order_detail3 where ord_detail_id = '$orderDetailId' limit 1";
            echo $sql;
            $result=mysqli_query($con,$sql);
            
            if(mysqli_num_rows($result)>0){
                
                    $row=mysqli_fetch_assoc($result);
                    $pc = $row['pro_code'];
                    $iq = $row['item_qty'];
                    $ot = $row['ord_type'];
                    
                    if ($ot == "Normal" || $ot == "Domestic") {
                        //select stock record
                        $sql = "select * from stock3 where pro_code = '$pc' limit 1";
                        $result=mysqli_query($con,$sql);

                        //update stock
                        if(mysqli_num_rows($result)>0){

                                $row=mysqli_fetch_assoc($result);
                                $stockId = $row['stock_id'];
                                $availableQty = $row['available_qty'];
                                $actualQty = $row['actual_qty'];

                                //if domestic order add to stock
                                if($ot == "Domestic") {
                                    $availableQty = (floatval($iq) + floatval($availableQty));
                                    $actualQty = (floatval($iq) + floatval($actualQty));

                                } else if ($ot == "Normal") {
                                    //reduce from stock
                                    $availableQty = (floatval($availableQty) - floatval($iq));
                                    $actualQty = (floatval($actualQty) - floatval($iq));
                                }

                                $sql = "update stock3 set available_qty = '$availableQty', actual_qty = '$actualQty' where stock_id = '$stockId'";

                                $result=mysqli_query($con,$sql);

                                if($result) {
                                    echo "Stock updated";

                                } else {
                                    echo "Stock update failed";
                                }
                            
                        } else {
                            //insert stock
                            //if domestic order add to stock
                            if($ot == "Domestic") {
                                $availableQty = (floatval($iq));
                                $actualQty = (floatval($iq));

                            } else if ($ot == "Normal") {
                                //reduce from stock
                                $availableQty = (floatval($iq) * (-1));
                                $actualQty = (floatval($iq) * (-1));
                            }
                            
                            echo $actualQty;
                            
                            $stockId = time();
                            
                            $sql = "INSERT INTO stock3 (`stock_id`,`pro_code`,`available_qty`,`actual_qty`) VALUES ('$stockId','$pc','$availableQty','$actualQty')";
                            
                            
                            $result=mysqli_query($con,$sql);

                            if($result) {
                                echo "Stock added";

                            } else {
                                echo "Stock add failed";
                            }
                            
                        }
                        
                    }
                
            }   //end of mysql num rows
            
            echo "success";
            
        } //end of result
        else {
            echo "error";
        }
        
        break;


    case "onholdProduction" :   //for real-production-started.php file
    
        $orderDetailId=$_POST['orderDetailId'];
        
        $sql = "update order_detail3 set ord_detail_status = 'production on hold' where ord_detail_id = '$orderDetailId'";
        
        $result=mysqli_query($con,$sql);
        
        if($result) {
            echo "success";
            
        } else {
            echo "error";
        }
        
        break;

    case "retrieveMachineScheduledOrders":  //real prduction.php

            
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


        // SELECT od.ord_detail_id AS ORDER_DETAIL_ID, od.ord_id AS ORDER_ID, p.pro_code AS PRO_CODE, p.pro_name AS PRODUCT_NAME, od.ord_type AS ORDER_TYPE, od.item_qty AS QTY 
        // ,od.`ord_detail_status` AS ORD_DETAIL_STATUS
        // FROM order_detail3 od 
        // LEFT JOIN product3 p ON od.pro_code = p.pro_code 
        // WHERE 
        // od.ord_type IN ('customize','restock','balance request') AND od.`ord_detail_status`='machine scheduled'
        
        $search_query = "";
        $order_by = " order by ms.reserved_from asc, ms.reserved_to ";

$sql="SELECT od.ord_detail_id AS ORDER_DETAIL_ID, od.ord_id AS ORDER_ID, concat('ORD-',lpad(o.`ord_code`, 6, 0)) as ORDER_CODE, p.pro_code AS PRO_CODE, p.pro_name AS PRODUCT_NAME, 
        od.ord_type AS ORDER_TYPE, od.item_qty AS QTY, ms.reserved_from AS RESERVED_FROM ,ms.reserved_to AS RESERVED_TO, 
        od.ord_detail_status AS ORD_DETAIL_STATUS FROM order_detail3 od 
        LEFT JOIN machine_schedule3 ms ON  ms.`ord_detail_id`= od.`ord_detail_id` 
        LEFT JOIN product3 p ON od.pro_code = p.pro_code 
        LEFT JOIN tbl_orders3 o on o.ord_id = od.ord_id 
        WHERE 
        od.ord_type IN ('customize','restock','balance request', 'domestic') AND ord_detail_status='machine scheduled' AND ms.mac_sche_status='1' ".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
        
        //echo $sql;

        $result=mysqli_query($con,$sql);

        $data=array();
        $ajax_response=array();
        $count = mysqli_num_rows($result);   //to fix datatable entry count display

        if(mysqli_num_rows($result)>0){

            while($row=mysqli_fetch_assoc($result)){

                $tmp=array(
                    //.php  name='' side sql column name        //sql side
                    'ord_id'=>$row['ORDER_ID'], 
                    'ord_code'=>$row['ORDER_CODE'], 
                    'ord_type'=>$row['ORDER_TYPE'],
                    'pro_code'=>$row['PRO_CODE'],
                   

                  
                    'pro_name'=>$row['PRODUCT_NAME'],     
                    'item_qty'=>$row['QTY'],
                    'ord_detail_status'=>$row['ORD_DETAIL_STATUS'],
                    'mac_reserved_from'=>$row['RESERVED_FROM'],
                    'mac_reserved_to'=>$row['RESERVED_TO'],
                
                    'ord_detail_id'=>$row['ORDER_DETAIL_ID']  //for option column

                   

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
        
        case "retrieveProductionStartedOrders":  //real-production-started .php

            
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


        // SELECT od.ord_detail_id AS ORDER_DETAIL_ID, od.ord_id AS ORDER_ID, p.pro_code AS PRO_CODE, p.pro_name AS PRODUCT_NAME, od.ord_type AS ORDER_TYPE, od.item_qty AS QTY 
        // ,od.`ord_detail_status` AS ORD_DETAIL_STATUS
        // FROM order_detail3 od 
        // LEFT JOIN product3 p ON od.pro_code = p.pro_code 
        // WHERE 
        // od.ord_type IN ('customize','restock','balance request') AND od.`ord_detail_status`='machine scheduled'

        $search_query = "";
        $order_by = " order by ms.reserved_from asc, ms.reserved_to ";

$sql="SELECT od.ord_detail_id AS ORDER_DETAIL_ID, od.ord_id AS ORDER_ID, concat('ORD-',lpad(o.`ord_code`, 6, 0)) as ORDER_CODE, p.pro_code AS PRO_CODE, p.pro_name AS PRODUCT_NAME, 
        od.ord_type AS ORDER_TYPE, od.item_qty AS QTY, ms.reserved_from AS RESERVED_FROM ,ms.reserved_to AS RESERVED_TO, 
        od.ord_detail_status AS ORD_DETAIL_STATUS FROM order_detail3 od 
        LEFT JOIN machine_schedule3 ms ON  ms.`ord_detail_id`= od.`ord_detail_id` 
        LEFT JOIN product3 p ON od.pro_code = p.pro_code 
        LEFT JOIN tbl_orders3 o on o.ord_id = od.ord_id 
        WHERE 
        od.ord_type IN ('customize','restock','balance request', 'domestic') AND ord_detail_status='production started' AND ms.mac_sche_status='1' ".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
        
        //echo $sql;
        $result=mysqli_query($con,$sql);

        $data=array();
        $ajax_response=array();
        $count = mysqli_num_rows($result);   //to fix datatable entry count display

        if(mysqli_num_rows($result)>0){

            while($row=mysqli_fetch_assoc($result)){

                $tmp=array(
                    //.php  name='' side sql column name        //sql side
                    'ord_id'=>$row['ORDER_ID'], 
                    'ord_code'=>$row['ORDER_CODE'], 
                    'ord_type'=>$row['ORDER_TYPE'],
                    'pro_code'=>$row['PRO_CODE'],
                   

                  
                    'pro_name'=>$row['PRODUCT_NAME'],     
                    'item_qty'=>$row['QTY'],
                    'ord_detail_status'=>$row['ORD_DETAIL_STATUS'],
                    'mac_reserved_from'=>$row['RESERVED_FROM'],
                    'mac_reserved_to'=>$row['RESERVED_TO'],
                
                    'ord_detail_id'=>$row['ORDER_DETAIL_ID']  //for option column

                   

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
