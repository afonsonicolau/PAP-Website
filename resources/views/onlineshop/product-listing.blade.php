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
							@php
								$dateProduct = date_format($product->created_at, 'Y-m-d');
								$dateNow = date('Y-m-d');
								$diff = abs(strtotime($dateProduct) - strtotime($dateNow));
								$years = floor($diff / (365 * 60 * 60 * 24));
								$months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
								$days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
							@endphp
							@if ($days < 8)
								<div class="ps-badge"><span>Novo</span></div>
							@endif
							
							{{-- <div class="ps-badge ps-badge--sale ps-badge--2nd"><span>-35%</span></div> --}}
								<a class="ps-shoe__favorite" href="#"><i class="ps-icon-heart"></i></a>
								<img src="/storage/thumbnail/{{ $product->thumbnail }}" alt=""> <!-- Thumbnail -->
								<a class="ps-shoe__overlay" href="{{ route('online-shop.product-detail', $product->id) }}"></a>
							</div>
							<div class="ps-shoe__content">
								<div class="ps-shoe__variants">
									Stock: {{ $product->stock }} unidade(s)
								</div>
								<div class="ps-shoe__detail"><a class="ps-shoe__name" href="{{ route('online-shop.product-detail', $product->id) }}">{{ $product->type->type }}
									<p class="ps-shoe__categories">
										@php
											$colors = json_decode($product->color);
											$colorsText = "";
										
											foreach ($colors as $value) {
												$colorsText .= $value . ', ';
											}

											$colorsText = rtrim($colorsText, ", ");
										@endphp     
										<a href="{{ route('online-shop.product-detail', $product->id) }}">Coleção: {{ $product->collection->collection }}</a>	
										<br>
										<a href="{{ route('online-shop.product-detail', $product->id) }}">Cores: {{ $colorsText }}</a>
									</p>
									<span class="ps-shoe__price">{{ round( (($product->iva / 100) * ($product->price)) + $product->price, 2) }}€</span>
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
						$i = 0;
					@endphp
					@foreach($collectionsDistinct as $collection)
						@php 
							$i++;
						@endphp
						<li class="collection_filter collectionH_{{ $i }}" id="collection_{{ $collection->collection->id }}"><a href="#">{{ $collection->collection->collection }}</a></li>
					@endforeach
				</ul>
				<a href="" class="showmoreCollections" style="text-align: center;">Ver mais</a>
				<p ></p>
			</div>
     	</aside>
      	<aside class="ps-widget--sidebar ps-widget--filter">
        	<!-- Price Range -->
			<div class="ps-widget__header">
				<h3>Preço</h3>
			</div>
			<div class="ps-widget__content">
				<div class="ac-slider" data-default-min="0" data-default-max="{{ ($max * 0.23) + $max}}" data-max="{{ ($max * 0.23) + $max }}" data-step="0.01" data-unit="€"></div>
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
					@foreach($typesDistinct as $type)
						<li class="type_filter types" id="type_{{ $type->type->id }}"><a href="#">{{ $type->type->type }}</a></li>
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
