<?php

Route::view('login', 'auth.login');
Route::view('/', 'home')->name('inicio');
Route::post('login', 'Auth\LoginController@validateLogin')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('/chatEx', function() {
    return view ('chat.chat');
});
Route::resource('temario', 'TopicController', ['parameters' => [
    'temario' => 'topic'
]]);

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
    Route::resource('consulta', 'ChatController', ['parameters' => [
        'consulta' => 'chat'
    ]]);
    Route::post('message', 'MessageController@store');
    Route::resource('comment', 'CommentController');
    Route::resource('subscription', 'UserTopicController');
    Route::get('/information/{topic}', 'ResourceController@show')->name('information.show');
    Route::put('/passwordUpdate', 'UserController@resetPassword');
    Route::post('/test/resultado', 'UserProblemController@store')->name('test.realizar');   
    Route::get('/pruebas/{topic}', 'ProblemController@indexPruebas')->name('pruebasIndex.show');
    Route::get('/pruebas/{topic}/{int}', 'ProblemController@getPruebas')->name('getpruebas.show');
    Route::post('/contact', 'ContactController@store')->name('contact');
    Route::get('/resolver/{chat}', 'ChatController@solved')->name('consulta.resolver');
});

Route::middleware('role:teacher', 'role:admin')->group(function () {
    Route::get('/teachertopics', 'Intranet\TeacherTopicController@index')->name('teachertopic.index');
    Route::get('/teachertopic/resources/{topic}', 'Intranet\TeacherResourceController@index')->name('teacherresources.index');
    Route::get('/teacherresource/create/{topic}', 'Intranet\TeacherResourceController@create')->name('teacherresource.create');
    Route::get('/teacherterm/create/{topic}', 'Intranet\AdminTermController@create')->name('teacherterm.create');
    Route::get('/teacherproblem/problem/{topic}', 'Intranet\TeacherProblemController@index')->name('teacherproblem.index');
    Route::get('/teacherproblem/create/{topic}', 'Intranet\TeacherProblemController@create')->name('teacherproblem.create');
    Route::get('consultas/{topic}', 'Intranet\TeacherChatController@indexTopic')->name('consultas.index');
    Route::get('nuevaconsulta/{topic}', 'Intranet\TeacherChatController@create')->name('consultas.create');
    Route::get('terminos/{topic}', 'Intranet\TeacherTermController@index')->name('teacherterminos.index');
    Route::get('nuevotermino/{topic}', 'Intranet\TeacherTermController@create')->name('teacherterm.create');
    Route::resource('resource', 'Intranet\AdminResourceController');
    Route::resource('topic', 'Intranet\AdminTopicController');
    Route::resource('problem', 'Intranet\AdminProblemController');
    Route::resource('question', 'Intranet\AdminQuestionController');
    Route::resource('option', 'Intranet\AdminOptionController');
    Route::resource('chat', 'Intranet\AdminChatController');
    Route::resource('term', 'Intranet\AdminTermController');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/intranet', 'HomeController@showIntranet')->name('dashboard');
    Route::resource('user', 'Intranet\AdminUserController');
    Route::resource('post', 'Intranet\AdminPostController');
    Route::get('/problemType/{id}', 'Intranet\AdminProblemController@indexType')->name('problem.indexType');
    Route::get('/userType/{id}', 'Intranet\AdminUserController@indexType')->name('user.indexType');
    Route::post('/file', 'Intranet\AdminProblemController@storefile')->name('file.store');
    Route::get('/activate{user}', 'Intranet\AdminUserController@activate')->name('user.activate');
    Route::get('/deactivate{user}', 'Intranet\AdminUserController@deactivate')->name('user.deactivate');
    Route::get('/Postactivate{post}', 'Intranet\AdminPostController@activate')->name('post.activate');
    Route::get('/Postdeactivate{post}', 'Intranet\AdminPostController@deactivate')->name('post.deactivate');
    Route::get('/deleteImage/{topic}', 'Intranet\AdminTopicController@deleteImage')->name('image.delete');
});



