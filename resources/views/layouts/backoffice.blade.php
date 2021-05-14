<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Olfaire - Backoffice</title>
		<!-- plugins:css -->
		<link rel="stylesheet" href="/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
		<link rel="stylesheet" href="/assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
		<link rel="stylesheet" href="/assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
		<link rel="stylesheet" href="/assets/vendors/css/vendor.bundle.base.css">
		<link rel="stylesheet" href="/assets/vendors/css/vendor.bundle.addons.css">
		<!-- endinject -->
		<!-- plugin css for this page -->
		<!-- End plugin css for this page -->
		<!-- inject:css -->
		<link rel="stylesheet" href="/assets/css/shared/style.css">
		<!-- endinject -->
		<!-- Layout styles -->
		<link rel="stylesheet" href="/assets/css/demo_1/style.css">
		<!-- End Layout styles -->
		<link rel="shortcut icon" href="/assets/images/favicon.ico" />
	</head>
  	<body>
		<div class="container-scroller">
		<!-- partial:partials/_navbar.html -->
		<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
			<div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
			<a class="navbar-brand brand-logo" href="index.html">
				<img src="" alt="" /> </a>
			<a class="navbar-brand brand-logo-mini" href="index.html">
				<img src="" alt="" /> </a>
			</div>
			<div class="navbar-menu-wrapper d-flex align-items-center">
			<form class="ml-auto search-form d-none d-md-block" action="#">
				<div class="form-group">
					<input type="search" class="form-control" placeholder="Pesquisar...">
				</div>
			</form>
			<ul class="navbar-nav ml-auto">    
				<li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
				<a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
					<img class="img-xs rounded-circle" src="/assets/images/faces/face8.jpg" alt="Profile image"> </a>
				<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
					<div class="dropdown-header text-center">
					<img class="img-md rounded-circle" src="/assets/images/faces/face8.jpg" alt="Profile image">
					<p class="mb-1 mt-3 font-weight-semibold">{{ auth()->user()->username }}</p>
					<p class="font-weight-light text-muted mb-0">{{ auth()->user()->email }}</p>
					</div>
					<a class="dropdown-item" href="{{ route('welcome') }}">Página Principal</a>
					<a class="dropdown-item" href="{{ route('backoffice.profile') }}">Perfil</a>
					<a class="dropdown-item" href="{{ route('logout') }}"
												onclick="event.preventDefault();
												document.getElementById('logout-form').submit();">Terminar Sessão
					<i class="dropdown-item-icon ti-power-off"></i>
					</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
					@csrf
					</form>
				</div>
				</li>
				<li>
					
				</li>
			</ul>
			<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
				<span class="mdi mdi-menu"></span>
			</button>
			</div>
		</nav>
		</nav>
		<!-- partial -->
		<div class="container-fluid page-body-wrapper">
			<!-- partial:partials/_sidebar.html -->
			<nav class="sidebar sidebar-offcanvas" id="sidebar">
			<ul class="nav">
				<li class="nav-item nav-profile">
				<a href="#" class="nav-link">
					<div class="profile-image">
					<img class="img-xs rounded-circle" src="/assets/images/faces/face8.jpg" alt="profile image">
					<div class="dot-indicator bg-success"></div>
					</div>
					<div class="text-wrapper">
					<p class="profile-name">{{ Auth::user()->username}}</p>
					<p class="designation">Administrador</p>
					</div>
				</a>
				</li>
				<a href="{{ route('home') }}">
				<li class="nav-item nav-category">Menu Principal</li>
				</a>
				<li class="nav-item">
				<a class="nav-link" data-toggle="collapse" href="#users" aria-expanded="false" aria-controls="ui-basic">
					<i class="menu-icon typcn typcn-coffee"></i>
					<span class="menu-title">Utilizadores</span>
					<i class="menu-arrow"></i>
				</a>
				<div class="collapse" id="users">
					<ul class="nav flex-column sub-menu">
					<li class="nav-item">
						<a class="nav-link" href="{{ route('users.client') }}">Listar Clientes</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ route('users.administrator') }}">Listar Administradores</a>
					</li>
					</ul>
				</div>
				</li>
				<li class="nav-item">
				<a class="nav-link" data-toggle="collapse" href="#products" aria-expanded="false" aria-controls="ui-basic">
					<i class="menu-icon typcn typcn-coffee"></i>
					<span class="menu-title">Produtos</span>
					<i class="menu-arrow"></i>
				</a>
				<div class="collapse" id="products">
					<ul class="nav flex-column sub-menu">
						<li class="nav-item">
							<a class="nav-link" href="{{ route('products.create') }}">Criar Produto</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('products.index') }}">Listar Produtos</a>
						</li>
					</ul>
				</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="collapse" href="#collections" aria-expanded="false" aria-controls="ui-basic">
						<i class="menu-icon typcn typcn-coffee"></i>
						<span class="menu-title">Coleções</span>
						<i class="menu-arrow"></i>
					</a>
					<div class="collapse" id="collections">
						<ul class="nav flex-column sub-menu">
						<li class="nav-item">
							<a class="nav-link" href="{{ route('collections.create') }}">Criar Coleção</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('collections.index') }}">Listar Coleções</a>
						</li>
						</ul>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="collapse" href="#types" aria-expanded="false" aria-controls="ui-basic">
					<i class="menu-icon typcn typcn-coffee"></i>
					<span class="menu-title">Tipos de Produto</span>
					<i class="menu-arrow"></i>
					</a>
					<div class="collapse" id="types">
					<ul class="nav flex-column sub-menu">
						<li class="nav-item">
						<a class="nav-link" href="{{ route('types.create') }}">Criar Tipo de Produto</a>
						</li>
						<li class="nav-item">
						<a class="nav-link" href="{{ route('types.index') }}">Listar Tipos</a>
						</li>
					</ul>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="collapse" href="#addresses" aria-expanded="false" aria-controls="ui-basic">
					<i class="menu-icon typcn typcn-coffee"></i>
					<span class="menu-title">Moradas de Utilizadores</span>
					<i class="menu-arrow"></i>
					</a>
					<div class="collapse" id="addresses">
					<ul class="nav flex-column sub-menu">
						<li class="nav-item">
						<a class="nav-link" href="{{ route('addresses.index') }}">Listar Moradas</a>
						</li>
					</ul>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="collapse" href="#orders" aria-expanded="false" aria-controls="ui-basic">
					<i class="menu-icon typcn typcn-coffee"></i>
					<span class="menu-title">Encomendas Realizadas</span>
					<i class="menu-arrow"></i>
					</a>
					<div class="collapse" id="orders">
					<ul class="nav flex-column sub-menu">
						<li class="nav-item">
						<a class="nav-link" href="{{ route('orders.index') }}">Listar Encomendas</a>
						</li>
					</ul>
					</div>
				</li>
			</ul>
			</nav>
			<!-- partial -->
			<div class="main-panel">
				<div class="content-wrapper">

			@yield('content')
			
				<footer class="footer" style="position: sticky;">
					<div class="container-fluid clearfix align-bottom">
					<span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Olfaire Mendes&Nicolau</span>
					</div>
				</footer>
            <!-- partial -->
            </div>
          <!-- main-panel ends -->
          </div>
        <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="/assets/vendors/js/vendor.bundle.base.js"></script>
        <script src="/assets/vendors/js/vendor.bundle.addons.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <!-- End plugin js for this page-->
        <!-- inject:js -->
        <script src="/assets/js/shared/off-canvas.js"></script>
        <script src="/assets/js/shared/misc.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="/assets/js/demo_1/dashboard.js"></script>
        <!-- End custom js for this page-->
        <script src="/assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
        <!-- Font Awesome Icons -->
        <script src="https://kit.fontawesome.com/303362d7a7.js" crossorigin="anonymous"></script>
        <!-- Ajax -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- Sweet Alerts JS -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <!-- Selectize JS -->
		<link rel="stylesheet" href="/assets/css/selectize.css">
		<script src="/assets/js/selectize.min.js"></script>
		<!-- Validation JS & CSS -->
		<script src="/assets/js/validate.js"></script>
		<link rel="stylesheet" href="/assets/css/validate.css">
        <!-- Scripts -->
        <script>
			// Price + IVA
			function totalPriceIva()
			{
				$(".totalPrice").removeClass("hidden");
				
				let price = $("#preço").val();
				let iva = $("#iva").val();
				let total = (price / ((100 - iva)/100)).toFixed(2);
				
				$("#totalPriceVal").text("Preço total: " + total + " €");
			}

			// Selectize for Collection colors
			$(document).ready($(function()
			{
				$('#cores').selectize({
					plugins: ['restore_on_backspace'],
					delimiter: ',',
					persist: false,
					create: function(input) {
						return {
							value: input,
							text: input
						}
					}
				});
			}));
			
			// Function to delete the image front-end and send request to backend
			function imageDelete(imageName, inputId, product){	
				
				$.ajax({
					url: `/backoffice/products/${product}/${imageName}`, 
					type: "DELETE",
					data: {'_token': '{{ csrf_token() }}'},
					datatype: "json",
					success: function (response) {
						$('#' + inputId).remove(); // Removes image from front-end
					}
				});
        	};

			// Function to delete the collection front-end with a warning (Sweet Alert) and send request to backend
			function collectionDelete(collectionId)
			{
				Swal.fire({

					title: 'Tem a certeza que quer remover a coleção?',
					text: `Todos os produtos associados a esta coleção serão removidos com ela!`,
					icon: 'warning',

					showCancelButton: true,
					confirmButtonColor: '#d33',
					cancelButtonColor: '#3085d6',
					confirmButtonText: 'Remover Coleção',
					cancelButtonText: 'Voltar Atrás'

				}).then((result) => {
					if (result.isConfirmed) {
						$.ajax({
							url: `/backoffice/collections/${collectionId}/true`,
							type: "PATCH",
							data: {'_token': '{{ csrf_token() }}'},
							datatype: "html",
							success: function (response) {
								$(`#collection_${collectionId}`).remove();
								Swal.fire(
									'Coleção Removida!',
									'A ação ocorreu com sucesso e a coleção foi removida!',
									'success'
								)
							},
							error: function () {
								Swal.fire(
									'Não foi possível retirar a coleção!',
									'Tente novamente mais tarde.',
									'error'
								)
							}
						});						
					}
				})
			};

			// Function to delete the type front-end with a warning (Sweet Alert) and send request to backend
			function typeDelete(typeId)
			{
				Swal.fire({

					title: 'Tem a certeza que quer remover este tipo de produto?',
					text: `Todos os produtos associados a este tipo serão removidos com ele!`,
					icon: 'warning',

					showCancelButton: true,
					confirmButtonColor: '#d33',
					cancelButtonColor: '#3085d6',
					confirmButtonText: 'Remover Tipo de Produto',
					cancelButtonText: 'Voltar Atrás'

				}).then((result) => {
					if (result.isConfirmed) {
						$.ajax({
							url: `/backoffice/types/${typeId}/true`,
							type: "PATCH",
							data: {'_token': '{{ csrf_token() }}'},
							datatype: "html",
							success: function (response) {
								$(`#type_${typeId}`).remove();
								Swal.fire(
									'Tipo de Produto Removido!',
									'A ação ocorreu com sucesso e o tipo foi removido!',
									'success'
								)
							},
							error: function () {
								Swal.fire(
									'Não foi possível retirar este tipo de produto!',
									'Tente novamente mais tarde.',
									'error'
								)
							}
						});						
					}
				})
			};

			// Everytime a collection changes so does its colors while creating or editing a product
			$("#coleção").change(function(){
				var selectedCollection = $(this).children("option:selected").val();
				
				$('#cor').find('option').not(':first').remove();

				if(selectedCollection)
				{
					$.ajax({
					url: `/backoffice/products/create/getColors/${selectedCollection}`,
					type: "GET",
					data: {'_token': '{{ csrf_token() }}'},
					dataType: 'json',
						success: function (response) {
							$('select[name="cor"]').empty();
							let colors = JSON.parse(response[0].colors);

							for (let i = 0; i < colors.length; i++) {
								let color = colors[i];

								let option = `<option value="${color}">${color}</option>`;

								$('#cor').append(option);
							}
						},
					});	
				}
				else 
				{
					$('select[name="cor"]').empty();
				}
			});
        </script>

		<script>
			function imagesPreview(input, placeToInsertImagePreview) {
				if (input.files) {
					var filesAmount = input.files.length;

					if(placeToInsertImagePreview == '.thumbnailPreview')
					{
						$('.thumbnailPreview').children('img').remove()
					}
					else if(placeToInsertImagePreview == '.imagesPreview')
					{
						$('.imagesPreview').children('img').remove()
					}

					for (i = 0; i < filesAmount; i++) {
						var reader = new FileReader();

						reader.onload = function(event) {
							$($.parseHTML('<img>')).attr('src', event.target.result).attr('width', 200).attr('heigth', 300).attr('class', 'pr-3').appendTo(placeToInsertImagePreview);
							//let image = `<img src="${e.target.result}" width="100" height="200" style="border: 5px solid green;  border-radius: 10px;">`	
						}

						reader.readAsDataURL(input.files[i]);
					}
				}

			};

			$("#miniatura").change(function() {
					imagesPreview(this, '.thumbnailPreview');
				});
			$('.imagens').change(function() {
				imagesPreview(this, '.imagesPreview');
			});

		</script>
 
	</body>
</html>
