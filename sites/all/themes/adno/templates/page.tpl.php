<div id="body-wrapper">
  <div id="page-wrapper">
    <div id="header">
      <?php if ($logo): ?>
        <a href="<?php print $front_page; ?>" title="<?php print t('Return to the homepage'); ?>" rel="home" id="logo">
          <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
        </a>
      <?php endif; ?>

      <?php print render($page['header']); ?>
      <?php print render($page['nav']); ?>
    </div>

    <div id="content-wrapper">
      <div id="content" <?php if (isset($page['sidebar_right']) && $page['sidebar_right']) {
          print 'class="right-sidebar-enabled"';
        }?>>

        <?php print render($title_prefix); ?>
        <?php if ($title): ?>
          <h1 id="page-title" class="title"><?php print $title; ?></h1>
        <?php endif; ?>
        <?php print render($title_suffix); ?>

        <?php if ($messages): ?>
          <div id="messages"><?php print $messages; ?></div>
        <?php endif; ?>

        <?php if ($tabs): ?>
          <div class="tabs"><?php print render($tabs); ?></div>
        <?php endif; ?>

        <?php print render($page['help']); ?>

        <?php if (isset($action_links) && $action_links): ?>
          <ul class="action-links"><?php print render($action_links); ?></ul>
        <?php endif; ?>

        <?php print render($page['content']); ?>
      </div>

      <?php if (isset($page['sidebar_right']) && $page['sidebar_right']): ?>
        <div id="sidebar-right" class="sidebar">
          <?php print render($page['sidebar_right']); ?>
        </div>
      <?php endif; ?>
    </div>

    <?php if ($page['doormat']): ?>
      <div id="doormat"><?php print render($page['doormat']); ?></div>
    <?php endif; ?>

    <?php if ($page['footer']): ?>
      <div id="footer"><?php print render($page['footer']); ?></div>
    <?php endif; ?>
  </div>
</div>
<div id="background">
  <?php print $background_image; ?>
</div>
