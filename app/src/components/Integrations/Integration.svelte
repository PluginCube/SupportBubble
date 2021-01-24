<script>
    import { fly } from 'svelte/transition'

    import { integration, showIntegration } from "store"

    import WhatsApp from './WhatsApp'
    import Messenger from './Messenger'
    import Form from './Form'

    let types = {
        whatsapp: WhatsApp,
        messenger: Messenger,
        form: Form
    }

    let close = () => {
        showIntegration.set(false)
    }
</script>

<style lang="scss">
    div {
        box-shadow: rgba(0, 0, 0, 0.1) 0px 12px 24px 0px;
        background: #fff;
        position: absolute;
        bottom: 0px;
        right: 0;
        border-radius: 10px;
        margin: 0;
        overflow: hidden;

        > i {
            position: absolute;
            right: 0;
            margin: 7px;
            padding: 3px;
            color: #999;
            background: rgba(0, 0, 0, 0.05);
            border-radius: 50px;
            opacity: 0;
            cursor: pointer;
            
            svg {
                width: 13px;
                fill: currentColor;
            }
        }

        &:hover > i {
            opacity: 1;
        }
    }
</style>

<div transition:fly={{x: 40}}>
    <i on:click={close}>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path fill="none" d="M0 0h24v24H0z"/>
            <path d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z"/>
        </svg>
    </i>
    
    <svelte:component this={types[$integration.type]} options={$integration} />
</div>