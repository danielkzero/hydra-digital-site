import { onBeforeUnmount, onMounted, ref } from 'vue'

import { isScrolledPast } from '@/utils/scroll'

export function useScrollState(threshold = 50) {
  const isScrolled = ref(false)

  function syncScrollState() {
    isScrolled.value = isScrolledPast(threshold)
  }

  onMounted(() => {
    syncScrollState()
    window.addEventListener('scroll', syncScrollState, { passive: true })
  })

  onBeforeUnmount(() => {
    window.removeEventListener('scroll', syncScrollState)
  })

  return {
    isScrolled,
  }
}
