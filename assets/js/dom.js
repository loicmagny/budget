$(document).ready(function () {
    $('.sidenav').sidenav();
    $('.collapsible').collapsible();
    $('select').formSelect();
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        yearRange: 80
    });
    $('.timepicker').timepicker({
        format: 'HH:ii:SS',
        twelveHour: false,
        default: 'now'
    });
    $('.tooltipped').tooltip();
    let elem = $('.collapsible.expandable');
    let instance = M.Collapsible.init(elem, {
        accordion: false
    });
    $('.tabs').tabs();
});