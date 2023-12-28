<?php
    require_once('incl/header_productionOfficer.php');
    // require_once('incl/header_productionOfficer.php');
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
            <!-- <li class="breadcrumb-item"><a href="admin_dash.php">Production</a></li> -->
            <li class="breadcrumb-item active" aria-current="page">Pending Machine Schedule Order List</li>
        </ol>
    </nav>



    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <!-- <div class="form-group row"> -->
                <!-- <label for="example-tel-input" class="col-2 col-form-label">Production Type </label> -->

                <!-- <div class="col-10">										 -->
                <!-- <select  name="order_type" id="order_type"  class="hidden"> -->
                <!-- <option value="">Please select</option>  
                                              <option value="prod_order">Production Order</option>  
                                              <option value="prod_own">Production Own</option>  -->

                <!-- </select> -->
                <!-- </div>        -->
                <!-- </div> -->


            </div> <!-- end of card  -->

        </div>
    </div>


    <div class="card mt-3">
        <div class="card-header bg-light">
            <h5>Pending Machine Schedule List</h5>
        </div>

        <div class="card-body p-3 pt-0">

            <table class="table" id="productionTbl">
                <thead class="thead-light text-dark">
                    <th scope="col">Order id</th>
                    <th scope="col">Order Type</th>
                    <th scope="col">Request Date</th>
                    <th scope="col">Product Code</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Qty</th>

                    <th scope="col">Option</th>
                </thead>
                <tbody>


                </tbody>
            </table>

        </div>
    </div>

</div> <!-- end of container-fluid  -->

<script>
    function datab_prod_order() {
        $('#productionTbl').DataTable({
            serverSide: true, //Server-side processing in DataTables is enabled via this
            paging: true, //to disable paging for the table
            processing: true,
            // rowId: 'id', 
            ajax: //to specify the URL where DataTables should get its Ajax data from
            {
                url: 'handlers/production-1-test33-po_handller.php?type=retrieveProductionOwn',
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
                    data: "deli_date",
                    name: "deli_date"
                },
                {
                    data: "pro_code",
                    name: "pro_code"
                },
                {
                    data: "pro_name",
                    name: "pro_name"
                },
                // {data:"pro_name",name:"pro_name"},      
                {
                    data: "item_qty",
                    name: "item_qty"
                },


                {
                    data: "ord_detail_id",
                    name: "ord_detail_id"
                } // for option



            ],
            columnDefs: [{
                "targets": 6, //tells DataTables which column(s) the definition should be applied to
                "data": "ord_detail_id",
                "render": function(data, type, row, meta) {
                    // return "<button onclick="planItem('+data+')">Plan<i class='fas fa-calendar-alt'></i></button>&nbsp;<button onclick="viewItem('+data+')">View<i class='fas fa-envelope-open-text'></i> </button>";

                    console.log(row.ord_type)

                    // if (row.ord_type == 'Customize') {

                        //with icon
                        // return '<button id="btnPlan" class="btn-dtable-plan"  onclick="planItem('+data+')"><i class="fas fa-calendar-alt"></i></button>&nbsp;<button  id="btnView" class="btn-dtable-view" onclick="viewItem('+data+')"><i class="fas fa-envelope-open-text"></i> </button>';

                        return '<button id="btnPlan" class="btn-dtable-plan"  onclick="planItem(' + data + ')"><i class="fas fa-calendar-alt"></i>schedule machine</button>&nbsp;<button  id="btnView" class="btn-dtable-view" onclick="configureItem(' + data + ')"><i class="fas fa-wrench"></i>configure machine </button>';
                        // return '<button id="btnPlan" class="btn-dtable-plan"  onclick="planItem('+data+')"><i class="fas fa-calendar-alt"></i></button>';

                    // } else {
                        // with icon
                        // return '<button id="btnPlan" class="btn-dtable-plan"  onclick="planItem('+data+')"><i class="fas fa-calendar-alt"></i>select machine</button>';
                        // return '<button id="btnPlan" class="btn-dtable-plan"  onclick="planItem(' + data + ')"><i class="fas fa-calendar-alt"></i>schedule machine</button>';
                    // }






                }
            }]

        });
    }







    //    production for orders-- plan & view bottons
    $(document).ready(function() {
        datab_prod_order();
    });


    //    production for own -- plan bottons
    $(document).ready(function() {
        // datab_prod_own();
    });



    //schdule machine 
    function planItem(ord_detail_id) {

        var scheduleMacUrl = "http://localhost/mopms/plan-production-1-po.php?ord_detail_id=" + ord_detail_id;
        window.open(scheduleMacUrl, "_blank");
    }

    



    function configureItem(ord_detail_id) {

        var configMacUrl = "http://localhost/mopms/configure-machine-machineScheduling-po.php?ord_detail_id=" + ord_detail_id;
        window.open(configMacUrl, "_blank");
    }

  

</script>




<?php require_once('incl/footer.php'); ?>
