<?php

use App\Http\Livewire\Academico\Docente\EditDocente;
use App\Http\Livewire\Academico\Docente\ListDocente;
use App\Http\Livewire\Academico\Docente\NewDocente;
use App\Http\Livewire\Academico\Estudiante\EditEstudiante;
use App\Http\Livewire\Academico\Estudiante\ListEstudiante;
use App\Http\Livewire\Academico\Estudiante\NewEstudiante;
use App\Http\Livewire\Academico\Estudiante\ShowEstudiante;
use App\Http\Livewire\Academico\Modulo\EditModulo;
use App\Http\Livewire\Academico\Modulo\ListModulo;
use App\Http\Livewire\Academico\Modulo\NewModulo;
use App\Http\Livewire\Academico\Modulo\ShowModulo;
use App\Http\Livewire\Academico\Programa\EditPrograma;
use App\Http\Livewire\Academico\Programa\ListPrograma;
use App\Http\Livewire\Academico\Programa\NewPrograma;
use App\Http\Livewire\Academico\Programa\ShowPrograma;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Sistema\Rol\EditRol;
use App\Http\Livewire\Sistema\Rol\ListRol;
use App\Http\Livewire\Sistema\Rol\NewRol;
use App\Http\Livewire\Sistema\Usuario\EditUsuario;
use App\Http\Livewire\Sistema\Usuario\ListUsuario;
use App\Http\Livewire\Sistema\Usuario\NewUsuario;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');

    // MODULO SISTEMA
    Route::group(['prefix' => 'usuario'], function () {
        Route::get('/list', ListUsuario::class)->name('usuario.list');
        Route::get('/new', NewUsuario::class)->name('usuario.new');
        Route::get('/edit/{usuario}', EditUsuario::class)->name('usuario.edit');
    });

    Route::group(['prefix' => 'rol'], function () {
        Route::get('/list', ListRol::class)->name('rol.list');
        Route::get('/new', NewRol::class)->name('rol.new');
        Route::get('/edit/{rol}', EditRol::class)->name('rol.edit');
    });

    // MODULO ACADEMICO
    Route::group(['prefix' => 'estudiante'], function () {
        Route::get('/list', ListEstudiante::class)->name('estudiante.list');
        Route::get('/new', NewEstudiante::class)->name('estudiante.new');
        Route::get('/edit/{estudiante}', EditEstudiante::class)->name('estudiante.edit');
        Route::get('/show/{estudiante}', ShowEstudiante::class)->name('estudiante.show');
    });

    Route::group(['prefix' => 'programa'], function () {
        Route::get('/list', ListPrograma::class)->name('programa.list');
        Route::get('/new', NewPrograma::class)->name('programa.new');
        Route::get('/edit/{programa}', EditPrograma::class)->name('programa.edit');
        Route::get('/show/{programa}', ShowPrograma::class)->name('programa.show');
    });

    Route::group(['prefix' => 'docente'], function () {
        Route::get('/list', ListDocente::class)->name('docente.list');
        Route::get('/new', NewDocente::class)->name('docente.new');
        Route::get('/edit/{docente}', EditDocente::class)->name('docente.edit');
        Route::get('/show/{docente}', ShowPrograma::class)->name('docente.show');
    });

    Route::group(['prefix' => 'modulo'], function () {
        Route::get('/list', ListModulo::class)->name('modulo.list');
        Route::get('/new', NewModulo::class)->name('modulo.new');
        Route::get('/edit/{modulo}', EditModulo::class)->name('modulo.edit');
        Route::get('/show/{modulo}', ShowModulo::class)->name('modulo.show');
    });
});
