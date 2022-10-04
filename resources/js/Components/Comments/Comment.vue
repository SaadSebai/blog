<template>
    <div class="my-4 px-10">
        <div class="flex">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 16 16" stroke="currentColor" stroke-width="2">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
            </svg>
            <div class="flex-1">
                <div class="flex justify-between items-center">
                    <div>
                        <span class="ml-2 text-gray-800">{{ comment.user.name }}</span>
                        <small class="ml-2 text-sm text-gray-600">{{ dayjs(comment.created_at).fromNow() }}</small>
                        <small v-if="comment.created_at !== comment.updated_at" class="text-sm text-gray-600"> &middot; edited</small>
                    </div>
                    <Dropdown v-if="comment.user.id === $page.props.auth.user.id">
                        <template #trigger>
                            <button>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                            </button>
                        </template>
                        <template #content>
                            <DropdownLink
                                as="button"
                                :href="route('blogs.comments.destroy', [comment.blog_id, comment.id])"
                                @click="$emit('deleted', this.comment)"
                                method="delete"
                                preserve-scroll
                            >
                                Delete
                            </DropdownLink>
                        </template>
                    </Dropdown>
                </div>
            </div>
        </div>

        <div class="ml-6  mt-2">
            {{ comment.body }}
        </div>
        <hr>
    </div>
</template>

<script>
    import dayjs from 'dayjs';
    import relativeTime from 'dayjs/plugin/relativeTime';
    import Dropdown from '@/Components/Dropdown.vue';
    import DropdownLink from '@/Components/DropdownLink.vue';

    dayjs.extend(relativeTime);
    export default {
        components: {
            dayjs,
            Dropdown,
            DropdownLink,
        },
        props: ['comment'],
        data() {
            return {
                dayjs,
            };
        },
    };

</script>
