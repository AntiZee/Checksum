<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Register</title>
</head>
<body>
<div id="bg">
    <form action="/register" method="POST">
        <div class="form-field">
            <input type="email" placeholder="Email" required/>
        </div>
        <div class="form-field">
            <input type="password" placeholder="Password" required/>
        </div>
        <div class="form-field">
            <button class="btn" type="submit">Register</button>
        </div>
    </form>
</div>
</body>
</html>