<?php
  require_once('incl/header_productionOfficer.php');
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
            <h5>Production Completed Order List</h5>
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

                    <th scope="col">Completed</th>
                </thead>
                <tbody>


                </tbody>
            </table>

        </div>
    </div>

</div> <!-- end of container-fluid  -->

<script>
    $(document).ready(function() {
        $("#frmQty").validate({
            rules: {
                pq: {
                    required: true,
                    number: true,

                },

                wq: {
                    required: true,
                    number: true,
                },


                cmnt: {
                    required: true
                }


            },
            messages: {
                pq: {
                    required: "produce qty required.",
                    number: "Please enter a valid format."
                },

                wq: {
                    required: "Waste qty required.",
                    number: "Please enter a valid format."

                },

                cmnt: {
                    required: "Please provide comment.",

                }


            }
        });

    });




    //    production for orders-- plan & view bottons
    $(document).ready(function() {
        datab_prod_order();
    });



    //    production for orders-- plan & view bottons

    function datab_prod_order() {
        $('#productionTbl').DataTable({
            serverSide: true, //Server-side processing in DataTables is enabled via this
            paging: true, //to disable paging for the table
            processing: true,
            // rowId: 'id', 
            ajax: //to specify the URL where DataTables should get its Ajax data from
            {
                url: 'handlers/production-completed-po_handler.php?type=retrieveProductionCompletedOrders',
                type: 'POST'
            },
            pageLength: 10,
            columns: [
                //data-> data value coming from the backend name -> table fields
                {
                    data: "ord_code",
                    name: "ord_code"
                },
                // {
                //     data: "ord_code",
                //     name: "ord_code"
                // },
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

                    return '<button id="btnPlan" class="btn-dtable-plan"  onclick="remark(' + data + ')" title="Complete Production" ><i class="fas fa-comment"></i>Remark</button>';
                    //aria-hidden="true"


                }
            }],
            "bDestroy": true

        });
    }








    function remark(orderDetailId) {
        //hiden field id 
        $('#odi').val(orderDetailId);
        $('#productionViewModal').modal('show');


    }

    // function saveQty(){
    //                  // form id

    //         valid =$("#frmQty").validate();


    //         if(valid){                                // form id
    //                         f = new FormData($("#frmQty")[0]);

    //                         $.ajax({
    //                             method:"POST",
    //                             url:"handlers/production-completed_handler.php?type=addProduceWasteQty",
    //                             data: f,
    //                             contentType: false,
    //                             processData: false,

    //                         })			
    //                             .done(function(data){


    //                             // swal("Success!", "Successfully added record.", "sucess");

    //                         });

    //                 }

    //         }

    // $(document).ready(function(){



    // dataTable();
    $.validator.addMethod("regex", function(value, element, regexpr) {
        return regexpr.test(value);
    });


    function qtySave() {
        
        if (!$("#frmQty").valid()) {
            return;
        }

        data = new FormData($('#frmQty')[0]);

        $.ajax({
                url: "handlers/production-completed-po_handler.php?type=addProduceWasteQty",
                method: 'POST',
                data: data,
                processData: false,
                contentType: false
            })

            .done(function(data) {

                swal(
                    "Success!",
                    "Data added successfully.",
                    "success"
                );
            
                $("#productionViewModal").modal("toggle");

                // $('#emp').DataTable().ajax.reload();

            });
    };

    // });

</script>


<!-- modal for comment -->
<div class="modal fade" id="productionViewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"> Produce and Waste Quantity </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <div class="row">
                    <div class="col-md-12">
                        <div class="card">

                            <div class="card mt-3">




                                <div class="card-body">

                                    <form action="#" id="frmQty">
                                        <fieldset>

                                            <input type="hidden" name="orderDetailId" id="odi">


                                            <label for="example-text-input" class="col-4 col-form-label">Produce Qty</label>
                                            <div class="col-8">
                                                <input class="form-control" type="text" placeholder="Enter produce qty" id="pq" name="pq">
                                                <!-- for -->
                                            </div>


                                            <label for="example-text-input" class="col-4 col-form-label">Waste Qty</label>
                                            <div class="col-8">
                                                <input class="form-control" type="text" placeholder=" Enter waste qty" id="wq" name="wq">
                                            </div>


                                            <div class="form-group">
                                                <label for="comment">Remark:</label>
                                                <textarea class="form-control" rows="5" name="cmnt" id="cmnt"></textarea>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="ml-lg-auto text-right">
                                                    <button type="reset" id="userCancel" class="btn btn-secondary">Cancel</button>
                                                    <button type="button" id="btnQtySave" onclick="qtySave()" class="btn btn-success">Save </button>
                                                    <!-- onclick="saveQty()"  -->

                                                </div>
                                            </div>


                                        </fieldset>
                                    </form>

                                </div>



                            </div>
                        </div>
                    </div> <!-- end of raw -->





                </div> <!-- end of modal body -->

                <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
            </div> -->

            </div>
        </div>
    </div>


    <?php require_once('incl/footer.php'); ?>
