<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class GenerateFactoryTest extends TestCase
{
    public function testArticleFactory(): void
    {
        for($i = 0; $i >= 0; $i++) {
            Factory(Article::class)->create();
        }

        $this->assertTrue(true, true);
    }
}
