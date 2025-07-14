<?php

namespace Tests\Unit;

use App\Models\Space;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SpaceTest extends TestCase
{
    use RefreshDatabase;  // უზრუნველყოფს მონაცემთა ბაზის სუფთა მდგომარეობას ტესტის დაწყებამდე

    /** @test */
    public function it_can_read_spaces_from_database()
    {
        // Arrange: შექმნათ მაგალითი Space მოდელის მონაცემები
        $space = Space::create([
            'slug' => 'unique-slug',
            'rank' => 5,
            'status' => 'active',
            'image' => 'image_url',
            'image_link' => 'image_link_url'
        ]);

        // Act: ჩასვლა ბაზაში და მიკითხვა მონაცემი
        $retrievedSpace = Space::where('slug', 'unique-slug')->first();

        // Assert: შევამოწმოთ რომ მონაცემი სწორად წავიკითხეთ
        $this->assertNotNull($retrievedSpace);  // დარწმუნება, რომ ინფორმაცია არსებობს
        $this->assertEquals('unique-slug', $retrievedSpace->slug);  // გადამოწმება, რომ slug სწორი ყოფილა
        $this->assertEquals(5, $retrievedSpace->rank);  // გადამოწმება rank-ი
        $this->assertEquals('active', $retrievedSpace->status);  // გადამოწმება status
    }
}
