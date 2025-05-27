<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Email Supplier</title>
</head>
<body class="bg-[#ccd8dd]">
    <div class="flex items-center justify-between bg-white rounded-lg shadow-md m-2 p-4">
         <div class="flex items-center">
            @include('side.sidebar')
            <h1 class="text-lg font-semibold text-gray-700 px-8">Orders</h1>
        </div>
       
    </div>
        <div class="flex-1 m-2">
           

           
            

            <div class="bg-white shadow-lg rounded-lg p-6 m-2">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">Orders to be Delivered</h2>
                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 border-b text-left text-gray-700 font-medium">Product</th>
                            <th class="py-2 px-4 border-b text-left text-gray-700 font-medium">Quantity</th>
                            <th class="py-2 px-4 border-b text-left text-gray-700 font-medium">Supplier</th>
                            <th class="py-2 px-4 border-b text-left text-gray-700 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4 border-b">Top Breed</td>
                            <td class="py-2 px-4 border-b">50</td>
                            <td class="py-2 px-4 border-b">supplier@example.com</td>
                            <td class="py-2 px-4 border-b text-green-500 font-medium">Pending</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b">Whiskas</td>
                            <td class="py-2 px-4 border-b">30</td>
                            <td class="py-2 px-4 border-b">supplier@example.com</td>
                            <td class="py-2 px-4 border-b text-green-500 font-medium">Pending</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

   
</body>
</html>