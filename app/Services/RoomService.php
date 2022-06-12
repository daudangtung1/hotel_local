<?php

namespace App\Services;

use App\Models\Room;
use App\Repositories\RoomRepository;

class RoomService
{
    protected $roomRepository;

    /**
     * RoomServices constructor.
     *
     * @param RoomRepository $RoomRepository
     */
    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    public function getAll()
    {
        return $this->roomRepository->getAll();
    }
}
