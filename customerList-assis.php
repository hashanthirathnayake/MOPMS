<?php
    require_once('incl/header_assistant.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

  





    <div class="card mt-3">
        <div class="card-header bg-light">
            <h5>Customer Detail List</h5>
        </div>

        <div class="card-body p-3 pt-0">

            <table class="table" id="customerTbl">
                <thead class="thead-light text-dark">

                    <th scope="col">#</th>    <!-- cus id -->

                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">NIC</th>
                    <th scope="col">Address</th>

                    
                    <th scope="col">City</th>
                    <th scope="col">Phone No</th>
                    <th scope="col">WhatsAp No</th>

                    
                    <th scope="col">Email</th>

                    <!-- <th scope="col">Option</th> -->


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
            serverSide: true, //Server-side processing in DataTables is enabled via this
            paging: true, //to disable paging for the table
            processing: true,
            // rowId: 'id', 
            ajax: //to specify the URL where DataTables should get its Ajax data from
            {
                url: 'handlers/customerList-assis_handler.php?type=retrieve',
                type: 'POST'
            },
            pageLength: 10, //Number of rows to display on a single page when using pagination
            columns: [{
                    data: "cus_id",
                    name: "cus_id"
                }, //data-> data value coming from the backend name -> table fields
                {
                    data: "cus_fname",
                    name: "cus_fname"
                },
                {
                    data: "cus_lname",
                    name: "cus_lname"
                },


                {
                    data: "cus_nic",
                    name: "cus_nic"
                } ,
                {
                    data: "cus_address",
                    name: "cus_address"
                },
                {
                    data: "cus_city",
                    name: "cus_city"
                },
                {
                    data: "cus_phone_no",
                    name: "cus_phone_no"
                },
                {
                    data: "cus_whatsap_no",
                    name: "cus_whatsap_no"
                },
                {
                    data: "cus_email",
                    name: "cus_email"
                },




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
        datab();
    });


   







</script>

<?php require_once('incl/footer.php'); ?>
