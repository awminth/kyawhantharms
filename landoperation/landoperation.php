<?php 
    include('../config.php'); 
    include(root.'master/header.php');
?>

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">Land Operation</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?=roothtml.'order/orderview.php'?>">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Land Operation
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">

            <div class="row mb-5">
                <div class="col-sm-2">
                    <div class="card">
                        <div class="card-content collapse show">
                            <div class="form-group col-md-12 pt-1">
                                <label for=" date12" class="filled">From</label>
                                <div class="position-relative has-icon-left">
                                    <input type="date" value="<?=date('Y-m-d')?>" id="timesheetinput3"
                                        class="form-control" name="from">
                                    <div class="form-control-position">
                                        <i class="ft-message-square"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12 ">
                                <label for=" date12" class="filled">To</label>
                                <div class="position-relative has-icon-left">
                                    <input type="date" value="<?=date('Y-m-d')?>" id="timesheetinput3"
                                        class="form-control" name="to">
                                    <div class="form-control-position">
                                        <i class="ft-message-square"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <a href="#" id='btnsearch' class="btn btn-social btn-block mr-1 mb-1 btn-yahoo"><span
                                        class="la la-search font-medium-3"></span> Search</a>
                            </div>
                            <div class="form-group col-md-12">
                                <a href="<?=roothtml.'createproject/newcreateproject.php'?>"
                                    class="btn btn-social btn-block mr-1 mb-1 btn-primary"><span
                                        class="la la-plus-circle font-medium-3"></span> New</a>
                            </div>
                            <div class="form-group col-md-12 pt-1">
                                <form method="POST" action="landoperation_action.php">
                                    <input type="hidden" name="hid">
                                    <input type="hidden" name="ser">
                                    <input type="hidden" name="dtfrom">
                                    <input type="hidden" name="dtto">
                                    <button type="submit" name="action" value="excel"
                                        class="btn btn-social btn-block btn-dropbox"><span
                                            class="la la-file-excel-o font-medium-3"></span> Excel</button>
                                    <button type="submit" name="action" value="pdf"
                                        class="btn btn-social btn-block btn-dropbox"><span
                                            class="la la-file-pdf-o font-medium-3"></span> PDF</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-10">
                    <table width="100%">
                        <tr>
                            <td width="25%">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Entry</label>
                                    <div class="col-sm-8">
                                        <select id="entry" class="custom-select btn-sm">
                                            <option value="10" selected>10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                            </td>
                            <td width="55%" class="float-right">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Search</label>
                                    <div class="col-sm-9">
                                        <input type="search" class="form-control" id="searching"
                                            placeholder="Searching . . . . ">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div id="show_data">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->

<!-- new Modal -->
<div class="modal fade text-left" id="installmentmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel25"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title text-text-bold-600" id="myModalLabel25">Installment List</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="frminstallment" method="POST">
                    <input type="hidden" name="projectcreateaid">
                    <input type="hidden" name="landoperationaid">
                    <input type="hidden" name="installmentaid">
                    <input type="hidden" name="action" value="saveinstallment">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="projectinput1">Project Name</label>
                                <input type="text" class="form-control" name="projectname" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="projectinput1">Buyer Name</label>
                                <input type="text" class="form-control" name="buyername" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="projectinput1">Deposit Fee</label>
                                <input type="number" class="form-control" name="depositfee">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="projectinput1">Deposit Date</label>
                                <input type="date" class="form-control" name="depositdt" value="<?= date("Y-m-d")?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="projectinput1">Remark</label>
                                <input type="text" class="form-control" name="rmk">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-primary mt-2"><i class="la la-save"></i>
                                    Save</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div id="show_table">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<?php include(root.'master/footer.php'); ?>

<script>
var ajax_url = "<?php echo roothtml.'landoperation/landoperation_action.php'; ?>";
$(document).ready(function() {
    $('#searching').focus();

    function load_page(page) {
        var entryvalue = $("[name='hid']").val();
        var search = $("[name='ser']").val();
        var dtfrom = $("[name='dtfrom']").val();
        var dtto = $("[name='dtto']").val();
        $.ajax({
            type: "post",
            url: ajax_url,
            data: {
                action: 'show_data',
                page_no: page,
                entryvalue: entryvalue,
                search: search,
                dtfrom: dtfrom,
                dtto: dtto
            },
            success: function(data) {
                $("#show_data").html(data);
            }
        });
    }
    load_page();

    $(document).on('click', '.page-link', function() {
        var pageid = $(this).data('page_number');
        load_page(pageid);
    });

    $(document).on("click", "#entry", function(e) {
        e.preventDefault();
        var entryvalue = $(this).data("txt");
        $("[name='hid']").val(entryvalue);
        load_page();
    });

    $(document).on("keyup", "#searching", function(e) {
        e.preventDefault();
        var serdata = $(this).val();
        $("[name='ser']").val(serdata);
        load_page();
    });

    $(document).on("click", "#btnsearch", function(e) {
        e.preventDefault();
        var from = $("[name='from']").val();
        var to = $("[name='to']").val();
        $("[name='dtfrom']").val(from);
        $("[name='dtto']").val(to);
        load_page();
    });

    $(document).on("click", "#btnedit", function() {
        var landoperationaid = $(this).data("landoperationaid");
        $.ajax({
            type: "post",
            url: ajax_url,
            data: {
                action: 'pre_edit',
                landoperationaid: landoperationaid
            },
            success: function(data) {
                if (data == 1) {
                    location.href = "<?= roothtml.'landoperation/prelandoperation.php'?>";
                }
            }
        });
    });

    $(document).on("click", "#btndelete", function() {
        var aid = $(this).data("aid");
        swal({
                title: "Delete?",
                text: "Are you sure Delete!",
                type: "error",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, cancel it!",
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
                            load_page();
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

    $(document).on("click", "#btnshare", function() {
        var landoperationaid = $(this).data('landoperationaid');
        $.ajax({
            type: "post",
            url: ajax_url,
            data: {
                action: 'goshare',
                landoperationaid: landoperationaid
            },
            success: function(data) {
                if (data == 1) {
                    location.href = "<?= roothtml.'landoperation/share.php'?>";
                }
            }
        });

    });

    $(document).on("click", "#btninstallment", function() {
        var landoperationaid = $(this).data('landoperationaid');
        var projectcreateaid = $(this).data('projectcreateaid');
        var projectname = $(this).data('projectname');
        var buyername = $(this).data('buyername');
        $("[name='projectcreateaid']").val(projectcreateaid);
        $("[name='landoperationaid']").val(landoperationaid);
        $("[name='projectname']").val(projectname);
        $("[name='buyername']").val(buyername);
        show_installmentdata();
        $("#installmentmodal").modal("show");
    });

    function show_installmentdata() {
        var projectcreateaid = $("[name='projectcreateaid']").val();
        var landoperationaid = $("[name='landoperationaid']").val();
        var projectname = $("[name='projectname']").val();
        $.ajax({
            type: "post",
            url: ajax_url,
            data: {
                action: 'go_installment',
                landoperationaid: landoperationaid,
                projectcreateaid: projectcreateaid,
                projectname: projectname
            },
            success: function(data) {
                $("#show_table").html(data);
            }
        });
    }

    $("#frminstallment").on("submit", function(e) {
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
                    $("[name='installmentaid']").val("");
                    $("[name='depositfee']").val("");
                    $("[name='rmk']").val("");
                    $("[name='action']").val("saveinstallment");
                    swal("Success", "Save data is successful.", "success");
                    show_installmentdata();
                    load_page();
                    swal.close();
                } else {
                    swal("Error", "Save data is error.", "error");
                }
            }
        });
    });

    $(document).on("click", "#btneditinstallment", function() {
        var aid = $(this).data('aid');
        var buyername = $(this).data('buyername');
        var depositfee = $(this).data('depositfee');
        var depositdate = $(this).data('depositdate');
        var rmk = $(this).data('rmk');
        $("[name='installmentaid']").val(aid);
        $("[name='buyername']").val(buyername);
        $("[name='depositfee']").val(depositfee);
        $("[name='depositdt']").val(depositdate);
        $("[name='rmk']").val(rmk);
        $("[name='action']").val("editinstallment");
    });

    $(document).on("click", "#btndeleteinstallment", function() {
        var aid = $(this).data("aid");
        var projectcreateaid = $(this).data("projectcreateaid");
        var landoperationaid = $(this).data("landoperationaid");
        swal({
                title: "Delete?",
                text: "Are you sure Delete!",
                type: "error",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, cancel it!",
                closeOnConfirm: false
            },
            function() {
                $.ajax({
                    type: "post",
                    url: ajax_url,
                    data: {
                        action: 'deleteinstallment',
                        aid: aid,
                        projectcreateaid: projectcreateaid,
                        landoperationaid: landoperationaid
                    },
                    success: function(data) {
                        if (data == 1) {
                            swal("Successful",
                                "Delete data success.",
                                "success");
                            show_installmentdata();
                            load_page();
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

});
</script>