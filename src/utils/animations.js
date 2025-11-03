import { ANIMATION_DURATIONS } from './constants';

export const animations = {
  zoomFade: {
    keyframes: `
    @keyframes zoomFade {
      0% {
        opacity: 0;
        transform: scale(1.1);
      }
    
      100% {
        opacity: 1;
        transform: scale(1);
      }
    }`,
    class: `
    .animate-zoom-fade {
      animation: zoomFade ${ANIMATION_DURATIONS.ZOOM_FADE} ease-out forwards;
    }`
  },
  fadeIn: {
    keyframes: `
    @keyframes fadeIn {
      from {
        opacity: 0;
      }
    
      to {
        opacity: 0.95;
      }
    }`,
    class: `
    .animate-fade-in {
      animation: fadeIn ${ANIMATION_DURATIONS.ZOOM_FADE} ease-out forwards;
    }`
  },
  contentFade: {
    keyframes: `
    @keyframes contentFade {
      0% {
        opacity: 0;
        transform: translateY(20px);
      }
    
      30% {
        opacity: 0;
        transform: translateY(20px);
      }
    
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }`,
    class: `
    .animate-content-fade {
      animation: contentFade ${ANIMATION_DURATIONS.CONTENT_FADE} ease-out forwards;
    }`
  }
};
