<template>
    <AdminLayout>
        <PageBreadcrumb parent-page="Setting" parent-link="/admin/setting" child-page="Edit" child-link="" page-title=""/>

        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="flex flex-col justify-between gap-5 border-gray-200 px-5 py-4 sm:flex-row sm:items-center dark:border-gray-800">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Setting Edit
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                    </p>
                </div>
                <div class="flex gap-3 py-3">
                    &nbsp;
                </div>
            </div>
            <div class="px-5 ">

                <div class="overflow-hidden pt-4 pb-4 border-t border-gray-200">
                    <form @submit.prevent="postData">
                    <div class="grid grid-cols-1 gap-5">
                        <div v-for="(item, index) in items" :key="index">
                            <div v-if="item.type == 'text'">
                                <label :for="item.key" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">{{ capitalizeEachWord(item.key) }}</label>
                                <input type="text" :id="item.key" :placeholder="'Enter ' + capitalizeEachWord(item.key)" v-model="item.value" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                            </div>
                            <div v-else-if="item.type == 'longtext'">
                                <label :for="item.key" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">{{ capitalizeEachWord(item.key) }}</label>
                                <textarea type="text" :id="item.key" :placeholder="'Enter ' + capitalizeEachWord(item.key)" v-model="item.value" rows="4" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                    {{ item.value }}
                                </textarea>
                            </div>
                            <div v-else-if="item.type == 'image'">
                                <label :for="item.key" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">{{ capitalizeEachWord(item.key) }}</label>
                                <input type="file" :id="item.key" :placeholder="'Enter ' + capitalizeEachWord(item.key)" accept="image/*" @change="uploadImage($event, item.key)" class="focus:border-ring-brand-300 shadow-theme-xs focus:file:ring-brand-300 h-11 w-full overflow-hidden rounded-lg border border-gray-300 bg-transparent text-sm text-gray-500 transition-colors file:mr-5 file:border-collapse file:cursor-pointer file:rounded-l-lg file:border-0 file:border-r file:border-solid file:border-gray-200 file:bg-gray-50 file:py-3 file:pr-3 file:pl-3.5 file:text-sm file:text-gray-700 placeholder:text-gray-400 hover:file:bg-gray-100 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 dark:text-white/90 dark:file:border-gray-800 dark:file:bg-white/[0.03] dark:file:text-gray-400 dark:placeholder:text-gray-400">
                                <MinioImage :path="item.value" alt="Logo" class="rounded-sm mt-3" :height="100" />
                            </div>
                        </div>

                        <div class="mt-5 flex flex-col justify-end gap-5 xl:flex-row xl:items-center">
                            <a href="/admin/dashboard" class="w-40 border border-gray-300 shadow-theme-xs hover:bg-gray-100 inline-flex items-center justify-center gap-2 rounded-lg px-4 py-3 text-sm font-medium text-black transition">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.21967 7.28033C5.92678 6.98744 5.92678 6.51256 6.21967 6.21967C6.51256 5.92678 6.98744 5.92678 7.28033 6.21967L11.999 10.9384L16.7176 6.2198C17.0105 5.92691 17.4854 5.92691 17.7782 6.2198C18.0711 6.51269 18.0711 6.98757 17.7782 7.28046L13.0597 11.999L17.7782 16.7176C18.0711 17.0105 18.0711 17.4854 17.7782 17.7782C17.4854 18.0711 17.0105 18.0711 16.7176 17.7782L11.999 13.0597L7.28033 17.7784C6.98744 18.0713 6.51256 18.0713 6.21967 17.7784C5.92678 17.4855 5.92678 17.0106 6.21967 16.7177L10.9384 11.999L6.21967 7.28033Z" fill="#323544"/>
                                </svg>
                                Cancel
                            </a>
                            <button type="submit" class="w-40 bg-success-500 shadow-theme-xs hover:bg-success-600 inline-flex items-center justify-center gap-2 rounded-lg px-4 py-3 text-sm font-medium text-white transition">
                                <svg width="20" height="20" viewBox="0 0 25 25" fill="FFFFFF" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.8125 3.47852C4.56986 3.47852 3.5625 4.48587 3.5625 5.72852V18.7285C3.5625 19.9712 4.56986 20.9785 5.8125 20.9785H18.8124C20.055 20.9785 21.0624 19.9712 21.0624 18.7285L21.0624 8.8427C21.0624 8.24536 20.8249 7.67254 20.4022 7.25049L17.2832 4.1363C16.8613 3.71509 16.2895 3.47852 15.6934 3.47852H5.8125ZM5.8125 4.97852C5.39829 4.97852 5.0625 5.3143 5.0625 5.72852V18.7285C5.0625 19.1427 5.39829 19.4785 5.8125 19.4785H7.56251L7.5625 15.7285C7.5625 14.4859 8.56986 13.4785 9.8125 13.4785L14.8125 13.4785C16.0551 13.4785 17.0625 14.4859 17.0625 15.7285V19.4785H18.8124C19.2266 19.4785 19.5624 19.1427 19.5624 18.7285L19.5624 8.8427C19.5624 8.64359 19.4832 8.45265 19.3423 8.31196L16.2233 5.19778C16.0827 5.05737 15.8921 4.97852 15.6934 4.97852H14.0625L14.0625 5.72851C14.0625 6.97115 13.0551 7.97852 11.8125 7.97852H8.8125C7.56986 7.97852 6.5625 6.97116 6.5625 5.72852V4.97852H5.8125ZM8.0625 4.97852V5.72852C8.0625 6.14273 8.39829 6.47852 8.8125 6.47852H11.8125C12.2267 6.47852 12.5625 6.14273 12.5625 5.72851L12.5625 4.97852H8.0625ZM15.5625 19.4785L9.06251 19.4785L9.0625 15.7285C9.0625 15.3143 9.39829 14.9785 9.8125 14.9785L14.8125 14.9785C15.2267 14.9785 15.5625 15.3143 15.5625 15.7285V19.4785Z" fill="#FFFFFF"/>
                                </svg>
                                Save
                            </button>
                        </div>
                    </div>
                    </form>
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
import { getSession } from '../../../helpers/SessionHelper';
import MinioImage from "../../../components/ui/MinioImage.vue";
import { SettingModel } from '../../../interfaces/SettingModel';
import { capitalizeEachWord } from '../../../helpers/ConverterHelper';
import axios from 'axios';
import Swal from 'sweetalert2'
import { useRouter } from 'vue-router'
import { useRoute } from 'vue-router';

const router = useRouter()
const route = useRoute();
const items = ref<SettingModel[] | null>(null);

const seletected_file = ref(null)

onMounted(() => {
    fetchData();
});

const fetchData = async () => {
    showLoading()

    axios.get(`/api/setting?sort=id:asc`,
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

const uploadImage = async (event: any, itemKey: any) => {
    showLoading()

    seletected_file.value = event.target.files[0];
    if (seletected_file.value) {
        const formData = new FormData();
        formData.append('file', seletected_file.value);

        await axios.post('/api/minio/upload', formData,
            {headers: {'Authorization': `Bearer ${getSession().token}`}}
        )
        .then(response => {
            Swal.close()
            const result = response.data;

            if (items.value) {
                items.value.forEach(item => {
                    if (item.key === itemKey) {
                        item.value = result['data']['path'];
                    }
                });
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
    } else {
        alert('Please select an image first.');
    }

}

const postData = async () => {
    showLoading()

    if (items.value) {
        items.value.forEach(item => {
            console.log(item)
        });
    }
    axios.post(`/api/setting/bulk`, items.value,
        {headers: {'Authorization': `Bearer ${getSession().token}`}}
    )
    .then(response => {
        Swal.close()
        const result = response.data;
        if(result['status']) {
            Swal.fire({
                icon: 'success',
                text: result['message'],
            }).then(()=> {
                router.push('/admin/dashboard')
            })
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

</script>
