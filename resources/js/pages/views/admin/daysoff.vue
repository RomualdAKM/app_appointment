<script setup>
import Sidebar from "./../component/sidebar.vue";
import Topbar from "./../component/topbar.vue";
import { ref, reactive, onMounted } from "vue";

const daysoff = ref({})

let form = reactive({
    date: "",
    hours: "",
});

const getDaysoff = async () => {

await axios
		.get("/api/get_days_off")
		.then((res) => {
			daysoff.value = res.data;
		
			console.log("daysoff", daysoff.value);
		})
		.catch((err) => {
			console.log(err);
		});
};

const isLoading = ref(false);

const saveDayOff = async () => {
    isLoading.value = true; // Activation du chargement
  
    await axios.post("/api/save_day_off", form).then((response) => {
        if (response.data.success) {
            isLoading.value = false; // Désactivation du chargement
            toast.fire({
                icon: "success",
                title: "jour de repos ajouté avec succès",
            });
            window.location.reload();
          
        } else {
            isLoading.value = false; // Désactivation du chargement en cas d'erreur
            console.log('error',response.data.message);
            toast.fire({
                icon: "error",
                title: "Veuillez remplir tous les champs requis et assurez-vous que les mots de passe correspondent",
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
}

const deleteDaysOff =  (daysoffId) => {
  Swal.fire({
        title: "Are you sure ?",
        text: "You can't go back",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it !",
    }).then((result) => {
        if (result.value) {
            axios.get("/api/delete_daysoff/" + daysoffId).then(() => {
                Swal.fire("Delete", "days delete successfully", "success");
                getDaysoff()
              
            });
        }
    });
}

onMounted( async () =>{

    await getDaysoff()
   
})

</script>

<template>
    <Sidebar />
    <!-- Page content START -->
    <div class="page-content">
        <Topbar />
        <!-- Page main content START -->
        <div class="page-content-wrapper border">
                    <!-- Title -->
            <div class="row mb-3">
                <div
                    class="col-12 d-sm-flex justify-content-between align-items-center"
                >
                    <h1 class="h3 mb-2 mb-sm-0">Temps de Repos</h1>
                    <a href="#" class="btn btn-sm btn-primary mb-0" data-bs-toggle="modal" data-bs-target="#addCourseModal">Ajouter un temps de repos</a>
                </div>
            </div>
         
            <!-- Card START -->
            <div class="card bg-transparent border">
                <!-- Card header START -->
                <div class="card-header bg-light border-bottom">
                    <!-- Search and select START -->
                    <div
                        class="row g-3 align-items-center justify-content-between"
                    >
                        <!-- Search bar -->
                        <div class="col-md-8">
                            <form class="rounded position-relative">
                                <input
                                    class="form-control bg-body"
                                    type="search"
                                    placeholder="Search"
                                    aria-label="Search"
                                />
                                <button
                                    class="bg-transparent p-2 position-absolute top-50 end-0 translate-middle-y border-0 text-primary-hover text-reset"
                                    type="submit"
                                >
                                    <i class="fas fa-search fs-6"></i>
                                </button>
                            </form>
                        </div>

                    </div>
                    <!-- Search and select END -->
                </div>
                <!-- Card header END -->

                <!-- Card body START -->
                <div class="card-body">
                    <!-- reservation table START -->
                    <div class="table-responsive border-0 rounded-3">
                        <!-- Table START -->
                        <table
                            class="table table-dark-gray align-middle p-4 mb-0 table-hover"
                        >
                            <!-- Table head -->
                            <thead>
                                <tr>
                                    

                                    <th scope="col" class="border-0">
                                       Date
                                    </th>

                                    <th scope="col" class="border-0">
                                       Heure
                                    </th>
                                    <th scope="col" class="border-0">
                                       Action
                                    </th>

                                   
                                </tr>
                                                                    
                            </thead>
                
                            <tbody>
                               ->
                                <tr v-for="item in daysoff" :key="item.id">
                                    
                                   
                                    <td>{{ item.date }}</td>
                                    <td>{{ item.hours }}</td>
                                                                                  
                                    <td>
                                                               
                                       <button  @click="deleteDaysOff(item.id)"
                                           class="btn btn-sm btn-danger-soft mb-0"
                                       >
                                           Supprimer
                                       </button>

                                   </td>
                                </tr>

                               
                            </tbody>
                          
                        </table>
                       
                    </div>
                    <!-- reservation table END -->
                </div>
                <!-- Card body END -->

            </div>
            <!-- Card END -->
        </div>

    </div>

    <div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-dark">
                            <h5 class="modal-title text-white" id="addQuizLabel">Ajouter Temps de repos</h5>
                            <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                        </div>
                        <div class="modal-body">
                            <form class="row text-start g-3">

                                <!-- Question -->
                                <div class="col-12">
                                    <label class="form-label">Date</label>
                                    <input class="form-control" type="date" v-model="form.date">
                                </div>
                             
                                <div class="col-12">

                                    <label class="form-label">Selectionnez heures</label>
                                    <select class="form-control" v-model="form.hours">
                                        <option value="9h-13h">9h-13h</option>
                                        <option value="14h-15h">14h-15h</option>
                                    </select>
                                                                   
                                </div>                            
                                                      
                            </form>
                        </div>
                      
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                            
                            <div v-if="isLoading" class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <button v-else type="button" @click="saveDayOff()" class="btn btn-success my-0">Enregistrer</button>
                        </div>
                    </div>
            </div>
    </div>
</template>
