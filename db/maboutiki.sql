-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 02 Novembre 2012 à 21:29
-- Version du serveur: 5.5.27
-- Version de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `maboutiki`
--

-- --------------------------------------------------------

--
-- Structure de la table `Applications`
--

CREATE TABLE IF NOT EXISTS `Applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `description` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Extensions`
--

CREATE TABLE IF NOT EXISTS `Extensions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `description` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Keys`
--

CREATE TABLE IF NOT EXISTS `Keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `description` varchar(256) NOT NULL,
  `application_id` int(11) NOT NULL,
  `extension_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Parameters`
--

CREATE TABLE IF NOT EXISTS `Parameters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `website_id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `extension_id` int(11) NOT NULL,
  `key_id` int(11) NOT NULL,
  `value` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Softwares`
--

CREATE TABLE IF NOT EXISTS `Softwares` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `url` varchar(128) NOT NULL,
  `description` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `Softwares`
--

INSERT INTO `Softwares` (`id`, `name`, `url`, `description`) VALUES
(2, 'SCP', 'http:/scp', 'Steam'),
(3, 'Coucou', 'http://coucou', 'Coucou'),
(4, 'Nekrofage', 'http://nekrofage', 'Nekrocity'),
(5, 'Cloud', 'http://cloud.com', 'Test'),
(6, 'qsdfq', 'qsdaaaaa', 'qsqsd'),
(7, 'Cloud', 'http://cloud.com', 'Cloud'),
(8, 'Cloud', 'http://cloud.com', 'Cloud'),
(9, 'Cloud', 'http://cloud.com', 'Cloud'),
(10, 'Cloud', 'http://cloud.com', 'qsd'),
(11, 'Cloun', 'http://cloud.com', 'Cloud'),
(12, 'aze', 'aze', 'aze'),
(13, 'Mail', 'Mail155', 'Mail2');

-- --------------------------------------------------------

--
-- Structure de la table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `role` varchar(32) NOT NULL,
  `type` varchar(64) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `address1` varchar(64) NOT NULL,
  `address2` varchar(64) NOT NULL,
  `city` varchar(64) NOT NULL,
  `zipcode` varchar(64) NOT NULL,
  `state` varchar(64) NOT NULL,
  `country` varchar(64) NOT NULL,
  `phone` varchar(64) NOT NULL,
  `mobile` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `datecreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `Users`
--

INSERT INTO `Users` (`id`, `login`, `password`, `role`, `type`, `firstname`, `lastname`, `address1`, `address2`, `city`, `zipcode`, `state`, `country`, `phone`, `mobile`, `email`, `datecreation`) VALUES
(1, 'sgondouin', 'e10adc3949ba59abbe56e057f20f883e', 'admin', 'qsd', 'Samuel', 'Gondouin', 'qsd', 'qsd', 'qsd', 'qsd', 'qsd', 'qsd', 'qsd', 'qsd', 'qsd', '2012-11-01 19:31:10'),
(2, 'tstark', 'e10adc3949ba59abbe56e057f20f883e', 'user', 'Tony', 'Tony', 'Stark', 'qsd', 'qsd', 'qsd', 'qsd', 'qsd', 'qsd', 'qsd', 'qsd', 'qsd', '2012-11-01 19:31:10'),
(4, 'nfury', 'e10adc3949ba59abbe56e057f20f883e', 'user', 'a', 'Nick', 'Fury', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', '2012-11-01 19:31:10'),
(5, 'bwayne', 'e10adc3949ba59abbe56e057f20f883e', 'user', 'b', 'Bruce', 'Wayne', 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b', '2012-11-01 19:31:10');

-- --------------------------------------------------------

--
-- Structure de la table `UsersSoftwares`
--

CREATE TABLE IF NOT EXISTS `UsersSoftwares` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `softwareid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `UsersSoftwares`
--

INSERT INTO `UsersSoftwares` (`id`, `userid`, `softwareid`) VALUES
(1, 5, 11),
(2, 5, 12),
(3, 5, 13);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
