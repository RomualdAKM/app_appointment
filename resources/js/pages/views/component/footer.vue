<script setup>

import { ref,watchEffect,computed,onMounted  } from 'vue'; 
import { useLocation } from '../../store/pinia';

const getLang = useLocation();
const translations = ref({});

// Charger les traductions en fonction de la langue sélectionnée
watchEffect(() => {
	const lang = getLang.useLang;
	if (lang) {
		import(`../../../locales/${lang}.json`)
			.then(module => {
				translations.value = module.default.messages;
				console.log('translations',translations.value)
			})
			.catch(error => {
				console.error('Error importing translation module:', error);
			});
	}
});

const translatedContent = computed(() => {
	return translations.value;
});

</script>

<template>
    <!-- =======================
Footer START -->
<footer class="bg-dark p-3 ">
	<div class="container">
		<div class="row align-items-center">
			<!-- Widget -->
			<div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
				<!-- Logo START -->
				<a href="/"> <img class="h-20px" src="/logo_pulpo.png" alt="logo"> </a>
			</div>
			
			<!-- Widget -->
			<div class="col-md-4 mb-3 mb-md-0">
				<div class="text-center text-white text-primary-hover">
					<router-link to="/login_admin">{{ translatedContent['footer-text1'] }}</router-link>  ©2024 Pulpo Azul. {{ translatedContent['footer-text2'] }} <a href="https://vibecro-corp.tech/" target="_blank" class="text-white">vibecro-corp</a>.
				</div>
			</div>
			<!-- Widget -->
			<div class="col-md-4">
				<!-- Rating -->
				<ul class="list-inline mb-0 text-center text-md-end">
					<li class="list-inline-item ms-2"><a href="#"><i class="text-white fab fa-facebook"></i></a></li>
					<li class="list-inline-item ms-2"><a href="#"><i class="text-white fab fa-instagram"></i></a></li>
					<li class="list-inline-item ms-2"><a href="#"><i class="text-white fab fa-linkedin-in"></i></a></li>
					<li class="list-inline-item ms-2"><a href="#"><i class="text-white fab fa-twitter"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
</footer>
<!-- =======================
Footer END -->

<!-- Back to top -->
<div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>
</template>