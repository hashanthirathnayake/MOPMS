<?php
    require_once('incl/header_assistant.php');

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
                <li class="breadcrumb-item"><a href="order-b.php">Place Order</a></li>
				<li class="breadcrumb-item active" aria-current="page">Registering Customer </li>

			</ol>
			</nav>

                



        <div class="row">
            <div class="col-md-12" id="form">
                <div class="card">
                    <h5 class="card-header"> Customer</h5>
                        <div class="card-body">
                            <form action="#" id="customerFrm">
                               <fieldset>

                               <input class="form-control" type="hidden"  name="cusId"  id="cusId">
                               <input class="form-control" type="hidden"  name="cusType"  id="cusType">
                                                 <!-- <div class="row">

                                                
                                                    <div class="col-md-1">
                                                      
                                                    </div>

                                                    <div class="col-md-10">
                                                 
                                                        <div class="form-group">
                                                            <label class="formLabel">Customer Type </label>												
                                                            <select  name="selectCusType" id="selectCusType"  onchange="changeFunc();" class="form-control">
                                                                <option value="">Please select</option>  
                                                                <option value="indi">Individual</option>  
                                                                <option value="com">company</option> 
                                                            </select>

                                                            
                                                        </div>
                                                    </div>	

                                               	

                                                    <div class="col-md-1">
                                                       
                                                    </div>



                                                </div> -->



                                        <div class="card-body" id="individual_card" >  <!--  2  customer type =individual-->
                                                            <!-- <div class="card-header">
                                                                    Featured
                                                                </div>  -->
                                                            <!-- <h6 class="card-header">Basic Info</h5> -->
                                                            <label class="formLabel">Basic Info</label>
                                                            <hr>
                                                                <div class="row">
                                                                        
                                                                        <div class="col-md-1">
                                                                        
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                            <label class="formLabel">First Name<span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" name="cusFname" id="cusFname" placeholder="">
                                                                        
                                                            
                                                                            </div>
                                                                        
                                                                        </div>	
                                                                        
                                                                        <div class="col-md-2">
                                                                        
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                
                                                                        
                                                                            <label class="formLabel">Last Name</label>
                                                                            <input type="text" class="form-control" name="cusLname" id="cusLname" placeholder="">
                                                                            <!-- <span class="form-text text-muted">+94 775 999 999</span> -->
                                                            
                                                                            </div>
                                                                        </div>	

                                                                        
                                                                        <div class="col-md-1">
                                                                        
                                                                        </div>
                                                                </div>		
                                                                    
                                                                    

                                                                    <div class="row">

                                                                                    <div class="col-md-1">
                                                                                    
                                                                                    </div>

                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <label class="formLabel">NIC<span class="text-danger">*</span></label>
                                                                                            <input type="text" class="form-control" name="cusNic" id="cusNic"  autocomplete="off" placeholder="">
                                                                                        
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-2">
                                                                                    
                                                                                    </div>

                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <label class="formLabel">City</label>
                                                                                            <input type="text" class="form-control" name="cusCity" id="cusCity" placeholder="">
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-1">
                                                                        
                                                                                    </div>
                                                                    </div>

                                                            

                                                                    <div class="row">

                                                                    
                                                                        <div class="col-md-1">
                                                                        
                                                                        </div>

                                                                        <div class="col-md-10">
                                                                    
                                                                            <div class="form-group">
                                                                            <label class="formLabel">Address<span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" name="cusAddress" id="cusAddress" placeholder="">

                                                                                
                                                                            </div>
                                                                        </div>	

                                                                    

                                                                        <div class="col-md-1">
                                                                        
                                                                        </div>



                                                                    </div>
                                                                    
                                                                <!-- <h6 class="card-header">Contact Info</h5>      sub heading 2   -->
                                                                <label class="formLabel">Contact Info</label>
                                                                <hr>

                                                                <div class="row">

                                                                        <div class="col-md-1">

                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label class="formLabel">Phone Number<span class="text-danger">*</span></label>
                                                                                <input type="text" class="form-control" name="cusPhoneNo" id="cusPhoneNo" placeholder="">
                                                                            
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-2">
                                                                        
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label class="formLabel">Whatsap Number<span class="text-danger">*</span></label>
                                                                                <input type="text" class="form-control" name="cusWhatsapNo" id="cusWhatsapNo" placeholder="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-1">

                                                                        </div>
                                                                </div>



                                                                <div class="row">


                                                                        <div class="col-md-1">

                                                                        </div>

                                                                        <div class="col-md-10">

                                                                            <div class="form-group">
                                                                            <label class="formLabel">Email<span class="text-danger">*</span></label>
                                                                            <input type="email" class="form-control" name="cusEmail" id="cusEmail" placeholder="">


                                                                            </div>
                                                                        </div>	



                                                                        <div class="col-md-1">

                                                                        </div>



                                                                </div>




                                                                <!-- <div class="row">      check in side the card body 2-  for the  cancel, save buttons
                                                                

                                                                    <div class="col-md-7">
                                                                    
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <div class="form-group text-right">
                                                                        <button type="button" onclick="submitData()" id="" class="btn btn-secondary">Cancel </button>
                                                                        <button type="button" onclick="submitData()" id="" class="btn btn-success">Save Customer </button>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-1">
                                                        
                                                                    </div>
                                                                </div> -->

                                               


                                        </div>     <!--end of  card  body 3  -->
                                       
                                         


                                        




                                        <div class="card-body" id="">   <!-- for the  cancel, save buttons -->
                                                        
                                                        <div class="row">
                                                                        <!-- <div class="col-md-1">
                                                                        
                                                                        </div>
    
                                                                        <div class="col-md-4">
                                                                        
                                                                        </div> -->
    
                                                                        <div class="col-md-7">
                                                                        
                                                                        </div>
    
                                                                        <div class="col-md-4">
                                                                            <div class="form-group text-right">
                                                                            <button type="reset" onclick="" id="" class="btn btn-secondary">Cancel </button>
                                                                          <a  href="order-b.php">  <button type="button" id="saveCus" class="btn btn-success" >Save Customer </button></a>   <!-- for button act as link   -->
                                                                           
                                                                                                                                                <!-- onclick="submitData()"  -->
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                            
                                                                        </div>
                                                         </div>
                                          </div>  <!--  end -for the  cancel, save buttons -->
                                                  
                               
                                                 

				                <fieldset>
							</form>
                            
                		</div>    <!-- end of card body -->
           		 	</div>   <!-- end of card  -->

        		</div>   <!-- end of col-md-12  -->
           </div>  <!-- end of raw  -->
            

     

 </div>  <!-- end of container fluid  -->





                  
 <script>          



        $(document).ready(function(){


          $.validator.addMethod("regex", function(value, element, regexpr) {          
                return regexpr.test(value);
                }); 

                $("#saveCus").click(function(){

                    $("#customerFrm").validate({
                            rules:{
                                cusFname:{
                                    required: true
                                },

                              

                                cusNic:{
                                    required: true,
                                    regex: /^([0-9]{9}[x|X|v|V]|[0-9]{12})$/
                                },

                                cusAddress:{
                                    required: true
                                },

                               
                                cusPhoneNo:{
                                    required: true,
                                    regex: /^(?:0|94|\+94)?(?:7(0|1|2|4|5|6|7|8)\d)\d{6}$/
                                },
                                cusWhatsapNo:{
                                    required: true,
                                    regex: /^(?:0|94|\+94)?(?:7(0|1|2|4|5|6|7|8)\d)\d{6}$/
                                },

                            

                                cusEmail:{
                                    required: true,
                                    regex: /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/
                                }
                            },
                            messages:{
                                cusFname:{
                                    required: "First name required."
                                },

                              
                                cusNic:{
                                    required: "Please enter the NIC.",
                                    regex: "Please enter a valid format.",
                                },

                                cusPhoneNo:{
                                    required: "Please enter a mobile number.",
                                    regex: "Please enter a valid format."
                                },
                                cusWhatsapNo:{
                                    required: "Please enter a mobile number.",
                                    regex: "Please enter a valid format."
                                },


                                cusEmail:{
                                    required: "Please enter an email address.",
                                    regex: "Please enter a valid email."
                                }

                            }
                    });

                        if(!$("#customerFrm").valid()){
                            return false;
                        }

                        data = new FormData($('#customerFrm')[0]);

                        $.ajax({
                            url:"handlers/individual-assis_handler.php?type=addIndividualCustomer",
                            method: 'POST',
                            data: data,
                            processData: false,
                            contentType: false
                        })

                        .done(function(data){

                            swal(
                                "Success!",
                                // "Data added successfully.",
                                " successfull.",
                                "success"
                            );

                            // $('#emp').DataTable().ajax.reload();

                        });

            });

        });



      








 </script>    