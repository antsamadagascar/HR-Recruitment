<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script type="text/javascript">
    alert("<?php echo $alert; ?>");
    window.location.href = "<?php echo base_url($action) ?>";
</script>