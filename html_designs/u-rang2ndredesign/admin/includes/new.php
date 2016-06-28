<?
function sanitize($input, $condition = 1){
	if($condition == 1){
		return htmlentities($input, ENT_QUOTES, 'UTF-8');
	}
}

// Generate Random Numbers
function GenerateNumCode ($num, $mach) {
	$let = array('0', '0', '1', '1', '2', '3', '4', '5', '6', '7', '8', '9');
	srand((float) microtime() * 10000000);

	for ($i=0;$i<$mach;$i++)
	{
		unset ($code);
		$ids = array_rand ($let, $num);
		foreach ($ids as $val)
		$code .=$let[$val];
		$return=strtoupper($code);
	}

	$sql = mysql_query("select requestid from urg_customers where requestid='$return'");
	if (mysql_num_rows($sql) == 0) {
		return $return;
	}else{
		return GenerateNumCode($num,$mach);
	}
}


// for encrypt
// using like: $pass = encrypt($pass, "abc123");
function encrypt($string, $key) {
  $result = '';
  for($i=0; $i<strlen($string); $i++) {
    $char = substr($string, $i, 1);
    $keychar = substr($key, ($i % strlen($key))-1, 1);
    $char = chr(ord($char)+ord($keychar));
    $result.=$char;
  }

  return base64_encode($result);
}

// for decrypt
// using like: $pass = decrypt($password,"abc123");
function decrypt($string, $key='%key&') {
	$result = '';
	$string = base64_decode($string);
	for($i=0; $i<strlen($string); $i++) {
		$char = substr($string, $i, 1);
		$keychar = substr($key, ($i % strlen($key))-1, 1);
		$ordChar = ord($char);
		$ordKeychar = ord($keychar);
		$sum = $ordChar - $ordKeychar;
		$char = chr($sum);
		$result.=$char;
	}
	return $result;
}

//getField function to get fields from database directly
function getFields($table, $leftField, $rightField, $getField, $sqlVars = "", $returnThis = "")
{
	$sql = "SELECT $getField from $table where $leftField = '{$rightField}' $sqlVars";
	if($result = mysql_query($sql))
	{
		if(mysql_num_rows($result)>0)
		{
			return mysql_result($result,0,$getField);
		}
		else
		{
			return "";
		}
	}
	else
	{
		if($returnThis!='')
		{
			echo "<strong>MYSQL ERROR</strong>:<br /><strong>SQL QUERY:</strong> $sql<br /><strong>SQL ERROR:</strong> ".mysql_error();
		}
		else
		{
			return $returnThis;
		}
	}
}

// for display months
function monthPullDown($montharray, $chkmonth)
{
	echo "\n<select name=\"month\" id=\"month\">\n";
	echo "<option value=\"\">Month</option>";
	$count = 1;
	for($i=0; $i<12; $i++) {
		if($count < 10){
			$count = "0".$count;
		}
		if($chkmonth==$montharray[$i]) {
			echo "<option value=\"" .$montharray[$i]."|".$count. "\" selected=\"selected\">".$montharray[$i]."</option>\n";
		} else {
			echo "<option value=\"" .$montharray[$i]."|".$count. "\">".$montharray[$i]."</option>\n";
		}
		$count++;
	}
	echo "</select>\n\n";
}

// for display years
function monthPullYear($currentyear, $chkyear)
{
	echo "\n<select name=\"year\" id=\"year\">\n";
	echo "<option value=\"\">Year</option>";
	
	for($i=0;$i < 13; $i++) {
		if($chkyear==$currentyear) {
			echo "<option value=\"" . $currentyear . "\" selected=\"selected\">".$currentyear."</option>\n";
		} else {
			echo "<option value=\"" . $currentyear . "\">".$currentyear."</option>\n";
		}
		$currentyear = $currentyear+1;
	}
	echo "</select>\n\n";
}

// for dynamic input button
function formButton($type,$name,$value,$param)
{
$frm_btn = "<table width='*' border='0' cellpadding='0' cellspacing='0'>
<tr>
<td style='padding:0px;'><img src='images/btn_green_l.png' width='7' height='29' /></td>
<td style='padding:0px;'><input name='".$name."' type='".$type."' class='btn2' value='".$value."' ".$param." /></td>
<td style='padding:0px;'><img src='images/btn_green_r.png' width='7' height='29' /></td>
</tr>
</table>";
return $frm_btn;
}

?>