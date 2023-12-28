<?php
    require_once('incl/header.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!--breadcrumbs-->

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="admin_dash.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product Category Configuration</li>
        </ol>
    </nav>

    <h1 class="h3 mb-2 text-gray-800">Product Category Configuration</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Product Category </h5>
                <div class="card-body">
                    <form action="#" id="productCategoryFrm">
                        <fieldset>
                            <input class="form-control" type="hidden" name="productCatCode" id="productCatCode" />
                            <input class="form-control" type="hidden" name="mode" id="mode" value="add" />

                            <div class="form-group row">
                                <label for="example-text-input" class="col-2 col-form-label">Product Category Name</label>
                                <div class="col-10">
                                    <input class="form-control" type="text" placeholder=" Product Category name" id="productCatName" name="productCatName">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="example-tel-input" class="col-2 col-form-label">Product Category status</label>
                                <!-- <label>product category Status</label> -->


                                <div class="col-10">
                                    <select class="form-control" id="productCatStatus" name="productCatStatus">
                                        <option value="1">Activated</option>
                                        <option value="0">Inactivated</option>
                                    </select>
                                </div>

                            </div>


                            <div class="form-group row mb-0">
                                <div class="ml-lg-auto text-right">
                                    <button type="submit" id="proCatCancel" class="btn btn-secondary">Cancel</button>
                                    <button type="button" onclick="submitProCat()" id="proCatSave" name="proCatSave" class="btn btn-success">Save </button>


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
            <h5>Product Category Detail List</h5>
        </div>

        <div class="card-body p-3 pt-0">

            <table class="table" id="productCatTbl">
                <thead class="thead-light text-dark">

                    <th scope="col">Product Category Code</th>

                    <th scope="col">Product CategoryName</th>
                    <th scope="col">Product Category Status</th>
                    <th scope="col">Option</th>


                </thead>

                <tbody>


                </tbody>
            </table>

        </div>
    </div>










</div> <!-- end of raw  -->









<script>
    function submitProCat() {
        // form id
        valid = $("#productCategoryFrm").validate();

        if (valid) { // form id
            var f = new FormData($("#productCategoryFrm")[0]);
            console.log(f);
            $.ajax({
                    method: "POST",
                    url: "handlers/product_cat_handler.php?type=saveProductCategory",
                    data: f,
                    contentType: false,
                    processData: false,

                })
                .done(function(data) {
                    window.location.reload();
                });

        }

    }






    function datab() {
        $('#productCatTbl').DataTable({
            serverSide: true, //Server-side processing in DataTables is enabled via this
            paging: true, //to disable paging for the table
            processing: true,
            // rowId: 'id', 
            ajax: //to specify the URL where DataTables should get its Ajax data from
            {
                url: 'handlers/product_cat_handler.php?type=retrieveProductCategory',
                type: 'POST'
            },
            pageLength: 10, //Number of rows to display on a single page when using pagination
            columns: [{
                    data: "pro_cat_code",
                    name: "pro_cat_code"
                }, //data-> data value coming from the backend name -> table fields
                {
                    data: "pro_cat_name",
                    name: "pro_cat_name"
                },
                {
                    data: "pro_cat_status",
                    name: "pro_cat_status"
                },


                {
                    data: "pro_cat_code",
                    name: "pro_cat_code"
                } // for option




            ],
            columnDefs: [{
                "targets": 3, //tells DataTables which column(s) the definition should be applied to
                "data": "pro_cat_code",
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
    function removeItem(pro_cat_code) {
        $.ajax({
                method: "POST",
                url: "handlers/product_cat_handler.php?type=deleteProductCategory",
                //id        //user_id
                data: {
                    pro_cat_code: pro_cat_code
                }
            })
            .done(function(data) {
                $('#productCatTbl').DataTable().destroy();
                datab();
                // window.location.reload();
            });
    }






    function editItem(pro_cat_code) {
        console.log(pro_cat_code);

        $.ajax({
                method: "POST",
                url: "handlers/product_cat_handler.php?type=loadEditForm",
                data: {
                    id: pro_cat_code
                }
            })
            .done(function(data) {
                data = JSON.parse(data);

                $("#mode").val("edit");
                $("#productCatCode").val(data[0].pro_cat_code);
                $("#productCatName").val(data[0].pro_cat_name);
                $("#productCatStatus").val(data[0].pro_cat_status);


                // $('#empTbl').DataTable().destroy();
                // datab();
                // window.location.reload();
            });
    }

</script>

<?php require_once('incl/footer.php'); ?>
