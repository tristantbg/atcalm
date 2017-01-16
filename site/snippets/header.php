<!DOCTYPE html>
<html lang="en" class="no-js">
<head>

	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="dns-prefetch" href="//www.google-analytics.com">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="canonical" href="<?php echo html($page->url()) ?>" />
	<?php if($page->isHomepage()): ?>
		<title><?= $site->title()->html() ?></title>
	<?php else: ?>
		<title><?= $page->title()->html() ?> | <?= $site->title()->html() ?></title>
	<?php endif ?>
	<?php if($page->isHomepage()): ?>
		<meta name="description" content="<?= $site->description()->html() ?>">
	<?php else: ?>
		<meta name="DC.Title" content="<?= $page->title()->html() ?>" />
		<?php if(!$page->text()->empty()): ?>
			<meta name="description" content="<?= $page->text()->excerpt(250) ?>">
			<meta name="DC.Description" content="<?= $page->text()->excerpt(250) ?>"/ >
			<meta property="og:description" content="<?= $page->text()->excerpt(250) ?>" />
		<?php else: ?>
			<meta name="description" content="">
			<meta name="DC.Description" content=""/ >
			<meta property="og:description" content="" />
		<?php endif ?>
	<?php endif ?>
	<meta name="robots" content="index,follow" />
	<meta name="keywords" content="<?= $site->keywords()->html() ?>">
	<?php if($page->isHomepage()): ?>
		<meta itemprop="name" content="<?= $site->title()->html() ?>">
		<meta property="og:title" content="<?= $site->title()->html() ?>" />
	<?php else: ?>
		<meta itemprop="name" content="<?= $page->title()->html() ?> | <?= $site->title()->html() ?>">
		<meta property="og:title" content="<?= $page->title()->html() ?> | <?= $site->title()->html() ?>" />
	<?php endif ?>
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?= html($page->url()) ?>" />
	<?php if($page->content()->name() == "project"): ?>
		<?php if (!$page->featured()->empty()): ?>
			<meta property="og:image" content="<?= resizeOnDemand($page->image($page->featured()), 1200) ?>"/>
		<?php endif ?>
	<?php else: ?>
		<?php if(!$site->ogimage()->empty()): ?>
			<meta property="og:image" content="<?= $site->ogimage()->toFile()->width(1200)->url() ?>"/>
		<?php endif ?>
	<?php endif ?>

	<meta itemprop="description" content="<?= $site->description()->html() ?>">
	<!-- <link rel="shortcut icon" href="<?php //url('assets/images/favicon.ico') ?>">
	<link rel="icon" href="<?php //url('assets/images/favicon.ico') ?>" type="image/x-icon"> -->

	<?php 
	echo css('assets/css/build/build.min.css');
	echo js('assets/js/vendor/modernizr.min.js');
	?>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?= url('assets/js/vendor/jquery.min.js') ?>">\x3C/script>')</script>

	<?php if(!$site->customcss()->empty()): ?>
		<style type="text/css">
			<?php echo $site->customcss()->html() ?>
		</style>
	<?php endif ?>

</head>
<body <?php e($page->content()->name() == "project", "class='project-page loaded'"); e($page->content()->name() == "contact", "class='contact-page'"); e($page->isHomepage(), "class='home'") ?>>

<div class="loader"></div>

<header<?php e($page->content()->name() == "contact", " class='opened'") ?>>
	<div id="site-title" data-target="index">
		<a href="<?= $site->url() ?>">
		<img src="<?= url('assets/images/calmos-logo.svg') ?>" onerror="this.src='<?= url('assets/images/calmos-logo.png') ?>'; this.onerror=null;" alt="Atelier Calmos" height="100%" width="auto">
		</a>
	</div>

	<?php $projects = $pages->find('work')->children()->visible() ?>
	<?php $pcount = $projects->count(); ?>
	<?php if($pcount > 0):
	$idx = 0 ?>
	<nav id="projects" <?php e($pcount > 10, 'class="sliding"') ?>>
		<?php foreach ($projects as $key => $project): ?>
			
			<?php if($idx%10 == 0): ?>
			<div class="cell">
			<?php endif ?>

			<a class="project-item" href="<?= $project->url() ?>" data-title="<?= $project->title()->html() ?>" data-id="<?= tagslug($project->title()) ?>" data-target="project">
			<span>
				<?= $project->title()->html() ?>
				<br><?= $project->subtitle()->html() ?>
				<br><?= $project->date('Y') ?>
			</span>
			</a>
			
			<?php if($idx%10 == 9): ?>
			</div>
			<?php elseif($idx == $pcount - 1): ?>
			</div>
			<?php endif ?>

			<?php $idx++ ?>

		<?php endforeach ?>
	</nav>
	<?php endif ?>
	
	<?php $contact = $pages->find('contact') ?>
	<div id="contact-link" >
		<a href="<?= $contact->url() ?>" data-title="<?= $contact->title()->html() ?>" data-target="contact">
		<h3><?= $contact->title()->html() ?></h3>
		</a>
	</div>

	<div id="contact-container">
	<?php if($page->content()->name() == "contact"): ?>
		<div class="inner">
			<div id="contact-description">
				<?= $page->text()->kt() ?>
			</div>
			<div id="contact-friends" class="row">
				<div class="col"><?= $page->left()->kt() ?></div>
				<div class="col"><?= $page->right()->kt() ?></div>
			</div>
			<div id="contact-footer" class="row">
				<div id="socials" class="col">
					<?php foreach($site->socials()->yaml() as $social): ?>
						<a href="<?php echo $social['link'] ?>" target="_blank"><?php echo $social['name'] ?></a>
					<?php endforeach ?>
				</div>
				<div id="credits" class="col">
					<?= $site->credits()->kt() ?>
				</div>
			</div>
			<div id="page-close" data-target="index"></div>
		</div>
	<?php endif ?>
	</div>
</header>