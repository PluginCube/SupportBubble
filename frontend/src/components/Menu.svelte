<script>
    import { fly } from 'svelte/transition'
    import { menu, showIntegration, integration, showMenu } from 'store'

    $menu.items = $menu.items.length ? $menu.items : []

    let click = (item) => {
        if (item.type == 'link') {
            if (item.url) {
                item.url =
                    item.url.indexOf('://') === -1
                        ? 'http://' + item.url
                        : item.url
                window.open(item.url, '_blank')
            }
        } else {
            showMenu.set(false)
            showIntegration.set(true)
            integration.set(item)
        }
    }
</script>

<style lang="scss">
    ul {
        box-shadow: rgb(0 0 0 / 10%) 0px 10px 35px 0px;
        padding: 10px 0px;
        width: 285px;
        background: #fff;
        position: absolute;
        bottom: 85px;
        right: 0;
        border-radius: 5px;
        margin: 0;
        list-style: none;

        li {
            float: left;
            width: 100%;
            margin: 0;
            padding: 9px 16px;
            cursor: pointer;

            &:hover {
                background: #f1f1f1;
            }

            i {
                width: 42px;
                height: 42px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                border-radius: 50px;
                float: left;
                margin-right: 14px;

                :global(svg) {
                    width: 22px;
                    fill: currentColor;
                }
            }

            h4 {
                float: left;
                margin: 0px;
                padding: 0px;
                width: calc(100% - 60px);
                font-size: 14px;
                font-weight: 400;
                margin-top: 1px;
                margin-bottom: 3px;
                color: #333;
            }

            span {
                width: calc(100% - 60px);
                font-size: 13px;
                float: left;
                color: #999999;
                font-weight: normal;
            }
        }
    }
</style>

<ul transition:fly={{ x: 40 }}>
    {#each $menu.items as item}
        <li
            on:click={() => {
                click(item)
            }}
        >
            <i style="background: {item.color};">
                {@html item.icon}
            </i>

            <h4>
                {item.title}
            </h4>

            <span>
                {item.subtitle}
            </span>
        </li>
    {/each}
</ul>