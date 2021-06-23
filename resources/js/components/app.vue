<template>
    <div>
        <header-section/>
        <div class="container-fluid p-0 bodyColor">
            <router-view/>
        </div>
        <footer-section />
    </div>
</template>

<script>
import headerSection from "./header/headerSection";
import footerSection from "./footer/footerSection";

export default {
    name: "app",
    components: {
        headerSection,
        footerSection
    }
}
</script>

<style scoped>

</style>
