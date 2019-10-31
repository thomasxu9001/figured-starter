<template>
    <div class="container blog-main">
        <div class="blog-post">
            <div>
                <button class="bg-light back-button" v-on:click="goBack">Go to list</button>
            </div>
            <div>
                <h2 class="blog-post-title">{{post.title}}</h2>

                <button class="bg-info action-button" v-if="hasPermission" v-on:click="editPost">Edit</button>
                <button class="bg-danger action-button" v-if="hasPermission" v-on:click="deletePost">Delete</button>

            </div>

            <p class="blog-post-meta">{{post.created_at}}</p>

            <p>{{post.content}}</p>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            id: String,
            hasPermission: String,
            token: String
        },
        mounted() {
            this.getPostDetail();
        },
        data() {
            return {
                post: [],
            }
        },
        methods: {
            getPostDetail() {
                this.$http.get('/api/posts/'+ this.id)
                    .then(response => {
                        return response.json();
                    }).then(data => {
                    this.post = data;
                });
            },
            editPost() {
                window.location.href = `/posts/edit/${this.id}`;
            },
            deletePost() {
                let headers = this.getTokenHeader();
                this.$http.delete('/api/posts/'+ this.id, {headers})
                    .then(response => {
                        return response.json();
                    }).then(() => {
                    window.location.href = `/posts/`;
                });
            },
            goBack() {
                window.location.href = `/posts/`;
            },
            getTokenHeader() {
                let headers = {
                    'Content-Type': 'application/json;charset=utf-8'
                };
                headers['Authorization'] = 'Bearer '+ this.token;
                return headers;
            }
        }
    }
</script>
