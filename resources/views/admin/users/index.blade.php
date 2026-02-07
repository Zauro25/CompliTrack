@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold text-primary mb-6">Users</h1>
    <a href="{{ route('admin.users.create') }}" class="mb-4 inline-block px-4 py-2 bg-primary text-white rounded hover:bg-primary-600">Add User</a>
    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-primary text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($users as $user)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-block px-2 py-1 rounded bg-secondary text-white text-xs">{{ ucfirst($user->role) }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-primary hover:underline mr-2">Edit</a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Delete this user?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">{{ $users->links() }}</div>
    </div>
</div>
@endsection
