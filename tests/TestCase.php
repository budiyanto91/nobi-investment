<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    protected $baseUrl = null;
    protected $baseModel = null;

    protected function setBaseUrl($url)
    {
        $this->baseUrl = $url;
    }

    protected function setBaseModel($model)
    {
        $this->baseModel = $model;
    }

    protected function findAll($url = '')
    {
        $url = $this->baseUrl ? $this->baseUrl : $url;

        $response = $this->getJson(url($url))->assertSuccessful();

        return $response;
    }

    protected function findByPaginator($url = '')
    {
        $url = $this->baseUrl ? $this->baseUrl : $url;

        $response = $this->getJson(url($url))->assertJson(fn ($json) =>
            $json->hasAny('data', 'links', 'meta')
                ->whereAllType([
                    'data' => 'array',
                    'links' => 'array',
                    'meta' => 'array'
            ])
        )->assertSuccessful();

        return $response;
    }

    protected function create($success = true, $attributes = [], $model = '', $url = '')
    {
        $url = $this->baseUrl ? $this->baseUrl : $url;
        $model = $this->baseModel ?? $model;
        
        $response = $this->postJson(url($url), $attributes);

        $model = new $model;

        $success ? $this->assertDatabaseHas($model->getTable(), $attributes) : $this->assertDatabaseMissing($model->getTable(), $attributes);

        return $response;
    }
}
