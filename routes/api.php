<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\CountyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Users – Felhasználók
|--------------------------------------------------------------------------
*/

/**
 * @api {post} /users/login Bejelentkezés
 * @apiName UserLogin
 * @apiGroup Users
 *
 * @apiDescription Bejelentkezteti a felhasználót a megadott hitelesítési adatokkal.
 *
 * @apiBody {String} email A felhasználó e-mail-címe.
 * @apiBody {String} password A felhasználó jelszava.
 *
 * @apiSuccess {Object} user A hitelesített felhasználó adatai.
 * @apiSuccess {String} token Hitelesítési token, amennyiben a végpont visszaadja.
 *
 * @apiError (401) Unauthorized Hibás hitelesítési adatok.
 * @apiError (422) ValidationError Érvénytelen vagy hiányzó adatok.
 */
Route::post('/users/login', [UserController::class, 'login']);

/**
 * @api {get} /users Felhasználók listázása
 * @apiName GetUsers
 * @apiGroup Users
 *
 * @apiDescription Lekéri az adatbázisban tárolt felhasználók listáját.
 *
 * @apiSuccess {Object[]} users A felhasználók listája.
 * @apiSuccess {Number} users.id A felhasználó azonosítója.
 * @apiSuccess {String} users.name A felhasználó neve.
 * @apiSuccess {String} users.email A felhasználó e-mail-címe.
 *
 * @apiError (500) InternalServerError Szerveroldali hiba.
 */
Route::get('/users', [UserController::class, 'index']);


/*
|--------------------------------------------------------------------------
| Cities – Városok
|--------------------------------------------------------------------------
*/

/**
 * @api {get} /cities Városok listázása
 * @apiName GetCities
 * @apiGroup Cities
 *
 * @apiDescription Lekéri az adatbázisban tárolt városok listáját.
 *
 * @apiSuccess {Object[]} cities A városok listája.
 * @apiSuccess {Number} cities.id A város azonosítója.
 * @apiSuccess {String} cities.zip_code A város irányítószáma.
 * @apiSuccess {String} cities.city A város neve.
 * @apiSuccess {Number} cities.population A város lakosságszáma.
 * @apiSuccess {Number} cities.county_id A városhoz tartozó vármegye azonosítója.
 *
 * @apiError (500) InternalServerError Szerveroldali hiba.
 */
Route::get('cities', [CityController::class, 'index']);

/**
 * @api {post} /city Új város létrehozása
 * @apiName CreateCity
 * @apiGroup Cities
 * @apiPermission Authenticated
 *
 * @apiDescription Új várost hoz létre az adatbázisban.
 * A végpont használatához Sanctum-hitelesítés szükséges.
 *
 * @apiHeader {String} Authorization Bearer token.
 * @apiHeader {String} Content-Type application/json.
 *
 * @apiBody {String} zip_code A város irányítószáma.
 * @apiBody {String} city A város neve.
 * @apiBody {Number} population A város lakosságszáma.
 * @apiBody {Number} county_id A vármegye azonosítója.
 *
 * @apiExample {json} Példakérés:
 * {
 *   "zip_code": "2600",
 *   "city": "Vác",
 *   "population": 33500,
 *   "county_id": 1
 * }
 *
 * @apiSuccess (201) {Object} city A létrehozott város adatai, ha a végpont visszaadja őket.
 *
 * @apiError (401) Unauthorized Hiányzó vagy érvénytelen hitelesítés.
 * @apiError (422) ValidationError Érvénytelen bemeneti adatok.
 */
Route::post('city', [CityController::class, 'store'])->middleware('auth:sanctum');

/**
 * @api {put} /cities/:id Város módosítása
 * @apiName UpdateCity
 * @apiGroup Cities
 * @apiPermission Authenticated
 *
 * @apiDescription Módosítja a megadott azonosítójú város adatait.
 * A végpont használatához Sanctum-hitelesítés szükséges.
 *
 * @apiHeader {String} Authorization Bearer token.
 * @apiHeader {String} Content-Type application/json.
 *
 * @apiParam {Number} id A módosítandó város azonosítója.
 *
 * @apiBody {String} zip_code A város irányítószáma.
 * @apiBody {String} city A város neve.
 * @apiBody {Number} population A város lakosságszáma.
 * @apiBody {Number} county_id A vármegye azonosítója.
 *
 * @apiExample {json} Példakérés:
 * {
 *   "zip_code": "2600",
 *   "city": "Vác",
 *   "population": 34000,
 *   "county_id": 1
 * }
 *
 * @apiSuccess {Object} city A módosított város adatai, ha a végpont visszaadja őket.
 *
 * @apiError (401) Unauthorized Hiányzó vagy érvénytelen hitelesítés.
 * @apiError (404) NotFound A város nem található.
 * @apiError (422) ValidationError Érvénytelen bemeneti adatok.
 */
Route::put('cities/{id}', [CityController::class, 'update'])->middleware('auth:sanctum');

/**
 * @api {delete} /cities/:id Város törlése
 * @apiName DeleteCity
 * @apiGroup Cities
 * @apiPermission Authenticated
 *
 * @apiDescription Törli a megadott azonosítójú várost az adatbázisból.
 * A végpont használatához Sanctum-hitelesítés szükséges.
 *
 * @apiHeader {String} Authorization Bearer token.
 *
 * @apiParam {Number} id A törlendő város azonosítója.
 *
 * @apiSuccess {String} message Sikeres törlésről szóló üzenet, ha a végpont visszaadja.
 *
 * @apiError (401) Unauthorized Hiányzó vagy érvénytelen hitelesítés.
 * @apiError (404) NotFound A város nem található.
 */
Route::delete('cities/{id}', [CityController::class, 'destroy'])->middleware('auth:sanctum');


/*
|--------------------------------------------------------------------------
| Counties – Vármegyék
|--------------------------------------------------------------------------
*/

/**
 * @api {get} /counties Vármegyék listázása
 * @apiName GetCounties
 * @apiGroup Counties
 *
 * @apiDescription Lekéri az adatbázisban tárolt vármegyék listáját.
 *
 * @apiSuccess {Object[]} counties A vármegyék listája.
 * @apiSuccess {Number} counties.id A vármegye azonosítója.
 * @apiSuccess {String} counties.name A vármegye neve.
 * @apiSuccess {String} counties.badge A vármegye címerének vagy jelvényének URL-je.
 *
 * @apiError (500) InternalServerError Szerveroldali hiba.
 */
Route::get('counties', [CountyController::class, 'index']);

/**
 * @api {post} /county Új vármegye létrehozása
 * @apiName CreateCounty
 * @apiGroup Counties
 * @apiPermission Authenticated
 *
 * @apiDescription Új vármegyét hoz létre az adatbázisban.
 * A végpont használatához Sanctum-hitelesítés szükséges.
 *
 * @apiHeader {String} Authorization Bearer token.
 * @apiHeader {String} Content-Type application/json.
 *
 * @apiBody {String} name A vármegye neve.
 * @apiBody {String} badge A vármegye címerének vagy jelvényének URL-je.
 *
 * @apiExample {json} Példakérés:
 * {
 *   "name": "Pest",
 *   "badge": "https://example.com/pest.png"
 * }
 *
 * @apiSuccess (201) {Object} county A létrehozott vármegye adatai, ha a végpont visszaadja őket.
 *
 * @apiError (401) Unauthorized Hiányzó vagy érvénytelen hitelesítés.
 * @apiError (422) ValidationError Érvénytelen bemeneti adatok.
 */
Route::post('county', [CountyController::class, 'store'])->middleware('auth:sanctum');

/**
 * @api {put} /counties/:id Vármegye módosítása
 * @apiName UpdateCounty
 * @apiGroup Counties
 * @apiPermission Authenticated
 *
 * @apiDescription Módosítja a megadott azonosítójú vármegye adatait.
 * A végpont használatához Sanctum-hitelesítés szükséges.
 *
 * @apiHeader {String} Authorization Bearer token.
 * @apiHeader {String} Content-Type application/json.
 *
 * @apiParam {Number} id A módosítandó vármegye azonosítója.
 *
 * @apiBody {String} name A vármegye neve.
 * @apiBody {String} badge A vármegye címerének vagy jelvényének URL-je.
 *
 * @apiExample {json} Példakérés:
 * {
 *   "name": "Bács-Kiskun",
 *   "badge": "https://example.com/bacs-kiskun.png"
 * }
 *
 * @apiSuccess {Object} county A módosított vármegye adatai, ha a végpont visszaadja őket.
 *
 * @apiError (401) Unauthorized Hiányzó vagy érvénytelen hitelesítés.
 * @apiError (404) NotFound A vármegye nem található.
 * @apiError (422) ValidationError Érvénytelen bemeneti adatok.
 */
Route::put('counties/{id}', [CountyController::class, 'update'])->middleware('auth:sanctum');

/**
 * @api {delete} /counties/:id Vármegye törlése
 * @apiName DeleteCounty
 * @apiGroup Counties
 * @apiPermission Authenticated
 *
 * @apiDescription Törli a megadott azonosítójú vármegyét az adatbázisból.
 * A végpont használatához Sanctum-hitelesítés szükséges.
 *
 * @apiHeader {String} Authorization Bearer token.
 *
 * @apiParam {Number} id A törlendő vármegye azonosítója.
 *
 * @apiSuccess {String} message Sikeres törlésről szóló üzenet, ha a végpont visszaadja.
 *
 * @apiError (401) Unauthorized Hiányzó vagy érvénytelen hitelesítés.
 * @apiError (404) NotFound A vármegye nem található.
 */
Route::delete('counties/{id}', [CountyController::class, 'destroy'])->middleware('auth:sanctum');