export const siteMeta = {
  brandName: 'HydraDigital',
  contactTitle: 'Entre em contato',
  footerText: 'HydraDigital. Todos os direitos reservados.',
}

export const heroContent = {
  title: 'Produtos digitais feitos para gerar resultado',
  description:
    'Desenvolvimento de aplicativos, jogos e soluções sob medida com foco em performance, clareza de produto e experiência real de uso.',
  actions: [
    { id: 'apps', label: 'Ver aplicativos', href: '#apps', variant: 'primary' },
    { id: 'contact', label: 'Falar com a Hydra', href: '#contact', variant: 'secondary' },
  ],
}

export const sectionContent = {
  apps: {
    eyebrow: 'Aplicativos',
    title: 'Produtos prontos para uso e evolução',
    description:
      'Aplicações pensadas para resolver processos reais, com foco em simplicidade operacional e manutenção contínua.',
  },
  games: {
    eyebrow: 'Jogos',
    title: 'Experiências publicadas pela Hydra',
    description:
      'Projetos casuais e autorais com identidade visual consistente, acessibilidade e loop de jogo claro.',
  },
  technologies: {
    eyebrow: 'Stack',
    title: 'Tecnologias e capacidades',
    description:
      'Ferramentas, plataformas e práticas usadas para manter entrega consistente, escalável e sustentável.',
  },
  blog: {
    eyebrow: 'Blog',
    title: 'Conteúdo para alimentar o site com frequência',
    description:
      'Publique notícias, novidades de produtos, estudos de caso e atualizações da empresa sem depender de edição manual no frontend.',
  },
}

export const navigationItems = [
  { id: 'apps', href: '#apps', label: 'Aplicativos', icon: 'bx bx-mobile-alt' },
  { id: 'games', href: '#games', label: 'Jogos', icon: 'bx bx-joystick' },
  { id: 'blog', href: '/blog', label: 'Blog', icon: 'bx bx-news' },
  { id: 'contact', href: '#contact', label: 'Contato', icon: 'bx bx-envelope' },
]

export const contactContent = {
  details: [
    {
      id: 'email',
      label: 'E-mail',
      value: 'contato@hydradigital.com.br',
      href: 'mailto:contato@hydradigital.com.br',
      icon: 'bx bxs-envelope',
    },
    {
      id: 'location',
      label: 'Base',
      value: 'Barra Mansa, RJ',
      icon: 'bx bxs-map',
    },
  ],
  socialLinks: [
    {
      id: 'play-store',
      label: 'Google Play',
      href: 'https://play.google.com/store/apps/dev?id=4658704075736141999',
      icon: 'bx bxl-play-store',
    },
    {
      id: 'facebook',
      label: 'Facebook',
      href: 'https://www.facebook.com/hydradigitalbr',
      icon: 'bx bxl-facebook-circle',
    },
  ],
}
