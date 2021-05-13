@extends('layouts.online-shop')

@section('content')

	<div class="ps-products-wrap pt-80 pb-80">
		<div class="ps-products" data-mh="product-listing">
			<div class="ps-product__columns">
				<!-- Product Listing -->
				@foreach ($productList as $product)
					<div class="ps-product__column" id="product_{{ $product->id }}">
						<div class="ps-shoe mb-30">
							<div class="ps-shoe__thumbnail">
							{{-- <div class="ps-badge"><span>New</span></div> --}}
							{{-- <div class="ps-badge ps-badge--sale ps-badge--2nd"><span>-35%</span></div> --}}
							<a class="ps-shoe__favorite" href="#"><i class="ps-icon-heart"></i></a>
							<img src="/storage/thumbnail/{{ $product->thumbnail }}" alt=""> <!-- Thumbnail -->
							<a class="ps-shoe__overlay" href="{{ route('online-shop.product-detail', $product->id) }}"></a>
							</div>
							<div class="ps-shoe__content">
							{{-- <div class="ps-shoe__variants">
								
								<select class="ps-rating ps-shoe__rating">
									<option value="1">1</option>
									<option value="1">2</option>
									<option value="1">3</option>
									<option value="1">4</option>
									<option value="2">5</option>
								</select>
							</div> --}}
							<div class="ps-shoe__detail"><a class="ps-shoe__name" href="#">{{ $product->type->type }}
								<p class="ps-shoe__categories">
									<a href="#">{{ $product->collection->collection }},	
									</a><a href="#">{{ $product->color }}</a></p><span class="ps-shoe__price">
									{{ round($product->price / ((100 - $product->iva)/100), 2) }}€</span>
							</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
			<div class="ps-product-action">
				{{-- <div class="ps-product__filter">
					<select class="ps-select selectpicker">
						<option value="1">Shortby</option>
						<option value="2">Name</option>
						<option value="3">Price (Low to High)</option>
						<option value="3">Price (High to Low)</option>
					</select>
				</div> --}}
				{{-- <div class="row">
					<div class="col-12 pt-5 d-flex justify-content-center">
						{{ $productList->links() }}
					</div>
				</div> --}}  
				<div class="ps-pagination">
					{{ $productList->links() }}
				</div> 
			</div>
		</div>
    <div class="ps-sidebar" data-mh="product-listing">
      	<aside class="ps-widget--sidebar ps-widget--category">
        	<!-- Collection -->
        	<div class="ps-widget__header">
          		<h3>Coleção</h3>
        	</div>
			<div class="ps-widget__content">
				<ul class="ps-list--checked">
					<li class="collection_filter current" id="collection_none"><a  href="#">Todas as Coleções</a></li>
					@php
					 	$collectionHere = array();
					@endphp
					@foreach ($collectionHere as $checked)
						@foreach($collectionsDistinct as $collection)
							@if($collection->collection->collection != $checked)
								@php
								dd("sadasdsada");
									array_push($collectionHere, $collection->collection);
								@endphp
								<li class="collection_filter" id="collection_{{ $collection->collection->id }}"><a href="#">{{ $collection->collection->collection }}</a></li>
							@endif
						@endforeach
					@endforeach
				</ul>
			</div>
     	</aside>
      	<aside class="ps-widget--sidebar ps-widget--filter">
        	<!-- Price Range -->
			<div class="ps-widget__header">
				<h3>Preço</h3>
			</div>
			<div class="ps-widget__content">
				<div class="ac-slider" data-default-min="0" data-default-max="{{ $max }}" data-max="{{ $max }}" data-step="1" data-unit="€"></div>
				<p class="ac-slider__meta">Preço:<span class="ac-slider__value ac-slider__min"></span>-<span class="ac-slider__value ac-slider__max"></span></p>
				<a class="ac-slider__filter ps-btn" href="#">Filtrar</a>
			</div>
      	</aside>
      	<aside class="ps-widget--sidebar ps-widget--category">
        	<div class="ps-widget__header">
				<!-- Tipo -->
				<h3>Os Nossos Tipos</h3>
        	</div>
			<div class="ps-widget__content">
				<ul class="ps-list--checked">
					<li class="type_filter current" id="type_none"><a href="#">Todos os Tipos de Produtos</a></li>
					@foreach($typesDistinct as $distinct)
						<li class="type_filter" id="type_{{ $distinct->type->id }}"><a href="#">{{ $distinct->type->type }}</a></li>
					@endforeach
				</ul>
			</div>
      	</aside>
      	{{-- <div class="ps-sticky desktop">
			<aside class="ps-widget--sidebar">
			<div class="ps-widget__header">
				<h3>Cores</h3>
			</div>
				<div class="ps-widget__content">
					<ul class="ps-list--color">
						<li><a href="#"></a></li>
						<li><a href="#"></a></li>
						<li><a href="#"></a></li>
						<li><a href="#"></a></li>
						<li><a href="#"></a></li>
						<li><a href="#"></a></li>
						<li><a href="#"></a></li>
						<li><a href="#"></a></li>
						<li><a href="#"></a></li>
						<li><a href="#"></a></li>
					</ul>
				</div>
			</aside>
      	</div> --}}
	</div>
  	</div>

@endsection
