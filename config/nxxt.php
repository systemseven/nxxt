<?php

return [
    'permissions' => [
        ['key' => 'builders', 'set' => ['view', 'create', 'edit', 'delete']],
        ['key' => 'vendors', 'set' => ['view', 'create', 'edit', 'delete']],
        ['key' => 'items', 'set' => ['view', 'create', 'edit', 'delete']],
        ['key' => 'communities', 'set' => ['view', 'create', 'edit', 'delete']],
        ['key' => 'users', 'set' => ['view', 'create', 'edit', 'delete']],
        ['key' => 'users_roles', 'set' => ['view', 'create', 'edit', 'delete']],
        ['key' => 'reports', 'set' => ['view']],
        ['key' => 'scheduling', 'set' => ['view', 'create', 'edit', 'delete']],
    ],
    'default_roles' => [
        ['name' => 'super_admin', 'permissions' => []],
        ['name' => 'builders_help_desk_expeditor', 'permissions' => ['builders:*', 'communities:*']],
        ['name' => 'scheduling_expeditor', 'permissions' => ['scheduling:*']],
        ['name' => 'field_manager', 'permissions' => []],
        ['name' => 'crew_leader', 'permissions' => []],
        ['name' => 'accounting', 'permissions' => ['reports:*']],
        ['name' => 'help_desk_&_scheduling_management', 'permissions' => ['scheduling*', 'builders*', 'communities*']],
        ['name' => 'upper_management', 'permissions' => ['reports:*']],
    ],
];
