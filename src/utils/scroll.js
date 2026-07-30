import { NAVBAR_HEIGHT, SCROLL_THRESHOLD } from '@/utils/constants'

export const scrollToSection = (selector, offset = NAVBAR_HEIGHT) => {
  if (typeof window === 'undefined') {
    return
  }

  const element = document.querySelector(selector)
  if (!element) {
    return
  }

  const elementPosition = element.getBoundingClientRect().top + window.scrollY
  window.scrollTo({
    top: Math.max(elementPosition - offset, 0),
    behavior: 'smooth',
  })
}

export const isScrolledPast = (threshold = SCROLL_THRESHOLD) => window.scrollY > threshold
