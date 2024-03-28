<script setup>
import Sidebar from "./../component/sidebar.vue";
import Topbar from "./../component/topbar.vue";
import { ref, reactive, onMounted } from "vue";

const maxplace = ref({})
const maxplaces = ref({})

const form = ref({
    number: maxplace.value.number
})

const getMaxplaces = async () => {

await axios
		.get("/api/get_max_places")
		.then((res) => {
			maxplaces.value = res.data;		
			console.log("maxplaces", maxplaces.value);
		})
		.catch((err) => {
			console.log(err);
		});
};

const getMaxplace = async (id) => {

await axios
		.get("/api/get_max_place/" + id)
		.then((res) => {
			maxplace.value = res.data;		
			console.log("maxplace", maxplace.value);
		})
		.catch((err) => {
			console.log(err);
		});
};

const isLoading = ref(false);

const editMaxPlace = async () => {
    isLoading.value = true; // Activation du chargement
  
    await axios.post("/api/edit_max_place/" + maxplace.value.id, maxplace.value).then((response) => {
        if (response.data.success) {
            isLoading.value = false; // Désactivation du chargement
            toast.fire({
                icon: "success",
                title: "editer avec succès",
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


onMounted( async () =>{

    await getMaxplace()
    await getMaxplaces()
   
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
                    <h1 class="h3 mb-2 mb-sm-0">Nombre max de personne par voyage</h1>
                    <!-- <a href="#" class="btn btn-sm btn-primary mb-0" data-bs-toggle="modal" data-bs-target="#addCourseModal">Ajouter un temps de repos</a> -->
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
                                       Nombre de place
                                    </th>
                                    <th scope="col" class="border-0">
                                       Action
                                    </th>

                                   
                                </tr>
                                                                    
                            </thead>
                
                            <tbody>
                               ->
                                <tr v-for="item in maxplaces" :key="item.id">
                                    
                                    <td>
                                        <div
                                            class="d-flex align-items-center position-relative"
                                        >                                  
                                           
                                            <h6
                                                class="table-responsive-title mb-0 ms-2"
                                            >
                                                <a
                                                    href="#"
                                                    class="stretched-link"
                                                    >{{ item.number }}</a
                                                >
                                            </h6>
                                        </div>
                                    </td>
                                                                                  
                                    <td>
                                                               
                                       <button  @click="getMaxplace(item.id)"
                                           class="btn btn-sm btn-primary-soft mb-0"
                                           data-bs-toggle="modal" data-bs-target="#addCourseModal"
                                       >
                                           Editer
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
                            <h5 class="modal-title text-white" id="addQuizLabel">Editer nombre de place max</h5>
                            <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                        </div>
                        <div class="modal-body">
                            <form class="row text-start g-3">

                                <!-- Question -->
                                <div class="col-12">
                                    <label class="form-label">Nombre de place max</label>
                                    <input class="form-control" type="number" min="0" v-model="maxplace.number">
                                </div>                                      
                                                      
                            </form>
                        </div>
                      
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                            
                            <div v-if="isLoading" class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <button v-else type="button" @click="editMaxPlace()" class="btn btn-success my-0">Enregistrer</button>
                        </div>
                    </div>
            </div>
    </div>
</template>
