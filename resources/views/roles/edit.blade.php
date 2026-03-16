<x-layouts.app>
    <div class="mb-6 flex items-center text-sm">
        <a href="{{ route('dashboard') }}"
            class="text-blue-600 dark:text-blue-400 hover:underline">{{ __('Dashboard') }}</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2 text-gray-400" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <a href="{{ route('roles.index') }}"
            class="text-blue-600 dark:text-blue-400 hover:underline">{{ __('Roles') }}</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2 text-gray-400" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-gray-500 dark:text-gray-400">{{ __('Edit') }}</span>
    </div>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ __('Edit Role') }}</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">{{ __('Update role details and permissions') }}</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="p-6">
            <form action="{{ route('roles.update', $role) }}" method="POST" class="max-w-2xl">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <x-forms.input label="Name" name="name" type="text" value="{{ old('name', $role->name) }}" required />
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('Permissions') }}
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 bg-gray-50 dark:bg-gray-900 p-4 rounded-md">
                        @forelse($permissions as $permission)
                            <div>
                                <x-forms.checkbox 
                                    name="permissions[]" 
                                    value="{{ $permission->id }}" 
                                    label="{{ $permission->name }}"
                                    :checked="in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray()))" />
                            </div>
                        @empty
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('No permissions available.') }}</p>
                        @endforelse
                    </div>
                    @error('permissions')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <x-button type="primary">{{ __('Update') }}</x-button>
                    <a href="{{ route('roles.index') }}">
                        <x-button type="secondary">{{ __('Cancel') }}</x-button>
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
