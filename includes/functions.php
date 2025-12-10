<?php
session_start();

// Gerar token
function generateToken() {
    if (!isset($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['token'];
}

// Validar token
function validateToken($t) {
    return isset($_SESSION['token']) && hash_equals($_SESSION['token'], $t);
}
?>
