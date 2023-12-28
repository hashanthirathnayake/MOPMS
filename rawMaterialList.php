<?php
    require_once('incl/header.php');
?>

     <!-- Begin Page Content -->
    <div class="container-fluid">

			<!--breadcrumbs-->
			
			<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="admin_dash.php">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Raw Material  Configuration</li>
			</ol>
			</nav>

	            
            <!-- data table -->
            <div class="card mt-3">
                        <div class="card-header bg-light">
                            <h5>Raw Material List</h5>
                        </div>

                        <div class="card-body p-3 pt-0">
                            
                                <table class="table" id="rawMatTbl">
                                    <thead class="thead-light text-dark">
                                        <th scope="col">#</th>
                                        <th scope="col">Raw Material</th>
                                        <th scope="col"> Description </th>
                                        <th scope="col"> Measurment</th>
                                        <th scope="col"> Stock</th>
                                        <th scope="col"> Re order Qty</th>
                                        <th scope="col">Status</th>
                                        
                                        <!-- <th scope="col">Option</th> -->
                                    </thead>
                                    <tbody>
                                        

                                    </tbody>
                                </table>
                        
                        </div>
             </div>


	</div>  <!-- end of raw  -->







                
<script>          

           function datab() {
            $('#rawMatTbl').DataTable({
                    serverSide: true, //Server-side processing in DataTables is enabled via this
                    paging: true, //to disable paging for the table
                    processing: true,
                    // rowId: 'id', 
                    ajax: //to specify the URL where DataTables should get its Ajax data from
                    {
                        url: 'handlers/rawMaterial_handler.php?type=retrieveRawMaterial',
                        type:'POST'
                    },
                    pageLength: 10, //Number of rows to display on a single page when using pagination
                    columns:
                    [
                        {data:"raw_mat_id",name:"raw_mat_id"}, //data-> data value coming from the backend name -> table fields
                       
                        {data:"raw_mat_name",name:"raw_mat_name"},
                        {data:"raw_mat_des",name:"raw_mat_des"},
                        {data:"raw_mat_msrmnt",name:"raw_mat_msrmnt"},
                        {data:"raw_mat_stock",name:"raw_mat_stock"},
                        {data:"raw_mat_reorder_qty",name:"raw_mat_reorder_qty"},
                        {data:"raw_mat_status",name:"raw_mat_status"},
                      
                    
                    
                        // {data:"raw_mat_id",name:"raw_mat_id"}     // for option
                    
                    
                
                    ],
                    // columnDefs: [{
                    //     "targets": 7, //tells DataTables which column(s) the definition should be applied to
                    //     "data": "raw_mat_id",
                    //     "render": function(data, type, row, meta){
                    //         return '<button id="btnRemove" onclick="removeItem('+data+')">DEL</button> &nbsp <button id="btnEdit" onclick="editItem('+data+')">Edit</button> ';
                    //         // return '<button id="btnRemove" onclick="removeItem('+data+')"> <i class="far fa-trash-alt"></i></button>&nbsp <button id="btnEdit" onclick="editItem('+data+')">class="btn  btn-dtable-edit"><i class="far fa-edit"></i></button> ';
                        
                    //         // return '<button id="btnRemove" onclick="removeItem('+data+')"> <i class="fa fa-trash-0" style="font-size:24px;color:orange"></i></button>&nbsp <button id="btnEdit" onclick="editItem('+data+')"><i class="fa fa-edit" style="font-size:24px;color:blue"></i></button> ';
                    //         // class="btn  btn-dtable-edit"><i class="far fa-edit">   <i class="fa fa-trash" aria-hidden="true"></i>
                    //     }
                    // }]

                });
            }


 

                $(document).ready(function(){
                datab();
                });


                                    //id
                function removeItem(raw_mat_id){
                $.ajax({
                    method:"POST",
                    url:"handlers/rawMaterial_handler.php?type=deleteRawMaterial",
                            //id        //user_id
                    data: {raw_mat_id: raw_mat_id}
                })
                .done(function(data){
                    $('#rawMatTbl').DataTable().destroy();
                    datab();
                    // window.location.reload();
                });
                }



                //     function editUser(user_id){
                // // var location = "http://localhost/projectNew/k9.php?divId="+div_id;
                //         window.location.replace(location);
                //     }



</script>

	

    <?php require_once('incl/footer.php'); ?>