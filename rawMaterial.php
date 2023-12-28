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

	  <h1 class="h3 mb-2 text-gray-800">Raw Material  Configuration</h1>

        <div class="row">
            <div class="col-md-12" >
                <div class="card">
                    <h5 class="card-header">Raw Material </h5>
                        <div class="card-body">
                            <form action="#" id="rawMaterialFrm">
								<fieldset>
								
                                <input class="form-control" type="hidden"  name="rawMatId"  id="rawMatId">

                                         <div class="form-group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Raw Material Name</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" placeholder="Material name" id="rawMatName"  name="rawMatName">
                                        </div>
                                        </div>

                                                    
                                    

                                        <div class="form-group row">
                                            <label for="example-tel-input" class="col-2 col-form-label"> Description</label>
                                            <div class="col-10">
                                                <!-- <input class="form-control" type="tel" placeholder="" id="example-tel-input"> -->
                                                <textarea class="form-control" placeholder="description" id="rawMatDes" name="rawMatDes" ></textarea>
                                            </div>


                                      
                                        </div>


                                     

                                        <div class="form-group row">
                                        <label for="example-tel-input" class="col-2 col-form-label">Measurement</label>
                                                                <!-- <label>product category Status</label> -->


                                                                <div class="col-10">
                                                                <select class="form-control"   placeholder="description" id="rawMatMsrmnt" name="rawMatMsrmnt">
                                                                    <option value="1">Cube</option>
                                                                    <option value="0">Bags</option>
                                                                </select>
                                                                </div>
                                                                
                                        </div>
                                        <!-- <div class="form-group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Stock</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" placeholder="stock qty" id="rawMatStock" name="rawMatStock">
                                        </div>
                                        </div> -->

                                        
                                        <div class="form-group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Reorder quantity</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" placeholder="Reorder Qty" id="rawMatReorderQty" name="rawMatReorderQty">
                                        </div>
                                        </div>

                                               
                                        <div class="form-group row">
                                                  <label for="example-tel-input" class="col-2 col-form-label">status</label>
                                                  


                                                  <div class="col-10">
                                                  <select class="form-control" id="rawMatStatus" name="rawMatStatus">
                                                      <option value="1">Activated</option>
                                                      <option value="0">Deactivated</option>
                                                  </select>
                                                  </div>
                                                  
                                              </div>  

                                        <div class="form-group row mb-0">
                                        <div class="ml-lg-auto text-right">
                                                <button type="submit"  id="cancel" class="btn btn-secondary">Cancel</button>
                                                <button type="button" onclick="submitRawMaterial()" id="rawMatSave" name="rawMatSave" class="btn btn-success">Save </button>
                                                

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
                            <h5>Raw Material List</h5>
                        </div>

                        <div class="card-body p-3 pt-0">
                            
                                <table class="table" id="rawMatTbl">
                                    <thead class="thead-light text-dark">
                                        <th scope="col">#</th>
                                        <th scope="col">Raw Material</th>
                                        <th scope="col"> Description </th>
                                        <th scope="col"> Measurment</th>
                                        <!-- <th scope="col"> Stock</th> -->
                                        <th scope="col"> Re order Qty</th>
                                        <th scope="col">Status</th>
                                        
                                        <th scope="col">Option</th>
                                    </thead>
                                    <tbody>
                                        

                                    </tbody>
                                </table>
                        
                        </div>
             </div>


	</div>  <!-- end of raw  -->







                
<script>          


            function submitRawMaterial(){
          // form id
            valid =$("#rawMaterialFrm").validate();


            if(valid){                                // form id
                            f = new FormData($("#rawMaterialFrm")[0]);
                        $.ajax({
                            method:"POST",
                            url:"handlers/rawMaterial_handler.php?type=addRawMaterial",
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
                        $("#rawMaterialFrm").validate({ 
                        rules: {
                            rawMatName:{
                            required: true,
                            
                            },
                            rawMatDes:{
                            required: true,
                            
                            },
                            rawMatMsrmnt:{
                            required: true,
                            
                            },
                         
                            rawMatReorderQty:{
                            required: true,
                            
                            }
                            
                        },
                        });
                        
                    });


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
                        // {data:"raw_mat_stock",name:"raw_mat_stock"},
                        {data:"raw_mat_reorder_qty",name:"raw_mat_reorder_qty"},
                        {data:"raw_mat_status",name:"raw_mat_status"},
                      
                    
                    
                        {data:"raw_mat_id",name:"raw_mat_id"}     // for option
                    
                    
                
                    ],
                    columnDefs: [{
                        "targets": 6, //tells DataTables which column(s) the definition should be applied to
                        "data": "raw_mat_id",
                        "render": function(data, type, row, meta){
                            // return '<button id="btnRemove" onclick="removeItem('+data+')">DEL</button> &nbsp <button id="btnEdit" onclick="editItem('+data+')">Edit</button> ';
                           //previous
                            // return '<button id="btnEdit" class="btn-dtable-edit" onclick="editItem('+data+')"><i class="fa fa-edit"></i></button>&nbsp;<button  id="btnRemove" class="btn-dtable-delete" onclick="removeItem('+data+')"><i class="fa fa-trash-o"></i></button>';
                           
                            return '<button id="btnEdit" class="btn-dtable-edit" onclick="editItem('+data+')"><i class="fa fa-edit"></i></button>&nbsp;<button  id="btnRemove" class="btn-dtable-delete" onclick="removeItem('+data+')"><i class="fa fa-trash-o"></i></button>&nbsp; <button id="btnView" onclick = "viewItem('+data+')" class="btn-dtable-view"><i class="fas fa-envelope-open-text"></i></button>';
                           
                            // return '<button id="btnRemove" onclick="removeItem('+data+')"> <i class="far fa-trash-alt"></i></button>&nbsp <button id="btnEdit" onclick="editItem('+data+')">class="btn  btn-dtable-edit"><i class="far fa-edit"></i></button> ';
                        
                            // return '<button id="btnRemove" onclick="removeItem('+data+')"> <i class="fa fa-trash-0" style="font-size:24px;color:orange"></i></button>&nbsp <button id="btnEdit" onclick="editItem('+data+')"><i class="fa fa-edit" style="font-size:24px;color:blue"></i></button> ';
                            // class="btn  btn-dtable-edit"><i class="far fa-edit">   <i class="fa fa-trash" aria-hidden="true"></i>
                        }
                    }]

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