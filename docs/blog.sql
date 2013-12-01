/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `blog_categories`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `blog_categories` (
  `blog_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_category_name` varchar(50) NOT NULL,
  PRIMARY KEY (`blog_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;


LOCK TABLES `blog_categories` WRITE;
/*!40000 ALTER TABLE `blog_categories` DISABLE KEYS */;
INSERT INTO `blog_categories` VALUES (1,'Clothes'),(2,'Shoes'),(3,'Make up'),(4,'Hairs');
/*!40000 ALTER TABLE `blog_categories` ENABLE KEYS */;
UNLOCK TABLES;


DROP TABLE IF EXISTS `blog_content`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `blog_content` (
  `blog_content_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_category_id` int(11) NOT NULL,
  `blog_user_id` int(11) NOT NULL,
  `blog_content_headline` varchar(50) NOT NULL,
  `blog_content_text` text NOT NULL,
  `blog_content_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `blog_publish` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`blog_content_id`),
  KEY `blog_user_id` (`blog_user_id`),
  KEY `blog_category_id` (`blog_category_id`),
  CONSTRAINT `blog_content_ibfk_1` FOREIGN KEY (`blog_user_id`) REFERENCES `blog_users` (`blog_user_id`) ON DELETE CASCADE,
  CONSTRAINT `blog_content_ibfk_2` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_categories` (`blog_category_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

LOCK TABLES `blog_content` WRITE;
/*!40000 ALTER TABLE `blog_content` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_content` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `blog_users`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `blog_users` (
  `blog_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_user_name` varchar(20) NOT NULL,
  `blog_user_password` char(40) NOT NULL,
  `blog_user_email` varchar(254) NOT NULL,
  `blog_user_access_level` int(1) NOT NULL DEFAULT '0',
  `blog_user_status` varchar(13) NOT NULL,
  PRIMARY KEY (`blog_user_id`),
  UNIQUE KEY `blog_username` (`blog_user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

LOCK TABLES `blog_users` WRITE;
/*!40000 ALTER TABLE `blog_users` DISABLE KEYS */;
INSERT INTO `blog_users` VALUES (1,'admin','admin12345','admin@admin.bg',5,'1');
/*!40000 ALTER TABLE `blog_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
