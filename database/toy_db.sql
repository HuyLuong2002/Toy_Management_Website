-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 09, 2023 lúc 09:28 AM
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
  `status` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `firstname`, `lastname`, `gender`, `date_birth`, `place_of_birth`, `create_date`, `permission_id`, `status`, `is_deleted`) VALUES
(2, 'ABC', 'e10adc3949ba59abbe56e057f20f883e', 'abc', 'cbd', 'Nam', '18/02/2023', 'TPHCM', '15/03/2023', 1, 1, 0),
(3, 'BBC', 'e10adc3949ba59abbe56e057f20f883e', 'ABC', 'BCD', 'Nữ', '22/03/2023', 'Hà Nội', '15/03/2023', 3, 1, 0),
(6, 'BBC1', 'e10adc3949ba59abbe56e057f20f883e', 'ABC', 'BCD', 'Nam', '25/02/2003', 'Bắc Ninh', '24/04/2023', 4, 1, 0),
(13, 'hahahihi', 'e10adc3949ba59abbe56e057f20f883e', 'DHG', 'DHG', 'Nam', '25/02/2002', 'Bắc Ninh', '24/04/2023', 4, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account_function`
--

CREATE TABLE `account_function` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `account_function`
--

INSERT INTO `account_function` (`id`, `name`, `is_deleted`) VALUES
(1, 'Quản lý khách hàng', 0),
(2, 'Quản lý nhân viên', 0),
(3, 'Quản lý sản phẩm', 0),
(4, 'Quản lý hóa đơn', 0),
(6, 'Quản lý thể loại', 1);

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
(2, 'Đồ chơi Marvel', 0),
(7, 'Đồ chơi búp bê', 0),
(8, '@', 1);

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
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`id`, `content`, `user_id`, `product_id`, `rate`, `time`) VALUES
(38, 'cc', 6, 6, 3, '09/05/2023 10:10:11 am'),
(39, 'cc', 6, 6, 2, '09/05/2023 10:10:16 am'),
(40, 'cc', 6, 6, 5, '09/05/2023 10:10:36 am'),
(41, 'cc', 6, 6, 1, '09/05/2023 10:11:39 am'),
(42, 'cc', 6, 6, 1, '09/05/2023 10:11:43 am');

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
(1, 1, 44, 25, 3500),
(4, 1, 43, 10, 3000),
(7, 15, 6, 30, 3000);

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
(10, 8, 7, 1, 2250),
(11, 8, 13, 1, 3000),
(12, 8, 14, 1, 3000),
(13, 12, 13, 1, 3000),
(14, 12, 7, 1, 2250),
(15, 13, 7, 1, 2250),
(16, 13, 13, 1, 3000),
(17, 14, 8, 2, 2000),
(18, 14, 6, 1, 2000),
(20, 14, 6, 2, 3000),
(21, 15, 48, 2, 2250),
(22, 15, 1, 1, 2000),
(23, 15, 6, 1, 2000),
(24, 16, 48, 2, 2250),
(25, 16, 1, 1, 2000),
(26, 16, 6, 1, 2000),
(27, 17, 48, 2, 2250),
(28, 17, 1, 1, 2000),
(29, 17, 6, 1, 2000),
(30, 18, 48, 2, 2250),
(31, 18, 1, 1, 2000),
(32, 18, 6, 1, 2000),
(33, 19, 48, 2, 2250),
(34, 19, 1, 1, 2000),
(35, 19, 6, 1, 2000);

--
-- Bẫy `detail_orders`
--
DELIMITER $$
CREATE TRIGGER `update_product_quantity` AFTER INSERT ON `detail_orders` FOR EACH ROW BEGIN
  UPDATE product SET quantity = quantity - NEW.quantity WHERE id = NEW.product_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_product_quantity_after_delete` AFTER DELETE ON `detail_orders` FOR EACH ROW BEGIN
    UPDATE product SET quantity = quantity + OLD.quantity WHERE id = OLD.product_id;
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
-- Cấu trúc bảng cho bảng `detail_permission_function`
--

CREATE TABLE `detail_permission_function` (
  `id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `function_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `detail_permission_function`
--

INSERT INTO `detail_permission_function` (`id`, `permission_id`, `function_id`, `action`) VALUES
(1, 1, 1, 'Thêm'),
(2, 1, 1, 'Sửa'),
(3, 1, 2, 'Thêm'),
(4, 1, 1, 'Thêm'),
(5, 3, 2, 'Thêm'),
(6, 3, 2, 'Sửa'),
(7, 3, 2, 'Xóa'),
(8, 1, 2, 'Sửa'),
(9, 1, 2, 'Xóa'),
(10, 1, 3, 'Thêm'),
(11, 1, 3, 'Sửa'),
(19, 2, 1, 'Thêm');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detail_review`
--

CREATE TABLE `detail_review` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `star` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `status` tinyint(1) NOT NULL,
  `create_date` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `enter_product`
--

INSERT INTO `enter_product` (`id`, `enter_date`, `total_quantity`, `total_price`, `provider_id`, `user_id`, `status`, `create_date`, `is_deleted`) VALUES
(1, '19/04/2023', 65, 3500, 3, 2, 1, '17/04/2023', 0),
(2, '02/04/2023', 50, 3000, 2, 2, 0, '02/04/2023', 1),
(15, '17/04/2023', 30, 25000, 2, 2, 1, '17/04/2023', 1),
(16, '19/04/2023', 30, 25000, 5, 2, 0, '17/04/2023', 1),
(17, '17/04/2023', 30, 25000, 3, 2, 1, '17/04/2023', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
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
(8, 6, 3, '14/04/2023', '', '', '', '', 0, '', 8250, 'cash', 1, 0),
(9, 6, 3, '14/08/2023', '', '', '', '', 0, '', 3000, 'cash', 0, 0),
(10, 6, 3, '14/01/2023', '', '', '', '', 0, '', 8250, 'cash', 0, 0),
(11, 6, 3, '14/11/2023', '', '', '', '', 0, '', 15000, 'cash', 0, 0),
(12, 6, 2, '19/04/2023', '', '', '', '', 0, '', 5250, 'cash', 0, 0),
(13, 6, 2, '19/04/2022', '', '', '', '', 0, '', 5250, 'cash', 1, 0),
(14, 2, 3, '07/05/2023', '', '', '', '', 0, '', 6000, 'cash', 0, 0),
(15, 6, 3, '08/05/2023 17:17:52 pm', 'Ngô Quyền', '0764286798', 'chum19923@gmail.com', 'VietNam', 0, '', 0, 'payment in cash', 2, 0),
(16, 6, 3, '08/05/2023 17:20:36 pm', 'Ngô Quyền', '0764286798', 'chum19923@gmail.com', 'VietNam', 0, '', 0, 'payment in cash', 2, 0),
(17, 6, 3, '08/05/2023 17:22:11 pm', 'Ngô Quyền', '0764286798', 'chum19923@gmail.com', 'VietNam', 0, '', 0, 'payment in cash', 2, 0),
(18, 6, 3, '08/05/2023 17:23:12 pm', 'Ngô Quyền', '0764286798', 'chum19923@gmail.com', 'VietNam', 0, '', 0, 'payment in cash', 2, 0),
(19, 6, 3, '08/05/2023 17:38:50 pm', 'cc', '0764286798', 'chum19923@gmail.com', 'VietNam', 0, '', 8940, 'payment in cash', 2, 0);

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
(2, 'Quản lý', 0),
(3, 'Nhân viên', 0),
(4, 'Khách hàng', 0),
(6, 'Quản lý nhân sự', 1),
(16, 'Quản lý phòng ban', 0);

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
  `quantity` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `image`, `price`, `description`, `create_date`, `highlight`, `category_id`, `sale_id`, `review`, `quantity`, `is_deleted`) VALUES
(1, 'Product 1', '31491ae01b.png', '2000', 'Sản phẩm mới', '01/04/2023', 1, 2, 1, 3, 25, 0),
(2, 'Product 2', 'ef314b1615.png', '3500', 'Sản phẩm mới', '01/04/2023', 0, 1, 2, 0, 20, 0),
(3, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '01/04/2023', 0, 1, 2, 0, 30, 0),
(6, 'Product 1', '31491ae01b.png', '2000', 'Sản phẩm mới', '01/04/2023', 0, 2, 1, 2, 33, 0),
(7, 'Product 3', '662359cdaf.png', '3000', 'Sản phẩm mới 3', '11/04/2023', 1, 1, 2, 5, 30, 0),
(8, 'Product 1', '31491ae01b.png', '2000', 'Sản phẩm mới', '01/04/2023', 0, 2, 1, 3, 30, 0),
(13, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 1, 1, 1, 5, 30, 0),
(14, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 0),
(15, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 0),
(16, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 0),
(17, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 0),
(18, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 0),
(19, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 0),
(20, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 0),
(21, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 0),
(22, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 0),
(23, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 0),
(24, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 0),
(25, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 0),
(26, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 0),
(27, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 0),
(28, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 0),
(29, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 1),
(30, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 0),
(31, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 0),
(32, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 0),
(33, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 0),
(34, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 0),
(35, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 0),
(36, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 0),
(37, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 0),
(38, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 0),
(39, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 0),
(40, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 1),
(41, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 0),
(42, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 0),
(43, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 0),
(44, 'Product 3', 'ef314b1615.png', '3000', 'Sản phẩm mới', '02/04/2023', 0, 1, 1, 5, 30, 0),
(46, 'Product 6', '2c19f85c9d.png', '3000', 'Sản phẩm mới', '09/04/2023', 1, 1, 2, 0, 35, 1),
(47, 'Product 6', 'f5c04df7ab.png', '3500', 'Sản phẩm mới 2', '14/04/2023', 1, 1, 2, 0, 35, 0),
(48, 'Product 15', 'f8b503a187.png', '3000', '<p><strong>Sản phẩm mới</strong></p>', '07/05/2023', 0, 2, 2, 0, 15, 0);

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
(1, 'Đồ Chơi Hòa Phú - Công Ty TNHH Đồ Chơi Hòa Phú', 0),
(2, 'Đồ Chơi Bến Tre - Công Ty TNHH MTV Thương Mại Dịch Vụ Khánh Kỳ BT', 0),
(3, 'Đồ Chơi Mỹ Hải - Công Ty TNHH Thương Mại Mỹ Hải', 0),
(5, 'Đồ chơi MyKingDom', 1),
(7, 'Đồ chơi - Mỹ công', 1);

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
  `status` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `sale`
--

INSERT INTO `sale` (`id`, `name`, `create_date`, `start_date`, `end_date`, `percent_sale`, `status`, `is_deleted`) VALUES
(1, 'Không áp dụng', '08/05/2023', '08/03/2023', '20/03/2023', 0, 1, 0),
(2, 'Khuyến mãi', '22/03/2023', '22/03/2023', '25/03/2023', 25, 1, 0),
(5, 'Khuyến mãi 1', '24/04/2023', '22/04/2023', '28/04/2023', 15, 1, 0),
(6, 'Khuyến mãi 1', '24/04/2023', '25/04/2023', '30/04/2023', 30, 1, 0),
(7, 'Khuyến mãi 1', '24/04/2023', '25/04/2023', '26/04/2023', 30, 1, 0),
(8, 'Khuyến mãi 2', '24/04/2023', '25/04/2023', '26/04/2023', 35, 1, 1),
(9, 'Khuyến mãi 2', '24/04/2023', '25/04/2023', '26/04/2023', 35, 1, 1),
(10, 'Khuyến mãi 2', '24/04/2023', '25/04/2002', '26/04/2000', 2, 1, 1),
(11, 'Khuyến mãi 1', '24/04/2023', '25/04/2023', '26/04/2023', 25, 1, 0);

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
-- Chỉ mục cho bảng `detail_permission_function`
--
ALTER TABLE `detail_permission_function`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_permission` (`permission_id`),
  ADD KEY `id_function` (`function_id`) USING BTREE;

--
-- Chỉ mục cho bảng `detail_review`
--
ALTER TABLE `detail_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `account_function`
--
ALTER TABLE `account_function`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `detail_enter_product`
--
ALTER TABLE `detail_enter_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `detail_orders`
--
ALTER TABLE `detail_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `detail_permission_function`
--
ALTER TABLE `detail_permission_function`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `detail_review`
--
ALTER TABLE `detail_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `enter_product`
--
ALTER TABLE `enter_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `provider`
--
ALTER TABLE `provider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- Các ràng buộc cho bảng `detail_permission_function`
--
ALTER TABLE `detail_permission_function`
  ADD CONSTRAINT `detail_permission_function_ibfk_1` FOREIGN KEY (`function_id`) REFERENCES `account_function` (`id`),
  ADD CONSTRAINT `detail_permission_function_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id`);

--
-- Các ràng buộc cho bảng `detail_review`
--
ALTER TABLE `detail_review`
  ADD CONSTRAINT `detail_review_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `detail_review_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`);

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
