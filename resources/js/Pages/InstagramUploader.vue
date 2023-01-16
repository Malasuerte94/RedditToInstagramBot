<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Posts
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <button @click="getAuthData"
                        class="m-10 text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800"
                        type="button">Connect to instagram {{ $page.props.user.name }}</button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script>
import axios from 'axios';
export default {
    data() {
        return {

        };
    },
    methods: {
        async getAuthData() {
            try {
                await axios.post('/api/get-instagram-auth-data');
            } catch (error) {
                console.error(error);
            }
        }
    },
};
</script>