<?php
/**
 * Created by PhpStorm.
 * UserOps: Sergey Pavlov
 * Date: 01.11.2017
 * Time: 15:08
 */

namespace crudExample;


class InitSite
{

    public $sqlTables = <<<'HERE'
-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 05 2017 г., 00:50
-- Версия сервера: 5.6.37
-- Версия PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- База данных: `crudTest`
--
CREATE DATABASE IF NOT EXISTS `crudTest` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `crudTest`;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `fio` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `rights` tinyint(1) NOT NULL COMMENT '0-пользователь/1-администратор'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `fio`, `email`, `rights`) VALUES
(1, 'admin', 'password', 'Ivanov N.N', 'ivan@ivanov.ru', 1),
(2, 'user', 'password', 'Some FIO', 'test@test.ru', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `second` (`login`);

HERE;
}
