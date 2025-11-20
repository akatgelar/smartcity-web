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

const adminRoutes = [
  {
    path: '/admin',
    children: [
        {
            path: '',
            name: 'Dashboard',
            component: () => import('../views/Admin/Dashboard/Dashboard.vue'),
            meta: {
                title: 'Dashboard',
            },
        },
        {
            path: 'calendar',
            name: 'Calendar',
            component: () => import('../views/Admin/Calendar/Calendar.vue'),
            meta: {
                title: 'Calendar',
            },
        },
        ]
  }
]

const clientRoutes = [
  {
    path: '/client',
    children: [
        {
            path: '',
            name: 'Signin',
            component: () => import('../views/Client/Auth/Signin.vue'),
            meta: {
                title: 'Signin',
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

const routes = [
  ...adminRoutes,
  ...clientRoutes,
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
