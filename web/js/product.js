$(document).on('beforeSubmit', 'div#product-form', function(e){
    var form = $('form#product-update');
    var formData = form.serialize();
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: formData,
        success: function (data) {
            // $('#product-update').attr('action')
            $('div#product-form').load("/product/create");
            $('html').animate({scrollTop:0}, '200');
            $.pjax({container: '#last-products-grid-pjax', timeout: false}).done(function() { $.pjax({container: '#products-grid-pjax', timeout: false}) });
            $('#inf-success').show().fadeOut(5000);
        },
        error: function () {
            alert('Ошибка записи! Обратитесь к разработчику, описав последовательно все действия, которые привели к ошибке!');
            $('inf-error').show().children('span').html('Ошибка! ' + data);
            $('html').animate({scrollTop:0}, '200');
            $('#inf-error').fadeOut(5000);
        }
    });
});

$(document).ready(function() {
    'use strict';

    $('div#product-form').on('submit', function(e){
        e.preventDefault();
    });

    $('#product-code').liTranslit();
});

function editProduct(key) {
    // var data = $(this).data();
    $('div#product-form').load('/product/update?id=' + key);
    // $('#product-code').liTranslit();
    // $('.grid-view tbody tr').removeClass('selected');
    // $(this).addClass('selected');
}
function rememberAccordionState(el) {
    'use strict';
    if ( $(el).next().hasClass('in') ) {
        Cookies.set('accordionState', '0', { path: '/' });
    }
    else  {
        Cookies.set('accordionState', $(el).data('num'), { path: '/' });
    }
    // alert($(el).data('num'));
    // alert(getCookie('accordionState'));
}

function showClassKnife(el) {
    $('#classKnife').toggle();
}

