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
				<li class="breadcrumb-item active" aria-current="page">Manufacturing Plant Configuration</li>
			</ol>
			</nav>

	  <h1 class="h3 mb-2 text-gray-800">Manufacturing Plant Configuration</h1>

        <div class="row">
            <div class="col-md-12" id="plantFrm">
                <div class="card">
                    <h5 class="card-header">Manufacturing Plant</h5>
                        <div class="card-body">
                            <form action="#" id="plantFrm">
								<fieldset>
								
                                        <input class="form-control" type="hidden"  name="plantNo"  id="plantNo">

                                         <div class="form-group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Manufacturing Plant name</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" placeholder=" plant name" id="plantName" name="plantName"> 
                                        </div>
                                        </div>

                                                    
                                        <!-- <div class="form-group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Plant location</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" placeholder=" plant location" id="example-text-input">
                                        </div>
                                        </div> -->

                                        <div class="form-group row">
                                        <label for="example-tel-input" class="col-2 col-form-label"> Manufacturing Plant contact no</label>
                                        <div class="col-10">
                                            <input class="form-control" type="tel" placeholder="" id="plantContactNo" name="plantContactNo" >
                                        </div>
                                        </div>


                                        <!-- <div class="form-group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Plant Size</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" placeholder=" plant length" id="example-text-input">
                                        </div>
                                        </div>
                                         -->
                                       <!-- 

                                        <div class="form-group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Plant width</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" placeholder=" plant width" id="example-text-input">
                                        </div>
                                        </div> -->

                                        <div class="form-group row">
                                        <label for="example-tel-input" class="col-2 col-form-label">status</label>
                                                              


                                                                <div class="col-10">
                                                                <select class="form-control"   id="plantStatus" name="plantStatus">
                                                                    <option value="1">occupied</option>
                                                                    <option value="0">avilable</option>
                                                                </select>
                                                                </div>
                                                                
                                        </div>

                                        <div class="form-group row">
                                        <label for="example-tel-input" class="col-2 col-form-label">Availability</label>
                                                              


                                                                <div class="col-10">
                                                                <select class="form-control"   id="plantAvailability" name="plantAvailability">
                                                                    <option value="1">occupied</option>
                                                                    <option value="0">avilable</option>
                                                                </select>
                                                                </div>
                                                                
                                        </div>

                                        <div class="form-group row mb-0">
                                        <div class="ml-lg-auto text-right">
                                                <button type="submit"  id="cancel" class="btn btn-secondary">Cancel</button>
                                                <button  onclick="saveManufacturingPlant()" id="savePlant"  id="savePlant"  class="btn btn-success">Save </button>
                                                

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
		<h5>Plant Detail List</h5>
	</div>

				<div class="card-body p-3 pt-0">
					
						<table class="table" id="plantTbl">
							<thead class="thead-light text-dark">

                            <th>Plant No</th>
                           <th>Plant name</th>
                            <th>Plant contact no</th>
                            <th>Status</th>
                            <th>Availability</th>
                            <th>Options</th>
							</thead>
							<tbody>
								

							</tbody>
						</table>
				
				</div>
</div>

		</div>  <!-- end of raw  -->






       

       

        <script>

                function saveManufacturingPlant(){
                            valid =$("#plantFrm").validate();
                            // valid =$("#saveUser").validate();

                                    if(valid){
                                    f = new FormData($("#plantFrm")[0]);
                                    $.ajax({
                                        method:"POST",
                                        url:"handlers/user_handler.php?type=addPlant",
                                        data: f,
                                        contentType: false,
                                        processData: false,
                                        
                                    })			
                                        .done(function(data){
                                        // window.location.reload();
                                    
                                    });
                                
                                }
                        
                        }



                        $(document).ready(function() {
                            $("#plantFrm").validate({ 
                            rules: {
                                plantName:{
                                required: true,
                                
                                },
                                plantContactNo:{
                                required: true,
                                
                                }
                                
                            },
                            });
                            
                        });



             function datab() {
                        $('#plantTbl').DataTable({
                            serverSide: true, //Server-side processing in DataTables is enabled via this
                            paging: true, //to disable paging for the table
                            processing: true,
                            // rowId: 'id', 
                            ajax: //to specify the URL where DataTables should get its Ajax data from
                            {
                                url: 'handlers/manufacturingPlant_handler.php?type=retrievePlant',
                                type:'POST'
                            },
                            pageLength: 10, //Number of rows to display on a single page when using pagination
                            columns:
                            [
                                //data-> data value coming from the backend name -> table fields
                                {data:"plant_no",name:"plant_no"}, 
                                {data:"plant_name",name:"plant_name"},
                                {data:"plant_contact_no",name:"plant_contact_no"},
                                {data:"plant_status",name:"plant_status"},
                                {data:"plant_availability",name:"plant_availability"},

                                {data:"plant_no",name:"plant_no"}  // last enty has no comma
                                                
                            
                            
                            ],
                            columnDefs: [{
                                "targets": 5, //tells DataTables which column(s) the definition should be applied to
                                "data": "plant_no",   // plant id according db  
                                "render": function(data, type, row, meta){
                                // return '<button id="btnRemove" onclick="removeItem('+data+')">DEL</button> &nbsp <button id="btnEdit" onclick="editItem('+data+')">Edit</button> ';
                                return '<button id="btnEdit" class="btn-dtable-edit" onclick="editItem('+data+')"><i class="fa fa-edit"></i></button>&nbsp;<button  id="btnRemove" class="btn-dtable-delete" onclick="removeItem('+data+')"><i class="fa fa-trash-o"></i></button>&nbsp; <button id="btnView" onclick = "viewItem('+data+')" class="btn-dtable-view"><i class="fas fa-envelope-open-text"></i></button>';
                           
                                // return '<button id="btnEdit" class="btn-dtable-edit" onclick="editItem('+data+')"><i class="fa fa-edit"></i></button>&nbsp;<button  id="btnRemove" class="btn-dtable-delete" onclick="removeItem('+data+')"><i class="fa fa-trash-o"></i></button>&nbsp; <button id="btnView" onclick = "viewItem('+data+')" class="btn-dtable-view"><i class="fas fa-envelope-open-text"></i></button>';

                            }
                        }]

                    });
            }
        //   );


          
      $(document).ready(function(){
            datab();
            // datab1();
        });


                                  //id
            function removeItem(plant_no){
              $.ajax({
                method:"POST",
                url:"handlers/user_handler1.php?type=deleteUser",
                        //id        //user_id
                data: {plant_no: plant_no}
              })
                    .done(function(data){
                        $('#plantTbl').DataTable().destroy();
                        datab();
                        // window.location.reload();





                    });


            }
                    

            function removeItem(plant_no){
              $.ajax({
                method:"POST",
                url:"handlers/user_handler1.php?type=deleteUser",
                        //id        //user_id
                data: {plant_no: plant_no}
              })
                    .done(function(data){
                        $('#plantTbl').DataTable().destroy();
                        datab();
                        // window.location.reload();





                    });


            }

</script>
	

    <?php require_once('incl/footer.php'); ?>