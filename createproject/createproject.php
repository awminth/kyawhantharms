<?php 
    include('../config.php'); 
    include(root.'master/header.php');
?>
<!-- BEGIN: Content-->
<!-- <div class="app-content container center-layout mt-2">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <div class="row breadcrumbs-top d-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=roothtml.'home/home.php'?>">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Created Projects
                        </li>
                    </ol>
                </div>
            </div>
            <h3 class="content-header-title mb-0">Created Projects</h3>
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
                            <div class="form-group col-md-12 pt-1">
                                <form method="POST" action="orderitems_action.php">
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
                    <div class="card">
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <input type="hidden" name="hid">
                                <input type="hidden" name="ser">
                                <div class="todo-fixed-search d-flex justify-content-between align-items-center pb-2">
                                    <fieldset class="form-group position-relative has-icon-left m-0 flex-grow-1 pl-2">
                                        <input type="text" class="form-control todo-search" id="searching"
                                            placeholder="Search Task">
                                        <div class="form-control-position">
                                            <i class="ft-search"></i>
                                        </div>
                                    </fieldset>
                                    <div class="todo-sort dropdown mr-1">
                                        <button class="btn dropdown-toggle sorting" type="button" id="sortDropdown"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ft-filter"></i>
                                            <span>Entry</span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="sortDropdown">
                                            <a class="dropdown-item ascending" href="#" id="entry" data-txt="20">20</a>
                                            <a class="dropdown-item descending" href="#" id="entry" data-txt="50">50</a>
                                            <a class="dropdown-item descending" href="#" id="entry"
                                                data-txt="100">100</a>
                                        </div>
                                    </div>
                                </div>
                                <div id="show_data">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">Order By Items Reports</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?=roothtml.'order/orderview.php'?>">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Order By Items Reports
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
                                <a href="<?=roothtml.'createproject/newcreateproject.php'?>" class="btn btn-social btn-block mr-1 mb-1 btn-primary"><span
                                        class="la la-plus-circle font-medium-3"></span> New</a>
                            </div>
                            <div class="form-group col-md-12 pt-1">
                                <form method="POST" action="createproject_action.php">
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
<div class="modal fade text-left" id="btnnewmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel25"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title text-text-bold-600" id="myModalLabel25">Add Doctor</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmsave" method="POST">
                <input type="hidden" name="action" value="addinvestor" />
                <input type="hidden" name="projectcreateid" />
                <div class="modal-body">
                    <div class="form-group">
                        <label for="usr">Select ShareHolder</label>
                        <select required class=" form-control select2" name="shareholder" id="shareholder">
                            <option value="">Choose ShareHolder</option>
                            <?=load_shareholder();?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="usr">Percent</label>
                        <input type="text" required class="form-control" name="sharepercent" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-primary"><i class="la la-save"></i>Add
                        Investor</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include(root.'master/footer.php'); ?>

<script>
var ajax_url = "<?php echo roothtml.'createproject/createproject_action.php'; ?>";
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

    $(document).on("change", "#shareholder", function() {
        var shareholderid = $("[name='shareholder']").val();
        $.ajax({
            type: "post",
            url: ajax_url,
            data: {
                action: 'select_shareholder',
                shareholderid: shareholderid
            },
            success: function(data) {
                $("[name='sharepercent']").val(data);
            }
        });
    });

    $(document).on("click", "#btnaddinvestors", function(e) {
        e.preventDefault();
        var projectcreateid = $(this).data("projectcreateid");
        $("[name='projectcreateid']").val(projectcreateid);
        $("#btnnewmodal").modal("show");
    });

    $(document).on("click", "#btneditcreateproject", function(e) {
        e.preventDefault();
        var projectcreateid = $(this).data("projectcreateid");
        $.ajax({
            type: "post",
            url: ajax_url,
            data: {
                action : "preeditcreateproject",
                editprojectid: projectcreateid
            },
            success: function(data) {
                if(data == 1){
                    location.href = "<?= roothtml.'createproject/newcreateproject.php'?>";
                }
            }
        });
    });

    $(document).on("click", "#btnlandoperation", function(e) {
        e.preventDefault();
        var projectcreateid = $(this).data("projectcreateid");
        $.ajax({
            type: "post",
            url: ajax_url,
            data: {
                action : "prelandoperation",
                landprojectid: projectcreateid
            },
            success: function(data) {
                if(data == 1){
                    location.href = "<?= roothtml.'landoperation/landoperation.php'?>";
                }
            }
        });
    });

    $("#frmsave").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $("#btnnewmodal").modal("hide");
        $.ajax({
            type: "post",
            url: ajax_url,
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data == 1) {
                    swal("Success", "Save data is successful.", "success");
                    load_page();
                    swal.close();
                } else {
                    swal("Error", "Save data is error.", "error");
                }
            }
        });
    });

});
</script>