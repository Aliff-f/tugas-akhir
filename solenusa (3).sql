-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 26, 2026 at 07:13 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `solenusa`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `cancel_old_pending_checkouts` ()   BEGIN
    UPDATE checkout
    SET status = 'cancelled'
    WHERE status = 'pending' AND TIMESTAMPDIFF(MINUTE, created_at, NOW()) > 1440;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_old_checkout_data` ()   BEGIN
    DELETE FROM checkout
    WHERE status IN ('completed', 'cancelled')
    AND TIMESTAMPDIFF(MINUTE, updated_at, NOW()) > 30;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_order_status` (IN `orderId` INT, IN `newStatus` VARCHAR(20))   BEGIN
    UPDATE checkout
    SET status = newStatus
    WHERE id = orderId;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `count_checkouts_by_status` (`statusInput` VARCHAR(20)) RETURNS INT DETERMINISTIC BEGIN
    DECLARE statusCount INT;
    
    SELECT COUNT(*) INTO statusCount
    FROM checkout
    WHERE status = statusInput;
    
    RETURN statusCount;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `count_pending_checkouts` () RETURNS INT DETERMINISTIC BEGIN
    DECLARE pendingCount INT;
    
    SELECT COUNT(*) INTO pendingCount
    FROM checkout
    WHERE status = 'pending';
    
    RETURN pendingCount;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `generate_order_number` () RETURNS VARCHAR(17) CHARSET utf8mb4 COLLATE utf8mb4_general_ci DETERMINISTIC BEGIN
    DECLARE new_order_number VARCHAR(17);
    DECLARE order_count INT;

    SELECT COUNT(*) + 1 INTO order_count
    FROM checkout
    WHERE DATE(created_at) = CURDATE();

    SET new_order_number = CONCAT(
        DATE_FORMAT(CURDATE(), '%Y%m%d'),
        DATE_FORMAT(NOW(), '%H%i%s'),
        LPAD(order_count, 3, '0')
         
    );

    RETURN new_order_number;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_size_id` int NOT NULL,
  `quantity` int NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(3, 'Casual'),
(4, 'Formal'),
(5, 'Outdoor'),
(7, 'School'),
(2, 'Sneakers'),
(1, 'Sports');

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_size_id` int NOT NULL,
  `status` enum('pending','completed','cancelled') COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `order_number` varchar(17) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `checkout`
--
DELIMITER $$
CREATE TRIGGER `after_checkout_insert` AFTER INSERT ON `checkout` FOR EACH ROW BEGIN
    DELETE FROM cart WHERE user_id = NEW.user_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`) VALUES
(3, '#232321'),
(4, '#234D41'),
(1, '#4A69E2'),
(5, '#C9CCC6'),
(2, '#FFA52F');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `comment` text COLLATE utf8mb4_general_ci NOT NULL,
  `rating` tinyint UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `product_id`, `user_id`, `comment`, `rating`, `created_at`) VALUES
(18, 2, 1, 'sudah bagus kok', 3, '2025-12-15 07:07:37');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'Salman', 'salman@gmail.com', 'Nice dude ????', '2024-12-30 07:42:03'),
(2, 'Aziz', 'aziz@gmail.com', 'Halooo', '2024-12-31 02:23:39');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `price` int NOT NULL,
  `stock` int NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category_id` int NOT NULL,
  `size_id` int DEFAULT NULL,
  `color_id` int DEFAULT NULL,
  `brand` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `image_url`, `category_id`, `size_id`, `color_id`, `brand`, `created_at`, `updated_at`) VALUES
(2, 'Eiger new', 'Stylish and comfortable sneakers with Air Max technology.', 5000000, 11, 'bannerr_3.jpg', 5, NULL, 1, 'Eiger', '2024-12-09 09:23:51', '2026-01-23 06:59:29'),
(3, 'Aerostereet new', 'Casual shoes with a classic design akay sipp', 300000, 21, '20251013_1525_image.png', 4, NULL, 5, 'Aerostreet', '2024-12-09 09:23:51', '2026-01-23 07:35:17'),
(44, 'newaerr', 'bsdig ud7ct lwjdb', 100000, 50, '7cf8d8aec9733d5c27162d8d73f06b0c.png', 2, NULL, NULL, 'aeroo', '2025-12-22 08:34:55', '2026-01-22 06:30:07'),
(47, 'venn', 'ini bagus dan berkualitas', 125000, 0, '73546a46e7d244b003e5034f6dd71c3b.jpg', 3, NULL, NULL, 'ventella', '2026-01-21 01:56:44', '2026-01-23 07:09:06'),
(48, 'van', 'sepatu berkualitas bagus', 150000, 14, 'e7bc437ca3683ac3b9ac646b13e6686d.jpg', 3, NULL, NULL, 'ventella', '2026-01-21 02:14:07', '2026-01-23 07:44:28'),
(49, 'putih', 'produk terbaikk', 100000, 30, 'c396ae13e95490cccee8a4b2cbfc501d.png', 3, NULL, NULL, 'ventela', '2026-01-26 04:42:08', '2026-01-26 04:42:08');

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

CREATE TABLE `product_size` (
  `id` int NOT NULL,
  `id_products` int NOT NULL,
  `id_sizes` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `created_at`) VALUES
(1, 'salman@gmail.com', '2024-12-30 07:41:34'),
(2, 'awo@gmail.com', '2024-12-31 02:01:54'),
(3, 'aziz@gmail.com', '2024-12-31 02:23:08'),
(5, 'galih@gmail.com', '2024-12-31 02:36:53'),
(9, 'aihsanavriandhana@gmail.com', '2025-12-04 01:33:01');

--
-- Triggers `subscribers`
--
DELIMITER $$
CREATE TRIGGER `prevent_duplicate_email_in_subscribers` BEFORE INSERT ON `subscribers` FOR EACH ROW BEGIN
  DECLARE email_exists INT;
  
  SELECT COUNT(*) INTO email_exists
  FROM subscribers
  WHERE email = NEW.email;
  
  IF email_exists > 0 THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'This email address is already subscribed.';
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gender` enum('male','female','other') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address_province` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address_city` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address_district` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address_subdistrict` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `street_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address_description` text COLLATE utf8mb4_general_ci,
  `zip_code` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_general_ci DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `reset_token` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL
) ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `email`, `password`, `gender`, `phone`, `address_province`, `address_city`, `address_district`, `address_subdistrict`, `street_name`, `address_description`, `zip_code`, `profile_picture`, `google_id`, `role`, `created_at`, `updated_at`, `reset_token`, `token_expiry`) VALUES
(1, 'Rifan Mabel Tofani', 'Rifan', 'aaa@gmail.com', '12345678', 'other', '081213800436', 'Jawa Barat', 'Bogor', 'Ciomass', 'Ciomass', 'jl. sukamulya 2', 'tembok abu', '16618', 'da1a2ee64e7f7312cf716afad1ccff00.png', NULL, 'user', '2024-12-26 06:17:34', '2026-01-20 04:34:17', NULL, NULL),
(2, 'admin', 'admin', 'admin@gmail.com', 'admin', 'male', '0869', 'kepo lu', 'kepo lu', 'kepo lu', 'kepo lu', 'kepo lu', 'kepo lu', '16610', 'senku_einstein_pose1.jpg', NULL, 'admin', '2024-12-27 08:24:36', '2026-01-22 06:00:47', NULL, NULL),
(4, 'Muhammad Fahmi Aziz', 'Fahmi', 'fahmi@gmail.com', '', 'male', '086969696969', 'Banten', 'Serang', 'asal', 'asa', 'jl. serang', 'olahhhhhhh!', '46069', 'foto_charles2.jpg', NULL, 'user', '2025-01-15 08:37:11', '2025-12-15 04:21:01', NULL, NULL),
(5, 'Wisnu Fadhilah', 'Wisnu', 'wisnu@gmail.com', '', 'male', '081199119119', 'j', 'j', 'j', 'j', 'j', 'j', '19919', 'download5.jpeg', NULL, 'user', '2025-01-19 13:02:30', '2025-12-15 04:39:10', NULL, NULL),
(12, 'ALIF IHSAN AVRIANDHANA', 'aihsanavriandhana@gmail.com', 'aihsanavriandhana@gmail.com', '', 'male', '089668144898', 'JAWA TIMUR', 'KOTA SURABAYA', 'benowo', 'sememi', 'bandarejo', 'pagar hitam', '46060', 'https://lh3.googleusercontent.com/a/ACg8ocLNqidEkpZYY4dwuwUzqJGkWxLVVMKBGVpxmdHdxcsWlZEdsw=s96-c', '101901265230124738274', 'user', '2026-01-07 19:07:06', '2026-01-22 05:51:02', '410e8369206c70446a73d38ad564549ce21e4236cd3531fb032e8faf9d8e45c8', '2026-01-22 06:51:02'),
(15, 'juan', 'juan', 'fihaaridhoi@gmail.com', '12345678910', 'male', '0812345678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'default.jpg', NULL, 'user', '2026-01-21 22:45:51', '2026-01-22 05:56:06', NULL, NULL);

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `prevent_user_deletion_with_active_order` BEFORE DELETE ON `users` FOR EACH ROW BEGIN
  DECLARE active_orders INT;
  
  SELECT COUNT(*) INTO active_orders
  FROM checkout
  WHERE user_id = OLD.id AND status = 'pending';
  
  IF active_orders > 0 THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'User cannot be deleted as there are active pending orders.';
  END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_size_ibfk_1` (`product_size_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user_id`),
  ADD KEY `checkout_ibfk_1` (`product_size_id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `size_id` (`size_id`),
  ADD KEY `color_id` (`color_id`);

--
-- Indexes for table `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product` (`id_products`),
  ADD KEY `size` (`id_sizes`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `google_id` (`google_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_size`
--
ALTER TABLE `product_size`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_size_ibfk_1` FOREIGN KEY (`product_size_id`) REFERENCES `product_size` (`id`);

--
-- Constraints for table `checkout`
--
ALTER TABLE `checkout`
  ADD CONSTRAINT `checkout_ibfk_1` FOREIGN KEY (`product_size_id`) REFERENCES `product_size` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_size`
--
ALTER TABLE `product_size`
  ADD CONSTRAINT `product` FOREIGN KEY (`id_products`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `size` FOREIGN KEY (`id_sizes`) REFERENCES `sizes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
