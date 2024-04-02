<script setup>
     import Footer from "./component/footer.vue"
     import Translate from './translate.vue';

    import { ref,watchEffect,computed,onMounted  } from 'vue'; 
    import { useLocation } from './../store/pinia';

    const getLang = useLocation();
    const translations = ref({});

    // Charger les traductions en fonction de la langue sélectionnée
    watchEffect(() => {
        const lang = getLang.useLang;
        if (lang) {
            import(`../../locales/${lang}.json`)
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
 
     const form = ref({
    
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

    const isLoading = ref(false);
 
     const validateForm = async () => {
        isLoading.value = true; // Activation du chargement
        const dataToSend = {
            form: form.value,
            users: users.value.people,
        };
        
            await axios.post("/api/save_reservation", dataToSend).then((response) => {

                if (response.data.success) {
                    isLoading.value = false; // Désactivation du chargement en cas d'erreur
                    window.location.reload();
                    toast.fire({
                    icon: "success",
                    title: "Reservation prise en compte  avec succé",
                });
                } else {
                    isLoading.value = false; // Désactivation du chargement en cas d'erreur
                console.log('error',response.data.message)
                toast.fire({
                    icon: "error",
                    title: "!!!! Remplissez tout les champs requis et assurez vous que les passwords correspondent",
                });
                }
            }).catch((error) => {
        isLoading.value = false; // Désactivation du chargement en cas d'erreur
        console.error('Error saving course:', error);
        toast.fire({
            icon: "error",
            title: "Une erreur s'est produite lors de la sauvegarde du cours. Veuillez réessayer plus tard.",
        });
    });
};

// Propriété calculée pour vérifier si le bouton "Suivant" doit être désactivé
const isNextButtonDisabled = computed(() => {
        // Vérifier si les champs obligatoires sont remplis
        if (!form.value.date || !form.value.hours || !users.value.people.every(person => person.trim())) {
            return true; // Désactiver le bouton si un champ est vide
        } else {
            return false; // Activer le bouton si tous les champs sont remplis
        }
    });


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
                 <h1 class="text-white">{{ translatedContent['banner-title'] }}</h1>
                 <p class="text-white mb-3">{{ translatedContent['banner-text'] }}</p>
                 <a href="#" class="btn btn-white mb-0">{{ translatedContent['banner-button'] }}<i class="bi bi-arrow-right ms-2"></i></a>
             </div>
 
             <div class="col-lg-6 col-xl-6 mb-n9">
                 <div class="card card-body shadow p-4 p-sm-5">
                     
                     <h2 class="mb-0 h3">{{ translatedContent['form-title'] }} </h2>
 
                     <!-- Récapitulatif des informations -->
                     <div v-if="summaryVisible" class="mb-4">
                         <h3 class="mb-3">{{ translatedContent['result-title'] }} :</h3>
                         <ul class="list-group">
                            
                             <li class="list-group-item" v-for="(person, index) in users.people" :key="index">{{ translatedContent['form-label3'] }} {{ index + 1 }} : {{ person }}</li>
                             <li class="list-group-item">{{ translatedContent['form-label1'] }} : {{ form.date }}</li>
                             <li class="list-group-item">{{ translatedContent['form-label2'] }} : {{ form.hours }}</li>
                         </ul>
                         <div class="d-grid mt-4">
                             <button @click="goBack" class="btn btn-secondary">{{ translatedContent['result-button-back'] }}</button>
                             <div v-if="isLoading" class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                             <button v-else @click="validateForm" class="btn btn-primary">{{ translatedContent['result-button-submit'] }}</button>
                         </div>
                     </div>
 
                     <!-- Formulaire -->
                     <form v-else class="mt-3 mt-sm-4 text-start">             

                         <div class="mb-3">
                             <label class="form-label">{{ translatedContent['form-label1'] }}</label>
                             <input class="form-control" type="date" v-model="form.date" @change="getRemainingSeats()">
                         </div>

                         <div class="mb-3">
                             <label class="form-label">{{ translatedContent['form-label2'] }}</label>
                             <select class="form-control" v-model="form.hours" @change="getRemainingSeats()">
                                 <option value="9h-13h">9h-13h</option>
                                 <option value="14h-15h">14h-15h</option>
                             </select>
                         </div>

                        
                        <div v-if="reamining_seats !== ''" class="mb-3">
                            <p>{{ translatedContent['form-message-error1'] }} {{ reamining_seats }} {{ translatedContent['form-message-error2'] }}.</p>
                        </div>

                         <div  v-for="(person, index) in users.people" :key="index">
                             <label class="form-label mt-2">{{ translatedContent['form-label3'] }} {{ index + 1 }}</label>
                             <div class="input-group ">
                                 <input class="form-control" v-model="users.people[index]" type="text" :placeholder="translatedContent['form-placeholder']"  :disabled="reamining_seats <= 0">
                                 <button class="btn btn-danger" type="button" @click="removePerson(index)" v-if="users.people.length > 1">-</button>
                             </div>
                         </div>
 
                         <button class="btn btn-primary mt-2 mb-4" type="button" @click="addPerson" :disabled="reamining_seats <= 0 || reamining_seats <= form.number_of_people">{{ translatedContent['form-button-add-person'] }} + </button>                
                                             
                         <div class="d-grid"><button @click.prevent="showSummary" class="btn btn-dark mb-0" :disabled="isNextButtonDisabled">{{ translatedContent['form-button-next'] }}</button></div>
 
                     </form>
                     <!-- Form END -->
                 </div>
             </div>
 
         </div> <!-- Row END -->
     </div>
    </section>
    <Translate />
    <Footer />
 </template>
 
 