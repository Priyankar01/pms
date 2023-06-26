<?php 

if(isset($_POST['submit'])){
	session_start();

	require "includes/conn.php";
	
	$id = $_POST['id'];
	$expiry_date = $_POST['expiry_date'];
	$newQty = $_POST['newQty'];
	$old_Qty = $_POST['old_Qty'];
	$dosage = $_POST['dosage'];
	$price_dosage = $_POST['price_dosage'];
	$half_dosage_price = $_POST['half_dosage_price'];

		$balance = $newQty + $old_Qty;
		$sql = " UPDATE store SET
		Qty = '$balance',
        price_dosage = '$price_dosage',
        half_dosage_price = '$half_dosage_price',
		expiry_date = '$expiry_date'

		WHERE id = $id
		
		";
	$res = mysqli_query ($conn, $sql);
	if($res = true){
		
		$sql2 = " UPDATE pharmacy_stock SET
		expiry_date = '$expiry_date'
		WHERE id = $id

		";
		$res2 = mysqli_query ($conn, $sql2);

	} if ($res = true) {
		$_SESSION['se'] = "<div class='alert alert-success'> Received Successifuly</div>";
                        header ("Location:receiving.php");
	}
	else{
		$_SESSION['failed'] = "<div class='alert alert-danger'> Failed to Receive</div>";
                        header ("Location:receiving.php");
	}

}else {
	echo "Not clicked";
}
