-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 04, 2023 lúc 03:08 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `toy_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `date_birth` varchar(255) NOT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `create_date` varchar(255) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `firstname`, `lastname`, `gender`, `date_birth`, `place_of_birth`, `create_date`, `permission_id`, `status`) VALUES
(2, 'ABC', 'e10adc3949ba59abbe56e057f20f883e', 'abc', 'cbd', 'Nam', '18/02/2023', 'TPHCM', '15/03/2023', 1, 1),
(3, 'BBC', 'e10adc3949ba59abbe56e057f20f883e', 'ABC', 'BCD', 'Nữ', '22/03/2023', 'Hà Nội', '15/03/2023', 3, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account_function`
--

CREATE TABLE `account_function` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `account_function`
--

INSERT INTO `account_function` (`id`, `name`) VALUES
(1, 'Quản lý khách hàng'),
(2, 'Quản lý nhân viên'),
(3, 'Quản lý sản phẩm'),
(4, 'Quản lý hóa đơn');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Đồ chơi mô hình'),
(2, 'Đồ chơi Marvel');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer_favorite_product`
--

CREATE TABLE `customer_favorite_product` (
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detail_enter_product`
--

CREATE TABLE `detail_enter_product` (
  `enter_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detail_orders`
--

CREATE TABLE `detail_orders` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detail_permission_function`
--

CREATE TABLE `detail_permission_function` (
  `permission_id` int(11) NOT NULL,
  `function_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `detail_permission_function`
--

INSERT INTO `detail_permission_function` (`permission_id`, `function_id`, `action`) VALUES
(1, 1, 'Thêm'),
(1, 1, 'Sửa'),
(1, 2, 'Thêm'),
(1, 1, 'Xóa'),
(3, 2, 'Thêm'),
(3, 2, 'Sửa'),
(3, 2, 'Xóa'),
(1, 2, 'Sửa'),
(1, 2, 'Xóa'),
(1, 3, 'Thêm'),
(1, 3, 'Sửa'),
(1, 3, 'Xóa'),
(1, 4, 'Thêm'),
(1, 4, 'Sửa'),
(1, 4, 'Xóa'),
(2, 4, 'Thêm'),
(2, 4, 'Sửa'),
(2, 4, 'Xóa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `enter_product`
--

CREATE TABLE `enter_product` (
  `id` int(11) NOT NULL,
  `enter_date` varchar(255) NOT NULL,
  `total_quantity` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `create_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `enter_product`
--

INSERT INTO `enter_product` (`id`, `enter_date`, `total_quantity`, `total_price`, `provider_id`, `user_id`, `status`, `create_date`) VALUES
(1, '03/04/2023', 60, 3000, 1, 2, 'Đã giao', '03/04/2023'),
(2, '02/04/2023', 50, 3000, 2, 2, 'Đang giao', '02/04/2023');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `total_price` int(11) NOT NULL,
  `pay_method` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `quantity`, `date`, `total_price`, `pay_method`, `status`) VALUES
(1, 2, 30, '02/04/2023', 3500, 'cash', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `permission`
--

INSERT INTO `permission` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Quản lý'),
(3, 'Nhân viên'),
(4, 'Khách hàng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `create_date` varchar(255) NOT NULL,
  `highlight` tinyint(1) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `review` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `image`, `price`, `description`, `create_date`, `highlight`, `category_id`, `sale_id`, `review`, `quantity`) VALUES
(1, 'Product 1', '31491ae01b.png', '2000', 'Sản phẩm mới', '01/04/2023', 0, 2, 1, 3, 30),
(2, 'Product 2', 'ef314b1615.png', '3500', 'Sản phẩm mới', '01/04/2023', 0, 1, 2, 0, 20),
(3, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '01/04/2023', 0, 1, 2, 0, 20),
(4, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(5, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(6, 'Product 1', '31491ae01b.png', '2000', 'Sản phẩm mới', '01/04/2023', 0, 2, 1, 3, 30),
(7, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(8, 'Product 1', '31491ae01b.png', '2000', 'Sản phẩm mới', '01/04/2023', 0, 2, 1, 3, 30),
(9, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(11, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(12, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(13, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(14, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(15, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(16, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(17, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(18, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(19, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(20, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(21, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(22, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(23, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(24, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(25, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(26, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(27, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(28, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(29, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(30, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(31, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(32, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(33, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(34, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(35, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(36, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(37, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(38, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(39, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30),
(40, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `provider`
--

CREATE TABLE `provider` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `provider`
--

INSERT INTO `provider` (`id`, `name`) VALUES
(1, 'Đồ Chơi Hòa Phú - Công Ty TNHH Đồ Chơi Hòa Phú'),
(2, 'Đồ Chơi Bến Tre - Công Ty TNHH MTV Thương Mại Dịch Vụ Khánh Kỳ BT'),
(3, 'Đồ Chơi Mỹ Hải - Công Ty TNHH Thương Mại Mỹ Hải');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `create_date` varchar(255) NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL,
  `percent_sale` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `sale`
--

INSERT INTO `sale` (`id`, `name`, `create_date`, `start_date`, `end_date`, `percent_sale`, `status`) VALUES
(1, 'Không áp dụng', '02/04/2023', '08/03/2023', '20/03/2023', 0, 1),
(2, 'Khuyến mãi', '22/03/2023', '22/03/2023', '25/03/2023', 25, 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_permission` (`permission_id`);

--
-- Chỉ mục cho bảng `account_function`
--
ALTER TABLE `account_function`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customer_favorite_product`
--
ALTER TABLE `customer_favorite_product`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_favorite_product_ibfk_1` (`user_id`);

--
-- Chỉ mục cho bảng `detail_enter_product`
--
ALTER TABLE `detail_enter_product`
  ADD KEY `enter_id` (`enter_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `detail_orders`
--
ALTER TABLE `detail_orders`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `detail_permission_function`
--
ALTER TABLE `detail_permission_function`
  ADD KEY `id_permission` (`permission_id`),
  ADD KEY `id_function` (`function_id`) USING BTREE;

--
-- Chỉ mục cho bảng `enter_product`
--
ALTER TABLE `enter_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provider_id` (`provider_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_ibfk_1` (`user_id`);

--
-- Chỉ mục cho bảng `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `sale_id` (`sale_id`);

--
-- Chỉ mục cho bảng `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `account_function`
--
ALTER TABLE `account_function`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `enter_product`
--
ALTER TABLE `enter_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `provider`
--
ALTER TABLE `provider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id`);

--
-- Các ràng buộc cho bảng `customer_favorite_product`
--
ALTER TABLE `customer_favorite_product`
  ADD CONSTRAINT `customer_favorite_product_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `customer_favorite_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `detail_enter_product`
--
ALTER TABLE `detail_enter_product`
  ADD CONSTRAINT `detail_enter_product_ibfk_1` FOREIGN KEY (`enter_id`) REFERENCES `enter_product` (`id`),
  ADD CONSTRAINT `detail_enter_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `detail_orders`
--
ALTER TABLE `detail_orders`
  ADD CONSTRAINT `detail_orders_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `detail_orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `detail_permission_function`
--
ALTER TABLE `detail_permission_function`
  ADD CONSTRAINT `detail_permission_function_ibfk_1` FOREIGN KEY (`function_id`) REFERENCES `account_function` (`id`),
  ADD CONSTRAINT `detail_permission_function_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id`);

--
-- Các ràng buộc cho bảng `enter_product`
--
ALTER TABLE `enter_product`
  ADD CONSTRAINT `enter_product_ibfk_1` FOREIGN KEY (`provider_id`) REFERENCES `provider` (`id`),
  ADD CONSTRAINT `enter_product_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
