<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Instagram Uploader
            </h2>
        </template>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <button @click="connectToInstagramAccounts"
                        class="m-5 text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800"
                        type="button">Connect to instagram {{ $page.props.user.name }}</button>
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-5">
                                <table v-if="accounts.length > 0" class="
                    w-full
                    rounded-lg
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
                                            <th scope="col" class="px-6 py-3">Username</th>
                                            <th scope="col" class="px-6 py-3">Account ID</th>
                                            <th scope="col" class="px-6 py-3">Business ID</th>
                                            <th scope="col" class="px-6 py-3">Author Prefix</th>
                                            <th scope="col" class="px-6 py-3">Include Author</th>
                                            <th scope="col" class="px-6 py-3">Date Added</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="
                            bg-white
                            border-b
                            dark:bg-gray-900 dark:border-gray-700
                        " v-for="account in accounts" :key="account.id">
                                            <th class="
                                px-6
                                py-4
                                font-medium
                                text-gray-900
                                whitespace-nowrap
                                dark:text-white
                            " scope="row">
                                                {{ account.id }}
                                            </th>
                                            <td class="px-6 py-4">{{ account.username }}</td>
                                            <td class="px-6 py-4">{{ account.account_id }}</td>
                                            <td class="px-6 py-4">{{ account.business_id }}</td>
                                            <td class="px-6 py-4">{{ account.author_prefix }}</td>
                                            <td class="px-6 py-4">{{ account.include_author }}</td>
                                            <td class="px-6 py-4">{{ account.created_at }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                
                    </div>
                </div>
                <div class="mt-10 max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                        Hastags
                        <form class="p-10" v-if="accounts">
                        <div class="grid gap-6 mb-6 md:grid-cols-1">
                            <div>
                                <label for="hashtagsName"
                                    class="block mb-2 text-sm font-medium text-black-900 text-black">Name (identifier)</label>
                                <input v-model="newHashtagsName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" id="hashtagsName" name="hashtagsName"/>
                            </div>
                            <div>
                                <label for="hashtags"
                                    class="block mb-2 text-sm font-medium text-black-900 text-black">Hastags (with space between)</label>
                                <textarea class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="newHashtags" name="hashtags" id="hashtags" cols="30" rows="10">

                                </textarea>
                            </div>
                            <div class="flex align-items-end align-items-xl-end">
                                <button @click="setHastags" type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                            </div>
                        </div>
                        <div v-if="errors">
                            <div v-for="error in errors" :key="error" class="text-red-500 text-sm">{{ error[0] }}</div>
                        </div> 
                    </form>
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-5">
                                <table v-if="hashtags" class="
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
                                            <th scope="col" class="px-6 py-3">Hashtags</th>
                                            <th scope="col" class="px-6 py-3">Date Added</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="
                            bg-white
                            border-b
                            dark:bg-gray-900 dark:border-gray-700
                        " v-for="hashtag in hashtags" :key="hashtag.id">
                                            <th class="
                                px-6
                                py-4
                                font-medium
                                text-gray-900
                                whitespace-nowrap
                                dark:text-white
                            " scope="row">
                                                {{ hashtag.id }}
                                            </th>
                                            <td class="px-6 py-4">{{ hashtag.hashtags }}</td>
                                            <td class="px-6 py-4">{{ hashtag.created_at }}</td>
                                        </tr>
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
            accounts: [],
            hashtags: [],
            newHashtags: '',
            newHashtagsName: '',
            errors: [],
        };
    },
    mounted() {
        this.getInstagramAccountsConnected();
        this.getHashtags();
    },
    methods: {
        async getInstagramAccountsConnected() {
            try {
                const response = await axios.get('/api/ig-accounts');
                this.accounts = response.data.data;
            } catch (error) {
                console.error(error);
            }
        },
        async connectToInstagramAccounts() {
            try {
                await axios.post('/api/ig-accounts/connect');
            } catch (error) {
                console.error(error);
            }
        },
        async getHashtags() {
            try {
                const response = await axios.get('/api/hashtags');
                this.hashtags = response.data.data;
            } catch (error) {
                console.error(error);
            }
        },
        async setHastags() {
            try {
                await axios.post('/api/hashtags', { hashtags: this.newHashtags, name: this.newHashtagsName });
                this.getHashtags();
            } catch (error) {
                this.errors = error.response.data.errors;
                console.error(error);
            }
        },
    },
};
</script>