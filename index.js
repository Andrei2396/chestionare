/*
 *  INDEX PAGE
 */

$('#login-index').click(function(){
    $('#login-blur').show();
    $('#login-window').show();
})
$('#login-blur').click(function(){
    $('#login-blur').hide();
    $('#login-window').hide();
    $('#register-window').hide();
})
$('#register-btn').click(function(){
    if($('#login-window').is(':visible')){
        $('#login-window').hide('slow');
        $('#register-window').show('slow');
    }
})

/**
 *  CHESTIONAR
 */

function check() {
    document.getElementsByClassName("choice1").checked = true;
  }
 
  $('.chioce').on('click', function(){
    $('.choice').removeClass('selected');
    $(this).addClass('selected');
});