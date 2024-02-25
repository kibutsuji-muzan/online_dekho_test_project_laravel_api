<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\accounts;
use App\Http\Controllers\Api\products;
use App\Http\Controllers\Api\storys;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('signup',[accounts::class,'signup']);
Route::post('login',[accounts::class,'login']);
Route::get('logout',[accounts::class,'logout'])->middleware('auth:sanctum');

Route::post('upload',[products::class,'upload'])->middleware('auth:sanctum');
Route::get('get',[products::class,'get'])->middleware('auth:sanctum');

Route::post('story_upload',[storys::class,'upload'])->middleware('auth:sanctum');
Route::get('story_get',[storys::class,'get'])->middleware('auth:sanctum');
Route::post('update_view',[storys::class,'updateViews'])->middleware('auth:sanctum');
Route::post('get_views',[storys::class,'getViews'])->middleware('auth:sanctum');
// Route::post('update_status',status::class)->middleware('auth:sanctum');
// Route::post('live_location',livelocation::class)->middleware('auth:sanctum');

// Illuminate\Database\QueryException: SQLSTATE[23000]: Integrity constraint violation: 1452 Cannot add or update a child row: a foreign key constraint fails (`laravel`.`products`, CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`username`) ON DELETE CASCADE) (Connection: mysql, SQL: insert into `products` (`name`, `desc`, `image`, `user_id`, `updated_at`, `created_at`) values (burger, something, /Applications/XAMPP/xamppfiles/temp/phpuT4Zpg, 1, 2024-02-03 18:09:53, 2024-02-03 18:09:53)) in file /Users/mohdkashif/Projects/online_dekho_test_project_laravel_api/vendor/laravel/framework/src/Illuminate/Database/Connection.php on line 822
