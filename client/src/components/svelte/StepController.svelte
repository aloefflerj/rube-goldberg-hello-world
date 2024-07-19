<script lang="ts">
    import type Step from "../../types/Step";
    import { currentStep } from '../../service/Steps.service';
    import { stepPossibleTitles } from "../../helpers/StepPossibleTitles";
    import { useWebSocket } from "../../hooks/useWebSocket";
    import { onMount } from "svelte";

    export let steps: Step[] = [];

    let step = currentStep(steps);
    
    onMount(async () => {
        const { onMessage } = useWebSocket('/steps/svelte');
        onMessage((e) => {
            step = JSON.parse(e.data.toString());
        });
	});

</script>

{#if step?.title === stepPossibleTitles.prologue}
    <h1>prologue</h1>
{:else if step?.title === stepPossibleTitles.bigBang}
    <h1>big bang</h1>
{:else}
    <h1>not found</h1>
{/if}
