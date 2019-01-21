<?php
i18n_gallery_register('lightcase', 'light case', 
  'A beautiful, flexible and responsive Lightbox Plugin to present various types of media and content famously. Lightcase was specially developed and successfully applied for the requirements of the event planning platform Evounce. The Lightcase Plugin is Open Source and free to use. It is licensed under the GPL license. Redistribution and use in source and binary forms, with or without modification, are permitted with the only condition that redistributions of source code must retain the full copyright notice. https://cornel.bopp-art.com/lightcase/',
  'i18n_gallery_lightcase_edit', 'i18n_gallery_lightcase_header', 
  'i18n_gallery_lightcase_content');

function i18n_gallery_lightcase_edit($gallery) {
    // called for the input fields in the admin gallery configuration
    // all field IDs and names must be prefixed mytype-
    // all Javascript functions must include the type name to be unique
    //
    // Options: show thumb title
    
?>
  <p>
    <label for="fancybox-thumbwidth"><?php i18n('i18n_gallery/MAX_THUMB_DIMENSIONS'); ?></label>
    <input type="text" class="text" id="fancybox-thumbwidth" name="fancybox-thumbwidth" value="<?php echo @$gallery['thumbwidth']; ?>" style="width:5em"/>
    x
    <input type="text" class="text" id="fancybox-thumbheight" name="fancybox-thumbheight" value="<?php echo @$gallery['thumbheight']; ?>" style="width:5em"/>
    &nbsp;
    <span id="fancybox-thumbcrop-span">
      <input type="checkbox" id="fancybox-thumbcrop" name="fancybox-thumbcrop" value="1" <?php echo @$gallery['thumbcrop'] ? 'checked="checked"' : ''; ?> style="vertical-align:middle; width:auto;"/> 
      <?php i18n('i18n_gallery/CROP'); ?>
    </span>
  </p>
<?php
}

function i18n_gallery_lightcase_header($gallery) {
  // called in the header of a page with a gallery
  // add CSS and Javascript files, etc.
    
    // Gallery Settings: Do not include CSS (global)
    if (i18n_gallery_check($gallery,'jquery') && i18n_gallery_needs_include('jquery.js')) 
    {
?>
<script type="text/javascript" src="<?php echo i18n_gallery_site_link(); ?>plugins/i18n_gallery/js/jquery-1.11.2.min.js"></script>
<?php
    } 
    if (i18n_gallery_check($gallery,'css') && i18n_gallery_needs_include('lightcase.css')) { 
?>
<link rel="stylesheet" type="text/css" href="<?php echo i18n_gallery_site_link(); ?>plugins/i18n_gallery/plugin_lightcase/css/lightcase.css">
<?php
    }
    if (i18n_gallery_check($gallery,'js') && i18n_gallery_needs_include('lightcase.js')) 
    {
?>
<script type="text/javascript" src="<?php echo i18n_gallery_site_link(); ?>plugins/i18n_gallery/plugin_lightcase/js/lightcase.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('a[data-rel^=lightcase]').lightcase();
    });

</script>
<?php
    }
}


function i18n_gallery_lightcase_content($gallery) {
    // called to actually display the gallery
    //
    // Vars (php):
    // $id = gallery name
    // htmlspecialchars(@$item['_title'] = images title
    // htmlspecialchars(@$item['_description']) = image description
    // i18n_gallery_image_link($gallery,$item) = full image link
    // i18n_gallery_thumb_link($gallery,$item) = thumb image link
    // w = width
    // h = height
    //

    $id = i18n_gallery_id($gallery);

    
    if (i18n_gallery_is_show_image($pic)) {
    $item = i18n_gallery_item($gallery, $pic);
?>
<div class="gallery gallery-lightcase gallery-<?php echo $id; ?>">
    <div class="gallery-image ">
        <!-- to add -->
    </div>
</div>
<?php
  } else { 
?>
<div class="gallery gallery-fancybox gallery-<?php echo $id; ?>">
    
<?php 
    foreach ($gallery['items'] as $item) 
    {
?>
    <a href="<?php echo i18n_gallery_image_link($gallery,$item); ?>" class="showcase" data-rel="lightcase:<?php echo $id; ?>" title="<b><?php echo htmlspecialchars(@$item['_title']); ?></b><br /><p><?php echo htmlspecialchars(@$item['_description']); ?></p>">
        <div class="image wallpaper" data-wallpaper="<?php i18n_gallery_thumb_link($gallery,$item); ?>" style="height: 150px; width: 150px; 
background-image: url('<?php i18n_gallery_thumb_link($gallery,$item); ?>');  background-color: rgba(255, 255, 255, 0.75); background-repeat: no-repeat;   background-position: center; margin: 10px; float:left;">
            <div class="caption">
                <p class="gallery-title" style="text-align: center; vertical-align: bottom; font-size: 0.75rem; color:#fff; text-shadow: 1px 1px 1px #000;"><?php echo htmlspecialchars(@$item['_title']); ?></p>
            </div>
        </div>
    </a>
<?php
    }
}
}