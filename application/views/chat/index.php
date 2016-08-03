<div id="chat">
    <div id="chat_head">
        <span><b><?php echo $_GET['to']?></b></span>
    </div>
    <div id="chat_body">
<?php if ($status == 'false') { ?>
    <span id="status_err">Пользователя с таким логином не существует</span>
<?php } ?>
<?php if ($status == 'true') { ?>
    <?php foreach ($messages as $key => $value) { ?>
        <span data-id="<?php echo $value['id'] ?>" class="message">[<?php echo $value['data'] ?>] <a href="profile/<?php echo $users[$key]['login'] ?>" target="_blank"><?php echo $users[$key]['login'] ?></a>: <?php echo $value['text'] ?></span>
    <?php } ?>
<?php } ?>
    </div>
    <?php if ($status == 'true') { ?>
    <div id="send_message">
        <script>getMessages()</script>
        <form action="/action/send_message" method="post" accept-charset="utf-8" onSubmit="send_mess(this); return false">
        <input id="mess" type="text" name="message" class="input_text" placeholder="Введите текст сообщения..." onKeyup="enterText()">
        <input id="send_but" type="submit" class="send dis" value="Отправить" disabled />
        </form>
    </div>
    <?php } ?>
</div>