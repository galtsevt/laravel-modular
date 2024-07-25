<?php

use Galtsevt\LaravelModular\App\Exceptions\ModuleNotFoundException;
use Galtsevt\LaravelModular\App\Modular\Module;
use Galtsevt\LaravelModular\App\Modular\SimpleModuleManager;
use PHPUnit\Framework\TestCase;

class SimpleModuleManagerTest extends TestCase
{
    /**
     * @throws ModuleNotFoundException
     */
    public function testRegisterModule()
    {
        $module = new Module();
        $moduleManager = new SimpleModuleManager([]);
        $moduleManager->register($module);

        $this->assertSame(true, $moduleManager->has($module->getKey()));
        $this->assertSame($module->getName(), $moduleManager->get($module->getKey())->getName());
    }

}
