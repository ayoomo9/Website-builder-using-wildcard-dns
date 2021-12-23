-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 17, 2011 at 08:03 AM
-- Server version: 5.1.33
-- PHP Version: 5.2.9-2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `lava`
--

-- --------------------------------------------------------

--
-- Table structure for table `gyd_acc`
--

CREATE TABLE IF NOT EXISTS `gyd_acc` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `gid` int(100) NOT NULL DEFAULT '0',
  `fid` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_acc`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_announcements`
--

CREATE TABLE IF NOT EXISTS `gyd_announcements` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `antext` varchar(200) NOT NULL DEFAULT '',
  `clid` int(100) NOT NULL DEFAULT '0',
  `antime` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `gyd_announcements`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_avatars`
--

CREATE TABLE IF NOT EXISTS `gyd_avatars` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `avlink` varchar(150) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `avlink` (`avlink`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `gyd_avatars`
--

INSERT INTO `gyd_avatars` (`id`, `avlink`) VALUES
(1, 'avatars/1.gif'),
(2, 'avatars/2.gif'),
(3, 'avatars/3.gif'),
(4, 'avatars/4.jpg'),
(5, 'avatars/5.gif'),
(6, 'avatars/6.PNG'),
(7, 'avatars/7.gif'),
(8, 'avatars/8.gif'),
(9, 'avatars/9.gif'),
(10, 'avatars/10.gif'),
(11, 'avatars/11.gif'),
(12, 'avatars/12.gif'),
(13, 'avatars/13.gif'),
(14, 'avatars/14.jpg'),
(15, 'avatars/15.jpg'),
(16, 'avatars/16.jpg'),
(17, 'avatars/17.jpg'),
(18, 'avatars/18.jpg'),
(19, 'avatars/19.jpg'),
(20, 'avatars/20.jpg'),
(21, 'avatars/21.jpg'),
(22, 'avatars/22.jpg'),
(23, 'avatars/23.jpg'),
(24, 'avatars/24.jpg'),
(25, 'avatars/25.jpg'),
(26, 'avatars/26.jpg'),
(27, 'avatars/27.jpg'),
(28, 'avatars/28.jpg'),
(29, 'avatars/29.jpg'),
(30, 'avatars/30.jpg'),
(31, 'avatars/31.jpg'),
(32, 'avatars/32.jpg'),
(33, 'avatars/33.jpg'),
(34, 'avatars/34.jpg'),
(35, 'avatars/35.jpg'),
(36, 'avatars/36.jpg'),
(37, 'avatars/37.jpg'),
(38, 'avatars/38.jpg'),
(39, 'avatars/39.jpg'),
(40, 'avatars/40.jpg'),
(41, 'avatars/41.jpg'),
(42, 'avatars/42.jpg'),
(43, 'avatars/43.jpg'),
(44, 'avatars/44.jpg'),
(45, 'avatars/45.jpg'),
(46, 'avatars/46.jpg'),
(47, 'avatars/47.jpg'),
(48, 'avatars/48.jpg'),
(49, 'avatars/49.jpg'),
(50, 'avatars/50.jpg'),
(51, 'avatars/51.jpg'),
(52, 'avatars/52.jpg'),
(53, 'avatars/53.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `gyd_blockedsite`
--

CREATE TABLE IF NOT EXISTS `gyd_blockedsite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=280 ;

--
-- Dumping data for table `gyd_blockedsite`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_blogs`
--

CREATE TABLE IF NOT EXISTS `gyd_blogs` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `bowner` int(100) NOT NULL DEFAULT '0',
  `bname` varchar(30) NOT NULL DEFAULT '',
  `btext` blob NOT NULL,
  `bgdate` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `bname` (`bname`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `gyd_blogs`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_brate`
--

CREATE TABLE IF NOT EXISTS `gyd_brate` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `blogid` int(100) NOT NULL DEFAULT '0',
  `uid` int(100) NOT NULL DEFAULT '0',
  `brate` char(1) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `gyd_brate`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_buddies`
--

CREATE TABLE IF NOT EXISTS `gyd_buddies` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `uid` int(100) NOT NULL DEFAULT '0',
  `tid` int(100) NOT NULL DEFAULT '0',
  `agreed` char(1) NOT NULL DEFAULT '0',
  `reqdt` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1684 ;

--
-- Dumping data for table `gyd_buddies`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_cards`
--

CREATE TABLE IF NOT EXISTS `gyd_cards` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fntsz` int(5) NOT NULL DEFAULT '0',
  `xst` int(10) NOT NULL DEFAULT '0',
  `yst` int(10) NOT NULL DEFAULT '0',
  `xjp` int(10) NOT NULL DEFAULT '0',
  `yjp` int(10) NOT NULL DEFAULT '0',
  `tcolor` varchar(20) NOT NULL DEFAULT '',
  `category` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_cards`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_chat`
--

CREATE TABLE IF NOT EXISTS `gyd_chat` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `chatter` int(100) NOT NULL DEFAULT '0',
  `who` int(100) NOT NULL DEFAULT '0',
  `timesent` int(50) NOT NULL DEFAULT '0',
  `msgtext` varchar(255) NOT NULL DEFAULT '',
  `rid` int(99) NOT NULL DEFAULT '0',
  `exposed` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2464 ;

--
-- Dumping data for table `gyd_chat`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_chonline`
--

CREATE TABLE IF NOT EXISTS `gyd_chonline` (
  `lton` int(15) NOT NULL DEFAULT '0',
  `uid` int(100) NOT NULL DEFAULT '0',
  `rid` int(99) NOT NULL DEFAULT '0',
  PRIMARY KEY (`lton`),
  UNIQUE KEY `username` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gyd_chonline`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_clubmembers`
--

CREATE TABLE IF NOT EXISTS `gyd_clubmembers` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `uid` int(100) NOT NULL DEFAULT '0',
  `clid` int(100) NOT NULL DEFAULT '0',
  `accepted` char(1) NOT NULL DEFAULT '0',
  `points` int(100) NOT NULL DEFAULT '0',
  `joined` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=624 ;

--
-- Dumping data for table `gyd_clubmembers`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_clubs`
--

CREATE TABLE IF NOT EXISTS `gyd_clubs` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `owner` int(100) NOT NULL DEFAULT '0',
  `name` varchar(30) NOT NULL DEFAULT '',
  `description` varchar(200) NOT NULL DEFAULT '',
  `rules` blob NOT NULL,
  `logo` varchar(200) NOT NULL DEFAULT '',
  `plusses` int(100) NOT NULL DEFAULT '0',
  `created` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `gyd_clubs`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_comup`
--

CREATE TABLE IF NOT EXISTS `gyd_comup` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `fileid` int(11) NOT NULL DEFAULT '0',
  `commenter` int(11) NOT NULL DEFAULT '0',
  `comment` blob NOT NULL,
  `time` int(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `gyd_comup`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_counter`
--

CREATE TABLE IF NOT EXISTS `gyd_counter` (
  `id` int(5) NOT NULL DEFAULT '0',
  `visitors` int(99) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gyd_counter`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_faqs`
--

CREATE TABLE IF NOT EXISTS `gyd_faqs` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `category` varchar(10) NOT NULL DEFAULT '',
  `question` varchar(100) NOT NULL DEFAULT '',
  `answer` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_faqs`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_fcats`
--

CREATE TABLE IF NOT EXISTS `gyd_fcats` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `position` int(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_fcats`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_forums`
--

CREATE TABLE IF NOT EXISTS `gyd_forums` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  `position` int(50) NOT NULL DEFAULT '0',
  `cid` int(100) NOT NULL DEFAULT '0',
  `clubid` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=84 ;

--
-- Dumping data for table `gyd_forums`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_galcomments`
--

CREATE TABLE IF NOT EXISTS `gyd_galcomments` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `pid` int(99) NOT NULL DEFAULT '0',
  `text` varchar(200) NOT NULL DEFAULT '',
  `byuser` varchar(100) NOT NULL DEFAULT '',
  `time` varchar(99) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `text` (`text`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_galcomments`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_gallery`
--

CREATE TABLE IF NOT EXISTS `gyd_gallery` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `uid` int(100) NOT NULL DEFAULT '0',
  `sex` varchar(255) NOT NULL DEFAULT '',
  `itemurl` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`itemurl`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `gyd_gallery`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_games`
--

CREATE TABLE IF NOT EXISTS `gyd_games` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `uid` int(100) NOT NULL DEFAULT '0',
  `gvar1` varchar(30) NOT NULL DEFAULT '',
  `gvar2` varchar(30) NOT NULL DEFAULT '',
  `gvar3` varchar(30) NOT NULL DEFAULT '',
  `gvar4` varchar(30) NOT NULL DEFAULT '',
  `gvar5` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `gyd_games`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_gbook`
--

CREATE TABLE IF NOT EXISTS `gyd_gbook` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `gbowner` int(100) NOT NULL DEFAULT '0',
  `gbsigner` int(100) NOT NULL DEFAULT '0',
  `gbmsg` blob NOT NULL,
  `dtime` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `gyd_gbook`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_groups`
--

CREATE TABLE IF NOT EXISTS `gyd_groups` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `autoass` char(1) NOT NULL DEFAULT '1',
  `mage` int(10) NOT NULL DEFAULT '0',
  `userst` char(1) NOT NULL DEFAULT '0',
  `posts` int(100) NOT NULL DEFAULT '0',
  `plusses` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_groups`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_hangman`
--

CREATE TABLE IF NOT EXISTS `gyd_hangman` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `text` varchar(30) NOT NULL DEFAULT '',
  `dscr` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_hangman`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_ignore`
--

CREATE TABLE IF NOT EXISTS `gyd_ignore` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` int(99) NOT NULL DEFAULT '0',
  `target` int(99) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_ignore`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_judges`
--

CREATE TABLE IF NOT EXISTS `gyd_judges` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `uid` int(100) NOT NULL DEFAULT '0',
  `fid` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_judges`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_lastview`
--

CREATE TABLE IF NOT EXISTS `gyd_lastview` (
  `whonick` varchar(20) NOT NULL DEFAULT '',
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `lastview` varchar(20) NOT NULL DEFAULT '',
  `ltime` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`whonick`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_lastview`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_links`
--

CREATE TABLE IF NOT EXISTS `gyd_links` (
  `url` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`url`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gyd_links`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_log`
--

CREATE TABLE IF NOT EXISTS `gyd_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date` varchar(99) NOT NULL DEFAULT '',
  `text` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_mainthemes`
--

CREATE TABLE IF NOT EXISTS `gyd_mainthemes` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL DEFAULT '',
  `iconset` int(100) NOT NULL DEFAULT '0',
  `bgc` varchar(6) NOT NULL DEFAULT '',
  `txc` varchar(6) NOT NULL DEFAULT '',
  `lnk` varchar(6) NOT NULL DEFAULT '',
  `hdc` varchar(6) NOT NULL DEFAULT '',
  `hbg` varchar(6) NOT NULL DEFAULT '',
  `boxbg` varchar(6) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_mainthemes`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_mangr`
--

CREATE TABLE IF NOT EXISTS `gyd_mangr` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `uid` int(100) NOT NULL DEFAULT '0',
  `gid` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_mangr`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_married`
--

CREATE TABLE IF NOT EXISTS `gyd_married` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `frmuid` int(11) NOT NULL DEFAULT '0',
  `touid` int(11) NOT NULL DEFAULT '0',
  `agreed` char(1) NOT NULL DEFAULT '0',
  `refused` char(1) NOT NULL DEFAULT '0',
  `complete` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=317 ;

--
-- Dumping data for table `gyd_married`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_meragochi`
--

CREATE TABLE IF NOT EXISTS `gyd_meragochi` (
  `uid` int(10) NOT NULL DEFAULT '0',
  `rodjen` int(20) NOT NULL DEFAULT '0',
  `tezina` int(10) NOT NULL DEFAULT '0',
  `ime` varchar(30) NOT NULL DEFAULT '',
  `ziv` int(1) NOT NULL DEFAULT '0',
  `nahranjen` int(20) NOT NULL DEFAULT '0',
  `boja` varchar(15) NOT NULL DEFAULT '',
  `igra` int(20) NOT NULL DEFAULT '0',
  `kupanje` int(20) NOT NULL DEFAULT '0',
  `smrt` int(20) NOT NULL DEFAULT '0',
  `raspolozenje` int(2) NOT NULL DEFAULT '5',
  `broj` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gyd_meragochi`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_misc`
--

CREATE TABLE IF NOT EXISTS `gyd_misc` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `dscr` varchar(200) NOT NULL DEFAULT '',
  `text` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_misc`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_mlog`
--

CREATE TABLE IF NOT EXISTS `gyd_mlog` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `action` varchar(10) NOT NULL DEFAULT '',
  `details` blob NOT NULL,
  `actdt` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22871 ;

--
-- Dumping data for table `gyd_mlog`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_mms`
--

CREATE TABLE IF NOT EXISTS `gyd_mms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pmtext` blob NOT NULL,
  `byuid` int(11) NOT NULL DEFAULT '0',
  `touid` int(11) NOT NULL DEFAULT '0',
  `unread` char(1) NOT NULL DEFAULT '',
  `timesent` int(100) NOT NULL DEFAULT '0',
  `starred` char(1) NOT NULL DEFAULT '',
  `reported` char(1) NOT NULL DEFAULT '',
  `filename` varchar(15) NOT NULL DEFAULT '',
  `extension` varchar(5) NOT NULL DEFAULT '',
  `size` int(11) NOT NULL DEFAULT '0',
  `origname` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `gyd_mms`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_mobile_carrier`
--

CREATE TABLE IF NOT EXISTS `gyd_mobile_carrier` (
  `time` int(11) NOT NULL DEFAULT '0',
  `ip_min` varchar(50) NOT NULL DEFAULT '',
  `ip_max` varchar(50) NOT NULL DEFAULT '',
  `num_min` bigint(30) NOT NULL DEFAULT '9223372036854775807',
  `num_max` bigint(30) NOT NULL DEFAULT '0',
  `country` varchar(5) NOT NULL DEFAULT '',
  `cc` char(2) NOT NULL DEFAULT '',
  `network` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`num_min`),
  UNIQUE KEY `ip_min` (`ip_min`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gyd_mobile_carrier`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_modr`
--

CREATE TABLE IF NOT EXISTS `gyd_modr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` int(100) NOT NULL DEFAULT '0',
  `forum` varchar(99) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_modr`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_moods`
--

CREATE TABLE IF NOT EXISTS `gyd_moods` (
  `id` int(99) NOT NULL AUTO_INCREMENT,
  `text` varchar(10) NOT NULL DEFAULT '',
  `img` varchar(100) NOT NULL DEFAULT '',
  `dscr` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `gyd_moods`
--

INSERT INTO `gyd_moods` (`id`, `text`, `img`, `dscr`) VALUES
(1, '[:-(]', 'moods/angry.gif', 'Angry'),
(2, '[:D]', 'moods/happy.gif', 'big grin'),
(3, '[:?]', 'moods/confused.gif', 'Confused'),
(4, '[8)]', 'moods/cool.gif', 'Cool'),
(5, '[=P]', 'moods/disgust.gif', 'Disgusts/ like yeah whatever'),
(6, '[:*]', 'moods/nasty.gif', 'Nasty/Drools'),
(7, '[>:)]', 'moods/evil.gif', 'Evil'),
(8, '[:/]', 'moods/careless.gif', 'Careless/Angry/Disappointed'),
(9, '[:(]', 'moods/sad.gif', 'Sad'),
(10, '[~:(]', 'moods/grr.gif', 'GRRR/Angry /Mad'),
(11, '[:8)]', 'moods/shy.gif', 'Shy/redface/blushing'),
(12, '[:O]', 'moods/retard.gif', 'Retard/eek/going huh'),
(13, '[:)]', 'moods/smile.gif', 'Smiling/Happy'),
(14, '[:,(]', 'moods/cry.gif', 'Crying'),
(15, '[x-(]', 'moods/dead.gif', 'Dead'),
(16, '[=D]', 'moods/happy.gif', 'Happy'),
(17, '[8(,]', 'moods/sick.gif', 'Sick/ Tired/ Sour'),
(18, '[3(]', 'moods/sleep.gif', 'Sleeping / Sleepy'),
(19, '[(:(]', 'moods/sorry.gif', 'Sorry');

-- --------------------------------------------------------

--
-- Table structure for table `gyd_mpot`
--

CREATE TABLE IF NOT EXISTS `gyd_mpot` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ddt` varchar(20) NOT NULL DEFAULT '',
  `dtm` varchar(20) NOT NULL DEFAULT '',
  `ppl` int(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=333 ;

--
-- Dumping data for table `gyd_mpot`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_mypage`
--

CREATE TABLE IF NOT EXISTS `gyd_mypage` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `uid` int(100) NOT NULL DEFAULT '0',
  `mimg` varchar(200) NOT NULL DEFAULT '',
  `thid` int(100) NOT NULL DEFAULT '1',
  `msg` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_mypage`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_network`
--

CREATE TABLE IF NOT EXISTS `gyd_network` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `subone` text NOT NULL,
  `subtwo` text NOT NULL,
  `isp` text NOT NULL,
  `country` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_network`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_nicks`
--

CREATE TABLE IF NOT EXISTS `gyd_nicks` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `nicklvl` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_nicks`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_online`
--

CREATE TABLE IF NOT EXISTS `gyd_online` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(100) NOT NULL DEFAULT '0',
  `actvtime` int(100) NOT NULL DEFAULT '0',
  `place` varchar(50) NOT NULL DEFAULT '',
  `placedet` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_online`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_polls`
--

CREATE TABLE IF NOT EXISTS `gyd_polls` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `pqst` varchar(255) NOT NULL DEFAULT '',
  `opt1` varchar(100) NOT NULL DEFAULT '',
  `opt2` varchar(100) NOT NULL DEFAULT '',
  `opt3` varchar(100) NOT NULL DEFAULT '',
  `opt4` varchar(100) NOT NULL DEFAULT '',
  `opt5` varchar(100) NOT NULL DEFAULT '',
  `pdt` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `gyd_polls`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_popups`
--

CREATE TABLE IF NOT EXISTS `gyd_popups` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `text` blob NOT NULL,
  `byuid` int(100) NOT NULL DEFAULT '0',
  `touid` int(100) NOT NULL DEFAULT '0',
  `unread` char(1) NOT NULL DEFAULT '1',
  `timesent` int(100) NOT NULL DEFAULT '0',
  `reported` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100 ;

--
-- Dumping data for table `gyd_popups`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_posts`
--

CREATE TABLE IF NOT EXISTS `gyd_posts` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `text` blob NOT NULL,
  `tid` int(100) NOT NULL DEFAULT '0',
  `uid` int(100) NOT NULL DEFAULT '0',
  `dtpost` int(100) NOT NULL DEFAULT '0',
  `reported` char(1) NOT NULL DEFAULT '0',
  `quote` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13217 ;

--
-- Dumping data for table `gyd_posts`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_pp_gbook`
--

CREATE TABLE IF NOT EXISTS `gyd_pp_gbook` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `uid` int(100) NOT NULL DEFAULT '0',
  `sname` varchar(15) NOT NULL DEFAULT '',
  `semail` varchar(100) NOT NULL DEFAULT '',
  `stext` text NOT NULL,
  `sdate` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_pp_gbook`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_pp_pres`
--

CREATE TABLE IF NOT EXISTS `gyd_pp_pres` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `pid` int(100) NOT NULL DEFAULT '0',
  `ans` int(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_pp_pres`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_prate`
--

CREATE TABLE IF NOT EXISTS `gyd_prate` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `pid` int(100) NOT NULL DEFAULT '0',
  `uid` int(100) NOT NULL DEFAULT '0',
  `prate` char(1) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_prate`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_presults`
--

CREATE TABLE IF NOT EXISTS `gyd_presults` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `pid` int(100) NOT NULL DEFAULT '0',
  `uid` int(100) NOT NULL DEFAULT '0',
  `ans` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_presults`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_private`
--

CREATE TABLE IF NOT EXISTS `gyd_private` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `text` blob NOT NULL,
  `byuid` int(100) NOT NULL DEFAULT '0',
  `touid` int(100) NOT NULL DEFAULT '0',
  `unread` char(1) NOT NULL DEFAULT '1',
  `timesent` int(100) NOT NULL DEFAULT '0',
  `starred` char(1) NOT NULL DEFAULT '0',
  `reported` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=90407 ;

--
-- Dumping data for table `gyd_private`
--

INSERT INTO `gyd_private` (`id`, `text`, `byuid`, `touid`, `unread`, `timesent`, `starred`, `reported`) VALUES
(90406, 0x596f752075736572206163636f756e74206973206e6f772076616c69646174656428616374697665292c20796f752063616e206e6f7720656e6a6f7920616c6c20746865206e696365206665617475726573206f6e20776170626965732e636f6d20776974686f757420616e79206c696d69742e205468616e6b7321, 194, 0, '1', 1310882625, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `gyd_private_folders`
--

CREATE TABLE IF NOT EXISTS `gyd_private_folders` (
  `folderid` int(100) NOT NULL AUTO_INCREMENT,
  `uid` int(100) NOT NULL DEFAULT '0',
  `foldername` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`folderid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_private_folders`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_pur`
--

CREATE TABLE IF NOT EXISTS `gyd_pur` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(100) NOT NULL DEFAULT '0',
  `penalty` char(1) NOT NULL DEFAULT '0',
  `exid` int(100) NOT NULL DEFAULT '0',
  `timeto` int(100) NOT NULL DEFAULT '0',
  `pnreas` varchar(100) NOT NULL DEFAULT '',
  `ipadd` varchar(30) NOT NULL DEFAULT '',
  `browserm` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_pur`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_rooms`
--

CREATE TABLE IF NOT EXISTS `gyd_rooms` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `pass` varchar(100) NOT NULL DEFAULT '',
  `static` char(1) NOT NULL DEFAULT '',
  `mage` int(10) NOT NULL DEFAULT '0',
  `chposts` int(100) NOT NULL DEFAULT '0',
  `perms` int(10) NOT NULL DEFAULT '0',
  `censord` char(1) NOT NULL DEFAULT '1',
  `freaky` char(1) NOT NULL DEFAULT '0',
  `lastmsg` int(100) NOT NULL DEFAULT '0',
  `clubid` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_rooms`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_search`
--

CREATE TABLE IF NOT EXISTS `gyd_search` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `svar1` varchar(50) NOT NULL DEFAULT '',
  `svar2` varchar(50) NOT NULL DEFAULT '',
  `svar3` varchar(50) NOT NULL DEFAULT '',
  `svar4` varchar(50) NOT NULL DEFAULT '',
  `svar5` varchar(50) NOT NULL DEFAULT '',
  `stime` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_search`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_ses`
--

CREATE TABLE IF NOT EXISTS `gyd_ses` (
  `id` varchar(100) NOT NULL DEFAULT '',
  `uid` varchar(30) NOT NULL DEFAULT '',
  `expiretm` int(100) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gyd_ses`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_settings`
--

CREATE TABLE IF NOT EXISTS `gyd_settings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `value` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `gyd_settings`
--

INSERT INTO `gyd_settings` (`id`, `name`, `value`) VALUES
(1, 'sesexp', '30'),
(2, 'Wed 05 Jul 2006 - 22:01', '167'),
(3, '4ummsg', '- wapbies- Express your mind with your loved ones only @ wapbies.com!'),
(4, 'Counter', '2686490'),
(5, 'pmaf', '2'),
(6, 'reg', '1'),
(7, 'fview', '0'),
(8, 'lastbpm', '2011-07-17'),
(9, 'sitename', ''),
(10, 'vldtn', '1');

-- --------------------------------------------------------

--
-- Table structure for table `gyd_shouts`
--

CREATE TABLE IF NOT EXISTS `gyd_shouts` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `shout` varchar(200) NOT NULL,
  `shouter` int(100) NOT NULL DEFAULT '0',
  `shtime` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_shouts`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_sites`
--

CREATE TABLE IF NOT EXISTS `gyd_sites` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sitename` varchar(30) NOT NULL DEFAULT '',
  `cid` int(10) NOT NULL DEFAULT '0',
  `sitelink` varchar(200) NOT NULL DEFAULT '',
  `slogo` varchar(200) NOT NULL DEFAULT '',
  `uid` int(10) NOT NULL DEFAULT '0',
  `hin` int(10) NOT NULL DEFAULT '0',
  `hout` int(10) NOT NULL DEFAULT '0',
  `dhits` int(10) NOT NULL DEFAULT '0',
  `thits` int(12) NOT NULL DEFAULT '0',
  `banned` int(5) NOT NULL DEFAULT '0',
  `dscr` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `sitelink` (`sitelink`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_sites`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_smilies`
--

CREATE TABLE IF NOT EXISTS `gyd_smilies` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `scode` varchar(15) NOT NULL DEFAULT '',
  `imgsrc` varchar(200) NOT NULL DEFAULT '',
  `hidden` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `scode` (`scode`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1001 ;

--
-- Dumping data for table `gyd_smilies`
--

INSERT INTO `gyd_smilies` (`id`, `scode`, `imgsrc`, `hidden`) VALUES
(62, '(police)', 'smilies/police.gif', '0'),
(2, '(angry)', 'smilies/angry.gif', '0'),
(78, '(what)', 'smilies/what.gif', '0'),
(90, '(wave)', 'smilies/wave.gif', '0'),
(99, '(Sour)', 'smilies/sour.gif', '0'),
(7, '(backstab)', 'smilies/backstab.gif', '0'),
(8, '(grin)', 'smilies/grin.gif', '0'),
(9, '(badidea)', 'smilies/badidea.gif', '0'),
(10, '(blowkiss)', 'smilies/blowkiss.gif', '0'),
(11, '(boast)', 'smilies/boast.gif', '0'),
(100, '(smartass)', 'smilies/smartass.gif', '0'),
(14, '(bounce)', 'smilies/bounce.gif', '0'),
(15, '(clap)', 'smilies/clap.gif', '0'),
(108, '(spiteful)', 'smilies/spiteful.gif', '0'),
(17, '(crazy)', 'smilies/crazy.gif', '0'),
(19, '(dance)', 'smilies/dance.gif', '0'),
(109, '(sorry)', 'smilies/sorry.gif', '0'),
(21, '(devil)', 'smilies/devil.gif', '0'),
(22, '(dizzy)', 'smilies/dizzy.gif', '0'),
(140, '(sucks)', 'smilies/sucks.gif', '0'),
(144, '(stir)', 'smilies/stir.gif', '0'),
(145, '(skip)', 'smilies/skip.gif', '0'),
(147, '(smoke)', 'smilies/smoke.gif', '0'),
(28, '(friends)', 'smilies/friends.gif', '0'),
(149, '(snoozer)', 'smilies/snoozer_09.gif', '0'),
(30, '(getout)', 'smilies/getout.gif', '0'),
(70, '(up)', 'smilies/up.gif', '0'),
(32, '(giveheart)', 'smilies/giveheart.gif', '0'),
(33, '(haha)', 'smilies/haha.gif', '0'),
(34, '(heart)', 'smilies/heart.gif', '0'),
(36, '(hehe)', 'smilies/hehe.gif', '0'),
(59, '(shout)', 'smilies/shout.gif', '0'),
(38, '(hi)', 'smilies/hi.gif', '0'),
(39, '(hifive)', 'smilies/hifive.gif', '0'),
(189, '(shsh)', 'smilies/shsh.gif', '0'),
(102, '(read)', 'smilies/read.gif', '0'),
(43, '(king)', 'smilies/king.gif', '0'),
(44, '(kiss)', 'smilies/kiss.gif', '0'),
(201, '(rap)', 'smilies/rap.gif', '0'),
(202, '(rain)', 'smilies/rain.gif', '0'),
(101, '(reading)', 'smilies/reading.gif', '0'),
(49, '(mwah)', 'smilies/mwah.gif', '0'),
(50, '(nod)', 'smilies/nod.gif', '0'),
(51, '(nono)', 'smilies/nono.gif', '0'),
(204, '(oops)', 'smilies/oops.gif', '0'),
(53, '(poke)', 'smilies/poke.gif', '0'),
(400, '(clapping)', 'smilies/clapping.gif', '0'),
(56, '(punch)', 'smilies/punch.gif', '0'),
(57, '(queen)', 'smilies/queen.gif', '0'),
(402, '(2stupid)', 'smilies/2stupid.gif', '0'),
(60, '(secret)', 'smilies/secret.gif', '0'),
(61, '(slap)', 'smilies/slap.gif', '0'),
(401, '(banana)', 'smilies/banana.gif', '0'),
(63, '(smooch)', 'smilies/smooch.gif', '0'),
(205, '(ok)', 'smilies/ok.gif', '0'),
(207, '(nokiss)', 'smilies/nokiss.gif', '0'),
(300, '(kill)', 'smilies/kill.gif', '0'),
(68, '(spy)', 'smilies/spy.gif', '0'),
(301, '(iluvu)', 'smilies/iluvu.gif', '0'),
(302, '(lol)', 'smilies/lol.gif', '0'),
(303, '(missu)', 'smilies/missu.gif', '0'),
(73, '(tea)', 'smilies/tea.gif', '0'),
(304, '(mad)', 'smilies/mad.gif', '0'),
(305, '(huh)', 'smilies/huh.gif', '0'),
(77, '(wakeup)', 'smilies/wakeup.gif', '0'),
(309, '(cool)', 'smilies/cool.gif', '0'),
(306, '(hungry)', 'smilies/hungry.gif', '0'),
(307, '(gun)', 'smilies/gun.gif', '0'),
(308, '(diablo)', 'smilies/diablo.gif', '0'),
(404, '(4k)', 'smilies/4k.jpeg', '0'),
(405, '(2guns)', 'smilies/2guns.gif', '0'),
(406, '(ashamed)', 'smilies/ashamed.gif', '0'),
(407, '(advices)', 'smilies/advices.gif', '0'),
(408, '(chainsaw)', 'smilies/chainsaw.gif', '0'),
(409, '(c_ya)', 'smilies/c_ya.gif', '0'),
(410, '(blabla)', 'smilies/blabla.gif', '0'),
(500, '(delete)', 'smilies/delete.gif', '0'),
(503, '(daydream)', 'smilies/daydream.gif', '0'),
(504, '(feminist)', 'smilies/feminist.gif', '0'),
(505, '(fool)', 'smilies/fool.gif', '0'),
(506, '(hacker)', 'smilies/hacker.gif', '0'),
(507, '(idol)', 'smilies/idol.gif', '0'),
(508, '(music)', 'smilies/music.gif', '0'),
(509, '(bdance)', 'smilies/bdance.gif', '0'),
(513, '(ayoomo9)', 'smilies/ayoomo9.gif', '0'),
(514, '(ghost)', 'smilies/ghost.gif', '0'),
(519, '(hey)', 'smilies/hey.gif', '0'),
(934, '(man_in_love)', 'smilies/man_in_love.gif', '0'),
(935, '(littleangel)', 'smilies/littleangel.gif', '0'),
(936, '(loveu)', 'smilies/loveu.gif', '0'),
(937, '(liar)', 'smilies/liar.gif', '0'),
(938, '(nunu)', 'smilies/nunu.gif', '0'),
(939, '(nyah)', 'smilies/nyah.gif', '0'),
(941, '(ouch)', 'smilies/ouch.gif', '0'),
(997, '(victory)', 'smilies/victory.gif', '0'),
(998, '(wild)', 'smilies/wild.gif', '0'),
(999, '(yawn)', 'smilies/yawn.gif', '0'),
(943, '(play)', 'smilies/play.gif', '0'),
(944, '(proud)', 'smilies/proud.gif', '0'),
(945, '(punch00)', 'smilies/punch00.gif', '0'),
(946, '(punchbag)', 'smilies/punchbag.gif', '0'),
(947, '(r_huh)', 'smilies/r_huh.gif', '0'),
(948, '(rcpokeass)', 'smilies/rcpokeass.gif', '0'),
(949, '(revolt)', 'smilies/revolt.gif', '0'),
(950, '(sleepy)', 'smilies/sleepy.gif', '0'),
(957, '(angelx)', 'smilies/angelx.gif', '0'),
(958, '(woried)', 'smilies/woried.jpeg', '0'),
(959, '(alien)', 'smilies/alien.gif', '0'),
(960, '(argu)', 'smilies/argu.gif', '0'),
(961, '(xlips)', 'smilies/xlips.gif', '0'),
(962, '(xfight)', 'smilies/xfight.gif', '0'),
(963, '(xbye)', 'smilies/xbye.gif', '0'),
(964, '(worship)', 'smilies/worship.jpeg', '0'),
(965, '(tool)', 'smilies/tool.gif', '0'),
(966, '(thumbsup)', 'smilies/thumbsup.gif', '0'),
(955, '(beee)', 'smilies/beee.gif', '0'),
(956, '(bones)', 'smilies/bones.gif', '0'),
(967, '(lol2)', 'smilies/lol2.gif', '0'),
(968, '(taunt)', 'smilies/taunt.gif', '0'),
(953, '(begging)', 'smilies/begging.gif', '0'),
(995, '(stupid)', 'smilies/stupid.gif', '0'),
(1000, '(yourmum)', 'smilies/yourmum.gif', '0');

-- --------------------------------------------------------

--
-- Table structure for table `gyd_themes`
--

CREATE TABLE IF NOT EXISTS `gyd_themes` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL DEFAULT '',
  `bgc` varchar(6) NOT NULL DEFAULT '',
  `txc` varchar(6) NOT NULL DEFAULT '',
  `lnk` varchar(6) NOT NULL DEFAULT '',
  `hdc` varchar(6) NOT NULL DEFAULT '',
  `hbg` varchar(6) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_themes`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_topics`
--

CREATE TABLE IF NOT EXISTS `gyd_topics` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `fid` int(100) NOT NULL DEFAULT '0',
  `authorid` int(100) NOT NULL DEFAULT '0',
  `text` blob NOT NULL,
  `pinned` char(1) NOT NULL DEFAULT '0',
  `closed` char(1) NOT NULL DEFAULT '0',
  `crdate` int(100) NOT NULL DEFAULT '0',
  `views` int(100) NOT NULL DEFAULT '0',
  `reported` char(1) NOT NULL DEFAULT '0',
  `lastpost` int(100) NOT NULL DEFAULT '0',
  `moved` char(1) NOT NULL DEFAULT '0',
  `pollid` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_topics`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_tusers`
--

CREATE TABLE IF NOT EXISTS `gyd_tusers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `pass` varchar(60) NOT NULL DEFAULT '',
  `admin` int(5) NOT NULL DEFAULT '0',
  `banned` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_tusers`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_uploads`
--

CREATE TABLE IF NOT EXISTS `gyd_uploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `filename` text NOT NULL,
  `date` varchar(100) NOT NULL DEFAULT '',
  `filesize` text NOT NULL,
  `uip` varchar(20) NOT NULL DEFAULT '',
  `device` varchar(150) NOT NULL DEFAULT '',
  `number` varchar(100) NOT NULL DEFAULT '',
  `mime` varchar(10) DEFAULT NULL,
  `dcount` int(11) DEFAULT '0',
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_uploads`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_usergallery`
--

CREATE TABLE IF NOT EXISTS `gyd_usergallery` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `uid` int(100) NOT NULL DEFAULT '0',
  `imageurl` varchar(100) NOT NULL DEFAULT '',
  `sex` char(1) NOT NULL DEFAULT '',
  `time` int(100) NOT NULL DEFAULT '0',
  `descript` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_usergallery`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_usergallery_rating`
--

CREATE TABLE IF NOT EXISTS `gyd_usergallery_rating` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `imageid` int(100) NOT NULL DEFAULT '0',
  `rating` int(100) NOT NULL DEFAULT '0',
  `comments` varchar(250) NOT NULL DEFAULT '',
  `commentsreply` varchar(250) NOT NULL DEFAULT '',
  `byuid` int(100) NOT NULL DEFAULT '0',
  `time` int(100) NOT NULL DEFAULT '0',
  `commentsyn` char(1) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_usergallery_rating`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_users`
--

CREATE TABLE IF NOT EXISTS `gyd_users` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `pass` varchar(60) NOT NULL DEFAULT '',
  `pass2` varchar(50) NOT NULL DEFAULT '',
  `birthday` varchar(50) NOT NULL DEFAULT '',
  `sex` char(1) NOT NULL DEFAULT '',
  `relstatus` varchar(100) NOT NULL DEFAULT '',
  `location` varchar(100) NOT NULL DEFAULT '',
  `theme` varchar(100) NOT NULL DEFAULT 'default.css',
  `showshout` int(100) NOT NULL DEFAULT '1',
  `showshortkey` int(100) NOT NULL DEFAULT '0',
  `ase` char(1) NOT NULL DEFAULT '0',
  `plusses` int(100) NOT NULL DEFAULT '0',
  `posts` int(6) NOT NULL DEFAULT '0',
  `totin` int(100) NOT NULL DEFAULT '0',
  `totout` int(100) NOT NULL DEFAULT '0',
  `buds` int(100) NOT NULL DEFAULT '0',
  `visit` varchar(255) NOT NULL DEFAULT '0',
  `ua` varchar(150) NOT NULL DEFAULT '',
  `ip` varchar(40) NOT NULL DEFAULT '',
  `signature` varchar(100) NOT NULL DEFAULT '',
  `avatar` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `site` varchar(50) NOT NULL DEFAULT '',
  `referby` varchar(50) NOT NULL DEFAULT '',
  `browserm` varchar(50) NOT NULL DEFAULT '',
  `ipadd` varchar(30) NOT NULL DEFAULT '',
  `lastact` int(100) NOT NULL DEFAULT '0',
  `regdate` int(100) NOT NULL DEFAULT '0',
  `chmsgs` int(100) NOT NULL DEFAULT '0',
  `chmood` int(100) NOT NULL DEFAULT '0',
  `shield` char(1) NOT NULL DEFAULT '0',
  `gplus` int(100) NOT NULL DEFAULT '0',
  `budmsg` varchar(100) NOT NULL DEFAULT '',
  `lastpnreas` varchar(100) NOT NULL DEFAULT '',
  `lastplreas` varchar(100) NOT NULL DEFAULT '',
  `shouts` int(100) NOT NULL DEFAULT '0',
  `pollid` int(100) NOT NULL DEFAULT '0',
  `rbcid` varchar(255) NOT NULL DEFAULT '',
  `hvia` char(1) NOT NULL DEFAULT '1',
  `lastvst` int(100) NOT NULL DEFAULT '0',
  `battlep` int(100) NOT NULL DEFAULT '0',
  `likes` blob NOT NULL,
  `hates` blob NOT NULL,
  `ms` char(1) NOT NULL DEFAULT 'S',
  `rname` varchar(40) NOT NULL DEFAULT '',
  `ppp` int(3) NOT NULL DEFAULT '10',
  `alert` int(1) NOT NULL DEFAULT '0',
  `profvws` int(100) NOT NULL DEFAULT '0',
  `tottimeonl` int(100) NOT NULL DEFAULT '0',
  `hidden` int(1) NOT NULL DEFAULT '0',
  `forumb` int(1) DEFAULT '0',
  `shoutb` int(1) DEFAULT '0',
  `inboxb` int(1) DEFAULT '0',
  `popuppm` int(100) NOT NULL DEFAULT '0',
  `pmood` varchar(100) NOT NULL DEFAULT '',
  `language` int(1) NOT NULL DEFAULT '0',
  `bwins` varchar(100) NOT NULL DEFAULT '0',
  `bloss` int(100) NOT NULL DEFAULT '0',
  `bcrew` varchar(100) NOT NULL DEFAULT '',
  `spinned` varchar(10) NOT NULL DEFAULT '0',
  `hit` varchar(5) NOT NULL DEFAULT '',
  `health` varchar(5) NOT NULL DEFAULT '',
  `accept` varchar(5) NOT NULL DEFAULT '',
  `activate` char(2) NOT NULL DEFAULT '',
  `spintime` varchar(10) NOT NULL DEFAULT '',
  `validated` char(1) NOT NULL DEFAULT '0',
  `bank` int(11) NOT NULL DEFAULT '0',
  `onlinedone` int(100) NOT NULL DEFAULT '0',
  `resetime` int(100) NOT NULL DEFAULT '0',
  `onlinetime` int(100) NOT NULL DEFAULT '0',
  `cards` varchar(10) NOT NULL DEFAULT '',
  `otime` int(11) NOT NULL DEFAULT '0',
  `fontsize` tinyint(1) NOT NULL DEFAULT '2',
  `tttw` int(11) NOT NULL DEFAULT '0',
  `tttl` int(11) NOT NULL DEFAULT '0',
  `emailon` char(1) NOT NULL DEFAULT '',
  `icons` varchar(11) NOT NULL DEFAULT '',
  `imgon` tinyint(1) NOT NULL DEFAULT '0',
  `emlalerton` int(1) NOT NULL DEFAULT '0',
  `galon` int(1) NOT NULL DEFAULT '1',
  `bdayon` int(1) NOT NULL DEFAULT '1',
  `tusron` int(1) NOT NULL DEFAULT '1',
  `sboxon` int(1) NOT NULL DEFAULT '1',
  `haveon` int(1) NOT NULL DEFAULT '1',
  `lateston` int(1) NOT NULL DEFAULT '1',
  `tz` int(2) NOT NULL DEFAULT '1',
  `shoutsize` int(1) NOT NULL DEFAULT '0',
  `dead` varchar(255) NOT NULL DEFAULT '1',
  `killer` varchar(255) NOT NULL DEFAULT '',
  `numberattck` bigint(20) NOT NULL DEFAULT '0',
  `justattacked` int(4) NOT NULL DEFAULT '0',
  `honor` int(11) NOT NULL DEFAULT '0',
  `realname` varchar(100) NOT NULL DEFAULT '',
  `lastreg` bigint(3) NOT NULL DEFAULT '0',
  `gold` bigint(20) NOT NULL DEFAULT '0',
  `land` bigint(20) NOT NULL DEFAULT '0',
  `offarmy` bigint(20) NOT NULL DEFAULT '0',
  `dffarmy` bigint(6) NOT NULL DEFAULT '0',
  `numturns` bigint(1) NOT NULL DEFAULT '0',
  `tsgone` bigint(20) NOT NULL DEFAULT '0',
  `oldtime` bigint(20) NOT NULL DEFAULT '0',
  `lastime` bigint(20) NOT NULL DEFAULT '0',
  `txtstyle` bigint(15) NOT NULL DEFAULT '0',
  `invites` int(100) NOT NULL DEFAULT '0',
  `navstyle` varchar(30) NOT NULL DEFAULT 'full',
  `netinfo` blob NOT NULL,
  `postalert` tinyint(1) NOT NULL DEFAULT '1',
  `pmpreviews` tinyint(1) NOT NULL DEFAULT '1',
  `validkey` varchar(255) NOT NULL DEFAULT '',
  `proviews` int(100) NOT NULL DEFAULT '0',
  `v3-theme` int(100) NOT NULL DEFAULT '0',
  `lastaction` bigint(20) NOT NULL DEFAULT '0',
  `showicon` int(100) NOT NULL DEFAULT '1',
  `showtime` int(100) NOT NULL DEFAULT '1',
  `specialid` int(100) NOT NULL DEFAULT '0',
  `viewpro` varchar(100) NOT NULL DEFAULT '1',
  `show_online` int(100) NOT NULL DEFAULT '1',
  `passremind` varchar(100) NOT NULL,
  `is_active` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_users`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_usfun`
--

CREATE TABLE IF NOT EXISTS `gyd_usfun` (
  `id` int(100) NOT NULL DEFAULT '0',
  `uid` int(100) NOT NULL DEFAULT '0',
  `action` varchar(10) NOT NULL DEFAULT '',
  `target` int(100) NOT NULL DEFAULT '0',
  `actime` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gyd_usfun`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_vault`
--

CREATE TABLE IF NOT EXISTS `gyd_vault` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `uid` int(100) NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL DEFAULT '',
  `itemurl` varchar(255) NOT NULL DEFAULT '',
  `pudt` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_vault`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_visitors`
--

CREATE TABLE IF NOT EXISTS `gyd_visitors` (
  `ip` varchar(20) NOT NULL DEFAULT '',
  `browser` varchar(20) NOT NULL DEFAULT '',
  `date` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gyd_visitors`
--


-- --------------------------------------------------------

--
-- Table structure for table `gyd_xinfo`
--

CREATE TABLE IF NOT EXISTS `gyd_xinfo` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `uid` int(100) NOT NULL DEFAULT '0',
  `gmailun` varchar(100) NOT NULL DEFAULT '',
  `gmailpw` blob NOT NULL,
  `country` varchar(50) NOT NULL DEFAULT '',
  `city` varchar(50) NOT NULL DEFAULT '',
  `street` varchar(50) NOT NULL DEFAULT '',
  `timezone` char(3) NOT NULL DEFAULT '',
  `height` varchar(10) NOT NULL DEFAULT '',
  `weight` varchar(10) NOT NULL DEFAULT '',
  `phoneno` varchar(20) NOT NULL DEFAULT '',
  `likes` varchar(250) NOT NULL DEFAULT '',
  `deslikes` varchar(250) NOT NULL DEFAULT '',
  `realname` varchar(100) NOT NULL DEFAULT '',
  `racerel` varchar(100) NOT NULL DEFAULT '',
  `hairtype` varchar(50) NOT NULL DEFAULT '',
  `eyescolor` varchar(10) NOT NULL DEFAULT '',
  `profession` varchar(100) NOT NULL DEFAULT '',
  `habitsb` varchar(250) NOT NULL DEFAULT '',
  `habitsg` varchar(250) NOT NULL DEFAULT '',
  `favsport` varchar(100) NOT NULL DEFAULT '',
  `favmusic` varchar(100) NOT NULL DEFAULT '',
  `moretext` blob NOT NULL,
  `sitedscr` varchar(200) NOT NULL DEFAULT '',
  `budsonly` char(1) NOT NULL DEFAULT '1',
  `sexpre` char(1) NOT NULL DEFAULT '',
  `gmailchk` int(10) NOT NULL DEFAULT '30',
  `gmaillch` int(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `gyd_xinfo`
--


-- --------------------------------------------------------

--
-- Table structure for table `refer_members`
--

CREATE TABLE IF NOT EXISTS `refer_members` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `byname` varchar(100) NOT NULL,
  `byuid` char(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `refer_members`
--


-- --------------------------------------------------------

--
-- Table structure for table `tools`
--

CREATE TABLE IF NOT EXISTS `tools` (
  `id` int(100) NOT NULL,
  `time_to_activate` int(100) NOT NULL DEFAULT '300',
  `use_time_wait` int(10) NOT NULL DEFAULT '1',
  `staff_login_auth` char(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tools`
--

INSERT INTO `tools` (`id`, `time_to_activate`, `use_time_wait`, `staff_login_auth`) VALUES
(1, 999, 1, '1');
