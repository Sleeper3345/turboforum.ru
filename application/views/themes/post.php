<div class="theme">
    <table>
        <thead>
        <tr>
            <th colspan="2"><?php echo $post['title'] ?></th>
        </tr>
        <tr>
            <th colspan="2"><?php echo $date ?> | <a href="../../profile/<?php echo $author['login'] ?>"><?php echo $author['login'] ?></a></th>
        </tr>
        </thead>
        <tbody>
            <tr data-post_id="<?php echo $post['id'] ?>">
                <td><?php echo $post['text'] ?></td>
                <td>
                    <i class="fa fa-pencil button alterar"></i>
                    <i class="fa fa-trash button excluir"></i>
                </td>
            </tr>
        </tbody>
    </table>
    <?php foreach ($comments as $key => $value) { ?>
        <table>
            <thead>
            <tr>
                <th colspan="2"><?php echo $com_dates[$key] ?> | <a href="../../profile/<?php echo $com_authors[$key]['login'] ?>"><?php echo $com_authors[$key]['login'] ?></a></th>
            </tr>
            <tr>
                <th colspan="2"><?php if (isset($_SESSION['userid'])) { ?> <a class="plus_minus minus" onclick="addCommentMinus(<?php echo $value['id'] ?>, <?php echo $_SESSION['userid'] ?>)">-</a> <?php } ?>Рейтинг: <span id="com_rating_<?php echo $value['id'] ?>"><?php echo $value['rating'] ?></span><?php if (isset($_SESSION['userid'])) { ?> <a class="plus_minus plus" onclick="addCommentPlus(<?php echo $value['id'] ?>, <?php echo $_SESSION['userid'] ?>)">+</a> <?php } ?> </th>
            </tr>
            </thead>
            <tbody>
            <tr id="comment-<?php echo $value['id'] ?>">
                <td><?php echo $value['text'] ?></td>
                <td>
                    <i class="fa fa-pencil button alterar"></i>
                    <i class="fa fa-trash button excluir"></i>
                </td>
            </tr>
            </tbody>
        </table>
    <?php } ?>
    <?php if (!isset($_SESSION['userid'])) { ?>
        <h3><a href="../../auth">Войдите</a> или <a href="../../register">зарегистрируйтесь</a> для того, чтобы оставлять комментарии.</h3>
    <?php } else { ?>
    <form action="../../action/add_comment/<?php echo $post['id'] ?>" method="post" accept-charset="utf-8" onSubmit="validFormPost(this); return false">
        <h3>Добавить комментарий</h3>
        <textarea class="com_text" type="text" name="text"></textarea><br /><br />
        <input id="sendbutton" type="submit" name="submit" value="Добавить комментарий" />
        </form>
    <?php } ?>
</div>