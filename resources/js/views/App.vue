<template>

    <div>

        <Header />

        <main>
            <!-- component matched by the route will be render here -->
            <router-view></router-view>
        </main>
    </div>

</template>

<script>
import Header from '../components/Header'


export default {
    name:'App',
    components: {
        Header,

    },
}
</script>

<style lang="scss">

</style>