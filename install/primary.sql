-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2015 at 10:06 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `besma`
--

-- --------------------------------------------------------

--
-- Table structure for table `accgroups`
--

CREATE TABLE IF NOT EXISTS `accgroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `groupname` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `groupid` int(10) DEFAULT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `lname` text COLLATE utf8_unicode_ci NOT NULL,
  `company` text COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `address1` text COLLATE utf8_unicode_ci NOT NULL,
  `address2` text COLLATE utf8_unicode_ci,
  `state` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city` text COLLATE utf8_unicode_ci NOT NULL,
  `postcode` text COLLATE utf8_unicode_ci NOT NULL,
  `country` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datecreated` date NOT NULL,
  `email_limit` int(50) NOT NULL DEFAULT '0',
  `sms_limit` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `lastlogin` datetime DEFAULT NULL,
  `email_perm` int(1) NOT NULL DEFAULT '1',
  `sms_perm` int(1) NOT NULL DEFAULT '1',
  `online` int(1) DEFAULT '0',
  `status` enum('Active','Inactive','Closed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `pwresetkey` text COLLATE utf8_unicode_ci NOT NULL,
  `pwresetexpiry` int(10) NOT NULL,
  `emailnotify` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `email_gateway` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `sms_gateway` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `firstname_lastname` (`name`(32),`lname`(32)),
  KEY `email` (`email`(64))
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `adminperms`
--

CREATE TABLE IF NOT EXISTS `adminperms` (
  `roleid` int(1) NOT NULL,
  `permid` int(1) NOT NULL,
  KEY `roleid_permid` (`roleid`,`permid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `adminperms`
--

INSERT INTO `adminperms` (`roleid`, `permid`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 45),
(1, 46),
(1, 47),
(1, 48),
(1, 49),
(1, 50),
(1, 51),
(1, 52),
(1, 53),
(1, 54);

-- --------------------------------------------------------

--
-- Table structure for table `adminroles`
--

CREATE TABLE IF NOT EXISTS `adminroles` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `adminroles`
--

INSERT INTO `adminroles` (`id`, `name`) VALUES
(1, 'Full Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `username` text NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT '',
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `email` text NOT NULL,
  `image` text,
  `roleid` int(2) NOT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `pwresetkey` text,
  `pwresetexpiry` int(12) DEFAULT NULL,
  `emailnotify` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `online` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`(32))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `fname`, `lname`, `username`, `password`, `status`, `email`, `image`, `roleid`, `lastlogin`, `pwresetkey`, `pwresetexpiry`, `emailnotify`, `online`) VALUES
(1, 'SoftVillage', 'BD', 'admin', 'bce978ee2ec277cf7c63c4044cc3fbdc', 'Active', 'support@softvillagebd.com', '../assets/admin/profile.jpg', 1, '2015-04-29 21:21:17', NULL, NULL, 'Yes', 0);

-- --------------------------------------------------------

--
-- Table structure for table `appconfig`
--

CREATE TABLE IF NOT EXISTS `appconfig` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting` text COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `appconfig`
--

INSERT INTO `appconfig` (`id`, `setting`, `value`) VALUES
(1, 'CompanyName', 'BESMA'),
(2, 'Email', 'support@softvillagebd.com'),
(3, 'sysUrl', 'http://localhost/besma'),
(4, 'caddress', '&lt;h3&gt;&lt;b&gt;Softvillagebd LTD&lt;/b&gt;&lt;/h3&gt; House # 77 Block # 4&lt;br&gt; Road # 22,Gulshan-2&lt;br&gt; Gulshan-2&lt;br&gt; Dhaka - 1212&lt;br&gt; Bangladesh&lt;br&gt;'),
(5, 'appStage', 'Live'),
(6, 'SoftwareVersion', '1.0.5'),
(7, 'WebsiteTitle', 'Bulk Email and SMS Management Application'),
(8, 'defaultcountry', 'United States of America'),
(9, 'defaultcurrency', 'USD'),
(10, 'defaultcurrencysymbol', '$'),
(11, 'logo', '../assets/uploads/logo.png'),
(12, 'admintheme', 'besma'),
(13, 'theme', 'besma'),
(14, 'footerTxt', 'Copyright &copy; BESMA 2014-2015 All Rights Reserved'),
(15, 'BrandName', 'BESMA'),
(16, 'clientlanguage', 'English'),
(17, 'adminlanguage', 'English'),
(18, 'defaultcountrycode', 'BD'),
(19, 'email_perm', '1'),
(20, 'sms_perm', '1'),
(21, 'Client_Registration', '1');

-- --------------------------------------------------------

--
-- Table structure for table `email_logs`
--

CREATE TABLE IF NOT EXISTS `email_logs` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `subject` text COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `send_by` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `email_providers`
--

CREATE TABLE IF NOT EXISTS `email_providers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `host_name` text,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `port` text,
  `status` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `email_providers`
--

INSERT INTO `email_providers` (`id`, `name`, `host_name`, `username`, `password`, `port`, `status`) VALUES
(1, 'PHPMailer', 'smtp.gmail.com', 'Your SMTP User Name', 'Your SMTP Password', '587', 1),
(2, 'SendGrid', 'https://api.sendgrid.com/', 'User Name', 'Password', '587', 1),
(3, 'MailGun', 'smtp.mailgun.org', 'User Name', 'Password', '587', 1);

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tplname` varchar(128) NOT NULL,
  `language_id` int(11) NOT NULL DEFAULT '1',
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `send` tinyint(1) DEFAULT '1',
  `core` enum('Yes','No') DEFAULT 'Yes',
  `hidden` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`,`language_id`),
  KEY `tplname` (`tplname`(32))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `tplname`, `language_id`, `subject`, `message`, `send`, `core`, `hidden`) VALUES
(1, 'Customer SignUp', 1, 'Welcome to {{business_name}}', '<div style="margin:0;padding:0"> \n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#439cc8">\n  <tbody><tr>\n    <td align="center">\n            <table cellspacing="0" cellpadding="0" width="672" border="0">\n              <tbody><tr>\n                <td height="95" bgcolor="#439cc8" style="background:#439cc8;text-align:left">\n                <table cellspacing="0" cellpadding="0" width="672" border="0">\n                      <tbody><tr>\n                        <td width="672" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n                      </tr>\n                      <tr>\n                        <td style="text-align:left">                        \n                        <table cellspacing="0" cellpadding="0" width="672" border="0">\n                          <tbody><tr>\n                            <td width="37" height="24" style="font-size:40px;line-height:40px;height:40px;text-align:left">\n                            </td>\n                            <td width="523" height="24" style="text-align:left">\n                            <div width="125" height="23" style="display:block;color:#ffffff;font-size:20px;font-family:Arial,Helvetica,sans-serif;max-width:557px;min-height:auto">{{business_name}}</div>\n                            </td>\n                            <td width="44" style="text-align:left"></td>\n                            <td width="30" style="text-align:left"></td>\n                            <td width="38" height="24" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n                          </tr>\n                        </tbody></table>\n                        </td>\n                      </tr>\n                      <tr><td width="672" height="33" style="font-size:33px;line-height:33px;height:33px;text-align:left"></td></tr>\n                    </tbody></table>\n                \n                </td>\n              </tr>\n            </tbody></table>\n     </td>\n    </tr>\n </tbody></table>  \n  \n <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#439cc8"><tbody><tr><td height="5" style="background:#439cc8;height:5px;font-size:5px;line-height:5px"></td></tr></tbody></table>\n       \n <table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#e9eff0">\n  <tbody><tr>\n    <td align="center">\n      <table cellspacing="0" cellpadding="0" width="671" border="0" bgcolor="#e9eff0" style="background:#e9eff0">\n        <tbody><tr>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="596" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="37" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n        </tr>\n        <tr>\n          <td width="38" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n          <td style="text-align:left"><table cellspacing="0" cellpadding="0" width="596" border="0" bgcolor="#ffffff">\n            <tbody><tr>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="556" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n            </tr>\n            <tr>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="556" style="text-align:left"><table cellspacing="0" cellpadding="0" width="556" border="0" style="font-family:helvetica,arial,sans-seif;color:#666666;font-size:16px;line-height:22px">\n                <tbody><tr>\n                  <td style="text-align:left"></td>\n                </tr>\n                <tr>\n                  <td style="text-align:left"><table cellspacing="0" cellpadding="0" width="556" border="0">\n                    <tbody><tr><td style="font-family:helvetica,arial,sans-serif;font-size:30px;line-height:40px;font-weight:normal;color:#253c44;text-align:left"></td></tr>\n                    <tr><td width="556" height="20" style="font-size:20px;line-height:20px;height:20px;text-align:left"></td></tr>\n                    <tr>\n                      <td style="text-align:left">\n                 Hi {{name}},<br>\n                 <br>\n                Thanks for signing up to {{business_name}}! This message is an automated reply to your registration request. Login to your account to set up your all details by using the details below:\n            <br>\n                <a target="_blank" style="color:#ff6600;font-weight:bold;font-family:helvetica,arial,sans-seif;text-decoration:none" href="{{sys_url}}">{{sys_url}}</a>.<br>\n                                    Email: {{username}}<br>\n                                    Password: {{password}} \n            <br>\n            Regards,<br>\n            The Team at {{business_name}}<br>\n            <br>\n          </td>\n                    </tr>\n                    <tr>\n                      <td width="556" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left">&nbsp;</td>\n                    </tr>\n                  </tbody></table></td>\n                </tr>\n              </tbody></table></td>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n            </tr>\n            <tr>\n              <td width="20" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n              <td width="556" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n              <td width="20" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n            </tr>\n          </tbody></table></td>\n          <td width="37" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n        </tr>\n        <tr>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="596" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="37" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n        </tr>\n      </tbody></table>\n  </td></tr>\n</tbody>\n</table>\n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#273f47"><tbody><tr><td align="center">&nbsp;</td></tr></tbody></table>\n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#364a51">\n  <tbody><tr>\n    <td align="center">\n       <table cellspacing="0" cellpadding="0" width="672" border="0" bgcolor="#364a51">\n              <tbody><tr>\n              <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="569" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n              </tr>\n              <tr>\n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left">\n                </td>\n                <td valign="top" style="font-family:helvetica,arial,sans-seif;font-size:12px;line-height:16px;color:#949fa3;text-align:left">Copyright &copy; {{business_name}}, All rights reserved.<br><br><br></td>\n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              </tr>\n              <tr>\n              <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              <td width="569" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>              \n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              </tr>\n            </tbody></table>\n     </td>\n  </tr>\n</tbody></table><div class="yj6qo"></div><div class="adL">\n     \n</div></div>\n', 1, 'Yes', 0),
(2, 'Ticket For Customer', 1, 'New Ticket From {{business_name}}', '<div style="margin:0;padding:0"> \n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#439cc8">\n  <tbody><tr>\n    <td align="center">\n            <table cellspacing="0" cellpadding="0" width="672" border="0">\n              <tbody><tr>\n                <td height="95" bgcolor="#439cc8" style="background:#439cc8;text-align:left">\n                <table cellspacing="0" cellpadding="0" width="672" border="0">\n                      <tbody><tr>\n                        <td width="672" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n                      </tr>\n                      <tr>\n                        <td style="text-align:left">                        \n                        <table cellspacing="0" cellpadding="0" width="672" border="0">\n                          <tbody><tr>\n                            <td width="37" height="24" style="font-size:40px;line-height:40px;height:40px;text-align:left">\n                            </td>\n                            <td width="523" height="24" style="text-align:left">\n                            <div width="125" height="23" style="display:block;color:#ffffff;font-size:20px;font-family:Arial,Helvetica,sans-serif;max-width:557px;min-height:auto" >{{business_name}}</div>\n                            </td>\n                            <td width="44" style="text-align:left"></td>\n                            <td width="30" style="text-align:left"></td>\n                            <td width="38" height="24" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n                          </tr>\n                        </tbody></table>\n                        </td>\n                      </tr>\n                      <tr><td width="672" height="33" style="font-size:33px;line-height:33px;height:33px;text-align:left"></td></tr>\n                    </tbody></table>\n                \n                </td>\n              </tr>\n            </tbody></table>\n     </td>\n    </tr>\n </tbody></table>  \n  \n <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#439cc8"><tbody><tr><td height="5" style="background:#439cc8;height:5px;font-size:5px;line-height:5px"></td></tr></tbody></table>\n       \n <table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#e9eff0">\n  <tbody><tr>\n    <td align="center">\n      <table cellspacing="0" cellpadding="0" width="671" border="0" bgcolor="#e9eff0" style="background:#e9eff0">\n        <tbody><tr>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="596" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="37" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n        </tr>\n        <tr>\n          <td width="38" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n          <td style="text-align:left"><table cellspacing="0" cellpadding="0" width="596" border="0" bgcolor="#ffffff">\n            <tbody><tr>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="556" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n            </tr>\n            <tr>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="556" style="text-align:left"><table cellspacing="0" cellpadding="0" width="556" border="0" style="font-family:helvetica,arial,sans-seif;color:#666666;font-size:16px;line-height:22px">\n                <tbody><tr>\n                  <td style="text-align:left"></td>\n                </tr>\n                <tr>\n                  <td style="text-align:left"><table cellspacing="0" cellpadding="0" width="556" border="0">\n                    <tbody><tr><td style="font-family:helvetica,arial,sans-serif;font-size:30px;line-height:40px;font-weight:normal;color:#253c44;text-align:left"></td></tr>\n                    <tr><td width="556" height="20" style="font-size:20px;line-height:20px;height:20px;text-align:left"></td></tr>\n                    <tr>\n                      <td style="text-align:left">\n                 Hi {{name}},<br>\n                 <br>\n                Thank you for stay with us! This is a Support Ticket For Yours.. Login to your account to view  your support tickets details:\n            <br>\n                <a target="_blank" style="color:#ff6600;font-weight:bold;font-family:helvetica,arial,sans-seif;text-decoration:none" href="{{sys_url}}">{{sys_url}}</a>.<br>\n                Ticket ID: {{ticket_id}}<br>\n                Ticket Subject: {{ticket_subject}}<br>\n                Message: {{message}}<br>\n                Created By: {{create_by}} \n            <br>\n            Regards,<br>\n            The Team at {{business_name}}<br>\n            <br>\n          </td>\n                    </tr>\n                    <tr>\n                      <td width="556" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left">Â </td>\n                    </tr>\n                  </tbody></table></td>\n                </tr>\n              </tbody></table></td>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n            </tr>\n            <tr>\n              <td width="20" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n              <td width="556" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n              <td width="20" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n            </tr>\n          </tbody></table></td>\n          <td width="37" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n        </tr>\n        <tr>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="596" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="37" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n        </tr>\n      </tbody></table>\n  </td></tr>\n</tbody>\n</table>\n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#273f47"><tbody><tr><td align="center">Â </td></tr></tbody></table>\n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#364a51">\n  <tbody><tr>\n    <td align="center">\n       <table cellspacing="0" cellpadding="0" width="672" border="0" bgcolor="#364a51">\n              <tbody><tr>\n              <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="569" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n              </tr>\n              <tr>\n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left">\n                </td>\n                <td valign="top" style="font-family:helvetica,arial,sans-seif;font-size:12px;line-height:16px;color:#949fa3;text-align:left">Copyright Â© {{business_name}}, All rights reserved.<br><br><br></td>\n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              </tr>\n              <tr>\n              <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              <td width="569" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>              \n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              </tr>\n            </tbody></table>\n     </td>\n  </tr>\n</tbody></table><div class="yj6qo"></div><div class="adL">\n     \n</div></div>\n', 1, 'Yes', 0),
(3, 'Add New Administration', 1, 'Welcome To {{business_name}} Administration', '<div style="margin:0;padding:0"> \n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#439cc8">\n  <tbody><tr>\n    <td align="center">\n            <table cellspacing="0" cellpadding="0" width="672" border="0">\n              <tbody><tr>\n                <td height="95" bgcolor="#439cc8" style="background:#439cc8;text-align:left">\n                <table cellspacing="0" cellpadding="0" width="672" border="0">\n                      <tbody><tr>\n                        <td width="672" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n                      </tr>\n                      <tr>\n                        <td style="text-align:left">                        \n                        <table cellspacing="0" cellpadding="0" width="672" border="0">\n                          <tbody><tr>\n                            <td width="37" height="24" style="font-size:40px;line-height:40px;height:40px;text-align:left">\n                            </td>\n                            <td width="523" height="24" style="text-align:left">\n                            <p  style="display:block;color:#ffffff;font-size:20px;font-family:Arial,Helvetica,sans-serif;max-width:557px;min-height:auto" >{{business_name}}</p>\n                            </td>\n                            <td width="44" style="text-align:left"></td>\n                            <td width="30" style="text-align:left"></td>\n                            <td width="38" height="24" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n                          </tr>\n                        </tbody></table>\n                        </td>\n                      </tr>\n                      <tr><td width="672" height="33" style="font-size:33px;line-height:33px;height:33px;text-align:left"></td></tr>\n                    </tbody></table>\n                \n                </td>\n              </tr>\n            </tbody></table>\n     </td>\n    </tr>\n </tbody></table>  \n  \n <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#439cc8"><tbody><tr><td height="5" style="background:#439cc8;height:5px;font-size:5px;line-height:5px"></td></tr></tbody></table>\n       \n <table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#e9eff0">\n  <tbody><tr>\n    <td align="center">\n      <table cellspacing="0" cellpadding="0" width="671" border="0" bgcolor="#e9eff0" style="background:#e9eff0">\n        <tbody><tr>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="596" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="37" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n        </tr>\n        <tr>\n          <td width="38" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n          <td style="text-align:left"><table cellspacing="0" cellpadding="0" width="596" border="0" bgcolor="#ffffff">\n            <tbody><tr>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="556" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n            </tr>\n            <tr>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="556" style="text-align:left"><table cellspacing="0" cellpadding="0" width="556" border="0" style="font-family:helvetica,arial,sans-seif;color:#666666;font-size:16px;line-height:22px">\n                <tbody><tr>\n                  <td style="text-align:left"></td>\n                </tr>\n                <tr>\n                  <td style="text-align:left"><table cellspacing="0" cellpadding="0" width="556" border="0">\n                    <tbody><tr><td style="font-family:helvetica,arial,sans-serif;font-size:30px;line-height:40px;font-weight:normal;color:#253c44;text-align:left"></td></tr>\n                    <tr><td width="556" height="20" style="font-size:20px;line-height:20px;height:20px;text-align:left"></td></tr>\n                    <tr>\n                      <td style="text-align:left">\n                 Hi {{name}},<br>\n                 <br>\n                Welcome to {{business_name}} Administration!  This message is an automated reply to your administration registration request. Login to your account to set up your all details by using the details below:\n            <br>\n                <a target="_blank" style="color:#ff6600;font-weight:bold;font-family:helvetica,arial,sans-seif;text-decoration:none" href=" {{sys_url}}/admin"> {{sys_url}}/admin</a>.<br>\n                                    Email: {{username}}<br>\n                                    Password: {{password}} \n            <br>\n            On behalf of the {{business_name}},<br>\n            The Team at {{business_name}}<br>\n            <br>\n          </td>\n                    </tr>\n                    <tr>\n                      <td width="556" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left">&nbsp;</td>\n                    </tr>\n                  </tbody></table></td>\n                </tr>\n              </tbody></table></td>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n            </tr>\n            <tr>\n              <td width="20" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n              <td width="556" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n              <td width="20" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n            </tr>\n          </tbody></table></td>\n          <td width="37" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n        </tr>\n        <tr>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="596" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="37" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n        </tr>\n      </tbody></table>\n  </td></tr>\n</tbody>\n</table>\n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#273f47"><tbody><tr><td align="center">&nbsp;</td></tr></tbody></table>\n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#364a51">\n  <tbody><tr>\n    <td align="center">\n       <table cellspacing="0" cellpadding="0" width="672" border="0" bgcolor="#364a51">\n              <tbody><tr>\n              <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="569" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n              </tr>\n              <tr>\n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left">\n                </td>\n                <td valign="top" style="font-family:helvetica,arial,sans-seif;font-size:12px;line-height:16px;color:#949fa3;text-align:left">Copyright &copy; {{business_name}}, All rights reserved.<br><br><br></td>\n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              </tr>\n              <tr>\n              <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              <td width="569" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>              \n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              </tr>\n            </tbody></table>\n     </td>\n  </tr>\n</tbody></table><div class="yj6qo"></div><div class="adL">\n     \n</div></div>\n', 1, 'Yes', 0),
(4, 'Admin Password Reset', 1, '{{business_name}} New Password', '<div style="margin:0;padding:0"> \n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#439cc8">\n  <tbody><tr>\n    <td align="center">\n            <table cellspacing="0" cellpadding="0" width="672" border="0">\n              <tbody><tr>\n                <td height="95" bgcolor="#439cc8" style="background:#439cc8;text-align:left">\n                <table cellspacing="0" cellpadding="0" width="672" border="0">\n                      <tbody><tr>\n                        <td width="672" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n                      </tr>\n                      <tr>\n                        <td style="text-align:left">                        \n                        <table cellspacing="0" cellpadding="0" width="672" border="0">\n                          <tbody><tr>\n                            <td width="37" height="24" style="font-size:40px;line-height:40px;height:40px;text-align:left">\n                            </td>\n                            <td width="523" height="24" style="text-align:left">\n                            <p  style="display:block;color:#ffffff;font-size:20px;font-family:Arial,Helvetica,sans-serif;max-width:557px;min-height:auto">{{business_name}}</p>\n                            </td>\n                            <td width="44" style="text-align:left"></td>\n                            <td width="30" style="text-align:left"></td>\n                            <td width="38" height="24" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n                          </tr>\n                        </tbody></table>\n                        </td>\n                      </tr>\n                      <tr><td width="672" height="33" style="font-size:33px;line-height:33px;height:33px;text-align:left"></td></tr>\n                    </tbody></table>\n                \n                </td>\n              </tr>\n            </tbody></table>\n     </td>\n    </tr>\n </tbody></table>  \n  \n <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#439cc8"><tbody><tr><td height="5" style="background:#439cc8;height:5px;font-size:5px;line-height:5px"></td></tr></tbody></table>\n       \n <table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#e9eff0">\n  <tbody><tr>\n    <td align="center">\n      <table cellspacing="0" cellpadding="0" width="671" border="0" bgcolor="#e9eff0" style="background:#e9eff0">\n        <tbody><tr>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="596" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="37" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n        </tr>\n        <tr>\n          <td width="38" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n          <td style="text-align:left"><table cellspacing="0" cellpadding="0" width="596" border="0" bgcolor="#ffffff">\n            <tbody><tr>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="556" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n            </tr>\n            <tr>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="556" style="text-align:left"><table cellspacing="0" cellpadding="0" width="556" border="0" style="font-family:helvetica,arial,sans-seif;color:#666666;font-size:16px;line-height:22px">\n                <tbody><tr>\n                  <td style="text-align:left"></td>\n                </tr>\n                <tr>\n                  <td style="text-align:left"><table cellspacing="0" cellpadding="0" width="556" border="0">\n                    <tbody><tr><td style="font-family:helvetica,arial,sans-serif;font-size:30px;line-height:40px;font-weight:normal;color:#253c44;text-align:left"></td></tr>\n                    <tr><td width="556" height="20" style="font-size:20px;line-height:20px;height:20px;text-align:left"></td></tr>\n                    <tr>\n                      <td style="text-align:left">\n                 Hi {{name}},<br>\n                 <br>\n                Password Reset Successfuly!   This message is an automated reply to your password reset request. Login to your account to set up your all details by using the details below:\n            <br>\n                <a target="_blank" style="color:#ff6600;font-weight:bold;font-family:helvetica,arial,sans-seif;text-decoration:none" href=" {{sys_url}}"> {{sys_url}}</a>.<br>\n                                    User Name: {{username}}<br>\n                                    Password: {{password}} \n            <br>\n            On behalf of the {{business_name}},<br>\n            The Team at {{business_name}}<br>\n            <br>\n          </td>\n                    </tr>\n                    <tr>\n                      <td width="556" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left">&nbsp;</td>\n                    </tr>\n                  </tbody></table></td>\n                </tr>\n              </tbody></table></td>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n            </tr>\n            <tr>\n              <td width="20" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n              <td width="556" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n              <td width="20" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n            </tr>\n          </tbody></table></td>\n          <td width="37" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n        </tr>\n        <tr>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="596" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="37" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n        </tr>\n      </tbody></table>\n  </td></tr>\n</tbody>\n</table>\n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#273f47"><tbody><tr><td align="center">&nbsp;</td></tr></tbody></table>\n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#364a51">\n  <tbody><tr>\n    <td align="center">\n       <table cellspacing="0" cellpadding="0" width="672" border="0" bgcolor="#364a51">\n              <tbody><tr>\n              <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="569" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n              </tr>\n              <tr>\n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left">\n                </td>\n                <td valign="top" style="font-family:helvetica,arial,sans-seif;font-size:12px;line-height:16px;color:#949fa3;text-align:left">Copyright &copy; {{business_name}}, All rights reserved.<br><br><br></td>\n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              </tr>\n              <tr>\n              <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              <td width="569" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>              \n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              </tr>\n            </tbody></table>\n     </td>\n  </tr>\n</tbody></table><div class="yj6qo"></div><div class="adL">\n     \n</div></div>\n', 1, 'Yes', 0),
(5, 'Forgot Admin Password', 1, '{{business_name}} password change request', '<div style="margin:0;padding:0"> \n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#439cc8">\n  <tbody><tr>\n    <td align="center">\n            <table cellspacing="0" cellpadding="0" width="672" border="0">\n              <tbody><tr>\n                <td height="95" bgcolor="#439cc8" style="background:#439cc8;text-align:left">\n                <table cellspacing="0" cellpadding="0" width="672" border="0">\n                      <tbody><tr>\n                        <td width="672" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n                      </tr>\n                      <tr>\n                        <td style="text-align:left">                        \n                        <table cellspacing="0" cellpadding="0" width="672" border="0">\n                          <tbody><tr>\n                            <td width="37" height="24" style="font-size:40px;line-height:40px;height:40px;text-align:left">\n                            </td>\n                            <td width="523" height="24" style="text-align:left">\n                            <p  style="display:block;color:#ffffff;font-size:20px;font-family:Arial,Helvetica,sans-serif;max-width:557px;min-height:auto" >{{business_name}}</p>\n                            </td>\n                            <td width="44" style="text-align:left"></td>\n                            <td width="30" style="text-align:left"></td>\n                            <td width="38" height="24" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n                          </tr>\n                        </tbody></table>\n                        </td>\n                      </tr>\n                      <tr><td width="672" height="33" style="font-size:33px;line-height:33px;height:33px;text-align:left"></td></tr>\n                    </tbody></table>\n                \n                </td>\n              </tr>\n            </tbody></table>\n     </td>\n    </tr>\n </tbody></table>  \n  \n <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#439cc8"><tbody><tr><td height="5" style="background:#439cc8;height:5px;font-size:5px;line-height:5px"></td></tr></tbody></table>\n       \n <table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#e9eff0">\n  <tbody><tr>\n    <td align="center">\n      <table cellspacing="0" cellpadding="0" width="671" border="0" bgcolor="#e9eff0" style="background:#e9eff0">\n        <tbody><tr>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="596" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="37" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n        </tr>\n        <tr>\n          <td width="38" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n          <td style="text-align:left"><table cellspacing="0" cellpadding="0" width="596" border="0" bgcolor="#ffffff">\n            <tbody><tr>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="556" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n            </tr>\n            <tr>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="556" style="text-align:left"><table cellspacing="0" cellpadding="0" width="556" border="0" style="font-family:helvetica,arial,sans-seif;color:#666666;font-size:16px;line-height:22px">\n                <tbody><tr>\n                  <td style="text-align:left"></td>\n                </tr>\n                <tr>\n                  <td style="text-align:left"><table cellspacing="0" cellpadding="0" width="556" border="0">\n                    <tbody><tr><td style="font-family:helvetica,arial,sans-serif;font-size:30px;line-height:40px;font-weight:normal;color:#253c44;text-align:left"></td></tr>\n                    <tr><td width="556" height="20" style="font-size:20px;line-height:20px;height:20px;text-align:left"></td></tr>\n                    <tr>\n                      <td style="text-align:left">\n                 Hi {{name}},<br>\n                 <br>\n                Password Reset Successfuly!   This message is an automated reply to your password reset request. Click this linke to reset your password:\n            <br>\n                <a target="_blank" style="color:#ff6600;font-weight:bold;font-family:helvetica,arial,sans-seif;text-decoration:none" href=" {{forgotpw_link}} "> {{forgotpw_link}} </a>.<br>\nNotes: Until your password has been changed, your current password will remain valid. The Forgot Password Link will be available for a limited time only.\n\n            <br>\n            On behalf of the {{business_name}},<br>\n            The Team at {{business_name}}<br>\n            <br>\n          </td>\n                    </tr>\n                    <tr>\n                      <td width="556" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left">&nbsp;</td>\n                    </tr>\n                  </tbody></table></td>\n                </tr>\n              </tbody></table></td>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n            </tr>\n            <tr>\n              <td width="20" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n              <td width="556" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n              <td width="20" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n            </tr>\n          </tbody></table></td>\n          <td width="37" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n        </tr>\n        <tr>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="596" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="37" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n        </tr>\n      </tbody></table>\n  </td></tr>\n</tbody>\n</table>\n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#273f47"><tbody><tr><td align="center">&nbsp;</td></tr></tbody></table>\n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#364a51">\n  <tbody><tr>\n    <td align="center">\n       <table cellspacing="0" cellpadding="0" width="672" border="0" bgcolor="#364a51">\n              <tbody><tr>\n              <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="569" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n              </tr>\n              <tr>\n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left">\n                </td>\n                <td valign="top" style="font-family:helvetica,arial,sans-seif;font-size:12px;line-height:16px;color:#949fa3;text-align:left">Copyright &copy; {{business_name}}, All rights reserved.<br><br><br></td>\n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              </tr>\n              <tr>\n              <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              <td width="569" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>              \n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              </tr>\n            </tbody></table>\n     </td>\n  </tr>\n</tbody></table><div class="yj6qo"></div><div class="adL">\n     \n</div></div>\n', 1, 'Yes', 0);
INSERT INTO `email_templates` (`id`, `tplname`, `language_id`, `subject`, `message`, `send`, `core`, `hidden`) VALUES
(6, 'Ticket Reply', 1, 'Reply to Ticket [TID-{{ticket_id}}]', '<div style="margin:0;padding:0"> \n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#439cc8">\n  <tbody><tr>\n    <td align="center">\n            <table cellspacing="0" cellpadding="0" width="672" border="0">\n              <tbody><tr>\n                <td height="95" bgcolor="#439cc8" style="background:#439cc8;text-align:left">\n                <table cellspacing="0" cellpadding="0" width="672" border="0">\n                      <tbody><tr>\n                        <td width="672" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n                      </tr>\n                      <tr>\n                        <td style="text-align:left">                        \n                        <table cellspacing="0" cellpadding="0" width="672" border="0">\n                          <tbody><tr>\n                            <td width="37" height="24" style="font-size:40px;line-height:40px;height:40px;text-align:left">\n                            </td>\n                            <td width="523" height="24" style="text-align:left">\n                            <div width="125" height="23" style="display:block;color:#ffffff;font-size:20px;font-family:Arial,Helvetica,sans-serif;max-width:557px;min-height:auto"  {{business_name}} ></div>\n                            </td>\n                            <td width="44" style="text-align:left"></td>\n                            <td width="30" style="text-align:left"></td>\n                            <td width="38" height="24" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n                          </tr>\n                        </tbody></table>\n                        </td>\n                      </tr>\n                      <tr><td width="672" height="33" style="font-size:33px;line-height:33px;height:33px;text-align:left"></td></tr>\n                    </tbody></table>\n                \n                </td>\n              </tr>\n            </tbody></table>\n     </td>\n    </tr>\n </tbody></table>  \n  \n <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#439cc8"><tbody><tr><td height="5" style="background:#439cc8;height:5px;font-size:5px;line-height:5px"></td></tr></tbody></table>\n       \n <table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#e9eff0">\n  <tbody><tr>\n    <td align="center">\n      <table cellspacing="0" cellpadding="0" width="671" border="0" bgcolor="#e9eff0" style="background:#e9eff0">\n        <tbody><tr>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="596" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="37" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n        </tr>\n        <tr>\n          <td width="38" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n          <td style="text-align:left"><table cellspacing="0" cellpadding="0" width="596" border="0" bgcolor="#ffffff">\n            <tbody><tr>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="556" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n            </tr>\n            <tr>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="556" style="text-align:left"><table cellspacing="0" cellpadding="0" width="556" border="0" style="font-family:helvetica,arial,sans-seif;color:#666666;font-size:16px;line-height:22px">\n                <tbody><tr>\n                  <td style="text-align:left"></td>\n                </tr>\n                <tr>\n                  <td style="text-align:left"><table cellspacing="0" cellpadding="0" width="556" border="0">\n                    <tbody><tr><td style="font-family:helvetica,arial,sans-serif;font-size:30px;line-height:40px;font-weight:normal;color:#253c44;text-align:left"></td></tr>\n                    <tr><td width="556" height="20" style="font-size:20px;line-height:20px;height:20px;text-align:left"></td></tr>\n                    <tr>\n                      <td style="text-align:left">\n                 Hi {{name}},<br>\n                 <br>\n                Thank you for stay with us! This is a Support Ticket Reply. Login to your account to view  your support ticket reply details:\n            <br>\n                <a target="_blank" style="color:#ff6600;font-weight:bold;font-family:helvetica,arial,sans-seif;text-decoration:none" href="{{sys_url}}">{{sys_url}}</a>.<br>\n                Ticket ID: {{ticket_id}}<br>\n                Ticket Subject: {{ticket_subject}}<br>\n                Message: {{message}}<br>\n                Replyed By: {{reply_by}} <br><br>\n                Should you have any questions in regards to this support ticket or any other tickets related issue, please feel free to contact the Support department by creating a new ticket from your Client Portal \n            <br><br>\n            Regards,<br>\n            The Team at {{business_name}}<br>\n            <br>\n          </td>\n                    </tr>\n                    <tr>\n                      <td width="556" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left">&nbsp;</td>\n                    </tr>\n                  </tbody></table></td>\n                </tr>\n              </tbody></table></td>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n            </tr>\n            <tr>\n              <td width="20" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n              <td width="556" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n              <td width="20" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n            </tr>\n          </tbody></table></td>\n          <td width="37" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n        </tr>\n        <tr>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="596" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="37" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n        </tr>\n      </tbody></table>\n  </td></tr>\n</tbody>\n</table>\n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#273f47"><tbody><tr><td align="center">&nbsp;</td></tr></tbody></table>\n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#364a51">\n  <tbody><tr>\n    <td align="center">\n       <table cellspacing="0" cellpadding="0" width="672" border="0" bgcolor="#364a51">\n              <tbody><tr>\n              <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="569" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n              </tr>\n              <tr>\n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left">\n                </td>\n                <td valign="top" style="font-family:helvetica,arial,sans-seif;font-size:12px;line-height:16px;color:#949fa3;text-align:left">Copyright &copy; {{business_name}}, All rights reserved.<br><br><br></td>\n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              </tr>\n              <tr>\n              <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              <td width="569" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>              \n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              </tr>\n            </tbody></table>\n     </td>\n  </tr>\n</tbody></table><div class="yj6qo"></div><div class="adL">\n     \n</div></div>\n', 1, 'Yes', 0),
(7, 'Forgot Client Password', 1, '{{business_name}} password change request', '<div style="margin:0;padding:0"> \n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#439cc8">\n  <tbody><tr>\n    <td align="center">\n            <table cellspacing="0" cellpadding="0" width="672" border="0">\n              <tbody><tr>\n                <td height="95" bgcolor="#439cc8" style="background:#439cc8;text-align:left">\n                <table cellspacing="0" cellpadding="0" width="672" border="0">\n                      <tbody><tr>\n                        <td width="672" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n                      </tr>\n                      <tr>\n                        <td style="text-align:left">                        \n                        <table cellspacing="0" cellpadding="0" width="672" border="0">\n                          <tbody><tr>\n                            <td width="37" height="24" style="font-size:40px;line-height:40px;height:40px;text-align:left">\n                            </td>\n                            <td width="523" height="24" style="text-align:left">\n                            <p  style="display:block;color:#ffffff;font-size:20px;font-family:Arial,Helvetica,sans-serif;max-width:557px;min-height:auto">{{business_name}} </p>\n                            </td>\n                            <td width="44" style="text-align:left"></td>\n                            <td width="30" style="text-align:left"></td>\n                            <td width="38" height="24" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n                          </tr>\n                        </tbody></table>\n                        </td>\n                      </tr>\n                      <tr><td width="672" height="33" style="font-size:33px;line-height:33px;height:33px;text-align:left"></td></tr>\n                    </tbody></table>\n                \n                </td>\n              </tr>\n            </tbody></table>\n     </td>\n    </tr>\n </tbody></table>  \n  \n <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#439cc8"><tbody><tr><td height="5" style="background:#439cc8;height:5px;font-size:5px;line-height:5px"></td></tr></tbody></table>\n       \n <table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#e9eff0">\n  <tbody><tr>\n    <td align="center">\n      <table cellspacing="0" cellpadding="0" width="671" border="0" bgcolor="#e9eff0" style="background:#e9eff0">\n        <tbody><tr>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="596" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="37" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n        </tr>\n        <tr>\n          <td width="38" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n          <td style="text-align:left"><table cellspacing="0" cellpadding="0" width="596" border="0" bgcolor="#ffffff">\n            <tbody><tr>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="556" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n            </tr>\n            <tr>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="556" style="text-align:left"><table cellspacing="0" cellpadding="0" width="556" border="0" style="font-family:helvetica,arial,sans-seif;color:#666666;font-size:16px;line-height:22px">\n                <tbody><tr>\n                  <td style="text-align:left"></td>\n                </tr>\n                <tr>\n                  <td style="text-align:left"><table cellspacing="0" cellpadding="0" width="556" border="0">\n                    <tbody><tr><td style="font-family:helvetica,arial,sans-serif;font-size:30px;line-height:40px;font-weight:normal;color:#253c44;text-align:left"></td></tr>\n                    <tr><td width="556" height="20" style="font-size:20px;line-height:20px;height:20px;text-align:left"></td></tr>\n                    <tr>\n                      <td style="text-align:left">\n                 Hi {{name}},<br>\n                 <br>\n                Password Reset Successfuly!   This message is an automated reply to your password reset request. Click this linke to reset your password:\n            <br>\n                <a target="_blank" style="color:#ff6600;font-weight:bold;font-family:helvetica,arial,sans-seif;text-decoration:none" href=" {{forgotpw_link}} "> {{forgotpw_link}} </a>.<br>\nNotes: Until your password has been changed, your current password will remain valid. The Forgot Password Link will be available for a limited time only.\n\n            <br>\n            On behalf of the {{business_name}},<br>\n            The Team at {{business_name}}<br>\n            <br>\n          </td>\n                    </tr>\n                    <tr>\n                      <td width="556" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left">&nbsp;</td>\n                    </tr>\n                  </tbody></table></td>\n                </tr>\n              </tbody></table></td>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n            </tr>\n            <tr>\n              <td width="20" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n              <td width="556" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n              <td width="20" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n            </tr>\n          </tbody></table></td>\n          <td width="37" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n        </tr>\n        <tr>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="596" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="37" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n        </tr>\n      </tbody></table>\n  </td></tr>\n</tbody>\n</table>\n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#273f47"><tbody><tr><td align="center">&nbsp;</td></tr></tbody></table>\n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#364a51">\n  <tbody><tr>\n    <td align="center">\n       <table cellspacing="0" cellpadding="0" width="672" border="0" bgcolor="#364a51">\n              <tbody><tr>\n              <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="569" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n              </tr>\n              <tr>\n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left">\n                </td>\n                <td valign="top" style="font-family:helvetica,arial,sans-seif;font-size:12px;line-height:16px;color:#949fa3;text-align:left">Copyright &copy; {{business_name}}, All rights reserved.<br><br><br></td>\n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              </tr>\n              <tr>\n              <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              <td width="569" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>              \n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              </tr>\n            </tbody></table>\n     </td>\n  </tr>\n</tbody></table><div class="yj6qo"></div><div class="adL">\n     \n</div></div>\n', 1, 'Yes', 0),
(8, 'Client Password Reset', 1, '{{business_name}} New Password', '<div style="margin:0;padding:0"> \n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#439cc8">\n  <tbody><tr>\n    <td align="center">\n            <table cellspacing="0" cellpadding="0" width="672" border="0">\n              <tbody><tr>\n                <td height="95" bgcolor="#439cc8" style="background:#439cc8;text-align:left">\n                <table cellspacing="0" cellpadding="0" width="672" border="0">\n                      <tbody><tr>\n                        <td width="672" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n                      </tr>\n                      <tr>\n                        <td style="text-align:left">                        \n                        <table cellspacing="0" cellpadding="0" width="672" border="0">\n                          <tbody><tr>\n                            <td width="37" height="24" style="font-size:40px;line-height:40px;height:40px;text-align:left">\n                            </td>\n                            <td width="523" height="24" style="text-align:left">\n                            <p  style="display:block;color:#ffffff;font-size:20px;font-family:Arial,Helvetica,sans-serif;max-width:557px;min-height:auto" >{{business_name}}</p>\n                            </td>\n                            <td width="44" style="text-align:left"></td>\n                            <td width="30" style="text-align:left"></td>\n                            <td width="38" height="24" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n                          </tr>\n                        </tbody></table>\n                        </td>\n                      </tr>\n                      <tr><td width="672" height="33" style="font-size:33px;line-height:33px;height:33px;text-align:left"></td></tr>\n                    </tbody></table>\n                \n                </td>\n              </tr>\n            </tbody></table>\n     </td>\n    </tr>\n </tbody></table>  \n  \n <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#439cc8"><tbody><tr><td height="5" style="background:#439cc8;height:5px;font-size:5px;line-height:5px"></td></tr></tbody></table>\n       \n <table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#e9eff0">\n  <tbody><tr>\n    <td align="center">\n      <table cellspacing="0" cellpadding="0" width="671" border="0" bgcolor="#e9eff0" style="background:#e9eff0">\n        <tbody><tr>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="596" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="37" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n        </tr>\n        <tr>\n          <td width="38" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n          <td style="text-align:left"><table cellspacing="0" cellpadding="0" width="596" border="0" bgcolor="#ffffff">\n            <tbody><tr>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="556" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n            </tr>\n            <tr>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="556" style="text-align:left"><table cellspacing="0" cellpadding="0" width="556" border="0" style="font-family:helvetica,arial,sans-seif;color:#666666;font-size:16px;line-height:22px">\n                <tbody><tr>\n                  <td style="text-align:left"></td>\n                </tr>\n                <tr>\n                  <td style="text-align:left"><table cellspacing="0" cellpadding="0" width="556" border="0">\n                    <tbody><tr><td style="font-family:helvetica,arial,sans-serif;font-size:30px;line-height:40px;font-weight:normal;color:#253c44;text-align:left"></td></tr>\n                    <tr><td width="556" height="20" style="font-size:20px;line-height:20px;height:20px;text-align:left"></td></tr>\n                    <tr>\n                      <td style="text-align:left">\n                 Hi {{name}},<br>\n                 <br>\n                Password Reset Successfuly!   This message is an automated reply to your password reset request. Login to your account to set up your all details by using the details below:\n            <br>\n                <a target="_blank" style="color:#ff6600;font-weight:bold;font-family:helvetica,arial,sans-seif;text-decoration:none" href=" {{sys_url}}"> {{sys_url}}</a>.<br>\n                                    Email: {{username}}<br>\n                                    Password: {{password}} \n            <br>\n            On behalf of the {{business_name}},<br>\n            The Team at {{business_name}}<br>\n            <br>\n          </td>\n                    </tr>\n                    <tr>\n                      <td width="556" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left">&nbsp;</td>\n                    </tr>\n                  </tbody></table></td>\n                </tr>\n              </tbody></table></td>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n            </tr>\n            <tr>\n              <td width="20" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n              <td width="556" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n              <td width="20" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n            </tr>\n          </tbody></table></td>\n          <td width="37" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n        </tr>\n        <tr>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="596" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="37" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n        </tr>\n      </tbody></table>\n  </td></tr>\n</tbody>\n</table>\n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#273f47"><tbody><tr><td align="center">&nbsp;</td></tr></tbody></table>\n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#364a51">\n  <tbody><tr>\n    <td align="center">\n       <table cellspacing="0" cellpadding="0" width="672" border="0" bgcolor="#364a51">\n              <tbody><tr>\n              <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="569" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n              </tr>\n              <tr>\n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left">\n                </td>\n                <td valign="top" style="font-family:helvetica,arial,sans-seif;font-size:12px;line-height:16px;color:#949fa3;text-align:left">Copyright &copy; {{business_name}}, All rights reserved.<br><br><br></td>\n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              </tr>\n              <tr>\n              <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              <td width="569" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>              \n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              </tr>\n            </tbody></table>\n     </td>\n  </tr>\n</tbody></table><div class="yj6qo"></div><div class="adL">\n     \n</div></div>\n', 1, 'Yes', 0),
(9, 'Ticket For Admin', 1, 'New Ticket From {{business_name}} Client', '<div style="margin:0;padding:0"> \n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#439cc8">\n  <tbody><tr>\n    <td align="center">\n            <table cellspacing="0" cellpadding="0" width="672" border="0">\n              <tbody><tr>\n                <td height="95" bgcolor="#439cc8" style="background:#439cc8;text-align:left">\n                <table cellspacing="0" cellpadding="0" width="672" border="0">\n                      <tbody><tr>\n                        <td width="672" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n                      </tr>\n                      <tr>\n                        <td style="text-align:left">                        \n                        <table cellspacing="0" cellpadding="0" width="672" border="0">\n                          <tbody><tr>\n                            <td width="37" height="24" style="font-size:40px;line-height:40px;height:40px;text-align:left">\n                            </td>\n                            <td width="523" height="24" style="text-align:left">\n                            <div width="125" height="23" style="display:block;color:#ffffff;font-size:20px;font-family:Arial,Helvetica,sans-serif;max-width:557px;min-height:auto" >{{business_name}}</div>\n                            </td>\n                            <td width="44" style="text-align:left"></td>\n                            <td width="30" style="text-align:left"></td>\n                            <td width="38" height="24" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n                          </tr>\n                        </tbody></table>\n                        </td>\n                      </tr>\n                      <tr><td width="672" height="33" style="font-size:33px;line-height:33px;height:33px;text-align:left"></td></tr>\n                    </tbody></table>\n                \n                </td>\n              </tr>\n            </tbody></table>\n     </td>\n    </tr>\n </tbody></table>  \n  \n <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#439cc8"><tbody><tr><td height="5" style="background:#439cc8;height:5px;font-size:5px;line-height:5px"></td></tr></tbody></table>\n       \n <table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#e9eff0">\n  <tbody><tr>\n    <td align="center">\n      <table cellspacing="0" cellpadding="0" width="671" border="0" bgcolor="#e9eff0" style="background:#e9eff0">\n        <tbody><tr>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="596" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="37" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n        </tr>\n        <tr>\n          <td width="38" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n          <td style="text-align:left"><table cellspacing="0" cellpadding="0" width="596" border="0" bgcolor="#ffffff">\n            <tbody><tr>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="556" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n            </tr>\n            <tr>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="556" style="text-align:left"><table cellspacing="0" cellpadding="0" width="556" border="0" style="font-family:helvetica,arial,sans-seif;color:#666666;font-size:16px;line-height:22px">\n                <tbody><tr>\n                  <td style="text-align:left"></td>\n                </tr>\n                <tr>\n                  <td style="text-align:left"><table cellspacing="0" cellpadding="0" width="556" border="0">\n                    <tbody><tr><td style="font-family:helvetica,arial,sans-serif;font-size:30px;line-height:40px;font-weight:normal;color:#253c44;text-align:left"></td></tr>\n                    <tr><td width="556" height="20" style="font-size:20px;line-height:20px;height:20px;text-align:left"></td></tr>\n                    <tr>\n                      <td style="text-align:left">\n                 Hi {{name}},<br>{{department_name}},<br>\n                 <br>\n            \n                Ticket ID: {{ticket_id}}<br>\n                Ticket Subject: {{ticket_subject}}<br>\n                Message: {{message}}<br>\n                Created By: {{create_by}} <br><br>\n                Waiting for your quick response.\n            <br><br>\n            Thank you. \n            <br>\n            Regards,<br>\n            {{name}}<br>\n{{business_name}} Client. \n            <br>\n          </td>\n                    </tr>\n                    <tr>\n                      <td width="556" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left">&nbsp;</td>\n                    </tr>\n                  </tbody></table></td>\n                </tr>\n              </tbody></table></td>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n            </tr>\n            <tr>\n              <td width="20" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n              <td width="556" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n              <td width="20" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n            </tr>\n          </tbody></table></td>\n          <td width="37" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n        </tr>\n        <tr>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="596" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="37" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n        </tr>\n      </tbody></table>\n  </td></tr>\n</tbody>\n</table>\n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#273f47"><tbody><tr><td align="center">&nbsp;</td></tr></tbody></table>\n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#364a51">\n  <tbody><tr>\n    <td align="center">\n       <table cellspacing="0" cellpadding="0" width="672" border="0" bgcolor="#364a51">\n              <tbody><tr>\n              <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="569" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n              </tr>\n              <tr>\n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left">\n                </td>\n                <td valign="top" style="font-family:helvetica,arial,sans-seif;font-size:12px;line-height:16px;color:#949fa3;text-align:left">Copyright &copy; {{business_name}}, All rights reserved.<br><br><br></td>\n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              </tr>\n              <tr>\n              <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              <td width="569" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>              \n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              </tr>\n            </tbody></table>\n     </td>\n  </tr>\n</tbody></table><div class="yj6qo"></div><div class="adL">\n     \n</div></div>\n', 1, 'Yes', 0),
(10, 'Client Ticket Reply', 1, 'Reply to Ticket [TID-{{ticket_id}}]', '<div style="margin:0;padding:0"> \n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#439cc8">\n  <tbody><tr>\n    <td align="center">\n            <table cellspacing="0" cellpadding="0" width="672" border="0">\n              <tbody><tr>\n                <td height="95" bgcolor="#439cc8" style="background:#439cc8;text-align:left">\n                <table cellspacing="0" cellpadding="0" width="672" border="0">\n                      <tbody><tr>\n                        <td width="672" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n                      </tr>\n                      <tr>\n                        <td style="text-align:left">                        \n                        <table cellspacing="0" cellpadding="0" width="672" border="0">\n                          <tbody><tr>\n                            <td width="37" height="24" style="font-size:40px;line-height:40px;height:40px;text-align:left">\n                            </td>\n                            <td width="523" height="24" style="text-align:left">\n                            <div width="125" height="23" style="display:block;color:#ffffff;font-size:20px;font-family:Arial,Helvetica,sans-serif;max-width:557px;min-height:auto">{{business_name}}</div>\n                            </td>\n                            <td width="44" style="text-align:left"></td>\n                            <td width="30" style="text-align:left"></td>\n                            <td width="38" height="24" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n                          </tr>\n                        </tbody></table>\n                        </td>\n                      </tr>\n                      <tr><td width="672" height="33" style="font-size:33px;line-height:33px;height:33px;text-align:left"></td></tr>\n                    </tbody></table>\n                \n                </td>\n              </tr>\n            </tbody></table>\n     </td>\n    </tr>\n </tbody></table>  \n  \n <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#439cc8"><tbody><tr><td height="5" style="background:#439cc8;height:5px;font-size:5px;line-height:5px"></td></tr></tbody></table>\n       \n <table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#e9eff0">\n  <tbody><tr>\n    <td align="center">\n      <table cellspacing="0" cellpadding="0" width="671" border="0" bgcolor="#e9eff0" style="background:#e9eff0">\n        <tbody><tr>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="596" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="37" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n        </tr>\n        <tr>\n          <td width="38" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n          <td style="text-align:left"><table cellspacing="0" cellpadding="0" width="596" border="0" bgcolor="#ffffff">\n            <tbody><tr>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="556" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n            </tr>\n            <tr>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="556" style="text-align:left"><table cellspacing="0" cellpadding="0" width="556" border="0" style="font-family:helvetica,arial,sans-seif;color:#666666;font-size:16px;line-height:22px">\n                <tbody><tr>\n                  <td style="text-align:left"></td>\n                </tr>\n                <tr>\n                  <td style="text-align:left"><table cellspacing="0" cellpadding="0" width="556" border="0">\n                    <tbody><tr><td style="font-family:helvetica,arial,sans-serif;font-size:30px;line-height:40px;font-weight:normal;color:#253c44;text-align:left"></td></tr>\n                    <tr><td width="556" height="20" style="font-size:20px;line-height:20px;height:20px;text-align:left"></td></tr>\n                    <tr>\n                      <td style="text-align:left">\n                 Hi {{name}},<br>{{department_name}},<br>\n                 <br>\n                 This is a Support Ticket Reply From Cleint.\n            <br>\n                Ticket ID: {{ticket_id}}<br>\n                Ticket Subject: {{ticket_subject}}<br>\n                Message: {{message}}<br>\n                Replyed By: {{reply_by}}  <br><br>\n                Waiting for your quick response.\n            <br><br>\n            Thank you. \n            <br>\n            Regards,<br>\n            {{name}}<br>\n{{business_name}} Client. \n            <br>\n          </td>\n                    </tr>\n                    <tr>\n                      <td width="556" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left">&nbsp;</td>\n                    </tr>\n                  </tbody></table></td>\n                </tr>\n              </tbody></table></td>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n            </tr>\n            <tr>\n              <td width="20" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n              <td width="556" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n              <td width="20" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n            </tr>\n          </tbody></table></td>\n          <td width="37" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n        </tr>\n        <tr>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="596" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="37" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n        </tr>\n      </tbody></table>\n  </td></tr>\n</tbody>\n</table>\n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#273f47"><tbody><tr><td align="center">&nbsp;</td></tr></tbody></table>\n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#364a51">\n  <tbody><tr>\n    <td align="center">\n       <table cellspacing="0" cellpadding="0" width="672" border="0" bgcolor="#364a51">\n              <tbody><tr>\n              <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="569" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n              </tr>\n              <tr>\n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left">\n                </td>\n                <td valign="top" style="font-family:helvetica,arial,sans-seif;font-size:12px;line-height:16px;color:#949fa3;text-align:left">Copyright &copy; {{business_name}}, All rights reserved.<br><br><br></td>\n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              </tr>\n              <tr>\n              <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              <td width="569" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>              \n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              </tr>\n            </tbody></table>\n     </td>\n  </tr>\n</tbody></table><div class="yj6qo"></div><div class="adL">\n     \n</div></div>\n', 1, 'Yes', 0),
(11, 'Bulk Email Send', 1, 'Email From {{business_name}}', '{{message_body}}\r\n', 1, 'Yes', 0);
INSERT INTO `email_templates` (`id`, `tplname`, `language_id`, `subject`, `message`, `send`, `core`, `hidden`) VALUES
(12, 'Customer Invoice Created', 1, '{{business_name}} Invoice', '<div style="margin:0;padding:0"> \n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#439cc8">\n  <tbody><tr>\n    <td align="center">\n            <table cellspacing="0" cellpadding="0" width="672" border="0">\n              <tbody><tr>\n                <td height="95" bgcolor="#439cc8" style="background:#439cc8;text-align:left">\n                <table cellspacing="0" cellpadding="0" width="672" border="0">\n                      <tbody><tr>\n                        <td width="672" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n                      </tr>\n                      <tr>\n                        <td style="text-align:left">                        \n                        <table cellspacing="0" cellpadding="0" width="672" border="0">\n                          <tbody><tr>\n                            <td width="37" height="24" style="font-size:40px;line-height:40px;height:40px;text-align:left">\n                            </td>\n                            <td width="523" height="24" style="text-align:left">\n                            <div width="125" height="23" style="display:block;color:#ffffff;font-size:20px;font-family:Arial,Helvetica,sans-serif;max-width:557px;min-height:auto"   >{{business_name}}</div>\n                            </td>\n                            <td width="44" style="text-align:left"></td>\n                            <td width="30" style="text-align:left"></td>\n                            <td width="38" height="24" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n                          </tr>\n                        </tbody></table>\n                        </td>\n                      </tr>\n                      <tr><td width="672" height="33" style="font-size:33px;line-height:33px;height:33px;text-align:left"></td></tr>\n                    </tbody></table>\n                \n                </td>\n              </tr>\n            </tbody></table>\n     </td>\n    </tr>\n </tbody></table>  \n  \n <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#439cc8"><tbody><tr><td height="5" style="background:#439cc8;height:5px;font-size:5px;line-height:5px"></td></tr></tbody></table>\n       \n <table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#e9eff0">\n  <tbody><tr>\n    <td align="center">\n      <table cellspacing="0" cellpadding="0" width="671" border="0" bgcolor="#e9eff0" style="background:#e9eff0">\n        <tbody><tr>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="596" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="37" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n        </tr>\n        <tr>\n          <td width="38" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n          <td style="text-align:left"><table cellspacing="0" cellpadding="0" width="596" border="0" bgcolor="#ffffff">\n            <tbody><tr>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="556" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n            </tr>\n            <tr>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n              <td width="556" style="text-align:left"><table cellspacing="0" cellpadding="0" width="556" border="0" style="font-family:helvetica,arial,sans-seif;color:#666666;font-size:16px;line-height:22px">\n                <tbody><tr>\n                  <td style="text-align:left"></td>\n                </tr>\n                <tr>\n                  <td style="text-align:left"><table cellspacing="0" cellpadding="0" width="556" border="0">\n                    <tbody><tr><td style="font-family:helvetica,arial,sans-serif;font-size:30px;line-height:40px;font-weight:normal;color:#253c44;text-align:left"></td></tr>\n                    <tr><td width="556" height="20" style="font-size:20px;line-height:20px;height:20px;text-align:left"></td></tr>\n                    <tr>\n                      <td style="text-align:left">\n       				   Hi {{name}},<br>\n        			   <br>\n       					Thank you for stay with us! This message is an automated reply to your invoice request. Login to your account to view your invoice details.<br /><br />\n						<br>\n        				<a target="_blank" style="color:#ff6600;font-weight:bold;font-family:helvetica,arial,sans-seif;text-decoration:none" href="{{sys_url}}">{{sys_url}}</a>.<br>\n                                    Invoice ID: {{invoice_id}} <br>\n                                    Invoice Amount: {{invoice_amount}}\n						<br>\n            Should you have any questions in regards to this invoice or any other billing related issue, please feel free to contact the Billing department by creating a new ticket from your Client Portal.\n            <br><br>\n						Regards,<br>\n						The Team at {{business_name}}<br>\n						<br>\n					</td>\n                    </tr>\n                    <tr>\n                      <td width="556" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"> </td>\n                    </tr>\n                  </tbody></table></td>\n                </tr>\n              </tbody></table></td>\n              <td width="20" height="26" style="font-size:26px;line-height:26px;height:26px;text-align:left"></td>\n            </tr>\n            <tr>\n              <td width="20" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n              <td width="556" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n              <td width="20" height="2" bgcolor="#d9dfe1" style="background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left"></td>\n            </tr>\n          </tbody></table></td>\n          <td width="37" height="40" style="font-size:40px;line-height:40px;height:40px;text-align:left"></td>\n        </tr>\n        <tr>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="596" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="37" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n        </tr>\n      </tbody></table>\n  </td></tr>\n</tbody>\n</table>\n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#273f47"><tbody><tr><td align="center"> </td></tr></tbody></table>\n<table cellspacing="0" cellpadding="0" width="100%" border="0" bgcolor="#364a51">\n  <tbody><tr>\n    <td align="center">\n       <table cellspacing="0" cellpadding="0" width="672" border="0" bgcolor="#364a51">\n              <tbody><tr>\n              <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="569" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n          <td width="38" height="30" style="font-size:30px;line-height:30px;height:30px;text-align:left"></td>\n              </tr>\n              <tr>\n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left">\n                </td>\n                <td valign="top" style="font-family:helvetica,arial,sans-seif;font-size:12px;line-height:16px;color:#949fa3;text-align:left">Copyright © {{business_name}}, All rights reserved.<br><br><br></td>\n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              </tr>\n              <tr>\n              <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              <td width="569" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>              \n                <td width="38" height="40" style="font-size:40px;line-height:40px;text-align:left"></td>\n              </tr>\n            </tbody></table>\n     </td>\n  </tr>\n</tbody></table><div class="yj6qo"></div><div class="adL">\n     \n</div></div>', 1, 'Yes', 0);

-- --------------------------------------------------------

--
-- Table structure for table `email_transaction`
--

CREATE TABLE IF NOT EXISTS `email_transaction` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) NOT NULL,
  `amount` int(10) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `int_country_codes`
--

CREATE TABLE IF NOT EXISTS `int_country_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(200) DEFAULT NULL,
  `iso_code` varchar(100) DEFAULT NULL,
  `country_code` varchar(10) DEFAULT NULL,
  `tariff` float(5,2) DEFAULT '3.00',
  `active` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=212 ;

--
-- Dumping data for table `int_country_codes`
--

INSERT INTO `int_country_codes` (`id`, `country_name`, `iso_code`, `country_code`, `tariff`, `active`) VALUES
(1, 'Afghanistan', 'AF / AFG', '93', 1.00, 1),
(2, 'Albania', 'AL / ALB', '355', 1.00, 1),
(3, 'Algeria', 'DZ / DZA', '213', 1.00, 1),
(4, 'Andorra', 'AD / AND', '376', 1.00, 1),
(5, 'Angola', 'AO / AGO', '244', 1.00, 0),
(6, 'Antarctica', 'AQ / ATA', '672', 1.00, 1),
(7, 'Argentina', 'AR / ARG', '54', 1.00, 1),
(8, 'Armenia', 'AM / ARM', '374', 1.00, 1),
(9, 'Aruba', 'AW / ABW', '297', 1.00, 0),
(10, 'Australia', 'AU / AUS', '61', 1.00, 1),
(11, 'Austria', 'AT / AUT', '43', 1.00, 1),
(12, 'Azerbaijan', 'AZ / AZE', '994', 1.00, 1),
(13, 'Bahrain', 'BH / BHR', '973', 1.00, 1),
(14, 'Bangladesh', 'BD / BGD', '880', 1.00, 1),
(15, 'Belarus', 'BY / BLR', '375', 1.00, 1),
(16, 'Belgium', 'BE / BEL', '32', 1.00, 1),
(17, 'Belize', 'BZ / BLZ', '501', 1.00, 1),
(18, 'Benin', 'BJ / BEN', '229', 1.00, 1),
(19, 'Bhutan', 'BT / BTN', '975', 1.00, 1),
(20, 'Bolivia', 'BO / BOL', '591', 1.00, 1),
(21, 'Bosnia and Herzegovina', 'BA / BIH', '387', 1.00, 1),
(22, 'Botswana', 'BW / BWA', '267', 1.00, 1),
(23, 'Brazil', 'BR / BRA', '55', 1.00, 1),
(24, 'Brunei', 'BN / BRN', '673', 1.00, 1),
(25, 'Bulgaria', 'BG / BGR', '359', 1.00, 1),
(26, 'Burkina Faso', 'BF / BFA', '226', 1.00, 1),
(27, 'Burma (Myanmar)', 'MM / MMR', '95', 1.00, 1),
(28, 'Burundi', 'BI / BDI', '257', 1.00, 1),
(29, 'Cambodia', 'KH / KHM', '855', 1.00, 1),
(30, 'Cameroon', 'CM / CMR', '237', 1.00, 1),
(31, 'Canada', 'CA / CAN', '1', 1.00, 1),
(32, 'Cape Verde', 'CV / CPV', '238', 1.00, 1),
(33, 'Central African Republic', 'CF / CAF', '236', 1.00, 1),
(34, 'Chad', 'TD / TCD', '235', 1.00, 1),
(35, 'Chile', 'CL / CHL', '56', 1.00, 1),
(36, 'China', 'CN / CHN', '86', 1.00, 1),
(37, 'Christmas Island', 'CX / CXR', '61', 1.00, 1),
(38, 'Cocos (Keeling) Islands', 'CC / CCK', '61', 1.00, 1),
(39, 'Colombia', 'CO / COL', '57', 1.00, 1),
(40, 'Comoros', 'KM / COM', '269', 1.00, 1),
(41, 'Cook Islands', 'CK / COK', '682', 1.00, 1),
(42, 'Costa Rica', 'CR / CRC', '506', 1.00, 1),
(43, 'Croatia', 'HR / HRV', '385', 1.00, 1),
(44, 'Cuba', 'CU / CUB', '53', 1.00, 1),
(45, 'Cyprus', 'CY / CYP', '357', 1.00, 1),
(46, 'Czech Republic', 'CZ / CZE', '420', 1.00, 1),
(47, 'Congo', 'CD / COD', '243', 1.00, 1),
(48, 'Denmark', 'DK / DNK', '45', 1.00, 1),
(49, 'Djibouti', 'DJ / DJI', '253', 1.00, 1),
(50, 'Ecuador', 'EC / ECU', '593', 1.00, 1),
(51, 'Egypt', 'EG / EGY', '20', 1.00, 1),
(52, 'El Salvador', 'SV / SLV', '503', 1.00, 1),
(53, 'Equatorial Guinea', 'GQ / GNQ', '240', 1.00, 1),
(54, 'Eritrea', 'ER / ERI', '291', 1.00, 1),
(55, 'Estonia', 'EE / EST', '372', 1.00, 1),
(56, 'Ethiopia', 'ET / ETH', '251', 1.00, 1),
(57, 'Falkland Islands', 'FK / FLK', '500', 1.00, 1),
(58, 'Faroe Islands', 'FO / FRO', '298', 1.00, 1),
(59, 'Fiji', 'FJ / FJI', '679', 1.00, 1),
(60, 'Finland', 'FI / FIN', '358', 1.00, 1),
(61, 'France', 'FR / FRA', '33', 1.00, 1),
(62, 'French Polynesia', 'PF / PYF', '689', 1.00, 1),
(63, 'Gabon', 'GA / GAB', '241', 1.00, 1),
(64, 'Gambia', 'GM / GMB', '220', 1.00, 1),
(65, 'Gaza Strip', '/', '970', 1.00, 1),
(66, 'Georgia', 'GE / GEO', '995', 1.00, 1),
(67, 'Germany', 'DE / DEU', '49', 1.00, 1),
(68, 'Ghana', 'GH / GHA', '233', 1.00, 1),
(69, 'Gibraltar', 'GI / GIB', '350', 1.00, 1),
(70, 'Greece', 'GR / GRC', '30', 1.00, 1),
(71, 'Greenland', 'GL / GRL', '299', 1.00, 1),
(72, 'Guatemala', 'GT / GTM', '502', 1.00, 1),
(73, 'Guinea', 'GN / GIN', '224', 1.00, 1),
(74, 'Guinea-Bissau', 'GW / GNB', '245', 1.00, 1),
(75, 'Guyana', 'GY / GUY', '592', 1.00, 1),
(76, 'Haiti', 'HT / HTI', '509', 1.00, 1),
(77, 'Holy See (Vatican City)', 'VA / VAT', '39', 1.00, 1),
(78, 'Honduras', 'HN / HND', '504', 1.00, 1),
(79, 'Hong Kong', 'HK / HKG', '852', 1.00, 1),
(80, 'Hungary', 'HU / HUN', '36', 1.00, 1),
(81, 'Iceland', 'IS / IS', '354', 1.00, 1),
(82, 'India', 'IN / IND', '91', 1.00, 1),
(83, 'Indonesia', 'ID / IDN', '62', 1.00, 1),
(84, 'Iran', 'IR / IRN', '98', 1.00, 1),
(85, 'Iraq', 'IQ / IRQ', '964', 1.00, 1),
(86, 'Ireland', 'IE / IRL', '353', 1.00, 1),
(87, 'Isle of Man', 'IM / IMN', '44', 1.00, 1),
(88, 'Israel', 'IL / ISR', '972', 1.00, 1),
(89, 'Italy', 'IT / ITA', '39', 1.00, 1),
(90, 'Ivory Coast', 'CI / CIV', '225', 1.00, 1),
(91, 'Japan', 'JP / JPN', '81', 1.00, 1),
(92, 'Jordan', 'JO / JOR', '962', 1.00, 1),
(93, 'Kazakhstan', 'KZ / KAZ', '7', 1.00, 1),
(94, 'Kenya', 'KE / KEN', '254', 1.00, 1),
(95, 'Kiribati', 'KI / KIR', '686', 1.00, 1),
(96, 'Kosovo', '/', '381', 1.00, 1),
(97, 'Kuwait', 'KW / KWT', '965', 1.00, 1),
(98, 'Kyrgyzstan', 'KG / KGZ', '996', 1.00, 1),
(99, 'Laos', 'LA / LAO', '856', 1.00, 1),
(100, 'Latvia', 'LV / LVA', '371', 1.00, 1),
(101, 'Lebanon', 'LB / LBN', '961', 1.00, 1),
(102, 'Lesotho', 'LS / LSO', '266', 1.00, 1),
(103, 'Liberia', 'LR / LBR', '231', 1.00, 1),
(104, 'Libya', 'LY / LBY', '218', 1.00, 1),
(105, 'Liechtenstein', 'LI / LIE', '423', 1.00, 1),
(106, 'Lithuania', 'LT / LTU', '370', 1.00, 1),
(107, 'Luxembourg', 'LU / LUX', '352', 1.00, 1),
(108, 'Macau', 'MO / MAC', '853', 1.00, 1),
(109, 'Macedonia', 'MK / MKD', '389', 1.00, 1),
(110, 'Madagascar', 'MG / MDG', '261', 1.00, 1),
(111, 'Malawi', 'MW / MWI', '265', 1.00, 1),
(112, 'Malaysia', 'MY / MYS', '60', 1.00, 1),
(113, 'Maldives', 'MV / MDV', '960', 1.00, 1),
(114, 'Mali', 'ML / MLI', '223', 1.00, 1),
(115, 'Malta', 'MT / MLT', '356', 1.00, 1),
(116, 'Marshall Islands', 'MH / MHL', '692', 1.00, 1),
(117, 'Mauritania', 'MR / MRT', '222', 1.00, 1),
(118, 'Mauritius', 'MU / MUS', '230', 1.00, 1),
(119, 'Mayotte', 'YT / MYT', '262', 1.00, 1),
(120, 'Mexico', 'MX / MEX', '52', 1.00, 1),
(121, 'Micronesia', 'FM / FSM', '691', 1.00, 1),
(122, 'Moldova', 'MD / MDA', '373', 1.00, 1),
(123, 'Monaco', 'MC / MCO', '377', 1.00, 1),
(124, 'Mongolia', 'MN / MNG', '976', 1.00, 1),
(125, 'Montenegro', 'ME / MNE', '382', 1.00, 1),
(126, 'Morocco', 'MA / MAR', '212', 1.00, 1),
(127, 'Mozambique', 'MZ / MOZ', '258', 1.00, 1),
(128, 'Namibia', 'NA / NAM', '264', 1.00, 1),
(129, 'Nauru', 'NR / NRU', '674', 1.00, 1),
(130, 'Nepal', 'NP / NPL', '977', 1.00, 1),
(131, 'Netherlands', 'NL / NLD', '31', 1.00, 1),
(132, 'Netherlands Antilles', 'AN / ANT', '599', 1.00, 1),
(133, 'New Caledonia', 'NC / NCL', '687', 1.00, 1),
(134, 'New Zealand', 'NZ / NZL', '64', 1.00, 1),
(135, 'Nicaragua', 'NI / NIC', '505', 1.00, 1),
(136, 'Niger', 'NE / NER', '227', 1.00, 1),
(137, 'Nigeria', 'NG / NGA', '234', 1.00, 1),
(138, 'Niue', 'NU / NIU', '683', 1.00, 1),
(139, 'Norfolk Island', '/ NFK', '672', 1.00, 1),
(140, 'North Korea', 'KP / PRK', '850', 1.00, 1),
(141, 'Norway', 'NO / NOR', '47', 1.00, 1),
(142, 'Oman', 'OM / OMN', '968', 1.00, 1),
(143, 'Pakistan', 'PK / PAK', '92', 1.00, 1),
(144, 'Palau', 'PW / PLW', '680', 1.00, 1),
(145, 'Panama', 'PA / PAN', '507', 1.00, 1),
(146, 'Papua New Guinea', 'PG / PNG', '675', 1.00, 1),
(147, 'Paraguay', 'PY / PRY', '595', 1.00, 1),
(148, 'Peru', 'PE / PER', '51', 1.00, 1),
(149, 'Philippines', 'PH / PHL', '63', 1.00, 1),
(150, 'Pitcairn Islands', 'PN / PCN', '870', 1.00, 1),
(151, 'Poland', 'PL / POL', '48', 1.00, 1),
(152, 'Portugal', 'PT / PRT', '351', 1.00, 1),
(153, 'Puerto Rico', 'PR / PRI', '1', 1.00, 1),
(154, 'Qatar', 'QA / QAT', '974', 1.00, 1),
(155, 'Republic of the Congo', 'CG / COG', '242', 1.00, 1),
(156, 'Romania', 'RO / ROU', '40', 1.00, 1),
(157, 'Russia', 'RU / RUS', '7', 1.00, 1),
(158, 'Rwanda', 'RW / RWA', '250', 1.00, 1),
(159, 'Saint Barthelemy', 'BL / BLM', '590', 1.00, 1),
(160, 'Saint Helena', 'SH / SHN', '290', 1.00, 1),
(161, 'Saint Pierre and Miquelon', 'PM / SPM', '508', 1.00, 1),
(162, 'Samoa', 'WS / WSM', '685', 1.00, 1),
(163, 'San Marino', 'SM / SMR', '378', 1.00, 1),
(164, 'Sao Tome and Principe', 'ST / STP', '239', 1.00, 1),
(165, 'Saudi Arabia', 'SA / SAU', '966', 1.00, 1),
(166, 'Senegal', 'SN / SEN', '221', 1.00, 1),
(167, 'Serbia', 'RS / SRB', '381', 1.00, 1),
(168, 'Seychelles', 'SC / SYC', '248', 1.00, 1),
(169, 'Sierra Leone', 'SL / SLE', '232', 1.00, 1),
(170, 'Singapore', 'SG / SGP', '65', 1.00, 1),
(171, 'Slovakia', 'SK / SVK', '421', 1.00, 1),
(172, 'Slovenia', 'SI / SVN', '386', 1.00, 1),
(173, 'Solomon Islands', 'SB / SLB', '677', 1.00, 1),
(174, 'Somalia', 'SO / SOM', '252', 1.00, 1),
(175, 'South Africa', 'ZA / ZAF', '27', 1.00, 1),
(176, 'South Korea', 'KR / KOR', '82', 1.00, 1),
(177, 'Spain', 'ES / ESP', '34', 1.00, 1),
(178, 'Sri Lanka', 'LK / LKA', '94', 1.00, 1),
(179, 'Sudan', 'SD / SDN', '249', 1.00, 1),
(180, 'Suriname', 'SR / SUR', '597', 1.00, 1),
(181, 'Swaziland', 'SZ / SWZ', '268', 1.00, 1),
(182, 'Sweden', 'SE / SWE', '46', 1.00, 1),
(183, 'Switzerland', 'CH / CHE', '41', 1.00, 1),
(184, 'Syria', 'SY / SYR', '963', 1.00, 1),
(185, 'Taiwan', 'TW / TWN', '886', 1.00, 1),
(186, 'Tajikistan', 'TJ / TJK', '992', 1.00, 1),
(187, 'Tanzania', 'TZ / TZA', '255', 1.00, 1),
(188, 'Thailand', 'TH / THA', '66', 1.00, 1),
(189, 'Timor-Leste', 'TL / TLS', '670', 1.00, 1),
(190, 'Togo', 'TG / TGO', '228', 1.00, 1),
(191, 'Tokelau', 'TK / TKL', '690', 1.00, 1),
(192, 'Tonga', 'TO / TON', '676', 1.00, 1),
(193, 'Tunisia', 'TN / TUN', '216', 1.00, 1),
(194, 'Turkey', 'TR / TUR', '90', 1.00, 1),
(195, 'Turkmenistan', 'TM / TKM', '993', 1.00, 1),
(196, 'Tuvalu', 'TV / TUV', '688', 1.00, 1),
(197, 'Uganda', 'UG / UGA', '256', 1.00, 1),
(198, 'Ukraine', 'UA / UKR', '380', 1.00, 1),
(199, 'United Arab Emirates', 'AE / ARE', '971', 1.00, 1),
(200, 'United Kingdom', 'GB / GBR', '44', 1.00, 1),
(201, 'United States', 'US / USA', '1', 1.00, 1),
(202, 'Uruguay', 'UY / URY', '598', 1.00, 1),
(203, 'Uzbekistan', 'UZ / UZB', '998', 1.00, 1),
(204, 'Vanuatu', 'VU / VUT', '678', 1.00, 1),
(205, 'Venezuela', 'VE / VEN', '58', 1.00, 1),
(206, 'Vietnam', 'VN / VNM', '84', 1.00, 1),
(207, 'Wallis and Futuna', 'WF / WLF', '681', 1.00, 1),
(208, 'West Bank', '/', '970', 1.00, 1),
(209, 'Yemen', 'YE / YEM', '967', 1.00, 1),
(210, 'Zambia', 'ZM / ZMB', '260', 1.00, 1),
(211, 'Zimbabwe', 'ZW / ZWE', '263', 1.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoiceitems`
--

CREATE TABLE IF NOT EXISTS `invoiceitems` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cname` varchar(50) NOT NULL,
  `item` text NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `qty` int(10) DEFAULT NULL,
  `tamount` decimal(10,2) NOT NULL,
  `invoiceid` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) NOT NULL,
  `created` date DEFAULT NULL,
  `datepaid` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `subtotal` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` enum('Unpaid','Paid','Partially Paid','Cancelled') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Unpaid',
  `paymentmethod` text COLLATE utf8_unicode_ci NOT NULL,
  `tax` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(5,2) DEFAULT '0.00',
  `note` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `manage_sender`
--

CREATE TABLE IF NOT EXISTS `manage_sender` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `s_id` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `manage_sender`
--

INSERT INTO `manage_sender` (`id`, `s_id`, `status`) VALUES
(1, 'Govt', 0),
(3, 'Interpool', 0),
(4, 'Besma', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateways`
--

CREATE TABLE IF NOT EXISTS `payment_gateways` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `value` text NOT NULL,
  `settings` text NOT NULL,
  `extra_value` text,
  `status` enum('active','inactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `name`, `value`, `settings`, `extra_value`, `status`) VALUES
(1, 'Paypal', 'demo@paypal.com', 'paypal', '', 'active'),
(2, 'Stripe', 'pk_test_ARblMczqDw61NusMMs7o1RVK', 'stripe', 'sk_test_BQokikJOvBiI2HlWgH4olfQ2', 'active'),
(3, 'Bank', 'Make a Payment to Our Bank Account &lt;br&gt;Bank Name: Bank Name &lt;br&gt;Account Name: Account Holder Name &lt;br&gt;Account Number: Account Number &lt;br&gt;', 'manualpayment', '', 'active'),
(4, 'Authorize.net', 'YOUR_API_LOGIN_ID', 'authorize_net', 'YOUR_TRANSACTION_KEY', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `sms_gateway`
--

CREATE TABLE IF NOT EXISTS `sms_gateway` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `api_link` text,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `api_id` text,
  `schedule` enum('Yes','No') NOT NULL DEFAULT 'No',
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `sms_gateway`
--

INSERT INTO `sms_gateway` (`id`, `name`, `api_link`, `username`, `password`, `api_id`, `schedule`, `status`) VALUES
(1, 'Twilio', '', 'User Name', 'Auth Token', '', 'No', 'Active'),
(2, 'Clickatell', 'http://api.clickatell.com', 'turbo-smsing', 'XICEMNYNMDRDBS', '3537357', 'No', 'Active'),
(3, 'SMSKaufen', 'http://www.smskaufen.com/sms/gateway/sms.php', 'API User Name', 'SMS API Key', '', 'No', 'Active'),
(4, 'Route SMS', 'http://smsplus1.routesms.com:8080/bulksms/bulksms', 'API User Name', 'Password', '', 'No', 'Active'),
(5, 'SMSGlobal', 'http://www.smsglobal.com/http-api.php', 'API User Name', 'Password', '', 'Yes', 'Active'),
(6, 'Nexmo', 'http://rest.nexmo.com/sms/xml', '80db0526', '5beff774', '', 'No', 'Active'),
(7, 'Kapow', 'http://www.kapow.co.uk/scripts/sendsms.php', 'username', 'password', '', 'No', 'Active'),
(8, 'TelAPI', '', 'TestUser', 'Token or password', '', 'No', 'Active'),
(9, 'NibsSMS', 'http://nibssms.com/portal/apiclient', 'Email/User Name', 'User Name', '18', 'Yes', 'Active'),
(10, 'InfoBip', 'http://api.infobip.com/api/v3/sendsms/plain', 'user name', 'password', '', 'No', 'Active'),
(11, 'RANNH', 'http://rannh.com/sendsms.php', 'testuser', 'testpassword', '', 'No', 'Active'),
(12, 'CsNetworks', 'http://api.cs-networks.net', 'softvillagebd', 'shamim+rahman+97', '', 'No', 'Active'),
(13, 'Bulk SMS', 'http://bulksms.2way.co.za', 'john', 'abcd1234', NULL, 'No', 'Active'),
(14, 'SMSC', 'http://smsc.i-digital-m.com', 'user', 'password', NULL, 'No', 'Active'),
(15, 'Telenorcsms', 'https://telenorcsms.com.pk', 'xxxx', 'xxx', '', 'No', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `sms_history`
--

CREATE TABLE IF NOT EXISTS `sms_history` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) NOT NULL,
  `sender` varchar(25) NOT NULL,
  `receiver` varchar(25) NOT NULL,
  `amount` int(5) NOT NULL,
  `sms` text NOT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `report` text,
  `reqlogtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `send_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sms_plan_feature`
--

CREATE TABLE IF NOT EXISTS `sms_plan_feature` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `fvalue` varchar(50) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sms_plan_feature`
--

INSERT INTO `sms_plan_feature` (`id`, `pid`, `fname`, `fvalue`, `status`) VALUES
(1, 1, 'SMS Credit', '1000', 1),
(2, 1, '24/7 Customer Support', 'Yes', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sms_price_plan`
--

CREATE TABLE IF NOT EXISTS `sms_price_plan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `plan_name` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `popular` int(2) NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sms_price_plan`
--

INSERT INTO `sms_price_plan` (`id`, `plan_name`, `price`, `popular`, `status`) VALUES
(1, 'Popular Plan', '100.00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sms_transaction`
--

CREATE TABLE IF NOT EXISTS `sms_transaction` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) NOT NULL,
  `amount` int(10) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `supportdepartments`
--

CREATE TABLE IF NOT EXISTS `supportdepartments` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `order` int(10) NOT NULL,
  `show` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  PRIMARY KEY (`id`),
  KEY `name` (`name`(64))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `supportdepartments`
--

INSERT INTO `supportdepartments` (`id`, `name`, `email`, `order`, `show`) VALUES
(1, 'Support Department', 'support@example.com', 1, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `ticketreplies`
--

CREATE TABLE IF NOT EXISTS `ticketreplies` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tid` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `admin` text COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `tid_date` (`tid`,`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `did` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `subject` text COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Pending','Answered','Customer Reply','In Progress','Closed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  `admin` text COLLATE utf8_unicode_ci NOT NULL,
  `replyby` text COLLATE utf8_unicode_ci NOT NULL,
  `closed_by` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `status` (`status`),
  KEY `date` (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
