<?php
    include('../config.php');
    include(root.'master/header.php');
    $projectcreateaid = $_SESSION["share_projectcreateaid"] ?? 0;
    $landoperationaid = $_SESSION["share_landoperationaid"] ?? 0;
?>

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">Shares</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?=roothtml.'home/home.php'?>">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Landoperation</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="#">Shares</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row mb-5">
                <div id="recent-transactions" class="col-4">
                    <div class="card">
                        <div class="card-content p-2">
                            <input type="hidden" name="ser">
                            <input type="hidden" name="projectcreateaid" value="<?= $projectcreateaid?>">
                            <input type="hidden" name="landoperationaid" value="<?= $landoperationaid?>">
                            <table width="100%">
                                <tr>
                                    <td width="100%" class="float-right">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Search</label>
                                            <div class="col-sm-10">
                                                <input type="search" class="form-control" id="searching"
                                                    placeholder="Searching . . . . . ">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <div id="show_tableone" class="table-responsive">

                            </div>
                        </div>
                    </div>
                </div>
                <div id="recent-transactions" class="col-8">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <div class="form-inline float-right">
                                <div class="">
                                    <form method="POST" action="share_action.php">
                                        <input type="hidden" name="hid">
                                        <input type="hidden" name="ser">
                                        <button type="submit" name="action" value="excel"
                                            class="btn btn-social btn-min-width btn-yahoo"><span
                                                class="la la-file-excel-o font-medium-3"></span>Excel</button>
                                        <button type="submit" name="action" value="pdf"
                                            class="btn btn-social btn-min-width btn-yahoo"><span
                                                class="la la-file-pdf-o font-medium-3"></span>PDF</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-content p-2">
                            <table width="100%">
                                <tr>
                                    <td width="55%" class="float-right">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Search</label>
                                            <div class="col-sm-10">
                                                <input type="search" class="form-control" id="searching"
                                                    placeholder="Searching . . . . . ">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <div id="show_tabletwo" class="table-responsive">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->

<!-- pay Modal -->
<div class="modal fade text-left" id="paymodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel25"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title text-text-bold-600" id="myModalLabel25">Add Share Payment</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmsave" method="POST">
                <input type="hidden" name="action" value="savepay" />
                <input type="hidden" name="projectinvestmentaid" />
                <input type="hidden" name="landoperationaid" />
                <div class="modal-body">
                    <div class="form-group">
                        <label for="usr">ShareHolder Name</label>
                        <input type="text" class="form-control" name="shareholdername" readonly>
                    </div>
                    <div class="form-group">
                        <label for="usr">ShareLand No</label>
                        <input type="number" required class="form-control" name="sharelandno"
                            placeholder="Enter ShareLand No">
                    </div>
                    <div class="form-group">
                        <label for="usr">LandOperation NetProfit</label>
                        <input type="number" required class="form-control" name="landoperationnetprofit"
                            placeholder="Enter LandOperation NetProfit">
                    </div>
                    <div class="form-group">
                        <label for="usr">ShareHolder Amount</label>
                        <input type="number" required class="form-control" name="shareholderamount"
                            placeholder="Enter ShareHolder Amount">
                    </div>
                    <div class="form-group">
                        <label for="usr">Share Percent</label>
                        <input type="number" required class="form-control" name="sharepercent"
                            placeholder="Enter Share Percent" readonly>
                    </div>
                    <div class="form-group">
                        <label for="usr">Share Fee</label>
                        <input type="number" required class="form-control" name="sharefee"
                            placeholder="Enter ShareFee">
                    </div>
                    <div class="form-group">
                        <label for="usr">Share Date</label>
                        <input type="date" class="form-control" name="sharedt"
                            value="<?= date("Y-m-d")?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-primary"><i class="la la-save"></i>Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- edit Modal -->
<div class="modal fade text-left" id="payeditmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel25"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title text-text-bold-600" id="myModalLabel25">Edit Share Payment</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmedit" method="POST">
                <input type="hidden" name="action" value="editpay" />
                <input type="hidden" name="eaid"/>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="usr">ShareHolder Name</label>
                        <input type="text" class="form-control" name="eshareholdername" readonly>
                    </div>
                    <div class="form-group">
                        <label for="usr">ShareLand No</label>
                        <input type="number" required class="form-control" name="esharelandno"
                            placeholder="Enter ShareLand No">
                    </div>
                    <div class="form-group">
                        <label for="usr">LandOperation NetProfit</label>
                        <input type="number" required class="form-control" name="elandoperationnetprofit"
                            placeholder="Enter LandOperation NetProfit">
                    </div>
                    <div class="form-group">
                        <label for="usr">ShareHolder Amount</label>
                        <input type="number" required class="form-control" name="eshareholderamount"
                            placeholder="Enter ShareHolder Amount">
                    </div>
                    <div class="form-group">
                        <label for="usr">Share Percent</label>
                        <input type="number" required class="form-control" name="esharepercent"
                            placeholder="Enter Share Percent" readonly>
                    </div>
                    <div class="form-group">
                        <label for="usr">Share Fee</label>
                        <input type="number" required class="form-control" name="esharefee"
                            placeholder="Enter ShareFee">
                    </div>
                    <div class="form-group">
                        <label for="usr">Share Date</label>
                        <input type="date" class="form-control" name="esharedt"
                            value="<?= date("Y-m-d")?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-primary"><i class="la la-edit"></i>Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php include(root.'master/footer.php'); ?>
<script>
var ajax_url = "<?php echo roothtml.'landoperation/share_action.php'; ?>";
$(document).ready(function() {
    function load_pageone(page) {
        var entryvalue = $("[name='hid']").val();
        var search = $("[name='ser']").val();
        var projectcreateaid = $("[name='projectcreateaid']").val();
        var landoperationaid = $("[name='landoperationaid']").val();
        $.ajax({
            type: "post",
            url: ajax_url,
            data: {
                action: 'showone',
                page_no: page,
                entryvalue: entryvalue,
                search: search,
                projectcreateaid: projectcreateaid,
                landoperationaid: landoperationaid
            },
            success: function(data) {
                $("#show_tableone").html(data);
            }
        });
    }
    load_pageone();

    $(document).on('click', '.page-link', function() {
        var pageid = $(this).data('page_number');
        load_pageone(pageid);
    });

    $(document).on("change", "#entry", function() {
        var entryvalue = $(this).val();
        $("[name='hid']").val(entryvalue);
        load_pageone();
    });

    $(document).on("keyup", "#searching", function() {
        var serdata = $(this).val();
        $("[name='ser']").val(serdata);
        load_pageone();
    });

    $(document).on("click", "#btnpay", function() {
        var aid = $(this).data("aid");
        var landoperationaid = $(this).data("landoperationaid");
        var shareholdername = $(this).data("shareholdername");
        var sharepercent = $(this).data("sharepercent");
        $("[name='projectinvestmentaid']").val(aid);
        $("[name='landoperationaid']").val(landoperationaid);
        $("[name='shareholdername']").val(shareholdername);
        $("[name='sharepercent']").val(sharepercent);
        $("#paymodal").modal("show");
    });

    $("#frmsave").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $("#paymodal").modal("hide");
        $.ajax({
            type: "post",
            url: ajax_url,
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data == 1) {
                    swal("Success", "Save data is successful.", "success");
                    load_pagetwo();
                    swal.close();
                } else {
                    swal("Error", "Save data is error.", "error");
                }
            }
        });
    });

    //Page Two
    function load_pagetwo(page) {
        var search = $("[name='ser']").val();
        var entryvalue = $("[name='hid']").val();
        $.ajax({
            type: "post",
            url: ajax_url,
            data: {
                action: 'showtwo',
                page_no: page,
                search: search,
                entryvalue: entryvalue
            },
            success: function(data) {
                $("#show_tabletwo").html(data);
            }
        });
    }
    load_pagetwo();

    $(document).on("click", "#btnedit", function(e) {
        e.preventDefault();
        var aid = $(this).data("aid");
        var shareholdername = $(this).data("shareholdername");
        var sharelandno = $(this).data("sharelandno");
        var landoperationnetprofit = $(this).data("landoperationnetprofit");
        var shareholderamount = $(this).data("shareholderamount");
        var sharepercent = $(this).data("sharepercent");
        var sharefee = $(this).data("sharefee");
        var sharedt = $(this).data("sharedt");
        $("[name='eaid']").val(aid);
        $("[name='eshareholdername']").val(shareholdername);
        $("[name='esharelandno']").val(sharelandno);
        $("[name='elandoperationnetprofit']").val(landoperationnetprofit);
        $("[name='eshareholderamount']").val(shareholderamount);
        $("[name='esharepercent']").val(sharepercent);
        $("[name='esharefee']").val(sharefee);
        $("[name='esharedt']").val(sharedt);
        $("#payeditmodal").modal("show");
    });

    $("#frmedit").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $("#payeditmodal").modal("hide");
        $.ajax({
            type: "post",
            url: ajax_url,
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data == 1) {
                    swal("Success", "Edit data is successful.", "success");
                    load_pagetwo();
                    swal.close();
                } else {
                    swal("Error", "Edit data is error.", "error");
                }
            }
        });
    });

    $(document).on("click", "#btndelete", function(e) {
        e.preventDefault();
        var aid = $(this).data("aid");
        swal({
                title: "Delete?",
                text: "Are you sure delete!",
                type: "error",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function() {
                $.ajax({
                    type: "post",
                    url: ajax_url,
                    data: {
                        action: 'delete',
                        aid: aid
                    },
                    success: function(data) {
                        if (data == 1) {
                            swal("Successful",
                                "Delete data success.",
                                "success");
                            load_pagetwo();
                            swal.close();
                        } else {
                            swal("Error",
                                "Delete data failed.",
                                "error");
                        }
                    }
                });
            });
    });

    $(document).on("click", "#btnpermission", function(e) {
        e.preventDefault();
        var aid = $(this).data("aid");
        var username = $(this).data("username");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'setup/usercontrol_action.php' ?>",
            data: {
                action: 'go_permission',
                aid: aid,
                username: username,
            },
            success: function(data) {
                location.href = "<?=roothtml.'setup/userpermission.php'?>";
            }
        });
    });



});
</script>