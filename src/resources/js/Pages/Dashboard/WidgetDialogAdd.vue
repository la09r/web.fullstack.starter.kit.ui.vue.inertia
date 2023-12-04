<template>
    <div class="card flex justify-content-center">
        <Listbox v-model="selectedItem" :options="items" optionLabel="path" class="w-full" >
            <template #option="slotProps">
                <div class="flex align-items-center" @click="addWidget(slotProps.option.path)">
                    {{ slotProps.option.path }}
                </div>
            </template>
        </Listbox>
    </div>
</template>

<script setup>
import Listbox from 'primevue/listbox';

import { ref } from "vue";
import {setLocalStorageKey, getLocalStorageKey, delLocalStorageKey} from "@/function.js";

const selectedItem = ref();
let items = ref(getLocalStorageKey('store_state_dashboard_widget'));

import {useStore} from 'vuex';
const store = useStore();

function addWidget(path)
{
    // delLocalStorageKey()
    let state           = store.state.main.ComponentsAsync['Dashboard/Widget'];
    let widgetsDeleted  = getLocalStorageKey('store_state_dashboard_widget');

    let stateNew = [ ...state ];

    for(let i =0; i < widgetsDeleted.length; i++)
    {
        if(widgetsDeleted[i].path == path)
        {
            stateNew.push(widgetsDeleted[i]);
            widgetsDeleted.splice(i, 1);
        }
    }

    setLocalStorageKey('store_state_dashboard_widget', widgetsDeleted);

    store.commit('mainSetComponentsAsyncByKey', { key: 'Dashboard/Widget', value: stateNew });
    items = ref(getLocalStorageKey('store_state_dashboard_widget'));
}
</script>

<script>
import { getLocalStorageKey } from '@/function.js';
export default {
    name: "WidgetDialogAdd",
}
</script>

<style scoped>

</style>