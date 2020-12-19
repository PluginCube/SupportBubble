<style>
    :root {
        --instant-support-btn-bg: <?= $button['bg'] ?>;
		--instant-support-btn-text: <?= $button['text_icon_color'] ?>;
    }
</style>


<div id="instant-support" data-size="<?= $button['size'] ?>" data-position="<?= $button['position'] ?>">

	<!-- Prompt Messages -->
	<div class="it-prompts">
        <span></span>
        <div class="it-loader"></div>
    </div>

	<!-- Button -->
    <div class="it-button" data-size="<?= $button['size'] ?>" >
            <i>
                <?= $this->get_svg_icon($button['icon']); ?>
            </i>

        <?php if ($button['text']) : ?>
            <span>
                <?= $button['text'] ?>
            </span>
        <?php endif; ?>
    </div>

</div>