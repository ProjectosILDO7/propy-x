<template>
    <div class="card col-xs-12 col-sm-12 col-md-4 col-lg-4 m-auto mt-4 shadow">

        <div class="card-header text-center">
            <span class="">
                <b>Propy-x: Login</b>
            </span>
        </div>
        <br>
        <div class="card-body">
            <form @submit.prevent="auth">

                <div class="input-group flex-nowrap mb-3">
                    <span class="input-group-text" id="addon-wrapping">
                        <i class="fa-solid fa-user"></i>
                    </span>
                    <input type="text" class="form-control" placeholder="Utilizador" aria-label="Utilizador"
                        aria-describedby="addon-wrapping" v-model="email">
                </div>

                <div class="input-group flex-nowrap mb-3">
                    <span class="input-group-text" id="addon-wrapping">
                        <i class="fa-solid fa-user-lock"></i>
                    </span>
                    <input type="password" class="form-control" placeholder="Senha" aria-label="Senha"
                        aria-describedby="addon-wrapping" v-model="password">
                </div>

                <div class="d-grid gap-2">
                    <button :class="[
                        'btn', 'btn-info', 'text-light',
                        loading ? 'disabled' : ''
                    ]" type="submit">
                        <span v-if="loading">
                              Validando acesso...
                        </span>
                        <span v-else>
                            <i class="fa-solid fa-right-to-bracket"></i> Entrar
                        </span>
                    </button>
                </div>
                <br>
                <hr>
                <div class="form-group text-md-center text-align-sm">
                    <ul>
                        <li><router-link class="text-secondary" :to="{ name: 'home.reset' }">
                                Esqueci minha senha
                            </router-link></li>
                        <li>
                            <router-link class="text-secondary" :to="{ name: 'home.register' }">
                                Criar uma conta
                            </router-link>
                        </li>
                    </ul>
                </div>

            </form>
        </div>
    </div>
</template>

<script>
import { computed, ref, watch } from 'vue'
import { useStore } from 'vuex'
import router from '../../router/'
import { notify } from "@kyvg/vue3-notification";
import btn_preloading from '../../components/preloading/btn-preloading-black.vue'


export default {
    name: "auth",
    setup() {
        const store = useStore()
        const email = ref("")
        const password = ref("")
        const device_name = ref("")
        const loading = ref(false)

        //const loadingStore = computed(() => store.state.loading)

        watch(
            () => store.state.users.authorization,
                (authorization) => {
                    if(authorization){
                        router.push({name:'admin.home'})
                    }
                }
        )

        const auth = () => {
            loading.value = true
            store.dispatch('auth', {
                email: email.value,
                password: password.value,
                device_name: 'propy-x'
            })
                .then(() => { router.push({ name: 'admin.home' }) })
                .catch((erro)=>{
                    notify({
                        title:'Erro',
                        text:erro,
                        type:'warn'
                    })
                })
                .finally(()=>loading.value=false)

        }

        return {
            auth,
            email,
            password,
            device_name,
            loading,
        }
    },

}

</script>

<style scoped>
ul li {
    list-style: none;
}

ul li a {
    list-style: none;
    text-decoration: none;
}

ul li a:hover {
    list-style: none;
    text-decoration: none;
    color: blue !important
}

/* Extra small devices (phones, 600px and down) */
@media only screen and (max-width: 600px) {
    .text-align-sm {
        text-align: center !important;
    }
}

/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width: 600px) {
    .text-align-sm {
        text-align: end !important;
    }
}

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
    .text-align-sm {
        text-align: end !important;
    }
}
</style>
