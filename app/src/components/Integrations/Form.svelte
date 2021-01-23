<script>
    export let options

    import { ajax } from 'methods'

    import Switch from "../Extra/Switch";

    let showSuccessMessage = false
    
    let submit = async () => {
        await ajax('it_form_submit', options.form)
        showSuccessMessage = true
    }
</script>

<style lang="scss">
    div {
        width: 300px;

        header {
            padding: 25px;
            overflow: hidden;
            background: #fff;
            
            h4 {
                display: block;
                float: left;
                width: 100%;
                margin: 0;
                font-size: 22px;
                line-height: 1;
            }

            p {
                display: block;
                float: left;
                width: 100%;
                margin: 15px 0px 0px;
                font-size: 15px;
            }
        }

        article {
            padding: 0px 25px 25px;
            overflow: hidden;
            background: #fff;

            > p {
                text-align: center;
                font-size: 16px;
                margin: 0;
                margin-top: 20px;
                background: #f4f4f4;
                padding: 15px 20px;
                border-radius: 5px;
            }

            input:not([type=checkbox]) {
                width: 100%;
                height: 36px;
                line-height: 36px;
                padding: 0px 10px;
                border: 1px solid rgba(0, 0, 0, 0.05);
                border-radius: 5px;
                font-size: 13px;
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.05);
                margin-top: 10px;
                font-family: inherit;
            }
            
            .it-switch {
                line-height: 36px;
                font-size: 13px;
                margin-top: 12px;
                font-family: inherit;
                color: #666;
                font-weight: 600;
                display: flex;
                align-items: center;
                
                span {
                    margin-left: 20px;
                }
            }

            textarea {
                width: 100%;
                padding: 5px 10px;
                border: 1px solid rgba(0, 0, 0, 0.05);
                border-radius: 5px;
                font-size: 13px;
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.05);
                margin-top: 10px;
                font-family: inherit;
            }

            button {
                font-size: 14px;
                font-family: inherit;
                text-transform: inherit;
                margin-top: 25px;
                padding: 0px 14px;
                line-height: 34px;
                color: #fff;
                letter-spacing: 0px;
                border-radius: 5px;
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.05);
                width: 100%;
            }
        }
    }
</style>

<div>
    <header>
        <h4>{options.headline}</h4>
        <p>{options.description}</p>
    </header>

    <article>
        {#if showSuccessMessage || ! options.form.fields}
            <p>{@html options.success_message}</p>
        {:else}
            <form on:submit|preventDefault={submit}>
                {#each options.form.fields as field}
                    {#if field.type == 'single_line_text'}
                        <input placeholder={field.title} bind:value={field.value} required>
                    {/if}

                    {#if field.type == 'paragraph'}
                        <textarea placeholder={field.title} bind:value={field.value} required></textarea>
                    {/if}

                    {#if field.type == 'number'}
                        <input type="number" placeholder={field.title} bind:value={field.value} required>
                    {/if}

                    {#if field.type == 'email'}
                        <input type="email" placeholder={field.title} bind:value={field.value} required>
                    {/if}

                    {#if field.type == 'date'}
                        <input type="date" placeholder={field.title} bind:value={field.value} required>
                    {/if}

                    {#if field.type == 'phone_number'}
                        <input type="tel" placeholder={field.title} bind:value={field.value} required>
                    {/if}

                    {#if field.type == 'switch'}
                        <div class="it-switch">
                            <Switch bind:value={field.value} />
                            <span>{field.title}</span>
                        </div>
                    {/if}
                {/each}

                <button type="submit">
                    Submit
                </button>
            </form>
        {/if}
    </article>
</div>