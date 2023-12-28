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
            <li class="breadcrumb-item active" aria-current="page">Employee Configuration</li>
        </ol>
    </nav>

    <h1 class="h3 mb-2 text-gray-800">Employee Configuration</h1>

    <!-- <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Product Category </h5>
                <div class="card-body">
                    <form action="#" id="productCategoryFrm">
                        <fieldset>
                        <h1 class="h3 mb-2 text-gray-800">Employee Configuration</h1> -->

<div class="row">
    <div class="col-md-12" id="">
        <div class="card">
            <h5 class="card-header-text">Employee</h5>
            <!-- <a href="view_k9_division.php" id="link-k9_divisions">View employee <i class="fas fa-arrow-right"></i></a> -->
            <!-- <h5 class="card-header">Employee</h5> -->
            <!-- card-header-text -->
                <div class="card-body">
                    <form action="#" id="empFrm">
                        <fieldset>
                        
                                                                 
                                          

                                            <input type="hidden" id="mode" name="mode" value="add">
                                            
                                            <input class="form-control" type="hidden"  name="employeeId"  id="employeeId">

                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-2 col-form-label">  Name<span class="text-danger">*</span></label>
                                                <div class="col-10">
                                                <input class="form-control" type="text"  placeholder=" name"   name="name"  id="empFname">
                                            </div>
                                            </div>

                                            
                                                                            
                                           

                                            <div class="form-group row">
                                            <label for="example-text-input" class="col-2 col-form-label">birth date<span class="text-danger">*</span></label>
                                                <div class="col-10">
                                                <input type="date" name="empJdate" id="bday" placeholder=" bday" class="form-control">
                                                </div>
                                           </div>	



                                           



                                            


                                            <div class="form-group row mb-0">
                                            <div class="ml-lg-auto text-right">
                                                    <button type="reset"  id="empCancel" class="btn btn-secondary">Cancel</button>
                                                    <button   type="button"   id="empSave" class="btn btn-success">Save <i class='fas fa-archway'></i></button>
                                                                    <!-- onclick="submitEmployee()" -->

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
                <h5> List</h5>
            </div>

                 <div class="card-body p-3 pt-0">

                            <table class="table" id="empTbl">
                                <thead class="thead-light text-dark">

                                                    <th scope="col">Emp No</th>
                                                    <th scope="col">First name</th>
                                                    <th scope="col">Last Name</th>
                                                    <th scope="col">Designation</th>
                                                    <th scope="col">Join date</th>
                                                    <th scope="col">Address</th>
                                                    <th scope="col">Nic</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Contact No</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Options</th>

                             

                                </thead>
                                <tbody>
                                    

                                </tbody>
                            </table>

                 </div>
        </div>










</div> <!-- end of raw  -->









<script>


        // $(document).ready(function(){

        
        //   });



    $(document).ready(function(){

      $.validator.addMethod("regex", function(value, element, regexpr) {          
        return regexpr.test(value);
        });


        datab();

            //for load desination list
                    
            $.ajax({
                    url : "handlers/employee_handler.php?type=loadDesignation", 
                    method : "GET",
                    success : function(data){
                        data = JSON.parse(data);                    
                        data.forEach(row => {                          //db column name
                            // $("#userCatDes").append("<option value='"+row.user_cat_id+"'>"+row.user_cat_des+"</option>");
                            $("#empDesig").append("<option value='"+row.desig_id+"'>"+row.desig_name+"</option>");

                                                            
                            //text box id
                        });
                    }
                }); 


    





        $("#empSave").click(function(){

            //form id
            $("#empFrm").validate({
                rules:{
                    empFname:{
                        required: true,
                    },

                    empLname:{
                        required: true,
                    },

                    empNic:{
                        required: true,
                        regex: /^([0-9]{9}[x|X|v|V]|[0-9]{12})$/,
                        minlength: 10,
                        maxlength: 12
                    },

                    empDesig:{
                        required: true,
                    },

                    empAddress:{
                        required: true,
                    },

                    empJdate: {
                    required: true,
                    // dateISO: true
                    },

                    empContactNo: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10
                    },
                   

                    empEmail:{
                        required: true,
                        regex: /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/
                    }
                },
                messages:{
                    empFname:{
                        required: "First name required."
                    },

                    empLname:{
                        required: "Last name required."
                    },

                    empNic:{
                        required: "Please enter the NIC.",
                        regex: "Please enter a valid format.",
                        minlength:"NIC number must contain between 10 to 12 characters.",
                        maxlength:"NIC number must contain between 10 to 12 characters."
                    },
                                  
                    empDesig:{
                        required: "Please select a designation.",
                        
                    },
                    empAddress:{
                        required: "Please enter a Address.",
                        regex: "Please enter a valid format."
                    },
                    empJdate:{
                        required: "Please select a date.",
                        
                    },

                    empContactNo:{
                        required: "Please enter a phone number.",
                        number: "Plese enter a valid format.",
                        minlength: "Number cannot be less than 10 digits.",
                        maxlength: "You can only enter 10 digits."
                    },

                    empEmail:{
                        required: "Please enter an email address.",
                        regex: "Please enter a valid email."
                    }

                }
            });

            if(!$("#empFrm").valid()){
                return false;
            }

            data = new FormData($('#empFrm')[0]);

            $.ajax({
                url: 'handlers/emp_handler.php?type=saveEmployee',
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


    function datab() {
        $('#empTbl').DataTable({
            serverSide: true, //Server-side processing in DataTables is enabled via this
            paging: true, //to disable paging for the table
            processing: true,
            // rowId: 'id', 
            ajax: //to specify the URL where DataTables should get its Ajax data from
            {
                url: 'handlers/employee_handler.php?type=retrieve',
                type: 'POST'
            },
            pageLength: 10, //Number of rows to display on a single page when using pagination
            columns: [{

                       
                    data: "emp_no",
                    name: "emp_no"
                }, //data-> data value coming from the backend name -> table fields
                {
                    data: "emp_fname",
                    name: "emp_fname"
                },
                {
                    data: "emp_lname",
                    name: "emp_lname"
                },
               
                {
                    data: "desig_id",
                    name: "desig_name"
                },
                {
                    data: "emp_jdate",
                    name: "emp_jdate"
                },
                {
                    data: "emp_address",
                    name: "emp_address"
                },
                {
                    data: "emp_nic",
                    name: "emp_nic"
                },
                {
                    data: "emp_email",
                    name: "emp_email"
                },
                {
                    data: "emp_contact_no",
                    name: "emp_contact_no"
                },
                {
                    data: "emp_status",
                    name: "emp_status"
                },
              
                {
                    data: "emp_no",
                    name: "emp_no"
                } // for option

            ],
            columnDefs: [{
                "targets": 10, //tells DataTables which column(s) the definition should be applied to
                "data": "emp_no",
                "render": function(data, type, row, meta) {
                    // return '<button id="btnRemove" onclick="removeItem('+data+')">DEL</button> &nbsp <button id="btnEdit" onclick="editItem('+data+')">Edit</button> ';
                    // return '<button id="btnEdit" class="btn-dtable-edit" onclick="editItem(' + data + ')"><i class="fa fa-edit"></i></button>&nbsp;<button  id="btnRemove" class="btn-dtable-delete" onclick="removeItem(' + data + ')"><i class="fa fa-trash-o"></i></button>';
                    

                    return '<button id="btnEdit" class="btn-dtable-edit" onclick="editItem('+data+')"><i class="fa fa-edit"></i></button>&nbsp;<button  id="btnRemove" class="btn-dtable-delete" onclick="removeItem('+data+')"><i class="fa fa-trash-o"></i></button>&nbsp; <button id="btnView" onclick = "viewItem('+data+')" class="btn-dtable-view"><i class="fas fa-envelope-open-text"></i></button>';

                }
            }]

        });
    }




    // $(document).ready(function() {
    //     datab();
    // });


    //id
    function removeItem(empId) {
        $.ajax({
                method: "POST",
                url: "handlers/employee_handler.php?type=delete",
                //id        //user_id
                data: {
                    empId: empId
                }
            })
            .done(function(data) {
                $('#empTbl').DataTable().destroy();
                datab();
                // window.location.reload();
            });
    }






    function editItem(employeeId) {
        console.log(employeeId);

        $.ajax({
                method: "POST",
                url: "handlers/employee_handler.php?type=loadEditForm",
                data: {
                    id: employeeId
                }
            })
            .done(function(data) {
                data = JSON.parse(data);

                // $("#mode").val("edit");
                // $("#productCatCode").val(data[0].pro_cat_code);
                // $("#productCatName").val(data[0].pro_cat_name);
                // $("#productCatStatus").val(data[0].pro_cat_status);

                $("#mode").val("edit");
                $("#employeeId").val(data[0].emp_no);
                $("#empFname").val(data[0].emp_fname);
                
                $("#empLname").val(data[0].emp_lname);
            
                // $("#empDesig").change();
                $("#empDesig").val(data[0].desig_id);
                $("#empJdate").val(data[0].emp_jdate);
                $("#empAddress").val(data[0].emp_address);

                $("#empNic").val(data[0].emp_nic);
                $("#empEmail").val(data[0].emp_email);
                $("#empContactNo").val(data[0].emp_contact_no);
                // $("#empStatus").val(data.mac_availability);
                // $("#empStatus").change();
                $("#empStatus").val(data[0].emp_status);
              
            });
    }





    //  //  for view
     function  viewItem(emp_no){

                $('#ViewModal').modal('show');

                // datab3();
                

                $.ajax({
                        method: "POST",
                        url: "handlers/employee_handler.php?type=viewEmployee",
                        data: {emp_no: emp_no},
                    })
                    
                    .done(function (data) {
                        

                        data = JSON.parse(data)[0];

                        console.log(data.emp_no);
                            // $('#employeeId').html(data.emp_no);
                            $('#empFnameModal').html(data.emp_fname);
                            $('#empLnameModal').html(data.emp_lname);
                            $('#empDesigModal').html(data.desig_id);
                            $('#empJdateModal').html(data.emp_jdate);
                            $('#empAddressModal').html(data.emp_address);
                            $('#empNicModal').html(data.emp_nic);
                            $('#empEmailModal').html(data.emp_email);
                            $('#empContactNoModal').html(data.emp_contact_no);
                            $('#empStatusModal').html(data.emp_status);
                    });

                }

</script>




               <!-- modal for view -->
               <div class="modal fade" id="ViewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Employee detail </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>First Name</td>
                                <td>:&nbsp; <span id="empFnameModal"></span></td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td>:&nbsp; <span id="empLnameModal"></span></td>
                            </tr>
                            <tr>
                                <td>Designation</td>
                                <td>:&nbsp; <span id="empDesigModal"></span></td>
                            </tr>
                            <tr>
                                <td>join date</td>
                                <td>:&nbsp; <span id="empJdateModal"></span></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>:&nbsp; <span id="empAddressModal"></span></td>
                            </tr>
                           
                            <tr>
                                <td>Status</td>
                                <td>:&nbsp; <span id="empStatusModal"></span></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <!-- <a  href="productionPlans.php"><button type="button" class="btn btn-primary">Confirm Production Plan</button></a> -->
            </div>
        </div>
    </div>
</div> 



<?php require_once('incl/footer.php'); ?>
