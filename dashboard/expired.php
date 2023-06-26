<!DOCTYPE html>
<html dir="ltr" lang="en">
<?php
session_start();
require "includes/head.php";
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
                                    <li class="breadcrumb-item active" aria-current="page">Expired</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card ">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title"> Expired </h4>
                                    </div>
                                </div>
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
                            </div>
                            <div class="table-responsive">
                                <table class="table v-middle">
                                    <thead>
                                        <tr class="bg-danger text-white">
                                            <th class="border-top-0">S.No</th>
                                            <th class="border-top-0">Medicine Name</th>
                                            <th class="border-top-0">Date Expired</th>
                                            <th class="border-top-0">Quantity</th>
                                            <th class="border-top-0">Price</th>
                                            <th class="border-top-0">Amount</th>
                                            <th class="border-top-0">Status</th>
                                            <th class="border-top-0">Action</th>


                                        </tr>
                                    </thead>
                                    <?php
                                    $sql = "SELECT * FROM store WHERE expiry_date < '$drug_expiry_date'";
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
                                                $dosage_sold = $rows['dosage_sold'];
                                                $price_dosage = $rows['price_dosage'];
                                                $drug_expiry_date = date("Y-m-d", strtotime(date("Y-m-d")));
                                                $confirm = $rows['confirm'];
                                    ?>
                                                <tbody>
                                                    <td>
                                                        <?php echo $sn++; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $medicine_name; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $expiry_date; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $Qty; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($dosage_sold == "Yes") {
                                                            echo "$price_dosage";
                                                        } else {
                                                            echo "$price";
                                                        }

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($price_dosage == '') {
                                                            $price_dosage = '0';
                                                        } else {
                                                            $price_dosage = $rows['dosage_sold'];
                                                        }
                                                        $dosage_sold_total = $Qty * $price_dosage;
                                                        $total = $Qty * $price;
                                                        if ($dosage_sold == "Yes") {
                                                            echo "$dosage_sold_total";
                                                        } else {
                                                            echo "$total";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($confirm == '0') {
                                                            echo "Not Yet Confirmed";
                                                        } else {
                                                            echo "Confirmed";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="delete_expired.php?id=<?php echo $id; ?>" class="btn btn-warning"> Confirm</a>
                                                    </td>
                                                </tbody>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </table>
                            </div>
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