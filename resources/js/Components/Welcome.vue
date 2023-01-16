<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
</script>

<template>
    <div>
        <div>
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div>
                    <ApplicationLogo class="block h-12 w-auto" />
                </div>

                <div class="mt-8 text-2xl">
                    Welcome to your Bot app!
                </div>
            </div>

            <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
                <div class="p-6">
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

                    <div class="mt-5">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-5">
                            <form v-if="igAccounts && hashtags && redditScrapers">
                                <div class="grid gap-6 mb-6 md:grid-cols-2">
                                    <div>
                                        <label for="ig_account_id"
                                            class="block mb-2 text-sm font-medium text-black-900 text-black">Instagram</label>
                                        <select v-model="newRedditAutomation.ig_account_id" required id="ig_account_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="null" selected>Choose an account</option>
                                            <template v-for="account in igAccounts" :key="account.id">
                                                <option :value="account.id">{{ account.username }}</option>
                                            </template>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="reddit_scraper_id"
                                            class="block mb-2 text-sm font-medium text-black-900 text-black">Subreddit</label>
                                        <select v-model="newRedditAutomation.reddit_scraper_id" required id="reddit_scraper_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
                                        <select v-model="newRedditAutomation.hashtag_id" required id="hashtag_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="null" selected>Hashtag collection</option>
                                            <template v-for="hashtag in hashtags" :key="hashtag.id">
                                                <option :value="hashtag.id">{{ hashtag.name }}</option>
                                            </template>
                                        </select>
                                    </div>
                                    <div class="flex self-end"><button
                                            @click="addNewRedditScrapper" type="button"
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
                </div>
                <div class="p-6 border-gray-200">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-8 h-8 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                            <a href="https://tailwindcss.com/">Instagram Uploader</a>
                        </div>
                    </div>

                    <div class="ml-12">
                        <div class="mt-2 text-sm text-gray-500">
                            Laravel Jetstream is built with Tailwind, an amazing utility first CSS framework that
                            doesn't get in your way. You'll be amazed how easily you can build and maintain fresh,
                            modern designs with this wonderful framework at your fingertips.
                        </div>
                    </div>
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
        this.loading = false;
    },
    methods: {
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
        async addNewRedditScrapper () {
            try {
                await axios.post('/api/reddit-automation', this.newRedditAutomation);
            } catch (error) {
                this.errors = error.response.data.errors;
            }
        },
    },
};
</script>