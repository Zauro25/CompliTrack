@php
    $role = auth()->user()?->role;

    $menu = match ($role) {
        'admin' => [
            ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'active' => ['admin.dashboard']],
            ['label' => 'Users', 'route' => 'admin.users.index', 'active' => ['admin.users.*']],
            ['label' => 'Divisions', 'route' => 'admin.divisions.index', 'active' => ['admin.divisions.*']],
            ['label' => 'Policies', 'route' => 'admin.policies.index', 'active' => ['admin.policies.*']],
            ['label' => 'Policy Versions', 'route' => 'admin.policies-versions.index', 'active' => ['admin.policies-versions.*']],
            ['label' => 'Register Auditor', 'route' => 'register.auditor', 'active' => ['register.auditor']],
        ],
        'staff' => [
            ['label' => 'Dashboard', 'route' => 'staff.dashboard', 'active' => ['staff.dashboard']],
            ['label' => 'My Policies', 'route' => 'staff.policies.index', 'active' => ['staff.policies.*']],
            ['label' => 'My Checklists', 'route' => 'staff.checklists.index', 'active' => ['staff.checklists.*']],
            ['label' => 'Compliance Entries', 'route' => 'staff.compliance-entries.index', 'active' => ['staff.compliance-entries.*']],
            ['label' => 'Upload Evidence', 'route' => 'staff.evidences.index', 'active' => ['staff.evidences.*']],
        ],
        'auditor' => [
            ['label' => 'Dashboard', 'route' => 'auditor.dashboard', 'active' => ['auditor.dashboard']],
            ['label' => 'Compliance Entries', 'route' => 'auditor.compliance-entries.index', 'active' => ['auditor.compliance-entries.*']],
            ['label' => 'Audit Reviews', 'route' => 'auditor.audit-reviews.index', 'active' => ['auditor.audit-reviews.*']],
        ],
        default => [],
    };
@endphp

<aside class="w-full lg:w-64">
    <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
        <div class="border-b border-gray-200 px-4 py-3">
            <p class="text-sm text-gray-500">Role</p>
            <p class="font-semibold text-gray-800">{{ ucfirst($role ?? 'user') }}</p>
        </div>

        <nav class="p-2">
            @foreach ($menu as $item)
                <a
                    href="{{ route($item['route']) }}"
                    class="mb-1 block rounded-md px-3 py-2 text-sm transition {{ request()->routeIs(...$item['active']) ? 'bg-gray-900 text-white' : 'text-gray-700 hover:bg-gray-100' }}"
                >
                    {{ $item['label'] }}
                </a>
            @endforeach

            <a
                href="{{ route('profile.edit') }}"
                class="mb-1 block rounded-md px-3 py-2 text-sm transition {{ request()->routeIs('profile.edit') ? 'bg-gray-900 text-white' : 'text-gray-700 hover:bg-gray-100' }}"
            >
                Profile Settings
            </a>
        </nav>
    </div>
</aside>
