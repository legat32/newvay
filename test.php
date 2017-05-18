<?php 
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "info@newvay.ru";
    $to = "avdeevstas@ya.ru";
    $subject = "Сайт работает";
    $message = "Уточните, как вы хотите отправлять почту? Вижу что у вас раньше отправлялась почта через SMTP яндекса. Можем настроить отправку через него.
Для этого вам надо указать актуальный пароль для входа в почтовый ящик яндекса.";
    $headers = "From:" . $from;
    mail($to,$subject,$message, $headers);
    echo "Test email sent";
?>
