<?php

// +----------------------------------------------------------------------+
// | FABULOUS - Fedora/Arrow Batch Utility with Lots Of User Services     |
// +----------------------------------------------------------------------+
// | Copyright (c) 2006, 2007 The University of South Australia,          |
// | ARROW (Australian Research Repository Online to the World),          |
// | mini Projects                                                        |
// |                                                                      |
// | This program is free software; you can redistribute it and/or modify |
// | it under the terms of the GNU General Public License as published by |
// | the Free Software Foundation; either version 2 of the License, or    |
// | (at your option) any later version.                                  |
// |                                                                      |
// | This program is distributed in the hope that it will be useful,      |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of       |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the        |
// | GNU General Public License for more details.                         |
// |                                                                      |
// | You should have received a copy of the GNU General Public License    |
// | along with this program; if not, write to:                           |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+
// | Author: Prashant Pandey <prashant.pandey@unisa.edu.au>               |
// +----------------------------------------------------------------------+

include ('./library/functions.php');

// ... we will put some php code here
session_start();
$errorMessage = '';

//print_r($tempDict);
if (isset($_POST['txtUserId']) && isset($_POST['txtPassword']) && isset($_POST['server']) && isset($_POST['port'])) {
// check if the user id and password combination is correct
// at present hardcoaded but at some point need to validaate against fedora username and password

$serverTemp=$_POST['server'];
$split=explode(":", $serverTemp);
$server=$split[0];
$index=$split[1];

if (authenticate($_POST['txtUserId'], $_POST['txtPassword'], $server, $_POST['port'], $_POST['ver'], $index)) {
// the user id and password match,
// set the session
$_SESSION['basic_is_logged_in'] = true;
$_SESSION['user'] = $_POST['txtUserId'];
$_SESSION['password'] = $_POST['txtPassword'];
$_SESSION['host'] = $server;
$_SESSION['port'] = $_POST['port'];
$_SESSION['version'] = $_POST['ver'];

// after login we move to the main page
header('Location: index.php');
exit;
} else {
$errorMessage = 'Sorry, Incorrect authentication values. TRY AGAIN !!';
}
}

//$errorMessage="created error";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>FABULOUS | Log-on</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="robots" content="all" />
<style type="text/css" media="all">@import "./include/layout.css";</style>
</head>

<body>


<div id="document"><a name="top"></a>
	<div id="header"></div>

</div>




<div id="content">
	<div id="base"> <h1>  Administrative Login </h1>
	</div>
	<p class="about">


<?php
  loginform();

if ($errorMessage != '') {
?>
<p align="center"><strong><font color="#990000"><?php echo $errorMessage; ?></font></strong></p>
<?php
}
?>
        
        </p>
  <hr/>
<div id="footer">
<p id="footer_copyright">
Copyright &#169;2007 <b>ARROW</b>, All right reserved
</p>

<?php bottom_tags();?>
 <hr/>
</div>

</div>

</body>
</html>