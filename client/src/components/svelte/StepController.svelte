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

<style>
    div.body {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 90%;
    }
</style>

<div class="body">
    {#if step?.title === stepPossibleTitles.prologue}
        <img src="/assets/prologue.gif" alt="prologue"/>
    {:else if step?.title === stepPossibleTitles.beggining}
        <img src="/assets/beggining.png" alt="beggining"/>
    {:else if step?.title === stepPossibleTitles.theUniverse}
        <img src="/assets/the-universe.gif" alt="the-universe"/>
    {:else if step?.title === stepPossibleTitles.inflation}
        <img src="/assets/inflation.gif" alt="inflation"/>
    {:else if step?.title === stepPossibleTitles.bigBang}
        <img src="/assets/big-bang.gif" alt="big-bang"/>
    {:else if step?.title === stepPossibleTitles.nucleosynthesis}
        <img src="/assets/nucleosynthesis.gif" alt="nucleosynthesis"/>
    {:else if step?.title === stepPossibleTitles.recombination}
        <img src="/assets/recombination.gif" alt="recombination"/>
    {:else if step?.title === stepPossibleTitles.firstStars}
        <img src="/assets/first-stars.gif" alt="first-stars"/>
    {:else if step?.title === stepPossibleTitles.ourSun}
        <img src="/assets/our-sun.gif" alt="our-sun"/>
    {:else if step?.title === stepPossibleTitles.ourPlanet}
        <img src="/assets/our-planet.gif" alt="our-planet"/>
    {:else if step?.title === stepPossibleTitles.helloWorld}
        <a href="https://github.com/aloefflerj/rube-goldberg-hello-world" target="_blank">
            <img src="/assets/hello-world.png" alt="hello-world"/>
        </a>
    {:else}
        <img src="/assets/beggining.png" alt="beggining"/>
    {/if}
</div>
