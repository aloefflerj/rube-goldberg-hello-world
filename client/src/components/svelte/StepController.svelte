<script lang="ts">
    import type Step from "../../types/Step";
    import { currentStep } from '../../service/Steps.service';

    export let steps: Step[] = [];

    const step = currentStep(steps);
</script>

{#if step?.title === "prologue"}
    <h1>prologue</h1>
{:else}
    <h1>not found</h1>
{/if}
