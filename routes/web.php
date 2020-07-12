<?php


if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PertanyaanController@index')->name('home');

Auth::routes();

Route::group(['middleware' => ['LoginUser']], function () {

    //pertanyaan
    Route::get('/pertanyaan/{id}', 'Frontend\PertanyaanController@detail')->name('pertanyaan.detail');
    Route::get('/pertanyaan', 'Frontend\PertanyaanController@index')->name('pertanyaan');
    Route::post('/pertanyaan', 'Frontend\PertanyaanController@store')->name('pertanyaan.store');
    //komentar di pertanyaan
    Route::match(['get', 'post'], '/post-komentar-pertanyaan', 'Frontend\KomentarController@storePertanyaan')->name('komentar.store');
    //komentar di jawaban
    Route::match(['get', 'post'], '/post-komentar-jawaban', 'Frontend\KomentarController@storeJawaban')->name('komentar.jawaban');

    //jawaban
    Route::match(['get', 'post'], '/post-jawaban', 'Frontend\JawabanController@store')->name('jawaban.store');

    //vote up pertanyaan
    Route::get('/post-vote-up/{id}', 'Frontend\VoteController@voteUp')->name('vote.up');
    //vote down pertanyaan
    Route::get('/post-vote-down/{id}', 'Frontend\VoteController@voteDown')->name('vote.down');
    //vote up jawaban
    Route::get('/jawaban-vote-up/{id}', 'Frontend\VoteController@voteUpJawaban')->name('jawaban.up');
    //vote down jawaban
    Route::get('/jawaban-vote-down/{id}', 'Frontend\VoteController@voteDownJawaban')->name('jawaban.down');



    Route::get('/account/{id}', 'Frontend\ProfilController@index')->name('account');
    //update profile
    Route::match(['get', 'post'], '/post', 'Frontend\ProfilController@post')->name('account.post');
    //membuat tag baru
    Route::match(['get', 'post'], '/post-tag', 'Frontend\TagController@post')->name('tag.post');
});

