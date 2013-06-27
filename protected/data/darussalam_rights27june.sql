-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 27, 2013 at 08:06 PM
-- Server version: 5.5.29
-- PHP Version: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `darussalam`
--

--
-- Dumping data for table `authassignment`
--

INSERT INTO `authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('CityAdmin', '2', NULL, 'N;'),
('SuperAdmin', '1', NULL, 'N;'),
('Test role ', '2', NULL, 'N;');

--
-- Dumping data for table `authitem`
--

INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('Author.*', 0, 'Author', NULL, 'N;'),
('Author.Create', 0, NULL, NULL, 'N;'),
('Author.Delete', 0, NULL, NULL, 'N;'),
('Author.Index', 0, NULL, NULL, 'N;'),
('Author.Update', 0, NULL, NULL, 'N;'),
('Author.View', 0, NULL, NULL, 'N;'),
('Categories.*', 0, 'Categories', NULL, 'N;'),
('Categories.Create', 0, NULL, NULL, 'N;'),
('Categories.Delete', 0, NULL, NULL, 'N;'),
('Categories.Index', 0, NULL, NULL, 'N;'),
('Categories.Update', 0, NULL, NULL, 'N;'),
('Categories.View', 0, NULL, NULL, 'N;'),
('City.*', 0, 'City ', NULL, 'N;'),
('City.Create', 0, NULL, NULL, 'N;'),
('City.Delete', 0, NULL, NULL, 'N;'),
('City.Index', 0, NULL, NULL, 'N;'),
('City.Update', 0, NULL, NULL, 'N;'),
('City.View', 0, NULL, NULL, 'N;'),
('CityAdmin', 2, 'City Admin', NULL, 'N;'),
('Configurations.*', 0, 'Configurations', NULL, 'N;'),
('Configurations.AppSettings', 0, NULL, NULL, 'N;'),
('Configurations.DeleteGeneral', 0, NULL, NULL, 'N;'),
('Configurations.DeleteOther', 0, NULL, NULL, 'N;'),
('Configurations.General', 0, NULL, NULL, 'N;'),
('Configurations.Index', 0, NULL, NULL, 'N;'),
('Configurations.Load', 0, NULL, NULL, 'N;'),
('Country.*', 0, 'Country', NULL, 'N;'),
('Country.Create', 0, NULL, NULL, 'N;'),
('Country.Delete', 0, NULL, NULL, 'N;'),
('Country.Index', 0, NULL, NULL, 'N;'),
('Country.Update', 0, NULL, NULL, 'N;'),
('Country.View', 0, NULL, NULL, 'N;'),
('Customer.*', 0, 'Customer', NULL, 'N;'),
('Customer.Delete', 0, NULL, NULL, 'N;'),
('Customer.Index', 0, NULL, NULL, 'N;'),
('Customer.OrderDetail', 0, NULL, NULL, 'N;'),
('Customer.OrdersList', 0, NULL, NULL, 'N;'),
('Customer.Update', 0, NULL, NULL, 'N;'),
('Customer.View', 0, NULL, NULL, 'N;'),
('Data entry', 2, 'Data entry', NULL, 'N;'),
('Language.*', 0, 'Language', NULL, 'N;'),
('Language.Create', 0, NULL, NULL, 'N;'),
('Language.Delete', 0, NULL, NULL, 'N;'),
('Language.Index', 0, NULL, NULL, 'N;'),
('Language.Update', 0, NULL, NULL, 'N;'),
('Language.View', 0, NULL, NULL, 'N;'),
('Layout.*', 0, 'Layout', NULL, 'N;'),
('Layout.Create', 0, NULL, NULL, 'N;'),
('Layout.Delete', 0, NULL, NULL, 'N;'),
('Layout.Index', 0, NULL, NULL, 'N;'),
('Layout.Update', 0, NULL, NULL, 'N;'),
('Layout.View', 0, NULL, NULL, 'N;'),
('Order.*', 0, NULL, NULL, 'N;'),
('Order.Delete', 0, NULL, NULL, 'N;'),
('Order.Index', 0, NULL, NULL, 'N;'),
('Order.OrderDetail', 0, NULL, NULL, 'N;'),
('Order.Update', 0, NULL, NULL, 'N;'),
('Order.View', 0, NULL, NULL, 'N;'),
('Pages.*', 0, NULL, NULL, 'N;'),
('Pages.Create', 0, NULL, NULL, 'N;'),
('Pages.Delete', 0, NULL, NULL, 'N;'),
('Pages.Index', 0, NULL, NULL, 'N;'),
('Pages.Update', 0, NULL, NULL, 'N;'),
('Pages.View', 0, NULL, NULL, 'N;'),
('Product.*', 0, NULL, NULL, 'N;'),
('Product.Create', 0, NULL, NULL, 'N;'),
('Product.Delete', 0, NULL, NULL, 'N;'),
('Product.DeleteChildByAjax', 0, NULL, NULL, 'N;'),
('Product.EditChild', 0, NULL, NULL, 'N;'),
('Product.Index', 0, NULL, NULL, 'N;'),
('Product.LoadChildByAjax', 0, NULL, NULL, 'N;'),
('Product.Update', 0, NULL, NULL, 'N;'),
('Product.View', 0, NULL, NULL, 'N;'),
('Product.ViewImage', 0, NULL, NULL, 'N;'),
('SelfSite.*', 0, NULL, NULL, 'N;'),
('SelfSite.Create', 0, NULL, NULL, 'N;'),
('SelfSite.Delete', 0, NULL, NULL, 'N;'),
('SelfSite.GetCity', 0, NULL, NULL, 'N;'),
('SelfSite.Index', 0, NULL, NULL, 'N;'),
('SelfSite.Update', 0, NULL, NULL, 'N;'),
('SelfSite.View', 0, NULL, NULL, 'N;'),
('SuperAdmin', 2, 'SuperAdmin', NULL, 'N;'),
('TranslatorCompiler.*', 0, 'TranslatorCompiler', NULL, 'N;'),
('TranslatorCompiler.Create', 0, NULL, NULL, 'N;'),
('TranslatorCompiler.Delete', 0, NULL, NULL, 'N;'),
('TranslatorCompiler.Index', 0, NULL, NULL, 'N;'),
('TranslatorCompiler.Update', 0, NULL, NULL, 'N;'),
('TranslatorCompiler.View', 0, NULL, NULL, 'N;'),
('User.*', 0, 'User', NULL, 'N;'),
('User.ChangePassword', 0, NULL, NULL, 'N;'),
('User.Create', 0, NULL, NULL, 'N;'),
('User.Delete', 0, NULL, NULL, 'N;'),
('User.Index', 0, NULL, NULL, 'N;'),
('User.ToggleEnabled', 0, NULL, NULL, 'N;'),
('User.Update', 0, NULL, NULL, 'N;'),
('User.View', 0, NULL, NULL, 'N;');

--
-- Dumping data for table `authitemchild`
--

INSERT INTO `authitemchild` (`parent`, `child`) VALUES
('Author.*', 'Author.Create'),
('Author.*', 'Author.Delete'),
('Author.*', 'Author.Index'),
('Author.*', 'Author.Update'),
('Author.*', 'Author.View'),
('Author.Create', 'Author.Index'),
('Author.Delete', 'Author.Index'),
('Author.Index', 'Author.View'),
('Author.Update', 'Author.Index'),
('Categories.*', 'Categories.Create'),
('Categories.*', 'Categories.Delete'),
('Categories.*', 'Categories.Index'),
('Categories.*', 'Categories.Update'),
('Categories.*', 'Categories.View'),
('Categories.Create', 'Categories.Index'),
('Categories.Delete', 'Categories.Index'),
('Categories.Index', 'Categories.View'),
('Categories.Update', 'Categories.Index'),
('City.*', 'City.Create'),
('City.*', 'City.Delete'),
('City.*', 'City.Index'),
('City.*', 'City.Update'),
('City.*', 'City.View'),
('City.Create', 'City.Index'),
('City.Delete', 'City.Index'),
('City.Index', 'City.View'),
('City.Update', 'City.Index'),
('CityAdmin', 'Author.*'),
('CityAdmin', 'Categories.*'),
('CityAdmin', 'Configurations.DeleteOther'),
('CityAdmin', 'Configurations.Load'),
('CityAdmin', 'Customer.*'),
('CityAdmin', 'Layout.*'),
('CityAdmin', 'Order.*'),
('CityAdmin', 'Pages.*'),
('CityAdmin', 'Product.*'),
('CityAdmin', 'TranslatorCompiler.*'),
('CityAdmin', 'User.*'),
('Configurations.*', 'Configurations.DeleteGeneral'),
('Configurations.*', 'Configurations.DeleteOther'),
('Configurations.*', 'Configurations.General'),
('Configurations.*', 'Configurations.Load'),
('Configurations.DeleteGeneral', 'Configurations.General'),
('Configurations.DeleteOther', 'Configurations.Load'),
('Country.*', 'Country.Create'),
('Country.*', 'Country.Delete'),
('Country.*', 'Country.Index'),
('Country.*', 'Country.Update'),
('Country.*', 'Country.View'),
('Country.Create', 'Country.Index'),
('Country.Delete', 'Country.Index'),
('Country.Index', 'Country.View'),
('Country.Update', 'Country.Index'),
('Customer.*', 'Customer.Delete'),
('Customer.*', 'Customer.Index'),
('Customer.*', 'Customer.OrderDetail'),
('Customer.*', 'Customer.OrdersList'),
('Customer.*', 'Customer.Update'),
('Customer.*', 'Customer.View'),
('Customer.Delete', 'Customer.Index'),
('Customer.Index', 'Customer.OrderDetail'),
('Customer.Index', 'Customer.OrdersList'),
('Customer.Index', 'Customer.View'),
('Customer.Update', 'Customer.Index'),
('Data entry', 'Categories.*'),
('Language.*', 'Language.Create'),
('Language.*', 'Language.Delete'),
('Language.*', 'Language.Index'),
('Language.*', 'Language.Update'),
('Language.*', 'Language.View'),
('Language.Create', 'Language.Index'),
('Language.Delete', 'Language.Index'),
('Language.Index', 'Language.View'),
('Language.Update', 'Language.Index'),
('Layout.*', 'Layout.Create'),
('Layout.*', 'Layout.Delete'),
('Layout.*', 'Layout.Index'),
('Layout.*', 'Layout.Update'),
('Layout.*', 'Layout.View'),
('Layout.Create', 'Layout.Index'),
('Layout.Delete', 'Language.Index'),
('Layout.Index', 'Layout.View'),
('Layout.Update', 'Language.Index'),
('Order.*', 'Order.Delete'),
('Order.*', 'Order.Index'),
('Order.*', 'Order.OrderDetail'),
('Order.*', 'Order.Update'),
('Order.*', 'Order.View'),
('Order.Delete', 'Order.Index'),
('Order.Index', 'Order.OrderDetail'),
('Order.Index', 'Order.View'),
('Order.Update', 'Order.Index'),
('Pages.*', 'Pages.Create'),
('Pages.*', 'Pages.Delete'),
('Pages.*', 'Pages.Index'),
('Pages.*', 'Pages.Update'),
('Pages.*', 'Pages.View'),
('Pages.Create', 'Pages.Index'),
('Pages.Delete', 'Pages.Index'),
('Pages.Index', 'Pages.View'),
('Pages.Update', 'Pages.Index'),
('Product.*', 'Product.Create'),
('Product.*', 'Product.Delete'),
('Product.*', 'Product.DeleteChildByAjax'),
('Product.*', 'Product.EditChild'),
('Product.*', 'Product.Index'),
('Product.*', 'Product.LoadChildByAjax'),
('Product.*', 'Product.Update'),
('Product.*', 'Product.View'),
('Product.*', 'Product.ViewImage'),
('Product.Create', 'Product.Index'),
('Product.Create', 'Product.LoadChildByAjax'),
('Product.Delete', 'Product.DeleteChildByAjax'),
('Product.Delete', 'Product.Index'),
('Product.Index', 'Product.View'),
('Product.Update', 'Product.EditChild'),
('Product.Update', 'Product.Index'),
('Product.View', 'Product.ViewImage'),
('SelfSite.*', 'SelfSite.Create'),
('SelfSite.*', 'SelfSite.Delete'),
('SelfSite.*', 'SelfSite.GetCity'),
('SelfSite.*', 'SelfSite.Index'),
('SelfSite.*', 'SelfSite.Update'),
('SelfSite.*', 'SelfSite.View'),
('SelfSite.Create', 'SelfSite.GetCity'),
('SelfSite.Create', 'SelfSite.Index'),
('SelfSite.Delete', 'SelfSite.Index'),
('SelfSite.Index', 'SelfSite.View'),
('SelfSite.Update', 'SelfSite.GetCity'),
('SelfSite.Update', 'SelfSite.Index'),
('Test role ', 'Author.*'),
('Test role ', 'Categories.*'),
('Test role 2', 'Pages.*'),
('TranslatorCompiler.*', 'TranslatorCompiler.Create'),
('TranslatorCompiler.*', 'TranslatorCompiler.Delete'),
('TranslatorCompiler.*', 'TranslatorCompiler.Index'),
('TranslatorCompiler.*', 'TranslatorCompiler.Update'),
('TranslatorCompiler.*', 'TranslatorCompiler.View'),
('TranslatorCompiler.Create', 'TranslatorCompiler.Index'),
('TranslatorCompiler.Delete', 'TranslatorCompiler.Index'),
('TranslatorCompiler.Index', 'TranslatorCompiler.View'),
('TranslatorCompiler.Update', 'TranslatorCompiler.Index'),
('User.*', 'User.ChangePassword'),
('User.*', 'User.Create'),
('User.*', 'User.Delete'),
('User.*', 'User.Index'),
('User.*', 'User.ToggleEnabled'),
('User.*', 'User.Update'),
('User.*', 'User.View'),
('User.Create', 'User.Index'),
('User.Delete', 'User.Index'),
('User.Index', 'User.View'),
('User.ToggleEnabled', 'User.Index'),
('User.Update', 'User.Index'),
('User.Update', 'User.ToggleEnabled');

--
-- Dumping data for table `rights`
--

INSERT INTO `rights` (`itemname`, `type`, `weight`) VALUES
('abc', 2, 1),
('Author.*', 0, 0),
('Author.Create', 0, 1),
('Author.Delete', 0, 2),
('Author.Index', 0, 4),
('Author.Update', 0, 3),
('Author.View', 0, 5),
('Categories.*', 0, 6),
('Categories.Create', 0, 7),
('Categories.Delete', 0, 8),
('Categories.Index', 0, 10),
('Categories.Update', 0, 9),
('Categories.View', 0, 11),
('City.*', 0, 12),
('City.Create', 0, 13),
('City.Delete', 0, 14),
('City.Index', 0, 16),
('City.Update', 0, 15),
('City.View', 0, 17),
('CityAdmin', 2, 1),
('Configurations.*', 0, 18),
('Configurations.AppSettings', 0, 23),
('Configurations.DeleteGeneral', 0, 19),
('Configurations.DeleteOther', 0, 20),
('Configurations.General', 0, 21),
('Configurations.Index', 0, 24),
('Configurations.Load', 0, 22),
('Country.*', 0, 25),
('Country.Create', 0, 26),
('Country.Delete', 0, 28),
('Country.Index', 0, 29),
('Country.Update', 0, 27),
('Country.View', 0, 30),
('Customer.*', 0, 31),
('Customer.Delete', 0, 32),
('Customer.Index', 0, 34),
('Customer.OrderDetail', 0, 35),
('Customer.OrdersList', 0, 36),
('Customer.Update', 0, 33),
('Customer.View', 0, 37),
('Language.*', 0, 38),
('Language.Create', 0, 39),
('Language.Delete', 0, 40),
('Language.Index', 0, 42),
('Language.Update', 0, 41),
('Language.View', 0, 43),
('Layout.*', 0, 44),
('Layout.Create', 0, 45),
('Layout.Delete', 0, 46),
('Layout.Index', 0, 48),
('Layout.Update', 0, 47),
('Layout.View', 0, 49),
('Order.*', 0, 50),
('Order.Delete', 0, 52),
('Order.Index', 0, 53),
('Order.OrderDetail', 0, 54),
('Order.Update', 0, 51),
('Order.View', 0, 55),
('Pages.*', 0, 56),
('Pages.Create', 0, 57),
('Pages.Delete', 0, 58),
('Pages.Index', 0, 60),
('Pages.Update', 0, 59),
('Pages.View', 0, 61),
('Product.*', 0, 62),
('Product.Create', 0, 63),
('Product.Delete', 0, 65),
('Product.DeleteChildByAjax', 0, 66),
('Product.EditChild', 0, 67),
('Product.Index', 0, 69),
('Product.LoadChildByAjax', 0, 68),
('Product.Update', 0, 64),
('Product.View', 0, 70),
('Product.ViewImage', 0, 71),
('SelfSite.*', 0, 72),
('SelfSite.Create', 0, 73),
('SelfSite.Delete', 0, 75),
('SelfSite.GetCity', 0, 76),
('SelfSite.Index', 0, 77),
('SelfSite.Update', 0, 74),
('SelfSite.View', 0, 78),
('SuperAdmin', 2, 0),
('Test', 2, 1),
('Test role ', 2, 2),
('Test role 2', 2, 3),
('TranslatorCompiler.*', 0, 79),
('TranslatorCompiler.Create', 0, 80),
('TranslatorCompiler.Delete', 0, 81),
('TranslatorCompiler.Index', 0, 83),
('TranslatorCompiler.Update', 0, 82),
('TranslatorCompiler.View', 0, 84),
('User.*', 0, 85),
('User.ChangePassword', 0, 86),
('User.Create', 0, 87),
('User.Delete', 0, 89),
('User.Index', 0, 91),
('User.ToggleEnabled', 0, 90),
('User.Update', 0, 88),
('User.View', 0, 92);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
