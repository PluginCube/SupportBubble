<script>
    import { fade } from 'svelte/transition'

    import { onMount } from 'svelte';

    import { prompts } from 'store'

    import Loader from './Loader'

    let currentMessage = null


    onMount(() => {
        setInterval(() => {
            if ( $prompts['messages'].length == 0 ) {
                return
            };

            currentMessage = $prompts['messages'][0]['message']

            setTimeout(() => {
                if ( $prompts['messages'].length !== 1 ) {
                    currentMessage = null
                }

                prompts.set({
                    messages: $prompts['messages'].shift(),
                    ... $prompts
                });
            }, 2500);
        }, 5000);
    })
</script>

<style lang="scss">
    div {
        position: absolute;
        bottom: 75px;
        right: 0;
        padding: 12px 18px;
        font-size: 14px;
        line-height: 20px;
        background: #fff;
        min-width: 65px;
        min-height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #555;
        border-radius: 5px;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 12px 24px 0px;
    }
</style>

<div in:fade class="with-pointer-arrow">
    {#if currentMessage}
        <span>
            {currentMessage}
        </span>
    {:else}
        <Loader color='#c0c3c5'/>
    {/if}
</div>