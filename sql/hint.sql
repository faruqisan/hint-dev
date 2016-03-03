-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2016 at 01:21 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hint`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_privilage`
--

CREATE TABLE IF NOT EXISTS `tb_privilage` (
`id_privilage` int(11) NOT NULL,
  `desc_privilage` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_privilage`
--

INSERT INTO `tb_privilage` (`id_privilage`, `desc_privilage`) VALUES
(2, 'admin'),
(1, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
`id_user` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_privilage` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `name`, `email`, `password`, `id_privilage`) VALUES
(1, 'Test User', 'user@test.com', 'ee11cbb19052e40b07aac0ca060c23ee', 1),
(2, 'Test Admin', 'admin@test.com', '5f4dcc3b5aa765d61d8327deb882cf99', 2),
(3, 'Test Developer', 'developer@test.com', '5e8edd851d2fdfbd7415232c67367cc3', 1),
(4, 'Test Tester', 'tester@test.com', 'f5d1278e8109edd94e1e4197e04873b9', 1),
(6, 'Faruqi Ikhsan', 'faruqisan@gmail.com', '0ae603c9faa047a703b249025f1e1d86', 1),
(7, 'tisa gapuak', 'tisa@gapuak.com', '498183250aa0bf6c027f41f34c7376db', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_privilage`
--
ALTER TABLE `tb_privilage`
 ADD PRIMARY KEY (`id_privilage`), ADD UNIQUE KEY `desc_privilage` (`desc_privilage`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
 ADD PRIMARY KEY (`id_user`), ADD UNIQUE KEY `email` (`email`), ADD KEY `id_privilage` (`id_privilage`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_privilage`
--
ALTER TABLE `tb_privilage`
MODIFY `id_privilage` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
MODIFY `id_user` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_privilage`) REFERENCES `tb_privilage` (`id_privilage`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
