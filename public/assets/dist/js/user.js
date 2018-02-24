$(document).ready(function(){
    $('#economy li select').change(function(){
        var selectedPackage = 'package'+$(this).val();
        $('#economy .price span').html($('#economy .price').data(selectedPackage));
        $('#economy .callUser').html($('#economy .callUser').data(selectedPackage));
        $('#economy .smsBlast').html($('#economy .smsBlast').data(selectedPackage));
        $('#economy .emailAlert').html($('#economy .emailAlert').data(selectedPackage));
        $('#economy .freeListing').html($('#economy .freeListing').data(selectedPackage));
        $('#economy .hotProperties').html($('#economy .hotProperties').data(selectedPackage));
        $('#economy .signUpLink a').attr('href', $('#economy .signUpLink a').data(selectedPackage));
    });
});