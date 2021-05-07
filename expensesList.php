<?php
include 'header.php';
?>
<div class="container">
    <h1 class="center-align">Liste des dépenses</h1>
    <div class="row">
        <div class="col s12 center-align">
            <table id="expensesTable">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Montant</th>
                        <th>Date</th>
                        <th>Type de dépenses</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="expensesList">
                    <?php
                    foreach ($expenses as $expense) {
                    ?>
                        <tr id="expenses_id_<?= $expense->exp_id ?>">
                            <div class="row">
                                <td id="expensesName_id_<?= $expense->exp_id ?>"><?= ucfirst($expense->first_name) . ' ' . ucfirst($expense->last_name) ?></td>
                                <td id="expensesAmount_id_<?= $expense->exp_id ?>"><?= $expense->exp_amount ?>€</td>
                                <td id="expensesDate_id_<?= $expense->exp_id ?>"><?= $expense->exp_date ?></td>
                                <td id="expensesCat_id_<?= $expense->exp_id ?>"><?= $expense->exp_label ?></td>
                                <td id="actionsInc_id_<?= $expense->exp_id ?>">
                                    <form enctype="multipart/form-data" method="POST">
                                        <a class="btn-floating btn-large waves-effect waves-light blue btn tooltipped" data-position="top" data-tooltip="Modifier" name="updateExpense" id="updateExpense" type="submit"><i class="material-icons">edit</i></a>
                                        <a class="btn-floating btn-large waves-effect waves-light red btn tooltipped" data-position="right" data-tooltip="Supprimer" name="deleteExpense" id="deleteExpense" type="submit"><i class="material-icons">delete</i></a>
                                    </form>
                                </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <form method="POST" enctype="multipart/form-data" id="expenses_list">
                <div class="row">

                    <div class="input-field col s12 m3 l3">
                        <select id="addExpenseUserList" name="userList">
                            <option value="0" disabled selected>Choisir l'utilisateur</option>
                            <?php
                            foreach ($users as $user) {
                            ?><option value="<?= $user->user_id ?>"><?= $user->first_name . ' ' . ucfirst($user->last_name) ?></option><?php
                                                                                                                                    }
                                                                                                                                        ?>
                        </select>
                    </div>
                    <div class="input-field col s12 m3 l3">
                        <input id="exp_amount" name="exp_amount" type="text" class="validate">
                        <label for="exp_amount">Montant</label>
                    </div>
                    <div class="input-field col s12 m3 l3">
                        <input type="text" class="datepicker" name="exp_date" id="exp_date" value="<?= date('Y-m-d'); ?>">
                        <label for="exp_date">Date de réception</label>
                    </div>
                    <div class="input-field col s12 m3 l3">
                        <input id="exp_label" name="exp_label" type="text" class="validate">
                        <label for="exp_label">Type</label>
                    </div>

                </div>
                <div class="row">
                    <div class="input-field col s12 m12 l12">
                        <a class="btn waves-effect waves-light green btn-small" id="insert_expenses" name="insertExpense">Valider
                            <i class="material-icons right">send</i>
                        </a>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div class="row center-align">
        <a class="btn-floating btn-large waves-effect waves-light green btn tooltipped" id="add_expenses" data-position="right" data-tooltip="Ajouter"><i class="material-icons" id="btnAdd">add</i></a>
    </div>
</div>
<?php
include 'footer.php';
?>