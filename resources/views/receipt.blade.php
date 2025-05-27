<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Receipt</title>
</head>
<body>
    <div class="m-8">
        <div class="flex items-center justify-between">
            @include('side.sidebar')
            <div>
                <form action="{{ route('receipt') }}" method="GET" class="flex items-center">
                    <input type="text" name="search" placeholder="Search receipt..." class="border border-gray-300 rounded-full px-3 py-2 mr-2 focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ request('search') }}">
                    <button type="submit">
                        <svg class="w-8 h-8 mr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="10" cy="10" r="6" stroke="#2c3747" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></circle><path d="M14.5 14.5L19 19" stroke="#2c3747" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </button>
                </form>
            </div>
        </div>

    
         <div class="max-w-md mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mt-8 ">
            <div class="flex justify-between mb-4">
                <div>
                    <h2 class="text-xl font-bold">Receipt</h2>
                    <p>Receipt #: <span class="font-mono"></span></p>
                    <p>Date: </p>
                    <p>Time: </p>
                </div>
               
            </div>
            <table class="w-full mb-4">
                <thead>
                    <tr>
                        <th class="text-left">Product</th>
                        <th class="text-right">Qty</th>
                        <th class="text-right">Price</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                    </tr>
                </tbody>
            </table>
            <div class="flex justify-end">
                <div>
                    <p class="font-bold">Total: </p>
                </div>
            </div>
        </div>
    </div>
   
       
</body>
</html>