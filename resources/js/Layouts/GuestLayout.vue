<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center py-5 bg-light">
    <div>
      <Link href="/" class="text-decoration-none">
        <ApplicationLogo class="w-20 h-20 text-muted" />
      </Link>
    </div>

    <div class="w-25 max-w-md mt-4 px-4 py-3 bg-white shadow rounded">
      <slot />
    </div>
  </div>
</template>
