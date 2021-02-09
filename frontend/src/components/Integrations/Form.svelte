<script>
    export let options

    import { bubble } from 'store'

    import { ajax } from 'methods'

    import Switch from '../Extra/Switch'

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
                font-size: 14px;
                padding-right: 25px;
                color: #111;
            }
        }

        article {
            padding: 5px 25px 25px;
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

            input:not([type='checkbox']), select {
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

            select {
                background-image: url("data:image/svg+xml;utf8,<svg fill='black' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
                background-repeat: no-repeat;
                background-size: 13px;
                background-position-y: center;
                background-position-x: calc(100% - 11px);
                -webkit-appearance: none;
                -moz-appearance: none;
                text-indent: 1px;
                cursor: pointer;
                appearance: none;
                color: #333;
                font-size: 12px;
            }

            .it-toggle {
                line-height: 36px;
                font-size: 13px;
                margin-top: 12px;
                font-family: inherit;
                color: #666;
                font-weight: 600;
                display: flex;
                align-items: center;

                span {
                    margin-left: 15px;
                }
            }

            textarea {
                width: 100% !important;
                max-width: 100%;
                min-height: 100px;
                padding: 5px 10px;
                border: 1px solid rgba(0, 0, 0, 0.05);
                border-radius: 5px;
                font-size: 13px;
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.05);
                margin-top: 10px;
                font-family: inherit;
                float: left;
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
        {#if showSuccessMessage || !options.form.fields}
            <p>{@html options.success_message}</p>
        {:else}
            <form on:submit|preventDefault={submit}>
                {#each options.form.fields as field}
                    {#if field.type == 'single_line_text'}
                        <input
                            placeholder={field.title}
                            bind:value={field.value}
                            required
                        />
                    {/if}

                    {#if field.type == 'paragraph'}
                        <textarea
                            placeholder={field.title}
                            bind:value={field.value}
                            required
                        />
                    {/if}

                    {#if field.type == 'number'}
                        <input
                            type="number"
                            placeholder={field.title}
                            bind:value={field.value}
                            required
                        />
                    {/if}

                    {#if field.type == 'email'}
                        <input
                            type="email"
                            placeholder={field.title}
                            bind:value={field.value}
                            required
                        />
                    {/if}

                    {#if field.type == 'date'}
                        <input
                            type="date"
                            placeholder={field.title}
                            bind:value={field.value}
                            required
                        />
                    {/if}

                    {#if field.type == 'time'}
                        <input
                            type="time"
                            placeholder={field.title}
                            bind:value={field.value}
                            required
                        />
                    {/if}

                    {#if field.type == 'phone_number'}
                        <input
                            type="tel"
                            placeholder={field.title}
                            bind:value={field.value}
                            required
                        />
                    {/if}

                    {#if field.type == 'toggle'}
                        <div class="it-toggle">
                            <Switch bind:value={field.value} />
                            <span>{field.title}</span>
                        </div>
                    {/if}

                    {#if field.type == 'dropdown'}
                        <select bind:value={field.value}>
                            {#each field.choices as choice}
                                <option value={choice.value}>
                                    {choice.value}
                                </option>
                            {/each}
                        </select>
                    {/if}
                {/each}

                <button
                    type="submit"
                    style="background-color:{$bubble.bg};">
                    Submit
                </button>
            </form>
        {/if}
    </article>
</div>