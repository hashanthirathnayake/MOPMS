<?php
    require_once('incl/header.php');
?>

<!-- Begin Page Content -->
    <div class="container-fluid">

			<!--breadcrumbs-->
			
			<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="admin_dash.php">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Make Payment</li>
                <li class="breadcrumb-item active" aria-current="page">Make Payment Detail </li>
			</ol>
			</nav>

                    <!-- <h1 class="h3 mb-2 text-gray-800">Order </h1> -->
                    <!-- <h1 class="h3 mb-2 text-gray-800">Employee Configuration</h1>

                <div class="row">
                    <div class="col-md-12" id="form">
                        <div class="card">
                            <h5 class="card-header">Employee</h5>
                                <div class="card-body">
                                    <form action="#" id="frmDivision">
                                        <fieldset>
                                        -->



        <div class="row">
            <div class="col-md-12" id="form">
                <div class="card">
                    <h5 class="card-header">Payment Detail</h5>
                        <div class="card-body">
                            <form action="#" id="paymentDetailFrm">
                                <fieldset>
                                               

                                              


                                                    <div class="row">

                                                
                                                                
                                                                <div class="col-md-1">

                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                    <label class="formLabel">Payment Due Amount</label>
                                                                    <input type="text" class="form-control" name="" id="" readonly name="cus_name" placeholder="">


                                                                    </div>

                                                                </div>	

                                                                <div class="col-md-2">

                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                     
                                                                   <label class="formLabel">Pay Date</label>
                                                                    <input type="date" class="form-control" name="" id="" placeholder="">
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
                                                                
                                                                        <label class="formLabel">Pay By </label>												
                                                                        <select  name="" id="" class="form-control">
                                                                        <option value="">Please select</option>  
                                                                        <option value="1">Cash</option>  
                                                                        <option value="0">Cheque</option> 
                                                                        </select>

                                                                    </div>	

                                                             </div>	


                                                            <div class="col-md-1">

                                                            </div>
                                                     </div>

                                              

                                        <!-- <div class="card-body" id="">   -->
                                            <!-- if use a card for cheq no, bank -->
                                            <!--  pay by- cheque-->
                                                            <!-- <div class="card-header">
                                                                    Featured
                                                                </div>  -->
                                                        
                                                                 <div class="row" >
                                                                        
                                                                        <div class="col-md-1">
                                                                        
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                            <label class="formLabel">Cheque No</label>
                                                                            <input type="text" class="form-control" name="" id="" placeholder="">
                                                                        
                                                            
                                                                            </div>
                                                                        
                                                                        </div>	
                                                                        
                                                                        <div class="col-md-2">
                                                                        
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                
                                                                        
                                                                            <label class="formLabel">Bank Name</label>
                                                                            <input type="text" class="form-control" name="" id="" placeholder="">
                                                                       
                                                            
                                                                            </div>
                                                                        </div>	

                                                                        
                                                                        <div class="col-md-1">
                                                                        
                                                                        </div>
                                                                </div>		
                                                                    
                                                                                                             
                                                  
                                                                                       
                                                                                                        
                                        <!-- </div>   -->
                                           <!--end of  card  body 3  -->
                                       
                                         


                                    
                                            



                                                                <div class="row"   id="" >   <!-- -->
                                                                        
                                                                        <div class="col-md-1">
                                                                        
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                            <label class="formLabel">Paid Amount</label>
                                                                            <input type="text" class="form-control" name="" id="" placeholder="">
                                                                        
                                                            
                                                                            </div>
                                                                        
                                                                        </div>	
                                                                        
                                                                        <div class="col-md-2">
                                                                        
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                
                                                                        
                                                                            <label class="formLabel">Balance</label>
                                                                            <input type="text" class="form-control" name="" id="" placeholder="">
                                                                       
                                                            
                                                                            </div>
                                                                        </div>	

                                                                        
                                                                        <div class="col-md-1">
                                                                        
                                                                        </div>
                                                                  </div>  





                                                                  
                                                   <!-- cancel , save button -->
                                            
                                                                <div class="row">
                                                                       
    
                                                                       <div class="col-md-7">
                                                                       
                                                                       </div>
   
                                                                       <div class="col-md-4">
                                                                           <div class="form-group text-right">
                                                                           <button  onclick="submitData()" id="" class="btn btn-secondary">Cancel </button>
                                                                         <a  href="invoice.php">  <button type="button" onclick="submitData()" id="" class="btn btn-success" >Print Receipt </button></a>   <!-- for button act as link   -->
                                                                           </div>
                                                                       </div>
                                                                       <div class="col-md-1">
                                                           
                                                                       </div>
                                                               </div>

				                <fieldset>
							</form>
                            
                		</div>    <!-- end of card body -->
           		 	</div>   <!-- end of card  -->

        		</div>   <!-- end of col-md-12  -->
           </div>  <!-- end of raw  -->
            
 </div>  <!-- end of container fluid  -->


 <?php require_once('incl/footer.php'); ?>