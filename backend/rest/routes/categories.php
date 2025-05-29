<?php
require_once '../../services/CategoryService.php';
require_once '../../middlewares/AuthMiddleware.php';
require_once '../../middlewares/AuthorizationMiddleware.php';

Flight::set('category_service', new CategoryService());

Flight::route('GET /categories', function () {
    Flight::auth_required();
    AuthorizationMiddleware::is_user_or_admin();

    Flight::json(Flight::get('category_service')->get_all_categories());
});

Flight::route('GET /categories/@id', function ($id) {
    Flight::auth_required();
    AuthorizationMiddleware::is_user_or_admin();

    Flight::json(Flight::get('category_service')->get_category_by_id($id));
});

Flight::route('POST /categories', function () {
    Flight::auth_required();
    AuthorizationMiddleware::is_admin(); // samo admin moze dodavati kategorije

    $data = Flight::request()->data->getData();
    Flight::get('category_service')->create_category($data['name'], $data['description']);
    Flight::json(["message" => "Category created successfully"]);
});

Flight::route('PUT /categories/@id', function ($id) {
    Flight::auth_required();
    AuthorizationMiddleware::is_admin(); // samo admin moze mijenjati

    $data = Flight::request()->data->getData();
    Flight::get('category_service')->update_category($id, $data['name'], $data['description']);
    Flight::json(["message" => "Category updated successfully"]);
});

Flight::route('DELETE /categories/@id', function ($id) {
    Flight::auth_required();
    AuthorizationMiddleware::is_admin(); // samo admin moze brisati

    Flight::get('category_service')->delete_category($id);
    Flight::json(["message" => "Category deleted successfully"]);
});

?>