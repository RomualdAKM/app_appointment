<script setup>
import Sidebar from "./../component/sidebar.vue";
import Topbar from "./../component/topbar.vue";
import {ref,reactive,onMounted} from 'vue'

const user = ref({

    name: "",
    email: "",
    password:"",
    c_password:"",
})

const getAuthUser = async () => {
 await axios.get('/api/get_auth_user/').then(response => {
        user.value = response.data
        console.log('user', user.value)
    })
}

const editProfil = async () => {
  await axios.post('/api/edit_profil',user.value).then((response) => {

    if(response.data.success){

                //router.push("/reset-password")

                console.log('ok')
                  toast.fire({
                      icon: "success",
                      title: "Edité avec succé",
                  });

                }
                 
              else{
                toast.fire({
                      icon: "error",
                      title: "Remplissez correctement tout les champs",
                  });
                console.log('errorr',response.data.message)
                // errors.value = response.data.message
              }   
  })

}

onMounted( async () => {
  await  getAuthUser()
})

</script>

<template>

<Sidebar />
    <!-- Page content START -->
        <div class="page-content">
	
	    <Topbar />

        <div class="page-content-wrapper border">

        <!-- =======================
        Page content START -->
        <section class="pt-0">
            <div class="container">
                <div class="row">   

                    <!-- Main content START -->
                    <div class="col-xl-12">
                        <!-- Edit profile START -->
                        <div class="card bg-transparent border rounded-3">
                            <!-- Card header -->
                            <div class="card-header bg-transparent border-bottom">
                                <h3 class="card-header-title mb-0">Edité Profil</h3>
                            </div>
                            <!-- Card body START -->
                            <div class="card-body">
                                     <div>
                                        <label class="form-label">Nom</label>
                                        <input class="form-control" type="text" v-model="user.name">
                                    </div>
                                    <div>
                                        <label class="form-label">Email</label>
                                        <input class="form-control" type="text" v-model="user.email">
                                    </div>
                                       <!-- New password -->
                                       <div class="mb-3">
                                           <label class="form-label"> Nouveau mot de passe</label>
                                           <div class="input-group">
                                               <input class="form-control" type="password" v-model="user.password" placeholder="Nouveau mot de passe">
                                             
                                           </div>
                                           <div class="rounded mt-1" id="psw-strength"></div>
                                       </div>
                                       <!-- Confirm password -->
                                       <div>
                                           <label class="form-label">Confirmer Nouveau mot de passe</label>
                                           <input class="form-control" type="password" v-model="user.c_password" placeholder="Confirmer Nouveau mot de passe">
                                       </div>
                                       <!-- Button -->
                                       <div class="d-flex justify-content-end mt-4">
                                           <button type="button" class="btn btn-primary mb-0" @click="editProfil()"> Enregistrer </button>
                                       </div>
                            </div>
                            <!-- Card body END -->
                        </div>
                       
                    </div>
                    <!-- Main content END -->
                </div><!-- Row END -->
            </div>
        </section>
        <!-- =======================
        Page content END -->
        </div>
        </div>

    
</template>