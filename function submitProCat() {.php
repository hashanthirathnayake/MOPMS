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