<template>
    <header class="header">
        <div class="container">
            <div class="header__left">
                <a href="/" title="Boolpress">
                    <h1 class="title">Boolpress</h1>
                </a>
            </div>
            <div class="header__right">
                <a href="/admin/home" title="Area riservata">Area riservata</a>
            </div>
        </div>
    </header>
</template>

<script>
export default {
    name: 'Header'
}
</script>

<style lang="scss" scoped>
@import '../../../sass/_variables.scss';
.header {
    width: 100%;
    padding: 1rem 0;
    background-color: $_blue;
    font-weight: 200;
    * {
        color: $_white;
    }
    .container {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    &__left .title {
        font-weight: 200;
        font-size: 3rem;
    }
}
</style>