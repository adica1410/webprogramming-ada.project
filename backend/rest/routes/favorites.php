<?php
require_once '../../services/FavoriteService.php';
require_once '../../middlewares/AuthMiddleware.php';
require_once '../../middlewares/AuthorizationMiddleware.php';

Flight::set('favorite_service', new FavoriteService());

// GET - Dohvati favorite za usera (dozvoljeno samo svom useru ili adminu)
Flight::route('GET /favorites/@user_id', function ($user_id) {
    Flight::auth_required();
    $user = Flight::get('user');

    if ($user->id != $user_id && $user->role !== 'admin') {
        Flight::halt(403, json_encode(['error' => 'Forbidden']));
    }

    Flight::json(Flight::get('favorite_service')->get_user_favorites($user_id));
});

// POST - Dodaj recept u favorite (samo za sebe)
Flight::route('POST /favorites', function () {
    Flight::auth_required();
    $user = Flight::get('user');

    $data = Flight::request()->data->getData();
    $data['user_id'] = $user->id; // osiguraj da korisnik dodaje sebi

    Flight::get('favorite_service')->add_favorite($data); // koristi array
    Flight::json(["message" => "Added to favorites"]);
});

// DELETE - Ukloni recept iz favorita (samo za sebe)
Flight::route('DELETE /favorites', function () {
    Flight::auth_required();
    $user = Flight::get('user');

    $data = Flight::request()->data->getData();
    $data['user_id'] = $user->id; // osiguraj da korisnik briše svoje

    Flight::get('favorite_service')->remove_favorite($data); // koristi array
    Flight::json(["message" => "Removed from favorites"]);
});

?>