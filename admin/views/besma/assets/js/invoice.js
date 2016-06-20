$(document).ready(function () {
    $(".item-add").on("click", function () {

        var sTable = $(".invoice-items");
        var RowAppend = ['<tr class="item-row">',
            '<td></td>'+
             '<td><input type="text" autocomplete="off" name="description[]"  class="form-control description"></td>'+
                '<td><input type="text" autocomplete="off" name="qty[]"  class="form-control qty"> </td>'+
                '<td><input type="text" autocomplete="off" name="price[]"  class="form-control price" ></td>'+
                '<td><span class="amount" name="total[]">0</span></td>'+
                '<td><button class="btn btn-danger" id="RemoveITEM" type="button"><i class="fa fa-trash-o"></i> Remove</button></td>'


            , "</tr>"].join("");
        var sLookup = $(RowAppend);

        var description = sLookup.find(".description");
        

            $(".item-row:last", sTable).after(sLookup);
            $(description).focus();

            sLookup.find("#RemoveITEM").on("click", function () {

                $(this).parents(".item-row").remove();
                
                if ($(".item-row").length < 2) $("#deleteRow").hide();
                var e = $(this).closest("tr");

            });

        return false
    });





    $('.invoice-items tbody').delegate( '.qty, .price ', 'keydown', function(e){
        var key_code  = e.keyCode;

        if( ( key_code > 47 && key_code < 58 ) || ( key_code > 95 && key_code < 106 ) || key_code == 110 || key_code == 190 || key_code == 8 || key_code == 9 ){
//           initMainFunc( $(this).closest('tr') );
        } else {
            e.preventDefault();
           console.log( key_code );
        }
        var numb = $(e.currentTarget).val();
    });

    function initFuntion($this) {
        var qtyVal = $this.find('.qty').val();
        var priceVal =  $this.find('.price').val();

        if( qtyVal && priceVal ){
           $this.find('.amount').text(qtyVal*priceVal  );
           updateTotal( );
        }
    }

    $('.invoice-items tbody').delegate( '.qty, .price', 'keyup', function(){
        initFuntion($(this).closest('tr'));
    });

    function updateTotal() {

        var totalText = 0;

        $('.amount').each(function(){
            var amount = parseFloat($(this).text());
            totalText += amount;
        });
        $('.total').text(totalText);
    }




});

