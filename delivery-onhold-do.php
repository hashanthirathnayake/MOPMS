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
            <li class="breadcrumb-item"><a href="pending_orders-do.php">Pending</a></li>
            <li class="breadcrumb-item active" aria-current="page">Delivery On hold</li>
        </ol>
    </nav>

    <!-- <h1 class="h3 mb-2 text-gray-800">User Configuration</h1> -->

    <div class="card mt-3">
        <div class="card-header bg-light">
            <h5>Delivery Onhold  List</h5>
        </div>

        <div class="card-body p-3 pt-0">

            <table class="table" id="productionTbl">
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
                url: 'handlers/delivery-onhold-do_handler.php?type=retrieveOnholdDelivery',
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
                    data: "ord_id",
                    name: "ord_id"
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
                   
                    return '<button id="btnPlan" class="btn-dtable-plan"  onclick="reason('+data+')" title="On hold Production" ><i class="fas fa-comment"></i>Reason</button>&nbsp;<button  id="btnOnHold" class="btn-dtable-view" onclick="resume('+data+')"><i class="fa fa-forward"></i>Resume </button>';
                                                                                                                                                                     //aria-hidden="true"
                  
                }
            }],
            "bDestroy": true

        });
    }

     

      
        function reason(deliId) {
             //hiden field id 
                $('#deliId').val(deliId);
                $('#productionViewModal').modal('show');

                             
            }

                      // $(document).ready(function(){

              

                // dataTable();
                $.validator.addMethod("regex", function(value, element, regexpr) {          
                return regexpr.test(value);
                }); 


                $(document).ready(function(){

                 
                 
                    $("#frmDeli").validate({
                        rules:{
                        
                            
                            cmnt:{
                                required: true
                            }

                           
                        },
                        messages:{
                           

                            cmnt:{
                                required: "Please provide comment.",
                               
                            }


                        }
                    });

                });


            function saveCmnt(){




                if(!$("#frmDeli").valid()){
                                    return false;
                                }
                                
                                data = new FormData($('#frmDeli')[0]);

                                $.ajax({
                                    url:"handlers/delivery-onhold-do_handler.php?type=addComent",
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

                                    // $('#emp').DataTable().ajax.reload();

                                });


                        }
                   

               

                // });

  


                function resume(deli_id) {

                $.ajax({
                type: "POST",
                url: "handlers/delivery-onhold-do_handler.php?type=resume",
                data: {
                    deli_id : deli_id,
                },
                cache: false,
                success: function(response) { // Aware user on record success or not
                    datab_prod_order();
                }
                });

                }
                

</script>


<!-- modal for comment -->
<div class="modal fade" id="productionViewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">  Delivery Completed Remark </h5>
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

                                    <form action="#" id="frmDeli">
                                        <fieldset>
                                        
                                        <input type="hidden" name="deliId" id="deliId">
                                                                                                                                                         
                                                                                    
                                        <div class="form-group">
                                            <label for="comment">Remark:</label>
                                            <textarea class="form-control" rows="5"  name="cmnt"></textarea>
                                        </div>

                                        <div class="form-group row mb-0">
                                                  <div class="ml-lg-auto text-right">
                                                          <button type="reset"  id="userCancel" class="btn btn-secondary">Cancel</button>
                                                          <button  type="button"   onclick="saveCmnt()"   id="btnDeliSave" class="btn btn-success">Save </button>
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
