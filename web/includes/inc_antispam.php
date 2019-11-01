<?php
if (!headers_sent()) {
	//session_start();
}

// SPAM CHECKER INCLUDE V 1.2.1 - UPDATED 22/05/08
// PORTED TO PHP BY MIKE 09/12/09

function GetSubstringCount($strToSearch, $strToLookFor, $bolCaseSensative) {
	if ($bolCaseSensative) {
		return substr_count($strToSearch, $strToLookFor);
	} else {
		return substr_count(strtoupper($strToSearch),strtoupper($strToLookFor));
	}
}

function IsSpam() {
	$SpamScore = 0;

	$SpamValues = "¥|Ã|¾|Ò|õ|®|Î|Ç|Ð|Å|Ó|þ|¿|º|»|Æ|¤|Content-Transfer-Encoding|base64|text/plain";
	$SpamArray  = explode("|",$SpamValues);

	$SpamValues2 = ".asp|.co.uk|.com|.html|.net|.php|</a>|[/url|[url|a href|amateur|anal|blowjob|cialis|cunnilingus|cunt|drug|fisting|freemovie|gay|guangdong|guangzhou|hooker|http://|lesbian|nude|naked|phentermine|porn|porno|prostitute|pussy|rolex|sex|sexual|software|viagra|wow gold|xanax|zoloft";
	$SpamArray2  = explode("|",$SpamValues2);

	if (count($SpamArray) < 1) {
		$SpamFound = false;
	} else {
		foreach ($_POST as $field => $value) {
			foreach ($SpamArray as $SpamCheck) {
				$SpamScore1 += (GetSubstringCount($value, $SpamCheck, false) * 15);
			}

			foreach ($SpamArray2 as $SpamCheck) {
				$SpamScore2 += (GetSubstringCount($value, $SpamCheck, false) * 3);
			}
		}

		$_SESSION['SpamScore1'] = $SpamScore1;
		$_SESSION['SpamScore2']	= $SpamScore2;
		$_SESSION['SpamScore']  = ($SpamScore1 + $SpamScore2);
		$SpamScore = ($SpamScore1 + $SpamScore2);

		// echo $SpamScore1 . " - " . $SpamScore2;

		if ($SpamScore > 15) {
			$SpamFound = true;
		} else {
			$SpamFound = false;
		}
	}

	return $SpamFound;
}
?>