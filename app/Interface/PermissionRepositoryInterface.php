<?php

namespace App\Interface;

interface PermissionRepositoryInterface
{
    /** Get all permissions ordered by ID */
    public function getAll();

    /** Get a permission by ID with its roles */
    public function getById($id);
}
