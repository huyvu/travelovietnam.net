-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.0.51b-community-nt-log


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema travel
--

CREATE DATABASE IF NOT EXISTS travel;
USE travel;

--
-- Definition of table `tv_album`
--

DROP TABLE IF EXISTS `tv_album`;
CREATE TABLE `tv_album` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) default NULL,
  `description` text,
  `thumbnail` varchar(255) default NULL,
  `media_type` tinyint(1) NOT NULL default '0' COMMENT '0: Photo; 1: Video',
  `category_id` bigint(20) unsigned NOT NULL default '0',
  `hit` bigint(20) unsigned NOT NULL default '0',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_album`
--

/*!40000 ALTER TABLE `tv_album` DISABLE KEYS */;
INSERT INTO `tv_album` (`id`,`name`,`alias`,`description`,`thumbnail`,`media_type`,`category_id`,`hit`,`created_date`,`active`) VALUES 
 (1,'Vietnam Discovery','vietnam-discovery','Take a moment to explore Vietnam','/travelovietnam.com/files/upload/image/thumb-tour.jpg',0,1,44,'2013-12-25 08:20:22',1),
 (2,'Treet Foods','treet-foods','','/travelovietnam.com/files/upload/image/thumb-tour.jpg',1,1,22,'2014-01-15 16:25:23',1);
/*!40000 ALTER TABLE `tv_album` ENABLE KEYS */;


--
-- Definition of table `tv_album_category`
--

DROP TABLE IF EXISTS `tv_album_category`;
CREATE TABLE `tv_album_category` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `alias` varchar(255) default NULL,
  `parent_id` bigint(20) unsigned default NULL,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_album_category`
--

/*!40000 ALTER TABLE `tv_album_category` DISABLE KEYS */;
INSERT INTO `tv_album_category` (`id`,`name`,`alias`,`parent_id`,`created_date`,`active`) VALUES 
 (1,'Charming Vietnam','charming-vietnam',NULL,'2013-11-20 13:39:46',1);
/*!40000 ALTER TABLE `tv_album_category` ENABLE KEYS */;


--
-- Definition of table `tv_album_photo`
--

DROP TABLE IF EXISTS `tv_album_photo`;
CREATE TABLE `tv_album_photo` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `album_id` bigint(20) unsigned default NULL,
  `name` varchar(255) default NULL,
  `alias` varchar(255) default NULL,
  `description` text,
  `file_path` varchar(255) default NULL,
  `hit` bigint(20) unsigned NOT NULL default '0',
  `order_num` int(10) unsigned NOT NULL default '0',
  `meta_title` varchar(255) default NULL,
  `meta_key` varchar(255) default NULL,
  `meta_desc` varchar(255) default NULL,
  `active` tinyint(1) NOT NULL default '1',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_album_photo`
--

/*!40000 ALTER TABLE `tv_album_photo` DISABLE KEYS */;
INSERT INTO `tv_album_photo` (`id`,`album_id`,`name`,`alias`,`description`,`file_path`,`hit`,`order_num`,`meta_title`,`meta_key`,`meta_desc`,`active`,`created_date`) VALUES 
 (1,1,'Image 1','image-1','<p>This is description</p>','/travelovietnam.com/files/upload/image/home.jpg',0,0,'','','',1,'2013-11-20 16:26:49');
/*!40000 ALTER TABLE `tv_album_photo` ENABLE KEYS */;


--
-- Definition of table `tv_album_video`
--

DROP TABLE IF EXISTS `tv_album_video`;
CREATE TABLE `tv_album_video` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `album_id` bigint(20) unsigned default NULL,
  `name` varchar(255) default NULL,
  `alias` varchar(255) default NULL,
  `description` text,
  `thumbnail` varchar(255) default NULL,
  `embeded_video` varchar(255) default NULL,
  `hit` bigint(20) unsigned NOT NULL default '0',
  `order_num` int(10) unsigned NOT NULL default '0',
  `meta_title` varchar(255) default NULL,
  `meta_key` varchar(255) default NULL,
  `meta_desc` varchar(255) default NULL,
  `active` tinyint(1) NOT NULL default '1',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_album_video`
--

/*!40000 ALTER TABLE `tv_album_video` DISABLE KEYS */;
INSERT INTO `tv_album_video` (`id`,`album_id`,`name`,`alias`,`description`,`thumbnail`,`embeded_video`,`hit`,`order_num`,`meta_title`,`meta_key`,`meta_desc`,`active`,`created_date`) VALUES 
 (1,2,'Treet Foods','treet-foods','','/travelovietnam.com/files/upload/image/thumb-tour.jpg','<iframe width=\"640\" height=\"360\" src=\"//www.youtube.com/embed/EJgiS39h5ZI\" frameborder=\"0\" allowfullscreen></iframe>',19,0,'','','',1,'2014-01-15 16:25:23');
/*!40000 ALTER TABLE `tv_album_video` ENABLE KEYS */;


--
-- Definition of table `tv_content`
--

DROP TABLE IF EXISTS `tv_content`;
CREATE TABLE `tv_content` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `title` varchar(255) default NULL,
  `alias` varchar(255) default NULL,
  `thumbnail` varchar(255) default NULL,
  `summary` text,
  `content` text,
  `order_num` bigint(20) unsigned default '0',
  `catid` bigint(20) unsigned default NULL,
  `meta_title` varchar(255) default NULL,
  `meta_key` varchar(255) default NULL,
  `meta_desc` varchar(255) default NULL,
  `lang` varchar(255) default 'EN',
  `active` tinyint(1) default '1',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_content`
--

/*!40000 ALTER TABLE `tv_content` DISABLE KEYS */;
INSERT INTO `tv_content` (`id`,`title`,`alias`,`thumbnail`,`summary`,`content`,`order_num`,`catid`,`meta_title`,`meta_key`,`meta_desc`,`lang`,`active`,`created_date`) VALUES 
 (1,'Fare Types & Rules','fare-types-and-rules','','','',1,10,'','','','EN',1,'2013-03-31 09:09:58'),
 (2,'Baggage Information','baggage-information','','','',1,10,'','','','EN',1,'2013-03-31 09:10:42'),
 (3,'Taxes and fees information','taxes-and-fees-information','','','',1,10,'','','','EN',1,'2013-03-31 09:11:09'),
 (4,'Optional Service Charges','optional-service-charges','','','',1,10,'','','','EN',1,'2013-03-31 09:11:31'),
 (5,'Codeshare Flights','codeshare-flights','','','',1,10,'','','','EN',1,'2013-03-31 09:11:53'),
 (6,'Travel vietnam','travel-vietnam','/travelovietnam.com/files/upload/image/holy.jpg','<p>In this tour, you have the benefit of professional English-speaking local guide with special experience of every stop-offs in the trip. When your departure reaches around 10 travelers or more, you will have an experienced tour leader whose passion and knowledge will impart so much inspiration. Call us at hotline….. to get to the leader whenever you need help in the trip.</p>','',1,3,'','','','EN',1,'2013-10-03 09:04:45'),
 (7,'Thousand-year-old pagoda in northern village','thousand-year-old-pagoda-in-northern-village','/travelovietnam.com/files/upload/image/thumb-tour.jpg','<p>Hai Phong City is home to a historic thousand-year-old pagoda in the village of Tra Phuong of the Thuy Huong Commune in Kien Thuy District, built during the Ly Dynasty in the beginning of the 11th century.</p>','',1,3,'','','','EN',1,'2013-05-04 10:18:04'),
 (8,'VIETNAM - THE HIDDEN CHARM','vietnam-the-hidden-charm','','<p>This journey explores the hidden Vietnam - from the bustling cities to the isolated highlands. Our journey begins with a tour of Ho Chi Minh City This journey explores the hidden Vietnam - from the bustling cities to the isolated highlands. Our journey begins with a tour of Ho Chi Minh City This journey explores the hidden Vietnam - from the bustling cities to the isolated highlands. Our journey begins with a tour of Ho Chi Minh City</p>','<p>This journey explores the hidden Vietnam - from the bustling cities to the isolated highlands. Our journey begins with a tour of Ho Chi Minh City This journey explores the hidden Vietnam - from the bustling cities to the isolated highlands. Our journey begins with a tour of Ho Chi Minh City This journey explores the hidden Vietnam - from the bustling cities to the isolated highlands. Our journey begins with a tour of Ho Chi Minh City</p>',1,23,'','','','EN',1,'2013-07-17 11:52:02'),
 (9,'Travel in Vietnam with TraveloVietnam','travel-in-vietnam-with-travelovietnam','','<div id=\"intro\" class=\"gray_dark hspace clearfix\">\r\n<div style=\"width: 100px; float: left;\"><span class=\"field-items\"><span class=\"field-item\"><img title=\"Flag\" src=\"http://d3oxn90f3yphmd.cloudfront.net/sites/default/files/elements/destination/general/Vietnam_0.gif\" alt=\"Flag\" width=\"105\" height=\"70\" /></span></span></div>\r\n<div style=\"width: 560px; float: left; margin-left: 15px;\"><span class=\"field-items\"><span class=\"field-item\">Vietnam\'s colour, chaos and natural beauty bring a new adventure every day. Feel your senses come alive as you walk Hanoi\'s crazy streets, visit the other-worldly villages of Sapa and sail on majestic Halong Bay. Vietnam\'s food, people, sights and history keep even the most seasoned traveller coming back for more.</span></span></div>\r\n</div>','',1,24,'','','','EN',1,'2013-10-28 17:33:13'),
 (10,'Can Tho','can-tho','/travelovietnam.com/files/upload/image/thumb-tour.jpg','<p>Vietnam isn\'t a paradise of shopping with expensive products of famous brands but there, surely you will find several interesting things to buy. Let hire a driver and depart for a shopping session! Tailoring: A traditional \"Ao Dai\" or styled clothes from silks can be made upon</p>','',1,30,'','','','EN',1,'2013-11-02 11:39:30'),
 (11,'Shopping in Vietnam','shopping-in-vietnam','/travelovietnam.com/files/upload/image/thumb-tour.jpg','<p>Vietnam isn\'t a paradise of shopping with expensive products of famous brands but there, surely you will find several interesting things to buy. Let hire a driver and depart for a shopping session! Tailoring: A traditional \"Ao Dai\" or styled clothes from silks can be made upon your order at local tailors (in Hanoi, Hue, Hoi An, Saigon, etc.). Within about 2 days, you</p>','<p>Vietnam isn\'t a paradise of shopping with expensive products of famous brands but there, surely you will find several interesting things to buy. Let hire a driver and depart for a shopping session! Tailoring: A traditional \"Ao Dai\" or styled clothes from silks can be made upon your order at local tailors (in Hanoi, Hue, Hoi An, Saigon, etc.). Within about 2 days, you</p>',1,27,'','','','EN',1,'2013-11-14 08:32:36'),
 (12,'About Us','about-us','','','',1,5,'','','','EN',1,'2014-02-14 06:12:47');
/*!40000 ALTER TABLE `tv_content` ENABLE KEYS */;


--
-- Definition of table `tv_content_category`
--

DROP TABLE IF EXISTS `tv_content_category`;
CREATE TABLE `tv_content_category` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `alias` varchar(255) default NULL,
  `parent_id` bigint(20) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_content_category`
--

/*!40000 ALTER TABLE `tv_content_category` DISABLE KEYS */;
INSERT INTO `tv_content_category` (`id`,`name`,`alias`,`parent_id`) VALUES 
 (1,'Visa News','visa-news',NULL),
 (2,'Visa FAQs','visa-faqs',NULL),
 (3,'Travel News','travel-news',NULL),
 (4,'Why Us','why-us',NULL),
 (5,'About Us','about-us',NULL),
 (6,'Payment Instruction','payment-instruction',NULL),
 (7,'Privacy Policy','privacy-policy',NULL),
 (8,'Terms and Conditions','terms-and-conditions',NULL),
 (9,'Visa Extension','visa-extension',NULL),
 (10,'Flight Information','flight-information',NULL),
 (11,'Flight FAQs','flight-faqs',NULL),
 (12,'Tour FAQs','tour-faqs',NULL),
 (13,'Hotel FAQs','hotel-faqs',NULL),
 (14,'Accommodations','accommodations',NULL),
 (15,'Restaurants','restaurants',NULL),
 (16,'Places','places',NULL),
 (17,'Weather Vietnam','weather-vietnam',NULL),
 (18,'Our Warranty','our-warranty',NULL),
 (19,'Become an Affiliate','become-an-affiliate',NULL),
 (20,'About promotion','about-promotion',NULL),
 (21,'Our Services','our-services',NULL),
 (22,'Travel Guides','travel-guides',NULL),
 (23,'Vietnam Hightlights','vietnam-highlights',NULL),
 (24,'Vietnam Overview','vietnam-overview',NULL),
 (25,'Best time to visit Vietnam','best-time-to-visit-vietnam',NULL),
 (26,'Vietnam Culture & History','vietnam-culture-and-history',NULL),
 (27,'Vietnam Travel Tips','vietnam-travel-tips',NULL),
 (28,'Vietnam FAQ & Information','vietnam-faqs',NULL),
 (29,'Festivals & Events','festivals-events',NULL),
 (30,'Travel Top Destinations','travel-top-destinations',NULL),
 (31,'Tour Booking Conditions','tour-booking-conditions',NULL),
 (32,'Cancel and Refund','cancel-and-refund',NULL),
 (33,'Money Back Guarantee','money-back-guarantee',NULL),
 (34,'Safety Payment','safety-payment',NULL);
/*!40000 ALTER TABLE `tv_content_category` ENABLE KEYS */;


--
-- Definition of table `tv_cuisine`
--

DROP TABLE IF EXISTS `tv_cuisine`;
CREATE TABLE `tv_cuisine` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `title` varchar(255) default NULL,
  `alias` varchar(255) default NULL,
  `thumbnail` varchar(255) default NULL,
  `summary` text,
  `content` text,
  `order_num` bigint(20) unsigned default '0',
  `catid` bigint(20) unsigned default NULL,
  `meta_title` varchar(255) default NULL,
  `meta_key` varchar(255) default NULL,
  `meta_desc` varchar(255) default NULL,
  `lang` varchar(255) default 'EN',
  `active` tinyint(1) default '1',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_cuisine`
--

/*!40000 ALTER TABLE `tv_cuisine` DISABLE KEYS */;
INSERT INTO `tv_cuisine` (`id`,`title`,`alias`,`thumbnail`,`summary`,`content`,`order_num`,`catid`,`meta_title`,`meta_key`,`meta_desc`,`lang`,`active`,`created_date`) VALUES 
 (1,'Crayfish Cà Mau','crayfish-ca-mau','http://www.vietnamesefood.com.vn/timthumb.php?src=upload/images/crayfish-ca-mau-tomtit-ca-mau.jpg&h=158&w=188','<p>Crayfish Cà Mau (Tôm Tít Cà Mau) is present from sea, especially dedicated to the friends from the mainland to visit Ca Mau. Crayfish’s meat is delicious, fresh, tasty medium gentle sea, far from the taste of shrimp and lobster. It is now considered one of Best Vietnamese Food.</p>','<div style=\"text-align: justify;\"><span style=\"font-size: 14px;\"><span style=\"font-family: georgia, serif;\"><em>Crayfish Cà Mau (Tôm Tít Cà Mau)</em> is present from sea, especially dedicated to the friends from the mainland to visit Ca Mau. Crayfish’s meat is delicious, fresh, tasty medium gentle sea, far from the taste of shrimp and lobster. It is now considered one of <a href=\"http://www.vietnamesefood.com.vn/vietnamese-food/best-vietnamese-food/\"><span style=\"color: #cc3300;\"><span style=\"font-size: 16px;\"><strong><em>Best Vietnamese Food</em></strong></span></span></a>.</span></span><br />  </div>\r\n<div style=\"text-align: center;\"><img style=\"width: 400px; height: 300px;\" title=\"crayfish-ca-mau-tom-tit-ca-mau\" src=\"http://www.vietnamesefood.com.vn/kcfinder/upload/images/Hinh%205/tomtit%20%284%29.jpg\" alt=\"crayfish-ca-mau-tom-tit-ca-mau\" longdesc=\"crayfish-ca-mau-tom-tit-ca-mau\" /><br />  </div>\r\n<div style=\"text-align: justify;\"><span style=\"font-size: 14px;\"><span style=\"font-family: georgia, serif;\">For a crayfish party is very attractive, there must first be selected for the wine and the shrimp are jumping. The bigger of this <span style=\"color: #cc3300;\"><span style=\"font-size: 16px;\"><strong><em>Best Vietnamese Food</em></strong></span></span> the greater value it is. 4-6 Type I /kg are truly \"world-class\".<br /> <br /> The cooking way of this <a href=\"http://www.vietnamesefood.com.vn/vietnamese-food/best-vietnamese-food/\"><span style=\"color: #cc3300;\"><strong><em><span style=\"font-size: 16px;\">Best Vietnamese Food</span></em></strong></span></a> is not very picky, just steamed, boiled or baked, with salt or lemon pepper fish sauce Foot binding enough visitors every domain. The handy man and \"soul\" are shown eating thin pressing the dried crayfish, as it is scrumptious dishes for entertaining friends or courtesy.</span></span><br />  </div>\r\n<div style=\"text-align: center;\"><img style=\"width: 400px; height: 300px;\" title=\"crayfish-ca-mau-tom-tit-ca-mau\" src=\"http://www.vietnamesefood.com.vn/kcfinder/upload/images/Hinh%205/tomtit%20%285%29.jpg\" alt=\"crayfish-ca-mau-tom-tit-ca-mau\" longdesc=\"crayfish-ca-mau-tom-tit-ca-mau\" /><br />  </div>\r\n<div style=\"text-align: justify;\"><span style=\"font-size: 14px;\"><span style=\"font-family: georgia, serif;\">Boiled shrimp is done, if the shrimp are large, they put the child up and drive a knife cut each folded for easy peeling. If baking, to fan the embers, are always returned, cooked shrimp shells gold, rising aroma is complex. But most were on hand peeled; slice extra pair of herbs, chewing up feeling crunchy punchy and sweet. If the child is small shrimp to hear crunchy bite.</span></span><br />  </div>\r\n<div style=\"text-align: center;\"><img style=\"width: 400px; height: 300px;\" title=\"crayfish-ca-mau-tom-tit-ca-mau\" src=\"http://www.vietnamesefood.com.vn/kcfinder/upload/images/Hinh%205/tomtit%20%282%29.jpg\" alt=\"crayfish-ca-mau-tom-tit-ca-mau\" longdesc=\"crayfish-ca-mau-tom-tit-ca-mau\" /><br />  </div>\r\n<p><span style=\"font-size: 14px;\"><span style=\"font-family: georgia, serif;\">Crayfish meat is red, ward complex flavor, soft but not mealy. Discerning People often use this dish with more vegetables, tomato, banana, cucumber and if there as good extra bit of mustard. Shrimp meat wrapped in rice paper if they wish to put vegetables and sour sauce - spicy, not sure if that package rolls up. If there are more bottles of rice wine or a few cans of beer party even more exciting.  If you come to this place, there is no reason you would not enjoy this <span style=\"color: #cc3300;\"><span style=\"font-size: 16px;\"><strong><em>Best Vietnamese Food</em></strong></span></span>.</span></span></p>',1,1,'','','','EN',1,'2013-07-31 11:13:49');
/*!40000 ALTER TABLE `tv_cuisine` ENABLE KEYS */;


--
-- Definition of table `tv_cuisine_category`
--

DROP TABLE IF EXISTS `tv_cuisine_category`;
CREATE TABLE `tv_cuisine_category` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `alias` varchar(255) default NULL,
  `active` tinyint(1) NOT NULL default '1',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_cuisine_category`
--

/*!40000 ALTER TABLE `tv_cuisine_category` DISABLE KEYS */;
INSERT INTO `tv_cuisine_category` (`id`,`name`,`alias`,`active`,`created_date`) VALUES 
 (1,'Noodle soups','noodle-soups',1,'2013-07-31 10:29:28'),
 (2,'Soup and cháo','soup-and-chao',1,'2013-07-31 10:32:14');
/*!40000 ALTER TABLE `tv_cuisine_category` ENABLE KEYS */;


--
-- Definition of table `tv_embassy`
--

DROP TABLE IF EXISTS `tv_embassy`;
CREATE TABLE `tv_embassy` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `title` varchar(255) default NULL,
  `alias` varchar(255) default NULL,
  `lang` varchar(255) NOT NULL default 'EN',
  `nation` varchar(255) default NULL,
  `content` text,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_embassy`
--

/*!40000 ALTER TABLE `tv_embassy` DISABLE KEYS */;
/*!40000 ALTER TABLE `tv_embassy` ENABLE KEYS */;


--
-- Definition of table `tv_entertainment`
--

DROP TABLE IF EXISTS `tv_entertainment`;
CREATE TABLE `tv_entertainment` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) default NULL,
  `thumbnail` varchar(255) default NULL,
  `city` bigint(20) unsigned NOT NULL default '0',
  `address` varchar(255) default NULL,
  `gmap_address` varchar(255) default NULL,
  `area` varchar(255) default NULL,
  `open_time` varchar(255) default NULL,
  `content_type` varchar(255) default NULL,
  `summary` text,
  `content` text,
  `order_num` bigint(20) unsigned NOT NULL default '0',
  `catid` bigint(20) unsigned NOT NULL default '0',
  `meta_title` varchar(255) default NULL,
  `meta_key` varchar(255) default NULL,
  `meta_desc` varchar(255) default NULL,
  `lang` varchar(255) NOT NULL default 'EN',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_entertainment`
--

/*!40000 ALTER TABLE `tv_entertainment` DISABLE KEYS */;
/*!40000 ALTER TABLE `tv_entertainment` ENABLE KEYS */;


--
-- Definition of table `tv_entertainment_category`
--

DROP TABLE IF EXISTS `tv_entertainment_category`;
CREATE TABLE `tv_entertainment_category` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `alias` varchar(255) default NULL,
  `parent_id` bigint(20) unsigned default NULL,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_entertainment_category`
--

/*!40000 ALTER TABLE `tv_entertainment_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `tv_entertainment_category` ENABLE KEYS */;


--
-- Definition of table `tv_feedback`
--

DROP TABLE IF EXISTS `tv_feedback`;
CREATE TABLE `tv_feedback` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `fullname` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  `content` text,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_feedback`
--

/*!40000 ALTER TABLE `tv_feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `tv_feedback` ENABLE KEYS */;


--
-- Definition of table `tv_flight_airline`
--

DROP TABLE IF EXISTS `tv_flight_airline`;
CREATE TABLE `tv_flight_airline` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `alias` varchar(255) default NULL,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_flight_airline`
--

/*!40000 ALTER TABLE `tv_flight_airline` DISABLE KEYS */;
INSERT INTO `tv_flight_airline` (`id`,`name`,`alias`,`created_date`,`active`) VALUES 
 (1,'Vietnam Airlines','vietnam-airlines','2013-10-03 09:58:52',1);
/*!40000 ALTER TABLE `tv_flight_airline` ENABLE KEYS */;


--
-- Definition of table `tv_flight_airport`
--

DROP TABLE IF EXISTS `tv_flight_airport`;
CREATE TABLE `tv_flight_airport` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `alias` varchar(255) default NULL,
  `code` varchar(255) default NULL,
  `nation` varchar(255) default NULL,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_flight_airport`
--

/*!40000 ALTER TABLE `tv_flight_airport` DISABLE KEYS */;
INSERT INTO `tv_flight_airport` (`id`,`name`,`alias`,`code`,`nation`,`created_date`,`active`) VALUES 
 (1,'Buon Ma Thuot','buon-ma-thuot','BMV','Vietnam','2013-10-03 10:11:16',1),
 (2,'Ca Mau','ca-mau','CAH','Vietnam','2013-10-03 10:11:16',1),
 (3,'Can Tho','can-tho','VCA','Vietnam','2013-10-03 10:11:16',1),
 (4,'Chu Lai','chu-lai','VCL','Vietnam','2013-10-03 10:11:16',1),
 (5,'Con Dao','con-dao','VCS','Vietnam','2013-10-03 10:11:16',1),
 (6,'Da Lat','da-lat','DLI','Vietnam','2013-10-03 10:11:16',1),
 (7,'Da Nang','da-nang','DAD','Vietnam','2013-10-03 10:11:16',1),
 (8,'Dien Bien','dien-bien','DIN','Vietnam','2013-10-03 10:11:16',1),
 (9,'Dong Hoi','dong-hoi','VDH','Vietnam','2013-10-03 10:11:16',1),
 (10,'Ha Noi','ha-noi','HAN','Vietnam','2013-10-03 10:11:16',1),
 (11,'Hai Phong','hai-phong','HPH','Vietnam','2013-10-03 10:11:16',1),
 (12,'Ho Chi Minh City','ho-chi-minh-city','SGN','Vietnam','2013-10-03 10:11:16',1),
 (13,'Hue','hue','HUI','Vietnam','2013-10-03 10:11:16',1),
 (14,'Nha Trang','nha-trang','NHA','Vietnam','2013-10-03 10:11:16',1),
 (15,'Phu Quoc','phu-quoc','PQC','Vietnam','2013-10-03 10:11:16',1),
 (16,'Pleiku','pleiku','PXU','Vietnam','2013-10-03 10:11:16',1),
 (17,'Quy Nhon','quy-nhon','UIH','Vietnam','2013-10-03 10:11:16',1),
 (18,'Rach Gia','rach-gia','VKG','Vietnam','2013-10-03 10:11:16',1),
 (19,'Thanh Hoa','thanh-hoa','THD','Vietnam','2013-10-03 10:11:16',1),
 (20,'Tuy Hoa','tuy-hoa','TBB','Vietnam','2013-10-03 10:11:16',1),
 (21,'Vinh','vinh','VII','Vietnam','2013-10-03 10:11:16',1),
 (22,'Melbourne','melbourne','MEL','Australia','2013-10-03 10:12:19',1),
 (23,'Sydney','sydney','SYD','Australia','2013-10-03 10:12:19',1),
 (24,'Amsterdam','amsterdam','AMS','Europe','2013-10-03 10:15:01',1),
 (25,'Barcelona','barcelona','BCN','Europe','2013-10-03 10:15:13',1),
 (26,'Frankfurt','frankfurt','FRA','Europe','2013-10-03 10:15:13',1),
 (27,'London','london','LON','Europe','2013-10-03 10:15:13',1),
 (28,'Moscow','moscow','MOW','Europe','2013-10-03 10:15:13',1),
 (29,'Nice','nice','NCE','Europe','2013-10-03 10:15:13',1),
 (30,'Paris','paris','PAR','Europe','2013-10-03 10:15:13',1),
 (31,'Prague','prague','PRG','Europe','2013-10-03 10:15:13',1),
 (32,'Rome','rome','ROM','Europe','2013-10-03 10:15:13',1),
 (33,'Luang Prabang','luang-prabang','LPQ','Indochina','2013-10-03 10:16:45',1),
 (34,'Phnom Penh','phnom-penh','PNH','Indochina','2013-10-03 10:16:45',1),
 (35,'Siem Riep','siem-riep','REP','Indochina','2013-10-03 10:16:45',1),
 (36,'Vientiane','vientiane','VTE','Indochina','2013-10-03 10:16:45',1),
 (37,'Beijing','beijing','BJS','North East Asia','2013-10-03 10:21:00',1),
 (38,'Busan','busan','PUS','North East Asia','2013-10-03 10:21:00',1),
 (39,'Chengdu','chengdu','CTU','North East Asia','2013-10-03 10:21:00',1),
 (40,'Fukuoka','fukuoka','FUK','North East Asia','2013-10-03 10:21:00',1),
 (41,'Guangzhou','guangzhou','CAN','North East Asia','2013-10-03 10:21:00',1),
 (42,'Hong Kong','hong-kong','HKG','North East Asia','2013-10-03 10:21:00',1),
 (43,'Kaohsiung','kaohsiung','KHH','North East Asia','2013-10-03 10:21:00',1),
 (44,'Nagoya','nagoya','NGO','North East Asia','2013-10-03 10:21:00',1),
 (45,'Osaka','osaka','OSA','North East Asia','2013-10-03 10:21:00',1),
 (46,'Seoul','seoul','SEL','North East Asia','2013-10-03 10:21:00',1),
 (47,'Shanghai','shanghai','SHA','North East Asia','2013-10-03 10:21:00',1),
 (48,'Taipei','taipei','TPE','North East Asia','2013-10-03 10:21:00',1),
 (49,'Tokyo','tokyo','TYO','North East Asia','2013-10-03 10:21:00',1),
 (50,'Bangkok','bangkok','BKK','South East Asia','2013-10-03 10:22:57',1),
 (51,'Jakarta','jakarta','JKT','South East Asia','2013-10-03 10:22:57',1),
 (52,'Kuala Lumpur','kuala-lumpur','KUL','South East Asia','2013-10-03 10:22:57',1),
 (53,'Manila','manila','MNL','South East Asia','2013-10-03 10:22:57',1),
 (54,'Singapore','singapore','SIN','South East Asia','2013-10-03 10:22:57',1),
 (55,'Yangon','yangon','RGN','South East Asia','2013-10-03 10:22:57',1),
 (56,'Atlanta Hartsfield','atlanta-hartsfield','ATL','United States of America','2013-10-03 10:28:14',1),
 (57,'Austin','austin','AUS','United States of America','2013-10-03 10:28:14',1),
 (58,'Boston, Logan','boston-logan','BOS','United States of America','2013-10-03 10:28:14',1),
 (59,'Chicago IL','chicago-il','CHI','United States of America','2013-10-03 10:28:14',1),
 (60,'Dallas Fort Worth','dallas-fort-worth','DFW','United States of America','2013-10-03 10:28:14',1),
 (61,'Denver','denver','DEN','United States of America','2013-10-03 10:28:14',1),
 (62,'Honolulu','honolulu','HNL','United States of America','2013-10-03 10:28:14',1),
 (63,'Los Angeles','los-angeles','LAX','United States of America','2013-10-03 10:28:14',1),
 (64,'Miami','miami','MIA','United States of America','2013-10-03 10:28:14',1),
 (65,'Minneapolis/St.Paul','minneapolis-st-paul','MSP','United States of America','2013-10-03 10:28:14',1),
 (66,'Philadelphia','philadelphia','PHL','United States of America','2013-10-03 10:28:14',1),
 (67,'Portland','portland','PDX','United States of America','2013-10-03 10:28:14',1),
 (68,'San Francisco','san-francisco','SFO','United States of America','2013-10-03 11:25:41',1),
 (69,'Seattle, Tacoma','seattle-tacoma','SEA','United States of America','2013-10-03 10:28:14',1),
 (70,'St Louis, Lambert','st-louis-lambert','STL','United States of America','2013-10-03 10:28:14',1),
 (71,'Washington','washington','WAS','United States of America','2013-10-03 10:28:14',1);
/*!40000 ALTER TABLE `tv_flight_airport` ENABLE KEYS */;


--
-- Definition of table `tv_flight_booking`
--

DROP TABLE IF EXISTS `tv_flight_booking`;
CREATE TABLE `tv_flight_booking` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `adults` int(10) unsigned NOT NULL default '1',
  `children` int(10) unsigned NOT NULL default '0',
  `infants` int(10) unsigned NOT NULL default '0',
  `fullname` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  `phone` varchar(255) default NULL,
  `message` text,
  `payment_method` varchar(255) default NULL,
  `status` tinyint(1) NOT NULL default '0',
  `total_fee` double NOT NULL default '0',
  `booking_key` varchar(255) default NULL,
  `booking_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `user_id` bigint(20) unsigned NOT NULL default '0',
  `promotion_code` varchar(45) default NULL,
  `discount` double NOT NULL default '0',
  `direction` varchar(255) NOT NULL default '"one-way"',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_flight_booking`
--

/*!40000 ALTER TABLE `tv_flight_booking` DISABLE KEYS */;
INSERT INTO `tv_flight_booking` (`id`,`adults`,`children`,`infants`,`fullname`,`email`,`phone`,`message`,`payment_method`,`status`,`total_fee`,`booking_key`,`booking_date`,`user_id`,`promotion_code`,`discount`,`direction`) VALUES 
 (1,0,0,0,'Le Thanh Phong','ltp_mv_huflit@yahoo.com','0933914822','','Credit Card',0,0,'flight_7fdd0c6919cbaa5350d3a91bec30a1c0','2013-10-04 12:51:28',1,'',0,'\"one-way\"'),
 (2,0,1,0,'Le Thanh Phong','ltp_mv_huflit@yahoo.com','0933914822','','Credit Card',0,37,'flight_56d87f68277bd94b96565d24ab1a6fc1','2013-10-04 13:01:26',1,'',0,'\"one-way\"'),
 (3,0,1,0,'Le Thanh Phong','ltp_mv_huflit@yahoo.com','0933914822','','Credit Card',0,37,'flight_af3079638cbe465bc768265a83a77973','2013-10-04 13:02:06',1,'',0,'\"one-way\"'),
 (4,0,1,0,'Le Thanh Phong','ltp_mv_huflit@yahoo.com','0933914822','','Credit Card',0,37,'flight_37ae79e3e0eac8499b37e646804b1ab0','2013-10-04 13:03:03',1,'',0,'\"one-way\"'),
 (5,0,1,0,'Le Thanh Phong','ltp_mv_huflit@yahoo.com','0933914822','','Credit Card',0,37,'flight_85211be5f28f376a301fa145f48efdda','2013-10-04 13:03:55',1,'',0,'\"one-way\"'),
 (6,0,1,0,'Le Thanh Phong','ltp_mv_huflit@yahoo.com','0933914822','','Credit Card',0,37,'flight_78879799d7725593b4388c20170a8c10','2013-10-04 13:05:28',1,'',0,'\"one-way\"'),
 (7,0,1,0,'Le Thanh Phong','ltp_mv_huflit@yahoo.com','0933914822','','Credit Card',0,37,'flight_0f82340abd721b7751a1c652dcdd9a28','2013-10-04 13:08:29',1,'',0,'\"one-way\"'),
 (8,0,1,0,'Le Thanh Phong','ltp_mv_huflit@yahoo.com','0933914822','','Credit Card',0,37,'flight_0e506290c39dd03457c973efc029a01a','2013-10-04 13:11:09',1,'',0,'\"one-way\"'),
 (9,0,1,0,'Le Thanh Phong','ltp_mv_huflit@yahoo.com','0933914822','','Credit Card',0,37,'flight_9fa8a85c7cedbe4a198717620679cc6d','2013-10-04 13:11:15',1,'',0,'\"one-way\"'),
 (10,0,1,0,'Le Thanh Phong','ltp_mv_huflit@yahoo.com','0933914822','','Credit Card',0,37,'flight_fc91e5301bb8d481af323da9541ac1b4','2013-10-04 13:12:54',1,'',0,'\"one-way\"'),
 (11,0,1,0,'Le Thanh Phong','ltp_mv_huflit@yahoo.com','0933914822','','Credit Card',0,37,'flight_d6909a6f1a6f98f35c4fa1f42f85f049','2013-10-04 13:30:29',1,'',0,'\"one-way\"'),
 (12,0,1,0,'Le Thanh Phong','ltp_mv_huflit@yahoo.com','0933914822','','Credit Card',0,37,'flight_47e352648cc00bb22badfe27b291af43','2013-10-04 13:31:09',1,'',0,'\"one-way\"'),
 (13,0,1,0,'Le Thanh Phong','ltp_mv_huflit@yahoo.com','0933914822','','Credit Card',0,37,'flight_e105eb1fbbf637faf2d9a480e848b533','2013-10-04 13:32:38',1,'',0,'\"one-way\"');
/*!40000 ALTER TABLE `tv_flight_booking` ENABLE KEYS */;


--
-- Definition of table `tv_flight_pax`
--

DROP TABLE IF EXISTS `tv_flight_pax`;
CREATE TABLE `tv_flight_pax` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `book_id` bigint(20) unsigned default '0',
  `fullname` varchar(255) default NULL,
  `gender` varchar(255) default NULL,
  `birthdate` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `nationality` varchar(255) default NULL,
  `passport` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_flight_pax`
--

/*!40000 ALTER TABLE `tv_flight_pax` DISABLE KEYS */;
INSERT INTO `tv_flight_pax` (`id`,`book_id`,`fullname`,`gender`,`birthdate`,`nationality`,`passport`) VALUES 
 (1,7,'Phong LE','Male','2013-10-01 00:00:00','Argentina',NULL),
 (2,8,'Phong LE','Male','2013-10-01 00:00:00','Argentina',NULL),
 (3,9,'Phong LE','Male','2013-10-01 00:00:00','Argentina',NULL),
 (4,10,'Phong LE','Male','2013-10-01 00:00:00','Argentina',NULL),
 (5,11,'Phong LE','Male','2013-10-01 00:00:00','Argentina',NULL),
 (6,12,'Phong LE','Male','2013-10-01 00:00:00','Argentina',NULL),
 (7,13,'Phong LE','Male','2013-10-01 00:00:00','Argentina',NULL);
/*!40000 ALTER TABLE `tv_flight_pax` ENABLE KEYS */;


--
-- Definition of table `tv_flight_route`
--

DROP TABLE IF EXISTS `tv_flight_route`;
CREATE TABLE `tv_flight_route` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `leaving_from` varchar(45) NOT NULL,
  `going_to` varchar(45) NOT NULL,
  `airline` varchar(45) NOT NULL,
  `flight` varchar(45) NOT NULL,
  `aircraft` varchar(45) default NULL,
  `stops` int(10) unsigned NOT NULL default '0',
  `stop_detail` text,
  `departure_time` varchar(45) NOT NULL,
  `arrival_time` varchar(45) NOT NULL,
  `duration` varchar(45) default NULL,
  `saverflex` double NOT NULL default '0',
  `economy` double NOT NULL default '0',
  `business` double NOT NULL default '0',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_flight_route`
--

/*!40000 ALTER TABLE `tv_flight_route` DISABLE KEYS */;
INSERT INTO `tv_flight_route` (`id`,`leaving_from`,`going_to`,`airline`,`flight`,`aircraft`,`stops`,`stop_detail`,`departure_time`,`arrival_time`,`duration`,`saverflex`,`economy`,`business`,`created_date`,`active`) VALUES 
 (1,'SGN','DAD','Vietnam Airlines','AIR123','Boeing 757',1,'','8:30 am','10:30 am','2h',40,50,60,'2013-11-19 10:19:21',1);
/*!40000 ALTER TABLE `tv_flight_route` ENABLE KEYS */;


--
-- Definition of table `tv_flight_stop`
--

DROP TABLE IF EXISTS `tv_flight_stop`;
CREATE TABLE `tv_flight_stop` (
  `id` int(11) NOT NULL auto_increment,
  `route_id` int(11) NOT NULL,
  `departure_time1` varchar(20) collate utf8_unicode_ci NOT NULL,
  `arrival_time1` varchar(20) collate utf8_unicode_ci NOT NULL,
  `duration1` varchar(20) collate utf8_unicode_ci NOT NULL,
  `leaving_from1` varchar(45) collate utf8_unicode_ci NOT NULL,
  `going_to1` varchar(45) collate utf8_unicode_ci NOT NULL,
  `airline1` varchar(45) collate utf8_unicode_ci NOT NULL,
  `flight1` varchar(45) collate utf8_unicode_ci NOT NULL,
  `layover1` varchar(20) collate utf8_unicode_ci NOT NULL,
  `departure_time2` varchar(20) collate utf8_unicode_ci NOT NULL,
  `arrival_time2` varchar(20) collate utf8_unicode_ci NOT NULL,
  `duration2` varchar(20) collate utf8_unicode_ci NOT NULL,
  `leaving_from2` varchar(45) collate utf8_unicode_ci NOT NULL,
  `going_to2` varchar(45) collate utf8_unicode_ci NOT NULL,
  `airline2` varchar(45) collate utf8_unicode_ci NOT NULL,
  `flight2` varchar(45) collate utf8_unicode_ci NOT NULL,
  `layover2` varchar(20) collate utf8_unicode_ci NOT NULL,
  `departure_time3` varchar(20) collate utf8_unicode_ci NOT NULL,
  `arrival_time3` varchar(20) collate utf8_unicode_ci NOT NULL,
  `duration3` varchar(20) collate utf8_unicode_ci NOT NULL,
  `leaving_from3` varchar(45) collate utf8_unicode_ci NOT NULL,
  `going_to3` varchar(45) collate utf8_unicode_ci NOT NULL,
  `airline3` varchar(45) collate utf8_unicode_ci NOT NULL,
  `flight3` varchar(45) collate utf8_unicode_ci NOT NULL,
  `layover3` varchar(20) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tv_flight_stop`
--

/*!40000 ALTER TABLE `tv_flight_stop` DISABLE KEYS */;
INSERT INTO `tv_flight_stop` (`id`,`route_id`,`departure_time1`,`arrival_time1`,`duration1`,`leaving_from1`,`going_to1`,`airline1`,`flight1`,`layover1`,`departure_time2`,`arrival_time2`,`duration2`,`leaving_from2`,`going_to2`,`airline2`,`flight2`,`layover2`,`departure_time3`,`arrival_time3`,`duration3`,`leaving_from3`,`going_to3`,`airline3`,`flight3`,`layover3`) VALUES 
 (1,2,'8:30 am','9:30 am','1h','BMV','SGN','Vietnam Airlines','Boeing 1','0h 30m','10:00 am','11:30 am','1h 30m','SGN','HAN','Vietnam Airlines','Boeing 2','','','','','','','','','');
/*!40000 ALTER TABLE `tv_flight_stop` ENABLE KEYS */;


--
-- Definition of table `tv_flight_ticket`
--

DROP TABLE IF EXISTS `tv_flight_ticket`;
CREATE TABLE `tv_flight_ticket` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `book_id` bigint(20) unsigned NOT NULL default '0',
  `leaving_from` varchar(255) default NULL,
  `going_to` varchar(255) default NULL,
  `departure_date` timestamp NOT NULL default '0000-00-00 00:00:00',
  `arrival_date` timestamp NOT NULL default '0000-00-00 00:00:00',
  `airline` varchar(255) default NULL,
  `flight` varchar(255) default NULL,
  `stops` varchar(255) default NULL,
  `class_type` varchar(255) default NULL,
  `fare` double NOT NULL default '0',
  `duration` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_flight_ticket`
--

/*!40000 ALTER TABLE `tv_flight_ticket` DISABLE KEYS */;
INSERT INTO `tv_flight_ticket` (`id`,`book_id`,`leaving_from`,`going_to`,`departure_date`,`arrival_date`,`airline`,`flight`,`stops`,`class_type`,`fare`,`duration`) VALUES 
 (1,4,'SGN','DAD','0000-00-00 00:00:00','2013-10-04 12:03:03','Vietnam Airlines','AIR123','0','economy',50,'2h'),
 (2,4,'DAD','SGN','2013-10-04 12:03:03','0000-00-00 00:00:00',NULL,NULL,NULL,'economy',0,NULL),
 (3,5,'SGN','DAD','0000-00-00 00:00:00','0000-00-00 00:00:00','Vietnam Airlines','AIR123','0','economy',50,'2h'),
 (4,5,'DAD','SGN','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,NULL,NULL,'economy',0,NULL),
 (5,6,'SGN','DAD','0000-00-00 00:00:00','0000-00-00 00:00:00','Vietnam Airlines','AIR123','0','economy',50,'2h'),
 (6,7,'SGN','DAD','0000-00-00 00:00:00','0000-00-00 00:00:00','Vietnam Airlines','AIR123','0','economy',50,'2h'),
 (7,8,'SGN','DAD','0000-00-00 00:00:00','0000-00-00 00:00:00','Vietnam Airlines','AIR123','0','economy',50,'2h'),
 (8,9,'SGN','DAD','0000-00-00 00:00:00','0000-00-00 00:00:00','Vietnam Airlines','AIR123','0','economy',50,'2h'),
 (9,10,'SGN','DAD','0000-00-00 00:00:00','0000-00-00 00:00:00','Vietnam Airlines','AIR123','0','economy',50,'2h'),
 (10,11,'SGN','DAD','0000-00-00 00:00:00','0000-00-00 00:00:00','Vietnam Airlines','AIR123','0','economy',50,'2h'),
 (11,12,'SGN','DAD','0000-00-00 00:00:00','0000-00-00 00:00:00','Vietnam Airlines','AIR123','0','economy',50,'2h'),
 (12,13,'SGN','DAD','0000-00-00 00:00:00','0000-00-00 00:00:00','Vietnam Airlines','AIR123','0','economy',50,'2h');
/*!40000 ALTER TABLE `tv_flight_ticket` ENABLE KEYS */;


--
-- Definition of table `tv_gallery`
--

DROP TABLE IF EXISTS `tv_gallery`;
CREATE TABLE `tv_gallery` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `thumbnail` varchar(255) default NULL,
  `active` tinyint(1) NOT NULL default '1',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_gallery`
--

/*!40000 ALTER TABLE `tv_gallery` DISABLE KEYS */;
/*!40000 ALTER TABLE `tv_gallery` ENABLE KEYS */;


--
-- Definition of table `tv_help_category`
--

DROP TABLE IF EXISTS `tv_help_category`;
CREATE TABLE `tv_help_category` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `alias` varchar(255) default NULL,
  `parent_id` bigint(20) unsigned default NULL,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_help_category`
--

/*!40000 ALTER TABLE `tv_help_category` DISABLE KEYS */;
INSERT INTO `tv_help_category` (`id`,`name`,`alias`,`parent_id`,`created_date`,`active`) VALUES 
 (1,'Tour booking','tour-booking',NULL,'2014-02-03 22:40:41',1);
/*!40000 ALTER TABLE `tv_help_category` ENABLE KEYS */;


--
-- Definition of table `tv_help_content`
--

DROP TABLE IF EXISTS `tv_help_content`;
CREATE TABLE `tv_help_content` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `title` varchar(255) default NULL,
  `alias` varchar(255) default NULL,
  `thumbnail` varchar(255) default NULL,
  `summary` text,
  `content` text,
  `catid` bigint(20) unsigned default NULL,
  `meta_title` varchar(255) default NULL,
  `meta_key` varchar(255) default NULL,
  `meta_desc` varchar(255) default NULL,
  `lang` varchar(255) default 'EN',
  `keywords` varchar(255) default NULL,
  `order_num` bigint(20) unsigned default '0',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `active` tinyint(1) default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tv_help_content`
--

/*!40000 ALTER TABLE `tv_help_content` DISABLE KEYS */;
INSERT INTO `tv_help_content` (`id`,`title`,`alias`,`thumbnail`,`summary`,`content`,`catid`,`meta_title`,`meta_key`,`meta_desc`,`lang`,`keywords`,`order_num`,`created_date`,`active`) VALUES 
 (1,'Shopping in Vietnam','shopping-in-vietnam','','<p>Welcome to a world where the colours are more vivid, where the landscapes are bolder, the coastline more dramatic, where the history is more compelling, where the tastes are more divine, where life is lived in the fast lane.</p>','<p>Welcome to a world where the colours are more vivid, where the landscapes are bolder, the coastline more dramatic, where the history is more compelling, where the tastes are more divine, where life is lived in the fast lane. This world is Vietnam, the latest Asian dragon to awake from its slumber. Nature has blessed Vietnam with a bountiful harvest of soaring mountains, a killer coastline and radiant rice ...</p>',1,'','','','EN',NULL,0,'2014-02-05 20:53:07',1);
/*!40000 ALTER TABLE `tv_help_content` ENABLE KEYS */;


--
-- Definition of table `tv_help_question`
--

DROP TABLE IF EXISTS `tv_help_question`;
CREATE TABLE `tv_help_question` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `parent_id` bigint(20) unsigned NOT NULL default '0',
  `category_id` bigint(20) unsigned NOT NULL default '0',
  `title` varchar(255) default NULL,
  `alias` varchar(255) default NULL,
  `content` text,
  `author` bigint(20) unsigned default NULL,
  `status` tinyint(1) unsigned NOT NULL default '0' COMMENT '0: Open; 1: Resolved; 2: Closed',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `active` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_help_question`
--

/*!40000 ALTER TABLE `tv_help_question` DISABLE KEYS */;
INSERT INTO `tv_help_question` (`id`,`parent_id`,`category_id`,`title`,`alias`,`content`,`author`,`status`,`created_date`,`active`) VALUES 
 (1,0,1,'Test ticket','test-ticket','Test ticket',1,0,'2014-02-13 17:31:07',0);
/*!40000 ALTER TABLE `tv_help_question` ENABLE KEYS */;


--
-- Definition of table `tv_hotel`
--

DROP TABLE IF EXISTS `tv_hotel`;
CREATE TABLE `tv_hotel` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `alias` varchar(255) default NULL,
  `meta_title` varchar(255) default NULL,
  `meta_key` varchar(255) default NULL,
  `meta_desc` varchar(255) default NULL,
  `summary` text,
  `highlight` text,
  `detail` text,
  `thumbnail` varchar(255) default NULL,
  `original_price` double NOT NULL default '0',
  `price` double default '0',
  `star` double default '1',
  `city` varchar(255) default NULL,
  `address` varchar(255) default NULL,
  `map` text,
  `story` text,
  `wifi` tinyint(1) default '1',
  `breakfast` tinyint(1) default '1',
  `smoking_room` tinyint(1) default '1',
  `parking` tinyint(1) default '1',
  `cable_television` tinyint(1) default '1',
  `nightclub` tinyint(1) default '1',
  `kitchenette` tinyint(1) default '1',
  `pool` tinyint(1) default '1',
  `air_conditioning` tinyint(1) default '1',
  `active` tinyint(1) default '1',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `category_id` bigint(20) unsigned NOT NULL default '0',
  `featured` tinyint(1) NOT NULL default '0',
  `amenities` text,
  `accommodation_type` bigint(20) unsigned NOT NULL default '1' COMMENT '1: hotel; 2: resort',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_hotel`
--

/*!40000 ALTER TABLE `tv_hotel` DISABLE KEYS */;
INSERT INTO `tv_hotel` (`id`,`name`,`alias`,`meta_title`,`meta_key`,`meta_desc`,`summary`,`highlight`,`detail`,`thumbnail`,`original_price`,`price`,`star`,`city`,`address`,`map`,`story`,`wifi`,`breakfast`,`smoking_room`,`parking`,`cable_television`,`nightclub`,`kitchenette`,`pool`,`air_conditioning`,`active`,`created_date`,`category_id`,`featured`,`amenities`,`accommodation_type`) VALUES 
 (1,'Beautiful 2 Saigon Hotel','beautiful-2-saigon-hotel','','','','<p>Nestled in the Bui Vien Street, the Beautiful Saigon 2 Hotel is located in the kingkom of Saigon</p>','<table border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td width=\"150\"><strong>General Facilities</strong></td>\r\n<td>\r\n<ul class=\"listsv\">\r\n<li class=\"vnhotels\">restaurant</li>\r\n<li class=\"vnhotels\">wi-fi in public areas</li>\r\n<li class=\"vnhotels\">safety deposit boxes</li>\r\n<li class=\"vnhotels\">smoking room</li>\r\n</ul>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td width=\"150\"><strong><strong>Internet in Rooms</strong></strong></td>\r\n<td>\r\n<ul class=\"listsv\">\r\n<li class=\"vnhotels\">internet access – LAN (complimentary)</li>\r\n<li class=\"vnhotels\">internet access – wireless</li>\r\n<li class=\"vnhotels\">internet access – wireless (complimentary)</li>\r\n<li class=\"vnhotels\">internet access - LAN</li>\r\n</ul>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td width=\"150\"><strong><strong><strong>General Services</strong></strong></strong></td>\r\n<td>\r\n<ul class=\"listsv\">\r\n<li class=\"vnhotels\">tours</li>\r\n<li class=\"vnhotels\">airport transfer</li>\r\n<li class=\"vnhotels\">laundry service</li>\r\n<li class=\"vnhotels\">dry cleaning</li>\r\n<li class=\"vnhotels\">room service</li>\r\n<li class=\"vnhotels\">concierge</li>\r\n<li class=\"vnhotels\">fax/photocopying</li>\r\n<li class=\"vnhotels\">car hire</li>\r\n<li class=\"vnhotels\">motorbike rental</li>\r\n</ul>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>','<div class=\"hd_rd-know_before\">\r\n<h2>What you need to know</h2>\r\n<ul class=\"hd_rd-misc_info clearfix\">\r\n<li class=\"chk_in\">\r\n<div class=\"property_details_checkinpolicytext\">\r\n<div class=\"content\">\r\n<div class=\"hd_rd-hotel_attribute_section_freetext_content\">\r\n<p>Extra-person charges may apply and vary depending on hotel policy. <br />Government-issued photo identification and a credit card or cash deposit are required at check-in for incidental charges. <br />Special requests are subject to availability upon check-in and may incur additional charges. Special requests cannot be guaranteed. <br /><br /></p>\r\n</div>\r\n</div>\r\n</div>\r\n</li>\r\n<li>Pets not allowed</li>\r\n<li>Minimum check-in age is: 18</li>\r\n<li>Check-out time is: Noon</li>\r\n<li>Check-in time starts at: 2 PM</li>\r\n<li>American Express: American Express</li>\r\n<li>Diners Club: Diners Club</li>\r\n<li>JCB International: JCB International</li>\r\n<li>MasterCard: MasterCard</li>\r\n<li>Visa: Visa</li>\r\n<li>No rollaway/extra beds available</li>\r\n</ul>\r\n<div class=\"hd_rd-hotel_attribute_section property_details_knowbeforego\">\r\n<div class=\"content\">\r\n<div class=\"hd_rd-hotel_attribute_section_freetext_content\">\r\n<ul>\r\n<li>Children 12 years old and younger stay free when occupying the parent or guardian\'s room, using existing bedding.</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"hd_rd-facilities\">\r\n<h2> </h2>\r\n</div>\r\n<div class=\"hd_rd-hotel_attribute_section property_details_dining\">\r\n<h2>Dining</h2>\r\n<div class=\"content\">\r\n<div class=\"hd_rd-hotel_attribute_section_freetext_content\">\r\n<p><strong>Straits Café</strong> serves international dishes and local specialties. Offering buffet breakfast, lunch, and dinner 7 days per week as well as a diverse <em>a la carte</em> menu, the restaurant is very popular with locals and visitors alike. Breakfast - 7 AM to 10.30 AM Lunch - Noon to 2.30 PM High-Tea - 3 PM to 5.30 PM (Saturday, Sunday &amp; Public Holidays only) Dinner - 6.30 PM to 10 PM Located on the ground floor of the hotel.</p>\r\n<p><strong>Palong Bar</strong> - open noon to 11 PM daily.</p>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"hd_rd-hotel_attribute_section\">\r\n<h2> </h2>\r\n<h2>Recreation</h2>\r\n<div class=\"content\">\r\n<div class=\"hd_rd-hotel_attribute_section_freetext_content\">\r\n<p>The recreational activities listed below are available either on site or nearby; fees may apply.</p>\r\n</div>\r\n<br />\r\n<ul class=\"col1 hd_rd-hotel_attribute_section_listelement_content\">\r\n<li>Aerobics nearby</li>\r\n<li>Swimming on site</li>\r\n</ul>\r\n</div>\r\n</div>\r\n<div class=\"hd_rd-hotel_attribute_section\">\r\n<h2> </h2>\r\n<h2>Notification and fees</h2>\r\n<div class=\"content\">\r\n<div class=\"hd_rd-hotel_attribute_section_freetext_content\">\r\n<p>The following fees and deposits are charged by the property at time of service, check-in, or check-out.</p>\r\n<br />\r\n<ul>\r\n<li>Breakfast fee: SGD 38.84 per person (approximately)</li>\r\n<li>Fee for in-room high-speed Internet (wired): SGD 29.43 per 24-hour period (rates may vary)</li>\r\n<li>Self parking fee: SGD 10 per day</li>\r\n</ul>\r\n<br />\r\n<p>The above list may not be comprehensive. Fees and deposits may not include tax and are subject to change.</p>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"hd_rd-hotel_attribute_section property_details_checkin\">\r\n<h2> </h2>\r\n<h2>Check-in information</h2>\r\n<div class=\"content\">\r\n<div class=\"hd_rd-hotel_attribute_section_freetext_content\">\r\n<p>Late check-out until 6 PM may be available on request; a surcharge equal to half of the daily room rate applies.</p>\r\n</div>\r\n</div>\r\n</div>\r\n<h2> </h2>\r\n<h2>Terms &amp; conditions</h2>\r\n<p>Extra-person charges may apply and vary depending on hotel policy. <br />Government-issued photo identification and a credit card or cash deposit are required at check-in for incidental charges. <br />Special requests are subject to availability upon check-in and may incur additional charges. Special requests cannot be guaranteed.</p>','/travelovietnam.com/files/upload/image/hotel.jpg',400,300,2,'1','2A-4A Tôn Đức Thắng, Hồ Chí Minh, Vietnam',NULL,'',0,0,1,1,1,1,1,1,1,1,'2013-03-23 09:08:04',1,1,'<ul>\r\n<li>Free wifi</li>\r\n<li>Free breakfast</li>\r\n<li>Smoking room</li>\r\n<li>Car parking</li>\r\n<li>Cable television</li>\r\n<li>Kitchenette</li>\r\n<li>Air conditioning</li>\r\n<li>Pool</li>\r\n<li>Nightclub</li>\r\n</ul>',1);
/*!40000 ALTER TABLE `tv_hotel` ENABLE KEYS */;


--
-- Definition of table `tv_hotel_booking`
--

DROP TABLE IF EXISTS `tv_hotel_booking`;
CREATE TABLE `tv_hotel_booking` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `hotel_id` bigint(20) unsigned NOT NULL default '0',
  `checkin` timestamp NOT NULL default '0000-00-00 00:00:00',
  `checkout` timestamp NOT NULL default '0000-00-00 00:00:00',
  `rooms` int(10) unsigned NOT NULL default '0',
  `adults` int(10) unsigned NOT NULL default '1',
  `children` int(10) unsigned NOT NULL default '0',
  `fullname` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  `phone` varchar(255) default NULL,
  `message` text,
  `payment_method` varchar(255) default NULL,
  `status` tinyint(1) NOT NULL default '0',
  `total_fee` double NOT NULL default '0',
  `booking_key` varchar(255) default NULL,
  `booking_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `user_id` bigint(20) unsigned NOT NULL default '0',
  `promotion_code` varchar(45) default NULL,
  `discount` double NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_hotel_booking`
--

/*!40000 ALTER TABLE `tv_hotel_booking` DISABLE KEYS */;
INSERT INTO `tv_hotel_booking` (`id`,`hotel_id`,`checkin`,`checkout`,`rooms`,`adults`,`children`,`fullname`,`email`,`phone`,`message`,`payment_method`,`status`,`total_fee`,`booking_key`,`booking_date`,`user_id`,`promotion_code`,`discount`) VALUES 
 (1,1,'2013-08-13 00:00:00','2013-08-14 00:00:00',1,1,0,'Le Thanh Phong','ltp_mv_huflit@yahoo.com','0933914822','','Credit Card',0,300,'hotel_c4d94bf2c5a0b3e8f9fbd58cc950ee80','2013-08-13 17:50:34',1,'',0),
 (2,1,'2013-08-13 00:00:00','2013-08-14 00:00:00',1,1,0,'Le Thanh Phong','ltp_mv_huflit@yahoo.com','0933914822','','Credit Card',0,300,'hotel_3b7a7240a2dcd004923da4fb74807b63','2013-08-13 17:56:29',1,'',0),
 (3,1,'2013-08-13 00:00:00','2013-08-14 00:00:00',1,1,0,'Le Thanh Phong','ltp_mv_huflit@yahoo.com','0933914822','','Credit Card',0,300,'hotel_5b7b583a38aa6951641426d2a6f76b6e','2013-08-13 17:56:52',1,'',0),
 (4,1,'2013-08-13 00:00:00','2013-08-14 00:00:00',1,1,0,'Le Thanh Phong','ltp_mv_huflit@yahoo.com','0933914822','','Credit Card',0,300,'hotel_2a3d0e2636beccacd7a4a414d8e62ffc','2013-08-13 18:18:52',1,'',0),
 (5,1,'2013-08-13 00:00:00','2013-08-14 00:00:00',1,1,0,'Le Thanh Phong','ltp_mv_huflit@yahoo.com','0933914822','','Credit Card',0,300,'hotel_9c91c4ba89b42997184f04189652ec0f','2013-08-13 18:18:56',1,'',0),
 (6,1,'2013-08-20 00:00:00','2013-08-23 00:00:00',1,1,0,'Le Thanh Phong','ltp_mv_huflit@yahoo.com','0933914822','','Credit Card',0,900,'hotel_be4d8eec260c22988851f79d12577148','2013-08-14 12:34:11',1,'',0),
 (7,1,'2013-08-20 00:00:00','2013-08-23 00:00:00',1,1,0,'Le Thanh Phong','ltp_mv_huflit@yahoo.com','0933914822','','Credit Card',0,900,'hotel_38b28807836b221c212e47ae3bb2d56d','2013-08-14 12:35:43',1,'',0),
 (8,1,'2013-08-20 00:00:00','2013-08-23 00:00:00',1,1,0,'Le Thanh Phong','ltp_mv_huflit@yahoo.com','0933914822','','Credit Card',0,900,'hotel_4b71b57f5b3d6d72b8d7a1d11d2e340c','2013-08-14 12:38:47',1,'',0);
/*!40000 ALTER TABLE `tv_hotel_booking` ENABLE KEYS */;


--
-- Definition of table `tv_hotel_category`
--

DROP TABLE IF EXISTS `tv_hotel_category`;
CREATE TABLE `tv_hotel_category` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `alias` varchar(255) default NULL,
  `active` tinyint(1) NOT NULL default '1',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_hotel_category`
--

/*!40000 ALTER TABLE `tv_hotel_category` DISABLE KEYS */;
INSERT INTO `tv_hotel_category` (`id`,`name`,`alias`,`active`,`created_date`) VALUES 
 (1,'Feature Hotels','feature-hotels',1,'2013-03-23 09:03:33'),
 (2,'Luxury Hotels','luxury-hotels',1,'2013-03-23 09:03:53'),
 (3,'Budget Hotels','budget-hotels',1,'2013-03-23 09:04:15');
/*!40000 ALTER TABLE `tv_hotel_category` ENABLE KEYS */;


--
-- Definition of table `tv_hotel_destination`
--

DROP TABLE IF EXISTS `tv_hotel_destination`;
CREATE TABLE `tv_hotel_destination` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `alias` varchar(255) default NULL,
  `thumbnail` varchar(255) default NULL,
  `region` varchar(255) default NULL,
  `glat` double default NULL,
  `glong` double default NULL,
  `active` tinyint(1) NOT NULL default '1',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_hotel_destination`
--

/*!40000 ALTER TABLE `tv_hotel_destination` DISABLE KEYS */;
INSERT INTO `tv_hotel_destination` (`id`,`name`,`alias`,`thumbnail`,`region`,`glat`,`glong`,`active`,`created_date`) VALUES 
 (1,'Ho Chi Minh','ho-chi-minh','http://vietnamhotels.net/data/images/city/11/1277797115',NULL,NULL,NULL,1,'2013-04-11 09:47:14'),
 (2,'Ha Noi','ha-noi','http://vietnamhotels.net/data/images/city/11/1277797115',NULL,NULL,NULL,1,'2013-04-11 09:47:06'),
 (3,'Nha Trang','nha-trang','http://vietnamhotels.net/data/images/city/11/1277797115',NULL,NULL,NULL,1,'2013-04-11 09:47:21'),
 (4,'Da Lat','da-lat','http://vietnamhotels.net/data/images/city/11/1277797115',NULL,NULL,NULL,1,'2013-04-11 09:46:54'),
 (5,'Vung Tau','vung-tau','http://vietnamhotels.net/data/images/city/11/1277797115',NULL,NULL,NULL,1,'2013-04-11 09:47:28'),
 (6,'Can Tho','can-tho','http://vietnamhotels.net/data/images/city/11/1277797115',NULL,NULL,NULL,1,'2013-04-11 09:46:28');
/*!40000 ALTER TABLE `tv_hotel_destination` ENABLE KEYS */;


--
-- Definition of table `tv_hotel_pax`
--

DROP TABLE IF EXISTS `tv_hotel_pax`;
CREATE TABLE `tv_hotel_pax` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `book_id` bigint(20) unsigned default '0',
  `fullname` varchar(255) default NULL,
  `gender` varchar(255) default NULL,
  `birthdate` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `nationality` varchar(255) default NULL,
  `passport` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_hotel_pax`
--

/*!40000 ALTER TABLE `tv_hotel_pax` DISABLE KEYS */;
INSERT INTO `tv_hotel_pax` (`id`,`book_id`,`fullname`,`gender`,`birthdate`,`nationality`,`passport`) VALUES 
 (1,3,'Phong LE','Male','1984-10-06 00:00:00','Vietnam',NULL),
 (2,4,'Phong LE','Male','1984-10-06 00:00:00','Vietnam',NULL),
 (3,5,'Phong LE','Male','1984-10-06 00:00:00','Vietnam',NULL),
 (4,6,'Phong LE','Male','2013-08-14 00:00:00','Vietnam',NULL),
 (5,7,'Phong LE','Male','2013-08-14 00:00:00','Vietnam',NULL),
 (6,8,'Phong LE','Male','2013-08-14 00:00:00','Vietnam',NULL);
/*!40000 ALTER TABLE `tv_hotel_pax` ENABLE KEYS */;


--
-- Definition of table `tv_hotel_request`
--

DROP TABLE IF EXISTS `tv_hotel_request`;
CREATE TABLE `tv_hotel_request` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `fullname` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  `phone` varchar(32) default NULL,
  `fromdate` timestamp NOT NULL default '0000-00-00 00:00:00',
  `todate` timestamp NOT NULL default '0000-00-00 00:00:00',
  `adults` int(10) unsigned default '0',
  `children` int(10) unsigned default '0',
  `message` text,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_hotel_request`
--

/*!40000 ALTER TABLE `tv_hotel_request` DISABLE KEYS */;
/*!40000 ALTER TABLE `tv_hotel_request` ENABLE KEYS */;


--
-- Definition of table `tv_hotel_room`
--

DROP TABLE IF EXISTS `tv_hotel_room`;
CREATE TABLE `tv_hotel_room` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `book_id` bigint(20) unsigned NOT NULL,
  `room_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_hotel_room`
--

/*!40000 ALTER TABLE `tv_hotel_room` DISABLE KEYS */;
INSERT INTO `tv_hotel_room` (`id`,`book_id`,`room_id`) VALUES 
 (1,2,1),
 (2,3,1),
 (3,4,1),
 (4,5,1),
 (5,6,1),
 (6,7,1),
 (7,8,1);
/*!40000 ALTER TABLE `tv_hotel_room` ENABLE KEYS */;


--
-- Definition of table `tv_mail`
--

DROP TABLE IF EXISTS `tv_mail`;
CREATE TABLE `tv_mail` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `sender` varchar(255) default NULL,
  `receiver` varchar(255) default NULL,
  `title` varchar(255) default NULL,
  `message` text,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_mail`
--

/*!40000 ALTER TABLE `tv_mail` DISABLE KEYS */;
INSERT INTO `tv_mail` (`id`,`sender`,`receiver`,`title`,`message`,`created_date`) VALUES 
 (1,'no-reply@travelovietnam.com','info@travelovietnam.com','[Report] - Beautiful 2 Saigon Hotel','Hotel: Beautiful 2 Saigon Hotel<br>Description: Hotel description<br>Photos: Photos<br>Maps: Maps<br>Other: Anything else?\r\nWe welcome all feedback','2013-06-24 11:30:38'),
 (2,'no-reply@travelovietnam.com','info@travelovietnam.com','[Report] - Beautiful 2 Saigon Hotel','Hotel: <br>Description: <br>Photos: <br>Maps: <br>Other: ','2013-06-24 11:45:32'),
 (3,'no-reply@travelovietnam.com','info@travelovietnam.com','[Report] - Beautiful 2 Saigon Hotel','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">\r\n				<html xml:lang=\"EN\" xmlns=\"http://www.w3.org/1999/xhtml\">\r\n					<head>\r\n						<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />	\r\n					</head>\r\n					<body style=\"font-family: Arial,Tahoma,sans-serif; font-size: 12px;\">\r\n						<div style=\"border: 1px solid #BBCDD9; background-color: #ECF4FD; margin: 10px; padding: 10px;\">\r\n							<div style=\"padding: 0px 0px 10px 0px;\">\r\n								<div>\r\n						<div style=\"padding: 10 0 10px 20px;\">\r\n							<table><tr><td>Name</td><td> : </td><td></td>		</table>\r\n						</div>\r\n					</div>\r\n							</div>\r\n						</div>\r\n					<body>\r\n				</html>','2013-06-24 12:06:07'),
 (4,'ltp_mv_huflit@yahoo.com','info@travelovietnam.com','BOOKING #H7: Vietnam Hotel Payment Remind - Le Thanh Phong','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">\r\n				<html xml:lang=\"EN\" xmlns=\"http://www.w3.org/1999/xhtml\">\r\n					<head>\r\n						<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />	\r\n					</head>\r\n					<body style=\"font-family: Arial,Tahoma,sans-serif; font-size: 12px;\">\r\n						<div style=\"border: 1px solid #BBCDD9; background-color: #ECF4FD; margin: 10px; padding: 10px;\">\r\n							<div style=\"padding: 0px 0px 10px 0px;\">\r\n								<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\">\r\n						<tr><td>Dear: <b>Le Thanh Phong</b></td></tr>\r\n						<tr><td>Thanks for choosing <a href=\"http://localhost/travelovietnam.com\" target=\"_blank\">TraveloVietnam</a>.</td></tr>\r\n						\r\n						<tr><td>* This is confirmation from us to show that we are reviewing your request for arranging hotel in Vietnam. But you have not paid yet. Our staff will send you payment request for your visa in 1 - 2 hours.</td></tr>\r\n						<tr><td>* Payment method: <b>Credit Card</b></td></tr>\r\n						<tr><td>* You can pay us via Paypal address: payment@vietnam-evisa.org</td></tr>\r\n						<tr><td>* For secure reason, we accept payment from third party only as: www.paypal.com or Western Union or Bank transfer. (Please do not send us your credit cards detail)</td></tr>\r\n						<tr><td><b>* Please double check for making sure your information is correctly. Any change after approved will be charged.</b></td></tr>\r\n					</table>\r\n					<br><fieldset style=\"border:1px solid #DADCE0; background-color: #FFFFFF;\">\r\n					<legend style=\"border:1px solid #DADCE0; background-color: #F6F6F6; padding: 4px\"><strong>Your Apply Visa Information Details</strong></legend>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							A. Hotel Information\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table>\r\n								<tr><td>Hotel</td><td> : </td><td>Beautiful 2 Saigon Hotel</td></tr>\r\n								<tr><td>Address</td><td> : </td><td>40/19 Bui Vien Street, Pham Ngu Lao Ward, Distrcit 1, Ho Chi Minh City, Vietnam</td></tr>\r\n								<tr><td>Checkin</td><td> : </td><td>Aug/20/2013</td></tr>\r\n								<tr><td>Checkout</td><td> : </td><td>Aug/23/2013</td></tr>\r\n								<tr><td>Number of Rooms</td><td> : </td><td>1</td></tr>\r\n								<tr><td>Number of Traveler</td><td> : </td><td>1</td></tr>\r\n								\r\n								<tr><td colspan=\"3\" style=\"border-top: 1px dotted #CCCCCC; height: 1px;\"></td></tr>\r\n								<tr><td><b>Total Services Charge</b></td><td> : </td><td><b>900 USD</b></td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							B. Room Information\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" style=\"border: 1px solid #A5CDE7;border-collapse: collapse;border-spacing: 0;margin: 0;\">\r\n								<tr>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Room</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Name</th>\r\n								</tr>\r\n								<tr><td align=\"center\" style=\"border: 1px solid #CCC;\">1</td><td style=\"border: 1px solid #CCC;\">Standard</td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							C. Traveler Information\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" style=\"border: 1px solid #A5CDE7;border-collapse: collapse;border-spacing: 0;margin: 0;\">\r\n								<tr>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Applicant</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Fullname</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Gender</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Date of Birth</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Nationality</th>\r\n								</tr>\r\n								<tr><td align=\"center\" style=\"border: 1px solid #CCC;\">1</td><td style=\"border: 1px solid #CCC;\">Phong LE</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Male</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Jan/01/1970</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Vietnam</td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							C. Contact Information\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table>\r\n								<tr><td>Primary Email</td><td> : </td><td><a href=\"mailto:\"></a></td></tr>\r\n								<tr><td>Secondary Email</td><td> : </td><td><a href=\"mailto:\"></a></td></tr>\r\n								<tr><td>Special Request</td><td> : </td><td></td></tr>\r\n								<tr><td colspan=\"2\"><a target=\"_blank\" href=\"http://whatismyipaddress.com/ip/127.0.0.1\">127.0.0.1</a></td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n				</fieldset>\r\n							</div>\r\n							<div style=\"padding: 15px 10px 0px 0px;\">\r\n								<table>\r\n									<tr><td colspan=\"3\"><b>Vietnam Visa Dept.</b></td></tr>\r\n									<tr><td>Address</td><td>:</td><td>184/1A Le Van Sy street, Phu Nhuan dist, Ho Chi Minh city, Vietnam.</td></tr>\r\n									<tr><td>Tell</td><td>:</td><td>(848) 6686 4039</td></tr>\r\n									<tr><td>Hotline</td><td>:</td><td>(+84) 909.343.525</td></tr>\r\n									<tr><td>Website</td><td>:</td><td><a href=\"http://localhost/travelovietnam.com\" target=\"_blank\">TraveloVietnam</a></td></tr>\r\n									<tr><td>Email</td><td>:</td><td><a href=\"mailto:info@travelovietnam.com\" target=\"_blank\">info@travelovietnam.com</a></td></tr>\r\n									<tr><td colspan=\"3\">WE ALWAYS 24/7 SUPPORT YOU</td></tr>\r\n								</table>\r\n							</div>\r\n						</div>\r\n					<body>\r\n				</html>','2013-08-14 11:35:43'),
 (5,'ltp_mv_huflit@yahoo.com','info@travelovietnam.com','BOOKING #H8: Vietnam Hotel Payment Remind - Le Thanh Phong','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">\r\n				<html xml:lang=\"EN\" xmlns=\"http://www.w3.org/1999/xhtml\">\r\n					<head>\r\n						<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />	\r\n					</head>\r\n					<body style=\"font-family: Arial,Tahoma,sans-serif; font-size: 12px;\">\r\n						<div style=\"border: 1px solid #BBCDD9; background-color: #ECF4FD; margin: 10px; padding: 10px;\">\r\n							<div style=\"padding: 0px 0px 10px 0px;\">\r\n								<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\">\r\n						<tr><td>Dear: <b>Le Thanh Phong</b></td></tr>\r\n						<tr><td>Thanks for choosing <a href=\"http://localhost/travelovietnam.com\" target=\"_blank\">TraveloVietnam</a>.</td></tr>\r\n						\r\n						<tr><td>* This is confirmation from us to show that we are reviewing your request for arranging hotel in Vietnam. But you have not paid yet. Our staff will send you payment request for your visa in 1 - 2 hours.</td></tr>\r\n						<tr><td>* Payment method: <b>Credit Card</b></td></tr>\r\n						<tr><td>* You can pay us via Paypal address: payment@vietnam-evisa.org</td></tr>\r\n						<tr><td>* For secure reason, we accept payment from third party only as: www.paypal.com or Western Union or Bank transfer. (Please do not send us your credit cards detail)</td></tr>\r\n						<tr><td><b>* Please double check for making sure your information is correctly. Any change after approved will be charged.</b></td></tr>\r\n					</table>\r\n					<br><fieldset style=\"border:1px solid #DADCE0; background-color: #FFFFFF;\">\r\n					<legend style=\"border:1px solid #DADCE0; background-color: #F6F6F6; padding: 4px\"><strong>Your Apply Visa Information Details</strong></legend>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							A. Hotel Information\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table>\r\n								<tr><td>Hotel</td><td> : </td><td>Beautiful 2 Saigon Hotel</td></tr>\r\n								<tr><td>Address</td><td> : </td><td>40/19 Bui Vien Street, Pham Ngu Lao Ward, Distrcit 1, Ho Chi Minh City, Vietnam</td></tr>\r\n								<tr><td>Checkin</td><td> : </td><td>Aug/20/2013</td></tr>\r\n								<tr><td>Checkout</td><td> : </td><td>Aug/23/2013</td></tr>\r\n								<tr><td>Number of Rooms</td><td> : </td><td>1</td></tr>\r\n								<tr><td>Number of Traveler</td><td> : </td><td>1</td></tr>\r\n								\r\n								<tr><td colspan=\"3\" style=\"border-top: 1px dotted #CCCCCC; height: 1px;\"></td></tr>\r\n								<tr><td><b>Total Services Charge</b></td><td> : </td><td><b>900 USD</b></td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							B. Room Information\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" style=\"border: 1px solid #A5CDE7;border-collapse: collapse;border-spacing: 0;margin: 0;\">\r\n								<tr>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Room</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Name</th>\r\n								</tr>\r\n								<tr><td align=\"center\" style=\"border: 1px solid #CCC;\">1</td><td style=\"border: 1px solid #CCC;\">Standard</td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							C. Traveler Information\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" style=\"border: 1px solid #A5CDE7;border-collapse: collapse;border-spacing: 0;margin: 0;\">\r\n								<tr>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Applicant</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Fullname</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Gender</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Date of Birth</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Nationality</th>\r\n								</tr>\r\n								<tr><td align=\"center\" style=\"border: 1px solid #CCC;\">1</td><td style=\"border: 1px solid #CCC;\">Phong LE</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Male</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Aug/14/2013</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Vietnam</td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							C. Contact Information\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table>\r\n								<tr><td>Email</td><td> : </td><td><a href=\"mailto:ltp_mv_huflit@yahoo.com\">ltp_mv_huflit@yahoo.com</a></td></tr>\r\n								<tr><td>Phone No.</td><td> : </td><td><a href=\"tel:0933914822\">0933914822</a></td></tr>\r\n								<tr><td>Additional Requirements</td><td> : </td><td></td></tr>\r\n								<tr><td colspan=\"2\"><a target=\"_blank\" href=\"http://whatismyipaddress.com/ip/127.0.0.1\">127.0.0.1</a></td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n				</fieldset>\r\n							</div>\r\n							<div style=\"padding: 15px 10px 0px 0px;\">\r\n								<table>\r\n									<tr><td colspan=\"3\"><b>Vietnam Visa Dept.</b></td></tr>\r\n									<tr><td>Address</td><td>:</td><td>184/1A Le Van Sy street, Phu Nhuan dist, Ho Chi Minh city, Vietnam.</td></tr>\r\n									<tr><td>Tell</td><td>:</td><td>(848) 6686 4039</td></tr>\r\n									<tr><td>Hotline</td><td>:</td><td>(+84) 909.343.525</td></tr>\r\n									<tr><td>Website</td><td>:</td><td><a href=\"http://localhost/travelovietnam.com\" target=\"_blank\">TraveloVietnam</a></td></tr>\r\n									<tr><td>Email</td><td>:</td><td><a href=\"mailto:info@travelovietnam.com\" target=\"_blank\">info@travelovietnam.com</a></td></tr>\r\n									<tr><td colspan=\"3\">WE ALWAYS 24/7 SUPPORT YOU</td></tr>\r\n								</table>\r\n							</div>\r\n						</div>\r\n					<body>\r\n				</html>','2013-08-14 11:38:47'),
 (6,'ltp_mv_huflit@yahoo.com','info@travelovietnam.com','BOOKING #F10: Vietnam Flight Payment Remind - Le Thanh Phong','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">\r\n				<html xml:lang=\"EN\" xmlns=\"http://www.w3.org/1999/xhtml\">\r\n					<head>\r\n						<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />	\r\n					</head>\r\n					<body style=\"font-family: Arial,Tahoma,sans-serif; font-size: 12px;\">\r\n						<div style=\"border: 1px solid #BBCDD9; background-color: #ECF4FD; margin: 10px; padding: 10px;\">\r\n							<div style=\"padding: 0px 0px 10px 0px;\">\r\n								<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\">\r\n						<tr><td>Dear: <b>Le Thanh Phong</b></td></tr>\r\n						<tr><td>Thanks for choosing <a href=\"http://localhost/travelovietnam.com\" target=\"_blank\">TraveloVietnam</a>.</td></tr>\r\n						\r\n						<tr><td>* This is confirmation from us to show that we are reviewing your request for arranging flight ticket to Vietnam. But you have not paid yet. Our staff will send you payment request for your booking in 1 - 2 hours.</td></tr>\r\n						<tr><td>* Payment method: <b>Credit Card</b></td></tr>\r\n						<tr><td>* You can pay us via Paypal address: payment@travelovietnam.com</td></tr>\r\n						<tr><td>* For secure reason, we accept payment from third party only as: www.paypal.com or Western Union or Bank transfer. (Please do not send us your credit cards detail)</td></tr>\r\n						<tr><td><b>* Please double check for making sure your information is correctly. Any change after approved will be charged.</b></td></tr>\r\n					</table>\r\n					<br><fieldset style=\"border:1px solid #DADCE0; background-color: #FFFFFF;\">\r\n					<legend style=\"border:1px solid #DADCE0; background-color: #F6F6F6; padding: 4px\"><strong>Your Apply Visa Information Details</strong></legend>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							A. Information of Visa\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table>\r\n								<tr><td>Tour</td><td> : </td><td></td></tr>\r\n								<tr><td>Duration</td><td> : </td><td> day</td></tr>\r\n								<tr><td>Number of Traveler</td><td> : </td><td>1</td></tr>\r\n								\r\n								<tr><td colspan=\"3\" style=\"border-top: 1px dotted #CCCCCC; height: 1px;\"></td></tr>\r\n								<tr><td><b>Total Services Charge</b></td><td> : </td><td><b>37 USD</b></td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							B. Passport Detail of Applications\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" style=\"border: 1px solid #A5CDE7;border-collapse: collapse;border-spacing: 0;margin: 0;\">\r\n								<tr>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Traveler</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Fullname</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Gender</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Date of Birth</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Nationality</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Departure Date</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Tour Class</th>\r\n								</tr>\r\n								<tr><td align=\"center\" style=\"border: 1px solid #CCC;\">1</td><td style=\"border: 1px solid #CCC;\">Phong LE</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Male</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Oct/01/2013</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Argentina</td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							C. Contact Information\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table>\r\n								<tr><td>Email</td><td> : </td><td><a href=\"mailto:ltp_mv_huflit@yahoo.com\">ltp_mv_huflit@yahoo.com</a></td></tr>\r\n								<tr><td>Phone No.</td><td> : </td><td><a href=\"tel:0933914822\">0933914822</a></td></tr>\r\n								<tr><td>Additional Requirements</td><td> : </td><td></td></tr>\r\n								<tr><td colspan=\"2\"><a target=\"_blank\" href=\"http://whatismyipaddress.com/ip/127.0.0.1\">127.0.0.1</a></td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n				</fieldset>\r\n							</div>\r\n							<div style=\"padding: 15px 10px 0px 0px;\">\r\n								<table>\r\n									<tr><td colspan=\"3\"><b>Vietnam Travel Dept.</b></td></tr>\r\n									<tr><td>Address</td><td>:</td><td>184/1A Le Van Sy, Phu Nhuan district, Ho Chi Minh city, Vietnam.</td></tr>\r\n									<tr><td>Tell</td><td>:</td><td>(848) 6686 4039</td></tr>\r\n									<tr><td>Hotline</td><td>:</td><td>(+84) 909.343.525</td></tr>\r\n									<tr><td>Website</td><td>:</td><td><a href=\"http://localhost/travelovietnam.com\" target=\"_blank\">TraveloVietnam</a></td></tr>\r\n									<tr><td>Email</td><td>:</td><td><a href=\"mailto:info@travelovietnam.com\" target=\"_blank\">info@travelovietnam.com</a></td></tr>\r\n									<tr><td colspan=\"3\">WE ALWAYS 24/7 SUPPORT YOU</td></tr>\r\n								</table>\r\n							</div>\r\n						</div>\r\n					<body>\r\n				</html>','2013-10-04 12:12:55'),
 (7,'ltp_mv_huflit@yahoo.com','info@travelovietnam.com','BOOKING #F13: Vietnam Flight Payment Remind - Le Thanh Phong','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">\r\n				<html xml:lang=\"EN\" xmlns=\"http://www.w3.org/1999/xhtml\">\r\n					<head>\r\n						<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />	\r\n					</head>\r\n					<body style=\"font-family: Arial,Tahoma,sans-serif; font-size: 12px;\">\r\n						<div style=\"border: 1px solid #BBCDD9; background-color: #ECF4FD; margin: 10px; padding: 10px;\">\r\n							<div style=\"padding: 0px 0px 10px 0px;\">\r\n								<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\">\r\n						<tr><td>Dear: <b>Le Thanh Phong</b></td></tr>\r\n						<tr><td>Thanks for choosing <a href=\"http://localhost/travelovietnam.com\" target=\"_blank\">TraveloVietnam</a>.</td></tr>\r\n						\r\n						<tr><td>* This is confirmation from us to show that we are reviewing your request for arranging flight ticket to Vietnam. But you have not paid yet. Our staff will send you payment request for your booking in 1 - 2 hours.</td></tr>\r\n						<tr><td>* Payment method: <b>Credit Card</b></td></tr>\r\n						<tr><td>* You can pay us via Paypal address: payment@travelovietnam.com</td></tr>\r\n						<tr><td>* For secure reason, we accept payment from third party only as: www.paypal.com or Western Union or Bank transfer. (Please do not send us your credit cards detail)</td></tr>\r\n						<tr><td><b>* Please double check for making sure your information is correctly. Any change after approved will be charged.</b></td></tr>\r\n					</table>\r\n					<br><fieldset style=\"border:1px solid #DADCE0; background-color: #FFFFFF;\">\r\n					<legend style=\"border:1px solid #DADCE0; background-color: #F6F6F6; padding: 4px\"><strong>Your Apply Visa Information Details</strong></legend>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							A. Information of Visa\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table>\r\n								<tr><td>Outbound Flight</td><td> : </td><td>Sat., Oct. 05, 2013 | Ho Chi Minh City (SGN) (SGN) to Da Nang (DAD) (DAD)</td></tr>\r\n								<tr><td>Number of Traveler</td><td> : </td><td>1</td></tr>\r\n								\r\n								<tr><td colspan=\"3\" style=\"border-top: 1px dotted #CCCCCC; height: 1px;\"></td></tr>\r\n								<tr><td><b>Total Services Charge</b></td><td> : </td><td><b>37 USD</b></td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							B. Passport Detail of Applications\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" style=\"border: 1px solid #A5CDE7;border-collapse: collapse;border-spacing: 0;margin: 0;\">\r\n								<tr>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Traveler</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Fullname</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Gender</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Date of Birth</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Nationality</th>\r\n								</tr>\r\n								<tr><td align=\"center\" style=\"border: 1px solid #CCC;\">1</td><td style=\"border: 1px solid #CCC;\">Phong LE</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Male</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Oct/01/2013</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Argentina</td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							C. Contact Information\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table>\r\n								<tr><td>Email</td><td> : </td><td><a href=\"mailto:ltp_mv_huflit@yahoo.com\">ltp_mv_huflit@yahoo.com</a></td></tr>\r\n								<tr><td>Phone No.</td><td> : </td><td><a href=\"tel:0933914822\">0933914822</a></td></tr>\r\n								<tr><td>Additional Requirements</td><td> : </td><td></td></tr>\r\n								<tr><td colspan=\"2\"><a target=\"_blank\" href=\"http://whatismyipaddress.com/ip/127.0.0.1\">127.0.0.1</a></td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n				</fieldset>\r\n							</div>\r\n							<div style=\"padding: 15px 10px 0px 0px;\">\r\n								<table>\r\n									<tr><td colspan=\"3\"><b>Vietnam Travel Dept.</b></td></tr>\r\n									<tr><td>Address</td><td>:</td><td>184/1A Le Van Sy, Phu Nhuan district, Ho Chi Minh city, Vietnam.</td></tr>\r\n									<tr><td>Tell</td><td>:</td><td>(848) 6686 4039</td></tr>\r\n									<tr><td>Hotline</td><td>:</td><td>(+84) 909.343.525</td></tr>\r\n									<tr><td>Website</td><td>:</td><td><a href=\"http://localhost/travelovietnam.com\" target=\"_blank\">TraveloVietnam</a></td></tr>\r\n									<tr><td>Email</td><td>:</td><td><a href=\"mailto:info@travelovietnam.com\" target=\"_blank\">info@travelovietnam.com</a></td></tr>\r\n									<tr><td colspan=\"3\">WE ALWAYS 24/7 SUPPORT YOU</td></tr>\r\n								</table>\r\n							</div>\r\n						</div>\r\n					<body>\r\n				</html>','2013-10-04 12:32:39'),
 (8,'info@travelovietnam.com','info@travelovietnam.com','BOOKING #T1: Vietnam Tour Payment Remind - ','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">\r\n				<html xml:lang=\"EN\" xmlns=\"http://www.w3.org/1999/xhtml\">\r\n					<head>\r\n						<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />	\r\n					</head>\r\n					<body style=\"font-family: Arial,Tahoma,sans-serif; font-size: 12px;\">\r\n						<div style=\"border: 1px solid #BBCDD9; background-color: #ECF4FD; margin: 10px; padding: 10px;\">\r\n							<div style=\"padding: 0px 0px 10px 0px;\">\r\n								<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\">\r\n						<tr><td>Dear: <b></b></td></tr>\r\n						<tr><td>Thanks for choosing <a href=\"http://localhost/travelovietnam.com\" target=\"_blank\">TraveloVietnam</a>.</td></tr>\r\n						\r\n						<tr><td>* This is confirmation from us to show that we are reviewing your request for planning tour in Vietnam. But you have not paid yet. Our staff will send you payment request for your booking in 1 - 2 hours.</td></tr>\r\n						<tr><td>* Payment method: <b></b></td></tr>\r\n						<tr><td>* You can pay us via Paypal address: payment@travelovietnam.com</td></tr>\r\n						<tr><td>* For secure reason, we accept payment from third party only as: www.paypal.com or Western Union or Bank transfer. (Please do not send us your credit cards detail)</td></tr>\r\n						<tr><td><b>* Please double check for making sure your information is correctly. Any change just contact us soon.</b></td></tr>\r\n					</table>\r\n					<br><fieldset style=\"border:1px solid #DADCE0; background-color: #FFFFFF;\">\r\n					<legend style=\"border:1px solid #DADCE0; background-color: #F6F6F6; padding: 4px\"><strong>Your Apply Visa Information Details</strong></legend>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							A. Information of Visa\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table>\r\n								<tr><td>Tour</td><td> : </td><td>Vietnam Holiday In Style</td></tr>\r\n								<tr><td>Duration</td><td> : </td><td>7 days - 6 nights</td></tr>\r\n								<tr><td>Destinations</td><td> : </td><td><a target=\"_blank\" title=\"Ha Noi, Ha Noi Vietnam, Ha Noi travel guide\" href=\"http://localhost/travelovietnam.com/tours/vietnam/ha-noi.html\">Ha Noi</a>&nbsp; &rarr; &nbsp;<a target=\"_blank\" title=\"Da Nang, Da Nang Vietnam, Da Nang travel guide\" href=\"http://localhost/travelovietnam.com/tours/vietnam/da-nang.html\">Da Nang</a>&nbsp; &rarr; &nbsp;<a target=\"_blank\" title=\"Nha Trang, Nha Trang Vietnam, Nha Trang travel guide\" href=\"http://localhost/travelovietnam.com/tours/vietnam/nha-trang.html\">Nha Trang</a>&nbsp; &rarr; &nbsp;<a target=\"_blank\" title=\"Ho Chi Minh, Ho Chi Minh Vietnam, Ho Chi Minh travel guide\" href=\"http://localhost/travelovietnam.com/tours/vietnam/ho-chi-minh.html\">Ho Chi Minh</a></td></tr>\r\n								<tr><td>Number of Traveler</td><td> : </td><td>0</td></tr>\r\n								\r\n								<tr><td colspan=\"3\" style=\"border-top: 1px dotted #CCCCCC; height: 1px;\"></td></tr>\r\n								<tr><td><b>Total Services Charge</b></td><td> : </td><td><b>0 USD</b></td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							B. Passport Detail of Applications\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" style=\"border: 1px solid #A5CDE7;border-collapse: collapse;border-spacing: 0;margin: 0;\">\r\n								<tr>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Traveler</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Fullname</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Gender</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Date of Birth</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Nationality</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Departure Date</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Tour Class</th>\r\n								</tr>\r\n								\r\n							</table>\r\n						</div>\r\n					</div>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							C. Contact Information\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table>\r\n								<tr><td>Email</td><td> : </td><td><a href=\"mailto:\"></a></td></tr>\r\n								<tr><td>Phone No.</td><td> : </td><td><a href=\"tel:\"></a></td></tr>\r\n								<tr><td>Additional Requirements</td><td> : </td><td></td></tr>\r\n								<tr><td colspan=\"2\"><a target=\"_blank\" href=\"http://whatismyipaddress.com/ip/127.0.0.1\">127.0.0.1</a></td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n				</fieldset>\r\n							</div>\r\n							<div style=\"padding: 15px 10px 0px 0px;\">\r\n								<table>\r\n									<tr><td colspan=\"3\"><b>Vietnam Travel Dept.</b></td></tr>\r\n									<tr><td>Address</td><td>:</td><td>184/1A Le Van Sy, Phu Nhuan district, Ho Chi Minh city, Vietnam.</td></tr>\r\n									<tr><td>Tell</td><td>:</td><td>(848) 6686 4039</td></tr>\r\n									<tr><td>Hotline</td><td>:</td><td>(+84) 909.343.525</td></tr>\r\n									<tr><td>Website</td><td>:</td><td><a href=\"http://localhost/travelovietnam.com\" target=\"_blank\">TraveloVietnam</a></td></tr>\r\n									<tr><td>Email</td><td>:</td><td><a href=\"mailto:info@travelovietnam.com\" target=\"_blank\">info@travelovietnam.com</a></td></tr>\r\n									<tr><td colspan=\"3\">WE ALWAYS 24/7 SUPPORT YOU</td></tr>\r\n								</table>\r\n							</div>\r\n						</div>\r\n					<body>\r\n				</html>','2013-10-30 16:31:30'),
 (9,'ltp_mv_huflit@yahoo.com','info@travelovietnam.com','BOOKING #T2: Vietnam Tour Payment Remind - Le Thanh Phong','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">\r\n				<html xml:lang=\"EN\" xmlns=\"http://www.w3.org/1999/xhtml\">\r\n					<head>\r\n						<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />	\r\n					</head>\r\n					<body style=\"font-family: Arial,Tahoma,sans-serif; font-size: 12px;\">\r\n						<div style=\"border: 1px solid #BBCDD9; background-color: #ECF4FD; margin: 10px; padding: 10px;\">\r\n							<div style=\"padding: 0px 0px 10px 0px;\">\r\n								<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\">\r\n						<tr><td>Dear: <b>Le Thanh Phong</b></td></tr>\r\n						<tr><td>Thanks for choosing <a href=\"http://localhost/travelovietnam.com\" target=\"_blank\">TraveloVietnam</a>.</td></tr>\r\n						\r\n						<tr><td>* This is confirmation from us to show that we are reviewing your request for planning tour in Vietnam. But you have not paid yet. Our staff will send you payment request for your booking in 1 - 2 hours.</td></tr>\r\n						<tr><td>* Payment method: <b></b></td></tr>\r\n						<tr><td>* You can pay us via Paypal address: payment@travelovietnam.com</td></tr>\r\n						<tr><td>* For secure reason, we accept payment from third party only as: www.paypal.com or Western Union or Bank transfer. (Please do not send us your credit cards detail)</td></tr>\r\n						<tr><td><b>* Please double check for making sure your information is correctly. Any change just contact us soon.</b></td></tr>\r\n					</table>\r\n					<br><fieldset style=\"border:1px solid #DADCE0; background-color: #FFFFFF;\">\r\n					<legend style=\"border:1px solid #DADCE0; background-color: #F6F6F6; padding: 4px\"><strong>Your Apply Visa Information Details</strong></legend>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							A. Information of Visa\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table>\r\n								<tr><td>Tour</td><td> : </td><td>Vietnam Holiday In Style</td></tr>\r\n								<tr><td>Duration</td><td> : </td><td>7 days - 6 nights</td></tr>\r\n								<tr><td>Destinations</td><td> : </td><td><a target=\"_blank\" title=\"Ha Noi, Ha Noi Vietnam, Ha Noi travel guide\" href=\"http://localhost/travelovietnam.com/tours/vietnam/ha-noi.html\">Ha Noi</a>&nbsp; &rarr; &nbsp;<a target=\"_blank\" title=\"Da Nang, Da Nang Vietnam, Da Nang travel guide\" href=\"http://localhost/travelovietnam.com/tours/vietnam/da-nang.html\">Da Nang</a>&nbsp; &rarr; &nbsp;<a target=\"_blank\" title=\"Nha Trang, Nha Trang Vietnam, Nha Trang travel guide\" href=\"http://localhost/travelovietnam.com/tours/vietnam/nha-trang.html\">Nha Trang</a>&nbsp; &rarr; &nbsp;<a target=\"_blank\" title=\"Ho Chi Minh, Ho Chi Minh Vietnam, Ho Chi Minh travel guide\" href=\"http://localhost/travelovietnam.com/tours/vietnam/ho-chi-minh.html\">Ho Chi Minh</a></td></tr>\r\n								<tr><td>Number of Traveler</td><td> : </td><td>0</td></tr>\r\n								\r\n								<tr><td colspan=\"3\" style=\"border-top: 1px dotted #CCCCCC; height: 1px;\"></td></tr>\r\n								<tr><td><b>Total Services Charge</b></td><td> : </td><td><b>800 USD</b></td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							B. Passport Detail of Applications\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" style=\"border: 1px solid #A5CDE7;border-collapse: collapse;border-spacing: 0;margin: 0;\">\r\n								<tr>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Traveler</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Fullname</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Gender</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Date of Birth</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Nationality</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Departure Date</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Tour Class</th>\r\n								</tr>\r\n								\r\n							</table>\r\n						</div>\r\n					</div>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							C. Contact Information\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table>\r\n								<tr><td>Email</td><td> : </td><td><a href=\"mailto:ltp_mv_huflit@yahoo.com\">ltp_mv_huflit@yahoo.com</a></td></tr>\r\n								<tr><td>Phone No.</td><td> : </td><td><a href=\"tel:\"></a></td></tr>\r\n								<tr><td>Additional Requirements</td><td> : </td><td></td></tr>\r\n								<tr><td colspan=\"2\"><a target=\"_blank\" href=\"http://whatismyipaddress.com/ip/127.0.0.1\">127.0.0.1</a></td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n				</fieldset>\r\n							</div>\r\n							<div style=\"padding: 15px 10px 0px 0px;\">\r\n								<table>\r\n									<tr><td colspan=\"3\"><b>Vietnam Travel Dept.</b></td></tr>\r\n									<tr><td>Address</td><td>:</td><td>184/1A Le Van Sy, Phu Nhuan district, Ho Chi Minh city, Vietnam.</td></tr>\r\n									<tr><td>Tell</td><td>:</td><td>(848) 6686 4039</td></tr>\r\n									<tr><td>Hotline</td><td>:</td><td>(+84) 909.343.525</td></tr>\r\n									<tr><td>Website</td><td>:</td><td><a href=\"http://localhost/travelovietnam.com\" target=\"_blank\">TraveloVietnam</a></td></tr>\r\n									<tr><td>Email</td><td>:</td><td><a href=\"mailto:info@travelovietnam.com\" target=\"_blank\">info@travelovietnam.com</a></td></tr>\r\n									<tr><td colspan=\"3\">WE ALWAYS 24/7 SUPPORT YOU</td></tr>\r\n								</table>\r\n							</div>\r\n						</div>\r\n					<body>\r\n				</html>','2013-11-01 11:46:42'),
 (10,'ltp_mv_huflit@yahoo.com','info@travelovietnam.com','BOOKING #T3: Vietnam Tour Payment Remind - Le Thanh Phong','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">\r\n				<html xml:lang=\"EN\" xmlns=\"http://www.w3.org/1999/xhtml\">\r\n					<head>\r\n						<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />	\r\n					</head>\r\n					<body style=\"font-family: Arial,Tahoma,sans-serif; font-size: 12px;\">\r\n						<div style=\"border: 1px solid #BBCDD9; background-color: #ECF4FD; margin: 10px; padding: 10px;\">\r\n							<div style=\"padding: 0px 0px 10px 0px;\">\r\n								<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\">\r\n						<tr><td>Dear: <b>Le Thanh Phong</b></td></tr>\r\n						<tr><td>Thanks for choosing <a href=\"http://localhost/travelovietnam.com\" target=\"_blank\">TraveloVietnam</a>.</td></tr>\r\n						\r\n						<tr><td>* This is confirmation from us to show that we are reviewing your request for planning tour in Vietnam. But you have not paid yet. Our staff will send you payment request for your booking in 1 - 2 hours.</td></tr>\r\n						<tr><td>* Payment method: <b></b></td></tr>\r\n						<tr><td>* You can pay us via Paypal address: payment@travelovietnam.com</td></tr>\r\n						<tr><td>* For secure reason, we accept payment from third party only as: www.paypal.com or Western Union or Bank transfer. (Please do not send us your credit cards detail)</td></tr>\r\n						<tr><td><b>* Please double check for making sure your information is correctly. Any change just contact us soon.</b></td></tr>\r\n					</table>\r\n					<br><fieldset style=\"border:1px solid #DADCE0; background-color: #FFFFFF;\">\r\n					<legend style=\"border:1px solid #DADCE0; background-color: #F6F6F6; padding: 4px\"><strong>Your Apply Visa Information Details</strong></legend>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							A. Information of Visa\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table>\r\n								<tr><td>Tour</td><td> : </td><td>Vietnam Holiday In Style</td></tr>\r\n								<tr><td>Duration</td><td> : </td><td>7 days - 6 nights</td></tr>\r\n								<tr><td>Destinations</td><td> : </td><td><a target=\"_blank\" title=\"Ha Noi, Ha Noi Vietnam, Ha Noi travel guide\" href=\"http://localhost/travelovietnam.com/tours/vietnam/ha-noi.html\">Ha Noi</a>&nbsp; &rarr; &nbsp;<a target=\"_blank\" title=\"Da Nang, Da Nang Vietnam, Da Nang travel guide\" href=\"http://localhost/travelovietnam.com/tours/vietnam/da-nang.html\">Da Nang</a>&nbsp; &rarr; &nbsp;<a target=\"_blank\" title=\"Nha Trang, Nha Trang Vietnam, Nha Trang travel guide\" href=\"http://localhost/travelovietnam.com/tours/vietnam/nha-trang.html\">Nha Trang</a>&nbsp; &rarr; &nbsp;<a target=\"_blank\" title=\"Ho Chi Minh, Ho Chi Minh Vietnam, Ho Chi Minh travel guide\" href=\"http://localhost/travelovietnam.com/tours/vietnam/ho-chi-minh.html\">Ho Chi Minh</a></td></tr>\r\n								<tr><td>Number of Traveler</td><td> : </td><td>2</td></tr>\r\n								\r\n								<tr><td colspan=\"3\" style=\"border-top: 1px dotted #CCCCCC; height: 1px;\"></td></tr>\r\n								<tr><td><b>Total Services Charge</b></td><td> : </td><td><b>880 USD</b></td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							B. Passport Detail of Applications\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" style=\"border: 1px solid #A5CDE7;border-collapse: collapse;border-spacing: 0;margin: 0;\">\r\n								<tr>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Traveler</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Fullname</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Gender</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Date of Birth</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Nationality</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Departure Date</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Tour Class</th>\r\n								</tr>\r\n								<tr><td align=\"center\" style=\"border: 1px solid #CCC;\">1</td><td style=\"border: 1px solid #CCC;\"></td><td align=\"center\" style=\"border: 1px solid #CCC;\">Male</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Nov/04/2013</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Afghanistan</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Jan/01/1970</td><td style=\"border: 1px solid #CCC;\"></td></tr><tr><td align=\"center\" style=\"border: 1px solid #CCC;\">2</td><td style=\"border: 1px solid #CCC;\"></td><td align=\"center\" style=\"border: 1px solid #CCC;\">Male</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Nov/04/2013</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Afghanistan</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Jan/01/1970</td><td style=\"border: 1px solid #CCC;\"></td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							C. Contact Information\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table>\r\n								<tr><td>Email</td><td> : </td><td><a href=\"mailto:ltp_mv_huflit@yahoo.com\">ltp_mv_huflit@yahoo.com</a></td></tr>\r\n								<tr><td>Phone No.</td><td> : </td><td><a href=\"tel:\"></a></td></tr>\r\n								<tr><td>Additional Requirements</td><td> : </td><td></td></tr>\r\n								<tr><td colspan=\"2\"><a target=\"_blank\" href=\"http://whatismyipaddress.com/ip/127.0.0.1\">127.0.0.1</a></td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n				</fieldset>\r\n							</div>\r\n							<div style=\"padding: 15px 10px 0px 0px;\">\r\n								<table>\r\n									<tr><td colspan=\"3\"><b>Vietnam Travel Dept.</b></td></tr>\r\n									<tr><td>Address</td><td>:</td><td>184/1A Le Van Sy, Phu Nhuan district, Ho Chi Minh city, Vietnam.</td></tr>\r\n									<tr><td>Tell</td><td>:</td><td>(848) 6686 4039</td></tr>\r\n									<tr><td>Hotline</td><td>:</td><td>(+84) 909.343.525</td></tr>\r\n									<tr><td>Website</td><td>:</td><td><a href=\"http://localhost/travelovietnam.com\" target=\"_blank\">TraveloVietnam</a></td></tr>\r\n									<tr><td>Email</td><td>:</td><td><a href=\"mailto:info@travelovietnam.com\" target=\"_blank\">info@travelovietnam.com</a></td></tr>\r\n									<tr><td colspan=\"3\">WE ALWAYS 24/7 SUPPORT YOU</td></tr>\r\n								</table>\r\n							</div>\r\n						</div>\r\n					<body>\r\n				</html>','2013-11-01 13:22:55'),
 (11,'ltp_mv_huflit@yahoo.com','info@travelovietnam.com','[Tour][Request] #TR2: Le Thanh Phong','<p><strong>Contactform applicant:</strong></p>\r\n				<table border=\"0\" cellpadding=\"0\">\r\n					<tbody>\r\n						<tr>\r\n							<td>\r\n								<p><em>Name</em>:</p>\r\n							</td>\r\n							<td>\r\n								<p>Le Thanh Phong</p>\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td>\r\n								<p><em>Email</em>:</p>\r\n							</td>\r\n							<td>\r\n								<p><a href=\"mailto:ltp_mv_huflit@yahoo.com\">ltp_mv_huflit@yahoo.com</a></p>\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td>\r\n								<p><em>Phone number</em>:</p>\r\n							</td>\r\n							<td>\r\n								<p>0933914822</p>\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td>\r\n								<p><em>From date</em>:</p>\r\n							</td>\r\n							<td>\r\n								<p></p>\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td>\r\n								<p><em>To date</em>:</p>\r\n							</td>\r\n							<td>\r\n								<p></p>\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td>\r\n								<p><em>Adults</em>:</p>\r\n							</td>\r\n							<td>\r\n								<p></p>\r\n							</td>\r\n						</tr>\r\n						<tr>\r\n							<td>\r\n								<p><em>Children</em>:</p>\r\n							</td>\r\n							<td>\r\n								<p></p>\r\n							</td>\r\n						</tr>\r\n					</tbody>\r\n				</table>\r\n				<p><br /> <strong>Message:</strong><br /> H</p>','2013-11-04 17:49:11'),
 (12,'info@travelovietnam.com','info@travelovietnam.com','[Tour][Request] #TR4: ','<p><strong>Contactform applicant:</strong></p>\r\n				<table border=\"0\" cellpadding=\"0\">\r\n					<tbody>\r\n						<tr>\r\n							<td>\r\n								<p><em>Reference</em>:</p>\r\n							</td>\r\n							<td>\r\n								<p>http://localhost/travelovietnam.com/vietnam/top-destinations/can-tho.html</p>\r\n							</td>\r\n						</tr>\r\n					</tbody>\r\n				</table>\r\n				<p><br /> <strong>Message:</strong><br /> </p>','2013-11-21 14:20:01'),
 (13,'info@travelovietnam.com','info@travelovietnam.com','[Tour][Request] #TR5: ','<p><strong>Contactform applicant:</strong></p>\r\n				<table border=\"0\" cellpadding=\"0\">\r\n					<tbody>\r\n						<tr>\r\n							<td>\r\n								<p><em>Reference</em>:</p>\r\n							</td>\r\n							<td>\r\n								<p>http://localhost/travelovietnam.com/vietnam/top-destinations/can-tho.html</p>\r\n							</td>\r\n						</tr>\r\n					</tbody>\r\n				</table>\r\n				<p><br /> <strong>Message:</strong><br /> </p>','2013-11-21 14:20:10'),
 (14,'ltp_mv_huflit@yahoo.com','info@travelovietnam.com','BOOKING #T3: Confirm Vietnam Tour  Payment Successful - Le Thanh Phong','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">\r\n				<html xml:lang=\"EN\" xmlns=\"http://www.w3.org/1999/xhtml\">\r\n					<head>\r\n						<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />	\r\n					</head>\r\n					<body style=\"font-family: Arial,Tahoma,sans-serif; font-size: 12px;\">\r\n						<div style=\"border: 1px solid #BBCDD9; background-color: #ECF4FD; margin: 10px; padding: 10px;\">\r\n							<div style=\"padding: 0px 0px 10px 0px;\">\r\n								<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\">\r\n						<tr><td>Dear: <b>Le Thanh Phong</b></td></tr>\r\n						<tr><td>Thanks for choosing <a href=\"http://localhost/travelovietnam.com\" target=\"_blank\">TraveloVietnam.Com</a>.</td></tr>\r\n						\r\n						<tr><td>* Payment successful via <b></b> payment gate.</td></tr>\r\n						<tr><td><b>* Please double check for making sure your information is correctly. Any change just contact us soon.</b></td></tr>\r\n					</table>\r\n					<br><fieldset style=\"border:1px solid #DADCE0; background-color: #FFFFFF;\">\r\n					<legend style=\"border:1px solid #DADCE0; background-color: #F6F6F6; padding: 4px\"><strong>Your Trip Information Details</strong></legend>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							A. Tour Information\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table>\r\n								<tr><td>Tour</td><td> : </td><td>Vietnam Holiday In Style</td></tr>\r\n								<tr><td>Tour Code</td><td> : </td><td>XYZ123</td></tr>\r\n								<tr><td>Duration</td><td> : </td><td>7 days - 6 nights</td></tr>\r\n								<tr><td>Destinations</td><td> : </td><td><a target=\"_blank\" title=\"Ha Noi, Ha Noi Vietnam, Ha Noi travel guide\" href=\"http://localhost/travelovietnam.com/vietnam/top-destinations/ha-noi.html\">Ha Noi</a>&nbsp; &rarr; &nbsp;<a target=\"_blank\" title=\"Da Nang, Da Nang Vietnam, Da Nang travel guide\" href=\"http://localhost/travelovietnam.com/vietnam/top-destinations/da-nang.html\">Da Nang</a>&nbsp; &rarr; &nbsp;<a target=\"_blank\" title=\"Nha Trang, Nha Trang Vietnam, Nha Trang travel guide\" href=\"http://localhost/travelovietnam.com/vietnam/top-destinations/nha-trang.html\">Nha Trang</a>&nbsp; &rarr; &nbsp;<a target=\"_blank\" title=\"Ho Chi Minh, Ho Chi Minh Vietnam, Ho Chi Minh travel guide\" href=\"http://localhost/travelovietnam.com/vietnam/top-destinations/ho-chi-minh.html\">Ho Chi Minh</a></td></tr>\r\n								<tr><td>Departure Date</td><td> : </td><td>Thu, Jan 01, 1970</td></tr>\r\n								<tr><td>Class Type</td><td> : </td><td></td></tr>\r\n								<tr><td>Number of Adults</td><td> : </td><td>2</td></tr>\r\n								<tr><td>Number of Children</td><td> : </td><td>0</td></tr>\r\n								<tr><td>Number of Infants</td><td> : </td><td>0</td></tr>\r\n								\r\n								<tr><td colspan=\"3\" style=\"border-top: 1px dotted #CCCCCC; height: 1px;\"></td></tr>\r\n								<tr><td><b>Total Services Charge</b></td><td> : </td><td><b>880 USD</b></td></tr>\r\n								<tr><td><b></b></td><td> : </td><td><b>0 USD</b></td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							B. Traveler Information\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" style=\"border: 1px solid #A5CDE7;border-collapse: collapse;border-spacing: 0;margin: 0;\">\r\n								<tr>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Traveler</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Fullname</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Gender</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Date of Birth</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Nationality</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Supplement</th>\r\n								</tr>\r\n								<tr><td align=\"center\" style=\"border: 1px solid #CCC;\">1</td><td style=\"border: 1px solid #CCC;\"></td><td align=\"center\" style=\"border: 1px solid #CCC;\">Male</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Nov/04/2013</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Afghanistan</td><td style=\"border: 1px solid #CCC;\">0</td></tr><tr><td align=\"center\" style=\"border: 1px solid #CCC;\">2</td><td style=\"border: 1px solid #CCC;\"></td><td align=\"center\" style=\"border: 1px solid #CCC;\">Male</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Nov/04/2013</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Afghanistan</td><td style=\"border: 1px solid #CCC;\">0</td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							C. Contact Information\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table>\r\n								<tr><td>Full Name</td><td> : </td><td>Le Thanh Phong</td></tr>\r\n								<tr><td>Email</td><td> : </td><td><a href=\"mailto:ltp_mv_huflit@yahoo.com\">ltp_mv_huflit@yahoo.com</a></td></tr>\r\n								<tr><td>Phone No.</td><td> : </td><td><a href=\"tel:\"></a></td></tr>\r\n								<tr><td>Additional Requirements</td><td> : </td><td></td></tr>\r\n								<tr><td colspan=\"2\"><a target=\"_blank\" href=\"http://whatismyipaddress.com/ip/127.0.0.1\">127.0.0.1</a></td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n				</fieldset>\r\n							</div>\r\n							<div style=\"padding: 15px 10px 0px 0px;\">\r\n								<table>\r\n									<tr><td colspan=\"3\"><b>Vietnam Travel Dept.</b></td></tr>\r\n									<tr><td>Address</td><td>:</td><td>184/1A Le Van Sy, Phu Nhuan district, Ho Chi Minh city, Vietnam.</td></tr>\r\n									<tr><td>Tell</td><td>:</td><td>(848) 6686 4039</td></tr>\r\n									<tr><td>Hotline</td><td>:</td><td>(+84) 909.343.525</td></tr>\r\n									<tr><td>Website</td><td>:</td><td><a href=\"http://localhost/travelovietnam.com\" target=\"_blank\">TraveloVietnam.Com</a></td></tr>\r\n									<tr><td>Email</td><td>:</td><td><a href=\"mailto:info@travelovietnam.com\" target=\"_blank\">info@travelovietnam.com</a></td></tr>\r\n									<tr><td colspan=\"3\">WE ALWAYS 24/7 SUPPORT YOU</td></tr>\r\n								</table>\r\n							</div>\r\n						</div>\r\n					<body>\r\n				</html>','2014-01-10 08:56:04'),
 (15,'ltp_mv_huflit@yahoo.com','info@travelovietnam.com','BOOKING #T3: Confirm Vietnam Tour  Payment Successful - Le Thanh Phong','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">\r\n				<html xml:lang=\"EN\" xmlns=\"http://www.w3.org/1999/xhtml\">\r\n					<head>\r\n						<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />	\r\n					</head>\r\n					<body style=\"font-family: Arial,Tahoma,sans-serif; font-size: 12px;\">\r\n						<div style=\"border: 1px solid #BBCDD9; background-color: #ECF4FD; margin: 10px; padding: 10px;\">\r\n							<div style=\"padding: 0px 0px 10px 0px;\">\r\n								<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\">\r\n						<tr><td>Dear: <b>Le Thanh Phong</b></td></tr>\r\n						<tr><td>Thanks for choosing <a href=\"http://localhost/travelovietnam.com\" target=\"_blank\">TraveloVietnam.Com</a>.</td></tr>\r\n						\r\n						<tr><td>* Payment successful via <b></b> payment gate.</td></tr>\r\n						<tr><td><b>* Please double check for making sure your information is correctly. Any change just contact us soon.</b></td></tr>\r\n					</table>\r\n					<br><fieldset style=\"border:1px solid #DADCE0; background-color: #FFFFFF;\">\r\n					<legend style=\"border:1px solid #DADCE0; background-color: #F6F6F6; padding: 4px\"><strong>Your Trip Information Details</strong></legend>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							A. Tour Information\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table>\r\n								<tr><td>Tour</td><td> : </td><td>Vietnam Holiday In Style</td></tr>\r\n								<tr><td>Tour Code</td><td> : </td><td>XYZ123</td></tr>\r\n								<tr><td>Duration</td><td> : </td><td>7 days - 6 nights</td></tr>\r\n								<tr><td>Destinations</td><td> : </td><td><a target=\"_blank\" title=\"Ha Noi, Ha Noi Vietnam, Ha Noi travel guide\" href=\"http://localhost/travelovietnam.com/vietnam/top-destinations/ha-noi.html\">Ha Noi</a>&nbsp; &rarr; &nbsp;<a target=\"_blank\" title=\"Da Nang, Da Nang Vietnam, Da Nang travel guide\" href=\"http://localhost/travelovietnam.com/vietnam/top-destinations/da-nang.html\">Da Nang</a>&nbsp; &rarr; &nbsp;<a target=\"_blank\" title=\"Nha Trang, Nha Trang Vietnam, Nha Trang travel guide\" href=\"http://localhost/travelovietnam.com/vietnam/top-destinations/nha-trang.html\">Nha Trang</a>&nbsp; &rarr; &nbsp;<a target=\"_blank\" title=\"Ho Chi Minh, Ho Chi Minh Vietnam, Ho Chi Minh travel guide\" href=\"http://localhost/travelovietnam.com/vietnam/top-destinations/ho-chi-minh.html\">Ho Chi Minh</a></td></tr>\r\n								<tr><td>Departure Date</td><td> : </td><td>Thu, Jan 01, 1970</td></tr>\r\n								<tr><td>Class Type</td><td> : </td><td></td></tr>\r\n								<tr><td>Number of Adults</td><td> : </td><td>2</td></tr>\r\n								<tr><td>Number of Children</td><td> : </td><td>0</td></tr>\r\n								<tr><td>Number of Infants</td><td> : </td><td>0</td></tr>\r\n								\r\n								<tr><td colspan=\"3\" style=\"border-top: 1px dotted #CCCCCC; height: 1px;\"></td></tr>\r\n								<tr><td><b>Total Services Charge</b></td><td> : </td><td><b>880 USD</b></td></tr>\r\n								<tr><td><b></b></td><td> : </td><td><b>0 USD</b></td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							B. Traveler Information\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" style=\"border: 1px solid #A5CDE7;border-collapse: collapse;border-spacing: 0;margin: 0;\">\r\n								<tr>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Traveler</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Fullname</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Gender</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Date of Birth</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Nationality</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Supplement</th>\r\n								</tr>\r\n								<tr><td align=\"center\" style=\"border: 1px solid #CCC;\">1</td><td style=\"border: 1px solid #CCC;\"></td><td align=\"center\" style=\"border: 1px solid #CCC;\">Male</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Nov/04/2013</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Afghanistan</td><td style=\"border: 1px solid #CCC;\">0</td></tr><tr><td align=\"center\" style=\"border: 1px solid #CCC;\">2</td><td style=\"border: 1px solid #CCC;\"></td><td align=\"center\" style=\"border: 1px solid #CCC;\">Male</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Nov/04/2013</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Afghanistan</td><td style=\"border: 1px solid #CCC;\">0</td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							C. Contact Information\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table>\r\n								<tr><td>Full Name</td><td> : </td><td>Le Thanh Phong</td></tr>\r\n								<tr><td>Email</td><td> : </td><td><a href=\"mailto:ltp_mv_huflit@yahoo.com\">ltp_mv_huflit@yahoo.com</a></td></tr>\r\n								<tr><td>Phone No.</td><td> : </td><td><a href=\"tel:\"></a></td></tr>\r\n								<tr><td>Additional Requirements</td><td> : </td><td></td></tr>\r\n								<tr><td colspan=\"2\"><a target=\"_blank\" href=\"http://whatismyipaddress.com/ip/127.0.0.1\">127.0.0.1</a></td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n				</fieldset>\r\n							</div>\r\n							<div style=\"padding: 15px 10px 0px 0px;\">\r\n								<table>\r\n									<tr><td colspan=\"3\"><b>Vietnam Travel Dept.</b></td></tr>\r\n									<tr><td>Address</td><td>:</td><td>184/1A Le Van Sy, Phu Nhuan district, Ho Chi Minh city, Vietnam.</td></tr>\r\n									<tr><td>Tell</td><td>:</td><td>(848) 6686 4039</td></tr>\r\n									<tr><td>Hotline</td><td>:</td><td>(+84) 909.343.525</td></tr>\r\n									<tr><td>Website</td><td>:</td><td><a href=\"http://localhost/travelovietnam.com\" target=\"_blank\">TraveloVietnam.Com</a></td></tr>\r\n									<tr><td>Email</td><td>:</td><td><a href=\"mailto:info@travelovietnam.com\" target=\"_blank\">info@travelovietnam.com</a></td></tr>\r\n									<tr><td colspan=\"3\">WE ALWAYS 24/7 SUPPORT YOU</td></tr>\r\n								</table>\r\n							</div>\r\n						</div>\r\n					<body>\r\n				</html>','2014-01-10 08:56:05'),
 (16,'ltp_mv_huflit@yahoo.com','info@travelovietnam.com','BOOKING #T3: Confirm Vietnam Tour  Payment Failure - Le Thanh Phong','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">\r\n				<html xml:lang=\"EN\" xmlns=\"http://www.w3.org/1999/xhtml\">\r\n					<head>\r\n						<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />	\r\n					</head>\r\n					<body style=\"font-family: Arial,Tahoma,sans-serif; font-size: 12px;\">\r\n						<div style=\"border: 1px solid #BBCDD9; background-color: #ECF4FD; margin: 10px; padding: 10px;\">\r\n							<div style=\"padding: 0px 0px 10px 0px;\">\r\n								<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\">\r\n						<tr><td>Dear: <b>Le Thanh Phong</b></td></tr>\r\n						<tr><td>Thanks for choosing <a href=\"http://localhost/travelovietnam.com\" target=\"_blank\">TraveloVietnam.Com</a>.</td></tr>\r\n						\r\n						<tr><td>* This is confirmation from us to show that you was not successful to booking our services in this case. Because you can not settle the payment with our system. May your credit card issue some where and you are way from there. Or some reason for security. So you can chose paypal method for this case. It may help you better.</td></tr>\r\n						<tr><td>* Payment unsuccessful via <b></b> payment gate.</td></tr>\r\n						<tr><td>* Or we will send you the Payment Request in 1-2 hours with multiple Methods of Payment. You can chose and pay us for your booking. Hope this more convenience for you.</td></tr>\r\n						<tr><td><b>* Please double check for making sure your information is correctly. Any change just contact us soon.</b></td></tr>\r\n					</table>\r\n					<br><fieldset style=\"border:1px solid #DADCE0; background-color: #FFFFFF;\">\r\n					<legend style=\"border:1px solid #DADCE0; background-color: #F6F6F6; padding: 4px\"><strong>Your Trip Information Details</strong></legend>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							A. Tour Information\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table>\r\n								<tr><td>Tour</td><td> : </td><td>Vietnam Holiday In Style</td></tr>\r\n								<tr><td>Tour Code</td><td> : </td><td>XYZ123</td></tr>\r\n								<tr><td>Duration</td><td> : </td><td>7 days - 6 nights</td></tr>\r\n								<tr><td>Destinations</td><td> : </td><td><a target=\"_blank\" title=\"Ha Noi, Ha Noi Vietnam, Ha Noi travel guide\" href=\"http://localhost/travelovietnam.com/vietnam/top-destinations/ha-noi.html\">Ha Noi</a>&nbsp; &rarr; &nbsp;<a target=\"_blank\" title=\"Da Nang, Da Nang Vietnam, Da Nang travel guide\" href=\"http://localhost/travelovietnam.com/vietnam/top-destinations/da-nang.html\">Da Nang</a>&nbsp; &rarr; &nbsp;<a target=\"_blank\" title=\"Nha Trang, Nha Trang Vietnam, Nha Trang travel guide\" href=\"http://localhost/travelovietnam.com/vietnam/top-destinations/nha-trang.html\">Nha Trang</a>&nbsp; &rarr; &nbsp;<a target=\"_blank\" title=\"Ho Chi Minh, Ho Chi Minh Vietnam, Ho Chi Minh travel guide\" href=\"http://localhost/travelovietnam.com/vietnam/top-destinations/ho-chi-minh.html\">Ho Chi Minh</a></td></tr>\r\n								<tr><td>Departure Date</td><td> : </td><td>Thu, Jan 01, 1970</td></tr>\r\n								<tr><td>Class Type</td><td> : </td><td></td></tr>\r\n								<tr><td>Number of Adults</td><td> : </td><td>2</td></tr>\r\n								<tr><td>Number of Children</td><td> : </td><td>0</td></tr>\r\n								<tr><td>Number of Infants</td><td> : </td><td>0</td></tr>\r\n								\r\n								<tr><td colspan=\"3\" style=\"border-top: 1px dotted #CCCCCC; height: 1px;\"></td></tr>\r\n								<tr><td><b>Total Services Charge</b></td><td> : </td><td><b>880 USD</b></td></tr>\r\n								<tr><td><b></b></td><td> : </td><td><b>0 USD</b></td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							B. Traveler Information\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" style=\"border: 1px solid #A5CDE7;border-collapse: collapse;border-spacing: 0;margin: 0;\">\r\n								<tr>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Traveler</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Fullname</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Gender</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Date of Birth</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Nationality</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Supplement</th>\r\n								</tr>\r\n								<tr><td align=\"center\" style=\"border: 1px solid #CCC;\">1</td><td style=\"border: 1px solid #CCC;\"></td><td align=\"center\" style=\"border: 1px solid #CCC;\">Male</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Nov/04/2013</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Afghanistan</td><td style=\"border: 1px solid #CCC;\">0</td></tr><tr><td align=\"center\" style=\"border: 1px solid #CCC;\">2</td><td style=\"border: 1px solid #CCC;\"></td><td align=\"center\" style=\"border: 1px solid #CCC;\">Male</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Nov/04/2013</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Afghanistan</td><td style=\"border: 1px solid #CCC;\">0</td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							C. Contact Information\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table>\r\n								<tr><td>Full Name</td><td> : </td><td>Le Thanh Phong</td></tr>\r\n								<tr><td>Email</td><td> : </td><td><a href=\"mailto:ltp_mv_huflit@yahoo.com\">ltp_mv_huflit@yahoo.com</a></td></tr>\r\n								<tr><td>Phone No.</td><td> : </td><td><a href=\"tel:\"></a></td></tr>\r\n								<tr><td>Additional Requirements</td><td> : </td><td></td></tr>\r\n								<tr><td colspan=\"2\"><a target=\"_blank\" href=\"http://whatismyipaddress.com/ip/127.0.0.1\">127.0.0.1</a></td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n				</fieldset>\r\n							</div>\r\n							<div style=\"padding: 15px 10px 0px 0px;\">\r\n								<table>\r\n									<tr><td colspan=\"3\"><b>Vietnam Travel Dept.</b></td></tr>\r\n									<tr><td>Address</td><td>:</td><td>184/1A Le Van Sy, Phu Nhuan district, Ho Chi Minh city, Vietnam.</td></tr>\r\n									<tr><td>Tell</td><td>:</td><td>(848) 6686 4039</td></tr>\r\n									<tr><td>Hotline</td><td>:</td><td>(+84) 909.343.525</td></tr>\r\n									<tr><td>Website</td><td>:</td><td><a href=\"http://localhost/travelovietnam.com\" target=\"_blank\">TraveloVietnam.Com</a></td></tr>\r\n									<tr><td>Email</td><td>:</td><td><a href=\"mailto:info@travelovietnam.com\" target=\"_blank\">info@travelovietnam.com</a></td></tr>\r\n									<tr><td colspan=\"3\">WE ALWAYS 24/7 SUPPORT YOU</td></tr>\r\n								</table>\r\n							</div>\r\n						</div>\r\n					<body>\r\n				</html>','2014-01-10 09:04:42'),
 (17,'ltp_mv_huflit@yahoo.com','info@travelovietnam.com','BOOKING #T3: Confirm Vietnam Tour  Payment Failure - Le Thanh Phong','<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">\r\n				<html xml:lang=\"EN\" xmlns=\"http://www.w3.org/1999/xhtml\">\r\n					<head>\r\n						<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />	\r\n					</head>\r\n					<body style=\"font-family: Arial,Tahoma,sans-serif; font-size: 12px;\">\r\n						<div style=\"border: 1px solid #BBCDD9; background-color: #ECF4FD; margin: 10px; padding: 10px;\">\r\n							<div style=\"padding: 0px 0px 10px 0px;\">\r\n								<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\">\r\n						<tr><td>Dear: <b>Le Thanh Phong</b></td></tr>\r\n						<tr><td>Thanks for choosing <a href=\"http://localhost/travelovietnam.com\" target=\"_blank\">TraveloVietnam.Com</a>.</td></tr>\r\n						\r\n						<tr><td>* This is confirmation from us to show that you was not successful to booking our services in this case. Because you can not settle the payment with our system. May your credit card issue some where and you are way from there. Or some reason for security. So you can chose paypal method for this case. It may help you better.</td></tr>\r\n						<tr><td>* Payment unsuccessful via <b></b> payment gate.</td></tr>\r\n						<tr><td>* Or we will send you the Payment Request in 1-2 hours with multiple Methods of Payment. You can chose and pay us for your booking. Hope this more convenience for you.</td></tr>\r\n						<tr><td><b>* Please double check for making sure your information is correctly. Any change just contact us soon.</b></td></tr>\r\n					</table>\r\n					<br><fieldset style=\"border:1px solid #DADCE0; background-color: #FFFFFF;\">\r\n					<legend style=\"border:1px solid #DADCE0; background-color: #F6F6F6; padding: 4px\"><strong>Your Trip Information Details</strong></legend>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							A. Tour Information\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table>\r\n								<tr><td>Tour</td><td> : </td><td>Vietnam Holiday In Style</td></tr>\r\n								<tr><td>Tour Code</td><td> : </td><td>XYZ123</td></tr>\r\n								<tr><td>Duration</td><td> : </td><td>7 days - 6 nights</td></tr>\r\n								<tr><td>Destinations</td><td> : </td><td><a target=\"_blank\" title=\"Ha Noi, Ha Noi Vietnam, Ha Noi travel guide\" href=\"http://localhost/travelovietnam.com/vietnam/top-destinations/ha-noi.html\">Ha Noi</a>&nbsp; &rarr; &nbsp;<a target=\"_blank\" title=\"Da Nang, Da Nang Vietnam, Da Nang travel guide\" href=\"http://localhost/travelovietnam.com/vietnam/top-destinations/da-nang.html\">Da Nang</a>&nbsp; &rarr; &nbsp;<a target=\"_blank\" title=\"Nha Trang, Nha Trang Vietnam, Nha Trang travel guide\" href=\"http://localhost/travelovietnam.com/vietnam/top-destinations/nha-trang.html\">Nha Trang</a>&nbsp; &rarr; &nbsp;<a target=\"_blank\" title=\"Ho Chi Minh, Ho Chi Minh Vietnam, Ho Chi Minh travel guide\" href=\"http://localhost/travelovietnam.com/vietnam/top-destinations/ho-chi-minh.html\">Ho Chi Minh</a></td></tr>\r\n								<tr><td>Departure Date</td><td> : </td><td>Thu, Jan 01, 1970</td></tr>\r\n								<tr><td>Class Type</td><td> : </td><td></td></tr>\r\n								<tr><td>Number of Adults</td><td> : </td><td>2</td></tr>\r\n								<tr><td>Number of Children</td><td> : </td><td>0</td></tr>\r\n								<tr><td>Number of Infants</td><td> : </td><td>0</td></tr>\r\n								\r\n								<tr><td colspan=\"3\" style=\"border-top: 1px dotted #CCCCCC; height: 1px;\"></td></tr>\r\n								<tr><td><b>Total Services Charge</b></td><td> : </td><td><b>880 USD</b></td></tr>\r\n								<tr><td><b></b></td><td> : </td><td><b>0 USD</b></td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							B. Traveler Information\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table cellpadding=\"4\" cellspacing=\"0\" border=\"0\" style=\"border: 1px solid #A5CDE7;border-collapse: collapse;border-spacing: 0;margin: 0;\">\r\n								<tr>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Traveler</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Fullname</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Gender</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Date of Birth</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Nationality</th>\r\n									<th style=\"background-color: #ECF4FD;border: 1px solid #A5CDE7;font-weight: normal;text-align: center;vertical-align: middle;\">Supplement</th>\r\n								</tr>\r\n								<tr><td align=\"center\" style=\"border: 1px solid #CCC;\">1</td><td style=\"border: 1px solid #CCC;\"></td><td align=\"center\" style=\"border: 1px solid #CCC;\">Male</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Nov/04/2013</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Afghanistan</td><td style=\"border: 1px solid #CCC;\">0</td></tr><tr><td align=\"center\" style=\"border: 1px solid #CCC;\">2</td><td style=\"border: 1px solid #CCC;\"></td><td align=\"center\" style=\"border: 1px solid #CCC;\">Male</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Nov/04/2013</td><td align=\"center\" style=\"border: 1px solid #CCC;\">Afghanistan</td><td style=\"border: 1px solid #CCC;\">0</td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n					<div>\r\n						<div style=\"color: #005286;font-weight: bold;padding: 10px 0 10px 20px;\">\r\n							C. Contact Information\r\n						</div>\r\n						<div style=\"padding: 0 0 10px 40px;\">\r\n							<table>\r\n								<tr><td>Full Name</td><td> : </td><td>Le Thanh Phong</td></tr>\r\n								<tr><td>Email</td><td> : </td><td><a href=\"mailto:ltp_mv_huflit@yahoo.com\">ltp_mv_huflit@yahoo.com</a></td></tr>\r\n								<tr><td>Phone No.</td><td> : </td><td><a href=\"tel:\"></a></td></tr>\r\n								<tr><td>Additional Requirements</td><td> : </td><td></td></tr>\r\n								<tr><td colspan=\"2\"><a target=\"_blank\" href=\"http://whatismyipaddress.com/ip/127.0.0.1\">127.0.0.1</a></td></tr>\r\n							</table>\r\n						</div>\r\n					</div>\r\n				</fieldset>\r\n							</div>\r\n							<div style=\"padding: 15px 10px 0px 0px;\">\r\n								<table>\r\n									<tr><td colspan=\"3\"><b>Vietnam Travel Dept.</b></td></tr>\r\n									<tr><td>Address</td><td>:</td><td>184/1A Le Van Sy, Phu Nhuan district, Ho Chi Minh city, Vietnam.</td></tr>\r\n									<tr><td>Tell</td><td>:</td><td>(848) 6686 4039</td></tr>\r\n									<tr><td>Hotline</td><td>:</td><td>(+84) 909.343.525</td></tr>\r\n									<tr><td>Website</td><td>:</td><td><a href=\"http://localhost/travelovietnam.com\" target=\"_blank\">TraveloVietnam.Com</a></td></tr>\r\n									<tr><td>Email</td><td>:</td><td><a href=\"mailto:info@travelovietnam.com\" target=\"_blank\">info@travelovietnam.com</a></td></tr>\r\n									<tr><td colspan=\"3\">WE ALWAYS 24/7 SUPPORT YOU</td></tr>\r\n								</table>\r\n							</div>\r\n						</div>\r\n					<body>\r\n				</html>','2014-01-10 09:04:43');
INSERT INTO `tv_mail` (`id`,`sender`,`receiver`,`title`,`message`,`created_date`) VALUES 
 (18,'info@travelovietnam.com','info@travelovietnam.com','Test ticket','Test ticket','2014-02-13 17:31:08');
/*!40000 ALTER TABLE `tv_mail` ENABLE KEYS */;


--
-- Definition of table `tv_message`
--

DROP TABLE IF EXISTS `tv_message`;
CREATE TABLE `tv_message` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `fullname` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  `phone` varchar(32) default NULL,
  `message` text,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_message`
--

/*!40000 ALTER TABLE `tv_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `tv_message` ENABLE KEYS */;


--
-- Definition of table `tv_meta`
--

DROP TABLE IF EXISTS `tv_meta`;
CREATE TABLE `tv_meta` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `url` varchar(255) NOT NULL,
  `title` varchar(255) default NULL,
  `keywords` varchar(255) default NULL,
  `description` varchar(255) default NULL,
  `active` tinyint(1) NOT NULL default '1',
  `canonical` varchar(255) default NULL,
  `addition_tags` text,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_meta`
--

/*!40000 ALTER TABLE `tv_meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `tv_meta` ENABLE KEYS */;


--
-- Definition of table `tv_nation`
--

DROP TABLE IF EXISTS `tv_nation`;
CREATE TABLE `tv_nation` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `alias` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=226 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_nation`
--

/*!40000 ALTER TABLE `tv_nation` DISABLE KEYS */;
INSERT INTO `tv_nation` (`id`,`name`,`alias`) VALUES 
 (11,'Andorra','andorra'),
 (12,'United Arab Emirates','united-arab-emirates'),
 (13,'Afghanistan','afghanistan'),
 (14,'Antigua and Barbuda','antigua-and-barbuda'),
 (15,'Anguilla','anguilla'),
 (16,'Albania','albania'),
 (17,'Netherlands Antilles','netherlands-antilles'),
 (18,'Angola','angola'),
 (19,'Antarctica','antarctica'),
 (20,'Argentina','argentina'),
 (21,'American Samoa','american-samoa'),
 (22,'Austria','austria'),
 (23,'Australia','australia'),
 (24,'Aruba','aruba'),
 (25,'Bosnia and Herzegovina','bosnia-and-herzegovina'),
 (26,'Barbados','barbados'),
 (27,'Bangladesh','bangladesh'),
 (28,'Belgium','belgium'),
 (29,'Burkina Faso','burkina-faso'),
 (30,'Bulgaria','bulgaria'),
 (31,'Bahrain','bahrain'),
 (32,'Burundi','burundi'),
 (33,'Benin','benin'),
 (34,'Bermuda','bermuda'),
 (35,'Brunei','brunei'),
 (36,'Bolivia','bolivia'),
 (37,'Brazil','brazil'),
 (38,'Bahamas','bahamas'),
 (39,'Bhutan','bhutan'),
 (40,'Botswana','botswana'),
 (41,'Belize','belize'),
 (42,'Canada','canada'),
 (43,'Cocos Keeling Islands','cocos-keeling-islands'),
 (44,'Central African Republic','central-african-republic'),
 (45,'Congo','congo'),
 (46,'Switzerland','switzerland'),
 (47,'Ivory Coast','ivory-coast'),
 (48,'Cook Islands','cook-islands'),
 (49,'Chile','chile'),
 (50,'Cameroon','cameroon'),
 (51,'China','china'),
 (52,'Colombia','colombia'),
 (53,'Costa Rica','costa-rica'),
 (54,'Cape Verde','cape-verde'),
 (55,'Christmas Island','christmas-island'),
 (56,'Cyprus','cyprus'),
 (57,'Czech Republic','czech-republic'),
 (58,'Germany','germany'),
 (59,'Djibouti','djibouti'),
 (60,'Denmark','denmark'),
 (61,'Dominica','dominica'),
 (62,'Dominican Republic','dominican-republic'),
 (63,'Algeria','algeria'),
 (64,'Ecuador','ecuador'),
 (65,'Estonia','estonia'),
 (66,'Egypt','egypt'),
 (67,'Enderbury Islands','enderbury-islands'),
 (68,'Spain and Canary Islands','spain-and-canary-islands'),
 (69,'Ethiopia','ethiopia'),
 (70,'Finland','finland'),
 (71,'Fiji','fiji'),
 (72,'Falkland Islands','falkland-islands'),
 (73,'Micronesia','micronesia'),
 (74,'Faroe Islands','faroe-islands'),
 (75,'France','france'),
 (76,'Gabon','gabon'),
 (77,'United Kingdom','united-kingdom'),
 (78,'Grenada','grenada'),
 (79,'French Guiana','french-guiana'),
 (80,'Ghana','ghana'),
 (81,'Gibraltar','gibraltar'),
 (82,'Greenland','greenland'),
 (83,'Gambia','gambia'),
 (84,'Guinea','guinea'),
 (85,'Guadeloupe and Martinique','guadeloupe-and-martinique'),
 (86,'Equatorial Guinea','equatorial-guinea'),
 (87,'Greece','greece'),
 (88,'Guatemala','guatemala'),
 (89,'Guam','guam'),
 (90,'Guinea Bissau','guinea-bissau'),
 (91,'Guyana','guyana'),
 (92,'Hong Kong','hong-kong'),
 (93,'Honduras','honduras'),
 (94,'Croatia','croatia'),
 (95,'Haiti','haiti'),
 (96,'Hungary','hungary'),
 (97,'Indonesia','indonesia'),
 (98,'Ireland','ireland'),
 (99,'Israel','israel'),
 (100,'India','india'),
 (101,'Iraq','iraq'),
 (102,'Iran','iran'),
 (103,'Iceland','iceland'),
 (104,'Italy','italy'),
 (105,'Jamaica','jamaica'),
 (106,'Jordan','jordan'),
 (107,'Japan','japan'),
 (108,'Kenya','kenya'),
 (109,'Cambodia','cambodia'),
 (110,'Kirbati','kirbati'),
 (111,'Comoros','comoros'),
 (112,'St Kitts','st-kitts'),
 (113,'Korea Dem Peoples Rep','korea-dem-peoples-rep'),
 (114,'Korea Repof','korea-repof'),
 (115,'Kuwait','kuwait'),
 (116,'Cayman Islands','cayman-islands'),
 (117,'Lao Peoples Dem Rep','lao-peoples-dem-rep'),
 (118,'Lebanon','lebanon'),
 (119,'Saint Lucia','saint-lucia'),
 (120,'Sri Lanka','sri-lanka'),
 (121,'Liberia','liberia'),
 (122,'Lesotho','lesotho'),
 (123,'Lithuania','lithuania'),
 (124,'Luxembourg','luxembourg'),
 (125,'Latvia','latvia'),
 (126,'Morocco','morocco'),
 (127,'Monaco','monaco'),
 (128,'Moldova','moldova'),
 (129,'Madagascar','madagascar'),
 (130,'Marshall Islands','marshall-islands'),
 (131,'Mali','mali'),
 (132,'Myanmar','myanmar'),
 (133,'Mongolia','mongolia'),
 (134,'Macau','macau'),
 (135,'Northern Mariana Islands','northern-mariana-islands'),
 (136,'Martinique','martinique'),
 (137,'Mauritania','mauritania'),
 (138,'Montserrat','montserrat'),
 (139,'Malta','malta'),
 (140,'Mauritius','mauritius'),
 (141,'Maldives','maldives'),
 (142,'Malawi','malawi'),
 (143,'Mexico','mexico'),
 (144,'Malaysia','malaysia'),
 (145,'Mozambique','mozambique'),
 (146,'Namibia','namibia'),
 (147,'New Caledonia','new-caledonia'),
 (148,'Niger','niger'),
 (149,'Norfolk Island','norfolk-island'),
 (150,'Nigeria','nigeria'),
 (151,'Nicaragua','nicaragua'),
 (152,'Netherlands','netherlands'),
 (153,'Norway','norway'),
 (154,'Nepal','nepal'),
 (155,'Nauru','nauru'),
 (156,'Niue','niue'),
 (157,'New Zealand','new-zealand'),
 (158,'Oman','oman'),
 (159,'Panama','panama'),
 (160,'Peru','peru'),
 (161,'French Polynesia','french-polynesia'),
 (162,'Papua New Guinea','papua-new-guinea'),
 (163,'Philippines','philippines'),
 (164,'Pakistan','pakistan'),
 (165,'Poland','poland'),
 (166,'St Pierre and Miquelon','st-pierre-and-miquelon'),
 (167,'Puerto Rico','puerto-rico'),
 (168,'Portugal','portugal'),
 (169,'Palau','palau'),
 (170,'Paraguay','paraguay'),
 (171,'Qatar','qatar'),
 (172,'Reunion','reunion'),
 (173,'Romania','romania'),
 (174,'Russian Federation','russian-federation'),
 (175,'Rwanda','rwanda'),
 (176,'Saudi Arabia','saudi-arabia'),
 (177,'Solomon Islands','solomon-islands'),
 (178,'Seychelles Islands','seychelles-islands'),
 (179,'Sudan','sudan'),
 (180,'Sweden','sweden'),
 (181,'Singapore','singapore'),
 (182,'St Helena','st-helena'),
 (183,'Slovenia','slovenia'),
 (184,'Slovakia','slovakia'),
 (185,'Sierra Leone','sierra-leone'),
 (186,'San Marino','san-marino'),
 (187,'Senegal','senegal'),
 (188,'Somalia','somalia'),
 (189,'Suriname','suriname'),
 (190,'Sao Tome and Principe','sao-tome-and-principe'),
 (191,'El Salvador','el-salvador'),
 (192,'Syria','syria'),
 (193,'Swaziland','swaziland'),
 (194,'Turks and Caicos Islands','turks-and-caicos-islands'),
 (195,'Chad','chad'),
 (196,'Togo','togo'),
 (197,'Thailand','thailand'),
 (198,'Tunisia','tunisia'),
 (199,'Tonga','tonga'),
 (200,'Turkey','turkey'),
 (201,'Trinidad and Tobago','trinidad-and-tobago'),
 (202,'Tuvalu','tuvalu'),
 (203,'Taiwan','taiwan'),
 (204,'Tanzania','tanzania'),
 (205,'Ukraine','ukraine'),
 (206,'Uganda','uganda'),
 (207,'US Minor Outlying Islands','us-minor-outlying-islands'),
 (208,'United States','united-states'),
 (209,'Uruguay','uruguay'),
 (210,'Grenadines St Vincent','grenadines-st-vincent'),
 (211,'Venezuela','venezuela'),
 (212,'Virgin Islands British','virgin-islands-british'),
 (213,'Virgin Islands US','virgin-islands-us'),
 (214,'Vietnam','vietnam'),
 (215,'Vanuatu','vanuatu'),
 (216,'Wallis and Futuna Islands','wallis-and-futuna-islands'),
 (217,'Samoa Western','samoa-western'),
 (218,'Mayotte','mayotte'),
 (219,'Yemen','yemen'),
 (220,'Yugoslavia','yugoslavia'),
 (221,'South Africa','south-africa'),
 (222,'Zambia','zambia'),
 (223,'Zaire','zaire'),
 (224,'Zimbabwe','zimbabwe'),
 (225,'Cuba','cuba');
/*!40000 ALTER TABLE `tv_nation` ENABLE KEYS */;


--
-- Definition of table `tv_photo`
--

DROP TABLE IF EXISTS `tv_photo`;
CREATE TABLE `tv_photo` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `ref_id` bigint(20) unsigned default NULL,
  `category_id` bigint(20) unsigned default NULL COMMENT '0: gallery; 1: tour; 3:hotel; 5: Cuisine; 7: News; 9: Destination',
  `name` varchar(255) default NULL,
  `description` text,
  `file_path` varchar(255) default NULL,
  `order_num` int(10) unsigned NOT NULL default '0',
  `active` tinyint(1) NOT NULL default '1',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_photo`
--

/*!40000 ALTER TABLE `tv_photo` DISABLE KEYS */;
INSERT INTO `tv_photo` (`id`,`ref_id`,`category_id`,`name`,`description`,`file_path`,`order_num`,`active`,`created_date`) VALUES 
 (1,1,1,'Vietnam Tour Image','Vietnam Tour Image','/travelovietnam.com/files/upload/image/travel-detail.jpg',0,1,'2013-03-16 08:09:06'),
 (2,1,1,'Land Tour','Vietnam Tour Image','/travelovietnam.com/files/upload/image/travel-detail.jpg',0,1,'2013-03-27 04:28:10'),
 (3,1,3,'Saigon','Saigon','/travelovietnam.com/files/upload/image/travel-detail.jpg',0,1,'2013-04-03 06:17:01'),
 (4,1,3,'Saigon2','Saigon2','/travelovietnam.com/files/upload/image/travel-detail.jpg',0,1,'2013-04-03 06:17:09'),
 (5,1,9,'Can Tho 1','Visit Can Tho now','/travelovietnam.com/files/upload/image/home.jpg',0,1,'2013-11-21 11:23:30');
/*!40000 ALTER TABLE `tv_photo` ENABLE KEYS */;


--
-- Definition of table `tv_promotion_txt`
--

DROP TABLE IF EXISTS `tv_promotion_txt`;
CREATE TABLE `tv_promotion_txt` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `sender` varchar(255) default NULL,
  `sender_email` varchar(255) default NULL,
  `emails` text,
  `subject` varchar(255) default NULL,
  `content` text,
  `active` tinyint(1) NOT NULL default '1',
  `create_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_promotion_txt`
--

/*!40000 ALTER TABLE `tv_promotion_txt` DISABLE KEYS */;
/*!40000 ALTER TABLE `tv_promotion_txt` ENABLE KEYS */;


--
-- Definition of table `tv_question`
--

DROP TABLE IF EXISTS `tv_question`;
CREATE TABLE `tv_question` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `title` varchar(255) default NULL,
  `alias` varchar(255) default NULL,
  `content` text,
  `author` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  `ref_id` bigint(20) unsigned default NULL,
  `category_id` bigint(20) unsigned default NULL,
  `parent_id` bigint(20) unsigned default NULL,
  `active` tinyint(1) default '1',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_question`
--

/*!40000 ALTER TABLE `tv_question` DISABLE KEYS */;
/*!40000 ALTER TABLE `tv_question` ENABLE KEYS */;


--
-- Definition of table `tv_redirect`
--

DROP TABLE IF EXISTS `tv_redirect`;
CREATE TABLE `tv_redirect` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `from_url` varchar(255) default NULL,
  `to_url` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tv_redirect`
--

/*!40000 ALTER TABLE `tv_redirect` DISABLE KEYS */;
/*!40000 ALTER TABLE `tv_redirect` ENABLE KEYS */;


--
-- Definition of table `tv_requirement`
--

DROP TABLE IF EXISTS `tv_requirement`;
CREATE TABLE `tv_requirement` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `citizen` varchar(255) default NULL,
  `alias` varchar(255) default NULL,
  `title` varchar(255) default NULL,
  `content` text,
  `active` tinyint(1) default '1',
  `status` varchar(1000) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_requirement`
--

/*!40000 ALTER TABLE `tv_requirement` DISABLE KEYS */;
/*!40000 ALTER TABLE `tv_requirement` ENABLE KEYS */;


--
-- Definition of table `tv_restaurant`
--

DROP TABLE IF EXISTS `tv_restaurant`;
CREATE TABLE `tv_restaurant` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) default NULL,
  `thumbnail` varchar(255) default NULL,
  `city` bigint(20) unsigned NOT NULL default '0',
  `address` varchar(255) default NULL,
  `gmap_address` varchar(255) default NULL,
  `area` varchar(255) default NULL,
  `open_time` varchar(255) default NULL,
  `content_type` varchar(255) default NULL,
  `summary` text,
  `content` text,
  `order_num` bigint(20) unsigned NOT NULL default '0',
  `catid` bigint(20) unsigned NOT NULL default '0',
  `meta_title` varchar(255) default NULL,
  `meta_key` varchar(255) default NULL,
  `meta_desc` varchar(255) default NULL,
  `lang` varchar(255) NOT NULL default 'EN',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_restaurant`
--

/*!40000 ALTER TABLE `tv_restaurant` DISABLE KEYS */;
/*!40000 ALTER TABLE `tv_restaurant` ENABLE KEYS */;


--
-- Definition of table `tv_restaurant_category`
--

DROP TABLE IF EXISTS `tv_restaurant_category`;
CREATE TABLE `tv_restaurant_category` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `alias` varchar(255) default NULL,
  `parent_id` bigint(20) unsigned default NULL,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_restaurant_category`
--

/*!40000 ALTER TABLE `tv_restaurant_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `tv_restaurant_category` ENABLE KEYS */;


--
-- Definition of table `tv_review`
--

DROP TABLE IF EXISTS `tv_review`;
CREATE TABLE `tv_review` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `author` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  `nationality` varchar(255) default NULL,
  `title` varchar(255) default NULL,
  `content` varchar(2000) default NULL,
  `rating` int(10) unsigned NOT NULL default '3',
  `category_id` int(10) unsigned NOT NULL default '0' COMMENT '1: Tour; 3: Hotel; 5: Cuisine; 7: News; 9: Destination; 11:Video',
  `ref_id` bigint(20) unsigned NOT NULL default '0',
  `parent_id` bigint(20) unsigned NOT NULL default '0',
  `active` tinyint(1) NOT NULL default '0',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_review`
--

/*!40000 ALTER TABLE `tv_review` DISABLE KEYS */;
INSERT INTO `tv_review` (`id`,`author`,`email`,`nationality`,`title`,`content`,`rating`,`category_id`,`ref_id`,`parent_id`,`active`,`created_date`) VALUES 
 (5,'Le Thanh Phong','ltp_mv_huflit@yahoo.com','Vietnam','Wonderful SaiGon nights','I will come back SaiGon soon.',4,1,1,0,1,'2013-04-07 07:10:09');
/*!40000 ALTER TABLE `tv_review` ENABLE KEYS */;


--
-- Definition of table `tv_room`
--

DROP TABLE IF EXISTS `tv_room`;
CREATE TABLE `tv_room` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `hotel_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) default NULL,
  `room_type` varchar(255) default NULL,
  `detail` text,
  `original_price` double NOT NULL default '0',
  `price` double default '0',
  `extra_bed` double default '0',
  `active` tinyint(1) unsigned NOT NULL default '1',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `breakfast` tinyint(1) unsigned NOT NULL default '0',
  `wifi` tinyint(1) unsigned NOT NULL default '0',
  `policies` text,
  `thumbnail` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_room`
--

/*!40000 ALTER TABLE `tv_room` DISABLE KEYS */;
INSERT INTO `tv_room` (`id`,`hotel_id`,`name`,`room_type`,`detail`,`original_price`,`price`,`extra_bed`,`active`,`created_date`,`breakfast`,`wifi`,`policies`,`thumbnail`) VALUES 
 (1,1,'Standard','Single','<p>20 sqm; Comfortable, cozy and quiet standard room on the top of the building with sound roof window (Euro window) and balcony; private bath room with nice hot shower room. This room type accommodates up to 2 guests (1 double bed)</p>',0,300,0,1,'2013-06-13 06:19:55',0,0,NULL,NULL);
/*!40000 ALTER TABLE `tv_room` ENABLE KEYS */;


--
-- Definition of table `tv_room_rate`
--

DROP TABLE IF EXISTS `tv_room_rate`;
CREATE TABLE `tv_room_rate` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `room_id` bigint(20) unsigned NOT NULL,
  `rate_date` varchar(32) default NULL,
  `original_price` double NOT NULL default '0',
  `price` double NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1485 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_room_rate`
--

/*!40000 ALTER TABLE `tv_room_rate` DISABLE KEYS */;
INSERT INTO `tv_room_rate` (`id`,`room_id`,`rate_date`,`original_price`,`price`) VALUES 
 (1114,1,'1_MON',0,100),
 (1115,1,'1_TUE',0,100),
 (1116,1,'1_WED',0,100),
 (1117,1,'1_THU',0,100),
 (1118,1,'1_FRI',0,100),
 (1119,1,'1_SAT',0,100),
 (1120,1,'1_SUN',0,100),
 (1121,1,'2_MON',0,100),
 (1122,1,'2_TUE',0,100),
 (1123,1,'2_WED',0,100),
 (1124,1,'2_THU',0,100),
 (1125,1,'2_FRI',0,100),
 (1126,1,'2_SAT',0,100),
 (1127,1,'2_SUN',0,100),
 (1128,1,'3_MON',0,100),
 (1129,1,'3_TUE',0,100),
 (1130,1,'3_WED',0,100),
 (1131,1,'3_THU',0,100),
 (1132,1,'3_FRI',0,100),
 (1133,1,'3_SAT',0,100),
 (1134,1,'3_SUN',0,300),
 (1135,1,'4_MON',0,100),
 (1136,1,'4_TUE',0,100),
 (1137,1,'4_WED',0,100),
 (1138,1,'4_THU',0,100),
 (1139,1,'4_FRI',0,100),
 (1140,1,'4_SAT',0,100),
 (1141,1,'4_SUN',0,100),
 (1142,1,'5_MON',0,100),
 (1143,1,'5_TUE',0,100),
 (1144,1,'5_WED',0,100),
 (1145,1,'5_THU',0,100),
 (1146,1,'5_FRI',0,100),
 (1147,1,'5_SAT',0,100),
 (1148,1,'5_SUN',0,100),
 (1149,1,'6_MON',0,100),
 (1150,1,'6_TUE',0,100),
 (1151,1,'6_WED',0,100),
 (1152,1,'6_THU',0,100),
 (1153,1,'6_FRI',0,100),
 (1154,1,'6_SAT',0,100),
 (1155,1,'6_SUN',0,100),
 (1156,1,'7_MON',0,100),
 (1157,1,'7_TUE',0,100),
 (1158,1,'7_WED',0,100),
 (1159,1,'7_THU',0,100),
 (1160,1,'7_FRI',0,100),
 (1161,1,'7_SAT',0,100),
 (1162,1,'7_SUN',0,100),
 (1163,1,'8_MON',0,100),
 (1164,1,'8_TUE',0,100),
 (1165,1,'8_WED',0,100),
 (1166,1,'8_THU',0,100),
 (1167,1,'8_FRI',0,100),
 (1168,1,'8_SAT',0,100),
 (1169,1,'8_SUN',0,100),
 (1170,1,'9_MON',0,100),
 (1171,1,'9_TUE',0,100),
 (1172,1,'9_WED',0,100),
 (1173,1,'9_THU',0,100),
 (1174,1,'9_FRI',0,100),
 (1175,1,'9_SAT',0,100),
 (1176,1,'9_SUN',0,100),
 (1177,1,'10_MON',0,100),
 (1178,1,'10_TUE',0,100),
 (1179,1,'10_WED',0,100),
 (1180,1,'10_THU',0,100),
 (1181,1,'10_FRI',0,100),
 (1182,1,'10_SAT',0,100),
 (1183,1,'10_SUN',0,100),
 (1184,1,'11_MON',0,100),
 (1185,1,'11_TUE',0,100),
 (1186,1,'11_WED',0,100),
 (1187,1,'11_THU',0,100),
 (1188,1,'11_FRI',0,100),
 (1189,1,'11_SAT',0,100),
 (1190,1,'11_SUN',0,100),
 (1191,1,'12_MON',0,100),
 (1192,1,'12_TUE',0,100),
 (1193,1,'12_WED',0,100),
 (1194,1,'12_THU',0,100),
 (1195,1,'12_FRI',0,100),
 (1196,1,'12_SAT',0,100),
 (1197,1,'12_SUN',0,100),
 (1198,1,'13_MON',0,100),
 (1199,1,'13_TUE',0,100),
 (1200,1,'13_WED',0,100),
 (1201,1,'13_THU',0,100),
 (1202,1,'13_FRI',0,100),
 (1203,1,'13_SAT',0,100),
 (1204,1,'13_SUN',0,100),
 (1205,1,'14_MON',0,100),
 (1206,1,'14_TUE',0,100),
 (1207,1,'14_WED',0,100),
 (1208,1,'14_THU',0,100),
 (1209,1,'14_FRI',0,100),
 (1210,1,'14_SAT',0,100),
 (1211,1,'14_SUN',0,100),
 (1212,1,'15_MON',0,100),
 (1213,1,'15_TUE',0,100),
 (1214,1,'15_WED',0,100),
 (1215,1,'15_THU',0,100),
 (1216,1,'15_FRI',0,100),
 (1217,1,'15_SAT',0,100),
 (1218,1,'15_SUN',0,100),
 (1219,1,'16_MON',0,100),
 (1220,1,'16_TUE',0,100),
 (1221,1,'16_WED',0,100),
 (1222,1,'16_THU',0,100),
 (1223,1,'16_FRI',0,100),
 (1224,1,'16_SAT',0,100),
 (1225,1,'16_SUN',0,100),
 (1226,1,'17_MON',0,100),
 (1227,1,'17_TUE',0,100),
 (1228,1,'17_WED',0,100),
 (1229,1,'17_THU',0,100),
 (1230,1,'17_FRI',0,100),
 (1231,1,'17_SAT',0,100),
 (1232,1,'17_SUN',0,100),
 (1233,1,'18_MON',0,100),
 (1234,1,'18_TUE',0,100),
 (1235,1,'18_WED',0,100),
 (1236,1,'18_THU',0,100),
 (1237,1,'18_FRI',0,100),
 (1238,1,'18_SAT',0,100),
 (1239,1,'18_SUN',0,100),
 (1240,1,'19_MON',0,100),
 (1241,1,'19_TUE',0,100),
 (1242,1,'19_WED',0,100),
 (1243,1,'19_THU',0,100),
 (1244,1,'19_FRI',0,100),
 (1245,1,'19_SAT',0,100),
 (1246,1,'19_SUN',0,100),
 (1247,1,'20_MON',0,100),
 (1248,1,'20_TUE',0,100),
 (1249,1,'20_WED',0,100),
 (1250,1,'20_THU',0,100),
 (1251,1,'20_FRI',0,100),
 (1252,1,'20_SAT',0,100),
 (1253,1,'20_SUN',0,100),
 (1254,1,'21_MON',0,100),
 (1255,1,'21_TUE',0,100),
 (1256,1,'21_WED',0,100),
 (1257,1,'21_THU',0,100),
 (1258,1,'21_FRI',0,100),
 (1259,1,'21_SAT',0,100),
 (1260,1,'21_SUN',0,100),
 (1261,1,'22_MON',0,100),
 (1262,1,'22_TUE',0,100),
 (1263,1,'22_WED',0,100),
 (1264,1,'22_THU',0,100),
 (1265,1,'22_FRI',0,100),
 (1266,1,'22_SAT',0,100),
 (1267,1,'22_SUN',0,100),
 (1268,1,'23_MON',0,100),
 (1269,1,'23_TUE',0,100),
 (1270,1,'23_WED',0,100),
 (1271,1,'23_THU',0,100),
 (1272,1,'23_FRI',0,100),
 (1273,1,'23_SAT',0,100),
 (1274,1,'23_SUN',0,100),
 (1275,1,'24_MON',0,100),
 (1276,1,'24_TUE',0,100),
 (1277,1,'24_WED',0,100),
 (1278,1,'24_THU',0,100),
 (1279,1,'24_FRI',0,100),
 (1280,1,'24_SAT',0,100),
 (1281,1,'24_SUN',0,100),
 (1282,1,'25_MON',0,100),
 (1283,1,'25_TUE',0,100),
 (1284,1,'25_WED',0,100),
 (1285,1,'25_THU',0,100),
 (1286,1,'25_FRI',0,100),
 (1287,1,'25_SAT',0,100),
 (1288,1,'25_SUN',0,100),
 (1289,1,'26_MON',0,100),
 (1290,1,'26_TUE',0,100),
 (1291,1,'26_WED',0,100),
 (1292,1,'26_THU',0,100),
 (1293,1,'26_FRI',0,100),
 (1294,1,'26_SAT',0,100),
 (1295,1,'26_SUN',0,100),
 (1296,1,'27_MON',0,100),
 (1297,1,'27_TUE',0,100),
 (1298,1,'27_WED',0,100),
 (1299,1,'27_THU',0,100),
 (1300,1,'27_FRI',0,100),
 (1301,1,'27_SAT',0,100),
 (1302,1,'27_SUN',0,100),
 (1303,1,'28_MON',0,100),
 (1304,1,'28_TUE',0,100),
 (1305,1,'28_WED',0,100),
 (1306,1,'28_THU',0,100),
 (1307,1,'28_FRI',0,100),
 (1308,1,'28_SAT',0,100),
 (1309,1,'28_SUN',0,100),
 (1310,1,'29_MON',0,100),
 (1311,1,'29_TUE',0,100),
 (1312,1,'29_WED',0,100),
 (1313,1,'29_THU',0,100),
 (1314,1,'29_FRI',0,100),
 (1315,1,'29_SAT',0,100),
 (1316,1,'29_SUN',0,100),
 (1317,1,'30_MON',0,100),
 (1318,1,'30_TUE',0,100),
 (1319,1,'30_WED',0,100),
 (1320,1,'30_THU',0,100),
 (1321,1,'30_FRI',0,100),
 (1322,1,'30_SAT',0,100),
 (1323,1,'30_SUN',0,100),
 (1324,1,'31_MON',0,100),
 (1325,1,'31_TUE',0,100),
 (1326,1,'31_WED',0,100),
 (1327,1,'31_THU',0,100),
 (1328,1,'31_FRI',0,100),
 (1329,1,'31_SAT',0,100),
 (1330,1,'31_SUN',0,100),
 (1331,1,'32_MON',0,100),
 (1332,1,'32_TUE',0,100),
 (1333,1,'32_WED',0,100),
 (1334,1,'32_THU',0,100),
 (1335,1,'32_FRI',0,100),
 (1336,1,'32_SAT',0,100),
 (1337,1,'32_SUN',0,100),
 (1338,1,'33_MON',0,100),
 (1339,1,'33_TUE',0,100),
 (1340,1,'33_WED',0,100),
 (1341,1,'33_THU',0,100),
 (1342,1,'33_FRI',0,100),
 (1343,1,'33_SAT',0,100),
 (1344,1,'33_SUN',0,100),
 (1345,1,'34_MON',0,100),
 (1346,1,'34_TUE',0,100),
 (1347,1,'34_WED',0,100),
 (1348,1,'34_THU',0,100),
 (1349,1,'34_FRI',0,100),
 (1350,1,'34_SAT',0,100),
 (1351,1,'34_SUN',0,100),
 (1352,1,'35_MON',0,100),
 (1353,1,'35_TUE',0,100),
 (1354,1,'35_WED',0,100),
 (1355,1,'35_THU',0,100),
 (1356,1,'35_FRI',0,100),
 (1357,1,'35_SAT',0,100),
 (1358,1,'35_SUN',0,100),
 (1359,1,'36_MON',0,100),
 (1360,1,'36_TUE',0,100),
 (1361,1,'36_WED',0,100),
 (1362,1,'36_THU',0,100),
 (1363,1,'36_FRI',0,100),
 (1364,1,'36_SAT',0,100),
 (1365,1,'36_SUN',0,100),
 (1366,1,'37_MON',0,100),
 (1367,1,'37_TUE',0,100),
 (1368,1,'37_WED',0,100),
 (1369,1,'37_THU',0,100),
 (1370,1,'37_FRI',0,100),
 (1371,1,'37_SAT',0,100),
 (1372,1,'37_SUN',0,100),
 (1373,1,'38_MON',0,100),
 (1374,1,'38_TUE',0,100),
 (1375,1,'38_WED',0,100),
 (1376,1,'38_THU',0,100),
 (1377,1,'38_FRI',0,100),
 (1378,1,'38_SAT',0,100),
 (1379,1,'38_SUN',0,100),
 (1380,1,'39_MON',0,100),
 (1381,1,'39_TUE',0,100),
 (1382,1,'39_WED',0,100),
 (1383,1,'39_THU',0,100),
 (1384,1,'39_FRI',0,100),
 (1385,1,'39_SAT',0,100),
 (1386,1,'39_SUN',0,100),
 (1387,1,'40_MON',0,100),
 (1388,1,'40_TUE',0,100),
 (1389,1,'40_WED',0,100),
 (1390,1,'40_THU',0,100),
 (1391,1,'40_FRI',0,100),
 (1392,1,'40_SAT',0,100),
 (1393,1,'40_SUN',0,100),
 (1394,1,'41_MON',0,100),
 (1395,1,'41_TUE',0,100),
 (1396,1,'41_WED',0,100),
 (1397,1,'41_THU',0,100),
 (1398,1,'41_FRI',0,100),
 (1399,1,'41_SAT',0,100),
 (1400,1,'41_SUN',0,100),
 (1401,1,'42_MON',0,100),
 (1402,1,'42_TUE',0,100),
 (1403,1,'42_WED',0,100),
 (1404,1,'42_THU',0,100),
 (1405,1,'42_FRI',0,100),
 (1406,1,'42_SAT',0,100),
 (1407,1,'42_SUN',0,100),
 (1408,1,'43_MON',0,100),
 (1409,1,'43_TUE',0,100),
 (1410,1,'43_WED',0,100),
 (1411,1,'43_THU',0,100),
 (1412,1,'43_FRI',0,100),
 (1413,1,'43_SAT',0,100),
 (1414,1,'43_SUN',0,100),
 (1415,1,'44_MON',0,100),
 (1416,1,'44_TUE',0,100),
 (1417,1,'44_WED',0,100),
 (1418,1,'44_THU',0,100),
 (1419,1,'44_FRI',0,100),
 (1420,1,'44_SAT',0,100),
 (1421,1,'44_SUN',0,100),
 (1422,1,'45_MON',0,100),
 (1423,1,'45_TUE',0,100),
 (1424,1,'45_WED',0,100),
 (1425,1,'45_THU',0,100),
 (1426,1,'45_FRI',0,100),
 (1427,1,'45_SAT',0,100),
 (1428,1,'45_SUN',0,100),
 (1429,1,'46_MON',0,100),
 (1430,1,'46_TUE',0,100),
 (1431,1,'46_WED',0,100),
 (1432,1,'46_THU',0,100),
 (1433,1,'46_FRI',0,100),
 (1434,1,'46_SAT',0,100),
 (1435,1,'46_SUN',0,100),
 (1436,1,'47_MON',0,100),
 (1437,1,'47_TUE',0,100),
 (1438,1,'47_WED',0,100),
 (1439,1,'47_THU',0,100),
 (1440,1,'47_FRI',0,100),
 (1441,1,'47_SAT',0,100),
 (1442,1,'47_SUN',0,100),
 (1443,1,'48_MON',0,100),
 (1444,1,'48_TUE',0,100),
 (1445,1,'48_WED',0,100),
 (1446,1,'48_THU',0,100),
 (1447,1,'48_FRI',0,100),
 (1448,1,'48_SAT',0,100),
 (1449,1,'48_SUN',0,100),
 (1450,1,'49_MON',0,100),
 (1451,1,'49_TUE',0,100),
 (1452,1,'49_WED',0,100),
 (1453,1,'49_THU',0,100),
 (1454,1,'49_FRI',0,100),
 (1455,1,'49_SAT',0,100),
 (1456,1,'49_SUN',0,100),
 (1457,1,'50_MON',0,100),
 (1458,1,'50_TUE',0,100),
 (1459,1,'50_WED',0,100),
 (1460,1,'50_THU',0,100),
 (1461,1,'50_FRI',0,100),
 (1462,1,'50_SAT',0,100),
 (1463,1,'50_SUN',0,100),
 (1464,1,'51_MON',0,100),
 (1465,1,'51_TUE',0,100),
 (1466,1,'51_WED',0,100),
 (1467,1,'51_THU',0,100),
 (1468,1,'51_FRI',0,100),
 (1469,1,'51_SAT',0,100),
 (1470,1,'51_SUN',0,100),
 (1471,1,'52_MON',0,100),
 (1472,1,'52_TUE',0,100),
 (1473,1,'52_WED',0,100),
 (1474,1,'52_THU',0,100),
 (1475,1,'52_FRI',0,100),
 (1476,1,'52_SAT',0,100),
 (1477,1,'52_SUN',0,100),
 (1478,1,'53_MON',0,100),
 (1479,1,'53_TUE',0,100),
 (1480,1,'53_WED',0,100),
 (1481,1,'53_THU',0,100),
 (1482,1,'53_FRI',0,100),
 (1483,1,'53_SAT',0,100),
 (1484,1,'53_SUN',0,8000);
/*!40000 ALTER TABLE `tv_room_rate` ENABLE KEYS */;


--
-- Definition of table `tv_room_rate_lunar`
--

DROP TABLE IF EXISTS `tv_room_rate_lunar`;
CREATE TABLE `tv_room_rate_lunar` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `room_id` bigint(20) unsigned NOT NULL,
  `rate_day` int(10) unsigned NOT NULL default '1',
  `rate_month` int(10) unsigned NOT NULL default '1',
  `original_price` double NOT NULL default '0',
  `price` double NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_room_rate_lunar`
--

/*!40000 ALTER TABLE `tv_room_rate_lunar` DISABLE KEYS */;
/*!40000 ALTER TABLE `tv_room_rate_lunar` ENABLE KEYS */;


--
-- Definition of table `tv_room_rate_solar`
--

DROP TABLE IF EXISTS `tv_room_rate_solar`;
CREATE TABLE `tv_room_rate_solar` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `room_id` bigint(20) unsigned NOT NULL,
  `rate_day` int(10) unsigned NOT NULL default '1',
  `rate_month` int(10) unsigned NOT NULL default '1',
  `original_price` double NOT NULL default '0',
  `price` double NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_room_rate_solar`
--

/*!40000 ALTER TABLE `tv_room_rate_solar` DISABLE KEYS */;
/*!40000 ALTER TABLE `tv_room_rate_solar` ENABLE KEYS */;


--
-- Definition of table `tv_sessions`
--

DROP TABLE IF EXISTS `tv_sessions`;
CREATE TABLE `tv_sessions` (
  `session_id` varchar(40) NOT NULL default '0',
  `ip_address` varchar(45) NOT NULL default '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL default '0',
  `user_data` text NOT NULL,
  PRIMARY KEY  (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_sessions`
--

/*!40000 ALTER TABLE `tv_sessions` DISABLE KEYS */;
INSERT INTO `tv_sessions` (`session_id`,`ip_address`,`user_agent`,`last_activity`,`user_data`) VALUES 
 ('b529e5419c7820688dbee6e90a0bbd13','127.0.0.1','Mozilla/5.0 (Windows NT 6.1; WOW64; rv:27.0) Gecko/20100101 Firefox/27.0',1392558432,'a:7:{s:4:\"user\";a:17:{s:2:\"id\";s:1:\"1\";s:3:\"uid\";s:0:\"\";s:8:\"provider\";s:7:\"travelo\";s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:32:\"1a4783285b8737cf67a02ca2faaa2d78\";s:13:\"password_text\";N;s:5:\"email\";s:23:\"ltp_mv_huflit@yahoo.com\";s:5:\"phone\";N;s:8:\"fullname\";s:13:\"Administrator\";s:6:\"gender\";s:1:\"1\";s:8:\"birthday\";N;s:11:\"nationality\";N;s:9:\"user_type\";s:1:\"0\";s:9:\"edit_mode\";s:1:\"1\";s:6:\"active\";s:1:\"1\";s:12:\"created_date\";s:19:\"2013-03-12 14:04:40\";s:5:\"login\";b:1;}s:21:\"root_addmin_logged_in\";b:0;s:16:\"addmin_logged_in\";b:1;s:9:\"logged_in\";b:1;s:11:\"logged_user\";O:8:\"stdClass\":16:{s:2:\"id\";s:1:\"1\";s:3:\"uid\";s:0:\"\";s:8:\"provider\";s:7:\"travelo\";s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:32:\"1a4783285b8737cf67a02ca2faaa2d78\";s:13:\"password_text\";N;s:5:\"email\";s:23:\"ltp_mv_huflit@yahoo.com\";s:5:\"phone\";N;s:8:\"fullname\";s:13:\"Administrator\";s:6:\"gender\";s:1:\"1\";s:8:\"birthday\";N;s:11:\"nationality\";N;s:9:\"user_type\";s:1:\"0\";s:9:\"edit_mode\";s:1:\"1\";s:6:\"active\";s:1:\"1\";s:12:\"created_date\";s:19:\"2013-03-12 14:04:40\";}s:13:\"security_code\";s:6:\"524663\";s:14:\"tour_shortlist\";a:0:{}}');
/*!40000 ALTER TABLE `tv_sessions` ENABLE KEYS */;


--
-- Definition of table `tv_shopping`
--

DROP TABLE IF EXISTS `tv_shopping`;
CREATE TABLE `tv_shopping` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) default NULL,
  `thumbnail` varchar(255) default NULL,
  `city` bigint(20) unsigned NOT NULL default '0',
  `address` varchar(255) default NULL,
  `gmap_address` varchar(255) default NULL,
  `area` varchar(255) default NULL,
  `open_time` varchar(255) default NULL,
  `content_type` varchar(255) default NULL,
  `summary` text,
  `content` text,
  `order_num` bigint(20) unsigned NOT NULL default '0',
  `catid` bigint(20) unsigned NOT NULL default '0',
  `meta_title` varchar(255) default NULL,
  `meta_key` varchar(255) default NULL,
  `meta_desc` varchar(255) default NULL,
  `lang` varchar(255) NOT NULL default 'EN',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_shopping`
--

/*!40000 ALTER TABLE `tv_shopping` DISABLE KEYS */;
/*!40000 ALTER TABLE `tv_shopping` ENABLE KEYS */;


--
-- Definition of table `tv_shopping_category`
--

DROP TABLE IF EXISTS `tv_shopping_category`;
CREATE TABLE `tv_shopping_category` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `alias` varchar(255) default NULL,
  `parent_id` bigint(20) unsigned default NULL,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_shopping_category`
--

/*!40000 ALTER TABLE `tv_shopping_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `tv_shopping_category` ENABLE KEYS */;


--
-- Definition of table `tv_sight`
--

DROP TABLE IF EXISTS `tv_sight`;
CREATE TABLE `tv_sight` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) default NULL,
  `thumbnail` varchar(255) default NULL,
  `city` bigint(20) unsigned NOT NULL default '0',
  `address` varchar(255) default NULL,
  `gmap_address` varchar(255) default NULL,
  `area` varchar(255) default NULL,
  `open_time` varchar(255) default NULL,
  `content_type` varchar(255) default NULL,
  `summary` text,
  `content` text,
  `order_num` bigint(20) unsigned NOT NULL default '0',
  `catid` bigint(20) unsigned NOT NULL default '0',
  `meta_title` varchar(255) default NULL,
  `meta_key` varchar(255) default NULL,
  `meta_desc` varchar(255) default NULL,
  `lang` varchar(255) NOT NULL default 'EN',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_sight`
--

/*!40000 ALTER TABLE `tv_sight` DISABLE KEYS */;
INSERT INTO `tv_sight` (`id`,`title`,`alias`,`thumbnail`,`city`,`address`,`gmap_address`,`area`,`open_time`,`content_type`,`summary`,`content`,`order_num`,`catid`,`meta_title`,`meta_key`,`meta_desc`,`lang`,`created_date`,`active`) VALUES 
 (1,'War remnants museum','war-remnants-museum','/travelovietnam.com/files/upload/image/hoan%20kiem%20lake%20in%20summer300-210.jpg',2,'184/1A Le Van Sy, Ward 10, Phu Nhuan District, Ho Chi Minh City, Vietnam','184/1A Le Van Sy, Ward 10, Phu Nhuan District, Ho Chi Minh City, Vietnam','South','7:30am - 12:00am; 1:30pm - 17:00pm',NULL,'<p>Sight the best places in Vietnam</p>','<p style=\"text-align: justify;\">One of the most popular museums in HCMC is the War Remnants Museum for Western tourists. This is the place to exhibit many documentary atrocities about victims of US military. Moreover it also display relics from US War such as: tans, guns, crackers, etc.</p>\r\n<p style=\"text-align: justify; margin-left: 30px;\"> </p>\r\n<p> <img style=\"-webkit-user-select: none; display: block; margin-left: auto; margin-right: auto;\" src=\"http://sotaydulich.com/userfiles/image/2011/04/18/Sotaydulich_WoW_Sai_Gon_Nuoc_mat_va_mau_01.jpg\" alt=\"\" width=\"550\" /></p>\r\n<p style=\"margin-left: 30px; text-align: center;\"><em>War jets are displayed in the front yard</em></p>\r\n<p style=\"margin-left: 30px; text-align: center;\"><em><br /></em></p>\r\n<p style=\"text-align: justify;\">Currently the War Remnants Museum is a unit under the Department of Culture, Sports and Tourism Ho Chi Minh City. Located in the museum system of Vietnam, the museum for world peace and a member of the World Council of Museums (ICOM), the War Remnants Museum, the Museum of thematic research, collection, storage, preservation and display of the material, photographs, artifacts on the evidence of the crime and the consequences of the war that the invasion force has caused to Vietnam. Thereby, the Museum of educating the public, especially the younger generation, mental struggle for independence and freedom of the country, the anti-war sense of invasion, to protect peace and solidarity friendship between the peoples of the world. </p>\r\n<p style=\"text-align: justify;\">Museum store more than 20,000 documents, exhibits and films, in which more than 1,500 documents, artifacts, films have been applied to introduce in eight thematic exhibition frequently. In 35 years, the Museum has welcomed over 15 million visitors at home and abroad. Currently with about 500,000 visitors each year, the War Remnants Museum is one of the only cultural tourism to attract high public credibility at home and abroad.</p>\r\n<p style=\"text-align: justify; margin-left: 30px;\"> </p>\r\n<p><img style=\"-webkit-user-select: none; cursor: -webkit-zoom-in; display: block; margin-left: auto; margin-right: auto;\" src=\"http://www.kyluc.vn/Editor/assets/01%20bieu%20trung/BT%20chung%20tich1.JPG\" alt=\"\" width=\"550\" height=\"413\" /></p>\r\n<p style=\"text-align: center;\"><em>Bombshells display corner</em></p>\r\n<p style=\"text-align: center;\"><em><br /></em></p>\r\n<ul style=\"text-align: justify;\">\r\n<li><span title=\"Với những thành quả đạt được, Bảo tàng Chứng tích Chiến tranh đã được Nhà nước tặng thưởng Huân chương Lao động hạng 3 (năm 1995), Huân chương Lao động hạng 2 (năm 2001).\">With these achievements, the War Remnants Museum was awarded the Labour Order No. 3 (1995), 2nd Class Labor Medal (2001). </span></li>\r\n<li><span title=\"Bảo tàng Chứng tích Chiến tranh đón nhận Huân chương Lao động hạng II do Chủ tịch nước Trần Đức Lương tặng thưởng ngày 12/3/2001\">War Remnants Museum, the second - class Labor Medal by President Tran Duc Luong awarded on 03.12.2001</span></li>\r\n<li><span title=\"Bảo tàng Chứng tích Chiến tranh được xếp là 1 trong 10 điểm tham quan thú vị nhất do khách nước ngoài và khách trong nước bình chọn tháng 11/2009\">War Remnants Museum ranks as one of the 10 most interesting attractions by domestic and foreign guests voted 11/2009</span></li>\r\n<li><span title=\"Bảo tàng Chứng tích Chiến tranh nhận Cờ truyền thống của UBND Thành phố nhân kỷ niệm 35 năm thành lập Bảo tàng Chứng tích Chiến tranh (04/9/1975 – 04/9/2010)\">War Remnants Museum receives Chinese tradition of the City People\'s Committee to celebrate the 35th anniversary of the War Remnants Museum (04/9/1975 - 04/9/2010)</span></li>\r\n</ul>\r\n<div style=\"text-align: justify;\"><span title=\"Từ năm 2002, Bảo tàng Chứng tích Chiến tranh được đầu tư xây dựng mới nhằm hiện đại hóa toàn diện hoạt động.\"><br /></span></div>\r\n<div style=\"text-align: justify;\"><span title=\"Từ năm 2002, Bảo tàng Chứng tích Chiến tranh được đầu tư xây dựng mới nhằm hiện đại hóa toàn diện hoạt động.\">Since 2002, the War Remnants Museum is new construction to a comprehensive modernization activities.</span><span title=\"Ngày 30/4/2010, đã hoàn thành công trình xây dựng.\">On 30/4/2010, has completed construction work. </span><span title=\"Hiện nay đang xây dựng nội dung trưng bày mới, mở rộng ra cả thời kỳ xâm lược của Pháp – Nhật và thời kỳ sau chiến tranh.\">Currently building new content display, extend the period of the French invasion of Japan and the postwar period.</span></div>',1,0,'','','','EN','2013-12-12 08:55:32',1);
/*!40000 ALTER TABLE `tv_sight` ENABLE KEYS */;


--
-- Definition of table `tv_sight_category`
--

DROP TABLE IF EXISTS `tv_sight_category`;
CREATE TABLE `tv_sight_category` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `alias` varchar(255) default NULL,
  `parent_id` bigint(20) unsigned default NULL,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_sight_category`
--

/*!40000 ALTER TABLE `tv_sight_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `tv_sight_category` ENABLE KEYS */;


--
-- Definition of table `tv_subscribe`
--

DROP TABLE IF EXISTS `tv_subscribe`;
CREATE TABLE `tv_subscribe` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `email` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL default '1',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_subscribe`
--

/*!40000 ALTER TABLE `tv_subscribe` DISABLE KEYS */;
/*!40000 ALTER TABLE `tv_subscribe` ENABLE KEYS */;


--
-- Definition of table `tv_team`
--

DROP TABLE IF EXISTS `tv_team`;
CREATE TABLE `tv_team` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `alias` varchar(255) default NULL,
  `title` varchar(255) NOT NULL,
  `thumbnail` varchar(255) default NULL,
  `description` text,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_team`
--

/*!40000 ALTER TABLE `tv_team` DISABLE KEYS */;
/*!40000 ALTER TABLE `tv_team` ENABLE KEYS */;


--
-- Definition of table `tv_testimonial`
--

DROP TABLE IF EXISTS `tv_testimonial`;
CREATE TABLE `tv_testimonial` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `title` varchar(255) default NULL,
  `content` text,
  `author` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  `nationality` varchar(255) default NULL,
  `rating` int(10) unsigned default '0',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `active` tinyint(1) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_testimonial`
--

/*!40000 ALTER TABLE `tv_testimonial` DISABLE KEYS */;
INSERT INTO `tv_testimonial` (`id`,`title`,`content`,`author`,`email`,`nationality`,`rating`,`created_date`,`active`) VALUES 
 (1,'Great website','Still deciding if a Travelovietnam is for you? Many of our travellers have experienced the adventure of a lifetime and are now more than happy to share their stories with you. Check out these adventure travel trip reviews or search for feedback by region, country or trip.\nHave you been on a Travelovietnam trip before? Fill out an evaluation, and let us and other travelers hear about it!','Le Thanh Phong','ltp_mv_huflit@yahoo.com','Vietnam',5,'2014-02-16 19:43:21',1),
 (2,'Great website','Still deciding if a Travelovietnam is for you? Many of our travellers have experienced the adventure of a lifetime and are now more than happy to share their stories with you. Check out these adventure travel trip reviews or search for feedback by region, country or trip. Have you been on a Travelovietnam trip before? Fill out an evaluation, and let us and other travelers hear about it!','Le Thanh Phong ','ltp_mv_huflit@yahoo.com','Argentina',4,'2014-02-16 20:17:18',1),
 (3,'Overall Review','Nice job!','Le Thanh Phong','phonglt@vietnam-media.vn','Australia',3,'2014-02-16 20:33:00',1),
 (4,'Overall Review','Still deciding if a Travelovietnam is for you? Many of our travellers have experienced the adventure of a lifetime and are now more than happy to share their stories with you. Check out these adventure travel trip reviews or search for feedback by region, country or trip. Have you been on a Travelovietnam trip before? Fill out an evaluation, and let us and other travelers hear about it!','Le Thanh Phong ','ltp_mv_huflit@yahoo.com','Argentina',2,'2014-02-16 20:34:21',1);
/*!40000 ALTER TABLE `tv_testimonial` ENABLE KEYS */;


--
-- Definition of table `tv_tooltip`
--

DROP TABLE IF EXISTS `tv_tooltip`;
CREATE TABLE `tv_tooltip` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `content` text,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_tooltip`
--

/*!40000 ALTER TABLE `tv_tooltip` DISABLE KEYS */;
INSERT INTO `tv_tooltip` (`id`,`name`,`content`,`created_date`,`active`) VALUES 
 (1,'[Tour][Search][Filter][Price]','<p>This price includes the land component of your trip, which is paid full prior to departure, plus any compulsory payments to be paid either locally or prior to your trip. Please see What’s Included for full details of compulsory payments. In addition, if you travel on Holidays in Vietnam, there is something which you have to note. For more details, please read Trip Notes.</p>','2014-01-13 07:41:57',1),
 (2,'[Tour][Search][Filter][Duration]','','2014-01-13 07:49:01',1),
 (3,'[Tour][Search][Filter][Region]','<p>Vietnam is divided into 3 regions: North, Central and South. You can choose one of them to find yourself the suitable destinations for your trip. Besides, if you want to explore all famous destinations as well as heritage from the North to the South, you may choose Throughout Vietnam to search tours for your demand</p>','2014-01-13 07:50:05',1),
 (4,'[Tour][Search][Filter][SpecialOffer]','','2014-01-13 07:50:48',1),
 (5,'[Tour][Search][Filter][TourTheme]','','2014-02-13 13:39:56',1),
 (6,'[Tour][Search][Filter][Destination]','<p>Vietnam has many tourism destinations which have own secluded features. Besides, there are somewhere that is famous all over the world such as Ha Long Bay, Nha Trang, Phan Thiet – Mui Ne, Ha Noi, Ho Chi Minh city, etc. You can base on it to choose for yourself the appropriate destination and enjoy it.</p>','2014-01-13 08:16:16',1),
 (7,'[Tour][Detail][Price]','<p>This price includes the land component of your trip, which is paid full prior to departure, plus any compulsory payments to be paid either locally or prior to your trip. Please see What’s Included for full details of compulsory payments. In addition, if you travel on Holidays in Vietnam, there is something which you have to note. For more details, please read Trip Notes.</p>','2014-01-13 11:25:53',1),
 (8,'[Tour][Search][Filter][TourType]','','2014-02-13 13:40:11',1);
/*!40000 ALTER TABLE `tv_tooltip` ENABLE KEYS */;


--
-- Definition of table `tv_tour`
--

DROP TABLE IF EXISTS `tv_tour`;
CREATE TABLE `tv_tour` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `code` varchar(255) default NULL,
  `sub_title` varchar(255) default NULL,
  `alias` varchar(255) default NULL,
  `meta_title` varchar(255) default NULL,
  `meta_key` varchar(255) default NULL,
  `meta_desc` varchar(255) default NULL,
  `thumbnail` varchar(255) default NULL,
  `promotion_image` varchar(255) default NULL,
  `map` varchar(255) default NULL,
  `depart_from` bigint(20) unsigned default NULL,
  `going_to` bigint(20) unsigned default NULL,
  `duration` int(10) unsigned NOT NULL default '1' COMMENT 'days',
  `destinations` varchar(255) default NULL,
  `original_price` double NOT NULL default '0',
  `price` double default NULL,
  `start` timestamp NULL default NULL,
  `finish` timestamp NULL default NULL,
  `summary` text,
  `highlight` text,
  `price_inclusion` text,
  `price_exclusion` text,
  `detail` text,
  `category_id` bigint(20) unsigned NOT NULL default '0',
  `categories` varchar(255) default NULL,
  `activities` varchar(255) default NULL,
  `featured` bigint(20) unsigned NOT NULL default '0',
  `package` bigint(20) unsigned NOT NULL default '0',
  `short_tour` bigint(20) unsigned NOT NULL default '0',
  `daily` bigint(20) unsigned NOT NULL default '0',
  `throughout` tinyint(1) unsigned NOT NULL default '0',
  `best_deal` bigint(20) unsigned NOT NULL default '0',
  `brochure` varchar(255) default NULL,
  `active` tinyint(1) unsigned default '1',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_tour`
--

/*!40000 ALTER TABLE `tv_tour` DISABLE KEYS */;
INSERT INTO `tv_tour` (`id`,`name`,`code`,`sub_title`,`alias`,`meta_title`,`meta_key`,`meta_desc`,`thumbnail`,`promotion_image`,`map`,`depart_from`,`going_to`,`duration`,`destinations`,`original_price`,`price`,`start`,`finish`,`summary`,`highlight`,`price_inclusion`,`price_exclusion`,`detail`,`category_id`,`categories`,`activities`,`featured`,`package`,`short_tour`,`daily`,`throughout`,`best_deal`,`brochure`,`active`,`created_date`) VALUES 
 (1,'Vietnam Holiday In Style','XYZ123','Six-Night Azores Vacation with Roundtrip Airfare and Accommodations at Queen Park Hotel','vietnam-holiday-in-style','Meta Title','Keywords','Page description','/travelovietnam.com/files/upload/image/thumb-tour.jpg','','/travelovietnam.com/files/upload/image/sample-map.jpg',1,2,7,'1;4;5;2',500,400,'0000-00-00 00:00:00','0000-00-00 00:00:00','<p><span class=\"des\">This well paced tour encompasses all the must see sights of Vietnam - Historic Hanoi, religious heritages in Asia, a cruise around spectacular Halong Bay, the ancient capital Hue, multicultural Hoi An, the mystical Mekong Delta and the bustling metropolis of Saigon. All of those you will take 11 days with us the most marvelous 11 days.</span></p>','<ul>\r\n<li>Visiting French Indochinese architecture</li>\r\n<li>Visiting famous tourism sites such as: Hanoi Old Quarter, Temple of Literature, One Pillar Pagoda, Tran Quoc Pagoda</li>\r\n<li>Enjoying the beauty of Halong Bay, one of Seven Wonders of the World.</li>\r\n<li>Discovering the famous caves in Vietnam such as: Trang An, Tam Coc, Bich Dong.</li>\r\n<li>Discovering Vietnam\'s rich cultural &amp; historical heritages.</li>\r\n</ul>','<ul>\r\n<li><span class=\"li_pri_in\">Vietnam Visa Approval Letter</span></li>\r\n<li><span class=\"li_pri_in\"><span class=\"li_pri_in\"> Accommodations with daily breakfast</span></span></li>\r\n<li><span class=\"li_pri_in\"><span class=\"li_pri_in\"><span class=\"li_pri_in\"> Meals as mentioned in the itinerary</span></span></span></li>\r\n<li><span class=\"li_pri_in\"><span class=\"li_pri_in\"><span class=\"li_pri_in\"><span class=\"li_pri_in\"> Transport by private car with AC</span></span></span></span></li>\r\n<li><span class=\"li_pri_in\"><span class=\"li_pri_in\"><span class=\"li_pri_in\"><span class=\"li_pri_in\"><span class=\"li_pri_in\"> English speaking guides</span></span></span></span></span></li>\r\n<li><span class=\"li_pri_in\"><span class=\"li_pri_in\"><span class=\"li_pri_in\"><span class=\"li_pri_in\"><span class=\"li_pri_in\"><span class=\"li_pri_in\"> All indicated internal flights</span></span></span></span></span></span></li>\r\n<li><span class=\"li_pri_in\"><span class=\"li_pri_in\"><span class=\"li_pri_in\"><span class=\"li_pri_in\"><span class=\"li_pri_in\"><span class=\"li_pri_in\"><span class=\"li_pri_in\"> Water &amp; tissues</span></span></span></span></span></span></span></li>\r\n<li><span class=\"li_pri_in\"><span class=\"li_pri_in\"><span class=\"li_pri_in\"><span class=\"li_pri_in\"><span class=\"li_pri_in\"><span class=\"li_pri_in\"><span class=\"li_pri_in\"><span class=\"li_pri_in\"> Entrance fees, performances, boat trips &amp; excursions</span></span></span></span></span></span></span></span></li>\r\n</ul>','<ul>\r\n<li><span class=\"li_pri_ex\">International flights to/from Vietnam</span></li>\r\n<li><span class=\"li_pri_ex\"><span class=\"li_pri_ex\"> Travel insurance</span></span></li>\r\n<li><span class=\"li_pri_ex\"><span class=\"li_pri_ex\"><span class=\"li_pri_ex\"> Visa stamp fees</span></span></span></li>\r\n<li><span class=\"li_pri_ex\"><span class=\"li_pri_ex\"><span class=\"li_pri_ex\"><span class=\"li_pri_ex\"> Early check-in, late check-out surcharge </span></span></span></span></li>\r\n<li><span class=\"li_pri_ex\"><span class=\"li_pri_ex\"><span class=\"li_pri_ex\"><span class=\"li_pri_ex\"><span class=\"li_pri_ex\"> Personal expenses</span></span></span></span></span></li>\r\n<li><span class=\"li_pri_ex\"><span class=\"li_pri_ex\"><span class=\"li_pri_ex\"><span class=\"li_pri_ex\"><span class=\"li_pri_ex\"><span class=\"li_pri_ex\"> Meals not mentioned <br /></span></span></span></span></span></span></li>\r\n<li><span class=\"li_pri_ex\"><span class=\"li_pri_ex\"><span class=\"li_pri_ex\"><span class=\"li_pri_ex\"><span class=\"li_pri_ex\"><span class=\"li_pri_ex\"><span class=\"li_pri_ex\"> Drinks not mentioned</span></span></span></span></span></span></span></li>\r\n<li><span class=\"li_pri_ex\"><span class=\"li_pri_ex\"><span class=\"li_pri_ex\"><span class=\"li_pri_ex\"><span class=\"li_pri_ex\"><span class=\"li_pri_ex\"><span class=\"li_pri_ex\"><span class=\"li_pri_ex\"> Tips &amp; Gratitues</span></span></span></span></span></span></span></span></li>\r\n</ul>','',6,'6;2;9;7;12','1;2',1,0,0,0,1,1,'/travelovietnam.com/files/upload/image/travel-detail.jpg',1,'2014-02-11 21:56:44');
/*!40000 ALTER TABLE `tv_tour` ENABLE KEYS */;


--
-- Definition of table `tv_tour_activity`
--

DROP TABLE IF EXISTS `tv_tour_activity`;
CREATE TABLE `tv_tour_activity` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `alias` varchar(255) default NULL,
  `active` tinyint(1) NOT NULL default '1',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_tour_activity`
--

/*!40000 ALTER TABLE `tv_tour_activity` DISABLE KEYS */;
INSERT INTO `tv_tour_activity` (`id`,`name`,`alias`,`active`,`created_date`) VALUES 
 (1,'Climbing','climbing',1,'2014-01-28 21:05:48'),
 (2,'Swimming','swimming',1,'2014-01-28 21:05:57');
/*!40000 ALTER TABLE `tv_tour_activity` ENABLE KEYS */;


--
-- Definition of table `tv_tour_booking`
--

DROP TABLE IF EXISTS `tv_tour_booking`;
CREATE TABLE `tv_tour_booking` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `tour_id` bigint(20) unsigned NOT NULL default '0',
  `departure_id` bigint(20) unsigned NOT NULL default '0',
  `departure_date` timestamp NULL default NULL,
  `classtype` varchar(255) default NULL,
  `tour_rate` double NOT NULL default '0',
  `adults` int(10) unsigned NOT NULL default '1',
  `children` int(10) unsigned NOT NULL default '0',
  `infants` int(10) unsigned NOT NULL default '0',
  `supplements` int(10) unsigned NOT NULL default '0',
  `supplement_rate` double NOT NULL default '0',
  `fullname` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  `phone` varchar(255) default NULL,
  `message` text,
  `payment_method` varchar(255) default NULL,
  `payment_option` varchar(255) default NULL,
  `status` tinyint(1) NOT NULL default '0',
  `total_fee` double NOT NULL default '0',
  `paid` double NOT NULL default '0',
  `booking_key` varchar(255) default NULL,
  `booking_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `user_id` bigint(20) unsigned NOT NULL default '0',
  `promotion_code` varchar(45) default NULL,
  `discount` double NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_tour_booking`
--

/*!40000 ALTER TABLE `tv_tour_booking` DISABLE KEYS */;
INSERT INTO `tv_tour_booking` (`id`,`tour_id`,`departure_id`,`departure_date`,`classtype`,`tour_rate`,`adults`,`children`,`infants`,`supplements`,`supplement_rate`,`fullname`,`email`,`phone`,`message`,`payment_method`,`payment_option`,`status`,`total_fee`,`paid`,`booking_key`,`booking_date`,`user_id`,`promotion_code`,`discount`) VALUES 
 (3,1,0,NULL,NULL,0,2,0,0,0,0,'Le Thanh Phong','ltp_mv_huflit@yahoo.com','','','',NULL,1,880,0,'tour_ff32f830b93104e81b7c36071ae769eb','2014-01-10 08:56:04',1,'',0),
 (4,1,1,'2013-10-01 00:00:00','',10000,2,0,0,1,10,'Administrator','ltp_mv_huflit@yahoo.com','0933914822','','OnePay','Pay later',0,20010,20010,'tour_5817eac77233eefed35e904fbfff3dd9','2014-02-13 11:53:00',1,'',0),
 (5,1,1,'2013-10-01 00:00:00','',10000,2,0,0,1,10,'Administrator','ltp_mv_huflit@yahoo.com','0933914822','','OnePay','Pay later',0,20010,20010,'tour_c3fc5b373bbc27d8beefc5e7a7d77998','2014-02-13 11:56:06',1,'',0);
/*!40000 ALTER TABLE `tv_tour_booking` ENABLE KEYS */;


--
-- Definition of table `tv_tour_category`
--

DROP TABLE IF EXISTS `tv_tour_category`;
CREATE TABLE `tv_tour_category` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `alias` varchar(255) default NULL,
  `active` tinyint(1) NOT NULL default '1',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_tour_category`
--

/*!40000 ALTER TABLE `tv_tour_category` DISABLE KEYS */;
INSERT INTO `tv_tour_category` (`id`,`name`,`alias`,`active`,`created_date`) VALUES 
 (1,'Trans-Vietnam Tours','trans-vietnam-tours',1,'2013-03-15 12:09:19'),
 (2,'Northern Highlights','northern-highlights',1,'2013-03-15 12:14:39'),
 (3,'Central Highlights','central-highlights',1,'2013-03-15 12:15:05'),
 (4,'Vietnam Classic Tours','vietnam-classic-tours',1,'2013-04-08 20:43:29'),
 (6,'Central Highland Highlights','central-highland-highlights',1,'2013-03-15 12:16:37'),
 (7,'Southern Highlights','southern-highlights',1,'2013-03-15 12:17:09'),
 (8,'Mekong Delta Highlights','mekong-delta-highlights',1,'2013-03-15 12:17:20'),
 (9,'Top 10 Vietnam Tours','top-10-vietnam-tours',1,'2013-04-08 20:42:56'),
 (10,'Vietnam Luxury Tours','vietnam-luxury-tours',1,'2013-04-08 20:43:14'),
 (11,'Vietnam Trekking Tours','vietnam-trekking-tours',1,'2013-04-08 20:43:43'),
 (12,'Vietnam Biking Tours','vietnam-biking-tours',1,'2013-04-08 20:43:53'),
 (13,'Vietnam Beach Tours','vietnam-beach-tours',1,'2013-04-08 20:44:01'),
 (14,'Vietnam Honeymoon Tours ','vietnam-honeymoon-tours',1,'2013-04-08 20:44:11'),
 (15,'Vietnam Golf Tours','vietnam-golf-tours',1,'2013-04-08 20:44:19'),
 (16,'Vietnam Cuisine Tours','vietnam-cuisine-tours',1,'2013-04-08 20:44:28');
/*!40000 ALTER TABLE `tv_tour_category` ENABLE KEYS */;


--
-- Definition of table `tv_tour_departure`
--

DROP TABLE IF EXISTS `tv_tour_departure`;
CREATE TABLE `tv_tour_departure` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tour_id` int(10) unsigned NOT NULL default '0',
  `start` timestamp NOT NULL default '0000-00-00 00:00:00',
  `finish` timestamp NOT NULL default '0000-00-00 00:00:00',
  `places` int(10) unsigned NOT NULL default '0',
  `price` double NOT NULL default '0',
  `supplement` double NOT NULL default '0',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_tour_departure`
--

/*!40000 ALTER TABLE `tv_tour_departure` DISABLE KEYS */;
INSERT INTO `tv_tour_departure` (`id`,`tour_id`,`start`,`finish`,`places`,`price`,`supplement`,`created_date`,`active`) VALUES 
 (1,1,'2013-10-01 00:00:00','2013-12-31 00:00:00',10,10000,10,'2013-10-24 14:23:20',1),
 (2,1,'2014-01-01 00:00:00','2014-02-01 00:00:00',10,12000,0,'2013-10-24 15:04:26',1);
/*!40000 ALTER TABLE `tv_tour_departure` ENABLE KEYS */;


--
-- Definition of table `tv_tour_departure_rate`
--

DROP TABLE IF EXISTS `tv_tour_departure_rate`;
CREATE TABLE `tv_tour_departure_rate` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `departure_id` bigint(20) unsigned default NULL,
  `name` varchar(255) default NULL,
  `room_type` varchar(255) default NULL,
  `group_size` int(10) unsigned NOT NULL default '1',
  `single_supplement` tinyint(1) NOT NULL default '0',
  `price` double default NULL,
  `active` tinyint(1) default '1',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_tour_departure_rate`
--

/*!40000 ALTER TABLE `tv_tour_departure_rate` DISABLE KEYS */;
INSERT INTO `tv_tour_departure_rate` (`id`,`departure_id`,`name`,`room_type`,`group_size`,`single_supplement`,`price`,`active`,`created_date`) VALUES 
 (1,1,'Land Tour','',1,0,10000,1,'2014-01-24 11:48:57'),
 (2,1,'Land Tour','',2,0,9500,1,'2014-01-24 11:48:57'),
 (5,1,'Land Tour',NULL,1,1,200,1,'2014-01-24 11:48:57');
/*!40000 ALTER TABLE `tv_tour_departure_rate` ENABLE KEYS */;


--
-- Definition of table `tv_tour_destination`
--

DROP TABLE IF EXISTS `tv_tour_destination`;
CREATE TABLE `tv_tour_destination` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `alias` varchar(255) default NULL,
  `thumbnail` varchar(255) default NULL,
  `region` varchar(255) default NULL,
  `glat` double default NULL,
  `glong` double default NULL,
  `active` tinyint(1) NOT NULL default '1',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_tour_destination`
--

/*!40000 ALTER TABLE `tv_tour_destination` DISABLE KEYS */;
INSERT INTO `tv_tour_destination` (`id`,`name`,`alias`,`thumbnail`,`region`,`glat`,`glong`,`active`,`created_date`) VALUES 
 (1,'Ha Noi','ha-noi',NULL,NULL,21.037723,105.849466,1,'2013-03-26 21:22:32'),
 (2,'Ho Chi Minh','ho-chi-minh','','Southern',NULL,NULL,1,'2013-12-23 14:38:56'),
 (3,'Hue','hue',NULL,NULL,NULL,NULL,1,'2013-03-15 12:49:37'),
 (4,'Da Nang','da-nang','','Central',16.060001,108.214588,1,'2013-11-08 08:49:01'),
 (5,'Nha Trang','nha-trang',NULL,NULL,NULL,NULL,1,'2013-03-15 12:49:59'),
 (6,'Vung Tau','vung-tau',NULL,NULL,NULL,NULL,1,'2013-03-15 12:50:07'),
 (7,'Phu Quoc','phu-quoc',NULL,NULL,NULL,NULL,1,'2013-03-15 12:50:16');
/*!40000 ALTER TABLE `tv_tour_destination` ENABLE KEYS */;


--
-- Definition of table `tv_tour_itinerary`
--

DROP TABLE IF EXISTS `tv_tour_itinerary`;
CREATE TABLE `tv_tour_itinerary` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `activities` varchar(255) default NULL,
  `meal` varchar(255) default NULL,
  `detail` text,
  `file_path` varchar(255) default NULL,
  `file_name` varchar(255) default NULL,
  `tour_id` bigint(20) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL default '1',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_tour_itinerary`
--

/*!40000 ALTER TABLE `tv_tour_itinerary` DISABLE KEYS */;
INSERT INTO `tv_tour_itinerary` (`id`,`title`,`activities`,`meal`,`detail`,`file_path`,`file_name`,`tour_id`,`active`,`created_date`) VALUES 
 (1,'Day 1: Hanoi Arrival - Wecome dinner ','Explore the tree-lined boulevards, to visit French Indochinese architecture, tranquil lakes','Dinner','<p>Upon arrive in Hanoi, the car and tour guide of the Tours In Vietnam will pick you up at Noi Bai International Airport and then transfer to hotel for check in. The rest of the day is at your leisure to explore the city with tree lined boulevards, French Indochinese architecture and tranquil lakes of this unique city.<br /> Welcome dinner in a famous local restaurant with Vietnamese food.<br /> Overnight in Hanoi.</p>','/travelovietnam.com/files/upload/image/hoan%20kiem%20lake%20in%20summer300-210.jpg','Hoan Kiem Lake in Hanoi',1,1,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `tv_tour_itinerary` ENABLE KEYS */;


--
-- Definition of table `tv_tour_pax`
--

DROP TABLE IF EXISTS `tv_tour_pax`;
CREATE TABLE `tv_tour_pax` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `book_id` bigint(20) unsigned default '0',
  `fullname` varchar(255) default NULL,
  `gender` varchar(255) default NULL,
  `birthdate` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `nationality` varchar(255) default NULL,
  `passport` varchar(255) default NULL,
  `supplement` tinyint(1) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_tour_pax`
--

/*!40000 ALTER TABLE `tv_tour_pax` DISABLE KEYS */;
INSERT INTO `tv_tour_pax` (`id`,`book_id`,`fullname`,`gender`,`birthdate`,`nationality`,`passport`,`supplement`) VALUES 
 (1,3,'','Male','2013-11-04 00:00:00','Afghanistan',NULL,0),
 (2,3,'','Male','2013-11-04 00:00:00','Afghanistan',NULL,0),
 (3,4,'Le Thanh Phong','Male','2014-02-13 00:00:00','Afghanistan',NULL,0),
 (4,4,'Le Thanh Phong','Male','2014-02-13 00:00:00','Afghanistan',NULL,1),
 (5,5,'Le Thanh Phong','Male','2014-02-13 00:00:00','Afghanistan',NULL,0),
 (6,5,'Le Thanh Phong','Male','2014-02-13 00:00:00','Afghanistan',NULL,1);
/*!40000 ALTER TABLE `tv_tour_pax` ENABLE KEYS */;


--
-- Definition of table `tv_tour_rate`
--

DROP TABLE IF EXISTS `tv_tour_rate`;
CREATE TABLE `tv_tour_rate` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `tour_id` bigint(20) unsigned default NULL,
  `name` varchar(255) default NULL,
  `room_type` varchar(255) default NULL,
  `group_size` int(10) unsigned NOT NULL default '1',
  `single_supplement` tinyint(1) NOT NULL default '0',
  `price` double default NULL,
  `active` tinyint(1) default '1',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_tour_rate`
--

/*!40000 ALTER TABLE `tv_tour_rate` DISABLE KEYS */;
INSERT INTO `tv_tour_rate` (`id`,`tour_id`,`name`,`room_type`,`group_size`,`single_supplement`,`price`,`active`,`created_date`) VALUES 
 (2,1,'Land Tour','',2,0,1136,1,'2013-03-16 07:41:28'),
 (3,1,'Land Tour','',4,0,913,1,'2013-03-16 07:42:25'),
 (4,1,'Land Tour','',6,0,819,1,'2013-03-16 07:43:26'),
 (5,1,'Land Tour','',8,0,798,1,'2013-03-16 16:01:32'),
 (6,1,'Land Tour',NULL,1,1,200,1,'2014-01-24 12:01:45'),
 (7,1,'Deluxe',NULL,2,0,2000,1,'2014-01-24 12:04:59'),
 (8,1,'Deluxe',NULL,4,0,1800,1,'2014-01-24 12:04:59'),
 (9,1,'Deluxe',NULL,6,0,1600,1,'2014-01-24 12:04:59'),
 (10,1,'Deluxe',NULL,8,0,1400,1,'2014-01-24 12:04:59'),
 (11,1,'Deluxe',NULL,1,1,200,1,'2014-01-24 12:04:59');
/*!40000 ALTER TABLE `tv_tour_rate` ENABLE KEYS */;


--
-- Definition of table `tv_tour_request`
--

DROP TABLE IF EXISTS `tv_tour_request`;
CREATE TABLE `tv_tour_request` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `fullname` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  `phone` varchar(32) default NULL,
  `fromdate` timestamp NOT NULL default '0000-00-00 00:00:00',
  `todate` timestamp NOT NULL default '0000-00-00 00:00:00',
  `adults` int(10) unsigned default '0',
  `children` int(10) unsigned default '0',
  `infants` int(10) unsigned default '0',
  `message` text,
  `destinations` varchar(255) default NULL,
  `uri` varchar(255) default NULL,
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_tour_request`
--

/*!40000 ALTER TABLE `tv_tour_request` DISABLE KEYS */;
INSERT INTO `tv_tour_request` (`id`,`fullname`,`email`,`phone`,`fromdate`,`todate`,`adults`,`children`,`infants`,`message`,`destinations`,`uri`,`created_date`) VALUES 
 (1,'Le Thanh Phong','ltp_mv_huflit@yahoo.com','','0000-00-00 00:00:00','0000-00-00 00:00:00',1,0,0,'',NULL,NULL,'2013-04-03 20:33:42'),
 (2,'Le Thanh Phong','ltp_mv_huflit@yahoo.com','0933914822','0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0,'H',NULL,NULL,'2013-11-04 17:49:10'),
 (3,'Le Thanh Phong','ltp_mv_huflit@yahoo.com','0933914822','0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0,'H',NULL,NULL,'2013-11-04 17:49:23'),
 (4,'','','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0,'',NULL,'http://localhost/travelovietnam.com/vietnam/top-destinations/can-tho.html','2013-11-21 14:20:00'),
 (5,'','','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0,'',NULL,'http://localhost/travelovietnam.com/vietnam/top-destinations/can-tho.html','2013-11-21 14:20:09');
/*!40000 ALTER TABLE `tv_tour_request` ENABLE KEYS */;


--
-- Definition of table `tv_tour_tripnote`
--

DROP TABLE IF EXISTS `tv_tour_tripnote`;
CREATE TABLE `tv_tour_tripnote` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tour_id` int(10) unsigned NOT NULL default '0',
  `title` varchar(255) default NULL,
  `content` text,
  `order_num` int(10) unsigned default '0',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_tour_tripnote`
--

/*!40000 ALTER TABLE `tv_tour_tripnote` DISABLE KEYS */;
INSERT INTO `tv_tour_tripnote` (`id`,`tour_id`,`title`,`content`,`order_num`,`created_date`,`active`) VALUES 
 (1,1,'Map','<p>This is map</p>',0,'2013-10-22 09:18:50',1);
/*!40000 ALTER TABLE `tv_tour_tripnote` ENABLE KEYS */;


--
-- Definition of table `tv_tour_visit`
--

DROP TABLE IF EXISTS `tv_tour_visit`;
CREATE TABLE `tv_tour_visit` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `tour_id` bigint(20) unsigned NOT NULL,
  `destination_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_tour_visit`
--

/*!40000 ALTER TABLE `tv_tour_visit` DISABLE KEYS */;
/*!40000 ALTER TABLE `tv_tour_visit` ENABLE KEYS */;


--
-- Definition of table `tv_user`
--

DROP TABLE IF EXISTS `tv_user`;
CREATE TABLE `tv_user` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `uid` varchar(80) NOT NULL,
  `provider` varchar(20) NOT NULL default 'travelo',
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `password_text` varchar(45) default NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) default NULL,
  `fullname` varchar(255) default NULL,
  `gender` tinyint(1) NOT NULL default '1' COMMENT '1:Male; 0:Female',
  `birthday` varchar(45) default NULL,
  `nationality` varchar(45) default NULL,
  `user_type` int(10) unsigned NOT NULL default '2' COMMENT '-1:root; 0:admin; 1:moderator; 2:General',
  `edit_mode` int(10) unsigned NOT NULL default '1' COMMENT '0:R; 1:W',
  `active` tinyint(1) NOT NULL default '1',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_user`
--

/*!40000 ALTER TABLE `tv_user` DISABLE KEYS */;
INSERT INTO `tv_user` (`id`,`uid`,`provider`,`username`,`password`,`password_text`,`email`,`phone`,`fullname`,`gender`,`birthday`,`nationality`,`user_type`,`edit_mode`,`active`,`created_date`) VALUES 
 (1,'','travelo','admin','1a4783285b8737cf67a02ca2faaa2d78',NULL,'ltp_mv_huflit@yahoo.com',NULL,'Administrator',1,NULL,NULL,0,1,1,'2013-03-12 14:04:40'),
 (2,'','travelo','ltp_mv_huflit@yahoo.com','a80f1a51609f2e976cd916087f65b994','phongnhi','ltp_mv_huflit@yahoo.com','0933914822','Le Thanh Phong',1,'1970-01-01','Vietnam',2,1,1,'2013-04-10 05:35:11'),
 (3,'','travelo','','d05bae7bf7c4c74a6f42c0024e2e16b1','5270D1','','','',1,NULL,NULL,2,1,1,'2013-10-30 16:31:28'),
 (4,'670719074','facebook','ltp_mv_huflit@yahoo.com','',NULL,'ltp_mv_huflit@yahoo.com',NULL,'Le Thanh Phong',1,NULL,NULL,2,1,1,'2014-02-05 22:06:21');
/*!40000 ALTER TABLE `tv_user` ENABLE KEYS */;


--
-- Definition of table `tv_vietnam_destination`
--

DROP TABLE IF EXISTS `tv_vietnam_destination`;
CREATE TABLE `tv_vietnam_destination` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `destination_id` bigint(20) unsigned NOT NULL default '0',
  `gmap_address` varchar(255) default NULL,
  `title` varchar(255) default NULL,
  `alias` varchar(255) default NULL,
  `thumbnail` varchar(255) default NULL,
  `summary` text,
  `highlight` text,
  `content` text,
  `order_num` bigint(20) unsigned default '0',
  `meta_title` varchar(255) default NULL,
  `meta_key` varchar(255) default NULL,
  `meta_desc` varchar(255) default NULL,
  `lang` varchar(255) default 'EN',
  `active` tinyint(1) default '1',
  `created_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_vietnam_destination`
--

/*!40000 ALTER TABLE `tv_vietnam_destination` DISABLE KEYS */;
INSERT INTO `tv_vietnam_destination` (`id`,`destination_id`,`gmap_address`,`title`,`alias`,`thumbnail`,`summary`,`highlight`,`content`,`order_num`,`meta_title`,`meta_key`,`meta_desc`,`lang`,`active`,`created_date`) VALUES 
 (1,2,NULL,'Can Tho','can-tho','/travelovietnam.com/files/upload/image/travel-detail.jpg','<p>Vietnam isn\'t a paradise of shopping with expensive products of famous brands but there, surely you will find several interesting things to buy. Let hire a driver and depart for a shopping session! Tailoring: A traditional \"Ao Dai\" or styled clothes from silks can be made upon</p>','','',1,'','','','EN',1,'2013-11-21 17:00:29');
/*!40000 ALTER TABLE `tv_vietnam_destination` ENABLE KEYS */;


--
-- Definition of table `tv_visa_booking`
--

DROP TABLE IF EXISTS `tv_visa_booking`;
CREATE TABLE `tv_visa_booking` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `visa_type` varchar(255) NOT NULL,
  `embassies` text,
  `group_size` int(10) unsigned NOT NULL,
  `arrival_date` timestamp NOT NULL default '0000-00-00 00:00:00',
  `exit_date` timestamp NOT NULL default '0000-00-00 00:00:00',
  `arrival_port` varchar(255) NOT NULL,
  `rush_type` int(11) default '0' COMMENT '0: Normal; 1: urgent; 2:Super urgent',
  `rush_fee` double default '0',
  `visit_purpose` varchar(255) default NULL,
  `fast_checkin` tinyint(1) default '0',
  `car_pickup` tinyint(1) default '0',
  `car_type` varchar(255) default NULL,
  `seats` varchar(255) default NULL,
  `flight_number` varchar(255) default NULL,
  `arrival_time` varchar(255) default NULL,
  `primary_email` varchar(255) default NULL,
  `secondary_email` varchar(255) default NULL,
  `special_request` text,
  `visa_fee` double default '0',
  `total_visa_fee` double default '0',
  `car_fee` double default '0',
  `fast_checkin_fee` double default '0',
  `stamp_fee` double default '0',
  `promotion_code` varchar(6) default NULL,
  `discount` double default '0',
  `total_fee` double default '0',
  `user_id` bigint(20) unsigned default NULL,
  `payment_method` varchar(255) default NULL,
  `status` int(10) unsigned default '0' COMMENT '0: Unpaid; 1: Paid',
  `booking_key` varchar(255) default NULL,
  `booking_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_visa_booking`
--

/*!40000 ALTER TABLE `tv_visa_booking` DISABLE KEYS */;
/*!40000 ALTER TABLE `tv_visa_booking` ENABLE KEYS */;


--
-- Definition of table `tv_visa_pax`
--

DROP TABLE IF EXISTS `tv_visa_pax`;
CREATE TABLE `tv_visa_pax` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `book_id` bigint(20) unsigned default '0',
  `fullname` varchar(255) default NULL,
  `gender` varchar(255) default NULL,
  `birthdate` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `nationality` varchar(255) default NULL,
  `passport` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_visa_pax`
--

/*!40000 ALTER TABLE `tv_visa_pax` DISABLE KEYS */;
/*!40000 ALTER TABLE `tv_visa_pax` ENABLE KEYS */;


--
-- Definition of table `tv_visa_tips`
--

DROP TABLE IF EXISTS `tv_visa_tips`;
CREATE TABLE `tv_visa_tips` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(255) default NULL,
  `alias` varchar(255) default NULL,
  `nation` varchar(255) default NULL,
  `content` text,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_visa_tips`
--

/*!40000 ALTER TABLE `tv_visa_tips` DISABLE KEYS */;
/*!40000 ALTER TABLE `tv_visa_tips` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
