<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    <title>Non-Academic Digital Certificate Validator (SHA-512)</title>
</head>
<body>
    @guest
    <header>
        <h1 id="head1">Non-Academic Digital Certificate Validator (SHA-512)</h1>
        <div class="auth">
            <a href="/login"><button>Login</button></a>
            <a href="/register"><button>Register</button></a>
        </div>
    </header>
    <div class="input">
        <div id="droppable-zone">
          <div id="droppable-zone-wrapper">
            <div id="droppable-zone-text">Drag & drop your certificate here OR click to browse</div>
          </div>
          <input class="droppable-file" id="input" type="file" accept="image/jpeg, image/png, application/pdf" onchange="hash()">
        </div>
    </div>
    <div class="output">
        <textarea id="output" placeholder="SHA-512 Checksum" readonly></textarea>
    </div>
    <div class="remove">
        <button id="remove" onclick="clearInput()">Remove</button>
    </div>
    @endguest
    @auth
    <header>
        <h1 id="head1">Non-Academic Digital Certificate Validator (SHA-512)</h1>
        <div class="auth">
            <form class="search">
                <input type="text" placeholder="Search...">
            </form>
            <form action="{{ route('logout') }}" method="POST" id>
                @csrf
                <a href="#"><button>Logout</button></a>
            </form>
        </div>
    </header>
    <div class="input">
        <div id="droppable-zone">
          <div id="droppable-zone-wrapper">
            <div id="droppable-zone-text">Drag & drop your certificate here OR click to browse</div>
          </div>
          <input class="droppable-file" id="input" type="file" accept="image/jpeg, image/png, application/pdf" onchange="hash()">
        </div>
    </div>
    <div class="output">
        <textarea id="output" placeholder="SHA-512 Checksum" readonly></textarea>
    </div>
    <div class="remove">
        <button id="remove" onclick="clearInput()">Remove</button>
    </div>
    <div class="save">
        <button id="save" onclick="save()" disabled>Save</button>
    </div>
    <table>
        <thead>
            <tr>
                <th>No.</th>
				<th>Name</th>
				<th>Date</th>
				<th>SHA-512</th>
            </tr>
        </thead>
    </table>
    @endauth
</body>
</html>