 <!-- filepath: c:\xampp\htdocs\Cuatro_Patee\resources\views\account.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Add Account</title>
   

</head>
<body class="bg-[#ccd8dd]">
    <div class="m-2">
        
        <div class="flex items-center jusitfy-between m-8">
            @include('side.sidebar')
            <div class="flex w-full justify-end items-center  gap-4">
                <button type="button" data-modal-target="addAccountModal" data-modal-toggle="addAccountModal" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                    + Add Account
                </button>
                <form action="{{ route('accounts.index') }}" method="GET" class="flex items-center">
                    <input type="text" name="search" placeholder="Search accounts..." class="border border-gray-300 rounded-full px-3 py-2 mr-2 focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ request('search') }}">
                    <button type="submit">
                        <svg class="w-8 h-8 mr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="10" cy="10" r="6" stroke="#2c3747" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></circle><path d="M14.5 14.5L19 19" stroke="#2c3747" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </button>
                </form>
            </div>
           
        </div>
       <div class="flex flex-col items-center justify-center m-8 ">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-[#2c3747] text-white">
                    <th class="py-2 px-4 border">User ID</th>
                    <th class="py-2 px-4 border">Name</th>
                    <th class="py-2 px-4 border">Email</th>
                    <th class="py-2 px-4 border">Username</th>
                    <th class="py-2 px-4 border">Role</th>
                    <th class="py-2 px-4 border">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accounts as $account)
                    <tr>
                        <td class="py-2 px-4 border">{{$account->id}}</td>
                        <td class="py-2 px-4 border  ">
                                <div class="flex items-center gap-3">
                                    @if($account->image)
                                        @if(Str::startsWith($account->image, ['http://', 'https://', 'data:image']))
                                            <img src="{{ $account->image }}" alt="account Image" class="w-16 h-16 object-cover rounded-full">
                                        @else
                                            <img src="{{ asset('storage/' . $account->image) }}" alt="account Image" class="w-16 h-16 object-cover rounded">
                                        @endif
                                    @endif
                                    <span>{{ $account->name }}</span>
                                </div>
                            </td>
                        <td class="py-2 px-4 border">{{$account->email}}</td>
                        <td class="py-2 px-4 border">{{$account->username}}</td>
                        <td class="py-2 px-4 border">{{$account->role}}</td>
                        <td class="py-2 px-4 border flex items-center justify-center gap-4 h-auto">
                            <div class="flex items-center justify-center gap-2 min-h-16">
                                <button type="button" data-modal-target="editModal-{{ $account->id }}" data-modal-toggle="editModal-{{ $account->id }}" class="flex items-center text-green-700 justify-center w-10 h-10 rounded-full hover:bg-green-100 transition">
                                    Edit
                                </button>
                                <button data-modal-target="deleteModal-{{ $account->id }}" data-modal-toggle="deleteModal-{{ $account->id }}" class="flex items-center text-red-700 justify-center w-10 h-10 rounded-full hover:bg-red-100 transition">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>

        <div id="addAccountModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                <div class="relative p-4  min-w-md h-full md:h-auto">
                    <div class="relative bg-white rounded-lg shadow">
                        <div class="flex justify-between items-center p-4 border-b rounded-t">
                            <h3 class="text-xl font-semibold">Add Account</h3>
                            
                            <a href=""  class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            
                            </a>
                        </div>
                      <form action="{{ route('accounts.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-2 gap-6 p-6 space-y-4">
                        @csrf

                        <div>
                            <label class="block mb-1 font-semibold">Upload Image (optional)</label>
                            <input type="file" name="image" accept="image/*" class="w-full border rounded px-3 py-2">
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold">Name</label>
                            <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold">Email</label>
                            <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold">Username</label>
                            <input type="text" name="username" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold">Password</label>
                            <input type="password" name="password" class=" w-full border rounded px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block mb-1 font-semibold">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div>
                            <label class="block mb-1 font-semibold">Role</label>
                            <select name="role" class="w-full border rounded px-3 py-2" required>
                                <option value="" disabled selected>Select role</option>
                                <option value="admin">Admin</option>
                                <option value="staff">Staff</option>
                            </select>
                        </div>

                        <div class="col-span-2 flex justify-end gap-2">
                            <a href="" class="w-[100px] text-center py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</a>
                            <button type="submit" class=" py-2 w-[100px] bg-green-600 text-white rounded hover:bg-green-700">Add</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

             @foreach($accounts as $account)

                <div id="editModal-{{ $account->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                        <div class="relative bg-white rounded-lg shadow">
                            <div class="flex justify-between items-center p-4 border-b rounded-t">
                                <h3 class="text-xl font-semibold">Edit Account</h3>
                                 <a href=""  class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </a>
                            </div>
                              <form action="{{ route('accounts.update', $account->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                                @csrf
                                @method('PUT')
                                <div>
                                    <div>
                                        <label class="block mb-1 font-semibold">Upload New Image (optional)</label>
                                        <input type="file" name="image" accept="image/*" class="w-full border rounded px-3 py-2">
                                    </div>                  
                                   @if($account->image)
                                        @if(Str::startsWith($account->image, ['http://', 'https://', 'data:image']))
                                            <img src="{{ $account->image }}" alt="account Image" class="w-16 h-32 object-cover rounded mt-2">
                                        @else
                                            <img src="{{ asset('storage/' . $account->image) }}" alt="account Image" class="w-16 h-32 object-cover rounded mt-2">
                                        @endif
                                    @endif
                                </div>
                                <div>
                                    <label class="block mb-1 font-semibold">Name</label>
                                    <input type="text" name="name" class="w-full border rounded px-3 py-2" value="{{ $account->name }}" required>
                                </div>
                                <div>
                                    <label class="block mb-1 font-semibold">Email</label>
                                    <input type="email"  name="email" class="w-full border rounded px-3 py-2" value="{{ $account->email }}" required>
                                </div>
                                <div>
                                    <label class="block mb-1 font-semibold">Username</label>
                                    <input type="text" name="username" class="w-full border rounded px-3 py-2" value="{{ $account->username }}" required>
                                </div>
                                <div>
                                    <label class="block mb-1 font-semibold">Password</label>
                                    <input type="password" name="password" class="w-full border rounded px-3 py-2" value="{{ $account->password }}" required>
                                </div>
                                <div>
                                    <label class="block mb-1 font-semibold">Role</label>
                                    <select name="role" class="w-full border rounded px-3 py-2" required>
                                        <option value="admin" @if($account->role == 'admin') selected @endif>Admin</option>
                                        <option value="staff" @if($account->role == 'staff') selected @endif>Staff</option>
                                    </select>
                                </div>
                                <div class="flex justify-end gap-2">
                                    <a href="" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</a>
                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div id="deleteModal-{{ $account->id }}" tabindex="-1" class="hidden fixed z-50 w-full inset-0 justify-center items-center ">
                    <div class="relative p-4 w-full max-w-md h-full md:h-auto mx-auto flex items-center">
                        <div class="relative bg-white rounded-lg shadow w-full">
                            <div class="flex justify-between items-center p-4 border-b rounded-t">
                                <h3 class="text-xl font-semibold">Delete Account</h3>
                                 <a href=""  class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </a>
                            </div>
                            <form action="{{ route('accounts.destroy', $account->id) }}" method="POST" class="p-6 space-y-4 ">
                                @csrf
                                @method('DELETE')
                                <p>Are you sure you want to delete <span class="font-bold">{{ $account->name }}</span>?</p>
                                <div class="flex justify-end gap-2">
                                    <a href="" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</a>
                                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
       </div>
       
    </div>

    <script>
document.querySelectorAll('[data-modal-toggle]').forEach(btn => {
    btn.addEventListener('click', function() {
        const modalId = btn.getAttribute('data-modal-target');
        document.getElementById(modalId).classList.remove('hidden');
    });
});
document.querySelectorAll('[data-modal-hide]').forEach(btn => {
    btn.addEventListener('click', function() {
        const modalId = btn.getAttribute('data-modal-hide');
        document.getElementById(modalId).classList.add('hidden');
    });
});
</script>
</body>

<script src="https://unpkg.com/flowbite@2.3.0/dist/flowbite.min.js"></script>
</html>