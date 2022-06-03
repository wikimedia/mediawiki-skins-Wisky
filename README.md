# Wisky
Skin for MediaWiki

## Description

This is a maintained fork of https://bitbucket.org/wikiskripta/wisky/ which was originally intended for MediaWiki 1.28. It now follows the MediaWiki releases.

## Installation
* Download and place the skin folder to your /skins/ folder.
* Add the following code to your LocalSettings.php:

```php
wfLoadSkin('Wisky');
```
* If you are using (or planning to use) VisualEditor, add ```"Wisky"``` to a ```$wgVisualEditorSupportedSkins``` global array in your LocalSettings.php.

## Internationalization
This skin is available in English and Czech language. For other languages, just edit files in /i18n/ folder.

## Authors
* [Lukáš Kejha](http://www.lkgraphics.cz), Petr Kajzar
* GNU GPL License, Copyright (c) 2017 First Faculty of Medicine, Charles University