<?php
	session_start();
	session_destroy();
	echo "<script>window.open('pointofinterest.php', '_self')</script>";
?>