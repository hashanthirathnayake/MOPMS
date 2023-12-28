<?php
    require_once('incl/header.php');
?>




<!-- Begin Page Content -->
<div class="container-fluid">

<div class="card-body">


        <div class="row">
                       


			<div class="table-responsive">
                        <table class="table" id="productTbl">
							<thead class="thead-light text-dark">

                                <th scope="col">#</th>
								<th scope="col">Plant Name </th>
                                <th scope="col">Machine Name</th>
								<th scope="col">Product NAme</th>
                                <th scope="col"> Min Qty</th>
                  				 <th scope="col"> Max Qty</th>

							
							</thead>
							<tbody>


							</tbody>
						</table>

			</div>
		</div>
	</div>




    


</div>     <!-- end of container fluid   -->



<script>
$(document).ready(function(){

$('#productTbl').DataTable({
    serverSide:true,
                paging:true,
                processing:true,
                // rowId: 'id',
                ajax:{
                    url:'handlers/machineReport_handler.php?type=retrieve',
                  
                    type: 'POST',
                },
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend:'copy',
                        className:'btn btn-primary'
                    },
                    {
                        extend:'excel',
                        className:'btn btn-info'
                    },
                    {
                        text:'PDF',
                        className:'btn btn-dark',
                        // margin: [ 0, 0, 0, 12 ],
                        // alignment: 'center',
                        // image: 'img/logo-lucky.jpg',
		                // fit: [100, 100],
                        action: function(){
                        pdf();
                    }
                    // {
                    //     extend:'PDFHtml5',
                    //     className:'btn btn-dark',
                    //     action: function(){
                    //     pdf();
                    // }
                    },
                ],
                pageLength:10,
                columns:[


                    {data:"mac_config_id",name:"NO"}, //data-> data value coming from the backend natable 

                    {data:"plant_no",name:"PLANT_NAME"},
                    {data:"mac_id",name:"MACHINE_NAME"},
                    {data:"pro_code",name:"PRODUCT_NAME"},
                    {data:"mac_min_qty",name:"MIN_QTY"},
                    {data:"mac_max_qty_per_day",name:"MAX_QTY"}

                                          
                     ]


});
});









function pdf() {

$.ajax({
url: "handlers/machineReport_handler.php?type=retrieveReportDetails",
type: "POST"
}).done(function (data) {

var dataArray = [];
var arr = $.parseJSON(data);


$.each(arr, function (index, value) {
// dataArray.push([value["div_id"], value["div_name"],value["div_head"], value["div_address1"], value["div_address2"],value["div_contact"] ]);
dataArray.push([value["NO"], value["PLANT_NAME"], value["MACHINE_NAME"], value["PRODUCT_NAME"] , value["MIN_QTY"] , value["MAX_QTY"]  ]);
});



var head = [["No","Plant Name","Machine Name","Product","Min Qty","Max Qty"]];
// var head = [["Division ID","Name","Head Officer","Address 1","Address 2","Contact"]];

var body = dataArray;

const doc =new jsPDF('p', 'pt', 'a4',{filters: ['ASCIIHexEncode']});

doc.setFontSize(20);






doc.addImage("data:image/jpeg;base64,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", "JPEG", 200, 80, 200, 100);

        //x axis , y axis
doc.text(170,215,"Producable  Quantity of Machines");
doc.line(255, 230, 335, 230);
// doc.setFontSize(15);

doc.autoTable({head: head, body: body, margin: {top: 305},lineWidth: 0.1},

);




        // IE doesn't allow using a blob object directly as link href
        // instead it is necessary to use msSaveOrOpenBlob
        if (window.navigator && window.navigator.msSaveOrOpenBlob) {
        window.navigator.msSaveOrOpenBlob(doc.output("blob"), "Class.pdf");
        } else {

        // For other browsers:
        // Create a link pointing to the ObjectURL containing the blob.
        window.open(
        URL.createObjectURL(doc.output("blob")),
        "_blank",
        // "Product Details Report",
        "height=650,width=1000,scrollbars=yes,location=yes"
        );

        // For Firefox it is necessary to delay revoking the ObjectURL
        setTimeout(() => {
        window.URL.revokeObjectURL(doc.output("bloburl"));
        }, 100);
        }
        //end output

        }
        );



}





</script>