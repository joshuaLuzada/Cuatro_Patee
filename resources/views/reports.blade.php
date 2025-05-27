{{-- filepath: c:\xampp\htdocs\Cuatro_Patee\resources\views\reports.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Reports</title>
</head>
<body class="bg-[#ccd8dd]">
    @if(session('deleted'))
        <div 
            x-data="{ show: true }" 
            x-show="show" 
            x-init="setTimeout(() => show = false, 3000)" 
            class="fixed top-6 right-6 bg-green-500 text-white px-6 py-3 rounded shadow-lg z-50 transition"
            x-transition
        >
            {{ session('deleted') }}
        </div>
    @endif
     <div class="m-8">
        
        <div class="flex items-center justify-between">
            @include('side.sidebar')
            <div>
                 <form action="{{ route('reports') }}" method="GET" class="flex items-center">
                    <input type="text" name="search" placeholder="Search products..." class="border border-gray-300 rounded-full px-3 py-2 mr-2 focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ request('search') }}">
                    <button type="submit">
                        <svg class="w-8 h-8 mr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="10" cy="10" r="6" stroke="#2c3747" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></circle><path d="M14.5 14.5L19 19" stroke="#2c3747" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </button>
                </form>
            </div>
        </div>
       
    </div>
    <div class="m-8" x-data="{ openModal: false, reportId: null, password: '' }">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-[#2c3747] text-white">
                    <th class="py-2 px-4 border">Report ID</th>
                    <th class="py-2 px-4 border">About</th>
                    <th class="py-2 px-4 border">Date</th>
                    <th class="py-2 px-4 border">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                    <tr>
                        <td class="py-2 px-4 border">{{ $report->id }}</td>
                        <td class="py-2 px-4 border">{{ $report->about }}</td>
                        <td class="py-2 px-4 border">{{ \Carbon\Carbon::parse($report->created_at)->format('Y-m-d H:i') }}</td>
                        <td class="py-2 px-4 border">
                            <div class="flex justify-center">
                                <button 
                                    @click="openModal = true; reportId = {{ $report->id }}; password = ''"
                                    type="button"
                                    class="flex items-center justify-center text-red-700 w-10 h-10 rounded-full hover:bg-red-100 transition"
                                    title="Delete"
                                >
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div 
            x-show="openModal"
            x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
        >
            <div class="bg-white rounded-lg shadow-lg w-80 p-6">
                <h2 class="text-lg font-bold mb-4 text-gray-800">Enter Password to Delete</h2>
                <form 
                    method="POST" 
                    :action="'{{ url('reports/delete') }}/' + reportId"
                    @submit.prevent="
                        $refs.submitBtn.disabled = true;
                        $el.submit();
                    "
                >
                    @csrf
                    @method('DELETE')
                    <input 
                        type="password" 
                        name="password" 
                        x-model="password"
                        class="border border-gray-300 rounded px-3 py-2 w-full mb-4 focus:ring-2 focus:ring-red-400"
                        placeholder="Password"
                        required
                    >
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="openModal = false" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Cancel</button>
                        <button type="submit" x-ref="submitBtn" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>