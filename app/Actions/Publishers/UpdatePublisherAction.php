<?php

namespace App\Actions\Publishers;

use App\Data\Publishers\PublisherData;
use App\Models\Publisher;

class UpdatePublisherAction
{
    /**
     * Atualiza uma editora.
     */
    public function execute(
        Publisher $publisher,
        PublisherData $data
    ): Publisher {

        $publisher->update(
            $data->toArray()
        );

        return $publisher->refresh();

    }
}
