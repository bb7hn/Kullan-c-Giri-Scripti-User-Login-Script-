-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 20 Eyl 2019, 17:52:09
-- Sunucu sürümü: 5.7.17-log
-- PHP Sürümü: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `kgs`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

DROP TABLE IF EXISTS `uyeler`;
CREATE TABLE IF NOT EXISTS `uyeler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kadi` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sifre` text NOT NULL,
  `dogrulamakodu` text NOT NULL,
  `dogrulamadurumu` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `uyeler`
--

INSERT INTO `uyeler` (`id`, `kadi`, `email`, `sifre`, `dogrulamakodu`, `dogrulamadurumu`) VALUES
(1, 'asd', 'asd', '10470c3b4b1fed12c3baac014be15fac67c6e815', '', 0),
(2, 'root', 'batuhanozen06@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'KGS_5d82997a1cb8e', 1),
(3, 'root2', 'root', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'KGS_5d82e8cabdae0', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
