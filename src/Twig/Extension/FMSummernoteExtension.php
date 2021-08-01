<?php

namespace FM\SummernoteBundle\Twig\Extension;

use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Class FMSummernoteExtension.
 */
class FMSummernoteExtension extends AbstractExtension
{
    /**
     * @var array
     */
    protected $parameters;

    /**
     * @var Environment
     */
    protected $twig;

    /**
     * @param $parameters
     * @param Environment $twig
     */
    public function __construct($parameters, Environment $twig)
    {
        $this->parameters = $parameters;
        $this->twig = $twig;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('summernote_init', [$this, 'summernoteInit'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * @return string
     */
    public function summernoteInit()
    {
        $template = $this->parameters['init_template'];
        $options = [];

        $options['fontname'] = count($this->parameters['fontname']) > 0 ? $this->prepareArrayParameter('fontname') : $this->getDefaultFontname();
        $options['fontnocheck'] = count($this->parameters['fontnocheck']) > 0 ? $this->prepareArrayParameter('fontnocheck') : null;
        $options['language'] = isset($this->parameters['language']) ? $this->parameters['language'] : null;
        $options['plugins'] = isset($this->parameters['plugins']) ? $this->parameters['plugins'] : null;
        $options['selector'] = $this->parameters['selector'];
        $options['width'] = $this->parameters['width'];
        $options['height'] = $this->parameters['height'];
        $options['include_jquery'] = $this->parameters['include_jquery'];
        $options['include_bootstrap'] = $this->parameters['include_bootstrap'];
        $options['include_fontawesome'] = $this->parameters['include_fontawesome'];
        $options['fontawesome_path'] = $this->parameters['fontawesome_path'];
        $options['bootstrap_css_path'] = $this->parameters['bootstrap_css_path'];
        $options['bootstrap_js_path'] = $this->parameters['bootstrap_js_path'];
        $options['jquery_path'] = $this->parameters['jquery_path'];
        $options['summernote_css_path'] = $this->parameters['summernote_css_path'];
        $options['summernote_js_path'] = $this->parameters['summernote_js_path'];
        $options['jquery_version'] = $this->parameters['jquery_version'];
        $options['toolbar'] = $this->prepareToolbar();

        $base_path = (!isset($this->parameters['base_path']) ? 'bundles/fmsummernote/Jquery'.$options['jquery_version'].'.x/' : $this->parameters['base_path']);

        return $this->twig->render($template, ['sn' => $options, 'base_path' => $base_path]);
    }

    private function prepareToolbar()
    {   // builds summernote toolbar array
        if (empty($this->parameters['toolbar']) && empty($this->parameters['extra_toolbar'])) {
            return;
        }

        $str = '[';
        $toolbar = $this->parameters['toolbar'];
        $str .= $this->processToolbar($toolbar);
        if (!empty($this->parameters['extra_toolbar'])) {
            if (empty($this->parameters['toolbar'])) {
                $str .= $this->getDefaultToolbar();
            }
            $str .= $this->processToolbar($this->parameters['extra_toolbar']);
        }
        $str .= ']';

        return $str;
    }

    /**
     * Return a javascript array.
     *
     * @var string name
     *             The name of the parameter to look for
     *
     * @return string
     */
    private function prepareArrayParameter($name)
    {
        if (isset($this->parameters[$name])) {
            $parameterArray = $this->parameters[$name];
            $count = count($parameterArray);
            $str = "['".$parameterArray[0]."'";

            for ($i = 1; $i < $count; ++$i) {
                $str .= ", '".$parameterArray[$i]."'";
            }

            $str .= ']';

            return $str;
        }
    }

    /**
     * Return [ $key, [data, data] ],.
     *
     * @param array $toolbar
     *
     * @return string
     */
    private function processToolbar(array $toolbar)
    {
        $str = '';
        foreach ($toolbar as $key => $tb) {
            $str .= sprintf("[ '%s', ", $key);
            $str .= json_encode($tb);
            $str .= '], ';
        }

        return $str;
    }

    /**
     * return default toolbar when only extra_toolbar is defined.
     *
     * @return string
     */
    private function getDefaultToolbar()
    {
        return "['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'hr']],
                ['view', ['fullscreen', 'codeview']],
                ['help', ['help']],";
    }

    public function getDefaultFontname()
    {
        return "['Arial', 'Courier New', 'Helvetica', 'Times New Roman']";
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'fm_summernote';
    }
}
