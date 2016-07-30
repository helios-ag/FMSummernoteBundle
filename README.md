FMSummernoteBundle
==================

FMSummernoteBundle adds [summernote](https://github.com/summernote/summernote) bundle


| StyleCI | Downloads | Version | License |
|---------|-----------|---------|---------|
|[![StyleCI](https://styleci.io/repos/43000455/shield)](https://styleci.io/repos/43000455)|[![Total Downloads](https://poser.pugx.org/helios-ag/fm-summernote-bundle/downloads)](https://packagist.org/packages/helios-ag/fm-summernote-bundle)|[![Latest Stable Version](https://poser.pugx.org/helios-ag/fm-summernote-bundle/v/stable)](https://packagist.org/packages/helios-ag/fm-summernote-bundle)|[![License](https://poser.pugx.org/helios-ag/fm-summernote-bundle/license)](https://packagist.org/packages/helios-ag/fm-summernote-bundle)|


## Installation


### Step 1: Installation

Using Composer, just add the following configuration to your `composer.json`:

Or you can use composer to install this bundle:
Add FMSummernoteBundle in your composer.json:

```sh
composer require helios-ag/fm-summernote-bundle
```

Now tell composer to download the bundle by running the command:

```sh
composer update helios-ag/fm-summernote-bundle
```

### Step 2: Enable the bundle

Finally, enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new FM\SummernoteBundle\FMSummernoteBundle(),
    );
}
```

## Configuration

You can configure the bundle as follows, but note that the plugins "elfinder" and "video" are not supported in Jquery2.x.

```yaml
fm_summernote:
    jquery_version: 1 # Default, can be 1 or 2
    plugins:
        - video
        - elfinder # by default plugins not set, bundle comes with elfinder plugin / provides integration with FMElfinderBundle
    selector: .summernote #defines summernote selector for apply to
    toolbar: # define toolbars, if no toolbar configured, default toolbars defined
        ['style', ['style']]
    extra_toolbar: # extra toolbar can be used for plugins toolbar and as additional toolbar setings, when 'toolbar' option is omitted
        elfinder: [elfinder]
    width: 600
    height: 400
    include_jquery: true #include js libraries, if your template already have them, set to false
    include_bootstrap: true
    include_fontawesome: true

```

##Usage

Twig template example

```twig
    {{ summernote_init() }}
    <textarea class="summernote"></textarea>  
```
