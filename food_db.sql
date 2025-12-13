-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2025 at 11:02 PM
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
-- Database: `food_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(42, 2, 44, 'Spicy Potato Cubes', 4, 1, 'appetizer5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_groups`
--

CREATE TABLE `ingredient_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `tag` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `ingredient_groups`
--

INSERT INTO `ingredient_groups` (`id`, `group_name`, `category`, `tag`) VALUES
(1, 'Cheesy Appetizers', 'appetizers', 'cheesy'),
(2, 'Light Appetizers', 'appetizers', 'light'),
(3, 'Spicy Appetizers', 'appetizers', 'spicy'),
(4, 'Comfort Main Dish', 'main dish', 'comfort'),
(5, 'Grilled Main Dish', 'main dish', 'grilled'),
(6, 'Healthy Main Dish', 'main dish', 'healthy'),
(7, 'Meaty Main Dish', 'main dish', 'meaty'),
(8, 'Classic Desserts', 'desserts', 'classic'),
(9, 'Creamy Desserts', 'desserts', 'creamy'),
(10, 'Chocolate Desserts', 'desserts', 'chocolate'),
(11, 'Sweet Desserts', 'desserts', 'sweet'),
(12, 'Cold Drinks', 'drinks', 'cold'),
(13, 'Fruity Drinks', 'drinks', 'fruity'),
(14, 'Milky Drinks', 'drinks', 'milky'),
(15, 'Refreshing Drinks', 'drinks', 'refreshing');

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_group_items`
--

CREATE TABLE `ingredient_group_items` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `ingredient` varchar(100) NOT NULL,
  `weight` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `ingredient_group_items`
--

INSERT INTO `ingredient_group_items` (`id`, `group_id`, `ingredient`, `weight`) VALUES
(1, 2, 'chickpeas', 4),
(3, 1, 'phyllo dough', 1),
(4, 2, 'grape leaves', 1),
(5, 3, 'potatoes', 3),
(6, 5, 'chicken breast', 0),
(7, 7, 'chicken breast', 0),
(8, 7, 'beef strips', 0),
(9, 4, 'minced meat', 0),
(10, 7, 'minced meat', 0),
(11, 7, 'chicken', 0),
(12, 5, 'sea bass', 2),
(13, 8, 'phyllo dough', 1),
(14, 8, 'rice', 1),
(15, 8, 'semolina dough', 1),
(16, 8, 'semolina', 1),
(18, 8, 'milk', 0),
(19, 9, 'milk', 2),
(20, 15, 'lemon', 1),
(21, 14, 'yogurt', 1),
(22, 12, 'hibiscus petals', 0),
(23, 12, 'fresh oranges', 1),
(24, 13, 'fresh oranges', 1),
(25, 1, 'mozzarella cheese', 1),
(26, 3, 'baguette', 2),
(27, 4, 'beef patty', 0),
(28, 7, 'beef patty', 0),
(29, 4, 'pizza dough', 1),
(30, 4, 'fettuccine ', 2),
(31, 10, 'chocolate', 0),
(32, 9, 'lotus biscuits', 1),
(33, 10, 'crepe', 1),
(34, 15, 'pure spring water', 1),
(35, 12, 'espresso', 0),
(36, 14, 'espresso', 2),
(37, 15, 'carbonated water', 2),
(38, 7, 'beef ribs', 0),
(39, 4, 'grilled chicken', 0),
(40, 5, 'grilled chicken', 0),
(41, 7, 'grilled chicken', 0),
(200, 6, 'grilled chicken', 1),
(201, 6, 'olive oil', 1),
(202, 6, 'yogurt', 0),
(203, 6, 'parsley', 0),
(204, 6, 'eggplant', 1),
(205, 6, 'chickpeas', 0),
(206, 6, 'onion', 1),
(207, 6, 'tomato', 1),
(301, 11, 'sugar', 0),
(302, 11, 'syrup', 1),
(303, 11, 'rose water', 0),
(304, 11, 'molasses', 1),
(305, 11, 'dates', 0),
(306, 11, 'coconut', 1),
(307, 11, 'semolina', 0),
(308, 11, 'milk', 0),
(309, 11, 'phyllo dough', 0),
(310, 15, 'cardamom', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(3, 2, 'haidar', 'haidarfawaz@gmail.com', '78853424', 'hello world!'),
(4, 2, 'haidar', 'abc@gmai.com', '78853424', 'hi');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(9, 2, 'Haidar', '78853424', 'haidarfawaz@gmail.com', 'Whish', '2, beirut, beirut, beirut', 'burger (10 x 2) - ', 20, '2025-05-11', 'completed'),
(10, 2, 'Haidar', '78853424', 'haidarfawaz@gmail.com', 'cash on delivery', '2, beirut, beirut, beirut', 'Hummus Plate (5 x 1) - ', 5, '2025-05-11', 'pending'),
(11, 2, 'Haidar', '78853424', 'haidarfawaz@gmail.com', 'cash on delivery', '2, beirut, beirut, beirut', 'Grilled Fish with Lemon (13 x 1) - BBQ Ribs Platter (14 x 1) - Rice Pudding (4 x 1) - Orange Juice (3 x 1) - ', 34, '2025-05-12', 'completed'),
(12, 2, 'Haidar', '78853424', 'haidarfawaz@gmail.com', 'credit card', '2, beirut, beirut, beirut', 'Chicken Wings (7 x 2) - ', 14, '2025-05-12', 'pending'),
(13, 2, 'Haidar', '78853424', 'haidarfawaz@gmail.com', 'cash on delivery', '2, beirut, beirut, beirut', 'Grilled Chicken Caesar Wrap (10 x 1) - ', 10, '2025-05-12', 'completed'),
(14, 2, 'Haidar', '78853424', 'haidarfawaz@gmail.com', 'cash on delivery', '2, beirut, beirut, beirut', 'Kofta with Rice (11 x 1) - ', 11, '2025-05-12', 'completed'),
(15, 2, 'Haidar', '78853424', 'haidarfawaz@gmail.com', 'paypal', '2, beirut, beirut, beirut', 'Beef Shawarma Plate (12 x 1) - ', 12, '2025-05-13', 'completed'),
(16, 2, 'Haidar', '78853424', 'haidarfawaz@gmail.com', 'credit card', '2, beirut, beirut, beirut', 'Kofta with Rice (11 x 1) - ', 11, '2025-05-13', 'pending'),
(17, 2, 'Haidar', '78853424', 'haidarfawaz@gmail.com', 'cash on delivery', '2, beirut, beirut, beirut', 'Jallab (3 x 1) - ', 3, '2025-05-13', 'pending'),
(18, 2, 'Haidar', '78853424', 'haidarfawaz@gmail.com', 'cash on delivery', '2, beirut, beirut, beirut', 'Mhalabieh (3 x 1) - ', 3, '2025-05-13', 'pending'),
(19, 2, 'Haidar', '78853424', 'haidarfawaz@gmail.com', 'cash on delivery', '2, beirut, beirut, beirut', 'Orange Juice (3 x 1) - Grilled Chicken Platter (12 x 1) - Hummus Plate (5 x 1) - Chicken Fatteh (10 x 1) - ', 30, '2025-05-16', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(100) NOT NULL,
  `ingredients` text NOT NULL,
  `tags` text NOT NULL,
  `meal_time` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `image`, `ingredients`, `tags`, `meal_time`) VALUES
(1, 'Hummus Plate', 'appetizers', 4.50, 'appetizer1.jpg\r\n', 'Chickpeas, tahini, lemon juice, garlic, olive oil', 'light', 'afternoon'),
(41, 'Falafel Balls', 'Appetizers', 5.00, 'appetizer2.jpg', 'Chickpeas, parsley, onion, garlic, spices', 'light', 'afternoon'),
(42, 'Cheese Rolls', 'appetizers', 4.75, 'appetizer3.jpg', 'Phyllo dough, white cheese, parsley', 'cheesy', 'afternoon'),
(43, 'Stuffed Grape Leaves', 'appetizers', 5.50, 'appetizer4.jpg', 'Grape leaves, rice, tomato, onion, mint', 'light', 'afternoon'),
(44, 'Spicy Potato Cubes', 'appetizers', 4.25, 'appetizer5.jpg', 'Potatoes, garlic, coriander, chili', 'spicy', 'afternoon'),
(45, 'Mini Kibbeh', 'appetizers', 5.25, 'appetizer6.jpg', 'Bulgur, minced beef, onion, pine nuts', 'meaty', 'afternoon'),
(46, 'Grilled Chicken Platter', 'main dish', 12.00, 'main1.jpg', 'Chicken breast, spices, grilled vegetables, rice', 'comfort,grilled,meaty', 'evening'),
(47, 'Beef Shawarma Plate', 'main dish', 11.50, 'main2.jpg', 'Beef strips, tahini, pickles, fries, bread', 'comfort,meaty', 'evening'),
(48, 'Kofta with Rice', 'main dish', 10.75, 'main3.jpg', 'Minced meat, parsley, onion, rice, spices', 'comfort,meaty', 'evening'),
(49, 'Chicken Fatteh', 'main dish', 9.99, 'main4.jpg', 'Chicken, chickpeas, yogurt, garlic, pita', 'comfort,meaty', 'evening'),
(50, 'Vegetable Moussaka', 'main dish', 8.50, 'main5.jpg', 'Eggplant, tomato, chickpeas, onion, garlic', 'comfort,healthy', 'evening'),
(51, 'Grilled Fish with Lemon', 'main dish', 13.00, 'main6.jpg', 'Sea bass, lemon, olive oil, herbs', 'grilled,healthy', 'evening'),
(52, 'Baklava', 'desserts', 4.00, 'dessert1.jpg', 'Phyllo dough, nuts, syrup', 'classic,sweet', 'late-night'),
(53, 'Rice Pudding', 'desserts', 3.50, 'dessert2.jpg', 'Rice, milk, sugar, rose water', 'classic,sweet', 'morning'),
(54, 'Knefeh', 'desserts', 5.00, 'dessert3.jpg', 'Semolina dough, cheese, sugar syrup', 'cheesy,sweet', 'late-night'),
(55, 'Maamoul Cookies', 'desserts', 4.25, 'dessert4.jpg', 'Semolina, dates, walnuts', 'classic,sweet', 'late-night'),
(56, 'Basbousa', 'desserts', 3.75, 'dessert5.jpg', 'Semolina, yogurt, coconut, syrup', 'sweet', 'late-night'),
(57, 'Mhalabieh', 'desserts', 3.25, 'dessert6.jpg', 'Milk, cornstarch, sugar, rose water', 'creamy,sweet', 'late-night'),
(58, 'Mint Lemonade', 'drinks', 2.50, 'drink1.jpg', 'Lemon, mint, sugar, water', 'refreshing', 'anytime'),
(59, 'Jallab', 'drinks', 3.00, 'drink2.jpg', 'Dates, grape molasses, rose water', 'refreshing,sweet', 'anytime'),
(60, 'Ayran', 'drinks', 2.25, 'drink3.jpg', 'Yogurt, water, salt', 'milky', 'anytime'),
(61, 'Iced Hibiscus Tea', 'drinks', 2.75, 'drink4.jpg', 'Hibiscus petals, sugar, ice', 'cold,refreshing', 'anytime'),
(62, 'Orange Juice', 'drinks', 3.00, 'drink5.jpg', 'Fresh oranges', 'fruity', 'anytime'),
(63, 'Arabic Coffee', 'drinks', 1.99, 'drink6.jpg', 'Ground coffee, cardamom, water', 'refreshing', 'morning'),
(64, 'Mozzarella Sticks', 'appetizers', 5.50, 'appetizer7.jpg', 'Mozzarella cheese, breadcrumbs, herbs', 'cheesy,fried', 'afternoon'),
(65, 'Chicken Wings', 'appetizers', 6.50, 'appetizer8.jpg', 'Chicken wings, BBQ sauce or buffalo, spices', 'comfort,meaty', 'afternoon'),
(66, 'Garlic Bread', 'appetizers', 4.00, 'appetizer9.jpg', 'Baguette, garlic butter, parsley', 'comfort', 'afternoon'),
(67, 'Classic Beef Burger', 'main dish', 9.99, 'main7.jpg', 'Beef patty, lettuce, tomato, pickles, burger bun, sauce', 'comfort,meaty', 'evening'),
(68, 'Pepperoni Pizza', 'main dish', 12.50, 'main8.jpg', 'Pizza dough, tomato sauce, mozzarella, pepperoni', 'cheesy,comfort,meaty', 'evening'),
(69, 'Creamy Alfredo Pasta', 'main dish', 10.50, 'main9.jpg', 'Fettuccine pasta, cream, parmesan, chicken, garlic', 'cheesy,comfort,creamy,meaty', 'evening'),
(70, 'Molten Chocolate Cake', 'desserts', 5.75, 'dessert7.jpg', 'Chocolate, eggs, butter, sugar, flour', 'chocolate,sweet', 'late-night'),
(71, 'Lotus Cheesecake', 'desserts', 6.00, 'dessert8.jpg', 'Lotus biscuits, cream cheese, butter, caramel', 'cheesy,creamy,sweet', 'late-night'),
(72, 'Nutella Crepe', 'desserts', 5.25, 'dessert9.jpg', 'Crepe, Nutella, banana or strawberries', 'chocolate,fruity,sweet', 'late-night'),
(73, 'Bottled Water', 'drinks', 1.00, 'drink7.jpg', 'Pure spring water', 'refreshing', 'anytime'),
(74, 'Iced Latte', 'drinks', 3.75, 'drink8.jpg', 'Espresso, milk, ice', 'cold,milky', 'morning'),
(75, 'Sparkling Water', 'drinks', 2.00, 'drink9.jpg', 'Carbonated water, optional lemon', 'cold,refreshing', 'anytime'),
(76, 'BBQ Ribs Platter', 'main dish', 14.00, 'main10.jpg', 'Beef ribs, BBQ sauce, coleslaw, fries', 'comfort,meaty', 'evening'),
(77, 'Grilled Chicken Caesar Wrap', 'main dish', 9.50, 'main11.jpg', 'Grilled chicken, romaine, Caesar dressing, tortilla wrap', 'grilled,healthy,meaty', 'evening'),
(78, 'Margherita Pizza', 'main dish', 11.00, 'main12.jpg', 'Pizza dough, tomato sauce, mozzarella, fresh basil', 'cheesy,comfort,healthy', 'evening');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `weight` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `category`, `weight`) VALUES
(1, 'cheesy', 'appetizers', 2),
(2, 'light', 'appetizers', 8),
(3, 'spicy', 'appetizers', 6),
(4, 'meaty', 'main dish', 3),
(5, 'comfort', 'main dish', 5),
(6, 'grilled', 'main dish', 3),
(7, 'healthy', 'main dish', 7),
(8, 'classic', 'desserts', 9),
(9, 'creamy', 'desserts', 9),
(10, 'chocolate', 'desserts', 4),
(11, 'sweet', 'desserts', 8),
(12, 'cold', 'drinks', 3),
(13, 'milky', 'drinks', 5),
(14, 'refreshing', 'drinks', 9),
(15, 'fruity', 'drinks', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `address`) VALUES
(2, 'Haidar', 'haidarfawaz@gmail.com', '78853424', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2, beirut, beirut, beirut');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingredient_groups`
--
ALTER TABLE `ingredient_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingredient_group_items`
--
ALTER TABLE `ingredient_group_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `ingredient_groups`
--
ALTER TABLE `ingredient_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ingredient_group_items`
--
ALTER TABLE `ingredient_group_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=313;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ingredient_group_items`
--
ALTER TABLE `ingredient_group_items`
  ADD CONSTRAINT `ingredient_group_items_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `ingredient_groups` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
