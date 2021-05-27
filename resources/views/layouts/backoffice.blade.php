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
						<a class="nav-link" data-toggle="collapse" href="#company" aria-expanded="false" aria-controls="ui-basic">
						<i class="menu-icon typcn typcn-coffee"></i>
						<span class="menu-title">Empresa</span>
						<i class="menu-arrow"></i>
						</a>
						<div class="collapse" id="company">
						<ul class="nav flex-column sub-menu">
							<li class="nav-item">
								<a class="nav-link" href="{{ route('company.index') }}">Informações da Empresa</a>
							</li>
						</ul>
						</div>
					</li>
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
							<li class="nav-item">
								<a class="nav-link" href="{{ route('emails.index') }}">E-mails Recebidos</a>
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
						<a class="nav-link" data-toggle="collapse" href="#clientes" aria-expanded="false" aria-controls="ui-basic">
						<i class="menu-icon typcn typcn-coffee"></i>
						<span class="menu-title">Clientes</span>
						<i class="menu-arrow"></i>
						</a>
						<div class="collapse" id="clientes">
						<ul class="nav flex-column sub-menu">
							<li class="nav-item">
								<a class="nav-link" href="{{ route('addresses.index') }}">Listar Moradas</a>
							</li>
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
        <!-- JS -->
        <script src="/assets/vendors/js/vendor.bundle.base.js"></script>
        <script src="/assets/vendors/js/vendor.bundle.addons.js"></script>
        <script src="/assets/js/shared/off-canvas.js"></script>
        <script src="/assets/js/shared/misc.js"></script>
        <script src="/assets/js/demo_1/dashboard.js"></script>
        <script src="/assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
        <!-- Font Awesome Icons -->
        <script src="https://kit.fontawesome.com/303362d7a7.js" crossorigin="anonymous"></script>
        <!-- Ajax -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- Sweet Alerts JS -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <!-- Selectize JS -->
		<script src="/assets/js/selectize.min.js"></script>
		<link rel="stylesheet" href="/assets/css/selectize.css">
		<!-- Validation JS & CSS -->
		<script src="/assets/js/validate.js"></script>
		<link rel="stylesheet" href="/assets/css/validate.css">
        <!-- Scripts -->
        <script>
			// Show or not the inputs depending on the check
			$(document).ready($(function() {
				hideInputs();
			}));

			function hideInputs()
			{
				if($("#changepassword")[0].checked) {
					$("div .info").removeClass("hidden");
				}
				else{
					$("div .info").addClass("hidden");
				}
			};

			// When user chooses a color in multi-select it's values are shown 
			$("#cor").on("change", function() {
				$("#colors").val($(this).val());
			});
			// When administrator changes state of order, ajax request is made
			$("#state").on("change", function()
			{
				// Verification with Swal JS
				Swal.fire({

					title: 'Tem a certeza que quer mudar o estado da encomeda?',
					text: `O estado escolhido será demonstrado ao utilizador!`,
					icon: 'warning',

					showCancelButton: true,
					confirmButtonColor: '#d33',
					cancelButtonColor: '#3085d6',
					confirmButtonText: 'Mudar Estado',
					cancelButtonText: 'Voltar Atrás'

				}).then((result) => {
					if (result.isConfirmed) {
						let id = $("#state").closest('tr').prop('id');
						let state = $("#state option:selected").text();

						$.ajax({
							url: `/backoffice/orders/${id}/${state}`,
							type: "PATCH",
							data: {'_token': '{{ csrf_token() }}'},
							datatype: "html",
							success: function () {
								Swal.fire(
									'Estado Atualizado',
									'A ação ocorreu com sucesso e o estado da encomenda foi atualizado!',
									'success'
								)
							},
							error: function () {
								Swal.fire(
									'Não foi possível atualizar o estado da encomenda!',
									'Tente novamente mais tarde.',
									'error'
								)
							}
						});					
					}
				});
			});

			// On product type change reference changes as well 
			$("#tipo").on("change", function()
			{
				let typeId = $('#tipo option:selected').val();
				$.ajax({
					url: `/backoffice/products/create/getInfo/null/${typeId}`, 
					type: "GET",
					data: {'_token': '{{ csrf_token() }}'},
					dataType: "json",
					success: function (response) {
						// Empty label
						$('#reference').empty(); 

						let reference = JSON.parse(response);
						// Set reference according to type choosen
						$('#reference').val(reference); 
					}
				});
			});

			// Everytime a collection changes so does its colors while creating or editing a product
			$("#colecao").change(function(){
				let selectedCollection = $(this).children("option:selected").val();
				
				$('#cor').find('option').not(':first').remove();

				if(selectedCollection)
				{
					$.ajax({
					url: `/backoffice/products/create/getInfo/${selectedCollection}/null`,
					type: "GET",
					data: {'_token': '{{ csrf_token() }}'},
					dataType: 'json',
						success: function (response) {
							$('select[id="cor"]').empty();
							
							for (let i = 0; i < response.length; i++) {
								let color = response[i];

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

			// Images Preview
			$("#miniatura").change(function() {
					imagesPreview(this, '.thumbnailPreview');
			});
			$('.imagens').change(function() {
				imagesPreview(this, '.imagesPreview');
			});
			
			// Company Details
			function changeDetails(type, value, cancel)
			{
				if(cancel == 1) {
					let p = "";
					if(value.toString().length > 0 && value.toString().length <= 2) {
						p = `<p><b>${value}%</b> <a type="button" href="#" onclick="changeDetails('${type}', ${value}, 0)"><i class="fas fa-pen"></i></a></p>`;
					}	
					else {
						p = `<p>REF: <b>${value}</b> <a type="button" href="#" onclick="changeDetails('${type}', ${value}, 0)"><i class="fas fa-pen"></i></a></p>`;
					}
						
					$(`div .${type}`).append(p);
					$(".form-active").remove();
				}
				else {
					let formCheck = $(".form-active").length;
					if (formCheck > 0) {
						let input = $(".form-active").find('input[class="form-control"]').get();
						let valueOld = input[0].value;
						let typeOld = input[0].id;

						if(valueOld.toString().length > 0 && valueOld.toString().length <= 2) {
							p = `<p><b>${valueOld}%</b> <a type="button" href="#" onclick="changeDetails('${typeOld}', ${valueOld}, 0)"><i class="fas fa-pen"></i></a></p>`;
						}	
						else {
							p = `<p>REF: <b>${valueOld}</b> <a type="button" href="#" onclick="changeDetails('${typeOld}', ${valueOld}, 0)"><i class="fas fa-pen"></i></a></p>`;
						}

						$(`div .${typeOld}`).append(p);

						$(".form-active").remove();
					}

					$(`.${type}`).children('p').remove();

					let dataMax, dataMin;
					if(value.toString().length > 0 && value.toString().length <= 2) {
						dataMin = 1; dataMax = 99;
					}
					else {
						dataMin = 10000; dataMax = 99999;
					}

					let form =  `
						<form class="forms-sample form-active" method="POST" action="{{ route('company.update') }}" enctype="multipart/form-data">
							@csrf
							@method('PATCH')

							<div class="form-group">
								<input type="number" class="form-control" min="${dataMin}" name="${type}" id="${type}" value="${value}" data-validate="yes" data-min="${dataMin}" data-max="${dataMax}" data-type="int">
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary" title="Guardar"><i class="fas fa-save"></i></button>
								<a type="button" class="btn btn-danger" href="#" onclick="changeDetails('${type}', ${value}, 1)" title="Cancelar"><i class="fas fa-ban"></i></a>
							</div>
						</form>
					`;

					$(`.${type}`).append(form);
				}
			};

			// Price + IVA
			function totalPriceIva()
			{
				$(".totalPrice").removeClass("hidden");

				let price = $("#preco").val();
				let iva = $("#iva").val();
				iva = (iva / 100) * price;

				let total = Number(iva) + Number(price);
				
				$("#totalPriceVal").text("Preço total: " + (total).toFixed(2) + " €");
			};

			// Function to delete the image front-end and send request to backend
			function imageDelete(imageName, inputId, product)
			{	
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
				});
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
				});
			};

			function imagesPreview(input, placeToInsertImagePreview) 
			{
				if (input.files) 
				{
					let filesAmount = input.files.length;

					if(placeToInsertImagePreview == '.thumbnailPreview')
					{
						$('.thumbnailPreview').children('img').remove()
					}
					else if(placeToInsertImagePreview == '.imagesPreview')
					{
						$('.imagesPreview').children('img').remove()
					}

					for (i = 0; i < filesAmount; i++) {
						let reader = new FileReader();

						reader.onload = function(event) {
							$($.parseHTML('<img>')).attr('src', event.target.result).attr('width', 200).attr('heigth', 300).attr('class', 'pr-3').appendTo(placeToInsertImagePreview);
							//let image = `<img src="${e.target.result}" width="100" height="200" style="border: 5px solid green;  border-radius: 10px;">`	
						}
						reader.readAsDataURL(input.files[i]);
					}
				}
			};
        </script>
	</body>
</html>
