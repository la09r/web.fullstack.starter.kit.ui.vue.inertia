<template>
    <div class="col-lg-3 col-md-6 col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div>{{index}}: {{name}}</div>
                <Button v-if="$store.state.main.Component.DashboardWidget.btn.hide"
                        @click="hideWidget(name, index)"
                        icon="pi pi-times" severity="danger" rounded raised class="smaller">
                </Button>
            </div>
            <div class="card-body">
                <component :is="computeAsyncComponent"></component>

            </div>
        </div>
    </div>
</template>

<script setup>
import Button from 'primevue/button';
</script>
<script>
import {defineAsyncComponent} from "vue";
import {setLocalStorageKey, getLocalStorageKey} from "@/function.js";

export default {
    name: "Dynamic Dashboard Widget Component",
    props: {
        name: {
            type: String,
            required: true
        },
        index: {
            type: Number,
            required: true
        },
        number: {
            type: Number,
            required: true
        },
    },
    methods: {
        hideWidget: function (name, index) {
            let state = this.$store.state.main.ComponentsAsync['Dashboard/Widget'];
            let widgetsDeleted = getLocalStorageKey('store_state_dashboard_widget');

            for(let i = 0; i < state.length; i++)
            {
                if(state[i].path == name)
                {
                    widgetsDeleted.push(state[i]);
                    state.splice(i, 1);

                    setLocalStorageKey('store_state_dashboard_widget', widgetsDeleted)
                    break;
                }
            }
        }
    },
    mounted() {
        if(!getLocalStorageKey('store_state_dashboard_widget'))
        {
            setLocalStorageKey('store_state_dashboard_widget', [])
        }
    },
    computed: {
        computeAsyncComponent () {
            return defineAsyncComponent(() => import(`../../../../../../../../resources/js/ComponentsAsync/Dashboard/Widget/${this.name}.vue`));
        }
    }
}
</script>