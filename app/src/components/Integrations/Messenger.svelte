<script>
    export let options

    let today = new Date();
    let time = today.getHours() + ":" + today.getMinutes()

    options.messenger_url = (options.messenger_url.indexOf('://') === -1) ? 'http://' + options.messenger_url : options.messenger_url;
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
                margin-right: 15px;

                img {
                    width: 100%;
                    height: auto;
                    border-radius: 50px;
                }
                
                &::before{
                    content: "";
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
                letter-spacing: .3px;
                margin-top: -14px;
                margin-bottom: 16px;
            }

            img {
                width: 30px;
                height: auto;
                border-radius: 50px;
                float: left;
                margin-right: 10px;
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
                justify-content: center;
                align-items: center;

                svg {
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
            <img src={options.avatar} alt={options.user_name}>
        </figure>
        
        <aside>
            <h4>{options.user_name}</h4>
            <span>{options.caption}</span>
        </aside>
    </header>

    <article>
        <small>{time}</small>

        <img src={options.avatar} alt={options.user_name}>

        <aside>
            <p>{@html options.welcome_message}</p>
        </aside>
    </article>

    <footer>
        <a href={options.messenger_url} target="_blank" style="background-color:{options.color};">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <g>
                    <path fill="none" d="M0 0h24v24H0z"/>
                    <path fill-rule="nonzero" d="M12 2c5.634 0 10 4.127 10 9.7 0 5.573-4.366 9.7-10 9.7a10.894 10.894 0 0 1-2.895-.384.8.8 0 0 0-.534.039l-1.984.876a.8.8 0 0 1-1.123-.707l-.055-1.78a.797.797 0 0 0-.268-.57C3.195 17.135 2 14.617 2 11.7 2 6.127 6.367 2 12 2zM5.995 14.537c-.282.447.268.951.689.631l3.155-2.394a.6.6 0 0 1 .723 0l2.337 1.75a1.5 1.5 0 0 0 2.169-.4l2.937-4.66c.282-.448-.268-.952-.689-.633l-3.155 2.396a.6.6 0 0 1-.723 0l-2.337-1.75a1.5 1.5 0 0 0-2.169.4l-2.937 4.66z"/>
                </g>
            </svg>
            
            Start Chat
        </a>
    </footer>
</div>