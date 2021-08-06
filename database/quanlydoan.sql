-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2021 at 02:24 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quanlydoan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbldoan`
--

CREATE TABLE `tbldoan` (
  `madoan` int(11) NOT NULL,
  `tendoan` varchar(100) NOT NULL,
  `duongdan` varchar(100) NOT NULL,
  `mota` text NOT NULL,
  `diem` int(11) NOT NULL,
  `ngaydang` timestamp NOT NULL DEFAULT current_timestamp(),
  `deadline` date NOT NULL,
  `tinhtrang` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `new_name` varchar(100) NOT NULL,
  `done` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbldoan`
--

INSERT INTO `tbldoan` (`madoan`, `tendoan`, `duongdan`, `mota`, `diem`, `ngaydang`, `deadline`, `tinhtrang`, `name`, `new_name`, `done`) VALUES
(1, 'Bao cao do an tot nghiep dot 1', 'http://localhost:8080/QuanLyDoAn/view/download.php?id=1', 'tốt', 11, '2021-08-04 02:05:38', '2021-08-17', 'đã giao', 'Hoàng-Ngọc-Hải-Front-End-Developer (1) (1).pdf', '1Hoàng-Ngọc-Hải-Front-End-Developer (1) (1).pdf', ''),
(2, 'Bao cao do an tot nghiep dot 2', 'http://localhost:8080/QuanLyDoAn/view/download.php?id=2', '', 0, '2021-08-04 02:05:38', '2021-08-17', 'đã giao', 'Bao_cao_lap_trinh_android (1).pdf', '2Bao_cao_lap_trinh_android (1).pdf', 'done'),
(3, 'Bao cao do an tot nghiep dot 3', '', '', 0, '2021-08-04 02:05:38', '2021-08-17', 'đã giao', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblgiaovien`
--

CREATE TABLE `tblgiaovien` (
  `magiaovien` int(11) NOT NULL,
  `tengiaovien` varchar(100) NOT NULL,
  `ngaysinh` date NOT NULL,
  `sodienthoai` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `makhoa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblgiaovien`
--

INSERT INTO `tblgiaovien` (`magiaovien`, `tengiaovien`, `ngaysinh`, `sodienthoai`, `email`, `makhoa`) VALUES
(1, 'Nguyen Van A', '2021-08-17', '0347689482', 'babywell40@gmail.com', 1),
(2, 'Nguyen Van B', '2021-08-17', '0929217149', 'babywell40@gmail.com', 1),
(5, 'Trần Thị B', '2021-08-12', '0356868584', 'hoangvuong1225@gmail.com', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tblkhoa`
--

CREATE TABLE `tblkhoa` (
  `makhoa` int(11) NOT NULL,
  `tenkhoa` varchar(50) NOT NULL,
  `ngaythanhlap` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `mota` text NOT NULL,
  `truongkhoa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblkhoa`
--

INSERT INTO `tblkhoa` (`makhoa`, `tenkhoa`, `ngaythanhlap`, `mota`, `truongkhoa`) VALUES
(1, 'Công nghệ thông tin', '2021-08-06 03:46:40', 'Mo ta', 1),
(2, 'Cơ khí', '2021-08-06 03:47:29', 'Mô tả', 1),
(4, 'Kinh tế', '2021-08-06 03:46:34', '123', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbllop`
--

CREATE TABLE `tbllop` (
  `malop` int(11) NOT NULL,
  `tenlop` varchar(100) NOT NULL,
  `siso` int(11) NOT NULL,
  `manienkhoa` int(11) NOT NULL,
  `magiaovien` int(11) NOT NULL,
  `makhoa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbllop`
--

INSERT INTO `tbllop` (`malop`, `tenlop`, `siso`, `manienkhoa`, `magiaovien`, `makhoa`) VALUES
(1, 'Cong nge thong tin k59', 11, 1, 1, 1),
(2, 'Công trình 1', 44, 1, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblnienkhoa`
--

CREATE TABLE `tblnienkhoa` (
  `manienkhoa` int(11) NOT NULL,
  `tennienkhoa` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblnienkhoa`
--

INSERT INTO `tblnienkhoa` (`manienkhoa`, `tennienkhoa`) VALUES
(1, '2020-2022'),
(2, '2022-2023');

-- --------------------------------------------------------

--
-- Table structure for table `tblphancong`
--

CREATE TABLE `tblphancong` (
  `maphancong` int(11) NOT NULL,
  `madoan` int(11) NOT NULL,
  `masinhvien` int(11) NOT NULL,
  `magiaovien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblphancong`
--

INSERT INTO `tblphancong` (`maphancong`, `madoan`, `masinhvien`, `magiaovien`) VALUES
(1, 1, 2, 1),
(6, 3, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `masinhvien` bigint(10) NOT NULL,
  `hoten` varchar(100) NOT NULL,
  `ngaysinh` date NOT NULL,
  `sodienthoai` int(11) NOT NULL,
  `diachi` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `matkhau` varchar(50) NOT NULL,
  `malop` int(11) NOT NULL,
  `quyen` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`masinhvien`, `hoten`, `ngaysinh`, `sodienthoai`, `diachi`, `email`, `matkhau`, `malop`, `quyen`) VALUES
(2, 'Đỗ Quốc Tuấn', '2000-08-17', 356868584, 'Sài Gòn', 'email', '123', 1, 'sinhvien'),
(3, 'Admin', '0000-00-00', 0, '', '', '123', 0, 'admin'),
(5, 'Nguyễn Văn C', '2000-08-04', 356868584, 'Sài Gòn', 'hoangvuong1225@gmail.com', '123', 1, 'sinhvien'),
(6, 'Nguyễn Mai Chí Trung', '2021-08-14', 356868584, 'Sài Gòn', 'hoangvuong1225@gmail.com', '123', 1, 'sinhvien');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbldoan`
--
ALTER TABLE `tbldoan`
  ADD PRIMARY KEY (`madoan`);

--
-- Indexes for table `tblgiaovien`
--
ALTER TABLE `tblgiaovien`
  ADD PRIMARY KEY (`magiaovien`);

--
-- Indexes for table `tblkhoa`
--
ALTER TABLE `tblkhoa`
  ADD PRIMARY KEY (`makhoa`);

--
-- Indexes for table `tbllop`
--
ALTER TABLE `tbllop`
  ADD PRIMARY KEY (`malop`);

--
-- Indexes for table `tblnienkhoa`
--
ALTER TABLE `tblnienkhoa`
  ADD PRIMARY KEY (`manienkhoa`);

--
-- Indexes for table `tblphancong`
--
ALTER TABLE `tblphancong`
  ADD PRIMARY KEY (`maphancong`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`masinhvien`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbldoan`
--
ALTER TABLE `tbldoan`
  MODIFY `madoan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblgiaovien`
--
ALTER TABLE `tblgiaovien`
  MODIFY `magiaovien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblkhoa`
--
ALTER TABLE `tblkhoa`
  MODIFY `makhoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbllop`
--
ALTER TABLE `tbllop`
  MODIFY `malop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblnienkhoa`
--
ALTER TABLE `tblnienkhoa`
  MODIFY `manienkhoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblphancong`
--
ALTER TABLE `tblphancong`
  MODIFY `maphancong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `masinhvien` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
