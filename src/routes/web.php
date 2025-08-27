<?php

use Illuminate\Support\Facades\Route;



Route::post('/livros', [App\Http\Controllers\LivroController::class, 'cadastrarLivro'])
    ->name('livros.cadastrar');

Route::get('/', [App\Http\Controllers\LivroController::class, 'listarLivros'])
     ->name('livros.listar');

Route::any('/livros/{id}', [App\Http\Controllers\LivroController::class, 'editarLivro'])
    ->name('livros.atualizar');

Route::get('/livros/{id}/editar', [App\Http\Controllers\LivroController::class, 'mostrarFormularioEditar'])
    ->name('livros.editar');

Route::post('livros/{id}/deletar', [App\Http\Controllers\LivroController::class, 'deletarLivro'])
    ->name('livros.deletar');