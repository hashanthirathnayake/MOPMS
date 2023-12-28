<?php
    require_once('incl/header.php');
   
?>
<style>
    /* <!--  to resolve  jquery validation css error  --> */
    form .error {
        color: #ff0000;
        font-size: 1rem;
    }

</style>

 <!-- <script src='select2.min.js' type='text/javascript'></script>      for select 2 drop down search -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!--breadcrumbs-->

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="admin_dash.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Order </li>
        </ol>
    </nav>




    <div class="row">
        <div class="col-md-12" id="form">
            <div class="card">
                <h5 class="card-header">Order Information</h5>
                <div class="card-body">
                    <h4 class="mb-2 text-gray-800" style="font-weight:200;"><i class="fas fa-tasks"></i> &nbsp; Add Primary Information</h4>
                    <br>

                    <form action="#" id="formGeneral">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-md-4 col-form-label">Customer Name<span class="text-danger">*</span></label>

                                    <div class="col-md-8">
                                        <select class="form-control" id="orderCusName" name="orderCusName" onclick="getcustomerlist()">
                                            <option value="">Please select</option>
                                        </select>
                                        <br>

                                        <div class="text-right">
                                            <button id="add_customer" onclick="addCustomer(); return false;" class="btn btn-primary btn-sm"><b><i class="fas fa-plus"></i> Add Customer</b></button>
                                            &nbsp;
                                            <button onclick="getcustomerlist(); return false;" class="btn btn-success btn-sm"><b><i class="fa fa-refresh"></i> Refresh List</b></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Order Placed Date<span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <input readonly type="date" class="form-control" name="orderPlaceDate" id="orderPlaceDate" placeholder="">
                                    </div>
                                </div>

                                <br>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Order Request Date<span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <input type="date" class="form-control" name="orderDeliveryDate" id="orderDeliveryDate" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Order Delivery Adddress<span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <textarea class="form-control" name="orderDeliveryAddress" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <hr>

                    <h4 class="mb-2 text-gray-800" style="font-weight:200;"><i class="fas fa-shopping-cart"></i> &nbsp; Add Product Information</h4>
                    <br>

                    <form action="#" id="formProduct">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Product Name<span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <select name="orderProductName" id="orderProductName" class="form-control" onclick="getproductlist()">
                                            <option value="">Please select</option>
                                        </select>
                                        <br>

                                        <div class="text-right">
                                            <button id="addp" onclick="addproduct(); return false;" class="btn btn-primary btn-sm">
                                                <b><i class="fas fa-plus"></i> Add Product</b>
                                            </button>
                                            <button onclick="getproductlist(); return false;" class="btn btn-success btn-sm">
                                                <b><i class="fa fa-refresh"></i> Refresh List</b>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Unit Price (Rs.)</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" readonly name="orderProductUnitPrice" id="orderProductUnitPrice" placeholder="">
                                    </div>
                                </div>
                                <br>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Product Stock</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" readonly name="orderProductStock" id="orderProductStock" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Order Quantity<span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="orderProductQty" id="orderProductQty" placeholder="">
                                    </div>
                                </div>
                                <br>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Description</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" readonly name="orderProductDes" id="orderProductDes" placeholder="">
                                    </div>
                                </div>
                                <br>

                                <div class="form-group row">
                                    <label for="example-text-input" class="col-md-4 col-form-label">Order type<span class="text-danger">*</span></label>
                                    <div class="col-md-8">
                                        <select class="form-control" id="orderType2" name="orderType2">
                                            <option value="Normal">Normal</option>
                                            <option value="Customize">Customize</option>
                                            <option value="Domestic">Domestic</option>
                                            <option value="Balance Request">Balance Request</option>
                                        </select>
                                    </div>
                                </div>
                                <br>

                                <div class="text-right">
                                    <button type="button" id="btnAddToList" name="btnAddToList" class="btn btn-success">
                                        <i class="fa fa-check"></i> Add To List
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <br>

                    <h4 class="mb-2 text-gray-800" style="font-weight:200;"><i class="fas fa-check"></i> &nbsp; Order Description</h4>
                    <br>

                    <table class="table" id="orderPlaceTbl">
                        <thead class="thead-light text-dark">


                            <!-- <th scope="col"># </th> -->
                            <th scope="col" data-override="product_name">Product Name</th>
                            <th scope="col" data-override="product_id_name" class="">Product id </th> <!-- product id  name  -->
                            <!-- class="hide"  -->
                            <th scope="col">Description</th>

                            <th scope="col" data-override="orderType">Order Type</th>
                            <th scope="col" data-override="unit_price"> Unit Price</th>
                            <!-- <th scope="col">Stock qty</th>    no need-->

                            <!-- correct one for order_qty -->
                            <!-- <th scope="col" data-override="order_qty">Order Item Qty</th> -->
                            <th scope="col" data-override="order_qty">Order Item Qty</th>
                            <th scope="col" data-override="sub_total">Sub Total</th>
                            <!-- <td id="lblTotal" style="text-align:center" >0</td> -->
                            <th scope="col">Action</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div> <!-- end of card body -->
            </div> <!-- end of card  -->

        </div> <!-- end of col-md-12  -->
    </div> <!-- end of raw  -->








</div> <!-- now // -->


<!--  for total -->
<div class="col-md-5" style="float: right">

    <form id="frmTotal">
        <div class="card mt-3">


            <div class="card-body p-3 pt-0">

                <table class="table" id="orderPlaceCalculationTbl">
                    <thead class="thead-light text-dark">
                        <tr>
                            <th scope="col">Total (Rs.) </th>
                            <td class=" text-white text-right" id="">
                                <input type="text" class="form-control" readonly name="orderTotal" id="orderTotal">
                            </td>
                            <!-- <td class="bg-dark text-white text-right" id="counter"><b></b></td> -->
                        </tr>

                        <tr>
                            <th scope="col">Discount(%)</th>
                            <td class=" text-white text-right" id="">
                                <input type="text" class="form-control" name="orderDiscount" id="orderDiscount" placeholder="">
                            </td>
                        </tr>

                        <tr>
                            <th scope="col">Trade Discount(%)</th>
                            <td class=" text-white text-right" id="">
                                <input type="text" class="form-control" name="tradeDiscount" id="tradeDiscount" placeholder="">
                            </td>
                        </tr>


                        <tr>
                            <th scope="col">VAT</th>
                            <td class=" text-white text-right" id="">
                                <input type="text" class="form-control" name="orderVAT" id="orderVAT" placeholder="">
                            </td>
                        </tr>




                        <tr>
                            <th scope="col">Net Total(Rs.)</th>
                            <td class="text-white text-right" id="">
                                <input type="text" class="form-control" readonly name="orderNetTotal" id="orderNetTotal" placeholder="">
                            </td>
                        </tr>



                    </thead>





                </table>

            </div><!-- end of card body  -->




        </div> <!-- end of card mt 3 -->
        <!-- </div> -->

        <div class="card-body" id="">
            <!-- for the  cancel, save buttons -->

            <div class="row">


                <div class="col-md-12">
                    <div class="form-group text-right">
                        <button type="button" id="" name="" class="btn btn-secondary">Cancel </button>
                        <!-- <a  href="payment.php">  <button type="button"   onclick="saveOrder()" id="btnSaveOrder" name="btnSaveOrder" class="btn btn-success" >Save Order </button></a>   for button act as link   -->
                        <button type="button" id="btnSaveOrder" name="btnSaveOrder" class="btn btn-success">Save Order </button> <!-- for button act as link    , onclick="saveOrder()"         -->

                    </div>
                </div>
                <div class="col-md-1">

                </div>
            </div>
        </div>

    </form>
</div> <!-- end of container fluid  -->








<script>
    // <script type="text/javascript">


    $(document).ready(function() {
        getcustomerlist();
        getproductlist();
    });

    function getproductlist() {
        //ajax request

        $.ajax({
            url: "handlers/order-aa_handler.php?type=getProductName",
            method: "GET",
            success: function(data) {
                data = JSON.parse(data);
                // console.log(data);
                data.forEach(row => {
                    $("#orderProductName").append("<option value='" + row.pro_code + "'>" + row.pro_name + "</option>");
                });
                
                $("#orderProductName").select2();
            }
        });
    }




    function getcustomerlist() {


        // $(document).ready(function () {

        $.ajax({
            url: "handlers/order-aa_handler.php?type=getCustomerName",
            method: "GET",
            success: function(data) {
                data = JSON.parse(data);
                data.forEach(row => { //db column name
                    $("#orderCusName").append("<option value='" + row.cus_id + "'>" + row.cus_fname + " " + row.cus_lname + "</option>");

                    $("#orderCusName").select2(); 
                    //text box id
                });
            }
        });

        // });

    }


    function addproduct() {
        var addproducturl = "http://localhost/mopms/product2-customize.php";  //url for navigation page
        window.open(addproducturl, "_blank");  //open in another tab
    }

    function addCustomer() {

        var addCustomerUrl = "http://localhost/mopms/individual.php";
        window.open(addCustomerUrl, "_blank");

    }

    var total = 0;

    $("#orderProductName").change(function() {
        var s = $(this).val();

        loadProductDetailsById(s);
    });

    function loadProductDetailsById(productId) {
        $.ajax({
            url: "handlers/order-aa_handler.php?type=loadProductDetails",
            method: "POST",
            data: {
                id: productId
            },
            success: function(data) {
                data = JSON.parse(data)[0];
                //txt box id                db colmn name
                $("#orderProductDes").val(data.pro_des);
                $("#orderProductUnitPrice").val(data.pro_unit_price);
                
                console.log("aaa");
                if (typeof data.pro_stock === "undefined" || data.pro_stock == null || data.pro_stock == '') {
                    data.pro_stock = 0;
                }
                
                $("#orderProductStock").val(data.pro_stock);

                // $("#txtStock").val(data.product_stock);
            }
        });
    }

    //txt id
    $("#txtQty").change(function() {
        var price = Number($("#orderProductUnitPrice").val());
        var qty = Number($(this).val());
        if (price != "" && qty != "") {
            var subTotal = price * qty;
            // var total = price * qty;

            $("#lblSubTotal").html(subTotal); //??whta to take  tota coulmn
        }

    });


    var count = 0

    // for add to list buton
    $("#btnAddToList").click(function() {

        if ($("#formProduct").valid()) {

            //
            // LHS can give any name               .val() uses for 
            // var productId= $("#cmbProduct").val();

            // var productName= $("#orderProductName option:selected").find(':selected').text();
            var productName = $("#orderProductName").find(':selected').text();
            var productNameId = $("#orderProductName").val();
            // alert(productNameId);
            var description = $("#orderProductDes").val();

            //for order type
            //orderType  id,name of text box
            // var orderTYPE= $("#orderType option:selected").val();
            var orderType = $("#orderType2").find(':selected').val();
            console.log(orderType);

            var price = $("#orderProductUnitPrice").val();
            
            if(orderType == "Domestic") {
                price = 0;
            }
            
            // var stock= $("#orderProductStock").val();  no need
            var qty = $("#orderProductQty").val();

            // var total= $("#lblTotal").html();
            // var total= price * qty;
            var sub_total = price * qty;

            var total = Number($("#orderTotal").val());
            // subTotal = Number(subTotal) + Number(total);
            total = Number(total) + Number(sub_total);

            //tbl id
            count++

            var id = "row" + count;
            // $("#orderPlaceTbl").append("<tr><td style='text-align:center;'>"+productName.text()+"</td><td style='text-align:center;'>"+stock+"</td><td style='text-align:center;'>"+qty+"</td><td style='text-align:center;'>"+price+"</td><td style='text-align:center;'>"+total+"</td></tr>")
            $("#orderPlaceTbl").append("<tr id=" + id + "><td>" + productName + "</td><td class=''>" +
                productNameId + "</td><td>" + description + "</td><td>" + orderType + "</td><td>" + price +
                "</td><td>" + qty + "</td><td>" + sub_total +
                "</td><td><button class='btn-dtable-edit' onclick='editbtnfunc(" + id +
                ")'><i class='fa fa-edit'></i></button><button class='btn-dtable-delete'  onclick='deletebtnfunc(" +
                id + ")'><i class='fa fa-trash-o'></i></button></td></tr>");
            // "<tr><td>" + catalog_val.item_name + "</td><td>" + catalog_val.variation +       //hide                                                                   //<td>"+stock+"</td>  - removed                 
            //         class='tablebtn'           <td><button onclick='editbtnfunc("+id+")'><i class='fa fa-edit'></i></button>



            $("#txtQty").val("");
            $("#lblSubTotal").html("0");

            $("#orderTotal").val(total);

            $("#orderProductName").val("");
            $("#orderProductDes").val("");

            $("#orderType").val("");
            $("#orderProductUnitPrice").val("");
            $("#orderProductStock").val("");
            $("#orderProductQty").val("");

        }

        // $('#frmOrder')[0].reset();

    });

    function editbtnfunc(id) {
        var total = Number($("#orderTotal").val());
        var subTotal = $(id).find("td:eq(6)").text();

        total = Number(total) - Number(subTotal);
        console.log(total);
        $("#orderTotal").val(total);

        var productId = $(id).find("td:eq(1)").text();

        loadProductDetailsById(productId);

        var orderQuantity = $(id).find("td:eq(5)").text();
        var orderType = $(id).find("td:eq(3)").text();

        $('#orderProductName').val(productId);
        $('#orderType2').val(orderType);
        $('#orderProductQty').val(orderQuantity);

        $(id).remove();

    }

    function deletebtnfunc(id) {
        // alert("delete");


        // in editing
        var tot = $(id).find("td:eq(6)").text();
        // alert(sub_tot);
        total = Number(total) - Number(tot);
        $("#orderTotal").val(total);


        $(id).remove();
    }

    $("#orderDiscount").keyup(function() {


        var total = Number($("#orderTotal").val());
        var discount = Number($(this).val());


        var tradeDiscountTotal = Number(total) - (Number(total) * Number(discount / 100));
        $("#tradeDiscount").val(tradeDiscountTotal);
    });



    $("#orderVAT").keyup(function() {

        var total = Number($("#orderTotal").val());
        var vat = Number($("#orderVAT").val());
        var tradeDiscountTotal = Number($("#tradeDiscount").val());
        var vatVal = Number(tradeDiscountTotal) * Number(Number(vat) / 100);


        if (vat != "") {
            var netTotal = Number(tradeDiscountTotal) + Number(vatVal)
        } else {
            var netTotal = Number(tradeDiscountTotal);
        }
        $("#orderNetTotal").val(netTotal);
    });








    // function saveOrder() 

    $("#btnSaveOrder").click(function() {
        var generalValid = $("#formGeneral").valid();
        var priceValid = $("#frmTotal").valid();

        if (!(generalValid && priceValid)) {
            alert("Please fill out the required fields.");
            return;
        }

        //general information
        f = new FormData($("#formGeneral")[0]);

        //product information
        var table = $('#orderPlaceTbl').tableToJSON({
            ignoreColumns: [7]
        });
        f.append('table', JSON.stringify(table));

        //price table
        var orderTotal = $("#orderTotal").val();
        var orderVAT = $("#orderVAT").val();
        var orderDiscount = $("#orderDiscount").val();
        var tradeDiscount = $("#tradeDiscount").val();
        var orderNetTotal = $("#orderNetTotal").val();

        f.append('orderTotal', orderTotal);
        f.append('orderVAT', orderVAT);
        f.append('orderDiscount', orderDiscount);
        f.append('tradeDiscount', tradeDiscount);
        f.append('orderNetTotal', orderNetTotal);

        //console.log(JSON.stringify(f));

        $.ajax({
                method: "POST",
                url: "handlers/order-aa_handler.php?type=addOrder",
                data: f,
                contentType: false,
                processData: false,

            })
            .done(function(data) {
                // window.location.reload();
                swal({
                    title: "Success",
                    icon: "success",

                    text: "Order Placed Successfully!",
                });

                if (data != 'error') {
                   

                    // alert('payment.php?id='.data)?


                }
                // $("#formProduct").trigger("reset");  //to clear the form fields
                // $("#formGeneral").trigger("reset"); 
                // $("#orderPlaceCalculationTbl").trigger("reset");  

                location.replace('http://localhost/mopms/production-1-test-33.php');
                    

            });
    });

    $(document).ready(function() {
        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today = now.getFullYear() + "-" + (month) + "-" + (day);

        $('#orderDeliveryDate').prop("min", today);

        $("#formGeneral").validate({
            rules: {
                orderCusName: {
                    required: true,

                },
                orderPlaceDate: {
                    required: true,

                },
                orderDeliveryDate: {
                    required: true,

                },
                orderDeliveryAddress: {
                    required: true,

                }

            }
        });

        $("#formProduct").validate({
            rules: {
                orderProductName: {
                    required: true,

                },
                orderProductQty: {
                    required: true,

                },
                orderType2: {
                    required: true,

                }
            }
        });

        $("#frmTotal").validate({
            rules: {
                orderDiscount: {
                    required: true,

                },
                tradeDiscount: {
                    required: true,

                },
                orderVAT: {
                    required: true,

                }
            }
        });

        $('#orderPlaceDate').val(today);
    });




</script>










<?php require_once('incl/footer.php'); ?>
