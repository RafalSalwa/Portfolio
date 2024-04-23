<?php

namespace App\Enum;

enum ContactTechStaffReason:string{
    case Bug ='bug';
    case Question ='question';
    case FeatureRequest ='feature_request';

}