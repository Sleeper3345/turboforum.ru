<div class="main">
<h3><?php echo $title; ?></h3>
<br />
     <?php if (isset($_SESSION['userid'])) {
     if ($_SESSION['login'] == $user_item['login']) { ?>
         <h3>Это Вы</h3>
<?php } else { ?>
         <a href="../chat?to=<?php echo $user_item['login']; ?>"><button>Отправить сообщение</button></a><br /><br />
     <?php } } ?>
</div>