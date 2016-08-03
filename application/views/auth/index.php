<div class="main">

<h2><?php echo $title; ?></h2><br />

<?php echo validation_errors(); ?>

<form action="/auth" method="post" accept-charset="utf-8" onSubmit="checkPass(this); return false">

<label for="login">Логин</label>
<input id="login" type="input" name="login" /><br /><br />

<label for="password">Пароль</label>
<input id="pass" type="password" name="password" /><br /><br />

<input type="submit" value="Войти" /><br /><br />

</form>

</div>