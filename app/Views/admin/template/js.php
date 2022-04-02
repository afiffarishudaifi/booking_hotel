<?php $session = session(); ?>

<!-- Toastr -->
<script src="<?= base_url() ?>/docs/tambahan/toastr/toastr.min.js"></script>
<script type="text/javascript">

    $( document ).ready(function() {
        if ('<?= $session->getFlashdata('sukses'); ?>' != '') {
            toastr.success('<?= $session->getFlashdata('sukses'); ?>')
        } else if ('<?= $session->getFlashdata('gagal'); ?>' != '') {
            toastr.error('<?= $session->getFlashdata('gagal'); ?>')
        }
    });
</script>