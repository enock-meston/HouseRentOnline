<?php
session_start();
include('../includes/config.php');
include 'pay_parse.php';
$continue_loop = true;
if ($_GET) {
	if (isset($_GET['ref']) && !empty($_GET['ref'])) {
		$sql_selectHouseRef = mysqli_query($con,"SELECT * FROM `tbl_payrequest` WHERE Transactionref ='".$_GET['ref']."'");
		$dataRef = mysqli_fetch_assoc($sql_selectHouseRef);
		$Transactionref = $dataRef['Transactionref'];
		$status = $dataRef['status'];

		if ($status == "pending") {
			hdev_payment::api_id("HDEV-48d87cf2-c648-49c1-9c7c-a1a12dbc30eb-ID");
			hdev_payment::api_key("HDEV-79d8e552-5bed-4f5a-9551-cd051e32e406-KEY");
			$result = hdev_payment::get_pay($_GET['ref']);
			// var_dump($result);
			if (isset($result->status) && ($result->status != "error")) {
				$tx_id = $result->tx_id;
				$tx_ref = $result->tx_ref;
				$status = $result->status;
				// update
				if ($status == 'success') {
					$continue_loop = false;
					// code...
				}elseif ($status == 'failed') {
					$continue_loop = false;
					// code...
				}elseif ($status == 'pending') {
					// code...
				}
				$sql_upt = mysqli_query($con,"UPDATE `tbl_payrequest` SET `TransactionIDMoMo`='$tx_id',`status`='$status' WHERE Transactionref ='$tx_ref'");

			}
		}

	}
}
if ($continue_loop) {
	echo "Waiting For Payment...";
?>
<script>
	const exxc = setTimeout(rld,2000);
	function rld() {
		window.location.reload();
	}
</script>
<?php
}else{
	?>
<script type="text/javascript">
	window.alert('Payment : '+'<?php echo strtoupper($status); ?>')
</script>
	<?php
}
?>