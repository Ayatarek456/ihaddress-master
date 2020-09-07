<?php

use App\Http\Controllers\Api\IhUniqueController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Setup CORS */
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");


//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});



Route::post('social_auth', 'Api\LoginController@socialAuth');
Route::post('search', 'Api\SearchController@search');
Route::post('fcm/send','Api\FcmtokenController@sendMessage');
Route::post('rate','Api\RateController@store');

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('logout','Api\LoginController@ApiLogout');
    Route::post('fcm','Api\FcmtokenController@store');
    Route::post('createaddress','Api\AddressController@createAddress');
    Route::post('createaddress2','Api\AddressController@createAddress2');
    Route::post('deleteaddress','Api\AddressController@deleteAddress');
    Route::post('editaddress','Api\AddressController@editAddress');
    Route::post('updateaddress','Api\AddressController@updateAddress');

    Route::post('saveaddress','Api\SaveAddressController@store');
    Route::post('saveaddress/index','Api\SaveAddressController@index');
    Route::post('saveaddress/delete','Api\SaveAddressController@delete');
    Route::post('saveaddress/update','Api\SaveAddressController@edit');
});


Route::get('test',function (){
    $ip = $_SERVER['REMOTE_ADDR'];
    $ih = (new App\Http\Controllers\Api\IhUniqueController)->generateIH($ip);
    return $ih;
});

//Route::post('createAddress',function (){
//    $image = str_replace('data:image/png;base64,', '', $_POST['image1']);
//    $image = str_replace(' ', '+', $image);
//// Decode the Base64 encoded Image
//    $data = base64_decode($image);
//// Create Image path with Image name and Extension
//    $file = public_path('/images') . "MyImage" . '.jpg';
//// Save Image in the Image Directory
//    $success = file_put_contents($file, $data);
//    return 'ok';
//});