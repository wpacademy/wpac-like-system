# WPAC Social Tools - Like, React & Share
The Most Simple WordPress Post Like, Dislike &amp; Reaction System with Social Sharing.. :v:

This will add powerful social features to your WordPress website. Engage with your website visitors by giving them the opportunity to react with your content. This plugin will all like dislike buttons with like vs dislike bar or you can add emoji reactions like Facebook.
Both visitors and logged-in members can react to your posts. Not only reactions but a social sharing bar as well so no more different plugins.
This plugin also has a widget to show most liked or disliked posts anywhere you like.

This plugin is my first project, so feel free to provide feedback via support forums. You can also contribute to help me improve this open-source project.

## Installation

1. Click on the `Download ZIP` button at the right to download the plugin.
2. Upload the entire `wpac-like-system` folder to the `/wp-content/plugins/` directory.
3. Activate the plugin through the `Plugins` menu in WordPress.

## Settings
You can change button labels and other settings by visiting `WPAC Settings` Tab

<img src="https://user-images.githubusercontent.com/38207694/61747890-5ef1bf80-adb8-11e9-8299-12e57f4bce63.png" alt="WPAC Settings Screen">

## Shortcodes
`[WPAC_LIKE_SYSTEM]` Display Like & Dislike buttons in post or page. 

`[WPAC_LIKE_COUNT]` Return Like count for current post being viewed.

`[WPAC_DISLIKE_COUNT]` Return Dislike count for current post being viewed.

`[WPAC_LIKE_COUNT id="123"]` Return Like count for given post ID.

`[WPAC_DISLIKE_COUNT id="123"]` Return Disike count for given post ID.

`[WPAC_LIKE_COUNT string="Liked % times"]` Return Like count wrapped in a string, use `%` where you want to display count value.

`[WPAC_DISLIKE_COUNT string="Disliked % times"]` Return Disike count wrapped in a string, use `%` where you want to display count value.


## Changelog
5. 3.0.0
    * New Feature: Now non-logged-in users can also like/dislike or React.
    * New Feature: Liked vs Dislike bar.
    * New Feature: Social Sharing Bar.
    * New Widget: Now you can show most liked/disliked posts anywhere with the new widget.
    * Reactions count now updated without reloading the page.
    * Improvements in code.
    * CSS bug fixes.
4. 2.0.3 -  Fixed new reaction icons
3. 2.0.2
    * Added new reaction styles (emojis).
    * Added option to change success and error strings
    * upgraded database for future updates to features
    * like and dislike count now updates without page reload
    * various reported bugs are fixed
2. 2.0.0 - Added Reaction System, New Shortcode and Fixed Bugs.
1. 1.0.0 - Started the project
