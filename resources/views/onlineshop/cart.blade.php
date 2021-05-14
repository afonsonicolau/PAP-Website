@extends('layouts.online-shop')

@section('content')

	<div class="ps-content pt-80 pb-80">
		<div class="ps-container">
			<div class="ps-cart-listing">
			@if($cartItems->count() > 0)
				<table class="table ps-cart__table">
					<thead>
						<tr>
							<th></th>
							<th>Produtos</th>
							<th>Preço</th>
							<th>Quantidade</th>
							<th>Total</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@php
							$total = 0;
							$i = 0;
							$productIds = array();
						@endphp
						@foreach ($cartItems as $item)
							<tr id="cart_{{ $item->product_id }}">
								<td><img src="/storage/thumbnail/{{ $item->product->thumbnail }}" height=100 width=100 alt=""></td>
								<td>{{ $item->product->type->type }}</td>
								<td>{{ round($item->price / ((100 - $item->iva)/100), 2) }}€</td>
								<td>
									<div class="form-group--number">
										<input class="form-control" id="cartQuantity_{{ $item->product_id }}" type="number" min="1" value="{{ $item->quantity }}">
									</div>
								</td>
								<td><p id="productPriceTotal_{{ $item->product_id }}">{{ round($item->price / ((100 - $item->iva)/100), 2) * $item->quantity }}€</p></td>
								<td>
									<div class="ps-remove" onclick="cartDelete({{ $item->product_id }}, {{ round($item->price / ((100 - $item->iva)/100), 2) * $item->quantity }})"></div>
								</td>
								@php
									array_push($productIds, $item->product_id . ' => ' . round($item->price / ((100 - $item->iva)/100), 2));
									$total += round($item->price / ((100 - $item->iva)/100), 2) * $item->quantity;
								@endphp
							</tr>
						@endforeach
					</tbody>
				</table>
			@else
				<h3><b>Carrinho de Compras sem produtos</b></h3>
				<h5 class="pb-10">Adicione produtos para poder avançar para uma possível compra</h5>
			@endif
				<div class="ps-cart__actions">
					<div class="ps-cart__promotion">
						@if($cartItems->count() > 0) 
							<div class="form-group">
								<a type="button" class="ps-btn" href="" id="cartQuantityButton" onclick="return changeCartQuantity(event, {{ json_encode($productIds) }})">Atualizar Carrinho<i class="fas fa-redo"></i></a>
							</div>
						@endif
						<div class="form-group">
							<a class="ps-btn ps-btn--gray pt-3" href="{{ route('online-shop.product-listing') }}">Continuar a Comprar</a>
						</div>
					</div>
					@if($cartItems->count() > 0) 
						<div class="ps-cart__total">
							<h3>Preço Total: <span id="productsTotal">{{ $total }}€</span></h3> 
							<a class="ps-btn" href="{{ route('online-shop.checkout') }}">Finalizar Compra<i class="ps-icon-next"></i></a> 
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>

@endsection