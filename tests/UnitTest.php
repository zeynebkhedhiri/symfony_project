<?php

namespace App\Tests;

use App\Entity\Event;
use PHPUnit\Framework\TestCase;

class EventTest extends TestCase
{
    public function testEventProperties()
    {
        $event = new Event();
        
        // Test title property
        $event->setTitle('Test Event');
        $this->assertTrue($event->getTitle() === 'Test Event');
        
        // Test description property
        $event->setDescription('This is a test description.');
        $this->assertTrue($event->getDescription() === 'This is a test description.');
        
        // Test date property
        $date = new \DateTime('2024-12-31');
        $event->setDate($date);
        $this->assertTrue($event->getDate() === $date);
    }
}
