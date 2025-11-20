<template>
    <AdminLayout>
        <PageBreadcrumb parent-page="User Level" parent-link="/admin/user-level" child-page="Detail" child-link="" page-title=""/>

        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="flex flex-col justify-between gap-5 border-gray-200 px-5 py-4 sm:flex-row sm:items-center dark:border-gray-800">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        User Level Detail
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                    </p>
                </div>
                <div class="flex gap-3">
                    <router-link :to="`/admin/user-level/edit/${route.params.id}`" class="shadow-theme-xs inline-flex py-3 px-4 items-center justify-center rounded-lg border border-gray-300 text-yellow-500 hover:text-yellow-700 dark:text-yellow-400 dark:hover:text-yellow/90 mr-2 gap-2 text-sm font-medium ">
                        <svg class="fill-current" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M17.0911 3.53206C16.2124 2.65338 14.7878 2.65338 13.9091 3.53206L5.6074 11.8337C5.29899 12.1421 5.08687 12.5335 4.99684 12.9603L4.26177 16.445C4.20943 16.6931 4.286 16.9508 4.46529 17.1301C4.64458 17.3094 4.90232 17.3859 5.15042 17.3336L8.63507 16.5985C9.06184 16.5085 9.45324 16.2964 9.76165 15.988L18.0633 7.68631C18.942 6.80763 18.942 5.38301 18.0633 4.50433L17.0911 3.53206ZM14.9697 4.59272C15.2626 4.29982 15.7375 4.29982 16.0304 4.59272L17.0027 5.56499C17.2956 5.85788 17.2956 6.33276 17.0027 6.62565L16.1043 7.52402L14.0714 5.49109L14.9697 4.59272ZM13.0107 6.55175L6.66806 12.8944C6.56526 12.9972 6.49455 13.1277 6.46454 13.2699L5.96704 15.6283L8.32547 15.1308C8.46772 15.1008 8.59819 15.0301 8.70099 14.9273L15.0436 8.58468L13.0107 6.55175Z" fill=""></path>
                        </svg>
                        Edit Data
                    </router-link>

                    <button @click="deleteData(route.params.id)" class="shadow-theme-xs inline-flex py-3 px-4 items-center justify-center rounded-lg border border-gray-300 text-error-500 hover:text-error-700 dark:text-error-400 dark:hover:text-error/90 mr-2 gap-2 text-sm font-medium ">
                        <svg class="fill-current" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.04142 4.29199C7.04142 3.04935 8.04878 2.04199 9.29142 2.04199H11.7081C12.9507 2.04199 13.9581 3.04935 13.9581 4.29199V4.54199H16.1252H17.166C17.5802 4.54199 17.916 4.87778 17.916 5.29199C17.916 5.70621 17.5802 6.04199 17.166 6.04199H16.8752V8.74687V13.7469V16.7087C16.8752 17.9513 15.8678 18.9587 14.6252 18.9587H6.37516C5.13252 18.9587 4.12516 17.9513 4.12516 16.7087V13.7469V8.74687V6.04199H3.8335C3.41928 6.04199 3.0835 5.70621 3.0835 5.29199C3.0835 4.87778 3.41928 4.54199 3.8335 4.54199H4.87516H7.04142V4.29199ZM15.3752 13.7469V8.74687V6.04199H13.9581H13.2081H7.79142H7.04142H5.62516V8.74687V13.7469V16.7087C5.62516 17.1229 5.96095 17.4587 6.37516 17.4587H14.6252C15.0394 17.4587 15.3752 17.1229 15.3752 16.7087V13.7469ZM8.54142 4.54199H12.4581V4.29199C12.4581 3.87778 12.1223 3.54199 11.7081 3.54199H9.29142C8.87721 3.54199 8.54142 3.87778 8.54142 4.29199V4.54199ZM8.8335 8.50033C9.24771 8.50033 9.5835 8.83611 9.5835 9.25033V14.2503C9.5835 14.6645 9.24771 15.0003 8.8335 15.0003C8.41928 15.0003 8.0835 14.6645 8.0835 14.2503V9.25033C8.0835 8.83611 8.41928 8.50033 8.8335 8.50033ZM12.9168 9.25033C12.9168 8.83611 12.581 8.50033 12.1668 8.50033C11.7526 8.50033 11.4168 8.83611 11.4168 9.25033V14.2503C11.4168 14.6645 11.7526 15.0003 12.1668 15.0003C12.581 15.0003 12.9168 14.6645 12.9168 14.2503V9.25033Z" fill=""></path>
                        </svg>
                        Delete Data
                    </button>
                </div>
            </div>
            <div class="px-5">

                <div class="overflow-hidden pb-4 border-t border-gray-200">
                    <div class="gap-2 py-4 px-4 divide-y divide-gray-100 dark:divide-gray-800 ">
                        <li class="flex items-center gap-5 py-2.5 w-full">
                            <span class="w-1/5 text-gray-500 sm:w-1/5 dark:text-gray-400">ID</span>
                            <span class="w-4/5 font-medium text-gray-700 sm:w-4/5 dark:text-gray-400">{{ items?.id }}</span>
                        </li>
                        <li class="flex items-center gap-5 py-2.5">
                            <span class="w-1/5 text-gray-500 sm:w-1/5 dark:text-gray-400">Name</span>
                            <span class="w-4/5 font-medium text-gray-700 sm:w-4/5 dark:text-gray-400">{{ items?.name }}</span>
                        </li>
                        <li class="flex items-center gap-5 py-2.5">
                            <span class="w-1/5 text-gray-500 sm:w-1/5 dark:text-gray-400">Active</span>
                            <span class="w-4/5 font-medium text-gray-700 sm:w-4/5 dark:text-gray-400">
                                <span v-if="items?.is_active == 1" class="inline-flex items-center px-2.5 py-0.5 justify-center gap-1 rounded-full font-medium capitalize text-sm bg-success-50 text-success-600 dark:bg-success-500/15 dark:text-success-500">Active</span>
                                <span v-else-if="items?.is_active == 0" class="inline-flex items-center px-2.5 py-0.5 justify-center gap-1 rounded-full font-medium capitalize text-sm bg-error-50 text-error-600 dark:bg-error-500/15 dark:text-error-500">Not Active</span>
                            </span>
                        </li>
                        <li class="flex items-center gap-5 py-2.5">
                            <span class="w-1/5 text-gray-500 sm:w-1/5 dark:text-gray-400">Created At</span>
                            <span class="w-4/5 font-medium text-gray-700 sm:w-4/5 dark:text-gray-400">{{ convertDateTimeIndo(items?.created_at) }}</span>
                        </li>
                        <li class="flex items-center gap-5 py-2.5">
                            <span class="w-1/5 text-gray-500 sm:w-1/5 dark:text-gray-400">Updated At</span>
                            <span class="w-4/5 font-medium text-gray-700 sm:w-4/5 dark:text-gray-400">{{ convertDateTimeIndo(items?.updated_at) }}</span>
                        </li>
                    </div>
                </div>

            </div>
        </div>

    </AdminLayout>
</template>

<script lang="ts" setup>
import { onMounted, ref } from 'vue';
import AdminLayout from '../../../components/layout/AdminLayout.vue'
import PageBreadcrumb from '../../../components/common/PageBreadcrumb.vue'
import { showLoading } from '../../../helpers/AlertHelper';
import { convertDateTimeIndo } from '../../../helpers/ConverterHelper';
import { getSession } from '../../../helpers/SessionHelper';
import { UserLevelModel } from '../../../interfaces/UserLevelModel'
import axios from 'axios';
import Swal from 'sweetalert2'
import { useRouter } from 'vue-router'
import { useRoute } from 'vue-router';

const router = useRouter()
const route = useRoute();
const items = ref<UserLevelModel | null>(null);

onMounted(() => {
  fetchData();
});

const fetchData = async () => {
    showLoading()

    axios.get(`/api/user_level/${route.params.id}`,
        {headers: {'Authorization': `Bearer ${getSession().token}`}}
    )
    .then(response => {
        Swal.close()
        const result = response.data;
        if(result['status']) {
            items.value = result.data;
        } else {
            Swal.fire({
                icon: 'error',
                text: result['message'],
            })
        }
    })
    .catch(error => {
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

const deleteData = async (id: string| string[]) => {
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

            axios.delete(`/api/user_level/${id}`,
                {headers: {'Authorization': `Bearer ${getSession().token}`}}
            )
            .then(response => {
                const result = response.data;
                Swal.fire({
                    icon: 'info',
                    text: result['message'],
                }).then(()=> {
                    router.push('/admin/user-level')
                })
            })
        }
    });
}

</script>
