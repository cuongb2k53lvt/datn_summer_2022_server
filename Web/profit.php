<?php
    require "../dbconnect.php";
    session_start();
    if(!isset($_SESSION['user_name']) && !isset($_SESSION['password'])){
        echo '<script type="text/JavaScript"> 
        window.open("http://localhost/FashionShop-phpServer/Web/Login_web.html","_self");
      </script>';
    }
    $cur_month = $_GET['cur_month'];
    $cur_year = $_GET['cur_year'];

    $get_top5_product = "SELECT * FROM products_fashionshop INNER JOIN (SELECT SUM(quantity) as total, product_id FROM detail_bill_fashionshop INNER JOIN bill_fashionshop ON detail_bill_fashionshop.bill_id = bill_fashionshop.bill_id WHERE bill_fashionshop.bill_status = 'Đã giao' AND MONTH(bill_fashionshop.date_shipped) = '$cur_month' AND YEAR(bill_fashionshop.date_shipped) = '$cur_year' GROUP BY product_id ORDER BY total DESC LIMIT 5) table1 ON products_fashionshop.product_id = table1.product_id";

    $month_profit = "SELECT SUM(quantity*(price*(100-discount_rate_bill)/100-cost)) as profit FROM (SELECT quantity, detail_bill_fashionshop.product_id, products_fashionshop.price, products_fashionshop.cost,detail_bill_fashionshop.discount_rate_bill FROM detail_bill_fashionshop INNER JOIN bill_fashionshop ON detail_bill_fashionshop.bill_id = bill_fashionshop.bill_id INNER JOIN products_fashionshop ON products_fashionshop.product_id = detail_bill_fashionshop.product_id WHERE bill_fashionshop.bill_status = 'Đã giao' AND MONTH(bill_fashionshop.date_shipped) = '$cur_month' AND YEAR(bill_fashionshop.date_shipped) = '$cur_year') table1;";
    $month_profit_data = mysqli_query($connect,$month_profit);
    $month_profit_html = '';
    if($month_profit_data){
        while($row = mysqli_fetch_assoc($month_profit_data)){
            $month_profit_html = '<div class="widget-content-right">
            <div class="widget-numbers text-white">
              <span>'.number_format($row['profit']).' VNĐ</span>
            </div>
          </div>';
        }
    }

    $year_profit = "SELECT SUM(quantity*(price*(100-discount_rate_bill)/100-cost)) as profit FROM (SELECT quantity, detail_bill_fashionshop.product_id, products_fashionshop.price, products_fashionshop.cost,detail_bill_fashionshop.discount_rate_bill FROM detail_bill_fashionshop INNER JOIN bill_fashionshop ON detail_bill_fashionshop.bill_id = bill_fashionshop.bill_id INNER JOIN products_fashionshop ON products_fashionshop.product_id = detail_bill_fashionshop.product_id WHERE bill_fashionshop.bill_status = 'Đã giao' AND YEAR(bill_fashionshop.date_shipped) = '$cur_year') table1;";
    $year_profit_data = mysqli_query($connect,$year_profit);
    $year_profit_html = '';
    if($year_profit_data){
        while($row = mysqli_fetch_assoc($year_profit_data)){
            $year_profit_html = '<div class="widget-content-wrapper text-white">
            <div class="widget-content-left">
              <div class="widget-heading">
                Tổng doanh thu năm <span>'.$cur_year.'</span>
              </div>
            </div>
            <div class="widget-content-right">
              <div class="widget-numbers text-white">
                <span>'.number_format($row['profit']).' VNĐ</span>
              </div>
            </div>
          </div>';
        }
    }

    $data_product = mysqli_query($connect,$get_top5_product);
    $product_html = '';
    if($data_product){
        while($row = mysqli_fetch_assoc($data_product)){
            $product_html .= '<div
            class="bg-white w-full rounded-md px-4 py-4 flex justify-between mb-3"
          >
            <div class="flex items-center">
              <div>
                <p>Tên sản phẩm: '.$row['product_name'].'</p>
                <p>Sản xuất: <span>'.$row['location'].'</span></p>
                <p>Giá: <span>'.number_format($row['price']).' VNĐ</span></p>
                <p>Sản phẩm đã bán: <span>'.$row['total'].'</span></p>
              </div>
            </div>
            <div class="text-center flex items-center">
                <form action="detail_product.php" method="get" class="bg-purple-500 p-2 text-xs text-white  hover:shadow-lg">
                <input type="text" name="product_id" value = "'.$row['product_id'].'" style="display: none;">
                <input type="submit" value="Xem">
                </form>
            </div>
          </div>';
        }
    }
    $get_top5_user = "SELECT * FROM user_fashionshop ORDER BY total_spend DESC LIMIT 5";
    $data_user = mysqli_query($connect,$get_top5_user);
    $user_html = '';
    if($data_user){
        while($row = mysqli_fetch_assoc($data_user)){
            $user_html .= '<div
            class="bg-white w-full rounded-md px-4 py-4 flex justify-between mb-3"
          >
            <div class="flex items-center">
              <div>
                <p>Họ tên: <span>'.$row['full_name'].'</span></p>
                <p>Liên hệ: <span>'.$row['address'].'</span></p>
                <p>Email: <span>'.$row['email'].'</span></p>
                <p>Tiền thanh toán: <span>'.number_format($row['total_spend']).' VNĐ</span></p>
              </div>
            </div>
            <div class="text-center flex items-center">
                <form action="detail_user.php" method="get" class="bg-purple-500 p-2 text-xs text-white hover:shadow-lg">
                <input type="text" name="user_name" value = "'.$row['user_name'].'" style="display: none;">
                <input type="text" name="user_id" value = "'.$row['user_id'].'" style="display: none;">
                <input type="submit" value="Xem">
                </form>
            </div>
          </div>';
        }
    }
    $get_bill = "SELECT * FROM bill_fashionshop INNER JOIN user_fashionshop ON bill_fashionshop.user_id = user_fashionshop.user_id 
    WHERE bill_fashionshop.bill_status = 'Đã giao' AND MONTH(bill_fashionshop.date_shipped) = '$cur_month' AND YEAR(bill_fashionshop.date_shipped) = '$cur_year'";
    $data_bill = mysqli_query($connect,$get_bill);
    $bill_html = '';
    if($data_bill){
        while($row = mysqli_fetch_assoc($data_bill)){
            $bill_html .= '<div
            class="bg-white w-full rounded-md px-4 py-4 flex justify-between mb-6"
          >
            <div class="flex items-center">
              <img
                src="https://banner2.cleanpng.com/20180523/tha/kisspng-businessperson-computer-icons-avatar-clip-art-lattice-5b0508dc6a3a10.0013931115270566044351.jpg"
                alt="user"
                class="h-[80px] w-[80px] rounded-full mr-4"
              />
              <div>
                <p>'.$row['user_name'].'</p>
                <p>'.$row['email'].'</p>
                <p>'.$row['phone'].'</p>
              </div>
            </div>
            <div class="text-center">
              <div class="flex items-center text-[14px] mb-2">
                <div class="text-center">
                  <p>Ngày thanh toán</p>
                  <p>'.$row['date_created'].'</p>
                </div>
              </div>
              <form action="detail_invoice.php" method="get">
                    <input type="text" name="bill_id" value = "'.$row['bill_id'].'" style="display: none;">
                    <input type="text" name="user_name" value = "'.$row['user_name'].'" style="display: none;">
                    <input type="text" name="email" value = "'.$row['email'].'" style="display: none;">
                    <input type="text" name="phone" value = "'.$row['phone'].'" style="display: none;">
                    <input type="text" name="date_created" value = "'.$row['date_created'].'" style="display: none;">
                    <input type="text" name="total_amount" value = "'.$row['amount'].'" style="display: none;">
                    <input type="text" name="bill_status" value = "'.$row['bill_status'].'" style="display: none;">
                    <input type="submit"
                    class="bg-purple-500 p-2 text-xs text-white hover:shadow-lg"
                    value="View"
                />
              </form>
            </div>
          </div>';
        }
    }
    $profit_html = '<!DOCTYPE html>
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
        <title>List user</title>
      </head>
    
      <body>
        <div
          class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header font-[\'Lexend_Deca\']"
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
                <div class="pb-20 relative">
                  <!-- title-->
                  <h1
                    class="text-blue-400 text-[40px] leading-[55px] font-semibold mb-16"
                  >
                    Doanh thu tháng '.$cur_month.' năm '.$cur_year.'
                  </h1>
                  <!--profit-->
                  <div class="flex justify-between mb-4">
                    <div class="w-1/2">
                      <div class="card mb-3 widget-content bg-asteroid">
                        <div class="widget-content-wrapper text-white">
                          <div class="widget-content-left">
                            <div class="widget-heading">Doanh thu tháng</div>
                          </div>
                          '.$month_profit_html.'
                        </div>
                      </div>
                    </div>
                    <!--select-->
                    <div>
                      <form action="profit.php" method="get">
                    <select
                    class="bg-white px-3 py-2 text-gray-800 focus:outline-none rounded-2 drop-shadow-md"
                    name="cur_month"
                    >
                      <option value="01">Tháng 1</option>
                      <option value="02">Tháng 2</option>
                      <option value="03">Tháng 3</option>
                      <option value="04">Tháng 4</option>
                      <option value="05">Tháng 5</option>
                      <option value="06">Tháng 6</option>
                      <option value="07">Tháng 7</option>
                      <option value="08">Tháng 8</option>
                      <option value="09">Tháng 9</option>
                      <option value="10">Tháng 10</option>
                      <option value="11">Tháng 11</option>
                      <option value="12">Tháng 12</option>
                    </select>
                    <select
                    class="bg-white px-3 py-2 text-gray-800 focus:outline-none rounded-2 drop-shadow-md"
                    name="cur_year"
                    >
                      <option value="2022">2022</option>
                      <option value="2023">2023</option>
                    </select>
                      <button type="submit" class="bg-white px-3 py-1 text-gray-800 focus:outline-none rounded-2 drop-shadow-md">
                        <img style="height: 20px; width: 20px;" src="assets/images/icon-filter-5.jpg">
                      </button>
                  </form>
                    </div>
                  </div>
                  <!--table user + product-->
                  <div class="flex mb-8">
                    <div class="w-1/2 p-2">
                      <h1 class="text-center text-[18px] mb-4">
                        Top 5 người dùng mua nhiều nhất <span></span>
                      </h1>
                      '.$user_html.'
                    </div>
                    <div class="w-1/2 p-2">
                      <h1 class="text-center text-[18px] mb-4">
                        Top 5 sản phẩm bán chạy nhất tháng <span></span>
                      </h1>
                      '.$product_html.'
                    </div>
                  </div>
                  <!-- list invoice-->
                  <div class="mb-16">
                    <h1 class="text-center text-[22px] mb-3">
                      Danh sách hóa đơn được duyệt trong tháng <span>1</span>
                    </h1>
                    '.$bill_html.'
                  </div>
                  <!--total-->
                  <div class="w-[940px] fixed bottom-0 z-20">
                    <div class="">
                      <div class="card mb-3 widget-content bg-midnight-bloom">
                        '.$year_profit_html.'
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--script-->
            <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
          </div>
        </div>
      </body>
    </html>
    ';
    echo $profit_html;
?>