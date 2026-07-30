<template>
  <main class="mx-auto max-w-6xl px-4 pb-20 pt-28 sm:px-6 lg:px-8">
    <SectionBlock
      eyebrow="Admin"
      title="Gerenciar blog"
      description="Painel editorial com login seguro, editor rich text, upload de capa e configuração de credenciais."
      centered
    >
      <section v-if="!isAuthenticated" class="mx-auto max-w-xl surface-card p-6 sm:p-8">
        <h2 class="text-2xl font-semibold text-white">Entrar no painel</h2>
        <p class="mt-2 text-slate-400">Use suas credenciais administrativas para acessar o CMS do blog.</p>

        <form class="mt-8 grid gap-4" @submit.prevent="handleLogin">
          <label class="grid gap-2">
            <span class="text-sm text-slate-300">E-mail</span>
            <input v-model="loginForm.email" type="email" class="input-field" autocomplete="username" required />
          </label>

          <label class="grid gap-2">
            <span class="text-sm text-slate-300">Senha</span>
            <input v-model="loginForm.password" type="password" class="input-field" autocomplete="current-password" required />
          </label>

          <button type="submit" class="rounded-full bg-cyan-400 px-5 py-3 text-sm font-medium text-slate-950 transition hover:bg-cyan-300">
            {{ authLoading ? 'Entrando...' : 'Entrar' }}
          </button>

          <p v-if="authError" class="text-sm text-rose-300">{{ authError }}</p>
        </form>
      </section>

      <div v-else class="grid gap-6 lg:grid-cols-[260px_1fr]">
        <div class="mb-2 flex justify-end lg:hidden">
          <button
            class="admin-mobile-toggle"
            @click="toggleMobileSidebar"
          >
            <i class="bx bx-menu text-xl"></i>
            Menu do painel
          </button>
        </div>

        <transition name="mobile-sidebar-fade">
          <div
            v-if="isMobileSidebarOpen"
            class="admin-mobile-backdrop lg:hidden"
            @click="closeMobileSidebar"
          ></div>
        </transition>

        <aside
          class="surface-card admin-sidebar p-4"
          :class="isMobileSidebarOpen ? 'admin-sidebar--mobile-open' : ''"
        >
          <div class="admin-sidebar__header">
            <div class="flex items-start justify-between gap-4 lg:block">
              <div>
                <p class="section-eyebrow">Sessão</p>
                <h2 class="mt-3 text-xl font-semibold text-white">{{ accountForm.email }}</h2>
                <p class="mt-2 text-sm text-slate-400">Gerencie posts, layout editorial e credenciais em um único fluxo.</p>
              </div>

              <button class="rounded-full border border-white/10 px-3 py-2 text-sm text-white transition hover:border-white/30 lg:hidden" @click="closeMobileSidebar">
                Fechar
              </button>
            </div>
          </div>

          <nav class="mt-6 grid gap-2">
            <button
              v-for="item in menuItems"
              :key="item.id"
              class="admin-nav-button"
              :class="activePanel === item.id ? 'admin-nav-button--active' : ''"
              @click="handleMenuSelection(item.id)"
            >
              <span class="flex items-center gap-3">
                <i :class="item.icon" class="text-xl"></i>
                {{ item.label }}
              </span>
              <span v-if="item.id === 'posts'" class="rounded-full bg-white/5 px-2 py-1 text-xs text-slate-300">
                {{ posts.length }}
              </span>
            </button>
          </nav>

          <div class="glass-divider my-6"></div>

          <button class="w-full rounded-full border border-white/10 px-4 py-3 text-sm text-white transition hover:border-white/30" @click="handleLogout">
            Sair
          </button>
        </aside>

        <section class="relative min-h-[32rem]">
          <transition name="panel-fade" mode="out-in">
            <div v-if="activePanel === 'posts'" key="posts" class="surface-card admin-panel p-6">
              <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                  <h2 class="text-2xl font-semibold text-white">Posts salvos</h2>
                  <p class="mt-2 text-slate-400">Rascunhos e publicações disponíveis para edição.</p>
                </div>
                <button class="rounded-full border border-cyan-300/20 bg-cyan-400/10 px-4 py-2 text-sm font-medium text-cyan-200 transition hover:bg-cyan-400/20" @click="loadPosts">
                  Atualizar lista
                </button>
              </div>

              <div class="mt-6 grid gap-3">
                <article
                  v-for="post in posts"
                  :key="post.id"
                  class="admin-post-card"
                >
                  <div class="flex items-start justify-between gap-4">
                    <div class="min-w-0">
                      <h3 class="truncate text-lg font-medium text-white">{{ post.title }}</h3>
                      <p class="mt-1 truncate text-sm text-slate-400">{{ post.slug }}</p>
                    </div>
                    <span class="rounded-full px-3 py-1 text-xs" :class="post.published ? 'bg-emerald-400/10 text-emerald-200' : 'bg-amber-400/10 text-amber-200'">
                      {{ post.published ? 'Publicado' : 'Rascunho' }}
                    </span>
                  </div>

                  <p class="mt-3 text-sm leading-6 text-slate-300">{{ post.excerpt }}</p>

                  <div class="mt-5 flex gap-3">
                    <button class="rounded-full border border-white/10 px-4 py-2 text-sm text-white transition hover:border-cyan-300/40 hover:text-cyan-200" @click="startEdit(post)">
                      Editar
                    </button>
                    <button class="rounded-full border border-transparent bg-rose-400/10 px-4 py-2 text-sm text-rose-200 transition hover:bg-rose-400/20" @click="handleDelete(post.id)">
                      Excluir
                    </button>
                  </div>
                </article>
              </div>
            </div>

            <div v-else-if="activePanel === 'editor'" key="editor" class="surface-card admin-panel p-6">
              <div class="flex flex-wrap items-start justify-between gap-4">
                <div>
                  <h2 class="text-2xl font-semibold text-white">{{ editingId ? 'Editar post' : 'Novo post' }}</h2>
                  <p class="mt-2 text-slate-400">Monte o conteúdo com visual rico e publique quando estiver pronto.</p>
                </div>

                <button
                  v-if="editingId"
                  type="button"
                  class="rounded-full border border-white/10 px-4 py-2 text-sm text-white transition hover:border-white/30"
                  @click="resetForm"
                >
                  Limpar editor
                </button>
              </div>

              <form class="mt-8 grid gap-5" @submit.prevent="handleSubmit">
                <div class="grid gap-5 lg:grid-cols-[1.1fr_0.9fr]">
                  <label class="grid gap-2">
                    <span class="text-sm text-slate-300">Título</span>
                    <input v-model="form.title" type="text" class="input-field" required />
                  </label>

                  <label class="grid gap-2">
                    <span class="text-sm text-slate-300">Resumo</span>
                    <textarea v-model="form.excerpt" rows="3" class="input-field" required></textarea>
                  </label>
                </div>

                <div class="grid gap-4 lg:grid-cols-[1fr_auto]">
                  <label class="grid gap-2">
                    <span class="text-sm text-slate-300">Imagem de capa</span>
                    <input
                      v-model="form.coverImage"
                      type="text"
                      class="input-field"
                      placeholder="/api/uploads/minha-imagem.jpg ou https://dominio.com/imagem.jpg"
                    />
                  </label>

                  <label class="grid gap-2">
                    <span class="text-sm text-slate-300">Upload simples</span>
                    <input type="file" accept="image/*" class="input-field file:mr-3 file:rounded-full file:border-0 file:bg-cyan-400 file:px-4 file:py-2 file:text-sm file:font-medium file:text-slate-950" @change="handleImageUpload" />
                  </label>
                </div>

                <img v-if="form.coverImage" :src="form.coverImage" alt="Prévia da capa" class="max-h-64 rounded-2xl border border-white/10 object-cover shadow-2xl shadow-slate-950/30" />

                <label class="grid gap-2">
                  <span class="text-sm text-slate-300">Conteúdo</span>
                  <div class="quill-surface quill-surface--dark">
                    <QuillEditor
                      v-model:content="form.content"
                      content-type="html"
                      theme="snow"
                      toolbar="full"
                    />
                  </div>
                </label>

                <label class="flex items-center gap-3 text-slate-300">
                  <input v-model="form.published" type="checkbox" class="h-4 w-4 rounded border-white/20 bg-slate-950 text-cyan-400" />
                  Publicar imediatamente
                </label>

                <div class="flex flex-wrap gap-3 pt-2">
                  <button type="submit" class="rounded-full bg-cyan-400 px-5 py-3 text-sm font-medium text-slate-950 transition hover:bg-cyan-300">
                    {{ saving ? 'Salvando...' : editingId ? 'Atualizar post' : 'Criar post' }}
                  </button>
                  <button
                    type="button"
                    class="rounded-full border border-white/10 px-5 py-3 text-sm text-white transition hover:border-white/30"
                    @click="showPostsPanel"
                  >
                    Voltar para posts
                  </button>
                </div>

                <p v-if="feedback" class="text-sm text-cyan-200">{{ feedback }}</p>
                <p v-if="errorMessage" class="text-sm text-rose-300">{{ errorMessage }}</p>
              </form>
            </div>

            <div v-else key="credentials" class="surface-card admin-panel p-6">
              <h2 class="text-2xl font-semibold text-white">Credenciais administrativas</h2>
              <p class="mt-2 text-slate-400">Atualize login, senha e confirmação de senha sem sair do painel.</p>

              <form class="mt-8 grid gap-4" @submit.prevent="handleAccountUpdate">
                <label class="grid gap-2">
                  <span class="text-sm text-slate-300">Login / e-mail</span>
                  <input v-model="accountForm.email" type="email" class="input-field" autocomplete="username" required />
                </label>

                <label class="grid gap-2">
                  <span class="text-sm text-slate-300">Senha atual</span>
                  <input v-model="accountForm.currentPassword" type="password" class="input-field" autocomplete="current-password" required />
                </label>

                <div class="grid gap-4 md:grid-cols-2">
                  <label class="grid gap-2">
                    <span class="text-sm text-slate-300">Nova senha</span>
                    <input v-model="accountForm.password" type="password" class="input-field" autocomplete="new-password" />
                  </label>

                  <label class="grid gap-2">
                    <span class="text-sm text-slate-300">Confirmar nova senha</span>
                    <input v-model="accountForm.passwordConfirmation" type="password" class="input-field" autocomplete="new-password" />
                  </label>
                </div>

                <button type="submit" class="rounded-full border border-cyan-300/30 bg-cyan-400/10 px-5 py-3 text-sm font-medium text-cyan-200 transition hover:bg-cyan-400/15">
                  {{ updatingAccount ? 'Salvando credenciais...' : 'Salvar credenciais' }}
                </button>

                <p v-if="accountFeedback" class="text-sm text-cyan-200">{{ accountFeedback }}</p>
                <p v-if="accountError" class="text-sm text-rose-300">{{ accountError }}</p>
              </form>
            </div>
          </transition>
        </section>
      </div>
    </SectionBlock>
  </main>
</template>

<script setup>
import { QuillEditor } from '@vueup/vue-quill'
import { onMounted, reactive, ref, watch } from 'vue'

import SectionBlock from '@/components/SectionBlock.vue'
import { fetchProfile, login, logout, updateAccount, uploadImage } from '@/services/authApi'
import { createPost, deletePost, listPosts, updatePost } from '@/services/blogApi'

const menuItems = [
  { id: 'posts', label: 'Posts salvos', icon: 'bx bx-collection' },
  { id: 'editor', label: 'Editor', icon: 'bx bx-edit-alt' },
  { id: 'credentials', label: 'Credenciais', icon: 'bx bx-lock-alt' },
]

const posts = ref([])
const saving = ref(false)
const authLoading = ref(false)
const updatingAccount = ref(false)
const editingId = ref(null)
const activePanel = ref('posts')
const feedback = ref('')
const errorMessage = ref('')
const authError = ref('')
const accountFeedback = ref('')
const accountError = ref('')
const isAuthenticated = ref(false)
const isMobileSidebarOpen = ref(false)

const loginForm = reactive({
  email: '',
  password: '',
})

const form = reactive({
  title: '',
  excerpt: '',
  content: '',
  coverImage: '',
  published: true,
})

const accountForm = reactive({
  email: '',
  currentPassword: '',
  password: '',
  passwordConfirmation: '',
})

function resetForm() {
  editingId.value = null
  form.title = ''
  form.excerpt = ''
  form.content = ''
  form.coverImage = ''
  form.published = true
  feedback.value = ''
  errorMessage.value = ''
}

function resetAccountMessages() {
  accountFeedback.value = ''
  accountError.value = ''
}

function toggleMobileSidebar() {
  isMobileSidebarOpen.value = !isMobileSidebarOpen.value
}

function closeMobileSidebar() {
  isMobileSidebarOpen.value = false
}

function handleMenuSelection(panel) {
  activePanel.value = panel
  feedback.value = ''
  errorMessage.value = ''
  closeMobileSidebar()
}

function showPostsPanel() {
  activePanel.value = 'posts'
}

async function bootstrapAdmin() {
  try {
    const profile = await fetchProfile()
    isAuthenticated.value = true
    accountForm.email = profile.email
    await loadPosts()
  } catch (error) {
    isAuthenticated.value = false
  }
}

async function handleLogin() {
  authLoading.value = true
  authError.value = ''

  try {
    const data = await login(loginForm.email, loginForm.password)
    isAuthenticated.value = true
    accountForm.email = data.admin.email
    accountForm.currentPassword = ''
    activePanel.value = 'posts'
    await loadPosts()
  } catch (error) {
    authError.value = error.message
  } finally {
    authLoading.value = false
  }
}

function handleLogout() {
  logout()
  isAuthenticated.value = false
  posts.value = []
  activePanel.value = 'posts'
  closeMobileSidebar()
  resetForm()
  loginForm.email = ''
  loginForm.password = ''
  accountForm.currentPassword = ''
  accountForm.password = ''
  accountForm.passwordConfirmation = ''
}

async function loadPosts() {
  posts.value = await listPosts({ admin: true })
}

function startEdit(post) {
  editingId.value = post.id
  form.title = post.title
  form.excerpt = post.excerpt
  form.content = post.content
  form.coverImage = post.coverImage || ''
  form.published = post.published
  feedback.value = ''
  errorMessage.value = ''
  activePanel.value = 'editor'
  closeMobileSidebar()
}

async function handleImageUpload(event) {
  const [file] = event.target.files || []
  if (!file) {
    return
  }

  try {
    const uploaded = await uploadImage(file)
    form.coverImage = uploaded.path
    feedback.value = 'Imagem enviada com sucesso.'
  } catch (error) {
    errorMessage.value = error.message
  } finally {
    event.target.value = ''
  }
}

async function handleSubmit() {
  saving.value = true
  feedback.value = ''
  errorMessage.value = ''

  try {
    const payload = {
      title: form.title,
      excerpt: form.excerpt,
      content: form.content,
      coverImage: form.coverImage,
      published: form.published,
    }

    if (editingId.value) {
      await updatePost(editingId.value, payload)
      feedback.value = 'Post atualizado com sucesso.'
    } else {
      await createPost(payload)
      feedback.value = 'Post criado com sucesso.'
    }

    resetForm()
    await loadPosts()
    activePanel.value = 'posts'
  } catch (error) {
    errorMessage.value = error.message
  } finally {
    saving.value = false
  }
}

async function handleDelete(id) {
  if (!window.confirm('Deseja excluir este post?')) {
    return
  }

  try {
    await deletePost(id)
    if (editingId.value === id) {
      resetForm()
      activePanel.value = 'posts'
    }
    await loadPosts()
  } catch (error) {
    errorMessage.value = error.message
  }
}

async function handleAccountUpdate() {
  updatingAccount.value = true
  resetAccountMessages()

  try {
    const profile = await updateAccount({
      email: accountForm.email,
      currentPassword: accountForm.currentPassword,
      password: accountForm.password,
      passwordConfirmation: accountForm.passwordConfirmation,
    })

    accountForm.email = profile.email
    accountForm.currentPassword = ''
    accountForm.password = ''
    accountForm.passwordConfirmation = ''
    loginForm.email = ''
    loginForm.password = ''
    accountFeedback.value = 'Credenciais atualizadas com sucesso.'
  } catch (error) {
    accountError.value = error.message
  } finally {
    updatingAccount.value = false
  }
}

watch(isMobileSidebarOpen, (open) => {
  document.body.style.overflow = open ? 'hidden' : ''
})

onMounted(bootstrapAdmin)
</script>
