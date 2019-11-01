<?php

if (1 == 1) {
// SQL INJECTION FILTER V1.3.1
$arrSQLInjectors  = array("char(","sysobjects","(select",";declare","<script","</script");
$arrSQLInjectorsP = Array("char(","sysobjects","<script","</script");
$arrCSInjectors   = Array("acunetix","111-222-1933email@address.com");

// GET
foreach ($_GET as $key => $value) {
	foreach ($arrSQLInjectors as $test) {
		if (strpos($value,$test) !== false) {
			// FOUND SOMETHING
			header("Location: /404.php?si=true&t=q");
			exit;
		}
	}
}

// POST
foreach ($_POST as $key => $value) {	if (!is_array($value)) {
		foreach ($arrSQLInjectorsP as $test) {
			if (strpos($value,$test) !== false) {
				// FOUND SOMETHING
				header("Location: /404.php?si=true&t=p");
				exit;
			}
		}			}
}

// COOKIES AND SESSIONS
foreach ($_COOKIE as $key => $value) {
	foreach ($arrCSInjectors as $test) {
		if (strpos($value,$test) !== false) {
			// FOUND SOMETHING
			header("Location: /404.php?si=true&t=c");
			exit;
		}
	}
}

/*
foreach ($_SESSION as $key => $value) {
	foreach ($arrCSInjectors as $test) {
		if (strpos($value,$test) !== false) {
			// FOUND SOMETHING
			header("Location: /404.php?si=true&t=s");
			exit;
		}
	}
}
*/}
?>