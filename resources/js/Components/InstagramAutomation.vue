<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
</script>

<template>
    <div>
        <div>
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 h-8 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                        <a>Instagram Automation</a>
                    </div>
                </div>
            </div>
            <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1">
                <div class="p-6" v-if="!loading">
                    <div class="mt-5">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-5">
                            <form v-if="igAccounts && redditScrapers">
                                <div class="grid gap-6 mb-6 md:grid-cols-3">
                                    <div>
                                        <label for="ig_account_id"
                                            class="block mb-2 text-sm font-medium text-black-900 text-black">Instagram</label>
                                        <select v-model="newInstagramAutomation.ig_account_id" required
                                            id="ig_account_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="null" selected>Choose an account</option>
                                            <template v-for="account in igAccounts" :key="account.id">
                                                <option :value="account.id">{{ account.username }}</option>
                                            </template>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="reddit_scraper_id"
                                            class="block mb-2 text-sm font-medium text-black-900 text-black">Subreddit</label>
                                        <select v-model="newInstagramAutomation.reddit_scraper_id" required
                                            id="reddit_scraper_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="null" selected>Subreddit</option>
                                            <template v-for="redditScraper in redditScrapers" :key="redditScraper.id">
                                                <option :value="redditScraper.id">{{ redditScraper.subreddit }}</option>
                                            </template>
                                        </select>
                                    </div>
                                    <div class="flex self-end"><button @click="addNewInstagramAutomation" type="button"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                                    </div>
                                </div>
                                <div v-if="errors">
                                    <div v-for="error in errors" :key="error" class="text-red-500 text-sm">{{
                                        error[0]
                                    }}</div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <template v-if="instagramAutomations">
                        <div v-for="instagramAutomation in instagramAutomations" :key="instagramAutomation.id"
                            class="mt-5">
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-2.5">
                                <div class="grid gap-1 grid-cols-4 content-center items-center">
                                    <div>{{ instagramAutomation.subreddit }}</div>
                                    <div>{{ instagramAutomation.instagram }}</div>
                                    <div>{{ instagramAutomation.created_at }}</div>
                                    <div class="flex">
                                        <button type="button" @click="
                                            startManualScrape(instagramAutomation.id)
                                        " class="
                                                            ml-auto
                                                            border
                                                            rounded-lg
                                                            p-2.5
                                                            text-center
                                                            block
                                                            items-center
                                                            bg-blue-700
                                                            border-blue-500
                                                            focus:ring-blue-800
                                                            hover:scale-95
                                                        ">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="blue" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="blue" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" />
                                            </svg>
                                        </button>
                                        <button type="button" @click="
                                            setActiveStatus(instagramAutomation.id, !instagramAutomation.active)
                                        " class="
                                                            ml-auto
                                                            border
                                                            rounded-lg
                                                            p-2.5
                                                            text-center
                                                            block
                                                            items-center
                                                            
                                                            focus:ring-green-800
                                                            hover:scale-95
                                                        " :class="{
                                                            'bg-green-700': !instagramAutomation.active,
                                                            'border-green-500': !instagramAutomation.active,
                                                            'bg-red-700': instagramAutomation.active,
                                                            'border-red-500': instagramAutomation.active,
                                                        }">

                                            <svg v-if="!instagramAutomation.active" xmlns="http://www.w3.org/2000/svg"
                                                fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="none"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" />
                                            </svg>
                                            <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.75 5.25v13.5m-7.5-13.5v13.5" />
                                            </svg>



                                            <span class="sr-only">Delete</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    data() {
        return {
            loading: true,
            newInstagramAutomation: {
                ig_account_id: null,
                reddit_scraper_id: null,
            },
            instagramAutomations: [],
            igAccounts: [],
            redditScrapers: [],
            errors: [],
        };
    },
    mounted() {
        this.getRedditScrapersAccounts();
        this.getInstagramAccountsConnected();
        this.getinstagramAutomations();
        this.loading = false;
    },
    methods: {
        async getinstagramAutomations() {
            try {
                const response = await axios.get('/api/instagram-automation');
                this.instagramAutomations = response.data.data;
            } catch (error) {
                console.error(error);
            }
        },
        async getInstagramAccountsConnected() {
            try {
                const response = await axios.get('/api/ig-accounts');
                this.igAccounts = response.data.data;
            } catch (error) {
                console.error(error);
            }
        },
        async getRedditScrapersAccounts() {
            try {
                this.loading = true;
                const response = await axios.get('/api/reddit-scrapers');
                this.redditScrapers = response.data.data;
            } catch (error) {
                console.error(error);
            }
            this.loading = false;
        },
        async setActiveStatus(id, status) {
            try {
                await axios.patch(`/api/instagram-automation/${id}`, { status: status });
                this.getinstagramAutomations();
            } catch (error) {
                console.error(error);
            }
        },
        async addNewInstagramAutomation() {
            try {
                await axios.post('/api/instagram-automation', this.newInstagramAutomation);
                this.getinstagramAutomations();
            } catch (error) {
                this.errors = error.response.data.errors;
            }
        },
        async testPost() {
            try {
                console.log('STARTING TEST');
                const response = await axios.get('/api/instagram-automation/get-post/test');
                console.log(response);
            } catch (error) {
                console.error(error);
            }
        },
    },
};
</script>