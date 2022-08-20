<?php
    require "../dbconnect.php";
    session_start();
    if(!isset($_SESSION['user_name']) && !isset($_SESSION['password'])){
        echo '<script type="text/JavaScript"> 
        window.open("http://localhost/FashionShop-phpServer/Web/Login_web.html","_self");
      </script>';
    }
    $search_style = "(search.length > 0) ? 'bg-purple-500' : 'bg-gray-500 cursor-not-allowed'";
    $status = $_GET['status'];
    $search_value = $_GET['search_value'];
    $select_opt1 = '';
    $select_opt2 = '';
    $select_opt3 = '';
    if(strlen($search_value) == 0){
      $get_user = "SELECT * FROM user_fashionshop";
    }else{
      $get_user = "SELECT * FROM user_fashionshop WHERE user_name LIKE '%$search_value%'";
    }
    if($status == 'all'){
      $get_user = "SELECT * FROM user_fashionshop";
      $select_opt1 = 'selected';
    }
    if($status == 'active'){
      $get_user = "SELECT * FROM user_fashionshop WHERE active_status = 'active'";
      $select_opt2 = 'selected';
    }
    if($status == 'deactive'){
      $get_user = "SELECT * FROM user_fashionshop WHERE active_status = 'deactive'";
      $select_opt3 = 'selected';
    }
    $data_user = mysqli_query($connect,$get_user);
    $data_user_html = '';
    if($data_user){
      while($row = mysqli_fetch_assoc($data_user)){
        $status_color = 'green';
        $action = 'Unblock';
        if($row['active_status'] == 'active'){
          $status_color = 'red';
          $action = 'Block';
        }
        $data_user_html.='<tr
        class="border-b bg-gray-100 text-center text-sm text-gray-600"
      >
        <td class="border-r p-2">'.$row['user_id'].'</td>
        <td class="border-r p-2">'.$row['full_name'].'</td>
        <td class="border-r p-2">'.$row['email'].'</td>
        <td class="border-r p-2">'.$row['user_name'].'</td>
        <td class="border-r p-2">'.$row['phone'].'</td>
        <td class="border-r p-2">'.$row['last_login'].'</td>
        <td>
          <form action="detail_user.php" method="get" class="bg-purple-500 p-2 text-xs text-white hover:shadow-lg">
              <input type="text" name="user_name" value = "'.$row['user_name'].'" style="display: none;">
              <input type="text" name="user_id" value = "'.$row['user_id'].'" style="display: none;">
              <input type="submit" value="Xem">
          </form>
          <form action="change_user_status.php" method="post" class="bg-'.$status_color.'-500 p-2 text-xs text-white hover:shadow-lg">
              <input type="text" name="user_name" value = "'.$row['user_name'].'" style="display: none;">
              <input type="text" name="status" value = "'.$row['active_status'].'" style="display: none;">
              <input type="submit" value="'.$action.'">
          </form>
        </td>
      </tr>';
      }
    }
    $list_user_html = '<!DOCTYPE html>
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
                          <a href="insert_product.html">
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
                  <h1
                    class="text-blue-400 text-[40px] leading-[55px] font-semibold mb-16"
                  >
                    Danh sách người dùng
                  </h1>
                  <div class="flex items-center justify-content-between px-2 mb-10">
                    <!--search-->
                    <div
                      
                    >
                    <form action="list_user.php" method="get" class="w-full max-w-md flex items-center rounded-lg bg-white drop-shadow-md">
                    <div class="w-full">
                      <input
                        type="search"
                        name="search_value"
                        class="w-full rounded-full px-4 py-1 text-gray-800 focus:outline-none"
                        placeholder="search"
                      />
                    </div>
                    <input type="text" name="status" value = "" style="display: none;">
                    <div>
                      <button
                        type="submit"
                        class="flex h-12 w-12 items-center justify-center rounded-r-lg bg-blue-500 text-white"
                        :class="'.$search_style.'"
                        :disabled="search.length == 0"
                      >
                        <svg
                          class="h-5 w-5"
                          fill="none"
                          stroke="currentColor"
                          viewBox="0 0 24 24"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                          ></path>
                        </svg>
                      </button>
                    </div>
                  </form>
                    </div>
    
                    <!--select-->
                    <div>
                      <form action="list_user.php" method="get">
                        <select
                        name="status"
                        class="bg-white px-3 py-2 text-gray-800 focus:outline-none rounded-2 drop-shadow-md"
                        >
                          <option value="all" '.$select_opt1.'>Tất cả</option>
                          <option value="active" '.$select_opt2.'>Đang hoạt động</option>
                          <option value="deactive" '.$select_opt3.'>Đang bị khóa</option>
                        </select>
                        <input type="text" name="search_value" value = "" style="display: none;">
                        <button type="submit" class="bg-white px-3 py-1 text-gray-800 focus:outline-none rounded-2 drop-shadow-md">
                          <img style="height: 20px; width: 20px;" src="assets/images/icon-filter-5.jpg">
                        </button>
                      </form>
                    </div>
                  </div>
                  <div class="table w-full p-2">
                    <table class="w-full border">
                      <thead>
                        <tr class="border-b bg-gray-50">
                          <th
                            class="cursor-pointer border-r p-2 text-sm text-gray-500"
                          >
                            <div class="flex items-center justify-center">ID</div>
                          </th>
                          
                          <th
                            class="cursor-pointer border-r p-2 text-sm text-gray-500"
                          >
                            <div class="flex items-center justify-center">
                              Họ và tên
                            </div>
                          </th>
                          <th
                            class="cursor-pointer border-r p-2 text-sm text-gray-500"
                          >
                            <div class="flex items-center justify-center">
                              Email
                            </div>
                          </th>
                          <th
                            class="cursor-pointer border-r p-2 text-sm text-gray-500"
                          >
                            <div class="flex items-center justify-center">
                              Tài khoản
                            </div>
                          </th>
                          <th
                            class="cursor-pointer border-r p-2 text-sm text-gray-500"
                          >
                            <div class="flex items-center justify-center">
                              Điện thoại
                            </div>
                          </th>
                          <th
                            class="cursor-pointer border-r p-2 text-sm text-gray-500"
                          >
                            <div class="flex items-center justify-center">
                              Đăng nhập lần cuối
                            </div>
                          </th>
                          <th
                            class="cursor-pointer border-r p-2 text-sm text-gray-500"
                          >
                            <div class="flex items-center justify-center">
                              Hành động
                            </div>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        '.$data_user_html.'
                      </tbody>
                    </table>
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
    echo $list_user_html;
?>