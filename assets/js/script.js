//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//IncomeList.php
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


$('#add_income').click(function () {
    $('#income_list').toggle()
    $('#add_income').removeClass("green")
    $('#add_income').addClass("red")
    $('#btnAdd').html('close')
    $('#add_income').attr('data-tooltip', 'Annuler');
    if (!$('#income_list').is(':visible')) {
        $('#add_income').removeClass("red")
        $('#add_income').addClass("green")
        $('#btnAdd').html('add')
        $('#add_income').attr('data-tooltip', 'Ajouter');
    }
})

$('body').on('click', '#insert_income', function () {
    let cat = $('#incomeSelect').val()
    let user_id = $('#addIncomeUserList').val()
    let amount = $('#amount').val();
    let date = $('#receipt_date').val()
    $.post(
        'header.php', {
            user_id: user_id,
            inc_amount: amount,
            inc_receipt_date: date,
            inc_cat_id: cat,
            insertIncome: true
        },
        function (data) {
            alert(data)
            $('#incomeList tr:last').after(
                '<tr id="income_id_' + data[data.length - 1]['inc_id'] + '">' +
                '<td>' + data[data.length - 1]['first_name'] + data[data.length - 1]['last_name'] + '</td>' +
                '<td>' + data[data.length - 1]['inc_amount'] + '€</td>' +
                '<td>' + data[data.length - 1]['receipt_date'] + '</td>' +
                '<td><a class="btn-floating btn-large waves-effect waves-light blue btn tooltipped" data-position="top" data-tooltip="Modifier"' +
                'value="' + data[data.length - 1]['inc_id'] + '" id="updateIncome"><i class="material-icons">edit</i></a>' +

                '<a class="btn-floating btn-large waves-effect waves-light red btn tooltipped" data-position="right" data-tooltip="Supprimer"' +
                'value="' + data[data.length - 1]['inc_id'] + '" id="deleteIncome"><i class="material-icons">delete</i></a></td>' +
                '</tr>')
        },
        'JSON'
    )
})


$('body').on('click', '#updateIncome', function () {
    let row_id = $(this).parents('tr').prop('id');
    let id = row_id.replace(/[^0-9.]/g, "");
    $('#incomeAmount_id_' + id + '').html(
        '<div class="input-field col s12 m3 l3">' +
        '<input id="amount_id_' + id + '" name="amount_id_' + id + '" type="number" class="validate">' +
        '<label for="amount">Montant</label>' +
        '</div>'
    )
    $('#incomeDate_id_' + id + '').html(
        '<div class="input-field col s12 m3 l3">' +
        '<input type="text" class="datepicker" name="receipt_date_id_' + id + '" id="receipt_date_id_' + id + '"' +
        '<label for="receipt_date">Date de réception</label>' +
        '</div>'
    )
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        yearRange: 80
    })
    $('#actionsInc_id_' + id + '').html(
        '<button class="btn waves-effect waves-light green btn-small" id="updateIncome_id_' + id + '">Valider' +
        '<i class="material-icons right">send</i>' +
        '</button>')
    $('#updateIncome').hide()
    $('#deleteIncome').hide()

    $('#updateIncome_id_' + id + '').click(function () {
        let amount = $('#amount_id_' + id + '').val()
        let date = $('#receipt_date_id_' + id + '').val()
        $.post(
            'header.php', {
                inc_id: id,
                inc_amount: amount,
                receipt_date: date,
                updateIncome: true
            },
            function (data) {
                console.log(data)
                $('#income_id_' + id + '').html(
                    '<tr id="income_id_' + data[data.length - 1]['inc_id'] + '">' +
                    '<td>' + data[data.length - 1]['first_name'] + data[data.length - 1]['last_name'] + '</td>' +
                    '<td>' + data[data.length - 1]['inc_amount'] + '€</td>' +
                    '<td>' + data[data.length - 1]['receipt_date'] + '</td>' +
                    '<td><a class="btn-floating btn-large waves-effect waves-light blue btn tooltipped" data-position="top" data-tooltip="Modifier"' +
                    'value="' + data[data.length - 1]['inc_id'] + '" id="updateIncome"><i class="material-icons">edit</i></a>' +

                    '<a class="btn-floating btn-large waves-effect waves-light red btn tooltipped" data-position="right" data-tooltip="Supprimer"' +
                    'value="' + data[data.length - 1]['inc_id'] + '" id="deleteIncome"><i class="material-icons">delete</i></a></td>' +
                    '</tr>')
                $('#updateIncome').show()
                $('#deleteIncome').show()
            },
            'JSON'
        )
    })
})


$('body').on('click', '#deleteIncome', function () {
    let row_id = $(this).parents('tr').prop('id');
    let id = row_id.replace(/[^0-9.]/g, "");

    $.post(
        'header.php', {
            inc_id: id,
            deleteIncome: true
        },
        function (data) {
            if (data) {
                // alert(id)
                $('#income_id_' + id + '').remove()
            }
        },
        'JSON'
    )
})


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//UserList.php
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$('#add_user').click(function () {
    $('#user_list').toggle()
    $('#add_user').removeClass("green")
    $('#add_user').addClass("red")
    $('#btnAdd').html('close')
    $('#add_user').attr('data-tooltip', 'Annuler');
    if (!$('#user_list').is(':visible')) {
        $('#add_user').removeClass("red")
        $('#add_user').addClass("green")
        $('#btnAdd').html('add')
        $('#add_user').attr('data-tooltip', 'Ajouter');
    }
})

$('body').on('click', '#insert_user', function () {
    let lastName = $('#lastName').val()
    let firstName = $('#firstName').val()
    let birthdate = $('#birthDate').val()
    $.post(
        'header.php', {
            last_name: lastName,
            first_name: firstName,
            birthdate: birthdate,
            insertUser: true
        },
        function (data) {
            console.log(data)
            $('#user_list').before(
                '<tr id="user_id_' + data[data.length - 1]['user_id'] + '">' +
                '<td>' + data[data.length - 1]['last_name'] + '</td>' +
                '<td>' + data[data.length - 1]['first_name'] + '</td>' +
                '<td>' + data[data.length - 1]['birthdate'] + '</td>' +
                '<td><a class="btn-floating btn-large waves-effect waves-light blue btn tooltipped" data-position="top" data-tooltip="Modifier"' +
                'value="' + data[data.length - 1]['user_id'] + '" id="updateUser"><i class="material-icons">edit</i></a>' +

                '<a class="btn-floating btn-large waves-effect waves-light red btn tooltipped" data-position="right" data-tooltip="Supprimer"' +
                'value="' + data[data.length - 1]['user_id'] + '" id="deleteUser"><i class="material-icons">delete</i></a></td>' +
                '</tr>')
        },
        'JSON'
    )
})

$('body').on('click', '#updateUser', function () {
    let row_id = $(this).parents('tr').prop('id');
    let id = row_id.replace(/[^0-9.]/g, "");
    $('#userLastName_id_' + id + '').html(
        '<input name="lastName" type="text" id="inputLastName_id_' + id + '" class="validate">' +
        '                        <label for="lastName">Nom de famille</label>'
    )
    $('#userFirstName_id_' + id + '').html(
        '<input name="firstName" type="text" id="inputFirstName_id_' + id + '" class="validate">' +
        '<label for="firstName">Prénom</label>'
    )
    $('#userBirthdate_id_' + id + '').html(
        '<input type="text" class="datepicker" id="inputBirthdate_id_' + id + '">' +
        '<label for="birthdate">Date de naissance</label>'
    )
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        yearRange: 80
    })
    $('#actionsUser_id_' + id + '').html(
        '<button class="btn waves-effect waves-light green btn-small" id="updateUser_id_' + id + '">Valider' +
        '<i class="material-icons right">send</i>' +
        '</button>')
    $('#updateUser').remove()
    $('#deleteUser').remove()

    $('#updateUser_id_' + id + '').click(function () {
        let firstName = $('#inputFirstName_id_' + id + '').val()
        let lastName = $('#inputLastName_id_' + id + '').val()
        let birth_date = $('#inputBirthdate_id_' + id + '').val()
        $.post(
            'header.php', {
                user_id: id,
                last_name: lastName,
                first_name: firstName,
                birthdate: birth_date,
                updateUser: true
            },
            function (data) {
                console.log(data)
                $('#user_id_' + id + '').html(
                    '<td id="userLastName_id_' + id + '">' + data[data.length - 1]['last_name'] + '</td>' +
                    '<td id="userFirstName_id_' + id + '">' + data[data.length - 1]['first_name'] + '</td>' +
                    '<td id="userBirthdate_id_' + id + '">' + data[data.length - 1]['birthdate'] + '</td>' +
                    '<td><a class="btn-floating btn-large waves-effect waves-light blue btn tooltipped" data-position="top" data-tooltip="Modifier"' +
                    'id="updateUser"><i class="material-icons">edit</i></a>' +
                    '<a class="btn-floating btn-large waves-effect waves-light red btn tooltipped" data-position="right" data-tooltip="Supprimer"' +
                    'id="deleteUser"><i class="material-icons">delete</i></a></td>' +
                    '</tr>')
            },
            'JSON'
        )
    })
})


$('body').on('click', '#deleteUser', function () {
    let row_id = $(this).parents('tr').prop('id');
    let id = row_id.replace(/[^0-9.]/g, "");

    $.post(
        'header.php', {
            user_id: id,
            deleteUser: true
        },
        function (data) {
            if (data) {
                // alert(id)
                $('#user_id_' + id + '').remove()
            }
        },
        'JSON'
    )
})


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//CategoryList.php
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



$('#add_category').click(function () {
    $('#cat_name').append(
        '<input name="catName" type="text" id="catName" class="validate"> ' +
        '<label for="catName">Catégorie</label>'
    )
    $('#actions').append(
        '<button class="btn waves-effect waves-light red btn-small" id="cancelInsertCategory">Annuler' +
        '<i class="material-icons right">close</i>' +
        '</button>' +
        '<button class="btn waves-effect waves-light green btn-small" type="submit" id="insertCat" name="insertUser">Valider' +
        '<i class="material-icons right">send</i>' +
        '</button>'
    )
})



$('body').on('click', '#insertCat', function () {
    let catName = $('#catName').val()
    $.post(
        'header.php', {
            inc_cat_name: catName,
            insertCat: true
        },
        function (data) {
            $('#category_list').before(
                '<tr id="inc_cat_id_' + data[data.length - 1]['inc_cat_id'] + '">' +
                '<td>' + data[data.length - 1]['inc_cat_name'] + '</td>' +
                '<td>' +

                '<a class="btn-floating btn-large waves-effect waves-light blue btn tooltipped" data-position="top" data-tooltip="Modifier"' +
                'value="' + data[data.length - 1]['inc_cat_id'] + '" id="updateCategory"><i class="material-icons">edit</i></a>' +

                '<a class="btn-floating btn-large waves-effect waves-light red btn tooltipped" data-position="right" data-tooltip="Supprimer"' +
                'value="' + data[data.length - 1]['inc_cat_id'] + '" id="deleteCategory"><i class="material-icons">delete</i></a></td>' +
                '</tr>')
        },
        'JSON'
    )
})

$('body').on('click', '#deleteCategory', function () {
    let row_id = $(this).parents('tr').prop('id');
    let id = row_id.replace(/[^0-9.]/g, "");

    $.post(
        'header.php', {
            inc_cat_id: id,
            deleteCat: true
        },
        function (data) {
            // alert(data)
            if (data) {
                $('#inc_cat_id_' + id + '').remove()
            }
        },
        'JSON'
    )
})


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//expensesList.php
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$('#add_expenses').click(function () {
    $('#expenses_list').toggle()
    $('#add_expenses').removeClass("green")
    $('#add_expenses').addClass("red")
    $('#btnAdd').html('close')
    $('#add_expenses').attr('data-tooltip', 'Annuler');
    if (!$('#expenses_list').is(':visible')) {
        $('#add_expenses').removeClass("red")
        $('#add_expenses').addClass("green")
        $('#btnAdd').html('add')
        $('#add_expenses').attr('data-tooltip', 'Ajouter');
    }
})

$('body').on('click', '#insert_expenses', function () {
    let exp_label = $('#exp_label').val()
    let user_id = $('#addExpenseUserList').val()
    let amount = $('#exp_amount').val();
    let date = $('#exp_date').val()
    $.post(
        'header.php', {
            user_id: user_id,
            exp_amount: amount,
            exp_date: date,
            exp_label: exp_label,
            insertExpense: true
        },
        function (data) {
            $('#expensesList tr:last').after(
                '<tr id="expenses_id_' + data[data.length - 1]['exp_id'] + '">' +
                '<td>' + data[data.length - 1]['first_name'] + ' ' + data[data.length - 1]['last_name'] + '</td>' +
                '<td>' + data[data.length - 1]['exp_amount'] + '€</td>' +
                '<td>' + data[data.length - 1]['exp_date'] + '</td>' +
                '<td>' + data[data.length - 1]['exp_label'] + '</td>' +
                '<td><a class="btn-floating btn-large waves-effect waves-light blue btn tooltipped" data-position="top" data-tooltip="Modifier"' +
                'value="' + data[data.length - 1]['exp_id'] + '" id="updateExpense"><i class="material-icons">edit</i></a>' +

                '<a class="btn-floating btn-large waves-effect waves-light red btn tooltipped" data-position="right" data-tooltip="Supprimer"' +
                'value="' + data[data.length - 1]['exp_id'] + '" id="deleteExpense"><i class="material-icons">delete</i></a></td>' +
                '</tr>')
        },
        'JSON'
    )
})

$('body').on('click', '#updateExpense', function () {
    let row_id = $(this).parents('tr').prop('id');
    let id = row_id.replace(/[^0-9.]/g, "");
    $('#expensesAmount_id_' + id + '').html(
        '<div class="input-field col s12 m3 l3">' +
        '<input id="amount_id_' + id + '" name="amount_id_' + id + '" type="number" class="validate">' +
        '<label for="amount">Montant</label>' +
        '</div>'
    )
    $('#expensesDate_id_' + id + '').html(
        '<div class="input-field col s12 m3 l3">' +
        '<input type="text" class="datepicker" name="receipt_date_id_' + id + '" id="receipt_date_id_' + id + '"' +
        '<label for="receipt_date">Date de réception</label>' +
        '</div>'
    )
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        yearRange: 80
    })
    $('#expensesCat_id_' + id + '').html(
        '<div class="input-field col s12 m3 l3">' +
        '<input id="label_id_' + id + '" name="label_id_' + id + '" type="text" class="validate">' +
        '<label for="amount">Label</label>' +
        '</div>'
    )
    $('#actionsInc_id_' + id + '').html(
        '<button class="btn waves-effect waves-light green btn-small" id="updateIncome_id_' + id + '">Valider' +
        '<i class="material-icons right">send</i>' +
        '</button>')
    $('#updateIncome').hide()
    $('#deleteIncome').hide()

    $('#updateIncome_id_' + id + '').click(function () {
        let amount = $('#amount_id_' + id + '').val()
        let date = $('#receipt_date_id_' + id + '').val()
        let label = $('#label_id_' + id + '').val()
        $.post(
            'header.php', {
                exp_id: id,
                exp_amount: amount,
                exp_date: date,
                exp_label: label,
                updateExpense: true
            },
            function (data) {
                console.log(data)
                $('#expenses_id_' + id + '').html(
                    '<tr id="expenses_id_' + data[data.length - 1]['exp_id'] + '">' +
                    '<td>' + data[data.length - 1]['first_name'] + ' ' + data[data.length - 1]['last_name'] + '</td>' +
                    '<td>' + data[data.length - 1]['exp_amount'] + '€</td>' +
                    '<td>' + data[data.length - 1]['exp_date'] + '</td>' +
                    '<td>' + data[data.length - 1]['exp_label'] + '</td>' +
                    '<td><a class="btn-floating btn-large waves-effect waves-light blue btn tooltipped" data-position="top" data-tooltip="Modifier"' +
                    'value="' + data[data.length - 1]['exp_id'] + '" id="updateIncome"><i class="material-icons">edit</i></a>' +

                    '<a class="btn-floating btn-large waves-effect waves-light red btn tooltipped" data-position="right" data-tooltip="Supprimer"' +
                    'value="' + data[data.length - 1]['exp_id'] + '" id="deleteIncome"><i class="material-icons">delete</i></a></td>' +
                    '</tr>')
                $('#updateIncome').show()
                $('#deleteIncome').show()
            },
            'JSON'
        )
    })
})

$('body').on('click', '#deleteExpense', function () {
    let row_id = $(this).parents('tr').prop('id');
    let id = row_id.replace(/[^0-9.]/g, "");
    alert(id)
    $.post(
        'header.php', {
            exp_id: id,
            deleteExpense: true
        },
        function (data) {
            if (data) {
                // alert(id)
                $('#expenses_id_' + id + '').remove()
            }
        },
        'JSON'
    )
})
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//index.php
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



$(document).ready(function () {
    let j = 0
    $.post(
        'header.php', {
            getUsersIds: true
        },
        function (result) {
            let results = JSON.parse(result)
            for (let i = 0; i < results.length; i++) {
                $.post(
                    'header.php', {
                        user_id: results[i]['user_id'],
                        getUsersBalance: true
                    },
                    function (data) {
                        let datas = JSON.parse(data)
                        for (let j = 0; j < datas.length; j++) {
                            $('#income_id_' + datas[j]['id'] + '').append(
                                '<tr>' +
                                '<td>' + datas[j]['inc_amount'] + '</td>' +
                                '<td>' + datas[j]['receipt_date'] + '</td>' +
                                '<td>' + datas[j]['inc_cat_name'] + '</td>' +
                                '</tr>'
                            )
                            $('#expense_id_' + datas[j]['id'] + '').append(
                                '<tr>' +
                                '<td>' + datas[j]['exp_amount'] + '</td>' +
                                '<td>' + datas[j]['exp_date'] + '</td>' +
                                '<td>' + datas[j]['exp_label'] + '</td>' +
                                '</tr>'
                            )
                            let maxIncome = 0
                            let maxExpense = 0
                            maxIncome = maxIncome + Number(datas[j]['inc_amout'])
                            maxExpense = maxExpense + Number(datas[j]['exp_amount'])
                            let userBalance = Number(maxIncome) - Number(maxExpense)
                            console.log((datas[j]['inc_amout']))
                            console.log((datas[j]['exp_amount']))
                            console.log(Number(userBalance))
                            $('#userBalance_id_' + datas[j]['id'] + '').html(
                                '' + userBalance + ''
                            )
                        }
                    }
                )
            }
        }
    )
})