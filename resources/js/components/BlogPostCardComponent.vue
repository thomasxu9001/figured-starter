<template>
    <div class="container">
        <div class="blog-post" v-for="post in posts.data" :key="post._id">
            <h2 class="blog-post-title"><a :href="`/posts/${post._id}`" >{{post.title}}</a></h2>
            <p class="blog-post-meta">{{post.created_at}} </p>
            <p>{{post.content}}</p>
        </div>
        <pagination :data="posts" @pagination-change-page="getResults"></pagination>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log(this.posts);
        },
        data() {
            return {
                posts: {},
            }
        },
        created() {
            this.getResults();
        },
        methods: {
            getResults(page) {
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
