-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2020 at 10:28 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bloodbank`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `first_name`, `last_name`) VALUES
(2, 'will', 'cd4c76dfe760e981ffcac643545e1a75', 'William', 'nasoni');

-- --------------------------------------------------------

--
-- Table structure for table `blood_group`
--

CREATE TABLE `blood_group` (
  `id` int(11) NOT NULL,
  `blood_group` varchar(5) NOT NULL,
  `quantity` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blood_group`
--

INSERT INTO `blood_group` (`id`, `blood_group`, `quantity`) VALUES
(1, 'A', 44),
(2, 'B', 90),
(3, 'AB', 80),
(4, 'O', 90);

-- --------------------------------------------------------

--
-- Table structure for table `emergency`
--

CREATE TABLE `emergency` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `region_id` int(1) NOT NULL,
  `blood_group_id` int(1) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emergency`
--

INSERT INTO `emergency` (`id`, `user_id`, `region_id`, `blood_group_id`, `time`) VALUES
(1, 9, 3, 2, '2019-10-28 09:04:47'),
(2, 4, 2, 1, '2019-11-26 09:31:42');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(15) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `number` varchar(191) NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `number`, `body`, `created_at`, `updated_at`) VALUES
(11, 'vm ,d,', 'mf,dm', '844454', 'this is a test', '2019-01-16 12:24:54', '2019-01-16 12:24:54'),
(12, 'Ganizani Malango', 'gmalango@gmail.com', '0994323547', 'I need an upright Hisense fridge of range MK200,000 to MK250,000 With atleast 200 litres.\nRegards', '2019-06-11 06:46:26', '2019-06-11 06:46:26'),
(13, 'Joseph Niyirora', 'joelianemuton@gmail.com', '2503016761', 'Kodi munthu angakupezeni malo ati kuti adzagule nawo microwave', '2019-11-25 07:39:04', '2019-11-25 07:39:04'),
(14, 'Joseph Niyirora', 'joelianemuton@gmail.com', '2503016761', 'Kodi munthu angakupezeni malo ati kuti adzagule nawo microwave', '2019-11-25 07:39:10', '2019-11-25 07:39:10'),
(15, 'Joseph Niyirora', 'joelianemuton@gmail.com', '+12503016761', 'Kodi munthu angakupezeni malo ati kuti adzagule nawo microwave', '2019-11-25 07:39:36', '2019-11-25 07:39:36'),
(16, 'Joseph Niyirora', 'joelianemuton@gmail.com', '+12503016761', 'Kodi munthu angakupezeni malo ati kuti adzagule nawo microwave', '2019-11-25 07:39:36', '2019-11-25 07:39:36'),
(17, 'Joseph Niyirora', 'joelianemuton@gmail.com', '+12503016761', 'Kodi munthu angakupezeni malo ati kuti adzagule nawo microwave', '2019-11-25 07:39:37', '2019-11-25 07:39:37'),
(18, 'Joseph Niyirora', 'joelianemuton@gmail.com', '+12503016761', 'Kodi munthu angakupezeni malo ati kuti adzagule nawo microwave', '2019-11-25 07:39:38', '2019-11-25 07:39:38'),
(19, 'Harold', 'haroldchinyama@gmail.com', '0881131122', 'How much is 39\" Hisense LED TV and Hisence upright fridge with water dispenser?', '2019-12-17 11:29:07', '2019-12-17 11:29:07'),
(20, 'Zechariah Pfannerstill', 'brunopion@gmail.com', 'Sleek Steel Towels', 'Ergonomic', '2020-01-03 01:16:54', '2020-01-03 01:16:54'),
(21, 'Lily Von V', 'mandy.boylett@gmail.com', 'District', 'European Unit of Account 9(E.U.A.-9)', '2020-01-05 01:07:14', '2020-01-05 01:07:14'),
(22, 'Santino Prosacco', 'baric.lidija@yahoo.com', 'Club', 'withdrawal', '2020-01-07 20:37:50', '2020-01-07 20:37:50');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '2014_10_12_000000_create_users_table', 1),
(8, '2014_10_12_100000_create_password_resets_table', 1),
(9, '2018_11_14_181959_create_brands_table', 1),
(10, '2018_11_14_182231_create_appliances_table', 1),
(11, '2018_11_14_182256_create_appliance_cats_table', 1),
(12, '2018_11_14_182343_create_hero_imgs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone_number` varchar(16) NOT NULL,
  `gender` varchar(9) NOT NULL,
  `blood_group_id` int(1) NOT NULL,
  `region_id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `first_name`, `last_name`, `email`, `phone_number`, `gender`, `blood_group_id`, `region_id`) VALUES
(2, 5, 'William', 'Nasoni', 'tnasoni@mail.com', '2123521', 'male', 3, 1),
(4, 7, 'Mary', 'Jane', 'j@m.com', '8745122', 'female', 1, 1),
(5, 8, 'Jane', 'Doe', 'jane@j.com', '5478', 'female', 3, 2),
(6, 9, 'Jame', 'Doe', 'ja@mail.com', '784', 'male', 2, 3),
(7, 10, 'ninja', 'does', 'w@nina.com', '789', 'male', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `id` int(11) NOT NULL,
  `region` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(15) NOT NULL,
  `report` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `phone_number`, `password`) VALUES
(1, 'w@nasono.com', '88822211', '5f4dcc3b5aa765d61d8327deb882cf99'),
(2, 'j@mail.com', '48944949', '1a1dc91c907325c69271ddf0c944bc72'),
(3, 'tnasoni@mail.com', '777777', '1a1dc91c907325c69271ddf0c944bc72'),
(5, 'tnasoni@mail.com', '2123521', '5ebe2294ecd0e0f08eab7690d2a6ee69'),
(7, 'j@m.com', '8745122', 'cd4c76dfe760e981ffcac643545e1a75'),
(8, 'jane@j.com', '5478', 'cd4c76dfe760e981ffcac643545e1a75'),
(9, 'ja@mail.com', '784', 'cd4c76dfe760e981ffcac643545e1a75'),
(10, 'w@nina.com', '789', 'cd4c76dfe760e981ffcac643545e1a75');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_group`
--
ALTER TABLE `blood_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergency`
--
ALTER TABLE `emergency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blood_group`
--
ALTER TABLE `blood_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `emergency`
--
ALTER TABLE `emergency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
