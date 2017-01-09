<?php $projects = $pages->find('work')->children()->visible() ?>

<div id="projects-overview" data-id="<?= tagslug($page->title()) ?>">

	<?php foreach($projects as $key => $project): ?>
	<?php if($image = $project->featured()->toFile()): ?>
	<div class="gallery-cell" href="<?= $project->url() ?>" data-title="<?= $project->title()->html() ?>" data-id="<?= tagslug($project->title()) ?>" data-target="project" data-flickity-bg-lazyload="<?= $image->url() ?>"></div>
	<?php endif ?>
	<?php endforeach ?>

	<div id="mouse-title"><span></span></div>

</div>