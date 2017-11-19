$(document).ready(function() {

    $('#order-form').submit(function(){
        $.ajax({
            type: 'POST',
            url: 'main_script.php',
            data: $(this).serialize()
        }).done(function() {
            /*$('#callback1').hide('slow');
            $('#post_form_success').html('Благодарим за оставленную заявку! Мы свяжемся с Вами в ближайшее время');*/
            //window.location = "http://agencyfirst.ru/spasibo.html";
            alert('Ушло');
        });
        return false;
    });

});