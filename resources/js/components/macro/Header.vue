<template>
    <header class="header">
        <div class="container">
            <div class="header__left">
                <a href="/" title="Boolpress">
                    <h1 class="title">Boolpress</h1>
                </a>
            </div>
            <div class="header__right">
                <a href="/admin/home" title="Area riservata"><button class="btn">Area riservata</button></a>
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
    box-shadow: 0 .3rem .3rem rgba(0, 0, 0, 0.3);
    position: sticky;
    z-index: 999;
    top: 0;
    left: 0;
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
    &__right .btn {
        background-color: $_darkBlue;
        box-shadow: 0 0 .3rem $_darkBlue;
    }
}
</style>