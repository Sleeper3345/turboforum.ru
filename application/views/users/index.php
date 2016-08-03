<?php
include "auth.php";//Подключаем БД
//делаем запрос на категории
$query = "select * from user ";
$result = mysql_query($query) or die(mysql_error());
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; Charset=UTF-8">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
</head>
<body>
<form id="myForm">
    Выберите пользователя:<br/>
    <select id="userbox">
        <?php
        //Выводим категории и ее ID
        while ($row=mysql_fetch_array($result))
        {
            print "<option value=".$row['id'].">";
            print $row['login'];
            echo("</option>");
        }
        ?>
    </select>
    <button id="know">Узнать</button>
</form>

<div id="content"></div>

<script>
    $(document).ready(function(){

        $('#know').on('click',function(){
            $.ajax({
                type: "POST",
                url: "users/show",
                data: "userbox="+$("#userbox").val(),
                success: function(html){
                    $("#content").html(html);
                }
            });
            return false;
        });

    });
</script>

</body>
</html>