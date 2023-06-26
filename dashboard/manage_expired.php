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
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title"> Expired </h4>
                                    </div>
                                </div>
                                <div class="float-right"> <a href="add_medicine.php" class="btn btn-success float-right"> New Entry</a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <div class="card-body">
                                    <form action="" id="manage-expired">
                                        <div class="col-md-12">
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <label class="control-label">Product</label>
                                                    <select name="" id="product" class="custom-select browser-default select2">
                                                        <option value=""></option>
                                                        <option value=""></option>
                                                    </select>
                                                    <small><a href="javascript:void(0)" id="search_prod">Search product in details.</a></small>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="control-label">Qty</label>
                                                    <input type="number" class="form-control text-right" step="any" id="qty">
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="control-label">&nbsp</label>
                                                    <button class="btn btn-block btn-sm btn-success" type="button" id="add_list"><i class="fa fa-plus"></i> Add to List</button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <table class="table table-bordered" id="list">
                                                    <colgroup>
                                                        <col width="20%">
                                                        <col width="40%">
                                                        <col width="30%">
                                                        <col width="10%">
                                                    </colgroup>
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Date Expired</th>
                                                            <th class="text-center">Product</th>
                                                            <th class="text-center">Qty</th>
                                                            <th class="text-center"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="item-row">
                                                            <td>
                                                                <input type="date" class="form-control" name="expiry_date[]" class="text-right" value="">
                                                            </td>
                                                            <td>
                                                                <input type="hidden" name="inv_id[]" value="">
                                                                <input type="hidden" class="form-control" name="product_id[]" value="">
                                                                <p class="pname">Name: <b><sup></sup></b></p>
                                                                <p class="pdesc"><small><i>Description: <b></b></i></small></p>
                                                            </td>
                                                            <td>
                                                                <input type="number" class="form-control" min="1" step="any" name="qty[]" value="" class="text-right">
                                                            </td>
                                                            <td class="text-center">
                                                                <button class="btn btn-sm btn-danger" onclick="rem_list($(this))"><i class="fa fa-trash"></i></button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <button class="btn btn-success col-sm-3 btn-sm btn-block float-right ">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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