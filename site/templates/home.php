<?php snippet('header') ?>

<?php $projects = $page->children()->visible() ?>

<div id="projects-overview">

	<?php foreach($projects as $key => $project): ?>
	<div class="gallery-cell" data-title="<?= $project->title()->html() ?>" data-target="project" data-flickity-bg-lazyload="<?= $project->featured()->toFile()->url() ?>"></div>
	<?php endforeach ?>

</div>

<div id="content-container"></div>

<?php snippet('footer') ?>