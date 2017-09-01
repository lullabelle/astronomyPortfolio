CREATE DATABASE astro_gallery;
USE astro_gallery;
--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL auto_increment,
  `photograph_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `author` varchar(255) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `photograph_id` (`photograph_id`)
) AUTO_INCREMENT=7;


--
-- Table structure for table `photographs`
--

DROP TABLE IF EXISTS `photographs`;
CREATE TABLE `photographs` (
  `id` int(11) NOT NULL auto_increment,
  `filename` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `size` int(11) NOT NULL,
  `caption` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) AUTO_INCREMENT=9;


--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  PRIMARY KEY  (`id`)
) AUTO_INCREMENT=4;

--
-- Dumping data for table `users`
--
INSERT INTO `users` VALUES (1,'Joanne','Amadeus','Joanne','Connor');
GRANT ALL PRIVILEGES ON astro_gallery.* TO 'Joanne'@'localhost' IDENTIFIED BY 'Amadeus' ;
