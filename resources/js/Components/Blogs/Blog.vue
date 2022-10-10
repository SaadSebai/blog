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
                </div>
            </div>

            <comment-section
                :blog="blog"
            />

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

    function edited(value) {
        editing.value = value;
    }
</script>

