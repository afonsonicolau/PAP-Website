@extends('layouts.online-shop')

@section('content')

    <div class="ps-product--detail pt-60">
        <div class="ps-container">
            <div class="row">
                <div class="col-lg-10 col-md-12 col-lg-offset-1">
                    <div class="ps-product__thumbnail">
                        <div class="ps-product__preview">
                            <div class="ps-product__variants">
                                <div class="item"><img src="/storage/thumbnail/{{ $product->thumbnail }}" alt=""></div>
                                @if ($product->images != [] && $product->images != null)
                                    @foreach (json_decode($product->images) as $key => $image)
                                        <div class="item"><img src="/storage/products/{{ $image }}" alt=""></div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="ps-product__image">
                        <div class="item"><img class="zoom" src="/storage/thumbnail/{{ $product->thumbnail }}" alt="" data-zoom-image="/storage/thumbnail/{{ $product->thumbnail }}"></div>
                        @if ($product->images != [] && $product->images != null)
                            @foreach (json_decode($product->images) as $key => $image)
                            <div class="item"><img class="zoom" src="/storage/products/{{ $image }}" alt="" data-zoom-image="/storage/products/{{ $image }}"></div>
                            @endforeach
                        @endif
                    </div>
            </div>
            <div class="ps-product__thumbnail--mobile">
                <div class="ps-product__main-img"><img src="images/shoe-detail/1.jpg" alt=""></div>
                <div class="ps-product__preview owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="20" data-owl-nav="true" data-owl-dots="false" data-owl-item="3" data-owl-item-xs="3" data-owl-item-sm="3" data-owl-item-md="3" data-owl-item-lg="3" data-owl-duration="1000" data-owl-mousedrag="on"><img src="images/shoe-detail/1.jpg" alt=""><img src="images/shoe-detail/2.jpg" alt=""><img src="images/shoe-detail/3.jpg" alt=""></div>
            </div>
            <div class="ps-product__info">
                {{--<div class="ps-product__rating">
                 <select class="ps-rating">
                    <option value="1">1</option>
                    <option value="1">2</option>
                    <option value="1">3</option>
                    <option value="1">4</option>
                    <option value="2">5</option>
                </select><a href="#">(Read all 8 reviews)</a>
                </div>--}}
                @php
                    $colors = json_decode($product->color);
                    $colorsText = "";

                    foreach ($colors as $value) {
                        $colorsText .= $value . ', ';
                    }

                    $colorsText = rtrim($colorsText, ", ");
                @endphp

                <h1>{{ $product->type->type }}</h1>
                <p class="ps-product__category"><b>Coleção:</b> {{ $product->collection->collection }}<br>
                <b>Cores:</b> {{ $colorsText }}</p>
                <h3 class="ps-product__price">Preço: {{ round( (($product->iva / 100) * ($product->price)) + $product->price, 2) }}€</h3>
                <hr>
                @if($product->stock >= 100)
                    <h4>Stock: <b class="text-success">{{ $product->stock }} unidades</b></h4>
                @elseif($product->stock >= 30)
                    <h4>Stock: <b style="color:#ffc107!important">{{ $product->stock }} unidades</b></h4>
                @else
                    <h4>Stock: <b style="color:#dc3545!important">{{ $product->stock }} unidades</b></h4>
                @endif
                {{-- <div class="ps-product__block ps-product__quickview">

                </div> --}}
                <div class="ps-product__block ps-product__size"></div>

                @if ($product->stock > 0)
                    @if (auth()->user())
                        <form method="POST" action="{{ route('online-shop.add-to-cart', [$product->id, auth()->user()->id]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input class="form-control" type="number" id="quantidade" name="quantidade" min="1" value="1" style="width: 10em;" data-validate="yes" data-min="1" data-max="{{ $product->stock }}" data-type="int" placeholder="Quantidade">
                                @if ($errors->has('quantidade'))
                                    <p class="text-danger">{{$errors->first('quantidade')}}</p>
                                @endif
                                @if (Session::has('error'))
                                    <p class="text-danger">{{ Session::get('error') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="ps-btn mb-10">Adicionar ao Carrinho<i class="ps-icon-next"></i></button>
                            </div>
                        </form>
                    @else
                        <div class="ps-product__shopping"><a class="ps-btn mb-10" href="{{ route('login') }}">Adicionar ao Carrinho<i class="ps-icon-next"></i></a>
                    @endif
                @else
                    <p>Este produto está sem stock de momento, pedimos desculpa pelo inconveniente.</p>
                @endif
                {{-- <div class="ps-product__actions"><a class="mr-10" href="whishlist.html"><i class="ps-icon-heart"></i></a><a href="compare.html"><i class="ps-icon-share"></i></a></div> --}}
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="ps-product__content mt-50">
                <ul class="tab-list" role="tablist">
                    <li class="active"><a href="#tab_01" aria-controls="tab_01" role="tab" data-toggle="tab">Descrição</a></li>
                    {{-- <li><a href="#tab_02" aria-controls="tab_02" role="tab" data-toggle="tab">Avaliações</a></li>
                    <li><a href="#tab_03" aria-controls="tab_03" role="tab" data-toggle="tab">PRODUCT TAG</a></li>
                    <li><a href="#tab_04" aria-controls="tab_04" role="tab" data-toggle="tab">ADDITIONAL</a></li> --}}
                </ul>
            </div>
            <div class="tab-content mb-60">
                <div class="tab-pane active" role="tabpanel" id="tab_01">
                <p>{{ $product->description }}</p>

                </div>
                <div class="tab-pane" role="tabpanel" id="tab_02">
                <p class="mb-20">1 review for <strong>Shoes Air Jordan</strong></p>
                <div class="ps-review">
                    <div class="ps-review__thumbnail"><img src="images/user/1.jpg" alt=""></div>
                    <div class="ps-review__content">
                    <header>
                        <select class="ps-rating">
                        <option value="1">1</option>
                        <option value="1">2</option>
                        <option value="1">3</option>
                        <option value="1">4</option>
                        <option value="5">5</option>
                        </select>
                        <p>By<a href=""> Alena Studio</a> - November 25, 2017</p>
                    </header>
                    <p>Soufflé danish gummi bears tart. Pie wafer icing. Gummies jelly beans powder. Chocolate bar pudding macaroon candy canes chocolate apple pie chocolate cake. Sweet caramels sesame snaps halvah bear claw wafer. Sweet roll soufflé muffin topping muffin brownie. Tart bear claw cake tiramisu chocolate bar gummies dragée lemon drops brownie.</p>
                    </div>
                </div>
                <form class="ps-product__review" action="_action" method="post">
                    <h4>ADD YOUR REVIEW</h4>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                            <div class="form-group">
                            <label>Name:<span>*</span></label>
                            <input class="form-control" type="text" placeholder="">
                            </div>
                            <div class="form-group">
                            <label>Email:<span>*</span></label>
                            <input class="form-control" type="email" placeholder="">
                            </div>
                            <div class="form-group">
                            <label>Your rating<span></span></label>
                            <select class="ps-rating">
                                <option value="1">1</option>
                                <option value="1">2</option>
                                <option value="1">3</option>
                                <option value="1">4</option>
                                <option value="5">5</option>
                            </select>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 ">
                            <div class="form-group">
                            <label>Your Review:</label>
                            <textarea class="form-control" rows="6"></textarea>
                            </div>
                            <div class="form-group">
                            <button class="ps-btn ps-btn--sm">Submit<i class="ps-icon-next"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
                <div class="tab-pane" role="tabpanel" id="tab_03">
                <p>Add your tag <span> *</span></p>
                <form class="ps-product__tags" action="_action" method="post">
                    <div class="form-group">
                    <input class="form-control" type="text" placeholder="">
                    <button class="ps-btn ps-btn--sm">Add Tags</button>
                    </div>
                </form>
                </div>
                <div class="tab-pane" role="tabpanel" id="tab_04">
                <div class="form-group">
                    <textarea class="form-control" rows="6" placeholder="Enter your addition here..."></textarea>
                </div>
                <div class="form-group">
                    <button class="ps-btn" type="button">Submit</button>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    {{-- <div class="ps-section ps-section--top-sales ps-owl-root pt-40 pb-80">
        <div class="ps-container">
            <div class="ps-section__header mb-50">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 ">
                        <h3 class="ps-section__title" data-mask="Produtos">- Produtos parecidos</h3>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                        <div class="ps-owl-actions"><a class="ps-prev" href="#"><i class="ps-icon-arrow-right"></i>Prev</a><a class="ps-next" href="#">Next<i class="ps-icon-arrow-left"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="ps-section__content">
                <div class="ps-owl--colection owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="30" data-owl-nav="false" data-owl-dots="false" data-owl-item="4" data-owl-item-xs="1" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="4" data-owl-duration="1000" data-owl-mousedrag="on">
                    <div class="ps-shoes--carousel">
                        <div class="ps-shoe">
                            <div class="ps-shoe__thumbnail">
                                <div class="ps-badge"><span>New</span></div><a class="ps-shoe__favorite" href="#"><i class="ps-icon-heart"></i></a><img src="images/shoe/1.jpg" alt=""><a class="ps-shoe__overlay" href="product-detail.html"></a>
                            </div>
                        <div class="ps-shoe__content">
                            <div class="ps-shoe__variants">
                                <div class="ps-shoe__variant normal"><img src="images/shoe/2.jpg" alt=""><img src="images/shoe/3.jpg" alt=""><img src="images/shoe/4.jpg" alt=""><img src="images/shoe/5.jpg" alt=""></div>
                                <select class="ps-rating ps-shoe__rating">
                                    <option value="1">1</option>
                                    <option value="1">2</option>
                                    <option value="1">3</option>
                                    <option value="1">4</option>
                                    <option value="2">5</option>
                                </select>
                            </div>
                            <div class="ps-shoe__detail"><a class="ps-shoe__name" href="product-detai.html">Air Jordan 7 Retro</a>
                                <p class="ps-shoe__categories"><a href="#">Men shoes</a>,<a href="#"> Nike</a>,<a href="#"> Jordan</a></p><span class="ps-shoe__price"> £ 120</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ps-shoes--carousel">
                    <div class="ps-shoe">
                        <div class="ps-shoe__thumbnail">
                            <div class="ps-badge"><span>New</span></div>
                            <div class="ps-badge ps-badge--sale ps-badge--2nd"><span>-35%</span></div><a class="ps-shoe__favorite" href="#"><i class="ps-icon-heart"></i></a><img src="images/shoe/2.jpg" alt=""><a class="ps-shoe__overlay" href="product-detail.html"></a>
                        </div>
                        <div class="ps-shoe__content">
                            <div class="ps-shoe__variants">
                            <div class="ps-shoe__variant normal"><img src="images/shoe/2.jpg" alt=""><img src="images/shoe/3.jpg" alt=""><img src="images/shoe/4.jpg" alt=""><img src="images/shoe/5.jpg" alt=""></div>
                            <select class="ps-rating ps-shoe__rating">
                                <option value="1">1</option>
                                <option value="1">2</option>
                                <option value="1">3</option>
                                <option value="1">4</option>
                                <option value="2">5</option>
                            </select>
                            </div>
                            <div class="ps-shoe__detail"><a class="ps-shoe__name" href="product-detai.html">Air Jordan 7 Retro</a>
                            <p class="ps-shoe__categories"><a href="#">Men shoes</a>,<a href="#"> Nike</a>,<a href="#"> Jordan</a></p><span class="ps-shoe__price">
                                <del>£220</del> £ 120</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ps-shoes--carousel">
                    <div class="ps-shoe">
                    <div class="ps-shoe__thumbnail">
                        <div class="ps-badge"><span>New</span></div><a class="ps-shoe__favorite" href="#"><i class="ps-icon-heart"></i></a><img src="images/shoe/3.jpg" alt=""><a class="ps-shoe__overlay" href="product-detail.html"></a>
                    </div>
                    <div class="ps-shoe__content">
                        <div class="ps-shoe__variants">
                        <div class="ps-shoe__variant normal"><img src="images/shoe/2.jpg" alt=""><img src="images/shoe/3.jpg" alt=""><img src="images/shoe/4.jpg" alt=""><img src="images/shoe/5.jpg" alt=""></div>
                        <select class="ps-rating ps-shoe__rating">
                            <option value="1">1</option>
                            <option value="1">2</option>
                            <option value="1">3</option>
                            <option value="1">4</option>
                            <option value="2">5</option>
                        </select>
                        </div>
                        <div class="ps-shoe__detail"><a class="ps-shoe__name" href="product-detai.html">Air Jordan 7 Retro</a>
                        <p class="ps-shoe__categories"><a href="#">Men shoes</a>,<a href="#"> Nike</a>,<a href="#"> Jordan</a></p><span class="ps-shoe__price"> £ 120</span>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div> --}}

@endsection
