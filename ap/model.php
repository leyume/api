<?php 
// $mysqli = mysqli_connect("localhost", "root", "chukeychux", "api");
$mysqli = mysqli_connect("localhost", "li", "one", "api");

function _query($tbl, $where="", $order="", $limit="100", $cols=""){
	global $mysqli; $arr="";
	if($where != '') { $where = 'WHERE '.$where; }
	if($order != '') { $order = 'ORDER BY '.$order.' '; }
	if($cols != '') { $fields = implode(',', $cols); } else { $fields = '*'; }
	if(empty($limit)) { $limit = 100; }
	$sql = "SELECT ".$fields." FROM " . $tbl . " " . $where . " ". $order . " LIMIT ".$limit;
	$res = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	while ($rows = mysqli_fetch_array($res, MYSQL_ASSOC)) { $arr[] = $rows; }
	
	if(mysqli_num_rows($res)==1) return $arr[0]; else return $arr;
}
function _insert($tbl, $arr){
	global $mysqli;
	$sql = "INSERT INTO ".$tbl." (".implode(',', array_keys($arr)).") VALUES ('".implode("','", array_values($arr))."')";
	$res = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	$ins_id = mysqli_insert_id($mysqli);
	return $ins_id;
}
function _update($tbl, $arr, $where="", $limit="1", $e="" ){
	global $mysqli;
	if($where != '') { $where = 'WHERE '.$where; }
	else { $where = 'WHERE id = '.$arr['id']; }
	foreach ($arr as $k => $v) { if(isset($v) || $e!='') { $ar[] = $k."= '".$v."'"; } }
	// foreach ($arr as $k => $v) { $ar[] = $k."= '".$v."'"; }
	$sql = "UPDATE ".$tbl." SET ".implode(',', $ar)." ".$where." LIMIT ".$limit;
	$res = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	return $res;
}
function _delete($tbl, $arr, $where="", $limit="1" ){
	global $mysqli;
	if($where != '') { $where = 'WHERE '.$where; }
	else { $where = "WHERE id = '".$arr['id']."'"; }
	$sql = "DELETE FROM ".$tbl." ".$where." LIMIT ".$limit;
	$res = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
	return ( mysqli_affected_rows( $mysqli ) > 0 ) ? 1 : 0;
}
?>