/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";
$('.select2').select2();

const Toast = Swal.mixin({
     toast: true,
     position: 'top-end',
     showConfirmButton: false,
     timer: 3000
});
var delay = (function(){
     var timer = 0;
     return function(callback, ms){
     clearTimeout(timer);
     timer = setTimeout(callback,ms);
     };
})();  

function Angkasaja(evt) 
{
     var charCode = (evt.which) ? evt.which : event.keyCode
     if (charCode > 31 && (charCode < 48 || charCode > 57))
          return false;
     return true;
}

function tanggal_indo(data)
{
     if(data == '0000-00-00')
     {
          return '-';
     }else{
          var tgl = data.split("-");
          return tgl[2]+' '+get_bulan(tgl[1])+' '+tgl[0];  
     }

}

$("input[data-type='currency']").on({
     keyup: function() {
          formatCurrency($(this));
     },
     blur: function() { 
          formatCurrency($(this), "blur");
     }
});

function formatNumber(n) {
     return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".")
}
function formatCurrency(input, blur) {
     var input_val = input.val().replace(/^0+/, '');
     if (input_val === "") { return; }
     var original_len = input_val.length;
     var caret_pos = input.prop("selectionStart");

     if (input_val.indexOf(",") >= 0) {
          var decimal_pos = input_val.indexOf(",");
          var left_side = input_val.substring(0, decimal_pos);
          var right_side = input_val.substring(decimal_pos);

          left_side = formatNumber(left_side);

          right_side = formatNumber(right_side);

          if (blur === "blur") {
               right_side += "";
          }

          right_side = right_side.substring(0, 2);

          input_val = left_side + "" + right_side;

     } 
     else {
          input_val = formatNumber(input_val);
          input_val = input_val;
          if (blur === "blur") {
               input_val += "";
          }
     }

     input.val(input_val);

     var updated_len = input_val.length;
     caret_pos = updated_len - original_len + caret_pos;
     input[0].setSelectionRange(caret_pos, caret_pos);
}

function format_uang(bilangan)
{
     if(bilangan != null)
     {
          var number_string = bilangan.toString(),
          sisa    = number_string.length % 3,
          rupiah  = number_string.substr(0, sisa),
          ribuan  = number_string.substr(sisa).match(/\d{3}/g);

          if (ribuan) {
               separator = sisa ? '.' : '';
               rupiah += separator + ribuan.join('.');
          }
     }else{
          rupiah = '';
     }


     return rupiah;
}

function get_bulan(data){
     var id = parseInt(data);
     switch(id) {
          case 1: { return 'Januari'; break; }
          case 2: { return 'Februari'; break; }
          case 3: { return 'Maret'; break; }
          case 4: { return 'April'; break; }
          case 5: { return 'Mei'; break; }
          case 6: { return 'Juni'; break; }  
          case 7: { return 'Juli'; break; }
          case 8: { return 'Agustus'; break; }
          case 9: { return 'September'; break; }
          case 10: { return 'Oktober'; break; }
          case 11: { return 'November'; break; }
          case 12: { return 'Desember'; break; }
     }
}