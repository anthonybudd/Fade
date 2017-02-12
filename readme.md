# Fade

A simple WordPress plugin for remotely disabling wordpress sites that does not require login details.
Read [this Medium post](https://medium.com/@AnthonyBudd/how-to-get-your-freelance-clients-to-pay-58b3c0d0e91e#.19tmpclug)

## Setup
Either drop the plugin folder into the mu-plugins directory or require the class and call the static method Fade::boot() anywhere in your theme's PHP files. You could also put the plugin in your plugins directory but this is not recommended.
```php
// functions.php
<?php
    require 'fade.php';
    add_action('init', ['Fade', 'boot']);
````
The first time you refresh the website after adding the plugin it will generate a random key and show it on your screen, keep this key for later. You will only be shown it once.

Once enabled you can control the opacity by url by navigating to the website and adding the following GET parameters:
fade: ‘on’ or ‘off’ - This enables or disables the fade
opacity: decimal value between 1 and 0 — This will be the css opacity value
key: the key that was shown earlier.

## Examples
Set opacity to 0.95: http://example.com/?fade=on&opacity=0.95&key=e8P3vgHy6w
Set opacity to 0.5: http://example.com/?fade=on&opacity=0.5&key=e8P3vgHy6w
Disable the plugin: http://example.com/?fade=off&key=e8P3vgHy6w

