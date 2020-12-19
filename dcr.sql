-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 19, 2020 at 04:20 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mqnpkowp_dcr`
--

-- --------------------------------------------------------

--
-- Table structure for table `address_districts`
--

CREATE TABLE `address_districts` (
  `district_id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `district_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `address_districts`
--

INSERT INTO `address_districts` (`district_id`, `division_id`, `district_name`) VALUES
(1, 1, 'Dhaka'),
(2, 1, 'Faridpur'),
(3, 1, 'Gazipur'),
(4, 1, 'Gopalganj'),
(5, 1, 'Kishoreganj'),
(6, 1, 'Madaripur'),
(7, 1, 'Manikganj'),
(8, 1, 'Munshiganj'),
(9, 1, 'Narayanganj'),
(10, 1, 'Narsingdi'),
(11, 1, 'Rajbari'),
(12, 1, 'Shariatpur'),
(13, 1, 'Tangail'),
(14, 2, 'Jamalpur'),
(15, 2, 'Mymensingh'),
(16, 2, 'Netrokona'),
(17, 2, 'Sherpur'),
(18, 3, 'Bandarban'),
(19, 3, 'Brahmanbaria'),
(20, 3, 'Chandpur'),
(21, 3, 'Chittagong'),
(22, 3, 'Comilla'),
(23, 3, 'Cox\'s Bazar'),
(24, 3, 'Feni'),
(25, 3, 'Khagrachhari'),
(26, 3, 'Lakshmipur'),
(27, 3, 'Noakhali'),
(28, 3, 'Rangamati'),
(29, 4, 'Bagerhat'),
(30, 4, 'Chuadanga'),
(31, 4, 'Jessore'),
(32, 4, 'Jhenaidah'),
(33, 4, 'Khulna'),
(34, 4, 'Kushtia'),
(35, 4, 'Magura'),
(36, 4, 'Meherpur'),
(37, 4, 'Narail'),
(38, 4, 'Satkhira'),
(39, 5, 'Barguna'),
(40, 5, 'Barisal'),
(41, 5, 'Bhola'),
(42, 5, 'Jhalokati'),
(43, 5, 'Patuakhali'),
(44, 5, 'Pirojpur'),
(45, 6, 'Habiganj'),
(46, 6, 'Moulvibazar'),
(47, 6, 'Sunamganj'),
(48, 6, 'Sylhet'),
(49, 7, 'Dinajpur'),
(50, 7, 'Gaibandha'),
(51, 7, 'Kurigram'),
(52, 7, 'Lalmonirhat'),
(53, 7, 'Nilphamari'),
(54, 7, 'Panchagarh'),
(55, 7, 'Rangpur'),
(56, 7, 'Thakurgaon'),
(57, 8, 'Bogra'),
(58, 8, 'Jaipurhat'),
(59, 8, 'Naogaon'),
(60, 8, 'Natore'),
(61, 8, 'Chapai Nawabganj'),
(62, 8, 'Pabna'),
(63, 8, 'Rajshahi'),
(64, 8, 'Sirajganj');

-- --------------------------------------------------------

--
-- Table structure for table `address_divisions`
--

CREATE TABLE `address_divisions` (
  `division_id` int(11) NOT NULL,
  `division_name` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `address_divisions`
--

INSERT INTO `address_divisions` (`division_id`, `division_name`) VALUES
(1, 'Dhaka'),
(2, 'Mymensing'),
(3, 'Chittagong'),
(4, 'Khulna'),
(5, 'Barisal'),
(6, 'Sylhet'),
(7, 'Rangpur'),
(8, 'Rajshahi');

-- --------------------------------------------------------

--
-- Table structure for table `address_thanas`
--

CREATE TABLE `address_thanas` (
  `thana_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `thana_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `address_thanas`
--

INSERT INTO `address_thanas` (`thana_id`, `district_id`, `thana_name`) VALUES
(1, 1, 'Demra'),
(2, 1, 'Dhaka Cantt.'),
(3, 1, 'Dhamrai'),
(4, 1, 'Dhanmondi'),
(5, 1, 'Gulshan'),
(6, 1, 'Jatrabari'),
(7, 1, 'Joypara'),
(8, 1, 'Keraniganj'),
(9, 1, 'Khilgaon'),
(10, 1, 'Khilkhet'),
(11, 1, 'Lalbag'),
(12, 1, 'Mirpur'),
(13, 1, 'Mohammadpur'),
(14, 1, 'Motijheel'),
(15, 1, 'Nawabganj'),
(16, 1, 'New market'),
(17, 1, 'Palton'),
(18, 1, 'Ramna'),
(19, 1, 'Sabujbag'),
(20, 1, 'Savar'),
(21, 1, 'Sutrapur'),
(22, 1, 'Tejgaon'),
(23, 1, 'Uttara'),
(24, 2, 'Alfadanga'),
(25, 2, 'Bhanga'),
(26, 2, 'Boalmari'),
(27, 2, 'Charbhadrasan'),
(28, 2, 'Faridpur Sadar'),
(29, 2, 'Madukhali'),
(30, 2, 'Nagarkanda'),
(31, 2, 'Sadarpur'),
(32, 2, 'Sadarpur'),
(33, 2, 'Shriangan'),
(34, 3, 'Gazipur Sadar'),
(35, 3, 'Kaliakaar'),
(36, 3, 'Kaliganj'),
(37, 3, 'Kapashia'),
(38, 3, 'Monnunagar'),
(39, 3, 'Sreepur'),
(40, 4, 'Gopalganj Sadar'),
(41, 4, 'Kashiani'),
(42, 4, 'Kotalipara'),
(43, 4, 'Maksudpur'),
(44, 4, 'Tungipara'),
(45, 5, 'Bajitpur'),
(46, 5, 'Bhairob'),
(47, 5, 'Hossenpur'),
(48, 5, 'Itna'),
(49, 5, 'Karimganj'),
(50, 5, 'Katiadi'),
(51, 5, 'Kishoreganj Sadar'),
(52, 5, 'Kuliarchar'),
(53, 5, 'Mithamoin'),
(54, 5, 'Nikli'),
(55, 5, 'Ostagram'),
(56, 5, 'Pakundia'),
(57, 5, 'Tarial'),
(58, 6, 'Barhamganj'),
(59, 6, 'kalkini'),
(60, 6, 'Madaripur Sadar'),
(61, 6, 'Rajoir'),
(62, 7, 'Doulatpur'),
(63, 7, 'Gheor'),
(64, 7, 'Lechhraganj'),
(65, 7, 'Manikganj Sadar'),
(66, 7, 'Saturia'),
(67, 7, 'Shibloya'),
(68, 7, 'Singari'),
(69, 8, 'Gajaria'),
(70, 8, 'Lohajong'),
(71, 8, 'Munshiganj Sadar'),
(72, 8, 'Sirajdikhan'),
(73, 8, 'Sreenagar'),
(74, 9, 'Araihazar'),
(75, 9, 'Baidder Bazar'),
(76, 9, 'Bandar'),
(77, 9, 'Fatullah'),
(78, 9, 'Narayanganj Sadar'),
(79, 9, 'Rupganj'),
(80, 9, 'Siddirganj'),
(81, 10, 'Belabo'),
(82, 10, 'Monohordi'),
(83, 10, 'Narsingdi Sadar'),
(84, 10, 'Palash'),
(85, 10, 'Raypura'),
(86, 10, 'Shibpur'),
(87, 11, 'Baliakandi'),
(88, 11, 'Pangsha'),
(89, 11, 'Rajbari Sadar'),
(90, 11, 'Bhedorganj'),
(91, 11, 'Damudhya'),
(92, 11, 'Gosairhat'),
(93, 11, 'Jajira'),
(94, 11, 'Naria'),
(95, 11, 'Shariatpur Sadar'),
(96, 13, 'Basail'),
(97, 13, 'Bhuapur'),
(98, 13, 'Delduar'),
(99, 13, 'Ghatail'),
(100, 13, 'Gopalpur'),
(101, 13, 'Kalihati'),
(102, 13, 'Kashkaolia'),
(103, 13, 'Madhupur'),
(104, 13, 'Mirzapur'),
(105, 13, 'Nagarpur'),
(106, 13, 'Sakhipur'),
(107, 13, 'Tangail Sadar'),
(108, 14, 'Dewangonj'),
(109, 14, 'Islampur'),
(110, 14, 'Jamalpur'),
(111, 14, 'Malandah'),
(112, 14, 'Madarganj'),
(113, 14, 'Shorishabari'),
(114, 15, 'Bhaluka'),
(115, 15, 'Fulbaria'),
(116, 15, 'Gaforgaon'),
(117, 15, 'Gouripur'),
(118, 15, 'Haluaghat'),
(119, 15, 'Isshwargonj'),
(120, 15, 'Muktagachha'),
(121, 15, 'Mymensingh Sadar'),
(122, 15, 'Nandail'),
(123, 15, 'Phulpur'),
(124, 15, 'Trishal'),
(125, 16, 'Susung Durgapur'),
(126, 16, 'Atpara'),
(127, 16, 'Barhatta'),
(128, 16, 'Dharmapasha'),
(129, 16, 'Dhobaura'),
(130, 16, 'Kalmakanda'),
(131, 16, 'Kendua'),
(132, 16, 'Khaliajuri'),
(133, 16, 'Madan'),
(134, 16, 'Moddhynagar'),
(135, 16, 'Mohanganj'),
(136, 16, 'Netrakona Sadar'),
(137, 16, 'Purbadhola'),
(138, 17, 'Bakshigonj'),
(139, 17, 'Jhinaigati'),
(140, 17, 'Nakla'),
(141, 17, 'Nalitabari'),
(142, 17, 'Sherpur Shadar'),
(143, 17, 'Shribardi'),
(144, 45, 'Azmireeganj'),
(145, 45, 'Bahubal'),
(146, 45, 'Baniachang'),
(147, 45, 'Chunarughat'),
(148, 45, 'Habiganj Sadar'),
(149, 45, 'Kalauk'),
(150, 45, 'Madhabpur'),
(151, 45, 'Nabiganj'),
(152, 46, 'Baralekha'),
(153, 46, 'Kamalganj'),
(154, 46, 'Kulaura'),
(155, 46, 'Moulvibazar Sadar'),
(156, 46, 'Rajnagar'),
(157, 46, 'Srimangal'),
(158, 47, 'Bishamsarpur'),
(159, 47, 'Chhatak'),
(160, 47, 'Dhirai Chandpur'),
(161, 47, 'Duara bazar'),
(162, 47, 'Ghungiar'),
(163, 47, 'Jagnnathpur'),
(164, 47, 'Sachna'),
(165, 47, 'Sunamganj Sadar'),
(166, 47, 'Tahirpur'),
(167, 48, 'Balaganj'),
(168, 48, 'Balaganjgfhfghj'),
(169, 48, 'Bianibazar'),
(170, 48, 'Bishwanath'),
(171, 48, 'Fenchuganj'),
(172, 48, 'Goainhat'),
(173, 48, 'Gopalganj'),
(174, 48, 'Jaintapur'),
(175, 48, 'Jakiganj'),
(176, 48, 'Kanaighat'),
(177, 48, 'Kompanyganj'),
(178, 48, 'Sylhet Sadar'),
(179, 18, 'Alikadam'),
(180, 18, 'Bandarban Sadar'),
(181, 18, 'Naikhong'),
(182, 18, 'Roanchhari'),
(183, 18, 'Ruma'),
(184, 19, 'Thanchi'),
(185, 19, 'Akhaura'),
(186, 19, 'Banchharampur'),
(187, 19, 'Brahamanbaria Sadar'),
(188, 19, 'Kasba'),
(189, 19, 'Nabinagar'),
(190, 19, 'Nasirnagar'),
(191, 19, 'Sarail'),
(192, 20, 'Chandpur Sadar'),
(193, 20, 'Faridganj'),
(194, 20, 'Hajiganj'),
(195, 20, 'Hayemchar'),
(196, 20, 'Kachua'),
(197, 20, 'Matlobganj'),
(198, 20, 'Shahrasti'),
(199, 21, 'Anawara'),
(200, 21, 'Boalkhali'),
(201, 21, 'Chittagong Sadar'),
(202, 21, 'East Joara'),
(203, 21, 'Fatikchhari'),
(204, 21, 'Hathazari'),
(205, 21, 'Jaldi'),
(206, 21, 'Lohagara'),
(207, 21, 'Mirsharai'),
(208, 21, 'Patiya'),
(209, 21, 'Rangunia'),
(210, 21, 'Rouzan'),
(211, 21, 'Sandwip'),
(212, 21, 'Satkania'),
(213, 21, 'Sitakunda'),
(214, 22, 'Barura'),
(215, 22, 'Brahmanpara'),
(216, 22, 'Chandina'),
(217, 22, 'Chouddagram'),
(218, 22, 'Comilla Sadar'),
(219, 22, 'Daudkandi'),
(220, 22, 'Davidhar'),
(221, 22, 'Homna'),
(222, 22, 'Laksam'),
(223, 22, 'Langalkot'),
(224, 22, 'Muradnagar'),
(225, 23, 'Chiringga'),
(226, 23, 'Coxs Bazar Sadar'),
(227, 23, 'Gorakghat'),
(228, 23, 'Kutubdia'),
(229, 23, 'Ramu'),
(230, 23, 'Teknaf'),
(231, 23, 'Ukhia'),
(232, 24, 'Chhagalnaia'),
(233, 24, 'Dagonbhuia'),
(234, 24, 'Feni Sadar'),
(235, 24, 'Pashurampur'),
(236, 24, 'Sonagazi'),
(237, 25, 'Diginala'),
(238, 25, 'Khagrachari Sadar'),
(239, 25, 'Laxmichhari'),
(240, 25, 'Mahalchhari'),
(241, 25, 'Matiranga'),
(242, 25, 'Panchhari'),
(243, 25, 'Ramghar Head Office'),
(244, 26, 'Char Alexgander'),
(245, 26, 'Lakshimpur Sadar'),
(246, 26, 'Ramganj'),
(247, 26, 'Raypur'),
(248, 27, 'Basurhat'),
(249, 27, 'Begumganj'),
(250, 27, 'Chatkhil'),
(251, 27, 'Hatiya'),
(252, 27, 'Noakhali Sadar'),
(253, 27, 'Senbag'),
(254, 28, 'Barakal'),
(255, 28, 'Bilaichhari'),
(256, 28, 'Jarachhari'),
(257, 28, 'Kalampati'),
(258, 28, 'kaptai'),
(259, 28, 'Longachh'),
(260, 28, 'Marishya'),
(261, 28, 'Naniachhar'),
(262, 28, 'Rajsthali'),
(263, 28, 'Rangamati Sadar'),
(264, 49, 'Bangla Hili'),
(265, 49, 'Biral'),
(266, 49, 'Birampur'),
(267, 49, 'Birganj'),
(268, 49, 'Chirirbandar'),
(269, 49, 'Dinajpur Sadar'),
(270, 49, 'Khansama'),
(271, 49, 'Maharajganj'),
(272, 49, 'Nawabganj'),
(273, 49, 'Osmanpur'),
(274, 49, 'Parbatipur'),
(275, 49, 'Phulbari'),
(276, 49, 'Setabganj'),
(277, 50, 'Bonarpara'),
(278, 50, 'Gaibandha Sadar'),
(279, 50, 'Gobindaganj'),
(280, 50, 'Palashbari'),
(281, 50, 'Phulchhari'),
(282, 50, 'Saadullapur'),
(283, 50, 'Sundarganj'),
(284, 51, 'Bhurungamari'),
(285, 51, 'Chilmari'),
(286, 51, 'Kurigram Sadar'),
(287, 51, 'Nageshwar'),
(288, 51, 'Rajarhat'),
(289, 51, 'Rajibpur'),
(290, 51, 'Roumari'),
(291, 51, 'Ulipur'),
(292, 52, 'Aditmari'),
(293, 52, 'Hatibandha'),
(294, 52, 'Lalmonirhat Sadar'),
(295, 52, 'Patgram'),
(296, 52, 'Tushbhandar'),
(297, 53, 'Dimla'),
(298, 53, 'Domar'),
(299, 53, 'Jaldhaka'),
(300, 53, 'Kishoriganj'),
(301, 53, 'Nilphamari Sadar'),
(302, 53, 'Saidpur'),
(303, 54, 'Boda'),
(304, 54, 'Chotto Dab'),
(305, 54, 'Dabiganj'),
(306, 54, 'Panchagra Sadar'),
(307, 54, 'Tetulia'),
(308, 55, 'Taraganj'),
(309, 55, 'Badarganj'),
(310, 55, 'Gangachara'),
(311, 55, 'Kaunia'),
(312, 55, 'Mithapukur'),
(313, 55, 'Pirgachha'),
(314, 55, 'Rangpur Sadar'),
(315, 55, 'Badarganj'),
(316, 56, 'Baliadangi'),
(317, 56, 'Jibanpur'),
(318, 56, 'Pirganj'),
(319, 56, 'Rani Sankail'),
(320, 56, 'Thakurgaon Sadar'),
(321, 57, 'Alamdighi'),
(322, 57, 'Bogra Sadar'),
(323, 57, 'Dhunat'),
(324, 57, 'Dupchachia'),
(325, 57, 'Gabtoli'),
(326, 57, 'Kahalu'),
(327, 57, 'Nandigram'),
(328, 57, 'Sariakandi'),
(329, 57, 'Sherpur'),
(330, 57, 'Shibganj'),
(331, 57, 'Sonatola'),
(332, 58, 'Bholahat'),
(333, 58, 'Chapai Nawabganj Sadar'),
(334, 58, 'Nachol'),
(335, 58, 'Rohanpur'),
(336, 58, 'Shibganj U.P.O'),
(337, 59, 'Akkelpur'),
(338, 59, 'Joypurhat Sadar'),
(339, 59, 'kalai'),
(340, 59, 'Khetlal'),
(341, 59, 'panchbibi'),
(342, 60, 'Ahsanganj'),
(343, 60, 'Badalgachhi'),
(344, 60, 'Dhamuirhat'),
(345, 60, 'Mahadebpur'),
(346, 60, 'Naogaon Sadar'),
(347, 60, 'Niamatpur'),
(348, 60, 'Nitpur'),
(349, 60, 'Patnitala'),
(350, 60, 'Prasadpur'),
(351, 60, 'Raninagar'),
(352, 60, 'Sapahar'),
(353, 61, 'Gopalpur UPO'),
(354, 61, 'Harua'),
(355, 61, 'Hatgurudaspur'),
(356, 61, 'Laxman'),
(357, 61, 'Natore Sadar'),
(358, 61, 'Singra'),
(359, 62, 'Banwarinagar'),
(360, 62, 'Bera'),
(361, 62, 'Bhangura'),
(362, 62, 'Chatmohar'),
(363, 62, 'Debottar'),
(364, 62, 'Ishwardi'),
(365, 62, 'Pabna Sadar'),
(366, 62, 'Sathia'),
(367, 62, 'Sujanagar'),
(368, 63, 'Bagha'),
(369, 63, 'Bhabaniganj'),
(370, 63, 'Charghat'),
(371, 63, 'Durgapur'),
(372, 63, 'Godagari'),
(373, 63, 'Khod Mohanpur'),
(374, 63, 'Lalitganj'),
(375, 63, 'Putia'),
(376, 63, 'Rajshahi Sadar'),
(377, 63, 'Tanor'),
(378, 64, 'Baiddya Jam Toil'),
(379, 64, 'Belkuchi'),
(380, 64, 'Dhangora'),
(381, 64, 'Kazipur'),
(382, 64, 'Shahjadpur'),
(383, 64, 'Sirajganj Sadar'),
(384, 64, 'Tarash'),
(385, 64, 'Ullapara'),
(386, 39, 'Amtali'),
(387, 39, 'Bamna'),
(388, 39, 'Barguna Sadar'),
(389, 39, 'Betagi'),
(390, 39, 'Patharghata'),
(391, 40, 'Agailzhara'),
(392, 40, 'Babuganj'),
(393, 40, 'Barajalia'),
(394, 40, 'Barisal Sadar'),
(395, 40, 'Gouranadi'),
(396, 40, 'Mahendiganj'),
(397, 40, 'Muladi'),
(398, 40, 'Sahebganj'),
(399, 40, 'Uzirpur'),
(400, 41, 'Bhola Sadar'),
(401, 41, 'Borhanuddin UPO'),
(402, 41, 'Charfashion'),
(403, 41, 'Doulatkhan'),
(404, 41, 'Hajirhat'),
(405, 41, 'Hatshoshiganj'),
(406, 41, 'Lalmohan UPO'),
(407, 42, 'Jhalokati Sadar'),
(408, 42, 'Kathalia'),
(409, 42, 'Nalchhiti'),
(410, 42, 'Rajapur'),
(411, 43, 'Bauphal'),
(412, 43, 'Dashmina'),
(413, 43, 'Galachipa'),
(414, 43, 'Khepupara'),
(415, 43, 'Patuakhali Sadar'),
(416, 43, 'Subidkhali'),
(417, 44, 'Banaripara'),
(418, 44, 'kaukhali'),
(419, 44, 'Mathbaria'),
(420, 44, 'Nazirpur'),
(421, 44, 'Pirojpur Sadar'),
(422, 44, 'Swarupkathi'),
(423, 29, 'Bagerhat Sadar'),
(424, 29, 'Chalna Ankorage'),
(425, 29, 'Chitalmari'),
(426, 29, 'Fakirhat'),
(427, 29, 'Kachua UPO'),
(428, 29, 'Rampal'),
(429, 29, 'Rayenda'),
(430, 30, 'Alamdanga'),
(431, 30, 'Chuadanga Sadar'),
(432, 30, 'Damurhuda'),
(433, 30, 'Doulatganj'),
(434, 31, 'Bagharpara'),
(435, 31, 'Chaugachha'),
(436, 31, 'Jessore Sadar'),
(437, 31, 'Jhikargachha'),
(438, 31, 'Keshabpur'),
(439, 31, 'Monirampur'),
(440, 31, 'Noapara'),
(441, 31, 'Sarsa'),
(442, 32, 'Harinakundu'),
(443, 32, 'Jhenaidah Sadar'),
(444, 32, 'Kotchandpur'),
(445, 32, 'Maheshpur'),
(446, 32, 'Naldanga'),
(447, 32, 'Shailakupa'),
(448, 33, 'Alaipur'),
(449, 33, 'Batiaghat'),
(450, 33, 'Chalna Bazar'),
(451, 33, 'Digalia'),
(452, 33, 'Khulna Sadar'),
(453, 33, 'Madinabad'),
(454, 33, 'Paikgachha'),
(455, 33, 'Phultala'),
(456, 33, 'Sajiara'),
(457, 33, 'Terakhada'),
(458, 34, 'Bheramara'),
(459, 34, 'Janipur'),
(460, 34, 'Kumarkhali'),
(461, 34, 'Kushtia Sadar'),
(462, 34, 'Mirpur'),
(463, 34, 'Rafayetpur'),
(464, 35, 'Arpara'),
(465, 35, 'Magura Sadar'),
(466, 35, 'Mohammadpur'),
(467, 35, 'Shripur'),
(468, 36, 'Gangni'),
(469, 36, 'Meherpur Sadar'),
(470, 37, 'Kalia'),
(471, 37, 'Laxmipasha'),
(472, 37, 'Mohajan'),
(473, 37, 'Narail Sadar'),
(474, 38, 'Ashashuni'),
(475, 38, 'Debbhata'),
(476, 38, 'kalaroa'),
(477, 38, 'Kaliganj UPO'),
(478, 38, 'Nakipur'),
(479, 38, 'Satkhira Sadar'),
(480, 38, 'Taala');

-- --------------------------------------------------------

--
-- Table structure for table `address_zips`
--

CREATE TABLE `address_zips` (
  `zip_id` int(11) NOT NULL,
  `thana_id` int(11) NOT NULL,
  `zip_code` int(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `address_zips`
--

INSERT INTO `address_zips` (`zip_id`, `thana_id`, `zip_code`) VALUES
(1, 1, 1360),
(2, 2, 1206),
(3, 3, 1350),
(4, 4, 1209),
(5, 5, 1212),
(6, 6, 1232),
(7, 7, 1330),
(8, 8, 1310),
(9, 9, 1219),
(10, 10, 1229),
(11, 11, 1211),
(12, 12, 1216),
(13, 13, 1207),
(14, 14, 1222),
(15, 15, 1320),
(16, 16, 1205),
(17, 17, 1000),
(18, 18, 1217),
(19, 19, 1214),
(20, 20, 1340),
(21, 21, 1100),
(22, 22, 1215),
(23, 23, 1230),
(24, 24, 7870),
(25, 25, 7830),
(26, 26, 7860),
(27, 27, 7810),
(28, 28, 7800),
(29, 29, 7850),
(30, 30, 7840),
(31, 31, 7820),
(32, 32, 7820),
(33, 33, 7804),
(34, 34, 1700),
(35, 35, 1750),
(36, 36, 1720),
(37, 37, 1730),
(38, 38, 1710),
(39, 39, 1740),
(40, 40, 8100),
(41, 41, 8130),
(42, 42, 8110),
(43, 43, 8140),
(44, 44, 8120),
(45, 45, 2336),
(46, 46, 2350),
(47, 47, 2320),
(48, 48, 2390),
(49, 49, 2310),
(50, 50, 2330),
(51, 51, 2300),
(52, 52, 2340),
(53, 53, 2370),
(54, 54, 2360),
(55, 55, 2380),
(56, 56, 2326),
(57, 57, 2316),
(58, 58, 7930),
(59, 59, 7920),
(60, 60, 7900),
(61, 61, 7910),
(62, 62, 1860),
(63, 63, 1840),
(64, 64, 1830),
(65, 65, 1800),
(66, 66, 1810),
(67, 67, 1850),
(68, 68, 1820),
(69, 69, 1510),
(70, 70, 1530),
(71, 71, 1500),
(72, 72, 1540),
(73, 73, 1550),
(74, 74, 1450),
(75, 75, 1440),
(76, 76, 1410),
(77, 77, 1420),
(78, 78, 1400),
(79, 79, 1460),
(80, 80, 1430),
(81, 81, 1640),
(82, 82, 1650),
(83, 83, 1600),
(84, 84, 1610),
(85, 85, 1630),
(86, 86, 1620),
(87, 87, 7730),
(88, 88, 7720),
(89, 89, 7700),
(90, 90, 8030),
(91, 91, 8040),
(92, 92, 8050),
(93, 93, 8010),
(94, 94, 8020),
(95, 95, 8000),
(96, 96, 1920),
(97, 97, 1960),
(98, 98, 1910),
(99, 99, 1980),
(100, 100, 1990),
(101, 101, 1970),
(102, 102, 1930),
(103, 103, 1996),
(104, 104, 1940),
(105, 105, 1936),
(106, 106, 1950),
(107, 107, 1900),
(108, 108, 2030),
(109, 109, 2020),
(110, 110, 2000),
(111, 111, 2010),
(112, 112, 2040),
(113, 113, 2050),
(114, 114, 2240),
(115, 115, 2216),
(116, 116, 2230),
(117, 117, 2270),
(118, 118, 2260),
(119, 119, 2280),
(120, 120, 2210),
(121, 121, 2200),
(122, 122, 2290),
(123, 123, 2250),
(124, 124, 2220),
(125, 125, 2420),
(126, 126, 2470),
(127, 127, 2440),
(128, 128, 2450),
(129, 129, 2416),
(130, 130, 2430),
(131, 131, 2480),
(132, 132, 2460),
(133, 133, 2490),
(134, 134, 2456),
(135, 135, 2446),
(136, 136, 2400),
(137, 137, 2410),
(138, 138, 2140),
(139, 139, 2120),
(140, 140, 2150),
(141, 141, 2110),
(142, 142, 2100),
(143, 143, 2130),
(144, 144, 3360),
(145, 145, 3310),
(146, 146, 3350),
(147, 147, 3320),
(148, 148, 3300),
(149, 149, 3340),
(150, 150, 3330),
(151, 151, 3370),
(152, 152, 3250),
(153, 153, 3220),
(154, 154, 3230),
(155, 155, 3200),
(156, 156, 3240),
(157, 157, 3210),
(158, 158, 3010),
(159, 159, 3080),
(160, 160, 3040),
(161, 161, 3070),
(162, 162, 3050),
(163, 163, 3060),
(164, 164, 3020),
(165, 165, 3000),
(166, 166, 3030),
(167, 167, 3120),
(168, 168, 0),
(169, 169, 3170),
(170, 170, 3130),
(171, 171, 3116),
(172, 172, 3150),
(173, 173, 3160),
(174, 174, 3156),
(175, 175, 3190),
(176, 176, 3180),
(177, 177, 3140),
(178, 178, 3100),
(179, 179, 4650),
(180, 180, 4600),
(181, 181, 4660),
(182, 182, 4610),
(183, 183, 4620),
(184, 184, 4630),
(185, 185, 3450),
(186, 186, 3420),
(187, 187, 3400),
(188, 188, 3460),
(189, 189, 3410),
(190, 190, 3440),
(191, 191, 3430),
(192, 192, 3600),
(193, 193, 3650),
(194, 194, 3610),
(195, 195, 3660),
(196, 196, 3630),
(197, 197, 3640),
(198, 198, 3620),
(199, 199, 4376),
(200, 200, 4366),
(201, 201, 4000),
(202, 202, 4380),
(203, 203, 4350),
(204, 204, 4330),
(205, 205, 4390),
(206, 206, 4396),
(207, 207, 4320),
(208, 208, 4370),
(209, 209, 4360),
(210, 210, 4340),
(211, 211, 4300),
(212, 212, 4386),
(213, 213, 4310),
(214, 214, 3560),
(215, 215, 3526),
(216, 216, 3510),
(217, 217, 3550),
(218, 218, 3500),
(219, 219, 3516),
(220, 220, 3530),
(221, 221, 3546),
(222, 222, 3570),
(223, 223, 3580),
(224, 224, 3540),
(225, 225, 4740),
(226, 226, 4700),
(227, 227, 4710),
(228, 228, 4720),
(229, 229, 4730),
(230, 230, 4760),
(231, 231, 4750),
(232, 232, 3910),
(233, 233, 3920),
(234, 234, 3900),
(235, 235, 3940),
(236, 236, 3930),
(237, 237, 4420),
(238, 238, 4400),
(239, 239, 4470),
(240, 240, 4430),
(241, 241, 4450),
(242, 242, 4410),
(243, 243, 4440),
(244, 244, 3730),
(245, 245, 3700),
(246, 246, 3720),
(247, 247, 3710),
(248, 248, 3850),
(249, 249, 3820),
(250, 250, 3870),
(251, 251, 3890),
(252, 252, 3800),
(253, 253, 3860),
(254, 254, 4570),
(255, 255, 4550),
(256, 256, 4560),
(257, 257, 4510),
(258, 258, 4530),
(259, 259, 4580),
(260, 260, 4590),
(261, 261, 4520),
(262, 262, 4540),
(263, 263, 4500),
(264, 264, 5270),
(265, 265, 5210),
(266, 266, 5266),
(267, 267, 5220),
(268, 268, 5240),
(269, 269, 5200),
(270, 270, 5230),
(271, 271, 5226),
(272, 272, 5280),
(273, 273, 5290),
(274, 274, 5250),
(275, 275, 5260),
(276, 276, 5216),
(277, 277, 5750),
(278, 278, 5700),
(279, 279, 5740),
(280, 280, 5730),
(281, 281, 5760),
(282, 282, 5710),
(283, 283, 5720),
(284, 284, 5670),
(285, 285, 5630),
(286, 286, 5600),
(287, 287, 5660),
(288, 288, 5610),
(289, 289, 5650),
(290, 290, 5640),
(291, 291, 5620),
(292, 292, 5510),
(293, 293, 5530),
(294, 294, 5500),
(295, 295, 5540),
(296, 296, 5520),
(297, 297, 5350),
(298, 298, 5340),
(299, 299, 5330),
(300, 300, 5320),
(301, 301, 5300),
(302, 302, 5310),
(303, 303, 5010),
(304, 304, 5040),
(305, 305, 5020),
(306, 306, 5000),
(307, 307, 5030),
(308, 308, 5420),
(309, 309, 5431),
(310, 310, 5410),
(311, 311, 5440),
(312, 312, 5460),
(313, 313, 5450),
(314, 314, 5400),
(315, 315, 5430),
(316, 316, 5140),
(317, 317, 5130),
(318, 318, 5470),
(319, 319, 5120),
(320, 320, 5100),
(321, 321, 5890),
(322, 322, 5800),
(323, 323, 5850),
(324, 324, 5880),
(325, 325, 5820),
(326, 326, 5870),
(327, 327, 5860),
(328, 328, 5830),
(329, 329, 5840),
(330, 330, 5810),
(331, 331, 5826),
(332, 332, 6330),
(333, 333, 6300),
(334, 334, 6310),
(335, 335, 6320),
(336, 336, 6340),
(337, 337, 5940),
(338, 338, 5900),
(339, 339, 5930),
(340, 340, 5920),
(341, 341, 5910),
(342, 342, 6596),
(343, 343, 6570),
(344, 344, 6580),
(345, 345, 6530),
(346, 346, 6522),
(347, 347, 6520),
(348, 348, 6550),
(349, 349, 6540),
(350, 350, 6510),
(351, 351, 6590),
(352, 352, 6560),
(353, 353, 6420),
(354, 354, 6430),
(355, 355, 6440),
(356, 356, 6410),
(357, 357, 6400),
(358, 358, 6450),
(359, 359, 6650),
(360, 360, 6680),
(361, 361, 6640),
(362, 362, 6630),
(363, 363, 6610),
(364, 364, 6620),
(365, 365, 6600),
(366, 366, 6670),
(367, 367, 6660),
(368, 368, 6280),
(369, 369, 6250),
(370, 370, 6270),
(371, 371, 6240),
(372, 372, 6290),
(373, 373, 6220),
(374, 374, 6210),
(375, 375, 6260),
(376, 376, 6000),
(377, 377, 6230),
(378, 378, 6730),
(379, 379, 6740),
(380, 380, 6720),
(381, 381, 6710),
(382, 382, 6770),
(383, 383, 6700),
(384, 384, 6780),
(385, 385, 6760),
(386, 386, 8710),
(387, 387, 8730),
(388, 388, 8700),
(389, 389, 8740),
(390, 390, 8720),
(391, 391, 8240),
(392, 392, 8210),
(393, 393, 8260),
(394, 394, 8200),
(395, 395, 8230),
(396, 396, 8270),
(397, 397, 8250),
(398, 398, 8280),
(399, 399, 8220),
(400, 400, 8300),
(401, 401, 8320),
(402, 402, 8340),
(403, 403, 8310),
(404, 404, 8360),
(405, 405, 8350),
(406, 406, 8330),
(407, 407, 8400),
(408, 408, 8430),
(409, 409, 8420),
(410, 410, 8410),
(411, 411, 8620),
(412, 412, 8630),
(413, 413, 8640),
(414, 414, 8650),
(415, 415, 8600),
(416, 416, 8610),
(417, 417, 8530),
(418, 418, 8510),
(419, 419, 8560),
(420, 420, 8540),
(421, 421, 8500),
(422, 422, 8520),
(423, 423, 9300),
(424, 424, 9350),
(425, 425, 9360),
(426, 426, 9370),
(427, 427, 9310),
(428, 428, 9340),
(429, 429, 9330),
(430, 430, 7210),
(431, 431, 7200),
(432, 432, 7220),
(433, 433, 7230),
(434, 434, 7470),
(435, 435, 7410),
(436, 436, 7400),
(437, 437, 7420),
(438, 438, 7450),
(439, 439, 7440),
(440, 440, 7460),
(441, 441, 7430),
(442, 442, 7310),
(443, 443, 7300),
(444, 444, 7330),
(445, 445, 7340),
(446, 446, 7350),
(447, 447, 7320),
(448, 448, 9240),
(449, 449, 9260),
(450, 450, 9270),
(451, 451, 9220),
(452, 452, 9100),
(453, 453, 9290),
(454, 454, 9280),
(455, 455, 9210),
(456, 456, 9250),
(457, 457, 9230),
(458, 458, 7040),
(459, 459, 7020),
(460, 460, 7010),
(461, 461, 7000),
(462, 462, 7030),
(463, 463, 7050),
(464, 464, 7620),
(465, 465, 7600),
(466, 466, 7630),
(467, 467, 7610),
(468, 468, 7110),
(469, 469, 7100),
(470, 470, 7520),
(471, 471, 7510),
(472, 472, 7521),
(473, 473, 7500),
(474, 474, 9460),
(475, 475, 9430),
(476, 476, 9410),
(477, 477, 9440),
(478, 478, 9450),
(479, 479, 9400),
(480, 480, 9420);

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `area_id` int(11) NOT NULL,
  `area_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active' COMMENT 'Active, Inactive'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `area_territories`
--

CREATE TABLE `area_territories` (
  `area_territory_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `territory_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chemists`
--

CREATE TABLE `chemists` (
  `chemist_id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `other_special_day` text COLLATE utf8_unicode_ci,
  `status` enum('active','inactive','pending','rejected') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `is_edit_request` tinyint(4) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chemists`
--

INSERT INTO `chemists` (`chemist_id`, `name`, `category_id`, `class_id`, `other_special_day`, `status`, `is_edit_request`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'chemist', 1, 2, '[{\"special_day\":\"day title1\",\"date\":\"1991-12-23\",\"message\":\"Today is his birthday\"},{\"special_day\":\"day title2\",\"date\":\"2017-03-12\",\"message\":\"Today is his birthday\"}]', 'active', 0, 1, NULL, '2018-04-16 09:23:49', NULL),
(2, 'Enna Pharma', 2, 1, NULL, 'active', 0, 1, NULL, '2018-04-16 09:32:37', NULL),
(3, 'new chemist edit', 1, 1, NULL, 'inactive', 0, 1, NULL, '2018-04-16 11:21:10', NULL),
(4, 'mr chemist', 1, 1, NULL, 'active', 0, 1, NULL, '2018-04-19 07:09:21', NULL),
(5, 'regb', 1, 2, NULL, 'pending', 0, 1, NULL, '2018-04-19 11:54:35', NULL),
(6, 'ertreyt', 1, 1, NULL, 'active', 0, 1, NULL, '2018-04-19 13:09:39', NULL),
(7, 'ertreyt', 1, 1, NULL, 'active', 0, 1, NULL, '2018-04-19 13:12:16', NULL),
(8, 'prince', 1, 2, '[{\"special_day\":\"day title1\",\"date\":\"1991-12-23\",\"message\":\"Today is his birthday\"},{\"special_day\":\"day title2\",\"date\":\"2017-03-12\",\"message\":\"Today is his birthday\"}]', 'pending', 0, 1, NULL, '2018-04-27 14:35:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chemist_address`
--

CREATE TABLE `chemist_address` (
  `chemist_address_id` int(111) NOT NULL,
  `chemist_id` int(11) NOT NULL,
  `address_line1` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `address_line2` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `division` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `district` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thana` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chemist_address`
--

INSERT INTO `chemist_address` (`chemist_address_id`, `chemist_id`, `address_line1`, `address_line2`, `division`, `district`, `thana`, `zip`) VALUES
(1, 1, 'Shyamoli, Dhaka', '', '1', '1', '1', '1'),
(7, 2, 'efrverfv', '', '3', '19', '186', NULL),
(6, 2, 'waefrgthgb rt3gb', '', '1', '1', '11', '11'),
(13, 3, 'test', '', '1', '1', '1', '1'),
(12, 3, 'ertyhj thyjuk', '', '8', '60', '343', '343'),
(22, 4, '9+6\r\n+9', '', '4', '32', '445', '445'),
(18, 5, 'defrgb', '', '4', '31', '434', '434'),
(19, 6, 'fghfh', '', '4', '30', '432', '432'),
(20, 7, 'fghfh', '', '4', '30', '432', '432'),
(21, 8, 'Shyamoli, Dhaka', '', '1', '2', '1', 'z12345');

-- --------------------------------------------------------

--
-- Table structure for table `chemist_categories`
--

CREATE TABLE `chemist_categories` (
  `chemist_category_id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active' COMMENT 'active, inactive'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chemist_categories`
--

INSERT INTO `chemist_categories` (`chemist_category_id`, `name`, `status`) VALUES
(1, 'New Cat', 'active'),
(2, '2nd Cat', 'active'),
(4, '12345', 'active'),
(3, 'ert', 'inactive'),
(5, 'New Categories 2', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `chemist_contacts`
--

CREATE TABLE `chemist_contacts` (
  `chemist_contact_id` int(11) NOT NULL,
  `chemist_id` int(11) NOT NULL,
  `contact_no` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chemist_contacts`
--

INSERT INTO `chemist_contacts` (`chemist_contact_id`, `chemist_id`, `contact_no`) VALUES
(1, 1, '0123456'),
(2, 1, '12345670'),
(3, 1, '012345678'),
(14, 3, '5454151'),
(8, 2, '8801710603488'),
(13, 3, '7896321450'),
(24, 4, '1234567'),
(19, 5, '1234567'),
(20, 6, '645646'),
(21, 7, '645646'),
(22, 8, '123456'),
(23, 8, '123456');

-- --------------------------------------------------------

--
-- Table structure for table `chemist_dcr`
--

CREATE TABLE `chemist_dcr` (
  `chemist_dcr_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'MPO Type user ID',
  `remark` text COLLATE utf8_unicode_ci,
  `time` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending' COMMENT '''pending'',''accepted'',''rejected''',
  `chemist_id` int(10) NOT NULL,
  `order_value` decimal(10,2) DEFAULT NULL,
  `collection` decimal(10,2) DEFAULT NULL,
  `reject_reason` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chemist_dcr`
--

INSERT INTO `chemist_dcr` (`chemist_dcr_id`, `user_id`, `remark`, `time`, `status`, `chemist_id`, `order_value`, `collection`, `reject_reason`, `created_at`, `updated_at`) VALUES
(1, 11, 'dxvdc dfvdfg', '10', 'pending', 0, 100.00, 50.00, 'fdsfdsfdsf', '2018-04-05 18:00:00', '2018-04-06 00:00:00'),
(2, 5, 'xcxcvxcv', 'xcv', 'pending', 2, 1200.00, 1200.00, 'sfsdfsdf', '2018-04-05 18:00:00', '2018-04-14 00:00:00'),
(3, 1, 'dxvdc dfvdfg', '10', 'pending', 0, NULL, NULL, NULL, '2018-04-17 17:17:03', '2018-04-17 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `chemist_dcr_gifts`
--

CREATE TABLE `chemist_dcr_gifts` (
  `chemist_dcr_gift_id` int(11) NOT NULL,
  `chemist_dcr_id` int(11) NOT NULL,
  `gift_name` text NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chemist_dcr_products`
--

CREATE TABLE `chemist_dcr_products` (
  `chemist_dcr_product_id` int(11) NOT NULL,
  `chemist_dcr_id` int(11) NOT NULL,
  `chemist_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_value` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `collection` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chemist_dcr_products`
--

INSERT INTO `chemist_dcr_products` (`chemist_dcr_product_id`, `chemist_dcr_id`, `chemist_id`, `product_id`, `order_value`, `collection`) VALUES
(20, 1, 2, 10, NULL, NULL),
(19, 1, 1, 2, NULL, NULL),
(17, 3, 1, 2, NULL, NULL),
(18, 3, 2, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chemist_dcr_visit_team`
--

CREATE TABLE `chemist_dcr_visit_team` (
  `chemist_dcr_visit_team_id` int(11) NOT NULL,
  `chemist_dcr_id` int(11) NOT NULL,
  `team_member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chemist_edit_requests`
--

CREATE TABLE `chemist_edit_requests` (
  `chemist_edit_request_id` int(10) NOT NULL,
  `chemist_id` int(10) NOT NULL,
  `name` varchar(192) NOT NULL,
  `category_id` int(10) DEFAULT NULL,
  `class_id` int(10) DEFAULT NULL,
  `territory_id` int(10) DEFAULT NULL,
  `other_special_day` varchar(512) DEFAULT NULL,
  `contacts` varchar(192) DEFAULT NULL,
  `chemist_address` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chemist_edit_requests`
--

INSERT INTO `chemist_edit_requests` (`chemist_edit_request_id`, `chemist_id`, `name`, `category_id`, `class_id`, `territory_id`, `other_special_day`, `contacts`, `chemist_address`) VALUES
(1, 5, 'New Chemist Name', 4, 1, 2, '[{\"special_day_id\":1,\"date\":\"1991-12-23\",\"message\":\"Today is his birthday\"},{\"special_day_id\":2,\"date\":\"2017-03-12\",\"message\":\"Today is his birthday\"}]', '[{\"contact_no\":\"019207563\"},{\"contact_no\":\"019207564\"}]', '[{\"address_line1\":\"addr1\",\"address_line2\":\"addr2\",\"division\":1,\"district\":2,\"thana\":1,\"zip\":\"1234\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `chemist_special_days`
--

CREATE TABLE `chemist_special_days` (
  `chemist_special_day_id` int(11) NOT NULL,
  `chemist_id` int(11) NOT NULL,
  `special_day_id` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chemist_special_days`
--

INSERT INTO `chemist_special_days` (`chemist_special_day_id`, `chemist_id`, `special_day_id`, `message`, `date`) VALUES
(1, 1, 1, 'Today is his birthday', '1991-12-23'),
(2, 1, 2, 'Today is his birthday', '2017-03-12'),
(10, 2, 1, '', '2018-04-17'),
(9, 2, 1, '', '2018-04-11'),
(8, 2, 2, '', '2018-04-19'),
(16, 3, 1, '', '2018-04-17'),
(15, 3, 2, '', '2018-04-26'),
(17, 3, 1, '', '2018-04-28'),
(18, 3, 2, '', '2018-04-28'),
(22, 8, 1, 'Today is his birthday', '1991-12-23'),
(23, 8, 2, 'Today is his birthday', '2017-03-12');

-- --------------------------------------------------------

--
-- Table structure for table `chemist_special_day_types`
--

CREATE TABLE `chemist_special_day_types` (
  `chemist_special_day_type_id` int(11) NOT NULL,
  `name` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci DEFAULT 'active'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chemist_special_day_types`
--

INSERT INTO `chemist_special_day_types` (`chemist_special_day_type_id`, `name`, `status`) VALUES
(1, 'Birthday', 'active'),
(2, 'Merriage Day', 'active'),
(3, 'New Days', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `chemist_territories`
--

CREATE TABLE `chemist_territories` (
  `chemist_territory_id` int(11) NOT NULL,
  `chemist_id` int(11) NOT NULL,
  `territory_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chemist_territories`
--

INSERT INTO `chemist_territories` (`chemist_territory_id`, `chemist_id`, `territory_id`) VALUES
(3, 2, 1),
(6, 3, 1),
(14, 4, 1),
(11, 5, 1),
(12, 6, 2),
(13, 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL COMMENT '1=doctor, 2=chemist',
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `class_name`, `type`, `status`) VALUES
(1, 'D_A+', 1, 'active'),
(2, 'D_B', 1, 'active'),
(3, 'C_B+', 2, 'inactive'),
(4, 'C_A+', 2, 'active'),
(5, 'e2r4f', 1, 'active'),
(6, 'ty5th53y', 1, 'active'),
(7, 'C-c++', 2, 'inactive'),
(8, 'Eye Power', 1, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `designation_id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `division_id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active' COMMENT 'Active, Inactive'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`division_id`, `name`, `code`, `status`) VALUES
(1, 'Dhaka', NULL, 'Active'),
(2, 'Chattogram', NULL, 'Inactive'),
(3, 'Kumilla', NULL, 'Inactive'),
(4, 'Rajshahi', NULL, 'Inactive'),
(5, 'Rangpur', NULL, 'Active'),
(6, 'Sylhel', NULL, 'Active'),
(7, 'Barishal', NULL, 'Active'),
(8, 'Khulna', NULL, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `division_zones`
--

CREATE TABLE `division_zones` (
  `division_region_id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'male' COMMENT '''male'', ''female''',
  `qualification` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `honorium` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=true, 0=false',
  `other_special_day` text COLLATE utf8_unicode_ci,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `status` enum('active','inactive','pending','rejected') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `is_edit_request` tinyint(4) NOT NULL DEFAULT '0',
  `crated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `name`, `email`, `gender`, `qualification`, `class_id`, `honorium`, `other_special_day`, `created_by`, `updated_by`, `status`, `is_edit_request`, `crated_at`, `updated_at`) VALUES
(8, 'mmm', 'mm@gg.com', 'Male', 'uy', 1, 1, '', 1, NULL, 'pending', 0, '2018-04-16 13:19:57', NULL),
(9, 'bbil_doctor', 'bbil@bbil.com', 'Female', 'abc', 1, 0, '[{\"special_day\":\"day title1\",\"date\":\"1991-12-23\",\"message\":\"Today is his birthday\"},{\"special_day\":\"day title2\",\"date\":\"2017-03-12\",\"message\":\"Today is his birthday\"}]', 1, NULL, 'active', 0, '2018-04-16 13:32:25', NULL),
(2, 'bbil', 'blubird@bbil.com', 'Female', 'abc', 2, 0, '', 1, NULL, 'active', 0, '2018-04-16 09:08:51', NULL),
(10, 'Dr.lal mohammod', 'ad@gmail.com', 'Male', 'MBBS', 1, 1, '', 1, NULL, 'inactive', 0, '2018-04-17 04:42:18', NULL),
(3, 'blubird', 'blubird@bbil.com', 'Female', 'abc', 2, 0, '', 1, NULL, 'active', 0, '2018-04-16 09:12:44', NULL),
(1, 'new doctor bbil', 'fgtyhn@fghty.gg,', 'Female', 'new', 2, 1, '', 1, NULL, 'inactive', 0, '2018-04-16 10:33:13', NULL),
(5, 'new doctor bbil', 'fgtyhn@fghty.gg,', 'Female', 'new', 2, 1, '', 1, NULL, 'active', 0, '2018-04-16 10:33:19', NULL),
(6, 'new doctor bbil', 'fgtyhn@fghty.gg,', 'Female', 'new', 2, 1, '', 1, NULL, 'active', 0, '2018-04-16 10:33:28', NULL),
(7, 'frgthdn', '53t6t@fgb.ggg,wfgty6hn@fgtyh.gg', 'Female', 'rfgfq', 2, 1, '', 1, NULL, 'active', 0, '2018-04-16 10:36:56', NULL),
(11, 'Mrs doctor', 'gytjhnuj@rgty.hyy', 'Female', 'MBBS', 1, 1, '', 1, NULL, 'active', 0, '2018-04-19 07:04:38', NULL),
(12, 'vffbg', 'gfb@fgth.hh', 'Female', 'fvgb', 1, 1, '', 1, NULL, 'pending', 0, '2018-04-19 11:48:53', NULL),
(13, 'vffbg', 'gfb@fgth.hh', 'Female', 'fvgb', 1, 1, '', 1, NULL, 'active', 0, '2018-04-19 11:49:01', NULL),
(14, '1234', 'sdfbghry@frhyj.gg', 'Female', 'e3r4tg', 4, 1, '', 1, NULL, 'active', 0, '2018-04-19 11:50:15', NULL),
(15, '1234', 'sdfbghry@frhyj.gg', 'Female', 'e3r4tg', 4, 1, '', 1, NULL, 'active', 0, '2018-04-19 11:50:30', NULL),
(16, '1234', 'sdfbghry@frhyj.gg', 'Female', 'e3r4tg', 4, 1, '', 1, NULL, 'active', 0, '2018-04-19 11:50:52', NULL),
(17, 'gfh', 'aa@gg.com', 'Female', 'fhfgh', 2, 1, '', 1, NULL, 'active', 0, '2018-04-19 13:00:45', NULL),
(18, 'gfh', 'aa@gg.com', 'Female', 'fhfgh', 2, 1, '', 1, NULL, 'active', 0, '2018-04-19 13:05:08', NULL),
(19, 'gfh', 'aa@gg.com', 'Female', 'fhfgh', 2, 1, '', 1, NULL, 'active', 0, '2018-04-19 13:07:08', NULL),
(20, 'gfh', 'aa@gg.com', 'Female', 'fhfgh', 2, 1, '', 1, NULL, 'active', 0, '2018-04-19 13:08:35', NULL),
(21, 'Salauddin Molla', 'aa@gg.com', 'Female', 'tryrfy', 3, 1, '', 1, NULL, 'active', 0, '2018-04-19 13:09:13', NULL),
(22, 'bbil_doctor', 'bbil@bbil.com', 'Female', 'abc', 1, 0, '[{\"special_day\":\"day title1\",\"date\":\"1991-12-23\",\"message\":\"Today is his birthday\"},{\"special_day\":\"day title2\",\"date\":\"2017-03-12\",\"message\":\"Today is his birthday\"}]', 1, NULL, 'pending', 0, '2018-04-27 14:33:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_categories`
--

CREATE TABLE `doctor_categories` (
  `doctor_category_d` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active' COMMENT 'active, inactive'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_chambers`
--

CREATE TABLE `doctor_chambers` (
  `doctor_chamber_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `address_line1` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `address_line2` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `division` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `district` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `thana` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctor_chambers`
--

INSERT INTO `doctor_chambers` (`doctor_chamber_id`, `doctor_id`, `address_line1`, `address_line2`, `division`, `district`, `thana`, `zip`) VALUES
(98, 1, 'addr1', '', '1', '2', '26', '26'),
(93, 2, 'addr1', '', '1', '1', '1', '1'),
(86, 3, 'addr1', 'addr2', '1', '1', '1', '1'),
(87, 3, 'addr1.2', 'addr2.2', '2', '1', '1', '1'),
(99, 7, 'dsefrt5hy', '', '3', '20', '195', '195'),
(100, 7, 'sadfgrth', '', '2', '15', '116', '116'),
(101, 8, 'fhfh', '', '2', '16', '134', '134'),
(102, 9, 'addr1', 'addr2', '1', '2', '1', '1234'),
(103, 9, 'addr1.2', 'addr2.2', '2', '1', '5', '4321'),
(104, 10, 'amd', '', '1', '1', '14', '14'),
(107, 11, 'thyj', '', '3', '21', '206', '206'),
(109, 16, 'dv', '', '3', '20', '194', '194'),
(110, 20, 'fhfhf', '', '5', '42', '408', '408'),
(114, 21, 'rtyry', '', '3', '21', '202', '202'),
(112, 22, 'addr1', 'addr2', '1', '2', '1', '1234'),
(113, 22, 'addr1.2', 'addr2.2', '2', '1', '5', '4321');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_contacts`
--

CREATE TABLE `doctor_contacts` (
  `doctor_contact_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `contact_no` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctor_contacts`
--

INSERT INTO `doctor_contacts` (`doctor_contact_id`, `doctor_id`, `contact_no`) VALUES
(42, 1, '12345678'),
(41, 1, '1234567'),
(26, 2, '12345670'),
(25, 2, '1234560'),
(21, 3, '1234560'),
(20, 3, '12345670'),
(19, 3, '123456780'),
(13, 4, '585852'),
(14, 5, '585852'),
(15, 6, '585852'),
(44, 7, '2134567'),
(43, 7, '234567'),
(27, 2, '123456780'),
(40, 1, '123456'),
(45, 8, '5345'),
(46, 9, '1234560'),
(47, 9, '1234560'),
(48, 10, '01723100459'),
(52, 11, '234567'),
(53, 12, '2345'),
(54, 13, '2345'),
(55, 14, '12345678'),
(56, 15, '12345678'),
(58, 16, '12345678'),
(59, 17, '67547576578568'),
(60, 18, '67547576578568'),
(61, 19, '67547576578568'),
(62, 20, '67547576578568'),
(66, 21, '4645r6754r67'),
(64, 22, '1234560'),
(65, 22, '1234560');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_dcr`
--

CREATE TABLE `doctor_dcr` (
  `doctor_dcr_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'MPO Type user ID',
  `remark` text COLLATE utf8_unicode_ci,
  `time` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending' COMMENT '''pending'', ''accepted'', ''rejected''',
  `reject_reason` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Doctor Visitor by MPO';

--
-- Dumping data for table `doctor_dcr`
--

INSERT INTO `doctor_dcr` (`doctor_dcr_id`, `doctor_id`, `user_id`, `remark`, `time`, `status`, `reject_reason`, `created_at`, `updated_at`) VALUES
(1, 22, 1, 'dxvdc dfvdfg', '10', 'pending', '.', '2018-04-16 16:43:42', '2018-04-16 00:00:00'),
(2, 22, 1, 'dxvdc dfvdfg', '10', 'pending', '.', '2018-04-16 16:44:19', '2018-04-16 00:00:00'),
(3, 22, 1, 'dxvdc dfvdfg', '10', 'pending', '.', '2018-04-17 16:46:50', '2018-04-17 00:00:00'),
(4, 22, 1, 'dxvdc dfvdfg', '10', 'pending', '.', '2018-04-17 16:47:59', '2018-04-17 00:00:00'),
(5, 22, 1, 'dxvdc dfvdfg', '10', 'pending', '.', '2018-04-17 16:49:05', '2018-04-17 00:00:00'),
(6, 22, 1, 'dxvdc dfvdfg', '10', 'pending', '.', '2018-04-17 16:49:36', '2018-04-17 00:00:00'),
(7, 22, 1, 'dxvdc dfvdfg', '10', 'pending', '.', '2018-04-17 16:50:17', '2018-04-17 00:00:00'),
(8, 22, 1, 'dxvdc dfvdfg', '10', 'pending', '.', '2018-04-17 16:50:34', '2018-04-17 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_dcr_gifts`
--

CREATE TABLE `doctor_dcr_gifts` (
  `doctor_dcr_gift_id` int(11) NOT NULL,
  `doctor_dcr_id` int(11) NOT NULL,
  `gift_name` text NOT NULL,
  `quantity` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_dcr_ppms`
--

CREATE TABLE `doctor_dcr_ppms` (
  `doctor_dcr_ppm_id` int(11) NOT NULL,
  `ppm_id` int(11) DEFAULT NULL,
  `doctor_dcr_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_dcr_products`
--

CREATE TABLE `doctor_dcr_products` (
  `doctor_dcr_product_id` int(11) NOT NULL,
  `doctor_dcr_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctor_dcr_products`
--

INSERT INTO `doctor_dcr_products` (`doctor_dcr_product_id`, `doctor_dcr_id`, `product_id`) VALUES
(1, 8, 1),
(2, 8, 2),
(3, 8, 3),
(4, 1, 1),
(5, 1, 2),
(6, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_dcr_sample_products`
--

CREATE TABLE `doctor_dcr_sample_products` (
  `doctor_dcr_sample_product_id` int(11) NOT NULL,
  `doctor_dcr_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_dcr_visit_team`
--

CREATE TABLE `doctor_dcr_visit_team` (
  `doctor_dcr_visit_team_id` int(11) NOT NULL,
  `doctor_dcr_id` int(11) NOT NULL,
  `team_member_id` int(11) NOT NULL COMMENT 'user_id visited with'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_edit_requests`
--

CREATE TABLE `doctor_edit_requests` (
  `doctor_edit_request_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'male' COMMENT '''male'', ''female''',
  `qualification` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `honorium` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=true, 0=false',
  `other_special_day` text COLLATE utf8_unicode_ci,
  `contacts` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `specialities` text COLLATE utf8_unicode_ci,
  `special_days` text COLLATE utf8_unicode_ci,
  `chamber_address` text COLLATE utf8_unicode_ci,
  `home_address1` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `home_division` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `home_district` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `home_thana` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `home_zip` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctor_edit_requests`
--

INSERT INTO `doctor_edit_requests` (`doctor_edit_request_id`, `doctor_id`, `name`, `email`, `gender`, `qualification`, `class_id`, `honorium`, `other_special_day`, `contacts`, `specialities`, `special_days`, `chamber_address`, `home_address1`, `home_division`, `home_district`, `home_thana`, `home_zip`) VALUES
(1, 8, 'mmm', 'mm@gg.com', 'Male', 'tyutuy', 1, 1, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 9, 'bbil_doctor', 'bbil@bbil.com', 'Female', 'abckli', 1, 0, '[{\"special_day\":\"day title1\",\"date\":\"1991-12-23\",\"message\":\"Today is his birthday\"},{\"special_day\":\"day title2\",\"date\":\"2017-03-12\",\"message\":\"Today is his birthday\"}]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_home_address`
--

CREATE TABLE `doctor_home_address` (
  `doctor_home_address_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `address_line1` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `address_line2` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `division` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `district` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thana` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctor_home_address`
--

INSERT INTO `doctor_home_address` (`doctor_home_address_id`, `doctor_id`, `address_line1`, `address_line2`, `division`, `district`, `thana`, `zip`) VALUES
(17, 1, 'Shyamoli, Dhaka', '', '1', '2', '30', '30'),
(12, 2, 'Shyamoli, Dhaka', '', '1', '1', '1', '1'),
(10, 3, 'Shyamoli, Dhaka', '', '1', '1', '1', '1'),
(5, 4, 'defrgbnh', '', '2', '16', '128', '128'),
(6, 5, 'defrgbnh', '', '2', '16', '128', '128'),
(7, 6, 'defrgbnh', '', '2', '16', '128', '128'),
(18, 7, 'wdefrgthy', '', '5', '40', '396', '396'),
(19, 8, 'fgh', '', '3', '20', '195', '195'),
(20, 9, 'Shyamoli, Dhaka', '', '1', '2', '1', 'z12345'),
(21, 10, 'sdsaf', '', '8', '63', '376', '376'),
(25, 11, 'hyjunh', '', '3', '20', '194', '194'),
(26, 12, 'rgthyj', '', '6', '48', '176', '176'),
(27, 13, 'rgthyj', '', '6', '48', '176', '176'),
(28, 14, 'dcdvfwr', '', '2', '16', '135', '135'),
(29, 15, 'dcdvfwr', '', '2', '16', '135', '135'),
(31, 16, 'dcdvfwr', '', '2', '16', '135', '135'),
(32, 17, '6456', '', '4', '32', '443', '443'),
(33, 18, '6456', '', '4', '32', '443', '443'),
(34, 19, '6456', '', '4', '32', '443', '443'),
(35, 20, '6456', '', '4', '32', '443', '443'),
(38, 21, '', '', '', '', '', ''),
(37, 22, 'Shyamoli, Dhaka', '', '1', '2', '1', 'z12345');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_specialities`
--

CREATE TABLE `doctor_specialities` (
  `doctor_speciality_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `speciality_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctor_specialities`
--

INSERT INTO `doctor_specialities` (`doctor_speciality_id`, `doctor_id`, `speciality_id`) VALUES
(28, 8, 3),
(27, 8, 1),
(25, 1, 1),
(29, 9, 1),
(20, 2, 3),
(19, 2, 1),
(12, 5, 3),
(11, 4, 3),
(16, 3, 1),
(13, 6, 3),
(26, 7, 1),
(30, 9, 2),
(31, 9, 3),
(32, 10, 1),
(36, 11, 2),
(37, 12, 1),
(38, 13, 1),
(39, 14, 2),
(40, 15, 2),
(42, 16, 2),
(43, 17, 2),
(44, 17, 3),
(45, 17, 5),
(46, 18, 2),
(47, 18, 3),
(48, 18, 5),
(49, 19, 2),
(50, 19, 3),
(51, 19, 5),
(52, 20, 2),
(53, 20, 3),
(54, 20, 5),
(59, 21, 2),
(56, 22, 1),
(57, 22, 2),
(58, 22, 3);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_special_days`
--

CREATE TABLE `doctor_special_days` (
  `doctor_special_day_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `special_day_id` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctor_special_days`
--

INSERT INTO `doctor_special_days` (`doctor_special_day_id`, `doctor_id`, `special_day_id`, `message`, `date`) VALUES
(24, 1, 2, '', '2017-03-12'),
(23, 1, 1, '', '1991-12-23'),
(14, 2, 2, '', '2017-03-12'),
(13, 2, 1, '', '1991-12-23'),
(26, 7, 2, '', '2018-04-19'),
(25, 7, 1, '', '2018-04-04'),
(27, 8, 1, '', '2018-04-17'),
(28, 9, 1, 'Today is his birthday', '1991-12-23'),
(29, 9, 2, 'Today is his birthday', '2017-03-12'),
(30, 10, 1, '', '2018-04-17'),
(36, 16, 2, '', '2018-04-13'),
(34, 11, 1, '', '2018-04-06'),
(37, 22, 1, 'Today is his birthday', '1991-12-23'),
(38, 22, 2, 'Today is his birthday', '2017-03-12');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_special_day_types`
--

CREATE TABLE `doctor_special_day_types` (
  `doctor_special_day_type_id` int(11) NOT NULL,
  `name` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctor_special_day_types`
--

INSERT INTO `doctor_special_day_types` (`doctor_special_day_type_id`, `name`, `status`) VALUES
(1, 'BD', 'active'),
(2, 'MD', 'active'),
(3, 'DDRM', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `feature_id` int(10) UNSIGNED NOT NULL,
  `feature_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`feature_id`, `feature_name`, `created_at`, `updated_at`) VALUES
(1, 'Dashbord', '2018-04-23 18:00:00', NULL),
(2, 'Products', '2018-04-23 18:00:00', NULL),
(3, 'Doctors', '2018-04-23 18:00:00', NULL),
(4, 'Chemists', '2018-04-23 18:00:00', NULL),
(5, 'Prescription list', '2018-04-23 18:00:00', NULL),
(6, 'Prescription Accept & reject', '2018-04-23 18:00:00', NULL),
(7, 'Report AM', '2018-04-23 18:00:00', NULL),
(8, 'Report MPO', '2018-04-23 18:00:00', NULL),
(9, 'Target Septup', '2018-04-23 18:00:00', NULL),
(10, 'User List ', '2018-04-23 18:00:00', NULL),
(11, 'Create User', '2018-04-23 18:00:00', NULL),
(12, 'User Role Permission', '2018-04-23 18:00:00', NULL),
(13, 'Location Setup', '2018-04-23 18:00:00', NULL),
(14, 'Location Mapping', '2018-04-23 18:00:00', NULL),
(15, 'Chemist Category', '2018-04-23 18:00:00', NULL),
(16, 'Create Special Day', '2018-04-23 18:00:00', NULL),
(17, 'Create Doctor Speciality ', '2018-04-23 18:00:00', NULL),
(18, 'Create Docor Class', '2018-04-23 18:00:00', NULL),
(19, 'Create Chemist Class', '2018-04-23 18:00:00', NULL),
(20, 'Create Chemist Special Day type', '2018-04-23 18:00:00', NULL),
(21, 'Create Doctor Special Day type', '2018-04-23 18:00:00', NULL),
(22, 'Message Template', '2018-04-23 18:00:00', NULL),
(23, 'Notification', '2018-04-23 18:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feature_actions`
--

CREATE TABLE `feature_actions` (
  `feature_action_id` int(11) NOT NULL,
  `sub_feature_id` int(11) NOT NULL,
  `action_name` varchar(45) NOT NULL,
  `creatd_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feature_actions`
--

INSERT INTO `feature_actions` (`feature_action_id`, `sub_feature_id`, `action_name`, `creatd_at`, `update_at`) VALUES
(1, 1, 'login', '2018-04-25 13:22:25', NULL),
(2, 2, 'Top 5 Products', '2018-04-25 13:22:25', NULL),
(3, 2, 'Top 10 Doctors', '2018-04-25 13:22:25', NULL),
(4, 2, 'Prescription by Division', '2018-04-25 13:22:25', NULL),
(5, 3, 'Doctor Create', '2018-04-25 13:22:26', NULL),
(6, 3, 'Doctor Edit', '2018-04-25 13:22:26', NULL),
(7, 3, 'Doctor Delete', '2018-04-25 13:22:26', NULL),
(8, 3, 'Doctor List', '2018-04-25 13:22:26', NULL),
(9, 4, 'Chemist Create', '2018-04-25 13:22:26', NULL),
(10, 4, 'Chemist Edit', '2018-04-25 13:22:26', NULL),
(11, 4, 'Chemist Delete', '2018-04-25 13:22:26', NULL),
(12, 4, 'Chemist List', '2018-04-25 13:22:26', NULL),
(13, 5, 'AM Report', '2018-04-25 13:22:26', NULL),
(14, 5, 'MPO Report', '2018-04-25 13:22:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `location_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `location_maping`
--

CREATE TABLE `location_maping` (
  `location_maping_id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `territory_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `location_type`
--

CREATE TABLE `location_type` (
  `location_type_id` int(11) NOT NULL,
  `type` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `location_type`
--

INSERT INTO `location_type` (`location_type_id`, `type`) VALUES
(1, 'Division'),
(2, 'Zone'),
(3, 'Region'),
(4, 'Area'),
(5, 'Territory');

-- --------------------------------------------------------

--
-- Table structure for table `login_log`
--

CREATE TABLE `login_log` (
  `login_log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logout_time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mpo_targets`
--

CREATE TABLE `mpo_targets` (
  `mpo_target_id` int(11) NOT NULL,
  `mpo_id` int(11) NOT NULL,
  `target_start_date` date NOT NULL,
  `target_end_date` date DEFAULT NULL,
  `target_type_id` int(11) NOT NULL,
  `unit` int(10) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mpo_targets`
--

INSERT INTO `mpo_targets` (`mpo_target_id`, `mpo_id`, `target_start_date`, `target_end_date`, `target_type_id`, `unit`, `created_at`, `updated_at`, `created_by`) VALUES
(21, 30, '2022-04-01', NULL, 1, 10, '2018-04-24', NULL, 58),
(22, 30, '2022-04-01', NULL, 2, 10, '2018-04-24', NULL, 58),
(23, 30, '2022-04-01', NULL, 3, 10, '2018-04-24', NULL, 58),
(24, 30, '2022-04-01', NULL, 4, 11, '2018-04-24', NULL, 58),
(25, 59, '2021-01-01', NULL, 1, 50, '2018-04-24', NULL, 58),
(26, 59, '2021-01-01', NULL, 2, 50, '2018-04-24', NULL, 58),
(27, 59, '2021-01-01', NULL, 3, 50, '2018-04-24', NULL, 58),
(28, 59, '2021-01-01', NULL, 4, 50, '2018-04-24', NULL, 58),
(29, 59, '2018-04-01', NULL, 1, 50, '2018-04-24', NULL, 58),
(30, 59, '2018-04-01', NULL, 2, 50, '2018-04-24', NULL, 58),
(31, 59, '2018-04-01', NULL, 3, 50, '2018-04-24', NULL, 58),
(32, 59, '2018-04-01', NULL, 4, 50, '2018-04-24', NULL, 58),
(33, 30, '2018-04-01', NULL, 1, 50, '2018-04-24', NULL, 58),
(34, 30, '2018-04-01', NULL, 2, 50, '2018-04-24', NULL, 58),
(35, 30, '2018-04-01', NULL, 3, 50, '2018-04-24', NULL, 58),
(36, 30, '2018-04-01', NULL, 4, 50, '2018-04-24', NULL, 58);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ppms`
--

CREATE TABLE `ppms` (
  `ppm_id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `created_by` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ppms`
--

INSERT INTO `ppms` (`ppm_id`, `name`, `status`, `created_at`, `updated_at`, `created_by`) VALUES
(1, 'PPM1', '', '2018-04-29 17:59:55', '0000-00-00 00:00:00', '1'),
(2, 'PPM2', '', '2018-04-29 18:00:01', '0000-00-00 00:00:00', '2');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `prescription_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'MPO Type user ID',
  `doctor_id` int(11) NOT NULL,
  `status` enum('pending','accepted','rejected','') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending' COMMENT 'pending, accepted, rejected',
  `updated_by` int(11) DEFAULT NULL COMMENT 'The User_id who updated the status ',
  `division_id` int(10) DEFAULT NULL,
  `area_id` int(10) DEFAULT NULL,
  `zone_id` int(10) DEFAULT NULL,
  `territory_id` int(10) DEFAULT NULL,
  `reject_reason` text COLLATE utf8_unicode_ci COMMENT 'why Rejected',
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`prescription_id`, `user_id`, `doctor_id`, `status`, `updated_by`, `division_id`, `area_id`, `zone_id`, `territory_id`, `reject_reason`, `created_at`, `updated_at`) VALUES
(1, 30, 1, 'rejected', NULL, 1, NULL, NULL, NULL, 'fdvfdv', '2018-04-17', NULL),
(2, 31, 2, 'rejected', NULL, 2, NULL, NULL, NULL, 'ret', '2018-04-17', NULL),
(3, 59, 5, 'rejected', NULL, 3, NULL, NULL, NULL, 'no reason', '2018-04-17', NULL),
(4, 31, 3, 'accepted', NULL, 4, NULL, NULL, NULL, NULL, '2018-04-17', NULL),
(5, 30, 3, 'rejected', NULL, 5, NULL, NULL, NULL, 'swedf 4rf', '2018-04-17', NULL),
(6, 31, 5, 'rejected', NULL, 6, NULL, NULL, NULL, 'edf', '2018-04-17', NULL),
(7, 59, 5, 'accepted', NULL, 7, NULL, NULL, NULL, NULL, '2018-04-17', NULL),
(8, 31, 7, 'rejected', NULL, 8, NULL, NULL, NULL, 'gbbvbvd', '2018-04-17', NULL),
(9, 1, 1, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prescription_details`
--

CREATE TABLE `prescription_details` (
  `prescription_detail_id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `prescription_details`
--

INSERT INTO `prescription_details` (`prescription_detail_id`, `prescription_id`, `product_id`) VALUES
(1, 1, 5),
(2, 2, 5),
(3, 3, 5),
(4, 4, 10),
(5, 5, 5),
(6, 6, 6),
(7, 7, 17),
(8, 8, 8),
(9, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `prescription_images`
--

CREATE TABLE `prescription_images` (
  `prescription_image_id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `image_path` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription_images`
--

INSERT INTO `prescription_images` (`prescription_image_id`, `prescription_id`, `image_path`) VALUES
(1, 2, '/uploads/prescriptions/pr1.png'),
(2, 7, '/uploads/prescriptions/pr2.png'),
(3, 7, '/uploads/prescriptions/pr2.png'),
(4, 2, '/uploads/prescriptions/pr2.png'),
(5, 4, '/uploads/prescriptions/pr1.png'),
(6, 4, '/uploads/prescriptions/pr2.png'),
(7, 4, '/uploads/prescriptions/pr2.png'),
(8, 4, '/uploads/prescriptions/pr2.png');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `product_code` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `packet_size` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price_tp` decimal(10,2) NOT NULL,
  `price_vat` decimal(10,2) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `updated_by` timestamp NULL DEFAULT NULL COMMENT 'keep JSON data. Kep Pair is: User_ID : Date: Name: cat: type:',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedf_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `category_id`, `type_id`, `product_code`, `packet_size`, `price_tp`, `price_vat`, `created_by`, `status`, `updated_by`, `created_at`, `updatedf_at`) VALUES
(1, 'bbil product one', 1, 1, '2000', '10', 150.00, 35.00, 1, 'active', '0000-00-00 00:00:00', '2018-04-06 09:33:54', '0000-00-00 00:00:00'),
(2, 'bbil product two', 1, 1, '2000', '10', 150.00, 35.00, 1, 'active', '0000-00-00 00:00:00', '2018-04-06 09:34:46', '0000-00-00 00:00:00'),
(3, 'bbil product three', 1, 1, '2000', '10', 150.00, 35.00, 1, 'active', '0000-00-00 00:00:00', '2018-04-06 09:34:46', '0000-00-00 00:00:00'),
(4, 'bbil product four', 1, 1, '2000', '10', 150.00, 35.00, 1, 'active', '0000-00-00 00:00:00', '2018-04-06 09:33:54', '0000-00-00 00:00:00'),
(5, 'bbil product five', 1, 1, '2000', '10', 150.00, 35.00, 1, 'active', '0000-00-00 00:00:00', '2018-04-06 09:34:46', '0000-00-00 00:00:00'),
(6, 'bbil product six', 1, 1, '2000', '10', 150.00, 35.00, 1, 'active', '0000-00-00 00:00:00', '2018-04-06 09:34:46', '0000-00-00 00:00:00'),
(7, 'bbil product seven', 1, 1, '2000', '10', 150.00, 35.00, 1, 'active', '0000-00-00 00:00:00', '2018-04-06 09:33:54', '0000-00-00 00:00:00'),
(8, 'Acedol SR Tablet', 1, 1, 'ACST', '510', 262.37, 308.02, 20, 'active', '0000-00-00 00:00:00', '2018-04-06 09:34:46', '0000-00-00 00:00:00'),
(9, 'bbil product nine', 1, 1, '2000', '10', 150.00, 35.00, 1, 'inactive', '0000-00-00 00:00:00', '2018-04-06 09:34:46', '0000-00-00 00:00:00'),
(10, 'bbil product ten', 1, 1, '2000', '10', 150.00, 35.00, 1, 'active', '0000-00-00 00:00:00', '2018-04-06 09:33:54', '0000-00-00 00:00:00'),
(11, 'bbil product eleven', 1, 1, '2000', '10', 150.00, 35.00, 1, 'inactive', '0000-00-00 00:00:00', '2018-04-06 09:34:46', '0000-00-00 00:00:00'),
(12, 'bbil product twelve', 1, 1, '2000', '10', 150.00, 35.00, 1, 'inactive', '0000-00-00 00:00:00', '2018-04-06 09:34:46', '0000-00-00 00:00:00'),
(14, 'new one DD', NULL, NULL, '4', '4', 450.00, 4550.00, 20, 'inactive', NULL, '2018-04-07 08:19:37', NULL),
(15, 'C_pro', NULL, NULL, '1258', '10', 10.00, 10.00, 20, 'inactive', NULL, '2018-04-09 07:26:15', NULL),
(16, 'product one edit', NULL, NULL, 'p1230', '100', 15000.00, 102500.00, 20, 'active', NULL, '2018-04-11 11:11:55', NULL),
(17, 'pro', NULL, NULL, 'pro90', '10', 15000.00, 125000.00, 20, 'active', NULL, '2018-04-11 11:14:30', NULL),
(18, 'pro91', NULL, NULL, '1230', '1250', 25000000.00, 35.00, 20, 'active', NULL, '2018-04-11 11:16:47', NULL),
(19, 'pro92', NULL, NULL, 'pop12', '10', 12.50, 13.50, 20, 'active', NULL, '2018-04-11 11:18:50', NULL),
(20, 'dvfbkkk', NULL, NULL, 'fv', '10', 12.00, 12.00, 20, 'active', NULL, '2018-04-11 11:49:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `region_id` int(11) NOT NULL,
  `region_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active' COMMENT 'Active, Inactive'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `region_areas`
--

CREATE TABLE `region_areas` (
  `region_area_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `are_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `name`) VALUES
(1, 'SM'),
(2, 'ZSM'),
(3, 'RSM'),
(4, 'AM'),
(5, 'MPO');

-- --------------------------------------------------------

--
-- Table structure for table `role_features`
--

CREATE TABLE `role_features` (
  `role_permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `feature_id` int(11) NOT NULL,
  `sub_feature_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sms_templates`
--

CREATE TABLE `sms_templates` (
  `sms_template_id` int(11) NOT NULL,
  `sms_type` int(11) NOT NULL COMMENT '1=system specila days; 2= Doctor special days; 3= Chemist special days',
  `special_day_type_id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sms_templates`
--

INSERT INTO `sms_templates` (`sms_template_id`, `sms_type`, `special_day_type_id`, `content`, `created_at`) VALUES
(1, 2, 1, 'Happy Birthday [name]', '2018-03-30 11:45:27'),
(2, 2, 2, 'Happy merriage anniversary [name]', '2018-03-30 11:45:27');

-- --------------------------------------------------------

--
-- Table structure for table `specialities`
--

CREATE TABLE `specialities` (
  `speciality_id` int(11) NOT NULL,
  `name` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `specialities`
--

INSERT INTO `specialities` (`speciality_id`, `name`, `status`) VALUES
(1, 'Cardiology edit', 'inactive'),
(2, 'new 10', 'active'),
(3, '102', 'inactive'),
(4, 'New Specialit', 'active'),
(5, 'dcdc', 'inactive'),
(6, 'hyn', 'active'),
(7, 'Bone Special', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `sub_features`
--

CREATE TABLE `sub_features` (
  `sub_feature_id` int(10) NOT NULL,
  `feature_id` int(10) NOT NULL,
  `sub_feature_name` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_features`
--

INSERT INTO `sub_features` (`sub_feature_id`, `feature_id`, `sub_feature_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'login', '2018-04-25 13:22:13', NULL),
(2, 2, 'Top 5 Products', '2018-04-25 13:22:14', NULL),
(3, 2, 'Top 10 Doctors', '2018-04-25 13:22:14', NULL),
(4, 2, 'Prescription by Division', '2018-04-25 13:22:14', NULL),
(5, 3, 'Doctor Create', '2018-04-25 13:22:14', NULL),
(6, 3, 'Doctor Edit', '2018-04-25 13:22:14', NULL),
(7, 3, 'Doctor Delete', '2018-04-25 13:22:14', NULL),
(8, 3, 'Doctor List', '2018-04-25 13:22:14', NULL),
(9, 4, 'Chemist Create', '2018-04-25 13:22:14', NULL),
(10, 4, 'Chemist Edit', '2018-04-25 13:22:14', NULL),
(11, 4, 'Chemist Delete', '2018-04-25 13:22:14', NULL),
(12, 4, 'Chemist List', '2018-04-25 13:22:14', NULL),
(13, 5, 'AM Report', '2018-04-25 13:22:14', NULL),
(14, 5, 'MPO Report', '2018-04-25 13:22:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_special_days`
--

CREATE TABLE `system_special_days` (
  `system_special_day_id` int(11) NOT NULL,
  `name` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `date` date NOT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `system_special_days`
--

INSERT INTO `system_special_days` (`system_special_day_id`, `name`, `message`, `date`, `status`) VALUES
(1, 'Independent Day', NULL, '1970-01-01', 'active'),
(2, 'Birth Day of Seikh Muzib', NULL, '2018-03-17', 'inactive'),
(3, 'Holiday', NULL, '1970-01-01', 'active'),
(4, 'New Dates', NULL, '2018-04-09', 'active'),
(5, 'New Date From here', NULL, '2019-09-30', 'inactive'),
(6, 'test', NULL, '1970-01-01', 'active'),
(7, 'test edit', NULL, '1970-01-01', 'active'),
(8, 'cdfgb', NULL, '2011-12-21', 'active'),
(9, 'new', NULL, '2018-11-07', 'active'),
(10, 'new one real', NULL, '2012-01-24', 'active'),
(11, 'cc', NULL, '2015-10-22', 'active'),
(12, 'cus', NULL, '2018-04-17', 'inactive'),
(13, 'tes', NULL, '2018-04-28', 'active'),
(14, 'Gym', NULL, '2018-04-30', 'active'),
(15, 'new onehh', NULL, '2018-04-18', 'active'),
(16, 'kazi', NULL, '2010-10-10', 'active'),
(17, 'Kazi again', NULL, '2012-12-12', 'active'),
(18, 'kazi Another', NULL, '2010-10-10', 'active'),
(19, 'go', NULL, '2018-04-18', 'active'),
(20, 'y', NULL, '2020-04-20', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `target_types`
--

CREATE TABLE `target_types` (
  `target_type_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL COMMENT 'Collection, visit, prescription, order etc',
  `target_for` enum('doctor','chemist','','') NOT NULL,
  `is_financial_target` tinyint(4) NOT NULL COMMENT 'can be financial target',
  `status` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `target_types`
--

INSERT INTO `target_types` (`target_type_id`, `name`, `target_for`, `is_financial_target`, `status`, `created_at`, `updated_at`, `created_by`) VALUES
(1, 'prescription', 'doctor', 1, 1, 0, 0, 0),
(2, 'visit', 'doctor', 0, 1, 0, 0, 0),
(3, 'collection', 'chemist', 1, 1, 0, 0, 0),
(4, 'order', 'chemist', 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `territories`
--

CREATE TABLE `territories` (
  `territory_id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active' COMMENT 'Active, Inactive'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `territories`
--

INSERT INTO `territories` (`territory_id`, `name`, `code`, `status`) VALUES
(1, 'Shymoli', '1234', 'Active'),
(2, 'moha', '8576', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `thanas`
--

CREATE TABLE `thanas` (
  `thana_id` int(11) NOT NULL,
  `thana_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `first_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `passcode` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_oauth_token` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active' COMMENT '''active'',''inactive'',''deleted''',
  `forcely_logout` tinyint(4) NOT NULL DEFAULT '0',
  `is_registered` tinyint(1) NOT NULL DEFAULT '0',
  `last_login_time` datetime DEFAULT NULL,
  `last_logout_time` datetime DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT '6',
  `password` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hr_port` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_port` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `home_contact` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `personal_contact` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `work_contact` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_imei` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_reset` tinyint(4) NOT NULL DEFAULT '0',
  `location_type_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `is_view_password` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `parent_id`, `first_name`, `last_name`, `user_id`, `passcode`, `active_oauth_token`, `status`, `forcely_logout`, `is_registered`, `last_login_time`, `last_logout_time`, `role_id`, `password`, `email`, `hr_port`, `account_port`, `home_contact`, `personal_contact`, `work_contact`, `active_imei`, `password_reset`, `location_type_id`, `location_id`, `is_view_password`, `remember_token`, `created_at`, `updated_at`) VALUES
(30, 1, 'SK', 'Reaz', 'reaz', '$2y$10$bud/b/RFqaLXatVerBbpweiQUPU7tQXGxXyX1hZXTMsvsFu6PastW', 'bnhjYWMyZjY=', 'active', 0, 1, '2018-04-27 01:15:52', NULL, 5, '$2y$10$TchjWrqYM6/FK7GDskIeoO6ZUrtnukdS/LmXGTz7iEgMLxo.YIVmO', 'reaz@blubirdinteractive.com', 'BluBird', 'BluBird', '000111222', '000111222', '000111222', '868716030708152ss', 0, NULL, 1, NULL, NULL, '2018-04-06 17:03:51', NULL),
(31, 29, 'sk', 'Rigan', 'rigan', '$2y$10$pThEIQT2wGOvVnpgYqhquOruue9T/jhvR7GNcim29.NJUy4I4hznq', 'a3I3MTZ5ZmU=', 'inactive', 0, 1, NULL, NULL, 5, '$2y$10$KrCfd/tZpxfB8yzcx/CXEOZuiQWsKXafWqjS8L0.WVnsg/0jXaVva', 'rigan@bbil.com', 'BBIL', 'BBIL', '1234567', '1234567', '1234567', '352525061368395', 0, NULL, 2, NULL, NULL, '2018-04-07 06:35:40', NULL),
(61, 1, 'Kazi', 'Shahin', 'kazi', '$2y$10$lqU.NORCjvOQFi8KkvUx6u.khMLWjxcs1CwQ6wCOhLGvrOBXgCbZS', 'OGFpeGo0NzQ=', 'active', 0, 1, NULL, NULL, 5, '$2y$10$/YTB9sRGvvGhDeeCnIzzNupIVmyyiTxS46lbxxPeuosq7SOdDke0u', 'root@root.com', '356379067607745', '356379067607745', '356379067607745', '356379067607745', '356379067607745', '356379067607745', 0, NULL, 2, '2x556uQ/xM12MHvp33YPDyLMzC2lpJL5B5YRO3hF6TM=', NULL, '2018-04-24 07:51:07', NULL),
(60, 58, 'Md asd', 'masda', 'reaz101', '$2y$10$FvspFa7WJvHJnIIfPudIY.pfY8sWVvzEjzt2TJzk7vABB.1I3sOoW', 'Z3IybWEzeXE=', 'inactive', 0, 1, NULL, NULL, 5, '$2y$10$/EOdVMGH3ULeGFT.aoYAn.Ye8mmrda5NJB2ZTkIWKJXdQr8G6ucpS', 'skresat108@gmail.com', 'sada', 'asd', '2222', '222', '2222', '868716030708152', 0, NULL, 2, 'xtUNBHUAXB37lQbRYdSWjey3vCMEXmD3mx2z7nrX67o=', NULL, '2018-04-21 20:08:52', NULL),
(57, 56, 'RSM', 'test', 'rsm', NULL, NULL, 'active', 0, 0, NULL, NULL, 3, '$2y$10$NEG40Nf9g8UtEkScLCo8VutP5ahrfsOm2z0yNc4hznN9ksP4cU.Dy', '', '2589', '2589', '2589', '2589', '2589', '', 0, NULL, 1, '2x556uQ/xM12MHvp33YPDyLMzC2lpJL5B5YRO3hF6TM=', NULL, '2018-04-16 08:40:29', NULL),
(1, 57, 'AM', 'User', 'admin@dcr.com', NULL, NULL, 'active', 0, 0, NULL, NULL, 4, '$2y$10$qRrmYLtLSfXBvHO9klfQv.9.oVHuQAi62ScSNjU84w2BMMeDe.5nG', '', '2589', '2589', '2589', '2589', '2589', '', 0, NULL, 1, '2x556uQ/xM12MHvp33YPDyLMzC2lpJL5B5YRO3hF6TM=', 'od69QGR0rXW241WjvaziIIakTkdEC2CkihqcADTGmZxJgiwH9Yvg1GAiFYfh', '2018-04-16 08:41:04', NULL),
(55, 0, 'SM', 'test', 'sm', NULL, NULL, 'active', 0, 0, NULL, NULL, 1, '$2y$10$TgMfiv2ukPW2P2c0kglbheiEsxEUeN2FMjpRo24JNJLUOGHo5I/cy', '', '2589', '2589', '2589', '2589', '2589', '', 0, NULL, 2, '2x556uQ/xM12MHvp33YPDyLMzC2lpJL5B5YRO3hF6TM=', NULL, '2018-04-16 08:36:04', NULL),
(56, 55, 'ZSM', 'test', 'zsm', NULL, NULL, 'active', 0, 0, NULL, NULL, 2, '$2y$10$9tHny2qEi8UROWqC0Xqm.uoflOaBQdfXNsZgU6F6TQGZDKUdzzfsW', '', '2589', '2589', '2589', '2589', '2589', '', 0, NULL, 2, '2x556uQ/xM12MHvp33YPDyLMzC2lpJL5B5YRO3hF6TM=', NULL, '2018-04-16 08:36:35', NULL),
(62, 1, 'Nazmul', 'BluBird', 'nazmul', '$2y$10$KBsr5cLVSuSlInutZmzpm.Flg2QyIKGtW5jOvL6APqtR25EnULZzq', 'cWo2cWs0ang=', 'active', 0, 1, NULL, NULL, 5, '$2y$10$sYbYiruQkmSjD/aqL3E8.eLNpXtVjvotod32fcEcBEM/yqrKee.F.', 'mdnhussain2014@gmail.com', 'Market002', 'Account003', '123456', '123456', '123456', '860369039488018', 0, NULL, 1, '2x556uQ/xM12MHvp33YPDyLMzC2lpJL5B5YRO3hF6TM=', NULL, '2018-04-25 11:48:03', NULL),
(63, 1, 'xyz', 'saa', 'reaz_01', '$2y$10$43raD298Spt0Ps5a.xlrvO9xmHVlDokJzMtYHEq8SAIm4Zb8Xc1b.', 'ZWw0dGtnMWo=', 'active', 0, 1, NULL, NULL, 5, '$2y$10$E1k/1H2gT4R7oA7sECQ69uMcD7GjYGOjQdpKbeMeHngKVgdhq04N6', 'sss@gmail.com', 'aaa', 'aaaa', '2434343', '334343', '33', '12345', 0, NULL, 1, '2x556uQ/xM12MHvp33YPDyLMzC2lpJL5B5YRO3hF6TM=', NULL, '2018-04-26 20:21:46', NULL),
(64, 1, 'adsds', 'asda', 'reaz_00', '$2y$10$gpX5eJHkPaOKukYCTSpaBONUMQwXgRi5ijFXv2UnXb2ol5hplY8eW', 'aWZ5czQ1Nmc=', 'active', 0, 1, '2018-05-12 12:21:49', NULL, 5, '$2y$10$4aw3qR2tUwznEloC.GsSy.W.W6UF.V1QupfyIbg8zHvE2BYyV/JBe', 'sss@gf.com', 'asda', 'asda', '224345655', '35456', '4656786', '123456', 0, NULL, 2, '2x556uQ/xM12MHvp33YPDyLMzC2lpJL5B5YRO3hF6TM=', NULL, '2018-04-27 10:30:02', NULL),
(65, 1, 'sdfdf', 'sdfsd', 'taj01', '$2y$10$RoxRlzAUtPHYL55XtwaXqOs5nd1SQxATYn9SpweZV0Oyg2cMOdL3e', 'NXg2Z2Y2djg=', 'active', 0, 1, '2018-04-28 02:30:24', NULL, 5, '$2y$10$D8uhGOLvXM/hwJoB53BtaO/fhIXuKoTvJ3RNLgg49Bqj699zQIUZS', 'sss@ggg.com', '3w', 'dsdd', '01784567890', '35678909876', '5467890765', '358856080405700', 0, NULL, 1, '2x556uQ/xM12MHvp33YPDyLMzC2lpJL5B5YRO3hF6TM=', NULL, '2018-04-27 10:56:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_designations`
--

CREATE TABLE `user_designations` (
  `user_designation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_imei_log`
--

CREATE TABLE `user_imei_log` (
  `user_imei_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `imei_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_location_log`
--

CREATE TABLE `user_location_log` (
  `user_location_log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `location_type_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_location_maping`
--

CREATE TABLE `user_location_maping` (
  `user_location_maping_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `territory_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_role_location_type`
--

CREATE TABLE `user_role_location_type` (
  `user_role_location_type_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `location_type_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE `user_sessions` (
  `user_session_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `oauth_token` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_sessions`
--

INSERT INTO `user_sessions` (`user_session_id`, `user_id`, `oauth_token`, `created_at`) VALUES
(1, 30, 'bXptaXIzcGM=', '2018-04-07 00:18:11'),
(2, 30, 'NnB4Nm0wdjE=', '2018-04-07 00:31:00'),
(3, 30, 'aTNobnRhYnU=', '2018-04-07 00:33:21'),
(4, 30, 'cGttZTVpdGE=', '2018-04-07 00:35:24'),
(5, 30, 'bHB0eXQ5azY=', '2018-04-07 00:36:13'),
(6, 30, 'eXFtMGF4amQ=', '2018-04-07 00:37:27'),
(7, 30, 'djFlZ21qNXk=', '2018-04-07 00:38:05'),
(8, 30, 'YzR3cXl4cXE=', '2018-04-07 00:38:34'),
(9, 30, 'MDE5ZnU2emY=', '2018-04-07 00:39:41'),
(10, 30, 'bWd3cGd0d3k=', '2018-04-07 00:40:06'),
(11, 30, 'cXZjOG5xeW4=', '2018-04-07 00:40:20'),
(12, 31, 'a3I3MTZ5ZmU=', '2018-04-08 03:19:16'),
(13, 34, 'dnZnZmxtbDI=', '2018-04-09 05:13:00'),
(14, 34, 'bm8zNHFxbHk=', '2018-04-09 05:17:04'),
(15, 34, 'c3ZoMzJzdDU=', '2018-04-09 06:00:29'),
(16, 30, 'Y21rMjI1MnE=', '2018-04-09 03:08:14'),
(17, 30, 'ZjRlaGp6enQ=', '2018-04-09 03:24:07'),
(18, 42, 'Zml6MzRheWg=', '2018-04-10 05:59:43'),
(19, 42, 'MmhsaXYzZ3c=', '2018-04-10 06:01:17'),
(20, 47, 'amNrM29ya20=', '2018-04-10 23:13:26'),
(21, 47, 'ajFncmo5NjU=', '2018-04-11 00:26:35'),
(22, 47, 'azR0c285MGI=', '2018-04-11 00:30:05'),
(23, 47, 'cHN3ZDh6a2g=', '2018-04-11 00:30:51'),
(24, 48, 'aXhyODlrbHQ=', '2018-04-11 01:00:14'),
(25, 47, 'M2lkaWpyNms=', '2018-04-11 02:08:19'),
(26, 47, 'eWVvcjhkdmI=', '2018-04-11 02:09:45'),
(27, 47, 'YjgydDlrcWY=', '2018-04-11 02:10:34'),
(28, 48, 'dHd4aWkybTU=', '2018-04-11 02:19:44'),
(29, 48, 'ZGp3Y3h3NjE=', '2018-04-11 02:26:42'),
(30, 48, 'Z3F4c2o0NGU=', '2018-04-11 02:30:09'),
(31, 48, 'a3FibDY2cnY=', '2018-04-11 02:31:51'),
(32, 48, 'eGl6eGx4azU=', '2018-04-11 06:34:13'),
(33, 48, 'eGs1OGl3bXI=', '2018-04-10 19:05:32'),
(34, 49, 'dnZhNngzdWk=', '2018-04-12 04:59:37'),
(35, 49, 'd2Z2YTRxM2M=', '2018-04-12 23:04:24'),
(36, 49, 'cXoxY3J0cWU=', '2018-04-12 23:05:21'),
(37, 50, 'b2RlcnYzd2g=', '2018-04-13 03:29:37'),
(38, 50, 'aDdtb2xud3g=', '2018-04-13 03:34:18'),
(39, 50, 'MjRwZjBqZ3k=', '2018-04-13 03:35:06'),
(40, 50, 'c2hwcmxtM20=', '2018-04-13 03:35:24'),
(41, 50, 'b3g0czVhcno=', '2018-04-13 03:36:06'),
(42, 50, 'N3ZhcnhrbGo=', '2018-04-13 03:36:40'),
(43, 51, 'NXEzbnZ1Nm4=', '2018-04-13 03:44:54'),
(44, 51, 'YW5uenhlZHU=', '2018-04-13 03:47:11'),
(45, 51, 'bThjcTNiNXI=', '2018-04-13 03:47:37'),
(46, 49, 'eDVpMGM1Z2I=', '2018-04-13 03:53:11'),
(47, 52, 'bmNob2hwZHc=', '2018-04-13 05:01:03'),
(48, 52, 'NGl1czk0ejI=', '2018-04-13 05:05:25'),
(49, 52, 'Y2RsdmczaWg=', '2018-04-13 05:05:49'),
(50, 53, 'YWo4MXNrY2E=', '2018-04-15 01:24:43'),
(51, 53, 'eWdsaGs3ZHg=', '2018-04-15 01:34:50'),
(52, 54, 'eGZ0Z253dmg=', '2018-04-16 00:56:00'),
(53, 54, 'dWR5eWhrMHI=', '2018-04-16 00:56:25'),
(54, 47, 'eDIwa2x1aWI=', '2018-04-16 01:14:19'),
(55, 59, 'cmF6ZGd0cXQ=', '2018-04-16 02:48:31'),
(56, 59, 'bmZ0MXdlNXU=', '2018-04-16 03:01:48'),
(57, 59, 'bWQ4eTZyMTI=', '2018-04-15 19:25:05'),
(58, 59, 'MzhoemdubXo=', '2018-04-17 23:47:54'),
(59, 60, 'Z3IybWEzeXE=', '2018-04-21 02:12:26'),
(60, 61, 'OGFpeGo0NzQ=', '2018-04-24 01:51:54'),
(61, 62, 'cWo2cWs0ang=', '2018-04-25 05:49:40'),
(62, 63, 'NzEyejZlN2g=', '2018-04-26 02:26:13'),
(63, 63, 'azZkdW9yOW8=', '2018-04-26 02:31:09'),
(64, 63, 'NnVuY3MxbHA=', '2018-04-26 02:31:23'),
(65, 63, 'c3g2cHhzNXU=', '2018-04-26 02:41:14'),
(66, 63, 'M2t6djcwN2M=', '2018-04-26 02:44:25'),
(67, 63, 'MWh6dTZ4aHg=', '2018-04-26 02:51:14'),
(68, 63, 'cWZ2NXk1emc=', '2018-04-27 03:49:08'),
(69, 63, 'eG03NTRwNGI=', '2018-04-27 04:00:46'),
(70, 63, 'NnZsc20xYmc=', '2018-04-27 04:10:29'),
(71, 63, 'dDFoMDFyMzE=', '2018-04-27 04:12:43'),
(72, 63, 'd3NtemViMGs=', '2018-04-27 04:16:08'),
(73, 63, 'cmlyaXBkYmg=', '2018-04-27 04:17:46'),
(74, 63, 'ZWw0dGtnMWo=', '2018-04-27 04:21:31'),
(75, 64, 'NXk0Y3JqN2E=', '2018-04-27 04:39:38'),
(76, 64, 'YTJhMG9tN3A=', '2018-04-27 04:40:13'),
(77, 65, 'ODJ3NDI3MTM=', '2018-04-27 05:19:43'),
(78, 65, 'eTZuNHR5Nmo=', '2018-04-27 05:20:17'),
(79, 30, 'bnhjYWMyZjY=', '2018-04-26 19:15:52'),
(80, 64, 'bmxhbGgwNmE=', '2018-04-26 19:21:25'),
(81, 64, 'MzkzZDk4Y2I=', '2018-04-26 19:24:24'),
(82, 64, 'azZ4Ymo4d3c=', '2018-04-26 23:40:15'),
(83, 64, 'ZnNmZjdid3M=', '2018-04-26 23:41:59'),
(84, 64, 'eGluMTB6dHQ=', '2018-04-27 03:25:14'),
(85, 65, 'bXN1bDE4dGw=', '2018-04-28 06:01:16'),
(86, 65, 'NXg2Z2Y2djg=', '2018-04-27 20:30:24'),
(87, 64, 'bW9yYW9yYzQ=', '2018-04-28 01:14:47'),
(88, 64, 'Z3N3N21zbGs=', '2018-04-28 01:17:21'),
(89, 64, 'bjU1dGg4aTU=', '2018-04-28 01:18:55'),
(90, 65, 'YTg3ajFzbTI=', '2018-04-28 23:50:09'),
(91, 65, 'ZXpxa2M3bGI=', '2018-04-28 23:50:09'),
(92, 64, 'NDlzeGxhem0=', '2018-04-30 07:04:45'),
(93, 64, 'aTdjMDIwY2I=', '2018-04-30 07:05:03'),
(94, 64, 'aWZ5czQ1Nmc=', '2018-05-12 17:21:49');

-- --------------------------------------------------------

--
-- Table structure for table `zones`
--

CREATE TABLE `zones` (
  `zone_id` int(11) NOT NULL,
  `zone_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active' COMMENT 'Active, Inactive'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `zones`
--

INSERT INTO `zones` (`zone_id`, `zone_name`, `code`, `status`) VALUES
(1, 'Dhaka', NULL, 'Inactive'),
(2, 'Mymensing', NULL, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `zone_regions`
--

CREATE TABLE `zone_regions` (
  `zone_region_id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address_districts`
--
ALTER TABLE `address_districts`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `address_divisions`
--
ALTER TABLE `address_divisions`
  ADD PRIMARY KEY (`division_id`);

--
-- Indexes for table `address_thanas`
--
ALTER TABLE `address_thanas`
  ADD PRIMARY KEY (`thana_id`);

--
-- Indexes for table `address_zips`
--
ALTER TABLE `address_zips`
  ADD PRIMARY KEY (`zip_id`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`area_id`);

--
-- Indexes for table `area_territories`
--
ALTER TABLE `area_territories`
  ADD PRIMARY KEY (`area_territory_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `chemists`
--
ALTER TABLE `chemists`
  ADD PRIMARY KEY (`chemist_id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `chemist_address`
--
ALTER TABLE `chemist_address`
  ADD PRIMARY KEY (`chemist_address_id`),
  ADD KEY `thana` (`thana`);

--
-- Indexes for table `chemist_categories`
--
ALTER TABLE `chemist_categories`
  ADD PRIMARY KEY (`chemist_category_id`);

--
-- Indexes for table `chemist_contacts`
--
ALTER TABLE `chemist_contacts`
  ADD PRIMARY KEY (`chemist_contact_id`),
  ADD KEY `contact_no` (`contact_no`);

--
-- Indexes for table `chemist_dcr`
--
ALTER TABLE `chemist_dcr`
  ADD PRIMARY KEY (`chemist_dcr_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `chemist_dcr_products`
--
ALTER TABLE `chemist_dcr_products`
  ADD PRIMARY KEY (`chemist_dcr_product_id`);

--
-- Indexes for table `chemist_edit_requests`
--
ALTER TABLE `chemist_edit_requests`
  ADD PRIMARY KEY (`chemist_edit_request_id`);

--
-- Indexes for table `chemist_special_days`
--
ALTER TABLE `chemist_special_days`
  ADD PRIMARY KEY (`chemist_special_day_id`);

--
-- Indexes for table `chemist_special_day_types`
--
ALTER TABLE `chemist_special_day_types`
  ADD PRIMARY KEY (`chemist_special_day_type_id`);

--
-- Indexes for table `chemist_territories`
--
ALTER TABLE `chemist_territories`
  ADD PRIMARY KEY (`chemist_territory_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`division_id`);

--
-- Indexes for table `division_zones`
--
ALTER TABLE `division_zones`
  ADD PRIMARY KEY (`division_region_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`),
  ADD KEY `name` (`name`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `doctor_categories`
--
ALTER TABLE `doctor_categories`
  ADD PRIMARY KEY (`doctor_category_d`);

--
-- Indexes for table `doctor_chambers`
--
ALTER TABLE `doctor_chambers`
  ADD PRIMARY KEY (`doctor_chamber_id`),
  ADD KEY `thana` (`thana`);

--
-- Indexes for table `doctor_contacts`
--
ALTER TABLE `doctor_contacts`
  ADD PRIMARY KEY (`doctor_contact_id`);

--
-- Indexes for table `doctor_dcr`
--
ALTER TABLE `doctor_dcr`
  ADD PRIMARY KEY (`doctor_dcr_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `doctor_dcr_gifts`
--
ALTER TABLE `doctor_dcr_gifts`
  ADD PRIMARY KEY (`doctor_dcr_gift_id`);

--
-- Indexes for table `doctor_dcr_ppms`
--
ALTER TABLE `doctor_dcr_ppms`
  ADD PRIMARY KEY (`doctor_dcr_ppm_id`);

--
-- Indexes for table `doctor_dcr_products`
--
ALTER TABLE `doctor_dcr_products`
  ADD PRIMARY KEY (`doctor_dcr_product_id`);

--
-- Indexes for table `doctor_dcr_sample_products`
--
ALTER TABLE `doctor_dcr_sample_products`
  ADD PRIMARY KEY (`doctor_dcr_sample_product_id`);

--
-- Indexes for table `doctor_dcr_visit_team`
--
ALTER TABLE `doctor_dcr_visit_team`
  ADD PRIMARY KEY (`doctor_dcr_visit_team_id`);

--
-- Indexes for table `doctor_edit_requests`
--
ALTER TABLE `doctor_edit_requests`
  ADD PRIMARY KEY (`doctor_edit_request_id`),
  ADD KEY `name` (`name`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `doctor_home_address`
--
ALTER TABLE `doctor_home_address`
  ADD PRIMARY KEY (`doctor_home_address_id`);

--
-- Indexes for table `doctor_specialities`
--
ALTER TABLE `doctor_specialities`
  ADD PRIMARY KEY (`doctor_speciality_id`);

--
-- Indexes for table `doctor_special_days`
--
ALTER TABLE `doctor_special_days`
  ADD PRIMARY KEY (`doctor_special_day_id`);

--
-- Indexes for table `doctor_special_day_types`
--
ALTER TABLE `doctor_special_day_types`
  ADD PRIMARY KEY (`doctor_special_day_type_id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`feature_id`);

--
-- Indexes for table `feature_actions`
--
ALTER TABLE `feature_actions`
  ADD PRIMARY KEY (`feature_action_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `location_maping`
--
ALTER TABLE `location_maping`
  ADD PRIMARY KEY (`location_maping_id`);

--
-- Indexes for table `location_type`
--
ALTER TABLE `location_type`
  ADD PRIMARY KEY (`location_type_id`);

--
-- Indexes for table `login_log`
--
ALTER TABLE `login_log`
  ADD PRIMARY KEY (`login_log_id`);

--
-- Indexes for table `mpo_targets`
--
ALTER TABLE `mpo_targets`
  ADD PRIMARY KEY (`mpo_target_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `ppms`
--
ALTER TABLE `ppms`
  ADD PRIMARY KEY (`ppm_id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`prescription_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `prescription_details`
--
ALTER TABLE `prescription_details`
  ADD PRIMARY KEY (`prescription_detail_id`);

--
-- Indexes for table `prescription_images`
--
ALTER TABLE `prescription_images`
  ADD PRIMARY KEY (`prescription_image_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `name` (`name`),
  ADD KEY `price_tp` (`price_tp`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`region_id`);

--
-- Indexes for table `region_areas`
--
ALTER TABLE `region_areas`
  ADD PRIMARY KEY (`region_area_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `role_features`
--
ALTER TABLE `role_features`
  ADD PRIMARY KEY (`role_permission_id`);

--
-- Indexes for table `sms_templates`
--
ALTER TABLE `sms_templates`
  ADD PRIMARY KEY (`sms_template_id`);

--
-- Indexes for table `specialities`
--
ALTER TABLE `specialities`
  ADD PRIMARY KEY (`speciality_id`);

--
-- Indexes for table `sub_features`
--
ALTER TABLE `sub_features`
  ADD PRIMARY KEY (`sub_feature_id`);

--
-- Indexes for table `system_special_days`
--
ALTER TABLE `system_special_days`
  ADD PRIMARY KEY (`system_special_day_id`);

--
-- Indexes for table `target_types`
--
ALTER TABLE `target_types`
  ADD PRIMARY KEY (`target_type_id`);

--
-- Indexes for table `territories`
--
ALTER TABLE `territories`
  ADD PRIMARY KEY (`territory_id`);

--
-- Indexes for table `thanas`
--
ALTER TABLE `thanas`
  ADD PRIMARY KEY (`thana_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `first_name` (`first_name`),
  ADD KEY `last_name` (`last_name`),
  ADD KEY `status` (`status`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `active_imei` (`active_imei`);

--
-- Indexes for table `user_designations`
--
ALTER TABLE `user_designations`
  ADD PRIMARY KEY (`user_designation_id`);

--
-- Indexes for table `user_imei_log`
--
ALTER TABLE `user_imei_log`
  ADD PRIMARY KEY (`user_imei_id`);

--
-- Indexes for table `user_location_log`
--
ALTER TABLE `user_location_log`
  ADD PRIMARY KEY (`user_location_log_id`);

--
-- Indexes for table `user_location_maping`
--
ALTER TABLE `user_location_maping`
  ADD PRIMARY KEY (`user_location_maping_id`);

--
-- Indexes for table `user_role_location_type`
--
ALTER TABLE `user_role_location_type`
  ADD PRIMARY KEY (`user_role_location_type_id`);

--
-- Indexes for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`user_session_id`);

--
-- Indexes for table `zones`
--
ALTER TABLE `zones`
  ADD PRIMARY KEY (`zone_id`);

--
-- Indexes for table `zone_regions`
--
ALTER TABLE `zone_regions`
  ADD PRIMARY KEY (`zone_region_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address_districts`
--
ALTER TABLE `address_districts`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `address_divisions`
--
ALTER TABLE `address_divisions`
  MODIFY `division_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `address_thanas`
--
ALTER TABLE `address_thanas`
  MODIFY `thana_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=481;

--
-- AUTO_INCREMENT for table `address_zips`
--
ALTER TABLE `address_zips`
  MODIFY `zip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=481;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `area_territories`
--
ALTER TABLE `area_territories`
  MODIFY `area_territory_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chemists`
--
ALTER TABLE `chemists`
  MODIFY `chemist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `chemist_address`
--
ALTER TABLE `chemist_address`
  MODIFY `chemist_address_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `chemist_categories`
--
ALTER TABLE `chemist_categories`
  MODIFY `chemist_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `chemist_contacts`
--
ALTER TABLE `chemist_contacts`
  MODIFY `chemist_contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `chemist_dcr`
--
ALTER TABLE `chemist_dcr`
  MODIFY `chemist_dcr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chemist_dcr_products`
--
ALTER TABLE `chemist_dcr_products`
  MODIFY `chemist_dcr_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `chemist_edit_requests`
--
ALTER TABLE `chemist_edit_requests`
  MODIFY `chemist_edit_request_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chemist_special_days`
--
ALTER TABLE `chemist_special_days`
  MODIFY `chemist_special_day_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `chemist_special_day_types`
--
ALTER TABLE `chemist_special_day_types`
  MODIFY `chemist_special_day_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chemist_territories`
--
ALTER TABLE `chemist_territories`
  MODIFY `chemist_territory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `division_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `division_zones`
--
ALTER TABLE `division_zones`
  MODIFY `division_region_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `doctor_categories`
--
ALTER TABLE `doctor_categories`
  MODIFY `doctor_category_d` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_chambers`
--
ALTER TABLE `doctor_chambers`
  MODIFY `doctor_chamber_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `doctor_contacts`
--
ALTER TABLE `doctor_contacts`
  MODIFY `doctor_contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `doctor_dcr`
--
ALTER TABLE `doctor_dcr`
  MODIFY `doctor_dcr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `doctor_dcr_gifts`
--
ALTER TABLE `doctor_dcr_gifts`
  MODIFY `doctor_dcr_gift_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_dcr_ppms`
--
ALTER TABLE `doctor_dcr_ppms`
  MODIFY `doctor_dcr_ppm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_dcr_products`
--
ALTER TABLE `doctor_dcr_products`
  MODIFY `doctor_dcr_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `doctor_dcr_sample_products`
--
ALTER TABLE `doctor_dcr_sample_products`
  MODIFY `doctor_dcr_sample_product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_dcr_visit_team`
--
ALTER TABLE `doctor_dcr_visit_team`
  MODIFY `doctor_dcr_visit_team_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_edit_requests`
--
ALTER TABLE `doctor_edit_requests`
  MODIFY `doctor_edit_request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctor_home_address`
--
ALTER TABLE `doctor_home_address`
  MODIFY `doctor_home_address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `doctor_specialities`
--
ALTER TABLE `doctor_specialities`
  MODIFY `doctor_speciality_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `doctor_special_days`
--
ALTER TABLE `doctor_special_days`
  MODIFY `doctor_special_day_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `doctor_special_day_types`
--
ALTER TABLE `doctor_special_day_types`
  MODIFY `doctor_special_day_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `feature_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `feature_actions`
--
ALTER TABLE `feature_actions`
  MODIFY `feature_action_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `location_maping`
--
ALTER TABLE `location_maping`
  MODIFY `location_maping_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `location_type`
--
ALTER TABLE `location_type`
  MODIFY `location_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `login_log`
--
ALTER TABLE `login_log`
  MODIFY `login_log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mpo_targets`
--
ALTER TABLE `mpo_targets`
  MODIFY `mpo_target_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ppms`
--
ALTER TABLE `ppms`
  MODIFY `ppm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `prescription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `prescription_details`
--
ALTER TABLE `prescription_details`
  MODIFY `prescription_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `prescription_images`
--
ALTER TABLE `prescription_images`
  MODIFY `prescription_image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `region_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `region_areas`
--
ALTER TABLE `region_areas`
  MODIFY `region_area_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role_features`
--
ALTER TABLE `role_features`
  MODIFY `role_permission_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_templates`
--
ALTER TABLE `sms_templates`
  MODIFY `sms_template_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `specialities`
--
ALTER TABLE `specialities`
  MODIFY `speciality_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sub_features`
--
ALTER TABLE `sub_features`
  MODIFY `sub_feature_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `system_special_days`
--
ALTER TABLE `system_special_days`
  MODIFY `system_special_day_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `target_types`
--
ALTER TABLE `target_types`
  MODIFY `target_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `territories`
--
ALTER TABLE `territories`
  MODIFY `territory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `thanas`
--
ALTER TABLE `thanas`
  MODIFY `thana_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `user_designations`
--
ALTER TABLE `user_designations`
  MODIFY `user_designation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_imei_log`
--
ALTER TABLE `user_imei_log`
  MODIFY `user_imei_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_location_log`
--
ALTER TABLE `user_location_log`
  MODIFY `user_location_log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_location_maping`
--
ALTER TABLE `user_location_maping`
  MODIFY `user_location_maping_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_role_location_type`
--
ALTER TABLE `user_role_location_type`
  MODIFY `user_role_location_type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `user_session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `zones`
--
ALTER TABLE `zones`
  MODIFY `zone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `zone_regions`
--
ALTER TABLE `zone_regions`
  MODIFY `zone_region_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
