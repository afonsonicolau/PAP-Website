@extends('layouts.online-shop')

@section('content')

    <div class="container order-div">
        <h2>A encomenda #{{ $order->order_number }} foi registada e encontra-se neste momento em processamento.</h2>
        <h4>Consulte o seu e-mail para ver mais detalhes</h4>
    </div>
	
  
@endsection
