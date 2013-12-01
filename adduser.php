<?php

    session_start();

    $form_token = md5(rand(time(), true));

    $_SESSION['form_token'] = $form_token;

    $form_action = 'adduser_submit.php';

    $submit_value = 'Добави потребител';

    include 'includes/header.php';

    include 'includes/user_form.php'; 

    include 'includes/footer.php';
?>
