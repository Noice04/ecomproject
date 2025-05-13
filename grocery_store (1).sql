-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2025 at 05:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grocery_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL,
  `total_price` decimal(20,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cartitem`
--

CREATE TABLE `cartitem` (
  `cart_item_id` int(25) NOT NULL,
  `cart_id` int(25) NOT NULL,
  `product_id` int(25) NOT NULL,
  `quantity` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(25) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`) VALUES
(1, 'dairy'),
(2, 'bakery'),
(3, 'fruit'),
(4, 'meat');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL,
  `total_price` decimal(20,0) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_item` int(25) NOT NULL,
  `order_id` int(25) NOT NULL,
  `product_id` int(25) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(25) NOT NULL,
  `order_id` int(25) NOT NULL,
  `payment_method` varchar(25) NOT NULL,
  `payment_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(25) NOT NULL,
  `name` varchar(25) NOT NULL,
  `description` varchar(40) NOT NULL,
  `price` decimal(4,2) NOT NULL,
  `stock` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `image_url` varchar(80) DEFAULT NULL,
  `deal` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `stock`, `category_id`, `image_url`, `deal`) VALUES
(1, 'Wheat Bread', 'Fresh bread made in store', 10.00, 7, 2, 'https://cdn.pixabay.com/photo/2019/05/06/14/24/bread-4183225_1280.jpg', 0),
(2, 'Whole Bread', 'Its good for you', 10.00, 20, 2, 'https://cdn.pixabay.com/photo/2022/03/23/15/40/sliced-bread-7087438_1280.jpg', 0),
(4, 'Milk', 'Dairy product from a cow', 6.00, 20, 1, 'https://cdn.pixabay.com/photo/2016/12/06/18/27/milk-1887234_1280.jpg', 0),
(5, 'Bacon', 'Pork Belly that is cut in thin slices', 13.50, 10, 4, 'https://cdn.pixabay.com/photo/2021/01/11/19/17/breakfast-5909430_1280.jpg', 0),
(6, 'Banana', 'yellow fruit full of flavour', 2.20, 50, 3, 'https://cdn.pixabay.com/photo/2011/03/24/10/12/banana-5734_1280.jpg', 0),
(7, 'Apple', 'crisp red fruit, sweet and juicy', 1.50, 100, 3, 'https://cdn.pixabay.com/photo/2014/02/01/17/28/apple-256261_1280.jpg', 0),
(8, 'Orange', 'citrus fruit rich in vitamin C', 1.80, 80, 3, 'https://cdn.pixabay.com/photo/2017/01/20/15/06/orange-1995056_1280.jpg', 1),
(9, 'Strawberry', 'fresh and sweet summer berry', 3.00, 60, 3, 'https://cdn.pixabay.com/photo/2022/05/27/10/35/strawberry-7224875_1280.jpg', 0),
(11, 'Cheddar Cheese', 'aged sharp cheddar block', 4.50, 30, 1, 'https://cdn.pixabay.com/photo/2010/12/16/12/09/keens-cheddar-3514_1280.jpg', 1),
(12, 'Whole Wheat Bread', 'freshly baked brown bread', 2.00, 55, 2, 'https://cdn.pixabay.com/photo/2015/10/23/19/50/bread-1003564_1280.jpg', 0),
(13, 'Eggs', 'pack of 12 large brown eggs', 3.20, 90, 4, 'https://cdn.pixabay.com/photo/2022/07/26/13/55/egg-7345934_1280.jpg', 0),
(14, 'Yogurt', '500g plain Greek yogurt', 2.80, 75, 1, 'https://cdn.pixabay.com/photo/2016/12/22/10/46/raspberries-1925178_640.jpg', 1),
(15, 'Chicken Breast', 'boneless skinless chicken breast', 5.50, 40, 4, 'https://cdn.pixabay.com/photo/2014/03/05/01/20/chicken-breast-279849_640.jpg', 0),
(16, 'Sausage Links', 'pork sausages with herbs', 4.20, 50, 4, 'https://cdn.pixabay.com/photo/2014/08/26/15/24/sausage-428067_640.jpg', 1),
(17, 'Grapes', 'sweet and seedless green grapes', 2.90, 60, 3, 'https://cdn.pixabay.com/photo/2021/01/05/05/30/grapes-5889697_640.jpg', 0),
(18, 'Peach', 'juicy peach perfect for snacking', 1.75, 45, 3, 'https://cdn.pixabay.com/photo/2017/08/11/17/41/peach-2632182_1280.jpg', 1),
(19, 'Blueberry Muffin', 'freshly baked with real blueberries', 2.50, 30, 2, 'https://cdn.pixabay.com/photo/2017/03/12/10/29/blueberry-2136748_640.jpg', 0),
(20, 'Bagel', 'chewy and golden brown bagel', 1.80, 40, 2, 'https://cdn.pixabay.com/photo/2023/01/09/05/55/bagel-7706691_1280.jpg', 0),
(21, 'Cream Cheese', 'smooth and tangy dairy spread', 2.60, 25, 1, 'https://cdn.pixabay.com/photo/2013/09/11/22/52/cream-cheese-181530_640.jpg', 1),
(22, 'Butter', 'unsalted butter stick for cooking', 1.90, 35, 1, 'https://cdn.pixabay.com/photo/2018/05/18/12/55/butter-3411126_640.jpg', 0),
(23, 'Ground Beef', 'lean ground beef for burgers', 6.30, 50, 4, 'https://cdn.pixabay.com/photo/2021/06/21/10/33/minced-meat-6352865_1280.jpg', 1),
(24, 'Bacon', 'smoked pork bacon strips', 5.10, 40, 4, 'https://cdn.pixabay.com/photo/2014/10/19/20/59/bacon-494027_1280.jpg', 0),
(25, 'Turkey Breast', 'sliced turkey breast for sandwiches', 4.75, 30, 4, 'https://cdn.pixabay.com/photo/2018/07/08/19/04/turkey-3525914_1280.jpg', 1),
(26, 'Cottage Cheese', 'high-protein dairy snack', 3.10, 60, 1, 'https://cdn.pixabay.com/photo/2020/05/18/17/01/cottage-cheese-5188644_1280.jpg', 0),
(27, 'Mozzarella Cheese', 'fresh Italian mozzarella ball', 3.90, 40, 1, 'https://cdn.pixabay.com/photo/2020/01/06/20/53/mozzarella-4744181_1280.jpg', 0),
(28, 'Sour Cream', 'creamy and tangy dairy topping', 2.30, 35, 1, 'https://cdn.pixabay.com/photo/2020/08/10/15/01/cream-5478161_1280.jpg', 1),
(29, 'Swiss Cheese', 'nutty and mild block of Swiss cheese', 4.70, 30, 1, 'https://cdn.pixabay.com/photo/2020/06/24/18/26/swiss-cheese-5337558_1280.jpg', 0),
(30, 'Buttermilk', 'low-fat cultured buttermilk', 1.95, 28, 1, 'https://cdn.pixabay.com/photo/2021/09/10/15/01/buttermilk-6613680_1280.jpg', 1),
(31, 'Vanilla Yogurt', 'sweet and creamy dairy snack', 2.20, 60, 1, 'https://cdn.pixabay.com/photo/2016/10/24/21/05/yogurt-1761033_1280.jpg', 0),
(32, 'Wheat Rolls', 'freshly baked wheat dinner rolls', 2.10, 50, 2, 'https://cdn.pixabay.com/photo/2018/03/01/14/56/bread-3192404_1280.jpg', 1),
(33, 'Baguette', 'crispy French baguette', 1.70, 45, 2, 'https://cdn.pixabay.com/photo/2017/03/27/13/59/baguette-2178874_1280.jpg', 0),
(34, 'Croissant', 'buttery and flaky croissant', 2.40, 38, 2, 'https://cdn.pixabay.com/photo/2017/06/18/18/38/croissant-2419132_1280.jpg', 1),
(35, 'Donut', 'glazed donut with chocolate topping', 1.80, 60, 2, 'https://cdn.pixabay.com/photo/2015/06/10/04/37/donut-804144_1280.jpg', 0),
(36, 'Cinnamon Roll', 'swirled pastry with cinnamon and icing', 2.60, 42, 2, 'https://cdn.pixabay.com/photo/2017/02/16/16/34/bun-2078312_1280.jpg', 0),
(37, 'Pear', 'juicy and sweet green pear', 1.65, 55, 3, 'https://cdn.pixabay.com/photo/2017/01/20/15/06/pear-1995063_1280.jpg', 1),
(38, 'Kiwi', 'tangy kiwi fruit with green flesh', 0.95, 80, 3, 'https://cdn.pixabay.com/photo/2017/08/06/09/35/kiwi-2587211_1280.jpg', 0),
(39, 'Pineapple', 'tropical fruit full of flavor', 3.80, 30, 3, 'https://cdn.pixabay.com/photo/2016/03/05/19/02/pineapple-1238310_1280.jpg', 1),
(40, 'Mango', 'sweet and juicy tropical mango', 2.40, 40, 3, 'https://cdn.pixabay.com/photo/2015/05/26/14/39/mango-784469_1280.jpg', 0),
(41, 'Cherries', 'fresh red cherries, sweet and tart', 3.20, 35, 3, 'https://cdn.pixabay.com/photo/2016/06/17/06/05/cherries-1465802_1280.jpg', 1),
(42, 'Plum', 'ripe purple plums', 1.85, 38, 3, 'https://cdn.pixabay.com/photo/2017/10/25/11/09/plum-2880772_1280.jpg', 0),
(43, 'Watermelon', 'large juicy watermelon slice', 4.00, 25, 3, 'https://cdn.pixabay.com/photo/2015/07/17/14/43/watermelon-849265_1280.jpg', 1),
(44, 'Lemon', 'zesty lemons for drinks or cooking', 1.10, 65, 3, 'https://cdn.pixabay.com/photo/2016/02/19/11/19/lemons-1205657_1280.jpg', 0),
(45, 'Raspberry', 'tart and sweet fresh raspberries', 3.50, 30, 3, 'https://cdn.pixabay.com/photo/2018/08/22/19/02/raspberry-3629234_1280.jpg', 1),
(46, 'Papaya', 'exotic and refreshing papaya', 3.75, 27, 3, 'https://cdn.pixabay.com/photo/2016/11/21/15/55/papaya-1846387_1280.jpg', 0),
(47, 'Beef Steak', 'premium cut beef steak', 9.90, 20, 4, 'https://cdn.pixabay.com/photo/2017/06/20/19/22/steak-2423271_1280.jpg', 1),
(48, 'Pork Chop', 'thick-cut pork chops for grilling', 5.70, 35, 4, 'https://cdn.pixabay.com/photo/2017/03/27/13/59/pork-2178890_1280.jpg', 0),
(49, 'Lamb Chops', 'tender lamb rib chops', 11.50, 18, 4, 'https://cdn.pixabay.com/photo/2016/04/27/09/39/lamb-1359582_1280.jpg', 1),
(50, 'Turkey Legs', 'roasted turkey drumsticks', 6.40, 24, 4, 'https://cdn.pixabay.com/photo/2016/03/05/22/59/meat-1239244_1280.jpg', 0),
(51, 'Beef Ribs', 'slow-cooked BBQ beef ribs', 8.20, 22, 4, 'https://cdn.pixabay.com/photo/2016/03/05/22/49/ribs-1239151_1280.jpg', 1),
(52, 'Ham Slices', 'sliced cured ham for sandwiches', 4.30, 40, 4, 'https://cdn.pixabay.com/photo/2017/08/10/07/32/ham-2612965_1280.jpg', 0),
(53, 'Meatballs', 'homemade seasoned beef meatballs', 5.00, 35, 4, 'https://cdn.pixabay.com/photo/2014/04/22/02/56/meatballs-329523_1280.jpg', 1),
(54, 'Roast Beef', 'oven-roasted beef slices', 7.10, 28, 4, 'https://cdn.pixabay.com/photo/2015/05/02/00/57/roast-beef-749439_1280.jpg', 0),
(55, 'Sliced Salami', 'pepper salami slices for platters', 3.80, 30, 4, 'https://cdn.pixabay.com/photo/2020/05/10/18/56/salami-5151507_1280.jpg', 1),
(56, 'Chicken Wings', 'seasoned and cooked chicken wings', 4.90, 45, 4, 'https://cdn.pixabay.com/photo/2017/08/10/07/30/chicken-2612948_1280.jpg', 0),
(57, 'Greek Yogurt', 'thick Greek-style yogurt', 2.70, 50, 1, 'https://cdn.pixabay.com/photo/2020/05/11/17/28/greek-yogurt-5153941_1280.jpg', 1),
(58, 'Chocolate Milk', 'chilled chocolate flavored milk', 1.60, 60, 1, 'https://cdn.pixabay.com/photo/2017/10/04/19/47/chocolate-2816470_1280.jpg', 0),
(59, 'Cream Cheese Spread', 'smooth spreadable cheese', 2.50, 40, 1, 'https://cdn.pixabay.com/photo/2016/05/05/10/40/spread-1375298_1280.jpg', 0),
(60, 'Cottage Cheese Tub', 'soft curds with mild flavor', 3.30, 35, 1, 'https://cdn.pixabay.com/photo/2020/05/18/17/01/cottage-cheese-5188644_1280.jpg', 1),
(61, 'Eggnog', 'holiday spiced dairy drink', 3.20, 25, 1, 'https://cdn.pixabay.com/photo/2020/11/19/20/48/eggnog-5757079_1280.jpg', 0),
(62, 'Cheese Danish', 'pastry filled with sweet cheese', 2.80, 30, 2, 'https://cdn.pixabay.com/photo/2021/02/02/12/44/cheese-danish-5973036_1280.jpg', 1),
(63, 'Muffin Variety Pack', 'assorted flavored muffins', 5.50, 20, 2, 'https://cdn.pixabay.com/photo/2017/08/07/23/39/muffin-2606971_1280.jpg', 0),
(64, 'Focaccia Bread', 'Italian flatbread with herbs', 3.10, 35, 2, 'https://cdn.pixabay.com/photo/2020/06/24/18/10/focaccia-5337509_1280.jpg', 0),
(65, 'Apple Pie', 'classic American apple pie slice', 3.70, 28, 2, 'https://cdn.pixabay.com/photo/2016/11/29/03/53/apple-pie-1867766_1280.jpg', 1),
(66, 'Pumpkin Bread', 'moist spiced pumpkin loaf', 2.90, 33, 2, 'https://cdn.pixabay.com/photo/2018/09/19/14/42/pumpkin-bread-3688612_1280.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `subscription_id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `subscribed_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(70) NOT NULL,
  `address` varchar(40) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `address`, `is_admin`) VALUES
(11, 'asdf', 'asdf@asdf', '$2y$10$U/DmvfWu9.SIaRWuYseb6e/Sw51oFAzUoapScXygh3LBdoJGdUz.O', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlistitem`
--

CREATE TABLE `wishlistitem` (
  `wishlist_item_id` int(25) NOT NULL,
  `user_id` int(25) NOT NULL,
  `product_id` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `fk_cart_user` (`user_id`);

--
-- Indexes for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD KEY `fk_cartitem_product` (`product_id`),
  ADD KEY `fk_cartitem_cart` (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_order_user` (`user_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_item`),
  ADD KEY `fk_orderitem_order` (`order_id`),
  ADD KEY `fk_orderitem_product` (`product_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `fk_payment_order` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_product_category` (`category_id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`subscription_id`),
  ADD KEY `fk_subscription_user` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wishlistitem`
--
ALTER TABLE `wishlistitem`
  ADD PRIMARY KEY (`wishlist_item_id`),
  ADD KEY `fk_wishlistitem_user` (`user_id`),
  ADD KEY `fk_wishlistitem_product` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_item` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `subscription_id` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `wishlistitem`
--
ALTER TABLE `wishlistitem`
  MODIFY `wishlist_item_id` int(25) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD CONSTRAINT `fk_cartitem_cart` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`),
  ADD CONSTRAINT `fk_cartitem_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `fk_orderitem_order` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`),
  ADD CONSTRAINT `fk_orderitem_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_payment_order` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `subscription`
--
ALTER TABLE `subscription`
  ADD CONSTRAINT `fk_subscription_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `wishlistitem`
--
ALTER TABLE `wishlistitem`
  ADD CONSTRAINT `fk_wishlistitem_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `fk_wishlistitem_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
