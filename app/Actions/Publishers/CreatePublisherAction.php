<?php

namespace App\Actions\Publishers;

use App\Data\Publishers\PublisherData;
use App\Models\Publisher;

class CreatePublisherAction
{
    /**
     * Cria uma nova editora.
     */
    public function execute(
        PublisherData $data
    ): Publisher {

        return Publisher::create(
            $data->toArray()
        );

    }
}
