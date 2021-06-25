@extends('layouts.online-shop')

@section('content')

	{{-- <div class="ps-banner">
		<div class="rev_slider fullscreenbanner" id="home-banner">
			<ul>
				<li class="ps-banner" data-index="rs-2972" data-transition="random" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-rotate="0"><img class="rev-slidebg" src="images/slider/3.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="5" data-no-retina>
				<div class="tp-caption ps-banner__header" id="layer-1" data-x="left" data-hoffset="['-60','15','15','15']" data-y="['middle','middle','middle','middle']" data-voffset="['-150','-120','-150','-170']" data-width="['none','none','none','400']" data-type="text" data-responsive_offset="on" data-frames="[{&quot;delay&quot;:1000,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;x:50px;opacity:0;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:300,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;x:50px;opacity:0;&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;}]">
					<p>March 2002 <br> Nike SB Dunk Low Pro</p>
				</div>
				<div class="tp-caption ps-banner__title" id="layer21" data-x="['left','left','left','left']" data-hoffset="['-60','15','15','15']" data-y="['middle','middle','middle','middle']" data-voffset="['-60','-40','-50','-70']" data-type="text" data-responsive_offset="on" data-textAlign="['center','center','center','center']" data-frames="[{&quot;delay&quot;:1200,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;x:50px;opacity:0;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:300,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;x:50px;opacity:0;&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;}]">
					<p class="text-uppercase">SUBA</p>
				</div>
				<div class="tp-caption ps-banner__description" id="layer211" data-x="['left','left','left','left']" data-hoffset="['-60','15','15','15']" data-y="['middle','middle','middle','middle']" data-voffset="['30','50','50','50']" data-type="text" data-responsive_offset="on" data-textAlign="['center','center','center','center']" data-frames="[{&quot;delay&quot;:1200,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;x:50px;opacity:0;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:300,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;x:50px;opacity:0;&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;}]">
					<p>Supa wanted something that was going to rep his East Coast <br> roots and, more specifically, his hometown of <br/> New York City in  a big way.</p>
				</div><a class="tp-caption ps-btn" id="layer31" href="#" data-x="['left','left','left','left']" data-hoffset="['-60','15','15','15']" data-y="['middle','middle','middle','middle']" data-voffset="['120','140','200','200']" data-type="text" data-responsive_offset="on" data-textAlign="['center','center','center','center']" data-frames="[{&quot;delay&quot;:1500,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;x:50px;opacity:0;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:300,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;x:50px;opacity:0;&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;}]">Purchase Now<i class="ps-icon-next"></i></a>
				</li>
				<li class="ps-banner ps-banner--white" data-index="rs-100" data-transition="random" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-rotate="0"><img class="rev-slidebg" src="images/slider/2.jpg" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="5" data-no-retina>
				<div class="tp-caption ps-banner__header" id="layer20" data-x="left" data-hoffset="['-60','15','15','15']" data-y="['middle','middle','middle','middle']" data-voffset="['-150','-120','-150','-170']" data-width="['none','none','none','400']" data-type="text" data-responsive_offset="on" data-frames="[{&quot;delay&quot;:1000,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;x:50px;opacity:0;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:300,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;x:50px;opacity:0;&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;}]">
					<p>BEST ITEM <br> THIS SUMMER</p>
				</div>
				<div class="tp-caption ps-banner__title" id="layer339" data-x="['left','left','left','left']" data-hoffset="['-60','15','15','15']" data-y="['middle','middle','middle','middle']" data-voffset="['-60','-40','-50','-70']" data-type="text" data-responsive_offset="on" data-textAlign="['center','center','center','center']" data-frames="[{&quot;delay&quot;:1200,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;x:50px;opacity:0;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:300,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;x:50px;opacity:0;&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;}]">
					<p class="text-uppercase">Recovery</p>
				</div>
				<div class="tp-caption ps-banner__description" id="layer2-14" data-x="['left','left','left','left']" data-hoffset="['-60','15','15','15']" data-y="['middle','middle','middle','middle']" data-voffset="['30','50','50','50']" data-type="text" data-responsive_offset="on" data-textAlign="['center','center','center','center']" data-frames="[{&quot;delay&quot;:1200,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;x:50px;opacity:0;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:300,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;x:50px;opacity:0;&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;}]">
					<p>Supa wanted something that was going to rep his East Coast <br> roots and, more specifically, his hometown of <br/> New York City in  a big way.</p>
				</div><a class="tp-caption ps-btn" id="layer364" href="#" data-x="['left','left','left','left']" data-hoffset="['-60','15','15','15']" data-y="['middle','middle','middle','middle']" data-voffset="['120','140','200','200']" data-type="text" data-responsive_offset="on" data-textAlign="['center','center','center','center']" data-frames="[{&quot;delay&quot;:1500,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;x:50px;opacity:0;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:300,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;x:50px;opacity:0;&quot;,&quot;ease&quot;:&quot;Power3.easeInOut&quot;}]">Purchase Now<i class="ps-icon-next"></i></a>
				</li>
			</ul>
		</div>
	</div> --}}
	<div class="ps-section--features-product ps-section masonry-root pt-100 pb-100">
		<div class="ps-container">
		<div class="ps-section__header mb-50">
			<h3 class="ps-section__title" data-mask="Destaques">- Produtos em Destaque</h3>
			{{-- <ul class="ps-masonry__filter">
				<li class="current"><a href="#" data-filter="*">Todos <sup></sup></a></li>
				<li><a href="#" data-filter="">Nike <sup></sup></a></li>
			</ul> --}}
		</div>
		<div class="masonry-wrapper" data-col-md="4" data-col-sm="2" data-col-xs="1" data-gap="30" data-radio="100%">
			<div class="ps-masonry">
				<div class="grid-sizer"></div>
				@php
					$i = 0;
				@endphp
				@foreach ($products as $product)
					@if ($product->standout == 1 && $i < 8)
						@php
							$i++
						@endphp
						<div class="grid-item kids">
							<div class="grid-item__content-wrapper">
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

									@if ($product->outlet == 1)
										<div class="ps-badge ps-badge--sale ps-badge--2nd"><span>Outlet</span></div>
									@endif
										<a class="ps-shoe__favorite" href="#"><i class="ps-icon-heart"></i></a>
										<img src="/storage/thumbnail/{{ $product->thumbnail }}" alt=""> <!-- Thumbnail -->
										<a class="ps-shoe__overlay" href="{{ route('online-shop.product-detail', $product->id) }}"></a>
									</div>
									<div class="ps-shoe__content">
										<div class="ps-shoe__variants">
											@if($product->stock >= 100)
												<p>Stock: <b class="text-success">{{ $product->stock }} unidades</b></p>
											@elseif($product->stock >= 30)
												<p>Stock: <b style="color:#ffc107!important">{{ $product->stock }} unidades</b></p>
											@else
												<p>Stock: <b style="color:#dc3545!important">{{ $product->stock }} unidades</b></p>
											@endif
										</div>
										@php
											$colors = json_decode($product->color);
											$colorsText = "";

											foreach ($colors as $value) {
												$colorsText .= $value . ', ';
											}

											$colorsText = rtrim($colorsText, ", ");
										@endphp
										<div class="ps-shoe__detail"><a class="ps-shoe__name" href="#">{{ $product->type->type }}
											<p class="ps-shoe__categories">
												<a href="{{ route('online-shop.product-detail', $product->id) }}">Coleção: {{ $product->collection->collection }}</a>
												<br>
												<a href="{{ route('online-shop.product-detail', $product->id) }}">Cores: {{ $colorsText }}</a>
											</p>
											<span class="ps-shoe__price">{{ round( (($product->iva / 100) * ($product->price)) + $product->price, 2) }}€</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					@endif
				@endforeach
				@foreach ($products as $product)
					@if ($product->standout == 0 && $product->disabled == 0 && $i < 8)
						@php
							$i++
						@endphp
						<div class="grid-sizer"></div>
							<div class="grid-item kids">
								<div class="grid-item__content-wrapper">
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

										@if ($product->outlet == 1)
											<div class="ps-badge ps-badge--sale ps-badge--2nd"><span>Outlet</span></div>
										@endif
											<!-- <a class="ps-shoe__favorite" href="#"><i class="ps-icon-heart"></i></a> -->
											<img src="/storage/thumbnail/{{ $product->thumbnail }}" alt=""> <!-- Thumbnail -->
											<a class="ps-shoe__overlay" href="{{ route('online-shop.product-detail', $product->id) }}"></a>
										</div>
										<div class="ps-shoe__content">
											<div class="ps-shoe__variants">
												@if($product->stock >= 100)
													<p>Stock: <b class="text-success">{{ $product->stock }} unidades</b></p>
												@elseif($product->stock >= 30)
													<p>Stock: <b style="color:#ffc107!important">{{ $product->stock }} unidades</b></p>
												@else
													<p>Stock: <b style="color:#dc3545!important">{{ $product->stock }} unidades</b></p>
												@endif
											</div>
											<div class="ps-shoe__detail"><a class="ps-shoe__name" href="{{ route('online-shop.product-detail', $product->id) }}">{{ $product->type->type }}
												@php
													$colors = json_decode($product->color);
													$colorsText = "";

													foreach ($colors as $value) {
														$colorsText .= $value . ', ';
													}

													$colorsText = rtrim($colorsText, ", ");
												@endphp
												<p class="ps-shoe__categories">
													<a href="{{ route('online-shop.product-detail', $product->id) }}">Coleção: {{ $product->collection->collection }}</a>
													<br>
													<a href="{{ route('online-shop.product-detail', $product->id) }}">Cores: {{ $colorsText }}</a>
												</p>
												<span class="ps-shoe__price">{{ round( (($product->iva / 100) * ($product->price)) + $product->price, 2) }}€</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						@endif
					@endforeach
				</div>
			</div>
		</div>
	</div>
	<div class="ps-section--offer">
		<div class="ps-column"><a class="ps-offer"><img src="/storage/uploads/monstruario1.jpeg" alt="" height="600" width="965"></a></div>
		<div class="ps-column"><a class="ps-offer"><img src="/storage/uploads/fabrica2.jpeg" alt="" height="600" width="965"></a></div>
	</div>

@endsection
