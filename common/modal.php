<script>
    $(document).ready(function() {
        $(".update-button").click(function() {
            console.log('entrou')
            let form = $('#<?php echo $idForm; ?>')

            if (form.attr('action') !== undefined)
                form.removeAttr('action')
            
            var dataValue = $(this).data('value')
            var actionUrl = `<?php echo $modalAction; ?>?id=${dataValue}`
            form.attr('action', actionUrl)
        });
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
                            $inputType = $input["type"];
                        ?>
                        <div class="form-group">
                            <label for="<?php echo strtolower($inputName); ?>"><?php echo $inputName; ?></label>
                            <input type="<?php echo $inputType; ?>" class="form-control" id="<?php echo $inputName; ?>" name="<?php echo $inputName; ?>" required>
                        </div>
                    <?php } ?>
                    <button type="submit" class="btn btn-primary"><?php echo $modalSubmitText; ?></button>
                </form>
            </div>
        </div>
    </div>
</div>  