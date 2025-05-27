<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Inventory</title>
</head>
<body class="bg-[#ccd8dd]">
     <div class="m-2">
        
        <div class="flex items-center">
            @include('side.sidebar')
        </div>
            <div class="m-8 flex  gap-2 ">
                <span class="inline-block w-6 h-6 bg-red-500 rounded-full"></span>
                <span class="font-semibold text-gray-700">Low Stocks</span>
                <span class="font-semibold text-green-600">(Add stocks before they run out.)</span>
            </div>
        <div class="flex flex-col items-center justify-center ml-8 mr-8  ">
          
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-[#2c3747] text-white">
                        <th class="py-2 px-4 border">Product ID</th>
                        <th class="py-2 px-4 border">Product Name</th>
                        <th class="py-2 px-4 border">Stock</th>
                        <th class="py-2 px-4 border">Description</th>
                    </tr>
                </thead>
                <tbody>
                     @foreach($products as $product)
                        <tr class="{{ $product->stock <= 10 ? 'bg-red-500 text-white' : '' }}">
                            <td class="py-2 px-4 border">{{ $product->id }}</td>
                            <td class="py-2 px-4 border">{{ $product->name }}</td>
                            <td class="py-2 px-4 border ">{{ $product->stock }}</td>
                            <td class="py-2 px-4 border">{{ $product->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
       
    </div>
</body>
</html>