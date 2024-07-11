<script lang="ts">
    import { onMount } from "svelte";
    export let particles: any[] = [];

    onMount(async () => {
        const wsUrl = "ws://localhost:16000/newEntity/svelte";
        const webSocket = new WebSocket(wsUrl);

        webSocket.onmessage = (e) => {
            const particle = JSON.parse(e.data.toString());
            particles.push(particle);
            particles = particles;
        };
    });
</script>

<div>
    <ul>
        {#each particles as { id, charge }}
            <li>{id} - {charge}</li>
        {:else}
            <l1>loading...</l1>
        {/each}
    </ul>
</div>

<style>
</style>
