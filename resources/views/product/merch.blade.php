<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!--<script src="{{ asset('js/app.js') }}" defer></script>-->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">-->

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="/css/bootstrap.css">
    <script src="/js/jquery.js" type="text/javascript"></script>
    <script src="/js/bootstrap.js" type="text/javascript"></script>
</head>
<body>
    <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ route('dashboard') }}">Home</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        @if(Auth::user()->category == 'pekara')
        <li><a href="{{ route('insert_product') }}">Dodajte proizvod</a></li>
        @elseif(Auth::user()->category == 'butik')
        <li><a href="{{ route('insert_merch') }}">Dodajte robu</a></li>
        @endif
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('logout') }}">Izloguj se</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  </nav>
  <div class="container">
    @if(count($errors) > 0)
      @foreach($errors->all() as $error)
      <div class="alert alert-danger" role="alert">{{ $error }}</div>
      @endforeach
    @endif
 <form action="{{ route('merchandise') }}" method="POST">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="name">Proizvodjac:</label>
    <input type="text" class="form-control" name="proiz">
  </div>
  <div class="form-group">
    <label for="name">Zemlja porekla:</label>
    <input type="text" class="form-control" name="country">
  </div>
  <div class="form-group">
    <label for="name">Uvoznik:</label>
    <input type="text" class="form-control" name="uvoznik">
  </div>
  <div class="form-group">
    <label for="name">Naziv Proizvoda:</label>
    <input type="text" class="form-control" name="name">
  </div>
  <div class="form-group">
    <label for="name">Sastav:</label>
    <input type="text" class="form-control" name="sastav">
  </div>
  <div class="form-group">
    <label for="name">Velicine:</label>
    <input type="text" class="form-control" name="size">
  </div>
  <div class="form-group">
    <label for="name">Odrzavanje:</label>
    <input type="text" class="form-control" name="maintenance">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
</div>

</body>
</html>