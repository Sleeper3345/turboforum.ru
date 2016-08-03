<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('news/create'); ?>

<label for="title">Заголовок</label>
<input type="input" name="title" /><br />

<label for="text">Описание</label>
<textarea name="text"></textarea><br />

<input type="submit" name="submit" value="Добавить новость" />

</form>