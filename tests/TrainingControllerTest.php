<?php

namespace Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\School;
use App\Entity\Training;
use App\Entity\Module;
use App\DataFixtures\SchoolFixtures;

class TrainingTest extends WebTestCase
{
    public function testBasicSearch()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/search_training');

        $em = self::$kernel->getContainer()->get('doctrine')->getManager();
        $trainings = $em->getRepository(Training::class)->findAll();
        $modules = $em->getRepository(Module::class)->findAll();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', 'Recherche de formation par module');
        $this->assertCount( count($trainings) , $crawler->filter('tbody > tr'));

        $this->assertCount( count($modules) + 1  , $crawler->filter('label'));
    }

    public function testSearchWithModule()
    {
        $moduleId = 3;
        $client = static::createClient();
        $crawler = $client->request('GET', '/search_training?modules[]='.$moduleId );

        $em = self::$kernel->getContainer()->get('doctrine')->getManager();
        $trainings = $em->getRepository(Training::class)->findByModules([$moduleId]);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', 'Recherche de formation par module');
        $this->assertCount( count($trainings) , $crawler->filter('tbody > tr'));
    }

    public function testSearchAnyModule()
    {
        $moduleId = 187;
        $client = static::createClient();
        $crawler = $client->request('GET', '/search_training?modules[]='.$moduleId."&match_any_module=1" );

        $em = self::$kernel->getContainer()->get('doctrine')->getManager();
        $trainings = $em->getRepository(Training::class)->findByAnyModule([$moduleId]);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', 'Recherche de formation par module');
        $this->assertCount( count($trainings) , $crawler->filter('tbody > tr'));
    }

    public function testModuleDetailsPage()
    {
        $client = static::createClient();
        $em = self::$kernel->getContainer()->get('doctrine')->getManager();

        $module = $em->getRepository(Module::class)->findOneBy([]);

        $this->assertNotNull($module, 'Aucun module trouvé en base de données.');

        $url = '/module/' . $module->getId();

        $client->request('GET', $url);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertResponseIsSuccessful();

        $this->assertSelectorTextContains('h1', $module->getName());
    }

   


}

/*

namespace Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class TrainingControllerTest extends WebTestCase
{

    public function testCheckbox()
    {
        $client = static::createClient();
    
        $crawler = $client->request('GET', '/search_training', [
            'match_any_module' => '1'
        ]);
    
        $this->assertResponseIsSuccessful();
        
        $this->assertTrue($crawler->filter('input[name="match_any_module"]')->attr('checked') !== null);
    }

    public function testSelectedModules()
{
    $client = static::createClient();

    $crawler = $client->request('GET', '/search_training', [
        'modules' => [1, 2, 3]
    ]);

    $this->assertResponseIsSuccessful();
    
    $selectedModules = $crawler->filter('input[name="modules[]"]')->extract(['value']);

   // $this->assertEquals(['1', '2', '3'], $selectedModules);
}

    

    
    
    
}*/