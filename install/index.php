<?php
//include($_SERVER['DOCUMENT_ROOT'] . '/modules/config.php');
include('config.php');
//echo $modules;


echo 'Testing database connection<br>';

$con = mysql_connect($myserver,$username,$password);

@mysql_select_db($database) or die( "Unable to select database");
mysql_select_db($database, $con);


$sql = "CREATE TABLE IF NOT EXISTS `articles` (
  `ID` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `title` tinytext NOT NULL,
  `url` tinytext NOT NULL,
  `body` text NOT NULL,
  `category` tinytext NOT NULL,
  `author` tinytext NOT NULL,
  `date` tinytext NOT NULL,
  `test` longtext NOT NULL,
  PRIMARY KEY (`ID`)
)";
// Execute query
mysql_query($sql,$con);
echo 'Creating Table Articles<br/>';

$sql = "CREATE TABLE IF NOT EXISTS `article_cat` (
  `ID` int(4) NOT NULL AUTO_INCREMENT,
  `category` text NOT NULL,
  PRIMARY KEY (`ID`)
)" ;
// Execute query
mysql_query($sql,$con);
echo 'Creating Table Article Categories<br/>';



$sql = "CREATE TABLE IF NOT EXISTS `gamelink` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` tinytext,
  `url` tinytext,
  PRIMARY KEY (`ID`)
)" ;
// Execute query
mysql_query($sql,$con);
echo 'Creating Table Games<br/>';




$sql = "CREATE TABLE IF NOT EXISTS `jokes` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) DEFAULT NULL,
  `joke` text,
  PRIMARY KEY (`ID`),
  KEY `category` (`category`)
)" ;
// Execute query
mysql_query($sql,$con);
echo 'Creating Table Jokes<br/>';




$sql = "CREATE TABLE IF NOT EXISTS `joke_categories` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `category` (`category`)
)" ;
// Execute query
mysql_query($sql,$con);
echo 'Creating Table Joke Categories<br/>';




$sql = "CREATE TABLE IF NOT EXISTS `members` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(65) NOT NULL DEFAULT 'NOT NULL',
  `password` varchar(65) NOT NULL DEFAULT 'NOT NULL',
  `email` varchar(65) NOT NULL DEFAULT 'NOT NULL',
  `firstname` varchar(65) NOT NULL DEFAULT 'NOT NULL',
  `lastname` varchar(65) NOT NULL DEFAULT 'NOT NULL',
  `sig` varchar(100) NOT NULL,
  `pic` varchar(300) NOT NULL,
  `joindate` date NOT NULL,
  `exitdate` date NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
)";
// Execute query
mysql_query($sql,$con);
echo 'Creating Table Members<br/>';




$sql = "CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menutype` varchar(75) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `link` text,
  `type` varchar(50) NOT NULL DEFAULT '',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `parent` int(11) NOT NULL DEFAULT '0',
  `sublevel` int(11) DEFAULT '0',
  `ordering` int(11) DEFAULT '0',
  `imgname` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `componentid` (`menutype`,`published`),
  KEY `menutype` (`menutype`)
)";
// Execute query
mysql_query($sql,$con);
echo 'Creating Table Menus<br/>';
//////////////////////////////////////////

$sql = "INSERT INTO `menu` (`id`, `menutype`, `name`, `alias`, `link`, `type`, `published`, `parent`, `sublevel`, `ordering`, `imgname`) VALUES
(122, 'ScriptManager', 'Manager', 'Manager', '?page=modules/scripts/admin_scripts.php', '', 0, 0, 0, 0, 'http://media/images/cpanel/icon-48-menumgr.png'),
(121, 'ArticleManager', 'Categories', 'Categories', '?page=modules/articles/article_cat.php', '', 0, 0, 0, 0, 'http://media/images/cpanel/icon-48-stats.png'),
(120, 'ArticleManager', 'New', 'New', '?page=modules/articles/new_article.php', '', 0, 0, 0, 0, 'http://media/images/cpanel/icon-48-article-add.png'),
(119, 'ArticleManager', 'Manager', 'Manager', '?page=modules/articles/index.php', '', 0, 0, 0, 0, 'http://media/images/icons/Control-Panel.png'),
(117, 'MenuManager', 'Add', 'Add', '?page=modules/menu/add_categories.php', '', 0, 0, 0, 0, 'http://media/images/cpanel/icon-48-article-add.png'),
(116, 'MenuManager', 'Categories', 'Categories', '?page=modules/menu/categories.php', '', 0, 0, 0, 0, 'http://media/images/cpanel/icon-48-stats.png'),
(115, 'MenuManager', 'New', 'New', '?page=modules/menu/add_menus.php', '', 0, 0, 0, 0, 'http://media/images/cpanel/icon-48-menu.png'),
(114, 'MenuManager', 'Manager', 'Manager', '?page=modules/menu/index.php', '', 0, 0, 0, 0, 'http://media/images/cpanel/icon-48-menumgr.png'),
(112, 'cPanel', 'Hackers Database', 'Hackers Database', '?page=modules/txt2html/articles.php', '', 0, 0, 0, 0, 'http://media/images/cpanel/icon-48-static.png'),
(111, 'cPanel', 'Scripts Manager', 'Scripts Manager', '?page=modules/scripts/admin_scripts.php', '', 0, 0, 0, 0, 'http://media/images/cpanel/icon-48-cpanel.png'),
(110, 'cPanel', 'User Manager', 'User Manager', '?page=modules/admin/users/index.php', '', 0, 0, 0, 0, 'http://media/images/cpanel/icon-48-user.png'),
(109, 'cPanel', 'Playlist Manager', 'Playlist Manager', '?page=modules/playlist/index.php', '', 0, 0, 0, 0, 'http://media/images/cpanel/icon-48-menu.png'),
(108, 'cPanel', 'Media Manager', 'Media Manager', '?page=modules/video/index.php', '', 0, 0, 0, 0, 'http://media/images/cpanel/icon-48-extension.png'),
(107, 'cPanel', 'Menu Categories', 'Menu Categories', '?page=modules/menu/categories.php', '', 0, 0, 0, 0, 'http://media/images/cpanel/icon-48-category.png'),
(106, 'cPanel', 'Menu Manager', 'Menu Manager', '?page=modules/menu/index.php', '', 0, 0, 0, 0, 'http://media/images/cpanel/icon-48-menumgr.png'),
(105, 'cPanel', 'Global Configuration', 'Global Configuration', '?page=modules/admin/system/configuration.php', '', 0, 0, 0, 0, 'http://media/images/cpanel/icon-48-config.png'),
(104, 'cPanel', 'Tracking Manager', 'Tracking Manager', 'http://media/cgi-bin/axs/ax-admin.pl', '', 0, 0, 0, 0, 'http://media/images/cpanel/icon-48-module.png'),
(103, 'cPanel', 'Article Categories', 'Article Categories', '?page=modules/articles/article_cat.php', '', 0, 0, 0, 0, 'http://media/images/cpanel/icon-48-category.png'),
(101, 'cPanel', 'Add New Article', 'Add New Article', '?page=modules/articles/new_article.php', '', 0, 0, 0, 0, 'http://media/images/cpanel/icon-48-article-add.png'),
(102, 'cPanel', 'Article Manager', 'Article Manager', '?page=modules/articles/index.php', '', 0, 0, 0, 0, 'http://media/images/cpanel/icon-48-article.png'),
(92, 'usermenu', 'Logout', 'Logout', 'http://media/?page=modules/login/logout.php', '', 0, 0, 0, 0, NULL),
(88, 'mainmenu', 'Videos', 'Videos', '?page=modules/video/video.php', '', 0, 0, 0, 0, 'http://media/images/cpanel/icon-48-media.png'),
(86, 'usermenu', 'My Details', 'My Details', '?page=edit_user.php', '', 0, 0, 0, 0, NULL),
(85, 'usermenu', 'Home', 'Home', 'http://media/', '', 0, 0, 0, 0, NULL),
(133, 'cPanel', 'Logs', 'Logs', '?page=modules/admin/logs.php', '', 0, 0, 0, 0, 'http://media/images/icons/Document.png'),
(134, 'mainmenu', 'Games', 'Games', '?page=flash/index.php', '', 0, 0, 0, 0, 'http://media/images/icons/Favorites.png'),
(135, 'links', 'Links', 'Links', '?page=modules/links/index.php', '', 0, 0, 0, 0, 'http://media/images/icons/Favorites.png'),
(136, 'links', 'Game Links', 'Game Links', '?page=modules/links/gamelinks.php', '', 0, 0, 0, 0, 'http://media/images/icons/Chat.png'),
(142, 'mainmenu', 'Search', 'Search', '?page=search.php', '', 0, 0, 0, 0, 'http://media/images/menu/icon-32-search.png'),
(72, 'mainmenu', 'Home', 'Home', 'http://media', '', 0, 0, 0, 0, 'http://media/images/cpanel/icon-48-frontpage.png'),
(131, 'cPanel', 'PhpMyAdmin', 'PhpMyAdmin', 'https://media/phpmyadmin/', '', 0, 0, 0, 0, 'http://media/images/cpanel/logo_left.png'),
(123, 'ScriptManager', 'New', 'New', '?page=modules/scripts/new_script.php', '', 0, 0, 0, 0, 'http://media/images/cpanel/icon-48-article-add.png'),
(124, 'ScriptManager', 'Categories', 'Categories', '?page=modules/scripts/scripts_cat.php', '', 0, 0, 0, 0, 'http://media/images/cpanel/icon-48-stats.png'),
(125, 'ScriptManager', 'View Scripts', 'View Scripts', '?page=modules/scripts/scripts.php', '', 0, 0, 0, 0, 'http://media/images/cpanel/icon-48-cpanel.png'),
(126, 'VideoManager', 'Manager', 'Manager', '?page=modules/video/index.php', '', 0, 0, 0, 0, 'http://media/images/cpanel/icon-48-menumgr.png'),
(127, 'VideoManager', 'New', 'New', '?page=modules/video/add1.php', '', 0, 0, 0, 0, 'http://media/images/cpanel/icon-48-article-add.png'),
(128, 'cPanel', 'Joke Manager', 'Joke Manager', '?page=modules/jokes/index.php', '', 0, 0, 0, 0, 'http://media/images/icons/Alert.png'),
(129, 'mainmenu', 'Jokes', 'Jokes', '?page=modules/jokes/view.php', '', 0, 0, 0, 0, 'http://media/images/icons/Chat.png'),
(130, 'cPanel', 'Optimize Database', 'Optimize Database', '?page=modules/admin/Optimize_Database.php', '', 0, 0, 0, 0, 'http://media/images/icons/Control-Panel.png')";
// Execute query
mysql_query($sql,$con);
echo 'Adding Menus<br/>';
/////////////////////////////////////////




$sql = "CREATE TABLE IF NOT EXISTS `menu_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menutype` varchar(75) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `menutype` (`menutype`)
)";
// Execute query
mysql_query($sql,$con);
echo 'Creating Table Menu Types<br/>';




$sql = "CREATE TABLE IF NOT EXISTS `tracking` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ipaddress` varchar(50) NOT NULL,
  `date` text NOT NULL,
  `url` varchar(50) NOT NULL,
  `msg` text NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
)";
// Execute query
mysql_query($sql,$con);
echo 'Creating Table Tracking<br/>';




$sql = "CREATE TABLE IF NOT EXISTS `video` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` tinytext,
  `year` tinytext NOT NULL,
  `url` text,
  `url2` text,
  `body` longtext,
  `image` text,
  `imdb` text,
  `tags` text NOT NULL,
  `rank` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
)";
// Execute query
mysql_query($sql,$con);
echo 'Creating Table Videos<br/>';


echo 'All done';
mysql_close($con);

?>