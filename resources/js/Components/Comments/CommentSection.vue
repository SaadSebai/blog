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

<script>
    import Comment from './Comment.vue';
    import CommentForm from './CommentForm.vue';

    export default {
        components: {
            Comment,
            CommentForm,
        },
        props: ['blog'],
        data() {
            return {
                comments: null,
                loadable: true,
                nextPage: null,
            };
        },
        methods: {
            loadComments() {
                if(this.loadable)
                {
                    this.$inertia.get(this.nextPage ?? route('blogs.comments.index', this.blog.id), {}, {
                        preserveState: true,
                        preserveScroll: true,
                        only: ['comments'],
                        onSuccess: ({props}) => {
                            this.comments = this.nextPage ? [...this.comments, ...props.comments.data] : props.comments.data;
                            if(props.comments.next_page_url && this.nextPage != props.comments.next_page_url)
                            {
                                this.nextPage = props.comments.next_page_url;
                            }
                            else
                            {
                                this.loadable = false;
                                this.nextPage = null;
                            }
                        }
                    });
                }
            },
            created()
            {
                this.comments = null;
                this.loadable = true;
                this.nextPage = null;
            },
            deleted(comment) {
                this.comments.pop(comment);
            },
        },
    };
</script>
