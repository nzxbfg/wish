-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Авг 24 2023 г., 15:07
-- Версия сервера: 8.0.33-25
-- Версия PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cf07970_wish`
--

-- --------------------------------------------------------

--
-- Структура таблицы `allitems`
--

CREATE TABLE IF NOT EXISTS `allitems` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `reserved` tinyint(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `allitems`
--

INSERT INTO `allitems` (`id`, `title`, `img`, `description`, `link`, `reserved`) VALUES
(1, 'Фотоаппарат Creme', '64dfa01e9f0ed_creamwebp.webp', 'Цифровой фотик, которого мне не хватает', 'https://instagram.com/paper.shoot?igshid=MzRlODBiNWFlZA==', 0),
(2, 'Кольцо или серьги от Александра Карпинского ', '64dfa76de9ee6_IMG_7683jpeg.jpeg', 'Я люблю белое золото или серебро, размер ', 'https://instagram.com/alexanderkarpinsky?igshid=MzRlODBiNWFlZA==', 0),
(3, 'Подвеска Vivienne Westwood,', '64dfb46de6df1_IMG_7691jpeg.jpeg', 'AMANDA BAS RELIEF PENDANT', 'https://www.viviennewestwood.com/en/', 0),
(4, 'Сумочка от Vivienne Westwood ', '64dfaf2e9cd4c_IMG_7689jpeg.jpeg', ' Hazel Medium Handbag', 'https://www.viviennewestwood.com/en/', 0),
(5, 'Парфюм  Lacoste', '64dfab779badb_IMG_7687webp.webp', 'Lacoste L.12.12 Pour Elle Sparkling ', 'https://www.letu.ru/product/lacoste-l.12.12-pour-elle-sparkling/39100093', 0),
(6, ' Ковер ручной работы, всегда такой хотела ', '64dfaaa013baf_IMG_7685jpeg.jpeg', 'Ребята делают огромную работу, делают качественно и индивидуально) хотелось бы что то маленькое и минималистичное', 'https://instagram.com/xmechno?igshid=MzRlODBiNWFlZA== https://instagram.com/kovrua?igshid=MzRlODBiNWFlZA==', 0),
(7, 'Парфюм LE LABO SANTAL33', '64dfb4095d421_IMG_7693jpeg.jpeg', 'Потрясающий аромат фиалки, кедра, кардамона и ириса', 'https://goldapple.ru/11466-19760317147-santal-33', 0),
(8, 'Увлажнитель воздуха ', '64dfb1db690ae_IMG_7692jpeg.jpeg', 'Кайфушечка нужная', 'https://ozon.ru/t/pARq2jp', 0),
(9, 'Флешечка ', '64dfb334952e3_IMG_7694jpeg.jpeg', 'Штука придуманная для людей, чтобы не платить за айклауд ', 'https://ozon.ru/t/KyX00K1', 0),
(10, 'Часы ', '64dfb905647aa_IMG_7696jpeg.jpeg', 'Casio Vintage LA670WEA-7E', 'https://www.alltime.ru/watch/casio/LA-670WEA-7E/12594/?user-guid=0%3Allgxf4jn%3AcV7K8WpA_W_f0gI8mn3dDV9rQUaY2PlS', 0),
(11, 'Шмот ', '64e6dc35576b1_IMG_7774jpeg.jpeg', '', 'https://instagram.com/notenough_store?igshid=MzRlODBiNWFlZA==', 0),
(12, 'Кольцо', '64e6dd1368eae_IMG_7775jpeg.jpeg', 'Размер я свой все еще не знаю( ', 'https://instagram.com/priceyoupay?igshid=MzRlODBiNWFlZA==', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `base`
--

CREATE TABLE IF NOT EXISTS `base` (
  `id` int NOT NULL AUTO_INCREMENT,
  `card` varchar(255) NOT NULL,
  `mainimg` varchar(255) NOT NULL,
  `about` varchar(255) NOT NULL,
  `telegram` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `base`
--

INSERT INTO `base` (`id`, `card`, `mainimg`, `about`, `telegram`, `instagram`) VALUES
(1, '5536914005953355', '64df9c8abf8a2_64db9e8dbc3da_photo_2023-08-11_23-13-15jpgjpg.jpg', 'Этот wishlist приурочен к моему дню рождению, которое состоится 15 сентября! Здесь представлены мои хотелки к моему 24 летию!  Если Вы хотите порадовать меня нужными подарками, которых мне не хватает, то листайте ниже)', 'https://t.me/elenaloveepta', 'https://instagram.com/elenaloveepta');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `pass`) VALUES
(3, 'elenaloveepta', '8c4d96143f3a9512287a36c22324b729'),
(4, 'root', 'e61088ec5c3594c62b1e4d341ff6e53e');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
