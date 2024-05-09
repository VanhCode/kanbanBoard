-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 09, 2024 at 08:49 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kanbanboardrealtime`
--

-- --------------------------------------------------------

--
-- Table structure for table `boards`
--

CREATE TABLE `boards` (
  `id` int NOT NULL,
  `leader` int NOT NULL,
  `board_name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `boards`
--

INSERT INTO `boards` (`id`, `leader`, `board_name`, `created_at`, `updated_at`) VALUES
(157, 1, 'Nhóm dự án 1', '2024-05-08 04:27:50', '2024-05-08 04:27:50'),
(158, 3, 'Nhóm Tốt nghiệp', '2024-05-08 04:30:10', '2024-05-08 04:30:10'),
(159, 1, 'Nhóm 3', '2024-05-08 08:41:37', '2024-05-08 08:41:37');

-- --------------------------------------------------------

--
-- Table structure for table `board_detail`
--

CREATE TABLE `board_detail` (
  `id` int NOT NULL,
  `board_id` int NOT NULL,
  `member_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `board_detail`
--

INSERT INTO `board_detail` (`id`, `board_id`, `member_id`, `created_at`, `updated_at`) VALUES
(132, 157, 2, '2024-05-08 04:27:58', '2024-05-08 04:27:58'),
(133, 157, 4, '2024-05-08 04:29:10', '2024-05-08 04:29:10'),
(134, 157, 3, '2024-05-08 04:29:10', '2024-05-08 04:29:10'),
(135, 159, 3, '2024-05-08 08:41:55', '2024-05-08 08:41:55'),
(136, 159, 2, '2024-05-08 08:42:15', '2024-05-08 08:42:15');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int NOT NULL,
  `board_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'to-do',
  `iduser_created_by` int NOT NULL,
  `iduser_assigned_to` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `board_id`, `title`, `status`, `iduser_created_by`, `iduser_assigned_to`, `created_at`, `updated_at`) VALUES
(65, 158, 'Vịn', 'to-do', 3, NULL, '2024-05-08 04:30:49', '2024-05-08 04:30:49'),
(74, 157, 'Đi vịn6', 'to-do', 1, NULL, '2024-05-08 07:43:58', '2024-05-08 08:35:31'),
(75, 157, 'Đi vịn 3', 'to-do', 1, NULL, '2024-05-08 08:33:36', '2024-05-08 22:15:44'),
(81, 159, 'Đi vịn1', 'to-do', 1, NULL, '2024-05-08 20:31:51', '2024-05-08 22:03:28'),
(82, 159, 'Đi vịn9', 'to-do', 1, NULL, '2024-05-08 21:50:29', '2024-05-08 22:03:22'),
(83, 159, 'd', 'to-do', 1, NULL, '2024-05-08 22:03:33', '2024-05-08 22:03:33'),
(84, 159, 'd', 'to-do', 1, NULL, '2024-05-08 22:03:34', '2024-05-08 22:03:34'),
(85, 159, 'd', 'to-do', 1, NULL, '2024-05-08 22:03:35', '2024-05-08 22:03:35'),
(86, 159, 'd', 'to-do', 1, NULL, '2024-05-08 22:03:36', '2024-05-08 22:03:36'),
(87, 159, 'd', 'to-do', 1, NULL, '2024-05-08 22:03:37', '2024-05-08 22:03:37'),
(88, 159, 'd', 'to-do', 1, NULL, '2024-05-08 22:03:38', '2024-05-08 22:03:38'),
(89, 159, 'd', 'to-do', 1, NULL, '2024-05-08 22:03:39', '2024-05-08 22:03:39'),
(90, 159, 'd', 'to-do', 1, NULL, '2024-05-08 22:03:40', '2024-05-08 22:03:40'),
(91, 159, 'd', 'to-do', 1, NULL, '2024-05-08 22:03:41', '2024-05-08 22:03:41'),
(92, 159, 'd', 'to-do', 1, NULL, '2024-05-08 22:03:42', '2024-05-08 22:03:42'),
(93, 159, 'd', 'to-do', 1, NULL, '2024-05-08 22:03:43', '2024-05-08 22:03:43'),
(94, 159, 'd', 'to-do', 1, NULL, '2024-05-08 22:03:44', '2024-05-08 22:03:44'),
(95, 159, 'd', 'to-do', 1, NULL, '2024-05-08 22:03:45', '2024-05-08 22:03:45'),
(96, 159, 'd', 'to-do', 1, NULL, '2024-05-08 22:03:46', '2024-05-08 22:03:46'),
(97, 159, 'd', 'to-do', 1, NULL, '2024-05-08 22:03:47', '2024-05-08 22:03:47'),
(98, 159, 'd', 'to-do', 1, NULL, '2024-05-08 22:03:48', '2024-05-08 22:03:48'),
(99, 159, 'd', 'to-do', 1, NULL, '2024-05-08 22:03:49', '2024-05-08 22:03:49'),
(100, 159, 'd', 'to-do', 1, NULL, '2024-05-08 22:03:50', '2024-05-08 22:03:50'),
(101, 159, 'd', 'to-do', 1, NULL, '2024-05-08 22:03:51', '2024-05-08 22:03:51'),
(102, 159, 'd', 'to-do', 1, NULL, '2024-05-08 22:03:53', '2024-05-08 22:03:53'),
(103, 159, 'd', 'to-do', 1, NULL, '2024-05-08 22:03:54', '2024-05-08 22:03:54'),
(104, 159, 'd6', 'to-do', 1, NULL, '2024-05-08 22:03:55', '2024-05-08 22:07:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `image`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Trần Việt Anh', 'tranvanh2k4@gmail.com', NULL, 'https://scontent.fhan14-1.fna.fbcdn.net/v/t39.30808-1/434858696_122159487740035199_102493501140684843_n.jpg?stp=dst-jpg_p200x200&_nc_cat=101&ccb=1-7&_nc_sid=5f2048&_nc_ohc=h-xUJbN7tnsQ7kNvgHo3Fpj&_nc_ht=scontent.fhan14-1.fna&oh=00_AfB2VrSpWst8-hexTAEQYWxwWEucwkTbtMVo7AotWpMXZA&oe=663FF01E', '$2y$12$rpe5A25uvhRI16vxqni2KuWjgzQ8Stuojt1VbXvkJ3AFysx1yj6cO', NULL, '2024-05-04 19:25:17', '2024-05-04 19:25:17'),
(2, 'Nhật Lào Cai', 'nhatcaca2004@gmail.com', NULL, 'https://scontent.fhan14-5.fna.fbcdn.net/v/t39.30808-6/292011549_1192119298221484_5096720056686154923_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=5f2048&_nc_ohc=MRRdviLSfzkQ7kNvgGcNCWC&_nc_ht=scontent.fhan14-5.fna&oh=00_AfB2teyWlk9S69eSx2HaFuhGjR5q-ufMMeVrx1OAITVRzQ&oe=66402F94', '$2y$12$FG7MwO9GbM0hjpNbDM4xoenc/5m55fVLQprddkoRdWn3dRo5kkx82', NULL, '2024-05-04 19:56:53', '2024-05-04 19:56:53'),
(3, 'Duynnz', 'duy@gmail.com', NULL, 'https://scontent.fhan14-3.fna.fbcdn.net/v/t1.15752-9/440516507_398500626418502_6577681708194761980_n.png?_nc_cat=103&ccb=1-7&_nc_sid=5f2048&_nc_ohc=3SV_ffv2CiIQ7kNvgHfVbud&_nc_ht=scontent.fhan14-3.fna&oh=03_Q7cD1QExZyqbBCoOjIZaxMmhsWeo-G95BS0yjqrcc3KyxHYxzg&oe=6661B334', '$2y$12$IMlIb6YMblf1ImicITWL2udGka29HLWwHwe/8dcw9OkZxtYp4.TE6', NULL, '2024-05-04 20:30:08', '2024-05-04 20:30:08'),
(4, 'Tráng', 'trang@gmail.com', NULL, 'https://scontent.fhan14-2.fna.fbcdn.net/v/t1.15752-9/440535540_973066351147838_6940931212901785498_n.png?_nc_cat=100&ccb=1-7&_nc_sid=5f2048&_nc_ohc=rFA_aEGyd2gQ7kNvgEuriwB&_nc_ht=scontent.fhan14-2.fna&oh=03_Q7cD1QEJD9Iy9jV-a_IvImQ8tFHh6Hsab_8pm52G0y_ImyglAA&oe=66619B81', '$2y$12$JIxtEvHdVicmFNLi6XhBmO0Sgca2rKsadK/r3UBSc/FHMp6orRqkO', NULL, '2024-05-04 20:30:28', '2024-05-04 20:30:28'),
(5, 'Quốc', 'quoc@gmail.com', NULL, 'https://scontent.fhan14-1.fna.fbcdn.net/v/t1.15752-9/440492898_7769167493177110_1738289467924784045_n.png?_nc_cat=107&ccb=1-7&_nc_sid=5f2048&_nc_ohc=nFPmxAkqeBsQ7kNvgG3m5Kg&_nc_ht=scontent.fhan14-1.fna&oh=03_Q7cD1QGj6IJk7O7G9Id2RnTr3uw9hW84Efs2SEkBl5QKtkhV7g&oe=666197E5', '$2y$12$55vIJKEmttvjzopTTggxM.HaTsYNtswH2ZxK80xeyV7kMr4NyIXRa', NULL, '2024-05-04 20:30:44', '2024-05-04 20:30:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boards`
--
ALTER TABLE `boards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leader` (`leader`);

--
-- Indexes for table `board_detail`
--
ALTER TABLE `board_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `board_id` (`board_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iduser_assigned_to` (`iduser_assigned_to`),
  ADD KEY `board_id` (`board_id`),
  ADD KEY `iduser_created_by` (`iduser_created_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boards`
--
ALTER TABLE `boards`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `board_detail`
--
ALTER TABLE `board_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `board_detail`
--
ALTER TABLE `board_detail`
  ADD CONSTRAINT `board_detail_ibfk_1` FOREIGN KEY (`board_id`) REFERENCES `boards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `board_detail_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`board_id`) REFERENCES `boards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`iduser_created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
