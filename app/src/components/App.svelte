<script>
    import { onMount } from 'svelte'
    import { fly } from 'svelte/transition'
    import { button, showButton, showMenu, showPrompts, showIntegration } from 'store'

    import Button from './Button'
    import Prompts from './Prompts'
    import Menu from './Menu'

    import Integration from './Integrations/Integration'

    let style = ``

    // Position style
    $: ['top', 'bottom', 'left', 'right'].forEach((e) => {
        if ($button.position.includes(e)) {
            style += e + ': 0;'
        }
    })

    onMount(() => {
        showButton.set(true)

        setTimeout(() => {
            showPrompts.set(true)
        }, 3000);
    })
</script>

<style lang="scss">
    div {
        position: fixed;
        z-index: 999;
        margin: 50px;
        min-width: 220px;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto,
            Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif;

        :global(.with-pointer-arrow) {
            &::before {
                content: "";
                position: absolute;
                bottom: -6px;
                right: 20px;
                left: auto;
                border-right: 10px solid transparent;
                border-top: 10px solid #FFFFFF;
                border-left: 10px solid transparent;
                border-bottom: 0px solid transparent;
            }
        }
    }
</style>

{#if $showButton}
    <div transition:fly={{ y: 100, duration: 500 }} {style}>
        <Button />
        
        {#if ! $showMenu && $showPrompts}
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
