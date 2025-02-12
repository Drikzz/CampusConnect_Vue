@extends('dashboard.dashboard')

@section('dashboard-content')
    <div class="max-w-2xl mx-auto">
        <h2 class="text-2xl font-bold mb-6">Profile Settings</h2>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="flex items-center space-x-6 mb-6">
                <div class="shrink-0">
                    <img class="h-24 w-24 object-cover rounded-full"
                        src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/default-avatar.png') }}"
                        alt="{{ $user->username }}">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Profile Picture</label>
                    <input type="file" name="profile_picture" accept="image/*"
                        class="mt-1 block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-primary-color/10 file:text-primary-color
                        hover:file:bg-primary-color/20">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" name="first_name" id="first_name"
                        value="{{ old('first_name', $user->first_name) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-color focus:ring-primary-color">
                </div>

                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-color focus:ring-primary-color">
                </div>
            </div>

            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-color focus:ring-primary-color">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" value="{{ $user->email }}" disabled
                    class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 shadow-sm">
                <p class="mt-1 text-sm text-gray-500">Email cannot be changed</p>
            </div>

            @if ($user->is_student)
                <div class="space-y-4">
                    <h3 class="text-lg font-medium">Student ID Verification</h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">ID Front</label>
                        <input type="file" name="wmsu_id_front" accept="image/*"
                            class="mt-1 block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-primary-color/10 file:text-primary-color
                            hover:file:bg-primary-color/20">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">ID Back</label>
                        <input type="file" name="wmsu_id_back" accept="image/*"
                            class="mt-1 block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-primary-color/10 file:text-primary-color
                            hover:file:bg-primary-color/20">
                    </div>
                </div>
            @endif

            <div class="flex justify-end">
                <button type="submit" class="bg-primary-color text-white px-4 py-2 rounded-md hover:bg-primary-color/90">
                    Save Changes
                </button>
            </div>
        </form>

        @if (!$user->is_seller)
            <div class="mt-8 border-t pt-6">
                <h3 class="text-lg font-medium mb-4">Become a Seller</h3>
                <p class="text-gray-600 mb-4">Start selling your products on our platform</p>
                <a href="{{ route('dashboard.become-seller') }}"
                    class="inline-block bg-primary-color text-white px-4 py-2 rounded-md hover:bg-primary-color/90">
                    Apply Now
                </a>
            </div>
        @endif
    </div>
@endsection
