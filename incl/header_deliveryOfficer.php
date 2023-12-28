<?php
 require('handlers/config.php'); 

   if(isset($_SESSION['usr_name'])){
     if(($_SESSION['user_cat_id'])!=7){   
        //for the user cat id=7 for delivery officer
      header("location:/MOPMS/accessDenied.php");

      exit();
     }  
  }
   else{
    header("location:/MOPMS/login2.php");

    exit();
   }

    $order_prefix = "ORD-";
?>




<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Lucky Traders</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">


    <!-- from footer -->

    <!-- for data tables -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- <script src="vendor/jquery/jquery-3.5.1.min.js"></script>  -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> -->


    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>


    <!-- cdn for validation -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script> -->

    <script src="downloaded-plugins/jquery.validate.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.jss"></script> -->


    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script> -->

    <script src="downloaded-plugins/additional-methods.min.js"></script>

    <!-- json tales -->
    <!-- <script src="vendor/tabletojson.js"></script>
<script src="vendor/tabletojson-cell.js"></script>
<script src="vendor/tabletojson-row.js"></script> -->



    <!-- for order.php  to order details table to pass to backend -->
    <script src="vendor/tableToJson/tabletojson.js"></script>
    <script src="vendor/tableToJson/tabletojson-cell.js"></script>
    <script src="vendor/tableToJson/tabletojson-row.js"></script>


    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <!-- accor ecomadmin  -->
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>


    <!-- report related buttons  -->
    <script src="vendor/datatables/dataTables.buttons.min.js"></script>
    <!-- https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js -->
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.bootstrap4.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <script src="vendor/datatables/buttons.html5.min.js"></script>
    <!-- https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js -->




    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>






    <!-- report pdf export  -->
    <script src="vendor/datatables/jspdf.js"></script>
    <script src="vendor/datatables/jspdf.debug.js"></script>
    <script src="vendor/datatables/jspdf.plugin.autotable.min.js"></script>
    <!-- https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js -->



    <!-- sweet alerts -->
    <!-- <link href="vendor/sweetalert/sweetalert2.all.js" rel="stylesheet">  -->
    <script src="vendor/sweetalert/sweetalert.min.js"></script>
    <!-- <script src="vendor/sweetalert/sweetalert2.all.min.js"></script> 
        <script src="vendor/sweetalert/sweetalert2.js"></script> 
        <script src="vendor/sweetalert/sweetalert2.min.js"></script>  -->

    <!-- charts -->

    <script src="vendor/chart/Chart.bundle.js"></script>
    <script src="vendor/chart/Chart.bundle.min.js"></script>
    <script src="vendor/chart/Chart.js"></script>
    <script src="vendor/chart/Chart.min.js"></script>


    <!-- Page level custom scripts -->
    <!-- <script src="js/demo/chart-area-demo.js"></script> 
        <script src="js/demo/chart-pie-demo.js"></script> -->
    <!-- <script src="js/demo/income-bar-chart.js"></script>
         <script src="js/demo/pie-chart.js"></script> -->


    <!--jquery validator  -->

    <script src="vendor/jqueryValidator/jquery.validate.min.js"></script>
    <script src="vendor/jqueryValidator/additional-methods.min.js"></script>


    <script src="vendor/jqueryValidator/customValidation.js"></script>




    <link href="vendor/fontawesome-free/css/fontawesome.min.css" rel="stylesheet">


    <script src="vendor/fontawesome-free/js/fontawesome.min.js"></script>


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.24/datatables.min.css" />

    <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- <link href="vendor/datatables/jquery.dataTables.min.css" rel="stylesheet">  -->
    <!-- <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet">   -->
    <link href="vendor/datatables/buttons.dataTables.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- maathana  awulk tynwna ... online ka daama wada... sav kaala dapuwama  icon hartita display wenna naa -->
    <!-- <link href="vendor/fontawesome-free/font-awesome.min.css" rel="stylesheet">  -->



<!-- for customer andd product select -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js" integrity="sha512-fZy9udcMtCbrKvLIxWhOUaH6TZYddjizBEhESeTsv1lwzXgcR6ZalhWye+BlT/KQ0KIfyjiqwce7IKKtRH29hQ==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" integrity="sha512-arEjGlJIdHpZzNfZD2IidQjDZ+QY9r4VFJIm2M/DhXLjvvPyXFj+cIotmo0DLgvL3/DOlIaEDwzEiClEPQaAFQ==" crossorigin="anonymous" />




<!-- cdn for date picker -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" /> -->

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous"></script> -->



    <!-- //cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js -->


    <!-- from footer -->

    <!-- Bootstrap core JavaScript-->
    <!-- <script src="vendor/jquery/jquery.min.js"></script>  -->
    <!--  insteda of this i use  jquery-3.5.1.min -->

    <!-- <script src="vendor/jquery/jquery-3.5.1.min.js"></script>  -->




    <!-- Page level plugins -->
    <!-- <script src="vendor/chart.js/Chart.min.js"></script> -->










    <!-- not working dta table -so i add this  -->
    <!-- <script src="vendor/bootstrap/js/bootstrap.min.js"></script> -->


    <!-- for jqury validation -->
    <!-- <script src="vendor/jquery-validation-1.19.2/src/ajax.js"></script>
    <script src="vendor/jquery-validation-1.19.2/src/core.js"></script>
    <script src="vendor/jquery-validation-1.19.2/src/additional/core.js"></script> -->



    <!-- styling for card header -->


    <style>
        /* <!--  to resolve  jquery validation css error  --> */
        /* form .error {
  color: #ff0000;
  font-size: 1rem;
} */


        /*  !important */


        /* .card-header {
  background-color: #009999 ;     
             }  */


        .card-header-dtable {
            background-color: #009999;
        }

        /* .card-header-text{
          color : white;
        } */



        .card-header-text {
            color: white;
        }



        .d-table-btn {
            margin-left: 10px;
        }

        .hide {
            display: none;
        }


        .btn-dtable-edit {
            background-color: #6ebae6;
        }

        /* delete   #ffaa4f -orange        plan- yellow -#ffe54f     view -#21b03e   green    pay  -#a1961d  */

        .btn-dtable-delete {
            background-color: #ffaa4f;
            margin-left: 10px;
        }

        .btn-dtable-plan {
            /* background-color:#ffe54f; */
            background-color: #f5e876;


        }


        .btn-dtable-allocate {
            /* background-color:#ffe54f; */
            background-color: #f5e876;


        }

        /* btn-dtable-view */

        .btn-dtable-view {
            /* background-color:#21b03e;  # */
            background-color: #88f27e;
            margin-left: 10px;
        }

        .btn-dtable-pay {
            background-color: #a1961d;

        }


        /* style for side bar  */
        .sidebar {
            background: #009999;
        }

        .sidebar-brand-icon,
        .sidebar-brand-text {
            color: white;
        }

        .sidebar .nav-item .nav-link,
        .sidebar-heading {
            color: white;
        }

    </style>




</head>

<body id="page-top">




    <!-- Page Wrapper -->
    <div id="wrapper">


        <!-- Page Wrapper -->
        <!-- <div id="wrapper"> -->

        <?php 
            require_once('sidebar_deliverOfficer.php');
            ?>
        <?php 
         require_once('topbar_deliveryOfficer.php');
         ?>

        <!-- end of head -->
