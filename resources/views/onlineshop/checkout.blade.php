@extends('layouts.online-shop')

@section('content')

	<div class="ps-checkout pt-80 pb-80">
		<div class="ps-container">
			<form class="ps-checkout__form" method="POST" action="{{ route('online-shop.create-order') }}" enctype="multipart/form-data">
				@csrf
				<div class="row">
					<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
						<div class="ps-checkout__billing">
							
							<h3>Detalhes de Envio</h3>
							<hr>
							<h4>Morada de Envio</h4>
							<p>Se não tiver uma morada registada clique <a href="{{route('online-shop.create-addresses')}}">aqui</a> para criar uma. Caso já tenham uma, simplesmente selecione-a.</p>
							<div class="d-flex flex-column">
								@foreach ($addresses as $address)
									@if ($address->user_id == auth()->user()->id && ($address->type == 2 || $address->type == 3))
									<div class="mt-15 unselected-address" id="address_{{ $address->id }}" onclick="selectAddress({{ $address->id }})">
										<div class="pl-10 pt-10">{{ $address->name }}</div> 
										<div class="pl-10">{{ $address->address }}</div>
										<div class="pl-10">{{ $address->city }}, {{ $address->postal_code }}</div>
										<div class="pl-10">{{ $address->country }}</div>
										<div class="pl-10 pb-10">{{ $address->phone_number }}</div>
									</div>
									@endif
								@endforeach
							</div>

							<hr>
							<h4>Métodos de Envio</h4>
							<p>Escolha o método de envio para enviar a sua encomenda.</p>
							<div class="d-flex flex-column">
								<div class="mt-15 unselected-address">
									<div class="pl-10 pb-10 pt-10">CTT</div> 
									<input type="hidden" name="delivery_method" id="delivery_method" value="CTT">
								</div>
							</div>
							<h3 class="mt-40">Informação Adicional (Não obrigatório)</h3>
							<div class="form-group form-group--inline textarea">
								<label>Notas</label>
								<textarea class="form-control" rows="5" id="additional" name="additional" placeholder="Notas adicionais para a sua entrega."></textarea>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
						<div class="ps-checkout__order">
							<header>
								<h3>Resumo dos pedidos</h3>
							</header>
							<div class="content">
								<table class="table ps-checkout__products">
									<thead>
										<tr>
										<th></th>
										<th class="text-uppercase">Produto</th>
										<th class="text-uppercase">Total</th>
										</tr>
									</thead>
									<tbody>
											@php
												$total = 0; 
												$cartIds = array(); 
											@endphp

											@foreach ($carts as $cart)
												@if ($cart->user_id == auth()->user()->id && $cart->bought == 0)
													@foreach ($products as $product)
														@if ($product->id == $cart->product_id)
															<tr>
																<td><img src="/storage/thumbnail/{{ $product->thumbnail }}" height=100 width=100 alt=""></td>
																<td><div class="pt-45">{{ $product->type->type }} x{{ $cart->quantity }}</td>
																<td><div class="pt-45">{{ ($cart->quantity * $product->price)}}€</div></td>
															</tr>	
															@php
																array_push($cartIds, $cart->id);
																$total += $cart->quantity * $product->price;
															@endphp
														@endif
													@endforeach	
												@endif
											@endforeach
											
											<tr>
												<td>Total dos Produtos</td>
												<td></td>
												<td>{{ $total }}€</td>
											</tr>
									</tbody>
								</table>
								<hr>
							</div>
							<footer class="hidden">
								<h3>Método de Pagamento</h3>
								<div class="form-group paypal">
									<div class="ps-radio">
										<input class="form-control" type="radio" name="payment" id="rdo01" onclick="paymentMethod('Paypal')" value="Paypal">
										<label for="rdo01">Paypal</label>
									</div>
								</div>
								<div class="form-group paypal">
									<div class="ps-radio">
										<input class="form-control" type="radio" name="payment" id="rdo02" onclick="paymentMethod('Multibanco')" value="Multibanco">
										<label for="rdo02">Multibanco</label>
									</div>
								</div>
								<div class="form-group paypal">
									<div class="ps-radio">
										<input class="form-control" type="radio" name="payment" id="rdo03" onclick="paymentMethod('Cartão de Débito')" value="Cartão de Débito">
										<label for="rdo03">Cartão Débito</label>
									</div>
									<input type="hidden" name="total_price" id="total_price" value="{{ $total }}">
									<input type="hidden" name="address_id" id="address_id">
									<input type="hidden" name="cart_ids" id="cart_ids" value="{{ json_encode($cartIds) }}">
									<input type="hidden" name="payment_method" id="payment_method">
									<button type="submit" class="ps-btn ps-btn--fullwidth" id="check_radio">Efetuar Compra<i class="ps-icon-next"></i></button>
								</div>
							</footer>
						</div>
						<div class="ps-shipping">
							<h3>Atenção</h3>
							<p>Confira todos os dados antes de efetuar a compra.
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
  
@endsection
