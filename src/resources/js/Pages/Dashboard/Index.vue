<template>
    <NavLogin />
  <CardLayoutFluid title="Dashboard">
    Render widgets <Link class="link-primary" :href="route('route.dashboard.welcome')">Welcome</Link>
      <hr>
      <div>
          <Widget v-for="widget in $store.state.main.ComponentsAsync['Dashboard/Widget']"
                  :widget-name="widget.path"
                  />
      </div>
  </CardLayoutFluid>
</template>

<script setup>
  import { Link } from '@inertiajs/vue3';
  import CardLayoutFluid from "../../Layouts/CardLayoutFluid.vue";
  import NavLogin from "../../Components/Dashboard/Nav.vue";
  import Widget from "./Widget.vue";
</script>
<script>
  export default {
    props: {
      text: String
    },
    data() {
      return {

      }
    }
  };
</script>