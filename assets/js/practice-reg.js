$(document).ready(function(){
    $('#login').show();
    $('.to_register').click(function(){
        $('#login').toggle();
        $('#register').toggle();
    });
});
