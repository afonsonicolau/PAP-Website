@extends('layouts.online-shop')

@section('content')

	<div class="ps-content pt-80 pb-80">
		<div class="ps-container">
			<div class="ps-cart-listing">
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
					@endphp
					@foreach ($carts as $cart)
						@if ($cart->user_id == auth()->user()->id && $cart->bought == 0)
							<tr id="cart_{{ $cart->id }}">
								<td><img src="/storage/thumbnail/{{ $cart->product->thumbnail }}" height=100 width=100 alt=""></td>
								<td>{{ $cart->product->type->type }}</td>
								<td>{{ round($cart->price / ((100 - $cart->iva)/100), 2) }}€</td>
								<td>
									<div class="form-group--number">
										<button class="minus" onclick="changeCartQuantity({{ $cart->id }}, 'minus', {{ round($cart->price / ((100 - $cart->iva)/100), 2) }})"><span>-</span></button>
										<input class="form-control" id="cartQuantity_{{ $cart->id }}" type="number" min="1" value="{{ $cart->quantity }}" disabled>
										<button class="plus" onclick="changeCartQuantity({{ $cart->id }}, 'plus', {{ round($cart->price / ((100 - $cart->iva)/100), 2) }})"><span>+</span></button>
									</div>
								</td>
								<td><p id="productPriceTotal_{{ $cart->id }}">{{ round($cart->price / ((100 - $cart->iva)/100), 2) * $cart->quantity}}€</p></td>
								@php
									$total += round($cart->price / ((100 - $cart->iva)/100), 2) * $cart->quantity
								@endphp
								<td>
									<div class="ps-remove" onclick="cartDelete({{ $cart->id }}, {{ $cart->price }})"></div>
								</td>
							</tr>
						@endif
					@endforeach
				</tbody>
				</table>
				<div class="ps-cart__actions">
					<div class="ps-cart__promotion">
						{{-- <div class="form-group">
							<a class="ps-btn ps-btn--black" href="">Atualizar Carrinho</a>
						</div> --}}
						<div class="form-group">
							<a class="ps-btn ps-btn--gray pt-3" href="{{ route('online-shop.product-listing') }}">Continuar a Comprar</a>
						</div>
					</div>
					<div class="ps-cart__total">
						<h3>Preço Total: <span id="productsTotal">{{ $total }}€</span></h3><a class="ps-btn" href="{{ route('online-shop.checkout') }}">Finalizar Compra<i class="ps-icon-next"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection