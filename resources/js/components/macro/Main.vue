<template>
    <main class="main">
        <div class="container">
            <div class="posts-wrapper">
                <Post v-for="(post, index) in posts" :key="post.id" :index="index" :post="post"/>
            </div>
        </div>
    </main>
</template>

<script>

import Post from '../commons/Post.vue'

export default {
    name: 'Main',
    components: { Post },
    data() {
        return {
            posts: []
        }
    },
    created() {
        axios.get('api/posts')
            .then(response => {
                this.posts = response.data
            })
    }
}
</script>

<style lang="scss" scoped>
.main {
    margin: 1rem 0;
    @media screen and (min-width: 768px) {
        margin: 2rem 0;
    }
    .posts-wrapper {
        background-color: #fff;
        padding: .5rem;
        display: flex;
        flex-wrap: wrap;
    }
}
</style>