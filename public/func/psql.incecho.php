<?php
//	include_once('phpfunc.php');

if (!function_exists('quote_smart')) {
//避免 sql injection
  function quote_smart($value){//2007/6 pauley
    //2008/6 ryoung [[This feature has been DEPRECATED and REMOVED as of PHP 6.0.0. Relying on this feature is highly discouraged.]]
    // Stripslashes
    if (get_magic_quotes_gpc()) {
       $value = stripslashes($value);
    }
    // Quote if not integer
    if (!is_numeric($value)) {
       $value =  pg_escape_string($value);
    }
$value=str_replace("</","",$value);
$value=str_replace("\"","",$value);
$value=str_replace("'","''",$value);
$value=str_replace("--","",$value);
$value=str_replace(";","",$value);
$value=str_replace("//","",$value);
    return $value;
  }
}
/*
usage: no need.
called by functions below
*/
function use_pg_db($db_name) {
	$host=$_SESSION['dbhost'];
	$user=$_SESSION['dbuser'];
	$password=$_SESSION['dbpass'];

	$db_conn = pg_connect("host=$host user=$user password=$password dbname=$db_name");

	if ( ! $db_conn ) {
		echo "資料庫失敗;無法開啟 資料庫，請確定連線資訊是否正確!";//$db_name
		exit;
	}
	pg_set_client_encoding($db_conn,'UTF8');
	return $db_conn;
}

/*
usage:
$rst=exec_sql($sql_str, $dbname).
$rst: true/false;
*/
function exec_sql() {

	$args = func_get_args();
	while ($data = each ($args))
	{
		if ($data['key']==0) $sql_str = $data['value'];
		if ($data['key']==1) $use_pg_db = $data['value'];
	}
	if (isset($use_pg_db)) {
		$db_conn=use_pg_db($use_pg_db);
//		pg_set_client_encoding($db_conn,'BIG5');
		if (!pg_query($db_conn,$sql_str)){
		      echo "執行失敗;，請洽資訊組同工檢查以下指令<BR> $sql_str";
		      exit;
		}
	}
	pg_close($db_conn);
	return true;
}

/*
usage:
$rst=select_sql($sql_str, $dbname).
$rst=select_sql($sql_str, $dbname, 1).
$rst: 2 dimensional array
*/
function select_sql() {

	$args = func_get_args();
	while ($data = each ($args))
	{
		if ($data['key']==0) $sql_str = $data['value'];
		if ($data['key']==1) $use_pg_db = $data['value'];
		if ($data['key']==2) $fetchtype = $data['value'];
	}
	if ($fetchtype) $fetchtype=PGSQL_ASSOC;// default PGSQL_NUM;
	//else $fetchtype=PGSQL_NUM;

	if (isset($use_pg_db)) {
		$db_conn=use_pg_db($use_pg_db);
//		pg_set_client_encoding($db_conn,'BIG5');
	}

	$sql_rs=pg_exec($db_conn,$sql_str);
	if (!$sql_rs){
	      echo "查詢失敗，請洽資訊組同工檢查以下指令<BR> $sql_str";
	      exit;
	}
	$rs_rows=pg_numrows($sql_rs);
	$rs_fields=pg_numfields($sql_rs);

	if ($fetchtype==PGSQL_ASSOC){
		while($row=pg_fetch_assoc($sql_rs))
		{
			$array_rs[]=$row;
		}
	}else{
		$row_num=0;
		while($row=pg_fetch_row($sql_rs))
		{
			for($rs_num=0;$rs_num<$rs_fields;$rs_num++)
			{
				$array_rs[$row_num][]=$row[$rs_num];
			}
			$row_num++;
		}
	}
	pg_close($db_conn);
	return $array_rs;
}

/*
usage: insert_sql($insert_tb, $insert_fd, $insert_data,  $dbname).
$insert_fd, $insert_data are all 1 dimensional array
*/
function insert_sql() {

	$args = func_get_args();
	while ($data = each ($args))
	{
		if ($data['key']==0) $insert_tb = $data['value'];
		if ($data['key']==1) $insert_fd = $data['value'];
		if ($data['key']==2) $insert_data = $data['value'];
		if ($data['key']==3) $use_pg_db = $data['value'];
	}

	if (isset($use_pg_db)) {
		$db_conn=use_pg_db($use_pg_db);
//		pg_set_client_encoding($db_conn,'BIG5');
	}
	$sql_substr= "";
	for ($i = 0 ; $i<sizeof($insert_data) ; $i++) {
		$inval=$insert_data[$i];
		if (is_string($inval))
			$inval=addslashes($inval);
		if ($i<>0) $sql_substr.= ",";
		if ($inval=="NULL") $sql_substr.= "NULL";
		else $sql_substr.= "'{$inval}'";
	}

	$sql_str="insert into $insert_tb (";
	$sql_str .= implode(" , ", $insert_fd);
	$sql_str .= " ) values (";
	$sql_str .=$sql_substr;
//	$sql_str .= implode(" , ", $insert_data);
	$sql_str .= " )";
//	echo $sql_str."<br>";//exit;
	$sql_rs=pg_query($db_conn,$sql_str);
	if (!$sql_rs){
	      echo "新增失敗，請洽資訊組同工檢查以下指令<BR> $sql_str";
	      exit;
	}

	pg_close($db_conn);
}

/*
usage: update_sql($update_tb, $update_fd, $update_data, $update_key_fd, $update_key_data,  $dbname).
$update_fd, $update_data, $update_key_fd, $update_key_data are all 1 dimensional array
*/
function update_sql() {

	$args = func_get_args();
	while ($data = each ($args))
	{
		if ($data['key']==0) $update_tb = $data['value'];
		if ($data['key']==1) $update_fd = $data['value'];
		if ($data['key']==2) $update_data = $data['value'];
		if ($data['key']==3) $update_key_fd = $data['value'];
		if ($data['key']==4) $update_key_data = $data['value'];
		if ($data['key']==5) $use_pg_db = $data['value'];
	}

	if (isset($use_pg_db)) {
		$db_conn=use_pg_db($use_pg_db);
//		pg_set_client_encoding($db_conn,'BIG5');
	}

	$sql_str="update $update_tb set ";
	for ($i=0;$i<sizeof($update_fd);$i++)
	{
		if ($i<>0) $sql_str .= " , ";
		$inval=$update_data[$i];
		if ($inval=="NULL") $sql_str .= "$update_fd[$i] = NULL";
		else $sql_str .= "$update_fd[$i] = '".addslashes($inval)."'";

	}
	$sql_str .= " where ";
	for ($i=0;$i<sizeof($update_key_fd);$i++)
	{
		if ($i<>0) $sql_str .= " and ";
		$inval=$update_key_data[$i];
		if ($inval=="NULL") $sql_str .= "$update_key_fd[$i] = NULL";
		else $sql_str .= "$update_key_fd[$i] = '{$inval}'";
//		$sql_str .= "$update_key_fd[$i] = $update_key_data[$i]";
	}
	//echo $sql_str."<br>";it;
	$sql_rs=pg_exec($db_conn,$sql_str);
	if (!$sql_rs){
	      echo "更新失敗，請洽資訊組同工檢查以下指令<BR> $sql_str";
	      exit;
	}
	pg_close($db_conn);

}

/*
usage: delete_sql($delete_tb, $delete_key_fd, $delete_key_data,  $dbname).
$delete_key_fd, $delete_key_data are all 1 dimensional array
*/
function delete_sql() {

	$args = func_get_args();
	while ($data = each ($args))
	{
		if ($data['key']==0) $delete_tb = $data['value'];
		if ($data['key']==1) $delete_key_fd = $data['value'];
		if ($data['key']==2) $delete_key_data = $data['value'];
		if ($data['key']==3) $use_pg_db = $data['value'];
	}

	if (isset($use_pg_db)) {
		$db_conn=use_pg_db($use_pg_db);
//		pg_set_client_encoding($db_conn,'BIG5');
	}

	$sql_str="delete from $delete_tb where ";
	for ($i=0;$i<sizeof($delete_key_fd);$i++)
	{
		if ($i<>0) $sql_str .= " and ";
		$inval=$delete_key_data[$i];
		if ($inval=="NULL") $sql_str .= "$delete_key_fd[$i] = NULL";
		else $sql_str .= "$delete_key_fd[$i] = '{$inval}'";

	}
//	echo $sql_str."<br>";exit;
	$sql_rs=pg_query($db_conn,$sql_str);
	if (!$sql_rs){
	      echo "刪除失敗，請洽資訊組同工檢查以下指令<BR> $sql_str";
	      exit;
	}
	pg_close($db_conn);
}
?>