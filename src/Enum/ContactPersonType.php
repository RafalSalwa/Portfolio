<?php

namespace App\Enum;

enum ContactPersonType:string{
    case Recruiter ='recruiter';
    case Interviewer ='interviewer';

    public function getLabel()
    {

    }
}