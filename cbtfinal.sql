-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2022 at 01:33 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cbtfinal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tab`
--

CREATE TABLE `admin_tab` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_log_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_tab`
--

INSERT INTO `admin_tab` (`id`, `username`, `fullname`, `password`, `last_log_date`) VALUES
(7, 'Admin', 'CBT Administrator', '$2y$10$mZAhYfvLVhbccNS7gYNZHuAGtEMdwRBKfjlfC0VWwsNtwwOFUdGYq', '2022-12-01 21:15:27');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(20) NOT NULL,
  `subject_name` text NOT NULL,
  `question` varchar(255) NOT NULL,
  `option_A` varchar(255) NOT NULL,
  `option_B` varchar(255) NOT NULL,
  `option_C` varchar(255) NOT NULL,
  `option_D` varchar(255) NOT NULL,
  `correct_answer` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `question_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `subject_name`, `question`, `option_A`, `option_B`, `option_C`, `option_D`, `correct_answer`, `date_added`, `question_id`) VALUES
(10, 'ss3_english', '<p>He left the town early this morning _____ he arrived very late.</p>', 'although', 'but', 'despite', 'even', 'B', '2022-11-24 18:40:38', 2147483647),
(11, 'ss3_english', '<p>FLEET OF CARS is an example of _____.</p>', 'a common noun', 'a proper noun', 'a collective noun', 'an abstract noun', 'C', '2022-11-24 18:42:51', 1183287620),
(12, 'ss3_english', '<p>Poverty with peace and contentment is _____ than riches with incessant fear.</p>', 'more better', 'most better', 'very better', 'far better', 'D', '2022-11-24 18:44:34', 1273197696),
(13, 'ss3_english', '<p>Which of the following sentences is in the passive voice?</p>', 'He preached a good sermon last Sunday.', 'The students are being taught by the teacher.', 'The student comes late every day.', 'She made a promise to her son.', 'B', '2022-11-24 18:46:16', 2147483647),
(14, 'ss3_english', '<p>African leaders should be cautious of ____ who praise every government action.</p>', 'critics', 'parasites', 'enthusiasts', 'sycophants', 'D', '2022-11-24 18:47:57', 2147483647),
(15, 'ss3_english', '<p>The gateman asked me ________.</p>', 'who I am', 'who I was', 'who am I', 'who are you', 'B', '2022-11-24 18:58:42', 2147483647),
(16, 'ss3_english', '<p><strong>From the options lettered A &ndash; D, choose the one that has the SAME MEANING as the words written in capital letters.</strong></p>\r\n<p>On a crucial issue like this, I am sure that Nnenna will SIT ON THE FENCE.</p>', 'Nnenna will speak out her true feeling.', 'Nnenna will not commit herself to any side.', 'Nnenna will be defensive.', 'Nnenna will judge between the two parties.', 'B', '2022-11-24 19:00:51', 2147483647),
(17, 'ss3_english', '<p>Good children should not disagree ____ their parents.</p>', 'of', 'with', 'by', 'to', 'B', '2022-11-24 19:01:50', 2147483647),
(18, 'ss3_english', '<p>You _____ be ashamed of yourself for saying such a thing before the principal.</p>', 'we', 'should', 'might', 'shall', 'B', '2022-11-24 19:08:29', 2147483647),
(19, 'ss3_english', '<p>They told her that we would solve the problem _____</p>', 'herself', 'himself', 'themselves', 'ourselves', 'D', '2022-11-24 19:10:32', 2147483647),
(20, 'ss3_mathematics', '<p>On a map, 1cm represent 5km. Find the area on the map that represents 100km<sup>2</sup>.</p>', '2cm2', '4cm2', '6cm2', '8cm2', 'B', '2022-11-24 19:16:28', 2147483647),
(21, 'ss3_mathematics', '<p>The distance, d, through which a stone falls from rest varies directly as the square of the time, t, taken. If the stone falls 45cm in 3 seconds, how far will it fall in 6 seconds?</p>', '90cm', '135cm', '180cm', '225cm', 'C', '2022-11-24 19:18:26', 1136003159),
(22, 'ss3_mathematics', '<p>The curved surface area of a cylinder 5cm high is 110cm<sup>2</sup>. Find the radius of its base<br /><br /></p>\r\n<p>&pi; = 22/7&nbsp;</p>', '2.6cm', '3.5cm', '7.0cm', '3.6cm', 'B', '2022-11-24 19:22:04', 1062677295),
(23, 'ss3_mathematics', '<p>If 23<sub>x</sub>&nbsp;= 32<sub>5</sub>, find the value of x</p>', '7', '6', '5', '4', 'A', '2022-11-24 19:23:04', 2147483647),
(24, 'ss3_mathematics', '<p>What sum of money will amount to D10,400 in 5 years at 6% simple interest?</p>', 'D8,000.00', 'D10,000.00', 'D12,000.00', 'D16,000.00', 'A', '2022-11-24 19:24:39', 1673487412),
(25, 'ss3_mathematics', '<p>Given that 2x + y = 7 and 3x - 2y = 3, by how much is 7x greater than 10?</p>', '1', '3', '7', '17', 'C', '2022-11-24 19:26:03', 2147483647),
(26, 'ss3_mathematics', '<p>Factorize; (2x + 3y)<sup>2</sup>&nbsp;- (x - 4y)<sup>2</sup></p>', '(3x - y)(x + 7y)', '(3x + y)(2x - 7y)', '(3x + y)(x - 7y)', '(3x - y)(2x + 7y)', 'A', '2022-11-24 19:27:39', 2147483647),
(27, 'ss3_mathematics', '<p>The volume of a pyramid with height 15cm is 90cm<sup>3</sup>. If its base is a rectangle with dimension xcm by 6cm, find the value of x</p>', '3', '5', '6', '8', 'A', '2022-11-24 19:28:33', 2147483647),
(28, 'ss3_mathematics', '<p>Kweku walked 8m up to slope and was 3m above the ground. If he walks 12m further up the slope, how far above the ground will he be?</p>', '4.5m', '6.0m', '7.5m', '9.0m', 'C', '2022-11-24 19:40:02', 2147483647),
(29, 'ss3_mathematics', '<p>A fair die is thrown two times. What is the probability that the sum of the scores is at least 10?</p>', '5/36', '1/6', '5/18', '2/3', 'B', '2022-11-24 19:42:23', 2147483647),
(30, 'ss3_physics', '<p>Which of the following statements is not correct about steel and soft iron?</p>', 'steel is more magnetized than soft iron', 'permanent magnets are usually made of steel', 'soft iron is more readily magnetized than steel', 'soft iron more readily loses its magnetism than steel', 'A', '2022-11-24 19:46:25', 2147483647),
(31, 'ss3_physics', '<p>What determines the polarity at the ends of an electromagnet? The</p>', 'magnitude of the current passing through the wire', 'material of the core of the magnet', 'material of the coil', 'direction of current in the wire', 'D', '2022-11-24 19:48:41', 2147483647),
(32, 'ss3_physics', '<p>The phenomenon by which two light atomic nuclear combine to form a heavy nuclide with the release of energy is known as</p>', 'radioactivity', 'nuclear fusion', 'nuclear fission', 'chain reaction', 'B', '2022-11-24 19:50:24', 2147483647),
(33, 'ss3_physics', '<p>In a p-type semiconductor, the</p>', 'number of holes are equal to the number of electrons', 'electrical resistivity increases', 'electrons are the majority charge carriers', 'holes are the majority charge carriers', 'D', '2022-11-24 19:51:45', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(10) NOT NULL,
  `username` text NOT NULL,
  `fullname` text NOT NULL,
  `score` int(10) NOT NULL,
  `date_taken` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `subject_name` text NOT NULL,
  `grade` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) NOT NULL,
  `point_right` int(10) NOT NULL,
  `duration` int(255) NOT NULL,
  `allow_register` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `point_right`, `duration`, `allow_register`) VALUES
(1, 2, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ss1_subjects`
--

CREATE TABLE `ss1_subjects` (
  `id` int(10) NOT NULL,
  `subject_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ss1_subjects`
--

INSERT INTO `ss1_subjects` (`id`, `subject_name`) VALUES
(1, 'ss1_accounts'),
(2, 'ss1_agric_science'),
(3, 'ss1_biology'),
(4, 'ss1_chemistry'),
(5, 'ss1_commerce'),
(6, 'ss1_computer_science'),
(7, 'ss1_economics'),
(8, 'ss1_english'),
(9, 'ss1_geography'),
(10, 'ss1_government'),
(11, 'ss1_literature'),
(12, 'ss1_mathematics'),
(13, 'ss1_physics'),
(14, 'ss1_yoruba');

-- --------------------------------------------------------

--
-- Table structure for table `ss2_subjects`
--

CREATE TABLE `ss2_subjects` (
  `id` int(10) NOT NULL,
  `subject_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ss2_subjects`
--

INSERT INTO `ss2_subjects` (`id`, `subject_name`) VALUES
(1, 'ss2_accounts'),
(2, 'ss2_agric_science'),
(3, 'ss2_biology'),
(4, 'ss2_chemistry'),
(5, 'ss2_commerce'),
(6, 'ss2_computer_science'),
(7, 'ss2_economics'),
(8, 'ss2_english'),
(9, 'ss2_geography'),
(10, 'ss2_government'),
(11, 'ss2_literature'),
(12, 'ss2_mathematics'),
(13, 'ss2_physics'),
(14, 'ss2_yoruba');

-- --------------------------------------------------------

--
-- Table structure for table `ss3_subjects`
--

CREATE TABLE `ss3_subjects` (
  `id` int(10) NOT NULL,
  `subject_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ss3_subjects`
--

INSERT INTO `ss3_subjects` (`id`, `subject_name`) VALUES
(1, 'ss3_accounts'),
(2, 'ss3_agric_science'),
(3, 'ss3_biology'),
(4, 'ss3_chemistry'),
(5, 'ss3_commerce'),
(6, 'ss3_computer_science'),
(7, 'ss3_economics'),
(8, 'ss3_english'),
(9, 'ss3_geography'),
(10, 'ss3_government'),
(11, 'ss3_literature'),
(12, 'ss3_mathematics'),
(13, 'ss3_physics'),
(14, 'ss3_yoruba');

-- --------------------------------------------------------

--
-- Table structure for table `students_tab`
--

CREATE TABLE `students_tab` (
  `id_students` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `last_log_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students_tab`
--

INSERT INTO `students_tab` (`id_students`, `username`, `fullname`, `password`, `grade`, `last_log_date`) VALUES
(54, 'Victor', 'Victor Okeawolam', '$2y$10$R0uM1WsOaje0uX6v3MlvpuDIp/UVbfAUKSD/BhRpH4kGNFEH7iqhO', 'SS3', '2022-12-01 18:31:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tab`
--
ALTER TABLE `admin_tab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss1_subjects`
--
ALTER TABLE `ss1_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss2_subjects`
--
ALTER TABLE `ss2_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss3_subjects`
--
ALTER TABLE `ss3_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_tab`
--
ALTER TABLE `students_tab`
  ADD PRIMARY KEY (`id_students`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tab`
--
ALTER TABLE `admin_tab`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ss1_subjects`
--
ALTER TABLE `ss1_subjects`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ss2_subjects`
--
ALTER TABLE `ss2_subjects`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ss3_subjects`
--
ALTER TABLE `ss3_subjects`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `students_tab`
--
ALTER TABLE `students_tab`
  MODIFY `id_students` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
