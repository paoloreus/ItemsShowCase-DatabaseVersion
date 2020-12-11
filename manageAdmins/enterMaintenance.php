<?php
$file = fopen('../offline.txt','wb');
fclose($file);
header('Location: ../public/indexLogin.php');
?>