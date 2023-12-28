<?php
    require_once('incl/header.php');
?>




<!-- Begin Page Content -->
    <div class="container-fluid">

    <!-- <h1 class="h3 mb-4 text-gray-800">Blank Page</h1> -->

              <!--breadcrumbs-->

              <!-- <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admin_dash.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sales Report</li>
              </ol>
              </nav>



                        <div class="row">
                            <div class="col-md-12" id="">
                                <div class="card">

                                        <div class="card-body">

                                    </div>     end of card body -->
                                <!-- </div>    end of card

                            </div>
                        </div> -->







            <!-- data table -->
          <!--    <div class="card mt-3">
                    <div class="card-header bg-light">
                        <h5>Employee List</h5>
                    </div>

                        <div class="card-body p-3 pt-0">

                                <table class="table" id="empTbl">
                                    <thead class="thead-light text-dark">

                                                        <th>Emp No</th>
                                                        <th>First name</th>
                                                        <th>Last Name</th>
                                                        <th>Designation</th>
                                                        <th>Join date</th>
                                                        <th>Address</th>
                                                        <th>Nic</th>
                                                        <th>Email</th>
                                                        <th>Contact No</th>
                                                        <th>Status</th>
                                                        <th>Options</th>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                </table>

                        </div>
            </div> -->

            <!-- <div class="card shadow mb-12">
		<div class="card-header bg-light">Machine Detail Report </div> -->



        <!-- </div> -->

		<div class="card-body">


        <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>From</label>
                                <input type="date" name="date_from" id="date_from"  placeholder="" class="form-control mandatory">
                            </div>
                        </div>


                        <div class="col-md-2">
                            <div class="form-group">
                                <label>To</label>
                                <input type="date" name="date_to" id="date_to" placeholder="" class="form-control">
                            </div>
                        </div>
                    </div>


			<div class="table-responsive">
                        <table class="table" id="machineTbl">
							<thead class="thead-light text-dark">
                                <th scope="col">#</th>
								<th scope="col">Machine</th>
								<!-- <th scope="col"> Supervisor</th> -->
                                <th scope="col">Min Qty</th>
								<th scope="col">Max Qty</th>


                                <th scope="col"> Status</th>
                  				<th scope="col"> Availability</th>

								<!-- <th scope="col">Option</th> -->
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

        $('#machineTbl').DataTable({

                serverSide:true,
                paging:true,
                processing:true,
                // rowId: 'id',
                ajax:{
                    url:'handlers/machineReport_handler.php?type=retrieveMachine',
                    // url:'handlers/k9_handler.php?type=retrieveDivision',
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


                                {data:"mac_id",name:"mac_id"}, //data-> data value coming from the backend name -> table fields

                                {data:"mac_name",name:"mac_name"},
                                // {data:"employee_name",name:"employee_name"},

                                {data:"mac_min_qty",name:"mac_min_qty"},

                                {data:"mac_max_qty_per_day",name:"mac_max_qty_per_day"},


                                {data:"mac_status",name:"mac_status"},
                                {data:"mac_availability",name:"mac_availability"}




                                // {data:"mac_id",name:"mac_id"}
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
            dataArray.push([value["mac_id"], value["mac_name"], value["mac_min_qty"], value["mac_max_qty_per_day"],value["mac_status"] ,value["mac_availability"] ]);
        });





        var head = [["Machine ID","Machine Name","Min Qty"," Max Qty","Status","Availability"]];
        // var head = [["Division ID","Name","Head Officer","Address 1","Address 2","Contact"]];

        var body = dataArray;

        const doc =new jsPDF('p', 'pt', 'a4',{filters: ['ASCIIHexEncode']});

        doc.setFontSize(20);

        doc.line(255, 230, 335, 230);

        doc.setFontSize(15);

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




// columnDefs:[
                //         {
                //             "targets": 6,
                //             "data":"mac_id",
                //             "render": function(data, type, row, meta){
                //                 // return  ' <button id="viewDivision" title="View" onclick="viewDivision('+data+')" class="btn btn-dtable-view"  data-toggle="modal" data-target="#frmViewDivision" data-whatever="@mdo"><i class="fas fa-envelope-open-text"></i></button>&nbsp;<button id="editDivision" title="Edit" onclick="editDivision('+data+')" class="btn  btn-dtable-edit"><i class="far fa-edit"></i></button>&nbsp;<button id="delDivision" title="Delete" onclick="delDivision('+data+')" class="btn  btn-dtable-del"><i class="far fa-trash-alt"></i></button>';
                //                 return '<button id="btnEdit" class="btn-dtable-edit" onclick="editItem('+data+')"><i class="fa fa-edit"></i></button>&nbsp;<button  id="btnRemove" class="btn-dtable-delete" onclick="removeItem('+data+')"><i class="fa fa-trash-o"></i></button>';
                //            }
                //         }]

</script>
