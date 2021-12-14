<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>AQUATIC PLATINUMA | TRYOUT</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ asset('assets/img/icon.ico') }}" type="image/x-icon" />
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<script src="{{ asset('assets/v2/js/plugin/webfont/webfont.min.js') }}"></script>
	<script>
		WebFont.load({
			google: {
				"families": ["Lato:300,400,700,900"]
			},
			custom: {
				"families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
				urls: ["{{ asset('assets/css/fonts.min.css') }}"]
			},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<link rel="stylesheet" href="{{ asset('assets/v2/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/v2/css/atlantis.min.css') }}">

</head>

<body data-background-color="bg2">
	<div class="wrapper sidebar_minimize">
		<div class="main-header">
			<div class="logo-header position-fixed" data-background-color="white">
				<a href="#" class="logo">
					<img src="{{ asset('assets/img/logo.png') }}" alt="navbar brand" class="navbar-brand" height="70%">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>

			@include('partials.sidebar')

			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="{{ asset('storage') . '/' . auth()->user()->image }}" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="{{ asset('storage') . '/' . auth()->user()->image }}" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4>{{ auth()->user()->name }}</h4>
											</div>
										</div>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</div>

		<div class="main-panel">
			<div class="container container-full">
				@yield('models')
			</div>
			@include('partials.footer')
		</div>


	</div>
	<script src="{{ asset('assets/v2/js/core/jquery.3.2.1.min.js') }}"></script>
	<script src="{{ asset('assets/v2/js/core/popper.min.js') }}"></script>
	<script src="{{ asset('assets/v2/js/core/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/v2/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('assets/v2/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>
	<script src="{{ asset('assets/v2/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
	<script src="{{ asset('assets/v2/js/plugin/chart.js/chart.min.js') }}"></script>
	<script src="{{ asset('assets/v2/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
	<script src="{{ asset('assets/v2/js/plugin/chart-circle/circles.min.js') }}"></script>
	<script src="{{ asset('assets/v2/js/plugin/datatables/datatables.min.js') }}"></script>
	<script src="{{ asset('assets/v2/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
	<script src="{{ asset('assets/v2/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
	<script src="{{ asset('assets/v2/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>
	<script src="{{ asset('assets/v2/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
	<script src="{{ asset('assets/v2/js/atlantis.min.js') }}"></script>

	<script src="{{ asset('assets/v2/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
	<script src="{{ asset('assets/v2/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
	<script src="{{ asset('assets/v2/js/plugin/sortable/sortable.min.js') }}"></script>

	<script>
		var form_finish = document.getElementById('form_finish');
		var worksheet_id = document.getElementById('worksheet_id');
		var variation_id = document.getElementById('variation_id');
		var tryout_id = document.getElementById('tryout_id');
		var tryout_time = document.getElementById('tryout_time');
		var end_date = document.getElementById('end_date');

		let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

		// variation 1
		var btn_numbers = document.getElementsByClassName('btn_number');

		// variation 2 dan 3
		var parent_index = 0;
		var parent_quest = document.getElementsByClassName('parent');

		// variation 3
		var column = document.getElementById('column');
		if( variation_id.value == 3 ){
			document.body.style.zoom = '70%';			
		}

		function show_parent(index) {
			if (parent_quest.length == index && variation_id.value != 1) {
				fn_form_submit();
			}
			if (parent_quest[index]) {
				var curr_parent = document.getElementsByClassName('parent_display');
				var parent_id = parent_quest[index].id;
				var child_quest = document.getElementsByClassName('child-' + parent_id);

				parent_quest[index].classList.remove('d-none');
				if (variation_id.value != 3) {
					if (child_quest[0]) {
						change_question(child_quest[0].id);
					}
				}
				parent_index++;

				if (curr_parent[0]) {
					curr_parent[0].classList.add('d-none');
					curr_parent[0].classList.remove('parent_display');
				}
				parent_quest[index].classList.add('parent_display');

				var btn_parent = document.getElementById('btn-' + parent_id);
				if (btn_parent) {
					btn_parent.classList.remove('btn-border');

					var curr_btn_parent = document.getElementsByClassName('btn-parent');
					if (curr_btn_parent[0]) {
						curr_btn_parent[0].classList.add('btn-border');
						curr_btn_parent[0].classList.remove('btn-parent');
					}

					btn_parent.classList.add('btn-parent');
				}
			}
		}

		function change_question(quest_id) {
			var div_quest = document.getElementById(quest_id);
			var btn_quest = document.getElementById('btn_number_' + quest_id);
			if (btn_quest) {
				btn_quest.classList.remove('btn-border');
			}

			div_quest.classList.remove('d-none');
			var curr_div_quest = document.getElementsByClassName('quest_display');
			if (curr_div_quest[0]) {
				if( curr_div_quest[0].id != quest_id ) {
					var curr_btn_quest = document.getElementById('btn_number_' + curr_div_quest[0].id);
					if (curr_btn_quest) {
						curr_btn_quest.classList.add('btn-border');
					}
	
					curr_div_quest[0].classList.add('d-none');
					curr_div_quest[0].classList.remove('quest_display');
				}
			}

			div_quest.classList.add('quest_display');
		}
		if (btn_numbers[0]) {
			btn_numbers[0].click();
		}


		function answer(opt_id, quest_id, skor, next = false, last = false) {
			var btn_option = document.getElementById(opt_id);
			if( variation_id.value == 1 ){
				if( btn_option ){
					var prev_btn_options = document.getElementsByClassName('quest_'+quest_id);
					if( prev_btn_options ){
						for (let index = 0; index < prev_btn_options.length; index++) {
							const prev_btn_option = prev_btn_options[index];
							prev_btn_option.classList.add('btn-border')
						}
					}

					btn_option.classList.remove('btn-border')
				}
			}
			if(variation_id.value == 3){
				if( btn_option ){
					var prev_btn_options = document.getElementsByClassName('quest_'+quest_id);
					if( prev_btn_options ){
						for (let index = 0; index < prev_btn_options.length; index++) {
							const prev_btn_option = prev_btn_options[index];
							prev_btn_option.classList.remove('btn-primary')
							prev_btn_option.classList.remove('text-white')
						}
					}
					btn_option.classList.add('btn-primary')
					btn_option.classList.add('text-white')
				}
			}

			var data = [];
			data['worksheet_id'] = worksheet_id.value;
			data['question_id'] = quest_id;
			data['option_id'] = opt_id;																																																																																																																																									
			data['skor'] = skor;

			fetch('/tryout/answer', {																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																			
					headers: {
						"Content-Type": "application/json",
						"Accept": "application/json, text-plain, */*",
						"X-Requested-With": "XMLHttpRequest",
						"X-CSRF-TOKEN": token
					},
					method: 'post',
					credentials: "same-origin",
					body: JSON.stringify({
						worksheet_id: data['worksheet_id'],
						question_id: data['question_id'],
						option_id: data['option_id'],
						skor: data['skor'],
					})
				})
				.then(response => response.json())
				.then(function(data) {
					console.log(data);																																																																																																																																																																																																																																																																																																																																																																																																																																																															
				})
				.catch(function(error) {
					console.log(error);
				});
			if (next) {
				if (next == quest_id) {
					show_parent(parent_index);
				} else {
					change_question(next);
				}
			}
		}


		function timer() {
			var index_timer = 0;
			var stop = new Date(end_date.value).getTime();

			var x = setInterval(() => {
				if( isNaN(parseInt(tryout_time.value)) ){
					fn_form_submit();
				}
				// var end = new Date(stop + (parseInt(tryout_time.value) * 60000 * index_timer))
				console.log(end_date.value)
				console.log(stop)
				console.log(tryout_time.value)

				var end = new Date(stop + (parseInt(tryout_time.value) * 1000 * index_timer))
				var now = new Date().getTime();

				var distance = end - now;

				var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
				var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
				var seconds = Math.floor((distance % (1000 * 60)) / 1000);

				time.innerHTML = hours + ":" + minutes + ":" + seconds;

				if (distance < 0) {
					if (variation_id.value == 3) {
						if (parent_index == column.value) {
							clearInterval(x);
							fn_form_submit();
						} else {
							index_timer++;
							show_parent(parent_index);
						}
					} else {
						clearInterval(x);
						fn_form_submit();
					}
				}
			}, 1000);
		}

		function fn_form_submit() {
			form_finish.submit();
			// console.log('fn_form_submit');
		}
		timer();
		show_parent(parent_index);
	</script>
</body>

</html>