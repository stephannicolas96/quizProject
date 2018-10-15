<?php

$email = isset($_POST['inputValue']) ? htmlspecialchars($_POST['inputValue']) : '';

if(filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo '1';
} else {
    echo '0';
}
