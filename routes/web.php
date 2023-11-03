<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\AsesorController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\ExameneController;
use App\Http\Controllers\ParticipanteController;

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
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//Empresa
Route::post('/empresa/activar', [EmpresaController::class, 'activar'])->name('empresa.activar');
Route::get('/empresa/bajas', [EmpresaController::class, 'bajas'])->name('empresa.bajas');
Route::resource('empresa', EmpresaController::class);


//Departamento
Route::post('/departamento/activar', [DepartamentoController::class, 'activar'])->name('departamento.activar');
Route::get('/departamento/bajas', [DepartamentoController::class, 'bajas'])->name('departamento.bajas');
Route::resource('departamento', DepartamentoController::class);

//Personal
Route::post('/personal/activar', [PersonalController::class, 'activar'])->name('personal.activar');
Route::get('/personal/bajas', [PersonalController::class, 'bajas'])->name('personal.bajas');
Route::resource('personal', PersonalController::class);

//Curso
Route::get('/curso/{curso}/faltas', [CursoController::class, 'faltas'])->name('curso.faltas');
Route::get('/curso/{curso}/justificar', [CursoController::class, 'justificar'])->name('curso.justificar');
Route::get('/curso/{curso}/asistencia', [CursoController::class, 'asistencia'])->name('curso.asistencia');
Route::get('/curso/{curso}/listas', [CursoController::class, 'listas'])->name('curso.listas');
Route::get('/curso/{curso}/participantes', [CursoController::class, 'cursoParticipantes'])->name('curso.participantes');
Route::post('/curso/ligar-asesor', [CursoController::class, 'ligarAsesor'])->name('curso.ligar_asesor');
Route::post('/curso/activar', [CursoController::class, 'activar'])->name('curso.activar');
Route::get('/curso/bajas', [CursoController::class, 'bajas'])->name('curso.bajas');
Route::resource('curso', CursoController::class);

//Asesor
Route::post('/asesor/activar', [AsesorController::class, 'activar'])->name('asesor.activar');
Route::get('/asesor/bajas', [AsesorController::class, 'bajas'])->name('asesor.bajas');
Route::resource('asesor', AsesorController::class);

//Examen
Route::post('/examene/activar', [ExameneController::class, 'activar'])->name('examen.activar');
Route::get('/examene/bajas', [ExameneController::class, 'bajas'])->name('examen.bajas');
Route::resource('examen', ExameneController::class);

//Participantes
Route::post('/participante/agregarSindicalizados', [ParticipanteController::class, 'agregarSindicalizados'])
->name('participante.agregarSindicalizados');
Route::post('/participante/agregarEmpledados', [ParticipanteController::class, 'agregarEmpledados'])
->name('participante.agregarEmpledados');
Route::get('/participante/delete', [ParticipanteController::class, 'delete']) -> name('participante.delete');
Route::resource('participante', ParticipanteController::class);

require __DIR__.'/auth.php';

