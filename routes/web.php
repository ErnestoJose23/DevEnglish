<?php

Route::view('login', 'auth.login');
Route::view('/', 'home')->name('inicio');
Route::post('login', 'Auth\LoginController@validateLogin')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');


Route::resource('temario', 'TopicController', ['parameters' => [
    'temario' => 'topic'
]]);
Route::get('/videos', 'VideosController@Index');
Route::get('/links', 'LinksController@Index');
Route::get('/videos/{topic}', 'VideosController@showVideos')->name('videos.show');
Route::get('/links/{topic}', 'LinksController@showLinks')->name('links.show');

Route::middleware(['auth'])->group( function (){
    Route::resource('forum', 'PostController', ['parameters' => [
        'forum' => 'post'
    ]]);
    Route::resource('usuario', 'UserController', ['parameters' => [
        'usuario' => 'user'
    ]]);
    Route::resource('prueba', 'ProblemController', ['parameters' => [
        'prueba' => 'problem'
    ]]);
    Route::resource('comment', 'CommentController');
    Route::resource('subscription', 'SubscriptionController');
    Route::get('/progreso/{id}', 'UserController@getProgreso')->name('user.progreso');
    Route::get('/ajustes', 'UserController@profile');
    Route::put('/ajustes/{user}', 'UserController@update')->name('user.update');
    Route::post('profile', 'UserController@update_avatar');
    Route::put('/passwordUpdate', 'UserController@resetPassword');
    Route::get('/temarios', 'PruebasController@Index');
    Route::post('/test/resultado', 'PruebasController@realizarTest')->name('test.realizar');   
    Route::get('/pruebas/{topic}', 'ProblemController@indexPruebas')->name('pruebasIndex.show');
    Route::get('/pruebas/{topic}/{int}', 'ProblemController@getPruebas')->name('getpruebas.show');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/intranet', 'HomeController@showIntranet')->name('dashboard');
    Route::get('password', 'UserController@changePassword')->name('password');
    Route::post('password', 'UserController@resetPassword')->name('reset.password');

    Route::resource('resource', 'Intranet\AdminResourceController');
    Route::resource('topic', 'Intranet\AdminTopicController');
    Route::resource('user', 'Intranet\AdminUserController');
    Route::resource('problem', 'Intranet\AdminProblemController');
    Route::resource('post', 'Intranet\AdminPostController');
    Route::get('/problemType/{id}', 'Intranet\AdminProblemController@indexType')->name('problem.indexType');
    Route::get('/userType/{id}', 'Intranet\AdminUserController@indexType')->name('user.indexType');
    Route::post('/question', 'Intranet\AdminQuestionController@store')->name('question.store');
    Route::post('/file', 'Intranet\AdminProblemController@storefile')->name('file.store');
    Route::delete('preguntas/{question}', 'Intranet\AdminQuestionController@destroy')->name('question.destroy');
    Route::delete('option/{option}/{problem}', 'Intranet\AdminOptionController@destroy')->name('option.destroy');
    Route::post('/option', 'Intranet\AdminOptionController@store')->name('option.store');
    Route::get('/activate{user}', 'Intranet\AdminUserController@activate')->name('user.activate');
    Route::get('/deactivate{user}', 'Intranet\AdminUserController@deactivate')->name('user.deactivate');
    Route::get('/Postactivate{post}', 'Intranet\AdminPostController@activate')->name('post.activate');
    Route::get('/Postdeactivate{post}', 'Intranet\AdminPostController@deactivate')->name('post.deactivate');
});



