-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Янв 31 2024 г., 07:34
-- Версия сервера: 10.4.27-MariaDB
-- Версия PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `fio` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `fio`, `password`, `salt`, `birthdate`, `email`, `country`, `registration_date`) VALUES
(42, 'Wardkes', 'Месропян-Ханахян Вардкес Вачаганович', 'c43e93a36cbf891c8c7ef6fa68da735f', 'udA\\4O)20-jGqN>w,0,{:A%TDakEbH-iXx]}zG?K.6EO)joQ,rNhibVsru@laqk]\\;G{6</d6b.@`^6r5Pw\'mv=;Pr0N[PPi*Hz', '2004-01-22', 'wsdad@dasd', 'Ереван', '2024-01-26 06:52:19'),
(43, 'ivanadadad', 'Месропян Вардкес Иванович', '6bef9775fa7a475f32d7394721099ea8', '2ioIHS>q(s[xmg$>Vqe*d;?f&W94Bv4VtR0LWDz|\":Ve:Ofu7<pbW2sS2(w0v|LV\"_M:d:<3DYvp{Qrp/-@7\"1681\'hk:cvM|wv', '2024-01-12', 'ivanadadad@ivanadadad', 'Ереван', '2024-01-26 07:04:34'),
(45, 'admin', '', '928bd43b6514ff3d9ba03725d03f598a', 'VQ\\b\'A7+u:)x6yu5swVp^#US~NO+\"/(s\'OeGepN~`&(~50i<pqj~N=|<BZ`\'S[xJvK2`&mVl{Bc3,AF/v+o3BCbL<:LKRxJQlhv', '0000-00-00', '', '', '2024-01-29 07:46:38');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
