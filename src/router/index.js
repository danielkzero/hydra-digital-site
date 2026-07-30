import { createRouter, createWebHistory } from 'vue-router'

import { scrollToSection } from '@/utils/scroll'

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
    },
    {
      path: '/blog',
      name: 'BlogView',
      component: () => import('@/views/publico/BlogView.vue'),
    },
    {
      path: '/blog/admin',
      name: 'BlogAdminView',
      component: () => import('@/views/admin/BlogAdminView.vue'),
    },
    {
      path: '/blog/:slug',
      name: 'BlogPostView',
      component: () => import('@/views/publico/BlogPostView.vue'),
    },
  ],
  scrollBehavior(to) {
    if (to.hash) {
      window.requestAnimationFrame(() => scrollToSection(to.hash))
      return false
    }

    return { top: 0 }
  },
})

export default router
