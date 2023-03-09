<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Reset Password</title>
</head>
<body>
    <div class="bg">
        <form action="{{ route('password.update') }}" method="POST" id="auth">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            @if (session('status'))
                <div class="form-field">
                    <p class="text-center">{{ session('status') }}</p>
                </div>
            @endif
            @error('email')
                <div class="form-field">
                    <p class="text-center">{{ $message }}</p>
                </div>
            @enderror
            @error('password')
                <div class="form-field">
                    <p class="text-center">{{ $message }}</p>
                </div>
            @enderror
            @error('password_confirmation')
                <div class="form-field">
                    <p class="text-center">{{ $message }}</p>
                </div>
            @enderror
            <div class="form-field" id="e">
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="form-field" id="p">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-field" id="p">
                <input type="password" name="password_confirmation" placeholder="Password Confirmation" required>
            </div>
            <div class="form-field">
                <button class="btn" type="submit">Reset Password</button>
            </div>
        </form>
    </div>
</body>
</html>