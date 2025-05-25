<?php
require_once '../../services/RecipeService.php';
require_once '../../middlewares/AuthMiddleware.php';
require_once '../../middlewares/AuthorizationMiddleware.php';

Flight::set('recipe_service', new RecipeService());

// GET all recipes (svi korisnici mogu)
Flight::route('GET /recipes', function () {
    Flight::auth_required();
    AuthorizationMiddleware::is_user_or_admin();

    Flight::json(Flight::get('recipe_service')->get_all_recipes());
});

// GET recipe by ID (svi korisnici mogu)
Flight::route('GET /recipes/@id', function ($id) {
    Flight::auth_required();
    AuthorizationMiddleware::is_user_or_admin();

    Flight::json(Flight::get('recipe_service')->get_recipe_by_id($id));
});

// POST - Kreiraj recept (samo logovani korisnik)
Flight::route('POST /recipes', function () {
    Flight::auth_required();
    AuthorizationMiddleware::is_user_or_admin();

    $user = Flight::get('user');
    $data = Flight::request()->data->getData();
    $data['user_id'] = $user->id; // dodeli vlasništvo

    Flight::get('recipe_service')->create_recipe($data);
    Flight::json(["message" => "Recipe created successfully"]);
});

// PUT - Update recepta (admin ili vlasnik)
Flight::route('PUT /recipes/@id', function ($id) {
    Flight::auth_required();

    $recipe = Flight::get('recipe_service')->get_recipe_by_id($id);
    if (!$recipe) {
        Flight::halt(404, json_encode(['error' => 'Recipe not found']));
    }

    AuthorizationMiddleware::is_owner_or_admin($recipe['user_id']);

    $data = Flight::request()->data->getData();
    Flight::get('recipe_service')->update_recipe($id, $data);
    Flight::json(["message" => "Recipe updated successfully"]);
});

// DELETE - Brisanje recepta (admin ili vlasnik)
Flight::route('DELETE /recipes/@id', function ($id) {
    Flight::auth_required();

    $recipe = Flight::get('recipe_service')->get_recipe_by_id($id);
    if (!$recipe) {
        Flight::halt(404, json_encode(['error' => 'Recipe not found']));
    }

    AuthorizationMiddleware::is_owner_or_admin($recipe['user_id']);

    Flight::get('recipe_service')->delete_recipe($id);
    Flight::json(["message" => "Recipe deleted successfully"]);
});

?>