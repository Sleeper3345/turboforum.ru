<div class="add_theme">
<?php echo validation_errors(); ?>

<?php echo form_open('themes/add'); ?>

<h3>Добавить тему</h3>

<label for="title">Заголовок:</label>
<input class="theme_name" type="text" name="title" /><br /><br />

<label for="text">Описание:</label>
<textarea class="com_text" type="text" name="text"></textarea><br /><br />

<select id="list" name="category">
    <?php foreach ($categories as $category) { ?>
        <option value="<?php echo $category['name_url'] ?>"><?php echo $category['name'] ?></option>
    <?php } ?>
</select>

<input type="submit" name="submit" value="Добавить тему" />

</form>
</div>

<script>
    var elems = document.getElementsByTagName("option");
    for( var i =0, elem; elem = elems[ i++ ]; ) {
        if (elem.getAttribute('value', 2) == "<?php echo $_GET['type'] ?>") {
            elem.selected = true;
        }
    }
</script>