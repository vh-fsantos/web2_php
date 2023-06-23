<script>
    $(document).ready(function() {
        $(".update-button").click(function() {
            let form = $('#<?php echo $idForm; ?>')
            let dataValue = $(this).data('value')
            let actionUrl = `<?php echo $modalAction; ?>?id=${dataValue}`
            form.attr('action', actionUrl)
        })
        $(".close").click(function() {
            let form = $('#<?php echo $idForm; ?>')
            form.removeAttr('action')
            let inputs = form.querySelectorAll('input')
            inputs.array.forEach(input => {
                input.value = ''
            });
        })
    })
</script>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="updateModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModal"><?php echo $modalTitle; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="<?php echo $idForm; ?>" method="post">
                    <?php foreach ($modalInputs as $input) { 
                            $inputName = $input["name"];
                            $inputLabel = $input["label"];
                            $inputType = $input["type"];
                        ?>
                        <div class="form-group">
                            <label for="<?php echo $inputName; ?>"><?php echo $inputLabel; ?></label>
                            <input type="<?php echo $inputType; ?>" class="form-control" id="<?php echo $inputName; ?>" name="<?php echo $inputName; ?>" required>
                        </div>
                    <?php } ?>
                    <button type="submit" class="btn btn-primary"><?php echo $modalSubmitText; ?></button>
                </form>
            </div>
        </div>
    </div>
</div>  