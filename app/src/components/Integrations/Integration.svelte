<script>
    import { fly } from 'svelte/transition'

    import { integration } from "store"

    import WhatsApp from './WhatsApp'

    let types = {
        whatsapp: WhatsApp,
    }
</script>

<style>
    div {
        box-shadow: 0px 0px 50px rgba(0,0,0,0.15);
        background: #fff;
        position: absolute;
        bottom: 75px;
        right: 0;
        border-radius: 10px;
        margin: 0;
    }
</style>

<div transition:fly={{x: 40}}>
    <svelte:component this={types[$integration.type]} options={$integration} />
</div>