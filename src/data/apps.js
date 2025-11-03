import GestorMobile from '@/assets/images/tela.88e8b992.jpg';
import MhjrPCP from '@/assets/images/tela.9842321.jpg';
import Aspirador from '@/assets/images/AspiradorInfo1.png';
import TaskBox from '@/assets/images/taskbox.webp'

export default [
  {
    id: 4,
    title: 'Task Box',
    description: 'O Task Box é um aplicativo de produtividade que ajuda você a organizar suas tarefas e listas de forma simples, rápida e eficiente.',
    coverImage: TaskBox,
    pathLink: '/apps/taskbox'
  },
  {
    id: 1,
    title: 'Gestor Mobile',
    description: 'Aplicativo que permite criar e gerenciar pedidos online e offline, com sincronização automática. Ideal para representantes e clientes.',
    coverImage: GestorMobile,
    pathLink: '/apps/gestormobile'
  }, 
  {
    id: 2,
    title: 'Mini PCP',
    description: 'Aplicativo que permite a gestão de pedidos de clientes, com funcionalidades avançadas de controle de estoque, PCP e financeiro.',
    coverImage: MhjrPCP,
    pathLink: '/apps/minipcp'
  },
  {
    id: 3,
    title: 'Aspirador Informações GoogleMaps',
    description: 'Aplicativo que permite a visualização de informações de um cliente, como endereço, horários, telefones e outros, de maneira automatizada.',
    coverImage: Aspirador,
    pathLink: '/apps/aspirador'
  }
];
