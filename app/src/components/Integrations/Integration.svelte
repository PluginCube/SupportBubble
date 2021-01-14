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
        box-shadow: rgba(0, 0, 0, 0.1) 0px 12px 24px 0px;
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