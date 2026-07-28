<?php

namespace App\Enums;

enum BookFormat: string
{
    case PAPERBACK = 'Capa comum';

    case HARDCOVER = 'Capa dura';

    case DIGITAL = 'Ebook';

    case AUDIOBOOK = 'Audiobook';
}
