<?php
    require_once('incl/header_deliveryOfficer.php');
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
            <li class="breadcrumb-item"><a href="deliveryOfficer_dash.php">Home</a></li>
            <li class="breadcrumb-item"><a href="pending_orders.php">Pending Delivery</a></li>
            <li class="breadcrumb-item active" aria-current="page">Assign Dlivery</li>
        </ol>
    </nav>

    <div class="card mt-3">
        <div class="card-header bg-light">
            <h5>Delivery order information</h5>
        </div>

        <div class="card-body p-3 pt-0">

            <h4 class="mb-2 text-gray-800" style="font-weight:200;"><i class="fas fa-tasks"></i> &nbsp; Primary Information</h4>
            <br>

            <div class="row">
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Order No.</td>
                                    <td><?php echo $order_prefix; ?><span id="ordCode"></span></td>
                                </tr>
                                <tr>
                                    <td>Customer</td>
                                    <td><span id="deliCusName"></span></td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td><span id="deliAddress"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>City</td>
                                    <td><span id="deliCity"></span></td>
                                </tr>
                                <tr>
                                    <td>Placed on</td>
                                    <td><span id="deliPlaceDate"></span></td>
                                </tr>
                                <tr>
                                    <td>Delivery required on</td>
                                    <td><span id="deliReqDate"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <br>

            <h4 class="mb-2 text-gray-800" style="font-weight:200;"><i class="fas fa-tasks"></i> &nbsp; Order Detail(s)</h4>
            <br>

            <div class="table-responsive">
                <table class="table table-hover" id="orderDetailTable">
                    <thead class="thead-light text-dark">
                        <th scope="col">Product</th>
                        <th scope="col">Description</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Sub total</th>
                        <th scope="col">Type</th>
                        <th scope="col">Status</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <hr>

            <h4 class="mb-2 text-gray-800" style="font-weight:200;"><i class="fas fa-clock"></i> &nbsp; Schedule</h4>
            <br>

            <form action="#" id="deliveryScheduleForm">
                <input id="orderFormId" type="hidden" name="ordId" />

                <div class="row">
                    <div class="col-sm-6">
                        <h5 class=""><b><i class="fa fa-truck"></i> Vehicle</b></h5>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-3 col-form-label">Select Vehicle</label>

                            <div class="col-7">
                                <select required class="form-control" id="deliVehicle" name="deliVehicle">
                                    <option value="">Please select</option>
                                </select>
                            </div>
                        </div>

                        <div id="vehicle-sche-div" class="grey-box d-none">

                            <h5 style="color:#fff;">Existing schedule(s) for this vehicle</h5>
                            <br>

                            <div class="table-responsive">
                                <table class="table table-hover" id="vehicleTable">
                                    <thead class="thead-light text-dark">
                                        <th scope="col">From</th>
                                        <th scope="col">To</th>
                                        <th scope="col">Status</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h5 class=""><b><i class="fa fa-user"></i> Driver</b></h5>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-3 col-form-label">Select Driver</label>

                            <div class="col-7">
                                <select required class="form-control" id="deliDriver" name="deliDriver">
                                    <option value="">Please select</option>

                                </select>
                            </div>
                        </div>

                        <div id="driver-sche-div" class="grey-box d-none">

                            <h5 style="color:#fff;">Existing schedule(s) for this driver</h5>
                            <br>

                            <div class="table-responsive">
                                <table class="table table-hover" id="driverTable">
                                    <thead class="thead-light text-dark">
                                        <th scope="col">From</th>
                                        <th scope="col">To</th>
                                        <th scope="col">Status</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="example-text-input" class="col-3 col-form-label">Delivery start date</label>
                            <div class="col-7">
                                <input required type="date" name="startDate" id="startDate" placeholder="Delivery start date" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-3 col-form-label">Delivery end date</label>
                            <div class="col-7">
                                <input required type="date" name="endDate" id="endDate" placeholder="Delivery end date" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="ml-lg-auto text-right">
                            <button type="reset" id="proCatCancel" class="btn btn-secondary">Cancel</button>
                            <a href="javascript:void(0)" onclick="saveDelivery()" class="btn btn-success">Save Schedule</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var params = new window.URLSearchParams(window.location.search);
        var id = params.get('order_id');

        $("#orderFormId").val(id);

        loadOrderDetail();

        $.ajax({
            url: "handlers/assignDelivery-do_handler.php?type=getVehicle",
            method: "GET",
            success: function(data) {
                data = JSON.parse(data);
                data.forEach(row => { //db column name
                    // $("#deliVehicle").append("<option value='"+row.veh_id+"'>"+row.veh_type+"</option>");
                    //text box id

                    $("#deliVehicle").append("<option value='" + row.veh_id + "'>" + row.veh_no + "    " + row.veh_type + "</option>");
                });
            }
        });

        $.ajax({
            url: "handlers/assignDelivery-do_handler.php?type=getDriver",
            method: "GET",
            success: function(data) {
                data = JSON.parse(data);
                data.forEach(row => { //db column name
                    // $("#deliDriver").append("<option value='"+row.desig_id+"'>"+row.desig_name+"</option>");
                    //text box id
                    $("#deliDriver").append("<option value='" + row.emp_no + "'>" + row.emp_fname + ' ' + row.emp_lname + "</option>");

                });
            }
        });

    });

    function loadOrderDetail() {
        var params = new window.URLSearchParams(window.location.search);
        var id = params.get('order_id');

        console.log(id);

        $.ajax({
                method: 'POST',
                url: "handlers/assignDelivery-do_handler.php?type=viewOrderDetail",
                data: {
                    id: id
                },
            })

            .done(function(data) {
                data = JSON.parse(data)[0];

                $('#orderId').val(data.ORDER_ID);

                $('#ordCode').html(data.ORD_CODE);
                $('#deliCusName').html(data.CUS_NAME);
                $('#deliAddress').html(data.ADDRESS);
                $('#deliCity').html(data.CITY);
                $('#deliPlaceDate').html(data.PLACE_ON);
                $('#deliReqDate').html(data.DELIVERY_REQUIRED_ON);

                loadDetailTable(id);
            });
    }

    function loadDetailTable(orderId) {

        $('#orderDetailTable').DataTable({

            serverSide: true, //Server-side processing in DataTables is enabled via this
            paging: true, //to disable paging for the table
            processing: true,

            ajax: //to specify the URL where DataTables should get its Ajax data from
            {
                url: 'handlers/assignDelivery-do_handler.php?type=retrieveOrderDetails',
                type: 'POST',
                data: {
                    order_id: orderId
                },
            },
            pageLength: 10, //Number of rows to display on a single page when using pagination
            columns: [{
                    data: "pro_name",
                    name: "pro_name"
                },
                {
                    data: "pro_des",
                    name: "pro_des"
                },
                {
                    data: "item_qty",
                    name: "item_qty"
                },
                {
                    data: "item_subtotal",
                    name: "item_subtotal"
                },
                {
                    data: "ord_type",
                    name: "ord_type"
                },
                {
                    data: "ord_detail_status",
                    name: "ord_detail_status"
                }
            ],
            "bDestroy": true

        });

    }

    $('#deliVehicle').on('change', function() {
        var vehicleId = this.value;

        loadVehicleSchedules(vehicleId);
    });

    //load vehicle dates
    function loadVehicleSchedules(vehicleId) {

        if (vehicleId == null || vehicleId == "") {
            $("#vehicle-sche-div").addClass("d-none");
            return;
        }

        $("#vehicle-sche-div").removeClass("d-none");

        $('#vehicleTable').DataTable({

            serverSide: true, //Server-side processing in DataTables is enabled via this
            paging: true, //to disable paging for the table
            processing: true,

            ajax: //to specify the URL where DataTables should get its Ajax data from
            {
                url: 'handlers/assignDelivery-do_handler.php?type=retrieveVehicleSchedules',
                type: 'POST',
                data: {
                    vehicle_id: vehicleId
                },
            },
            pageLength: 10, //Number of rows to display on a single page when using pagination
            columns: [{
                    data: "start_date",
                    name: "start_date"
                },
                {
                    data: "end_date",
                    name: "end_date"
                },
                {
                    data: "status",
                    name: "status"
                }
            ],
            "bDestroy": true

        });
    }

    $('#deliDriver').on('change', function() {
        var driverId = this.value;

        loadDriverSchedules(driverId);
    });

    //load driver dates
    function loadDriverSchedules(driverId) {

        if (driverId == null || driverId == "") {
            $("#driver-sche-div").addClass("d-none");
            return;
        }

        $("#driver-sche-div").removeClass("d-none");

        $('#driverTable').DataTable({

            serverSide: true, //Server-side processing in DataTables is enabled via this
            paging: true, //to disable paging for the table
            processing: true,

            ajax: //to specify the URL where DataTables should get its Ajax data from
            {
                url: 'handlers/assignDelivery-do_handler.php?type=retrieveDriverSchedules',
                type: 'POST',
                data: {
                    driver_id: driverId
                },
            },
            pageLength: 10, //Number of rows to display on a single page when using pagination
            columns: [{
                    data: "start_date",
                    name: "start_date"
                },
                {
                    data: "end_date",
                    name: "end_date"
                },
                {
                    data: "status",
                    name: "status"
                }
            ],
            "bDestroy": true

        });
    }

    function saveDelivery() {

        if ($("#deliveryScheduleForm").valid()) { // form id

            f = new FormData($("#deliveryScheduleForm")[0]);
            $.ajax({
                    method: "POST",
                    url: "handlers/assignDelivery-do_handler.php?type=saveDelivery",
                    data: f,
                    contentType: false,
                    processData: false,

                })
                .done(function(data) {
                    location.replace('http://localhost/mopms/pending_orders-do.php');
                });

        }

    }

</script>

<?php require_once('incl/footer.php'); ?>
