import GestorMobile from "@/assets/images/tela.88e8b992.jpg";
import PcpDashboard from "@/assets/images/pcp-dashboard.png";
import PcpOrdens from "@/assets/images/pcp-ordens-producao.png";
import PcpEquipamentos from "@/assets/images/pcp-equipamentos.png";
import PcpHistoricoEquipamento from "@/assets/images/pcp-historico-equipamento.png";
import PcpOperadorApontamento from "@/assets/images/pcp-operador-apontamento.png";
import PcpImpressaoOs from "@/assets/images/pcp-impressao-os.png";
import PcpTemaEscuro from "@/assets/images/pcp-tema-escuro.png";
import Aspirador from "@/assets/images/AspiradorInfo1.png";
import TaskBox from "@/assets/images/PrincipalTaskBox.png";
import GestorCover from "@/assets/images/gestor-analise-comercial.png";
import GestorTerritorio from "@/assets/images/gestor-territorio.png";
import GestorEstoque from "@/assets/images/gestor-estoque.png";
import GestorCarregamento from "@/assets/images/gestor-carregamento.png";

export default [
  {
    id: "gestor",
    aliases: ["gestormobile"],
    title: "Gestor — Web e Mobile",
    description:
      "Plataforma integrada para gestão comercial, logística e estoque, com experiência web e aplicativo mobile para operações em campo.",
    coverImage: GestorCover,
    pathLink: "/apps/gestor",
    autor: "Daniel Ramos",
    data: "30 de julho de 2026",
    resumo:
      "Gestão integrada de pedidos, vendas, logística e estoque em uma única experiência.",
    features: [
      "Inteligência comercial",
      "Gestão logística",
      "Controle de estoque",
      "Dashboards e relatórios",
      "Aplicativo online e offline",
    ],
    conteudo: [
      "O Gestor centraliza etapas essenciais da operação em uma interface web responsiva: pedidos, análise de margem, desempenho comercial, fretes, carregamentos e movimentações de estoque.",
      "A plataforma foi desenhada para dar contexto aos dados. Indicadores, alertas, filtros e visualizações territoriais ajudam cada área a identificar riscos, prioridades e oportunidades sem depender de consultas fragmentadas.",
      "Entre os destaques estão o painel de risco comercial por pedido, relatórios de supervisão com cobertura territorial, acompanhamento de estoque em tempo real e a montagem visual de cargas por peso e cubagem.",
      "A mesma solução também está disponível no Gestor Mobile, permitindo que representantes e clientes criem e acompanhem pedidos mesmo sem conexão. Os dados são sincronizados automaticamente assim que o dispositivo volta a ficar online.",
    ],
    gallery: [
      {
        image: GestorCover,
        title: "Risco comercial e margem",
        description:
          "Indicadores de rentabilidade, receita em risco e fila de atuação ajudam a priorizar pedidos que exigem revisão.",
      },
      {
        image: GestorTerritorio,
        title: "Inteligência territorial",
        description:
          "Mapa interativo, métricas de desempenho e detalhamento regional apoiam a gestão de supervisores e representantes.",
      },
      {
        image: GestorEstoque,
        title: "Estoque em tempo real",
        description:
          "Saldos, níveis críticos, evolução das movimentações e histórico ficam reunidos em uma única visão.",
      },
      {
        image: GestorCarregamento,
        title: "Planejamento de carregamento",
        description:
          "A ocupação do caminhão é visualizada por pedido, com controle de peso, valor, volume e espaço restante.",
      },
      {
        image: GestorMobile,
        title: "Gestor Mobile",
        description:
          "A operação comercial continua em campo com pedidos online e offline, sincronização automática e integração com a plataforma web.",
      },
    ],
  },
  {
    id: "taskbox",
    title: "Task Box",
    description:
      "O Task Box é um aplicativo de produtividade projetado para ajudar você a organizar suas tarefas e listas de forma prática, rápida e eficiente.",
    coverImage: TaskBox,
    pathLink: "/apps/taskbox",
    autor: "Daniel Ramos",
    data: "02 de novembro de 2025",
    resumo:
      "Gerencie suas tarefas, equipes e produtividade de maneira inteligente e simplificada.",
    conteudo: [
      `
<section id="taskbox" class="max-w-3xl mx-auto bg-gray-900 text-gray-100 rounded-2xl shadow-xl p-8 mt-10">
  <header class="border-b border-gray-700 pb-4 mb-6">
    <div class="flex items-center justify-between">

      <!-- Botão Google Play -->
      <a
        href="https://play.google.com/store/apps/details?id=com.hydradigital.taskbox.app&hl=pt_BR"
        target="_blank"
        rel="noopener noreferrer"
        class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white font-medium px-4 py-2 rounded-lg duration-200 shadow-md 
        transition-all hover:scale-105
        "
      >
        <i class='bx bxl-play-store text-2xl'></i>
        <span>Google Play</span>
      </a>
    </div>

    <p class="text-gray-300 leading-relaxed mt-2">
      O Task Box foi desenvolvido para auxiliar pessoal comuns, profissionais autônomos a manter o foco e aumentar a produtividade no dia a dia.
    </p>
  </header>

  <article class="space-y-6">
    <h2 class="text-2xl font-semibold text-indigo-400">Entre os principais recursos estão:</h2>

    <ul class="list-disc list-inside space-y-2 text-gray-300">
      <li><span class="text-gray-100 font-medium">Criação e gerenciamento</span> de listas de tarefas;</li>
      <li>Reagendamento rápido e fácil de tarefas;</li>
      <li>Repetição automática de tarefas (<em>diária</em>, <em>semanal</em> ou <em>mensal</em>) com definição de limite de data;</li>
      <li>Ordenação crescente e decrescente;</li>
      <li>Lembretes com opção de antecipação em minutos;</li>
      <li>Exclusão de tarefas concluídas;</li>
      <li>
        Agrupamento de tarefas por período:
        <strong class="text-indigo-400">HOJE</strong>,
        <strong class="text-indigo-400">AMANHÃ</strong>,
        <strong class="text-indigo-400">PASSADAS</strong> e
        <strong class="text-indigo-400">FUTURAS</strong>;
      </li>
      <li>Detalhamento completo das tarefas com opção de duplicação;</li>
    </ul>

    <p class="text-gray-300 leading-relaxed">
      O Task Box oferece suporte a múltiplos dispositivos android.
    </p>

    <p class="bg-gray-800 border-l-4 border-indigo-500 p-4 rounded-md text-sm text-gray-200">
      <strong class="text-indigo-400">Privacidade:</strong> todos os dados são armazenados localmente, garantindo
      segurança, privacidade e acesso rápido mesmo offline.
    </p>
  </article>
</section>
`,
    ],
  },
  {
    id: "minipcp",
    title: "Sistema de Controle PCP",
    description:
      "Plataforma de Planejamento e Controle da Produção para acompanhar pedidos, ordens, equipamentos e entregas em uma operação industrial.",
    coverImage: PcpDashboard,
    pathLink: "/apps/minipcp",
    autor: "Daniel Ramos",
    data: "30 de julho de 2026",
    resumo:
      "Planejamento e acompanhamento da produção industrial, do pedido à entrega.",
    features: [
      "Ordens de produção",
      "Gestão de equipamentos",
      "Operação por código de barras",
      "Rastreabilidade",
      "Indicadores produtivos",
      "Tema claro e escuro",
    ],
    conteudo: [
      "O sistema de Controle PCP reúne planejamento, execução e acompanhamento da produção em uma experiência simples para equipes industriais.",
      "O dashboard consolida o volume produzido, máquinas em uso, ordens ativas, ritmo de fabricação e entregas recentes. As equipes conseguem identificar rapidamente o que está em andamento e onde a operação exige atenção.",
      "Pedidos são convertidos em ordens de produção rastreáveis, com quantidades, pesos, tempos, progresso e prazos. Nos centros de trabalho, cada equipamento pode ser associado a uma ordem de serviço, operador e histórico de apontamentos.",
      "No chão de fábrica, o operador recebe a ordem impressa com os códigos de barras do produto e da operação. Ao bipar a OS, o sistema identifica o trabalho, vincula o colaborador e inicia o apontamento. A mesma tela permite acompanhar as ordens abertas e encerrá-las ao final da execução.",
      "A interface também oferece temas claro e escuro, permitindo adaptar a leitura às condições de iluminação do ambiente produtivo.",
    ],
    gallery: [
      {
        image: PcpDashboard,
        title: "Visão geral da produção",
        description:
          "Indicadores, metas por cliente e históricos recentes oferecem uma leitura rápida do desempenho fabril.",
      },
      {
        image: PcpOrdens,
        title: "Ordens de produção",
        description:
          "Acompanhamento de quantidades, peso, tempo, progresso e prazo de entrega em cada ordem produtiva.",
      },
      {
        image: PcpImpressaoOs,
        title: "Ordem pronta para o chão de fábrica",
        description:
          "A impressão reúne pedido, produto, operação, material, observações e códigos de barras para leitura rápida.",
      },
      {
        image: PcpOperadorApontamento,
        title: "Apontamento pelo operador",
        description:
          "O colaborador bipa a ordem de serviço, acompanha as operações vinculadas ao seu nome e encerra a OS ao concluir o trabalho.",
      },
      {
        image: PcpEquipamentos,
        title: "Centros de trabalho",
        description:
          "Visão das máquinas em uso, setores, ordens vinculadas e operadores responsáveis por equipamento.",
      },
      {
        image: PcpHistoricoEquipamento,
        title: "Histórico operacional",
        description:
          "Detalhamento da ordem de serviço com pedido, cliente, operador, quantidades e registros de apontamento.",
      },
      {
        image: PcpTemaEscuro,
        title: "Tema escuro",
        description:
          "A experiência pode ser adaptada para ambientes com menor iluminação sem perder a hierarquia dos dados produtivos.",
      },
    ],
  },
  {
    id: "aspirador",
    title: "Aspirador Informações GoogleMaps",
    description:
      "Aplicativo que permite a visualização de informações de um cliente, como endereço, horários, telefones e outros, de maneira automatizada.",
    coverImage: Aspirador,
    pathLink: "/apps/aspirador",
    autor: "Daniel Ramos",
    data: "10 de novembro de 2024",
    resumo: "Visualize informações de clientes de forma automatizada.",
    conteudo: [
      "Permite ver endereço, horários, telefones e outras informações importantes de clientes.",
      "Automatiza a visualização de dados para otimizar o tempo de atendimento.",
      "Suporte a múltiplos dispositivos e integração com mapas online.",
    ],
  },
];
