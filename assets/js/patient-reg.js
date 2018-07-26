$(document).ready(function(){
    $('#login').show();
    $('.to_register').click(function(){
        $('#login').toggle();
        $('#register').toggle();
    });
});

$("#userphonesignup").keypress(function(e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 43 && e.which > 31 ) {
        return false;
    }
});


$("#register").submit(function(event){
    var forename	= $("#usernamesignup").val();
    var surname		= $("#userlnamesignup").val();
    var email		= $("#emailsignup").val();
    var mobile		= $("#userphonesignup").val();
    if(forename.trim() == ''){
        event.preventDefault();
        $("#usernamesignup").css('border','1px solid red');
        $("#usernamesignup").focus();
    }else if(surname.trim() == ''){
        event.preventDefault();
        $("#userlnamesignup").css('border','1px solid red');
        $("#userlnamesignup").focus();
    }else if(email.trim() == ''){
        event.preventDefault();
        $("#emailsignup").css('border','1px solid red');
        $("#emailsignup").focus();
    }else if(mobile.trim() == ''){
        event.preventDefault();
        $("#userphonesignup").css('border','1px solid red');
        $("#userphonesignup").focus();
    }
});	
