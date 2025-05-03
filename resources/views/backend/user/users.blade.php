
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

            <a href="{{route('users.create')}}" class="inline-fl

            ex items-center px-4 py-2 bg-blue-600 text-white rounded-md shadow-sm hover:bg-blue-700 transition">
                Add User
            </a>
        </header>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="overflow-x-auto">
                <table id="myTable" class="display min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                    <tr>
                        <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-600">ID</th>
                        <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-600">Role Id</th>
                        <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-600">Photo</th>
                        <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-600">Name</th>
                        <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-600">Email</th>
                        <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-600">Created At</th>
                        <th scope="col" class="px-4 py-3 text-left text-sm font-medium text-gray-600">Action</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    <?php if(count($users) > 0): ?>
                    <?php $count = 0;?>
                        <?php foreach($users as $user) : ?>
                    <?php $count++; ?>

                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-sm text-gray-700">{{$count}}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{$user->user_role->name ?? 'N/A'}}</td>
                        <td class="px-4 py-3 text-sm text-gray-700"><img width="50px" src="https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?semt=ais_hybrid&w=740"/></td>
                        <td class="px-4 py-3 text-sm text-gray-700"><?php echo $user->name; ?></td>
                        <td class="px-4 py-3 text-sm text-gray-700"><?php echo $user->email; ?></td>
                        <td class="px-4 py-3 text-sm text-gray-500"><?php echo date('d M Y', strtotime($user->created_at)); ?></td>
                        <td class="px-4 py-3 text-sm px-[10px]">
                            <div class="flex space-x-4">
                                <form action="{{route('users.edit', $user->id)}}" method="GET" class="inline">
                                    @csrf
                                    @method('GET')
                                    <button type="submit"  class="btn btn-info text-red-50">Edit</button>
                                </form>
                                <!---------Delete user with session message --------->
                                @if($user->id !== 1 && $user->id !== auth()->user()->id)
                                    <form action="{{route('users.delete', $user->id)}}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                @endif

                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-sm text-gray-500">No users found.</td>
                    </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

</x-app-layout>
