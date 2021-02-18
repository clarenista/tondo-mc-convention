<template>
    <div>
        <b-navbar toggleable="lg" type="dark" variant="info">
            <b-navbar-brand href="/">AC</b-navbar-brand>

            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse id="nav-collapse" is-nav>
            <b-navbar-nav>
                <!--<b-nav-item href="#" >Link</b-nav-item> -->
            </b-navbar-nav>

            <!-- Right aligned nav items -->
            <b-navbar-nav class="ml-auto">
                <router-link class="nav-link" :to="'/registration'">Registration</router-link>
                <router-link class="nav-link" :to="'/login'">Login</router-link>
                <router-link class="nav-link" :to="'/boothman'">Booth Manager</router-link>
            </b-navbar-nav>
            </b-collapse>
        </b-navbar>
        <div class="container mt-3">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {}
</script>