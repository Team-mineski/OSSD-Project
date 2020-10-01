<?php
define('DEBUG' , true);
define('DEFAULT_CONTROLLER' , 'Home'); // default controller if there is no file anmed users
define('DEFAULT_LAYOUT' , 'default'); // if no layout is set in the controller use this layout.

define('PROOT', '/Tuto/');
define('SITE_TITLE' , 'Lady Ridgeway'); // This will be used if no site title is set.
define('MENU_BRAND', 'Tuto');

define('DB_NAME' , 'hospital'); // database name
define('DB_USER' , 'root'); //
define('DB_PASSWORD' , '');
define('DB_HOST' , '127.0.0.1'); // database host ** use IP address to avoid DNS lookup


define('CURRENT_USER_SESSION_NAME', 'dggEdgdfrdgSRRbjhbBBJHGbvcfcv'); // session name for logged in user
define('REMEMBER_ME_COOKIE_NAME' , 'GGVBSjjbbcgxBgfgVVGVG123bjhj'); //cookie name for logged in user remember me
define('REMEMBER_ME_COOKIE_EXPIRY', 30); // time in seconds for remember me cookie to live (30 days)


define('ACCESS_RESTRICTED', 'Restricted'); // controller name for the restricted redirect
 ?>
