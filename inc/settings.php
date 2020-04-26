<?php
/*
* Register Setting Section, Fields abd Setting Pages HTML
*/

//Setting Page HTML Templates & Forms
require plugin_dir_path( __FILE__ ). 'setting-parts/setting-forms.php';

//Setting Pages Menu Tabs
require plugin_dir_path( __FILE__ ). 'setting-parts/menu-pages.php';

// Register settings, sections & fields.
require plugin_dir_path( __FILE__ ). 'setting-parts/register-settings.php';

/* 
* Setting Pages Form Fields
*/

//General Setting Page Form Fields
require plugin_dir_path( __FILE__ ). 'setting-fields/general.php';

// Buttons Setting Page Form Fields
require plugin_dir_path( __FILE__ ). 'setting-fields/buttons.php';

// Reactions Setting Page Form Fields
require plugin_dir_path( __FILE__ ). 'setting-fields/reactions.php';

// Sharing Setting Page Form Fields
require plugin_dir_path( __FILE__ ). 'setting-fields/sharing.php';