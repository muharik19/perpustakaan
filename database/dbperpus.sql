-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2018 at 02:48 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbperpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `tanggota`
--

CREATE TABLE IF NOT EXISTS `tanggota` (
  `NIM` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(250) NOT NULL,
  `TempatLahir` varchar(100) NOT NULL,
  `TanggalLahir` date NOT NULL,
  `JK` enum('Laki-laki','Perempuan') NOT NULL,
  `Prodi` enum('Teknik Informatika','Sistem Informasi','Teknik Mesin','Management','Sastra Inggris','Sastra Indonesia','Akutansi') NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `CreatedUser` int(11) NOT NULL,
  `LastUpdateDate` datetime NOT NULL,
  `LastUpdateUser` int(11) NOT NULL,
  PRIMARY KEY (`NIM`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2011180089 ;

--
-- Dumping data for table `tanggota`
--

INSERT INTO `tanggota` (`NIM`, `Nama`, `TempatLahir`, `TanggalLahir`, `JK`, `Prodi`, `CreatedDate`, `CreatedUser`, `LastUpdateDate`, `LastUpdateUser`) VALUES
(2011140002, 'Deni', 'Jakarta', '2018-01-09', 'Laki-laki', 'Management', '2018-01-04 15:51:36', 3, '2018-01-04 15:53:01', 3),
(2011140001, 'Ani Gunawan', 'Jakarta', '2018-01-24', 'Laki-laki', 'Teknik Mesin', '2018-01-04 15:51:06', 3, '2018-01-04 15:52:49', 3),
(2011140003, 'Ahmad Sidik', 'Tangerang', '1989-02-07', 'Laki-laki', 'Teknik Informatika', '2018-01-05 00:30:22', 3, '0000-00-00 00:00:00', 0),
(2011140004, 'Suryaningsih', 'Tangerang', '2018-01-11', 'Perempuan', 'Management', '2018-01-07 09:19:51', 2, '0000-00-00 00:00:00', 0),
(2011140005, 'Erry', 'Jakarta', '2018-01-02', 'Perempuan', 'Management', '2018-01-07 14:54:11', 2, '0000-00-00 00:00:00', 0),
(2011140006, 'Putri', 'Bogor', '2018-01-22', 'Perempuan', 'Sistem Informasi', '2018-01-07 14:54:48', 2, '0000-00-00 00:00:00', 0),
(2011140007, 'Mikayla', 'Tangerang', '2014-01-24', 'Perempuan', 'Sastra Inggris', '2018-01-09 05:56:31', 5, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbuku`
--

CREATE TABLE IF NOT EXISTS `tbuku` (
  `Id` int(9) NOT NULL AUTO_INCREMENT,
  `Judul` varchar(200) NOT NULL,
  `Pengarang` varchar(100) NOT NULL,
  `Penerbit` varchar(150) NOT NULL,
  `TahunTerbit` varchar(4) NOT NULL,
  `Isbn` varchar(25) NOT NULL,
  `JumlahBuku` int(3) NOT NULL,
  `Lokasi` enum('Computer','Bisnis','Management','Masak') NOT NULL,
  `TanggalInput` date NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `CreatedUser` int(11) NOT NULL,
  `LastUpdateDate` datetime NOT NULL,
  `LastUpdateUser` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbuku`
--

INSERT INTO `tbuku` (`Id`, `Judul`, `Pengarang`, `Penerbit`, `TahunTerbit`, `Isbn`, `JumlahBuku`, `Lokasi`, `TanggalInput`, `CreatedDate`, `CreatedUser`, `LastUpdateDate`, `LastUpdateUser`) VALUES
(9, 'Edukasi bahasa inggris', 'Dhira', 'PT TRI JAYA PERCETAKAN', '2017', '978-602-00-2519-4', 1, 'Management', '2018-01-02', '2018-01-09 05:59:46', 5, '0000-00-00 00:00:00', 0),
(8, 'Management Keuangan', 'Malvina', 'PT KOMPAS GRAMEDIA', '2018', '909-975-00-3091-0', 2, 'Management', '2018-01-10', '2018-01-09 05:58:00', 5, '0000-00-00 00:00:00', 0),
(4, 'Collection Design', 'Andriyan', 'PT TRI JAYA PERCETAKAN', '2000', '909-975-10-2581-3', 0, 'Management', '2015-02-04', '2017-12-18 19:27:19', 0, '2018-01-07 15:15:56', 2),
(7, 'PHP & LARAVEL', 'Agus Saputra', 'PT. Terbit Jaya', 'tahu', '909-975-00-2691-9', 0, 'Computer', '2017-12-13', '2018-01-07 15:24:47', 2, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tpendidikan_terakhir`
--

CREATE TABLE IF NOT EXISTS `tpendidikan_terakhir` (
  `IdPendidikanTerakhir` int(11) NOT NULL AUTO_INCREMENT,
  `PendidikanTerakhir` varchar(100) NOT NULL,
  PRIMARY KEY (`IdPendidikanTerakhir`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tpendidikan_terakhir`
--

INSERT INTO `tpendidikan_terakhir` (`IdPendidikanTerakhir`, `PendidikanTerakhir`) VALUES
(1, 'SD'),
(2, 'SMP'),
(3, 'SMA/SMK'),
(4, 'D1 - D2'),
(5, 'Diploma 3'),
(6, 'Strata 1'),
(7, 'Strata 2'),
(8, 'Strata 3');

-- --------------------------------------------------------

--
-- Table structure for table `ttransaksi`
--

CREATE TABLE IF NOT EXISTS `ttransaksi` (
  `Id` int(9) NOT NULL AUTO_INCREMENT,
  `idBuku` int(11) NOT NULL,
  `NIM` int(11) NOT NULL,
  `TanggalPinjam` varchar(30) NOT NULL,
  `TanggalKembali` varchar(30) NOT NULL,
  `Status` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `ttransaksi`
--

INSERT INTO `ttransaksi` (`Id`, `idBuku`, `NIM`, `TanggalPinjam`, `TanggalKembali`, `Status`) VALUES
(13, 4, 2011180088, '03-01-2018', '10-01-2018', 'Pinjam'),
(14, 4, 2011140024, '03-01-2018', '10-01-2018', 'Pinjam'),
(12, 3, 2011140027, '01-01-2018', '08-01-2018', 'Pinjam'),
(15, 5, 2011100030, '03-01-2018', '10-01-2018', 'Pinjam'),
(16, 3, 2011140002, '04-01-2018', '11-01-2018', 'Pinjam'),
(17, 3, 2011140001, '04-01-2018', '11-01-2018', 'Pinjam'),
(18, 1, 2011140003, '07-01-2018', '14-01-2018', 'Pinjam'),
(19, 5, 2011140004, '07-01-2018', '14-01-2018', 'Pinjam'),
(20, 5, 2011140001, '07-01-2018', '14-01-2018', 'Pinjam'),
(21, 1, 2011140004, '07-01-2018', '14-01-2018', 'Pinjam'),
(22, 1, 2011140003, '07-01-2018', '14-01-2018', 'Pinjam'),
(23, 6, 2011140005, '07-01-2018', '14-01-2018', 'Pinjam'),
(24, 6, 2011140006, '07-01-2018', '14-01-2018', 'Pinjam'),
(25, 6, 2011140002, '07-01-2018', '14-01-2018', 'Pinjam'),
(26, 3, 2011140006, '07-01-2018', '14-01-2018', 'Pinjam'),
(27, 3, 2011140005, '07-01-2018', '14-01-2018', 'Pinjam'),
(28, 4, 2011140005, '07-01-2018', '14-01-2018', 'Pinjam'),
(29, 7, 2011140003, '07-01-2018', '14-01-2018', 'Pinjam'),
(30, 9, 2011140007, '09-01-2018', '16-01-2018', 'Pinjam');

-- --------------------------------------------------------

--
-- Table structure for table `tuser`
--

CREATE TABLE IF NOT EXISTS `tuser` (
  `IdUser` int(11) NOT NULL AUTO_INCREMENT,
  `NIP` varchar(6) NOT NULL,
  `NamaLengkap` varchar(100) NOT NULL,
  `Alamat` text NOT NULL,
  `Telepon` varchar(20) NOT NULL,
  `CellPhone` varchar(20) NOT NULL,
  `Agama` varchar(20) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Aktif` char(1) NOT NULL,
  `Username` varchar(32) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `IdPendidikanTerakhir` int(11) NOT NULL,
  `LastLogin` datetime NOT NULL,
  `LastUpdateDate` datetime NOT NULL,
  `LastUpdateUser` int(11) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `CreatedUser` int(11) NOT NULL,
  PRIMARY KEY (`IdUser`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tuser`
--

INSERT INTO `tuser` (`IdUser`, `NIP`, `NamaLengkap`, `Alamat`, `Telepon`, `CellPhone`, `Agama`, `Email`, `Aktif`, `Username`, `Password`, `IdPendidikanTerakhir`, `LastLogin`, `LastUpdateDate`, `LastUpdateUser`, `CreatedDate`, `CreatedUser`) VALUES
(3, '019928', 'Desi Tri Rahayu', 'Kp Pondok Serut RT004 RW010 Kel. Pondok Kacang Kec. Pondok Aren Kota Tangerang Selatan', '02198765432', '08997213930', 'Islam', 'desi@altecnology.com', 'Y', 'desi', '069e2dd171f61ecffb845190a7adf425', 6, '2018-01-07 15:58:01', '2017-12-18 20:55:24', 0, '2017-12-18 20:55:10', 0),
(2, '019929', 'Ahmad Muharik Al Ansori', 'Kp Pondok Serut RT004 RW010 Kel. Pondok Kacang Kec. Pondok Aren Kota Tangerang Selatan', '02112345678', '087772488816', 'Islam', 'ahmadmuharik@altecnology.com', 'Y', 'muharik', '27e7eeb1e86108f986d09dd0a6a5d511', 8, '2018-01-13 11:04:38', '0000-00-00 00:00:00', 0, '2017-12-18 20:53:30', 0),
(4, '019930', 'Andi Noval, SE', 'Kp. Pondok serut RT004 RW010 Kel. Pondok Kacang Barat Kec. Pondok Aren', '02198765432', '087875439000', 'Islam', 'andi@yahoo.com', 'Y', 'andi', 'ce0e5bf55e4f71749eade7a8b95c4e46', 6, '2018-01-01 07:45:40', '0000-00-00 00:00:00', 0, '2018-01-01 06:32:50', 2),
(5, '019931', 'Sri Wahyuni, SE', 'Kp Pabuaran RT004 RW005 Kel. Paburan Kec Cibinong Bogor', '02183456987', '081245637865', 'Islam', 'sri_wahyu@yahoo.co.id', 'N', 'sri', 'd1565ebd8247bbb01472f80e24ad29b6', 6, '2018-01-09 05:55:04', '2018-01-03 01:23:48', 2, '2018-01-02 23:54:00', 2),
(6, '019932', 'James', 'Kp jeruk nipis RT002 RW 001 Kb Jeruk', '02195762345', '08127563456', 'Kristen', 'jam@yahoo.com', 'Y', 'james', 'b4cc344d25a2efe540adbf2678e2304c', 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2018-01-03 00:31:39', 2),
(7, '019933', 'Ronaldo', 'Puri Bintaro Hijau Blok N1 No.12 RT006 RW101 Kel. Pondok Aren Kec. Pondok Aren', '02198457634', '087854127845', 'Katolik', 'ronald@yahoo.com', 'Y', 'ronaldo', 'c5aa3124b1adad080927ce4d144c6b33', 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2018-01-03 00:41:05', 2),
(8, '019934', 'Messi', 'Limo RT005 RW010 Kel. Limo Kec. Limo Depok', '02184562746', '087823783467', 'Budha', 'messi@gmail.com', 'Y', 'messi', '1463ccd2104eeb36769180b8a0c86bb6', 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2018-01-03 00:42:21', 2),
(9, '019935', 'Jet Lie', 'Delatinos Blok B1 No. 02 RT001 RW010 Kel Rawa Buntu Kec. Serpong', '02183563854', '081284567297', 'Hindu', 'jet@gmail.com', 'Y', 'jet', '564f60a2dd82ea24bfa3f2f615348f7c', 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '2018-01-03 00:43:29', 2),
(10, '019936', 'Supriyono, SE', 'Kp. Pondok serut RT004 RW010 Kel. Pondok Kacang Barat Kec. Pondok Aren', '02197485764', '08381678364', 'Islam', 'supri@yahoo.com', 'Y', 'supri', 'd79444495ba8886c397b418227564d3f', 6, '2018-01-10 05:52:21', '2018-01-03 09:37:25', 2, '2018-01-03 09:36:48', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
