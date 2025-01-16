<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage User') }}
        </h2>
    </x-slot>
    
    <link rel="stylesheet" href="{{ asset('css/Superadmin/manageacc.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <div class="container-fluid mt-4">
        @if (session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-sm rounded-lg p-4">
            <!-- Create Account Button aligned to the right -->
            <div class="mb-4 text-right">
                <a href="{{ route('create') }}" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-plus-circle"></i> Create New Account
                </a>
            </div>

        <div class="bg-white shadow-sm rounded-lg p-4">
            <table class="table table-striped manage-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accounts as $account)
                        <tr>
                            <td class="td-border">{{ $account->name }}</td>
                            <td class="td-border">{{ $account->email }}</td>
                            <td class="td-border">{{ $account->role }}</td>
                            <td class="td-border">
                                <a href="{{ route('Superadmin.edit', $account->role) }}" class="btn btn-sm btn-outline-primary me-2">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                <form action="{{ route('Superadmin.delete-account', $account->role) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this account?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
