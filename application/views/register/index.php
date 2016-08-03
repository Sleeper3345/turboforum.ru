<div class="main">

<h2><?php echo $title; ?></h2><br />

<?php echo validation_errors(); ?>

<form action="/register" method="post" onsubmit="checkUser(this); return false" accept-charset="utf-8">

<label for="login">Логин</label>
<input id="input_login" type="input" name="login" /><br /><br />

<label for="password">Пароль</label>
<input id="input_pass" type="password" name="password" /><br /><br />

<input type="submit" value="Зарегистрироваться" /><br /><br />

</form>

</div>