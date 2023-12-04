<template>
    <NavLogin />
  <CardLayoutFluid title="Dashboard" :showSpeedDialOptions="showSpeedDialOptions">
      <div class="row">
          <Widget v-for="(widget, index) in getWidgets()"
                  :name="widget.path"
                  :index="index"
                  :number="index + 1"
                  />
      </div>
  </CardLayoutFluid>
</template>

<script setup>
  import { ref } from 'vue';
  import { useToast } from 'primevue/usetoast';

  import { Link } from '@inertiajs/vue3';
  import CardLayoutFluid from "@/Layouts/CardLayoutFluid.vue";
  import NavLogin from "@/Components/Dashboard/Nav.vue";
  import Widget from "./Widget.vue";


  import { useDialog } from 'primevue/usedialog';
  const dialog = useDialog();

  window.PRIMEVUE_SERVICE_DIALOG = dialog;
</script>
<script>
  import WidgetDialogAdd from './WidgetDialogAdd.vue';
  import {setLocalStorageKey, getLocalStorageKey} from "@/function.js";

  export default {
    props: {
      text: String
    },
    data() {
      return {
          showSpeedDialOptions: {
              show: true,
              items: [
                  {
                      label: 'Delete',
                      icon: 'pi pi-times',
                      command: (e) => {
                          // this.$toast.add({ severity: 'info', summary: 'Delete', detail: 'Data Deleted' });
                          this.$store.commit('mainDashboardWidgetVisibleBtnDeleteCommit');
                      }
                  },
                  {
                      label: 'Add',
                      icon: 'pi pi-plus',
                      command: () => {
                          // this.$toast.add({ severity: 'info', summary: 'Add', detail: 'Data Added' });

                          if(this.$store.state.main.Component.DashboardWidget.btn.hide)
                          {
                              this.$store.commit('mainDashboardWidgetVisibleBtnDeleteCommit');
                          }

                          window.PRIMEVUE_SERVICE_DIALOG.open(WidgetDialogAdd, {
                              props: {
                                  header: 'Add Widget',
                                  style: {
                                      width: '50vw',
                                  },
                                  breakpoints:{
                                      '960px': '75vw',
                                      '640px': '90vw'
                                  },
                                  modal: true
                              }
                          });
                      }
                  },
              ]
          }
      }
    },
      methods: {
          getWidgets()
          {
              let state = this.$store.state.main.ComponentsAsync['Dashboard/Widget'];
              let widgetsDeleted = getLocalStorageKey('store_state_dashboard_widget') ?? [];


              for(let i = 0; i < state.length; i++)
              {
                  for(const widgetDeleted of widgetsDeleted)
                  {
                      if(state[i].path == widgetDeleted.path)
                      {
                          state.splice(i, 1);
                          break;
                      }
                  }
              }
              return state;
          }
      }
  };
</script>