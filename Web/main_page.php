<?php
    require "../dbconnect.php";
    session_start();
    $employee_html = '';
    if(!isset($_SESSION['user_name']) && !isset($_SESSION['password'])){
        echo '<script type="text/JavaScript"> 
        window.open("http://localhost/FashionShop-phpServer/Web/Login_web.html","_self");
      </script>';
    }
    $cur_month = date('m');
    $cur_year = date('Y');
    $get_user = "SELECT COUNT(user_id) AS user_quantity FROM user_fashionshop";
    $user_data = mysqli_query($connect,$get_user);
    $user_quantity = '';
    while($row = mysqli_fetch_assoc($user_data)){
        $user_quantity = $row['user_quantity'];
    }
    $get_product = "SELECT COUNT(product_id) AS product_quantity FROM products_fashionshop";
    $product_data = mysqli_query($connect,$get_product);
    $product_quantity = '';
    while($row = mysqli_fetch_assoc($product_data)){
        $product_quantity = $row['product_quantity'];
    }
    $get_bill = "SELECT COUNT(bill_id) AS bill_quantity FROM bill_fashionshop";
    $bill_data = mysqli_query($connect,$get_bill);
    $bill_quantity = '';
    while($row = mysqli_fetch_assoc($bill_data)){
        $bill_quantity = $row['bill_quantity'];
    }
    $get_employee = "SELECT COUNT(employee_id) AS employee_quantity FROM employee";
    $employee_data = mysqli_query($connect,$get_employee);
    $employee_quantity = '';
    while($row = mysqli_fetch_assoc($employee_data)){
        $employee_quantity = $row['employee_quantity'];
    }
    if($_SESSION['user_name'] == 'admin' && $_SESSION['password'] == 'admin'){
        $employee_html = '<div class="">
        <div class="card mb-3 widget-content bg-midnight-bloom" id="employee_list">
          <div class="widget-content-wrapper text-white">
            <div class="widget-content-left">
              <div class="widget-heading">Nhân viên</div>
            </div>
            <div class="widget-content-right">
              <div class="widget-numbers text-white">
                <span>'.$employee_quantity.'</span>
              </div>
            </div>
          </div>
        </div>
      </div>';
    }
    $main_page_html = '<!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- import font -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
          href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100;200;300;400;500;600&display=swap"
          rel="stylesheet"
        />
        <!-- import tailwindcss -->
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- import css -->
        <link rel="stylesheet" href="main.css" />
        <!-- import js -->
        <script src="main.js"></script>
        <!-- title -->
        <title>home</title>
      </head>
    
      <body>
        <div
          class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header font-["Lexend_Deca"]"
        >
          <!-- header -->
          <div class="app-header header-shadow h-[70px] flex justify-between">
            <!-- logo -->
            <div class="app-header__logo">
              <div class="logo-src flex items-center justify-center w-20">
                <img class="w-[80px] h-[80px]" src="logo.png" alt="" />
              </div>
              <div class="header__pane ml-auto">
                <div>
                  <button
                    type="button"
                    class="hamburger close-sidebar-btn hamburger--elastic"
                    data-class="closed-sidebar"
                  >
                    <span class="hamburger-box">
                      <span class="hamburger-inner"></span>
                    </span>
                  </button>
                </div>
              </div>
            </div>
            <div class="pr-8">
            <form action="Logout_user.php" method="get">
            <input type="submit"
            class="rounded-md bg-sky-400 hover:bg-sky-500 delay-200 px-4 py-2 font-medium text-white"
            value="Đăng xuất"
          />
          </form>
            </div>
          </div>
          <!-- body -->
          <div class="app-main">
            <!-- menu left -->
            <div class="app-sidebar sidebar-shadow pt-20">
              <div class="scrollbar-sidebar">
                <div class="app-sidebar__inner">
                  <ul class="vertical-nav-menu">
                    <li class="app-sidebar__heading"></li>
                    <li>
                      <a href="main_page.php" class="mm-active">
                        <i class="metismenu-icon pe-7s-home"></i>
                        Trang chủ
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="metismenu-icon pe-7s-user"></i>
                        Người dùng
                        <i
                          class="metismenu-state-icon pe-7s-angle-down caret-left"
                        ></i>
                      </a>
                      <ul>
                        <li>
                          <a href="http://localhost/FashionShop-phpServer/Web/list_user.php?status=all&search_value=">
                            <i class="metismenu-icon"></i>
                            Danh sách người dùng
                          </a>
                        </li>
                      </ul>
                    </li>
                    <li>
                      <a href="#">
                        <i class="metismenu-icon pe-7s-box2"></i>
                        Sản phẩm
                        <i
                          class="metismenu-state-icon pe-7s-angle-down caret-left"
                        ></i>
                      </a>
                      <ul>
                        <li>
                          <a href="product_info_page.php">
                            <i class="metismenu-icon"></i>
                            Thêm sản phẩm
                          </a>
                        </li>
                        <li>
                          <a href="http://localhost/FashionShop-phpServer/Web/list_product.php?product_value=all&product_type=all&search_value=">
                            <i class="metismenu-icon"></i>
                            Danh sách sản phẩm
                          </a>
                        </li>
                      </ul>
                    </li>
                    <li>
                      <a href="http://localhost/FashionShop-phpServer/Web/invoice.php?month_value=all">
                        <i class="metismenu-icon pe-7s-note2"></i>
                        Hóa đơn chi tiết
                        <i
                          class="metismenu-state-icon pe-7s-angle-down caret-left"
                        ></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <!-- content -->
            <div class="app-main__outer">
              <div class="app-main__inner">
                <!-- code here -->
                <div class="pb-20">
                  <div class="">
                    <div class="">
                      <div class="card mb-3 widget-content bg-midnight-bloom" id="user_list">
                        <div class="widget-content-wrapper text-white">
                          <div class="widget-content-left">
                            <div class="widget-heading">Người dùng</div>
                          </div>
                          <div class="widget-content-right">
                            <div class="widget-numbers text-white">
                              <span>'.$user_quantity.'</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="">
                      <div class="card mb-3 widget-content bg-arielle-smile" id="product_list">
                        <div class="widget-content-wrapper text-white">
                          <div class="widget-content-left">
                            <div class="widget-heading">Sản phẩm</div>
                          </div>
                          <div class="widget-content-right">
                            <div class="widget-numbers text-white">
                              <span>'.$product_quantity.'</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="">
                      <div class="card mb-3 widget-content bg-grow-early" id="bill_list">
                        <div class="widget-content-wrapper text-white">
                          <div class="widget-content-left">
                            <div class="widget-heading">Đơn hàng</div>
                          </div>
                          <div class="widget-content-right">
                            <div class="widget-numbers text-white">
                              <span>'.$bill_quantity.'</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    '.$employee_html.'
                    <div class="">
                      <div
                        class="card mb-3 widget-content bg-gradient-to-r from-[purple] to-[cyan]"
                        id="profit"
                      >
                        <div class="widget-content-wrapper text-white">
                          <div class="widget-content-left flex">
                            <div class="widget-heading mr-2">Doanh Thu</div>
                          </div>
                          <div class="widget-content-right">
                            <div class="widget-numbers text-white">
                              <span></span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
          </div>
        </div>
        <script type="text/JavaScript"> 
            var user_list = document.getElementById("user_list");
            var bill_list = document.getElementById("bill_list");
            var product_list = document.getElementById("product_list");
            var employee_list = document.getElementById("employee_list");
            var profit = document.getElementById("profit");
            user_list.addEventListener("click", function () {
                window.open("http://localhost/FashionShop-phpServer/Web/list_user.php?status=all&search_value=","_self");
            });
            bill_list.addEventListener("click", function () {
              window.open("http://localhost/FashionShop-phpServer/Web/invoice.php?month_value=all","_self");
            });
            product_list.addEventListener("click", function () {
              window.open("http://localhost/FashionShop-phpServer/Web/list_product.php?product_value=all&product_type=all&search_value=","_self");
            });
            employee_list.addEventListener("click", function () {
              window.open("http://localhost/FashionShop-phpServer/Web/list_employee.php?search_value=","_self");
            });
            profit.addEventListener("click", function () {
              window.open("http://localhost/FashionShop-phpServer/Web/profit.php?cur_month='.$cur_month.'&cur_year='.$cur_year.'","_self");
            });
        </script>
      </body>
    </html>
    ';
    echo $main_page_html;
?>