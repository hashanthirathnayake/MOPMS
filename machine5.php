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
            <li class="breadcrumb-item active" aria-current="page">Machine </li>
        </ol>
    </nav>

    <h1 class="h3 mb-2 text-gray-800"> Machine</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header"> Machine </h5>
                <div class="card-body">
                    <form action="#" id="machineFrm">
                        <fieldset>
                        <input type="hidden" id="mode" name="mode" value="add">
                                                    <input class="form-control" type="hidden"  name="macId"  id="macId">
                                                    <!-- <input class="form-control" type="hidden"  name="userCatId"  id="userCatId"> -->


                                                        <div class="form-group row">
                                                        <label for="example-text-input" class="col-2 col-form-label">Machine name<span class="text-danger">*</span></label>
                                                        <div class="col-10">
                                                        <input class="form-control" type="text" placeholder=" Mahine name" id="macName" name="macName" >
                                                        </div>
                                                        </div>


                                                       

                                                        <div class="form-group row">
                                                        <label for="example-text-input" class="col-2 col-form-label">Supervisor name<span class="text-danger">*</span></label>
                                                        <div class="col-10">
                                                        <select class="form-control" id="macSupName" name="macSupName">
                                                        <option value="">Please select</option> 
                                                            <!-- <option value="1">Admin</option>
                                                                <option value="0">Assistant</option>
                                                                <option value="2">user2</option>
                                                                <option value="3">user3</option> -->
                                                            </select>
                                                        </div>
                                                        </div>


                                                        
                                                        <div class="form-group row">
                                                        <label for="example-text-input" class="col-2 col-form-label">Plant name<span class="text-danger">*</span></label>
                                                        <div class="col-10">
                                                        <select class="form-control" id="plantName" name="plantName">
                                                        <option value="">Please select</option> 
                                                            <!-- <option value="1">Admin</option>
                                                                <option value="0">Assistant</option>
                                                                <option value="2">user2</option>
                                                                <option value="3">user3</option> -->
                                                            </select>
                                                        </div>
                                                        </div>

                                                        <!-- <div class="form-group row">
                                                        <label for="example-text-input" class="col-2 col-form-label"> Min Qty per day</label>
                                                        <div class="col-10">
                                                        <input class="form-control" type="text" placeholder=" Min Qty" id="macMinQty" name="macMinQty" >
                                                        </div>
                                                        </div>

                                                        <div class="form-group row">
                                                        <label for="example-text-input" class="col-2 col-form-label">  Max Qty per day</label>
                                                        <div class="col-10">
                                                        <input class="form-control" type="text" placeholder=" Max Qty" id="macMaxQty" name="macMaxQty" >
                                                        </div>
                                                        </div> -->

                                                        <!-- <div class="form-group row">
                                                                        <label for="example-tel-input" class="col-2 col-form-label">Machine Type </label>
                                                                                
                                                                                <div class="col-10">										
                                                                                        <select  name="macType" id="macType" class="form-control">
                                                                                            <option value="">Please select</option>  
                                                                                            <option value="1">Manual</option>  
                                                                                            <option value="2">Semi Auto</option> 
                                                                                            <option value="3">Auto</option> 
                                                                                            <option value="4">other</option> 

                                                                                        </select>
                                                                                </div>       
                                                        </div> -->
                                                           
                                                                    


                                                        <div class="form-group row">
                                                          <label for="example-tel-input" class="col-2 col-form-label">status<span class="text-danger">*</span></label>
                                                                            


                                                                            <div class="col-10">
                                                                            <select class="form-control" id="macStatus" name="mactSatus">
                                                                                <option value="">Please Select</option>
                                                                                <option value="1">Activated</option>
                                                                                <option value="0">Deactivated</option>
                                                                            </select>
                                                                            </div>
                                                                            
                                                        </div>  
                                                       
            


                                                            <div class="form-group row mb-0">
                                                            <div class="ml-lg-auto text-right">
                                                                    <button type="reset"  id="userCancel" class="btn btn-secondary">Cancel</button>
                                                                    <button  type="button"  id="machineSave" name="machineSave"  class="btn btn-success">Save </button>
                                                                                        <!--  onclick="submitMachine()"  -->
                                                        
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
            <h5>Machine Detail List</h5>
        </div>

        <div class="card-body p-3 pt-0">

        <table class="table" id="machineTbl">
							<thead class="thead-light text-dark">
                                <th scope="col">#</th>
								<th scope="col">Machine Name</th>
								<th scope="col"> Supervisor</th>
                                <th scope="col">Plant Name</th> 
								

                                <th scope="col"> Status</th>
                  			
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

$.ajax({
    url : "handlers/machine5_handler.php?type=getDesignation", 
    method : "GET",
    success : function(data){
        data = JSON.parse(data);                    
        data.forEach(row => {                          //db column name
            // $("#userCatDes").append("<option value='"+row.user_cat_id+"'>"+row.user_cat_des+"</option>");
            $("#macSupName").append("<option value='"+row.emp_no+"'>"+row.emp_fname+' '+row.emp_lname +"</option>");
            //text box id
        });
    }
}); 


$.ajax({
    url : "handlers/machine5_handler.php?type=getPlantName", 
    method : "GET",
    success : function(data){
        data = JSON.parse(data);                    
        data.forEach(row => {                          //db column name
            // $("#userCatDes").append("<option value='"+row.user_cat_id+"'>"+row.user_cat_des+"</option>");
            $("#plantName").append("<option value='"+row.plant_no+"'>"+row.plant_name+"</option>");

            
            // $("#productCatName").append("<option value='"+row.pro_cat_code+"'>"+row.pro_cat_name+"</option>");
                
            //text box id
        });
    }
}); 

});






    // function submitMachine() {
    //     // form id
    //     valid = $("#machineFrm").validate();

    //     if (valid) { // form id
    //         var f = new FormData($("#machineFrm")[0]);
    //         console.log(f);
    //         $.ajax({
    //                 method: "POST",
    //                 url: "handlers/machine5_handler.php?type=saveMachine",
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
        $('#machineTbl').DataTable({
            serverSide: true, //Server-side processing in DataTables is enabled via this
            paging: true, //to disable paging for the table
            processing: true,
            // rowId: 'id', 
            ajax: //to specify the URL where DataTables should get its Ajax data from
            {
                url: 'handlers/machine5_handler.php?type=retrieve',
                type: 'POST'
            },
            pageLength: 10, //Number of rows to display on a single page when using pagination
            columns: [{
                    data: "mac_id",
                    name: "mac_id"
                }, //data-> data value coming from the backend name -> table fields
                {
                    data: "mac_name",
                    name: "mac_name"
                },
                {           
                    data: "emp_no",  //emp_name , emp_no i fk in machine 3
                    name: "employee_name"
                },
                {
                    data: "plant_no",   //plant_name , plant_no is fk in machine3 table 
                    name: "plant_name"
                },


                {
                    data: "mac_status",
                    name: "mac_status"
                } ,
                {
                    data: "mac_id",
                    name: "mac_id"
                } // for option



            ],
            columnDefs: [{
                "targets": 5, //tells DataTables which column(s) the definition should be applied to
                "data": "mac_id",
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




    $(document).ready(function() {
        datab();
    });


    //id
    function removeItem(mac_id) {
        $.ajax({
                method: "POST",
                url: "handlers/machine5_handler.php?type=deleteMachine",
                //id        //user_id
                data: {
                    mac_id: mac_id
                }
            })
            .done(function(data) {
                $('#machineTbl').DataTable().destroy();
                datab();
                // window.location.reload();
            });
    }



  


    function editItem(macId) {
        console.log(macId);

        $.ajax({
                method: "POST",
                url: "handlers/machine5_handler.php?type=loadEditForm",
                data: {
                    id: macId
                    //name   value
                }
            })
            .done(function(data) {
                data = JSON.parse(data);

                $("#mode").val("edit");
                $("#macId").val(data[0].mac_id);
                $("#macName").val(data[0].mac_name);
                $("#macSupName").val(data[0].emp_no);
                $("#plantName").val(data[0].plant_no);
                $("#macStatus").val(data[0].mac_status);

              
            });
    }



    $(document).ready(function(){

            $.validator.addMethod("regex", function(value, element, regexpr) {          
            return regexpr.test(value);
            });


            // datab();

                $("#machineSave").click(function(){

            //form id
            $("#machineFrm").validate({
                rules:{
                    macName:{
                        required: true,
                    },

                    empLname:{
                        required: true,
                    },

                  

                    plantName:{
                        required: true,
                    },

                    mactSatus:{
                        required: true,
                    }
                 
                },
                messages:{
                    macName:{
                        required: "Please select machine name."
                    },

                    macSupName:{
                        required: "Please select supervisor."
                    },

                    plantName:{
                        required: "Please select plant name.",
                       
                    },
                                
                    mactSatus:{
                        required: "Please select status.",
                        
                    }
                }
            });

            if(!$("#machineFrm").valid()){
                return false;
            }

            data = new FormData($('#machineFrm')[0]);

            $.ajax({
                url: 'handlers/machine5_handler.php?type=saveMachine',
                method: 'POST',
                data: data,
                processData: false,
                contentType: false
            })

            .done(function(data){

                // swal(
                //     "Success!",
                //     "Data added successfully.",
                //     "success"
                // );

                // $('#emp').DataTable().ajax.reload();   //check
                
                // $('#empTbl').datab().ajax.reload();
            });

            });   



            });  // end of documnt.ready
























</script>

<?php require_once('incl/footer.php'); ?>
