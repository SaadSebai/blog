<template>
    <div>
        <comment-form
            :blog="blog"
            @created="created"
        />

        <div v-if="this.comments">
            <hr>
            <comment
                v-for="comment in comments"
                @deleted="deleted"
                :key="comment.id"
                :comment="comment"
            />
        </div>

        <hr>

        <div v-if="blog.comments_count > 0 && loadable"
            class="flex justify-center my-2 text-blue-600">
            <button
                @click="loadComments"
                class="text-sm"
            >
                Load comments
            </button>
        </div>
    </div>
</template>

<script setup>
    import { ref } from 'vue';
    import Comment from './Comment.vue';
    import CommentForm from './CommentForm.vue';
    import { Inertia } from '@inertiajs/inertia'

    const props = defineProps({
        blog: Object
    });

    const comments = ref(null);
    const loadable = ref(true);
    const nextPage = ref(null);

    function loadComments() {
        if(loadable.value)
        {
            Inertia.get(nextPage.value ?? route('blogs.comments.index', props.blog.id), {}, {
                preserveState: true,
                preserveScroll: true,
                only: ['comments'],
                onSuccess: ({props}) => {
                    console.log(props)
                    comments.value = nextPage.value ? [...comments.value, ...props.comments.data] : props.comments.data;
                    if(props.comments.next_page_url && nextPage.value != props.comments.next_page_url)
                    {
                        nextPage.value = props.comments.next_page_url;
                    }
                    else
                    {
                        loadable.value = false;
                        nextPage.value = null;
                    }
                }
            });
        }
    }

    function created()
    {
        comments.value = null;
        loadable.value = true;
        nextPage.value = null;
    }

    function deleted(comment) {
        comments.value.pop(comment);
    }
</script>
