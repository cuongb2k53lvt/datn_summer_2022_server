<?php
    require "../dbconnect.php";
    session_start();
    if(!isset($_SESSION['user_name']) && !isset($_SESSION['password'])){
        echo '<script type="text/JavaScript"> 
        window.open("http://datn4.000webhostapp.com/Web/Login_web.html","_self");
      </script>';
    }
    if($_SESSION['user_name'] != 'admin' && $_SESSION['password'] != 'admin'){
        session_start();
        session_unset();
        session_destroy();
        echo '<script type="text/JavaScript"> 
        window.open("http://datn4.000webhostapp.com/Web/Login_web.html","_self");
      </script>';
    }
    $employee_account = $_GET['employee_account'];
    $bill_html = '';
    $get_employee_bill = "SELECT * FROM bill_fashionshop INNER JOIN user_fashionshop ON bill_fashionshop.user_id = user_fashionshop.user_id WHERE employee = '$employee_account' ORDER BY bill_id DESC";
    $employee_bill_data = mysqli_query($connect,$get_employee_bill);
    if($employee_bill_data){
        while($row = mysqli_fetch_assoc($employee_bill_data)){
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
                <p>Hóa đơn: '.$row['bill_id'].'</p>
                <p>Trạng thái: '.$row['bill_status'].'</p>
                <p>Tên người dùng:'.$row['user_name'].'</p>
                <p>Email: '.$row['email'].'</p>
                <p>Liên hệ: '.$row['phone'].'</p>
                <p>Nhân viên duyệt đơn: '.$row['employee'].'</p>
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
    $invoice_html = '<!DOCTYPE html>
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
        <title>invoice</title>
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
                          <a href="http://datn4.000webhostapp.com/Web/list_user.php?status=all&search_value=">
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
                          <a href="http://datn4.000webhostapp.com/Web/list_product.php?product_value=all&product_type=all&search_value=">
                            <i class="metismenu-icon"></i>
                            Danh sách sản phẩm
                          </a>
                        </li>
                      </ul>
                    </li>
                    <li>
                      <a href="http://datn4.000webhostapp.com/Web/invoice.php?month_value=all">
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
                  <h1
                    class="text-blue-400 text-[40px] leading-[55px] font-semibold mb-16"
                  >
                    Lịch sử duyệt đơn
                  </h1>
    
                  <div class="flex items-center justify-content-between mb-10">
                    <!--search-->
                    <div
                      class="w-full max-w-md flex items-center rounded-lg bg-white drop-shadow-md"
                    >
                      
                    </div>
    
                    <!--select-->
                    <div>
                      
                    </div>
                  </div>
    
                  <div>
                    '.$bill_html.'
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
    echo $invoice_html;
?>