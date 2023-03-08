<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/app.css">
    <title>Reset Password</title>
</head>
<body>
    <div class="bg">
        <a href="login" class="back-button">&#8592; Back</a>
        <form action="{{ route('password.reset') }}" method="POST" id="auth">
            @csrf
            @if (session('status'))
                <div class="form-field">
                    <p>{{ session('status') }}</p>
                </div>
            @endif
            @error('password')
                <div class="form-field">
                    <p>{{ $message }}</p>
                </div>
            @enderror
            <div class="form-field" id="p">
                <input type="password" name="password" placeholder="Password" required />
            </div>
            <div class="form-field">
                <button class="btn" type="submit">Send</button>
            </div>
        </form>
    </div>
</body>
</html>