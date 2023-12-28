<?php 
require_once('incl/header.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Report</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <!-- <div class="row"> -->
    <!-- <div class="col-xl-3 col-md-6 mb-4"> -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Report</a></li>
        </ol>
    </nav>
    <!-- </div> -->
    <!-- </div> -->


    <!-- Content Row -->

    <div class="row">

        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Filter</h6>
                </div>
                <div class="card-body">
                    <form id="frmLabPres">
                        <fieldset>

                            <div class="form-group row">
                                <label for="fromDate" class="col-sm-4 col-form-label">From:</label>
                                <div class="col-sm-4">
                                <input type="date" class="form-control" name="fromDate" id="fromDate">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="toDate" class="col-sm-4 col-form-label">To:</label>
                                <div class="col-sm-4">
                                <input type="date" class="form-control" name="toDate" id="toDate">
                                </div>
                            </div>

                            
                        </fieldset>

                        <hr>

                        <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-primary" id="filter">Search</button>
                        </div>
                        </div>
                    </form>
                </div>                
            </div>
      
        </div>
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <div class="col-sm-3">
                        <h6 class="m-0 font-weight-bold text-primary">Report</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="tableReport" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <!-- <th>Date</th>
                                    <th>Number of Appointments</th>
                                    <th>Total (Rs.)</th> -->


                                    <th>ma schde id</th>
                                    <th>ord detail id</th>
                                    <th>mac id</th>
                                    <th>mac name</th>
                                    <th>reserved from </th>
                                    <th>reserved to</th>
                                    

                                </tr>
                            </thead>

                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2" style="text-align:right">Total:</th>
                                    <th></th>
                                </tr>
                            </tfoot>    
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
    $(document).ready(function(){

        
        $('#filter').click(function(){
            
            var from = $('#fromDate').val();
            var to = $('#toDate').val();
            $('#tableReport').DataTable().clear().destroy();
 
            report(from,to);

        });

    });

    function report(from,to){

        $('#tableReport').DataTable({
    
            serverSide:true,
            paging:true,
            processing:true,
            // rowId: 'apt_id',
            ajax:{
                url: "handlers/machineScheduleReport_handler.php?type=filter",
                type: 'POST',
                data: {from:from,to:to}
            },
            pageLength:10,
            columns:[
                // {data:"date",name:"date"},
                // {data:"aptCount",name:"aptCount"},
                // {data:"tot",name:"tot"}
                {data:"mac_sche_id",name:"mac_sche_id"},
                {data:"ord_detail_id",name:"ord_detail_id"},
                {data:"mac_id",name:"mac_id"},
                {data:"mac_name",name:"mac_name"},
                 {data:"reserved_from",name:"reserved_from"},
                 {data:"reserved_to",name:"reserved_to"}

               

            ],
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
    
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
    
                // Total over all pages
                total = api
                    .column( 2 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
    
                // Total over this page
                pageTotal = api
                    .column( 2, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
    
                // Update footer
                $(api.column( 2 ).footer() ).html(
                    'Rs.'+pageTotal +' ( Rs.'+ total +' total)'
                );
            }
               
        });
     
    };


</script>

<?php 
require_once('incl/footer.php');
?>

