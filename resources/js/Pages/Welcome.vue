<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>

    <Head title="Welcome" />

    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0 w-40">
                <img class="animate-pulse" src="../../images/logo.png" alt="">
            </div>
            <div v-if="canLogin" class="top-0 right-0 px-6 py-4 flex">
                <Link v-if="$page.props.user" :href="route('dashboard')"
                    class="text-sm text-white">Dashboard</Link>

                <template v-else>
                    <Link :href="route('login')" class="text-sm text-white flex hover:scale-95">Log in</Link>

                    <Link v-if="canRegister" :href="route('register')"
                        class="ml-4 text-sm text-white flex hover:scale-95">Register</Link>
                </template>
            </div>
        </div>
    </div>
</template>
