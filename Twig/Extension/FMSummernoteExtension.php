<?php

namespace FM\SummernoteBundle\Twig\Extension;

/**
 * Class FMSummernoteExtension
 * @package FM\SummernoteBundle\Twig\Extension
 */
class FMSummernoteExtension extends \Twig_Extension
{
    /**
     * @var array
     */
    protected $parameters;

    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * @param $parameters
     * @param \Twig_Environment $twig
     */
    public function __construct($parameters, \Twig_Environment $twig)
    {
        $this->parameters = $parameters;
        $this->twig       = $twig;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('summenote_init', array($this, 'summernoteInit'), array('is_safe' => array('html')))
        );
    }

    /**
     * @return string
     */
    public function summernoteInit()
    {
        $template = $this->parameters['init_template'];
        $options = array();

        $options['language']            = isset($this->parameters['language']) ? $this->parameters['language']: null;
        $options['plugins']             = isset($this->parameters['plugins']) ? $this->parameters['plugins']: null;;
        $options['selector']            = $this->parameters['selector'];
        $options['width']               = $this->parameters['width'];
        $options['height']              = $this->parameters['height'];
        $options['include_jquery']      = $this->parameters['include_jquery'];
        $options['include_bootstrap']   = $this->parameters['include_bootstrap'];
        $options['include_fontawesome'] = $this->parameters['include_fontawesome'];
        $options['fontawesome_path']    = $this->parameters['fontawesome_path'];
        $options['bootstrap_css_path']  = $this->parameters['bootstrap_css_path'];
        $options['bootstrap_js_path']   = $this->parameters['bootstrap_js_path'];
        $options['jquery_path']         = $this->parameters['jquery_path'];
        $options['summernote_css_path'] = $this->parameters['summernote_css_path'];
        $options['summernote_js_path']  = $this->parameters['summernote_js_path'];

        $options['toolbar'] = $this->prepareToolbar();

        $base_path = (!isset($this->parameters['base_path']) ? 'bundles/fmsummernote/' : $this->parameters['base_path']);

        return $this->twig->render($template, array('sn' => $options, 'base_path' => $base_path));
    }

    private function prepareToolbar()
    {   // builds summernote toolbar array
        if(empty($this->parameters['toolbar']) && empty($this->parameters['extra_toolbar'])) {
            return null;
        }

        $str = '[';
        $toolbar = $this->parameters['toolbar'];
        $str .= $this->processToolbar($toolbar);
        if(!empty($this->parameters['extra_toolbar'])) {
            if(empty($this->parameters['toolbar'])) {
                $str .= $this->getDefaultToolbar();
            }
            $str .= $this->processToolbar($this->parameters['extra_toolbar']);

        }
        $str .= ']';

        return $str;
    }

    /**
     * Return [ $key, [data, data] ],
     * @param array $toolbar
     * @return string
     */
    private function processToolbar(array $toolbar)
    {
        $str = '';
        foreach ($toolbar as $key => $tb) {
            $str .= sprintf("[ '%s', ", $key);
            $str .= json_encode($tb);
            $str .='], ';
        }

        return $str;
    }

    /**
     * return default toolbar when only extra_toolbar is defined
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