<?php
require_once __DIR__ . '/../../services/AuthService.php';

Flight::route('POST /auth/register', function () {
    $data = Flight::request()->data->getData();
    $authService = new AuthService();
    echo json_encode($authService->register($data));
});

Flight::route('POST /auth/login', function () {
    $data = Flight::request()->data->getData();
    $authService = new AuthService();
    echo json_encode($authService->login($data));
});

$authService = new AuthService();

Flight::route('POST /auth/login', function() use ($authService) {
    $data = Flight::request()->data->getData();
    Flight::json($authService->login($data));
});

