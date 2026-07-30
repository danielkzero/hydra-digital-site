<template>
  <div class="grid gap-6 lg:grid-cols-[1.4fr_1fr]">
    <div class="surface-card p-8">
      <p class="section-eyebrow">Contato</p>
      <h3 class="mt-3 text-2xl font-semibold text-white">{{ contactTitle }}</h3>
      <p class="mt-3 max-w-2xl text-slate-300">
        Parcerias, novos produtos e melhorias em sistemas existentes podem ser tratados direto pelos canais abaixo.
      </p>
      <div class="mt-8 grid gap-4">
        <div
          v-for="info in contactInfo"
          :key="info.id"
          class="flex items-start gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 text-slate-200"
        >
          <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-cyan-400/10 text-cyan-300">
            <i :class="info.icon" class="text-xl"></i>
          </span>
          <div>
            <p class="text-sm uppercase tracking-[0.2em] text-slate-400">{{ info.label }}</p>
            <a
              v-if="info.href"
              :href="info.href"
              class="mt-1 inline-block text-base text-white transition hover:text-cyan-300"
            >
              {{ info.value }}
            </a>
            <p v-else class="mt-1 text-base text-white">{{ info.value }}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="surface-card flex flex-col justify-between p-8">
      <div>
        <p class="section-eyebrow">Canais</p>
        <h3 class="mt-3 text-2xl font-semibold text-white">{{ socialTitle }}</h3>
        <p class="mt-3 text-slate-300">
          Acompanhe publicacoes, apps ativos e novos lancamentos.
        </p>
      </div>

      <div class="mt-8 grid gap-3">
        <a
          v-for="social in socialLinks"
          :key="social.id"
          :href="social.href"
          target="_blank"
          rel="noreferrer"
          class="flex items-center justify-between rounded-2xl border border-white/10 bg-white/5 px-4 py-4 text-white transition hover:border-cyan-300/40 hover:bg-cyan-400/10 hover:text-cyan-200"
        >
          <span class="flex items-center gap-3">
            <i :class="social.icon" class="text-2xl"></i>
            {{ social.label }}
          </span>
          <i class="bx bx-up-right-arrow-alt text-xl"></i>
        </a>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  contactTitle: {
    type: String,
    default: 'Informacoes de contato',
  },
  socialTitle: {
    type: String,
    default: 'Redes sociais',
  },
  contactInfo: {
    type: Array,
    default: () => [],
  },
  socialLinks: {
    type: Array,
    default: () => [],
  },
})
</script>
