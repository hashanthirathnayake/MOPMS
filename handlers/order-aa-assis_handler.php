<?php
   
require_once('../incl/dbconnection.php');

$type = $_GET["type"];

switch($type) {
    case "getCustomerName":
        $sql = "SELECT * from customer";
        $result = mysqli_query($con,$sql);
        
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode($data);
        break;

    case "getProductName":
        $sql = "SELECT p.*, s.available_qty as pro_stock from product3 p 
                left join stock3 s on s.pro_code = p.pro_code";
        $result = mysqli_query($con,$sql);
        
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        
        echo json_encode($data);
        break;

    case "loadProductDetails":
        $id = $_POST["id"];
        //$sql = "SELECT * from product3 WHERE pro_code='$id'";
        $sql = "SELECT p.*, s.available_qty as pro_stock from product3 p 
                left join stock3 s on s.pro_code = p.pro_code 
                where 
                p.pro_code='$id'";
        
        $result = mysqli_query($con,$sql);
        
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode($data);
        break;

    case "addOrder":
        $orderNo = time();  
        $orderCusName = $_POST['orderCusName'];
        $orderPlaceDate = $_POST['orderPlaceDate'];
        $orderDeliveryDate = $_POST['orderDeliveryDate'];
        $orderDeliveryAddress = $_POST['orderDeliveryAddress'];

        $orderTotal = $_POST['orderTotal'];
        $orderDiscount = $_POST['orderDiscount'];
        $tradeDiscount = $_POST['tradeDiscount'];
        $orderVAT = $_POST['orderVAT'];
        $orderNetTotal = $_POST['orderNetTotal'];
       
        $has_errors = FALSE;
        $error_messages = array();
        
                    // form txt box name
        if($orderCusName == '' || $orderCusName == NULL){
            $has_errors = TRUE;
            array_push($error_messages,'name is required');
        }

        if($orderPlaceDate == '' || $orderPlaceDate == NULL){
            $has_errors = TRUE;
            array_push($error_messages,'place date is required');
        }
        
        if($has_errors == TRUE) {
            echo json_encode($error_messages);
            
        } else {
            $orderNo = time().rand(1,1000);
                                                //ord_id
            $sql = "INSERT INTO tbl_orders3 (ord_id, cus_id, ord_place_date,ord_deli_date, ord_total, ord_vat,ord_discount,ord_net_total,ord_deli_address,ord_status) 
            VALUES ('$orderNo', '$orderCusName', '$orderPlaceDate', '$orderDeliveryDate', $orderTotal, $orderVAT, $orderDiscount, $orderNetTotal, '$orderDeliveryAddress', 'pending')";
            
            $result = mysqli_query($con, $sql);


            // echo $sql;
            if($result) {
                // echo "success";
                
                $res =true;
                foreach (json_decode( $_POST['table']) as $table) {

                    // time().rand(1,1000)
                    $order_item_pk = time().rand(1,1000);
                    $product_name = $table->product_name;
                    // $product_id_name = $table->product_id_name;

                    $pro_code = $table->product_id_name;
                    $Description = $table->Description;
                    $orderTYPE = $table->orderType;
                    
                    $ordDetailStatus = 'pending';
                    
                    if($orderTYPE == 'Normal') {
                        $ordDetailStatus = 'completed';
                    }

                    $unit_price = $table->unit_price;
                    $order_qty = $table->order_qty;
                    $sub_total2 = $table->sub_total;


                    if(isset($sub_total2)) {
                        echo "value set";
                        
                    } else {
                        echo "not set";
                    }

                    $wasteAmount = "SELECT pro_wastage from product3 where pro_code='$pro_code'";
                    $result = mysqli_query($con,$wasteAmount);  
            
                    $row = mysqli_fetch_assoc($result);
            
                    $temp = ($order_qty * $row['pro_wastage'])/100;
            
            
                    $itemQtyWithWaste = $order_qty + $temp;
            
                    $itemQtyWithWasteRound= round($itemQtyWithWaste);

                    $sql2 = "INSERT INTO order_detail3 (ord_detail_id,ord_id, pro_code, item_subtotal, item_qty, ord_type,ord_detail_status) 
                    VALUES ( '$order_item_pk','$orderNo', '$pro_code', '$sub_total2', '$itemQtyWithWasteRound', '$orderTYPE','$ordDetailStatus')";
                                
                    echo $sql2;
                                                                                              
                    $result1 = mysqli_query($con,$sql2) or die ("Error!-" .mysqli_error($con));
                    
                    if ($orderTYPE == "Normal") {
                        $sql3 = "select * from stock3 where pro_code = '$pro_code' limit 1";
                        $result=mysqli_query($con,$sql3);

                        //update stock
                        if(mysqli_num_rows($result)>0) {
                            $stockRow=mysqli_fetch_assoc($result);
                            
                            $stockId = $stockRow['stock_id'];
                            $availableQty = $stockRow['available_qty'];
                            $actualQty = $stockRow['actual_qty'];

                            // SELECT MONTHNAME(ord_place_date) AS 'Month',SUM(ord_net_total) AS 'TotalIncome' FROM tbl_orders3  GROUP BY YEAR(ord_place_date)
                            
                            $sql4 = "update stock3 set available_qty = '$availableQty' where stock_id = '$stockId'";

                            $result=mysqli_query($con,$sql4);

                            if($result) {
                                echo "Stock updated";

                            } else {
                                echo "Stock update failed";
                            }
                        }
                    }
                    
                    sleep(2);

                    // echo $sql2;

                }//end of for each 
            }//end of result
        }
    }
?>
