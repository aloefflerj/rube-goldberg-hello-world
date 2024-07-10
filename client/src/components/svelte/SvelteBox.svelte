<script lang="ts">
    export let title: string;
</script>

<div class="svlete-box">
    <div class="header">
        <h2>{ title }</h2>
    </div>
    <slot />
</div>

<style scoped>
    h2 {
        padding: 0;
        margin: 0;
        color: #812d18;
    }
    div.header {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 10%;
        padding: 0;
        margin: 0;
        background-color: #cc6146;
    }
    div.svlete-box {
        background-color: #d48875;
        width: 100%;
        height: 100%;
    }
</style>
