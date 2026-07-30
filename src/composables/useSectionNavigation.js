import { useRoute, useRouter } from 'vue-router'

import { scrollToSection } from '@/utils/scroll'

export function useSectionNavigation() {
  const route = useRoute()
  const router = useRouter()

  async function navigateToSection(href) {
    if (!href?.startsWith('#')) {
      return
    }

    if (route.path !== '/') {
      await router.push({ path: '/', hash: href })
      window.requestAnimationFrame(() => scrollToSection(href))
      return
    }

    scrollToSection(href)
  }

  return {
    navigateToSection,
  }
}
