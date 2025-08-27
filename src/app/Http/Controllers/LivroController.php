<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use Illuminate\Support\Facades\Log;

class LivroController extends Controller
{
    
    public function cadastrarLivro(Request $request){
        $livro = new Livro();

        $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'editora' => 'required|string|max:255',
            'ano' => 'required|integer',
            'quantidade' => 'required|integer',
        ]);

        $livro->titulo = $request->input('titulo');
        $livro->autor = $request->input('autor');
        $livro->editora = $request->input('editora');
        $livro->ano = $request->input('ano');
        $livro->quantidade = $request->input('quantidade');

        $existe = Livro::where('autor', $request->autor)
                    ->where('editora', $request->editora)
                    ->exists();

    if ($existe) {
        return redirect()->back()
                         ->withInput()
                         ->with('error', 'Registro duplicado encontrado: este autor já possui livro registrado nesta editora.');
    }
        $livro ->save();

        Log::debug('Request recebido: ', $request->all());

        return redirect()->route('livros.listar')->with('success', 'Livro cadastrado com sucesso!');

    }

    public function listarLivros()
    {
        $livros = Livro::all();
        return view('livros', compact('livros'));
    }

    public function editarLivro(Request $request, $id)
    {
        $livro = Livro::find($id);
        if (!$livro) {
            return response()->json(['message' => 'Livro não encontrado'], 404);
        }

        $request->validate([
            'titulo' => 'sometimes|required|string|max:255',
            'autor' => 'sometimes|required|string|max:255',
            'editora' => 'sometimes|required|string|max:255',
            'ano' => 'sometimes|required|integer',
            'quantidade' => 'sometimes|required|integer',
        ]);

        $livro->update($request->only(['titulo', 'autor', 'editora', 'ano', 'quantidade']));

        return redirect()->route('livros.listar')->with('success', 'Livro atualizado com sucesso!');
    }

    public function mostrarFormularioEditar($id)
{
    $livro = Livro::find($id);
    if (!$livro) {
        return redirect('/livroslist')->with('error', 'Livro não encontrado');
    }

    return view('editar_livro', compact('livro'));
}

    public function deletarLivro($id)
    {
        $livro = Livro::find($id);
        if (!$livro) {
            return response()->json(['message' => 'Livro não encontrado'], 404);
        }

        $livro->delete();
        return redirect()->route('livros.listar')->with('success', 'Livro deletado com sucesso!');
    }
}
