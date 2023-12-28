<?php
    require_once('incl/header.php');
?>

<!-- Begin Page Content -->
    <div class="container-fluid">

			<!--breadcrumbs-->
			
			<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="admin_dash.php">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Product Category List</li>
			</ol>
			</nav>
                <div class="card mt-3">
                        <div class="card-header bg-light">
                            <h5>Product Category Detail List</h5>
                        </div>

                            <div class="card-body p-3 pt-0">
                    
                                <table class="table" id="productCatTbl">
                                    <thead class="thead-light text-dark">
                                        
                                        <th scope="col">Product Category Code</th>
                                        
                                        <th scope="col">Product CategoryName</th>
                                        <th scope="col">Product Category Status</th>
                                                                          
                                
                                    </thead>

                                    <tbody>
                                        

                                    </tbody>
                                </table>
                
                            </div>
                </div>


		</div>  <!-- end of raw  -->
     
                 
        

<script>          


function datab() {
$('#productCatTbl').DataTable({
        serverSide: true, //Server-side processing in DataTables is enabled via this
        paging: true, //to disable paging for the table
        processing: true,
        // rowId: 'id', 
        ajax: //to specify the URL where DataTables should get its Ajax data from
        {
            url: 'handlers/product_cat_list_handler.php?type=retrieveProductCategoryList',
            type:'POST'
        },
        pageLength: 10, //Number of rows to display on a single page when using pagination
        columns:
        [
            {data:"pro_cat_code",name:"pro_cat_code"}, //data-> data value coming from the backend name -> table fields
            {data:"pro_cat_name",name:"pro_cat_name"},
            {data:"pro_cat_status",name:"pro_cat_status"},
        
        
            // {data:"pro_cat_code",name:"pro_cat_code"}     // for option
        

                   
    
        ]
        // columnDefs: [{
        //     "targets": 3, //tells DataTables which column(s) the definition should be applied to
        //     "data": "pro_cat_code",
        //     "render": function(data, type, row, meta){
        //         return '<button id="btnRemove" onclick="removeItem('+data+')">DEL</button> &nbsp <button id="btnEdit" onclick="editItem('+data+')">Edit</button> ';
        //         // return '<button id="btnRemove" onclick="removeItem('+data+')"> <i class="far fa-trash-alt"></i></button>&nbsp <button id="btnEdit" onclick="editItem('+data+')">class="btn  btn-dtable-edit"><i class="far fa-edit"></i></button> ';
               
        //         // return '<button id="btnRemove" onclick="removeItem('+data+')"> <i class="fa fa-trash-0" style="font-size:24px;color:orange"></i></button>&nbsp <button id="btnEdit" onclick="editItem('+data+')"><i class="fa fa-edit" style="font-size:24px;color:blue"></i></button> ';
        //         // class="btn  btn-dtable-edit"><i class="far fa-edit">   <i class="fa fa-trash" aria-hidden="true"></i>
        //     }
        // }]

      });
}


 

$(document).ready(function(){
datab();
});


                      //id
function removeItem(pro_cat_code){
  $.ajax({
    method:"POST",
    url:"handlers/product_cat_handler.php?type=deleteProductCategory",
            //id        //user_id
    data: {pro_cat_code: pro_cat_code}
  })
  .done(function(data){
    $('#productCatTbl').DataTable().destroy();
    datab();
    // window.location.reload();
  });
}


</script>

    <?php require_once('incl/footer.php'); ?>