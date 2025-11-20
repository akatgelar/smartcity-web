<template>
  <div class="relative" ref="dropdownRef">
    <button
      class="flex items-center text-gray-700 dark:text-gray-400"
      @click.prevent="toggleDropdown"
    >
      <span class="mr-2 overflow-hidden rounded-full h-11 w-11">
        <MinioImage v-if="appSession['picture']" :path="appSession['picture']" alt="Logo" :width="44" :height="44" />
      </span>

      <span class="block mr-1 font-large text-theme-sm text-transform: capitalize" > {{ appSession.name }} </span>

      <ChevronDownIcon :class="{ 'rotate-180': dropdownOpen }" />
    </button>

    <!-- Dropdown Start -->
    <div
      v-if="dropdownOpen"
      class="absolute right-0 mt-[17px] flex w-[260px] flex-col rounded-2xl border border-gray-200 bg-white p-3 shadow-theme-lg dark:border-gray-800 dark:bg-gray-dark"
    >
      <div class="m-3">
        <span class="block font-medium text-gray-700 text-theme-sm dark:text-gray-400 text-transform: capitalize">
          {{ appSession.name }}
        </span>
        <span class="mt-0.5 block text-theme-xs text-gray-500 dark:text-gray-400">
          {{ appSession.email }}
        </span>
        <span class="mt-0.5 block text-theme-xs text-gray-500 dark:text-gray-400">
          ({{ appSession.user_level_name }})
        </span>
      </div>

      <ul class="flex flex-col gap-1 pb-3 border-gray-200 dark:border-gray-800">
        <li>
            <router-link
                to="/admin/profile"
                class="flex items-center gap-3 px-3 py-2 font-medium text-gray-700 rounded-lg group text-theme-sm hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300"
            >
                <UserCircleIcon
                    class="text-gray-500 group-hover:text-gray-700 dark:group-hover:text-gray-300"
                />
                Edit Profile
            </router-link>
        </li>
        <li>
            <router-link
                to="/auth/logout"
                class="flex items-center gap-3 px-3 py-2 font-medium text-gray-700 rounded-lg group text-theme-sm hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300"
            >
                <LogoutIcon
                class="text-gray-500 group-hover:text-gray-700 dark:group-hover:text-gray-300"
                />
                Sign out
            </router-link>
        </li>
      </ul>
    </div>
    <!-- Dropdown End -->
  </div>
</template>

<script setup lang="ts">
import { UserCircleIcon, ChevronDownIcon, LogoutIcon, SettingsIcon, InfoCircleIcon } from '../../../icons'
import { RouterLink } from 'vue-router'
import { ref, onMounted, onUnmounted } from 'vue'
import { getSession } from '../../../helpers/SessionHelper';
import MinioImage from "../../ui/MinioImage.vue";

const dropdownOpen = ref(false)
// const dropdownRef = ref(null)
const dropdownRef = ref<HTMLElement | null>(null)
const appSession = ref(getSession());

const toggleDropdown = () => {
  dropdownOpen.value = !dropdownOpen.value
}

const closeDropdown = () => {
  dropdownOpen.value = false
}

const handleClickOutside = (event: any) => {
  if (dropdownRef.value && !dropdownRef.value.contains(event.target)) {
    closeDropdown()
  }
}

onMounted(() => {
    document.addEventListener('click', handleClickOutside)
})

onUnmounted(() => {
    document.removeEventListener('click', handleClickOutside)
})
</script>
