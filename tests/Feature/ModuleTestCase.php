<?php

namespace Modules\ModuleControl\Tests;

use JWTAuth;
use Tests\TestCase;
use Modules\ModuleControl\Entities\Action;
use Modules\ModuleControl\Entities\User;
use Modules\ModuleControl\Traits\ModuleDatabaseMigrations;

abstract class ModuleTestCase extends TestCase
{
    use ModuleDatabaseMigrations;

    protected $loggedUser;

    public function setup()
    {
        parent::setup();
        $this->loggedUser = factory(User::class)->create();
    }

    private function headers()
    {
        $token = JWTAuth::fromUser($this->loggedUser);
        JWTAuth::setToken($token);

        return [
            'Accept' => 'application/json',
            'Authorization' => sprintf('Bearer %s', $token),
        ];
    }

    public function json($method, $uri, array $data = [], array $headers = [])
    {
        $headers = array_merge($headers, $this->headers());

        return parent::json($method, $uri, $data, $headers);
    }


    /**
     * Este método insere a permissão de acesso nescessária para executar a
     * operação desejada.
     *
     * @param string $title        Título da Action
     * @param string $description  Descrição da Action
     * @param string $method       Método HTTP usado
     * @param string $to           URL de destino usada nas rotas
     */
    public function setAccessPermission(
        $title,
        $description,
        $method,
        $to,
        $module = 'Sebrae',
        $allow_access = 0
    ) {
        $action = Action::create([
            'title' => $title,
            'description' => $description,
            'icon' => 'filter_list',
            'to' => $to,
        ]);

        $action->rules()->create([
            'module_name' => $module,
            'route_uri' => $to,
            'route_method' => $method,
            'allow_access' => $allow_access,
        ]);

        $this->loggedUser->permissions()->attach([
            $action->id
        ]);
    }
}
