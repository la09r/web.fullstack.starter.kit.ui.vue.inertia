<template>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
              <div>{{ title }}</div>
              <Button v-if="showButtonAdd" @click="$emit('callbackButtonAdd', {})" icon="pi pi-plus" rounded raised ></Button>
              <Button v-if="showButtonOptions" @click="$emit('callbackButtonOptions', { options: showButtonOptions})" icon="pi pi-cog" rounded raised ></Button>
              <div class="speed-dial-default"  v-if="showSpeedDialOptions">
                <SpeedDial :model="showSpeedDialOptions.items" showIcon="pi pi-cog" direction="left" :style="{ position: 'relative', right: 'calc(0% + 0px)', top: '0px' }" />
              </div>
            </div>
          </div>
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
  import Button from "primevue/button"
  import SpeedDial from 'primevue/speeddial';

</script>
<script>
  export default {
    props: {
        title: String,
        showButtonAdd: Boolean,
        showButtonOptions: Object,
        showSpeedDialOptions: Object,
        dynamicDialog: Object,
    },
    data() {
      return {}
    },
  };
</script>