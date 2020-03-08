<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
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
	<form class="form" action="{{ route('signup') }}" method="POST">
		@if(count($errors) > 0)
			@foreach($errors->all() as $error)
			<div class="alert alert-danger" role="alert">{{ $error }}</div>
			@endforeach
		@endif
		{{ csrf_field() }}
		<h2>Registruj se</h2>
		<div class="input">
			<div class="inputBox">
				<label>Email</label>
				<input type="text" name="email" placeholder="">
			</div>
			<div class="inputBox">
				<label>Naziv firme</label>
				<input type="text" name="name" placeholder="">
			</div>
			<div class="inputBox">
				<label>Grad</label>
				<input type="text" name="city" placeholder="">
			</div>
			<div class="inputBox">
				<label>Adresa</label>
				<input type="text" name="address" placeholder="">
			</div>
			<div class="inputBox">
			  <label for="category">Trgovina na malo</label>
			  <select class="form-control" name="category">
			    <option value="0" disabled="" selected="">--Izaberi--</option>
			    <option value="butik">Butik</option>
			    <option value="pekara">Pekara</option>
			  </select>
			</div>
			<div class="inputBox">
				<label>Lozinka</label>
				<input type="password" name="password" placeholder="">
			</div>
			<div class="inputBox">
				<input type="submit" name="" value="Registruj se">
			</div>
		</div>
		<p class="forget">Zaboravljena lozinka <a href="">Kliknite ovde</a></p>
	</form>
</body>
</html>
