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
    <script src="vendor/tabletojson.js"></script>
    <script src="vendor/tabletojson-cell.js"></script>
    <script src="vendor/tabletojson-row.js"></script>





    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <!-- accor ecomadmin  -->
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>




    <link href="vendor/fontawesome-free/css/fontawesome.min.css" rel="stylesheet">


    <script src="vendor/fontawesome-free/js/fontawesome.min.js"></script>



    <link href="  https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


    <style>
    /* <!--  to resolve  jquery validation css error  --> */
    form .error {
        color: #ff0000;
        font-size: 1rem;
    }

</style>

</head>

<body id="page-top">
    <div class="row" style="margin:0;">
        <div class="col-md-6 front-img-box" style="display: table;">
            <div class="text-center" style="display: table-cell; vertical-align: middle;">
                <img src="img/mopms.png" alt="" style="width: 250px;">
                <br>
                <br>
                <h1 style="color: #fff; font-size: 4rem; width:100%;">
                    Welcome
                    <br>
                    <small><small style="color:#ffeb3b;">Login to continue</small></small>
                </h1>
            </div>
        </div>
        <div class="col-md-6 front-log-box" style="display: table;">
            <div style="display: table-cell; vertical-align: middle;">
                <form action="#" class="" id="loginFrm" style="width: 360px; margin: 0 auto;">
                    <p style="font-size: 3rem;">Login</p>
                    <br>
                    <fieldset>
                        <div class="form-group">
                            <label class="sr-only">User Name</label>
                            <input style="padding: 25px 20px; font-size: 20px;" type="text" class="form-control"  autocomplete="off"  placeholder="user name" id="loginUsername" name="loginUsername" required>
                        </div>
                        <div class="form-group">
                            <label class="sr-only">Password</label>
                            <input style="padding: 25px 20px; font-size: 20px;" type="password" class="form-control"  autocomplete="off"  placeholder="password" id="loginPassword" name="loginPassword" required>
                        </div>

                        <hr>

                        <button type="button" onclick="login()" class="btn btn-primary btn-block" name="btnLogin" id="btnLogin"><b>CONTINUE</b></button>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <script>
        function login() {

            // alert('test');
            f = new FormData($("#loginFrm")[0]);
            $.ajax({
                    method: "POST",
                    url: "handlers/login_handler.php?type=userLogin",
                    data: f,
                    contentType: false,
                    processData: false,
                    dataType: 'json',

                })
                .done(function(data) {
                    if (data.status == 'success') {

                        window.location = data.redirect;


                        // var location = "http://localhost/mopms/admin_dash.php?user_cat_id="+user_cat_id;
                        //   window.location.replace(location);

                    } else if (data.status == 'error') {

                        alert('error');

                    }
                });
        }

    </script>
</body>

</html>
