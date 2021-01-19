/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

function change_row(element) {
    row = element.parent().parent();
    row_id = element.parent().parent().attr('row_id');
    product_id = row.find('.product_id').val();
    product_quantity = row.find('.product_quantity').val();
    $.ajax({
        method: 'POST',
        url: window.location.href,
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'row_id': row_id,
            'product_id': product_id,
            'quantity': product_quantity
        }
    }).done(function (result) {
        row.find('.price').text(result.price);
        row.find('.amount').text(result.price * product_quantity);
    });
}

$(document).ready(function () {
    $('.table-child').hide();
    $('.visible-control-products').on('click', function () {
        $('#table' + this.id).toggle();
    });
    $('.product_row').each(function () {
        price = $(this).find('.price').text();
        quantity = $(this).find('.product_quantity').val();
        $(this).find('.amount').text(price*quantity);
    });
    $('.product_id').on('change', function () {
        change_row($(this));
    });
    $('.product_quantity').on('change', function () {
        change_row($(this));
    });
});