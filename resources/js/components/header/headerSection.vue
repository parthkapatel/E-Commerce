<template>
    <div>
        <nav class="navbar navbar-expand-lg navDiv navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">E-Commerce</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 pull-right" v-if="!isLogged">
                        <li class="nav-item">
                            <router-link class="nav-link" to="/login">Login</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/register">Register</router-link>
                        </li>
                    </ul>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 " v-else-if="role === 'A'">
                        <li class="nav-item">
                            <router-link class="nav-link" to="/admin/home">
                                Dashboard
                            </router-link>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="categoryDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                Category
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="categoryDropdown">
                                <router-link class="dropdown-item" to="/admin/create-category/">
                                    Add New Category
                                </router-link>
                                <router-link class="dropdown-item" to="/admin/view-category/">
                                    View category
                                </router-link>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="productDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                Product
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="productDropdown">
                                <router-link class="dropdown-item" to="/admin/create-product/">
                                    Add New Product
                                </router-link>
                                <router-link class="dropdown-item" to="/admin/view-product/">
                                    View Product
                                </router-link>
                                <router-link class="dropdown-item" to="/admin/upload-product-images/">
                                    Upload Product Images
                                </router-link>
                                <router-link class="dropdown-item" to="/admin/assign-categories-to-product/">
                                    Assign Categories To Product
                                </router-link>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <div style="cursor: pointer;" class="nav-link dropdown-toggle" id="nameDropdown" role="button"
                                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ fullName }}
                            </div>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" @click="logout()" > Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
import {mapGetters} from 'vuex'

export default {
    name: "headerSection",
    computed: {
        ...mapGetters([
            'isLogged',
            'userName',
            'fullName',
            'role',
        ])
    },
    methods: {
        logout() {
            this.$store.dispatch('logout')
        },
    },
}
</script>

<style scoped>
.navDiv{
    background-color: #00203FFF;
}
</style>
