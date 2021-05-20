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
							<input type="checkbox" name="deliveryBilling" id="deliveryBilling"> Morada de Faturação e de Envio diferentes
							<br><br>
							<p style="color:black">Se não tiver uma morada registada clique <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" style="text-decoration: underline; color:green;">aqui</a> para criar uma. Caso já tenham uma, simplesmente selecione-a.</p>

							<div id="deliveryPlusBilling">
								<h4>Morada de Envio e Faturação</h4>
								<div class="d-flex flex-column">
									@foreach ($addresses as $address)
										@if ($address->user_id == auth()->user()->id && $address->type == 3)
										<div class="mt-15 unselected-address" id="address_{{ $address->id }}" onclick="selectAddress({{ $address->id }}, 'Both')">
											<div class="pl-10 pt-10">{{ $address->name }}</div> 
											<div class="pl-10">{{ $address->address }}</div>
											<div class="pl-10">{{ $address->city }}, {{ $address->postal_code }}</div>
											<div class="pl-10">{{ $address->country }}</div>
											<div class="pl-10 pb-10">{{ $address->phone_number }}</div>
										</div>
										@endif
									@endforeach
								</div>
							</div>
							
							<div class="hidden" id="delivery">
								<h4>Morada de Envio</h4>
								<div class="d-flex flex-column">
									@foreach ($addresses as $address)
										@if ($address->user_id == auth()->user()->id && $address->type == 2 || $address->type == 3)
										<div class="mt-15 unselected-address delivery" id="delivery_{{ $address->id }}" onclick="selectAddress({{ $address->id }}, 'Delivery')">
											<div class="pl-10 pt-10">{{ $address->name }}</div> 
											<div class="pl-10">{{ $address->address }}</div>
											<div class="pl-10">{{ $address->city }}, {{ $address->postal_code }}</div>
											<div class="pl-10">{{ $address->country }}</div>
											<div class="pl-10 pb-10">{{ $address->phone_number }}</div>
										</div>
										@endif
									@endforeach
								</div>
							</div>
							
							<div class="hidden" id="billing">
								<h4>Morada de Faturação</h4>
								<div class="d-flex flex-column">
								@foreach ($addresses as $address)
									@if ($address->user_id == auth()->user()->id && $address->type == 1 || $address->type == 3)
										<div class="mt-15 unselected-address billing" id="billing_{{ $address->id }}" onclick="selectAddress({{ $address->id }}, 'Billing')">
											<div class="pl-10 pt-10">{{ $address->name }}</div> 
											<div class="pl-10">{{ $address->address }}</div>
											<div class="pl-10">{{ $address->city }}, {{ $address->postal_code }}</div>
											<div class="pl-10">{{ $address->country }}</div>
											<div class="pl-10 pb-10">{{ $address->phone_number }}</div>
										</div>
									@endif
								@endforeach
							</div>
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
							<p class="pt-10 hidden" id="errorMessage" style="color:red;"></p>
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
										<th class="text-uppercase">Imagem</th>
										<th class="text-uppercase">Produto</th>
										<th class="text-uppercase">Total</th>
										</tr>
									</thead>
									<tbody>
											@php
												$total = 0; 
											@endphp
											@foreach ($cartItems as $item)
													<tr>
														<td><img src="/storage/thumbnail/{{ $item->product->thumbnail }}" height=100 width=100 alt=""></td>
														<td><div class="pt-45">{{ $item->product->type->type }} x{{ $item->quantity }}</td>
														<td><div class="pt-45">{{ round($item->price / ((100 - $item->iva)/100), 2) * $item->quantity }}€</div></td>
													</tr>	
													@php
														$total += round($item->price / ((100 - $item->iva)/100), 2) * $item->quantity;
													@endphp
											@endforeach
											
											<tr>
												<td class="text-uppercase"><b>Total</b></td>
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
									<input type="hidden" name="delivery_id" id="delivery_id">
									<input type="hidden" name="billing_id" id="billing_id">
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

	<!-- Modal to create an address in checkout -->
	<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<form action="{{ route('online-shop.store-addresses', auth()->user()->id) }}" method="POST" class="ml-10 mr-10">
					@csrf
					<div class="form-group">
						<h3>Registar uma Morada</h3>
						<p class="required-red">*Obrigatório | Esta morada será guardada no seu perfil</p>
						
						<div class="form-group ">
							<label>Nome<span class="required-red">*</span></label>
							<input class="form-control" id="nome" name="nome"type="text" placeholder="Nome em que fica registado a morada" value="{{ old('nome') }}" data-validate="yes" data-min="5" data-max="144" data-type="string">
						</div>
						<div class="form-group ">
							<label>Endereço<span class="required-red">*</span> </label>
							<input id="endereço" name="endereço" class="form-control" type="text" placeholder="Endereço desejado" value="{{ old('endereço') }}" data-validate="yes" data-min="5" data-max="255" data-type="string">
						</div>
						<div class="form-group ">
							<label>Telemóvel<span class="required-red">*</span></label>
							<input id="telemóvel" name="telemóvel" class="form-control" type="text" placeholder="Número de telemóvel" value="{{ old('telemóvel') }}" data-validate="yes" data-min="9" data-max="9" data-type="int">
						</div>
						<div class="form-group ">
							<label>NIF</label>
							<input id="nif" name="nif" class="form-control" type="text" placeholder="Não preencher caso não queira registar o mesmo" value="{{ old('nif') }}" data-validate="yes" data-min="9" data-max="9" data-type="nif">
						</div>
						<div class="form-group ">
							<label>País<span class="required-red">*</span></label>
							<select class="form-control" name="país" id="país" required>
								<option value="" disabled selected>--Selecione um país--</option>
								<option value="Portugal">Portugal</option>
								<option value="Espanha">Espanha</option>
								<option value="França">França</option>
							</select>
						</div>
						<div class="form-group ">
							<label>Código Postal<span class="required-red">*</span></label>
							<input id="códigopostal" name="códigopostal" class="form-control" type="text" placeholder="1234-123" value="{{ old('códigopostal') }}" data-validate="yes" data-type="postalcode">
						</div>
						<div class="form-group ">
							<label>Cidade<span class="required-red">*</span></label>
							<input id="cidade" name="cidade" class="form-control" type="text" placeholder="Cidade onde se encontra a morada" value="{{ old('cidade') }}" data-validate="yes" data-min="2" data-max="100" data-type="string"> 
						</div>
						<div class="form-group ">
							<label>Empresa</label>
							<input id="empresa" name="empresa" class="form-control" type="text" placeholder="Preencher com o nome da empresa caso a morada seja numa" value="{{ old('empresa') }}" data-validate="yes" data-min="0" data-max="255" data-type="string">
						</div>
						<div class="form-group ">
							<label>Definição da Morada<span class="required-red">*</span></label>
							<select class="form-control" name="type" id="type" required>
								<option value="" disabled selected>--Escolha uma opção--</option>
								<option value="1">Faturação</option>
								<option value="2">Envio</option>
								<option value="3">Ambas</option>
							</select>
						</div>
						<div class="form-group ">
							<label>Morada Padrão?<span class="required-red">*</span></label>
							<select class="form-control" name="default" id="default" required>
								<option value="" disabled selected>--Escolha uma opção--</option>
								<option value="0">Sim</option>
								<option value="1">Não</option>
							</select>
						</div>
						<div class="form-group">
							<div class="ps-checkbox">
								<input type="hidden" name="here" id="here" value="here">
								<input class="form-control" type="checkbox" id="cb01">
								<button type="submit" class="btn btn-primary">Criar Morada</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

@endsection
