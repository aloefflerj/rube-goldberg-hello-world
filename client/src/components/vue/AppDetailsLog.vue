<template>
    <div class="log-box">
        <h2>Message Type: <u>{{ appLog.messageType }}</u></h2>
        <h2>Class Name: <u>{{ appLog.className }}</u></h2>
        <h2>Function Name: <u>{{ appLog.functionName }}</u></h2>
        <h2>Abstraction Layer: <u>{{ appLog.abstractionLayer }}</u></h2>
    </div>
</template>

<script setup lang="ts">
 
import { ref } from 'vue';
import type AppLog from '../../types/AppLog';

const wsUrl = 'ws://localhost:16000/cleanArch';
const webSocket = new WebSocket(wsUrl);
const appLog = ref<AppLog>({
    messageType: '...',
    className: '...',
    functionName: '...',
    abstractionLayer: '...'
});

webSocket.onmessage = (e) => {
    const value = JSON.parse(e.data.toString());
    appLog.value = value;
}
</script>

<style scoped>
    h2 {
        padding: 0;
        margin: 0;
        color: #17615d;
    }
    div.log-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 80%;
    }
</style>