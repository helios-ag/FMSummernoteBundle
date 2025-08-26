# FMSummernoteBundle

[![Tests](https://github.com/helios-ag/FMSummernoteBundle/actions/workflows/test.yaml/badge.svg)](https://github.com/helios-ag/FMSummernoteBundle/actions/workflows/test.yaml)

[![Total Downloads](https://poser.pugx.org/helios-ag/fm-summernote-bundle/downloads)](https://packagist.org/packages/helios-ag/fm-summernote-bundle)
[![Latest Stable Version](https://poser.pugx.org/helios-ag/fm-summernote-bundle/v/stable)](https://packagist.org/packages/helios-ag/fm-summernote-bundle)
[![License](https://poser.pugx.org/helios-ag/fm-summernote-bundle/license)](https://packagist.org/packages/helios-ag/fm-summernote-bundle)
[![Codacy Badge](https://app.codacy.com/project/badge/Coverage/7e69b3d893b94af78df72631ee4f5496)](https://app.codacy.com/gh/helios-ag/FMSummernoteBundle/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_coverage)
FMSummernoteBundle integrates the [Summernote WYSIWYG editor](https://summernote.org/) with Symfony applications.
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/7e69b3d893b94af78df72631ee4f5496)](https://app.codacy.com/gh/helios-ag/FMSummernoteBundle/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_grade)

## Requirements

- PHP 8.0 or higher
- Symfony 6.0 or higher
- jQuery (can be included automatically)

## Installation

### Step 1: Install the bundle

```bash
composer require helios-ag/fm-summernote-bundle
```

### Step 2: Enable the bundle

If you're using Symfony Flex, the bundle will be enabled automatically. Otherwise, enable it in your `config/bundles.php` file:

```php
// config/bundles.php

return [
    // ...
    FM\SummernoteBundle\FMSummernoteBundle::class => ['all' => true],
];
```

## Configuration

You can configure the bundle as follows, but note that the plugins "elfinder" and "video" are not supported in Jquery2.x.

```yaml
fm_summernote:
    plugins:
        - video
        - elfinder # by default plugins not set, bundle comes with elfinder plugin / provides integration with FMElfinderBundle
    selector: .summernote #defines summernote selector for apply to
    toolbar: # define toolbars, if no toolbar configured, default toolbars defined
        style: [style]
        bold: [bold]
    extra_toolbar: # extra toolbar can be used for plugins toolbar and as additional toolbar setings, when 'toolbar' option is omitted
        elfinder: [elfinder]
    width: 600
    height: 400
    language: '' # define language (with language culture code like de-DE, fr-FR, etc.) by default, it is in english
    include_jquery: true #include js libraries, if your template already have them, set to false
    include_bootstrap: true
    include_fontawesome: true
```

## Usage

Twig template example

```twig
    {{ summernote_init() }}
    <textarea class="summernote"></textarea>  
```
