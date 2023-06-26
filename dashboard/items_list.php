<!DOCTYPE html>
<html dir="ltr" lang="en">
<?php
session_start();
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 4 admin, bootstrap 4, css3 dashboard, bootstrap 4 dashboard, AdminWrap lite admin bootstrap 4 dashboard, frontend, responsive bootstrap 4 admin template, Xtreme admin lite design, Xtreme admin lite dashboard bootstrap 4 dashboard template">
    <meta name="description" content="Xtreme Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>WAKA PHARMACY :: Items </title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/xtreme-admin-lite/" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <link href="assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="dist/css/style.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    a class="navbar-brand" href="index.html">
                    <b class="logo-icon">
                        WAKA PHARMACY
                    </b>
                    </a>
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" id="search" placeholder="Search here...."> <a class="srh-btn"><i class="ti-close"></i></a>
                            </form>
                        </li>
                    </ul>
                    <ul class="navbar-nav float-right">
                    </ul>
                </div>
            </nav>
        </header>
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
                                    <li class="breadcrumb-item active" aria-current="page">Medicine List</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <?php
                if (isset($_SESSION['updated_price'])) {
                    echo $_SESSION['updated_price'];
                    unset($_SESSION['updated_price']);
                }
                ?>
                <?php
                if (isset($_SESSION['failed_price'])) {
                    echo $_SESSION['failed_price'];
                    unset($_SESSION['failed_price']);
                }
                ?>
                <div class="row">
                    <div class="col-12">
                        <div class="form-inline">
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title">Items List </h4>
                                    </div>
                                </div>
                                <div class="float-right"> <a href="add_list.php" class="btn btn-success float-right"> Add Item</a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table v-middle " id="table-data">
                                    <thead>
                                        <tr class="bg-dark text-white">
                                            <th class="border-top-0">S.N</th>
                                            <th class="border-top-0">Item Info</th>
                                            <th class="border-top-0"> Price </th>
                                            <th class="border-top-0"> Quanitity </th>
                                            <th class="border-top-0 col-span-2"> Action </th>
                                        </tr>
                                    </thead>
                                    <?php
                                    require "includes/conn.php";
                                    if (isset($_GET['page'])) {
                                        $page = $_GET['page'];
                                    } else {
                                        $page = 1;
                                    }
                                    $num_per_page = 05;
                                    $start_from = ($page - 1) * 05;
                                    $sql = "SELECT * FROM store_items limit $start_from,$num_per_page";
                                    $res = mysqli_query($conn, $sql);
                                    if ($res == TRUE) {
                                        $count = mysqli_num_rows($res);
                                        $sn = 1;
                                        if ($count > 0) {
                                            while ($rows = mysqli_fetch_assoc($res)) {
                                                $id = $rows['id'];
                                                $item_name = $rows['item_name'];
                                                $capacity = $rows['capacity'];
                                                $price = $rows['price'];
                                                $expiry_date = $rows['expiry_date'];
                                    ?>
                                                <tbody id="output">
                                                    <tr>
                                                        <th scope="row"><?php echo $sn++; ?></th>
                                                        <td>
                                                            <p> MID: <b><?php echo "$id"; ?></b></p>
                                                            <p> Name:<b><?php echo "$item_name"; ?></b>
                                                            </p>
                                                            <p> Expiry Date: <b><?php echo "$expiry_date"; ?></b></p>
                                                        </td>
                                                        <td><?php echo "$price"; ?></td>
                                                        <td><?php echo "$capacity"; ?></td>
                                                        <td>
                                                            <a href="update_items_stock.php?id=<?php echo "$id" ?>" class="btn btn-success" type="button">Update Quanitity</a>
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
                    $pr_query = "select * from store_items";
                    $pr_result = mysqli_query($conn, $pr_query);
                    $total_record = mysqli_num_rows($pr_result);
                    $total_page = ceil($total_record / $num_per_page);
                    if ($page > 1) {
                        echo "<a href='items_list.php?page=" . ($page - 1) . "' class='btn btn-warning'>Previous</a>";
                    }
                    for ($i = 1; $i < $total_page; $i++) {
                        echo "<a href='items_list.php?page=" . $i . "' class='btn btn-success'>$i</a>";
                    }
                    if ($i > $page) {
                        echo "<a href='medicine_list.php?page=" . ($page + 1) . "' class='btn btn-warning'>Next</a>";
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
                    url: 'action.php',
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