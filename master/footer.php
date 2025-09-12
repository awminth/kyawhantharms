
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-transparent footer-light navbar-shadow" style="display:none;">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span
                class="float-md-left d-block d-md-inline-block">Copyright &copy; 2019 <a
                    class="text-bold-800 grey darken-2" href="https://1.envato.market/modern_admin"
                    target="_blank">PIXINVENT</a></span><span class="float-md-right d-none d-lg-block">Hand-crafted &
                Made with<i class="ft-heart pink"></i><span id="scroll-top"></span></span></p>
    </footer>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <!-- BEGIN: Vendor JS-->
    <script src="<?=roothtml.'lib/app-assets/vendors/js/vendors.min.js'?>"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="<?=roothtml.'lib/app-assets/vendors/js/ui/jquery.sticky.js'?>"></script>
    <script src="<?=roothtml.'lib/app-assets/vendors/js/charts/chartist.min.js'?>"></script>
    <script src="<?=roothtml.'lib/app-assets/vendors/js/charts/chartist-plugin-tooltip.min.js'?>"></script>
    <script src="<?=roothtml.'lib/app-assets/vendors/js/charts/raphael-min.js'?>"></script>
    <script src="<?=roothtml.'lib/app-assets/vendors/js/charts/morris.min.js'?>"></script>
    <script src="<?=roothtml.'lib/app-assets/vendors/js/timeline/horizontal-timeline.js'?>"></script>
    <script src="<?=roothtml.'lib/app-assets/vendors/js/forms/icheck/icheck.min.js'?>"></script>
    <script src="<?=roothtml.'lib/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js'?>"></script>
    <script src="<?=roothtml.'lib/app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js'?>"></script>
    <script src="<?=roothtml.'lib/app-assets/vendors/js/forms/toggle/switchery.min.js'?>"></script>
    <script src="<?=roothtml.'lib/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js'?>"></script>
    <script src="<?=roothtml.'lib/app-assets/js/scripts/forms/custom-file-input.js'?>"></script>
    <!-- Select2 -->
    <script src="<?=roothtml.'lib/app-assets/vendors/js/forms/select/select2.full.min.js'?>"></script>
    <script src="<?=roothtml.'lib/app-assets/js/scripts/forms/select/form-select2.js'?>"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="<?=roothtml.'lib/app-assets/js/core/app-menu.js'?>"></script>
    <script src="<?=roothtml.'lib/app-assets/js/core/app.js'?>"></script>
    <script src="<?=roothtml.'lib/app-assets/js/scripts/forms/checkbox-radio.js'?>"></script>
    <script src="<?=roothtml.'lib/app-assets/js/scripts/forms/input-groups.js'?>"></script>
    <script src="<?=roothtml.'lib/app-assets/js/scripts/pages/app-todo.js' ?>"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="<?=roothtml.'lib/app-assets/vendors/js/pickers/daterange/moment.min.js' ?>"></script>
    <script src="<?=roothtml.'lib/app-assets/vendors/js/editors/quill/quill.min.js' ?>"></script>
    <script src="<?=roothtml.'lib/app-assets/vendors/js/extensions/dragula.min.js' ?>"></script>
    <!-- END: Page Vendor JS-->
    
    <!-- for print -->
    <script src="<?php echo roothtml.'lib/print.min.js' ?>"></script>
    <!-- editor -->
    <script src="<?php echo roothtml.'lib/ckeditor/ckeditor.js' ?>"></script>
    <!-- END: Page JS-->

    <script>
    $(document).ready(function() {
        $(document).ajaxStart(function() {
            $(".loader").show();
        });

        $(document).ajaxComplete(function() {
            $(".loader").hide();
        });

        $(document).on("click", "#btnlogout", function(e) {
            e.preventDefault();
            swal({
                    title: "Answer ?",
                    text: "Are you sure Exit!",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes,Sure!",
                    closeOnConfirm: false
                },
                function() {
                    $.ajax({
                        type: "post",
                        url: "<?php echo roothtml.'index_action.php' ?>",
                        data: {
                            action: 'logout'
                        },
                        success: function(data) {
                            if (data == 1) {
                                location.href =
                                    "<?php echo roothtml.'index.php' ?>";
                            }
                        }
                    });
                });
        });

        $(document).on("change", "#imageChk", function() {
            if ($(this).is(':checked')) {
                // alert('yes');
                $("#chkimgshow").show(); // Check လုပ်ထားရင် image ကို ပြမယ်
            } else {
                // alert('no');
                $("#chkimgshow").hide(); // Check လုပ်ထားရင် image ကို ပိတ်မယ်
            }
        });

        




    });
    </script>


</body>
<!-- END: Body-->

</html>