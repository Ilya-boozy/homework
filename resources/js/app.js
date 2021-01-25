/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

function changeRow(element) {
    row = element.parent().parent();
    axios.post(
        '/api/products/info',
        {
            product_id: row.find('.product_id').val()
        }
    ).then(function (response) {
            row.find('.price').text(response.data.price);
            row.find('.amount').text(response.data.price * row.find('.quantity').val());
        }
    );
}

function afterLoadTable(element) {

    element.find('.table-child').hide();
    element.find('.visible-control-products').on('click', function () {
        $('#table' + this.id).toggle();
    });
    element.find('.product_row').each(function () {
        price = $(this).find('.price').text();
        quantity = $(this).find('.quantity').val();
        $(this).find('.amount').text(price * quantity);
    });
    element.find('.page-link').on('click', function () {
        ``;
        getPage($(this).attr('url'), $(this));
    });
}

function getPage(url, btn) {
    if (url) {
        axios
            .get(url)
            .then(function (response) {
                conteiner = ($('.tab-pane').has($(btn)));
                conteiner.html(response.data);
                afterLoadTable(conteiner);
            });
    }
}

$(document).ready(function () {
    afterLoadTable($('html'));
    $('.product_id').on('change', function () {
        changeRow($(this));
    });
    $('.quantity').on('change', function () {
        changeRow($(this));
    });
});