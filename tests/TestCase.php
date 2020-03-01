<?php

namespace Tests;

use App\Http\Middleware\VerifyCsrfToken;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;
    protected $base_route = null;
    protected $base_model = null;

    protected function signIn($user = null)
    {
        $user = $user ?? create(\App\Models\User::class);
        $this->actingAs($user);
        return $this;
    }

    protected function setBaseRoute($route)
    {
        $this->base_route = $route;
    }

    protected function setBaseModel($model)
    {
        $this->base_model = $model;
    }

    protected function create($attributes = [], $model = '', $route = '')
    {
        $this->withoutExceptionHandling()->withoutMiddleware(VerifyCsrfToken::class);
        $route = $this->base_route ? "{$this->base_route}.store" : $route;
        $model = $this->base_model ?? $model;
        $attributes = raw($model, $attributes);

        if (!auth()->user()) {
            $this->expectException(\Illuminate\Auth\AuthenticationException::class);
        }

        $response = $this->post(route($route), $attributes)
            ->assertSessionHas('message', 'Successfully created')
            ->assertSessionHas('messageType', 's');

        $attributes = array_map(function ($attribute) {

                if(verifyIfInputIsADate($attribute)){
                    return \Carbon\Carbon::createFromFormat('d/m/Y', $attribute)
                        ->startOfDay();
                }

            return $attribute;
        }, $attributes);

        $model = new $model;
        $this->assertDatabaseHas($model->getTable(), $attributes);
        return $response;
    }

    protected function update($attributes = [], $model = '', $route = '')
    {
        $this->withoutExceptionHandling()->withoutMiddleware(VerifyCsrfToken::class);
        $route = $this->base_route ? "{$this->base_route}.update" : $route;
        $model = $this->base_model ?? $model;
        $model = create($model, $attributes);
        if (!auth()->user()) {
            $this->expectException(\Illuminate\Auth\AuthenticationException::class);
        }
        $response = $this->patchJson(route($route, $model->id), $model->toArray());
        tap($model->fresh(), function ($model) use ($attributes) {
            collect($attributes)->each(function ($value, $key) use ($model) {
                $this->assertEquals($value, $model[$key]);
            });
        });
        return $response;
    }

    protected function destroy($model = '', $route = '')
    {
        $this->withoutExceptionHandling()->withoutMiddleware(VerifyCsrfToken::class);
        $route = $this->base_route ? "{$this->base_route}.destroy" : $route;
        $model = $this->base_model ?? $model;
        $model = create($model);
        if (!auth()->user()) {
            $this->expectException(\Illuminate\Auth\AuthenticationException::class);
        }
        $response = $this->deleteJson(route($route, $model->id));
        $this->assertDatabaseMissing($model->getTable(), $model->toArray());
        return $response;
    }

    public function multipleDelete($model = '', $route = '')
    {
        $this->withoutExceptionHandling()->withoutMiddleware(VerifyCsrfToken::class);
        $route = $this->base_route ? "{$this->base_route}.destroyAll" : $route;
        $model = $this->base_model ?? $model;
        $model = create($model, [], 5);
        $ids = $model->map(function ($item, $key) {
            return $item->id;
        });
        return $this->deleteJson(route($route), ['ids' => $ids]);
    }

}
