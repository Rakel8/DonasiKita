<?php
// Redirect all requests to public/index.php
header('Location: /public/index.php' . (empty($_SERVER['QUERY_STRING']) ? '' : '?' . $_SERVER['QUERY_STRING']));
exit;
