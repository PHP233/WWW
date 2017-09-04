<?php ob_start(); ?>
<?php
header('HTTP/1.1 404 Not Found');
header("status: 404 Not Found");
?>
<script type="text/javascript">window.location.href="<?php bloginfo('url'); ?>";</script>