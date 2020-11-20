<?php

declare(strict_types=1);

namespace App\Http;

/**
 * Class Transformer
 * @package App\Http
 */
abstract class Transformer
{
    /**
     * @param $data
     * @return array
     */
    public function transformCollection($data)
    {
        return array_map([$this, 'transform'], $data);
    }

    /**
     * @param $item
     * @return mixed
     */
    abstract public function transform($item);
}
