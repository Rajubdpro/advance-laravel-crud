
<x-app-layout>
    <!-- Make sure you have Tailwind CSS included in your main layout -->
    <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class=" w-full bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="overflow-x-auto">
                <!-- Edit User Form -->
                <div class="bg-white rounded-lg shadow-md p-6 max-w-7xl mx-auto">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-gray-800">Edit User</h2>
                    </div>

                    <form action="{{route('users.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                        <!-- User Photo -->
                        <div class="mb-6">
                            <div class="flex items-center">
                                <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden mr-4">
                                    <img id="user-photo-preview" src="https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?semt=ais_hybrid&w=740" alt="User photo" class="w-full h-full object-cover" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Profile Photo</label>
                                    <div class="flex items-center space-x-2">
                                        <label class="px-3 py-1.5 bg-blue-600 text-white text-sm font-medium rounded-md cursor-pointer hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Upload New
                                            <input type="file" class="hidden" id="user-photo" accept="image/*" />
                                        </label>
                                        <button type="button" class="px-3 py-1.5 border border-gray-300 text-sm font-medium rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- User ID (Disabled) -->
                            <div>
                                <label for="user-id" class="block text-sm font-medium text-gray-700 mb-1">ID</label>
                                <input type="text" id="user-id" name="user-id" disabled value="{{$user->id}}"
                                       class="bg-gray-100 text-gray-500 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none">
                            </div>

                            <!-- Name -->
                            <div>
                                <label for="user-name" class="block text-sm font-medium text-gray-700 mb-1">Name <span class="text-red-500">*</span></label>
                                <input type="text" id="user-name" name="name" required value="{{$user->name}}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="user-email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                                <input type="email" id="user-email" name="email" required value="{{$user->email}}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="user-password" class="block text-sm font-medium text-gray-700 mb-1"> Current Password</label>
                                <input type="password" id="user-password" name="user-password" placeholder="Your current password"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <!-- New Password -->
                            <div>
                                <label for="new-password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                                <input type="password" id="new-password" name="new-password"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="confirm-password" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                                <input type="password" id="confirm-password" name="confirm-password"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                           @if($user->id == 1 )
                            <!-- Role -->
                            <div>
                                <label for="user-role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                                <select id="user-role" name="user-role"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                    <option value="editor">Editor</option>
                                </select>
                            </div>
                            @endif
                            <!-- Status -->
                            @if($user->id == 1)
                            <div>
                                <label for="user-status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select id="user-status" name="user-status"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="suspended">Suspended</option>
                                </select>
                            </div>
                            @endif
                        </div>

                        <!-- Form Actions -->
                        <div class="mt-8 flex justify-end space-x-3">
                            <a href="{{'/users'}}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Cancel
                            </a>
                            <!----- User update form action ------>
                            <form action="{{route('users.update', $user->id)}}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Update User
                                </button>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>
