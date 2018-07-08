<?php

namespace FM\SummernoteBundle\Composer;

use Composer\Script\CommandEvent;
use Composer\Script\Event;
use Sensio\Bundle\DistributionBundle\Composer\ScriptHandler;
use FM\SummernoteBundle\Installer\SummernoteInstaller;

class SummernoteScriptHandler extends ScriptHandler
{
    /**
     * @param CommandEvent|Event $event
     */
    public static function install($event)
    {
        $installer = new SummernoteInstaller();
        $installer->install();
    }
}
