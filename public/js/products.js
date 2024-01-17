$(document).ready(function() {
    const ProductQuantity = {
        prodId: null,
        quantityValueSelector: '',
        updateQuantity: function (plusValue, quantityValueSelector) {
            if (null === this.prodId) {
                return false;
            }

            $.ajax({
                type:'POST',
                url:'/admin/products/' + this.prodId + '/update_quantity',
                dataType: 'json',
                data: {
                    _token: $('input[name="_token"]').val(),
                    plus_value: plusValue,
                },
                success: function(data) {
                    quantityValueSelector.text(data.product_quantity);
                    $('.bsm-alert').show();
                    setTimeout(function () {
                        $('.bsm-alert').hide();
                    }, 2000);
                    // window.location.reload();
                },
                error: function() {
                }
            });
        }
    }

    $('.quantity .subQuantity').on('click', function () {
        ProductQuantity.prodId = $(this).closest('tr').data('product_id');
        ProductQuantity.updateQuantity(-1, $(this).closest('tr').find('.quantityValue'));
    });

    $('.quantity .plusQuantity').on('click', function () {
        ProductQuantity.prodId = $(this).closest('tr').data('product_id');
        ProductQuantity.updateQuantity(1, $(this).closest('tr').find('.quantityValue'));
    });

    $('.prodType').on('change', function () {
        const TYPE_MULTIPLE = 2;
        TYPE_MULTIPLE == $(this).val() ? $('.sub_product_section').show() : $('.sub_product_section').hide();
    });
});



