<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <title>Hash</title>
</head>
<body>
    @guest
        <header>
            <h1 id="head1">Non-Academic Digital Certificate Verificator (SHA-512)</h1>
            <div class="auth">
                <a href="login"><button>Login</button></a>
                <a href="register"><button>Register</button></a>
            </div>
        </header>
        <br>
        <p class="hint">↓↓ Masukkan sertifikat digital anda ke dalam kotak di bawah ini (Hanya menerima jpg/jpeg, png, dan pdf) ↓↓</p>
        <div class="input">
            <div id="droppable-zone">
                <div id="droppable-zone-wrapper">
                    <div id="droppable-zone-text">Drag & drop your certificate here OR click to browse</div>
                </div>
                <input class="droppable-file" id="input" type="file" accept="image/jpeg, image/png, application/pdf" onchange="hash()">
            </div>
        </div>
        <br>
        <p class="hint">↓↓ Dan hasil akan keluar di kotak bawah ini ↓↓</p>
        <div class="output">
            <textarea id="output" placeholder="SHA-512 Checksum" readonly></textarea>
        </div>
        <p class="hint">Tekan untuk clear input dan output</p>
        <div class="remove">
            <button id="remove" onclick="clearInput()">Remove</button>
        </div>
    @endguest
    @auth
        <header>
            <h1 id="head2">Non-Academic Digital Certificate Validator (SHA-512)</h1>
            <div class="auth">
                <input type="text" name="search" id="search" placeholder="Search SHA-512 Checksum">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button>Logout</button>
                </form>
            </div>
        </header>
        <br>
        <p class="hint">↓↓ Masukkan sertifikat digital anda ke dalam kotak di bawah ini (Hanya menerima jpg/jpeg, png, dan pdf) ↓↓</p>
        <div class="input">
            <div id="droppable-zone">
                <div id="droppable-zone-wrapper">
                    <div id="droppable-zone-text">Drag & drop your certificate here OR click to browse</div>
                </div>
                <input class="droppable-file" id="input" type="file" accept="image/jpeg, image/png, application/pdf" onchange="hash()">
            </div>
        </div>
        <br>
        <p class="hint">↓↓ Dan hasil akan keluar di kotak bawah ini ↓↓</p>
        <div class="output">
            <textarea id="output" placeholder="SHA-512 Checksum" readonly></textarea>
        </div>
        <p class="hint">Tekan untuk clear input dan output</p>
        <div class="remove">
            <button id="remove" onclick="clearInput()">Remove</button>
        </div>
        <p class="hint">Tekan save untuk menyimpan data sertifikat. Hasil data sertifikat yang pernah tersimpan akan ditampilkan pada tabel dibawah</p>
        <div class="save">
            <form action="{{ route('save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="name" id="namefile" readonly>
                <input type="hidden" name="sha512" id="hash" readonly>
                <input type="file" name="certificate" style="display: none">
                <button id="save" type="submit" disabled>Save</button>
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>SHA-512</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody id="search_results">
                @if ($certificates->isEmpty())
                    <tr>
                        <td colspan="4">No Data</td>
                    </tr>
                @else
                    @foreach ($certificates as $c)
                        <tr>
                            <td>{{ $c->name }}</td>
                            <td>{{ $c->time }}</td>
                            <td>{{ $c->sha512 }}</td>
                            <td><a href="{{ Storage::url($c->file_path) }}" download><button>Download</button></a></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    @endauth
</body>
</html>