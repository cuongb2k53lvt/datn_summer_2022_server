<?php
    require "../dbconnect.php";
    session_start();
    if(!isset($_SESSION['user_name']) && !isset($_SESSION['password'])){
        echo '<script type="text/JavaScript"> 
        window.open("http://localhost/FashionShop-phpServer/Web/Login_web.html","_self");
      </script>';
    }
    $bill_id = $_GET['bill_id'];
    $user_name = $_GET['user_name'];
    $email = $_GET['email'];
    $phone = $_GET['phone'];
    $date_created = $_GET['date_created'];
    $user_id = '';
    $bill_status = '';
    $bill_value = '';
    $get_bill_status = "SELECT * FROM bill_fashionshop WHERE bill_id = '$bill_id'";
    $data_bill_status = mysqli_query($connect,$get_bill_status);
    if($data_bill_status){
      while($row = mysqli_fetch_assoc($data_bill_status)){
        $bill_status = $row['bill_status'];
        $bill_value = $row['amount'];
        $user_id = $row['user_id'];
      }
    }
    $total_amount = number_format($_GET['total_amount']);
    $get_bill_detail = "SELECT * FROM detail_bill_fashionshop INNER JOIN products_fashionshop ON 
    detail_bill_fashionshop.product_id = products_fashionshop.product_id WHERE detail_bill_fashionshop.bill_id = '$bill_id'";
    $bill_detail_data = mysqli_query($connect,$get_bill_detail);
    $bill_detail_html = '';
    if($bill_detail_data){
        while($row = mysqli_fetch_assoc($bill_detail_data)){
            $currency = number_format($row['price']);
            $bill_detail_html .= '<tr>
            <td
              class="flex items-center space-x-1 whitespace-nowrap px-9 py-5"
            >
              <div>
                <p>'.$row['product_name'].'</p>
              </div>
            </td>
            <td
              class="truncate whitespace-nowrap text-gray-600"
            ></td>
            <td
              class="truncate whitespace-nowrap text-center text-gray-600"
            >
              '.$row['quantity'].'
            </td>
            <td
              class="truncate whitespace-nowrap text-center text-gray-600"
            >
              '.$currency.' VNĐ
            </td>
          </tr>';
        }
    }
    $detail_invoice_html = '<!DOCTYPE html>
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
        <title>detailed invoice 123456789</title>
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
                  <h1
                    class="text-blue-400 text-[40px] leading-[55px] font-semibold text-center mb-4"
                  >
                    Hóa đơn chi tiết
                  </h1>
    
                  <section class="bg-gray-100 py-10">
                    <div class="mx-auto max-w-2xl py-0 md:py-16">
                      <article
                        class="overflow-hidden shadow-none md:rounded-md md:shadow-md"
                      >
                        <div class="bg-white md:rounded-b-md">
                          <div class="border-b border-gray-200 p-9">
                            <div class="space-y-6">
                              <div class="items-top flex justify-between">
                                <div class="space-y-4">
                                  <div>
                                    <p class="text-lg font-bold">Hóa đơn</p>
                                    <p></p>
                                  </div>
                                  <div>
                                    <p class="text-sm font-medium text-gray-400">
                                      Hóa đơn của
                                    </p>
                                    <p>'.$user_name.'</p>
                                    <p>'.$email.'</p>
                                    <p>'.$phone.'</p>
                                  </div>
                                </div>
                                <div class="space-y-2">
                                  <div>
                                    <p class="text-sm font-medium text-gray-400">
                                      Mã ID
                                    </p>
                                    <p>'.$bill_id.'</p>
                                  </div>
                                  <div>
                                    <p class="text-sm font-medium text-gray-400">
                                      Ngày thanh toán
                                    </p>
                                    <p>'.$date_created.'</p>
                                  </div>
                                  <div>
                                    <p class="text-sm font-medium text-gray-400">
                                      Trạng thái đơn hàng
                                    </p>
                                    <p>'.$bill_status.'</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="border-b border-gray-200 p-9">
                            <p class="text-sm font-medium text-gray-400">Lưu ý</p>
                            <p class="text-sm">Thank you for your order.</p>
                          </div>
                          <table class="w-full divide-y divide-gray-200 text-sm">
                            <thead>
                              <tr>
                                <th
                                  scope="col"
                                  class="px-9 py-4 text-left font-semibold text-gray-400"
                                >
                                  Sản phẩm
                                </th>
                                <th
                                  scope="col"
                                  class="py-3 text-left font-semibold text-gray-400"
                                ></th>
                                <th
                                  scope="col"
                                  class="py-3 text-center font-semibold text-gray-400"
                                >
                                  Số lượng
                                </th>
                                <th
                                  scope="col"
                                  class="py-3 text-center font-semibold text-gray-400"
                                >
                                  Giá tiền
                                </th>
                                <th
                                  scope="col"
                                  class="py-3 text-left font-semibold text-gray-400"
                                ></th>
                              </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                              '.$bill_detail_html.'
                            </tbody>
                          </table>
                          <div class="border-b border-gray-200 p-9">
                            <div class="space-y-3">
                              <div class="flex justify-between">
                                <div>
                                  <p class="text-lg font-bold text-black">Tổng</p>
                                </div>
                                <p class="text-lg font-bold text-black">'.$total_amount.' VNĐ</p>
                              </div>
                            </div>
                            <div class="space-y-3" style="margin-top: 10px;">
                              <div class="flex justify-between">
                                <div class="flex justify-center">
                                  <form action="change_bill_status.php" method="post">
                                    <input type="text" name="bill_id" value = "'.$bill_id.'" style="display: none;">
                                    <input type="text" name="user_id" value = "'.$user_id.'" style="display: none;">
                                    <input type="text" name="bill_value" value = "'.$bill_value.'" style="display: none;">
                                    <input type="text" name="bill_status" value = "'.$bill_status.'" style="display: none;">
                                    <input type="text" name="action" value = "Duyệt đơn" style="display: none;">
                                    <input type="submit"
                                    class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-6 py-2 rounded-md drop-shadow-md transition-all duration-700 hover:-translate-y-1 hover:bg-gradient-to-l"
                                    value="Duyệt đơn hàng"
                                    />
                                  </form>
                                </div>
                                <div class="flex justify-center">
                                    <form action="change_bill_status.php" method="post">
                                    <input type="text" name="bill_id" value = "'.$bill_id.'" style="display: none;">
                                    <input type="text" name="user_id" value = "'.$user_id.'" style="display: none;">
                                    <input type="text" name="bill_value" value = "'.$bill_value.'" style="display: none;">
                                    <input type="text" name="bill_status" value = "'.$bill_status.'" style="display: none;">
                                    <input type="text" name="action" value = "Chuyển sang đã giao" style="display: none;">
                                    <input type="submit"
                                    class="bg-gradient-to-r from-cyan-500 to-green-500 text-white px-6 py-2 rounded-md drop-shadow-md transition-all duration-700 hover:-translate-y-1 hover:bg-gradient-to-l"
                                    value="Chuyển sang đã giao"
                                    />
                                  </form>
                                </div>
                                <div class="flex justify-center">
                                  <form action="change_bill_status.php" method="post">
                                    <input type="text" name="bill_id" value = "'.$bill_id.'" style="display: none;">
                                    <input type="text" name="user_id" value = "'.$user_id.'" style="display: none;">
                                    <input type="text" name="bill_value" value = "'.$bill_value.'" style="display: none;">
                                    <input type="text" name="bill_status" value = "'.$bill_status.'" style="display: none;">
                                    <input type="text" name="action" value = "Hủy đơn" style="display: none;">
                                    <input type="submit"
                                    class="bg-gradient-to-r from-green-500 to-red-500 text-white px-6 py-2 rounded-md drop-shadow-md transition-all duration-700 hover:-translate-y-1 hover:bg-gradient-to-l"
                                    value="Hủy đơn hàng"
                                    />
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </article>
                    </div>
                  </section>
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
    echo $detail_invoice_html;
?>