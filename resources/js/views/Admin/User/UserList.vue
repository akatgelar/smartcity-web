<template>
    <AdminLayout>
        <PageBreadcrumb parent-page="User" parent-link="/admin/user" child-page="List" child-link="" page-title=""/>

        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="flex flex-col justify-between gap-5 border-gray-200 px-5 py-4 sm:flex-row sm:items-center dark:border-gray-800">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        User List
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                    </p>
                </div>
                <div class="flex gap-3">
                    <router-link to="/admin/user/add" class="bg-brand-500 shadow-theme-xs hover:bg-brand-600 inline-flex items-center justify-center gap-2 rounded-lg px-4 py-3 text-sm font-medium text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M5 10.0002H15.0006M10.0002 5V15.0006" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        Add Data
                    </router-link>
                </div>
            </div>
            <div class="px-5">

                <div class="overflow-hidden pb-4">
                    <div class="flex flex-col gap-2 py-4 rounded-b-none border-b-0 px-4 sm:flex-row sm:items-center rounded-xl border border-gray-100 sm:justify-between dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="flex items-center gap-3">
                            <span class="text-gray-500 dark:text-gray-400">Show</span>
                            <div class="relative">
                                <select
                                    v-model="perPage"
                                    @change="handlePerPage"
                                    class="w-full py-2 pl-3 pr-8 text-sm text-gray-800 bg-transparent border border-gray-300 rounded-lg appearance-none dark:bg-dark-900 h-9 bg-none shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <span
                                    class="absolute z-30 text-gray-500 -translate-y-1/2 right-2 top-1/2 dark:text-gray-400">
                                    <svg class="stroke-current" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.8335 5.9165L8.00016 10.0832L12.1668 5.9165" stroke="" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </div>
                            <span class="text-gray-500 dark:text-gray-400">entries</span>
                        </div>
                        <div class="relative">
                            <input
                                type="text"
                                v-model="search"
                                @input="handleSearch"
                                placeholder="Search..."
                                class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pl-11 pr-4 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800 xl:w-[300px]"/>
                            <button
                                class="absolute text-gray-500 -translate-y-1/2 left-4 top-1/2 dark:text-gray-400">
                                <svg
                                    class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.04199 9.37363C3.04199 5.87693 5.87735 3.04199 9.37533 3.04199C12.8733 3.04199 15.7087 5.87693 15.7087 9.37363C15.7087 12.8703 12.8733 15.7053 9.37533 15.7053C5.87735 15.7053 3.04199 12.8703 3.04199 9.37363ZM9.37533 1.54199C5.04926 1.54199 1.54199 5.04817 1.54199 9.37363C1.54199 13.6991 5.04926 17.2053 9.37533 17.2053C11.2676 17.2053 13.0032 16.5344 14.3572 15.4176L17.1773 18.238C17.4702 18.5309 17.945 18.5309 18.2379 18.238C18.5308 17.9451 18.5309 17.4703 18.238 17.1773L15.4182 14.3573C16.5367 13.0033 17.2087 11.2669 17.2087 9.37363C17.2087 5.04817 13.7014 1.54199 9.37533 1.54199Z" fill=""></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="max-w-full overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-4 py-3 border border-gray-100 dark:border-white/[0.05] text-left" @click="handleSort('id')">
                                        <div class="flex items-center justify-between w-full cursor-pointer">
                                            <p class="font-medium text-gray-700 dark:text-gray-400">ID</p>
                                            <TableSort :sort-by="sortBy" :sort-order="sortOrder" value-sort="id"></TableSort>
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 border border-gray-100 dark:border-white/[0.05] text-left" @click="handleSort('name')">
                                        <div class="flex items-center justify-between w-full cursor-pointer">
                                            <p class="font-medium text-gray-700 dark:text-gray-400">Name</p>
                                            <TableSort :sort-by="sortBy" :sort-order="sortOrder" value-sort="name"></TableSort>
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 border border-gray-100 dark:border-white/[0.05] text-left" @click="handleSort('email')">
                                        <div class="flex items-center justify-between w-full cursor-pointer">
                                            <p class="font-medium text-gray-700 dark:text-gray-400">Email</p>
                                            <TableSort :sort-by="sortBy" :sort-order="sortOrder" value-sort="email"></TableSort>
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 border border-gray-100 dark:border-white/[0.05] text-left" @click="handleSort('last_login')">
                                        <div class="flex items-center justify-between w-full cursor-pointer">
                                            <p class="font-medium text-gray-700 dark:text-gray-400">Last Login</p>
                                            <TableSort :sort-by="sortBy" :sort-order="sortOrder" value-sort="last_login"></TableSort>
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 border border-gray-100 dark:border-white/[0.05] text-left" @click="handleSort('is_active')">
                                        <div class="flex cursor-pointer">
                                            <p class="font-medium text-gray-700 dark:text-gray-400 text-center w-full">Active</p>
                                            <TableSort :sort-by="sortBy" :sort-order="sortOrder" value-sort="is_active" class="text-right"></TableSort>
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 border border-gray-100 dark:border-white/[0.05] text-left" @click="handleSort('created_at')">
                                        <div class="flex cursor-pointer">
                                            <p class="font-medium text-gray-700 dark:text-gray-400 text-center w-full">Action</p>
                                            <TableSort :sort-by="sortBy" :sort-order="sortOrder" value-sort="created_at"></TableSort>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-t border-gray-100 dark:border-white/[0.5]" v-for="item in items" :key="item.id">
                                    <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05]">{{ item.id }}</td>
                                    <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05]">{{ item.name }}</td>
                                    <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05]">{{ item.email }}</td>
                                    <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05]">{{ convertDateTimeIndo(item.last_login) }}</td>
                                    <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05] text-center">
                                        <span v-if="item.is_active == 1" class="inline-flex items-center px-2.5 py-0.5 justify-center gap-1 rounded-full font-medium capitalize text-sm bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500">Active</span>
                                        <span v-else-if="item.is_active == 0" class="inline-flex items-center px-2.5 py-0.5 justify-center gap-1 rounded-full font-medium capitalize text-sm bg-error-50 text-error-600 dark:bg-error-500/15 dark:text-error-500">Not Active</span>
                                    </td>
                                    <td class="px-4 py-3 border border-gray-100 dark:border-white/[0.05] text-center">
                                        <router-link :to="`/admin/user/detail/${item.id}`" class="shadow-theme-xs inline-flex h-8 w-10 items-center justify-center rounded-lg border border-gray-300 text-blue-light-500 hover:text-blue-light-700 dark:text-blue-light-400 dark:hover:text-blue-light/90 mr-2">
                                            <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.04175 9.37363C3.04175 5.87693 5.87711 3.04199 9.37508 3.04199C12.8731 3.04199 15.7084 5.87693 15.7084 9.37363C15.7084 12.8703 12.8731 15.7053 9.37508 15.7053C5.87711 15.7053 3.04175 12.8703 3.04175 9.37363ZM9.37508 1.54199C5.04902 1.54199 1.54175 5.04817 1.54175 9.37363C1.54175 13.6991 5.04902 17.2053 9.37508 17.2053C11.2674 17.2053 13.003 16.5344 14.357 15.4176L17.177 18.238C17.4699 18.5309 17.9448 18.5309 18.2377 18.238C18.5306 17.9451 18.5306 17.4703 18.2377 17.1774L15.418 14.3573C16.5365 13.0033 17.2084 11.2669 17.2084 9.37363C17.2084 5.04817 13.7011 1.54199 9.37508 1.54199Z"></path>
                                            </svg>
                                        </router-link>

                                        <router-link :to="`/admin/user/edit/${item.id}`" class="shadow-theme-xs inline-flex h-8 w-10 items-center justify-center rounded-lg border border-gray-300 text-yellow-500 hover:text-yellow-700 dark:text-yellow-400 dark:hover:text-yellow/90  mr-2">
                                            <svg class="fill-current" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.0911 3.53206C16.2124 2.65338 14.7878 2.65338 13.9091 3.53206L5.6074 11.8337C5.29899 12.1421 5.08687 12.5335 4.99684 12.9603L4.26177 16.445C4.20943 16.6931 4.286 16.9508 4.46529 17.1301C4.64458 17.3094 4.90232 17.3859 5.15042 17.3336L8.63507 16.5985C9.06184 16.5085 9.45324 16.2964 9.76165 15.988L18.0633 7.68631C18.942 6.80763 18.942 5.38301 18.0633 4.50433L17.0911 3.53206ZM14.9697 4.59272C15.2626 4.29982 15.7375 4.29982 16.0304 4.59272L17.0027 5.56499C17.2956 5.85788 17.2956 6.33276 17.0027 6.62565L16.1043 7.52402L14.0714 5.49109L14.9697 4.59272ZM13.0107 6.55175L6.66806 12.8944C6.56526 12.9972 6.49455 13.1277 6.46454 13.2699L5.96704 15.6283L8.32547 15.1308C8.46772 15.1008 8.59819 15.0301 8.70099 14.9273L15.0436 8.58468L13.0107 6.55175Z" fill=""></path>
                                            </svg>
                                        </router-link>

                                        <button @click="deleteData(item.id)" class="shadow-theme-xs inline-flex h-8 w-10 items-center justify-center rounded-lg border border-gray-300 text-error-500 hover:text-error-700 dark:text-error-400 dark:hover:text-error/90  mr-2">
                                            <svg class="fill-current" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.04142 4.29199C7.04142 3.04935 8.04878 2.04199 9.29142 2.04199H11.7081C12.9507 2.04199 13.9581 3.04935 13.9581 4.29199V4.54199H16.1252H17.166C17.5802 4.54199 17.916 4.87778 17.916 5.29199C17.916 5.70621 17.5802 6.04199 17.166 6.04199H16.8752V8.74687V13.7469V16.7087C16.8752 17.9513 15.8678 18.9587 14.6252 18.9587H6.37516C5.13252 18.9587 4.12516 17.9513 4.12516 16.7087V13.7469V8.74687V6.04199H3.8335C3.41928 6.04199 3.0835 5.70621 3.0835 5.29199C3.0835 4.87778 3.41928 4.54199 3.8335 4.54199H4.87516H7.04142V4.29199ZM15.3752 13.7469V8.74687V6.04199H13.9581H13.2081H7.79142H7.04142H5.62516V8.74687V13.7469V16.7087C5.62516 17.1229 5.96095 17.4587 6.37516 17.4587H14.6252C15.0394 17.4587 15.3752 17.1229 15.3752 16.7087V13.7469ZM8.54142 4.54199H12.4581V4.29199C12.4581 3.87778 12.1223 3.54199 11.7081 3.54199H9.29142C8.87721 3.54199 8.54142 3.87778 8.54142 4.29199V4.54199ZM8.8335 8.50033C9.24771 8.50033 9.5835 8.83611 9.5835 9.25033V14.2503C9.5835 14.6645 9.24771 15.0003 8.8335 15.0003C8.41928 15.0003 8.0835 14.6645 8.0835 14.2503V9.25033C8.0835 8.83611 8.41928 8.50033 8.8335 8.50033ZM12.9168 9.25033C12.9168 8.83611 12.581 8.50033 12.1668 8.50033C11.7526 8.50033 11.4168 8.83611 11.4168 9.25033V14.2503C11.4168 14.6645 11.7526 15.0003 12.1668 15.0003C12.581 15.0003 12.9168 14.6645 12.9168 14.2503V9.25033Z" fill=""></path>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="border-t-0 border rounded-b-xl border-gray-100 py-4 pl-[18px] pr-4 dark:border-white/[0.05]">
                        <TablePagination
                            :page="page"
                            :perPage="perPage"
                            :totalData="totalData"
                            @update:page="(newPage: number) => { page = newPage; fetchData(); }"
                        />
                    </div>
                </div>

            </div>
        </div>

    </AdminLayout>
</template>

<script setup lang="ts">
import { onMounted, ref, watch } from 'vue';
import AdminLayout from '../../../components/layout/AdminLayout.vue'
import PageBreadcrumb from '../../../components/common/PageBreadcrumb.vue'
import TableSort from '../../../components/ui/TableSort.vue';
import TablePagination from '../../../components/ui/TablePagination.vue';
import { showLoading } from '../../../helpers/AlertHelper';
import { convertDateTimeIndo } from '../../../helpers/ConverterHelper';
import { getSession } from '../../../helpers/SessionHelper';
import { UserModel } from '../../../interfaces/UserModel'
import debounce from 'lodash/debounce'
import axios from 'axios';
import Swal from 'sweetalert2'

// variable for table
const page = ref(1);
const perPage = ref(10);
const totalData = ref(0);
const sortBy = ref('id');
const sortOrder = ref('asc');
const search = ref('');
const items = ref<UserModel[] | null>(null);

onMounted(() => {
  fetchData();
});

const fetchData = async () => {
    showLoading()

    axios.get(`/api/user?per_page=${perPage.value}&page=${page.value}&sort=${sortBy.value}:${sortOrder.value}&search=${search.value}`,
        {headers: {'Authorization': `Bearer ${getSession().token}`}}
    )
    .then(response => {
        Swal.close()
        const result = response.data;
        if(result['status']) {
            items.value = result.data;
            totalData.value = result.metadata.total_data;
        } else {
            Swal.fire({
                icon: 'error',
                text: result['message'],
            })
        }
    })
    .catch(error => {
        Swal.close()
        if (typeof error.response.data === 'object') {
            Swal.fire({
                icon: 'error',
                text: error.response.data.message,
            })
        } else {
            Swal.fire({
                icon: 'error',
                text: error.message,
            })
        }
    });
};

const handleSearch = debounce(() => {
    page.value = 1;
    fetchData();
}, 500)

const handlePerPage = () => {
    page.value = 1;
    fetchData();
};

const handleSort = (column: string) => {
    if (sortBy.value === column) {
        sortOrder.value = sortOrder.value === 'asc' ? 'desc' : 'asc';
    } else {
        sortBy.value = column;
        sortOrder.value = 'asc';
    }
    fetchData();
};

const deleteData = async (id: number) => {
    Swal.fire({
        text: "Are you sure, want to delete this data?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            showLoading()

            axios.delete(`/api/user/${id}`,
                {headers: {'Authorization': `Bearer ${getSession().token}`}}
            )
            .then(response => {
                const result = response.data;
                Swal.fire({
                    icon: 'info',
                    text: result['message'],
                }).then(()=> {
                    fetchData();
                })
            })
        }
    });
}

watch([page, sortBy, sortOrder], fetchData);

</script>
