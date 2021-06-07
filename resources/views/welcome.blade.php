@extends('layouts.outer')

@section('content')

    <!-- ======= Home Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
            <h1>Onde a sua loiça é feita!</h1>
            <h2>Olfaire Mendes&Nicolau</h2>
            <!-- <a href="#about" class="btn-get-started scrollto">Get Started</a> -->
        </div>
    </section>
    <!-- End Home -->

    <main id="main">
        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container">
                <div class="row content">
                    <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                        <h2>Sobre nós</h2>
                        <img src="/storage/uploads/grandfather2.jpeg" width="350" style="border: solid 3px black;">
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left" data-aos-delay="200" style="margin-top: 10%;">
                        <p>
                            Proseguindo uma tradição familiar, iniciada nos anos 40, Álvaro José fundou a sua própria
                            empresa em 1970 produzindo faiança tradicional das Caldas da Rainha, criando a marca OLFAIRE.
                            <br><br>
                            Inserida na política de expansão da empresa é constituída a (Mendes & Nicolau, LDA) em 1991 num
                            novo espaço indústrial com vista a satisfazer a procura crescente de loiça de faiança para os
                            mercados externos.
                            <br><br>
                            Atualmente a empresa exporta para vários mercados dos 5 continentes.
                        </p>
                        <p>
                            Temos vários objetivos, e vamos tentar sempre o nosso melhor para os alcançar e superar qualquer
                            dificuldade, tal como aconteceu no passado e acontecerá no futuro!
                        </p>
                    </div>
                </div>

            </div>
        </section>
        <!-- End About Section -->

        <!-- ======= Products Section ======= -->
        <section id="portfolio" class="portfolio section-bg">
            <div class="container">
                <div class="section-title" data-aos="fade-left">
                    <h2>Produtos</h2>
                    <p>Muitos dos nossos produtos são feitos com base na natureza, sejam animais, plantas, frutas ou até mesmo legumes. Temos bastantes mais disponíveis na loja on-line!</p>
                </div>
                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
                    @foreach ($products as $product)
                        @if ($product->standout == 1 && $i < 9)
                            @php
                                $i++;
                            @endphp
                            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                                <div class="portfolio-wrap">
                                    <img src="/storage/thumbnail/{{ $product->thumbnail }}" class="img-fluid" alt="">
                                    <div class="portfolio-info">
                                        <p>{{ $product->type->type }}</p>
                                        <p>{{ round(($product->iva / 100) * $product->price + $product->price, 2) }}€</p>
                                        <div class="portfolio-links">
                                            <a href="storage/thumbnail/{{ $product->thumbnail }}" data-gallery="portfolioGallery" class="portfolio-lightbox"><i class="bx bx-plus"></i></a>
                                            <a href="{{ route('online-shop.product-detail', $product->id) }}" title="Mais detalhes"><i class="bx bx-link"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    @foreach ($products as $product)
                        @if ($product->standout == 0 && $i < 9)
                            @php
                                $i++;
                            @endphp
                            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                                <div class="portfolio-wrap">
                                    <img src="storage/thumbnail/{{ $product->thumbnail }}" class="img-fluid" alt="">
                                    <div class="portfolio-info">
                                        <p>{{ $product->type->type }}</p>
                                        <p>{{ round(($product->iva / 100) * $product->price + $product->price, 2) }}€</p>
                                        <div class="portfolio-links">
                                            <a href="storage/thumbnail/{{ $product->thumbnail }}" data-gallery="portfolioGallery" class="portfolio-lightbox"><i class="bx bx-plus"></i></a>
                                            <a href="{{ route('online-shop.product-detail', $product->id) }}" title="Mais detalhes"><i class="bx bx-link"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
        <!-- End Products Section -->

        <!-- ======= Team Section ======= -->
        <section id="team" class="team">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="section-title" data-aos="fade-right">
                            <h2>Equipa</h2>
                            <p>A nossa empresa tem um administrador principal, como apresentado à direita, juntamente com a gerente de comércio Ibérico e conta com 18 empregados. Juntos, conseguimos alcançar qualquer objetivo.</p>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="member" data-aos="zoom-in" data-aos-delay="100">
                                    <div class="pic">
                                        <img src="/assets/mainpage/img/team/team-1.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="member-info">
                                        <h4>Fernando Nicolau</h4>
                                        <span>Chefe Executivo & Gerente de Exportações</span>
                                        <p>"O difícil faz-se, o impossível demora mais um bocadinho."</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="member" data-aos="zoom-in" data-aos-delay="200">
                                    <div class="pic">
                                        <img src="/assets/mainpage/img/team/team-2.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="member-info">
                                        <h4>Carla Nicolau</h4>
                                        <span>Gerente Comercial Ibérico</span>
                                        <p>"Só não se consegue aquilo que não se quer."</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Team Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact section-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4" data-aos="fade-right">
                        <div class="section-title">
                            <h2>Contacte-nos</h2>
                            <p>Caso nos queira contactar tem todos os métodos aqui disponíveis! Atendimento comercial está
                                disponível de segunda a sexta-feira das 10:30 às 16:30.</p>
                        </div>
                    </div>

                    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12326.154545922802!2d-9.1301935!3d39.4345561!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x9e61dc6b201a642d!2sOlfaire%20Mendes%20%26%20Nicolau%2C%20Lda!5e0!3m2!1sen!2spt!4v1621259549663!5m2!1sen!2spt" width="600" height="270" style="border:0; width: 100%;" loading="lazy"></iframe>
                        <div class="info mt-4">
                            <i class="bi bi-geo-alt"></i>
                            <h4>Localização:</h4>
                            <p>Estrada Nacional 8, Tornada, 2500-315</p>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mt-4">
                                <div class="info">
                                    <i class="bi bi-envelope"></i>
                                    <h4>E-mail:</h4>
                                    <p>geral@olfaire.com</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="info w-100 mt-4">
                                    <i class="bi bi-phone"></i>
                                    <h4>Telefone:</h4>
                                    <p>+351 262 881 213</p>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('welcome-sendemail') }}" method="POST" class="php-email-form mt-4">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome"
                                        data-validate="yes" data-min="4" data-max="100" data-type="string"
                                        value="{{ old('nome') }}" />
                                    @if ($errors->has('nome'))
                                        <p class="text-danger">{{ $errors->first('nome') }}</p>
                                    @endif
                                </div>

                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="E-mail"
                                        data-validate="yes" data-min="4" data-max="100" data-type="email"
                                        value="{{ old('email') }}" />
                                    @if ($errors->has('email'))
                                        <p class="text-danger">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" name="assunto" id="assunto" placeholder="Assunto"
                                    data-validate="yes" data-min="4" data-max="100" data-type="string"
                                    value="{{ old('assunto') }}" />
                                @if ($errors->has('assunto'))
                                    <p class="text-danger">{{ $errors->first('assunto') }}</p>
                                @endif
                            </div>
                            <div class="form-group mt-3">
                                <textarea class="form-control" name="mensagem" id="mensagem" rows="5" placeholder="Mensagem"
                                    data-validate="yes" data-min="4" data-max="255"
                                    value="{{ old('mensagem') }}"></textarea>
                                @if ($errors->has('mensagem'))
                                    <p class="text-danger">{{ $errors->first('mensagem') }}</p>
                                @endif
                            </div>
                            @if (Session::has('success'))
                                <div class="form-group">
                                    <div class="alert alert-success text-center" role="alert">
                                        {{ Session::get('success') }}
                                    </div>
                                </div>
                            @endif
                            <div class="text-center">
                                <button type="submit">Enviar Mensagem</button>
                            </div>
                        </form>
                    </div>
                </div> 
            </div>
        </section><!-- End Contact Section --> 
    </main>
    <!-- End #main -->

@endsection
