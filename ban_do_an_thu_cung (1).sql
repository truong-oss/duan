-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 10, 2024 at 05:59 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ban_do_an_thu_cung`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int NOT NULL,
  `mo_ta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `link_anh` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ngay_dang` date NOT NULL,
  `trang_thai_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `mo_ta`, `link_anh`, `ngay_dang`, `trang_thai_id`) VALUES
(9, 'a', './uploads/1733226362slider_index_1_5.webp', '2024-12-03', 1),
(10, 'áaaaaa', './uploads/1733226308slide_2_img.webp', '2024-12-03', 1),
(11, 'ngọc', './uploads/1733226318slider_index_1_1.webp', '2024-12-03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `binh_luans`
--

CREATE TABLE `binh_luans` (
  `id` int NOT NULL,
  `tai_khoan_id` int NOT NULL,
  `san_pham_id` int NOT NULL,
  `noi_dung` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ngay_dang` date NOT NULL,
  `trang_thai` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `binh_luans`
--

INSERT INTO `binh_luans` (`id`, `tai_khoan_id`, `san_pham_id`, `noi_dung`, `ngay_dang`, `trang_thai`) VALUES
(1, 1, 1, 'sản phẩm tốt', '2024-11-16', 1),
(2, 35, 1, 'ss', '2024-11-28', 1),
(3, 36, 1, 's', '2024-12-10', 1),
(35, 36, 1, '1', '2024-12-10', 1),
(36, 36, 1, 'a1', '2024-12-10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `san_pham_id` int NOT NULL,
  `so_luongs` int DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `san_pham_id`, `so_luongs`) VALUES
(29, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_don_hangs`
--

CREATE TABLE `chi_tiet_don_hangs` (
  `id` int NOT NULL,
  `don_hang_id` int NOT NULL,
  `san_pham_id` int NOT NULL,
  `so_luong` int NOT NULL,
  `don_gia` int NOT NULL,
  `thanh_tien` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chi_tiet_don_hangs`
--

INSERT INTO `chi_tiet_don_hangs` (`id`, `don_hang_id`, `san_pham_id`, `so_luong`, `don_gia`, `thanh_tien`) VALUES
(32, 53, 1, 1, 210000, 199000),
(33, 54, 1, 2, 210000, 199000),
(34, 54, 2, 1, 60000, 55000),
(35, 55, 1, 7, 210000, 199000),
(36, 62, 1, 1, 210000, 199000),
(37, 65, 1, 1, 210000, 199000),
(38, 65, 2, 1, 60000, 55000),
(39, 66, 2, 1, 60000, 55000),
(40, 67, 1, 2, 210000, 199000),
(41, 68, 1, 2, 210000, 199000),
(42, 68, 2, 1, 60000, 55000);

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_gio_hangs`
--

CREATE TABLE `chi_tiet_gio_hangs` (
  `id` int NOT NULL,
  `gio_hang_id` int NOT NULL,
  `san_pham_id` int NOT NULL,
  `so_luong` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chi_tiet_gio_hangs`
--

INSERT INTO `chi_tiet_gio_hangs` (`id`, `gio_hang_id`, `san_pham_id`, `so_luong`) VALUES
(62, 151, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `chuc_vus`
--

CREATE TABLE `chuc_vus` (
  `id` int NOT NULL,
  `ten_chuc_vu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `danh_mucs`
--

CREATE TABLE `danh_mucs` (
  `id` int NOT NULL,
  `ten_danh_muc` varchar(50) NOT NULL,
  `mo_ta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `danh_mucs`
--

INSERT INTO `danh_mucs` (`id`, `ten_danh_muc`, `mo_ta`) VALUES
(1, 'hạt', 'cám cho mèo'),
(2, 'pate', 'nhiều thành phần gia vị phù hợp cho pet của bạn'),
(3, 'Bánh thưởng', 'tạo sự thèm ăn cho pet');

-- --------------------------------------------------------

--
-- Table structure for table `don_hangs`
--

CREATE TABLE `don_hangs` (
  `id` int NOT NULL,
  `ma_don_hang` varchar(50) NOT NULL,
  `tai_khoan_id` int DEFAULT NULL,
  `ten_nguoi_nhan` varchar(255) NOT NULL,
  `email_nguoi_nhan` varchar(255) NOT NULL,
  `sdt_nguoi_nhan` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `dia_chi_nguoi_nhan` varchar(50) NOT NULL,
  `ngay_dat` date NOT NULL,
  `tong_tien` decimal(10,2) NOT NULL,
  `ghi_chu` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `phuong_thuc_thanh_toan_id` int NOT NULL,
  `trang_thai_don_hang_id` int NOT NULL,
  `trang_thai_thanh_toan_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `don_hangs`
--

INSERT INTO `don_hangs` (`id`, `ma_don_hang`, `tai_khoan_id`, `ten_nguoi_nhan`, `email_nguoi_nhan`, `sdt_nguoi_nhan`, `dia_chi_nguoi_nhan`, `ngay_dat`, `tong_tien`, `ghi_chu`, `phuong_thuc_thanh_toan_id`, `trang_thai_don_hang_id`, `trang_thai_thanh_toan_id`) VALUES
(54, 'DH-7261', NULL, 'Nguyễn Xuân ngọc', 'ngochip@gmail.com', '0987654321', 'Phúc thọ-Hà Nội', '2024-12-04', '483000.00', 'a', 1, 9, 4),
(62, 'DH-7962', 2, 'ngochip', 'fsfs@gmail.com', '0333510701', 'Phúc thọ_hà nội', '2024-12-06', '229000.00', 'a', 1, 1, 1),
(65, 'DH-9314', 2, 'ngochip', 'fsfs@gmail.com', '0333510701', 'Phúc thọ_hà nội', '2024-12-06', '284000.00', 'a', 1, 1, 1),
(66, 'DH-4916', NULL, 'viet', 'fsfs@gmail.com', '0325261859', 'ha noi', '2024-12-09', '85000.00', '333', 1, 1, 1),
(67, 'DH-8651', NULL, 'aa', 'aa@gmail.com', '0327251849', 'ha noi', '2024-12-10', '428000.00', 'qq', 1, 1, 1),
(68, 'DH-4515', 36, 'Nguyễn Văn A', 'abc@gmail.com', '0234567891', 'aa', '2024-12-10', '483000.00', '', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gio_hangs`
--

CREATE TABLE `gio_hangs` (
  `id` int NOT NULL,
  `tai_khoan_id` varchar(50) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `gio_hangs`
--

INSERT INTO `gio_hangs` (`id`, `tai_khoan_id`, `session_id`) VALUES
(151, NULL, 'qcq61u6ton8jj0po38hndtbf49');

-- --------------------------------------------------------

--
-- Table structure for table `list_anh_san_phams`
--

CREATE TABLE `list_anh_san_phams` (
  `id` int NOT NULL,
  `san_pham_id` int NOT NULL,
  `link_hinh_anh` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `list_anh_san_phams`
--

INSERT INTO `list_anh_san_phams` (`id`, `san_pham_id`, `link_hinh_anh`) VALUES
(4, 3, './uploads/1731959623anh1.png'),
(5, 3, './uploads/1731959623anh2.webp'),
(6, 3, './uploads/1731959623anh7.png'),
(7, 1, './uploads/1733226851images.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `san_phams`
--

CREATE TABLE `san_phams` (
  `id` int NOT NULL,
  `ten_san_pham` varchar(50) NOT NULL,
  `gia_san_pham` int NOT NULL,
  `gia_khuyen_mai` int NOT NULL,
  `so_luong` int NOT NULL,
  `danh_muc_id` int NOT NULL,
  `hinh_anh` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `trang_thai` int NOT NULL,
  `ngay_nhap` date NOT NULL,
  `mo_ta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `luot_xem` int DEFAULT '0',
  `khoi_luong` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `san_phams`
--

INSERT INTO `san_phams` (`id`, `ten_san_pham`, `gia_san_pham`, `gia_khuyen_mai`, `so_luong`, `danh_muc_id`, `hinh_anh`, `trang_thai`, `ngay_nhap`, `mo_ta`, `luot_xem`, `khoi_luong`) VALUES
(1, 'hạt dinh dưỡng', 210000, 199000, 20, 1, './uploads/1732240514anh2.webp', 1, '2024-11-14', 'hạt nhiều vị cho pet', 0, 30),
(2, 'pate (vàng)', 60000, 55000, 39, 2, './uploads/1732240520anh3.jpg', 1, '2024-11-16', 'ngon tuyệt vời', 0, 1),
(3, 'pate cá ngừ', 240000, 200000, 20, 2, './uploads/1732240528anh4.jpg', 1, '2024-11-05', 'pate cá ngừ kích thích thèm ăn cho pet ....', 0, 1),
(4, 'hạt vị nguyên bản', 200000, 150000, 40, 1, './uploads/1732240535anh5.jpg', 1, '2024-11-04', 'vị nguyên bản', 0, 30),
(5, 'pate (hồng)', 39000, 30000, 20, 2, './uploads/1732240541anh7.png', 2, '2024-11-19', 'chưa có thông tin', 0, 1),
(6, 'hạt vị đặc biệt', 400000, 355000, 10, 1, './uploads/1732240549anh1.png', 2, '2024-11-04', '...', 0, 30);

-- --------------------------------------------------------

--
-- Table structure for table `tai_khoans`
--

CREATE TABLE `tai_khoans` (
  `id` int NOT NULL,
  `ho_ten` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) NOT NULL,
  `mat_khau` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `so_dien_thoai` varchar(255) NOT NULL,
  `chuc_vu` int NOT NULL,
  `gioi_tinh` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `anh_dai_dien` varchar(255) DEFAULT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `dia_chi` text,
  `trang_thai` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tai_khoans`
--

INSERT INTO `tai_khoans` (`id`, `ho_ten`, `email`, `mat_khau`, `so_dien_thoai`, `chuc_vu`, `gioi_tinh`, `anh_dai_dien`, `ngay_sinh`, `dia_chi`, `trang_thai`) VALUES
(1, 'duan11', 'duan1@gmail.com1', '$2y$10$jETMB2dXkqe1Ed/cPeKZ1O8TRPpIjb/K97xdSEvir7sO3a9O17fvW', '02222133451', 2, '1', NULL, '2024-11-21', 'phuc tho1', 2),
(2, 'ngochip', 'fsfs@gmail.com', '$2y$10$ENjvOM0JwF66Px2vTKpHz.2m8nOcykTC5JPYxTeEsaKA1BjCNJtYu', '0333510701', 2, '1', NULL, NULL, 'hanoi', 1),
(33, 'nguyeen quoc vvvv', 'viet223331111@gmail.com', '$2y$10$DQ.ksDrlDNQKrunwl3mNEOoDYW9UW3wMP5d9c9.Aon.DANA1RrNeu', '09876544', 1, '1', NULL, '2024-11-24', NULL, 1),
(34, 'ngọc', 'ngocnxph50224@gmail.com', '$2y$10$ZDXTz156eFCMJD9r/iii1.gYaAZpZg33y8TfN0PBnwBbLcr4TNGsi', '0869541205', 1, '1', NULL, '2024-11-16', NULL, 1),
(36, 'Nguyễn Văn A', 'abc@gmail.com', '$2y$10$MV5I/O6yOU3YtRyk8ZKFKuDMERG52dnz47P04iIvoPnYI0hmUXEES', '0234567891', 2, 'nam', './uploads/1733808505chup-anh-doanh-nhan-picture.vn-3-scaled.jpg', NULL, 'số 1 hà nội ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `thanh_toans`
--

CREATE TABLE `thanh_toans` (
  `id` int NOT NULL,
  `ten_hinh_thuc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `thanh_toans`
--

INSERT INTO `thanh_toans` (`id`, `ten_hinh_thuc`) VALUES
(1, 'thanh toán khi nhận hàng'),
(2, 'QR');

-- --------------------------------------------------------

--
-- Table structure for table `trang_thai_banner`
--

CREATE TABLE `trang_thai_banner` (
  `id` int NOT NULL,
  `trang_thai_banner` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `trang_thai_banner`
--

INSERT INTO `trang_thai_banner` (`id`, `trang_thai_banner`) VALUES
(1, 'Hiển thị'),
(2, 'Ẩn');

-- --------------------------------------------------------

--
-- Table structure for table `trang_thai_don_hangs`
--

CREATE TABLE `trang_thai_don_hangs` (
  `id` int NOT NULL,
  `ten_trang_thai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `trang_thai_don_hangs`
--

INSERT INTO `trang_thai_don_hangs` (`id`, `ten_trang_thai`) VALUES
(1, 'chưa xác nhận'),
(2, 'đã xác nhận'),
(3, 'đang chuẩn bị hàng'),
(4, 'đang giao'),
(5, 'đã giao'),
(6, 'đã nhận'),
(7, 'thành công'),
(8, 'hoàn hàng'),
(9, 'hoàn hàng thành công'),
(10, 'hủy đơn');

-- --------------------------------------------------------

--
-- Table structure for table `trang_thai_thanh_toans`
--

CREATE TABLE `trang_thai_thanh_toans` (
  `id` int NOT NULL,
  `ten_trang_thais` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `trang_thai_thanh_toans`
--

INSERT INTO `trang_thai_thanh_toans` (`id`, `ten_trang_thais`) VALUES
(1, 'Chưa thanh toán'),
(2, 'Đã thanh toán'),
(3, 'chưa hoàn tiền'),
(4, 'Đã hoàn tiền');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `binh_luans`
--
ALTER TABLE `binh_luans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `san_pham_id` (`san_pham_id`);

--
-- Indexes for table `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `don_hang_id` (`don_hang_id`,`san_pham_id`);

--
-- Indexes for table `chi_tiet_gio_hangs`
--
ALTER TABLE `chi_tiet_gio_hangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gio_hang_id` (`gio_hang_id`,`san_pham_id`);

--
-- Indexes for table `chuc_vus`
--
ALTER TABLE `chuc_vus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `danh_mucs`
--
ALTER TABLE `danh_mucs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `don_hangs`
--
ALTER TABLE `don_hangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gio_hangs`
--
ALTER TABLE `gio_hangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tai_khoan_id` (`tai_khoan_id`);

--
-- Indexes for table `list_anh_san_phams`
--
ALTER TABLE `list_anh_san_phams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `san_pham_id` (`san_pham_id`),
  ADD KEY `san_pham_id_2` (`san_pham_id`);

--
-- Indexes for table `san_phams`
--
ALTER TABLE `san_phams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tai_khoans`
--
ALTER TABLE `tai_khoans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thanh_toans`
--
ALTER TABLE `thanh_toans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trang_thai_banner`
--
ALTER TABLE `trang_thai_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trang_thai_don_hangs`
--
ALTER TABLE `trang_thai_don_hangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trang_thai_thanh_toans`
--
ALTER TABLE `trang_thai_thanh_toans`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `binh_luans`
--
ALTER TABLE `binh_luans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `chi_tiet_gio_hangs`
--
ALTER TABLE `chi_tiet_gio_hangs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `chuc_vus`
--
ALTER TABLE `chuc_vus`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `danh_mucs`
--
ALTER TABLE `danh_mucs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `don_hangs`
--
ALTER TABLE `don_hangs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `gio_hangs`
--
ALTER TABLE `gio_hangs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `list_anh_san_phams`
--
ALTER TABLE `list_anh_san_phams`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `san_phams`
--
ALTER TABLE `san_phams`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tai_khoans`
--
ALTER TABLE `tai_khoans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `thanh_toans`
--
ALTER TABLE `thanh_toans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trang_thai_banner`
--
ALTER TABLE `trang_thai_banner`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trang_thai_don_hangs`
--
ALTER TABLE `trang_thai_don_hangs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `trang_thai_thanh_toans`
--
ALTER TABLE `trang_thai_thanh_toans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`san_pham_id`) REFERENCES `san_phams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `list_anh_san_phams`
--
ALTER TABLE `list_anh_san_phams`
  ADD CONSTRAINT `list_anh_san_phams_ibfk_1` FOREIGN KEY (`san_pham_id`) REFERENCES `san_phams` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
