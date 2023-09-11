<template>
    <div class="vue-box">
        <div class="header">
            <h2>{{ title }}</h2>
        </div>
        <slot />
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
export default defineComponent({
    name: 'VueBox',
    props: {
        title: {
            type: String
        }
    }
});
</script>

<style scoped>
    h2 {
        padding: 0;
        margin: 0;
        color: #17615d;
    }    
    div.header {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 10%;
        padding: 0;
        margin: 0;
        background-color: #37a38c;
    }
    div.vue-box {
        background-color: #42B883;
        width: 100%;
        height: 100%;
    }
</style>
