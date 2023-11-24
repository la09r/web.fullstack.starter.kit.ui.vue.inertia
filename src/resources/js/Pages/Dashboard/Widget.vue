<template>
    <component :is="comp"></component>
</template>

<script>
import {defineAsyncComponent} from "vue";

export default {
    name: "Dynamic Dashboard Widget Component",
    props: {
        componentName: {
            type: String,
            required: true
        }
    },
    computed: {
        comp () {
            return defineAsyncComponent(() => import(`../../../../../../../resources/js/ComponentsAsync/Dashboard/Widget/${this.componentName}.vue`))
        }
    }
}
</script>