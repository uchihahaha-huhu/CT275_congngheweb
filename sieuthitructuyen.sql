-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 13, 2024 lúc 07:06 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `sieuthitructuyen`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `accounts`
--

CREATE TABLE `accounts` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_address` varchar(255) DEFAULT NULL,
  `user_phone` varchar(10) DEFAULT NULL,
  `user_avatar` varchar(255) DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `accounts`
--

INSERT INTO `accounts` (`user_id`, `user_name`, `user_password`, `user_email`, `user_address`, `user_phone`, `user_avatar`, `role`) VALUES
(5, 'Quản trị viên', 'admin', 'admin@gmail.com', 'xuan khanh, can tho', '0999999999', 'egg.png', 1),
(9, 'Khôi', 'khoi', 'khoi@gmail.com', 'địa chỉ', '000099888', 'bg.jpg', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bills`
--

CREATE TABLE `bills` (
  `bill_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `bill_user` varchar(50) NOT NULL,
  `bill_email` varchar(255) NOT NULL,
  `bill_address` varchar(255) NOT NULL,
  `bill_phone` varchar(10) NOT NULL,
  `bill_time` datetime NOT NULL,
  `bill_total` decimal(10,0) NOT NULL DEFAULT 0,
  `bill_paymethod` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1. Thanh toán khi nhận hàng\r\n2. Chuyển khoản ngân hàng\r\n3. Ví điện tử MoMo',
  `bill_status` tinyint(1) DEFAULT 0 COMMENT '0. Đơn mới\r\n1. Đang xử lý\r\n2. Đang giao hàng\r\n3. Đã giao hàng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `bills`
--

INSERT INTO `bills` (`bill_id`, `user_id`, `bill_user`, `bill_email`, `bill_address`, `bill_phone`, `bill_time`, `bill_total`, `bill_paymethod`, `bill_status`) VALUES
(106, 9, 'Khôi', 'khoi@gmail.com', 'địa chỉ', '000099888', '2024-04-13 11:48:55', 170000, 2, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill_details`
--

CREATE TABLE `bill_details` (
  `bill_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `bill_details`
--

INSERT INTO `bill_details` (`bill_id`, `product_id`, `quantity`) VALUES
(106, 45, 3),
(106, 47, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(152, 'Bảng'),
(150, 'Bút'),
(153, 'Máy tính'),
(151, 'Thước');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_text` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `comment_date` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_text`, `user_id`, `product_id`, `comment_date`) VALUES
(51, 'sản phẩm rất tốt', 5, 46, '2024-04-13 11:38:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_price` decimal(10,0) NOT NULL DEFAULT 0,
  `product_image` varchar(255) DEFAULT NULL,
  `product_description` text DEFAULT NULL,
  `product_view` int(11) NOT NULL DEFAULT 0,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_image`, `product_description`, `product_view`, `category_id`) VALUES
(45, 'Bút viết set6 Cute dog puppy nice day - Mix', 40000, 'but1.jpeg', 'Bút viết cute xinh xắn', 0, 150),
(46, 'Bút viết set6 Shinchan and friends runny nose pain', 40000, 'but2.jpeg', 'Bút viết cute xinh xắn', 0, 150),
(47, 'Bút chì kim Cute animal cosplay cartoon characters', 25000, 'but3.jpeg', 'Bút cute xinh xắn', 0, 150),
(48, 'Bút viết Gấu trúc Pandabiz love food - Mix', 15000, 'but5.jpeg', 'Bút gấu trúc cute', 0, 150),
(49, 'Bút viết Colorful fruit big eyes inside xếp chồng ', 25000, 'but4.jpeg', 'Bút Colorful mới nhất ', 0, 150),
(50, 'Máy tính MJ Sanrio family Cinnamoroll Kuromi littl', 60000, 'maytinh1.jpeg', 'Máy tính MJ Sanrio family Cinnamoroll Kuromi little face mới nhất', 0, 153),
(51, 'Máy tính MJ Cute cat fruit strawberry kèm móc leng', 60000, 'maytinh2.jpeg', 'Máy tính MJ Cute cat fruit strawberry kèm móc leng keng - Mix', 0, 153),
(52, 'Máy tính MJ Cute dog yellow bell có tai kèm móc le', 60000, 'maytinh3.jpeg', 'Máy tính MJ Cute dog yellow bell có tai kèm móc leng keng', 0, 153),
(53, 'Máy tính MJ Cute rabbit face lucky rich kèm móc le', 60000, 'maytinh4.jpeg', 'Máy tính MJ Cute rabbit face lucky rich kèm móc leng keng - Mix', 0, 153),
(54, 'Máy tính MJ Cute rabbit in the cup kèm móc leng ke', 60000, 'maytinh5.jpeg', 'Máy tính MJ Cute rabbit in the cup kèm móc leng keng - Mix', 0, 153),
(55, 'Bộ thước kẻ Koomily little friend and fruit 15cm -', 30000, 'thuoc1.jpeg', 'Bộ thước kẻ Koomily little friend and fruit 15cm - Mix\r\n', 0, 151),
(56, 'Bộ thước kẻ Gấu trúc Panda bear study hard 15cm - ', 30000, 'thuoc2.jpeg', 'Bộ thước kẻ Gấu trúc Panda bear study hard 15cm - Mix', 0, 151),
(57, 'Bộ thước kẻ Capybara i love study 15cm - Mix', 30000, 'thuoc3.jpeg', 'Bộ thước kẻ Capybara i love study 15cm - Mix', 0, 151),
(58, 'Bộ thước kẻ Hải ly Loopy smile 15cm - Mix', 30000, 'thuoc4.jpeg', 'Bộ thước kẻ Hải ly Loopy smile 15cm - Mix', 0, 151),
(59, 'Bộ thước kẻ Sanrio family Pochacco food time 15cm ', 30000, 'thuoc5.jpeg', 'Bộ thước kẻ Sanrio family Pochacco food time 15cm - Mix', 0, 151),
(60, 'Bảng học sinh 2 mặt Thiên Long TP-B09/AK', 50000, 'bang1.webp', 'Bảng học sinh 2 mặt Thiên Long TP-B09/AK - Nhân vật Akooland thế giới học cụ thần kỳ', 0, 152);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Chỉ mục cho bảng `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `fk_bill_uid` (`user_id`);

--
-- Chỉ mục cho bảng `bill_details`
--
ALTER TABLE `bill_details`
  ADD KEY `fk_bill_id` (`bill_id`),
  ADD KEY `fk_bill_product` (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `fk_uid_cmt` (`user_id`),
  ADD KEY `fk_pro_cmt` (`product_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `Lk_sanpham_danhmuc` (`category_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `accounts`
--
ALTER TABLE `accounts`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `bills`
--
ALTER TABLE `bills`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `fk_bill_uid` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`user_id`);

--
-- Các ràng buộc cho bảng `bill_details`
--
ALTER TABLE `bill_details`
  ADD CONSTRAINT `fk_bill_id` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`bill_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bill_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_pro_cmt` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `fk_uid_cmt` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`user_id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `Lk_sanpham_danhmuc` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
