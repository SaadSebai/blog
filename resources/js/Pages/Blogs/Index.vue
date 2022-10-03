<template>
    <Head title="Blog" />

    <AuthenticatedLayout>
        <div class="max-w-3xl mx-auto p-4 sm:p-6 lg:p-8">

            <flash-message
                v-if="$page.props.flash.success || $page.props.flash.error"
                :flash="$page.props.flash"
            />

            <create-form />

            <Blog
                v-for="blog in blogs.data"
                :key="blog.id"
                :blog="blog"
            />

            <pagination class="mt-6 place-content-center w-full" :links="blogs.links" />

        </div>

    </AuthenticatedLayout>
</template>

<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    import Pagination from '@/Components/Shared/Pagination.vue';
    import FlashMessage from '@/Components/Shared/FlashMessage.vue';
    import Blog from '@/Components/Blogs/Blog.vue';
    import CreateForm from '@/Components/Blogs/CreateForm.vue';

    defineProps(['blogs']);

</script>
