<?php

namespace Armincms\Qasedak;

use Illuminate\Support\Manager;
use Armincms\Qasedak\Contracts\Service;

class ServiceManager extends Manager
{
    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return 'armin';
    }

    /**
     * Create an instance of the Armin SMS driver.
     * 
     * @return \Armincms\Qasedak\Repository
     */
    protected function createArminDriver()
    { 
        return $this->repository(new ArminService((array) $this->config->get('armin-sms')));
    }

    /**
     * Create a new cache repository with the given implementation.
     *
     * @param  \Armincms\Qasedak\Contracts\service $service
     * @return \Armincms\Qasedak\Repository
     */
    public function repository(Service $service)
    {
        return tap(new Repository($service), function ($repository) {
            // $this->setEventDispatcher($repository);
        });
    }
}
