<?php 
/**
 * This file copy the main command to project root
 */

namespace CorleyComposer;

use ComposerScriptEvent;

class Install
{
    public static function starts(Event $event)
    {
    	$path = realpath(dirname(__FILE__));
		copy("$path/kernel/commands/manage.php", "$path/../../../manage.php");
        $event->getIO()->write("manage file copied");
    }
}
