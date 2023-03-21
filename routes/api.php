<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\PropositionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReponseController;
use App\Http\Controllers\AuthentificationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public routes
Route::resource('filieres',FiliereController::class);
Route::resource('etudiants',EtudiantController::class);
Route::resource('examens',ExamenController::class);
Route::resource('matieres',MatiereController::class);
Route::resource('professeurs',ProfesseurController::class);
Route::resource('propositions',PropositionController::class);
Route::resource('questions',QuestionController::class);
Route::resource('reponses',ReponseController::class);
Route::resource('notes',NoteController::class);
Route::resource('departements', DepartementController::class);

Route::post('/register', [AuthentificationController::class, 'register']);
Route::post('/login', [AuthentificationController::class, 'login']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    // Departement
    // Route::post('/departements',[DepartementController::class, 'store']);
    // Route::put('/departements/{id}',[DepartementController::class, 'update']);
    // Route::delete('/departements/{id}',[DepartementController::class, 'destroy']);
    // Etudiant
    Route::post('/etudiants',[EtudiantController::class, 'store']);
    Route::put('/etudiants/{id}',[EtudiantController::class, 'update']);
    Route::delete('/etudiants/{id}',[EtudiantController::class, 'destroy']);
    // Examen
    Route::post('/examens',[ExamenController::class, 'store']);
    Route::put('/examens/{id}',[ExamenController::class, 'update']);
    Route::delete('/examens/{id}',[ExamenController::class, 'destroy']);
    // Filiere
    Route::post('/filieres',[FiliereController::class, 'store']);
    Route::put('/filieres/{id}',[FiliereController::class, 'update']);
    Route::delete('/filieres/{id}',[FiliereController::class, 'destroy']);
    // Matiere
    Route::post('/matieres',[MatiereController::class, 'store']);
    Route::put('/matieres/{id}',[MatiereController::class, 'update']);
    Route::delete('/matieres/{id}',[MatiereController::class, 'destroy']);
    // Note
    Route::post('/notes',[NoteController::class, 'store']);
    Route::put('/notes/{id}',[NoteController::class, 'update']);
    Route::delete('/notes/{id}',[NoteController::class, 'destroy']);
    // Professeur
    Route::post('/professeurs',[ProfesseurController::class, 'store']);
    Route::put('/professeurs/{id}',[ProfesseurController::class, 'update']);
    Route::delete('/professeurs/{id}',[ProfesseurController::class, 'destroy']);
    // Proposition
    Route::post('/propositions',[PropositionController::class, 'store']);
    Route::put('/propositions/{id}',[PropositionController::class, 'update']);
    Route::delete('/propositions/{id}',[PropositionController::class, 'destroy']);
    // Question
    Route::post('/questions',[QuestionController::class, 'store']);
    Route::put('/questions/{id}',[QuestionController::class, 'update']);
    Route::delete('/questions/{id}',[QuestionController::class, 'destroy']);
    // Reponse
    Route::post('/reponses',[ReponseController::class, 'store']);
    Route::put('/reponses/{id}',[ReponseController::class, 'update']);
    Route::delete('/reponses/{id}',[ReponseController::class, 'destroy']);
    //logout
    Route::post('/logout', [AuthentificationController::class, 'logout']);
});