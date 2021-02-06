<script>
    import { fade } from 'svelte/transition'

    import { onMount } from 'svelte'

    import { bubble } from 'store'

    import Loader from './Loader'

    let currentMessage = null

    onMount(() => {
        setInterval(() => {
            if ($bubble['prompts'].length == 0) {
                return
            }

            currentMessage = $bubble['prompts'][0]['message']

            setTimeout(() => {
                if ($bubble['prompts'].length !== 1) {
                    currentMessage = null
                }

                bubble.set({
                    prompts: $bubble['prompts'].shift(),
                    ...$bubble,
                })
            }, 2500)
        }, 5000)
    })
</script>

<style lang="scss">
    div {
        position: absolute;
        bottom: 80px;
        right: 0;
        padding: 12px 18px;
        font-size: 14px;
        line-height: 20px;
        background: #fff;
        min-width: 60px;
        min-height: 41px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #555;
        border-radius: 5px;
        box-shadow: rgb(0 0 0 / 10%) 0px 10px 35px 0px;
    }
</style>

<div in:fade class="with-pointer-arrow">
    {#if currentMessage}
        <span>
            {@html currentMessage}
        </span>
    {:else}
        <Loader color="#c0c3c5" />
    {/if}
</div>