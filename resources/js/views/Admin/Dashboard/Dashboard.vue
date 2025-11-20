<template>
  <admin-layout>
    <div class="grid grid-cols-12 gap-4 md:gap-6">
      <div class="col-span-12 space-y-6 xl:col-span-7">
        <ecommerce-metrics />
        <monthly-target />
      </div>
      <div class="col-span-12 xl:col-span-5">
        <monthly-sale />
      </div>

      <div class="col-span-12">
        <statistics-chart />
      </div>

      <div class="col-span-12 xl:col-span-5">
        <customer-demographic />
      </div>

      <div class="col-span-12 xl:col-span-7">
        <recent-orders />
      </div>
    </div>
  </admin-layout>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue'
import { showLoading } from '../../../helpers/AlertHelper';
import Swal from 'sweetalert2'

import AdminLayout from '../../../components/layout/AdminLayout.vue'
import EcommerceMetrics from './EcommerceMetrics.vue'
import MonthlyTarget from './MonthlySale.vue'
import MonthlySale from './MonthlyTarget.vue'
import CustomerDemographic from './CustomerDemographic.vue'
import StatisticsChart from './StatisticsChart.vue'
import RecentOrders from './RecentOrders.vue'


onMounted(() => {
})

</script>
