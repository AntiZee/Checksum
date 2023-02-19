<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link  rel="stylesheet" href="{{ asset('/js/app.js') }}">
    <title>Cryptographic Hash Function Tools</title>
</head>
<body>
    <div class="navbar"></div>
    <h1 id="head1">Cryptographic Hash Function Tools</h1>
    <div class="arrow">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <div id="body">
      <table id="table1">
          <tr>
            <th><h3 id="head3">File Hash</h3></th>
            <th><h3 id="head3">String Hash</h3></th>
          </tr>
          <tr>
            <td><li><a href="app/file/md5f.html">MD5</a></li></td>
            <td><li><a href="app/string/md5.html">MD5</a></li></td>
          </tr>
          <tr>
            <td><li><a href="app/file/sha1f.html">SHA-1</a></li></td>
            <td><li><a href="app/file/sha1.html">SHA-1</a></li></td>
          </tr>
          <tr>
            <td><li><a href="app/file/sha256f.html">SHA-256</a></li></td>
            <td><li><a href="app/file/sha256.html">SHA-256</a></li></td>
          </tr>
          <tr>
            <td><li><a href="app/file/sha512f.html">SHA-512</a></li></td>
            <td><li><a href="app/file/sha512.html">SHA-512</a></li></td>
          </tr>
        </table>
      </table>
    </div>
</body>
</html>