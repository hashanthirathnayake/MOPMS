<?php
    require_once('incl/header.php');
?>

<!-- Begin Page Content -->
    <div class="container-fluid">

			<!--breadcrumbs-->
			
			<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="admin_dash.php">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Vehicle List</li>
			</ol>
			</nav>
                <div class="card mt-3">
                        <div class="card-header bg-light">
                            <h5>Vehicle Detail List</h5>
                        </div>

                            <div class="card-body p-3 pt-0">
                    
                                <table class="table" id="vehicleDetailTbl">
                                    <thead class="thead-light text-dark">
                                    <th scope="col">#</th>
                                    <th scope="col">Vehicle No</th>
                                    <th scope="col">Type</th>
                                    <th scope="col"> Brand</th>

                                    <th scope="col">Color</th>
                                
                                    <th scope="col">Year</th>
                                    <th scope="col"> Eng Capacity</th>

                                    <th scope="col"> Status</th>
                                    <th scope="col">Availability</th>
                                
                                    </thead>

                                    <tbody>
                                        

                                    </tbody>
                                </table>
                
                            </div>
                </div>


		</div>  <!-- end of raw  -->
     
                 
        

<script>          


function datab() {
$('#vehicleDetailTbl').DataTable({
        serverSide: true, //Server-side processing in DataTables is enabled via this
        paging: true, //to disable paging for the table
        processing: true,
        // rowId: 'id', 
        ajax: //to specify the URL where DataTables should get its Ajax data from
        {
            url: 'handlers/vehicle_list_handler.php?type=retrieveVehicleList',
            type:'POST'
        },
        pageLength: 10, //Number of rows to display on a single page when using pagination
        columns:
        [
                         {data:"veh_id",name:"veh_id"}, 
                        {data:"veh_no",name:"veh_no"},
                        {data:"veh_type",name:"veh_type"},
                        {data:"veh_brand",name:"veh_brand"},

                        {data:"veh_color",name:"veh_color"}, //data-> data value coming from the backend name -> table fields
                        {data:"veh_year",name:"veh_year"},
                                                   
                        {data:"veh_eng_capa",name:"veh_eng_capa"},

                        {data:"veh_status",name:"veh_status"},
                        {data:"veh_availability",name:"veh_availability"}
           

                   
    
        ]
        // columnDefs: [{
        //     "targets": 3, //tells DataTables which column(s) the definition should be applied to
        //     "data": "pro_cat_code",
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


 

</script>

    <?php require_once('incl/footer.php'); ?>