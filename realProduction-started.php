<?php
    require_once('incl/header.php');
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
            <li class="breadcrumb-item"><a href="admin_dash.php">Home</a></li>
            <li class="breadcrumb-item"><a href="admin_dash.php">Production</a></li>
            <li class="breadcrumb-item active" aria-current="page"></li>
        </ol>
    </nav>

    <!-- <h1 class="h3 mb-2 text-gray-800">User Configuration</h1> -->

    <div class="card mt-3">
        <div class="card-header bg-light">
            <h5>Production Started Order List</h5>
        </div>

        <div class="card-body p-3 pt-0">

            <table class="table" id="productionTbl">
                <thead class="thead-light text-dark">
                    <th scope="col">Order id</th>
                    <th scope="col">Order Type</th>
                    <th scope="col">Product Code</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Order status</th>
                    <th scope="col">Reserve From</th>
                    <th scope="col">Reserve To</th>

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

    function datab_prod_order() {
        $('#productionTbl').DataTable({
            serverSide: true, //Server-side processing in DataTables is enabled via this
            paging: true, //to disable paging for the table
            processing: true,
            // rowId: 'id', 
            ajax: //to specify the URL where DataTables should get its Ajax data from
            {
                url: 'handlers/realProduction_handler.php?type=retrieveProductionStartedOrders',
                type: 'POST'
            },
            pageLength: 10,
            columns: [
                //data-> data value coming from the backend name -> table fields
                {
                    data: "ord_code",
                    name: "ord_code"
                },
                {
                    data: "ord_type",
                    name: "ord_type"
                },
                {
                    data: "pro_code",
                    name: "pro_code"
                },
                {
                    data: "pro_name",
                    name: "pro_name"
                },

                {
                    data: "item_qty",
                    name: "item_qty"
                },
                {
                    data: "ord_detail_status",
                    name: "ord_detail_status"
                },

                {
                    data: "mac_reserved_from",
                    name: "mac_reserved_from"
                },
                {
                    data: "mac_reserved_to",
                    name: "mac_reserved_to"
                },
                {
                    data: "ord_detail_id",
                    name: "ord_detail_id"
                } // for option



            ],
            columnDefs: [{
                "targets": 8, //tells DataTables which column(s) the definition should be applied to
                "data": "ord_detail_id",
                "render": function(data, type, row, meta) {
                    // return "<button onclick="planItem('+data+')">Plan<i class='fas fa-calendar-alt'></i></button>&nbsp;<button onclick="viewItem('+data+')">View<i class='fas fa-envelope-open-text'></i> </button>";
                 
                   // return "<button class="btn-dtable-view" onclick="CompleteProduction(' + data + ')" title="Complete Production"><i class='fas fa-play'></i></button>&nbsp;<button onclick="onHoldProduction('+data+')">View<i class='fas fa-pause'></i> On Hold</button>";

                   return '<button id="btnPlan" class="btn-dtable-plan"  onclick="CompleteProductionButton('+data+')" title="Complete Production" ><i class="fa fa-check-square" ></i>completed</button>&nbsp;<button  id="btnOnHold" class="btn-dtable-view" onclick="onHoldProduction('+data+')"><i class="fas fa-pause"></i>on Hold </button>';
                  

               }
            }],
            "bDestroy": true

        });
    }

    //    production for orders-- plan & view bottons
    $(document).ready(function() {
        datab_prod_order();
    });




    //production plan item for order prduction  
    function planItem(ord_detail_id) {

        var location = "http://localhost/mopms/assignResource.php?ord_detail_id=" + ord_detail_id;
        window.location.replace(location);
    }


    function CompleteProductionButton(ordDetailId) {

        $.ajax({
            type: "POST",
            url: "handlers/realProduction_handler.php?type=completeProduction",
            data: {
                orderDetailId : ordDetailId,
            },
            cache: false,
            success: function(response) { // Aware user on record success or not
                datab_prod_order();
            }
        });

    }
    

    function onHoldProduction(ordDetailId) {

        $.ajax({
        type: "POST",
        url: "handlers/realProduction_handler.php?type=onholdProduction",
        data: {
            orderDetailId : ordDetailId,
        },
        cache: false,
        success: function(response) { // Aware user on record success or not
            datab_prod_order();
        }
        });

        }






    // //  for view
    // function viewItem() {
    //     $('#productionViewModal').modal('show');

    //     datab3();
    // }

</script>



<?php require_once('incl/footer.php'); ?>
