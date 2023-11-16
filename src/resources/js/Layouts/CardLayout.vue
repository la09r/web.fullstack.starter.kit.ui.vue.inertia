<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ title }}</div>
          <div class="card-body">
            <slot />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
  import { Link } from '@inertiajs/vue3';
</script>
<script>
  export default {
    props: {
      title: String
    },
    data() {
      return {}
    }
  };
</script>