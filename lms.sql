-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2025 at 05:13 PM
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
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ad_id` int(11) NOT NULL,
  `ad_name` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `reg_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ad_id`, `ad_name`, `email`, `password`, `reg_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', '2024-09-23 00:02:10');

-- --------------------------------------------------------

--
-- Table structure for table `annual_payment`
--

CREATE TABLE `annual_payment` (
  `id` int(11) NOT NULL,
  `pay_num` varchar(50) NOT NULL DEFAULT 'PAY-001' COMMENT 'Auto-incrementing pay_num',
  `ad_name` varchar(50) NOT NULL,
  `mbr_name` varchar(100) NOT NULL,
  `fee` varchar(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `annual_payment`
--

INSERT INTO `annual_payment` (`id`, `pay_num`, `ad_name`, `mbr_name`, `fee`, `date`) VALUES
(8, 'PAY-001', 'Admin', 'User', '1000/=', '2024-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `au_id` int(11) NOT NULL,
  `au_num` varchar(100) NOT NULL DEFAULT 'AUT-001' COMMENT 'Auto-incrementing au_num',
  `au_name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`au_id`, `au_num`, `au_name`, `image`, `status`) VALUES
(1, 'AUT-001', 'J.K. Rowling', 'assets/img/author/j.k.rowling.jpg', 'Active'),
(2, 'AUT-002', 'George Orwell', 'assets/img/author/george_orwell.jpg', 'Active'),
(3, 'AUT-003', 'Yuval Noah Harari', 'assets/img/author/yuval_noah_harari.jpg', 'Active'),
(4, 'AUT-004', 'Carl Sagan', 'assets/img/author/carl_sagan.jpg', 'Active'),
(5, 'AUT-005', 'Bill Bryson', 'assets/img/author/bill_bryson.jpg', 'Active'),
(6, 'AUT-006', 'J.R.R. Tolkien', 'assets/img/author/j.r.r.tolkien.jpg', 'Active'),
(7, 'AUT-007', 'Agatha Christie', 'assets/img/author/agatha_christie.jpg', 'Active'),
(8, 'AUT-008', 'Dan Brown', 'assets/img/author/dan_brown.jpg', 'Active'),
(9, 'AUT-009', 'Tara Westover', 'assets/img/author/tara_westover.jpg', 'Active'),
(10, 'AUT-010', 'Prince Harry', 'assets/img/author/prince_harry.jpg', 'Active'),
(11, 'AUT-011', 'Riley Sager', 'assets/img/author/riley_sager.jpg', 'Active'),
(16, 'AUT-012', 'Rebeca Yaros', 'assets/img/author/rebecca_yarros.jpg', 'Active'),
(19, 'AUT-001', 'Sally Rooney', 'assets/img/author/sally_rooney.jpg', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `bk_num` varchar(50) NOT NULL DEFAULT 'BOK-001' COMMENT 'Auto-incrementing bk_num',
  `title` varchar(100) NOT NULL,
  `au_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `publisher` varchar(50) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `pages` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `bk_num`, `title`, `au_id`, `cat_id`, `publisher`, `isbn`, `description`, `pages`, `image`, `status`) VALUES
(1, 'BOK-001', 'Harry Potter and the Sorcerer\'s Stone', 1, 1, 'Scholastic', '978-0439708180', 'A young wizard, Harry Potter, embarks on his journey to defeat dark forces at Hogwarts.', 350, 'assets/img/books/harry_potter_and_the_sorcerer\'s_stone.jpg', 'Available'),
(2, 'BOK-002', 'Harry Potter and the Chamber of Secrets', 1, 1, 'Scholastic', '978-0439064873', 'Harry returns for his second year at Hogwarts and faces new dangers in the Chamber of Secrets.', 341, 'assets/img/books/harry_potter_and_the_chamber_of_secrets.jpg', 'Active'),
(3, 'BOK-003', '1984', 2, 1, 'Signet Classics', '978-0451524935', 'A dystopian novel about a totalitarian regime led by Big Brother and the consequences of oppressive government.', 328, 'assets/img/books/1984.jpg', 'Active'),
(4, 'BOK-004', 'Animal Farm', 2, 1, 'Signet Classics', '978-0451526342', 'A satirical fable about farm animals rebelling against their human farmer, allegorical of totalitarianism.', 144, 'assets/img/books/animal_farm.jpg', 'Active'),
(5, 'BOK-005', 'Homage to Catalonia', 2, 2, 'Mariner Books', '978-0156421171', 'Orwell\'s personal account of his experiences in the Spanish Civil War, reflecting on the chaos of the conflict.', 232, 'assets/img/books/homage_to_catalonia.jpg', 'Active'),
(6, 'BOK-006', 'The Road to Wigan Pier', 2, 2, 'Mariner Books', '978-0156767507', 'Orwell examines the poverty and living conditions of northern England\'s working class during the Great Depression.', 224, 'assets/img/books/the_road_to_wigan_pier.jpg', 'Active'),
(7, 'BOK-007', 'Very Good Lives', 1, 2, 'Little, Brown and Company', '978-0316369152', 'J.K. Rowling shares her inspiring commencement speech on life lessons and failure at Harvard.', 80, 'assets/img/books/very_good_lives.jpg', 'Active'),
(8, 'BOK-008', 'Cosmos', 4, 3, 'Ballantine Books', '978-0345331359', 'Carl Sagan explores the vastness of space, time, and the human quest for knowledge.', 396, 'assets/img/books/cosmos.jpg', 'Active'),
(9, 'BOK-009', 'The Demon-Haunted World', 4, 3, 'Ballantine Books', '978-0345409461', 'Sagan champions scientific thought and critical thinking in an age dominated by pseudoscience.', 457, 'assets/img/books/the_demon-haunted_world.jpg', 'Active'),
(10, 'BOK-010', 'In a Sunburned Country', 5, 4, 'Broadway Books', '978-0767903868', 'Bryson humorously recounts his travels through Australia, exploring the land\'s vastness and peculiarities.', 352, 'assets/img/books/in_a_sunburned_country.jpg', 'Active'),
(11, 'BOK-011', 'A Walk in the Woods', 5, 4, 'Broadway Books', '978-0767902526', 'Bryson shares his adventures hiking the Appalachian Trail, blending humor with nature insights.', 397, 'assets/img/books/a_walk_in_the_woods.jpg', 'Active'),
(12, 'BOK-012', 'The Ickabog', 1, 4, 'Scholastic', '978-1338732870', 'A fairy tale about truth, power, and a mythical monster, set in the kingdom of Cornucopia.', 304, 'assets/img/books/the_ickabog.jpg', 'Active'),
(13, 'BOK-013', 'Sapiens', 3, 5, 'Harper', '978-0062316110', 'Harari traces the history of humankind, from the Stone Age to modern-day technological revolutions.', 498, 'assets/img/books/sapiens.jpg', 'Active'),
(14, 'BOK-014', 'Homo Deus', 3, 5, 'Harper', '978-0062464316', 'Harari examines the future of humanity and the potential developments in artificial intelligence and biotechnology.', 449, 'assets/img/books/homo_deus.jpg', 'Active'),
(15, 'BOK-015', 'Harry Potter and the Deathly Hallows', 1, 6, 'Scholastic', '978-0545010221', 'The final installment of Harry\'s journey to defeat Voldemort in an epic battle between good and evil.', 759, 'assets/img/books/harry_potter_and_the_deathly_hallows.jpg', 'Active'),
(16, 'BOK-016', 'The Hobbit', 6, 6, 'Houghton Mifflin Harcourt', '978-0547928227', 'Bilbo Baggins embarks on an adventure to reclaim a lost treasure guarded by the dragon Smaug.', 365, 'assets/img/books/the_hobbit.jpg', 'Active'),
(17, 'BOK-017', 'The Lord of the Rings', 6, 6, 'Houghton Mifflin Harcourt', '978-0544003415', 'An epic tale of the battle between good and evil as Frodo sets out to destroy the One Ring.', 1216, 'assets/img/books/the_lord_of_the_rings.jpg', 'Active'),
(18, 'BOK-018', 'Murder on the Orient Express', 7, 7, 'Harper', '978-0062693662', 'Hercule Poirot investigates a murder aboard the luxurious Orient Express.', 288, 'assets/img/books/murder_on_the_orient_express.jpg', 'Active'),
(19, 'BOK-019', 'And Then There Were None', 7, 7, 'Harper', '978-0062073488', 'Ten strangers are invited to an island, where they are systematically killed one by one.', 264, 'assets/img/books/and_then_there_were_none.jpg', 'Active'),
(20, 'BOK-020', 'The Da Vinci Code', 8, 7, 'Anchor', '978-0307474278', 'Symbologist Robert Langdon unravels a conspiracy linked to a secret society and historical events.', 597, 'assets/img/books/the_da_vinci_code.jpg', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_num` varchar(50) NOT NULL DEFAULT 'CAT-001' COMMENT 'Auto-incrementing cat_num',
  `cat_name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_num`, `cat_name`, `image`, `status`) VALUES
(1, 'CAT-001', 'Fiction', 'assets/img/category/fiction.png', 'Active'),
(2, 'CAT-002', 'Non-Fiction', 'assets/img/category/non-fiction.png', 'Active'),
(3, 'CAT-003', 'Science', 'assets/img/category/science.png', 'Active'),
(4, 'CAT-004', 'Travel', 'assets/img/category/travel.png', 'Active'),
(5, 'CAT-005', 'History', 'assets/img/category/history.png', 'Active'),
(6, 'CAT-006', 'Fantasy', 'assets/img/category/fantasy.png', 'Active'),
(7, 'CAT-007', 'Thriller', 'assets/img/category/thriller.png', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `issue_book`
--

CREATE TABLE `issue_book` (
  `is_bk_id` int(11) NOT NULL,
  `iss_num` varchar(50) NOT NULL DEFAULT 'ISS-001' COMMENT 'Auto-incrementing iss_num',
  `mbr_name` varchar(50) NOT NULL,
  `ad_name` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `issue_date` date NOT NULL,
  `due_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issue_book`
--

INSERT INTO `issue_book` (`is_bk_id`, `iss_num`, `mbr_name`, `ad_name`, `title`, `issue_date`, `due_date`) VALUES
(5, 'ISS-001', 'User', 'Admin', 'Very Good Lives', '2024-11-18', '2024-11-24');

-- --------------------------------------------------------

--
-- Table structure for table `latest_book`
--

CREATE TABLE `latest_book` (
  `lt_bk_id` int(11) NOT NULL,
  `lst_num` varchar(50) NOT NULL DEFAULT 'LST-001' COMMENT 'Auto-incrementing lst_num',
  `title` varchar(100) NOT NULL,
  `au_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `publisher` varchar(100) NOT NULL,
  `isbn` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `pages` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `pdf` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `latest_book`
--

INSERT INTO `latest_book` (`lt_bk_id`, `lst_num`, `title`, `au_id`, `cat_id`, `publisher`, `isbn`, `description`, `pages`, `image`, `pdf`, `status`) VALUES
(1, 'LST-001', 'The Running Grave', 1, 1, 'Little, Brown and Company', '978-0316413039', 'A gripping new detective novel in the Cormoran Strike series by J.K. Rowling under the pseudonym Robert Galbraith.', 944, 'assets/img/latestbk/the_running_grave.jpg', 'assets/img/pdf/the_running_grave.pdf', 'Active'),
(2, 'LST-002', 'Educated: A Memoir', 9, 2, 'Random House', '978-0399590504', 'A memoir of Tara Westover\'s journey from growing up in a strict survivalist family to earning a PhD at Cambridge.', 352, 'assets/img/latestbk/educated.jpg', 'assets/img/pdf/educated.pdf', 'Active'),
(3, 'LST-003', 'Spare', 10, 2, 'Random House', '978-0593593806', 'Prince Harry tells his personal story, from his childhood to his life in the public eye, and his royal challenges.', 416, 'assets/img/latestbk/spare.jpg', 'assets/img/pdf/spare.pdf', 'Active'),
(4, 'LST-004', 'The Only One Left', 11, 7, 'Dutton', '978-0593187417', 'A thrilling mystery by Riley Sager, where a woman uncovers a dark secret hidden for decades.', 384, 'assets/img/latestbk/the_only_one_left.jpg', 'assets/img/pdf/the_only_one_left.pdf', 'Active'),
(10, 'LST-005', 'Fourth Wing', 16, 6, 'Testing', '9780008386597', 'degreg', 250, 'assets/img/latestbk/fourth_wing.jpg', 'assets/img/pdf/fourth_wing.pdf', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `mbr_id` int(11) NOT NULL,
  `mbr_number` varchar(50) NOT NULL DEFAULT 'MBR-001' COMMENT 'Auto-incrementing mbr_number',
  `mbr_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `moblie_no` varchar(50) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`mbr_id`, `mbr_number`, `mbr_name`, `email`, `moblie_no`, `gender`, `age`, `image`) VALUES
(1, 'MBR-001', 'User', 'user@gmail.com', '077-1111117', 'Female', 23, 'assets/img/member/user1.png'),
(2, 'MBR-002', 'Ayesha Fernando', 'ayesha.fernando@gmail.com', '071-2345678', 'Female', 25, 'assets/img/member/user2.png'),
(3, 'MBR-003', 'Rishan Perera', 'rishan.perera@hotmail.com', '071-1234567', 'Male', 28, 'assets/img/member/man1.png'),
(4, 'MBR-004', 'Kasun Abeysinghe', 'kasun.abeysinghe@gmail.com', '071-1234567', 'Male', 30, 'assets/img/member/man2.png'),
(8, 'MBR-005', 'New member', 'rfazal2001@gmail.com', '12345667878', 'Female', 24, 'assets/img/member/user3.png');

-- --------------------------------------------------------

--
-- Table structure for table `member_login`
--

CREATE TABLE `member_login` (
  `member_id` int(11) NOT NULL,
  `mbr_number` varchar(50) NOT NULL DEFAULT 'MBR-001' COMMENT 'Auto-incrementing mbr_number',
  `mbr_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `reg_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member_login`
--

INSERT INTO `member_login` (`member_id`, `mbr_number`, `mbr_name`, `email`, `password`, `reg_date`) VALUES
(11, 'MBR-001', 'User', 'user@gmail.com', '202cb962ac59075b964b07152d234b70', '2024-10-22'),
(13, 'MBR-002', 'Ayesha Fernando', 'ayesha.fernando@gmail.com', '202cb962ac59075b964b07152d234b70', '2024-12-03');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `msg_id` int(11) NOT NULL,
  `ad_name` varchar(50) NOT NULL,
  `mbr_name` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` varchar(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`msg_id`, `ad_name`, `mbr_name`, `subject`, `message`, `date`) VALUES
(4, 'Admin', 'User', 'Reminder', 'return book', '2024-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `reserve_book`
--

CREATE TABLE `reserve_book` (
  `rbk_id` int(11) NOT NULL,
  `mbr_num` varchar(50) NOT NULL,
  `mbr_name` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reserve_book`
--

INSERT INTO `reserve_book` (`rbk_id`, `mbr_num`, `mbr_name`, `title`, `image`, `date`) VALUES
(1, 'MBR-001', 'User', 'Very Good Lives', 'assets/img/books/very_good_lives.jpg', '2024-11-15'),
(7, 'MBR-001', 'User', 'Harry Potter and the Sorcerer\'s Stone', 'assets/img/books/harry_potter_and_the_sorcerer\'s_stone.jpg', '2024-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `return_book`
--

CREATE TABLE `return_book` (
  `re_bk_id` int(11) NOT NULL,
  `ret_num` varchar(50) NOT NULL DEFAULT 'RET-001' COMMENT 'Auto-incrementing ret_num',
  `mbr_name` varchar(50) NOT NULL,
  `ad_name` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `due_date` date NOT NULL,
  `return_date` date NOT NULL,
  `diff_days` int(11) NOT NULL,
  `fine` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `return_book`
--

INSERT INTO `return_book` (`re_bk_id`, `ret_num`, `mbr_name`, `ad_name`, `title`, `due_date`, `return_date`, `diff_days`, `fine`) VALUES
(60, 'RET-001', 'User', 'Admin', 'Very Good Lives', '2024-11-24', '2024-12-05', 11, '50/=');

-- --------------------------------------------------------

--
-- Table structure for table `st_message`
--

CREATE TABLE `st_message` (
  `st_msg_id` int(11) NOT NULL,
  `mbr_name` varchar(50) NOT NULL,
  `ad_name` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` varchar(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `st_message`
--

INSERT INTO `st_message` (`st_msg_id`, `mbr_name`, `ad_name`, `subject`, `message`, `date`) VALUES
(11, 'User', 'Admin', 'testing', 'test', '2024-12-06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `annual_payment`
--
ALTER TABLE `annual_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`au_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `au_id` (`au_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `issue_book`
--
ALTER TABLE `issue_book`
  ADD PRIMARY KEY (`is_bk_id`);

--
-- Indexes for table `latest_book`
--
ALTER TABLE `latest_book`
  ADD PRIMARY KEY (`lt_bk_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`mbr_id`) USING BTREE;

--
-- Indexes for table `member_login`
--
ALTER TABLE `member_login`
  ADD PRIMARY KEY (`member_id`) USING BTREE;

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `reserve_book`
--
ALTER TABLE `reserve_book`
  ADD PRIMARY KEY (`rbk_id`);

--
-- Indexes for table `return_book`
--
ALTER TABLE `return_book`
  ADD PRIMARY KEY (`re_bk_id`);

--
-- Indexes for table `st_message`
--
ALTER TABLE `st_message`
  ADD PRIMARY KEY (`st_msg_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `annual_payment`
--
ALTER TABLE `annual_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `au_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `issue_book`
--
ALTER TABLE `issue_book`
  MODIFY `is_bk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `latest_book`
--
ALTER TABLE `latest_book`
  MODIFY `lt_bk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `mbr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `member_login`
--
ALTER TABLE `member_login`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reserve_book`
--
ALTER TABLE `reserve_book`
  MODIFY `rbk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `return_book`
--
ALTER TABLE `return_book`
  MODIFY `re_bk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `st_message`
--
ALTER TABLE `st_message`
  MODIFY `st_msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `FK_books_author` FOREIGN KEY (`au_id`) REFERENCES `author` (`au_id`),
  ADD CONSTRAINT `FK_books_category` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
