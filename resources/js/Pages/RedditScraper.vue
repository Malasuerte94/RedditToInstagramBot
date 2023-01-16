<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Reddit Scrappers
            </h2>
        </template>

        <div class="py-12" v-if="!loading">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <form class="p-10" v-if="igAccounts">
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label for="subreddit"
                                    class="block mb-2 text-sm font-medium text-black-900 text-black">Subreddit</label>
                                <input v-model="newRedditScrapper.subreddit" type="text" id="subreddit"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="working subreddit..." required>
                            </div>
                            <div>
                                <label for="ig_account_id"
                                    class="block mb-2 text-sm font-medium text-black-900 text-black">Ig Account</label>
                                <select v-model="newRedditScrapper.ig_account_id" required id="ig_account_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="null" selected>Choose an account</option>
                                    <template v-for="account in igAccounts" :key="account.id">
                                        <option :value="account.id">{{ account.username }}</option>
                                    </template>
                                </select>
                            </div>
                            </div>
                        <div class="grid gap-6 mb-6 md:grid-cols-4">
                            <div>
                                <label for="filter_by"
                                    class="block mb-2 text-sm font-medium text-black-900 text-black">Filter by</label>
                                <select v-model="newRedditScrapper.filter_by" required id="filter_by" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="hot"> Hot </option>
                                    <option value="new"> New </option>
                                    <option value="top"> Top </option>
                                    <option value="random"> Random </option>
                                    <option value="controversial"> Controversial </option>
                                </select>
                            </div>
                            <div>
                                <label for="time_filter"
                                    class="block mb-2 text-sm font-medium text-gray-900 text-black">Filter by time</label>
                                <select v-model="newRedditScrapper.time_filter" required id="time_filter" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="hour"> Hour </option>
                                    <option value="day"> Day </option>
                                    <option value="week"> Week </option>
                                    <option value="month"> Month </option>
                                    <option value="year"> Year </option>
                                    <option value="all"> All </option>
                                </select>
                            </div>
                            <div>
                                <label for="limit"
                                    class="block mb-2 text-sm font-medium text-gray-900 text-black">Limit of posts</label>
                                <input v-model="newRedditScrapper.limit_posts" type="number" id="limit"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Limit to nr. of posts" required>
                            </div>
                            <div class="flex align-items-end align-items-xl-end"><button @click="addNewRedditScrapper" type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button></div>
                        </div>
                        <div v-if="errors">
                            <div v-for="error in errors" :key="error" class="text-red-500 text-sm">{{ error[0] }}</div>
                        </div> 
                    </form>

                </div>
            </div>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-5">
                            <table v-if="reditScrapers" class="
                    w-full
                    text-sm text-left text-gray-500
                    dark:text-gray-400
                ">
                                <thead class="
                        text-xs text-gray-700
                        uppercase
                        bg-gray-50
                        dark:bg-gray-700 dark:text-gray-400
                    ">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">#</th>
                                        <th scope="col" class="px-6 py-3">Instagram Account</th>
                                        <th scope="col" class="px-6 py-3">Sub Reddit</th>
                                        <th scope="col" class="px-6 py-3">Filter By</th>
                                        <th scope="col" class="px-6 py-3">Filter by time</th>
                                        <th scope="col" class="px-6 py-3">Limit</th>
                                        <th scope="col" class="px-6 py-3">Date Added</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="(redditScraper, index) in reditScrapers" :key="index">
                                        <tr class="
                            bg-white
                            border-b
                            dark:bg-gray-900 dark:border-gray-700
                        " v-for="redditScraperForAccount in redditScraper" :key="redditScraperForAccount.id">
                                        <th class="
                                px-6
                                py-4
                                font-medium
                                text-gray-900
                                whitespace-nowrap
                                dark:text-white
                            " scope="row">
                                            {{ redditScraperForAccount.id }}
                                        </th>
                                        <td class="px-6 py-4">{{ redditScraperForAccount.ig_username }}</td>
                                        <td class="px-6 py-4">{{ redditScraperForAccount.subreddit }}</td>
                                        <td class="px-6 py-4">{{ redditScraperForAccount.filter_by }}</td>
                                        <td class="px-6 py-4">{{ redditScraperForAccount.time_filter }}</td>
                                        <td class="px-6 py-4">{{ redditScraperForAccount.limit }}</td>
                                        <td class="px-6 py-4">{{ redditScraperForAccount.created_at }}</td>
                                    </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>

                    </div>
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
            loading: true,
            newRedditScrapper: {
                subreddit: '',
                ig_account_id: null,
                filter_by: 'hot',
                time_filter: 'hour',
                limit_posts: 10,
            },
            igAccounts: [],
            reditScrapers: [],
            errors: [],
        };
    },
    mounted() {
        this.getIgAccounts();
        this.getRedditScrapersAccounts();
        this.loading = false;
    },
    methods: {
        async getIgAccounts() {
            try {
                this.loading = true;
                const response = await axios.get('/api/ig-accounts');
                this.igAccounts = response.data.data;
            } catch (error) {
                console.error(error);
            }
            this.loading = false;
        },
        async getRedditScrapersAccounts() {
            try {
                this.loading = true;
                const response = await axios.get('/api/reddit-scrapers');
                this.reditScrapers = response.data.data;
            } catch (error) {
                console.error(error);
            }
            this.loading = false;
        },
        async addNewRedditScrapper() {
            try {
                this.loading = true;
                this.errors = [];
                await axios.post('/api/reddit-scrapers', this.newRedditScrapper);
                this.getRedditScrapersAccounts();
            } catch (error) {
                this.errors = error.response.data.errors;
                console.error(error);
            }
            this.loading = false;
        },
    },
};
</script>