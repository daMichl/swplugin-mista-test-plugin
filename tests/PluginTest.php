<?php

namespace MistaTestPlugin\Tests;

use MistaTestPlugin\MistaTestPlugin as Plugin;
use Shopware\Components\Test\Plugin\TestCase;

class PluginTest extends TestCase
{
    protected static $ensureLoadedPlugins = [
        'MistaTestPlugin' => []
    ];

    public function testCanCreateInstance()
    {
        /** @var Plugin $plugin */
        $plugin = Shopware()->Container()->get('kernel')->getPlugins()['MistaTestPlugin'];

        $this->assertInstanceOf(Plugin::class, $plugin);
    }
}
