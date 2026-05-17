<?php

namespace Hexatex\LaravelService\Tests\Unit;

use Hexatex\LaravelService\Service;
use Hexatex\LaravelService\Tests\TestCase;
use Hexatex\LaravelService\Tests\TestObjects\TestModel;
use Hexatex\LaravelService\Tests\TestObjects\TestService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use \Closure;
use \InvalidArgumentException;

class AbstractServiceTest extends TestCase
{
    public function testStoreUpdateDestroyMany_throwCannotUpdate()
    {
        $this->testStoreUpdateDestroyMany(noDestroyMethod: false, throwCannotUpdate: true);
    }

    public function testStoreUpdateDestroyMany_noDestroyMethod()
    {
        $this->testStoreUpdateDestroyMany(noDestroyMethod: true, throwCannotUpdate: false);
    }

    public function testStoreUpdateDestroyMany(bool $noDestroyMethod = false, bool $throwCannotUpdate = false)
    {
        // Arrange
        $service = new TestService();
        $fills = [
            ['test' => 'store'], // store model
            ['id' => 12345, 'test' => 'update'], // update model
        ];
        $updateModel = new TestModel(['id' => 12345, 'test' => 'update']);
        $destroyModel = new TestModel(['id' => 54321, 'test' => 'destroy']);

        $models = new Collection([$destroyModel]);

        if (!$throwCannotUpdate) {
            $models->push($updateModel);
        }

        $destroyClosure = $noDestroyMethod ? null : function ($model) use (&$destroyRan) {
                $destroyRan = true;
                $this->assertEquals($model['test'] ?? null, 'destroy');
            };

        $storeRan = false;
        $updateRan = false;
        $destroyRan = false;

        // Act
        if ($throwCannotUpdate) {
            $this->expectException(InvalidArgumentException::class);
            $this->expectExceptionMessage('Cannot update a model that does not exist in the collection.');
        }

        $service->storeUpdateDestroy(
            $fills,
            $models,
            function ($fill) use (&$storeRan) {
                $storeRan = true;
                $this->assertEquals($fill['test'] ?? null, 'store');
            },
            function ($fill, $model) use (&$updateRan) {
                $updateRan = true;
                $this->assertEquals($fill['test'] ?? null, 'update');
                $this->assertEquals($model['test'] ?? null, 'update');
            },
            $destroyClosure,
        );

        // Assert
        if ($throwCannotUpdate) {
            $this->fail('An exception should have been thrown.');
        }

        $this->assertTrue($storeRan);
        $this->assertTrue($updateRan);

        if ($noDestroyMethod) {
            $this->assertFalse($destroyRan);
        } else {
            $this->assertTrue($destroyRan);
        }
    }
}
