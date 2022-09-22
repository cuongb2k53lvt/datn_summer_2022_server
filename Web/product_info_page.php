<?php
    require "../dbconnect.php";
    $select_all_brand = "SELECT * FROM brand_fashionshop";
    $brand_data = mysqli_query($connect,$select_all_brand);
    $brands ='';
    while($row = mysqli_fetch_assoc($brand_data)){
        $brands = $brands.'<option value="'.$row['brand_id'].'">'.$row['name'].'</option>';
    }
    $select_all_type = "SELECT * FROM clothes_type_fashionshop";
    $type_data = mysqli_query($connect,$select_all_type);
    $types = '';
    while($row = mysqli_fetch_assoc($type_data)){
        $types = $types.'<option value="'.$row['type_id'].'">'.$row['type'].'</option>';
    }
    $product_info_page = '<!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- import font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100;200;300;400;500;600&display=swap"
            rel="stylesheet">
        <!-- import tailwindcss -->
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- import css -->
        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="modal.css">
        <!-- import js -->
        <script src="main.js"></script>
    
        <!-- title -->
        <title>insert product</title>
    </head>
    
    <body>
        <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
            <!-- header -->
            <div class="app-header header-shadow">
                <!-- logo -->
                <div class="app-header__logo">
                    <div class="">Model Fashion</div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                                data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- body -->
            <div class="app-main">
                <!-- menu left -->
                <div class="app-sidebar sidebar-shadow">
                    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading">Menu</li>
                                <li>
                                    <a href="main_page.php" class="mm-active">
                                        <i class="metismenu-icon pe-7s-home"></i>
                                        Trang chủ
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="metismenu-icon pe-7s-users"></i>
                                        Người dùng
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
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
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
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
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
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
                            <h1 class="text-blue-400 text-[40px] leading-[55px] font-semibold mb-14">
                                Sản phẩm
                            </h1>
                            <button
                                class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-10 py-4 rounded-md drop-shadow-md transition-all duration-700 hover:-translate-y-1 hover:bg-gradient-to-l"
                                name="addBrand" id="addBrand">
                                Thêm brand
                            </button>
                            <div id="modalBrand" class="modalBrand">
                                <!-- Modal content -->
                                <form action="insert_brand.php" method="post" enctype="multipart/form-data">
                                    <div class="modal-content">
                                        <p class="text-blue-400 text-[40px] leading-[55px] font-semibold mb-14">Thêm brand
                                        </p>
                                        <input
                                            class="w-full text-[#333333] text-base border-[1px] border-[#333333] rounded-md px-3 py-2"
                                            type="text" name="inputAddBrandName" placeholder="Tên brand" required>
                                        <input
                                            class="w-full text-[#333333] text-base border-[1px] border-[#333333] rounded-md px-3 py-2"
                                            type="text" name="inputAddBrandLocation" placeholder="Quốc gia" required>
                                        <input
                                            class="w-full text-[#333333] text-base border-[1px] border-[#333333] rounded-md px-3 py-2"
                                            type="text" name="inputAddBrandDesc" placeholder="Mô tả" required>
                                        <div class="flex">
                                            <input type="file" name="fileImgBrand" id="fileImgBrand" required>
                                            <img src="" alt="" id="imageBrand" width="200" height="200">
                                        </div>
                                        <input
                                            class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-10 py-4 rounded-md drop-shadow-md transition-all duration-700 hover:-translate-y-1 hover:bg-gradient-to-l"
                                            type="submit" value="Thêm brand" name="submitAddBrand">
                                    </div>
                                </form>
                            </div>
                            <button
                                class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-10 py-4 rounded-md drop-shadow-md transition-all duration-700 hover:-translate-y-1 hover:bg-gradient-to-l"
                                name="addType" id="addType">
                                Thêm loại quần áo
                            </button>
                            <div id="modalType" class="modalType">
                                <!-- Modal content -->
                                <form action="insert_clothes_type.php" method="post">
                                    <div class="modal-content">
                                        <p>Loại quần áo</p>
                                        <input
                                            class="w-full text-[#333333] text-base border-[1px] border-[#333333] rounded-md px-3 py-2"
                                            type="text" name="inputAddType" required>
                                        <input
                                            class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-10 py-4 rounded-md drop-shadow-md transition-all duration-700 hover:-translate-y-1 hover:bg-gradient-to-l"
                                            type="submit" value="Thêm loại quần áo" name="submitAddType">
                                    </div>
                                </form>
                            </div>
                            <form action="insert_product.php" method="post" enctype="multipart/form-data">
                                <h2 class="text-[20px] text-blue-400 text-center mb-6">
                                    Thông tin sản phẩm
                                </h2>
                                <!-- Thông tin -->
                                <div class="flex justify-between mb-20">
                                    <div class="w-[60%] grid grid-rows-6 gap-y-4 mb-6">
                                        <div>
                                            <p class="text-[#4285F4] text-[12px] ml-2">Tên sản phẩm</p>
                                            <input
                                                class="w-full text-[#333333] text-base border-[1px] border-[#333333] rounded-md px-3 py-2"
                                                type="text" name="productName" required>
                                        </div>
                                        <div>
                                            <p class="text-[#4285F4] text-[12px] ml-2">Chất liệu</p>
                                            <input
                                                class="w-full text-[#333333] text-base border-[1px] border-[#333333] rounded-md px-3 py-2"
                                                type="text" name="material" required>
                                        </div>
                                        <div>
                                            <p class="text-[#4285F4] text-[12px] ml-2">Xuất sứ</p>
                                            <input
                                                class="w-full text-[#333333] text-base border-[1px] border-[#333333] rounded-md px-3 py-2"
                                                type="text" name="location" required>
                                        </div>
                                        <div>
                                            <p class="text-[#4285F4] text-[12px] ml-2">Mô tả</p>
                                            <input
                                                class="w-full text-[#333333] text-base border-[1px] border-[#333333] rounded-md px-3 py-2"
                                                type="text" name="description" required>
                                        </div>
                                        <div>
                                            <p class="text-[#4285F4] text-[12px] ml-2">Giá bán</p>
                                            <input
                                                class="w-full text-[#333333] text-base border-[1px] border-[#333333] rounded-md px-3 py-2"
                                                type="number" min="1000" name="price" required>
                                        </div>
                                        <div>
                                            <p class="text-[#4285F4] text-[12px] ml-2">Giá nhập</p>
                                            <input
                                                class="w-full text-[#333333] text-base border-[1px] border-[#333333] rounded-md px-3 py-2"
                                                type="number" min="1000" name="cost" required>
                                        </div>
                                        <div>
                                            <p class="text-[#4285F4] text-[12px] ml-2">Brand</p>
                                            <select
                                                class="w-full text-[#333333] text-base border-[1px] border-[#333333] rounded-md px-3 py-2"
                                                name="brand">
                                                '.$brands.'
                                            </select>
                                        </div>
                                        <div>
                                            <p class="text-[#4285F4] text-[12px] ml-2">Loại</p>
                                            <select
                                                class="w-full text-[#333333] text-base border-[1px] border-[#333333] rounded-md px-3 py-2"
                                                name="type">
                                                '.$types.'
                                            </select>
                                        </div>
                                        <div>
                                            <p class="text-[#4285F4] text-[12px] ml-2">Tỉ lệ giảm giá (%)</p>
                                            <input
                                                class="w-full text-[#333333] text-base border-[1px] border-[#333333] rounded-md px-3 py-2"
                                                type="number" min="0" max="100" name="discount" required>
                                        </div>
                                    </div>
                                    <div class="w-[20%] pt-[18px]">
                                        <div class="flex items-center mb-[34px]">
                                            <div class="w-10 mr-4">
                                                <label class="text-[#4285F4]" for="size_s">S</label>
                                            </div>
                                            <input
                                                class="w-40 text-[#333333] text-base border-[1px] border-[#333333] rounded-md px-3 py-2"
                                                type="number" min="0" max="1000" id="size_s" name="size_s"
                                                placeholder="Số lượng" required>
                                        </div>
                                        <div class="flex items-center mb-[34px]">
                                            <div class="w-10 mr-4">
                                                <label class="text-[#4285F4]" for="size_m">M</label>
                                            </div>
                                            <input
                                                class="w-40 text-[#333333] text-base border-[1px] border-[#333333] rounded-md px-3 py-2"
                                                type="number" min="0" max="1000" id="size_m" name="size_m"
                                                placeholder="Số lượng" required>
                                        </div>
                                        <div class="flex items-center mb-[34px]">
                                            <div class="w-10 mr-4">
                                                <label class="text-[#4285F4]" for="size_l">L</label>
                                            </div>
                                            <input
                                                class="w-40 text-[#333333] text-base border-[1px] border-[#333333] rounded-md px-3 py-2"
                                                type="number" min="0" max="1000" id="size_l" name="size_l"
                                                placeholder="Số lượng" required>
                                        </div>
                                        <div class="flex items-center">
                                            <div class="w-10 mr-4">
                                                <label class="text-[#4285F4]" for="size_xl">XL</label>
                                            </div>
                                            <input
                                                class="w-40 text-[#333333] text-base border-[1px] border-[#333333] rounded-md px-3 py-2"
                                                type="number" min="0" max="1000" id="size_xl" name="size_xl"
                                                placeholder="Số lượng" required>
                                        </div>
    
                                    </div>
                                </div>
                                <!-- Chọn ảnh -->
                                <div class="mb-6">
                                    <h2 class="text-[20px] text-[#E51B23] text-center mb-10">
                                        Chọn ảnh
                                    </h2>
                                    <!-- image-1 -->
                                    <div class="flex justify-between mb-6">
                                        <div class="flex">
                                            <input type="file" name="fileToUpload1" id="fileToUpload1" required>
                                            <img src="" alt="image-1" id="image1" width="200" height="200">
                                        </div>
                                        <!-- image-2 -->
                                        <div class="flex">
                                            <input type="file" name="fileToUpload2" id="fileToUpload2" required>
                                            <img src="" alt="image-2" id="image2" width="200" height="200">
                                        </div>
                                    </div>
                                    <!-- image-3 -->
                                    <div class="flex justify-center">
                                        <input type="file" name="fileToUpload3" id="fileToUpload3" required>
                                        <img src="" alt="image-3" id="image3" width="200" height="200">
                                    </div>
                                </div>
                                <!-- button -->
                                <div class="flex justify-center">
                                    <input
                                        class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-10 py-4 rounded-md drop-shadow-md transition-all duration-700 hover:-translate-y-1 hover:bg-gradient-to-l"
                                        type="submit" value="Thêm sản phẩm" name="submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
            </div>
        </div>
    </body>
    
    </html>
    <script src="insert_product.js"></script>';
    echo $product_info_page;
?>