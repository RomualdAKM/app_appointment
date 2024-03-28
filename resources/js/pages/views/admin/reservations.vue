<script setup>
import Sidebar from "./../component/sidebar.vue";
import Topbar from "./../component/topbar.vue";
import { ref, reactive, onMounted } from "vue";


const reservations = ref({})


const getReservation = async () => {

await axios
		.get("/api/get_reservations")
		.then((res) => {
			reservations.value = res.data;
		
			console.log("reservations", reservations.value);
		})
		.catch((err) => {
			console.log(err);
		});
};

onMounted( async () =>{
    await getReservation()
   
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
                    <h1 class="h3 mb-2 mb-sm-0">Reservations</h1>
                    <!-- <a href="#" class="btn btn-sm btn-primary mb-0" data-bs-toggle="modal" data-bs-target="#addreservationModal">Nouveau Cours</a> -->
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
                                    <th
                                        scope="col"
                                        class="border-0 rounded-start"
                                    >
                                        Email 
                                    </th>
                                  
                                    <th scope="col" class="border-0">
                                       Numero
                                    </th>

                                    <th scope="col" class="border-0">
                                       Date
                                    </th>

                                    <th scope="col" class="border-0">
                                       Heure
                                    </th>

                                    <th scope="col" class="border-0">
                                       Nombre de personnes
                                    </th>

                                    <th scope="col" class="border-0">
                                       Nom complet des personnes
                                    </th>

                                </tr>
                                                                    
                            </thead>
                
                            <tbody>
                               ->
                                <tr v-for="reservation in reservations" :key="reservation.id">
                                    
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
                                                    >{{ reservation.user.email }}</a
                                                >
                                            </h6>
                                        </div>
                                    </td>
                                  
                                    <td>{{ reservation.user.number }}</td>
                                    <td>{{ reservation.date }}</td>
                                    <td>{{ reservation.hours }}</td>
                                    <td>{{ reservation.number_of_people }}</td>
                                    <td>

                                        <ul>
                                                <li v-for="person in reservation.people" :key="person.id">{{person.fullname}}</li>
                                               
                                        </ul>

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
</template>
