<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <title>Non-Academic Digital Certificate Validator (SHA-512)</title>
</head>
<body>
    <header>
        <h1 id="head1">Non-Academic Digital Certificate Validator (SHA-512)</h1>
        <div class="auth">
            <button>Login</button>
            <button>Register</button>
        </div>
    </header>
    <div class="input">
        <div id="droppable-zone">
          <div id="droppable-zone-wrapper">
            <div id="droppable-zone-text">Drag & drop your certificate here OR click to browse</div>
          </div>
          <input class="droppable-file" id="input" type="file">
        </div>
    </div>
    <div class="output">
        <textarea id="output" placeholder="SHA-512 Checksum" readonly></textarea>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    </div>
</body>
</html>