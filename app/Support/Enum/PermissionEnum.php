<?php

namespace App\Support\Enum;

enum PermissionEnum: string
{
  case USER_VIEW = 'user.view';
  case USER_UPDATE = 'user.update';
  case USER_DELETE = 'user.delete';

  case SUBSCRIPTION_MANAGE = 'subscription.manage';
}
