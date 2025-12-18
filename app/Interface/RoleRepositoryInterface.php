<?php

namespace App\Interface;

use Spatie\Permission\Models\Role;

interface RoleRepositoryInterface
{
    /** Get all roles with user and permission counts */
    public function getAll();

    /** Get a role by ID with its permissions and users */
    public function getById($id);

    /** Create a new role and assign permissions */
    public function create(array $data);

    /** Update a role and sync its permissions */
    public function update(Role $role, array $data);

    /** Delete a role if no users assigned */
    public function delete(Role $role);

    /** Assign a role to multiple users */
    public function assignRoleToUsers(Role $role, array $userIds);
}
