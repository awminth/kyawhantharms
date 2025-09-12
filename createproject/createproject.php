<?php 
    include('../config.php'); 
    include(root.'master/header.php');
?>
<!-- BEGIN: Content-->
<div class="app-content container center-layout mt-2">
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
            <input type="hidden" name="hid">
            <input type="hidden" name="ser">
            <div class="todo-fixed-search d-flex justify-content-between align-items-center pb-2">
                <fieldset class="form-group position-relative has-icon-left m-0 flex-grow-1 pl-2">
                    <input type="text" class="form-control todo-search" id="searching" placeholder="Search Task">
                    <div class="form-control-position">
                        <i class="ft-search"></i>
                    </div>
                </fieldset>
                <div class="todo-sort dropdown mr-1">
                    <button class="btn dropdown-toggle sorting" type="button" id="sortDropdown" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="ft-filter"></i>
                        <span>Entry</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="sortDropdown">
                        <a class="dropdown-item ascending" href="#" id="entry" data-txt="20">20</a>
                        <a class="dropdown-item descending" href="#" id="entry" data-txt="50">50</a>
                        <a class="dropdown-item descending" href="#" id="entry" data-txt="100">100</a>
                    </div>
                </div>
            </div>
            <div id="show_data">

            </div>
        </div>
    </div>
</div>

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
                    <button type="submit" class="btn btn-outline-primary"><i class="la la-save"></i>Add Investor</button>
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
        $.ajax({
            type: "post",
            url: ajax_url,
            data: {
                action: 'show_data',
                page_no: page,
                entryvalue: entryvalue,
                search: search
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