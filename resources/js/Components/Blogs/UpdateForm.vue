<template>
    <div>
        <form @submit.prevent="form.put(route('blogs.update', blog.id), { onSuccess: () => $emit('edited', false) })">
            <div class="mt-4 ">
                <span for="tile">Title:</span>
                <input
                    id="title"
                    type="text"
                    v-model="form.title"
                    placeholder="Title"
                    class="w-full text-gray-900 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                >
                <InputError :message="form.errors.title" class="mt-2" />
            </div>

            <div class="mt-4 ">
                <span for="body">Body:</span>
                <textarea
                    id="body"
                    rows="4"
                    v-model="form.body"
                    class="w-full text-gray-900 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>
                <InputError :message="form.errors.message" class="mt-2" />
            </div>

            <div class="space-x-2">
                <PrimaryButton class="mt-4">Save</PrimaryButton>
                <button class="mt-4" @click="$emit('edited', false); form.reset(); form.clearErrors()">Cancel</button>
            </div>
        </form>
    </div>
</template>

<script setup>
    import { useForm } from '@inertiajs/inertia-vue3';
    import InputError from '@/Components/InputError.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';

    const props = defineProps(['blog']);

    const form = useForm({
        title: props.blog.title,
        body: props.blog.body,
    });

</script>
