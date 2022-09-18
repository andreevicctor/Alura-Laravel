<x-layout title="Novo usuário">

    <form method="post">
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Senha</label>
            <input type="password" name="password" id="password" class="form-control  @error('password') is-invalid @enderror"
                autocomplete="current-password" required>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="form-label">Confirmação de Senha</label>
            <input type="password" name="password_confirmation" id="password_confirmation" 
                class="form-control @error('password') is-invalid @enderror" autocomplete="current-password" required>
        </div>

        <button class="btn btn-primary mt-3">Registrar</button>

    </form>
    
</x-layout>