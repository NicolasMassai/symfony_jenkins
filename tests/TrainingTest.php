<?php

namespace Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use App\Entity\Training;
use App\Entity\Module;
use PHPUnit\Framework\TestCase;

class TrainingTest extends TestCase
{
    public function testTraining()
    {
        $training = new Training();

        for ($i = 0; $i < 3; $i++) {
            $module = new Module();
            $module->setName($i);
            $training->addModule($module);
        }

        $modules = $training->getModules();

        $this->assertCount(3, $modules);
    }
}
