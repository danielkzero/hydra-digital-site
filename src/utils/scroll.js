/**
 * Realiza uma rolagem suave até o elemento especificado
 * @param {string} href - O seletor do elemento alvo (ex: '#apps')
 * @param {number} offset - Deslocamento opcional do topo (ex: para compensar navbar fixa)
 */
export const scrollToSection = (href, offset = 80) => {
  // Aguarda o próximo tick do Vue para garantir que o DOM foi atualizado
  setTimeout(() => {
    const element = document.querySelector(href);
    console.log('Procurando elemento:', href);
    console.log('Elemento encontrado:', element);
    
    if (element) {
      const elementPosition = element.getBoundingClientRect().top + window.pageYOffset;
      const offsetPosition = elementPosition - offset;
      
      window.scrollTo({
        top: offsetPosition,
        behavior: 'smooth'
      });
    } else {
      console.warn(`Elemento ${href} não encontrado no DOM`);
    }
  }, 0);
};

/**
 * Verifica se a página foi rolada além de um determinado limite
 * @param {number} threshold - Limite de rolagem em pixels
 * @returns {boolean} - Verdadeiro se a página foi rolada além do limite
 */
export const isScrolledPast = (threshold = 50) => {
  return window.scrollY > threshold;
};
