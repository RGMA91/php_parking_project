<?php

function view($path, $data = []) {
    extract($data);
    include __DIR__ . "/../views/{$path}.php";
}