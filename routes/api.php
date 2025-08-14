<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LeadController;

// --- Rutas Públicas ---
// El formulario de registro debe ser público para que cualquiera pueda registrarse.
Route::post('/leads', [LeadController::class, 'store']);

// --- Rutas Protegidas ---
// Solo usuarios autenticados y con rol de 'admin' pueden acceder a estas rutas.
Route::middleware(['auth:sanctum'])->group(function () {
    // Devuelve los datos del usuario autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Grupo específico para administradores
    Route::middleware('can:view-report')->group(function () {
        Route::get('/leads', [LeadController::class, 'index']);
        Route::patch('/leads/{lead}/contacted', [LeadController::class, 'markAsContacted']);
    });
});
