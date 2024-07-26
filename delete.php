<?php
include 'app/functions.php';

$id = $_GET['id'];
deleteAccount($id);

header('Location: index.php');
exit;
?>
