<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/css/style.css">
<link rel="stylesheet" href="/css/bootstrap.css">
    <script src="/js/jquery.js" type="text/javascript"></script>
    <script src="/js/bootstrap.js" type="text/javascript"></script>
<link rel="stylesheet" href="/css/style.css">
<style>
body {font-family: "Times New Roman", Georgia, Serif;}
h1, h2, h3, h4, h5, h6 {
  font-family: "Playfair Display";
  letter-spacing: 5px;
}
</style>
<body>
	<form class="form" action="{{ route('signin') }}" method="POST">
		@if(count($errors) > 0)
			@foreach($errors->all() as $error)
			<div class="alert alert-danger" role="alert">{{ $error }}</div>
			@endforeach
		@endif
		{{ csrf_field() }}
		<h2>Uloguj se</h2>
		<div class="input">
			<div class="inputBox">
				<label>Email</label>
				<input type="text" name="email" placeholder="">
			</div>
			<div class="inputBox">
				<label>Lozinka</label>
				<input type="password" name="password" placeholder="">
			</div>
			<div class="inputBox">
				<input type="submit" name="" value="Uloguj se">
			</div>
		</div>
		<p class="forget">Zaboravljena lozinka <a href="">Klikni ovde</a></p>
		<p class="forget"><a href="{{ route('signup') }}">Novi korisnik</a></p>
	</form>
</body>
</html>