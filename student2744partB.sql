-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: webpagesdb.it.auth.gr:3306
-- Χρόνος δημιουργίας: 26 Δεκ 2020 στις 19:53:39
-- Έκδοση διακομιστή: 5.5.62-0ubuntu0.14.04.1
-- Έκδοση PHP: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `student2744partB`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `subject` varchar(500) CHARACTER SET greek COLLATE greek_bin NOT NULL,
  `text` varchar(500) CHARACTER SET greek COLLATE greek_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `announcements`
--

INSERT INTO `announcements` (`id`, `date`, `subject`, `text`) VALUES
(1, '2020-10-01', 'Έναρξη μαθημάτων', 'Τα μαθήματα αρχίζουν την επόμενη εβδομάδα'),
(2, '2020-10-15', 'Ανάρτηση 1ης εργασίας', 'Η πρώτη εργασία έχει αναρτηθεί στην ενότητα των Εργασιών'),
(3, '2020-12-20', 'Υπενθύμιση', 'Υπενθυμίζεται η πρώτη εργασία'),
(4, '2020-12-10', 'Υποβλήθηκε η εργασία 1', 'Η ημερομηνία παράδοσης είναι 2020-12-10'),
(5, '2021-01-10', 'Υποβλήθηκε η εργασία 2', 'Η ημερομηνία παράδοσης είναι 2021-01-10');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `title` varchar(500) CHARACTER SET greek NOT NULL,
  `description` varchar(500) CHARACTER SET greek NOT NULL,
  `filename` varchar(500) CHARACTER SET greek NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `documents`
--

INSERT INTO `documents` (`id`, `title`, `description`, `filename`) VALUES
(1, 'Εκφώνηση 1ης Εργασίας', 'Η πρώτη εργασία αφορά την υλοποίηση ενός στατικού ιστότοπου σε HTML, CSS', 'file1.doc'),
(2, 'Συμπληρωματικές οδηγίες', 'Στο ακόλουθο αρχείο υπάρχουν συμπληρωματικές οδηγίες για την εργασία', 'file2.doc');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `homework`
--

CREATE TABLE `homework` (
  `id` int(11) NOT NULL,
  `goals` varchar(500) CHARACTER SET greek NOT NULL,
  `filename` varchar(500) CHARACTER SET greek NOT NULL,
  `submissions` varchar(500) CHARACTER SET greek NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `homework`
--

INSERT INTO `homework` (`id`, `goals`, `filename`, `submissions`, `date`) VALUES
(1, 'Να μάθετε HTML, CSD, PHP', 'ergasia1.doc', 'Αναφορά σε word, powerpoint', '2020-12-10'),
(2, 'Να μάθετε για τα Εκπαιδευτικά Περιβάλλοντα Διαδικτύου', 'ergasia2.doc', 'Γραπτή αναφορά', '2021-01-10');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(500) CHARACTER SET latin1 NOT NULL,
  `lastname` varchar(500) CHARACTER SET latin1 NOT NULL,
  `loginname` varchar(500) CHARACTER SET latin1 NOT NULL,
  `password` varchar(500) CHARACTER SET latin1 NOT NULL,
  `role` varchar(500) CHARACTER SET latin1 NOT NULL DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `loginname`, `password`, `role`) VALUES
(1, 'test1', 'Test1', 'test1@csd.gr', '$2y$10$ILCUkmLncZmWl2ICWyAsI.IWX7mDfjY2y3lh8Z04cbqoAziqZ6ZWa', 'student'),
(2, 'test2', 'Test2', 'test2@csd.gr', '$2y$10$VM0RVzLdwFgIxjWg/XIrjuWpz8VsRqjLjxC.jIWzl4fYXIRXtFiAW', 'tutor'),
(3, 'test3', 'Test3', 'test3@csd.gr', '$2y$10$LfWGbGm6xUbRhWuHRn.iDetIVR0Mtxf.HfGQXcZ5CH9R0Vqv8WFjW', 'student'),
(4, 'test4', 'Test4', 'test4@csd.gr', '$2y$10$u4nljVzwaiCljhi50A8xCey2YcMGW9SHXCd/ylXsZf2xeJVz3se9W', 'tutor');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loginname` (`loginname`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT για πίνακα `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT για πίνακα `homework`
--
ALTER TABLE `homework`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
