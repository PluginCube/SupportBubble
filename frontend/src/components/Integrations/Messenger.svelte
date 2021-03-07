<script>
    export let options

    let today = new Date()
    let time = today.getHours() + ':' + today.getMinutes()

    options.messenger_url =
        options.messenger_url.indexOf('://') === -1
            ? 'http://' + options.messenger_url
            : options.messenger_url
</script>

<style lang="scss">
    div {
        width: 325px;
        border-radius: 10px;
        overflow: hidden;

        header {
            padding: 25px 20px;
            overflow: hidden;
            display: flex;
            align-items: center;
            background: #fff;
            border-bottom: 1px solid #f4f4f4;

            figure {
                position: relative;
                width: 52px;
                height: 52px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                border-radius: 50px;
                float: left;
                margin: 0;
                margin-right: 15px;

                img {
                    width: 100%;
                    height: 100%;
                    border-radius: 50px;
                    object-fit: cover;
                    object-position: center;
                }

                &::before {
                    content: '';
                    bottom: 0px;
                    right: 0px;
                    width: 12px;
                    height: 12px;
                    box-sizing: border-box;
                    background-color: rgb(74, 213, 4);
                    display: block;
                    position: absolute;
                    z-index: 1;
                    border-radius: 50%;
                    border: 2px solid rgb(255, 255, 255);
                }
            }

            aside {
                width: calc(100% - 65px);
                float: left;
                margin: 0;
                padding: 0;

                h4 {
                    float: left;
                    margin: 0px;
                    padding: 0px;
                    letter-spacing: 0.1px;
                    font-size: 16px;
                    font-weight: 700;
                    line-height: 20px;
                    color: #111;
                    width: 100%;
                }

                span {
                    float: left;
                    color: #333;
                    font-weight: normal;
                    font-size: 13px;
                    line-height: 18px;
                    margin-top: 5px;
                }
            }
        }

        article {
            padding: 30px 20px;
            position: relative;
            overflow: auto;

            small {
                font-size: 10px;
                line-height: 14px;
                color: #d4d4d4;
                width: 100%;
                text-align: center;
                padding-top: 0px;
                float: right;
                letter-spacing: 0.3px;
                margin-top: -14px;
                margin-bottom: 16px;
            }

            img {
                width: 30px;
                height: 30px;
                border-radius: 50px;
                float: left;
                margin-right: 10px;
                object-fit: cover;
                object-position: center;
            }

            aside {
                padding: 8px 12px;
                background: #f4f4f4;
                border-radius: 8px;
                max-width: 225px;
                float: left;
                position: relative;

                p {
                    font-size: 14px;
                    line-height: 19px;
                    margin: 0;
                    color: #000000;
                    float: left;
                    width: 100%;
                }
            }
        }

        footer {
            padding: 20px;
            overflow: hidden;
            background: #fff;
            display: block;

            a {
                text-decoration: none;
                font-size: 15px;
                color: #fff;
                width: 100%;
                float: left;
                text-align: center;
                font-weight: 700;
                border-radius: 8px;
                display: flex;
                height: 36px;
                align-items: center;
                justify-content: center;
                                
                :global(svg) {
                    width: 18px;
                    margin-right: 6px;
                    fill: currentColor;
                }
            }
        }
    }
</style>

<div>
    <header>
        <figure>
            <img src={options.avatar} alt={options.user_name} />
        </figure>

        <aside>
            <h4>{options.user_name}</h4>
            <span>{options.caption}</span>
        </aside>
    </header>

    <article>
        <small>{time}</small>

        <img src={options.avatar} alt={options.user_name} />

        <aside>
            <p>{@html options.welcome_message}</p>
        </aside>
    </article>

    <footer>
        <a
            href={options.messenger_url}
            target="_blank"
            style="background-color:{options.color};">
            {@html options.icon}
            {options.btn_text ?? 'Start Chat'}
        </a>
    </footer>
</div>