<?php snippet('header') ?>

<?php snippet('overview') ?>

<div id="content-container">
	<div class="inner">
		<div id="page-close" data-target="index"></div>
		<div id="project-content">
			<?php foreach($page->medias()->toStructure() as $media): ?>
			  <?php if ($media->_fieldset() == "image"): ?>
				  <?php if($image = $media->content()->toFile()): ?>
				  	<div class="content-item float image-item w<?= $media->width() ?> <?= $media->position() ?>" 
				  	<?php if($media->yoffset()->isNotEmpty()){ echo 'style="margin-top:'.$media->yoffset().'vw"'; } ?>
				  		data-x="<?= $media->xspeed() ?>" 
				  		data-y="<?= $media->yspeed() ?>">
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
			  <?php elseif ($media->_fieldset() == "twoimages"): ?>
			  		<?php $image1 = $media->content1()->toFile(); $image2 = $media->content2()->toFile(); ?>
				  	<div class="content-item image-item w<?= $media->width() ?> <?= $media->position() ?>" 
				  	<?php if($media->yoffset()->isNotEmpty()){ echo 'style="margin-top:'.$media->yoffset().'vw"'; } ?>
				  	>
				  		<div class="col float" 
				  		data-x="<?= $media->xspeed() ?>" 
				  		data-y="<?= $media->yspeed() ?>">
				  		<?php 
						$srcset = '';
						for ($i = 500; $i <= 3000; $i += 500) $srcset .= resizeOnDemand($image1, $i) . ' ' . $i . 'w,';
						?>

						<img 
						srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" 
						data-src="<?= resizeOnDemand($image1, 1500) ?>" 
						data-srcset="<?= $srcset ?>" 
						data-sizes="auto" 
						data-optimumx="1.5" 
						class="content lazyimg lazyload" 
						alt="<?= $page->title()->html().' — © '.$page->date("Y").', '.$site->title()->html(); ?>" 
						width="100%" height="auto">

						<noscript>
							<img class="content" alt="<?= $page->title()->html().' — © '.$page->date("Y").', '.$site->title()->html(); ?>" src="<?php echo resizeOnDemand($image1, 1500) ?>" width="100%" height="auto" />
						</noscript>
						</div>
						<div class="col float" 
						data-x="<?= $media->xspeed()->value() + 20 ?>" 
				  		data-y="<?= $media->yspeed()->value() - 50 ?>"
				  		<?php if($media->yoffset2()->isNotEmpty()){ echo ' style="margin-top:'.$media->yoffset2().'vw"'; } ?>>
				  		<?php 
						$srcset = '';
						for ($i = 500; $i <= 3000; $i += 500) $srcset .= resizeOnDemand($image2, $i) . ' ' . $i . 'w,';
						?>

						<img 
						srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" 
						data-src="<?= resizeOnDemand($image2, 1500) ?>" 
						data-srcset="<?= $srcset ?>" 
						data-sizes="auto" 
						data-optimumx="1.5" 
						class="content lazyimg lazyload" 
						alt="<?= $page->title()->html().' — © '.$page->date("Y").', '.$site->title()->html(); ?>" 
						width="100%" height="auto">

						<noscript>
							<img class="content" alt="<?= $page->title()->html().' — © '.$page->date("Y").', '.$site->title()->html(); ?>" src="<?php echo resizeOnDemand($image2, 1500) ?>" width="100%" height="auto" />
						</noscript>
						</div>
				  	</div>
			  <?php else: ?>
			  	<div class="content-item video-item w<?= $media->width() ?> <?= $media->position() ?>" 
			  	<?php if($media->yoffset()->isNotEmpty()){ echo 'style="margin-top:'.$media->yoffset().'vw"'; } ?> 
			  	data-x="<?= $media->xspeed() ?>" 
			  	data-y="<?= $media->yspeed() ?>">
			  		<?= $media->link()->oembed() ?>
			  	</div>
			  <?php endif ?>
			<?php endforeach ?>
			<div id="project-infos">
				<h1><?= $page->title()->html() ?></h1>
				<?= $page->text()->kt() ?>
				<?php if ($page->credits()->isNotEmpty()): ?>
				<div id="project-credits">
				<?= $page->credits()->kt() ?>
				</div>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>

<?php snippet('footer') ?>