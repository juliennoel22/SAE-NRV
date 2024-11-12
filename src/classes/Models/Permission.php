<?php

namespace iutnc\NRV\classes\Models;

class Permission
{
    private int $role_id;
    private string $role_name;
    private int $role_level;

    public function __construct(int $role_id, string $role_name, int $role_level)
    {
        $this->role_id = $role_id;
        $this->role_name = $role_name;
        $this->role_level = $role_level;
    }

    public function getRoleId(): int
    {
        return $this->role_id;
    }

    public function getRoleName(): string
    {
        return $this->role_name;
    }

    public function getRoleLevel(): int
    {
        return $this->role_level;
    }
}
