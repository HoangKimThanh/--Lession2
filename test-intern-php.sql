-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 10, 2022 lúc 04:35 AM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `test-intern-php`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Ba lô'),
(2, 'Bàn phím'),
(3, 'Chuột'),
(4, 'Headphones'),
(5, 'Lót chuột'),
(6, 'Tai nghe'),
(7, 'Khác');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `categoryId`, `image`) VALUES
(27, 'Balo đựng laptop thời trang CIGU', 1, 'anh-chinh-balo-1657416309'),
(28, 'Bàn phím cơ có led giá rẻ hãng HelloA-H156', 2, 'anh-chinh-helloA-1657416334'),
(29, 'Bàn phím có dây giá rẻ Akna-D410', 2, 'anh-chinh-Akna-1657416354'),
(30, 'Chuột chơi game lotechgi 6201', 3, 'anh-chinh-chuot-lotechgi-1657416374'),
(31, 'Chuột văn phòng cho sinh viên', 3, 'anh-chinh-chuot-van-phong-1657416390'),
(32, 'Tai nghe bluetooth HASAKA D32', 4, 'anh-chinh-hasaka-1657416416'),
(33, 'Lót chuột cỡ lớn no branch giá rẻ', 5, 'anh-chinh-lot-chuot-no-branch-1657416432'),
(34, 'Lót chuột cỡ nhỏ reraz xanh đen', 5, 'anh-chinh-lot-chuot-reraz-1657416448'),
(35, 'Chống đau tai atas-E46', 6, 'anh-chinh-atas-1657416468'),
(36, 'Tai nghe popo có mic', 6, 'anh-chinh-popo-1657416485'),
(37, 'Bộ vệ sinh laptop', 7, 'anh-chinh-bo-ve-sinh-1657416503'),
(38, 'Túi chống sốc', 7, 'anh-chinh-tui-chong-soc-1657416516'),
(39, 'Tai nghe bluetooth HASAKA D32 2', 4, 'anh-chinh-hasaka-1657416416'),
(40, 'Tai nghe bluetooth HASAKA D32 3', 4, 'anh-chinh-hasaka-1657416416'),
(41, 'Tai nghe bluetooth HASAKA D32 4', 4, 'anh-chinh-hasaka-1657416416'),
(42, 'Tai nghe bluetooth HASAKA D32 5', 4, 'anh-chinh-hasaka-1657416416'),
(43, 'Tai nghe bluetooth HASAKA D32 6', 4, 'anh-chinh-hasaka-1657416416'),
(44, 'Tai nghe bluetooth HASAKA D32 7', 4, 'anh-chinh-hasaka-1657416416'),
(45, 'Tai nghe bluetooth HASAKA D32 8', 4, 'anh-chinh-hasaka-1657416416'),
(47, 'Tai nghe bluetooth HASAKA D32 9', 4, 'anh-chinh-hasaka-1657416416'),
(48, 'Test', 1, 'anh-chinh-balo-1657416309');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `product_ibfk_1` (`categoryId`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
