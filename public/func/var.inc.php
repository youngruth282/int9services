<?php
/*
	array_walk($_POST , 'php_registerGlobal');

*/
if (!function_exists('php_registerSession')) {
function php_registerSession ()
{
	global $_SESSION;

	$args = func_get_args();
	while (list(,$key) = each ($args))
	{

		if (isset($_SESSION[$key])) $value = $_SESSION[$key];
		if (isset($value))
		{
			global $$key;
			$$key = $value;
			unset($value);
		}

	}
}
}
if (!function_exists('php_registerGlobal')) {
function php_registerGlobal ()
{
	global $_GET, $_POST;

	$args = func_get_args();
	while (list(,$key) = each ($args))
	{
		if (!is_array($key)) {
			if (isset($_GET[$key])) $value = $_GET[$key];

			if (isset($_POST[$key])) $value = $_POST[$key];

			if (isset($value))
			{
				global $$key;
				$$key = $value;
				unset($value);
			}
		}
	}
}
}

if (!function_exists('safestrtotime')) {

function safestrtotime($strInput) {
    $iVal = -1;
    for ($i=1900; $i<=1969; $i++) {
        // Check for this year string in date
        $strYear = (string)$i;
        if (!(strpos($strInput, $strYear)===false)) {
            $replYear = $strYear;
            $yearSkew = 1970 - $i;
            $strInput = str_replace($strYear, "1970", $strInput);
        }
    }
    $iVal = strtotime($strInput);
    if ($yearSkew > 0) {
        $numSecs = (60 * 60 * 24 * 365 * $yearSkew);
        $iVal = $iVal - $numSecs;
        $numLeapYears = 0;        // Work out number of leap years in period
        for ($j=$replYear; $j<=1969; $j++) {
            $thisYear = $j;
            $isLeapYear = false;
            // Is div by 4?
            if (($thisYear % 4) == 0) {
                $isLeapYear = true;
            }
            // Is div by 100?
            if (($thisYear % 100) == 0) {
                $isLeapYear = false;
            }
            // Is div by 1000?
            if (($thisYear % 1000) == 0) {
                $isLeapYear = true;
            }
            if ($isLeapYear == true) {
                $numLeapYears++;
            }
        }
        $iVal = $iVal - (60 * 60 * 24 * $numLeapYears);
    }
    return($iVal);
}
}

?>