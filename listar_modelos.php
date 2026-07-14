<?php

include "config.php";

$url = "https://generativelanguage.googleapis.com/v1beta/models?key=" . GEMINI_API_KEY;

$resposta = file_get_contents($url);

echo "<pre>";
echo $resposta;
echo "</pre>";