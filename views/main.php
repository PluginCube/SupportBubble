<style>
    :root {
        --instant-support-btn-bg: <?= $button['bg'] ?>;
		--instant-support-btn-text: <?= $button['text_icon_color'] ?>;
    }
</style>


<div class="instant-support" data-size="<?= $button['size'] ?>" data-position="<?= $button['position'] ?>" data-alignment="<?= $button['alignment'] ?>">

	<!-- Prompt Messages -->
	<ul class="instant-support-prompts">
		<?php foreach ($button['messages'] as $item) : ?>
			<li>
				<?= $item['message'] ?>
			</li>
		<?php endforeach; ?>
	</ul>

	<!-- Button -->
    <div class="instant-support-button">
        <?php
            var_dump($this->get_svg_icon($button['icon']));
        ?>

        <?php if ($button['text']) : ?>
            <span>
                <?= $button['text'] ?>
            </span>
        <?php endif; ?>
    </div>

</div>