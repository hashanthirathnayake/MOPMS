<?php
    require_once('incl/header.php');
    // require_once('incl/dbconnection.php');
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
            <li class="breadcrumb-item"><a href="production-1-test-33.php">Pending Machine Scheduling List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Schedule Machine</li>
        </ol>
    </nav>

    <!-- <h1 class="h3 mb-2 text-gray-800">User Configuration</h1> -->






    <!-- data table -->
    <div class="card mt-3">
        <div class="card-header bg-light">
            <h5>Resource Detail </h5>
        </div>

        <div class="card-body p-3 pt-0">

            <div class="row">
                <div class="col-md-6">
                   
                    <form action="#" id="empFrm">
                        <fieldset>

                            <!-- <div class="form-group row mb-0">
                                    <div class="ml-lg-auto text-right">
                                      <button type="submit"  id="cancelK9" class="btn btn-light">Cancel</button>
                                      <button type="button" onclick="submitData()" id="saveK9" class="btn btn-primary">Save <i class="fas fa-paw ml-2"></i></button>
                                    </div>
                                  </div>	
                                                                                      
                                                    -->
                            <input type="hidden" id="productCode" name="productCode">
                           


                            <h6 class="h3 mb-2 text-gray-800">Order Information</h6>
                            <input id="hdInptProCode" name="hdInptProCode" type="hidden" />

                            <div class="form-group row">
                                <label for="example-text-input" class="col-4 col-form-label"> Order id</label>
                                <div class="col-8">
                                    <input class="form-control" type="text" name="orderId" id="orderId" readonly />
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="example-text-input" class="col-4 col-form-label">order type</label>
                                <div class="col-8">
                                    <input class="form-control" type="text" name="orderType" id="orderType" readonly />
                                </div>
                            </div>






                            <div class="form-group row">
                                <label for="example-text-input" class="col-4 col-form-label">pro name</label>

                                <div class="col-8">
                                    <input type="text" name="productName" id="productName" class="form-control" readonly />
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="example-text-input" class="col-4 col-form-label">Quantity</label>

                                <div class="col-8">
                                    <input type="text" name="itemQty" id="itemQty" class="form-control" readonly />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-4 col-form-label">Order Place date</label>

                                <div class="col-8">
                                    <input type="text" name="placeDate" id="placeDate" class="form-control" readonly />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-text-input" class="col-4 col-form-label">Customer req date</label>

                                <div class="col-8">
                                    <input type="text" name="cusReqDate" id="cusReqDate" class="form-control" readonly />
                                </div>
                            </div>






                            <div class="form-group row mb-0">
                                <div class="ml-lg-auto text-right">
                                   

                                </div>
                            </div>
                            <fieldset>
                    </form>

                </div>


                <div class="col-md-6">

                    <form>

                        <fieldset>

                            <h6 class="h3 mb-2 text-gray-800">Product Information</h6>

                            <div class="form-group row">
                                <label for="example-text-input" class="col-4 col-form-label"> Descrption</label>

                                <div class="col-8">
                                    <input type="text" name="des" id="des" class="form-control" readonly />
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="example-text-input" class="col-4 col-form-label">Wastage</label>

                                <div class="col-8">
                                    <input type="text" name="wastage" id="wastage" class="form-control" readonly />
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="example-text-input" class="col-4 col-form-label">Unit price</label>

                                <div class="col-8">
                                    <input type="text" name="unitPrice" id="unitPrice" class="form-control" readonly />
                                </div>
                        </fieldset>
                    </form>
                </div>


            </div>


        </div>


    </div>




    <div class="row">
        <div class="col-md-12" id="">
            <div class="card">
                <!-- <h5 class="card-header">Order</h5> -->
                <div class="card-body">
                   

                    <form>





                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">select Machine</label>

                            <div class="col-10">
                                <select class="form-control" id="selectMachine" name="selectMachine">
                                    <option value="">Please select</option>

                                </select>
                            </div>

                        </div>
                     

                    </form>




                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="h3 mb-2 text-gray-800">Machine Information</h6>
                            <form action="#" id="">



                                <fieldset>


                                    <input class="form-control" type="hidden" name="macScheduleId" id="macScheduleId">




                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-4 col-form-label">Machine Min Quantity</label>
                                        <div class="col-8">
                                            <input type="text" name="macMinQty" id="macMinQty" class="form-control" readonly />
                                        </div>
                                    </div>






                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-4 col-form-label">No of Days</label>
                                        <div class="col-8">
                                            <input type="text" name="noOfDays" id="noOfDays" class="form-control" readonly />
                                        </div>
                                    </div>



                                    <!-- </fieldset> -->
                                    <!-- </form> -->

                        </div>


                        <div class="col-md-6">


                            <!-- <fieldset> -->
                            <h6 class="h3 mb-2 text-gray-800"></h6>





                            <div class="form-group row">
                                <label for="example-text-input" class="col-4 col-form-label">Machine Max Quantity per Day</label>
                                <div class="col-8">
                                    <input type="text" readonly name="macMaxQty" id="macMaxQty" class="form-control">
                                </div>
                            </div>




                            </fieldset>



                    
                            </form>
                        </div>

                    </div> <!-- end of row -->



                    <div>
                        <div>

                            <div>
                            </div> <!-- end of row -->




                            <!-- data table -->
                            <div class="card mt-3">
                                <div class="card-header bg-light">
                                    <h5>Machine Schedule List</h5>
                                </div>

                                <div class="card-body p-3 pt-0">

                                    <table class="table" id="machineScheduleTbl">
                                        <thead class="thead-light text-dark">
                                            <th scope="col">Schedule id</th>
                                            <th scope="col">Order Detail id</th>
                                            <th scope="col">Machine id</th>
                                            <th scope="col">Reserved From</th>
                                            <th scope="col">Reserved to</th>
                                            <th scope="col">Schedule Status</th>
                                            <th scope="col">Option</th>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                    </table>

                                </div>
                            </div>










                            <div class="row">
                                         <div class="col-md">
                                         <!-- <div class="col-md-6"> -->
                                          <form action="#" id="macScheduleFrm">
                                                <!-- <fieldset> -->
                                                <!-- <div class="col-md-6"> -->
                                                            <input class="form-control" type="hidden" name="macScheduleId" id="macScheduleId">
                                                            <input class="form-control" type="hidden" name="ord_detail_id" id="ord_detail_id">
                                                            <input class="form-control" type="hidden" name="macScheStatus" id="macScheStatus">


                                                            <div class="form-group row">
                                                                <label for="example-text-input" class="col-4 col-form-label">Machine Reserved From<span class="text-danger">*</span></label>
                                                                <div class="col-8">
                                                                    <input type="date" name="macReservedFrom" id="macReservedFrom" placeholder=" reserve from" class="form-control">
                                                                </div>
                                                            </div>
                                                <!-- </div> -->


                                                    <!-- <div class="col-md-6"> -->
                                            
                                                        <div class="form-group row">
                                                            <label for="example-text-input" class="col-4 col-form-label">Machine Reserved To<span class="text-danger">*</span></label>
                                                            <div class="col-8">
                                                                <input type="date" name="macReservedTo" id="macReservedTo" placeholder=" reserve to" class="form-control">
                                                            </div>
                                                        </div>
                                                        <!-- <div class="form-group row">
                                                            <label for="example-text-input" class="col-4 col-form-label">Machine Schedule Status</label>
                                                            <div class="col-8">
                                                            <select class="form-control" id="macScheStatus" name="macScheStatus">
                                                                    <option value="1">Activated</option>
                                                                    <option value="0">Inactivated</option>
                                                                </select>
                                                            </div>
                                                        </div> -->
                                                        <div class="form-group row mb-0">
                                                            <div class="ml-lg-auto text-right">
                                                            <button type="reset" id="proCatCancel" class="btn btn-secondary">Cancel</button>
                                                            <button type="button" id="reserveMachineSave" name="reserveMachineSave" class="btn btn-success">Reserve Machine </button>
                                                                            <!-- onclick="reserveMachine()"  -->

                                                            </div>
                                                        </div>

                                                    <!-- </div>  -->
                                    </form>
                                </div>

                            </div> <!-- end of row -->




                            <div>
                                <!--end of  raw -->

             <script>



                            $(document).ready(function() {

                                //   datab();
                            });



                            // $(document).ready(function(){

                                    $.validator.addMethod("regex", function(value, element, regexpr) {          
                                    return regexpr.test(value);
                                    }); 

                                    // datab();


                                    // var params = new window.URLSearchParams(window.location.search);
                                    //     var orddetailID = params.get('ord_detail_id');
                                      




                                    $("#reserveMachineSave").click(function(){

                                        var params = new window.URLSearchParams(window.location.search);
                                        var orddetailID = params.get('ord_detail_id');

                                        $("#macScheduleFrm").validate({
                                            rules:{
                                               

                                                macReservedFrom:{
                                                    required: true,
                                                    greaterThan:'#placeDate', 
                                                   
                                                },
                                                macReservedTo:{
                                                    required: true,
                                                    greaterThan: '#macReservedFrom'   //id of the input box
                                                }

                                    
                                            },
                                            messages:{
                                               

                                                macReservedFrom:{
                                                    required: "Reserve from date required.",
                                                    greaterThan:"select  greater date",
                                                },
                                                macReservedTo:{
                                                    required: "Reserve  to date required.",
                                                    greaterThan:"Reserve to date is greater than from date",
                                                }

                                                                                             

                                            }
                                        });

                                        if(!$("#macScheduleFrm").valid()){
                                            return false;
                                        }
                                        
                                        data = new FormData($('#macScheduleFrm')[0]);

                                        var macId= $('#selectMachine').val();
                                            data.append('mac_id',macId);

                                            data.append('ID',orddetailID);

                                        $.ajax({
                                            url:  "handlers/plan-production_handler.php?type=addScheduleList",
                                            method: 'POST',
                                            data: data,
                                            processData: false,
                                            contentType: false
                                        })

                                        .done(function(data){

                                            swal(
                                                "Success!",
                                                "Data added successfully.",
                                                "success"
                                            );

                                            //$('#machineScheduleTbl').datab().ajax.reload();
                                            window.location.replace("http://localhost/mopms/realProduction.php");

                                        });

                                    });

                                // });


                                    // function reserveMachine(){
                                    //         // form id

                                            
                                    //         var params = new window.URLSearchParams(window.location.search);
                                    //     var orddetailID = params.get('ord_detail_id');
                                      


                                    // valid =$("#macScheduleFrm").validate();


                                    // if(valid){                                // form id
                                    //                 f = new FormData($("#macScheduleFrm")[0]);
                                    //                 var macId= $('#selectMachine').val();
                                    //                 f.append('mac_id',macId);

                                    //                 f.append('ID',orddetailID);      //$ordDETAILid= $_POST["ID"];  
                                    //                 //  ID- post value,  variable 
                                    //                 $.ajax({
                                    //                     method:"POST",
                                    //                     url:  "handlers/plan-production_handler.php?type=addScheduleList",
                                    //                     data: f,
                                    //                     contentType: false,
                                    //                     processData: false,
                                                        
                                    //                 })			
                                    //                     .done(function(data){
                                    //                     // window.location.reload();
                                    //                     window.location.replace("http://localhost/mopms/realProduction.php");

                                    //                 });

                                    //         }

                                    // }





                                    function datab(machineId) {
                                        console.log(machineId);
                                        
                                        
                                        $('#machineScheduleTbl').DataTable({

                                            serverSide: true, //Server-side processing in DataTables is enabled via this
                                            paging: true, //to disable paging for the table
                                            processing: true,
                                            // rowId: 'id', 
                                            ajax: //to specify the URL where DataTables should get its Ajax data from
                                            {
                                                url: 'handlers/plan-production_handler.php?type=retrieveSchedule',
                                                type: 'POST',
                                                data: {
                                                    machineId: machineId
                                                },
                                            },
                                            pageLength: 10, //Number of rows to display on a single page when using pagination
                                            columns: [{
                                                    data: "mac_sche_id",
                                                    name: "mac_sche_id"
                                                },
                                                {
                                                    data: "ord_detail_id",
                                                    name: "ord_detail_id"
                                                },
                                                {
                                                    data: "mac_id",
                                                    name: "mac_id"
                                                },
                                                {
                                                    data: "reserved_from",
                                                    name: "reserved_from"
                                                },
                                                {
                                                    data: "reserved_to",
                                                    name: "reserved_to"
                                                },
                                                {
                                                    data: "mac_sche_status",
                                                    name: "mac_sche_status"
                                                },
                                                {
                                                    data: "mac_sche_id",
                                                    name: "mac_sche_id"
                                                } // for option




                                            ],
                                            columnDefs: [{
                                                "targets": 6, //tells DataTables which column(s) the definition should be applied to
                                                "data": "mac_sche_id",
                                                "render": function(data, type, row, meta) {
                                                    // return '<button id="btnRemove" onclick="removeItem('+data+')">DEL</button> &nbsp <button id="btnEdit" onclick="editItem('+data+')">Edit</button> ';
                                                    return '<button  id="btnRemove" class="btn-dtable-delete" onclick="removeItem(' + data + ')"><i class="fa fa-trash-o"></i></button>';

                                                    //<button id="btnEdit" class="btn-dtable-edit" onclick="editItem(' + data + ')"><i class="fa fa-edit"></i></button>&nbsp;
                                                }
                                            }],
                                            "bDestroy": true

                                        });
                                    }





                                    $(document).ready(function() {

                                        //  alert("test");

                                        loadOrderDetail();
                                        //    datab();
                                    });

                                    function loadMachineList() {
                                                    //hidden input product code
                                        var pro_code = $("#hdInptProCode").val();

                                        $.ajax({
                                            url: "handlers/plan-production_handler.php?type=selectMachine",
                                            data: {
                                                product_id: pro_code
                                            },
                                            method: "POST",
                                            success: function(data) {
                                                data = JSON.parse(data);
                                                data.forEach(row => {
                                                    //txt id                                        //db column name
                                                    $("#selectMachine").append("<option value='" + row.MACHINE_ID + "'>" + row.MACHINE_NAME + "</option>");


                                                    // datab();
                                                });


                                            }
                                        });



                                    }



                                    function loadOrderDetail() {
                                        var params = new window.URLSearchParams(window.location.search);
                                        var id = params.get('ord_detail_id');
                                        console.log(id);

                                        //  alert(test);
                                        $.ajax({
                                                method: 'POST',
                                                url: "handlers/plan-production_handler.php?type=viewOrderDetail",
                                                data: {
                                                    id: id
                                                },
                                                //name   value
                                            })

                                            .done(function(data) {
                                                // window.location.reload();

                                                data = JSON.parse(data)[0];

                                                // console.log(data.ord_id);

                                                //  txt box id     //db column name
                                                $('#orderId').val(data.ORDER_CODE);
                                                $('#orderType').val(data.ORDER_TYPE);
                                                $('#productName').val(data.PRODUCT_NAME);
                                                $('#itemQty').val(data.QTY);
                                                
                                                $('#placeDate').val(data.ORD_PLACE_DATE);
                                                $('#cusReqDate').val(data.CUS_REQ_DATE);

                                                $('#des').val(data.DES);
                                                $('#wastage').val(data.WASTE);
                                                $('#unitPrice').val(data.PRICE);
                                                $('#hdInptProCode').val(data.PRODUCT_CODE);

                                                loadMachineList();

                                            });
                                    }

                                  

                                    $("#selectMachine").change(function() {


                                        var id = $(this).val();
                                        var pro_code = $('#hdInptProCode').val();

                                        $.ajax({
                                            url: "handlers/plan-production_handler.php?type=loadMachineConfigDetails",
                                            method: "POST",
                                            data: {
                                                machine_id: id,
                                                product_id: pro_code
                                            },
                                            success: function(data) {
                                                data = JSON.parse(data)[0];

                                                $("#macMinQty").val(data.MIN_QTY);
                                                $("#macMaxQty").val(data.MAX_QTY_PER_DAY);

                                                //calculate no of days
                                                var qty = $('#itemQty').val();
                                                var noOfDays = (qty / data.MAX_QTY_PER_DAY);

                                                noOfDays = Math.ceil(noOfDays);

                                                $("#noOfDays").val(noOfDays);

                                                datab(id);
                                            }
                                        });
                                    });




                                
                    function removeItem(mac_sche_id) {
                        console.log(mac_sche_id);
                            $.ajax({
                                    method: "POST",
                                    url: "handlers/plan-production_handler.php?type=removeMachineSchedule",
                                    //id        //user_id
                                    data: {
                                        mac_sche_id: mac_sche_id
                                    }
                                })
                                .done(function(data) {
                                    $('#machineScheduleTbl').DataTable().destroy();
                                    var machineId= $('#selectMachine option:selected').val();
                                    datab(machineId);
                                    // window.location.reload();
                                    // console
                                });
                        }

                                </script>






    <?php require_once('incl/footer.php'); ?>





               
                                                  

