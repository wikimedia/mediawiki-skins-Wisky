# Wisky
Skin for MediaWiki

## Decription
This skin is intended for MediaWiki 1.28. Graphic design was created by Lukas Kejha (http://www.lkgraphics.cz), code by Slepi (http://www.wikiskripta.eu/index.php/User:Slepi).

## Instalation
* Make sure you have MediaWiki 1.28 installed.
* Download and place the skin folder to your /skins/ folder.
* Add the following code to your LocalSettings.php:

```php
wfLoadSkin('Wisky');
```
* If you are using (or planning to use) VisualEditor, add ```"Wisky"``` to a ```$wgVisualEditorSupportedSkins``` global array in your LocalSettings.php.

## Internationalization
This skin is available in English and Czech language. For other languages, just edit files in /i18n/ folder.
