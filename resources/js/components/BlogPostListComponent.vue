<template>
    <div class="container">
        <div class="blog-post" v-for="post in posts.data" :key="post._id">
            <h2 class="blog-post-title"><a :href="`/posts/${post._id}`">{{post.title}}</a></h2>
            <p class="blog-post-meta">{{post.created_at}} </p>
            <p>{{post.content}}</p>
        </div>
        <div v-if="posts.total === 0" class="card-title">
            Please add some posts.
        </div>
        <pagination :data="posts" @pagination-change-page="getPosts"></pagination>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                posts: {},
            }
        },
        created() {
            this.getPosts();
        },
        methods: {
            getPosts(page) {
                if (typeof page === 'undefined') {
                    page = 1;
                }

                this.$http.get('/api/posts?page=' + page)
                    .then(response => {
                        return response.json();
                    }).then(data => {
                    this.posts = data;
                });
            }
        }
    }
</script>
