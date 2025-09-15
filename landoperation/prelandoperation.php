<?php
    include('../config.php');
    include(root.'master/header.php');

    $aid = $_SESSION["landoperation_createprojectaid"] ?? 0;
    $projectidone = GetInt("select ProjectID from tblprojectcreate where AID='{$aid}'");
    $projectid = str_pad($projectidone, 6, '0', STR_PAD_LEFT);
    $projectname = GetString("select ProjectName from tblprojectcreate where AID='{$aid}'");

    $landmanageamt = "";
    $landnumber = "";
    $sellprice = 0;
    $confirmprice = 0;
    $pdf_file = "";
    $image_file = "";
    $agentname = "";
    $agentfee = 0;
    $otherfee = 0;
    $agentfeedt = date("Y-m-d");
    $rmk = "";
    $netprofit = 0;
    $buyername = "";
    $dt = date("Y-m-d");
    $paymentplan = "";
    $totalpay = 0;

    $landoperationaid = $_SESSION["preedit_landoperationaid"] ?? 0;
    $sql = "SELECT * FROM tbllandoperation WHERE AID='{$landoperationaid}'";
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $aid = $row["ProjectCreateID"];
        $projectidone = GetInt("select ProjectID from tblprojectcreate where AID='{$aid}'");
        $projectid = str_pad($projectidone, 6, '0', STR_PAD_LEFT);
        $projectname = GetString("select ProjectName from tblprojectcreate where AID='{$aid}'");
        $landmanageamt = $row["LandManageAmount"];
        $landnumber = $row["LandNumber"];
        $sellprice = $row["SalePrice"];
        $confirmprice = $row["ConfirmPrice"];
        $pdf_file = $row["ContrustFile"];
        $image_file = $row["RecordPhoto"];
        $agentname = $row["AgentName"];
        $agentfee = $row["AgentFee"];
        $otherfee = $row["OtherFee"];
        $agentfeedt = $row["AgentFeeDate"];
        $rmk = $row["AgentRmk"];
        $netprofit = $row["NetProfit"];
        $buyername = $row["BuyerName"];
        $dt = $row["Date"];
        $paymentplan = $row["PaymentPlan"];
        $totalpay = $row["TotalPayment"];
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
                    <input type="hidden" name="action" value="presave" />
                    <input type="hidden" name="projectcreateid" value="<?= $aid?>" />
                    <input type="hidden" name="landoperationaid" value="<?= $landoperationaid?>" />
                    <div class="form-body">
                        <h4 class="form-section"><i class="ft-user"></i> Land Operation </h4>
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
                                    <label for="projectinput1">ProjectName</label>
                                    <input type="text" class="form-control" value="<?= $projectname?>"
                                        name="projectname" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2">LandManage Amount</label>
                                    <input type="number" class="form-control" placeholder="LandManage Amount"
                                        value="<?= $landmanageamt?>" name="landmanageamt">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput3">Land Number</label>
                                    <input type="number" class="form-control" placeholder="Land Number"
                                        value="<?= $landnumber?>" name="landnumber">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput4">Sell Price</label>
                                    <input type="number" class="form-control" placeholder="Sell Price" name="sellprice"
                                        value="<?= $sellprice?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput4">Confirm Price</label>
                                    <input type="number" class="form-control" placeholder="Confirm Price"
                                        value="<?= $confirmprice?>" name="confirmprice" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input type="hidden" name="hidpdf_file" value="<?= $pdf_file?>">
                                <div class="form-group">
                                    <label for="usr">Construct File:</label>
                                    <input type="file" name="pdf_file" id="pdf_file" class="form-control"
                                        accept=".pdf,.PDF">
                                </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <input type="hidden" name="hidimage_file" value="<?= $image_file?>">
                                <label for="usr">Record Photo</label>
                                <input type="file" class="form-control" name="image_file" id="image_file"
                                    accept=".jpg,.png,.jpeg,.JPG,.PNG,.JPEG">
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput1">Agent Name</label>
                                    <input type="text" class="form-control" value="<?= $agentname?>" name="agentname">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput4">Agent Fee</label>
                                    <input type="number" class="form-control" placeholder="Agent Fee" name="agentfee"
                                        value="<?= $agentfee?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput4">Other Fee</label>
                                    <input type="number" class="form-control" placeholder="Other Fee" name="otherfee"
                                        value="<?= $otherfee?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2">Agent Fee Date</label>
                                    <input type="date" class="form-control" placeholder="Date" name="agentfeedt"
                                        value="<?= $agentfeedt?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput4">Remark</label>
                                    <input type="text" class="form-control" placeholder="Remark" name="rmk"
                                        value="<?= $rmk?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput4">Net Profit</label>
                                    <input type="number" class="form-control" placeholder="Net Profit" name="netprofit"
                                        value="<?= $netprofit?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput4">Buyer Name</label>
                                    <input type="text" class="form-control" placeholder="Buyer Name" name="buyername"
                                        value="<?= $buyername?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput2">Date</label>
                                    <input type="date" class="form-control" placeholder="Date" name="dt"
                                        value="<?= $dt?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="usr">Payment Plan</label>
                                    <select required class=" form-control select2" name="paymentplan" id="paymentplan">
                                        <?php if($paymentplan != ""){ ?>
                                        <option value="<?= $paymentplan?>"><?= $paymentplan?></option>
                                        <?php }
                                        else{?>
                                        <option value="">Choose Payment</option><?php }?>
                                        <?php for($i=0;$i<count($arr_payment);$i++){ ?>
                                        <option value="<?=$arr_payment[$i]?>"><?=$arr_payment[$i]?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4" id="totalpay" <?=($paymentplan == 'Cash')? '':'style="display:none;"'?>>
                                <div class="form-group">
                                    <label for="projectinput4">Total Pay</label>
                                    <input type="number" class="form-control" placeholder="Total Pay" name="totalpay" 
                                    value="<?= $totalpay?>">
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
                            <i class="la la-check-square-o"></i> Save
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
var ajax_url = "<?php echo roothtml.'landoperation/landoperation_action.php'; ?>";
$(document).ready(function() {

    $("#frmsave").on("submit", function(e) {
        e.preventDefault();
        var paymentplan = $("[name='paymentplan']").val();
        var totalpay = $("[name='totalpay']").val();
        if (paymentplan == "Cash") {
            if (Number(totalpay) == "" || Number(totalpay) <= 0) {
                swal("Warning", "TotalPay must be filled", "warning");
                return false;
            }
        }
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
                    location.href = "<?= roothtml.'landoperation/landoperation.php'?>";
                } else {
                    swal("Error", "Save data is error.", "error");
                }
            }
        });
    });

    $(document).on("change", "#paymentplan", function(e) {
        e.preventDefault();
        var paymentplan = $("[name='paymentplan']").val();
        if (paymentplan == "Cash") {
            $("#totalpay").show();
        } else {
            $("#totalpay").hide();
        }
    });

});
</script>