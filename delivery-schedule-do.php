<?php
    require_once('incl/header_deliveryOfficer.php');
?>

<style>
    /* <!--  to resolve  jquery validation css error  --> */
    form .error {
        color: #ff0000;
        font-size: 1rem;
    }

    div.dataTables_wrapper div.dataTables_length select {
    width: 75px !important;
}

div.dataTables_wrapper div.dataTables_filter {
    display: none !important;
}



</style>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!--breadcrumbs-->

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="deliveryOfficer_dash.php">Home</a></li>
            <li class="breadcrumb-item"><a href="pending_orders-do.php">Pending Delivery</a></li>
            <li class="breadcrumb-item active" aria-current="page">Schduled Delivery</li>
        </ol>
    </nav>

    <!-- <h1 class="h3 mb-2 text-gray-800">User Configuration</h1> -->

    <div class="card mt-3">
        <div class="card-header bg-light">
            <h5>Scheduled Delivery List</h5>
        </div>

        <div class="card-body p-3 pt-0">

            <table class="table" id="Tbl">
                <thead class="thead-light text-dark">
                    <th scope="col">Delivery id</th>
                    <th scope="col">Order ID</th>
                    <th scope="col"> Vehicle No</th>
                    <th scope="col">Delivery Vehicle</th>
                    <th scope="col">Deliver By</th>
                   
                    <th scope="col">Start Date</th>
                    <th scope="col">End date</th>
                    <!-- <th scope="col">Remark</th> -->
                    <th scope="col">Status</th>

                    <th scope="col">Option</th>
                </thead>
                <tbody>


                </tbody>
            </table>

        </div>
    </div>

</div> <!-- end of container-fluid  -->

<script>
   
 



    //    production for orders-- plan & view bottons

    function datab() {
        $('#Tbl').DataTable({
            serverSide: true, //Server-side processing in DataTables is enabled via this
            paging: true, //to disable paging for the table
            processing: true,
            // rowId: 'id', 
            ajax: //to specify the URL where DataTables should get its Ajax data from
            {
                url: 'handlers/delivery-schedule-do_handler.php?type=retrieveDeliveryScheduledList',
                // url: 'handlers/production-1-test33_handler.php?type=retrieveProductionView',
                type: 'POST'
            },
            pageLength: 10,
            columns: [
                //data-> data value coming from the backend name -> table fields
                {
                    data: "deli_id",
                    name: "deli_id"
                },
                {
                    data: "ord_code",
                    name: "ord_code"
                },
                {
                    data: "veh_no",
                    name: "veh_no"
                },
                {
                    data: "veh_type",
                    name: "veh_type"
                },

                {
                    data: "emp_no",
                    name: "employee_name"
                },
                {
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
                },

                {
                    data: "deli_id",
                    name: "deli_id"
                } // for option


            ],
            columnDefs: [{
                "targets": 8, //tells DataTables which column(s) the definition should be applied to
                "data": "deli_id",
                "render": function(data, type, row, meta) {
                    
                  
                       return '<button id="btnPlan" class="btn-dtable-plan"  onclick="startedDelivery('+data+')" title="Complete Production" ><i class="fa fa-check-square" ></i>Start</button>';
                        //&nbsp;<button  id="btnOnHold" class="btn-dtable-view" onclick="onHoldProductionButton('+data+')"><i class="fas fa-pause"></i>on Hold </button>                                                                                                                                                //aria-hidden="true"

                }
            }],
            "bDestroy": true

        });
    }

 
    $(document).ready(function() {
        datab();
    });




    //production plan item for order prduction  
    // function planItem(ord_detail_id) {

    //     var location = "http://localhost/mopms/assignResource.php?ord_detail_id=" + ord_detail_id;
    //     window.location.replace(location);
    // }


    
    function startedDelivery(deli_id) {

        $.ajax({
            type: "POST",
            url: "handlers/delivery-schedule-do_handler.php?type=startDelivery",
            data: {
                deli_id : deli_id,
            },
            cache: false,
            success: function(response) { // Aware user on record success or not
                datab();
            }
        });

        }

    // function CompleteDeliveryButton(deli_id) {

    //     $.ajax({
    //         type: "POST",
    //         url: "handlers/delivery-schedule_handler.php?type=completeDelivery",
    //         data: {
    //             deli_id : deli_id,
    //         },
    //         cache: false,
    //         success: function(response) { // Aware user on record success or not
    //             datab();
    //         }
    //     });

    // }
    

    // function onHoldProductionButton(deli_id) {

    //     $.ajax({
    //     type: "POST",
    //     url: "handlers/delivery-schedule_handler.php?type=onholdDelivery",
    //     data: {
    //         deli_id : deli_id,
    //     },
    //     cache: false,
    //     success: function(response) { // Aware user on record success or not
    //         datab();
    //     }
    //     });

    //     }




    

</script>





<?php require_once('incl/footer.php'); ?>
