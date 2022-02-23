<template>
    <main class="main">
        <div class="container">
            <h3>Posts</h3>
            <ul>
                <li v-for="post in posts" :key="post.id">
                    {{ post.title }}
                </li>
            </ul>
        </div>
    </main>
</template>

<script>
export default {
    name: 'Main',
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

</style>