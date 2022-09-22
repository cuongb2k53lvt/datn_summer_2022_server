<?php
    require "../dbconnect.php";
    $user_name = $_GET['user_name'];
    $user_id = $_GET['user_id'];
    session_start();
    if(!isset($_SESSION['user_name']) && !isset($_SESSION['password'])){
        echo '<script type="text/JavaScript"> 
        window.open("http://datn4.000webhostapp.com/Web/Login_web.html","_self");
      </script>';
    }
    $user_info_html = '';
    $get_user = "SELECT * FROM user_fashionshop WHERE user_name = '$user_name'";
    $data_user = mysqli_query($connect,$get_user);
    if($data_user){
        while($row = mysqli_fetch_assoc($data_user)){
            $currency = number_format($row['total_spend']);
            $user_info_html = '<div class="w-[65%]">
    <div class="flex items-center mb-4">
      <p class="w-[20%] font-semibold">Họ và tên : </p>
      <input
        class="w-[80%] p-2 focus:outline-blue-400"
        type="text"
        value="'.$row['full_name'].'"
      />
    </div>
    <div class="flex items-center mb-4">
      <p class="w-[20%] font-semibold">Ngày sinh : </p>
      <input
        class="w-[80%] p-2 focus:outline-blue-400"
        type="text"
        value="'.$row['birthdate'].'"
      />
    </div>
    <div class="flex items-center mb-4">
      <p class="w-[20%] font-semibold">Giới tính : </p>
      <input
        class="w-[80%] p-2 focus:outline-blue-400"
        type="text"
        value="'.$row['sex'].'"
      />
    </div>
    <div class="flex items-center mb-4">
      <p class="w-[20%] font-semibold">Số điện thoại : </p>
      <input
        class="w-[80%] p-2 focus:outline-blue-400"
        type="text"
        value="'.$row['phone'].'"
      />
    </div>
    <div class="flex items-center mb-4">
      <p class="w-[20%] font-semibold">Email : </p>
      <input
        class="w-[80%] p-2 focus:outline-blue-400"
        type="text"
        value="'.$row['email'].'"
      />
    </div>
    <div class="flex items-center mb-4">
      <p class="w-[20%] font-semibold">Tổng tiền đã chi trả: </p>
      <input
        class="w-[80%] p-2 focus:outline-blue-400"
        type="text"
        value="'.$currency.' vnđ"
      />
    </div>';
        }
    }
    $detail_user_html = '<!DOCTYPE html>
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
        <title>detail user</title>
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
              <div class="app-main__inner bg-white">
                <!-- code here -->
                <div class="pb-20">
                  <h1
                    class="text-blue-400 text-[40px] leading-[55px] font-semibold mb-14"
                  >
                    Chi tiết người dùng
                  </h1>
                  <form action="user_history.php" method="get">
                    <div class="flex">
                      <div class="w-[30%]">
                        <img
                          class="rounded-full"
                          alt="user-image"
                          src="https://www.pavilionweb.com/wp-content/uploads/2017/03/man-300x300.png"
                          alt=""
                          width="180px"
                          height="180px"
                        />
                      </div>
                        '.$user_info_html.'
                        <div class="flex justify-center">
                          <form action="" method="post">
                            <input type="text" name="user_id" value = "'.$user_id.'" style="display: none;">
                            <input type="submit"
                            class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-6 py-2 rounded-md drop-shadow-md transition-all duration-700 hover:-translate-y-1 hover:bg-gradient-to-l"
                            value="Lịch sử mua hàng"
                            />
                          </form>
                        </div>
                      </div>
                    </div>
                  </form>
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
    echo $detail_user_html;
?>