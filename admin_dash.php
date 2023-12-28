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


<script src="js/demo/income-bar-chart.js"></script>
<script src="js/demo/pie-chart.js"></script>
<script src="js/demo/machine-plant-bar-chart.js"></script>


<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Today orders</div>
                            <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">2</div> -->
                           
                            <div id="order-count" class="h5 mb-0 font-weight-bold text-gray-800">
                            </div>

                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">No of Machines</div>
                               <!-- give a id for  the div  tag  as   id="machine-count" -->
                            <div id="machine-count" class="h5 mb-0 font-weight-bold text-gray-800">
                            </div>

                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">No of Plants</div>
                           


                                <!-- give a id for  the div  tag  as   id="machine-count" -->
                                <div id="plant-count" class="h5 mb-0 font-weight-bold text-gray-800">
                            </div>
                             

                           
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1" name="noOfProduct" id="noOfProduct">No of Products</div>
                          


                                <!-- give a id for  the div  tag  as   id="machine-count" -->
                            <div id="product-count" class="h5 mb-0 font-weight-bold text-gray-800">
                            </div>


                           
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>










    <div class="row">

        <div class="col-lg-6">

            <!-- Default Card Example -->
            <!-- <div class="card mb-4"> -->
            <!-- <div class="card-header">
                           Order Income
                          </div> -->
            <!-- <div class="card-body"> -->



            <!-- Bar Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Monthly Income</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="myBarChart"></canvas>
                    </div>
                    <!-- <hr>
                                                            Styling for the bar chart can be found in the -->
                    <!-- <code>/js/demo/chart-bar-demo.js</code> file. -->
                </div>
            </div>
            <!-- </div> -->
            <!-- </div> -->

            <!-- Basic Card Example-->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Machine Location Details</h6>
                </div>
                <div class="card-body">
                    <!-- The styling for this basic card example is created by using default Bootstrap utility classes. By using utility classes, the style of the card component can be easily modified with no need for any custom CSS! -->

                    <div class="chart-bar">
                        <canvas id="myBarChart2"></canvas>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-6">

            <!-- Dropdown Card Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <!-- <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                          <h6 class="m-0 font-weight-bold text-primary"></h6>
                          <div class="dropdown no-arrow"> -->
                <!-- <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                                   <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"> -->
                <!--    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                  </div> -->
                <!-- </div>
                        </div> -->
                <!-- Card Body -->
                <!-- <div class="card-body"> -->


                <!-- Donut Chart -->
                <!-- <div class="col-xl-4 col-lg-5"> -->
                
                <!-- <div class="card shadow mb-4"> -->
                    <!-- Card Header - Dropdown -->
                    <!-- <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Product Category</h6>
                    </div> -->
                    <!-- Card Body -->
                    <!-- <div class="card-body">
                        <div class="chart-pie pt-4">
                            <canvas id="pieChart"></canvas> -->
                             <!--  pieChart -->
                           
                        <!-- </div>
                    </div>
                </div> -->






                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Product Category</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-bar">
                            <canvas id="pieChart"></canvas>
                        </div>
                        <!-- <hr>
                                                                Styling for the bar chart can be found in the -->
                        <!-- <code>/js/demo/chart-bar-demo.js</code> file. -->
                    </div>
                </div>






                <!-- </div> -->
            </div>










            <!-- Collapsable Card Example -->
            <!-- <div class="card shadow mb-4"> -->
            <!-- Card Header - Accordion -->
            <!-- <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Collapsable Card Example</h6>
                      </a> -->
            <!-- Card Content - Collapse -->
            <!-- <div class="collapse show" id="collapseCardExample">
                        <div class="card-body">
                          This is a collapsable card example using Bootstrap's built in collapse functionality. <strong>Click on the card header</strong> to see the card body collapse and expand!
                        </div>
                      </div>
                    </div> -->

        </div>

    </div>


    <!-- 
    <div class="col-sm-6">
                <canvas id="myChart" width="20px" height="15px"></canvas>
            </div>
            <div class="col-sm-3">
                <canvas id="myBarChart" width="10px" height="10px"></canvas>
    
            </div> -->







</div>
<!-- /.container-fluid -->



<script>
    $(document).ready(function() {

        $.ajax({
            url: "handlers/chart_handler.php?type=loadStatistics",
            method: "GET",
            success: function(data) {
                data = JSON.parse(data);

                
                $('#order-count').text(data.orderCount);
                $('#machine-count').text(data.machineCount);
                /*data.forEach(row => {
                    $("#deliDriver").append("<option value='" + row.pro_code + "'>" + row.desig_name + "</option>");
                    text box id
                    $("#noOfProduct").append("<option value='" + row.pro_code + "'>"
                        ' ' + row.emp_lname + "</option>");

                });*/
                //   

                //id of the div tag            backend variablle name
                $('#product-count').text(data.productCount);


                $('#plant-count').text(data.plantCount);


            }
        });

    });

</script>


<?php require_once('incl/footer.php'); ?>
