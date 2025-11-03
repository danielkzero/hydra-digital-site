<template>
    <main class="container mx-auto pt-20 min-h-screen  text-gray-200 flex flex-col md:flex-row">

        <!-- BOTÃO MOBILE -->
        <button @click="menuAberto = !menuAberto"
            class="fixed top-15 right-5 z-50 bg-gray-800 border border-gray-700 p-2 rounded-lg md:hidden hover:bg-gray-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- MENU LATERAL -->
        <aside :class="[
            'fixed md:static top-0 left-0 h-full md:h-auto bg-gray-900/95 md:bg-transparent w-64 md:w-80 shadow-xl md:shadow-none transform transition-transform duration-300 ease-in-out z-40',
            menuAberto ? 'translate-x-0' : '-translate-x-full md:translate-x-0'
        ]">
            <div class="p-6 pt-20 md:pt-24 border-b border-gray-700">
                <h2 class="text-xl font-bold text-indigo-400">Artigos</h2>
            </div>
            <nav class="p-6 space-y-4 overflow-y-auto">
                <div v-for="post in dados" :key="post.id" @click="abrirPagina(post.id)"
                    class="cursor-pointer p-3 rounded-lg transition hover:bg-gray-800 hover:text-indigo-300"
                    :class="{ 'bg-gray-800 text-indigo-400': paginaSelecionada?.id === post.id }">
                    <h3 class="font-semibold text-lg">{{ post.titulo }}</h3>
                    <p class="text-sm text-gray-400 truncate">{{ post.resumo }}</p>
                </div>
            </nav>
        </aside>

        <!-- CONTEÚDO PRINCIPAL -->
        <section id="blog" class="flex-1 container mx-auto px-6 mt-24 md:mt-0 md:ml-4">
            <div v-if="paginaSelecionada" class="max-w-3xl mx-auto pb-16">
                <!-- Cabeçalho -->
                <header class="mb-10 text-center">
                    <h1 class="text-4xl font-extrabold text-white mb-4 tracking-tight">
                        {{ paginaSelecionada.titulo }}
                    </h1>
                    <p class="text-gray-400 italic text-sm">
                        Publicado em {{ paginaSelecionada.data }} por <span class="text-indigo-400">{{
                            paginaSelecionada.autor }}</span>
                    </p>
                </header>

                <!-- Imagem -->
                <div class="w-full h-64 bg-cover bg-center rounded-2xl shadow-lg mb-10 transition-transform duration-500 hover:scale-[1.02]"
                    :style="{ backgroundImage: `url(${paginaSelecionada.imagem})` }"></div>

                <!-- Conteúdo -->
                <article class="prose prose-invert max-w-none leading-relaxed text-lg">
                    <p v-for="(paragrafo, i) in paginaSelecionada.conteudo" :key="i">
                        {{ paragrafo }}
                    </p>
                </article>
            </div>
            <div v-else class="text-center text-gray-400 mt-32">
                <h2 class="text-2xl font-bold mb-2">Página não encontrada</h2>
                <p>Tente selecionar outro artigo no menu.</p>
            </div>
        </section>
    </main>
</template>

<script setup>
import { useRoute, useRouter } from 'vue-router'
import { ref, computed, watch } from 'vue'

const route = useRoute()
const router = useRouter()
const menuAberto = ref(false)

const dados = ref([
    {
        id: 'minipcp',
        titulo: 'Mini PCP: Controle de Produção Simplificado',
        autor: 'Daniel Ramos',
        data: '03 de Novembro de 2025',
        imagem: 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=1200&q=60',
        resumo: 'Controle sua produção industrial com eficiência e simplicidade.',
        conteudo: [
            'O Mini PCP é uma ferramenta voltada para pequenas e médias indústrias que buscam um controle eficiente de produção sem complicação.',
            'Com um design simples e intuitivo, ele permite acompanhar pedidos, etapas produtivas e prazos de entrega com facilidade.',
            'A integração com sistemas externos e o suporte a dispositivos móveis fazem dele uma opção versátil para o chão de fábrica moderno.'
        ]
    },
    {
        id: 'taskbox',
        titulo: 'Task Box: Gerenciamento de Tarefas Inteligente',
        autor: 'Daniel Ramos',
        data: '02 de Novembro de 2025',
        imagem: 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1200&q=60',
        resumo: 'Gerencie tarefas, equipes e produtividade de forma inteligente.',
        conteudo: [
            'O Task Box foi desenvolvido para ajudar equipes e freelancers a manterem o foco e produtividade.',
            'Ele oferece recursos como tarefas recorrentes, etiquetas personalizadas e sincronização em tempo real.',
            'Com suporte para múltiplos dispositivos, o Task Box é ideal tanto para uso individual quanto em equipes ágeis.'
        ]
    },
    {
        id: 'devblog',
        titulo: 'Dicas para Desenvolvedores Independentes',
        autor: 'Daniel Ramos',
        data: '01 de Novembro de 2025',
        imagem: 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=1200&q=60',
        resumo: 'Aprenda a se organizar e crescer como dev independente.',
        conteudo: [
            'Ser um desenvolvedor independente exige disciplina e estratégia.',
            'Defina horários fixos, mantenha seu portfólio atualizado e invista em aprendizado contínuo.',
            'A constância é o segredo para transformar projetos pequenos em grandes oportunidades.'
        ]
    }
])

const paginaId = ref(route.params.page)
const paginaSelecionada = computed(() => dados.value.find(p => p.id === paginaId.value))

// Atualiza ao mudar rota
watch(
    () => route.params.page,
    (val) => {
        paginaId.value = val
        menuAberto.value = false
    }
)

function abrirPagina(id) {
    router.push(`/apps/${id}`)
    paginaId.value = id
    menuAberto.value = false
}
</script>

<style scoped>
.prose p {
    margin-bottom: 1.2em;
}

.prose-invert a {
    color: #818cf8;
    text-decoration: underline;
}
</style>
