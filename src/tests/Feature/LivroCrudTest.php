<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Livro;

class LivroCrudTest extends TestCase
{
    use RefreshDatabase; // Limpa o banco a cada teste

    /** @test */
    public function pode_cadastrar_um_livro()
    {
        $dados = [
            'titulo' => 'Livro de Teste',
            'autor' => 'Autor Teste',
            'editora' => 'Editora Teste',
            'ano' => 2025,
            'quantidade' => 5,
        ];

        $response = $this->postJson(route('livros.cadastrar'), $dados);

        // Verifica se retornou status 201
        $response->assertStatus(201);

        // Verifica se o JSON retornado tem o livro
        $response->assertJsonFragment([
            'titulo' => 'Livro de Teste',
            'autor' => 'Autor Teste',
        ]);

        // Verifica se o livro foi realmente salvo no banco
        $this->assertDatabaseHas('livros', [
            'titulo' => 'Livro de Teste',
            'autor' => 'Autor Teste',
        ]);
    }

    /** @test */
    public function pode_editar_um_livro()
    {
        // Cria um livro de teste
        $livro = Livro::create([
            'titulo' => 'Original',
            'autor' => 'Autor',
            'editora' => 'Editora',
            'ano' => 2025,
            'quantidade' => 10,
        ]);

        // Dados de atualização
        $dadosAtualizados = [
            'titulo' => 'Novo Título',
            'autor' => 'Novo Autor',
            'editora' => 'Nova Editora',
            'ano' => 2026,
            'quantidade' => 5,
        ];

        // Simula PATCH para a rota de atualização
        $response = $this->patch(route('livros.atualizar', $livro->id), $dadosAtualizados);

        // Verifica redirecionamento
        $response->assertRedirect(route('livros.listar'));

        // Verifica se o livro foi atualizado no banco
        $this->assertDatabaseHas('livros', [
            'id' => $livro->id,
            'titulo' => 'Novo Título',
            'autor' => 'Novo Autor',
        ]);
    }

     /** @test */
    public function pode_deletar_um_livro()
    {
        // Cria um livro de teste
        $livro = Livro::create([
            'titulo' => 'Para Deletar',
            'autor' => 'Autor',
            'editora' => 'Editora',
            'ano' => 2025,
            'quantidade' => 10,
        ]);

        // Simula POST para deletar
        $response = $this->post(route('livros.deletar', $livro->id));

        // Verifica redirecionamento
        $response->assertRedirect(route('livros.listar'));

        // Verifica se o livro foi removido
        $this->assertDatabaseMissing('livros', [
            'id' => $livro->id,
        ]);
    }

}
