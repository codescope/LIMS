<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
	$_SESSION["admin_id"] = null;
	$_SESSION["username"] = null;
    $_SESSION["privileges"] = null;
    setcookie("admin_id","",time()-60*30);
    setcookie("username","",time()-60*30);
    setcookie("privileges","",time()-60*30);

    session_destroy();

	redirect_to("login.php?success=". urlencode("Logged Out Successfully!"));
?>