<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('news/delete/'.$slug); ?>

<?php
echo '<h2>'.$news_item['title'].'</h2>';
echo $news_item['text'];
?>
<input type="hidden" name="deleteit" value="1">
<input type="submit" name="submit" value="Удалить новость" />

</form>