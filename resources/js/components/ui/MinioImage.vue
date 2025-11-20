
<template>
    <img
      v-if="imageUrl"
      :src="imageUrl"
      :alt="alt"
      :width="width"
      :height="height"
      class="object-cover"
      :style="{width: width + 'px', height: height + 'px', objectFit: 'cover',}"
    />
    <p v-else>Loading image...</p>
</template>

<script setup lang="ts">
import { ref, onMounted, watch } from "vue";
import axios from "axios";

// Props
const props = defineProps<{
  path: string;
  alt?: string;
  width?: number;
  height?: number;
}>();
const imageUrl = ref<string | null>(null);

const loadImage = async () => {
    const response = await axios.get(`/api/minio/get?path=${props.path}`);
    imageUrl.value = response.data['data'];
};

onMounted(loadImage);
watch(() => props.path, loadImage);
</script>
