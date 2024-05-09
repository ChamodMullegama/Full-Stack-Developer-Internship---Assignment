<template>
    <div>
        <Navbar />
        <div class="container">
            <slot name="content" />
        </div>
        <Footer />
    </div>
</template>
<script setup>
import Navbar from '@/Components/Main/Navbar.vue';
import Footer from '@/Components/Main/Footer.vue';
</script>
