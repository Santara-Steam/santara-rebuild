

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets2/css/guest/error.css') }}" />

    <title>Santara - Error 404</title>
</head>

<body>
<div class="page-container">
	<div class="img-logo">
      <img src="https://storage.googleapis.com/asset-santara/santara.co.id/images/error/404.png" alt="Error 404" style="width: 80%;">       
  	</div>
  	<div>
      <h1 class="title">Halaman Tidak Ditemukan</h1>
	  <p class="description">Error 404. </br>Mohon maaf kami tidak bisa menemukan halaman yang Anda maksud.</p> 
      <div class="app-download">
      	<a href="{{ url('/') }}" class="btn btn-santara-red" type="button">
            Kembali Kehalaman Utama
        </a>
      </div>	  
	</div>
</div>
</body>
</html>
