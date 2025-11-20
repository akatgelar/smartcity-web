import { ref } from 'vue';
import { createRouter, createWebHistory } from 'vue-router'

// const router = createRouter({
// //   history: createWebHistory(import.meta.env.BASE_URL),
//   history: createWebHistory('admin'),
//   scrollBehavior(to, from, savedPosition) {
//     return savedPosition || { left: 0, top: 0 }
//   },
//   routes: [
//     {
//       path: '/',
//       name: 'Ecommerce',
//       component: () => import('../views/Ecommerce.vue'),
//       meta: {
//         title: 'eCommerce Dashboard',
//       },
//     },
//     {
//       path: '/calendar',
//       name: 'Calendar',
//       component: () => import('../views/Others/Calendar.vue'),
//       meta: {
//         title: 'Calendar',
//       },
//     },
//     {
//       path: '/profile',
//       name: 'Profile',
//       component: () => import('../views/Others/UserProfile.vue'),
//       meta: {
//         title: 'Profile',
//       },
//     },
//     {
//       path: '/form-elements',
//       name: 'Form Elements',
//       component: () => import('../views/Forms/FormElements.vue'),
//       meta: {
//         title: 'Form Elements',
//       },
//     },
//     {
//       path: '/basic-tables',
//       name: 'Basic Tables',
//       component: () => import('../views/Tables/BasicTables.vue'),
//       meta: {
//         title: 'Basic Tables',
//       },
//     },
//     {
//       path: '/line-chart',
//       name: 'Line Chart',
//       component: () => import('../views/Chart/LineChart/LineChart.vue'),
//     },
//     {
//       path: '/bar-chart',
//       name: 'Bar Chart',
//       component: () => import('../views/Chart/BarChart/BarChart.vue'),
//     },
//     {
//       path: '/alerts',
//       name: 'Alerts',
//       component: () => import('../views/UiElements/Alerts.vue'),
//       meta: {
//         title: 'Alerts',
//       },
//     },
//     {
//       path: '/avatars',
//       name: 'Avatars',
//       component: () => import('../views/UiElements/Avatars.vue'),
//       meta: {
//         title: 'Avatars',
//       },
//     },
//     {
//       path: '/badge',
//       name: 'Badge',
//       component: () => import('../views/UiElements/Badges.vue'),
//       meta: {
//         title: 'Badge',
//       },
//     },

//     {
//       path: '/buttons',
//       name: 'Buttons',
//       component: () => import('../views/UiElements/Buttons.vue'),
//       meta: {
//         title: 'Buttons',
//       },
//     },

//     {
//       path: '/images',
//       name: 'Images',
//       component: () => import('../views/UiElements/Images.vue'),
//       meta: {
//         title: 'Images',
//       },
//     },
//     {
//       path: '/videos',
//       name: 'Videos',
//       component: () => import('../views/UiElements/Videos.vue'),
//       meta: {
//         title: 'Videos',
//       },
//     },
//     {
//       path: '/blank',
//       name: 'Blank',
//       component: () => import('../views/Pages/BlankPage.vue'),
//       meta: {
//         title: 'Blank',
//       },
//     },

//     {
//       path: '/error-404',
//       name: '404 Error',
//       component: () => import('../views/Errors/FourZeroFour.vue'),
//       meta: {
//         title: '404 Error',
//       },
//     },

//     {
//       path: '/signin',
//       name: 'Signin',
//       component: () => import('../views/Auth/Signin.vue'),
//       meta: {
//         title: 'Signin',
//       },
//     },
//     {
//       path: '/signup',
//       name: 'Signup',
//       component: () => import('../views/Auth/Signup.vue'),
//       meta: {
//         title: 'Signup',
//       },
//     },
//   ],
// })


declare global {
  interface Window {
    appSetting: {
      name: string;
      title: string;
      tagline: string;
      logo: string;
      description: string;
    };
  }

}

const clientRoutes = [
  {
    path: '/client',
    children: [
        {
            path: '',
            redirect: '/client/login'
        },
        {
            path: 'login',
            name: 'Login',
            component: () => import('../views/Client/Auth/Login.vue'),
            meta: {
                title: 'Login',
            },
        },
        {
            path: 'logout',
            name: 'Logout',
            component: () => import('../views/Client/Auth/Logout.vue'),
            meta: {
                title: 'Logout',
            },
        },
        {
            path: 'reset-password',
            name: 'ResetPassword',
            component: () => import('../views/Client/Auth/ResetPassword.vue'),
            meta: {
                title: 'Reset Password',
            },
        },
        {
            path: 'error-404',
            name: '404 Error',
            component: () => import('../views/Client/Errors/FourZeroFour.vue'),
            meta: {
                title: '404 Error',
            },
        },
    ]
  }
]

const adminRoutes = [
  {
    path: '/admin',
    children: [
        {
            path: '',
            redirect: '/admin/dashboard'
        },
        {
            path: 'dashboard',
            name: 'Dashboard',
            component: () => import('../views/Admin/Dashboard/Dashboard.vue'),
            meta: {
                title: 'Dashboard',
            },
        },
        {
            path: 'profile',
            name: 'Profile',
            component: () => import('../views/Admin/Profile/Profile.vue'),
            meta: {
                title: 'Profile',
            },
        },
        {
            path: 'user',
            children: [
                {
                    path: '',
                    name: 'User List',
                    component: () => import('../views/Admin/User/UserList.vue'),
                    meta: {
                        title: 'User List',
                    },
                },
                {
                    path: 'detail/:id',
                    name: 'User Detail',
                    component: () => import('../views/Admin/User/UserDetail.vue'),
                    meta: {
                        title: 'User Detail',
                    },
                },
                {
                    path: 'add',
                    name: 'User Add',
                    component: () => import('../views/Admin/User/UserAdd.vue'),
                    meta: {
                        title: 'User Add',
                    },
                },
                {
                    path: 'edit/:id',
                    name: 'User Edit',
                    component: () => import('../views/Admin/User/UserEdit.vue'),
                    meta: {
                        title: 'User Edit',
                    },
                }
            ]
        },
        {
            path: 'user-level',
            children: [
                {
                    path: '',
                    name: 'User Level List',
                    component: () => import('../views/Admin/UserLevel/UserLevelList.vue'),
                    meta: {
                        title: 'User Level List',
                    },
                },
                {
                    path: 'detail/:id',
                    name: 'User Level Detail',
                    component: () => import('../views/Admin/UserLevel/UserLevelDetail.vue'),
                    meta: {
                        title: 'User Level Detail',
                    },
                },
                {
                    path: 'add',
                    name: 'User Level Add',
                    component: () => import('../views/Admin/UserLevel/UserLevelAdd.vue'),
                    meta: {
                        title: 'User Level Add',
                    },
                },
                {
                    path: 'edit/:id',
                    name: 'User Level Edit',
                    component: () => import('../views/Admin/UserLevel/UserLevelEdit.vue'),
                    meta: {
                        title: 'User Level Edit',
                    },
                }
            ]
        },
        {
            path: 'setting',
            name: 'Setting List',
            component: () => import('../views/Admin/Setting/SettingList.vue'),
            meta: {
                title: 'Setting List',
            },
        },
    ]
  }
]


const routes = [
  ...clientRoutes,
  ...adminRoutes,
  { path: '/', redirect: '/client' } // default route
]

const router = createRouter({
  history: createWebHistory(),
  scrollBehavior(to, from, savedPosition) {
    return savedPosition || { left: 0, top: 0 }
  },
  routes
})

export default router
const appSetting = ref(window.appSetting)

router.beforeEach((to, from, next) => {
    document.title = `${to.meta.title} | ${appSetting.value?.title}`
    next()
})

// router.afterEach((to, from, next) => {
//     const route = useRoute();
//     if (route.path.startsWith("/admin")) {
//         checkSession()
//     }
// })
