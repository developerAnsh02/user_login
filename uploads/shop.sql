-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2023 at 09:07 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_pages`
--

CREATE TABLE `active_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `active_pages`
--

INSERT INTO `active_pages` (`id`, `name`, `enabled`) VALUES
(1, 'blog', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `iban` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `bic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `name`, `iban`, `bank`, `bic`) VALUES
(1, 'fgghgh', 'w453443545345', '4353454', '434534534');

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `time` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `image`, `url`, `time`) VALUES
(1, 'main.jpg', 'sdwqdsdfd_1', 1685953031);

-- --------------------------------------------------------

--
-- Table structure for table `blog_translations`
--

CREATE TABLE `blog_translations` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `for_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `blog_translations`
--

INSERT INTO `blog_translations` (`id`, `title`, `description`, `abbr`, `for_id`) VALUES
(1, '', '<p>fsdadrfsdfsdfgertfgdfgfgdfg</p>\r\n', 'bg', 1),
(2, 'sdwqdsdfd2343434234', '<p>gdfgdfgertflkjgr3tuiopjhjklvbnjkh</p>\r\n\r\n<p>g</p>\r\n\r\n<p>g</p>\r\n', 'en', 1),
(3, '32321321', '', 'gr', 1),
(4, '', '', 'id', 1),
(5, '', '', 'fr', 1);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `confirm_links`
--

CREATE TABLE `confirm_links` (
  `id` int(11) NOT NULL,
  `link` char(32) NOT NULL,
  `for_order` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `confirm_links`
--

INSERT INTO `confirm_links` (`id`, `link`, `for_order`) VALUES
(1, 'b497bcd2c458d9376ae4b3c206b994ce', 1234),
(2, '8f97a89a0ed8bea91bfd93ba1037ee9e', 1235),
(3, 'ef6dd92545c9462b99b5abd0efd54634', 1236);

-- --------------------------------------------------------

--
-- Table structure for table `cookie_law`
--

CREATE TABLE `cookie_law` (
  `id` int(10) UNSIGNED NOT NULL,
  `link` varchar(255) NOT NULL,
  `theme` varchar(20) NOT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cookie_law`
--

INSERT INTO `cookie_law` (`id`, `link`, `theme`, `visibility`) VALUES
(1, '', 'dark-bottom', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cookie_law_translations`
--

CREATE TABLE `cookie_law_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `message` varchar(255) NOT NULL,
  `button_text` varchar(50) NOT NULL,
  `learn_more` varchar(50) NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `for_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cookie_law_translations`
--

INSERT INTO `cookie_law_translations` (`id`, `message`, `button_text`, `learn_more`, `abbr`, `for_id`) VALUES
(1, '', '', '', 'bg', 1),
(2, '', '', '', 'en', 1),
(3, '', '', '', 'gr', 1),
(4, '', '', '', 'id', 1),
(5, '', '', '', 'fr', 1);

-- --------------------------------------------------------

--
-- Table structure for table `discount_codes`
--

CREATE TABLE `discount_codes` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(10) NOT NULL,
  `code` varchar(10) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `valid_from_date` int(10) UNSIGNED NOT NULL,
  `valid_to_date` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1-enabled, 0-disabled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(10) UNSIGNED NOT NULL,
  `activity` varchar(255) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `time` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `currencyKey` varchar(5) NOT NULL,
  `flag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `abbr`, `name`, `currency`, `currencyKey`, `flag`) VALUES
(1, 'bg', 'bulgarian', 'лв', 'BGN', 'bg.jpg'),
(2, 'en', 'english', '$', 'USD', 'en.jpg'),
(3, 'gr', 'greece', 'EUR', 'EUR', 'gr.png'),
(4, 'id', 'indonesian', 'RP', 'IDR', 'id.jpg'),
(5, 'fr', 'francais', 'EUR', 'EUR', 'fr.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'point to public_users ID',
  `products` text NOT NULL,
  `date` int(10) UNSIGNED NOT NULL,
  `referrer` varchar(255) NOT NULL,
  `clean_referrer` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `paypal_status` varchar(10) DEFAULT NULL,
  `processed` tinyint(1) NOT NULL DEFAULT 0,
  `viewed` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'viewed status is change when change processed status',
  `confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `discount_code` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `user_id`, `products`, `date`, `referrer`, `clean_referrer`, `payment_type`, `paypal_status`, `processed`, `viewed`, `confirmed`, `discount_code`) VALUES
(1, 1234, 0, 'a:1:{i:0;a:2:{s:12:\"product_info\";a:17:{s:11:\"vendor_name\";N;s:9:\"vendor_id\";s:1:\"0\";s:2:\"id\";s:1:\"3\";s:6:\"folder\";s:10:\"1685952566\";s:5:\"image\";s:14:\"PUMPIT_(2).png\";s:4:\"time\";s:10:\"1685952603\";s:11:\"time_update\";s:10:\"1685952661\";s:10:\"visibility\";s:1:\"1\";s:14:\"shop_categorie\";s:1:\"2\";s:8:\"quantity\";s:1:\"2\";s:11:\"procurement\";s:1:\"0\";s:9:\"in_slider\";s:1:\"0\";s:3:\"url\";s:6:\"hjhg_3\";s:16:\"virtual_products\";N;s:8:\"brand_id\";N;s:8:\"position\";s:2:\"10\";s:5:\"price\";s:2:\"30\";}s:16:\"product_quantity\";s:1:\"1\";}}', 1685952709, 'Direct', 'Direct', 'cashOnDelivery', NULL, 1, 1, 0, ''),
(2, 1235, 0, 'a:1:{i:0;a:2:{s:12:\"product_info\";a:17:{s:11:\"vendor_name\";N;s:9:\"vendor_id\";s:1:\"0\";s:2:\"id\";s:1:\"3\";s:6:\"folder\";s:10:\"1685952566\";s:5:\"image\";s:14:\"PUMPIT_(2).png\";s:4:\"time\";s:10:\"1685952603\";s:11:\"time_update\";s:10:\"1685952661\";s:10:\"visibility\";s:1:\"1\";s:14:\"shop_categorie\";s:1:\"2\";s:8:\"quantity\";s:1:\"1\";s:11:\"procurement\";s:1:\"1\";s:9:\"in_slider\";s:1:\"0\";s:3:\"url\";s:6:\"hjhg_3\";s:16:\"virtual_products\";N;s:8:\"brand_id\";N;s:8:\"position\";s:2:\"10\";s:5:\"price\";s:2:\"30\";}s:16:\"product_quantity\";s:1:\"1\";}}', 1685952910, 'http://localhost/Ecommerce-CodeIgniter-Bootstrap-master/shopping-cart', 'localhost', 'cashOnDelivery', NULL, 1, 1, 0, ''),
(3, 1236, 0, 'a:2:{i:0;a:2:{s:12:\"product_info\";a:17:{s:11:\"vendor_name\";N;s:9:\"vendor_id\";s:1:\"0\";s:2:\"id\";s:1:\"3\";s:6:\"folder\";s:10:\"1685952566\";s:5:\"image\";s:14:\"PUMPIT_(2).png\";s:4:\"time\";s:10:\"1685952603\";s:11:\"time_update\";s:10:\"1685953402\";s:10:\"visibility\";s:1:\"1\";s:14:\"shop_categorie\";s:1:\"2\";s:8:\"quantity\";s:2:\"12\";s:11:\"procurement\";s:1:\"2\";s:9:\"in_slider\";s:1:\"0\";s:3:\"url\";s:6:\"hjhg_3\";s:16:\"virtual_products\";N;s:8:\"brand_id\";N;s:8:\"position\";s:2:\"10\";s:5:\"price\";s:2:\"30\";}s:16:\"product_quantity\";s:1:\"1\";}i:1;a:2:{s:12:\"product_info\";a:17:{s:11:\"vendor_name\";N;s:9:\"vendor_id\";s:1:\"0\";s:2:\"id\";s:1:\"4\";s:6:\"folder\";s:10:\"1685953559\";s:5:\"image\";s:5:\"2.png\";s:4:\"time\";s:10:\"1685953590\";s:11:\"time_update\";s:1:\"0\";s:10:\"visibility\";s:1:\"1\";s:14:\"shop_categorie\";s:1:\"2\";s:8:\"quantity\";s:2:\"12\";s:11:\"procurement\";s:1:\"0\";s:9:\"in_slider\";s:1:\"0\";s:3:\"url\";s:13:\"new_product_4\";s:16:\"virtual_products\";N;s:8:\"brand_id\";N;s:8:\"position\";s:1:\"4\";s:5:\"price\";s:2:\"12\";}s:16:\"product_quantity\";s:1:\"3\";}}', 1685953743, 'http://localhost/Ecommerce-CodeIgniter-Bootstrap-master/shopping-cart', 'localhost', 'cashOnDelivery', NULL, 1, 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `orders_clients`
--

CREATE TABLE `orders_clients` (
  `id` int(11) NOT NULL,
  `first_name` varchar(500) NOT NULL,
  `last_name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `phone` varchar(500) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(500) NOT NULL,
  `post_code` varchar(500) NOT NULL,
  `notes` text NOT NULL,
  `for_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders_clients`
--

INSERT INTO `orders_clients` (`id`, `first_name`, `last_name`, `email`, `phone`, `address`, `city`, `post_code`, `notes`, `for_id`) VALUES
(1, '466328e342b28d1d4f82215dcfc8ac90bf973dc376d97400923ffca17b4cbb144ee9d260273f68706464fb463140dd31a06a0b6a744b4fef20ca513d65505fefEtvuoaLrh66yfj4iQU8YhBaGXPKvQUrylYafA7q4Pec=', '7fdd0a137151c4a529930ee43373279fce6bbe5b454fd471837e6b0eb327eeffb775ce0901712cc8201c5bb7d9cfb34199e4bd07ecf629532046ff38bdc1be7dBFYR5yq7VCxl+8oJHupxKUK/bse7jc5XgGoelqhg1/4=', '78612a4b0e8016930a081856673ddb55de555fcbf9d994967b60dc597bdea33881e6ddde5514452332df3ceee5df71394fb9aeab902ad2c046abf7abc98d4d0a6NPEjncL25DTLX6HzAVEMVYqglKwFGPJ2DyJSppY9RtcVpcOaQMLejG2KaAR9R3O', '67fb5bcd0bf3f6b9f518e0c526c03f7a17c569b912e4644204fa015ba8cf10c498aada2df87b83dafac727ad4025fa941117c37c5d0d5d0c905bfba1dd5d0a43ls82klCVAfMAQeXCklhkMB7Yocv2i+W2uuAnJp5qysw=', 'c7c099908520eee6c66412afa68023884158bcb905a3b15252d425a70da4d1bcccd1ebe57183457c6dd3da031152d87ddab3d3f083b9bdd44300a9a428b37182IrqPYueTjjiE4ZHUkKNQ8zCLazlZF5w+UehPN1gJKXlSqS6McirDzakRNcyW1jxk', 'd1959f08766a8c3e1c256d1e954f332f0f9e85d908a3f80aad352bb0b9ae9af70a76c260873a81acb33126b06ef833a70c06fcb2fbff119fdb83be47754798faGGWxV/ZJr6drTJBn2vD3O5wQjBB1oZjwHZXGiPvk6oU=', '0d04d3410ded1213d60b2a973463fb944b66b53dbc618c3e5caec15e1baecf79444cd510ab837243248b9925597c5028e77c3d4032310014e3c7a229a063fcaba9JQqKNybO/Js3hP2YvV2o/6Mtqf8Tfm69E/lYAnAf8=', 'eacd972a1f1a9641f080031e8a2135bd14491be1599d9a2aa33fda9b844e4b33beb4e5003f3b25b8249d52d32be64569ba5513eb87686be08b417058b8eb3cdfmJNlNcZAM+AbXUR4nMsm1nx0qjJMlKzFFemQDHz6QKo=', 1),
(2, 'c4228dca7d42e7dc0d5a64e7dbca4f7c619b6bfd8e6de788464b5359ea5bc4d895219b7b3cbe674b6851774f986a488f018fc7cf4015fa9a7fbce80468786decCfOQk9gs85cw9NwURychzOcg1DqSYpj6iZK2QYmVQGY=', 'b38c577a1db5bb086cf0cbd6fb2de09f0dab7e38af6403dda0dc6e21ceadea5465ee3c018ebc91cc2dc32acaf7d12d15234e3f2585f111048f83949007c27433HQz97Ueh7iscQKSfsBq0lHynxyhcvNS90eaHxlzHtRg=', '4bb9572f311a0e1366116a01161e0b6db582524d94fdbe9b3e78bb8cf52a5b16db1ed700e3b894f31a7953e3fca5be097f6e80334d29e24ea78cf0d77753bdc1hLBU0UGEsBteWbFxs3cHX4vauY3U3TPwHFDD9gYiTw4=', '461fbef9c7cc25b5bf29a633abf4f2f75c5265e96a90f62f0e9903022c0d845fedf2c0805e6a6427f5341fe3572236b26e423c1a7aaf8cdf9b280266c9771ab6lrojfklwebhamXYvGUqCYK9yOCn++mohtUOY4hFBil4=', '04474a016036fc8a7a312891c723396310a3fa0b7141cfd02ab76f9a0eb3eff0681b0f3166eaffe2b13209319365a14cbf29a8092103158d70d7e5d8c8678eb3ICF+LObNhIFs7wIzNKtWOktzUuSMurLHBrr6snFClc/IEXInp1GwXpfMxLd/O2dF', '1895dcffc067393f30e3c39eee957d74cc99e0f01793e446572dccc0b419433b52c081cc13225125b55e72aff110a4374f51ee11c0ce14b4825d1725c7e6e723m6Oiif6KvoinZdTm7KnI0VkIDdqbDm/F5RrrMG+mMd4=', 'abd5b538bd5d91ba7f29bb6bf0d088519f4600e5b7b1be883481757123947e4b802526a0774fc9635161b518d2f859327074a51ee4978536f15e3ddc29449059sHMw/DaBP6VAc5+YadmYhcSu7Aa3zsUMJOoS/1V71S4=', '1c811bb9d49cfcd130c07956073b547d70ba30e38ccf20b029bddd877936d2782f7bedd3d294e8b0ef12ca7925f879e8060aeb7f5816016a69c3b23462228bfaWMj7l5jAOHMcqn2Nu+jlt3Xb55RpKaKaq9T7SNOszRw=', 2),
(3, 'ead95127745d6e71bc9cf8c524471d8071b9d362e33982df02780bc32a3e33d593b1c11c8ce5b0b89ad1f207424feff23eb69682ff03d77d11cba43f3c5c9da6Q1QwRVbBCjNjkIsj55F9Q3nxesW9tidA3jnuixTpOkg=', '35394642e7cf9cca6fad6b0acc9d137662e0838e21dfafb5c055bd3ab007e0cbca6d2831c90603a485772b18ed01360cafdee5f97d43a37142adf303d5aeee45LZLO2RwiciHCfFiHBvpZ6hOx0/RZ6AU3vIsbqAVfITo=', '8d778465d23bcc51d9d5f21523ee5b7ddee77c64ae243ee62e2c17e6f5417274b15357fbab20dee971cf69eaecdf0a373b29c79245d1eadd1ddb175876191efbp86LgbMr9NA8dnXHRTMi/ISZMGJTl9vorrqiZ44Vz/k87/bkgCEJce6EwyHnQuf8', 'a788a7789bb78fcb63f23a8fa1a354031c641df5eefd68cb21f59d3b7572f43f929d12c229a9707e914950cf84cd1b8764801e89d45ed9d6468bf159b0eb09b1NDuNe5XfSBw+j4g3hgzKCzCR0Lw0P1QjqfO2oIa1zKs=', 'f2a4f134bb7af987c5e79fc03be09061b4884ed38c5d1997a97b4e4a3e88dc47627830708bc3142a7ba5a1acc8f86cad57bc7ce8e7001f454ef18ebacdd08ed6MhzZVgBBIvQaSI2hPlAJxOKU7VvyE+TjEaKpj9QM7Ff5R/tXkQtbIgJFKdVH4omz', '61aca0aa65209f8e4675157e6b258fbc391d450b56f4893ede7512f98f5577eb83e1bf2ccdbf9dc011feec598da58c3b1a0a195ddfdf95d70e72288d6ade285fJOC81/Pa3waq6dtygZeKqBsHkESJQdlP+EPhGE2H61Y=', '4b9dbe1d796f57b12ad237e11dd9fd80faf61343003b1af201130405c28692a9b3b0cce81ed8cec2010b89a7d75f77766d4c122ffae678414fb132170f88c386/KjKgVFehXvNKXnhia5f2jXDcc7/uovZgNIfUX28XHM=', 'c5091f6f69e489c7faf395c1027223dfc34dc04682ca865876ff2b2495904348045566b18968204fc8f896177411a3f87d0560ebc15e41d81c5b9736b9849cb02kBRFnfEuZFwE2ggvfLReccv0Y2mHsOB/hJCTdu3VYk=', 3);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `folder` int(10) UNSIGNED DEFAULT NULL COMMENT 'folder with images',
  `image` varchar(255) NOT NULL,
  `time` int(10) UNSIGNED NOT NULL COMMENT 'time created',
  `time_update` int(10) UNSIGNED NOT NULL COMMENT 'time updated',
  `visibility` tinyint(1) NOT NULL DEFAULT 1,
  `shop_categorie` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `procurement` int(10) UNSIGNED NOT NULL,
  `in_slider` tinyint(1) NOT NULL DEFAULT 0,
  `url` varchar(255) NOT NULL,
  `virtual_products` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `brand_id` int(5) DEFAULT NULL,
  `position` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `folder`, `image`, `time`, `time_update`, `visibility`, `shop_categorie`, `quantity`, `procurement`, `in_slider`, `url`, `virtual_products`, `brand_id`, `position`, `vendor_id`) VALUES
(1, 1685952035, 'wev.jpg', 1685952079, 1685952643, 1, 1, 11, 0, 1, 'peanut_buttor_1', NULL, NULL, 4, 0),
(2, 1685952282, 'image1.jpeg', 1685952334, 1685953427, 1, 5, 2, 0, 1, 'hfghfh_2', NULL, NULL, 4, 0),
(3, 1685952566, 'PUMPIT_(2).png', 1685952603, 1685953402, 1, 2, 11, 3, 0, 'hjhg_3', NULL, NULL, 10, 0),
(4, 1685953559, '2.png', 1685953590, 0, 1, 2, 9, 3, 0, 'new_product_4', NULL, NULL, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products_translations`
--

CREATE TABLE `products_translations` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `basic_description` text NOT NULL,
  `price` varchar(20) NOT NULL,
  `old_price` varchar(20) NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `for_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products_translations`
--

INSERT INTO `products_translations` (`id`, `title`, `description`, `basic_description`, `price`, `old_price`, `abbr`, `for_id`) VALUES
(1, '', '', '', '', '', 'bg', 1),
(2, 'peanut buttor', '<p>dfgerasdfsd</p>\r\n', '', '11', '111', 'en', 1),
(3, '', '', '', '', '', 'gr', 1),
(4, '', '', '', '', '', 'id', 1),
(5, '', '', '', '', '', 'fr', 1),
(6, '', '', '', '', '', 'bg', 2),
(7, 'hfghfh', '', '', '30', '45', 'en', 2),
(8, '', '', '', '', '', 'gr', 2),
(9, '', '', '', '', '', 'id', 2),
(10, '', '', '', '', '', 'fr', 2),
(11, '', '', '', '', '', 'bg', 3),
(12, 'hjhg', '<p>dfsassadsad</p>\r\n\r\n<p>fghtetyer<br />\r\nsdfsdfgdf gerg fggwdrt rgert4 wr</p>\r\n', '', '30', '111', 'en', 3),
(13, '', '', '', '', '', 'gr', 3),
(14, '', '', '', '', '', 'id', 3),
(15, '', '', '', '', '', 'fr', 3),
(16, '', '', '', '', '', 'bg', 4),
(17, 'new product', '<p>new 1</p>\r\n', '', '12', '15', 'en', 4),
(18, '', '', '', '', '', 'gr', 4),
(19, '', '', '', '', '', 'id', 4),
(20, '', '', '', '', '', 'fr', 4);

-- --------------------------------------------------------

--
-- Table structure for table `seo_pages`
--

CREATE TABLE `seo_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `seo_pages`
--

INSERT INTO `seo_pages` (`id`, `name`) VALUES
(1, 'home'),
(2, 'checkout'),
(3, 'contacts'),
(4, 'blog');

-- --------------------------------------------------------

--
-- Table structure for table `seo_pages_translations`
--

CREATE TABLE `seo_pages_translations` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `page_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_categories`
--

CREATE TABLE `shop_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `sub_for` int(11) NOT NULL,
  `position` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `shop_categories`
--

INSERT INTO `shop_categories` (`id`, `sub_for`, `position`) VALUES
(1, 0, 0),
(2, 0, 0),
(3, 4, 0),
(4, 0, 0),
(5, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shop_categories_translations`
--

CREATE TABLE `shop_categories_translations` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `for_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `shop_categories_translations`
--

INSERT INTO `shop_categories_translations` (`id`, `name`, `abbr`, `for_id`) VALUES
(1, '', 'bg', 1),
(2, 'buttor', 'en', 1),
(3, '', 'gr', 1),
(4, '', 'id', 1),
(5, '', 'fr', 1),
(6, '', 'bg', 2),
(7, 'asasaasasa', 'en', 2),
(8, '', 'gr', 2),
(9, '', 'id', 2),
(10, '', 'fr', 2),
(11, '', 'bg', 3),
(12, 'sassadsdey764', 'en', 3),
(13, '', 'gr', 3),
(14, '', 'id', 3),
(15, '', 'fr', 3),
(16, '', 'bg', 4),
(17, 'dfdsfrtwert345454543', 'en', 4),
(18, '', 'gr', 4),
(19, '', 'id', 4),
(20, '', 'fr', 4),
(21, '', 'bg', 5),
(22, 'r345345fbvcvg345', 'en', 5),
(23, '', 'gr', 5),
(24, '', 'id', 5),
(25, '', 'fr', 5);

-- --------------------------------------------------------

--
-- Table structure for table `subscribed`
--

CREATE TABLE `subscribed` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `subscribed`
--

INSERT INTO `subscribed` (`id`, `email`, `browser`, `ip`, `time`) VALUES
(1, 'ansh@gmail.com', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', '::1', '1685952496');

-- --------------------------------------------------------

--
-- Table structure for table `textual_pages_tanslations`
--

CREATE TABLE `textual_pages_tanslations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `abbr` varchar(5) NOT NULL,
  `for_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(100) NOT NULL,
  `notify` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'notifications by email',
  `last_login` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `notify`, `last_login`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'your@email.com', 0, 1686026988);

-- --------------------------------------------------------

--
-- Table structure for table `users_public`
--

CREATE TABLE `users_public` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `value_store`
--

CREATE TABLE `value_store` (
  `id` int(10) UNSIGNED NOT NULL,
  `thekey` varchar(50) NOT NULL,
  `value` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `value_store`
--

INSERT INTO `value_store` (`id`, `thekey`, `value`) VALUES
(1, 'sitelogo', '1.png'),
(2, 'navitext', ''),
(3, 'footercopyright', 'Your organization.'),
(4, 'contactspage', 'Hello dear client'),
(5, 'footerContactAddr', ''),
(6, 'footerContactEmail', 'support@shop.dev'),
(7, 'footerContactPhone', ''),
(8, 'googleMaps', '42.671840, 83.279163'),
(9, 'footerAboutUs', ''),
(10, 'footerSocialFacebook', ''),
(11, 'footerSocialTwitter', ''),
(12, 'footerSocialGooglePlus', ''),
(13, 'footerSocialPinterest', ''),
(14, 'footerSocialYoutube', ''),
(16, 'contactsEmailTo', 'contacts@shop.dev'),
(17, 'shippingOrder', '1'),
(18, 'addJs', ''),
(19, 'publicQuantity', '0'),
(20, 'paypal_email', ''),
(21, 'paypal_sandbox', '0'),
(22, 'publicDateAdded', '0'),
(23, 'googleApi', ''),
(24, 'template', 'clothesshop'),
(25, 'cashondelivery_visibility', '1'),
(26, 'showBrands', '0'),
(27, 'showInSlider', '0'),
(28, 'codeDiscounts', '1'),
(29, 'virtualProducts', '0'),
(30, 'multiVendor', '0'),
(31, 'outOfStock', '0'),
(32, 'hideBuyButtonsOfOutOfStock', '0'),
(33, 'moreInfoBtn', ''),
(34, 'refreshAfterAddToCart', '0');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `url` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendors_orders`
--

CREATE TABLE `vendors_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `products` text NOT NULL,
  `date` int(10) UNSIGNED NOT NULL,
  `referrer` varchar(255) NOT NULL,
  `clean_referrer` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `paypal_status` varchar(10) DEFAULT NULL,
  `processed` tinyint(1) NOT NULL DEFAULT 0,
  `viewed` tinyint(1) NOT NULL DEFAULT 0,
  `confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `discount_code` varchar(20) NOT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendors_orders_clients`
--

CREATE TABLE `vendors_orders_clients` (
  `id` int(11) NOT NULL,
  `first_name` varchar(500) NOT NULL,
  `last_name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `phone` varchar(500) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(500) NOT NULL,
  `post_code` varchar(500) NOT NULL,
  `notes` text NOT NULL,
  `for_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_pages`
--
ALTER TABLE `active_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `blog_translations`
--
ALTER TABLE `blog_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `confirm_links`
--
ALTER TABLE `confirm_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cookie_law`
--
ALTER TABLE `cookie_law`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cookie_law_translations`
--
ALTER TABLE `cookie_law_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE` (`abbr`,`for_id`) USING BTREE;

--
-- Indexes for table `discount_codes`
--
ALTER TABLE `discount_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_clients`
--
ALTER TABLE `orders_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_translations`
--
ALTER TABLE `products_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_pages`
--
ALTER TABLE `seo_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_pages_translations`
--
ALTER TABLE `seo_pages_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_categories`
--
ALTER TABLE `shop_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_categories_translations`
--
ALTER TABLE `shop_categories_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribed`
--
ALTER TABLE `subscribed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `textual_pages_tanslations`
--
ALTER TABLE `textual_pages_tanslations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_public`
--
ALTER TABLE `users_public`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `value_store`
--
ALTER TABLE `value_store`
  ADD PRIMARY KEY (`id`),
  ADD KEY `key` (`thekey`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique` (`email`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `vendors_orders`
--
ALTER TABLE `vendors_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors_orders_clients`
--
ALTER TABLE `vendors_orders_clients`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `active_pages`
--
ALTER TABLE `active_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog_translations`
--
ALTER TABLE `blog_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `confirm_links`
--
ALTER TABLE `confirm_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cookie_law`
--
ALTER TABLE `cookie_law`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cookie_law_translations`
--
ALTER TABLE `cookie_law_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `discount_codes`
--
ALTER TABLE `discount_codes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders_clients`
--
ALTER TABLE `orders_clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products_translations`
--
ALTER TABLE `products_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `seo_pages`
--
ALTER TABLE `seo_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seo_pages_translations`
--
ALTER TABLE `seo_pages_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_categories`
--
ALTER TABLE `shop_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shop_categories_translations`
--
ALTER TABLE `shop_categories_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `subscribed`
--
ALTER TABLE `subscribed`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `textual_pages_tanslations`
--
ALTER TABLE `textual_pages_tanslations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_public`
--
ALTER TABLE `users_public`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `value_store`
--
ALTER TABLE `value_store`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors_orders`
--
ALTER TABLE `vendors_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors_orders_clients`
--
ALTER TABLE `vendors_orders_clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
