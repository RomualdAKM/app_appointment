<script setup>
import router from "./../../router/index.js"
import { reactive,watchEffect,computed,onMounted,ref  } from 'vue'; 
import { useLocation } from './../store/pinia';
import Translate from './translate.vue';


const getLang = useLocation();
const translations = ref({});

// Charger les traductions en fonction de la langue sélectionnée
watchEffect(() => {
	const lang = getLang.useLang;
	if (lang) {
		import(`./../../locales/${lang}.json`)
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

let form = reactive({
    name: "",
    email: "",
    password: "",
    c_password: "",
    number: "",
});

let errors = ref([]);

const register = async () => {
    await axios.post("/api/register", form).then((response) => {
        if (response.data.success) {
            sessionStorage.setItem("token", response.data.data.token);
             router.push("/login");
            toast.fire({
            icon: "success",
            title: "Compte créé avec succé",
        });
        } else {
          console.log('error',response.data.message)
           toast.fire({
            icon: "error",
            title: "!!!! Remplissez tout les champs et assurez vous que les passwords correspondent",
        });
        }
    });
};

</script>

<template>

<!-- **************** MAIN CONTENT START **************** -->
<main>
	<section class="p-0 d-flex align-items-center position-relative overflow-hidden">
	
		<div class="container-fluid">
			<div class="row">
				<!-- left -->
				<div class="col-12 col-lg-6 d-md-flex align-items-center justify-content-center bg-primary bg-opacity-10 vh-lg-100">
					<div class="p-3 p-lg-5">
						<!-- Title -->
						<div class="text-center">
							<h2 class="fw-bold">{{ translatedContent['register-welcome-text'] }}</h2>
							
						</div>
						<!-- SVG Image -->
						<img src="/logo_pulpo.png" class="mt-5" alt="">
					
					</div>
				</div>

				<!-- Right -->
				<div class="col-12 col-lg-6 m-auto">
					<div class="row my-5">
						<div class="col-sm-10 col-xl-8 m-auto">
							<!-- Title -->
							<img src="/logo_pulpo.png" class="h-40px mb-2" alt="">
							<h2>{{ translatedContent['register-title'] }}</h2>
				
						
							<!-- Form START -->
							<form>
								<!-- Email -->
								<div class="mb-4">
									<label for="exampleInputEmail1" class="form-label">{{ translatedContent['register-label1'] }} </label>
									<div class="input-group input-group-lg">
										<!-- <span class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i class="bi bi-envelope-fill"></i></span> -->
										<input type="text" v-model="form.name" class="form-control border-0 bg-light rounded-end ps-1" id="exampleInputEmail1">
									</div>
								</div>
								<div class="mb-4">
									<label for="exampleInputEmail1" class="form-label">{{ translatedContent['register-label2'] }}</label>
									<div class="input-group input-group-lg">
										<span class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i class="bi bi-envelope-fill"></i></span>
										<input type="email" v-model="form.email" class="form-control border-0 bg-light rounded-end ps-1"  id="exampleInputEmail1">
									</div>
								</div>
								<div class="mb-4">
									<label for="exampleInputEmail1" class="form-label">{{ translatedContent['register-label3'] }}</label>
									<div class="input-group input-group-lg">
										<!-- <span class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i class="bi bi-envelope-fill"></i></span> -->
										<input type="tel" v-model="form.number" class="form-control border-0 bg-light rounded-end ps-1"  id="exampleInputEmail1">
									</div>
								</div>
								<!-- Password -->
								<div class="mb-4">
									<label for="inputPassword5" class="form-label">{{ translatedContent['register-label4'] }}</label>
									<div class="input-group input-group-lg">
										<span class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i class="fas fa-lock"></i></span>
										<input type="password" v-model="form.password" class="form-control border-0 bg-light rounded-end ps-1" placeholder="*********" id="inputPassword5">
									</div>
								</div>
								<!-- Confirm Password -->
								<div class="mb-4">
									<label for="inputPassword6" class="form-label">{{ translatedContent['register-label5'] }}</label>
									<div class="input-group input-group-lg">
										<span class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i class="fas fa-lock"></i></span>
										<input type="password" v-model="form.c_password" class="form-control border-0 bg-light rounded-end ps-1" placeholder="*********" id="inputPassword6">
									</div>
								</div>
								
								<!-- Button -->
								<div class="align-items-center mt-0">
									<div class="d-grid">
										<button class="btn btn-primary mb-0" @click="register()" type="button">{{ translatedContent['register-button'] }}</button>
									</div>
								</div>
							</form>
							<!-- Form END -->

							<!-- Sign up link -->
							<div class="mt-4 text-center">
								<span>{{ translatedContent['register-question'] }}<router-link to="/login"> {{ translatedContent['register-link'] }}</router-link></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
<!-- **************** MAIN CONTENT END **************** -->
<Translate />
</template>