<script setup>

import { reactive, ref } from "vue";
import router from "./../../router/index.js"

let form = reactive({
    email: "",
    password: "",
});

const login = async () => {
    await axios.post("api/login_admin", form).then((response) => {
        if (response.data.success) {
            sessionStorage.setItem("token", response.data.data.token);
            router.push("/reservations");
             toast.fire({
            icon: "success",
            title: "Connect  Successfully",
        });
        } else {
           toast.fire({
            icon: "error",
            title: response.data.message,
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
						<!-- <div class="text-center">
							<h2 class="fw-bold">Welcome to our largest community</h2>
							<p class="mb-0 h6 fw-light">Let's learn something new today!</p>
						</div> -->
						<!-- SVG Image -->
						<img src="/logo_pulpo.png" class="mt-5" alt="">
						
					</div>
				</div>

				<!-- Right -->
				<div class="col-12 col-lg-6 m-auto">
					<div class="row my-5">
						<div class="col-sm-10 col-xl-8 m-auto">
							<!-- Title -->
							<span class="mb-0 fs-1">👋</span>
							<h1 class="fs-2">Accédez à l'espace administrateur </h1>
						

							<!-- Form START -->
							<form>
								<!-- Email -->
								<div class="mb-4">
									<label for="exampleInputEmail1" class="form-label">Email </label>
									<div class="input-group input-group-lg">
										<span class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i class="bi bi-envelope-fill"></i></span>
										<input v-model="form.email" type="email" class="form-control border-0 bg-light rounded-end ps-1" placeholder="E-mail" id="exampleInputEmail1">
									</div>
								</div>
								<!-- Password -->
								<div class="mb-4">
									<label for="inputPassword5" class="form-label">Mot de passe </label>
									<div class="input-group input-group-lg">
										<span class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i class="fas fa-lock"></i></span>
										<input v-model="form.password" type="password" class="form-control border-0 bg-light rounded-end ps-1" placeholder="password" id="inputPassword5">
									</div>
									
								</div>
								<!-- Check box -->
								<div class="mb-4 d-flex justify-content-between mb-4">
									<div class="form-check">
										<input type="checkbox" class="form-check-input" id="exampleCheck1">
										<label class="form-check-label" for="exampleCheck1">Remember me</label>
									</div>
									<!-- <div class="text-primary-hover">
										<a href="forgot-password.html" class="text-secondary">
											<u>Forgot password?</u>
										</a>
									</div> -->
								</div>
								<!-- Button -->
								<div class="align-items-center mt-0">
									<div class="d-grid">
										<button class="btn btn-primary mb-0" type="button" @click="login()">Login</button>
									</div>
								</div>
							</form>
							<!-- Form END -->

							
							<!-- Sign up link -->
							<div class="mt-4 text-center">
								<span>Vous n'aviez pas un compte? <router-link to="/register">Inscription</router-link></span>
							</div>
						</div>
					</div> <!-- Row END -->
				</div>
			</div> <!-- Row END -->
		</div>
	</section>
</main>
<!-- **************** MAIN CONTENT END **************** -->
</template>