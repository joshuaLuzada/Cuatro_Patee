<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Home</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .scrollbar-hidden::-webkit-scrollbar {
    display: none;
}

.scrollbar-hidden {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
    </style>
</head>
<body class="bg-[#ccd8dd]">
    <div class="flex items-center justify-between bg-white rounded-lg shadow-md m-2 p-4">
       
        <div class="flex items-center">
            @include('side.sidebar')
            <h1 class="text-lg font-semibold text-gray-700 px-8">Cuatro Patee🐾</h1>
        </div>
        <div>
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR56rn6SPM8T2swfi_RHpSe1SWVBUMZDm9kd418KVsDq7RHyksHSEqT6mel1JQ845Erack&usqp=CAU" class="w-8 h-8" alt="">
        </div>
       
        
    </div>

        <div class="flex-1">
          

            

            <div id="metrics" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 px-4 py-6">
                
               
                <div class="bg-gradient-to-r from-green-500 to-teal-500 text-white shadow-lg rounded-lg p-6">
                    <h2 class="text-xl font-semibold">Net Sales</h2>
                    <p class="text-3xl font-bold mt-2">₱8,450.32</p>
                </div>

                
                <div class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white shadow-lg rounded-lg p-6">
                    <h2 class="text-xl font-semibold">Profit</h2>
                    <p class="text-3xl font-bold mt-2">₱2,120.55</p>
                </div>

                
                <div class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white shadow-lg rounded-lg p-6">
                    <h2 class="text-xl font-semibold">Transactions</h2>
                    <p class="text-3xl font-bold mt-2">120</p>
                </div>

               
                <div class="bg-gradient-to-r from-pink-500 to-red-500 text-white shadow-lg rounded-lg p-6">
                    <h2 class="text-xl font-semibold">Items Sold</h2>
                    <p class="text-3xl font-bold mt-2">450</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-4">
                
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-800">Sales Over Time</h2>
                    <canvas id="linearGraph"></canvas>
                </div>

                
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-800">Product Sales</h2>
                    <canvas id="barGraph"></canvas>
                </div>

                <div class="bg-red-500 text-white shadow-lg rounded-lg p-6">
                    <h2 class="text-2xl font-semibold mb-4">Low Stocks</h2>
                    <div class="max-h-64 overflow-y-auto pr-2 scrollbar-hidden"> 
                        <ul class="space-y-4">
                            @forelse($lowStocks as $product)
                                <li class="flex items-center justify-between bg-red-600 p-4 rounded-lg shadow-md">
                                    <div class="flex items-center space-x-4">
                                        <div class="bg-white text-red-500 rounded-full p-2">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h11M9 21V3m0 0L3 10m6-7l6 7"></path>
                                            </svg>
                                        </div>
                                        <span class="font-semibold">{{ $product->name }}</span>
                                    </div>
                                    <span class="font-bold text-lg">{{ $product->stock }} stock{{ $product->stock == 1 ? '' : 's' }} left</span>
                                </li>
                            @empty
                                <li class="text-white text-center">No low stock products!</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-lg rounded-lg p-6 m-4">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">Recent Transactions</h2>
                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 border-b text-left">Date</th>
                            <th class="py-2 px-4 border-b text-left">Product</th>
                            <th class="py-2 px-4 border-b text-left">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                         @forelse($transactions as $transaction)
                            <tr>
                                <td class="py-2 px-4 border-b text-left">
                                    {{ $transaction->created_at->format('Y-m-d H:i') }}
                                </td>
                                <td class="py-2 px-4 border-b text-left">
                                    {{ $transaction->item_name }}
                                </td>
                                <td class="py-2 px-4 border-b text-left">
                                    ₱{{ number_format($transaction->amount, 2) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-2 px-4 border-b text-center text-gray-500">No recent transactions.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
        </div>
    </div>
        
  

    
    <script>

        
        
        const linearCtx = document.getElementById('linearGraph').getContext('2d');
        new Chart(linearCtx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: 'Sales',
                    data: [3500, 2900, 3100, 5000, 3000, 0, 0, 0, 0, 0, 0, 0],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                }
            }
        });

       
        const barCtx = document.getElementById('barGraph').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['Top Breed', 'Whiskas', 'Cuties Catz', 'Good Boy'],
                datasets: [{
                    label: 'Units Sold',
                    data: [47, 35, 10, 15],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                }
            }
        });
    </script>
</body>
</html>