<template>
  <slot></slot>
</template>

<script setup lang="ts">
import { useSidebarProvider } from '../useSidebar'

useSidebarProvider()
</script>
