<?php
include "auth.php";
if (isset($_REQUEST['message'])) {
    $result = mysql_query("INSERT INTO message (title, text, touser, fromuser) VALUES('Заголовок', '".$_REQUEST['message']."',
    '".$_REQUEST['touser']."', '".$_SESSION['userid']."')");
}
else
    show_404();
?>