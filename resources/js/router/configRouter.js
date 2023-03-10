import Home from "../home/index.vue"

const routes = [
    
    // Routas admin precisa estar autenticado
    {
        path:'/admin',
        name:'admin.home',
        component:()=>import('../components/admin/home.vue'),
        meta: { auth: true },
        children:[
            {
                path:'',
                name:'admin.dashboard',
                component:()=>import('../components/admin/dashboardComponent.vue'),
            },
            {
                path:'perfil',
                name:'admin.perfil',
                component:()=>import('../components/admin/perfil/perfil.vue')
            },
            {
                path:'message',
                name:'admin.message',
                component:()=>import('../components/admin/message/messages.vue')
            },
            {
                path:'notify',
                name:'admin.notify',
                component:()=>import('../components/admin/notify/notify.vue')
            },
            {
                path:'pagamento',
                name:'admin.pagamento',
                component:()=>import('../components/admin/pagamento/pagamentos.vue')
            },
            {
                path:'users',
                name:'admin.users',
                component:()=>import('../components/admin/users/users.vue')
            },
            {
                path:'cursos',
                name:'admin.curso',
                component:()=>import('../components/admin/services/cursos/cursosComponentes.vue')
            },
            
        ]
    },

    {
        path:'/',
        name:"home",
        component: Home,
        children:[
            {
                path:'',
                name:'home.login',
                component:()=>import('../home/pages/LoginComponent.vue')
            },

            {
                path:'/register',
                name:'home.register',
                component:()=>import('../home/pages/RegisterComponent.vue')
            },

            {
                path:'/reset',
                name:'home.reset',
                component:()=>import('../home/pages/ResetComponent.vue')
            },

            {
                path:'/api/resetPassword/:token',
                name:'auth.resetPassword',
                component:()=>import('../home/pages/resetPassword.vue'),
                props:true
            },

            {
                path:'/services',
                name:'home.service',
                component:()=>import('../home/pages/ServicesComponent.vue')
            },
            {
                path:'/contacto',
                name:'home.contacto',
                component:()=>import('../home/pages/ContactoComponent.vue')
            },
            {
                path:'/sobre',
                name:'home.sobre',
                component:()=>import('../home/pages/SobreComponent.vue')
            }
        ]
    },
]

export default routes