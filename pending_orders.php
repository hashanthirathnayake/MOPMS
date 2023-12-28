<?php
    require_once('incl/header.php');
    require_once('incl/dbconnection.php');
?>

<style>
    /* <!--  to resolve  jquery validation css error  --> */
    form .error {
        color: #ff0000;
        font-size: 1rem;
    }

</style>




<!-- Begin Page Content -->
<div class="container-fluid">

    <!--breadcrumbs-->

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="admin_dash.php">Home</a></li>
            <li class="breadcrumb-item"><a href="admin_dash.php">Production</a></li>
            <li class="breadcrumb-item active" aria-current="page"></li>
        </ol>
    </nav>

    <!-- <h1 class="h3 mb-2 text-gray-800">User Configuration</h1> -->





    <div class="card mt-3">
        <div class="card-header bg-light">
            <h5>Pending Order List</h5>
        </div>

        <div class="card-body p-3 pt-0">
            <div class="table-responsive">
                <table class="table" id="productionTbl">
                    <thead class="thead-light text-dark">
                        <tr>
                            <th style="width: 150px;">Order id</th>
                            <th>Customer</th>
                            <th>City</th>
                            <th>Placed on</th>
                            <th>Delivery required on</th>
                            <th>Net Total</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        <?php
                            $sql="SELECT lpad(tor.`ord_code`, 6, 0) as ORD_CODE, tor.*, cus.cus_fname as first_name, cus.cus_lname as last_name, cus.cus_city as city FROM tbl_orders3 tor 
                                    left join customer cus on cus.cus_id = tor.cus_id
                                    where 
                                    tor.ord_status='pending' order by tor.ord_deli_date asc";
                            $result = mysqli_query($con,$sql);

                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                    $orderId = $row['ord_id'];
                                    $fn = $row['first_name'];
                                    $dm = false; 
                                    
                                    if($fn == "Domestic") {
                                        $dm = true;
                                    }

                                    echo "<tr>
                                            <td>".$order_prefix.$row['ORD_CODE']."</td>
                                            <td>".$row['first_name']." ".$row['last_name']."</td>
                                            <td>".$row['city']."</td>
                                            <td>".$row['ord_place_date']."</td>
                                            <td>".$row['ord_deli_date']."</td>
                                            <td>".$row['ord_net_total']."</td>
                                            </tr>";

                                    $sql2 = "SELECT od.*, p.pro_name as product_name FROM order_detail3 od 
                                                left join product3 p on p.pro_code = od.pro_code 
                                                where 
                                                od.ord_id = '$orderId' order by od.pro_code";

                                    $result2 = mysqli_query($con,$sql2);

                                    if(mysqli_num_rows($result2) > 0){
                                        $btnView = true;
                                        
                                        while($row2 = mysqli_fetch_assoc($result2)){
                                            $ordDetailStatus = $row2['ord_detail_status'];
                                            $statusColor = '#BC8F8F';   // # 000000
                                            
                                            if ($ordDetailStatus == 'pending') {
                                                $statusColor = '#00CED1';
                                            
                                            } else if ($ordDetailStatus == 'production started') {
                                                $statusColor = '#ffad33';
                                            } else if ($ordDetailStatus == 'completed') {
                                                $statusColor = '#2eb82e';
                                            }
                                            
                                            if($ordDetailStatus != 'completed') {
                                                $btnView = false;
                                            }
                                            
                                            echo '<tr>
                                                    <td style="width: 150px; background-color:#e3e6f0; padding-top:0; padding-bottom:0;"></td>
                                                    <td style="background-color:#e3e6f0; padding-top:0; padding-bottom:0;"><small><b>Detail Id</b></small></td>
                                                    <td style="background-color:#e3e6f0; padding-top:0; padding-bottom:0;"><small><b>Product</b></small></td>
                                                    <td style="background-color:#e3e6f0; padding-top:0; padding-bottom:0;"><small><b>Qty</b></small></td>
                                                    <td style="background-color:#e3e6f0; padding-top:0; padding-bottom:0;"><small><b>Type</b></small></td>
                                                    <td style="background-color:#e3e6f0; padding-top:0; padding-bottom:0;"><small><b>Production Status</b></small></td>
                                                </tr>';

                                            echo "<tr>
                                                    <td style='background-color:#e3e6f0; padding-top:2px; padding-bottom:2px;'></td>
                                                    <td style='padding-top:2px; padding-bottom:2px;'><small>".$row2['ord_detail_id']."</small></td>
                                                    <td style='padding-top:2px; padding-bottom:2px;'><small>".$row2['product_name']."</small></td>
                                                    <td style='padding-top:2px; padding-bottom:2px;'><small>".$row2['item_qty']."</small></td>
                                                    <td style='padding-top:2px; padding-bottom:2px;'><small>".$row2['ord_type']."</small></td>
                                                    <td style='color:#fff; background-color:".$statusColor."; padding-top:2px; padding-bottom:2px;'><small>".$row2['ord_detail_status']."</small></td>
                                                  </tr>";
                                        }
                                        
                                        echo "<tr>
                                                <td class='grad' style='padding-top:10px; padding-bottom:10px; text-align:right;' colspan='100%'>
                                                    <a href='http://localhost/mopms/assignDelivery.php?order_id=".$row['ord_id']."' class='btn btn-sm btn-success ".(($dm || !$btnView) ? "d-none" : "")."'>  
                                                        <i class='fa fa-truck'></i> &nbsp; Deliver  
                                                    </a>
                                                </td>
                                              </tr>";

                                    } else {
                                        echo "<tr><td colspan='100%' style='text-align:left; color: red;'><b>No items found.</b></td></tr>";
                                    }
                                }

                            } else {
                                echo '<tr>
                                        <td style="width: 150px; background-color:#e3e6f0; padding-top:0; padding-bottom:0;"></td>
                                        <td colspan="100%" style="text-align:center; color: red;"><b><small>No orders found.</small></b></td>
                                    </tr>';
                            }
                        ?>
                    </tbody>
                </table>
                
            </div>

        </div>
    </div>






</div> <!-- end of container-fluid  -->




<script>
                                   //ord_id             
function  assignDelivery(ord_id){

// var configMacUrl = "http://localhost/mopms/configure-machine-machineScheduling.php?ord_detail_id="+ord_detail_id;
//    window.open(configMacUrl,"_blank");
   var location = "http://localhost/mopms/assignDelivery.php?ord_id="+ord_id;
   window.location.replace(location);
//    window.open(configMacUrl,"_blank");
}



</script>



<?php require_once('incl/footer.php'); ?>
