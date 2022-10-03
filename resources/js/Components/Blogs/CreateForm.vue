<template>
    <div class="mb-6">
        <form @submit.prevent="form.post(route('blogs.store'), { onSuccess: () => form.reset() })">
            <div>
                <span for="tile">Title:</span>
                <input
                    id="title"
                    type="text"
                    v-model="form.title"
                    placeholder="Title"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mb-5"
                >
                <InputError :message="form.errors.title" class="mt-2" />
            </div>

            <div>
                <span for="body">Body:</span>
                <textarea
                    id="body"
                    rows="4"
                    v-model="form.body"
                    placeholder="What's on your mind?"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>
                <InputError :message="form.errors.body" class="mt-2" />
            </div>
            <PrimaryButton class="mt-4">Add Blog</PrimaryButton>
        </form>
    </div>
</template>

<script setup>
    import { useForm } from '@inertiajs/inertia-vue3';
    import InputError from '@/Components/InputError.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';

    const form = useForm({
        title: '',
        body: '',
    });

</script>
