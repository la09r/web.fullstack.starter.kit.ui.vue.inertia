<template>
  <CardLayout title="Dashboard">
    {{ text }} 1 <br>
    <Link class="link-primary" :href="route('route.dashboard.welcome')">Welcome</Link>
  </CardLayout>
</template>

<script setup>
  import { Link } from '@inertiajs/vue3';
  import CardLayout from "../../Layouts/CardLayout.vue";
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