<?php

namespace Bfg\PullerLivewire;

use App\Pulls\MyTestPull;
use Bfg\Puller\Controllers\PullerController;
use Bfg\Puller\Core\Dehydrator;
use Livewire\Controllers\HttpConnectionHandler;

class PullerLivewireController extends HttpConnectionHandler
{
    protected $states = [];

    protected $results = [];

    public function __invoke()
    {
        $fingerprint = parent::__invoke();
        $this->applyTasks(PullerController::getQueue());
        $fingerprint['puller'] = ['results' => $this->results, 'states' => $this->states];
        return $fingerprint;
    }

    protected function applyTasks(array $tasks)
    {
        Dehydrator::collection($tasks, function (Dehydrator $dehydrator, $key) {
            PullerController::forgetQueue($key);
            $this->states = array_merge($this->states, $dehydrator->states);
            $this->results[] = $dehydrator->response();
        });

        if (PullerController::hasQueue()) {
            $this->applyTasks(PullerController::getQueue());
        }
    }
}
