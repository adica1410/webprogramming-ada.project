<?php

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="My API",
 *     version="1.0.0",
 *     description="API documentation for the recipe app",
 *     @OA\Contact(
 *         email="example@example.com"
 *     )
 * )
 */

/**
 * @OA\Server(
 *     url="http://localhost/backend/rest",
 *     description="Local server"
 * )
 */

/**
 * USERS
 * @OA\Get(
 *     path="/users",
 *     summary="Get all users",
 *     @OA\Response(
 *         response=200,
 *         description="List of users"
 *     )
 * )
 * @OA\Post(
 *     path="/users",
 *     summary="Create new user",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"username", "email", "password"},
 *             @OA\Property(property="username", type="string"),
 *             @OA\Property(property="email", type="string"),
 *             @OA\Property(property="password", type="string")
 *         )
 *     ),
 *     @OA\Response(response=200, description="User created")
 * )
 */

/**
 * CATEGORIES
 * @OA\Get(
 *     path="/categories",
 *     summary="Get all categories",
 *     @OA\Response(response=200, description="List of categories")
 * )
 * @OA\Post(
 *     path="/categories",
 *     summary="Create category",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "description"},
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="description", type="string")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Category created")
 * )
 */

/**
 * RECIPES
 * @OA\Get(
 *     path="/recipes",
 *     summary="Get all recipes",
 *     @OA\Response(response=200, description="List of recipes")
 * )
 * @OA\Post(
 *     path="/recipes",
 *     summary="Create recipe",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title", "description", "category_id"},
 *             @OA\Property(property="title", type="string"),
 *             @OA\Property(property="description", type="string"),
 *             @OA\Property(property="category_id", type="integer")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Recipe created")
 * )
 */

/**
 * COMMENTS
 * @OA\Get(
 *     path="/comments",
 *     summary="Get all comments",
 *     @OA\Response(response=200, description="List of comments")
 * )
 * @OA\Get(
 *     path="/comments?recipe_id={id}",
 *     summary="Get comments by recipe ID",
 *     @OA\Parameter(
 *         name="recipe_id",
 *         in="query",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response=200, description="Comments for a recipe")
 * )
 * @OA\Post(
 *     path="/comments",
 *     summary="Add comment",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id", "recipe_id", "comment", "rating"},
 *             @OA\Property(property="user_id", type="integer"),
 *             @OA\Property(property="recipe_id", type="integer"),
 *             @OA\Property(property="comment", type="string"),
 *             @OA\Property(property="rating", type="number", format="float")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Comment added")
 * )
 */

/**
 * FAVORITES
 * @OA\Get(
 *     path="/favorites?user_id={id}",
 *     summary="Get favorites by user ID",
 *     @OA\Parameter(
 *         name="user_id",
 *         in="query",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(response=200, description="User's favorites")
 * )
 * @OA\Post(
 *     path="/favorites",
 *     summary="Add to favorites",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id", "recipe_id"},
 *             @OA\Property(property="user_id", type="integer"),
 *             @OA\Property(property="recipe_id", type="integer")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Added to favorites")
 * )
 * @OA\Delete(
 *     path="/favorites",
 *     summary="Remove from favorites",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id", "recipe_id"},
 *             @OA\Property(property="user_id", type="integer"),
 *             @OA\Property(property="recipe_id", type="integer")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Removed from favorites")
 * )
 */
