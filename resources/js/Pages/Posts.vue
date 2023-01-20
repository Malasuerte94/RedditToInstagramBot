<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Posts
            </h2>
        </template>
        <div class="py-12">
            <div v-if="posts && !loading" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <template v-for="(igAccount, index) in posts" :key="index">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div>
                            <h2 class="p-4 font-semibold text-xl text-gray-800 leading-tight">
                                {{ index }}
                            </h2>
                        </div>
                        <div class="p-4">
                            <div class="masonry-with-flex">
                                <template v-for="post in igAccount" :key="post.id">
                                    <div v-if="!post.posted" class="
                                        masonry-cell
                                        bg-white
                                        border border-gray-200
                                        rounded-lg
                                        shadow-md
                                        dark:bg-gray-800 dark:border-gray-700
                                     " :class="[uploading == post.id ? 'uploading animate-pulse' : '']">
                                        <div class="item flex flex-col justify-between content-between">
                                            <img class="rounded-t-lg" :src="post.image_url" alt="" />
                                            <div class="p-5">

                                                <h5 class="
                                                        mb-2
                                                        text-2sm
                                                        font-bold
                                                        tracking-tight
                                                        text-gray-900
                                                        dark:text-white
                                                    ">
                                                    Author: {{ post.author }}
                                                </h5>

                                                <p class="
                                                    mb-3
                                                    font-normal
                                                    text-gray-700
                                                    dark:text-gray-400
                                                ">
                                                    {{ post.content }}
                                                </p>
                                                <div class="
                                                    flex
                                                    items-center
                                                    p-2
                                                    justify-between
                                                ">
                                                    <div class="
                                                        p-2.5
                                                        flex
                                                        items-center
                                                        border border-gray-200
                                                        rounded
                                                        dark:border-gray-700
                                                    ">
                                                        <input v-on:change="
                                                            updatePost(
                                                                post.id,
                                                                $event
                                                            )
                                                        " :id="
    'bordered-checkbox-' +
    post.id
" type="checkbox" :checked="
    post.confirmed
" :name="
    'bordered-checkbox-' +
    post.id
" class="
                                                            text-blue-600
                                                            bg-gray-100
                                                            border-gray-300
                                                            rounded
                                                            focus:ring-blue-500
                                                            dark:focus:ring-blue-600
                                                            dark:ring-offset-gray-800
                                                            focus:ring-2
                                                            dark:bg-gray-700
                                                            dark:border-gray-600
                                                        " />
                                                        <label :for="
                                                            'bordered-checkbox-' +
                                                            post.id
                                                        " class="
                                                            w-full
                                                            ml-2
                                                            text-sm
                                                            font-medium
                                                            text-gray-900
                                                            dark:text-gray-300
                                                        ">
                                                            Aprove
                                                        </label>
                                                    </div>

                                                    <div>
                                                        <button type="button" v-on:click="
                                                            uploadManual(
                                                                post.id
                                                            )
                                                        " class="
                                                            text-blue-700
                                                            border
                                                            border-green-700
                                                            hover:bg-green-700
                                                            hover:text-white
                                                            focus:ring-4
                                                            focus:outline-none
                                                            focus:ring-blue-300
                                                            font-medium
                                                            rounded-lg
                                                            text-sm
                                                            p-2.5
                                                            text-center
                                                            inline-flex
                                                            items-center
                                                            mr-2
                                                            dark:border-blue-500
                                                            dark:text-blue-500
                                                            dark:hover:text-white
                                                            dark:focus:ring-blue-800
                                                        ">
                                                            <svg class="w-5 h-5" fill="currentColor" stroke="black"
                                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                stroke-width="1.5">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                                            </svg>

                                                            <span class="sr-only">Delete</span>
                                                        </button>
                                                        <button type="button" v-on:click="
    deletePost(post.id)
                                                        " class="
                                                            text-blue-700
                                                            border
                                                            border-red-700
                                                            hover:bg-red-700
                                                            hover:text-white
                                                            focus:ring-4
                                                            focus:outline-none
                                                            focus:ring-blue-300
                                                            font-medium
                                                            rounded-lg
                                                            text-sm
                                                            p-2.5
                                                            text-center
                                                            inline-flex
                                                            items-center
                                                            mr-2
                                                            dark:border-blue-500
                                                            dark:text-blue-500
                                                            dark:hover:text-white
                                                            dark:focus:ring-blue-800
                                                        ">
                                                            <svg class="w-5 h-5" fill="currentColor" stroke="black"
                                                                strokeWidth="{1.5}" viewBox="0 0 24 24"
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
                                </template>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </AppLayout>
</template>
<script>
import axios from "axios";
export default {
    data() {
        return {
            loading: true,
            posts: [],
            uploading: null,
        };
    },
    mounted() {
        this.getPosts();
    },
    methods: {
        async getPosts() {
            try {
                const response = await axios.get("/api/posts");
                this.posts = response.data;
                this.loading = false;
            } catch (error) {
                console.error(error);
            }
        },
        async deletePost(postId) {
            try {
                await axios.delete("/api/posts/" + postId);
                this.getPosts();
            } catch (error) {
                console.error(error);
            }
        },
        async updatePost(postId, event) {
            let checked = event.target.checked;
            try {
                await axios.patch("/api/posts/" + postId, {
                    confirmed: checked,
                });
                this.getPosts();
            } catch (error) {
                console.error(error);
            }
        },
        async uploadManual(postId) {
            this.uploading = postId;
            try {
                await axios.post("/api/posts/upload/", { post_id: postId });
                this.getPosts();
            } catch (error) {
                console.error(error);
            }
        },
    },
};
</script>
<style lang="scss" scoped>
.masonry-with-flex {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    grid-gap: 1px;
    grid-auto-rows: minmax(280px, auto);
    grid-auto-flow: dense;
    padding: 1px;

    .item {
        padding: 1rem;
    }
}

.masonry-cell {
    position: relative;
}

.uploading::after {
    content: ""; // :before and :after both require content
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: linear-gradient(120deg, #ee44d2, #33d0ff);
    background-color: #333;
    opacity: .7;
}
</style>