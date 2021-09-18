<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 1
    </div>
    <strong>Copyright &copy; <?= date('Y') ?> <a href="">Programer Mahal</a>.</strong> All rights
    reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- Include jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Include jQuery Validator plugin -->
<script src="<?= base_url('assets/plugin/plugins/bootstrap/js/') ?>validator.min.js"></script>
<!-- <script src="<?= base_url('assets/plugin/plugins/jquery/jquery-validation/') ?>jquery.validate.js"></script> -->


<!-- Include SmartWizard JavaScript source -->
<script type="text/javascript" src="<?= base_url('assets/plugin') ?>/dist/js/jquery.smartWizard.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        function gets() {
            var cekb = $('.x');
            $.each(cekb, function() {
                var idd = '';
                idd += $(this).attr('data');
                $.ajax({
                    type: "post",
                    url: "<?= base_url('user/ajaxsoal') ?>",
                    data: {
                        ids: idd
                    },
                    dataType: "json",
                    success: function(respons) {

                        var html = '';
                        for (let i = 0; i < respons.length; i++) {
                            html += '<input type="radio" name="jawaban-' + idd + '" value="' + respons[i].nilai + '"required>' + respons[i].kategori + '';
                        }
                        console.log(idd);
                        $('#jawab-' + idd).html(html);

                    }
                });
            })

            return true;
        }
        gets();


        // Toolbar extra buttons
        var btnFinish = $('<button></button>').text('Finish')
            .addClass('btn btn-info')
            .on('click', function() {
                if (!$(this).hasClass('disabled')) {
                    var elmForm = $("#myForm");
                    if (elmForm) {
                        elmForm.validator('validate');
                        var elmErr = elmForm.find('.has-error');
                        if (elmErr && elmErr.length > 0) {
                            alert('Oops we still have error in the form');
                            return false;
                        } else {
                            alert('Great! we are ready to submit form');
                            elmForm.submit();
                            return false;
                        }
                    }
                }
            });
        var btnCancel = $('<button></button>').text('Cancel')
            .addClass('btn btn-danger')
            .on('click', function() {
                $('#smartwizard').smartWizard("reset");
                $('#myForm').find("input, textarea").val("");
            });



        // Smart Wizard
        $('#smartwizard').smartWizard({
            selected: 0,
            theme: 'dots',
            transitionEffect: 'fade',
            toolbarSettings: {
                toolbarPosition: 'bottom',
                toolbarExtraButtons: [btnFinish, btnCancel]
            },
            anchorSettings: {
                markDoneStep: true, // add done css
                markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
                enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
            }
        });

        $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
            var elmForm = $("#form-step-" + stepNumber);
            console.log("jawaban-" + stepNumber);
            // stepDirection === 'forward' :- this condition allows to do the form validation
            // only on forward navigation, that makes easy navigation on backwards still do the validation when going next
            if (stepDirection === 'forward' && elmForm) {

            }
            return true;
        });

        $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
            // Enable finish button only on last step
            if (stepNumber == 3) {
                $('.btn-finish').removeClass('disabled');
            } else {
                $('.btn-finish').addClass('disabled');
            }
        });

    });
</script>
</body>

</html>