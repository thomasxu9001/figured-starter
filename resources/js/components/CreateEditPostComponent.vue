<template>
    <div class="container">
        <div class="form-group">
            <label>Title</label>
            <input name="title" type="text" class="form-control" placeholder="Here is Title" v-model="title">
        </div>
        <div class="form-group">
            <label>Content</label>
            <textarea id="content" name="content" class="form-control" style="height:400px;max-height:500px;"  placeholder="Here is Content" v-model="content"></textarea>
        </div>
        <button v-on:click="buttonClickHandler">{{buttonName}}</button>
    </div>
</template>

<script>
    export default {
        props: {
            id: String
        },
        mounted() {
            if (this.id) {
                this.getPostDetail();
                this.buttonName = 'Edit Post';
            } else {
                this.buttonName = 'Create Post';
            }
        },
        data() {
            return {
                title: this.title,
                content: this.content,
                buttonName: this.buttonName
            }
        },
        methods: {
            getPostDetail() {
                this.$http.get('/api/posts/'+ this.id)
                    .then(response => {
                        return response.json();
                    }).then(data => {
                    this.title = data.title;
                    this.content = data.content;
                });
            },
            editPost() {
                this.$http.put('/api/posts/' + this.id, {
                    title: this.title,
                    content: this.content
                })
                    .then(response => {
                        return response.json();
                    }).then(data => {
                    window.location.href = `/posts/${data._id}`;
                });
            },
            createPost() {
                this.$http.post('/api/posts/',{
                    title: this.title,
                    content: this.content
                })
                    .then(response => {
                        return response.json();
                    }).then(data => {
                    window.location.href = `/posts/${data._id}`;
                });
            },
            buttonClickHandler() {
                if (this.id) {
                    this.editPost();
                } else {
                    this.createPost();
                }
            }
        }
    }
</script>
