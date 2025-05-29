<?php
require_once __DIR__ . '/../services/UserService.php';
require_once __DIR__ . '/../middlewares/AuthMiddleware.php';
require_once __DIR__ . '/../middlewares/AuthorizationMiddleware.php';

header('Content-Type: application/json');
Flight::set('user_service', new UserService());

//  GET all users – samo admin
Flight::route('GET /users', function () {
    Flight::auth_required();
    AuthorizationMiddleware::is_admin();

    Flight::json(Flight::get('user_service')->get_all_users());
});

//  GET user by ID – admin ili vlasnik profila
Flight::route('GET /users/@id', function ($id) {
    Flight::auth_required();
    AuthorizationMiddleware::is_owner_or_admin($id);

    Flight::json(Flight::get('user_service')->get_user_by_id($id));
});

//  POST – registracija (javna)
Flight::route('POST /users', function () {
    $data = Flight::request()->data->getData();
    Flight::get('user_service')->create_user($data);
    Flight::json(["message" => "User created successfully"]);
});

//  PUT – admin ili vlasnik može ažurirati
Flight::route('PUT /users/@id', function ($id) {
    Flight::auth_required();
    AuthorizationMiddleware::is_owner_or_admin($id);

    $data = Flight::request()->data->getData();
    Flight::get('user_service')->update_user($id, $data);
    Flight::json(["message" => "User updated successfully"]);
});

//  DELETE – samo admin
Flight::route('DELETE /users/@id', function ($id) {
    Flight::auth_required();
    AuthorizationMiddleware::is_admin();

    Flight::get('user_service')->delete_user($id);
    Flight::json(["message" => "User deleted successfully"]);
});

