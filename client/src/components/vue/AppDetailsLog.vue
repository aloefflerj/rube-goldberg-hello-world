<script setup lang="ts">
 
import { ref } from 'vue';
import type AppLog from '../../types/AppLog';
import CleanArchOnion from './CleanArchOnion.vue';

const appLog = ref<AppLog>({
    messageType: '',
    className: '',
    functionName: '',
    abstractionLayer: '',
    abstractionType: ''
});

const wsUrl = 'ws://localhost:16000/cleanArch';
const webSocket = new WebSocket(wsUrl);

webSocket.onmessage = (e) => {
    const value = JSON.parse(e.data.toString());
    appLog.value = value;
}
</script>

<template>
        <CleanArchOnion :appLog="() => appLog" v-bind="$props"/>
</template>

<style scoped>
    h2 {
        padding: 0;
        margin: 0;
        color: #17615d;
    }
    
</style>