<template>
  <CardLayout title="Error">
    Error {{ text }} <br>
    <Link :href="route('route.dashboard')">Dashboard</Link>
  </CardLayout>
</template>

<script setup>
  import { Link } from '@inertiajs/vue3';
  import CardLayout from "@/Layouts/CardLayout.vue";
</script>
<script>
  export default {
    props: {
      text: String
    },
    data() {
      return {}
    }
  };
</script>