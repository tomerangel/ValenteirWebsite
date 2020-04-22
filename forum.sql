-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: אפריל 21, 2020 בזמן 05:18 PM
-- גרסת שרת: 10.4.11-MariaDB
-- PHP Version: 7.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `barcode` int(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `p_name` varchar(30) NOT NULL,
  `p_image` varchar(50) NOT NULL,
  `p_price` int(10) NOT NULL,
  `p_size` varchar(3) NOT NULL,
  `p_quantity` int(10) NOT NULL,
  `p_catagory` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- הוצאת מידע עבור טבלה `cart`
--

INSERT INTO `cart` (`id`, `barcode`, `username`, `p_name`, `p_image`, `p_price`, `p_size`, `p_quantity`, `p_catagory`) VALUES
(6, 456456465, 'tomerangel', '????? ?????', '1660802700_2_1_1.jpg', 10, 'XS', 1, 'tops'),
(5, 123123, 'tomerangel', 'tShirt', '2029218330_1_1_1.jpg', 20, 'XS', 1, 'tops');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `orders`
--

CREATE TABLE `orders` (
  `id` int(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `time` varchar(10) NOT NULL,
  `year` int(5) NOT NULL,
  `month` int(3) NOT NULL,
  `day` int(3) NOT NULL,
  `barcode` int(15) NOT NULL,
  `name` varchar(30) NOT NULL,
  `image` varchar(50) NOT NULL,
  `size` varchar(3) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- הוצאת מידע עבור טבלה `orders`
--

INSERT INTO `orders` (`id`, `username`, `time`, `year`, `month`, `day`, `barcode`, `name`, `image`, `size`, `quantity`, `price`) VALUES
(1, 'tomerangel', '12:06:18', 2020, 4, 20, 123, 'tome', 'WhatsApp Image 2019-12-22 at 19.33.34 (6).jpeg', 'XS', 1, 100);

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `payments`
--

CREATE TABLE `payments` (
  `id` int(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `time` varchar(15) NOT NULL,
  `year` int(5) NOT NULL,
  `month` int(3) NOT NULL,
  `day` int(3) NOT NULL,
  `card` varchar(20) NOT NULL,
  `cvv` varchar(5) NOT NULL,
  `exp` varchar(20) NOT NULL,
  `tprice` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- הוצאת מידע עבור טבלה `payments`
--

INSERT INTO `payments` (`id`, `username`, `time`, `year`, `month`, `day`, `card`, `cvv`, `exp`, `tprice`) VALUES
(1, 'tomerangel', '12:06:18', 2020, 4, 20, '1111222233334444', '344', '1-2020', '100');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `post_data` varchar(500) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- הוצאת מידע עבור טבלה `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_data`, `username`) VALUES
(1, 3, 'aaaa', 'tomer'),
(2, 3, 'asdasd', 'tomer'),
(3, 3, 'asdasd', 'tomer'),
(4, 3, 'asdasd', 'tomer'),
(5, 3, 'asdqwelkq;e', 'tomer'),
(6, 3, 'asdjklj', 'tomer'),
(7, 3, 'asd', 'tomer');

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `product`
--

CREATE TABLE `product` (
  `id` int(10) NOT NULL,
  `barcode` int(15) NOT NULL,
  `name` varchar(30) NOT NULL,
  `image` varchar(50) NOT NULL,
  `price` int(10) NOT NULL,
  `catagory` varchar(20) NOT NULL,
  `size` varchar(3) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- הוצאת מידע עבור טבלה `product`
--

INSERT INTO `product` (`id`, `barcode`, `name`, `image`, `price`, `catagory`, `size`, `quantity`) VALUES
(1, 123, 'tome', 'WhatsApp Image 2019-12-22 at 19.33.34 (6).jpeg', 100, 'heels', 'All', 1),
(2, 456456465, '????? ?????', '1660802700_2_1_1.jpg', 10, 'tops', 'All', 1),
(3, 123123, 'tShirt', '2029218330_1_1_1.jpg', 20, 'tops', 'All', 1);

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `shippments`
--

CREATE TABLE `shippments` (
  `id` int(15) NOT NULL,
  `full_name` varchar(40) NOT NULL,
  `year` int(5) NOT NULL,
  `month` int(3) NOT NULL,
  `day` int(3) NOT NULL,
  `city` varchar(15) NOT NULL,
  `state` varchar(10) NOT NULL,
  `address` varchar(30) NOT NULL,
  `zip` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- הוצאת מידע עבור טבלה `shippments`
--

INSERT INTO `shippments` (`id`, `full_name`, `year`, `month`, `day`, `city`, `state`, `address`, `zip`) VALUES
(1, 'tomer angel', 2020, 4, 20, '??? ???', '', '?????, 5', 8435013);

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `stock`
--

CREATE TABLE `stock` (
  `id` int(10) NOT NULL,
  `barcode` int(15) NOT NULL,
  `name` varchar(30) NOT NULL,
  `image` varchar(50) NOT NULL,
  `price` int(10) NOT NULL,
  `catagory` varchar(20) NOT NULL,
  `size` varchar(3) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- הוצאת מידע עבור טבלה `stock`
--

INSERT INTO `stock` (`id`, `barcode`, `name`, `image`, `price`, `catagory`, `size`, `quantity`) VALUES
(1, 123, 'tome', 'WhatsApp Image 2019-12-22 at 19.33.34 (6).jpeg', 100, 'heels', 'S', 100),
(2, 456456465, '????? ?????', '1660802700_2_1_1.jpg', 10, 'tops', 'L', 10),
(3, 123123, 'tShirt', '2029218330_1_1_1.jpg', 20, 'tops', 'L', 1);

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `support`
--

CREATE TABLE `support` (
  `id` int(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `full_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `year` int(5) NOT NULL,
  `month` int(3) NOT NULL,
  `day` int(3) NOT NULL,
  `time` varchar(10) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- הוצאת מידע עבור טבלה `support`
--

INSERT INTO `support` (`id`, `username`, `full_name`, `email`, `year`, `month`, `day`, `time`, `message`) VALUES
(1, 'tomerangel', 'tomer a', 'tomerangel9@gmail.com', 2020, 4, 20, '10:37:40', 'a12312465454');

-- --------------------------------------------------------

--
-- Stand-in structure for view `tomerangel`
-- (See below for the actual view)
--
CREATE TABLE `tomerangel` (
`id` int(10)
,`barcode` int(15)
,`name` varchar(30)
,`image` varchar(50)
,`price` int(10)
,`catagory` varchar(20)
,`size` varchar(3)
,`quantity` int(10)
);

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` int(50) NOT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `rank` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- הוצאת מידע עבור טבלה `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `balance`, `email`, `rank`) VALUES
(1, 'test', 123123, '100000', NULL, NULL),
(6, 'tomer', 123456, '25320', NULL, NULL),
(7, 'to', 156, '90000', NULL, NULL),
(8, 'tomerangel', 123, NULL, 'tomerangel9@gmail.com', 2);

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `users_volunteer`
--

CREATE TABLE `users_volunteer` (
  `id` int(11) NOT NULL,
  `username_volunteer` varchar(30) NOT NULL,
  `password_volunteer` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- מבנה טבלה עבור טבלה `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `barcode` int(15) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `catagory` varchar(20) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure for view `tomerangel`
--
DROP TABLE IF EXISTS `tomerangel`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tomerangel`  AS  select `product`.`id` AS `id`,`product`.`barcode` AS `barcode`,`product`.`name` AS `name`,`product`.`image` AS `image`,`product`.`price` AS `price`,`product`.`catagory` AS `catagory`,`product`.`size` AS `size`,`product`.`quantity` AS `quantity` from `product` ;

--
-- Indexes for dumped tables
--

--
-- אינדקסים לטבלה `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- אינדקסים לטבלה `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- אינדקסים לטבלה `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- אינדקסים לטבלה `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- אינדקסים לטבלה `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- אינדקסים לטבלה `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`id`);

--
-- אינדקסים לטבלה `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- אינדקסים לטבלה `users_volunteer`
--
ALTER TABLE `users_volunteer`
  ADD PRIMARY KEY (`id`);

--
-- אינדקסים לטבלה `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users_volunteer`
--
ALTER TABLE `users_volunteer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
