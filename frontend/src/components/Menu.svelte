<script>
    import { fly } from 'svelte/transition'
    import { menu, showIntegration, integration, showMenu } from 'store'

    $menu.items = $menu.items.length ? $menu.items : []

    let click = (item, e) => {
        if (['link', 'email'].includes(item.type))
            return;

        e.preventDefault();

        showMenu.set(false)
        showIntegration.set(true)
        integration.set(item)
    }

    let itemLink = (item) => {
        if (item.type == 'link') {
            return item.url.indexOf('://') === -1 ? 'http://' + item.url : item.url
        } else if (item.type == 'email') {
            return 'mailto:' + item.email
        }

        return '#';
    }
</script>

<style lang="scss">
    aside {
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

        > a {
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

            div {
                width: calc(100% - 60px);
                float: left;

                h4 {
                    float: left;
                    margin: 0px;
                    padding: 0px;
                    font-size: 14px;
                    font-weight: 400;
                    margin-top: 1px;
                    margin-bottom: 3px;
                    color: #333;
                    width: 100%;
                }

                span {
                    font-size: 13px;
                    float: left;
                    color: #999999;
                    font-weight: normal;
                    width: 100%;
                }
            }
        }
    }
</style>

<aside transition:fly={{ x: 40 }}>
    {#each $menu.items as item}
        <a href={itemLink(item)} target="_blank" on:click={(e) => {
            click(item, e)
        }}>
            <i style="background: {item.color};">
                {@html item.icon}
            </i>

            <div>
                <h4>
                    {item.title}
                </h4>

                <span>
                    {item.subtitle}
                </span>
            </div>
        </a>
    {/each}
</aside>