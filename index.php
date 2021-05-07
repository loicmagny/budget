<?php
include 'header.php';
?>

<main class="container">
    <h1 class="center-align">Résumé</h1>
    <?php
    foreach ($users as $user) {
    ?>
        <div class="card" id="user_id_<?= $user->user_id ?>">
            <div class="card-content">
                <span class="card-title"><?= ucfirst($user->first_name) . ' ' .  ucfirst($user->last_name) ?></span>
                <p id="userBalance_id_<?= $user->user_id ?>"><?= $userBalance ?>€</p>
            </div>
            <div class="card-tabs">
                <ul class="tabs tabs-fixed-width">
                    <li class="tab"><a class="active" href="#incomes_id_<?= $user->user_id ?>">Revenus</a></li>
                    <li class="tab"><a href="#expenses_id_<?= $user->user_id ?>">Dépenses</a></li>
                </ul>
            </div>
            <div class="card-content grey lighten-4">
                <div id="incomes_id_<?= $user->user_id ?>">
                    <table>
                        <thead>
                            <tr>
                                <th>Revenu</th>
                                <th>Date</th>
                                <th>Catégorie</th>
                            </tr>
                        </thead>
                        <tbody id="income_id_<?= $user->user_id ?>"><?php
                                                                    foreach ($incomes as $income) {
                                                                    ?>

                            <?php
                                                                    }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div id="expenses_id_<?= $user->user_id ?>">
                    <div class="col s5 m5 l5">
                        <table>
                            <thead>
                                <tr>
                                    <th>Dépense</th>
                                    <th>Date</th>
                                    <th>Catégorie</th>
                                </tr>
                            </thead>
                            <tbody id="expense_id_<?= $user->user_id ?>"><?php
                                                                            foreach ($expenses as $expense) {
                                                                            ?>
                                <?php
                                                                            }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <section class="container">

    </section>
</main>
<?php
include 'footer.php';
?>