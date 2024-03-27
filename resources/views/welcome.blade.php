<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        	<!-- Dark mode -->
	<script>
		const storedTheme = localStorage.getItem('theme')
 
		const getPreferredTheme = () => {
			if (storedTheme) {
				return storedTheme
			}
			return window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'light'
		}

		const setTheme = function (theme) {
			if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
				document.documentElement.setAttribute('data-bs-theme', 'dark')
			} else {
				document.documentElement.setAttribute('data-bs-theme', theme)
			}
		}

		setTheme(getPreferredTheme())

		window.addEventListener('DOMContentLoaded', () => {
		    var el = document.querySelector('.theme-icon-active');
			if(el != 'undefined' && el != null) {
				const showActiveTheme = theme => {
				const activeThemeIcon = document.querySelector('.theme-icon-active use')
				const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
				const svgOfActiveBtn = btnToActive.querySelector('.mode-switch use').getAttribute('href')

				document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
					element.classList.remove('active')
				})

				btnToActive.classList.add('active')
				activeThemeIcon.setAttribute('href', svgOfActiveBtn)
			}

			window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
				if (storedTheme !== 'light' || storedTheme !== 'dark') {
					setTheme(getPreferredTheme())
				}
			})

			showActiveTheme(getPreferredTheme())

			document.querySelectorAll('[data-bs-theme-value]')
				.forEach(toggle => {
					toggle.addEventListener('click', () => {
						const theme = toggle.getAttribute('data-bs-theme-value')
						localStorage.setItem('theme', theme)
						setTheme(theme)
						showActiveTheme(theme)
					})
				})

			}
		})

		
	</script>
        <title>Pulpo Azul</title>

        <!-- Fonts -->
        {{-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> --}}

       
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        	<!-- Favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Google Font -->
        <link rel="preconnect" href="https://fonts.googleapis.com/">
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&amp;family=Roboto:wght@400;500;700&amp;display=swap">

        <!-- Plugins CSS -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/font-awesome/css/all.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/tiny-slider/tiny-slider.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/glightbox/css/glightbox.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/choices/css/choices.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/aos/aos.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/glightbox/css/glightbox.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/quill/css/quill.snow.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/stepper/css/bs-stepper.min.css')}}">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.4/dist/tiny-slider.min.css">
		<script src="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.4/dist/min/tiny-slider.min.js"></script>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- Theme CSS -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
		@laravelPWA
    </head>
    <body>
        <div id="app">

        </div>
        <script src="{{ mix('js/app.js') }}"></script>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <!-- Bootstrap JS -->
        <script src="{{asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
		<script src="https://cdn.jsdelivr.net/npm/tiny-slider@2.9.4/dist/min/tiny-slider.min.js"></script>

        <!-- Vendors -->
        {{-- <script src="{{asset('assets/vendor/tiny-slider/tiny-slider.js')}}"></script> --}}
        <script src="{{asset('assets/vendor/glightbox/js/glightbox.js')}}"></script>
		<script src="{{asset('assets/vendor/choices/js/choices.min.js')}}"></script>
		<script src="{{asset('assets/vendor/aos/aos.js')}}"></script>

		<script src="{{asset('assets/vendor/quill/js/quill.min.js')}}"></script>
		<script src="{{asset('assets/vendor/stepper/js/bs-stepper.min.js')}}"></script>
        <!-- Template Functions -->
        <script src="{{asset('assets/js/functions.js')}}"></script>
    </body>
</html>
