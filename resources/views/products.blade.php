@php use Illuminate\Support\Str; @endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Products</title>

</head>
<body class="bg-[#ccd8dd]">
    <div class="m-2">
        
        <div class="flex items-center jusitfy-between m-8">
            @include('side.sidebar')
            <div class="flex w-full justify-end items-center  gap-4">
               <button type="button" data-modal-target="addProductModal"data-modal-toggle="addProductModal" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                 + Add Product
                </button>
                <form action="{{ route('products.index') }}" method="GET" class="flex items-center">
                    <input type="text" name="search" placeholder="Search products..." class="border border-gray-300 rounded-full px-3 py-2 mr-2 focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ request('search') }}">
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
                        <th class="py-2 px-4 border">Product ID</th>
                        <th class="py-2 px-4 border">Product Name</th>
                        <th class="py-2 px-4 border">Price</th>
                        <th class="py-2 px-4 border">Quantity</th>
                        <th class="py-2 px-4 border">Description</th>
                        <th class="py-2 px-4 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                     @foreach($products as $product)
                        <tr>
                            <td class="py-2 px-4 border">{{ $product->id }}</td>
                           <td class="py-2 px-4 border  ">
                                <div class="flex items-center gap-3">
                                    @if($product->image)
                                        @if(Str::startsWith($product->image, ['http://', 'https://', 'data:image']))
                                            <img src="{{ $product->image }}" alt="Product Image" class="w-16 h-16 object-cover rounded-full">
                                        @else
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="w-16 h-16 object-cover rounded">
                                        @endif
                                    @endif
                                    <span>{{ $product->name }}</span>
                                </div>
                            </td>
                            <td class="py-2 px-4 border">₱ {{ $product->price }}</td>
                            <td class="py-2 px-4 border">{{ $product->stock }}</td>
                            <td class="py-2 px-4 border">{{ $product->description }}</td>
                            <td class="py-2 px-4 border flex items-center justify-center gap-4 h-auto">
                                <div class="flex items-center justify-center gap-2 min-h-16">
                                <button type="button" data-modal-target="editModal-{{ $product->id }}" data-modal-toggle="editModal-{{ $product->id }}" class="flex items-center text-green-700 justify-center w-10 h-10 rounded-full hover:bg-green-100 transition">
                                  Edit
                                </button>
                                <button data-modal-target="deleteModal-{{ $product->id }}" data-modal-toggle="deleteModal-{{ $product->id }}" class="flex items-center text-red-700 justify-center w-10 h-10 rounded-full hover:bg-red-100 transition">
                                   Delete
                                    
                                </button>
                                </div>
                              
                            </td>
                        </tr>
                    @endforeach
                </tbody>
               
            </table>
          <div id="addProductModal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                <div class="relative p-4  min-w-md h-full md:h-auto">
                    <div class="relative bg-white rounded-lg shadow">
                        <div class="flex justify-between items-center p-4 border-b rounded-t">
                            <h3 class="text-xl font-semibold">Add Product</h3>
                            
                            <a href=""  class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            
                            </a>
                        </div>
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                            @csrf
                        <div>
                            
                        </div>
                           
                            <div>
                                <label class="block mb-1 font-semibold">Upload Image (optional)</label>
                                <input type="file" name="image" accept="image/*" class="w-full border rounded px-3 py-2">
                            </div>

                            <div>
                                <label class="block mb-1 font-semibold">Product Name</label>
                                <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
                            </div>
                           
                            <div>
                                <label class="block mb-1 font-semibold">Price</label>
                                <input type="number" step="0.01" name="price" class="w-full border rounded px-3 py-2" required>
                            </div>
                            <div>
                                <label class="block mb-1 font-semibold">Stock</label>
                                <input type="number" name="stock" class="w-full border rounded px-3 py-2" required>
                            </div>
                             <div>
                                <label class="block mb-1 font-semibold">Description</label>
                                <textarea name="description" class="w-full border rounded px-3 py-2" rows="2"></textarea>
                            </div>
                            
                            <div class="flex justify-end gap-2">
                                <a href="" class="w-[100px] text-center py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</a>
                                <button type="submit" class="w-[100px] py-2 bg-green-600 text-white rounded hover:bg-green-700">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @foreach($products as $product)

                <div id="editModal-{{ $product->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                        <div class="relative bg-white rounded-lg shadow">
                            <div class="flex justify-between items-center p-4 border-b rounded-t">
                                <h3 class="text-xl font-semibold">Edit Product</h3>
                                 <a href=""  class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </a>
                            </div>
                              <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                                @csrf
                                @method('PUT')
                                <div>
                                    <div>
                                        <label class="block mb-1 font-semibold">Upload New Image (optional)</label>
                                        <input type="file" name="image" accept="image/*" class="w-full border rounded px-3 py-2">
                                    </div>                  
                                   @if($product->image)
                                        @if(Str::startsWith($product->image, ['http://', 'https://', 'data:image']))
                                            <img src="{{ $product->image }}" alt="Product Image" class="w-16 h-32 object-cover rounded mt-2">
                                        @else
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="w-16 h-32 object-cover rounded mt-2">
                                        @endif
                                    @endif
                                </div>
                                <div>
                                    <label class="block mb-1 font-semibold">Product Name</label>
                                    <input type="text" name="name" class="w-full border rounded px-3 py-2" value="{{ $product->name }}" required>
                                </div>
                                <div>
                                    <label class="block mb-1 font-semibold">Price</label>
                                    <input type="number" step="0.01" name="price" class="w-full border rounded px-3 py-2" value="{{ $product->price }}" required>
                                </div>
                                <div>
                                    <label class="block mb-1 font-semibold">Stock</label>
                                    <input type="number" name="stock" class="w-full border rounded px-3 py-2" value="{{ $product->stock }}" required>
                                </div>
                                 <div>
                                    <label class="block mb-1 font-semibold">Description</label>
                                    <textarea name="description" class="w-full border rounded px-3 py-2" rows="2">{{ $product->description }}</textarea>
                                </div>
                                <div class="flex justify-end gap-2">
                                    <a href="" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</a>
                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div id="deleteModal-{{ $product->id }}" tabindex="-1" class="hidden fixed z-50 w-full inset-0 justify-center items-center ">
                    <div class="relative p-4 w-full max-w-md h-full md:h-auto mx-auto flex items-center">
                        <div class="relative bg-white rounded-lg shadow w-full">
                            <div class="flex justify-between items-center p-4 border-b rounded-t">
                                <h3 class="text-xl font-semibold">Delete Product</h3>
                                 <a href=""  class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </a>
                            </div>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="p-6 space-y-4 ">
                                @csrf
                                @method('DELETE')
                                <p>Are you sure you want to delete <span class="font-bold">{{ $product->name }}</span>?</p>
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
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.4.7/flowbite.min.js"></script>
</html>