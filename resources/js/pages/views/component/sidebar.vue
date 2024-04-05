<script setup>
import { ref, onMounted } from 'vue';

const logout = () => {
    localStorage.removeItem("token");
   
   window.location.reload();
};


</script>

<template>
    <!-- Sidebar START -->
<nav class="navbar sidebar navbar-expand-xl navbar-dark bg-dark">

<!-- Navbar brand for xl START -->
<div class="d-flex align-items-center">
   <img src="" alt="">
</div>
<!-- Navbar brand for xl END -->

<div class="offcanvas offcanvas-start flex-row custom-scrollbar h-100" data-bs-backdrop="true" tabindex="-1" id="offcanvasSidebar">
    <div class="offcanvas-body sidebar-content d-flex flex-column bg-dark">

        <!-- Sidebar menu START -->
        <ul class="navbar-nav flex-column" id="navbar-sidebar">
            
          
            <!-- Title -->
            <li class="nav-item ms-2 my-2">Pages</li>

            <!-- menu item 2 -->

            <!-- Menu item 3 -->
            <li class="nav-item"><router-link class="nav-link" to="/reservations" ><i class="far fa-clipboard fa-fw me-2" ></i>Listes des reservations</router-link></li>
            <li class="nav-item"><router-link class="nav-link" to="/daysoff" ><i class="far fa-clipboard fa-fw me-2" ></i>Temps de repos</router-link></li>
            <li class="nav-item"><router-link class="nav-link" to="/maxplace" ><i class="far fa-clipboard fa-fw me-2" ></i>Nombre de place max</router-link></li>
            <li class="nav-item"><router-link class="nav-link" to="/profil" ><i class="far fa-clipboard fa-fw me-2" ></i>Editer profil</router-link></li>
          
          </ul>
        <!-- Sidebar menu end -->

        
    </div>
</div>
</nav>
<!-- Sidebar END -->
</template>