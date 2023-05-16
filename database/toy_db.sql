-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 16, 2023 lúc 12:11 PM
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
  `date_birth` date NOT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `create_date` date NOT NULL,
  `permission_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `firstname`, `lastname`, `gender`, `date_birth`, `place_of_birth`, `create_date`, `permission_id`, `status`, `is_deleted`) VALUES
(1, 'huyluong', 'e10adc3949ba59abbe56e057f20f883e', 'Huy', 'Lương', 'Nam', '2002-05-16', 'TPHCM', '2023-05-16', 1, 1, 0),
(3, 'dieukiet', 'e10adc3949ba59abbe56e057f20f883e', 'kiet', 'luong', 'Nam', '2002-05-16', 'vietnam', '2023-05-16', 1, 0, 0),
(4, 'lucdaccau', 'e10adc3949ba59abbe56e057f20f883e', 'luc', 'nguyen', 'Nữ', '2002-05-16', 'vietnam', '2023-05-16', 2, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `is_deleted`) VALUES
(1, 'Đồ chơi mô hình', 0),
(2, 'Đồ chơi lắp ráp', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rate` tinyint(5) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`id`, `content`, `user_id`, `product_id`, `rate`, `time`) VALUES
(1, 'loz', 1, 1, 5, '2023-05-16 17:08:17'),
(2, 'nhu cac', 1, 1, 3, '2023-05-15 17:08:25');

--
-- Bẫy `comment`
--
DELIMITER $$
CREATE TRIGGER `trigger_tinh_diem_danh_gia_san_pham` AFTER INSERT ON `comment` FOR EACH ROW BEGIN
    DECLARE tong_danh_gia INT;
    DECLARE so_luong_danh_gia INT;
    DECLARE diem_danh_gia FLOAT;

    -- Lấy tổng điểm đánh giá và số lượng đánh giá từ bảng comment
    SELECT SUM(rate), COUNT(*) INTO tong_danh_gia, so_luong_danh_gia FROM comment WHERE product_id = NEW.product_id;

    -- Tính điểm đánh giá từ tổng điểm và số lượng đánh giá
    IF so_luong_danh_gia > 0 THEN
        SET diem_danh_gia = tong_danh_gia / so_luong_danh_gia;
    ELSE
        SET diem_danh_gia = 0;
    END IF;

    -- Cập nhật điểm đánh giá của sản phẩm
    UPDATE product SET review = diem_danh_gia WHERE id = NEW.product_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detail_enter_product`
--

CREATE TABLE `detail_enter_product` (
  `id` int(11) NOT NULL,
  `enter_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `detail_enter_product`
--

INSERT INTO `detail_enter_product` (`id`, `enter_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 1, 10, 3000);

--
-- Bẫy `detail_enter_product`
--
DELIMITER $$
CREATE TRIGGER `update_product_quantity_enter_product` AFTER INSERT ON `detail_enter_product` FOR EACH ROW BEGIN
  UPDATE product SET quantity = quantity + NEW.quantity WHERE id = NEW.product_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_product_quantity_enter_product_after_delete` AFTER DELETE ON `detail_enter_product` FOR EACH ROW BEGIN
    UPDATE product SET quantity = quantity - OLD.quantity WHERE id = OLD.product_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_product_quantity_enter_product_after_update` AFTER UPDATE ON `detail_enter_product` FOR EACH ROW BEGIN
  UPDATE product SET quantity = quantity - OLD.quantity + NEW.quantity WHERE id = NEW.product_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detail_orders`
--

CREATE TABLE `detail_orders` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `detail_orders`
--

INSERT INTO `detail_orders` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 1, 1, 3000),
(2, 2, 3, 1, 2125),
(3, 3, 6, 1, 2500),
(4, 3, 8, 1, 2500);

--
-- Bẫy `detail_orders`
--
DELIMITER $$
CREATE TRIGGER `update_product_quantity_after_delete` AFTER DELETE ON `detail_orders` FOR EACH ROW BEGIN
    UPDATE product SET quantity = quantity + OLD.quantity WHERE id = OLD.product_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_product_quantity_after_insert` AFTER INSERT ON `detail_orders` FOR EACH ROW BEGIN
  UPDATE product SET quantity = quantity - NEW.quantity WHERE id = NEW.product_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_product_quantity_after_update` AFTER UPDATE ON `detail_orders` FOR EACH ROW BEGIN
  UPDATE product SET quantity = quantity + OLD.quantity - NEW.quantity WHERE id = NEW.product_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `enter_product`
--

CREATE TABLE `enter_product` (
  `id` int(11) NOT NULL,
  `enter_date` date NOT NULL,
  `total_quantity` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `create_date` date NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `enter_product`
--

INSERT INTO `enter_product` (`id`, `enter_date`, `total_quantity`, `total_price`, `provider_id`, `user_id`, `status`, `create_date`, `is_deleted`) VALUES
(1, '2023-05-17', 15, 3000, 2, 1, 1, '2023-05-16', 0),
(2, '2023-06-20', 12, 2000, 1, 1, 0, '2023-05-16', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `country` text NOT NULL,
  `vat` int(11) NOT NULL,
  `ship_method` text NOT NULL,
  `total_price` int(11) NOT NULL,
  `pay_method` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `quantity`, `date`, `address`, `phone`, `email`, `country`, `vat`, `ship_method`, `total_price`, `pay_method`, `status`, `is_deleted`) VALUES
(1, 1, 1, '2023-05-09 17:08:37', 'Ngô Quyền', '0764286798', 'chum19923@gmail.com', 'VietNam', 300, 'Standard Shipping ($6)', 3306, 'payment in cash', 2, 0),
(2, 1, 1, '2023-05-10 17:08:51', 'àasfsafasfsafsa', '0909090909', 'dieukiet1479@gmail.com', 'VietNam', 213, 'Overnight Shipping ($12)', 2350, 'payment in cash', 2, 0),
(3, 1, 2, '2023-05-10 17:09:02', 'ngo quyen 2', '0901323123', 'asfhfd@gmail.com', 'VietNam', 500, 'Express Shipping ($8)', 5508, 'payment in cash', 2, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `permission`
--

INSERT INTO `permission` (`id`, `name`, `is_deleted`) VALUES
(1, 'Admin', 0),
(2, 'Khách hàng', 0),
(3, 'Quản lý ', 0),
(4, 'Nhân viên', 0);

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
  `create_date` date NOT NULL,
  `highlight` tinyint(1) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `review` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `image`, `price`, `description`, `create_date`, `highlight`, `category_id`, `sale_id`, `review`, `quantity`, `is_deleted`) VALUES
(1, 'Mô hình Captain dòng Mech Strike 6 inch', 'home-img-1.png', '3000', 'Sản phẩm mới', '2023-05-16', 1, 1, 1, 4, 29, 1),
(2, 'Mô hình Iron Man dòng Mech Strike tối thượng giáp 8 inch', '967f68e964.png', '2500', '<p><strong>Sản phẩm mới</strong></p>', '2023-05-16', 1, 1, 1, 0, 30, 1),
(3, 'Mô hình Hulk dòng Mech Strike 6 inch', '53fe90a5a8.png', '2500', '<p>Sản phẩm mới</p>', '2023-05-16', 1, 1, 2, 0, 9, 0),
(4, 'Vũ khí chiến đấu siêu sức mạnh Spiderman', '2f45633d26.png', '5500', 'Giới thiệu sản phẩm: Đồ chơi Vũ khí chiến đấu siêu suc manh Spiderman 1 Găng tay Spider-man 3 Mô hình nòng phi tiêu Neft 1 Hướng dẫn sử dụng', '2023-05-15', 1, 2, 1, 0, 3500, 0),
(5, 'Người Dơi Batman 4inch', '1cfb0656b7.png', '2500', '<p>Sản phẩm mới</p>', '2023-05-15', 0, 1, 2, 0, 2500, 1),
(6, 'MH anh hùng công lý 4 inch', '6e79b7601e.png', '2500', '<p>Sản phẩm mới</p>', '2023-05-09', 0, 2, 1, 0, 49, 0),
(7, 'Siêu anh hùng Captain America tối tân 30cm', '01fa875229.png', '2500', '<p>Sản phẩm mới</p>', '2023-05-04', 0, 2, 2, 0, 20, 0),
(8, 'Siêu anh hùng IRON MAN phiên bản Bend and Flex', '33f9818354.png', '2500', '<p>Sản phẩm mới</p>', '2023-05-09', 0, 2, 1, 0, 19, 0),
(9, 'Mô hình Thanos quyền năng', '61421926a7.png', '2500', '<p>Sản phẩm mới</p>', '2023-05-09', 0, 1, 2, 0, 10, 1),
(10, 'Mô hình Hulk dũng mãnh', '61fe1a2c2b.png', '2500', '<p>Sản phẩm mới</p>', '2023-05-04', 0, 2, 1, 0, 30, 0),
(11, 'Mô hình siêu anh hùng Spiderman 30cm', 'e1f6dc76fe.png', '2500', '<p>Sản phẩm mới</p>', '2023-05-12', 0, 1, 1, 0, 20, 0),
(13, 'Mô hình Venom Flex and Bend', '1303e24c74.png', '2500', '<p>&lt;p&gt;Sản phẩm mới&lt;/p&gt;</p>', '2023-05-10', 1, 1, 1, 0, 50, 0),
(14, 'Figure superman tối thượng size 30 inch', '6243bc2a5a.png', '2000', '<p>Sản phẩm mới</p>', '2023-05-10', 0, 1, 1, 0, 12, 0),
(15, 'Figure anh hùng đại bàng size 30 inch', '6da2a5f4f2.png', '1500', '<p>sản phẩm mới</p>', '2023-05-11', 0, 1, 2, 0, 30, 0),
(16, 'Figure iron man siêu to khổng lồ size 30 inch', '57b5f35d05.png', '3000', '<p><strong>Sản phẩm limited</strong></p>', '2023-05-11', 0, 1, 1, 0, 2, 0),
(17, 'Figure anh hùng xạ điêu size 30 inch', 'e64461ebbf.png', '1800', '<p>sản phẩm tồn kho</p>', '2023-05-10', 0, 2, 2, 0, 34, 0),
(18, 'Figure phù thủy cầu đặc tối thượng size 20 inch', '7a492fd185.png', '1900', '<p>H&agrave;ng si&ecirc;u tồn kho</p>', '2023-05-19', 0, 1, 2, 0, 123, 0),
(19, 'Figure Lý Tiểu Long bản lỗi size 10 inch', '170fbd1479.png', '2000', '<p>Sản phẩm cũng được</p>', '2023-05-12', 0, 1, 1, 0, 9, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `provider`
--

CREATE TABLE `provider` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `provider`
--

INSERT INTO `provider` (`id`, `name`, `is_deleted`) VALUES
(1, 'Đồ chơi Mỹ Hải', 0),
(2, 'Đồ chơi Nam Long', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `create_date` date NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `percent_sale` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `sale`
--

INSERT INTO `sale` (`id`, `name`, `create_date`, `start_date`, `end_date`, `percent_sale`, `status`, `is_deleted`) VALUES
(1, 'Không áp dụng', '2023-05-16', '2023-05-16', '2023-05-19', 0, 1, 0),
(2, 'Khuyến mãi 1', '2023-05-16', '2023-05-13', '2023-06-13', 15, 1, 0),
(5, 'Khuyến mãi đặc biệt', '2023-05-16', '2023-08-20', '2023-08-30', 50, 1, 0);

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
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `detail_enter_product`
--
ALTER TABLE `detail_enter_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enter_id` (`enter_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `detail_orders`
--
ALTER TABLE `detail_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

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
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `detail_enter_product`
--
ALTER TABLE `detail_enter_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `detail_orders`
--
ALTER TABLE `detail_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `enter_product`
--
ALTER TABLE `enter_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `provider`
--
ALTER TABLE `provider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id`);

--
-- Các ràng buộc cho bảng `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`);

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
