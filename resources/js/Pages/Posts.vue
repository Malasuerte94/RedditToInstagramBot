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
                    <template v-if="posts.length > 0">
                        <div class="p-4 overflow-auto">
                            <div
                                class="w-full hover:grid-flow-row grid-flow-row-dense overflow-auto gap-4 columns-2 md:columns-3 lg:columns-4">
                                <div v-for="post in posts" :key="post.id"
                                    class="mb-4 max-w-sm bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                                    <img class="rounded-t-lg" :src="post.image_url" alt="" />
                                    <div class="p-5">
                                        <a href="#">
                                            <h5
                                                class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                                {{ post.author }}</h5>
                                        </a>
                                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                            #hastagGenerator
                                        </p>
                                        <div class="flex items-center p-2 justify-between">
                                           
                                                <div
                                                    class="flex items-center pl-4 pr-4 border border-gray-200 rounded dark:border-gray-700">
                                                    <input v-on:change="updatePost(post.id, $event)" :id="'bordered-checkbox-'+post.id" type="checkbox" :checked="post.confirmed"
                                                        :name="'bordered-checkbox-'+post.id"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    <label :for="'bordered-checkbox-'+post.id"
                                                        class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                        Aprove
                                                        </label>
                                                </div>
                                            
                                            <div>
                                                <button type="button" v-on:click="deletePost(post.id)"
                                                    class="text-blue-700 border border-red-700 hover:bg-red-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800">
                                                    <svg class="w-5 h-5" fill="currentColor" stroke="black"
                                                        strokeWidth={1.5} viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                        <path strokeLinecap="round" strokeLinejoin="round"
                                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                    <span class="sr-only">Delete</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </template>
                </div>
            </div>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-5">
            <table v-if="posts.length > 0" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">#</th>
                        <th scope="col" class="px-6 py-3">Subreddit</th>
                        <th scope="col" class="px-6 py-3">Image</th>
                        <th scope="col" class="px-6 py-3">Author</th>
                        <th scope="col" class="px-6 py-3">Posted</th>
                        <th scope="col" class="px-6 py-3"> Confirmed</th>
                        <th scope="col" class="px-6 py-3">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700" v-for="post in posts"
                        :key="post.id">
                        <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" scope="row">{{
                            post.id
                        }}</th>
                        <td class="px-6 py-4">{{ post.subreddit }}</td>
                        <td class="px-6 py-4">{{ post.image_url }}</td>
                        <td class="px-6 py-4">{{ post.author }}</td>
                        <td class="px-6 py-4">{{ post.posted }}</td>
                        <td class="px-6 py-4">{{ post.confirmed }}</td>
                        <td class="px-6 py-4">{{ post.created_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
<script>
import axios from 'axios';
export default {
    data() {
        return {
            posts: [],
        };
    },
    mounted() {
        this.getPosts();
    },
    methods: {
        async getPosts() {
            try {
                const response = await axios.get('/api/posts');
                this.posts = response.data;
            } catch (error) {
                console.error(error);
            }
        },
        async deletePost(postId) {
            try {
                await axios.delete('/api/posts/' + postId);
                this.getPosts();
            } catch (error) {
                console.error(error);
            }
        },
        async updatePost(postId, event) {
            let checked = event.target.checked;
            try {
                await axios.patch('/api/posts/' + postId, {
                    confirmed: checked,
                });
                this.getPosts();
            } catch (error) {
                console.error(error);
            }
        },
    },
};
</script>