<?php

namespace App\Tests\Controller;

use App\Entity\Reservation;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ReservationControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/reservation/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Reservation::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Reservation index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'reservation[dateDebut]' => 'Testing',
            'reservation[dateFin]' => 'Testing',
            'reservation[status]' => 'Testing',
            'reservation[nombrePersonnes]' => 'Testing',
            'reservation[lieu]' => 'Testing',
            'reservation[createdAt]' => 'Testing',
            'reservation[updatedAt]' => 'Testing',
            'reservation[commentaires]' => 'Testing',
            'reservation[prix]' => 'Testing',
            'reservation[moyenPaiement]' => 'Testing',
            'reservation[Event]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Reservation();
        $fixture->setDateDebut('My Title');
        $fixture->setDateFin('My Title');
        $fixture->setStatus('My Title');
        $fixture->setNombrePersonnes('My Title');
        $fixture->setLieu('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setCommentaires('My Title');
        $fixture->setPrix('My Title');
        $fixture->setMoyenPaiement('My Title');
        $fixture->setEvent('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Reservation');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Reservation();
        $fixture->setDateDebut('Value');
        $fixture->setDateFin('Value');
        $fixture->setStatus('Value');
        $fixture->setNombrePersonnes('Value');
        $fixture->setLieu('Value');
        $fixture->setCreatedAt('Value');
        $fixture->setUpdatedAt('Value');
        $fixture->setCommentaires('Value');
        $fixture->setPrix('Value');
        $fixture->setMoyenPaiement('Value');
        $fixture->setEvent('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'reservation[dateDebut]' => 'Something New',
            'reservation[dateFin]' => 'Something New',
            'reservation[status]' => 'Something New',
            'reservation[nombrePersonnes]' => 'Something New',
            'reservation[lieu]' => 'Something New',
            'reservation[createdAt]' => 'Something New',
            'reservation[updatedAt]' => 'Something New',
            'reservation[commentaires]' => 'Something New',
            'reservation[prix]' => 'Something New',
            'reservation[moyenPaiement]' => 'Something New',
            'reservation[Event]' => 'Something New',
        ]);

        self::assertResponseRedirects('/reservation/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getDateDebut());
        self::assertSame('Something New', $fixture[0]->getDateFin());
        self::assertSame('Something New', $fixture[0]->getStatus());
        self::assertSame('Something New', $fixture[0]->getNombrePersonnes());
        self::assertSame('Something New', $fixture[0]->getLieu());
        self::assertSame('Something New', $fixture[0]->getCreatedAt());
        self::assertSame('Something New', $fixture[0]->getUpdatedAt());
        self::assertSame('Something New', $fixture[0]->getCommentaires());
        self::assertSame('Something New', $fixture[0]->getPrix());
        self::assertSame('Something New', $fixture[0]->getMoyenPaiement());
        self::assertSame('Something New', $fixture[0]->getEvent());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Reservation();
        $fixture->setDateDebut('Value');
        $fixture->setDateFin('Value');
        $fixture->setStatus('Value');
        $fixture->setNombrePersonnes('Value');
        $fixture->setLieu('Value');
        $fixture->setCreatedAt('Value');
        $fixture->setUpdatedAt('Value');
        $fixture->setCommentaires('Value');
        $fixture->setPrix('Value');
        $fixture->setMoyenPaiement('Value');
        $fixture->setEvent('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/reservation/');
        self::assertSame(0, $this->repository->count([]));
    }
}
