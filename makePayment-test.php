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
                        <li class="breadcrumb-item"><a href="admin_dash.php">Payment</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Make Payment</li>
                    </ol>
                    </nav>

                <!-- <h1 class="h3 mb-2 text-gray-800">User Configuration</h1> -->

       




            <!-- data table -->
                <div class="card mt-3">
                    <div class="card-header bg-light">
                        <h5>Payment Detail List</h5>
                    </div>

                        <div class="card-body p-3 pt-0">
                            
                                <table class="table" id="makePaymentTbl">
                                    <thead class="thead-light text-dark">

                                        <th>Payment No</th>
                                        <!-- <th>Order No</th>-->
                                        <th>Customer  Name</th> 
                                         
                                        <th>Payment status</th>
                                        <th>Action</th>

                                    </thead>
                                    <tbody>
                                        

                                    </tbody>
                                </table>
                        
                        </div>
                </div>


</div>  <!-- end of container-fluid  -->


                           
                  
 <script>          


           



            //   $(document).ready(function(){

            //       $.ajax({
            //           url : "handlers/user_handler.php?type=getUserCategory", 
            //           method : "GET",
            //           success : function(data){
            //               data = JSON.parse(data);                    
            //               data.forEach(row => {                          //db column name
            //                   $("#userCatDes").append("<option value='"+row.user_cat_id+"'>"+row.user_cat_des+"</option>");
            //                   //text box id
            //               });
            //           }
            //       }); 

            //   });

             

          function datab() {
            $('#makePaymentTbl').DataTable({
                    serverSide: true, //Server-side processing in DataTables is enabled via this
                    paging: true, //to disable paging for the table
                    processing: true,
                    // rowId: 'id', 
                    ajax: //to specify the URL where DataTables should get its Ajax data from
                    {
                        url: 'handlers/makePayment-test_handler.php?type=retrieveMakePayment',
                        type:'POST'
                    },
                    pageLength: 10, //Number of rows to display on a single page when using pagination
                    columns:
                    [
                        //data-> data value coming from the backend name -> table fields
                        {data:"payment_no",name:"id"},
                        // {data:"ord_no",name:"name"},
                        {data:"customer_name",name:"customer_name"},      // for customer name column 
                        {data:"payment_status",name:"payment_status"},
                                

                        {data:"payment_no",name:"payment_no"}  // for Action  button    // for option
                    
                     
                
                    ],
                    columnDefs: [{
                        "targets": 3, //tells DataTables which column(s) the definition should be applied to
                        "data": "payment_no",
                        "render": function(data, type, row, meta){
                            return '<button  class="btn-dtable-pay" id="btnPay" onclick="payItem('+data+')"><i class="fab fa-amazon-pay"></i></button>';

                            // class="btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModalCenter"
                            // return '<button id="btnRemove" onclick="removeuser_idItem('+data+')"> <i class="far fa-trash-alt"></i></button>&nbsp <button id="btnEdit" onclick="editItem('+data+')">class="btn  btn-dtable-edit"><i class="far fa-edit"></i></button> ';
                           
                            // return '<button id="btnRemove" onclick="removeItem('+data+')"> <i class="fa fa-trash-0" style="font-size:24px;color:orange"></i></button>&nbsp <button id="btnEdit" onclick="editItem('+data+')"><i class="fa fa-edit" style="font-size:24px;color:blue"></i></button> ';
                            // class="btn  btn-dtable-edit"><i class="far fa-edit">   <i class="fa fa-trash" aria-hidden="true"></i>

                                  // <button style='font-size:24px'>Button <i class='fas fa-calendar-alt'></i></button>

                            // makePaymentModal
                            // <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            //   <div class="modal-dialog modal-dialog-centered" role="document">
                            //           <div class="modal-content">
                            //             <div class="modal-header">
                            //               <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                            //               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            //                 <span aria-hidden="true">&times;</span>
                            //               </button>
                            //             </div>
                            //             <div class="modal-body">




                            //               ...
                            //             </div>
                            //                 <div class="modal-footer">
                            //                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            //                   <button type="button" class="btn btn-primary">Receipt</button>
                            //                 </div>
                            //           </div>
                            //   </div> 
                            // </div> 
                        }
                    }]

                  });
          }


             

      $(document).ready(function(){
            datab();
        });


        function payItem(payment_no){
    // $('#paymentDetailModal').modal('show');
     // location.replace('http://localhost/luk/payment.php?id='+data);
    var location = "http://localhost/luk/paymentAfterOrder.php?payment_no="+payment_no;
   
                window.location.replace(location);
    //   datab2();
    }

    
 
 </script>




       
	

    <?php require_once('incl/footer.php'); ?>











 <!-- modal for Plan -->
 <div class="modal fade" id="paymentDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
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


                                                            
                                                  





                                        <!-- </div>  end of modal body -->
                                            <!-- 
                                             <div class="modal-footer">
                                               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                               <a  href="productionPlans.php"><button type="button" class="btn btn-primary">Confirm Production Plan</button></a>
                                             </div> -->
                                       <!-- </div> -->
                               </div> 
 </div>



                  

        
        
        <!-- // inside modal content




<form action="#" id="frmPayment">
                                                <fieldset>
                                                                // <div class="row">

                                                                
                                                                        
                                                                //                         <div class="col-md-1">
                                                                                        
                                                                //                         </div>
                                                                //                         <div class="col-md-4">
                                                                //                             <div class="form-group">
                                                                //                             <label class="formLabel">Customer Name</label>
                                                                //                             <input type="text" class="form-control" name="paymentCusName" id="paymentCusName" readonly name="cus_name" placeholder="">
                                                                                        
                                                                            
                                                                //                             </div>
                                                                                        
                                                                //                         </div>	
                                                                                        
                                                                //                         <div class="col-md-2">
                                                                                        
                                                                //                         </div>

                                                                //                         <div class="col-md-4">
                                                                //                             <div class="form-group">
                                                                                                
                                                                                        
                                                                //                             <label class="formLabel">Order No</label>
                                                                //                             <input type="text" class="form-control" name="paymentOrderNo" id="paymentOrderNo" readonly name="order_no" placeholder="">
                                                                                        
                                                                            
                                                                //                             </div>
                                                                //                         </div>	

                                                                                        
                                                                //                         <div class="col-md-1">
                                                                                        
                                                                //                         </div>
                                                                //                 </div>		


                                                            


                                                                <div class="row">

                                                                
                                                                                
                                                                                <div class="col-md-1">

                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                    <label class="formLabel">Payment Due Amount</label>
                                                                                    <input type="text" class="form-control" name="paymentDueAmount" id="paymentDueAmount" readonly name="" placeholder="">


                                                                                    </div>

                                                                                </div>	

                                                                                <div class="col-md-2">

                                                                                </div>

                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        

                                                                                    <label class="formLabel">Pay Date</label>
                                                                                    <input type="text" class="form-control" name="paymentDate" id="paymentDate" readonly name="" placeholder="">

                                                                                

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
                                                                                <select  name="paymentPayBy" id="paymentPayBy" class="form-control">
                                                                                    <option value="">Please select</option>  
                                                                                    <option value="1">Cash</option>  
                                                                                    <option value="0">Cheque</option> 
                                                                                </select>


                                                                                </div>
                                                                            </div>	


                                                                            <div class="col-md-1">

                                                                            </div>
                                                                    </div>		

                                                     






                                                <div class="card-body" id="">   -->
                                                    <!-- if use a card for cheq no, bank -->
                                                    <!--  pay by- cheque-->
                                                                    <!-- <div class="card-header">
                                                                            Featured
                                                                        </div>  -->
                                                                

        
                                                                        <!-- <div class="row"   id="" >
                                                                                
                                                                                <div class="col-md-1">
                                                                                
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                    <label class="formLabel">Cheque No</label>
                                                                                    <input type="text" class="form-control" name="paymentChequeNo" id="paymentChequeNo" placeholder="">
                                                                                
                                                                    
                                                                                    </div>
                                                                                
                                                                                </div>	
                                                                                
                                                                                <div class="col-md-2">
                                                                                
                                                                                </div>

                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        
                                                                                
                                                                                    <label class="formLabel">Bank Name</label>
                                                                                    <input type="text" class="form-control" name="paymentBankName" id="paymentBankName" placeholder="">
                                                                            
                                                                    
                                                                                    </div>
                                                                                </div>	

                                                                                
                                                                                <div class="col-md-1">
                                                                                
                                                                                </div>
                                                                        </div>		
                                                                             -->
                                                                                                                    
                                                        
                                                                                            
                                                                                                                
                                                <!-- </div>   -->
                                                <!--end of  card  body 3  -->
                                       
                                         


                                    
                                            



                                                                <!-- <div class="row"   id="" >   -->
                                                                 <!-- -->
                                                                        
                                                                        <!-- <div class="col-md-1">
                                                                        
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                            <label class="formLabel">Payment Amount</label>
                                                                            <input type="text" class="form-control" name="paymentAmount" id="paymentAmount" placeholder="">
                                                                        
                                                            
                                                                            </div>
                                                                        
                                                                        </div>	
                                                                        
                                                                        <div class="col-md-2">
                                                                        
                                                                        </div>

                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                
                                                                        
                                                                            <label class="formLabel">Balance</label>
                                                                            <input type="text" class="form-control" name="paymentBalance" id="paymentBalance" placeholder="">
                                                                       
                                                            
                                                                            </div>
                                                                        </div>	

                                                                        
                                                                        <div class="col-md-1">
                                                                        
                                                                        </div>
                                                                  </div>   -->





                                                                  
                                                   <!-- cancel , save button -->
                                            
                                                                <!-- <div class="row">
                                                                       
    
                                                                       <div class="col-md-7">
                                                                       
                                                                       </div>
   
                                                                       <div class="col-md-4">
                                                                           <div class="form-group text-right">
                                                                           <button type="button" onclick="submitPayment()" id="" class="btn btn-secondary">Cancel </button>
                                                                         <a  href="invoice.php">  <button type="button" onclick="submitData()" id="paymentSave" name="paymentSave" class="btn btn-success" >Print Receipt </button></a>   <!-- for button act as link   -->
                                                                           <!-- </div>
                                                                       </div>
                                                                       <div class="col-md-1">
                                                           
                                                                       </div>
                                                               </div>

				                <fieldset>
							</form>  -->
                         