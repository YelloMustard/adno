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

        <div id="titlebox">
        <?php print render($title_prefix); ?>
        <?php if ($title): ?>
          <h1 id="page-title" class="title"><?php print $title; ?></h1>
        <?php endif; ?>
        <?php print render($title_suffix); ?>
          <!-- AddThis Button BEGIN -->
          <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
          <a class="addthis_button_preferred_1"></a>
          <a class="addthis_button_preferred_2"></a>
          <a class="addthis_button_preferred_3"></a>
          <a class="addthis_button_preferred_4"></a>
          <a class="addthis_button_compact"></a>
          <a class="addthis_counter addthis_bubble_style"></a>
          </div>
          <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-51093c6249181b7e"></script>
          <!-- AddThis Button END -->
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

         <div id="submenu-and-content">
          <?php if (isset($page['submenu']) && $page['submenu']): ?>
            <div id="submenu">
              <?php print render($page['submenu']); ?>
            </div>
          <?php endif; ?>
          
          <?php print render($page['content']); ?>
          <div class="clearfix">&nbsp;</div>
        </div>
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
      <div id="footer"><?php print render($page['footer']); ?>
        <!-- AddThis Button BEGIN -->
        <div class="addthis_toolbox addthis_default_style ">
        <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
        </div>
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-51093b1e5dcce3ef"></script>
        <!-- AddThis Button END -->
       </div>
    <?php endif; ?>
  </div>
</div>
<?php /*
<div id="background">
  <?php print $background_image; ?>
</div>
*/ ?>