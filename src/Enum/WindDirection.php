<?php

namespace App\Enum;

enum WindDirection:string
{
    case NORTH = 'North';
    case EAST = 'East';
    case SOUTH = 'South';
    case WEST = 'West';
    case NORTH_WEST = 'North West';
    case NORTH_EAST = 'North East';
    case SOUTH_WEST = 'South West';
    case SOUTH_EAST = 'South-East';

    public static function getWindDirections(): array{

        return [
            self::NORTH,
            self::EAST,
            self::SOUTH,
            self::WEST,
            self::NORTH_WEST,
            self::EAST_WEST,
            self::SOUTH_WEST,
            self::WEST_WEST,
        ];
    }

}