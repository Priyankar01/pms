<!DOCTYPE html>
<html dir="ltr" lang="en">

<?php
session_start();
require "includes/head.php";
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
$finalcode = 'Invoice_no ' . createRandomPassword();
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
                                    <li class="breadcrumb-item active" aria-current="page">Invoices</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title">Purchase Order</h4>
                                    </div>
                                    <div class="ml-auto">
                                        <a href="create_invoice.php?invoice=<?php echo $finalcode; ?>" class="btn btn-warning">Create Invoices </a>
                                        <a href="purchase_report.php" class="btn btn-success">Filter Invoices </a>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table v-middle">
                                    <thead>
                                        <tr class="bg-warning">
                                            <th class="border-top-0">S.N</th>
                                            <th class="border-top-0">Purchase Number</th>
                                            <th class="border-top-0">Medicine_name</th>
                                            <th class="border-top-0">Price</th>
                                            <th class="border-top-0">Status</th>
                                            <th class="border-top-0 col-span-4">Action</th>
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
                                    $sql = "SELECT * FROM purchase_order   limit $start_from,$num_per_page";
                                    $res = mysqli_query($conn, $sql);
                                    if ($res == TRUE) {
                                        $count = mysqli_num_rows($res);
                                        $sn = 1;
                                        if ($count > 0) {
                                            while ($rows = mysqli_fetch_assoc($res)) {
                                                $purchase_no = $rows['purchase_no'];
                                                $purchase_id = $rows['purchase_id'];
                                                $medicine_name = $rows['medicine_name'];
                                                $price = $rows['price'];
                                                $qty = $rows['qty'];
                                                $supplier = $rows['supplier'];
                                                $status = $rows['status'];
                                    ?>
                                                <tbody id="output">
                                                    <tr>
                                                        <th scope="row"><?php echo $sn++; ?></th>
                                                        <td class=' text-bold '><?php echo $purchase_no  ?></td>
                                                        <td class=' text-bold '><?php echo $medicine_name  ?></td>
                                                        <td class=' text-bold '><?php echo $price  ?></td>
                                                        <td class=' text-bold '><?php
                                                                                if ($status == 0) {
                                                                                ?>
                                                                <p class="text-danger">Unpaid</p>
                                                            <?php
                                                                                } else {
                                                            ?>
                                                                <p class="text-success">Paid</p>
                                                            <?php
                                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($status == 0) {
                                                            ?>
                                                                <a href="settle_invoice.php?purchase_no=<?php echo "$purchase_no" ?>" class="btn btn-success" type="button">Pay</a>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <a href="invoice_ind.php?purchase_no=<?php echo "$purchase_no" ?>" class="btn btn-success disabled" type="button">Paid</a>
                                                            <?php
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
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
                <div class="col-md-6 md-3">
                    <?php
                    $pr_query = "select * from purchase_order WHERE status = '0'";
                    $pr_result = mysqli_query($conn, $pr_query);
                    $total_record = mysqli_num_rows($pr_result);
                    $total_page = ceil($total_record / $num_per_page);
                    if ($page > 1) {
                        echo "<a href='invoice.php?page=" . ($page - 1) . "' class='btn btn-warning'>Previous</a>";
                    }
                    for ($i = 1; $i < $total_page; $i++) {
                        echo "<a href='invoice.php?page=" . $i . "' class='btn btn-success'>$i</a>";
                    }
                    if ($i > $page) {
                        echo "<a href='invoice.php?page=" . ($page + 1) . "' class='btn btn-warning'>Next</a>";
                    }
                    ?>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $("#search").keypress(function() {
                $.ajax({
                    type: 'POST',
                    url: 'pharmacy_search.php',
                    data: {
                        name: $("#search").val(),
                    },
                    success: function(data) {
                        $("#output").html(data);
                    }
                });
            });
        });
    </script>
</body>

</html>