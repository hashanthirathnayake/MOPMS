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



<!-- Begin Page Content -->
<div class="container-fluid">

    <!--breadcrumbs-->

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="admin_dash.php">Home</a></li>
                <li class="breadcrumb-item"><a href="production-1-test-33.php">Pending Machine Scheduling List</a></li>
				<li class="breadcrumb-item active" aria-current="page">configure Machine</li>
        </ol>
    </nav>

    <h1 class="h3 mb-2 text-gray-800"> Configuration Machine</h1>
    <a href="production-1-test-33.php" id="link-k9_divisions">View Production Order List <i class="fas fa-arrow-right"></i></a>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Configuration Machine </h5>
                <div class="card-body">



                    <form action="#" id="macConfigFrm">
                        <fieldset>
                            <input class="form-control" type="hidden"  name="macConfigId"  id="macConfigId">
                                        <input class="form-control" type="hidden" name="mode" id="mode" value="add" />
                                        <div class="form-group row">
                                                        <label for="example-text-input" class="col-2 col-form-label">Machine name<span class="text-danger">*</span></label>
                                                        <div class="col-10">
                                                        <select class="form-control" id="macName" name="macName">
                                                        <option value="">Please select</option> 
                                                            </select>
                                                        </div>
                                         </div>

                                        <div class="form-group row">
                                                        <label for="example-text-input" class="col-2 col-form-label">Product name<span class="text-danger">*</span></label>
                                                        <div class="col-10">
                                                        <select class="form-control" id="productName" name="productName">
                                                        <option value="">Please select</option> 
                                                            </select>
                                                        </div>
                                         </div>
                                        


                                        <div class="form-group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Min Qty<span class="text-danger">*</span></label>
                                        <div class="col-10">
                                         <input class="form-control" type="text" placeholder=" min qty" id="minQty" name="minQty">
                                        </div>
                                        </div>
                                               
                                        <div class="form-group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Max Qty<span class="text-danger">*</span></label>
                                        <div class="col-10">
                                         <input class="form-control" type="text" placeholder=" max qty" id="maxQty" name="maxQty">
                                        </div>
                                        </div>



                                        <!-- <input class="form-control" type="hidden"  name="macConfigStatus"  id="macConfigStatus"> -->
                                        <div class="form-group row">
                                        <label for="example-tel-input" class="col-2 col-form-label"> Config status<span class="text-danger">*</span></label>
                                                               

                                          <div class="col-10">
                                          <select class="form-control" id="macConfigStatus" name="macConfigStatus">
                                          <option value="1">Activated</option>
                                          <option value="0">Inactivated</option>
                                          </select>
                                          </div>
                                                                
                                        </div>


                                        <div class="form-group row mb-0">
                                        <div class="ml-lg-auto text-right">
                                                <button type="reset"  id="proCatCancel" class="btn btn-secondary">Cancel</button>
                                                <button type="button"  id="MacConfigSave" name="MacConfigSave" class="btn btn-success">Save </button>
                                                                        <!-- onclick="submitMacConfig()" -->
                                                                    
                                            </div>
                                        </div> 
                            <fieldset>
                    </form>

                </div> <!-- end of card body -->
            </div> <!-- end of card  -->

        </div>
    </div>





    <div class="card mt-3">
    <div class="card-header bg-light">
                            <h5>Configuration  Detail List</h5>
                        </div>

                            <div class="card-body p-3 pt-0">
                    
                                <table class="table" id="macConfigTbl">
                                    <thead class="thead-light text-dark">
                                        
                                        <th scope="col">mac config id</th>
                                        <th scope="col">Mac Name</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">min qty</th>
                                        <th scope="col">max qty</th>
                                        <th scope="col">Config Status</th>
                                        <th scope="col">Option</th>
                                        
                                
                                    </thead>

                                    <tbody>
                                        

                                    </tbody>
                                </table>
                
                            </div>
    </div>










</div> <!-- end of raw  -->




<script>
$(document).ready(function(){


 
    $("#macName").select2();   //for suggest machine name
    
    $("#productName").select2();   

    $.ajax({
                url : "handlers/configure-machine-machineScheduling_handler.php?type=getMachineName", 
                method : "GET",
                success : function(data){
                    data = JSON.parse(data);                    
                    data.forEach(row => {                          //db column name
                        // $("#userCatDes").append("<option value='"+row.user_cat_id+"'>"+row.user_cat_des+"</option>");
                        $("#macName").append("<option value='"+row.mac_id+"'>"+row.mac_name+"</option>");

                        
                        // $("#productCatName").append("<option value='"+row.pro_cat_code+"'>"+row.pro_cat_name+"</option>");
                            
                        //text box id
                    });
                }
            }); 





            $.ajax({
                url : "handlers/configure-machine-machineScheduling_handler.php?type=getProductName", 
                method : "GET",
                success : function(data){
                    data = JSON.parse(data);                    
                    data.forEach(row => {                          //db column name
                        // $("#userCatDes").append("<option value='"+row.user_cat_id+"'>"+row.user_cat_des+"</option>");
                        $("#productName").append("<option value='"+row.pro_code+"'>"+row.pro_name+"</option>");

                        
                        // $("#productCatName").append("<option value='"+row.pro_cat_code+"'>"+row.pro_cat_name+"</option>");
                            
                        //text box id
                    });
                }
            }); 



          });



          
        $(document).ready(function(){

            $.validator.addMethod("regex", function(value, element, regexpr) {          
            return regexpr.test(value);
            }); 

            datab();

            //buton id
            $("#MacConfigSave").click(function(){
                //form id
                $("#macConfigFrm").validate({
                    rules:{
                        macName:{
                            required: true
                        },

                        productName:{
                            required: true
                        },
                            
                        minQty:{
                            required: true,
                            number: true
                        },

                        maxQty:{
                            required: true,
                            number: true
                        },

                        macConfigStatus:{
                            required: true
                        }

                                
                    },
                    messages:{
                        macName:{
                            required: "mac name required."
                        },

                        productName:{
                            required: "product name required."
                        },

                        macConfigStatus:{
                            required: "Please select status"
                        
                        },

                        minQty:{
                            required: "Please enter min qty.",
                            number: "Please enter a number."
                        },

                        maxQty:{
                            required: "Please enter max qty.",
                            number: "Plese enter a number."
                        
                        },
                        
                        macConfigStatus:{
                            required: "Please select status.",
                        }
                    

                    }
                });

                if(!$("#macConfigFrm").valid()){
                    return false;
                }
                
                data = new FormData($('#macConfigFrm')[0]);

                $.ajax({
                    url:"handlers/configure-machine-machineScheduling_handler.php?type=saveMachineConfiguration",
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

                    // $('#macConfigTbl').DataTable().ajax.reload();

                });

            });

    });




    // function submitMacConfig() {
    //     // form id
    //     valid = $("#macConfigFrm").validate();

    //     if (valid) { // form id
    //         var f = new FormData($("#macConfigFrm")[0]);
    //         console.log(f);
    //         $.ajax({
    //                 method: "POST",
    //                 url:"handlers/configure-machine-machineScheduling_handler.php?type=saveMachineConfiguration",
    //                 data: f,
    //                 contentType: false,
    //                 processData: false,

    //             })
    //             .done(function(data) {
    //                 window.location.reload();
    //             });

    //     }

    // }






    function datab() {
        $('#macConfigTbl').DataTable({
            serverSide: true, //Server-side processing in DataTables is enabled via this
            paging: true, //to disable paging for the table
            processing: true,
            // rowId: 'id', 
            ajax: //to specify the URL where DataTables should get its Ajax data from
            {
                url: 'handlers/configure-machine-machineScheduling_handler.php?type=retrieve',
                type: 'POST'
            },
            pageLength: 10, //Number of rows to display on a single page when using pagination
            columns: [{
                    data: "mac_config_id",
                    name: "mac_config_id"
                }, //data-> data value coming from the backend name -> table fields
                {
                    data: "mac_id",
                    name: "mac_name"
                },
                {
                    data: "pro_code",
                    name: "pro_name"
                },
                {
                    data: "mac_min_qty",
                    name: "mac_min_qty"
                },
                {
                    data: "mac_max_qty_per_day",
                    name: "mac_max_qty_per_day"
                },
                {
                    data: "mac_config_status",
                    name: "mac_config_status"
                },



                {
                    data: "mac_config_id",
                    name: "mac_config_id"
                } // for option







            ],
            columnDefs: [{
                "targets": 6, //tells DataTables which column(s) the definition should be applied to
                "data": "mac_config_id",
                "render": function(data, type, row, meta) {
                    // return '<button id="btnRemove" onclick="removeItem('+data+')">DEL</button> &nbsp <button id="btnEdit" onclick="editItem('+data+')">Edit</button> ';
                    return '<button id="btnEdit" class="btn-dtable-edit" onclick="editItem(' + data + ')"><i class="fa fa-edit"></i></button>&nbsp;<button  id="btnRemove" class="btn-dtable-delete" onclick="removeItem(' + data + ')"><i class="fa fa-trash-o"></i></button>';
                    // return '<button id="btnRemove" onclick="removeItem('+data+')"> <i class="far fa-trash-alt"></i></button>&nbsp <button id="btnEdit" onclick="editItem('+data+')">class="btn  btn-dtable-edit"><i class="far fa-edit"></i></button> ';

                    // return '<button id="btnRemove" onclick="removeItem('+data+')"> <i class="fa fa-trash-0" style="font-size:24px;color:orange"></i></button>&nbsp <button id="btnEdit" onclick="editItem('+data+')"><i class="fa fa-edit" style="font-size:24px;color:blue"></i></button> ';
                    // class="btn  btn-dtable-edit"><i class="far fa-edit">   <i class="fa fa-trash" aria-hidden="true"></i>
                }
            }]

        });
    }




    // $(document).ready(function() {
    //     datab();
    // });


    //id
    function removeItem(macConfigId) {
        $.ajax({
                method: "POST",
                url: "handlers/configure-machine-machineScheduling_handler.php?type=delete",
                //id        //user_id
                data: {
                    macConfigId: macConfigId
                }
            })
            .done(function(data) {
                $('#macConfigTbl').DataTable().destroy();
                datab();
                // window.location.reload();
            });
    }






    function editItem(macConfigId) {
        console.log(macConfigId);

        $.ajax({
                method: "POST",
                url: "handlers/configure-machine-machineScheduling_handler.php?type=loadEditForm",
                data: {
                    id: macConfigId
                }
            })
            .done(function(data) {
                data = JSON.parse(data);

                $("#mode").val("edit");
                $("#macConfigId").val(data[0].mac_config_id);

                $("#macName").val(data[0].mac_id);
                $("#productName").val(data[0].pro_code);
                $("#minQty").val(data[0].mac_min_qty);

                $("#maxQty").val(data[0].mac_max_qty_per_day);
                $("#macConfigStatus").val(data[0].mac_config_status);
             
       
            });
    }

</script>
 



    <?php require_once('incl/footer.php'); ?>