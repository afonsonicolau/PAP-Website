@extends('layouts.outer')

@section('content')

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container">
      <div class="header-container d-flex align-items-center justify-content-between">
        <div class="logo">
          <h1 class="text-light"><a href="#home"><span>Olfaire</span></a></h1>
          <!-- Uncomment below if you prefer to use an image logo -->
          <!-- <a href="index.html"><img src="/assets/mainpage/img/logo.png" alt="" class="img-fluid"></a>-->
        </div>

        <nav id="navbar" class="navbar">
          <ul>
            <li><a href="#header">Início</a></li>
            <li><a href="#about">Sobre Nós</a></li>
            <li><a href="#portfolio">Produtos</a></li>
            <li><a href="#team">Equipa</a></li>
            <li><a href="#contact">Contacte-nos</a></li>
            <li><a href="{{ route('online-shop.index') }}">Loja Online</a></li>
            @if (auth()->user() && auth()->user()->role_id == 2)
				<li><a href="{{ route('home') }}">Backoffice</a></li>
			@endif
            @if (auth()->user())
              <a class="getstarted scrollto" href="{{ route('logout') }}"
					onclick="event.preventDefault();
					document.getElementById('logout-form').submit();">Terminar Sessão
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              	@csrf
              </form>
            @else
              <li><a class="getstarted scrollto" href="{{ route('register') }}">Registe-se!</a></li>
            @endif
            
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

      </div><!-- End Header Container -->
    </div>
  </header>
  <!-- End Header -->

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
            <h3>foto avô</h3>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left" data-aos-delay="200">
            <p>
              Proseguindo uma tradição familiar, iniciada nos anos 40, Álvaro José fundou a sua própria empresa em 1970 produzindo faiança tradicional das Caldas da Rainha, criando a marca OLFAIRE.
              <br><br> 
              Inserida na política de expansão da empresa é constituída a (Mendes & Nicolau, LDA) em 1991 num novo espaço indústrial com vista a satisfazer a procura crescente de loiça de faiança para os mercados externos.
              <br><br>
              Atualmente a empresa exporta para vários mercados dos 5 continentes.                   
            </p>
            <p>
              Temos vários objetivos, e vamos tentar sempre o nosso melhor para os alcançar e superar qualquer dificuldade, tal como aconteceu no passado e acontecerá no futuro!
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
							$i++
						@endphp
					
						<div class="col-lg-4 col-md-6 portfolio-item filter-app">
							<div class="portfolio-wrap">
								<img src="storage/thumbnail/{{ $product->thumbnail }}" class="img-fluid" alt="">
								<div class="portfolio-info">
									<p>{{ $product->type->type }}</p> 
									<p>{{ $product->price }}€</p>
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
                  <div class="pic"><img src="/assets/mainpage/img/team/team-1.jpg" class="img-fluid" alt=""></div>
                  <div class="member-info">
                    <h4>Fernando Nicolau</h4>
                    <span>Chefe Executivo & Gerente de Exportações</span>
                    <p>"O difícil faz-se, o impossível demora mais um bocadinho."</p>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 mt-4 mt-lg-0">
                <div class="member" data-aos="zoom-in" data-aos-delay="200">
                  <div class="pic"><img src="/assets/mainpage/img/team/team-2.jpg" class="img-fluid" alt=""></div>
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
              <p>Caso nos queira contactar tem todos os métodos aqui disponíveis! Atendimento comercial está disponível de segunda a sexta-feira das 10:30 às 16:30.</p>
            </div>
          </div>

          <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
            <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1870.571895895891!2d-9.129546242643082!3d39.43485719195862!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sen!2spt!4v1608726153620!5m2!1sen!2spt" frameborder="0" allowfullscreen></iframe>
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
                  <p>olfaire@gmail.com</p>
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

            <form action="forms/contact.php" method="post" role="form" class="php-email-form mt-4">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Nome" data-rule="minlen:4" data-msg="Este campo tem de ter pelo menos 4 caracteres." />
                  <div class="validate"></div>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" data-rule="email" data-msg="Por favor, introduza um e-mail válido." />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Assunto" data-rule="minlen:4" data-msg="Este campo tem de ter pelo menos 8 caracteres." />
                <div class="validate"></div>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Por favor, escreva uma mensagem." placeholder="Mensagem"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">A carregar...</div>
                <div class="error-message">Não foi possível enviar esta mensagem, por favor, tente mais tarde.</div>
                <div class="sent-message">A sua mensagem foi enviada. Obrigado!</div>
              </div>
              <div class="text-center"><button type="submit">Enviar Mensagem</button></div>
            </form>
          </div>
        </div>

      </div>
    </section><!-- End Contact Section -->

  </main>
  <!-- End #main -->

@endsection
  