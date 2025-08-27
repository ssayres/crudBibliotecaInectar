<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style_lista.css') }}" rel="stylesheet">

</head>
<body>
<div class="container py-5">

    <!-- Mensagens de sucesso ou erro -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Formulário de Cadastro -->
    <div class="form-section mb-5">
        <h2 class="mb-4">Controle de Livros</h2>
        <div class="card p-4 shadow-sm">
            <form action="{{ route('livros.cadastrar') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" required>
                </div>
                <div class="mb-3">
                    <label for="autor" class="form-label">Autor</label>
                    <input type="text" class="form-control" id="autor" name="autor" required>
                </div>
                <div class="mb-3">
                    <label for="editora" class="form-label">Editora</label>
                    <input type="text" class="form-control" id="editora" name="editora" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="ano" class="form-label">Ano de Publicação</label>
                        <input type="number" class="form-control" id="ano" name="ano" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="quantidade" class="form-label">Quantidade em Estoque</label>
                        <input type="number" class="form-control" id="quantidade" name="quantidade" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Cadastrar Livro</button>
            </form>
        </div>
    </div>

    <!-- Lista de Livros -->
    <h2 class="mb-4">Lista de Livros</h2>
    <div class="row g-4">
        @foreach($livros as $livro)
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $livro->titulo }}</h5>
                    <p class="card-text">
                        <strong>Autor:</strong> {{ $livro->autor }}<br>
                        <strong>Editora:</strong> {{ $livro->editora }}<br>
                        <strong>Ano:</strong> {{ $livro->ano }}<br>
                        <strong>Estoque:</strong> {{ $livro->quantidade }}
                    </p>
                    <a href="{{ route('livros.editar', $livro->id) }}" class="btn btn-sm btn-warning btn-edit">Editar</a>
                    <form action="{{ route('livros.deletar', $livro->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Deseja realmente deletar este livro?')">Deletar</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
