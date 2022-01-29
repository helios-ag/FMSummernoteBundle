<?php

declare(strict_types=1);

namespace FM\SummernoteBundle\Composer;

use Composer\Script\CommandEvent;
use Composer\Script\Event;
use FM\SummernoteBundle\Installer\SummernoteInstaller;
use Sensio\Bundle\DistributionBundle\Composer\ScriptHandler;

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
