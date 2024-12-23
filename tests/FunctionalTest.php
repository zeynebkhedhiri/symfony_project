<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EventControllerTest extends WebTestCase
{
    public function testCreateNewEvent()
    {
        $client = static::createClient();

        // Navigate to the 'New Event' page
        $crawler = $client->request('GET', '/event/new');

        // Check if the page loads successfully
        $this->assertResponseIsSuccessful();

        // Select the form and fill in data
        $form = $crawler->selectButton('Save')->form([
            'event[title]' => 'Test Event',
            'event[description]' => 'This is a test event.',
            'event[date]' => '2024-12-31', // Replace with actual form field names.
        ]);

        // Submit the form
        $client->submit($form);

        // Follow the redirect after successful form submission
        $client->followRedirect();

        // Check if the event was created successfully
        $this->assertSelectorTextContains('.event-item', 'Test Event'); // Adjust selector for your template
    }
}
