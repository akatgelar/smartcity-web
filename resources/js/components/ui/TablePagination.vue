<template>
  <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between">
    <div>
      Showing {{ startEntry }} to {{ endEntry }} of {{ totalData }} entries
    </div>
    <div class="flex items-center justify-center gap-0.5 xl:justify-normal xl:pt-0">
      <button
        class="h-10 px-3.5 py-auto rounded-lg border text-gray-700 bg-white shadow hover:bg-brand-500 hover:text-white disabled:opacity-50"
        @click="goToPage(1)"
        :disabled="page === 1"
      >
        First
      </button>

      <button
        class="h-10 px-3.5 py-auto rounded-lg border text-gray-700 bg-white shadow hover:bg-brand-500 hover:text-white disabled:opacity-50"
        @click="prevPage"
        :disabled="page === 1"
      >
        Previous
      </button>

      <button
        v-for="pageNumber in visiblePages"
        :key="pageNumber"
        @click="goToPage(pageNumber)"
        :class="[
          'h-10 w-10 rounded-lg border px-3.5 py-2.5 text-sm shadow',
          page === pageNumber
            ? 'bg-brand-500 hover:bg-brand-600 text-white hover:text-white'
            : 'bg-white hover:bg-brand-500 text-gray-700 hover:text-white'
        ]"
      >
        {{ pageNumber }}
      </button>

      <button
        class="h-10 px-3.5 py-auto rounded-lg border text-gray-700 bg-white shadow hover:bg-brand-500 hover:text-white disabled:opacity-50"
        @click="nextPage"
        :disabled="page === totalPage"
      >
        Next
      </button>

      <button
        class="h-10 px-3.5 py-auto rounded-lg border text-gray-700 bg-white shadow hover:bg-brand-500 hover:text-white disabled:opacity-50"
        @click="goToPage(totalPage)"
        :disabled="page === totalPage"
      >
        Last
      </button>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps<{
  page: number,
  perPage: number,
  totalData: number,
}>();

const emit = defineEmits(['update:page']);

const totalPage = computed(() => Math.ceil(props.totalData / props.perPage));
const startEntry = computed(() => (props.page - 1) * props.perPage + 1);
const endEntry = computed(() => Math.min(props.page * props.perPage, props.totalData));

const prevPage = () => {
  if (props.page > 1) emit('update:page', props.page - 1);
};

const nextPage = () => {
  if (props.page < totalPage.value) emit('update:page', props.page + 1);
};

const goToPage = (pageNumber: number) => {
  emit('update:page', pageNumber);
};

// Menentukan halaman yang ditampilkan (maksimal 3)
const visiblePages = computed(() => {
  const pages : number[] = [];
  const current = props.page;
  const last = totalPage.value;

  if (last <= 3) {
    for (let i = 1; i <= last; i++) pages.push(i);
  } else {
    if (current === 1) {
      pages.push(1, 2, 3);
    } else if (current === last) {
      pages.push(last - 2, last - 1, last);
    } else {
      pages.push(current - 1, current, current + 1);
    }
  }

  return pages.filter(p => p >= 1 && p <= last);
});
</script>
