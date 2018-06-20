-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 20, 2018 at 01:05 PM
-- Server version: 5.7.22-0ubuntu0.17.10.1
-- PHP Version: 7.1.17-0ubuntu0.17.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `questionId` int(11) NOT NULL,
  `isTrue` int(1) NOT NULL,
  `text_` text NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `questionId`, `isTrue`, `text_`, `createdAt`, `updatedAt`) VALUES
(1, 1, 1, 'Primitive (value) and Object (reference)', '2018-06-06 11:53:59', '2018-06-06 11:53:59'),
(2, 1, 0, 'Basic, Structure and Object', '2018-06-06 11:55:06', '2018-06-06 11:55:06'),
(3, 1, 0, 'Physical and Virtual', '2018-06-06 11:55:32', '2018-06-06 11:55:32'),
(4, 2, 0, 'Нет', '2018-06-14 10:12:41', '2018-06-14 10:12:41'),
(5, 2, 0, 'Есть', '2018-06-14 10:12:50', '2018-06-14 10:12:50'),
(6, 2, 1, 'Есть, только начиная с версии 8', '2018-06-14 10:13:20', '2018-06-14 10:13:25'),
(7, 2, 0, 'Есть, только начиная с версии 9', '2018-06-14 10:13:33', '2018-06-14 10:13:33'),
(8, 3, 0, 'Интерпретацией (построчно)', '2018-06-18 12:53:07', '2018-06-18 12:53:07'),
(9, 3, 1, 'Компиляцией', '2018-06-18 12:53:29', '2018-06-18 12:53:29'),
(10, 3, 0, 'При создании дистрибутива - компиляцией в промежуточный байт-код, а при выполнении - интерпретацией из него в родной машинный код платформы', '2018-06-18 12:54:37', '2018-06-18 12:54:37'),
(11, 4, 0, 'Во время компиляции', '2018-06-20 12:13:57', '2018-06-20 12:13:57'),
(12, 4, 0, 'Во время связывания', '2018-06-20 12:14:09', '2018-06-20 12:14:09'),
(13, 4, 1, 'Перед компиляцией', '2018-06-20 12:14:24', '2018-06-20 12:14:58'),
(14, 4, 0, 'Сразу после начала выполнения скомпилированного приложения', '2018-06-20 12:14:52', '2018-06-20 12:14:52'),
(15, 5, 0, 'Структуры', '2018-06-20 12:20:30', '2018-06-20 12:20:30'),
(16, 5, 1, 'Классы', '2018-06-20 12:20:38', '2018-06-20 12:20:38'),
(17, 5, 0, 'Указатели', '2018-06-20 12:21:00', '2018-06-20 12:21:00'),
(18, 5, 0, 'Возможность подключать библиотеки', '2018-06-20 12:21:47', '2018-06-20 12:21:47');

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '2', 1528442662),
('user', '1', 1528442577),
('user', '3', 1528789087),
('user', '4', 1528789151),
('user', '5', 1529391153),
('user', '6', 1529393154);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'Администратор', NULL, NULL, 1528442447, 1528442447),
('user', 1, 'Пользователь', NULL, NULL, 1528442447, 1528442447);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `parentId` int(11) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parentId`, `createdAt`, `updatedAt`) VALUES
(1, 'Разработка ПО', NULL, '2018-05-11 10:50:46', '2018-05-11 10:50:46'),
(2, 'Java', 1, '2018-05-11 10:51:31', '2018-05-11 10:51:31'),
(3, 'JavaScript', 1, '2018-05-11 10:51:59', '2018-05-11 10:51:59'),
(4, 'Design', NULL, '2018-06-05 09:40:47', '2018-06-05 09:40:47'),
(5, 'Adobe Photoshop', 4, '2018-06-05 09:41:14', '2018-06-05 09:41:14'),
(6, 'Adobe Illustrator', 4, '2018-06-05 09:41:35', '2018-06-05 09:41:35'),
(7, 'C++', 1, '2018-06-18 12:44:46', '2018-06-18 12:44:46');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `testId` int(11) NOT NULL,
  `text_` text NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `testId`, `text_`, `createdAt`, `updatedAt`) VALUES
(1, 1, 'На какие группы делятся все типы данных в Java?', '2018-06-06 11:52:59', '2018-06-06 11:52:59'),
(2, 1, 'Есть ли в Java лямбда-выражения?', '2018-06-14 10:12:28', '2018-06-14 10:12:28'),
(3, 3, 'Каким образом исходные коды C++ транслируются в машинные коды платформы?', '2018-06-18 12:52:43', '2018-06-18 12:52:43'),
(4, 3, 'Когда выполняются директивы препроцессора?', '2018-06-20 12:13:39', '2018-06-20 12:13:39'),
(5, 3, 'В отличие от языка C, в C++ есть...', '2018-06-20 12:20:19', '2018-06-20 12:20:19');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `questions` int(11) NOT NULL,
  `description` text,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `categoryId`, `name`, `questions`, `description`, `createdAt`, `updatedAt`) VALUES
(1, 2, 'Java Core', 2, 'Basic Java syntax', '2018-06-05 11:45:56', '2018-06-14 10:12:28'),
(2, 2, 'JavaFx', 0, 'Java applications with GUI using JavaFx', '2018-06-05 11:46:55', '2018-06-05 11:46:55'),
(3, 7, 'Основы С++', 3, 'Типы перемнных, операторы, управляющие структуры', '2018-06-18 12:49:34', '2018-06-20 12:20:19');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'user1', '$2y$13$yvY4TuCxD4B6r5efQLhCMOTQirWBVzZshjJ6K2apjSzdq87ETTUFG', 10, 1528442577, 1528442577),
(2, 'admin', '$2y$13$Zsc3wb1iTjiL8BaY4bAUTeRJ0FmdLGqhomSnkZbN3ZewTBmECQ1Ue', 10, 1528442662, 1528442662),
(3, 'user2', '$2y$13$kAVyP42NfsykEIQYXc9uje7Olldz/5y0u3f0apogWWtYavZjtg1ZS', 10, 1528789087, 1528789087),
(4, 'user3', '$2y$13$H1kDLLj9ifKs2dSAHEt0buinWm8ypxAtWTCgCDgUhdlinX7BOh91q', 10, 1528789151, 1528789151),
(5, 'root', '$2y$13$Xnip77JNSyKm94tkJd1hfe8JPVk3DXERDi2fQADx/rxb6l7gKmA.G', 10, 1529391152, 1529391152),
(6, 'kml,k;,', '$2y$13$TeUZwRNSyGp/aQEfovlkJOlHbMsvRW.8GBxzhS.F/WqayKWcF6S7e', 10, 1529393154, 1529393154);

-- --------------------------------------------------------

--
-- Table structure for table `_migration`
--

CREATE TABLE `_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_migration`
--

INSERT INTO `_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1526021040),
('m140506_102106_rbac_init', 1528442275),
('m170730_102718_create_categories_table', 1526021041),
('m170730_103232_create_tests_table', 1526021043),
('m170730_103650_create_questions_table', 1526021044),
('m170730_103913_create_answers_table', 1526021045),
('m170730_104450_create_timestamps', 1526021049),
('m180607_080702_create_user_table', 1528442261);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answers_questionId_FK` (`questionId`);

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_parentId` (`name`,`parentId`),
  ADD KEY `categories_parentId_FK` (`parentId`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_testId_FK` (`testId`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tests_name_categoryId` (`name`,`categoryId`),
  ADD KEY `tests_categoryId_FK` (`categoryId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `_migration`
--
ALTER TABLE `_migration`
  ADD PRIMARY KEY (`version`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_questionId_FK` FOREIGN KEY (`questionId`) REFERENCES `questions` (`id`);

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parentId_FK` FOREIGN KEY (`parentId`) REFERENCES `categories` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_testId_FK` FOREIGN KEY (`testId`) REFERENCES `tests` (`id`);

--
-- Constraints for table `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `tests_categoryId_FK` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
