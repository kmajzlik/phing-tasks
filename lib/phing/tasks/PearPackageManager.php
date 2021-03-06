<?php

require_once dirname(__FILE__) . '/PackageManagerInterface.php';
require_once "phing/Task.php";

class PearPackageManager implements PackageManagerInterface
{
    /**
     * Inherited
     */
    public function isInstalled($packageName)
    {
        $command = "pear info %s 2>&1 | awk 'BEGIN { s = 0 } /^Name/ { s = 1; exit }; END { if(s == 0) exit 1 }'";

        exec(sprintf($command, $packageName), $output, $exitStatus);

        return ($exitStatus == 0);
    }

    /**
     * Inherited
     */
    public function getInstallCommand()
    {
        return 'pear install';
    }
}
