<?php
session_start();
$_SESSION['AuID']=="";
session_unset();
session_destroy();

?>
<script language="javascript">
document.location="../tenantLogin.php";
</script>
