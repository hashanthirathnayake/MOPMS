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
            $sql = "SELECT * from product";
            $result = mysqli_query($con,$sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            echo json_encode($data);

        break;


        case "loadProductDetails":
            $id = $_POST["id"];
            $sql = "SELECT * from product WHERE pro_code='$id'";
            $result = mysqli_query($con,$sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            echo json_encode($data);

        break;

        case "addOrder":
        
            $orderNo = $_POST['orderNo'];  
            $orderCusName = $_POST['orderCusName'];    
            // $orderNo = $_POST['orderNo'];
            $orderPlaceDate = $_POST['orderPlaceDate'];
          
            $orderDeliveryDate = $_POST['orderDeliveryDate'];
            $orderDeliveryAddress = $_POST['orderDeliveryAddress'];


            $orderType = $_POST['orderType'];
            $orderProductName = $_POST['orderProductName'];
          
            $orderProductDes = $_POST['orderProductDes'];
            $orderProductUnitPrice = $_POST['orderProductUnitPrice'];
            $orderProductQty = $_POST['orderProductQty'];

            //          
            // <th scope="col" data-override="sub_total">Sub Total</th>
            // $sub_total = $_POST['sub_total'];
         
          
            $orderTotal = $_POST['orderTotal'];
            $orderDiscount = $_POST['orderDiscount'];
            // $tradeDiscount = $_POST['tradeDiscount'];

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
        
     
              
    
        if($has_errors == TRUE)
        {
            echo json_encode($error_messages);
        }
        
        else{     
                                    
                        // echo "id null";
                     
                        // $sql = "INSERT INTO tbl_order ( ord_place_date,ord_deli_date,ord_type, ord_qty,ord_total, ord_vat,ord_discount,ord_net_total) 
                        // VALUES ('$orderPlaceDate','$orderDeliveryDate','$orderType','$orderProductQty','$orderTotal','$orderVAT','$orderDiscount','$orderNetTotal')";

                $sql = "INSERT INTO tbl_orders (cus_id, ord_place_date,ord_deli_date,ord_type, ord_total, ord_vat,ord_discount,ord_net_total,ord_deli_address) 
                VALUES ('$orderCusName','$orderPlaceDate','$orderDeliveryDate','$orderType','$orderTotal','$orderVAT','$orderDiscount','$orderNetTotal','$orderDeliveryAddress')";

                        $result = mysqli_query($con,$sql);
                        // or

                        $last_id = $con->insert_id;
                
                      
                      
                    //   echo  json_encode( $_POST['table']);

                        if($result) {
                            // echo "success";
                           $res =true;
                            foreach (json_decode( $_POST['table']) as $table){

                                $product_name = $table->product_name;
                                // $product_id_name = $table->product_id_name;

                                $pro_code = $table->product_id_name;
                                $Description = $table->Description;
                                // $unit_price = $table->unit_price;

                                $unit_price = $table->unit_price;
                                $order_qty = $table->order_qty;
                                $sub_total = $table->sub_total;

                               

                                
                                // $sql2 = "INSERT INTO order_detail (ord_id,pro_code,pro_code, item_qty,item_subtotal) 
                                // VALUES ('$last_id','$orderProductName','$unit_price','$orderProductDes','$orderProductQty','$sub_total')";

                                      $sql2 = "INSERT INTO order_detail (ord_id,pro_code, item_qty,item_subtotal) 
                                 VALUES ('$last_id','$pro_code','$order_qty','$sub_total')";
                                                 //product_id_name



                                $result1 = mysqli_query($con,$sql2) or die ("Error!-" .mysqli_error($con));

                                if($result1){

                                    $pro_qty = "SELECT pro_wastage from product where pro_code='$pro_code'";
                                    $result = mysqli_query($con,$pro_qty);  

                                    $row = mysqli_fetch_assoc($result);

                                    $temp = ($order_qty * $row['pro_wastage'])/100;


                                    $wastage = $order_qty + $temp;

                                    $wastageRound= round($wastage);


                                //     $est_date = $order_qty /$mac_max_qty_per_day;
                                // $mac_max_qty_per_day="SELECT mac_max_qty_per_day FROM machine_config "; 
                                 

                                   //, product.pro_code 

                                $mac_max_qty_per_day = "SELECT machine_config.mac_max_qty_per_day FROM machine_config INNER JOIN product ON 
                                machine_config.mac_config_id=product.mac_config_id WHERE pro_code='$pro_code' " ;
                                
                                $result = mysqli_query($con,$mac_max_qty_per_day);  
                               
                                 
                                $row = mysqli_fetch_assoc($result);
                                // echo $row['mac_max_qty_per_day'];  
                                $estDays = (int)$order_qty /$row['mac_max_qty_per_day'];   

                                $estDaysRound=round($estDays);

                        //    $mac_max_qty_per_day = 3200;
                                

                                // echo($order_qty);
                                // echo($mac_max_qty_per_day);

                                // $estDays = $order_qty /$mac_max_qty_per_day;
                                

                                //                                     //ord id  Fk karenne natiwa
                                //     // $sql3 = "INSERT INTO production (ord_id,production_type,item_code,item_name,production_qty) 
                                //     // VALUES ('$last_id','prod_order','$product_id_name','$orderProductDes','$orderProductQty')";
                                    $sql3 = "INSERT INTO production (ord_id,production_type,production_item_code,production_qty,prod_estimate_days) 
                                    VALUES ('$last_id','prod_order','$pro_code','$wastageRound','$estDaysRound')";
                                  
                                  echo $sql3;
                                $result2 = mysqli_query($con,$sql3) or die ("Error!-" .mysqli_error($con));  
                                
                                if($result2){
                                    $res= $result2;
                                }

                                }
                                // echo $sql2; 
                                //     if($result1){
                                //         echo $last_id;
                                        // echo "success";
                                    // }
                            }
                          
                            if($res){
                                echo $last_id;
                            }
                         

                        } 
                        else {
                            echo "error";
                        }
               // }
                   
              

        }

        break;
       

}

?>


