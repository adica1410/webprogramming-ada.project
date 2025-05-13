<?php
require '../vendor/autoload.php';

require_once 'services/UserService.php';
require_once 'services/RecipeService.php';
require_once 'services/CategoryService.php';
require_once 'services/CommentService.php';
require_once 'services/FavoriteService.php';

Flight::set('user_service', new UserService());
Flight::set('recipe_service', new RecipeService());
Flight::set('category_service', new CategoryService());
Flight::set('comment_service', new CommentService());
Flight::set('favorite_service', new FavoriteService());

require 'rest/routes/users.php';
require 'rest/routes/recipes.php';
require 'rest/routes/categories.php';
require 'rest/routes/comments.php';
require 'rest/routes/favorites.php';

Flight::start();
