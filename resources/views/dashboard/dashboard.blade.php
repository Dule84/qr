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
      <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        @if(Auth::user()->category == 'pekara' && Auth::user()->is_activated == 1)
        <li><a href="{{ route('insert_product') }}">Dodajte proizvod</a></li>
        @elseif(Auth::user()->category == 'butik' && Auth::user()->is_activated == 1)
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
      @elseif($message = Session::get('succes'))
      <div class="alert alert-success" role="alert">{{ $message }}</div>
    @endif
  </div>
    <div class="container">
  <div class="row">
    <div class="col-md-12">
  <h2>Vasi proizvodi</h2>
</div>
  </div>
</div>
@if(Auth::user()->category == 'pekara')
  <div class="container">
  <div class="row">
  <table class="table">
    <thead>
      <tr>
        <th>Naziv</th>
        <th>Izmeni proizvod</th>
        <th>Obrisi</th>
        <th>Preuzmi</th>
        <th>Qr Code</th>
      </tr>
    </thead>
    <tbody>
    	@foreach($products as $product)
      <tr>
        <td>{{ $product->name }}</td>
        <td><a href="{{ route('product_by_id', $product->id) }}">Izmeni proizvod</a></td>
        <td><a href="{{ route('delete_product', $product->id) }}">Obrisi proizvod</a></td>
        <td><a href="{{ route('download_code', $product->id) }}">Preuzmi kod</a></td>
        <td><img src="{{ $path.$product->qr_name }}" width="30px"></td>
      </tr>      
      @endforeach
    </tbody>
  </table>
  </div>
</div>
<div class="container">
  <div class="row">
<a target="_blank" href="{{ route('pdf') }}" class="btn btn-primary" style="float:right;">Preuzmi pdf</a>
</div>
</div>
@elseif(Auth::user()->category == 'butik')
  <div class="container">
  <div class="row">
  <table class="table">
    <thead>
      <tr>
        <th>Naziv</th>
        <th>Izmeni proizvod</th>
        <th>Obrisi</th>
        <th>Preuzmi</th>
        <th>Qr Code</th>
      </tr>
    </thead>
    <tbody>
      @foreach($merchs as $product)
      <tr>
        <td>{{ $product->name }}</td>
        <td><a href="{{ route('edit_merch', $product->id) }}">Izmeni proizvod</a></td>
        <td><a href="{{ route('delete_merch', $product->id) }}">Obrisi proizvod</a></td>
        <td><a href="{{ route('download_merch_code', $product->id) }}">Preuzmi kod</a></td>
        <td><img src="{{ $path.$product->qr_name }}" width="30px"></td>
      </tr>      
      @endforeach
    </tbody>
  </table>
  </div>
</div>
@endif

</body>
</html>