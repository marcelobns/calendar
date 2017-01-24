$(function(){
    uppercase('.uppercase');
    $('.selectize').selectize();
    $('.wrapper').fadeIn();
});
$('#modal_frame').on('shown.bs.modal', function(e) {
    uppercase('.uppercase');
});
function uppercase(input){
    $(input).blur(function(e){
        e.currentTarget.value = e.currentTarget.value.toUpperCase();
    });
}
function weekday(n){
    switch (n) {
        case 0:
            return "Domingo"
            break;
        case 1:
            return "Segunda"
            break;
        case 2:
            return "Terça"
            break;
        case 3:
            return "Quarta"
            break;
        case 4:
            return "Quinta"
            break;
        case 5:
            return "Sexta"
            break;
        case 6:
            return "Sábado"
            break;
    }
}
