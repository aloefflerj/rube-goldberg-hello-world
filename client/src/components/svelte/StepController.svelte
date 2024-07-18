<script lang="ts">
    export let steps: any[] = [];

    const currentStep = steps.find((step) => step.status === "ongoing");
</script>

{#if currentStep.title === "prologue"}
    <h1>prologue</h1>
{:else}
    <h1>not found</h1>
{/if}
