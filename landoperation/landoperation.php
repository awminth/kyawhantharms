<?php
    include('../config.php');
    include(root.'master/header.php');

    $action = "savecreateproject";
    $projectid_chk = GetInt("select ProjectID from tblprojectcreate where AID is not null order by AID desc limit 1");
    if($projectid_chk > 0){
        $projectid_one = $projectid_chk + 1;
        $projectid = str_pad($projectid_one, 6, '0', STR_PAD_LEFT);
    }
    else{
        $projectid = "000001";
    }
    $projectname = "";
    $landinverstmentfee = "";
    $operationfee = "";
    $paperfee = "";
    $layerfee = "";
    $villageadminfee = "";
    $totalinverstmentfee = "";
    $sqrtfeet = "";
    $paperstorename = "";
    $constructdate = "";
    $maininvestorname = "";
    $rmk = "";
    $dt = "";
    $labourname = "";
    $depositfee = "";
    $depositdate = "";
    $labourrmk = "";
    $btn = "Save";
    $icon = "la la-check-square-o";
    $showfile = "";
    $showimg = "";

    $aid = (isset($_SESSION["edit_createprojectaid"])?$_SESSION["edit_createprojectaid"]:0);
    $sql = "select * from tblprojectcreate where AID = '{$aid}'";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_array($result);
        $action = "editcreateproject";
        $projectidone = $row["ProjectID"];
        $projectid = str_pad($projectidone, 6, '0', STR_PAD_LEFT);
        $projectname = $row["ProjectName"];
        $landinverstmentfee = $row["LandInverstmentFee"];
        $operationfee = $row["OperationFee"];
        $paperfee = $row["PaperFee"];
        $layerfee = $row["LayerFee"];
        $villageadminfee = $row["VillageAdminFee"];
        $totalinverstmentfee = $row["TotalInverstmentFee"];
        $sqrtfeet = $row["SqrtFeet"];
        $paperstorename = $row["PaperStoreName"];
        $constructdate = $row["ContrustDate"];
        $maininvestorname = $row["MainInversterName"];
        $rmk = $row["Rmk"];
        $dt = $row["Date"];
        $labourname = $row["LabourName"];
        $depositfee = $row["DepositFee"];
        $depositdate = $row["DepositDate"];
        $labourrmk = $row["LabourRmk"];
        $btn = "Edit";
        $icon = "la la-edit";
        $showfile = "style='display:none;'";
        $showimg = "style='display:none;'";
    }
?>

<div class="col-md-12">
    <div class="card" style="height: 1040.3px;">
        <div class="card-header">
            <h4 class="card-title" id="basic-layout-form">Project Information</h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-content collapse show">
            <div class="card-body">
                <form method="POST" id="frmsave">
                    <input type="hidden" name="action" value="<?= $action?>" />
                    <input type="hidden" name="eaid" value="<?=$aid?>" />
                    <div class="form-body">
                        <h4 class="form-section"><i class="ft-user"></i> Create Project</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput1">ProjectID</label>
                                    <input type="text" class="form-control" value="<?= $projectid?>" name="projectid"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2">LandManage Amount</label>
                                    <input type="number" class="form-control" placeholder="LandManage Amount"
                                        name="landmanageamt" value="<?= $projectname?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput3">Land Number</label>
                                    <input type="number" class="form-control" placeholder="Land Number"
                                        name="landnumber" value="<?= $landinverstmentfee?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput4">Sell Price</label>
                                    <input type="number" class="form-control" placeholder="Sell Price"
                                        name="sellprice" value="<?= $operationfee?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput4">Confirm Price</label>
                                    <input type="number" class="form-control" placeholder="Confirm Price" 
                                    name="confirmprice" value="<?= $paperfee?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput4">Payment Plan</label>
                                    <input type="number" class="form-control" placeholder="LayerFee" name="layerfee"
                                        value="<?= $layerfee?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput4">Buyer Name</label>
                                    <input type="text" class="form-control" placeholder="Buyer Name"
                                        name="buyername" value="<?= $villageadminfee?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput4">TotalInverstmentFee</label>
                                    <input type="number" class="form-control" placeholder="TotalInverstmentFee"
                                        name="totalinverstmentfee" value="<?= $totalinverstmentfee?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2">Square Feet</label>
                                    <input type="text" class="form-control" placeholder="Square Feet" name="sqrtfeet"
                                        value="<?= $sqrtfeet?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2">Paper Store Name</label>
                                    <input type="text" class="form-control" placeholder="Paper Store Name"
                                        name="paperstorename" value="<?= $paperstorename?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2">Construct Date</label>
                                    <input type="date" class="form-control" placeholder="Construct Date"
                                        name="constructdate" value="<?= date('Y-m-d')?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2">Main Investor Name</label>
                                    <input type="text" class="form-control" placeholder="Main Investor Name"
                                        name="maininvestorname" value="<?= $maininvestorname?>">
                                </div>
                            </div>
                            <div class="col-md-6" <?=$showfile?>>
                                <div class="form-group">
                                    <label for="usr">Upload File:</label>
                                    <input type="file" name="pdf_file" id="pdf_file" class="form-control" 
                                    accept=".pdf,.PDF">
                                </div>
                            </div>
                            <div class="form-group col-sm-6" <?=$showfile?>>
                                <label for="usr">Upload Image</label>
                                <input type="file" class="form-control" name="image_file" id="image_file"
                                    accept=".jpg,.png,.jpeg,.JPG,.PNG,.JPEG">
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2">Remark</label>
                                    <input type="text" class="form-control" placeholder="Remark" name="rmk"
                                        value="<?= $rmk?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2">Date</label>
                                    <input type="date" class="form-control" placeholder="Date" name="dt"
                                        value="<?= date('Y-m-d')?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2">Labour Name</label>
                                    <input type="text" class="form-control" placeholder="Labour Name" name="labourname"
                                        value="<?= $labourname?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput4">Deposit Fee</label>
                                    <input type="text" class="form-control" placeholder="Deposit Fee" name="depositfee"
                                        value="<?= $depositfee?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2">Deposit Date</label>
                                    <input type="date" class="form-control" placeholder="Deposit Date"
                                        name="depositdate" value="<?= date('Y-m-d')?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput4">Labour Remark</label>
                                    <input type="text" class="form-control" placeholder="Labour Remark" name="labourrmk"
                                        value="<?= $labourrmk?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn btn-warning mr-1"
                            onclick="location.href='<?=roothtml.'createproject/createproject.php'?>'">
                            <i class="ft-x"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="<?= $icon?>"></i> <?= $btn?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    include(root.'master/footer.php');
?>

<script>
var ajax_url = "<?php echo roothtml.'createproject/createproject_action.php'; ?>";
$(document).ready(function() {

    $("#frmsave").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: "post",
            url: ajax_url,
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data == 1) {
                    swal("Success", "Save data is successful.", "success");
                    location.href = "<?= roothtml.'createproject/createproject.php'?>";
                } else {
                    swal("Error", "Save data is error.", "error");
                }
            }
        });
    });

});
</script>