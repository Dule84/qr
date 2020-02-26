<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>
@if($result->category == 'pekara')
<h1>{{ $result->name }}</h1>
<p>{{ $product->name }}</p>
@foreach($ingredients as $in)
<p>{{ $in->name }}</p>
@endforeach
@elseif($result->category == 'butik')
@foreach($merchs as $merch)
<h1>{{ $result->name }}</h1>
<p>{{ $merch->proiz }}</p>
<p>{{ $merch->country }}</p>
<p>{{ $merch->uvoznik }}</p>
<p>{{ $merch->name }}</p>
<p>{{ $merch->sastav }}</p>
<p>{{ $merch->size }}</p>
<p>{{ $merch->maintenance }}</p>
@endforeach
@endif
</body>
</html>