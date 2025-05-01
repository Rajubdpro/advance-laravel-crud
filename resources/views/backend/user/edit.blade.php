
<x-app-layout>
    <!-- Make sure you have Tailwind CSS included in your main layout -->
    <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <header class="flex justify-between items-center py-6">
            <h2 class="text-lg font-medium text-gray-900">
                Users List {{count($users)}}
            </h2>
            @if (session('success'))
                <div class="text-green-500 bg-green-100 border border-green-400 rounded-md py-3 px-5">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="text-red-500 bg-red-100-100 border border-red-400 rounded-md py-3 px-5">
                    {{ session('error') }}
                </div>
            @endif

            <a href="#" class="inline-fl

            ex items-center px-4 py-2 bg-blue-600 text-white rounded-md shadow-sm hover:bg-blue-700 transition">
                Add User
            </a>
        </header>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="overflow-x-auto">
                <!-- Edit User Form -->
                <div class="bg-white rounded-lg shadow-md p-6 max-w-2xl mx-auto">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-gray-800">Edit User</h2>
                        <button type="button" class="text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form>
                        <!-- User Photo -->
                        <div class="mb-6">
                            <div class="flex items-center">
                                <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden mr-4">
                                    <img id="user-photo-preview" src="https://via.placeholder.com/80" alt="User photo" class="w-full h-full object-cover" />
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
                                <input type="text" id="user-id" name="user-id" disabled value="9"
                                       class="bg-gray-100 text-gray-500 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none">
                            </div>

                            <!-- Name -->
                            <div>
                                <label for="user-name" class="block text-sm font-medium text-gray-700 mb-1">Name <span class="text-red-500">*</span></label>
                                <input type="text" id="user-name" name="user-name" required value="Colorado Mcmahon"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="user-email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                                <input type="email" id="user-email" name="user-email" required value="wyjydifoxj@mailinator.com"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Created At (Disabled) -->
                            <div>
                                <label for="created-at" class="block text-sm font-medium text-gray-700 mb-1">Created At</label>
                                <input type="text" id="created-at" name="created-at" disabled value="01 May 2025"
                                       class="bg-gray-100 text-gray-500 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none">
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="user-password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                <input type="password" id="user-password" name="user-password" placeholder="Leave blank to keep current password"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <p class="mt-1 text-xs text-gray-500">Leave blank if you don't want to change the password</p>
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="confirm-password" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                                <input type="password" id="confirm-password" name="confirm-password"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

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

                            <!-- Status -->
                            <div>
                                <label for="user-status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select id="user-status" name="user-status"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="suspended">Suspended</option>
                                </select>
                            </div>
                        </div>

                        <!-- Additional Information Section -->
                        <div class="mt-6">
                            <h3 class="text-md font-medium text-gray-700 mb-3">Additional Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Phone -->
                                <div>
                                    <label for="user-phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                    <input type="tel" id="user-phone" name="user-phone"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Address -->
                                <div>
                                    <label for="user-address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                    <input type="text" id="user-address" name="user-address"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>

                            <!-- Notes -->
                            <div class="mt-4">
                                <label for="user-notes" class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                                <textarea id="user-notes" name="user-notes" rows="3"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="mt-8 flex justify-end space-x-3">
                            <button type="button" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Update User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>
