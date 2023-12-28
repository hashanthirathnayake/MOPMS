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
            <li class="breadcrumb-item active" aria-current="page">User Configuration</li>
        </ol>
    </nav>

    <h1 class="h3 mb-2 text-gray-800">User Configuration</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">User</h5>
                <div class="card-body">
                    <form action="#" id="userFrm">
                        <fieldset>


                            <input class="form-control" type="hidden" name="userId" id="userId">
                            <!-- <input class="form-control" type="hidden"  name="userCatId"  id="userCatId"> -->
                            <input class="form-control" type="hidden" name="mode" id="mode" value="add" />

                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">User category description<span class="text-danger">*</span></label>
                                <div class="col-10">
                                    <select class="form-control" id="userCatDes" name="userCatDes">
                                        <option value="">Please select</option>
                                        <!-- <option value="1">Admin</option>
                                                      <option value="0">Assistant</option>
                                                      <option value="2">user2</option>
                                                      <option value="3">user3</option> -->
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">User name<span class="text-danger">*</span></label>
                                <div class="col-10">
                                    <input class="form-control" type="text" placeholder=" User name" name="userName" id="userName">
                                </div>
                            </div>




                            <div class="form-group row">
                                <label for="example-password-input" class="col-2 col-form-label">Password<span class="text-danger">*</span></label>
                                <div class="col-10">
                                    <input class="form-control" type="password" placeholder="password" name="userPass" id="userPass">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="example-date-input" class="col-2 col-form-label">User created Date<span class="text-danger">*</span></label>
                                <div class="col-10">
                                    <input class="form-control" type="date" placeholder="2011-08-19" name="userCreatedDate" id="userCreatedDate">
                                </div>
                            </div>




                            <div class="form-group row">
                                <label for="example-tel-input" class="col-2 col-form-label">status<span class="text-danger">*</span></label>



                                <div class="col-10">
                                    <select class="form-control" id="userStatus" name="userStatus">
                                        <option value="">Please select</option>
                                        <option value="1">Activated</option>
                                        <option value="0">Deactivated</option>
                                    </select>
                                </div>

                            </div>


                            <div class="form-group row mb-0">
                                <div class="ml-lg-auto text-right">
                                    <button type="reset" id="userCancel" class="btn btn-secondary">Cancel</button>
                                    <button type="button" id="userSave" name="userSave" class="btn btn-success">Save </button>


                                </div>
                            </div>
                            <fieldset>
                    </form>

                </div> <!-- end of card body -->
            </div> <!-- end of card  -->

        </div>
    </div>





    <!-- data table -->
    <div class="card mt-3">
        <div class="card-header bg-light">
            <h5>User Detail List</h5>
        </div>

        <div class="card-body p-3 pt-0">

            <table class="table" id="userTbl">
                <thead class="thead-light text-dark">
                    <th scope="col">user id</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">User Name</th>
                    <th scope="col"> User created date</th>
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
    $(document).ready(function() {

        $.ajax({
            url: "handlers/userNew_handler.php?type=getUserCategory",
            method: "GET",
            success: function(data) {
                data = JSON.parse(data);
                data.forEach(row => { //db column name
                    $("#userCatDes").append("<option value='" + row.user_cat_id + "'>" + row.user_cat_des + "</option>");
                    //text box id
                });
            }
        });

    });




    $(document).ready(function() {



        $.validator.addMethod("regex", function(value, element, regexpr) {
            return regexpr.test(value);
        });

        datab();

        $("#userSave").click(function() {

            $("#userFrm").validate({
                rules: {

                    userCatDes: {
                        required: true,

                    },


                    userName: {
                        required: true,

                    },

                    userPass: {
                        required: true,
                        minlength: 4,
                        // maxlength: 10
                      



                    },
                    userCreatedDate: {
                        required: true,


                    },
                    userStatus: {
                        required: true,

                    }


                },
                messages: {
                    userCatDes: {
                        required: " user category required."
                    },

                    userName: {
                        required: "  user name required."
                    },

                    userPass: {
                        required: "Please enter password.",
                        // number: "Please provide valid format.",
                       
                    minlength:" must contain at least 4 characters.",
                        // maxlength:"Not greater than 10 characters."

                    },

                    userCreatedDate: {
                        required: "Please mention date",

                    },

                    userStatus: {
                        required: "Please mention status",


                    }


                }
            });

            if (!$("#userFrm").valid()) {
                return false;
            }

            data = new FormData($('#userFrm')[0]);

            $.ajax({
                    url: "handlers/userNew_handler.php?type=save",
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

                  
                    $("#userFrm").trigger("reset");  //to clear the form fields
                    datab();

                });

        });

    });



    function datab() {
        $('#userTbl').DataTable({
            serverSide: true, //Server-side processing in DataTables is enabled via this
            paging: true, //to disable paging for the table
            processing: true,
            // rowId: 'id', 
            ajax: //to specify the URL where DataTables should get its Ajax data from
            {
                url: 'handlers/userNew_handler.php?type=retrieve',
                type: 'POST'
            },
            pageLength: 10, //Number of rows to display on a single page when using pagination
            columns: [{
                    data: "user_id",
                    name: "user_id"
                }, //data-> data value coming from the backend name -> table fields
                {
                    data: "user_cat_id",
                    name: "user_cat_des"
                },
                {
                    data: "usr_name",
                    name: "usr_name"
                },
                {
                    data: "user_created_date",
                    name: "user_created_date"
                },
                {
                    data: "user_status",
                    name: "user_status"
                },

                {
                    data: "user_id",
                    name: "user_id"
                } // for option



            ],
            columnDefs: [{
                "targets": 5, //tells DataTables which column(s) the definition should be applied to
                "data": "user_id",
                "render": function(data, type, row, meta) {
                    // return '<button id="btnRemove" onclick="removeItem('+data+')">DEL</button> &nbsp <button id="btnEdit" onclick="editItem('+data+')">Edit</button> ';

                    return '<button id="btnEdit" class="btn-dtable-edit" onclick="editItem(' + data + ')"><i class="fa fa-edit"></i></button>&nbsp;<button  id="btnRemove" class="btn-dtable-delete" onclick="removeItem(' + data + ')"><i class="fa fa-trash-o"></i></button><button id="btnView" onclick = "viewItem(' + data + ')" class="btn-dtable-view"><i class="fas fa-envelope-open-text"></i></button>';

                }
            }],
            "bDestroy": true

        });
    }




    function removeItem(usr_code) {
        $.ajax({
                method: "POST",
                url: "handlers/userNew_handler.php?type=delete",
                //id        //user_id
                data: {
                    usr_code: usr_code
                }
            })
            .done(function(data) {
                $('#userTbl').DataTable().destroy();
                datab();
                // window.location.reload();
            });
    }



    function editItem(user_id) {
        console.log(user_id);

        $.ajax({
                method: "POST",
                url: "handlers/userNew_handler.php?type=loadEditForm",
                data: {
                    id: user_id
                }
            })
            .done(function(data) {
                data = JSON.parse(data);

                $("#mode").val("edit");
                $("#userId").val(data[0].user_id); //for id
                $("#userCatDes").val(data[0].user_cat_id);
                $("#userName").val(data[0].usr_name);
                $("#userPass").val(data[0].user_password);
                $("#userCreatedDate").val(data[0].user_created_date);

                $("#userStatus").val(data[0].user_status);

                // $('#empTbl').DataTable().destroy();
                // datab();
                // window.location.reload();
            });
    }





    //  for view       ///pass parameter
    function viewItem(userId) {
        console.log(userId);

        $('#ViewModal').modal('show');

        $.ajax({
                method: "POST",
                url: "handlers/userNew_handler.php?type=view",
                data: {
                    userId: userId
                },
            })

            .done(function(data) {
                // window.location.reload();

                console.log((data)[0]);

                data = JSON.parse(data)[0];

                console.log(data.userId);

                //txt box id in modal                 //db column name
                $('#userCategoryNameModal').html(data.user_cat_des);
                $('#userNameModal').html(data.usr_name);

                $('#userCreatedDateModal').html(data.user_created_date);


                $('#StatusModal').html(data.user_status);



            });

    }

</script>


<!-- modal for view -->
<div class="modal fade" id="ViewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">User detail </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>category Name</td>
                                <td>:&nbsp; <span id="userCategoryNameModal"></span></td>
                            </tr>
                            <tr>
                                <td>User Name</td>
                                <td>:&nbsp; <span id="userNameModal"></span></td>
                            </tr>
                            <tr>
                                <td>Created date</td>
                                <td>:&nbsp; <span id="userCreatedDateModal"></span></td>
                            </tr>


                            <tr>
                                <td>Status</td>
                                <td>:&nbsp; <span id="StatusModal"></span></td>
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
</div> <!-- end of raw -->










<?php require_once('incl/footer.php'); ?>
