<script>
    import { fly } from 'svelte/transition'
    import { button, showMenu, showPrompts } from 'store'

    let style = `
        color: ${$button.color};
        background-color: ${$button.bg};
    `

    let click = () => {
        showMenu.set(!$showMenu)
        
        showPrompts.set(false)
    }
</script>

<style lang="scss">
    div {
        font-size: 15px;
        border-radius: 5px;
        overflow: hidden;
        cursor: pointer;
        float: right;
        height: 42px;
        line-height: 42px;

        i {
            background: rgba(255, 255, 255, 0.125);
            float: right;
            height: inherit;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            overflow: hidden;

            div {
                display: flex;
            }

            :global(svg) {
                width: 20px;
                fill: currentColor;
            }
        }

        span {
            line-height: inherit;
            padding: 0px 20px;
            float: right;
        }

        &[data-size='small'] {
            font-size: 14px;
            height: 40px;
            line-height: 40px;

            i {
                width: 45px;

                :global(svg) {
                    width: 18px;
                }
            }
        }

        &[data-size='large'] {
            font-size: 15px;
            height: 45px;
            line-height: 45px;

            i {
                width: 50px;

                :global(svg) {
                    width: 24px;
                }
            }
        }
    }
</style>

<div on:click={click} data-size={$button.size} {style}>
    <i>
            {#if $showMenu}
                <div in:fly={{x: 20}}>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-11.414L9.172 7.757 7.757 9.172 10.586 12l-2.829 2.828 1.415 1.415L12 13.414l2.828 2.829 1.415-1.415L13.414 12l2.829-2.828-1.415-1.415L12 10.586z"
                        />
                    </svg>
                </div>
            {:else}
                <div in:fly={{x: 20}}>
                    {@html $button.icon}
                </div>
            {/if}
    </i>

    {#if $button.text}
        <span>{$button.text}</span>
    {/if}
</div>