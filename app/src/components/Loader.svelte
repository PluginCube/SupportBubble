<script>
	export let color = 'currentColor'
	export let size = 56
	export let gap = 12
	export let duration = 1

	let style = `
		--loader-size: ${size}px;
		--loader-color: ${color};
		--loader-animation-duration: ${duration}s;
		--loader-gap: ${gap}px;
	`
</script>

<style lang="scss">
    @mixin loader(
        $size: var(--loader-size),
        $color: var(--loader-color),
        $duration: var(--loader-animation-duration),
        $gap: var(--loader-gap),
        $align: null
    ) {
        $unique-name: unique-id();
        width: $size;
        height: $size;
        border-radius: 50%;
        box-shadow: 0 $size * 2 0 $color;
        position: relative;
        animation: #{'loader-'}#{$unique-name} $duration ease-in-out alternate
            infinite;
        animation-delay: ($duration / 5) * 2;

        &::after,
        &::before {
            content: '';
            position: absolute;
            width: $size;
            height: $size;
            border-radius: 50%;
            box-shadow: 0 $size * 2 0 $color;
            animation: #{'loader-'}#{$unique-name} $duration cubic-bezier(
                    0.42,
                    0,
                    0.35,
                    0.89
                ) alternate infinite;
        }

        &::before {
            left: -($size + $gap);
            animation-delay: ($duration / 5) * 3;
        }

        &::after {
            right: -($size + $gap);
            animation-delay: ($duration / 5) * 1;
        }

        @if ($align == center) {
            margin-left: auto;
            margin-right: auto;
		}
		
        @if ($align == middle) {
            top: 50%;
            margin: -($size * 2 + $size / 2) auto 0;
        } @else {
            top: - $size * 2 + 2;
		}
		
        @keyframes #{'loader-'}#{$unique-name} {
            0% {
                box-shadow: 0 $size * 2 0 $color;
            }

            100% {
                box-shadow: 0 $size 0 $color;
            }
        }
	}
	
	div {
		@include loader($size: 5px, $gap: 3px, $duration: 0.5s);
	}
</style>

<div {style}></div>