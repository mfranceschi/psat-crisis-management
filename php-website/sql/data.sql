--

-- Database : 'users'
--

CREATE DATABASE IF NOT EXISTS 'users'

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL PRIMARY KEY,
  `username` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `users` (`id`, `username`, `password`) VALUES
(2, 'bob', 'bobpassword'),
(3, 'alice', 'alicesecretpassword');
(1, 'admin', 'password'),