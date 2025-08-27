<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
     <link href="{{ asset('css/style_editar.css') }}" rel="stylesheet">
    <style>
 
    </style>
</head>
<body>
<div class="container">

   
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

   
    <div class="card">
        <h3 class="mb-4">Editar Livro: {{ $livro->titulo }}</h3>
        <form action="{{ route('livros.atualizar', $livro->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $livro->titulo }}" required>
            </div>

            <div class="mb-3">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" class="form-control" id="autor" name="autor" value="{{ $livro->autor }}" required>
            </div>

            <div class="mb-3">
                <label for="editora" class="form-label">Editora</label>
                <input type="text" class="form-control" id="editora" name="editora" value="{{ $livro->editora }}" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="ano" class="form-label">Ano de Publicação</label>
                    <input type="number" class="form-control" id="ano" name="ano" value="{{ $livro->ano }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="quantidade" class="form-label">Quantidade em Estoque</label>
                    <input type="number" class="form-control" id="quantidade" name="quantidade" value="{{ $livro->quantidade }}" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Atualizar Livro</button>
            <a href="{{ route('livros.listar') }}" class="btn btn-secondary btn-back">← Voltar à Lista de Livros</a>
        </form>
    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
