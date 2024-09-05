<?php
/*
namespace Functional\Controller;

use App\Entity\School;
use App\Entity\Training;
use App\DataFixtures\SchoolFixtures;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SchoolTest extends WebTestCase
{

    private $school;
    private $entityManager;
    private $client;
    private $fixture;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->entityManager = self::$kernel->getContainer()->get('doctrine')->getManager();
        //$this->entityManager->getConnection()->beginTransaction();
        // Load fixtures
        $this->loadFixtures();
    }

    private function loadFixtures(): void
    {
        $this->fixture = new SchoolFixtures();
        $this->fixture->load($this->entityManager);
    }

    protected function tearDown(): void 
    {
        //$this->entityManager->getConnection()->beginTransaction();
        $entities = $this->fixture->getEntities();

        foreach( $entities as $entity )
        {
            $this->entityManager->remove($entity);
        }

        $this->entityManager->flush();
    }

    public function testTrainingWithDatabase()
    {
        $repository = $this->entityManager->getRepository(Training::class);

        $training = $repository->findOneBy([]);

        echo $training->getId();
        $crawler = $this->client->request('GET', '/training/' . $training->getId());

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        //$this->assertCount(3, $crawler->filter('body > ul li'));
    }
}*/