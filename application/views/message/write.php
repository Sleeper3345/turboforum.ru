<?php
include "auth.php";//Подключаем БД
//делаем запрос на категории
$query = "select * from message ";
$result = mysql_query($query) or die(mysql_error());
?>
<html>
<head>
    <title><? echo $title ?></title>
    <meta http-equiv="Content-Type" content="text/html; Charset=UTF-8">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
</head>
<body>

<div id="content"></div>
<form action="../send" method="post" name="form">
    <p>
        <textarea id="sendmessage" name="message" rows="4" cols="55" wrap="virtual">Введите текст сообщения...</textarea>
    </p>
    <input name="js" type="hidden" value="no" id="js">
    <p>
        <input name="button" type="submit" value="Отправить" id="sendbutton"> <span id="resp"></span>
    </p>
</form>

<script type="text/javascript">
    $(function(){
        $("#sendbutton").click(function(){
            var message = $("#sendmessage").val();
            $.ajax({
                type: "POST",
                url: "../send",
                data: {"message": message, "touser": <? echo $user_item['id'] ?>},
                cache: false,
                success: function(response){
                    //var messageResp = new Array('Ваше сообщение отправлено','Сообщение не отправлено Ошибка базы данных','Нельзя отправлять пустые сообщения');
                    //var resultStat = messageResp[Number(response)];
                    if(response == 0){
                        $("#sendmessage").val("");
                    }
                    //$("#resp").text(resultStat).show().delay(1500).fadeOut(800);
                }
            });
            return false;

        });

    });
</script>

</body>
</html>