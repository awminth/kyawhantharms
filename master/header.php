<?php
    if(isset($_SESSION['kyawhantharms_userid'])){
    $aid=$_SESSION['kyawhantharms_userid'];
    $sql="select * from tbluser where AID={$aid}";
    $result=mysqli_query($con,$sql) or die("SQL a Query");
    $row = mysqli_fetch_array($result);
    $p1 = $row["p1"];
    $p1a1 = $row["p1a1"];
    $p1a2 = $row["p1a2"];
    $p1a3 = $row["p1a3"];

    $p2 = $row["p2"];
    $p2a1=$row["p2a1"];
    $p2a2=$row["p2a2"];
    $p2a3=$row["p2a3"];

    $p3=$row["p3"];
    $p3a1=$row["p3a1"];
    $p3a2=$row["p3a2"];
    $p3a3=$row["p3a3"];

    $p4=$row["p4"];
    $p4a1=$row["p4a1"];
    $p4a2=$row["p4a2"];
    $p4a3=$row["p4a3"];

    $p5=$row["p5"];
    $p5a1=$row["p5a1"];
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KyawHanThar MS</title>
    <link rel="apple-touch-icon" href="<?php echo roothtml.'lib/images/myicon.png' ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo roothtml.'lib/images/kg.png' ?>">
    <!-- <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700"
        rel="stylesheet"> -->

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?=roothtml.'lib/app-assets/vendors/css/vendors.min.css'?>">
    <link rel="stylesheet" type="text/css"
        href="<?=roothtml.'lib/app-assets/vendors/css/weather-icons/climacons.min.css'?>">
    <link rel="stylesheet" type="text/css" href="<?=roothtml.'lib/app-assets/fonts/meteocons/style.css'?>">
    <link rel="stylesheet" type="text/css" href="<?=roothtml.'lib/app-assets/vendors/css/charts/morris.css'?>">
    <link rel="stylesheet" type="text/css" href="<?=roothtml.'lib/app-assets/vendors/css/charts/chartist.css'?>">
    <link rel="stylesheet" type="text/css"
        href="<?=roothtml.'lib/app-assets/vendors/css/charts/chartist-plugin-tooltip.css'?>">
    <!-- END: Vendor CSS-->
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?=roothtml.'lib/app-assets/vendors/css/forms/icheck/icheck.css'?>">
    <link rel="stylesheet" type="text/css" href="<?=roothtml.'lib/app-assets/vendors/css/forms/icheck/custom.css'?>">
    <link rel="stylesheet" type="text/css"
        href="<?=roothtml.'lib/app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css'?>">
    <link rel="stylesheet" type="text/css"
        href="<?=roothtml.'lib/app-assets/vendors/css/forms/toggle/switchery.min.css'?>">
    <link rel="stylesheet" type="text/css"
        href="<?=roothtml.'lib/app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css'?>">
    <!-- Select2 -->
    <link rel="stylesheet" type="text/css"
        href="<?=roothtml.'lib/app-assets/vendors/css/forms/selects/select2.min.css'?>">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?=roothtml.'lib/app-assets/css/bootstrap.css'?>">
    <link rel="stylesheet" type="text/css" href="<?=roothtml.'lib/app-assets/css/bootstrap-extended.css'?>">
    <link rel="stylesheet" type="text/css" href="<?=roothtml.'lib/app-assets/css/colors.css'?>">
    <link rel="stylesheet" type="text/css" href="<?=roothtml.'lib/app-assets/css/components.css'?>">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="<?=roothtml.'lib/app-assets/css/core/menu/menu-types/horizontal-menu.css'?>">
    <link rel="stylesheet" type="text/css" href="<?=roothtml.'lib/app-assets/css/core/colors/palette-gradient.css'?>">
    <link rel="stylesheet" type="text/css" href="<?=roothtml.'lib/app-assets/fonts/simple-line-icons/style.css'?>">
    <link rel="stylesheet" type="text/css" href="<?=roothtml.'lib/app-assets/css/pages/timeline.css'?>">
    <link rel="stylesheet" type="text/css" href="<?=roothtml.'lib/app-assets/css/pages/dashboard-ecommerce.css'?>">
    <link rel="stylesheet" type="text/css" href="<?=roothtml.'lib/app-assets/css/plugins/forms/wizard.css'?>">
    <link rel="stylesheet" type="text/css"
        href="<?=roothtml.'lib/app-assets/css/plugins/forms/checkboxes-radios.css'?>">
    <link rel="stylesheet" type="text/css" href="<?=roothtml.'lib/app-assets/css/plugins/forms/switch.css'?>">
    <link rel="stylesheet" type="text/css" href="<?=roothtml.'lib/app-assets/css/pages/app-todo.css' ?>">
    <link rel="stylesheet" type="text/css"
        href="<?=roothtml.'lib/app-assets/vendors/css/pickers/daterange/daterangepicker.css' ?>">
    <link rel="stylesheet" type="text/css"
        href="<?=roothtml.'lib/app-assets/vendors/css/forms/selects/select2.min.css' ?>">
    <link rel="stylesheet" type="text/css"
        href="<?=roothtml.'lib/app-assets/vendors/css/editors/quill/quill.snow.css' ?>">
    <link rel="stylesheet" type="text/css"
        href="<?=roothtml.'lib/app-assets/vendors/css/extensions/dragula.min.css' ?>">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?=roothtml.'lib/assets/css/style.css'?>">
    <!-- END: Custom CSS-->
    <!-- Sweet Alarm -->
    <link href="<?=roothtml.'lib/sweet/sweetalert.css' ?>" rel="stylesheet" />
    <script src="<?=roothtml.'lib/sweet/sweetalert.min.js' ?>"></script>
    <script src="<?=roothtml.'lib/sweet/sweetalert.js' ?>"></script>
    <!-- for print -->
    <link href="<?php echo roothtml.'lib/print.min.css' ?>" rel="stylesheet" />
    <!-- END: Custom CSS-->

    <style>
    .loader {
        position: fixed;
        z-index: 999;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        background-color: Black;
        filter: alpha(opacity=60);
        opacity: 0.7;
        -moz-opacity: 0.8;
    }

    .center-load {
        z-index: 1000;
        margin: 300px auto;
        padding: 10px;
        width: 130px;
        background-color: black;
        border-radius: 10px;
        filter: 1;
        -moz-opacity: 1;
    }

    .center-load img {
        height: 128px;
        width: 128px;
    }
    </style>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu 2-columns  " data-open="hover" data-menu="horizontal-menu"
    data-col="2-columns">

    <div class="loader" style="display:none;">
        <div class="center-load">
            <img src="<?php echo roothtml.'lib/images/ajax-loader1.gif'; ?>" />
        </div>
    </div>

    <!-- BEGIN: Header-->
    <nav
        class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow navbar-static-top navbar-light navbar-brand-center">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-md-none mr-auto"><a
                            class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                class="ft-menu font-large-1"></i></a></li>
                    <li class="nav-item"><a class="navbar-brand" href="<?=roothtml.'home/home.php'?>"><img
                                class="brand-logo" alt="modern admin logo"
                                src="<?php echo roothtml.'lib/images/kg.png' ?>">
                            <h3 class="brand-text">KyawHanThar MS</h3>
                        </a></li>
                    <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse"
                            data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
                </ul>
            </div>
            <div class="navbar-container content">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                        <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                                href="#"><i class="ft-menu"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav float-right">
                        <li style="display:none;" class="dropdown dropdown-language nav-item"><a
                                class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-gb"></i><span
                                    class="selected-language"></span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#"
                                    data-language="en"><i class="flag-icon flag-icon-us"></i> English</a><a
                                    class="dropdown-item" href="#" data-language="fr"><i
                                        class="flag-icon flag-icon-fr"></i> French</a><a class="dropdown-item" href="#"
                                    data-language="pt"><i class="flag-icon flag-icon-pt"></i> Portuguese</a><a
                                    class="dropdown-item" href="#" data-language="de"><i
                                        class="flag-icon flag-icon-de"></i> German</a></div>
                        </li>
                        <li style="display:none;" class="dropdown dropdown-notification nav-item"><a
                                class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i
                                    class="ficon ft-bell"></i><span
                                    class="badge badge-pill badge-danger badge-up badge-glow">5</span></a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <h6 class="dropdown-header m-0"><span class="grey darken-2">Notifications</span>
                                    </h6><span class="notification-tag badge badge-danger float-right m-0">5 New</span>
                                </li>
                                <li class="scrollable-container media-list w-100"><a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i
                                                    class="ft-plus-square icon-bg-circle bg-cyan mr-0"></i></div>
                                            <div class="media-body">
                                                <h6 class="media-heading">You have new order!</h6>
                                                <p class="notification-text font-small-3 text-muted">Lorem ipsum dolor
                                                    sit amet, consectetuer elit.</p><small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">30 minutes
                                                        ago</time></small>
                                            </div>
                                        </div>
                                    </a><a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i
                                                    class="ft-download-cloud icon-bg-circle bg-red bg-darken-1 mr-0"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading red darken-1">99% Server load</h6>
                                                <p class="notification-text font-small-3 text-muted">Aliquam tincidunt
                                                    mauris eu risus.</p><small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">Five hour
                                                        ago</time></small>
                                            </div>
                                        </div>
                                    </a><a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i
                                                    class="ft-alert-triangle icon-bg-circle bg-yellow bg-darken-3 mr-0"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading yellow darken-3">Warning notifixation</h6>
                                                <p class="notification-text font-small-3 text-muted">Vestibulum auctor
                                                    dapibus neque.</p><small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">Today</time></small>
                                            </div>
                                        </div>
                                    </a><a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i
                                                    class="ft-check-circle icon-bg-circle bg-cyan mr-0"></i></div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Complete the task</h6><small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">Last week</time></small>
                                            </div>
                                        </div>
                                    </a><a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i
                                                    class="ft-file icon-bg-circle bg-teal mr-0"></i></div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Generate monthly report</h6><small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">Last month</time></small>
                                            </div>
                                        </div>
                                    </a></li>
                                <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center"
                                        href="javascript:void(0)">Read all notifications</a></li>
                            </ul>
                        </li>
                        <li style="display:none;" class="dropdown dropdown-notification nav-item"><a
                                class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i
                                    class="ficon ft-mail"></i></a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <h6 class="dropdown-header m-0"><span class="grey darken-2">Messages</span></h6>
                                    <span class="notification-tag badge badge-warning float-right m-0">4 New</span>
                                </li>
                                <li class="scrollable-container media-list w-100"><a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left"><span
                                                    class="avatar avatar-sm avatar-online rounded-circle"><img
                                                        src="../../../app-assets/images/portrait/small/avatar-s-19.png"
                                                        alt="avatar"><i></i></span></div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Margaret Govan</h6>
                                                <p class="notification-text font-small-3 text-muted">I like your
                                                    portfolio, let's start.</p><small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">Today</time></small>
                                            </div>
                                        </div>
                                    </a><a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left"><span
                                                    class="avatar avatar-sm avatar-busy rounded-circle"><img
                                                        src="../../../app-assets/images/portrait/small/avatar-s-2.png"
                                                        alt="avatar"><i></i></span></div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Bret Lezama</h6>
                                                <p class="notification-text font-small-3 text-muted">I have seen your
                                                    work, there is</p><small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">Tuesday</time></small>
                                            </div>
                                        </div>
                                    </a><a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left"><span
                                                    class="avatar avatar-sm avatar-online rounded-circle"><img
                                                        src="../../../app-assets/images/portrait/small/avatar-s-3.png"
                                                        alt="avatar"><i></i></span></div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Carie Berra</h6>
                                                <p class="notification-text font-small-3 text-muted">Can we have call in
                                                    this week ?</p><small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">Friday</time></small>
                                            </div>
                                        </div>
                                    </a><a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left"><span
                                                    class="avatar avatar-sm avatar-away rounded-circle"><img
                                                        src="../../../app-assets/images/portrait/small/avatar-s-6.png"
                                                        alt="avatar"><i></i></span></div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Eric Alsobrook</h6>
                                                <p class="notification-text font-small-3 text-muted">We have project
                                                    party this saturday.</p><small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00">last month</time></small>
                                            </div>
                                        </div>
                                    </a></li>
                                <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center"
                                        href="javascript:void(0)">Read all messages</a></li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-user nav-item"><a
                                class="dropdown-toggle nav-link dropdown-user-link" href="#"
                                data-toggle="dropdown"><span
                                    class="mr-1 user-name text-bold-700"><?=$_SESSION["kyawhantharms_username"]?></span><span
                                    class="avatar avatar-online"><img src="<?=roothtml.'lib/images/user.png' ?>"
                                        alt="avatar"><i></i></span></a>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item"
                                    href="<?=roothtml.'setup/profile.php'?>"><i class="ft-user"></i> Edit Profile</a><a
                                    class="dropdown-item" href="#" style="display: none;"><i class="ft-clipboard"></i>
                                    Todo</a><a class="dropdown-item" href="user-cards.html" style="display: none;"><i
                                        class="ft-check-square"></i>
                                    Task</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item" href="#" id="btnlogout"><i
                                        class="ft-power"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->

    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-dark navbar-without-dd-arrow navbar-shadow"
        role="navigation" data-menu="menu-wrapper">
        <div class="navbar-container main-menu-content" data-menu="menu-container">
            <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
                <li <?=($p1==1)?'' : 'style="display:none"' ?>
                    class="dropdown nav-item <?=(curlink == 'home.php')?'active':''?>"><a class=" nav-link"
                        href="<?=roothtml.'home/home.php'?>"><i class="la la-home"></i><span
                            data-i18n="Dashboard">Dashboard</span></a>
                </li>
                <li <?=($p2==1)?'' : 'style="display:none"' ?>
                    class="dropdown nav-item <?=(curlink == 'createproject.php')?'active':''?>">
                    <a class="nav-link" href="<?=roothtml.'createproject/createproject.php'?>">
                        <i class="la la-indent"></i><span data-i18n="Dashboard">Create Project</span></a>
                </li>
                <li <?=($p3==1)?'' : 'style="display:none"' ?>  
                    class="dropdown nav-item <?=(curlink == 'landoperation.php')?'active':''?>">
                    <a class="nav-link" href="<?=roothtml.'landoperation/landoperation.php'?>">
                        <i class="la la-indent"></i><span data-i18n="Dashboard">Land Operation</span></a>
                </li>
                <?php if($p4 == 1){ ?>
                <li class="dropdown nav-item <?=(curlink == 'usercontrol.php')?'active':''?>" data-menu="dropdown">
                    <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="la la-gear"></i><span
                            data-i18n="Layouts">Set Up</span></a>
                    <ul class="dropdown-menu">
                        <li <?=($p4a1==1)?'' : 'style="display:none"' ?>
                            class="<?=(curlink == 'shareholder.php')?'active':''?>">
                            <a class="dropdown-item" href="<?=roothtml.'setup/shareholder.php'?>">
                                <i class="la la-users"></i><span data-i18n="ToDo">Share Holder</span></a>
                        </li>
                        <li <?=($p4a2==1)?'' : 'style="display:none"' ?>
                            class="<?=(curlink == 'usercontrol.php')?'active':''?>">
                            <a class="dropdown-item" href="<?=roothtml.'setup/usercontrol.php'?>">
                                <i class="la la-users"></i><span data-i18n="ToDo">User Account</span></a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
                <?php if($p5 == 1){ ?>
                <li <?=($p5a1==1)?'' : 'style="display:none"' ?>
                    class="dropdown nav-item <?=(curlink == 'log.php')?'active':''?>">
                    <a class="nav-link" href="<?=roothtml.'log/log.php'?>">
                        <i class="la la-th-list"></i><span data-i18n="Dashboard">Log History</span></a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->


    <?php } else{  header("location:". roothtml."errorpage.php"); } ?>