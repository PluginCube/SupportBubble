<script>
    import { onMount } from 'svelte'
    import { fly } from 'svelte/transition'
    import {
        bubble,
        showBubble,
        showMenu,
        showPrompts,
        showIntegration,
    } from 'store'

    import { bubbleClick } from 'methods'

    import Bubble from './Bubble'
    import Prompts from './Prompts'
    import Menu from './Menu'

    import Integration from './Integrations/Integration'

    let style = ``

    onMount(() => {
        showBubble.set(true)
        
        if ($bubble.automatically_expand) {
            bubbleClick()
        } else {
            setTimeout(() => {
                showPrompts.set(true)
            }, 500)
        }
    })
</script>

<style lang="scss">
    div {
        position: fixed;
        z-index: 999;
        margin: 55px;
        min-width: 220px;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto,
            Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif;
        bottom: 0;
        right: 0;

        :global(.with-pointer-arrow) {
            &::before {
                content: '';
                position: absolute;
                bottom: -6px;
                right: 20px;
                left: auto;
                border-right: 8px solid transparent;
                border-top: 8px solid #ffffff;
                border-left: 8px solid transparent;
                border-bottom: 0px solid transparent;
            }
        }
    }
</style>

{#if $showBubble}
    <div transition:fly={{ y: 100, duration: 500 }} {style}>
        {#if !$showIntegration}
            <Bubble />
        {/if}

        {#if !$showMenu && $showPrompts && 'prompts' in $bubble}
            <Prompts />
        {/if}

        {#if $showMenu}
            <Menu />
        {/if}

        {#if $showIntegration}
            <Integration />
        {/if}
    </div>
{/if}