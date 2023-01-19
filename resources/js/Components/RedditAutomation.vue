<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
</script>

<template>
    <div>
        <div v-if="!loading">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 h-8 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                        Reddit Automation
                    </div>
                </div>
            </div>
            <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1">
                <div class="p-6">
                    <div class="mt-5">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-5">
                            <form v-if="igAccounts && hashtags && redditScrapers">
                                <div class="grid gap-6 mb-6 md:grid-cols-2">
                                    <div>
                                        <label for="ig_account_id"
                                            class="block mb-2 text-sm font-medium text-black-900 text-black">Instagram</label>
                                        <select v-model="newRedditAutomation.ig_account_id" required id="ig_account_id"
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
                                        <select v-model="newRedditAutomation.reddit_scraper_id" required
                                            id="reddit_scraper_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="null" selected>Subreddit</option>
                                            <template v-for="redditScraper in redditScrapers" :key="redditScraper.id">
                                                <option :value="redditScraper.id">{{ redditScraper.subreddit }}</option>
                                            </template>
                                        </select>
                                    </div>
                                </div>
                                <div class="grid gap-6 mb-6 md:grid-cols-2">
                                    <div>
                                        <label for="hashtag_id"
                                            class="block mb-2 text-sm font-medium text-black-900 text-black">Hashtags</label>
                                        <select v-model="newRedditAutomation.hashtag_id" required id="hashtag_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="null" selected>Hashtag collection</option>
                                            <template v-for="hashtag in hashtags" :key="hashtag.id">
                                                <option :value="hashtag.id">{{ hashtag.name }}</option>
                                            </template>
                                        </select>
                                    </div>
                                    <div class="flex self-end">
                                        <button @click="addNewRedditScrapper" type="button"
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
                    <template v-if="redditAutomations">
                        <div v-for="redditAutomation in redditAutomations" :key="redditAutomation.id" class="mt-5">
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-2.5">
                                <div class="grid gap-1 grid-cols-5 content-center items-center">
                                    <div>{{ redditAutomation.subreddit }}</div>
                                    <div>{{ redditAutomation.instagram }}</div>
                                    <div>{{ redditAutomation.hashtags }}</div>
                                    <div>{{ redditAutomation.created_at }}</div>
                                    <div class="flex">
                                        <button type="button" @click="
                                            startManualScrape(redditAutomation.id)
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
                                                        "
                                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                fill="blue" viewBox="0 0 24 24" stroke-width="1.5" stroke="blue"
                                                class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" />
                                            </svg>
                                        </button>
                                        <button type="button" @click="
                                            setActiveStatus(redditAutomation.id, !redditAutomation.active)
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
                                                        "
                                                        :class="{
                                                            'bg-green-700': !redditAutomation.active,
                                                            'border-green-500': !redditAutomation.active,
                                                            'bg-red-700': redditAutomation.active,
                                                            'border-red-500': redditAutomation.active,
                                                        }"
                                                        >

                                            <svg v-if="!redditAutomation.active" xmlns="http://www.w3.org/2000/svg"
                                                fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="none"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" />
                                            </svg>
                                            <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="white"
                                                class="w-6 h-6">
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
            newRedditAutomation: {
                ig_account_id: null,
                reddit_scraper_id: null,
                hashtag_id: null,
            },
            redditAutomations: [],
            igAccounts: [],
            redditScrapers: [],
            hashtags: [],
            errors: [],
        };
    },
    mounted() {
        this.getRedditScrapersAccounts();
        this.getHashtags();
        this.getInstagramAccountsConnected();
        this.getRedditAutomations();
        this.loading = false;
    },
    methods: {
        async getRedditAutomations() {
            try {
                const response = await axios.get('/api/reddit-automation');
                this.redditAutomations = response.data.data;
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
        async getHashtags() {
            try {
                const response = await axios.get('/api/hashtags');
                this.hashtags = response.data.data;
            } catch (error) {
                console.error(error);
            }
        },
        async addNewRedditScrapper() {
            try {
                await axios.post('/api/reddit-automation', this.newRedditAutomation);
                this.getRedditAutomations();
            } catch (error) {
                this.errors = error.response.data.errors;
            }
        },
        async setActiveStatus(id, status) {
            try {
                await axios.patch(`/api/reddit-automation/${id}`, {status: status});
                this.getRedditAutomations();
            } catch (error) {
                console.error(error);
            }
        },
        async startManualScrape(id) {
            try {
                await axios.post(`/api/reddit-automation/start-test/${id}`);
            } catch (error) {
                console.error(error);
            }
        },
    },
};
</script>