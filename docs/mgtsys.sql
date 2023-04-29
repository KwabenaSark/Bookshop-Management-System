-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 20, 2023 at 11:49 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mgtsys`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `Book_ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `title` varchar(30) NOT NULL,
  `Author` varchar(50) NOT NULL,
  `Publisher` varchar(50) NOT NULL,
  `ISBN` varchar(30) NOT NULL,
  `Genre` varchar(50) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `quantity_in_stock` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`Book_ID`),
  KEY `quantity_in_stock` (`quantity_in_stock`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`Book_ID`, `Name`, `title`, `Author`, `Publisher`, `ISBN`, `Genre`, `Description`, `quantity_in_stock`, `price`) VALUES
(1, 'Harry Potter and the Cursed Child ', '', ' J. K. Rowling', 'Warner Media', '', 'Fantasy', '', 0, 0),
(2, 'The Silent Patient', '', 'Alex Michaelides', 'Celadon Books', '', 'Mystery', 'Alicia Berenson’s life is seemingly perfect. Then she shoots her husband.', 0, 0),
(3, 'The Great Gatsby', '', 'F. Scott Fitzgerald', 'Scribner', '', 'Fiction', 'A tale of love and tragedy during the Roaring Twenties', 0, 0),
(4, '1984', '', 'George Orwell', 'Secker & Warburg', '', 'Science Fiction', 'A dystopian novel about government surveillance', 0, 0),
(5, 'Pride and Prejudice', '11', 'Jane Austen', 'T. Egerton, Whitehall', '11', 'Romance', 'A witty and romantic novel about the Bennet sisters', 0, 10),
(6, 'The Hobbit', '', 'J.R.R. Tolkien', 'George Allen & Unwin', '', 'Fantasy', 'A charming adventure in Middle-earth', 0, 0),
(7, 'The Da Vinci Code', '', 'Dan Brown', 'Doubleday', '', 'Thriller', 'A fast-paced thriller full of hidden codes and secrets', 0, 0),
(8, 'Harry Potter and the Sorcerer\'s Stone', '', 'J.K. Rowling', 'Bloomsbury Publishing', '', 'Fantasy', 'The first book in the popular Harry Potter series', 0, 0),
(9, 'The Hunger Games', '', 'Suzanne Collins', 'Scholastic', '', 'Science Fiction', 'A thrilling tale of survival in a dystopian world', 0, 0),
(10, 'The Girl with the Dragon Tattoo', '', 'Stieg Larsson', 'Norstedts Förlag', '', 'Mystery', 'A gripping murder mystery set in Sweden', 0, 0),
(11, 'The Lord of the Rings', 'The fallen', 'J.R.R. Tolkien', 'George Allen & Unwin', '1234', 'Fantasy', 'An epic tale of the quest to destroy the One Ring', 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE IF NOT EXISTS `inventory` (
  `quantity_in_stock` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`quantity_in_stock`),
  KEY `books` (`book_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`quantity_in_stock`, `book_id`, `name`, `status`) VALUES
(1, 1, 'Harry Potter and the Cursed Child', 'Available'),
(2, 2, 'The Silent Patient', 'Available'),
(3, 3, 'The Great Gatsby', 'Available'),
(4, 4, '1984', 'Available'),
(5, 5, 'Pride and Prejudice', 'Available'),
(6, 6, 'The Hobbit', 'Available'),
(7, 7, 'The Da Vinci Code', 'Available'),
(8, 8, 'Harry Potter and the Sorcerer\'s Stone', 'Available'),
(9, 9, 'The Hunger Games', 'Available'),
(10, 10, 'The Girl with the Dragon Tattoo', 'Available'),
(11, 11, 'The Lord of the Rings', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_Id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity_ordered` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `Date_Sold` date NOT NULL,
  `Payment_Type` varchar(20) NOT NULL,
  PRIMARY KEY (`order_Id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_Id`, `book_id`, `quantity_ordered`, `Price`, `Date_Sold`, `Payment_Type`) VALUES
(1, 0, 0, 10, '2022-03-15', 'Credit Card'),
(2, 0, 0, 13, '2022-03-16', 'Cash'),
(3, 0, 0, 15, '2022-03-17', 'Debit Card'),
(4, 0, 0, 12, '2022-03-18', 'Credit Card'),
(5, 0, 0, 11, '2022-03-19', 'Cash'),
(6, 6, 4, 14, '2023-07-08', 'Credit Card'),
(7, 7, 2, 22, '2023-04-15', 'Paypal'),
(8, 8, 4, 20, '2023-04-06', 'Cash'),
(9, 9, 2, 12, '2023-04-06', 'Cash'),
(10, 10, 2, 10, '2023-04-06', 'Cash'),
(20, 11, 5, 10, '2023-04-09', 'Mobile Money');

-- --------------------------------------------------------

--
-- Stand-in structure for view `report`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `report`;
CREATE TABLE IF NOT EXISTS `report` (
`Book_ID` int(11)
,`Name` varchar(50)
,`Author` varchar(50)
,`quantity_in_stock` int(11)
,`price` int(11)
,`quantity_ordered` int(11)
,`Date_Sold` date
,`Payment_Type` varchar(20)
,`status` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `transaction_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `total_price` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `date`, `total_price`, `order_id`) VALUES
(1, '2022-03-15', 0, 1),
(2, '2022-03-16', 0, 2),
(3, '2022-03-17', 0, 3),
(4, '2022-03-18', 0, 4),
(5, '2022-03-19', 0, 5),
(6, '2023-07-08', 56, 6),
(7, '2023-04-15', 44, 7),
(8, '2023-04-06', 80, 8),
(9, '2023-04-06', 24, 9),
(10, '2023-04-06', 20, 10),
(11, '2023-04-09', 50, 20);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role_name` varchar(255) DEFAULT NULL,
  `photo` longblob,
  `password` varchar(255) DEFAULT NULL,
  `login_session_key` varchar(255) DEFAULT NULL,
  `email_status` varchar(255) DEFAULT NULL,
  `password_expire_date` datetime DEFAULT '2023-07-05 00:00:00',
  `password_reset_key` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `email`, `role_name`, `photo`, `password`, `login_session_key`, `email_status`, `password_expire_date`, `password_reset_key`) VALUES
(2, 'admin', 'admin@gmail.com', 'Admin', 0x687474703a2f2f6c6f63616c686f73742f737472616e6473626f6f6b73686f706d616e6167656d656e7473797374656d2f75706c6f6164732f66696c65732f7778656179316b6f35747176676e722e706e67, '$2y$10$5e/ZIF.ltiR3p4tfdz1P..eWP3MqEFCXcf3xFM4d3gHa9NH718HCS', '9d536fd76e86df92d2f8af685c8ee50e', NULL, '2023-07-05 00:00:00', NULL),
(3, 'Clerk', 'clerk@gmail.com', 'Clerk', NULL, '$2y$10$0oYwETXpNK8YP7KPMbKhFujsB38MpUEJYn6RpSdZIrNBItXsILaFe', NULL, NULL, '2023-07-05 00:00:00', NULL),
(4, 'Manager', 'manager@gmail.com', 'Manager', NULL, '$2y$10$tqYc8cwkJO4NcEMZ5jRVNO7/KDyQxWYfMiwOasAjf17DR9WZ38Hiu', NULL, NULL, '2023-07-05 00:00:00', NULL),
(7, 'kwab', '1@gmail.com', 'Admin', 0x687474703a2f2f6c6f63616c686f73742f737472616e6473626f6f6b73686f706d616e6167656d656e7473797374656d2f75706c6f6164732f66696c65732f7237343574337636616964786362732e6a7067, '$2y$10$wh7q8HkvRcU05VrK47rmVeAUdqmDlvxSJdLG.4cgwihSCMbz8FZhW', NULL, NULL, '2023-07-05 00:00:00', NULL),
(8, 'Owusu', 'O@gmail.com', 'Admin', 0x687474703a2f2f6c6f63616c686f73742f737472616e6473626f6f6b73686f706d616e6167656d656e7473797374656d2f75706c6f6164732f66696c65732f3971795f643078317277336870366f2e706e67, '$2y$10$TuB12aKH2kHRLhsHKi7wMuyF6dmQwrkuXu0z3QvC6jQD64lH5Ddmi', NULL, NULL, '2023-07-05 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Structure for view `report`
--
DROP TABLE IF EXISTS `report`;

DROP VIEW IF EXISTS `report`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `report`  AS SELECT `b`.`Book_ID` AS `Book_ID`, `b`.`Name` AS `Name`, `b`.`Author` AS `Author`, `b`.`quantity_in_stock` AS `quantity_in_stock`, `b`.`price` AS `price`, `o`.`quantity_ordered` AS `quantity_ordered`, `o`.`Date_Sold` AS `Date_Sold`, `o`.`Payment_Type` AS `Payment_Type`, `i`.`status` AS `status` FROM ((`books` `b` join `orders` `o` on((`b`.`Book_ID` = `o`.`book_id`))) join `inventory` `i` on((`o`.`book_id` = `i`.`book_id`))) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
