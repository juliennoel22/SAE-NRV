<?php

namespace iutnc\NRV\classes\Actions;

use iutnc\NRV\classes\Actions\Action;
use iutnc\NRV\classes\Actions\DefaultAction;
use iutnc\NRV\classes\Auth\Authn;

class LogoutAction extends Action
{
    public function execute(): string
    {
        (new Authn())->logoutUser();
        return (new DefaultAction())->execute();

    }
}