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
				<li class="breadcrumb-item active" aria-current="page">User Category Configuration</li>
			</ol>
			</nav>

	  <h1 class="h3 mb-2 text-gray-800">User Category Configuration</h1>

        <div class="row">
            <div class="col-md-12" id="form">
                <div class="card">
                    <h5 class="card-header">User Category</h5>
                        <div class="card-body">
                            <form action="#" id="userCatFrm">
								<fieldset>
								
                                <input class="form-control" type="hidden"  name="userCatId"  id="userCatId">
                                <!-- <input class="form-control" type="hidden" name="productCatCode" id="productCatCode" /> -->
                            <input class="form-control" type="hidden" name="mode" id="mode" value="add" />

           
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-2 col-form-label">User Category </label>
                                        <div class="col-10">
                                        <input class="form-control" type="text"  placeholder="User Category Description"   name="userCatDes"  id="userCatDes">
                                    </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-2 col-form-label"> Status</label>
                                        <div class="col-10">
                                           
                                                 <select class="form-control" id="userCatStatus" name="userCatStatus">
                                                      <option value="1">Activated</option>
                                                      <option value="0">Deactivated</option>
                                                  </select>
                                         </div>
                                    </div>
                                    

                                    <div class="form-group row mb-0">
                                    <div class="ml-lg-auto text-right">
                                            <button type="submit"  id="userCatCancel" class="btn btn-secondary">Cancel</button>
                                            <button type="button"  onclick="submitUserCat()" id="userCatSave" name="userCatSave" class="btn btn-success">Save </button>
                                           

                                        </div>
                                    </div>
				                <fieldset>
							</form>
                            
                		</div>    <!-- end of card body -->
           		 	</div>   <!-- end of card  -->

        		</div>
    		</div>
		



            <div class="card mt-3">
                <div class="card-header bg-light">
                    <h5>User Category Detail List</h5>
                </div>

                    <div class="card-body p-3 pt-0">
                
                            <table class="table" id="userCatTbl">
                                <thead class="thead-light text-dark">
                                   
                                    <th scope="col">#</th>        <!--  for User Category ID -->
                                    <th scope="col">User Category  Des</th>
                                    <th scope="col">User Category  Status</th>
                                    <th scope="col">option</th>
                                    
                             
                                </thead>

                                <tbody>
                                   
                                </tbody>
                            </table>
            
                    </div>
          </div>

</div>  <!-- end of raw  -->      

                                     <script>          

                                        // function submitUser(){
                                        //         // form id
                                        // valid =$("#userCatFrm").validate();


                                        // if(valid){                                // form id
                                        //                 f = new FormData($("#userCatFrm")[0]);
                                        //                 $.ajax({
                                        //                     method:"POST",
                                        //                     url:"handlers/user_cat_handler.php?type=addUserCat",
                                        //                     data: f,
                                        //                     contentType: false,
                                        //                     processData: false,
                                                            
                                        //                 })			
                                        //                     .done(function(data){
                                        //                     // window.location.reload();
                                                        
                                        //                 });

                                        //         }

                                        // }

                                        function submitUserCat() {
                                                // form id
                                                valid = $("#userCatFrm").validate();

                                                if (valid) { // form id
                                                    var f = new FormData($("#userCatFrm")[0]);
                                                    console.log(f);
                                                    $.ajax({
                                                            method: "POST",
                                                            url:"handlers/user_cat_handler.php?type=saveUserCategory",
                                                            data: f,
                                                            contentType: false,
                                                            processData: false,

                                                        })
                                                        .done(function(data) {
                                                            window.location.reload();

                                                            // swal(
                                                            //         "Success!",
                                                            //         "Data added successfully.",
                                                            //         "success"
                                                            //     );

                                                            swal({
                                                                title: "Success",
                                                                icon: "success",
                                                                
                                                                text: "Product added Successfully!",
                                                                });


                                                        });

                                                }

                                            }


                                      

                                        function datab() {
                                        $('#userCatTbl').DataTable({
                                                serverSide: true, //Server-side processing in DataTables is enabled via this
                                                paging: true, //to disable paging for the table
                                                processing: true,
                                                // rowId: 'id', 
                                                ajax: //to specify the URL where DataTables should get its Ajax data from
                                                {
                                                    url: 'handlers/user_cat_handler.php?type=retrieveUserCat',
                                                    type:'POST'
                                                },
                                                pageLength: 10, //Number of rows to display on a single page when using pagination
                                                columns:
                                                [
                                                    {data:"user_cat_id",name:"user_cat_id"}, //data-> data value coming from the backend name -> table fields
                                                    {data:"user_cat_des",name:"user_cat_des"},
                                                    {data:"user_cat_status",name:"user_cat_status"},

                                                    {data:"user_cat_id",name:"user_cat_id"}     // for option
                                                // for option
                                                
                                                
                                                ],
                                                columnDefs: [{
                                                    "targets": 3, //tells DataTables which column(s) the definition should be applied to
                                                    "data": "user_cat_id",
                                                    "render": function(data, type, row, meta){
                                                        // return '<button id="btnRemove" onclick="removeItem('+data+')">DEL</button> &nbsp <button id="btnEdit" onclick="editItem('+data+')">Edit</button> ';
                                                       
                                                        return '<button id="btnEdit" class="btn-dtable-edit" onclick="editItem('+data+')"><i class="fa fa-edit"></i></button>&nbsp;<button  id="btnRemove" class="btn-dtable-delete" onclick="removeItem('+data+')"><i class="fa fa-trash-o"></i></button>';
                                                        // return '<button id="btnRemove" onclick="removeItem('+data+')"> <i class="far fa-trash-alt"></i></button>&nbsp <button id="btnEdit" onclick="editItem('+data+')"><i style="font-size:24px" class="fa">&#xf044;</i></button> ';
                                                    
                                                        // class="btn  btn-dtable-edit"><i class="far fa-edit">
                                                    }
                                                }]

                                            });
                                        }


                                        

                                        $(document).ready(function(){
                                        datab();
                                        });


                                                            //id
                                        function removeItem(user_cat_id){
                                        $.ajax({
                                            method:"POST",
                                            url:"handlers/user_cat_handler.php?type=deleteUserCat",
                                                    //id        //user_id
                                            data: {user_cat_id: user_cat_id}
                                        })
                                        .done(function(data){
                                            // swal(
                                            //     "Success!",
                                            //     "Data Removed successfully!",
                                            //     "success"
                                            // );
                                          
                                            $('#userCatTbl').DataTable().destroy();
                                            datab();

                                            swal({
                                                    title: "Success",
                                                    icon: "success",
                                                    
                                                    text: "Data Removed successfully!!",
                                                    });
                                            // window.location.reload();
                                        });
                                        }



                                        function editItem(user_cat_id) {
                                                console.log(user_cat_id);

                                                $.ajax({
                                                        method: "POST",
                                                        url: "handlers/user_cat_handler.php?type=loadEditForm",
                                                        data: {
                                                            id: user_cat_id
                                                        }
                                                    })
                                                    .done(function(data) {
                                                        data = JSON.parse(data);

                                                        $("#mode").val("edit");
                                                        $("#userCatId").val(data[0].user_cat_id);
                                                        $("#userCatDes").val(data[0].user_cat_des);
                                                        $("#userCatStatus").val(data[0].user_cat_status);


                                                        // $('#empTbl').DataTable().destroy();
                                                        // datab();
                                                        // window.location.reload();
                                                    });
                                            }
                                      



                                        </script>




    <?php require_once('incl/footer.php'); ?>
