<script setup>
     import { ref,onMounted,computed  } from "vue";
 
     const form = ref({
         email: "",
         phone: "",
         date: "",
         hours: "",
         number_of_people: 1,
     });
 
     const users = ref({
         people: [""],
     });

     const reamining_seats = ref('');

      
     const getRemainingSeats = async () => {
        if(form.value.date && form.value.hours) {

            await axios
                    .get("/api/get_reamining_seats/" + form.value.date + "/" + form.value.hours)
                    .then((res) => {
                        reamining_seats.value = res.data;
                    
                        console.log("get_reamining_seats", reamining_seats.value);
                    })
                    .catch((err) => {
                        console.log(err);
                    });

        }
        };
 
     const summaryVisible = ref(false);
 
     const showSummary = () => {
         summaryVisible.value = true;
     };
 
     const addPerson = () => {
         users.value.people.push("");
         form.value.number_of_people = users.value.people.length;
     };
 
     const removePerson = (index) => {
         users.value.people.splice(index, 1);
         form.value.number_of_people = users.value.people.length;
     };
 
     const goBack = () => {
         summaryVisible.value = false;
     };
 
     const validateForm = async () => {
        const dataToSend = {
            form: form.value,
            users: users.value.people,
        };
        
            await axios.post("/api/save_reservation", dataToSend).then((response) => {

                if (response.data.success) {
                    window.location.reload();
                    toast.fire({
                    icon: "success",
                    title: "Reservation prise en compte  avec succé",
                });
                } else {
                console.log('error',response.data.message)
                toast.fire({
                    icon: "error",
                    title: "!!!! Remplissez tout les champs requis et assurez vous que les passwords correspondent",
                });
                }
            });
     };


onMounted( async () =>{
 
    await getRemainingSeats()

})
 </script>
 

<template>
    <section class="mb-9 position-relative" style="background-image:url(/logo.avif); background-position: center left; background-size: cover;">
     <!-- Background dark overlay -->
     <div class="bg-overlay bg-blue opacity-9"></div>
     <div class="container z-index-9 position-relative">
         <div class="row g-4 justify-content-between align-items-center">
         
             <div class="col-lg-6">
                 <h1 class="text-white">Bienvenue sur Pulpo Azul</h1>
                 <p class="text-white mb-3">Plonger dans les eaux scintillantes de la Méditerranée est une expérience inoubliable, mais pour de nombreux enfants, cette rencontre magique avec la mer reste un rêve lointain. Une association s'efforce de réaliser ce rêve en offrant aux jeunes explorateurs la chance de découvrir la mer et d'apprécier sa beauté. En soutenant cette cause, vous permettez aux enfants d'apprendre, de grandir et de se connecter avec l'environnement marin, tout en les sensibilisant à la préservation de la Méditerranée pour les générations futures. Chaque don contribue à leur éducation et les rapproche de l'expérience enrichissante de découvrir et de protéger la mer Méditerranée. Votre soutien est crucial pour aider ces jeunes à aimer, respecter et protéger notre précieuse Méditerranée</p>
                 <a href="#" class="btn btn-white mb-0">Prendre Rendez-Vous<i class="bi bi-arrow-right ms-2"></i></a>
             </div>
 
         
             <div class="col-lg-6 col-xl-6 mb-n9">
                 <div class="card card-body shadow p-4 p-sm-5">
                     
                     <h2 class="mb-0 h3">Planifiez votre rendez-vous en toute sécurité </h2>
 
                     <!-- Récapitulatif des informations -->
                     <div v-if="summaryVisible" class="mb-4">
                         <h3 class="mb-3">Récapitulatif des informations :</h3>
                         <ul class="list-group">
                             <li class="list-group-item">Email : {{ form.email }}</li>
                             <li class="list-group-item">Numéro : {{ form.phone }}</li>
                             <li class="list-group-item" v-for="(person, index) in users.people" :key="index">Personne {{ index + 1 }} : {{ person }}</li>
                             <li class="list-group-item">Date : {{ form.date }}</li>
                             <li class="list-group-item">Heure : {{ form.hours }}</li>
                         </ul>
                         <div class="d-grid mt-4">
                             <button @click="goBack" class="btn btn-secondary">Retour au formulaire</button>
                             <button @click="validateForm" class="btn btn-primary">Valider</button>
                         </div>
                     </div>
 
                     <!-- Formulaire -->
                     <form v-else class="mt-3 mt-sm-4 text-start">             

                         <div class="mb-3">
                             <label class="form-label">Date</label>
                             <input class="form-control" type="date" v-model="form.date" @change="getRemainingSeats()">
                         </div>

                         <div class="mb-3">
                             <label class="form-label">Heure</label>
                             <select class="form-control" v-model="form.hours" @change="getRemainingSeats()">
                                 <option value="9h-13h">9h-13h</option>
                                 <option value="14h-15h">14h-15h</option>
                             </select>
                         </div>

                        
                        <div v-if="reamining_seats !== ''" class="mb-3">
                            <p>Il reste {{ reamining_seats }} place(s) pour la date et l'heure sélectionnées.</p>
                        </div>

                         <div class="mb-3">
                             <label class="form-label">Email</label>
                             <input type="email" v-model="form.email" class="form-control" :disabled="reamining_seats <= 0">
                         </div>
 
                         <div class="mb-3">
                             <label class="form-label">Numero</label>
                             <input type="tel" class="form-control" v-model="form.phone" :disabled="reamining_seats <= 0">
                         </div>
 
 
                         <div  v-for="(person, index) in users.people" :key="index">
                             <label class="form-label mt-2">Personne {{ index + 1 }}</label>
                             <div class="input-group ">
                                 <input class="form-control" v-model="users.people[index]" type="text" placeholder="nom complet" :disabled="reamining_seats <= 0">
                                 <button class="btn btn-danger" type="button" @click="removePerson(index)" v-if="users.people.length > 1">-</button>
                             </div>
                         </div>
 
                         <button class="btn btn-primary mt-2 mb-4" type="button" @click="addPerson" :disabled="reamining_seats <= 0 || reamining_seats <= form.number_of_people">Ajouter nouvelle personne+ </button>                
                                             
                         <div class="d-grid"><button @click.prevent="showSummary" class="btn btn-dark mb-0">Suivant</button></div>
 
                     </form>
                     <!-- Form END -->
                 </div>
             </div>
 
         </div> <!-- Row END -->
     </div>
     </section>
 </template>
 
 