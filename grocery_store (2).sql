-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2025 at 10:00 AM
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
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `item_cart_id` int(25) NOT NULL,
  `product_id` int(25) NOT NULL,
  `quantity` int(10) NOT NULL,
  `user_id` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`item_cart_id`, `product_id`, `quantity`, `user_id`) VALUES
(95, 19, 1, 13),
(96, 16, 1, 13),
(98, 13, 1, 13),
(104, 5, 1, 13),
(105, 9, 2, 13),
(106, 6, 1, 13);

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
(1, 'Dairy'),
(2, 'Bakery'),
(3, 'Fruit'),
(4, 'Meat');

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

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `user_id`, `total_price`, `status`, `created_at`) VALUES
(10, 13, 23, 0, '2025-05-14'),
(11, 13, 23, 0, '2025-05-14'),
(12, 13, 23, 0, '2025-05-14'),
(13, 13, 23, 0, '2025-05-14'),
(14, 13, 58, 0, '2025-05-14'),
(15, 16, 48, 0, '2025-05-15'),
(16, 13, 68, 0, '2025-05-15'),
(17, 13, 45, 0, '2025-05-15'),
(18, 13, 17, 0, '2025-05-15'),
(19, 13, 11, 0, '2025-05-15'),
(20, 13, 6, 0, '2025-05-15');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_item_id` int(25) NOT NULL,
  `order_id` int(25) NOT NULL,
  `product_id` int(25) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(29, 10, 4, 1, 6),
(30, 10, 11, 2, 5),
(31, 10, 14, 3, 3),
(32, 11, 4, 1, 6),
(33, 11, 11, 2, 5),
(34, 11, 14, 3, 3),
(35, 12, 4, 1, 6),
(36, 12, 11, 2, 5),
(37, 12, 14, 3, 3),
(38, 13, 4, 1, 6),
(39, 13, 11, 2, 5),
(40, 13, 14, 3, 3),
(41, 14, 4, 4, 6),
(42, 14, 11, 1, 5),
(43, 14, 14, 1, 3),
(44, 14, 21, 1, 3),
(45, 14, 1, 1, 10),
(46, 14, 2, 1, 10),
(47, 14, 12, 1, 2),
(48, 14, 19, 1, 3),
(49, 15, 4, 5, 6),
(50, 15, 11, 1, 5),
(51, 15, 5, 1, 14),
(52, 16, 1, 5, 10),
(53, 16, 4, 3, 6),
(54, 17, 4, 3, 6),
(55, 17, 1, 1, 10),
(56, 17, 5, 1, 14),
(57, 17, 13, 1, 3),
(58, 18, 4, 2, 6),
(59, 18, 11, 1, 5),
(60, 19, 4, 1, 6),
(61, 19, 11, 1, 5),
(62, 20, 4, 1, 6);

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
(23, 'Ground Beef', 'lean ground beef for burgers', 6.30, 50, 4, 'https://cdn.pixabay.com/photo/2016/11/21/15/42/beef-1846030_640.jpg', 1),
(25, 'Turkey Breast', 'sliced turkey breast for sandwiches', 4.75, 30, 4, 'https://cdn.pixabay.com/photo/2022/11/06/13/29/turkey-breast-7574011_1280.jpg', 1),
(26, 'Cottage Cheese', 'high-protein dairy snack', 3.10, 60, 1, 'https://cdn.pixabay.com/photo/2018/05/01/18/35/bowl-3366480_640.jpg', 0),
(27, 'Mozzarella Cheese', 'fresh Italian mozzarella ball', 3.90, 40, 1, 'https://cdn.pixabay.com/photo/2019/03/07/19/32/mozzarella-4040896_1280.jpg', 0),
(28, 'Sour Cream', 'creamy and tangy dairy topping', 2.30, 35, 1, 'https://cdn.pixabay.com/photo/2019/05/19/23/59/sour-cream-4215618_640.jpg', 1),
(29, 'Swiss Cheese', 'nutty and mild block of Swiss cheese', 4.70, 30, 1, 'https://cdn.pixabay.com/photo/2017/01/11/19/56/cheese-1972744_640.jpg', 0),
(30, 'Buttermilk', 'low-fat cultured buttermilk', 1.95, 28, 1, 'https://cdn.pixabay.com/photo/2015/08/29/04/53/buttermilk-912760_640.jpg', 1),
(31, 'Vanilla Yogurt', 'sweet and creamy dairy snack', 2.20, 60, 1, 'https://cdn.pixabay.com/photo/2018/04/05/16/49/yoghurt-3293359_640.jpg', 0),
(32, 'Wheat Rolls', 'freshly baked wheat dinner rolls', 2.10, 50, 2, 'https://cdn.pixabay.com/photo/2019/03/10/16/22/bread-4046506_640.jpg', 1),
(33, 'Baguette', 'crispy French baguette', 1.70, 45, 2, 'https://cdn.pixabay.com/photo/2017/06/23/23/57/bread-2436370_1280.jpg', 0),
(34, 'Croissant', 'buttery and flaky croissant', 2.40, 38, 2, 'https://cdn.pixabay.com/photo/2023/03/05/13/21/croissant-7831358_640.jpg', 1),
(35, 'Donut', 'glazed donut with chocolate topping', 1.80, 60, 2, 'https://cdn.pixabay.com/photo/2018/09/06/12/29/food-3658149_640.jpg', 0),
(36, 'Cinnamon Roll', 'swirled pastry with cinnamon and icing', 2.60, 42, 2, 'https://cdn.pixabay.com/photo/2023/11/13/13/19/food-8385524_640.jpg', 0),
(37, 'Pear', 'juicy and sweet green pear', 1.65, 55, 3, 'https://cdn.pixabay.com/photo/2017/05/09/11/02/pear-2297977_640.jpg', 1),
(38, 'Kiwi', 'tangy kiwi fruit with green flesh', 0.95, 80, 3, 'https://cdn.pixabay.com/photo/2021/10/17/16/44/kiwi-6718889_640.jpg', 0),
(39, 'Pineapple', 'tropical fruit full of flavor', 3.80, 30, 3, 'https://cdn.pixabay.com/photo/2020/02/09/19/34/pineapple-4834341_640.jpg', 1),
(40, 'Mango', 'sweet and juicy tropical mango', 2.40, 40, 3, 'https://cdn.pixabay.com/photo/2017/04/09/07/30/chaise-mans-2215042_640.jpg', 0),
(41, 'Cherries', 'fresh red cherries, sweet and tart', 3.20, 35, 3, 'https://cdn.pixabay.com/photo/2016/07/08/10/27/cherries-1503977_640.jpg', 1),
(42, 'Plum', 'ripe purple plums', 1.85, 38, 3, 'https://cdn.pixabay.com/photo/2018/08/24/15/32/plums-3628167_640.jpg', 0),
(43, 'Watermelon', 'large juicy watermelon slice', 4.00, 25, 3, 'https://cdn.pixabay.com/photo/2022/10/29/09/29/fruits-7554872_640.jpg', 1),
(44, 'Lemon', 'zesty lemons for drinks or cooking', 1.10, 65, 3, 'https://cdn.pixabay.com/photo/2018/04/03/18/32/fruit-3287620_640.jpg', 0),
(45, 'Raspberry', 'tart and sweet fresh raspberries', 3.50, 30, 3, 'https://cdn.pixabay.com/photo/2017/01/31/09/30/raspberry-2023406_640.jpg', 1),
(46, 'Papaya', 'exotic and refreshing papaya', 3.75, 27, 3, 'https://cdn.pixabay.com/photo/2015/10/01/00/31/papaya-966322_640.jpg', 0),
(47, 'Beef Steak', 'premium cut beef steak', 9.90, 20, 4, 'https://cdn.pixabay.com/photo/2022/11/15/12/22/beef-7593867_640.jpg', 1),
(48, 'Pork Chop', 'thick-cut pork chops for grilling', 5.70, 35, 4, 'https://cdn.pixabay.com/photo/2017/10/02/17/24/chops-2809505_640.jpg', 0),
(49, 'Lamb Chops', 'tender lamb rib chops', 11.50, 18, 4, 'https://cdn.pixabay.com/photo/2017/05/15/13/00/lamb-2314811_640.jpg', 1),
(50, 'Turkey Legs', 'roasted turkey drumsticks', 6.40, 24, 4, 'https://cdn.pixabay.com/photo/2014/06/28/14/05/chicken-leg-378947_640.jpg', 0),
(51, 'Beef Ribs', 'slow-cooked BBQ beef ribs', 8.20, 22, 4, 'https://cdn.pixabay.com/photo/2022/11/15/12/22/beef-7593867_640.jpg', 1),
(52, 'Ham Slices', 'sliced cured ham for sandwiches', 4.30, 40, 4, 'https://cdn.pixabay.com/photo/2017/05/02/14/55/black-forest-ham-2278383_1280.jpg', 0),
(53, 'Meatballs', 'homemade seasoned beef meatballs', 5.00, 35, 4, 'https://cdn.pixabay.com/photo/2019/09/28/21/04/meatballs-4511773_640.jpg', 1),
(54, 'Roast Beef', 'oven-roasted beef slices', 7.10, 28, 4, 'https://cdn.pixabay.com/photo/2019/12/16/19/51/roast-beef-4700101_640.jpg', 0),
(55, 'Sliced Salami', 'pepper salami slices for platters', 3.80, 30, 4, 'https://cdn.pixabay.com/photo/2017/01/15/14/49/eat-1981735_640.jpg', 1),
(56, 'Chicken Wings', 'seasoned and cooked chicken wings', 4.90, 45, 4, 'https://cdn.pixabay.com/photo/2022/11/07/15/47/chicken-wings-7576679_640.jpg', 0),
(57, 'Greek Yogurt', 'thick Greek-style yogurt', 2.70, 50, 1, 'https://cdn.pixabay.com/photo/2016/06/07/17/15/yogurt-1442034_640.jpg', 1),
(58, 'Chocolate Milk', 'chilled chocolate flavored milk', 1.60, 60, 1, 'https://cdn.pixabay.com/photo/2015/11/23/11/57/hot-chocolate-1058197_640.jpg', 0),
(59, 'Cream Cheese Spread', 'smooth spreadable cheese', 2.50, 40, 1, 'https://cdn.pixabay.com/photo/2016/05/07/12/12/a-sandwich-1377387_640.jpg', 0),
(60, 'Cottage Cheese Tub', 'soft curds with mild flavor', 3.30, 35, 1, 'https://cdn.pixabay.com/photo/2020/04/19/10/57/bread-5063099_640.jpg', 1),
(61, 'Eggnog', 'holiday spiced dairy drink', 3.20, 25, 1, 'https://cdn.pixabay.com/photo/2017/12/01/15/49/egg-nog-2991133_640.jpg', 0),
(62, 'Cheese Danish', 'pastry filled with sweet cheese', 2.80, 30, 2, 'https://cdn.pixabay.com/photo/2015/08/17/20/12/danish-pastry-892909_1280.jpg', 1),
(63, 'Muffin Variety Pack', 'assorted flavored muffins', 5.50, 20, 2, 'https://cdn.pixabay.com/photo/2017/08/01/14/38/cupcake-2565913_640.jpg', 0),
(64, 'Focaccia Bread', 'Italian flatbread with herbs', 3.10, 35, 2, 'https://cdn.pixabay.com/photo/2020/03/08/17/59/food-4913279_1280.jpg', 0),
(65, 'Apple Pie', 'classic American apple pie slice', 3.70, 28, 2, 'https://cdn.pixabay.com/photo/2016/10/19/21/05/apple-pie-1754010_640.jpg', 1),
(66, 'Pumpkin Bread', 'moist spiced pumpkin loaf', 2.90, 33, 2, 'https://cdn.pixabay.com/photo/2015/09/01/21/33/pumpkin-917632_640.jpg', 0);

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
  `is_admin` tinyint(1) NOT NULL,
  `twofa_secret` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `address`, `is_admin`, `twofa_secret`) VALUES
(13, 'user1', 'user1@gmail.com', '$2y$10$gTJtTuzi5WqlccVYs7RmKOd76gQgLDlHv1iQjjvm9Z9qSOFMckh82', '', 1, '4TCF2E4ZNEDRB2IIORV47QRX2GQ5LNQWN63AEJ3R55SHDFTGLX3GOT7X6S47IRFZWQK7WX44LFA6EK6CMJ3R3NQVK5PQLNPRDKIJPHY'),
(16, 'user2', 'user2@gmail.com', '$2y$10$KpLGIrdY./rHYUGmyaniFehRpRGVV9Vfz1zCo3O9RRUINeP9Ok4w6', '', 0, 'QDHN66EDDE7ULLFBT3IHBIPM23EWDK53D5JILJ3GSAQLDBOONQJZJCREHXZ3USYFXC5UP6JZOD6U5BPGI43JSB362U2VZGH3GPCXWII'),
(17, 'user3', 'user3@gmail.com', '$2y$10$Le9ApvFF8BP4hlzZg1k6neYWWjz0FyJYkLHyUN8WyT4xSgHqkV9Su', '', 0, 'TWEV2OPJE3C7TKCWVLTLAHQOL73UTHUDU2EOZXR7LI5JFQHKDIVHSCN74HLXJNHTNLZLJJ5YPY43KNVS5KHKKRXX663EL3DCWV4K2HA'),
(23, 'asdf', 'asdf@asdf', '$2y$10$q0H8uyjccazMWiaSFDccPOJhZhup2O4YrHmUWPQcejFyqQtujs9ua', '', 0, 'RLVOCQMC6MQV5CNSVIXH26CKHKSK35RJENKYUCI236HCHHHIBHMFPL53UNDCR2N6RVEBLO3EQXIGPQSZUDFXMGYD6AMNOC3CW47KDBY'),
(24, 'user4', 'r@r', '$2y$10$57HfZKSN2TN0Y6AQbdQv8OAzH5Xuvik74Q4l2CNSyzbyW3eizT5Um', '', 0, 'FODP2XJCV7AENTVSFINPSO66W65HTFKFTFIDHNENVFCCJUXELMLLJLMFMPX4PLWCQ7Y5MASPQDQKRY3F6ZKADPF32BTBHUVFGXQ5AJY'),
(25, 'r', 'r@r', '$2y$10$pX8QH/NHEVihPd3lxFnXleVXtcM6KfQemrG7Hxj0IDptyuE26JPy6', '', 0, 'MXMW5M4LOCXYA6OL6JQGZXM4AE7XMB6P7IVOOS3IEERM4UQFMPHPEBIGW6AC6IEWDKPRNKSSENY4RDF5HG2CV2GLHUYD2SEKHS4P7GA'),
(26, 'w', 'w@w', '$2y$10$LGEduQKNq5TgmFJCGwoGO.GunQyUtCJjIi4.0Culoe3pXyZsTM10.', '', 0, 'P4DK2MZML7NUHKH2Z5IHDRUKHEOL3GFBFA5JFT4QIKLW4K7EUHSFNIUKS2A6XFPECCRD6EKVQOZBAZZFMJRN7QJQEHKRE4P5VIC3HVA'),
(27, 'user5', 'user5@user5', '$2y$10$BjIhJUhEy1eEWHRsPuh3AucKdYvPNW1cJ5KqoJ2YSPQNpsjzu7CFW', '', 0, 'SF3O5PUGTQIMAIQAY2D5DD5OSGJSWRGTTX4D4JALADBH3MAKDJZIN45TT3CIDUNSY5XWUTNCRYRRTSTZXRASHOMJJOBBBBSCWRXCREA'),
(28, 'user10', 'user10@user10', '$2y$10$YznvgJ1QKk6jBLriJczNIOjexp/PEho7OpT7fyPAMhGIXUsmjNSKG', '', 0, '5ELDZDLIRUF3YAJHQ2HPTCJPCVD76DDSWSNJ3XUC2HYS2P34FH63AJJSYPPQUFEGS7MS4L6J3DOTUL6AKF6GVL6UU2ZRWM4JYDT4KDI');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`item_cart_id`),
  ADD KEY `fk_cartitem_product` (`product_id`),
  ADD KEY `fk_cartitem_user` (`user_id`);

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
  ADD PRIMARY KEY (`order_item_id`),
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
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `item_cart_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_item_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

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
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `fk_cartitem_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `fk_cartitem_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
