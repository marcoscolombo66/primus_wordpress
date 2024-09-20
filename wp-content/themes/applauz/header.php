<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php boldthemes_theme_data(); ?>>

<head>

	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-152915775-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'UA-152915775-1', { cookie_flags: 'HttpOnly;Secure;SameSite=None'});
	</script>
	<!--
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-147089972-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-147089972-1');
</script>
-->


	<?php
	boldthemes_set_override();
	boldthemes_header_init();
	boldthemes_header_meta();

	$body_style = '';

	$page_background = boldthemes_get_option('page_background');
	if ($page_background) {
		if (is_numeric($page_background)) {
			$page_background = wp_get_attachment_image_src($page_background, 'full');
			$page_background = $page_background[0];
		}
		$body_style = ' style="background-image:url(' . $page_background . ')"';
	}

	$header_extra_class = '';

	if (boldthemes_get_option('boxed_menu')) {
		$header_extra_class .= 'gutter ';
	}

	wp_head(); ?>

	<!--Start of Zendesk Chat Script-->
	<script type="text/javascript">
		window._chatlio = window._chatlio || [];
		! function() {
			var t = document.getElementById("chatlio-widget-embed");
			if (t && window.ChatlioReact && _chatlio.init) return void _chatlio.init(t, ChatlioReact);
			for (var e = function(t) {
					return function() {
						_chatlio.push([t].concat(arguments))
					}
				}, i = ["configure", "identify", "track", "show", "hide", "isShown", "isOnline", "page", "open", "showOrHide"], a = 0; a < i.length; a++) _chatlio[i[a]] || (_chatlio[i[a]] = e(i[a]));
			var n = document.createElement("script"),
				c = document.getElementsByTagName("script")[0];
			n.id = "chatlio-widget-embed", n.src = "https://w.chatlio.com/w.chatlio-widget.js", n.async = !0, n.setAttribute("data-embed-version", "2.3");
			n.setAttribute('data-widget-id', '2ae5a8d6-8494-43e1-55c0-de12d0e7ea10');
			c.parentNode.insertBefore(n, c);
		}();
	</script>
	<!--End of Zendesk Chat Script-->

</head>

<body <?php body_class(); ?> <?php echo wp_kses_post($body_style); ?>>
	<?php

	echo boldthemes_preloader_html(); ?>

	<div class="btPageWrap" id="top">

		<div class="btVerticalHeaderTop">
			<?php if (has_nav_menu('primary')) { ?>
				<div class="btVerticalMenuTrigger">&nbsp;<?php echo boldthemes_get_icon_html(array("icon" => "fa_f0c9", "url" => "#")); ?></div>
			<?php } ?>
			<div class="btLogoArea">
				<div class="logo">
					<span>
						<?php boldthemes_logo('header'); ?>
					</span>
				</div><!-- /logo -->
			</div><!-- /btLogoArea -->
		</div>
		<header class="mainHeader btClear <?php echo esc_attr($header_extra_class); ?>">
			<div class="mainHeaderInner">
				<?php echo boldthemes_top_bar_html('top'); ?>
				<div class="btLogoArea menuHolder btClear">
					<div class="port">
						<?php if (has_nav_menu('primary')) { ?>
							<div class="btHorizontalMenuTrigger">&nbsp;<?php echo boldthemes_get_icon_html(array("icon" => "fa_f0c9", "url" => "#")); ?></div>
						<?php } ?>
						<div class="logo">
							<span>
								<?php boldthemes_logo('header'); ?>
							</span>
						</div><!-- /logo -->
						<?php
						$menu_type = boldthemes_get_option('menu_type');
						if ($menu_type == 'horizontal-below-right' || $menu_type == 'horizontal-below-center' || $menu_type == 'horizontal-below-left' || $menu_type == 'vertical-left' || $menu_type == 'vertical-right') {
							echo boldthemes_top_bar_html('logo');
							echo '</div><!-- /port --></div><!-- /menuHolder -->';
							echo '<div class="btBelowLogoArea btClear"><div class="port">';
						}
						?>
						<div class="menuPort">
							<?php echo boldthemes_top_bar_html('menu'); ?>
							<nav>
								<?php boldthemes_nav_menu(); ?>
							</nav>
						</div><!-- .menuPort -->
					</div><!-- /port -->
				</div><!-- /menuHolder / btBelowLogoArea -->
			</div><!-- / inner header for scrolling -->
		</header><!-- /.mainHeader -->
		<div class="btContentWrap btClear">
			<?php
			$hide_headline = boldthemes_get_option('hide_headline');
			if (((!$hide_headline && !is_404()) || is_search())) {
				boldthemes_header_headline(array('breadcrumbs' => true));
			}
			?>
			<?php if (BoldThemesFramework::$page_for_header_id != '' && !is_search()) { ?>
				<?php
				$content = get_post(BoldThemesFramework::$page_for_header_id);
				$top_content = $content->post_content;
				if ($top_content != '') {
					$top_content = apply_filters('the_content', $top_content);
					$top_content = preg_replace('/data-edit_url="(.*?)"/s', 'data-edit_url="' . get_edit_post_link(BoldThemesFramework::$page_for_header_id, '') . '"', $top_content);
					echo '<div class = "btBlogHeaderContent">' . str_replace(']]>', ']]&gt;', $top_content) . '</div>';
				}

				?>
			<?php } ?>
			<div class="btContentHolder">

				<div class="btContent">