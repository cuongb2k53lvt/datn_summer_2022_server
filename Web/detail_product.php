<?php
    require '../dbconnect.php';
    session_start();
    if(!isset($_SESSION['user_name']) && !isset($_SESSION['password'])){
        echo '<script type="text/JavaScript"> 
        window.open("http://localhost/FashionShop-phpServer/Web/Login_web.html","_self");
      </script>';
    }
    $img = array();
    $product_id = $_GET['product_id'];
    $product_name = '';
    $desc = '';
    $price = '';
    $cost = '';
    $type = '';
    $date_added = '';
    $rating = '';
    $material = '';
    $discount_rate = '';
    $status1 = '';
    $status2 = '';
    $sold_quantity = '';
    $get_product_quantity = "SELECT SUM(remain_product) as remain, SUM(total_product) as total FROM product_size_fashionshop WHERE product_id = '$product_id'";
    $data_product_quantity = mysqli_query($connect,$get_product_quantity);
    if($data_product_quantity){
      while($row = mysqli_fetch_assoc($data_product_quantity)){
        $sold_quantity = ($row['total']-$row['remain']).'/'.$row['total'];
      }
    }
    $get_product = "SELECT * FROM products_fashionshop INNER JOIN product_photo_fashionshop ON 
    products_fashionshop.product_id = product_photo_fashionshop.product_id INNER JOIN clothes_type_fashionshop ON 
    products_fashionshop.type_id = clothes_type_fashionshop.type_id WHERE products_fashionshop.product_id = '$product_id'";
    $product_data = mysqli_query($connect,$get_product);
    if($product_data){
        while($row = mysqli_fetch_assoc($product_data)){
            array_push($img,$row['photo']);
            $product_name = $row['product_name'];
            $desc = $row['description_prd'];
            $price = $row['price'];
            $cost = $row['cost'];
            $type = $row['type'];
            $date_added = $row['date_added'];
            $rating = $row['rating'];
            $material = $row['material'];
            $discount_rate = $row['discount_rate'];
            if($row['status']=='Còn hàng'){
              $status1 = 'selected';
            }else{
              $status2 = 'selected';
            }
        }
    }
    $detail_product_html = '<!DOCTYPE html>
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
                <title>Chi tiết sản phẩm</title>
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
                      <div class="app-main__inner bg-white">
                        <!-- code here -->
                        <div class="pb-20">
                          <form action="update_detail_product.php" method="post" enctype="multipart/form-data">
                            <h1
                              class="text-blue-400 text-[40px] leading-[55px] font-semibold text-center mb-14"
                            >
                              Chi tiết sản phẩm
                            </h1>
            
                            <div class="flex justify-between">
                              <!-- image -->
                              <div class="w-[40%]">
                                <img
                                  src="'.$img[0].'"
                                  alt=""
                                  height="300px"
                                  width="300px"
                                  class="img0"
                                />
                                <div class="img_selector grid grid-cols-3 gap-4">
                                  <img
                                    src="'.$img[0].'"
                                    alt=""
                                    height="120px"
                                    width="120px"
                                  />
                                  <img
                                    src="'.$img[1].'"
                                    alt=""
                                    height="120px"
                                    width="120px"
                                  />
                                  <img
                                    src="'.$img[2].'"
                                    alt=""
                                    height="120px"
                                    width="120px"
                                  />
                                </div>
                                
                              </div>
                              
                              <!-- information -->
                              <div class="w-[55%]">
                                <div class="flex justify-between items-center mb-4">
                                  <p id="product_name" class="w-[20%] font-semibold">
                                    Tên sản phẩm
                                  </p>
                                  <input
                                    class="w-[76%] focus:outline-none px-2 py-1"
                                    type="text"
                                    id="product_name_edt"
                                    name = "product_name"
                                    value="'.$product_name.'"
                                  />
                                </div>
            
                                <div class="flex justify-between items-center mb-4">
                                  <p class="w-[20%] font-semibold">Mô tả</p>
                                  <textarea name="desc" cols="40" rows="5" class="w-[76%] focus:outline-none px-2 py-1">'.$desc.'</textarea>
                                </div>
            
                                <div class="flex justify-between items-center mb-4">
                                  <p class="w-[20%] font-semibold">Giá bán</p>
                                  <input
                                    class="w-[76%] focus:outline-none px-2 py-1"
                                    type="text"
                                    disabled
                                    value="'.number_format($price).' VNĐ"
                                  />
                                </div>
            
                                <div class="flex justify-between items-center mb-4">
                                  <p class="w-[20%] font-semibold">Giá nhập</p>
                                  <input
                                    class="w-[76%] focus:outline-none px-2 py-1"
                                    type="text"
                                    disabled
                                    value="'.number_format($cost).' VNĐ"
                                  />
                                </div>
            
                                <div class="flex justify-between items-center mb-4">
                                  <p class="w-[20%] font-semibold">Loại</p>
                                  <input
                                    class="w-[76%] focus:outline-none px-2 py-1"
                                    type="text"
                                    disabled
                                    value="'.$type.'"
                                  />
                                </div>
            
                                <div class="flex justify-between items-center mb-4">
                                  <p class="w-[20%] font-semibold">Ngày thêm vào</p>
                                  <input
                                    class="w-[76%] focus:outline-none px-2 py-1"
                                    type="text"
                                    disabled
                                    value="'.$date_added.'"
                                  />
                                </div>
                                <div class="flex justify-between items-center mb-4">
                                  <p class="w-[20%] font-semibold">Điểm số</p>
                                  <input
                                    class="w-[76%] focus:outline-none px-2 py-1"
                                    type="text"
                                    disabled
                                    value="'.$rating.'"
                                  />
                                </div>
                                <div class="flex justify-between items-center mb-4">
                                  <p class="w-[20%] font-semibold">Chất liệu</p>
                                  <input
                                    class="w-[76%] focus:outline-none px-2 py-1"
                                    type="text"
                                    name="material"
                                    value="'.$material.'"
                                  />
                                </div>
                                <div class="flex justify-between items-center mb-4">
                                  <p class="w-[20%] font-semibold">Tỉ lệ giảm giá(%)</p>
                                  <input
                                    class="w-[76%] focus:outline-none px-2 py-1"
                                    type="text"
                                    name="discount_rate"
                                    value="'.$discount_rate.'"
                                  />
                                </div>
                                <div class="flex justify-between items-center mb-4">
                                  <p class="w-[20%] font-semibold">Số sản phẩm bán được</p>
                                  <input
                                    class="w-[76%] focus:outline-none px-2 py-1"
                                    type="text"
                                    value="'.$sold_quantity.'"
                                    disabled
                                  />
                                </div>
                                <!-- logic -->
                                <input
                                    style="display: none;"
                                    type="text"
                                    name="product_id"
                                    value="'.$product_id.'"
                                  />
                                <div class="flex justify-between items-center mb-4">  
                                <p class="w-[20%] font-semibold">Trạng thái</p>  
                                <select
                                  class="bg-white px-3 py-2 text-gray-800 focus:outline-none rounded-2 drop-shadow-md"
                                  name="status"
                                  >
                                    <option value="Còn hàng" '.$status1.'>Còn hàng</option>
                                    <option value="Hết hàng" '.$status2.'>Hết hàng</option>
                                </select>  
                                </div>
                                <div class="flex justify-center">
                                  <button
                                    type="submit"
                                    id="update_btn"
                                    class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-6 py-2 rounded-md drop-shadow-md transition-all duration-700 hover:-translate-y-1 hover:bg-gradient-to-l"
                                  >
                                    Chỉnh sửa
                                  </button>
                                </div>
                              </div>
                            </div>
                          </form>
                          <form action="add_product_quantity.php" method="post" class = "img_selector grid grid-cols-3 gap-4">
                                  <div class="flex justify-between items-center mb-4">
                                    <input
                                    type="text"
                                    name = "product_id"
                                    style="display: none;"
                                    value="'.$product_id.'"
                                    />
                                    <input
                                      
                                      class="w-[76%] focus:outline-none px-2 py-1"
                                      type="number"
                                      id="product_name_edt"
                                      name = "quantity"
                                      value=""
                                      placeholder="Nhập số lượng"
                                      required
                                    />
                                    <select
                                      class="bg-white px-3 py-2 text-gray-800 focus:outline-none rounded-2 drop-shadow-md"
                                      name="size"
                                    >
                                      <option value="S" >Size S</option>
                                      <option value="M" >Size M</option>
                                      <option value="L" >Size L</option>
                                      <option value="XL" >Size XL</option>
                                    </select>  
                                    <input type="submit" value="Thêm số lượng" class = "bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-6 py-2 rounded-md drop-shadow-md transition-all duration-700 hover:-translate-y-1 hover:bg-gradient-to-l">
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
            <script src="detail_product.js"></script>    
            ';
    echo $detail_product_html;
?>