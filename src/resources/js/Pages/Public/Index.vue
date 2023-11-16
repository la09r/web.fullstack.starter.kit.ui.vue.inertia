<template>
  <CardLayout title="Home">
    {{ text }} <br>
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