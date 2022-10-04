<template>
    <div class="my-2 px-7">
        <form @submit.prevent="form.post(route('blogs.comments.store', blog.id),
                            { onSuccess: () => {form.reset(); $emit('created');},
                            preserveScroll: true })"
        >
            <div class="flex flex-row">
                <textarea
                    rows="1"
                    type="text"
                    v-model="form.body"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    placeholder="Write a comment..."
                ></textarea>

                <button class="ml-3 px-4 py-2 font-semibold text-sm bg-gray-800 text-white rounded-lg shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="h-5 w-5" viewBox="0 0 16 16">
                        <path d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1H2zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12z"/> <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                    </svg>
                </button>
            </div>
            <InputError :message="form.errors.body" class="mt-2" />

        </form>
    </div>
</template>

<script setup>
    import { useForm } from '@inertiajs/inertia-vue3';
    import InputError from '@/Components/InputError.vue';

    defineProps(['blog']);

    const form = useForm({
        body: ''
    });

</script>
