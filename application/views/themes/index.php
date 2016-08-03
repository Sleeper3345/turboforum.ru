<div id="main">
<table>
    <thead>
    <tr>
        <?php if (!isset($_SESSION['login'])) { ?>
        <th colspan="4"><?php echo $title ?></th>
        <?php } ?>
        <?php if (isset($_SESSION['login'])) { ?>
            <th colspan="3"><?php echo $title ?></th>
        <th><a href="add?type=<?php echo $theme ?>">Добавить тему</a></th>
        <?php } ?>
    </tr>
    <tr>
        <th>Дата</th>
        <th>Тема</th>
        <th colspan="2">Автор</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($themes as $key => $value) { ?>
        <tr data-i="<?php echo $value['id'] ?>">
            <td id="time"><?php echo $dates[$key] ?></td>
        <td id="title"><a href="/themes/post/<?php echo $value['id'] ?>"><?php echo $value['title'] ?></a></td>
            <td id="author" data-id="<?php echo $value['author'] ?>"><a href="../profile/<?php echo $authors[$key]['login'] ?>"><?php echo $authors[$key]['login'] ?></a></td>
            <td>
                <i class="fa fa-pencil button alterar"></i>
                <i class="fa fa-trash button excluir"></i>
            </td>
            </tr>
    <?php } ?>
    </tbody>
</table>
</div>