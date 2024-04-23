<?php

namespace App\Enum;

enum ContactReason:string{
    case JobOffer ='job_offer';
    case Feedback ='feedback';
    case Question ='question';
    case FeatureRequest ='feature_request';

    public function getLabel()
    {

    }
}