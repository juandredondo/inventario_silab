<?php 

namespace app\components\filters;

class AuthAccessRule extends \yii\filters\AccessRule
{
    protected function matchRole($user)
    {
        if (empty($this->roles)) {
            return true;
        }
        foreach ($this->roles as $role) {
            if ($role === '?') {
                if ($user->getIsGuest()) {
                    return true;
                }
            } elseif ($role === '@') {
                if (!$user->getIsGuest()) {
                    return true;
                }
            } elseif ($user->identity !== null ) {
                if($user->identity->can($role))
                    return true;
            }
        }
        return false;
    }
}

?>