<?php

namespace App\Service;

use App\Repository\SessionRepository;

class SessionService
{
    private SessionRepository $sessionRepository;

    public function __construct(SessionRepository $sessionRepository){
        $this->sessionRepository = $sessionRepository;
    }
    
    public function getAllSession()
    {
        return $this->sessionRepository->findAll();
    }

}