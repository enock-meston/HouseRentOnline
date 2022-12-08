<?php
session_start();
$_SESSION['landID']=="";
session_unset();
session_destroy();

?>
<script language="javascript">
document.location="../landlord.php";
</script>
