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
                <h3 class="content-header-title">User Control</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?=roothtml.'home/home.php'?>">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">SetUp</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="#">User Control</a>
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
                        <div class="card-header border-bottom">
                            <div class="form-inline float-right">
                                <div class="pr-1">
                                    <button type="button" id="btnnew"
                                        class="btn btn-social btn-min-width btn-primary"><span
                                            class="la la-plus-circle font-medium-3"></span>New</button>
                                </div>
                                <div class="">
                                    <form method="POST" action="usercontrol_action.php">
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
                                    <td width="20%">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-5 col-form-label">Show</label>
                                            <div class="col-sm-7">
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
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Search</label>
                                            <div class="col-sm-10">
                                                <input type="search" class="form-control" id="searching"
                                                    placeholder="Searching . . . . . ">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <div id="show_table" class="table-responsive">

                            </div>
                        </div>
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
                <label class="modal-title text-text-bold-600" id="myModalLabel25">Add User Control</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmsave" method="POST">
                <input type="hidden" name="action" value="save" />
                <div class="modal-body">
                    <div class="form-group">
                        <label for="usr">User Name</label>
                        <input type="text" required class="form-control" name="username" placeholder="Enter username">
                    </div>
                    <div class="form-group">
                        <label for="usr">Password</label>
                        <input type="password" required class="form-control" name="password"
                            placeholder="Enter password">
                    </div>
                    <div class="form-group">
                        <label for="usr">User Type</label>
                        <select required class=" form-control select2" name="usertype">
                            <option value="">Choose User Type</option>
                            <?php for($i=0;$i<count($arr_usertype);$i++){ ?>
                            <option value="<?=$arr_usertype[$i]?>"><?=$arr_usertype[$i]?></option>
                            <?php } ?>
                        </select>
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
<div class="modal fade text-left" id="btneditmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel25"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title text-text-bold-600" id="myModalLabel25">Edit User Control</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmedit" method="POST">
                <input type="hidden" name="action" value="edit" />
                <input type="hidden" name="eaid" />
                <div class="modal-body">
                    <div class="form-group">
                        <label for="usr">User Name</label>
                        <input type="text" required class="form-control" name="eusername" placeholder="Enter username">
                    </div>
                    <div class="form-group">
                        <label for="usr">Password</label>
                        <input type="password" required class="form-control" name="epassword"
                            placeholder="Enter password">
                    </div>
                    <div class="form-group">
                        <label for="usr">User Type</label>
                        <select required class=" form-control select2" name="eusertype" id="eusertype">
                            <option value="">Choose User Type</option>
                            <?php for($i=0;$i<count($arr_usertype);$i++){ ?>
                            <option value="<?=$arr_usertype[$i]?>"><?=$arr_usertype[$i]?></option>
                            <?php } ?>
                        </select>
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
$(document).ready(function() {
    function load_pag(page) {
        var entryvalue = $("[name='hid']").val();
        var search = $("[name='ser']").val();
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'setup/usercontrol_action.php' ?>",
            data: {
                action: 'show',
                page_no: page,
                entryvalue: entryvalue,
                search: search
            },
            success: function(data) {
                $("#show_table").html(data);
            }
        });
    }
    load_pag();

    $(document).on('click', '.page-link', function() {
        var pageid = $(this).data('page_number');
        load_pag(pageid);
    });

    $(document).on("change", "#entry", function() {
        var entryvalue = $(this).val();
        $("[name='hid']").val(entryvalue);
        load_pag();
    });

    $(document).on("keyup", "#searching", function() {
        var serdata = $(this).val();
        $("[name='ser']").val(serdata);
        load_pag();
    });

    $(document).on("click", "#btnnew", function() {
        $("#btnnewmodal").modal("show");
    });

    $("#frmsave").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $("#btnnewmodal").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'setup/usercontrol_action.php' ?>",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data == 1) {
                    swal("Success", "Save data is successful.", "success");
                    load_pag();
                    swal.close();
                } else {
                    swal("Error", "Save data is error.", "error");
                }
            }
        });
    });

    $(document).on("click", "#btnedit", function(e) {
        e.preventDefault();
        var aid = $(this).data("aid");
        var username = $(this).data("username");
        var password = $(this).data("password");
        var usertype = $(this).data("usertype");
        $("[name='eaid']").val(aid);
        $("[name='eusername']").val(username);
        $("[name='epassword']").val(password);
        $('#eusertype').val(usertype).trigger('change');
        $("#btneditmodal").modal("show");
    });

    $("#frmedit").on("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $("#btneditmodal").modal("hide");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'setup/usercontrol_action.php' ?>",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data == 1) {
                    swal("Success", "Edit data is successful.", "success");
                    load_pag();
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
                    url: "<?php echo roothtml.'setup/usercontrol_action.php'; ?>",
                    data: {
                        action: 'delete',
                        aid: aid
                    },
                    success: function(data) {
                        if (data == 1) {
                            swal("Successful",
                                "Delete data success.",
                                "success");
                            load_pag();
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