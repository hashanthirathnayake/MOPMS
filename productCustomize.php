<?php
    require_once('incl/header.php');
?>

<!-- Begin Page Content -->
    <div class="container-fluid">

			<!--breadcrumbs-->
			
			<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="admin_dash.php">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Product Configuration</li>
			</ol>
			</nav>

	    <h1 class="h3 mb-2 text-gray-800">Product Configuration</h1>
        <a href="order.php" id="link-k9_divisions">View Order <i class="fas fa-arrow-right"></i></a>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header-text">Product</h5>
                        <div class="card-body">
                            <form action="#" id="productFrm">
							              	<fieldset>
                          
                                          <input class="form-control" type="hidden"  name="productCode"  id="productCode">
                                        

                                             <div class="form-group row">
                                                <label for="example-text-input" class="col-2 col-form-label">Product Category Name</label>
                                                <div class="col-10">
                                                    <select class="form-control" id="productCatName" name="productCatName">
                                                    <!-- <option value="1">Admin</option>
                                                        <option value="0">Assistant</option>
                                                        <option value="2">user2</option>
                                                        <option value="3">user3</option> -->
                                                    </select>
                                                </div>
                                             </div>


                                             <div class="form-group row">
                                             <label for="example-text-input" class="col-2 col-form-label">Product name</label>
                                            <div class="col-10">
                                            <input class="form-control" type="text" placeholder=" Product name" id="productName" name="productName">
                                            </div>
                                            </div>


                                                          


                                                                                  
                                            <div class="form-group row">
                                            <label for="example-text-input" class="col-2 col-form-label">Product Description</label>
                                            <div class="col-10">
                                                <input class="form-control" type="text" placeholder=" Product Description" id="productDescription" name="productDescription">
                                            </div>
                                            </div>          


                                            <div class="form-group row">
                                            <label for="example-text-input" class="col-2 col-form-label">Unit price(Rs.)</label>
                                            <div class="col-10">
                                                <input class="form-control" type="text" placeholder="user category" id="productUnitPrice" name="productUnitPrice">
                                            </div>
                                            </div>

                                            <div class="form-group row">
                                            <label for="example-text-input" class="col-2 col-form-label">Wastage Percentage(%)</label>
                                            <div class="col-10">
                                                <input class="form-control" type="text" placeholder="wastage" id="productWastage" name="productWastage">
                                            </div>
                                            </div>


                                            <!-- <div class="form-group row">
                                            <label for="example-text-input" class="col-2 col-form-label">Product stock</label>
                                            <div class="col-10">
                                                <input class="form-control" type="text" placeholder="user category" id="productStock" name="productStock">
                                            </div>
                                            </div>   -->

                                            <div class="form-group row">
                                            <label for="example-tel-input" class="col-2 col-form-label">Product status</label>
                                                                

                                                                    <div class="col-10">
                                                                    <select class="form-control" id="productStatus" name="productStatus">
                                                                        <option value="1">Activated</option>
                                                                        <option value="0">Deactivated</option>
                                                                    </select>
                                                                    </div>
                                                                    
                                            </div>


                                                  <div class="form-group row mb-0">
                                                  <div class="ml-lg-auto text-right">
                                                          <button type="submit"  id="userCancel" class="btn btn-secondary">Cancel</button>
                                                          <button  type="button"  onclick="submitProduct()"  id="userSave" class="btn btn-success">Save </button>

                                            
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
            <div class="card-header">
            <!-- <div class="card-header bg-light"> -->
                <h5>Product Detail List</h5>
            </div>

				<div class="card-body p-3 pt-0">
					
						<table class="table" id="productTbl">
							<thead class="thead-light text-dark">
                                <th>Product code</th>
                                <th>Product name</th>
                                <th>Product des</th>
                                <th>unit price</th>
                                <!-- <th>Stock</th> -->
                                <th > Wastage percentage(%)</th>
                                <th > Status</th>
								<th >Option</th>
							</thead>
							<tbody>
								

							</tbody>
						</table>
				
				</div>
        </div>


</div>  <!-- end of raw  -->


                           
                  
 <script>          


            function submitProduct(){
                      // form id
            valid =$("#productFrm").validate();


            if(valid){                                // form id
                            f = new FormData($("#productFrm")[0]);
                            $.ajax({
                                method:"POST",
                                url:"handlers/productCustomize_handler.php?type=addProduct",
                                data: f,
                                contentType: false,
                                processData: false,
                                
                            })			
                                .done(function(data){
                                // window.location.reload();
                            
                            });

                    }

            }



              $(document).ready(function(){

                  $.ajax({
                      url : "handlers/productCustomize_handler.php?type=getProductCategory", 
                      method : "GET",
                      success : function(data){
                          data = JSON.parse(data);                    
                          data.forEach(row => {  
                                    //txt id                                        //db column name
                              $("#productCatName").append("<option value='"+row.pro_cat_code+"'>"+row.pro_cat_name+"</option>");
                            
                          });
                      }
                  }); 

              });

              $(document).ready(function() {
                $("#productFrm").validate({ 
                  rules: {
                    productName:{
                      required: true,
                      
                    },
                    productUnitPrice:{
                      required: true,
                      
                    }
                    
                  },
                });
                
              });


          function datab() {
            $('#productTbl').DataTable({
                    serverSide: true, //Server-side processing in DataTables is enabled via this
                    paging: true, //to disable paging for the table
                    processing: true,
                    // rowId: 'id', 
                    ajax: //to specify the URL where DataTables should get its Ajax data from
                    {
                        url: 'handlers/productCustomize_handler.php?type=retrieveProduct',
                        type:'POST'
                    },
                    pageLength: 10, //Number of rows to display on a single page when using pagination
                    columns:
                    [
                        //data-> data value coming from the backend name -> table fields
                        {data:"pro_code",name:"pro_code"}, 
                        // {data:"pro_cat_code",name:"pro_cat_code"},

                        {data:"pro_name",name:"pro_name"},
                        {data:"pro_des",name:"pro_des"},

                        {data:"pro_unit_price",name:"pro_unit_price"}, 
                        // {data:"pro_stock",name:"pro_stock"},

                                // {data:"pro_image",name:"pro_image"},
                        {data:"pro_wastage",name:"pro_wastage"}, 

                        {data:"pro_status",name:"pro_status"},



                    
                        {data:"pro_code",name:"pro_code"}     // for option
                    
                     
                
                    ],
                    columnDefs: [{
                        "targets": 6, //tells DataTables which column(s) the definition should be applied to
                        "data": "pro_code",
                        "render": function(data, type, row, meta){
                            // return '<button id="btnRemove" onclick="removeItem('+data+')">DEL</button> &nbsp <button id="btnEdit" onclick="editItem('+data+')">Edit</button> ';
                            return '<button id="btnEdit" class="btn-dtable-edit" onclick="editItem('+data+')"><i class="fa fa-edit"></i></button>&nbsp;<button  id="btnRemove" class="btn-dtable-delete" onclick="removeItem('+data+')"><i class="fa fa-trash-o"></i></button>';
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


                                //   id
            function removeItem(pro_code){
              $.ajax({
                method:"POST",
                url:"handlers/productCustomize_handler.php?type=deleteProduct",
                        //id        //user_id
                data: {pro_code: pro_code}
              })
              .done(function(data){
                $('#productTbl').DataTable().destroy();
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
