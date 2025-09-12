<?php
include('../config.php');
include(root.'master/header.php');

$aid = (isset($_SESSION["go_permission_aid"])?$_SESSION["go_permission_aid"]:0);
$sql = "select * from tbluser where AID={$aid}";
$result = mysqli_query($con,$sql) or die("SQL a Query");
$row = mysqli_fetch_array($result);
$M1 = $row["M1"];
$M2 = $row["M2"];
$M3 = $row["M3"];
$M4 = $row["M4"];
$M5 = $row["M5"];

$A1 = $row["A1"];
$A2 = $row["A2"];
$A3 = $row["A3"];
$A4 = $row["A4"];
$A5 = $row["A5"];
$A6 = $row["A6"];
$A7 = $row["A7"];
$A8 = $row["A8"];
$A9 = $row["A9"];
$A10 = $row["A10"];
$A11 = $row["A11"];
$A12 = $row["A12"];
$A13 = $row["A13"];
$A14 = $row["A14"];
$A15 = $row["A15"];
$A16 = $row["A16"];
$A17 = $row["A17"];
$A18 = $row["A18"];
$A19 = $row["A19"];
$A20 = $row["A20"];

?>  

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">User Permission <b
                        class="text-primary">(<?=$_SESSION["go_permission_name"]?>)</b></h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?=roothtml.'home/home.php'?>">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="<?=roothtml.'setup/usercontrol.php'?>">Manage User</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="#">User Permission</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row mb-5">
                <div id="recent-transactions" class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form id="frmsave" method="post">
                                    <input type="hidden" name="action" value="save_permission">
                                    <input type="hidden" name="aid" value="<?=$aid?>">
                                    <div class="row">
                                        <h3 class="my-2 col-12 mr-3">
                                            Order Dashboard
                                        </h3>
                                        <div class="col-4 reception">
                                            <div class="form-group">
                                                <input type="checkbox" class="switchery" data-size="sm"
                                                    data-switchery="true" <?=($A1==1)?'checked':'' ?> name="A1">
                                                <label class="ml-50" for="accountSwitch1">Order Dashboard</label>
                                            </div>
                                        </div>
                                        <!-- //////////////////////////////// -->
                                        <h3 class="my-2 col-12 mr-3">
                                            POS
                                        </h3>
                                        <div class="col-4 reception">
                                            <div class="form-group">
                                                <input type="checkbox" class="switchery" data-size="sm"
                                                    data-switchery="true" <?=($A2==1)?'checked':'' ?> name="A2">
                                                <label class="ml-50" for="accountSwitch1">POS</label>
                                            </div>
                                        </div>
                                        <!-- ////////////////////////////////////////////// -->
                                        <h3 class="my-2 col-12 mr-3" id="btnitemledger">
                                            Items Ledger
                                            <input type="checkbox" class="switchery" data-size="sm"
                                                data-switchery="true" <?=($M1==1)?'checked':'' ?> name="M1">
                                        </h3>
                                        <div class="col-4 itemledger"
                                            style="<?=($M1 == 1)?'display:block;':'display:none;'?>">
                                            <div class="form-group">
                                                <input type="checkbox" class="switchery" data-size="sm"
                                                    data-switchery="true" <?=($A3==1)?'checked':'' ?> name="A3">
                                                <label class="ml-50" for="accountSwitch1">Stock Items</label>
                                            </div>
                                        </div>
                                        <div class="col-4 itemledger"
                                            style="<?=($M1 == 1)?'display:block;':'display:none;'?>">
                                            <div class="form-group">
                                                <input type="checkbox" class="switchery" data-size="sm"
                                                    data-switchery="true" <?=($A4==1)?'checked':'' ?> name="A4">
                                                <label class="ml-50" for="accountSwitch1">Manage Purchase</label>
                                            </div>
                                        </div>
                                        <div class="col-4 itemledger"
                                            style="<?=($M1 == 1)?'display:block;':'display:none;'?>">
                                            <div class="form-group">
                                                <input type="checkbox" class="switchery" data-size="sm"
                                                    data-switchery="true" <?=($A5==1)?'checked':'' ?> name="A5">
                                                <label class="ml-50" for="accountSwitch1">Manage Sale Lists</label>
                                            </div>
                                        </div>
                                        <!-- /////////////////////////////////// -->
                                        <h3 class="my-2 col-12 mr-3" id="btnsetup">
                                            Setup
                                            <input type="checkbox" class="switchery" data-size="sm"
                                                data-switchery="true" <?=($M2==1)?'checked':'' ?> name="M2">
                                        </h3>
                                        <div class="col-4 setup"
                                            style="<?=($M2 == 1)?'display:block;':'display:none;'?>">
                                            <div class="form-group">
                                                <input type="checkbox" class="switchery" data-size="sm"
                                                    data-switchery="true" <?=($A6==1)?'checked':'' ?> name="A6">
                                                <label class="ml-50" for="accountSwitch1">Manage Item Type</label>
                                            </div>
                                        </div>
                                        <div class="col-4 setup"
                                            style="<?=($M2 == 1)?'display:block;':'display:none;'?>">
                                            <div class="form-group">
                                                <input type="checkbox" class="switchery" data-size="sm"
                                                    data-switchery="true" <?=($A7==1)?'checked':'' ?> name="A7">
                                                <label class="ml-50" for="accountSwitch1">Manage Category</label>
                                            </div>
                                        </div>
                                        <div class="col-4 setup"
                                            style="<?=($M2 == 1)?'display:block;':'display:none;'?>">
                                            <div class="form-group">
                                                <input type="checkbox" class="switchery" data-size="sm"
                                                    data-switchery="true" <?=($A8==1)?'checked':'' ?> name="A8">
                                                <label class="ml-50" for="accountSwitch1">Manage Expense</label>
                                            </div>
                                        </div>
                                        <div class="col-4 setup"
                                            style="<?=($M2 == 1)?'display:block;':'display:none;'?>">
                                            <div class="form-group">
                                                <input type="checkbox" class="switchery" data-size="sm"
                                                    data-switchery="true" <?=($A9==1)?'checked':'' ?> name="A9">
                                                <label class="ml-50" for="accountSwitch1">Manage User Account</label>
                                            </div>
                                        </div>
                                        
                                        <!-- ////////////////////////////////// -->
                                        <h3 class="my-2 col-12 mr-3" id="btnreport">
                                            Reports
                                            <input type="checkbox" class="switchery" data-size="sm"
                                                data-switchery="true" <?=($M3==1)?'checked':'' ?> name="M3">
                                        </h3>
                                        <div class="col-4 report"
                                            style="<?=($M3 == 1)?'display:block;':'display:none;'?>">
                                            <div class="form-group">
                                                <input type="checkbox" class="switchery" data-size="sm"
                                                    data-switchery="true" <?=($A10==1)?'checked':'' ?> name="A10">
                                                <label class="ml-50" for="accountSwitch1">Sale Items</label>
                                            </div>
                                        </div>
                                        <div class="col-4 report"
                                            style="<?=($M3 == 1)?'display:block;':'display:none;'?>">
                                            <div class="form-group">
                                                <input type="checkbox" class="switchery" data-size="sm"
                                                    data-switchery="true" <?=($A11==1)?'checked':'' ?> name="A11">
                                                <label class="ml-50" for="accountSwitch1">Invoice Lists</label>
                                            </div>
                                        </div>
                                        <div class="col-4 report"
                                            style="<?=($M3 == 1)?'display:block;':'display:none;'?>">
                                            <div class="form-group">
                                                <input type="checkbox" class="switchery" data-size="sm"
                                                    data-switchery="true" <?=($A12==1)?'checked':'' ?> name="A12">
                                                <label class="ml-50" for="accountSwitch1">Expense Lists</label>
                                            </div>
                                        </div>
                                        <div class="col-4 report"
                                            style="<?=($M3 == 1)?'display:block;':'display:none;'?>">
                                            <div class="form-group">
                                                <input type="checkbox" class="switchery" data-size="sm"
                                                    data-switchery="true" <?=($A13==1)?'checked':'' ?> name="A13">
                                                <label class="ml-50" for="accountSwitch1">Purchase Report</label>
                                            </div>
                                        </div>  
                                        <!-- ////////////////////   -->
                                        <h3 class="my-2 col-12 mr-3">
                                            Customer
                                        </h3>
                                        <div class="col-4 reception">
                                            <div class="form-group">
                                                <input type="checkbox" class="switchery" data-size="sm"
                                                    data-switchery="true" <?=($A14==1)?'checked':'' ?> name="A14">
                                                <label class="ml-50" for="accountSwitch1">Manage Customer</label>
                                            </div>
                                        </div>                                    
                                        <!-- ////////////////////////////////// -->
                                        
                                        <!-- ////////////////////////////////// -->
                                        <h3 class="my-2 col-12 mr-3">
                                            Log History
                                        </h3>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <input type="checkbox" class="switchery" data-size="sm"
                                                    data-switchery="true" <?=($A15==1)?'checked':'' ?> name="A15">
                                                <label class="ml-50" for="accountSwitch1">Log History</label>
                                            </div>
                                        </div>
                                        <!-- ///////////////////////// -->
                                        <div
                                            class="col-12 d-flex flex-sm-row flex-column justify-content-center pt-1 border-top">
                                            <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                changes</button>
                                            <a href="<?=roothtml.'setup/usercontrol.php'?>"
                                                class="btn btn-danger">Back</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->


<?php include(root.'master/footer.php'); ?>
<script>
$(document).ready(function() {

    $("#frmsave").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'setup/userpermission_action.php' ?>",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                //  swal(data);
                location.href = "<?php echo roothtml.'setup/usercontrol.php' ?>";
            }
        });
    });

    $(document).on("click", "#btnitemledger", function(e) {
        e.preventDefault();
        var reception = document.querySelectorAll(".itemledger");
        reception.forEach(function(div) {
            div.style.display = (div.style.display === "none") ? "block" : "none";
        });
    });

    $(document).on("click", "#btnreport", function(e) {
        e.preventDefault();
        var data = document.querySelectorAll(".report");
        data.forEach(function(div) {
            div.style.display = (div.style.display === "none") ? "block" : "none";
        });
    });

    $(document).on("click", "#btnsetup", function(e) {
        e.preventDefault();
        var data = document.querySelectorAll(".setup");
        data.forEach(function(div) {
            div.style.display = (div.style.display === "none") ? "block" : "none";
        });
    });




});
</script>