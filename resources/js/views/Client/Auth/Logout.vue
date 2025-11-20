<template>
</template>

<script setup lang="ts">
import { onMounted } from 'vue'
import { useRouter } from 'vue-router';

const router = useRouter();

onMounted(() => {
    localStorage.clear()
    router.push('/auth/login');
})

</script>
