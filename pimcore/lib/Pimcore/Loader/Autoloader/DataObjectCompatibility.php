<?php
/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Enterprise License (PEL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 * @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 * @license    http://www.pimcore.org/license     GPLv3 and PEL
 */

namespace Pimcore\Loader\Autoloader;

class DataObjectCompatibility
{
    /**
     * @param $class
     * @return bool
     */
    public function load($class) {
        if(strpos($class, 'Pimcore\\Model\Object\\') === 0) {
            $realClassName = str_replace('Pimcore\\Model\\Object\\', 'Pimcore\\Model\\DataObject\\', $class);
            class_alias($realClassName, $class);
            return true;
        }
    }

    /**
     * @param bool $prepend
     */
    public function register($prepend = false)
    {
        spl_autoload_register([$this, 'load'], true, $prepend);
    }

    /**
     *
     */
    public function unregister()
    {
        spl_autoload_unregister([$this, 'load']);
    }
}
