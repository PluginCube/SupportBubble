<script>
    import { fly } from 'svelte/transition'
    import { menu, showIntegration, integration, showMenu } from "store"

    let click = (item) => {
        if (item.type == 'link') {
            item.url = (item.url.indexOf('://') === -1) ? 'http://' + item.url : item.url;
            window.open(item.url, "_blank");
        }
        
        else {
            showMenu.set(false)
            showIntegration.set(true)
            integration.set(item)
        }
    }
</script>

<style lang="scss">
    ul {
        box-shadow: 0px 0px 50px rgba(0,0,0,0.15);
        padding: 8px 0px;
        width: 285px;
        background: #fff;
        position: absolute;
        bottom: 75px;
        right: 0;
        border-radius: 5px;
        margin: 0;
        list-style: none;
        
        li {
            float: left;
            width: 100%;
            margin: 0;
            padding: 8px 14px;
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
                margin-right: 12px;
                
                :global(svg) {
                    width: 24px;
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
                margin-top: 2px;
                margin-bottom: 2px;
                letter-spacing: .1px;
            }

            span {
                width: calc(100% - 60px);
                font-size: 13px;
                float: left;
                color: #888;
                font-weight: normal;
            }
        }
    }
</style>

<ul transition:fly={{x: 40}} class="with-pointer-arrow">
    {#each  $menu.items as item}
        <li on:click={() => {click(item)}}>
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