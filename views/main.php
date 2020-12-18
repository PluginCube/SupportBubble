<style>
    :root {
        --instant-support-btn-bg: <?= $button['bg'] ?>;
		--instant-support-btn-text: <?= $button['text_icon_color'] ?>;
    }
</style>


<div id="instant-support" data-size="<?= $button['size'] ?>" data-position="<?= $button['position'] ?>" data-alignment="<?= $button['alignment'] ?>">

	<!-- Prompt Messages -->
	<ul class="instant-support-prompts">
		<?php foreach ($button['messages'] as $item) : ?>
			<li>
				<?= $item['message'] ?>
			</li>
        <?php endforeach; ?>
        <li class="instant-support-prompt-placeholder">
            <i>
                <div class="loader"></div>
                <?= $this->get_svg_icon($button['icon']); ?>
            </i>
        </li>
	</ul>

	<!-- Button -->
    <div class="instant-support-button">
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