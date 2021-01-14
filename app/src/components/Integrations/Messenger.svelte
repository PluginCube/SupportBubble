<script>
    export let options

    let today = new Date();
    let time = today.getHours() + ":" + today.getMinutes()

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
            padding: 25px 20px;
            background-color: #f4f4f4;
            position: relative;
            overflow: auto;
            
            aside {
                padding: 7px 14px 6px;
                background: #fff;
                box-shadow: rgba(0, 0, 0, 0.13) 0px 1px 0.5px;
                border-radius: 0px 8px 8px;
                max-width: 225px;
                float: left;
                position: relative;

                &::before {
                    position: absolute;
                    background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAmCAMAAADp2asXAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAACQUExURUxpccPDw9ra2m9vbwAAAAAAADExMf///wAAABoaGk9PT7q6uqurqwsLCycnJz4+PtDQ0JycnIyMjPf3915eXvz8/E9PT/39/RMTE4CAgAAAAJqamv////////r6+u/v7yUlJeXl5f///5ycnOXl5XNzc/Hx8f///xUVFf///+zs7P///+bm5gAAAM7Ozv///2fVensAAAAvdFJOUwCow1cBCCnqAhNAnY0WIDW2f2/hSeo99g1lBYT87vDXG8/6d8oL4sgM5szrkgl660OiZwAAAHRJREFUKM/ty7cSggAABNFVUQFzwizmjPz/39k4YuFWtm55bw7eHR6ny63+alnswT3/rIDzUSC7CrAziPYCJCsB+gbVkgDtVIDh+DsE9OTBpCtAbSBAZSEQNgWIygJ0RgJMDWYNAdYbAeKtAHODlkHIv997AkLqIVOXVU84AAAAAElFTkSuQmCC);
                    background-position: 50% 50%;
                    background-repeat: no-repeat;
                    background-size: contain;
                    content: "";
                    top: 0px;
                    left: -12px;
                    width: 12px;
                    height: 19px;
               }

                span {
                    color: #999;
                    font-size: 13px;
                    margin-bottom: 10px;
                    float: left;
                    width: 100%;
                    font-weight: 500;
                }

                p {
                    font-size: 14px;
                    line-height: 19px;
                    margin: 0;
                    color: #000000;
                    float: left;
                    width: 100%;
                }

                small {
                    font-size: 12px;
                    line-height: 16px;
                    color: #999;
                    width: 100%;
                    text-align: right;
                    padding-top: 0px;
                    float: right;
                    margin-right: -4px;
                    margin-bottom: 0px;
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
        <aside>
            <span>{options.user_name}</span>
            <p>{@html options.welcome_message}</p>
            <small>{time}</small>
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