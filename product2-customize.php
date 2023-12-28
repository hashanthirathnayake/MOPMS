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
				<li class="breadcrumb-item active" aria-current="page">Product Configuration</li>
			</ol>
			</nav>

	    <h1 class="h3 mb-2 text-gray-800">Product Configuration</h1>
       

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header-text">Product</h5>
                        <div class="card-body">
                            <form action="#" id="productFrm">
							              	<fieldset>
                          
                                          <input class="form-control" type="hidden"  name="productCode"  id="productCode">
                                          <input class="form-control" type="hidden" name="mode" id="mode" value="add" />

                                             <div class="form-group row">
                                                <label for="example-text-input" class="col-2 col-form-label">Product Category Name<span class="text-danger">*</span></label>
                                                <div class="col-10">
                                                    <select class="form-control" id="productCatName" name="productCatName">
                                                    <option value="">Please select</option> 
                                                    </select>


                                                   
                                                </div>
                                             </div>


                                             <div class="form-group row">
                                             <label for="example-text-input" class="col-2 col-form-label">Product name<span class="text-danger">*</span></label>
                                            <div class="col-10">
                                            <input class="form-control" type="text" placeholder=" Product name" id="productName" name="productName">
                                            </div>
                                            </div>

                                            <!-- <div class="form-group row">
                                                <label for="example-text-input" class="col-2 col-form-label">Product Type</label>
                                                <div class="col-10">
                                               


                                                        <input class="form-control" type="text" placeholder=" " id="productType" name="productType">
                                                </div>
                                             </div> -->
                                                          


                                                                                  
                                            <div class="form-group row">
                                            <label for="example-text-input" class="col-2 col-form-label">Product Description<span class="text-danger">*</span></label>
                                            <div class="col-10">
                                                <input class="form-control" type="text" placeholder=" Product Description" id="productDescription" name="productDescription">
                                            </div>
                                            </div>          


                                            <div class="form-group row">
                                            <label for="example-text-input" class="col-2 col-form-label">Unit price(Rs.)<span class="text-danger">*</span></label>
                                            <div class="col-10">
                                                <input class="form-control" type="text" placeholder="price" id="productUnitPrice" name="productUnitPrice">
                                            </div>
                                            </div>

                                            <div class="form-group row">
                                            <label for="example-text-input" class="col-2 col-form-label">Wastage Percentage(%)<span class="text-danger">*</span></label>
                                            <div class="col-10">
                                                <input class="form-control" type="text" placeholder="wastage" id="productWastage" name="productWastage">
                                            </div>
                                            </div>


                                           

                                            

                                            <div class="form-group row">
                                            <label for="example-tel-input" class="col-2 col-form-label">Product status</label>
                                                                

                                                                    <div class="col-10">
                                                                    <select class="form-control" id="productStatus" name="productStatus">
                                                                    <option value="">Please select</option>  
                                                                        <option value="1">Activated</option>
                                                                        <option value="0">Deactivated</option>
                                                                    </select>
                                                                    </div>
                                                                    
                                            </div>

                                            <div class="form-group row"> 
                                 
                                             <label for="formFileMultiple" class="col-2 col-form-label">Product Image<span class="text-danger">*</span></label>
                                                <div class="col-10">
                                                <input class="form-control" type="file" id="productImage"  name="productImage" multiple>

                                                </div>                 
                                                                              
                                             </div>  


                                                  <div class="form-group row mb-0">
                                                  <div class="ml-lg-auto text-right">
                                                          <button type="reset"  id="userCancel" class="btn btn-secondary">Cancel</button>
                                                          <button  type="button"    id="saveProduct" class="btn btn-success">Save </button>
                                                                    <!-- onclick="submitProduct()" -->
                                            
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
                                <th>Product Category Name</th>
                                <th>Product name</th>
                      
                                <th>Product des</th>
                                <th>unit price</th>
                               
                                <th> Wastage percentage(%)</th>
                                <th> Status</th>
                                 <th> Image</th>
								<th >Option</th>
							</thead>
							<tbody>
								

							</tbody>
						</table>
				
				</div>
        </div>


</div>  <!-- end of raw  -->


                           
                  
 <script>    

       $(document).ready(function(){


      //for suggedt pro name when srach
        
  

        $.validator.addMethod("regex", function(value, element, regexpr) {          
        return regexpr.test(value);
        }); 

        datab();

        $("#saveProduct").click(function(){

            $("#productFrm").validate({
                rules:{

                    productCatName:{
                      required: true,
                      
                    },


                    productName:{
                      required: true,
                      
                    },
                   
                    productDescription: {
                          required: true,
                         

                    },
                    productUnitPrice: {
                        required: true,
                        // number:true,
                        number: true
                        // money: true,

                    },
                    productWastage: {
                        required: true,
                        number:true
                    },
                    productImage:
                    {
                        required: true,
                       
                    }
                                 
                 

                },
                messages:{
                    productCatName:{
                        required: "Category name required."
                    },

                    productName:{
                        required: "Product name required."
                    },

                    productUnitPrice:{
                        required: "Please enter price.",
                        number: "Please enter a number.",
                    },

                    productDescription:{
                        required: "Please provide features",
                        
                    },

                    productWastage:{
                        required: "Please mention wastage amount",
                        number: "Plese enter a number.",
                      
                    },
                    productImage:{
                        required: "Please select an image",
                        
                      
                    }

                    

                }
            });

            if(!$("#productFrm").valid()){
                return false;
            }
            
            data = new FormData($('#productFrm')[0]);

            $.ajax({
                url:"handlers/product2-customize_handler.php?type=saveProduct",
                method: 'POST',
                data: data,
                processData: false,
                contentType: false
            })

            .done(function(data){

                swal(
                    "Success!",
                    // "Removed successfully.",
                    // "Added successfully.",
                    "Updated successfully.",
                    "success"
                );

                // $('#productTbl').datab().ajax.reload();

            });

        });

     });

   





              $(document).ready(function(){

                  $.ajax({
                      url : "handlers/product2-customize_handler.php?type=getProductCategory", 
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

            


          function datab() {
            $('#productTbl').DataTable({
                    serverSide: true, //Server-side processing in DataTables is enabled via this
                    paging: true, //to disable paging for the table
                    processing: true,
                    // rowId: 'id', 
                    ajax: //to specify the URL where DataTables should get its Ajax data from
                    {
                        url: 'handlers/product2-customize_handler.php?type=retrieveProduct',
                        type:'POST'
                    },
                    pageLength: 10, //Number of rows to display on a single page when using pagination
                    columns:
                    [
                        //data-> data value coming from the backend name -> table fields
                        {data:"pro_code",name:"pro_code"}, 
                        {data:"pro_cat_name",name:"pro_cat_name"},

                        {data:"pro_name",name:"pro_name"},
                        // {data:"pro_type",name:"pro_type"},
                        {data:"pro_des",name:"pro_des"},

                        {data:"pro_unit_price",name:"pro_unit_price"}, 
                        // {data:"pro_stock",name:"pro_stock"},

                        {data:"pro_wastage",name:"pro_wastage"}, 

                        {data:"pro_status",name:"pro_status"},

                        {data:"pro_image",name:"pro_image"},


                    
                        {data:"pro_code",name:"pro_code"}     // for option
                    
                     
                
                    ],
                    columnDefs: [{
                        "targets": 8, //tells DataTables which column(s) the definition should be applied to
                        "data": "pro_code",
                        "render": function(data, type, row, meta){
                            // return '<button id="btnRemove" onclick="removeItem('+data+')">DEL</button> &nbsp <button id="btnEdit" onclick="editItem('+data+')">Edit</button> ';
                          
                          //previous one
                          //  return '<button id="btnEdit" class="btn-dtable-edit" onclick="editItem('+data+')"><i class="fa fa-edit"></i></button>&nbsp;<button  id="btnRemove" class="btn-dtable-delete" onclick="removeItem('+data+')"><i class="fa fa-trash-o"></i></button>';
                            // return '<button id="btnRemove" onclick="removeItem('+data+')"> <i class="far fa-trash-alt"></i></button>&nbsp <button id="btnEdit" onclick="editItem('+data+')">class="btn  btn-dtable-edit"><i class="far fa-edit"></i></button> ';
                           
                            return '<button id="btnEdit" class="btn-dtable-edit" onclick="editItem('+data+')"><i class="fa fa-edit"></i></button>&nbsp;<button  id="btnRemove" class="btn-dtable-delete" onclick="removeItem('+data+')"><i class="fa fa-trash-o"></i></button>&nbsp; <button id="btnView" onclick = "viewItem('+data+')" class="btn-dtable-view"><i class="fas fa-envelope-open-text"></i></button>';

                            // return '<button id="btnRemove" onclick="removeItem('+data+')"> <i class="fa fa-trash-0" style="font-size:24px;color:orange"></i></button>&nbsp <button id="btnEdit" onclick="editItem('+data+')"><i class="fa fa-edit" style="font-size:24px;color:blue"></i></button> ';
                            // class="btn  btn-dtable-edit"><i class="far fa-edit">   <i class="fa fa-trash" aria-hidden="true"></i>
                        }
                    }]

                  });
          }


             

      $(document).ready(function(){
            // datab();
        });


                                //   id
            function removeItem(pro_code){
              $.ajax({
                method:"POST",
                url:"handlers/product2-customize_handler.php?type=deleteProduct",
                        //id        //user_id
                data: {pro_code: pro_code}
              })
              .done(function(data){
                $('#productTbl').DataTable().destroy();
                datab();
                // window.location.reload();
              });
            }




            
    function editItem(pro_code) {
        console.log(pro_code);

        $.ajax({
                method: "POST",
                url: "handlers/product2-customize_handler.php?type=loadEditForm",
                data: {
                    id: pro_code
                }
            })
            .done(function(data) {
                data = JSON.parse(data);

                $("#mode").val("edit");
                $("#productCode").val(data[0].pro_code);
                $("#productCatName").val(data[0].pro_cat_code); 
                $("#productName").val(data[0].pro_name);
                $("#productDescription").val(data[0].pro_des);
                $("#productUnitPrice").val(data[0].pro_unit_price);
                $("#productWastage").val(data[0].pro_wastage);
                $("#productStatus").val(data[0].pro_status);

                 // $('#empTbl').DataTable().destroy();
                // datab();
                // window.location.reload();
            });
    }


 //  for view
 function viewItem(pro_code) {
        console.log(pro_code);

        $.ajax({
                method: "POST",
                url: "handlers/product2-customize_handler.php?type=viewProduct",
                data: {
                  pro_code: pro_code
                },
            })

            .done(function(data) {
                // window.location.reload();

                console.log((data)[0]);
    
                data = JSON.parse(data)[0];

                console.log(data.pro_code);
                $('#productCatNameModal').html(data.pro_cat_name);
                $('#productNameModal').html(data.pro_name);
                $('#productDescriptionModal').html(data.pro_des);
                $('#productUnitPriceModal').html(data.pro_unit_price);
                $('#productWastageModal').html(data.pro_wastage);
                // $('#empNicModal').html(data.pro_status);
                // productUnitPriceModal
                $('#productStatusModal').html(data.status_label);

                $('#ViewModal').modal('show');

            });

    }

    
 
 </script>


 
               <!-- modal for view -->
<div class="modal fade" id="ViewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Product detail </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>Product category Name</td>
                                <td>:&nbsp; <span id="productCatNameModal"></span></td>
                            </tr>
                            <tr>
                                <td>Product  Name</td>
                                <td>:&nbsp; <span id="productNameModal"></span></td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>:&nbsp; <span id="productDescriptionModal"></span></td>
                            </tr>
                            <tr>
                                <td>Unit price</td>
                                <td>:&nbsp; <span id="productUnitPriceModal"></span></td>
                            </tr>
                            <tr>
                                <td>Waste</td>
                                <td>:&nbsp; <span id="productWastageModal"></span></td>
                            </tr>
                           
                            <tr>
                                <td>Status</td>
                                <td>:&nbsp; <span id="productStatusModal"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <a  href="productionPlans.php"><button type="button" class="btn btn-primary">Confirm Production Plan</button></a> -->
            </div>
        </div>
    </div>
</div> <!-- end of raw -->




<!-- </div>  -->
<!-- end of modal body -->


<!-- </div> -->
	

    <?php require_once('incl/footer.php'); ?>
