<?php

if (empty($_GET['artistId']) or !is_numeric($_GET['artistId'])) {
    header('Location: /index.php');
    exit();
}

if (isset($_GET['artistId']) && !empty($_GET['artistId'])) {
    $artistId = $webPage->escapeString($_GET['artistId']);
} else {
    http_response_code($response_code = 404);
}

if ($artistId < 1 || $artistId > 89) {
    header("Location: /index.php", true, 404);
    exit();
}