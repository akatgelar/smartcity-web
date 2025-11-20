<template>
  <router-link to="/" class="lg:hidden flex">
    <!-- <img class="dark:hidden" src="/resources/images/logo/logo.svg" alt="Logo" />
    <img class="hidden dark:block" src="/resources/images/logo/logo-dark.svg" alt="Logo" /> -->
    <MinioImage v-if="appSetting['logo']" :path="appSetting['logo']" alt="Logo" :width="40" :height="40" />
    <h1 class="text-black text-xl my-auto pl-3">{{ appSetting['title'] }}</h1>
  </router-link>
</template>

<script setup lang="ts">
import { ref, computed } from "vue";
import { RouterLink } from 'vue-router'
import MinioImage from "../../ui/MinioImage.vue";
const appSetting = ref(window['appSetting'])
</script>
