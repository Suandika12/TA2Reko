<?php 
require_once('../../../include/all_include.php');
$%fieldpertama%=isset($_POST["%fieldpertama%"]) ? $_POST["%fieldpertama%"]:"";
$sql = "DELETE FROM data_jam_operasional WHERE %fieldpertama%=?";
$stmt = $dbh->prepare($sql);
$stmt->execute([$%fieldpertama%]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>
