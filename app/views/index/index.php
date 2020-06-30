<?php
if($_SESSION['name']){    
     echo "<h3>Привіт {$_SESSION['name']}</h3>";
 }else{
 	echo "<h3>Ви не авторизовані</h3>";
 }
?>



