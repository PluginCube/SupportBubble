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
            padding: 25px;
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
            background-color: #e6ddd4;
            position: relative;
            overflow: auto;
            
            &::before {
                display: block;
                position: absolute;
                content: "";
                left: 0px;
                top: 0px;
                height: 100%;
                width: 100%;
                z-index: 0;
                opacity: 0.08;
                background-image: url(https://elfsight.com/assets/chats/patterns/whatsapp.png);
            }

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
                background: rgb(79, 206, 93);
                padding: 8px 14px;
                width: 100%;
                float: left;
                text-align: center;
                font-weight: bold;
                border-radius: 50px;
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
        <a href="https://api.whatsapp.com/send?phone=14081234567">Start Chat</a>
    </footer>
</div>