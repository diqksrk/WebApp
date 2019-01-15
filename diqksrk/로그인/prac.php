<?php
$db = new PDO("mysql:dbname=fried__chicken", "root", "root");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$result = $db->query("SELECT 1 FROM member WHERE id='Tester'")->fetch();
print_r($result);
?>