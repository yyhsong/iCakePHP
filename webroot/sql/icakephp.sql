-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-04-02 15:22:25
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `icakephp`
--

-- --------------------------------------------------------

--
-- 表的结构 `sys_menus`
--

CREATE TABLE `sys_menus` (
  `id` int(5) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `controller` varchar(50) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `icon` varchar(50) DEFAULT 'fa fa-slack',
  `parent_id` int(5) DEFAULT NULL,
  `lft` int(4) DEFAULT NULL,
  `rght` int(4) DEFAULT NULL,
  `level` int(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sys_menus`
--

INSERT INTO `sys_menus` (`id`, `name`, `controller`, `action`, `icon`, `parent_id`, `lft`, `rght`, `level`) VALUES
(1, '系统菜单', '', '', 'fa fa-slack', NULL, 1, 10, 0),
(2, '系统管理', '', '', 'fa fa-cogs', 1, 2, 9, 1),
(3, '用户管理', 'SysUsers', 'index', 'fa fa-user', 2, 3, 4, 2),
(4, '角色管理', 'SysRoles', 'index', 'fa fa-user-plus', 2, 5, 6, 2),
(5, '菜单管理', 'SysMenus', 'index', 'fa fa-windows', 2, 7, 8, 2);

-- --------------------------------------------------------

--
-- 表的结构 `sys_roles`
--

CREATE TABLE `sys_roles` (
  `id` int(5) NOT NULL,
  `code` varchar(20) NOT NULL COMMENT '角色代码',
  `name` varchar(20) NOT NULL COMMENT '角色名称',
  `status` int(2) NOT NULL DEFAULT '1' COMMENT '启用状态'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sys_roles`
--

INSERT INTO `sys_roles` (`id`, `code`, `name`, `status`) VALUES
(1, 'Administrator', '超级管理员', 1),
(2, 'Admin', '系统管理员', 1),
(3, 'Tester', '测试人员', 1);

-- --------------------------------------------------------

--
-- 表的结构 `sys_roles_menus`
--

CREATE TABLE `sys_roles_menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `sys_role_id` int(10) NOT NULL,
  `sys_menu_id` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sys_roles_menus`
--

INSERT INTO `sys_roles_menus` (`id`, `sys_role_id`, `sys_menu_id`) VALUES
(1, 1, 2),
(2, 1, 3),
(4, 1, 5),
(5, 1, 4),
(6, 2, 2),
(7, 2, 3),
(8, 2, 4),
(9, 3, 2),
(10, 3, 3);

-- --------------------------------------------------------

--
-- 表的结构 `sys_users`
--

CREATE TABLE `sys_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `sys_role_id` int(5) NOT NULL,
  `account` varchar(20) NOT NULL,
  `pwt` varchar(255) NOT NULL,
  `realname` varchar(20) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `headpic` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sys_users`
--

INSERT INTO `sys_users` (`id`, `sys_role_id`, `account`, `pwt`, `realname`, `phone`, `status`, `headpic`, `created`, `modified`) VALUES
(1, 1, 'Neo', '$2y$10$XUaitw6yLrgiSU/CAKT3.e775SqT8G7BcFFCoZlLzfKazFk1baEWu', '尼奥', '15900000000', 1, NULL, '2018-03-26 19:22:00', '2018-04-02 10:25:00'),
(2, 2, 'Jacky', '$2y$10$0D5fGcNUfNte8xrzEgqDlOkW0oPzrHxYSdxD/XhwbphTlpE.jeHvG', '杰克', '15987654321', 1, '20180402140033857.png', '2018-03-26 19:24:00', '2018-04-02 14:05:00'),
(3, 3, 'Shelly', '$2y$10$iWN1Z4byE/vd3NJ/xlECOeOsJU/uQpLeF1aubqkAFtDun27q7iihS', '雪莉', '15912345678', 2, NULL, '2018-03-26 19:32:00', '2018-03-26 19:34:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sys_menus`
--
ALTER TABLE `sys_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_roles`
--
ALTER TABLE `sys_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_roles_menus`
--
ALTER TABLE `sys_roles_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_users`
--
ALTER TABLE `sys_users`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `sys_menus`
--
ALTER TABLE `sys_menus`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `sys_roles`
--
ALTER TABLE `sys_roles`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `sys_roles_menus`
--
ALTER TABLE `sys_roles_menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- 使用表AUTO_INCREMENT `sys_users`
--
ALTER TABLE `sys_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
