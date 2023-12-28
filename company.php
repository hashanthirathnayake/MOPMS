<?php
    require_once('incl/header.php');
?>

<style>
    /* <!--  to resolve  jquery validation css error  --> */
    form .error {
        color: #ff0000;
        font-size: 1rem;
    }

</style>



<!-- Begin Page Content -->
    <div class="container-fluid">

			<!--breadcrumbs-->
			
			<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="admin_dash.php">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Company Configuration</li>
			</ol>
			</nav>

	  <h1 class="h3 mb-2 text-gray-800">Company Configuration</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header">Company</h5>
                        <div class="card-body">
                            <form action="#" id="companyFrm">
								<fieldset>
                                <input type="hidden" id="mode" name="mode" value="add">

                                         <input class="form-control" type="hidden"  name="companyId"  id="companyId">

                                        <div class="form-group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Company name</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" placeholder=" Company name" id="companyName" name="companyName" >
                                        </div>
                                        </div>

                                                    
                                        <div class="form-group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Registration number</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" placeholder=" Registration number" id="companyRegNo" name="companyRegNo">
                                        </div>
                                        </div>

                                                    
                                        <div class="form-group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Address </label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" placeholder=" Address " id="companyAddress" name="companyAddress">
                                        </div>
                                        </div>


                                                    
                                        <div class="form-group row">
                                        <label for="example-text-input" class="col-2 col-form-label">City</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" placeholder="City" id="companyCity" name="companyCity">
                                        </div>
                                        </div>

                                        <div class="form-group row">
                                        <label for="example-tel-input" class="col-2 col-form-label">Hotline</label>
                                        <div class="col-10">
                                            <input class="form-control" type="tel" placeholder="+94-555-5555" id="companyHot" name="companyHot">
                                        </div>
                                        </div>
                                        <div class="form-group row">
                                        <label for="example-tel-input" class="col-2 col-form-label">Whatsap No</label>
                                        <div class="col-10">
                                            <input class="form-control" type="tel" placeholder="+94-555-5555" id="companyWhats" name="companyWhats">
                                        </div>
                                        </div>


                                                    
                                        <div class="form-group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Email</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" placeholder="sample@gmail.com" id="companyEmail" name="companyEmail">
                                        </div>
                                        </div>

                                                    
                                        <div class="form-group row">
                                        <label for="example-text-input" class="col-2 col-form-label">Website</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" placeholder=" website" id="companyWeb" name="companyWeb">
                                        </div>
                                        </div>

                                        <div class="form-group row">
                                                  <label for="example-tel-input" class="col-2 col-form-label">status</label>
                                                  


                                        <div class="col-10">
                                                  <select class="form-control" id="companyStatus" name="companyStatus">
                                                  <option value="">Please select</option> 
                                                      <option value="1">Activated</option>
                                                      <option value="0">Deactivated</option>
                                                  </select>
                                                  </div>
                                                  
                                        </div>  


                                        <div class="form-group row mb-0">
                                        <div class="ml-lg-auto text-right">
                                                <button type="submit"  id="companyCancel" class="btn btn-secondary">Cancel</button>
                                                <button type="button" onclick="submitCompany()" id="companySave"  name="companySave" class="btn btn-success">Save </button>
                                              

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
            <div class="card-header-dtable">
            <!-- <div class="card-header bg-light"> -->
                <h5 class="card-header">Company Detail List</h5>
            </div>

				<div class="card-body p-3 pt-0">
					
						<table class="table" id="companyTbl">
							<thead class="thead-light text-dark">
								<th scope="col">#</th>
								<th scope="col">Name</th>
								<th scope="col"> Reg No</th>
                                <th scope="col"> Address</th>
                                <th scope="col">City</th>
                                <th scope="col">Hotline </th>
                                <th scope="col">Whatsap No</th>
                                <th scope="col">Email </th>
                                <th scope="col">Website</th>
                              

                                <th scope="col"> Status</th>
								<th scope="col">Option</th>
							</thead>
							<tbody>
								

							</tbody>
						</table>
				
				</div>
        </div>
		</div>  <!-- end of raw  -->


       


                      
        <script>           //for submit data  entered from the form - to save in db
          


                            
                function submitCompany(){

                    valid =$("#companyFrm").validate();

                    var mode= $("#companyFrm").val(); 
                            if(mode == 'add'){

                    if(valid){
                                    f = new FormData($("#companyFrm")[0]);
                                    $.ajax({
                                        method:"POST",
                                        url:"handlers/company_handler.php?type=addCompany",
                                        data: f,
                                        contentType: false,
                                        processData: false,
                                        
                                    })			
                                        .done(function(data){
                                        // window.location.reload();
                                    
                                    });

                            }

                    }


                    else{
                                    if(valid){                                // form id
                                        f = new FormData($("#companyFrm")[0]);
                                        $.ajax({
                                            method:"POST",
                                            url:"handlers/company_handler.php?type=editCompany",
                                            data: f,
                                            contentType: false,
                                            processData: false,
                                            
                                        })			
                                            .done(function(data){
                                            window.location.reload();

                                        $('#companyTbl').DataTable().draw();
                                        });

                                        }

                                }



                }


                $(document).ready(function() {
                            $("#companyFrm").validate({ 
                                rules: {
                                    companyName:{
                                        required: true,
                                        
                                    },
                                    companyRegNo:{
                                        required: true,
                                        
                                    },
                                    companyAddress:{
                                        required: true,
                                        
                                    },
                                    companyCity:{
                                        required: true,
                                        
                                    },
                                    companyHot:{
                                        required: true,
                                        
                                    }
                                    
                                },
                            });
                    
                });





                function datab() {
            $('#companyTbl').DataTable({
                    serverSide: true, //Server-side processing in DataTables is enabled via this
                    paging: true, //to disable paging for the table
                    processing: true,
                    // rowId: 'id', 
                    ajax: //to specify the URL where DataTables should get its Ajax data from
                    {
                        url: 'handlers/company_handler.php?type=retrieveCompany',
                        type:'POST'
                    },
                    pageLength: 10, //Number of rows to display on a single page when using pagination
                    columns:
                    [
                        {data:"com_id",name:"com_id"}, //data-> data value coming from the backend name -> table fields
                        {data:"com_name",name:"com_name"},
                        {data:"com_reg_no",name:"com_reg_no"},
                        {data:"com_address",name:"com_address"},

                        {data:"com_city",name:"com_city"},
                        {data:"com_hotline",name:"com_hotline"},
                        {data:"com_whatsap",name:"com_whatsap"},
                        {data:"com_email",name:"com_email"},

                        {data:"com_website",name:"com_website"},
                        {data:"com_status",name:"com_status"},
                      
                       

                        {data:"com_id",name:"com_id"}     // for option
                    
                     
                
                    ],
                    columnDefs: [{
                        "targets": 10, //tells DataTables which column(s) the definition should be applied to
                        "data": "com_id",
                        "render": function(data, type, row, meta){
                            // return '<button id="btnRemove" onclick="removeItem('+data+')">DEL</button> &nbsp <button id="btnEdit" onclick="editItem('+data+')">Edit</button> ';
                              

                              //with view item
                            // return '<button id="btnEdit" class="btn-dtable-edit" onclick="editItem('+data+')"><i class="fa fa-edit"></i></button>&nbsp;<button  id="btnRemove" class="btn-dtable-delete" onclick="removeItem('+data+')"><i class="fa fa-trash-o"></i></button>&nbsp; <button id="btnView" onclick = "viewItem('+data+')" class="btn-dtable-view"><i class="fas fa-envelope-open-text"></i></button>';
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


                                  //id
            function removeItem(com_id){
              $.ajax({
                method:"POST",
                url:"handlers/company_handler.php?type=deleteCompany",
                        //id        //user_id
                data: {com_id: com_id}
              })
              .done(function(data){
                $('#companyTbl').DataTable().destroy();
                datab();
                // window.location.reload();
              });
            }



        //     function editUser(user_id){
        // // var location = "http://localhost/projectNew/k9.php?divId="+div_id;
        //         window.location.replace(location);
        //     }

    
                
        function editItem(com_id){
                                    // alert(mac_id);
                                $.ajax({
                                    method:"POST",
                                    url:"handlers/company_handler.php?type=getCompany",
                                            //id        //user_id
                                    data: {com_id: com_id}
                                })
                                .done(function(data){
                                    data = JSON.parse(data);

                                    $("#mode").val("edit");
                                    $("#companyId").val(data.com_id);
                                    $("#companyName").val(data.com_name);
                                    
                                    $("#companyRegNo").val(data.com_reg_no);
                                
                                    $("#companyAddress").val(data.com_address);
                                    $("#companyCity").val(data.com_city);
                                    $("#companyHot").val(data.com_hotline);

                                    $("#companyWhats").val(data.com_whatsap);
                                    $("#companyEmail").val(data.com_email);
                                    $("#companyWeb").val(data.com_website);
                                    // $("#empStatus").val(data.mac_availability);
                                    $("#companyStatus").change();
                                    // $("#macName").val(data.mac_name);
                                    
                                    // console.log(data.emp_no);
                                //     console.log(data.emp_fname);
                                
                                   //   alert(data);
                                 
                                    
                                    $('#companyTbl').DataTable().destroy();
                                    datab();

                                    // $(com_id).remove();
                                    // window.location.reload();

                                });
                                }


        </script>

	

    <?php require_once('incl/footer.php'); ?>