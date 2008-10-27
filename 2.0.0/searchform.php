<?php

// like i said, we must never forget to start the session
session_start();

// is the one accessing this page logged in or not?
if (!isset($_SESSION['basic_is_logged_in']) 
    || $_SESSION['basic_is_logged_in'] !== true) {

    // not logged in, move to login page
    header('Location: login.php');
    exit;
}

include ('./library/functions.php');
$id=$_GET['id'] ;
// Leave the PHP section and create the HTML form.
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>FABULOUS | <?php echo $id; ?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="robots" content="all" />
<style type="text/css" media="all">@import "./include/layout.css";</style>
</head>

<body>


<div id="document"><a name="top"></a>
	<div id="header"></div>

	<?php top_navigation();?>




</div>





<div id="content">
	<div id="base"> <h1>Fabulous Search Page </h1>
	</div>
	<p class="about">
 <?php 
 if($id=="activate")
 search_formA();
 else  if(($id=="deactivate"))
 search_formD();
 else  if(($id=="edit"))
 search_formE();
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
