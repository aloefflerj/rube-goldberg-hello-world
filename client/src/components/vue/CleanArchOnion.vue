<script setup lang="ts">
import type AppLog from '../../types/AppLog';

defineProps<{
    appLog: () => AppLog
}>();

</script>

<template>
    <div class="log-box">
        <div class="log-class">
            <h3 v-if="appLog().className !== ''">
                {{ appLog().className }}::{{ appLog().functionName }}
            </h3>
        </div>
        <div class="log-abstraction-type" :class="[ appLog().abstractionType ]">
            <h4>{{ appLog().abstractionType }}</h4>
        </div>
        <div class="clean-arch-wrapper">
            <div class="frameworks-drivers" :class="[ appLog().abstractionLayer === 'frameworkDriver' ? 'highlight' : '' ]"></div>
            <div class="adapters" :class="[ appLog().abstractionLayer === 'adapter' ? 'highlight' : '' ]"></div>
            <div class="application" :class="[ appLog().abstractionLayer === 'useCase' ? 'highlight' : '' ]"></div>
            <div class="domain-layer" :class="[ appLog().abstractionLayer === 'domain' ? 'highlight' : '' ]"></div>
        </div>
        <div class="layers-labels">
           <li>
                <span class="frameworks-drivers"></span>
                <h5>Frameworks & Drivers</h5>
            </li>
           <li>
                <span class="adapters"></span>
                <h5>Interface Adapters</h5>
            </li>
           <li>
                <span class="application"></span>
                <h5>Application Business Rules</h5>
            </li>
           <li>
                <span class="domain-layer"></span>
                <h5>Enterprise Business Rules</h5>
            </li>
        </div>
    </div>
</template>

<style>
    h3 {
        font-size: 28px;
        color: #17615D;
    }

    div.log-class {
        position: absolute;
        z-index: 5;
        top: 0;
    }

    div.log-abstraction-type {
        position: absolute;
        z-index: 6;
    }

    div.log-abstraction-type > h4 {
        font-size: 24px;
    }

    div.webFramework {
        top: 11%;
    }
    
    div.webFramework > h4 {
        color: #455999;
    }

    div.webAdapter {
        top: 18%;
    }

    div.webAdapter > h4  {
        color: #17615D;
    }

    div.useCase {
        top: 5;
    }

    div.useCase > h4 {
        color: #85444F;
    }

    div.domain {
        top: 5;
    }

    div.domain > h4 {
        color: #6a8039;
        z-index: 700;
    }

    div.mysqlAdapter {
        bottom: 18%;
    }

    div.mysqlAdapter > h4 {
        color: #17615D;
    }

    div.mysqlDriver {
        bottom: 11%;
    }

    div.mysqlDriver > h4 {
        color: #455999;
    }

    div.log-box {
        display: flex;
        height: 90%;
        position: relative;
        align-items: center;
        justify-content: center;
    }

    div.clean-arch-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            /* margin-top: 20%; */
            height: 90%;
            position: relative;
    }

    div.highlight {
        opacity: 1 !important;
    }

    div.frameworks-drivers {
        background-color: #A7D7FD;
        display: flex;
        border-radius: 50%;
        margin: 8%;
        box-shadow: 0 0 20px 1px #17615D;
        height: 80%;
        aspect-ratio: 1;
        position: absolute;
        opacity: 0.4;
    }

    div.adapters{
        background-color: #A2FDBA;
        display: flex;
        flex-basis: 100%;
        border-radius: 50%;
        margin: 11%;
        box-shadow: 0 0 20px 1px #455999;
        line-height: 2rem;
        aspect-ratio: 1;
        position: absolute;
        height: 65%;
        z-index: 1;
        opacity: 0.4;
    }

    div.application{
        background-color: #FAACA9;
        display: flex;
        flex-basis: 100%;
        border-radius: 50%;
        margin: 14%;
        box-shadow: 0 0 20px 1px #508B6B;
        line-height: 2rem;
        aspect-ratio: 1;
        position: absolute;
        height: 48%;
        z-index: 2;
        opacity: 0.4;
    }

    div.domain-layer{
        background-color: #FCFDB9;
        display: flex;
        flex-basis: 100%;
        border-radius: 50%;
        margin: 20%;
        box-shadow: 0 0 20px 1px #85444F;
        line-height: 2rem;
        aspect-ratio: 1;
        position: absolute;
        height: 33%;
        z-index: 3;
        opacity: 0.1;
    }

    div.layers-labels {
        position: absolute;
        bottom: 0;
        left: 0;
        display: flex;
        flex-direction: column;
        gap: 16px;
        margin: 40px;
    }

    div.layers-labels > li {
        display: flex;
        align-items: center;
    }
    
    div.layers-labels > li > h5 {
        font-size: 24px;
        color: #17615D;
        padding: 0 0 2px 20px;
        margin: 0;
    }

    span {
        display: block;
        width: 24px;
        height: 24px;
    }
    
    span.frameworks-drivers {
        background-color: #A7D7FD;
    }

    span.adapters {
        background-color: #A2FDBA;
    }

    span.application {
        background-color: #FAACA9;
    }
    
    span.domain-layer {
        background-color: #FCFDB9;
    }
</style>