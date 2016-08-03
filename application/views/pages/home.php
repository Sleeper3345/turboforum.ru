<div id="main">
    <table>
        <thead>
        <tr>
            <th colspan="3">Категории</th>
        </tr>
        <tr>
            <th>Категория</th>
            <th colspan="2">Тем</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($categories as $category) { ?>
            <tr>
                <td><a href="/themes/<?php echo $category['name_url'] ?>"><?php echo $category['name'] ?></a></td>
                <td><?php echo $category['count'] ?></td>
                <td>
                    <i class="fa fa-pencil button alterar"></i>
                    <i class="fa fa-trash button excluir"></i>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>