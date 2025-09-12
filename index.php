<?php 
include('config.php');
?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords"
        content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT"> -->
    <title>SHWE GADAWUN</title>
    <link rel="apple-touch-icon" href="<?php echo roothtml.'lib/images/kg.png' ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo roothtml.'lib/images/kg.png' ?>">
    <!-- <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700"
        rel="stylesheet"> -->

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo roothtml.'lib/app-assets/vendors/css/vendors.min.css' ?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo roothtml.'lib/app-assets/vendors/css/forms/icheck/icheck.css' ?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo roothtml.'lib/app-assets/vendors/css/forms/icheck/custom.css' ?>">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo roothtml.'lib/app-assets/css/bootstrap.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo roothtml.'lib/app-assets/css/bootstrap-extended.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo roothtml.'lib/app-assets/css/colors.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo roothtml.'lib/app-assets/css/components.css' ?>">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="<?php echo roothtml.'lib/app-assets/css/core/menu/menu-types/horizontal-menu.css' ?>">
    <link rel="stylesheet" type="text/css"
        href="<?php echo roothtml.'lib/app-assets/css/core/colors/palette-gradient.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo roothtml.'lib/app-assets/css/pages/login-register.css' ?>">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo roothtml.'lib/assets/css/style.css' ?>">
    <!-- END: Custom CSS-->

    <!-- Sweet Alarm -->
    <link href="<?php echo roothtml.'lib/sweet/sweetalert.css' ?>" rel="stylesheet" />
    <script src="<?php echo roothtml.'lib/sweet/sweetalert.min.js' ?>"></script>
    <script src="<?php echo roothtml.'lib/sweet/sweetalert.js' ?>"></script>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu horizontal-menu-padding 1-column  bg-full-screen-image blank-page"
    data-open="click" data-menu="horizontal-menu" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content container center-layout mt-2">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="row flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                                <div class="card-header border-0">
                                    <div class="card-title text-center">
                                        <img src="<?php echo roothtml.'lib/images/kg.png' ?>" alt="logo" 
                                        style='width:100px;height:auto;'>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">
                                        <span> Account
                                            Details</span>
                                    </p>
                                    <div class="card-body">
                                        <form id="frmlogin" class="form-horizontal">
                                            <input type="hidden" name="action" value="login" />
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="text" class="form-control" id="user-name" name="username"
                                                    value="<?php if(isset($_COOKIE['member_login'])){ echo $_COOKIE['member_login'];}?>"
                                                    placeholder="Your Username" required>
                                                <div class="form-control-position">
                                                    <i class="la la-user"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="password" class="form-control" id="user-password"
                                                    name="password"
                                                    value="<?php if(isset($_COOKIE['member_password'])){ echo $_COOKIE['member_password'];}?>"
                                                    placeholder="Enter Password" required>
                                                <div class="form-control-position">
                                                    <i class="la la-key"></i>
                                                </div>
                                            </fieldset>
                                            <div class="form-group row">
                                                <div class="col-sm-6 col-12 text-center text-sm-left pr-0">
                                                    <fieldset>
                                                        <input type="checkbox" id="remember-me" class="chk-remember"
                                                            name="remember"
                                                            <?php if(isset($_COOKIE['member_password'])){?> checked
                                                            <?php } ?>>
                                                        <label for="remember-me"> Remember Me</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-outline-info btn-block"><i
                                                    class="ft-unlock"></i> Login</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="<?php echo roothtml.'lib/app-assets/vendors/js/vendors.min.js' ?>"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="<?php echo roothtml.'lib/app-assets/vendors/js/ui/jquery.sticky.js' ?>"></script>
    <script src="<?php echo roothtml.'lib/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js' ?>"></script>
    <script src="<?php echo roothtml.'lib/app-assets/vendors/js/forms/icheck/icheck.min.js' ?>"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="<?php echo roothtml.'lib/app-assets/js/core/app-menu.js' ?>"></script>
    <script src="<?php echo roothtml.'lib/app-assets/js/core/app.js' ?>"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="<?php echo roothtml.'lib/app-assets/js/scripts/forms/form-login-register.js' ?>"></script>
    <!-- END: Page JS-->

    <script>
    $(document).ready(function() {
        $("#frmlogin").on("submit", function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: "post",
                url: "<?php echo roothtml.'index_action.php' ?>",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(".loader").show();
                },
                success: function(data) {
                    $(".loader").hide();
                    if (data == 1) {
                        swal("Successful!",
                            "Login Successful.",
                            "success");
                        location.href = "<?=roothtml.'setup/usercontrol.php' ?>";
                    } else {
                        swal("Error!",
                            "User Name or Password incorrect.",
                            "error");
                    }
                }
            });
        });

    });
    </script>


</body>
<!-- END: Body-->

</html>