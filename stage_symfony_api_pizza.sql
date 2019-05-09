-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 09 mei 2019 om 16:55
-- Serverversie: 10.1.33-MariaDB
-- PHP-versie: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stage_symfony_api_pizza`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190503192236', '2019-05-03 19:22:42'),
('20190506163157', '2019-05-06 16:32:25'),
('20190506215150', '2019-05-06 21:53:20');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pizzas`
--

CREATE TABLE `pizzas` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `baking` int(11) NOT NULL,
  `sliced` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `pizzas`
--

INSERT INTO `pizzas` (`id`, `name`, `baking`, `sliced`) VALUES
(1, 'Mozzarella', 0, 0),
(2, 'Salami', 1, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pizzas_toppings`
--

CREATE TABLE `pizzas_toppings` (
  `pizzas_id` int(11) NOT NULL,
  `toppings_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `pizzas_toppings`
--

INSERT INTO `pizzas_toppings` (`pizzas_id`, `toppings_id`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `toppings`
--

CREATE TABLE `toppings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `toppings`
--

INSERT INTO `toppings` (`id`, `name`) VALUES
(1, 'tomato sauce'),
(2, 'Salami');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexen voor tabel `pizzas`
--
ALTER TABLE `pizzas`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `pizzas_toppings`
--
ALTER TABLE `pizzas_toppings`
  ADD PRIMARY KEY (`pizzas_id`,`toppings_id`),
  ADD KEY `IDX_DCDEEEFC7F778084` (`pizzas_id`),
  ADD KEY `IDX_DCDEEEFCBE2B4234` (`toppings_id`);

--
-- Indexen voor tabel `toppings`
--
ALTER TABLE `toppings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `pizzas`
--
ALTER TABLE `pizzas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `toppings`
--
ALTER TABLE `toppings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `pizzas_toppings`
--
ALTER TABLE `pizzas_toppings`
  ADD CONSTRAINT `FK_DCDEEEFC7F778084` FOREIGN KEY (`pizzas_id`) REFERENCES `pizzas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_DCDEEEFCBE2B4234` FOREIGN KEY (`toppings_id`) REFERENCES `toppings` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
