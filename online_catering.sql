/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 100137
Source Host           : localhost:3306
Source Database       : online_catering

Target Server Type    : MYSQL
Target Server Version : 100137
File Encoding         : 65001

Date: 2019-03-19 13:21:25
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bank_account
-- ----------------------------
DROP TABLE IF EXISTS `bank_account`;
CREATE TABLE `bank_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank` varchar(255) DEFAULT NULL,
  `account` varchar(255) DEFAULT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bank_account
-- ----------------------------

-- ----------------------------
-- Table structure for booked_services
-- ----------------------------
DROP TABLE IF EXISTS `booked_services`;
CREATE TABLE `booked_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date_notified` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of booked_services
-- ----------------------------
INSERT INTO `booked_services` VALUES ('1', '3', '2', '2019-02-07 12:39:37');
INSERT INTO `booked_services` VALUES ('2', '8', '1', '2019-02-28 21:23:38');

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('1', 'Wedding Service', '7ae1615c99bb3de428d05e445d540181.jpeg', '2019-02-07 12:03:36', '2019-02-07 12:44:43');
INSERT INTO `categories` VALUES ('2', 'Birthday Party', '5d55fea6677eadc60eba75227ed1b7dd.jpeg', '2019-02-07 12:03:56', '2019-02-07 12:44:52');
INSERT INTO `categories` VALUES ('3', 'Buffet Catering', '2bf19cf41ccbdc64442fdcf8fd3e9a0e.jpeg', '2019-02-07 12:04:15', '2019-02-21 10:26:41');
INSERT INTO `categories` VALUES ('4', 'Cocktail Reception', '31d31b112f3884bf011da668cca665ac.jpeg', '2019-02-07 12:04:26', '2019-02-07 12:45:13');

-- ----------------------------
-- Table structure for messages
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(255) DEFAULT NULL,
  `sender` int(11) DEFAULT '0',
  `receiver` int(11) DEFAULT '0',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of messages
-- ----------------------------
INSERT INTO `messages` VALUES ('1', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '3', '0', '2019-02-07 12:15:42');
INSERT INTO `messages` VALUES ('2', 'fds', '3', '0', '2019-02-21 10:25:38');

-- ----------------------------
-- Table structure for ordered_services
-- ----------------------------
DROP TABLE IF EXISTS `ordered_services`;
CREATE TABLE `ordered_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_date` date DEFAULT NULL,
  `event_time` time DEFAULT '00:00:00',
  `event_address` varchar(255) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `receipt` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '0' COMMENT '0-pending, 1-approved, 2-disapproved, 3-cancelled,4-done',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cancel_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ordered_services
-- ----------------------------
INSERT INTO `ordered_services` VALUES ('2', '2019-02-28', null, null, '1', '3', '3480b0662e0300e59e7934bf55c516dc.jpeg', '4', '2019-02-28 21:30:07', null, '2019-02-28 21:30:07');
INSERT INTO `ordered_services` VALUES ('3', '2019-03-02', null, null, '2', '3', '05856ee3487ce4aca8f0a0d5e20d42c5.jpeg', '3', '2019-02-28 21:29:57', '2019-02-28 14:21:54', '2019-02-28 21:29:57');
INSERT INTO `ordered_services` VALUES ('4', '2019-02-27', null, null, '1', '3', null, '2', '2019-03-04 19:56:58', null, '2019-03-04 19:56:58');
INSERT INTO `ordered_services` VALUES ('5', '2019-03-01', null, null, '1', '3', null, '2', '2019-03-04 19:56:15', null, '2019-03-04 19:56:15');
INSERT INTO `ordered_services` VALUES ('6', '2019-03-01', null, 'gayasi', '1', '3', null, '0', '2019-02-27 21:29:01', null, null);
INSERT INTO `ordered_services` VALUES ('7', '2019-02-09', null, 'aa', '1', '3', null, '0', '2019-02-27 21:30:11', null, null);
INSERT INTO `ordered_services` VALUES ('8', '2019-03-01', null, '12345', '2', '3', null, '4', '2019-03-04 20:03:28', null, '2019-03-04 20:03:28');
INSERT INTO `ordered_services` VALUES ('9', '2019-03-01', null, '12345', '2', '3', null, '4', '2019-02-28 21:23:30', null, '2019-02-28 21:23:30');
INSERT INTO `ordered_services` VALUES ('10', '2019-03-04', null, 'fds', '2', '5', null, '1', '2019-03-04 20:03:00', null, '2019-03-04 20:03:00');
INSERT INTO `ordered_services` VALUES ('11', '2019-03-14', '22:59:00', 'fsd', '1', '5', null, '0', '2019-03-13 20:37:56', null, null);
INSERT INTO `ordered_services` VALUES ('12', '2019-03-13', '01:59:00', '', '1', '5', null, '0', '2019-03-13 20:38:25', null, null);
INSERT INTO `ordered_services` VALUES ('13', '2019-03-13', '23:59:00', 'fsad', '1', '5', null, '0', '2019-03-13 20:42:28', null, null);
INSERT INTO `ordered_services` VALUES ('14', '0000-00-00', '00:00:00', '', '1', '5', null, '0', '2019-03-13 20:46:37', null, null);

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `price` varchar(255) DEFAULT NULL,
  `total_person` int(11) DEFAULT '0',
  `type` int(11) DEFAULT '0' COMMENT '0-wedding service, 1-birthday party, 2-buffet catering, 3-cocktail reception',
  `status` int(11) DEFAULT '1' COMMENT '1-available, 0-unavailable',
  `request_status` int(11) DEFAULT '0' COMMENT '0-created by admin, 1-created by seller pending, 2-approved, 3-disapproved ',
  `deleted` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT '0' COMMENT 'id from users who created',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('1', 'Sample Wedding Service Product', 'Package 1 :Economy \r\nPhp26,000 ALL IN for 100pax \r\n( P260/head + 2000 if below 100pax\r\n\r\n1. Plain Rice \r\n2. Soy Chicken \r\n3. Roast Pork in Gravy Sauce\r\n4. Fish Fillet with honey mustard dip \r\n5. Baked Macaroni \r\n6. Buco Pandan \r\n7. Bottomless Ice Tea \r\n8. Purified Ice Water\r\n\r\nInclusions:\r\n• Complete Catering Set up wth tables and Chairs\r\n• Simple Linen Stage Backdrop with Tiffany Chair\r\n• Artificial Flowers or Mylar/Foil Designed Balloon Centerpieces\r\n• Artificial Flowers or Balloon Buffet Centerpiece\r\n• Monobloc Chairs with cover and ribbon per motif', 'P 12345.00', '100', '1', '1', '0', '0', '1', '2019-02-07 12:06:16', '2019-03-04 11:15:29');
INSERT INTO `products` VALUES ('2', 'Sample Birthday Party Product', 'Package 1 :Economy \r\nPhp26,000 ALL IN for 100pax \r\n( P260/head + 2000 if below 100pax\r\n\r\n1. Plain Rice \r\n2. Soy Chicken \r\n3. Roast Pork in Gravy Sauce\r\n4. Fish Fillet with honey mustard dip \r\n5. Baked Macaroni \r\n6. Buco Pandan \r\n7. Bottomless Ice Tea \r\n8. Purified Ice Water\r\n\r\nInclusions:\r\n• Complete Catering Set up wth tables and Chairs\r\n• Simple Linen Stage Backdrop with Tiffany Chair\r\n• Artificial Flowers or Mylar/Foil Designed Balloon Centerpieces\r\n• Artificial Flowers or Balloon Buffet Centerpiece\r\n• Monobloc Chairs with cover and ribbon per motif', 'Php 26,000', '100', '2', '1', '2', '0', '4', '2019-02-07 12:33:07', '2019-03-04 11:32:57');
INSERT INTO `products` VALUES ('3', '3', '123', '123 pesos', '13', '1', '1', '1', '0', '4', '2019-02-27 20:39:41', '2019-02-27 20:47:49');

-- ----------------------------
-- Table structure for product_images
-- ----------------------------
DROP TABLE IF EXISTS `product_images`;
CREATE TABLE `product_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_url` varchar(255) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_images
-- ----------------------------
INSERT INTO `product_images` VALUES ('16', '757712d5da0f0036919bbe0f9e74adf6.jpeg', '1', '2019-02-07 12:45:39');
INSERT INTO `product_images` VALUES ('17', '210bd5d62b336d0de26c6bec89401f0a.jpeg', '1', '2019-02-07 12:45:39');
INSERT INTO `product_images` VALUES ('18', '8f9ec5cd558666c83ea2301c6588b550.jpeg', '1', '2019-02-07 12:45:39');
INSERT INTO `product_images` VALUES ('19', '7b2fe63278809712775c38226fd437cd.jpeg', '1', '2019-02-07 12:45:39');
INSERT INTO `product_images` VALUES ('20', '0c6ee42b301196ff17812943a6299172.jpeg', '1', '2019-02-07 12:45:39');
INSERT INTO `product_images` VALUES ('26', 'c0afa73b5dc3dfd70eca2491430348bd.jpeg', '3', '2019-02-27 20:39:41');
INSERT INTO `product_images` VALUES ('27', 'b124d5ac1ccc97ab556c0a61a06f5ccc.jpeg', '3', '2019-02-27 20:39:41');
INSERT INTO `product_images` VALUES ('28', 'a2d07c7b8ea6f3779f5d2fd1d04c8e2c.jpeg', '3', '2019-02-27 20:39:41');
INSERT INTO `product_images` VALUES ('29', '7e57675694e57bf8cf4b81598d3cb80f.jpeg', '3', '2019-02-27 20:39:41');
INSERT INTO `product_images` VALUES ('30', 'bfafe84f52381cdab986f68283b7e357.jpeg', '3', '2019-02-27 20:39:41');
INSERT INTO `product_images` VALUES ('31', '5c8c61987f8ca74a6948d30a351771d3.jpeg', '2', '2019-03-04 11:30:57');
INSERT INTO `product_images` VALUES ('32', 'd7d19b30a15e92307a516614a13c0d36.jpeg', '2', '2019-03-04 11:30:57');
INSERT INTO `product_images` VALUES ('33', '4117e7295437bdd003f466a476aded1e.jpeg', '2', '2019-03-04 11:30:57');
INSERT INTO `product_images` VALUES ('34', 'f2d9814f8dd0886e9aa9d6fa0044d8cc.jpeg', '2', '2019-03-04 11:30:57');
INSERT INTO `product_images` VALUES ('35', 'c9de3aaa0be67e2f54d823e50038ce18.jpeg', '2', '2019-03-04 11:30:57');
INSERT INTO `product_images` VALUES ('36', 'c5eccb13bba4ea089865c843779f1fcd.jpeg', '2', '2019-03-04 11:31:40');
INSERT INTO `product_images` VALUES ('37', '277973748b39c56c9fd48a60092e784e.jpeg', '2', '2019-03-04 11:31:40');
INSERT INTO `product_images` VALUES ('38', '7f9f57dc822329af46fe76ac10e96012.jpeg', '2', '2019-03-04 11:31:40');

-- ----------------------------
-- Table structure for reviews
-- ----------------------------
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of reviews
-- ----------------------------
INSERT INTO `reviews` VALUES ('1', '2', null, 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2019-02-07 12:22:47');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT '' COMMENT 'address for customer, store address for seller',
  `avatar` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT '',
  `shop_name` varchar(255) DEFAULT '' COMMENT 'for seller only',
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `type` int(11) DEFAULT '2' COMMENT '2:customer; 1:seller; 0:admin, -1:super',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'super', 'admin', 'super address', null, '09123456789', '', 'super@catering.com', 'super', '$2y$10$k7lgx1esnbDjIy.Ity0DqOJLrqNCZg9WKjHeVgNTB6L30cucWW952', '-1', '2019-02-07 11:58:43', '2019-02-07 11:58:54');
INSERT INTO `users` VALUES ('2', 'admin', 'admin', '', null, '09987654321', '', 'admin@catering', 'admin', '$2y$10$TW1DUb5d5724Mm/veebhx.exUZh.UhfiYfaqZkc8LN6mRXbkNn.6W', '0', '2019-02-07 11:59:54', '2019-02-07 12:02:56');
INSERT INTO `users` VALUES ('3', 'Customer', 'Custom', 'cus addres', null, '09876543211', '', 'customer@catering', 'customer', '$2y$10$dFpwW5k3uhwPJGh22Zk3yeoEH.wE4eppMsQrPVJJ4LGgMjG1Ciw02', '2', '2019-02-07 12:01:49', '2019-02-07 12:29:02');
INSERT INTO `users` VALUES ('4', 'Seller', 'Sell', 'shop address', null, '09876543212', 'seller shop', 'seller@catering', 'seller', '$2y$10$a77IAYNBA0.hPl0F..fBX.b7aV9Jr9H.3fBkraCaBGfInV7yGZlIy', '1', '2019-02-07 12:32:04', null);
INSERT INTO `users` VALUES ('5', 'cus', 'tom', 'asdf', null, '123456789', '', 'cus@gmail.com', 'cus', '$2y$10$eI82q2EoN1MfXsgdNRPCn.ixcgYLUkO51b10FN1d0ug.NCFZrvKeu', '2', '2019-03-04 09:53:11', null);
