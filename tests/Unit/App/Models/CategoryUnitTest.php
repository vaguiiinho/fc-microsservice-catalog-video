<?php

namespace Tests\Unit\App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PHPUnit\Framework\TestCase;

class CategoryUnitTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    protected function model(): Model
    {
        return new Category();
    }

    public function testIfUsedTraits()
    {
        $traitsNeeds = [
            HasFactory::class,
            SoftDeletes::class,
        ];

        $traitsUsed = array_keys(class_uses($this->model()));

        $this->assertEquals($traitsNeeds, $traitsUsed);
    }
}
