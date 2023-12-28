<?php
    require_once('incl/header_assistant.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

  





    <div class="card mt-3">
        <div class="card-header bg-light">
            <h5>Stock Details </h5>
        </div>

        <div class="card-body p-3 pt-0">

            <table class="table" id="customerTbl">
                <thead class="thead-light text-dark">

                   

                    <th scope="col">#</th>
                    <th scope="col">Product Code</th>
                    <th scope="col">Product Nanme</th>
                    <th scope="col">Available Qty</th>
                    <th scope="col">Actual Qty</th>

                  


                </thead>

                <tbody>


                </tbody>
            </table>

        </div>
    </div>





</div> <!-- end of raw  -->




<script>
   

    function datab() {
        $('#customerTbl').DataTable({

            // alert('test');
            serverSide: true, //Server-side processing in DataTables is enabled via this
            paging: true, //to disable paging for the table
            processing: true,
            // rowId: 'id', 
            ajax: //to specify the URL where DataTables should get its Ajax data from
            {
                url: 'handlers/stock-1-po_handler.php?type=retrieve',
                type: 'POST'
            },
            pageLength: 10, //Number of rows to display on a single page when using pagination
            columns: [{
                    data: "stock_id",
                    name: "stock_id"
                }, //data-> data value coming from the backend name -> table fields
                {
                    data: "pro_code",
                    name: "pro_code"
                },
                {
                    data: "pro_name",
                    name: "pro_name"
                },
                {
                    data: "available_qty",
                    name: "available_qty"
                },


                {
                    data: "actual_qty",
                    name: "actual_qty"
                } ,
               

                

            ],
            // columnDefs: [{
            //     "targets": 3, //tells DataTables which column(s) the definition should be applied to
            //     "data": "cus_id",
            //     "render": function(data, type, row, meta) {
            //         // return '<button id="btnRemove" onclick="removeItem('+data+')">DEL</button> &nbsp <button id="btnEdit" onclick="editItem('+data+')">Edit</button> ';
            //         return '<button id="btnEdit" class="btn-dtable-edit" onclick="editItem(' + data + ')"><i class="fa fa-edit"></i></button>&nbsp;<button  id="btnRemove" class="btn-dtable-delete" onclick="removeItem(' + data + ')"><i class="fa fa-trash-o"></i></button>';
                   
            //         // class="btn  btn-dtable-edit"><i class="far fa-edit">   <i class="fa fa-trash" aria-hidden="true"></i>
            //     }
            // }]

        });
    }




    $(document).ready(function() {
        // alert('jfhj');
        datab();
    });


   







</script>

<?php require_once('incl/footer.php'); ?>
