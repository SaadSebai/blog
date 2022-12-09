<template>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2">
            <div class="bg-white border-b border-gray-200">
                <div>
                    <div class="p-6 flex space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 16 16" stroke="currentColor" stroke-width="2">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        </svg>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-gray-800">{{ blog.user.name }}</span>
                                    <small class="ml-2 text-sm text-gray-600">{{ dayjs(blog.created_at).fromNow() }}</small>
                                    <small v-if="blog.created_at !== blog.updated_at" class="text-sm text-gray-600"> &middot; edited</small>
                                </div>
                                <Dropdown v-if="blog.user.id === $page.props.auth.user.id">
                                    <template #trigger>
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </template>
                                    <template #content>
                                        <button class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:bg-gray-100 transition duration-150 ease-in-out" @click="editing = true">
                                            Edit
                                        </button>

                                        <DropdownLink as="button" :href="route('blogs.destroy', blog.id)" method="delete">
                                            Delete
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>

                            <update-form v-if="editing" :blog="blog" @edited="edited" />

                            <div v-else>
                                <h2 class="mt-4 text-lg text-gray-900">{{ blog.title }}</h2>
                                <p class="mt-4 text-sm text-gray-900">{{ blog.body }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="px-20 pb-4 flex space-x-2">
                        <button @click="liked = !liked">
                            <svg v-show="!liked" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-gray-500" fill="none" stroke="currentColor" viewBox="0 0 512 512">
                                <path d="M244 84L255.1 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 0 232.4 0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84C243.1 84 244 84.01 244 84L244 84zM255.1 163.9L210.1 117.1C188.4 96.28 157.6 86.4 127.3 91.44C81.55 99.07 48 138.7 48 185.1V190.9C48 219.1 59.71 246.1 80.34 265.3L256 429.3L431.7 265.3C452.3 246.1 464 219.1 464 190.9V185.1C464 138.7 430.4 99.07 384.7 91.44C354.4 86.4 323.6 96.28 301.9 117.1L255.1 163.9z"/>
                            </svg>
                            <svg v-show="liked" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-red-500 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 512 512">
                                <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/>
                            </svg>
                        </button>
                    </div>

                </div>
            </div>

            <comment-section :blog="blog" />

        </div>
</template>

<script setup>
    import dayjs from 'dayjs';
    import relativeTime from 'dayjs/plugin/relativeTime';
    import Dropdown from '@/Components/Dropdown.vue';
    import DropdownLink from '@/Components/DropdownLink.vue';
    import UpdateForm from '@/Components/Blogs/UpdateForm.vue';
    import CommentSection from '@/Components/Comments/CommentSection.vue';
    import { ref } from 'vue';

    dayjs.extend(relativeTime);

    defineProps({
        blog: Object
    })

    const editing = ref(false);
    const liked = ref(false);

    function edited(value) {
        editing.value = value;
    }
</script>

