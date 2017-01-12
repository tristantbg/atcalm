<?php snippet('header') ?>

<?php snippet('overview') ?>

<div id="content-container">
	<div class="inner">
		<div id="page-close" data-target="index"></div>
		<div id="project-infos">
			<h1><?= $page->title()->html() ?></h1>
			<?= $page->text()->kt() ?>
		</div>
		<div id="project-content">
			<?php foreach($page->medias()->toStructure() as $media): ?>
			  <?php if ($media->_fieldset() == "image"): ?>
			  <?php if($image = $media->content()->toFile()): ?>
			  	<div class="content-item image-item w<?= $media->width() ?> <?= $media->position() ?>" 
			  	<?php if($media->yoffset()->isNotEmpty()){ echo 'style="margin-top:'.$media->yoffset().'vw"'; } ?>
			  		data-x="<?php $pos = $media->position(); if ($pos == "left" or $pos == "right") {echo rand(100,130);} elseif($pos == "midleft" or $pos == "midright"){echo rand(40,70);} else {echo rand(20,40);} ?>" 
			  		data-y="<?php echo rand(70,100) ?>">
			  		<?php 
					$srcset = '';
					for ($i = 500; $i <= 3000; $i += 500) $srcset .= resizeOnDemand($image, $i) . ' ' . $i . 'w,';
					?>

					<img 
					srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" 
					data-src="<?= resizeOnDemand($image, 1500) ?>" 
					data-srcset="<?= $srcset ?>" 
					data-sizes="auto" 
					data-optimumx="1.5" 
					class="content lazyimg lazyload" 
					alt="<?= $page->title()->html().' — © '.$page->date("Y").', '.$site->title()->html(); ?>" 
					width="100%" height="auto">

					<noscript>
						<img class="content" alt="<?= $page->title()->html().' — © '.$page->date("Y").', '.$site->title()->html(); ?>" src="<?php echo resizeOnDemand($image, 1500) ?>" width="100%" height="auto" />
					</noscript>
			  	</div>
			  <?php endif ?>
			  <?php else: ?>
			  	<div class="content-item video-item w<?= $media->width() ?> <?= $media->position() ?>" 
			  	<?php if($media->yoffset()->isNotEmpty()){ echo 'style="margin-top:'.$media->yoffset().'vw"'; } ?> 
			  	data-x="<?php $pos = $media->position(); if ($pos == "left" or $pos == "right") {echo rand(100,130);} elseif($pos == "midleft" or $pos == "midright"){echo rand(40,70);} else {echo rand(20,40);} ?>" 
			  	data-y="<?php echo rand(70,100) ?>">
			  		<?= $media->link()->oembed() ?>
			  	</div>
			  <?php endif ?>
			<?php endforeach ?>
		</div>
	</div>
</div>

<?php snippet('footer') ?>