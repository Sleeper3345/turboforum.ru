<?php
include "auth.php";
if (isset($_REQUEST['userbox'])) {
    $query = "select * from user where id=".$_REQUEST['userbox']."";
    $result = mysql_query($query) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        print $row['type'] . "<br />";
    }
}
else
    show_404();
?>