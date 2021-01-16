<script>
    export let value = false

    $: if (typeof value == 'string') {
        value = JSON.parse(value)
    }

    let toggle = () => {
        value = !value
    }
</script>

<style lang="scss">
    div {
        position: relative;
        display: inline-block;
        width: 34px;
        height: 20px;

        &.active span {
            background-color: #20d678;
        }

        &.active span:before {
            transform: translateX(13px);
        }

        span {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #d8dee4;
            transition: 0.4s;
            border-radius: 34px;
        }

        span:before {
            position: absolute;
            content: "";
            height: 12px;
            width: 12px;
            left: 4px;
            bottom: 4px;
            background-color: #fff;
            transition: 0.4s;
            border-radius: 50%;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.06);
            
        }
    }
</style>

<div on:click={toggle} class:active={value}><span /></div>