<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search').on('input', function() {
                const query = $(this).val();
                $.ajax({
                    url: "{{ route('search') }}",
                    type: "GET",
                    dataType: "html",
                    data: {
                        'search': query
                    },
                    success: function(data) {
                        $('#search_results').html('');
                        $('#search_results').append(data);
                    }
                });
            });
        });
    </script>
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
                <input class="droppable-file" id="input" type="file" accept="image/jpeg, image/png, application/pdf"
                    onchange="hash()">
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
                <input type="text" name="search" id="search" placeholder="Search SHA-512 Checksum">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button>Logout</button>
                </form>
            </div>
        </header>
        <div class="input">
            <div id="droppable-zone">
                <div id="droppable-zone-wrapper">
                    <div id="droppable-zone-text">Drag & drop your certificate here OR click to browse</div>
                </div>
                <input class="droppable-file" id="input" type="file" accept="image/jpeg, image/png, application/pdf"
                    onchange="hash()">
            </div>
        </div>
        <div class="output">
            <textarea id="output" placeholder="SHA-512 Checksum" readonly></textarea>
        </div>
        <div class="remove">
            <button id="remove" onclick="clearInput()">Remove</button>
        </div>
        <div class="save">
            <form action="{{ route('save') }}" method="POST">
                @csrf
                <input type="hidden" name="name" id="namefile" readonly>
                <input type="hidden" name="sha512" id="hash" readonly>
                <button id="save" type="submit" disabled>Save</button>
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>SHA-512</th>
                </tr>
            </thead>
            <tbody id="search_results">
                @if ($certificates->isEmpty())
                    <tr>
                        <td colspan="3">No Data</td>
                    </tr>
                @else
                    @foreach ($certificates as $c)
                        <tr>
                            <td>{{ $c->name }}</td>
                            <td>{{ $c->time }}</td>
                            <td>{{ $c->sha512 }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    @endauth
</body>

</html>
