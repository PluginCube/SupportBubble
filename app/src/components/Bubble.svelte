<script>
    import { fly } from 'svelte/transition'
    import { bubble, showMenu, showPrompts, showIntegration } from 'store'

    let style = `
        color: ${$bubble.color};
        background-color: ${$bubble.bg};
    `

    let click = () => {
        showMenu.set(!$showMenu)
        
        showPrompts.set(false)
    }
</script>

<style lang="scss">
    div {
        border-radius: 50px;
        cursor: pointer;
        float: right;
        height: 52px;
        width: 52px;
        overflow: hidden;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 12px 24px 0px;
        display: flex;
        align-items: center;
        justify-content: center;

        :global(svg) {
            width: 18px;
            fill: currentColor;
        }

        &[data-size='small'] {
            height: 48px;
            width: 48px;

            :global(svg) {
                width: 18px;
            }
        }

        &[data-size='large'] {
            height: 55px;
            width: 55px;

            :global(svg) {
                width: 20px;
            }
        }
    }
</style>

<div on:click={click} data-size={$bubble.size} {style}>
    {#if $showMenu || $showIntegration}
        <i in:fly={{x: 20}}>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path
                    d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-11.414L9.172 7.757 7.757 9.172 10.586 12l-2.829 2.828 1.415 1.415L12 13.414l2.828 2.829 1.415-1.415L13.414 12l2.829-2.828-1.415-1.415L12 10.586z"
                />
            </svg>
        </i>
    {:else}
        <i in:fly={{x: 20, duration: 800}}>
            {@html $bubble.icon}
        </i>
    {/if}
</div>