<?php

/*
 * This file is part of the Phalcon Documentation Website.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE.txt file that was distributed with this source code.
 */

use Docs\Bootstrap;

// Register the auto loader
require __DIR__.'/../bootstrap/autoloader.php';

(new Bootstrap())->run();