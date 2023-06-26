<!DOCTYPE html>
<html dir="ltr" lang="en">

<?php
session_start();
require "includes/head.php";
require "includes/auth.php";
?>
<?php
function createRandomPassword()
{
    $chars = "003232303232023232023456789";
    srand((float)microtime() * 1000000);
    $i = 0;
    $pass = '';
    while ($i <= 7) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    return $pass;
}
$finalcode = 'Patient_No.:  ' . createRandomPassword();
?>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <?php require "includes/header.php" ?>
        <?php require "includes/aside.php"; ?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">Dashboard</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Store List</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <?php
                require "includes/conn.php";
                $sql = "SELECT * FROM store";
                $res = mysqli_query($conn, $sql);
                if ($res == TRUE) {
                    $count = mysqli_num_rows($res);
                    $sn = 1;
                    if ($count > 0) {
                        while ($rows = mysqli_fetch_assoc($res)) {
                            $id = $rows['id'];
                            $medicine_name = $rows['medicine_name'];
                            $type = $rows['type'];
                            $capacity = $rows['capacity'];
                            $Qty = $rows['Qty'];
                            $price = $rows['price'];
                            $amount = $rows['amount'];
                            $expiry_date = $rows['expiry_date'];
                            $drug_expiry_date = date("Y-m-d", strtotime(date("Y-m-d")));
                ?>
                <?php
                        }
                    }
                }
                ?>
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title">Expired List of Medicine </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table v-middle">
                                    <thead>
                                        <tr class="bg-danger text-white">
                                            <th class="border-top-0">S.No</th>
                                            <th class="border-top-0">Medicine Name</th>
                                            <th class="border-top-0">Date Expired</th>
                                            <th class="border-top-0">Quantity</th>
                                            <th class="border-top-0">Amount</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $sql = "SELECT * FROM expired_medince ";
                                    $res = mysqli_query($conn, $sql);
                                    if ($res == TRUE) {
                                        $count = mysqli_num_rows($res);
                                        $sn = 1;
                                        if ($count > 0) {
                                            while ($rows = mysqli_fetch_assoc($res)) {
                                                $id = $rows['id'];
                                                $medicine_name = $rows['medicine_name'];
                                                $date_expired = $rows['date_expired'];
                                                $qty = $rows['qty'];
                                                $amount = $rows['amount'];
                                    ?>
                                                <tbody>
                                                    <td>
                                                        <?php echo $sn++; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $medicine_name; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $date_expired; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $qty; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $amount; ?>
                                                    </td>
                                                </tbody>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </table>
                            </div>
                            <hr>
                            <div align="right" class="px-3 py-2">
                                <h4>Total:
                                    <?php
                                    $sql = "SELECT SUM(amount) as 'amount' FROM expired_medince";
                                    $res = mysqli_query($conn, $sql);
                                    $data = mysqli_fetch_array($res);
                                    ?>
                                    <?php echo $data['amount']; ?>
                                </h4>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title"> List of Damaged Medicine </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table v-middle">
                                    <thead>
                                        <tr class="bg-warning">
                                            <th class="border-top-0">Medicine Name</th>
                                            <th class="border-top-0">Quanitity Damaged</th>
                                            <th class="border-top-0">Price</th>
                                            <th class="border-top-0">Amount</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    require "includes/conn.php";
                                    if (isset($_GET['page'])) {
                                        $page = $_GET['page'];
                                    } else {
                                        $page = 1;
                                    }
                                    $num_per_page = 10;
                                    $start_from = ($page - 1) * 10;
                                    $sql = "SELECT * FROM damaged limit $start_from,$num_per_page";
                                    $res = mysqli_query($conn, $sql);
                                    if ($res == TRUE) {
                                        $count = mysqli_num_rows($res);
                                        $sn = 1;
                                        if ($count > 0) {
                                            while ($rows = mysqli_fetch_assoc($res)) {
                                                $id = $rows['id'];
                                                $name = $rows['name'];
                                                $qty = $rows['qty'];
                                                $price = $rows['price'];
                                                $amount = $rows['amount'];
                                    ?>
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo $name; ?></td>
                                                        <td><?php echo $qty; ?></td>
                                                        <td><?php echo $price; ?></td>
                                                        <td><?php echo $amount; ?></td>
                                                    </tr>
                                                </tbody>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </table>
                            </div>
                            <hr>
                            <div align="right" class="px-3 py-2">
                                <h4>Total:
                                    <?php
                                    $sql = "SELECT SUM(amount) as 'amount' FROM damaged";
                                    $res = mysqli_query($conn, $sql);
                                    $data = mysqli_fetch_array($res);
                                    ?>
                                    <?php echo $data['amount']; ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="footer text-center">
                    All Rights Reserved
                </footer>
            </div>
        </div>
        <script src="assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
        <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="dist/js/app-style-switcher.js"></script>
        <script src="dist/js/waves.js"></script>
        <script src="dist/js/sidebarmenu.js"></script>
        <script src="dist/js/custom.js"></script>
        <script src="assets/libs/chartist/dist/chartist.min.js"></script>
        <script src="assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
        <script src="dist/js/pages/dashboards/dashboard1.js"></script>
</body>

</html>