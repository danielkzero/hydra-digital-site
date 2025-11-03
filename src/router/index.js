import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'PrincipalView',
      component: () => import('@/views/publico/PrincipalView.vue'),
    },
    {
        path: '/apps/:page',
        name: 'PageAppsView',
        component: () => import('@/views/publico/PageAppsView.vue'),
    }
  ],
})

export default router
