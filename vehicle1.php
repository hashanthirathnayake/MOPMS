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
				<li class="breadcrumb-item active" aria-current="page">Vehicle Configuration</li>
			</ol>
			</nav>

	    <h1 class="h3 mb-2 text-gray-800">Vehicle Configuration</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header">Vehicle</h5>
                        <div class="card-body">
                            <form action="#" id="vehicleFrm">
							              	<fieldset>
                          
                                          <input class="form-control" type="hidden"  name="vehId"  id="vehId">
                                          
                                          <!-- <input class="form-control" type="hidden" name="productCatCode" id="productCatCode" /> -->
                                         <input class="form-control" type="hidden" name="mode" id="mode" value="add" />

                                          <div class="form-group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Vehicle Number</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" placeholder="Vehicle number" id="vehNo" name="vehNo" >
                                        </div>
                                        </div>

                                                    
                                        <!-- <div class="form-group row">
                                             <label for="example-tel-input" class="col-2 col-form-label">Vehicle Type </label>
                                                   	
                                                    <div class="col-10">										
                                                            <select id="vehType"  name="vehType"  class="form-control">
                                                                <option value="">Please select</option>  
                                                                <option value="1">Truck</option>  
                                                                <option value="2">Single Cab</option> 
                                                                <option value="3">other</option> 

                                                               
                                                            </select>
                                                    </div>       
                                        </div> -->
                                        <div class="form-group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Vehicle Type</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" placeholder="Truck,Single cab ,Other " id="vehType" name="vehType">
                                        </div>
                                        </div>


                
                                        <!-- <div class="form-group row">
                                             <label for="example-tel-input" class="col-2 col-form-label">Vehicle Brand </label>
                                                   	
                                                    <div class="col-10">										
                                                            <select  name="vehBrand" id="vehBrand" class="form-control">
                                                                <option value="">Please select</option>  
                                                                <option value="1">Mitsubishi</option>  
                                                                <option value="2">Toyota</option> 
                                                                <option value="3">Isuzu</option> 
                                                                <option value="4">Ashok Leyland</option> 
                                                                <option value="5">other</option> 

                                                            </select>
                                                    </div>       
                                        </div> -->
                                        <div class="form-group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Vehicle Brand</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" placeholder="Toyota,Isuzu, Ashok Leyland,other " id="vehBrand" name="vehBrand">
                                        </div>
                                        </div>


                                        <div class="form-group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Vehicle Color</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" placeholder="color " id="vehColor" name="vehColor">
                                        </div>
                                        </div>

                                      
                                        <div class="form-group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Year</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" placeholder="Year " id="vehYear" name="vehYear">
                                        </div>
                                        </div>
                                        
                                                                    
                                        <div class="form-group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Engine Capacity</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" placeholder="XXXX CC " id="vehEngCapa" name="vehEngCapa" >
                                        </div>
                                        </div>

                                      
                                        <!-- <div class="form-group row">
                                        <label for="example-tel-input" class="col-2 col-form-label"> veh status</label>
                                                               
                                                               <div class="col-10">
                                                                <select class="form-control" id="status" name="status">
                                                                    <option value="1">Activated</option>
                                                                    <option value="0">Deactivated</option>
                                                                </select>
                                                                </div>
                                                               
                                        </div> -->

                                       

                                        <div class="form-group row">
                                        <label for="example-tel-input" class="col-2 col-form-label">status</label>
                                                              


                                                                <div class="col-10">
                                                                <select class="form-control"   id="vehStatus" name="vehStatus">
                                                                    <option value="1">Active</option>
                                                                    <option value="0">Inactive</option>
                                                                </select>
                                                                </div>
                                                                
                                        </div>

                                        <!-- <div class="form-group row">
                                        <label for="example-tel-input" class="col-2 col-form-label">Availability</label>
                                                              


                                                                <div class="col-10">
                                                                <select class="form-control"   id="vehAvailability" name="vehAvailability">
                                                                    <option value="1">Available</option>
                                                                    <option value="0">Occupied</option>
                                                                </select>
                                                                </div>
                                                                 -->
                                        <!-- </div> -->

                                        <div class="form-group row mb-0">
                                        <div class="ml-lg-auto text-right">
                                                <button type="submit"  id="vehicleCancel" name="vehicleCancel" class="btn btn-secondary">Cancel</button>
                                                <button  type="button" onclick="submitVehicle()" id="vehicleSave"   name="vehicleSave" class="btn btn-success">Save </button>
                                              

                                        </div>
                                        </div>

				                         <fieldset>
							</form>
                            
                		</div>    <!-- end of card body -->
           		 	</div>   <!-- end of card  -->

        		</div>
    		</div>
	




     <!-- data table -->
     <div class="card mt-3">
	<div class="card-header bg-light">
		<h5>Vehicle Detail List</h5>
	</div>

				<div class="card-body p-3 pt-0">
					
						<table class="table" id="vehicleTbl">
							<thead class="thead-light text-dark">
								<th scope="col">#</th>
								<th scope="col">Vehicle No</th>
								<th scope="col">Type</th>
                                <th scope="col"> Brand</th>

                                <th scope="col">Color</th>
							
                                <th scope="col">Year</th>
								<th scope="col"> Eng Capacity</th>

                                <th scope="col"> Status</th>
                                <!-- <th scope="col">Availability</th> -->
								

								 <th scope="col">Option</th>   <!--  15 -->
							</thead>
							<tbody>
								

							</tbody>
						</table>
				
				</div>
</div>


</div>  <!-- end of raw  -->


                           
                  
 <script>          


           
            function submitVehicle() {
                    // form id
                    valid = $("#vehicleFrm").validate();

                    if (valid) { // form id
                        var f = new FormData($("#vehicleFrm")[0]);
                        console.log(f);
                        $.ajax({
                                method: "POST",
                                url:"handlers/vehicle1_handler.php?type=saveVehicle",
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
            $('#vehicleTbl').DataTable({
                    serverSide: true, //Server-side processing in DataTables is enabled via this
                    paging: true, //to disable paging for the table
                    processing: true,
                    // rowId: 'id', 
                    ajax: //to specify the URL where DataTables should get its Ajax data from
                    {
                        url: 'handlers/vehicle1_handler.php?type=retrieveVehicle',
                        type:'POST'
                    },
                    pageLength: 10, //Number of rows to display on a single page when using pagination
                    columns:
                    [     //data-> data value coming from the backend name -> table fields
                        {data:"veh_id",name:"veh_id"}, 
                        {data:"veh_no",name:"veh_no"},
                        {data:"veh_type",name:"veh_type"},
                        {data:"veh_brand",name:"veh_brand"},

                        {data:"veh_color",name:"veh_color"}, //data-> data value coming from the backend name -> table fields
                        {data:"veh_year",name:"veh_year"},
                                                   
                        {data:"veh_eng_capa",name:"veh_eng_capa"},

                        {data:"veh_status",name:"veh_status"},
                        // {data:"veh_availability",name:"veh_availability"},
                       
                    
                        {data:"veh_id",name:"veh_id"}     //    10    for option
                    
                     
                
                    ],
                    columnDefs: [{
                        "targets": 8, //tells DataTables which column(s) the definition should be applied to
                        "data": "veh_id",
                        "render": function(data, type, row, meta){
                            // return '<button id="btnRemove" onclick="removeItem('+data+')">DEL</button> &nbsp <button id="btnEdit" onclick="editItem('+data+')">Edit</button> ';
                           
                            // return '<button id="btnRemove" onclick="removeItem('+data+')"> <i class="far fa-trash-alt"></i></button>&nbsp <button id="btnEdit" onclick="editItem('+data+')">class="btn  btn-dtable-edit"><i class="far fa-edit"></i></button> ';
                            // return '<button id="btnEdit" class="btn-dtable-edit" onclick="editItem('+data+')"><i class="fa fa-edit"></i></button>&nbsp;<button  id="btnRemove" class="btn-dtable-delete" onclick="removeItem('+data+')"><i class="fa fa-trash-o"></i></button>';
                            return '<button id="btnEdit" class="btn-dtable-edit" onclick="editItem('+data+')"><i class="fa fa-edit"></i></button>&nbsp;<button  id="btnRemove" class="btn-dtable-delete" onclick="removeItem('+data+')"><i class="fa fa-trash-o"></i></button>&nbsp; <button id="btnView" onclick = "viewItem('+data+')" class="btn-dtable-view"><i class="fas fa-envelope-open-text"></i></button>';

                            
                            // return '<button id="btnRemove" onclick="removeItem('+data+')"> <i class="fa fa-trash-0" style="font-size:24px;color:orange"></i></button>&nbsp <button id="btnEdit" onclick="editItem('+data+')"><i class="fa fa-edit" style="font-size:24px;color:blue"></i></button> ';
                            // class="btn  btn-dtable-edit"><i class="far fa-edit">   <i class="fa fa-trash" aria-hidden="true"></i>
                        }
                    }]

                  });
          }


             

      $(document).ready(function(){
            datab();
        });


          

            function removeItem(veh_id) {
        $.ajax({
                method: "POST",
                url:"handlers/vehicle1_handler.php?type=deleteVehicle",
                //id        //user_id
                data: {
                    veh_id: veh_id
                }
            })
            .done(function(data) {
                $('#vehicleTbl').DataTable().destroy();
                datab();
                // window.location.reload();
            });
    }



//    //id
//    function removeItem(pro_cat_code) {
//         $.ajax({
//                 method: "POST",
//                 url: "handlers/product_cat_handler.php?type=deleteProductCategory",
//                 //id        //user_id
//                 data: {
//                     pro_cat_code: pro_cat_code
//                 }
//             })
//             .done(function(data) {
//                 $('#productCatTbl').DataTable().destroy();
//                 datab();
//                 // window.location.reload();
//             });
//     }



    function editItem(veh_id) {
        console.log(veh_id);

        $.ajax({
                method: "POST",
                url: "handlers/vehicle1_handler.php?type=loadEditForm",
                data: {
                    id: veh_id
                }
            })
            .done(function(data) {
                data = JSON.parse(data);

                $("#mode").val("edit");
                $("#vehId").val(data[0].veh_id);
                $("#vehNo").val(data[0].veh_no);
                $("#vehType").val(data[0].veh_type);
                $("#vehBrand").val(data[0].veh_brand);
                $("#vehColor").val(data[0].veh_color);
                $("#vehYear").val(data[0].veh_year);
                $("#vehEngCapa").val(data[0].veh_eng_capa);
                $("#vehStatus").val(data[0].veh_status);
                                
                                   
                                
                                        
              // $('#empTbl').DataTable().destroy();
                // datab();
                // window.location.reload();
            });
    }



        //     function editUser(user_id){
        // // var location = "http://localhost/projectNew/k9.php?divId="+div_id;
        //         window.location.replace(location);
        //     }

    
 
 </script>
       
	

    <?php require_once('incl/footer.php'); ?>
