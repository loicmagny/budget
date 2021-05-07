<?php
include 'header.php';
?>
<div class="container">
    <h1 class="center-align">Liste des Catégories</h1>
    <div class="row">
        <div class="col s12 center-align">
            <table id="userTable">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($categories as $category) {
                    ?>
                        <tr id="inc_cat_id_<?= $category->inc_cat_id; ?>">
                            <td id="incCatName"><?= $category->inc_cat_name ?></td>
                            <td>
                                <form enctype="multipart/form-data" method="POST">
                                    <a class="btn-floating btn-large waves-effect waves-light blue btn tooltipped" data-position="top" data-tooltip="Modifier" name="updateCategory" id="updateCategory" type="submit" value="<?= $category->inc_cat_id ?>"><i class="material-icons">edit</i></a>
                                    <a class="btn-floating btn-large waves-effect waves-light red btn tooltipped" data-position="right" data-tooltip="Supprimer" name="deleteCategory" id="deleteCategory" type="submit" value="<?= $category->inc_cat_id ?>"><i class="material-icons">delete</i></a>
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr id="category_list">
                        <form method="POST" enctype="multipart/form-data">
                            <td id="cat_name"></td>
                            <td id="actions"></td>
                        </form>
                    </tr>
                </tbody>
            </table>
            <a class="btn-floating btn-large waves-effect waves-light green btn tooltipped" id="add_category" data-position="right" data-tooltip="Ajouter"><i class="material-icons">add</i></a>
        </div>
    </div>
</div>
<?php
include 'footer.php';
?>