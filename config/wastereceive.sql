-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 03 Sie 2021, 09:05
-- Wersja serwera: 10.4.20-MariaDB
-- Wersja PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `wastereceive`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `nip` varchar(10) NOT NULL,
  `address` varchar(150) NOT NULL,
  `zip_code` varchar(6) NOT NULL,
  `city` varchar(50) NOT NULL,
  `bdo_number` varchar(9) NOT NULL,
  `created` datetime NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `nip`, `address`, `zip_code`, `city`, `bdo_number`, `created`, `description`) VALUES
(40, 'Przedsiębiorca A', '0000000000', 'Przykładowy adres lalala', '00-000', 'city', '000000000', '2021-08-03 08:58:36', 'Uwaga na kierowców, nie rozróżniają odpadów'),
(41, 'Przedsiębiorca B', '1111111111', 'Mieszkanie na wyspie pełen wody', '11-586', 'Wyspowo', '555555555', '2021-08-03 08:59:20', ''),
(42, 'Transportujemy odpady ', '8734437644', 'adrrsowowowow owow 54a', '55-555', 'Warszawa', '999999999', '2021-08-03 09:00:17', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wastereceive`
--

CREATE TABLE `wastereceive` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `customer_id` int(11) NOT NULL,
  `transporter_id` int(11) NOT NULL,
  `plateNumber` varchar(15) NOT NULL,
  `carWeightBrutto` float NOT NULL,
  `carWeightNetto` float NOT NULL,
  `WasteWeight` float NOT NULL,
  `wasteType` varchar(50) NOT NULL,
  `warehouse` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `wastereceive`
--

INSERT INTO `wastereceive` (`id`, `date`, `customer_id`, `transporter_id`, `plateNumber`, `carWeightBrutto`, `carWeightNetto`, `WasteWeight`, `wasteType`, `warehouse`, `description`, `created`) VALUES
(16, '2021-07-05 09:00:00', 40, 42, 'PJA 5050', 550, 500, 50, '15 01 02', 'ZRE', '', '2021-08-03 09:00:49'),
(17, '2021-08-03 09:01:00', 41, 42, 'PJA 5050', 650, 500, 150, '15 01 01', 'ZRE', '', '2021-08-03 09:01:15'),
(18, '2021-06-16 09:01:00', 40, 41, 'PJA 5050', 50, 48, 2, '20 03 01', 'ZRE', '', '2021-08-03 09:01:42');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `wastereceive`
--
ALTER TABLE `wastereceive`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT dla tabeli `wastereceive`
--
ALTER TABLE `wastereceive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
