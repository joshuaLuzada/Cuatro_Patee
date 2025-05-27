<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Sales</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
</head>
<body class="bg-[#ccd8dd]">
    <div class="flex items-center justify-between bg-white rounded-lg shadow-md m-2 p-4 sticky top-0 z-10">
        
        <div class="flex items-center ">
            @include('side.sidebar')
            <h1 class="text-lg font-semibold text-gray-700 px-8">Sales</h1>
        </div>
       
        <div class="relative">
           <svg id="cart-button" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" width="48px" height="48px" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#666666;" d="M510.495,228.218C496.646,99.903,387.996,0,256,0C114.615,0,0,114.616,0,256 c0,113.885,74.374,210.384,177.194,243.621L510.495,228.218z"></path> <path style="fill:#383838;" d="M326.105,177.394L204.96,56.249l-15.743,143.743L94.609,417.035l82.586,82.586 C202.022,507.647,228.501,512,256,512c141.384,0,256-114.616,256-256c0-9.389-0.52-18.655-1.506-27.782L338.525,56.249 L326.105,177.394z"></path> <polygon style="fill:#999999;" points="345.043,177.731 345.043,224.111 300.522,224.111 300.522,177.731 322.783,155.47 "></polygon> <g> <path style="fill:#B2B2B2;" d="M345.043,71.992v105.739h-44.522V71.992c0-12.299,9.962-22.261,22.261-22.261 C335.082,49.731,345.043,59.693,345.043,71.992z"></path> <polygon style="fill:#B2B2B2;" points="211.478,177.731 211.478,224.111 166.957,224.111 166.957,177.731 189.217,155.47 "></polygon> </g> <path style="fill:#CCCCCC;" d="M211.478,71.992v105.739h-44.522V71.992c0-12.299,9.962-22.261,22.261-22.261 S211.478,59.693,211.478,71.992z"></path> <polygon style="fill:#FDBA4C;" points="222.609,222.255 256,417.035 417.391,417.035 450.783,244.516 "></polygon> <g> <polygon style="fill:#FFD652;" points="256,222.255 256,417.035 94.609,417.035 61.217,244.516 "></polygon> <polygon style="fill:#FFD652;" points="222.609,218.025 256,394.774 399.026,394.774 428.927,240.286 "></polygon> </g> <polygon style="fill:#FBE287;" points="83.073,240.286 112.974,394.774 256,394.774 256,218.025 "></polygon> <g> <rect x="141.245" y="218.023" style="fill:#FDBA4C;" width="22.261" height="154.49"></rect> <rect x="210.332" y="218.023" style="fill:#FDBA4C;" width="22.261" height="154.49"></rect> </g> <g> <rect x="279.407" y="218.023" style="fill:#FB9D46;" width="22.261" height="154.49"></rect> <rect x="348.494" y="218.023" style="fill:#FB9D46;" width="22.261" height="154.49"></rect> </g> <polygon style="fill:#4F5AA8;" points="473.043,199.992 473.043,244.513 256,244.513 233.739,222.255 256,199.992 "></polygon> <rect x="38.957" y="199.992" style="fill:#4A75C3;" width="217.043" height="44.522"></rect> </g></svg>
        </div>
       
        
    </div>

            <div id="cart-panel" class="fixed inset-0 hidden z-50">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                <div class="absolute inset-y-0 right-0 flex max-w-full">
                    <div class="w-screen max-w-md bg-white shadow-xl">
                        <div class="flex flex-col h-full">
                            
                            <div class="flex items-center justify-between px-4 py-4 border-b border-gray-200">
                                <h2 class="text-lg font-medium text-gray-900">Cart</h2>
                                <button id="close-cart" class="text-gray-400 hover:text-gray-500">
                                    <span class="sr-only">Close panel</span>
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            
                            <div class="flex-1 overflow-y-auto px-4 py-6">
                                <ul id="cart-items" class="space-y-6">
                                    
                                </ul>
                            </div>

                            <div class="border-t border-gray-200 px-4 py-4">
                                <div class="flex justify-between text-base font-medium text-gray-900">
                                    <p>Subtotal</p>
                                    <p id="subtotal">₱00.00</p>
                                </div>
                                <div class="mt-4">
                                    <a href="#" class="block w-full text-center bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700">
                                        Purchase Order
                                    </a>
                                </div>
                                <div class="mt-4 text-center text-sm text-gray-500">
                                    <button id="continue-shopping" class="text-indigo-600 hover:text-indigo-700">
                                        Add more Product &rarr;
                                    </button>
                                </div>
                                <div id="receipt-modal" class="fixed inset-0 hidden z-50">
                                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
                                            <h2 class="text-lg font-bold text-gray-900 mb-4">Receipt</h2>
                                            <ul id="receipt-items" class="space-y-4"></ul>
                                            <div class="mt-4">
                                                <div class="flex justify-between text-base font-medium text-gray-900">
                                                    <p>Total</p>
                                                    <p id="receipt-total">₱00.00</p>
                                                </div>
                                            </div>
                                            <div class="mt-6">
                                                <button id="close-receipt" class="block w-full text-center bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700">
                                                    Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="payment-modal" class="fixed inset-0 hidden z-50">
                                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
                                            <h2 class="text-lg font-bold text-gray-900 mb-4">Payment</h2>
                                            <div class="mb-4">
                                                <p class="text-base font-medium text-gray-900">Total: <span id="payment-total">₱00.00</span></p>
                                            </div>
                                            <div class="mb-4">
                                                <label for="customer-money" class="block text-sm font-medium text-gray-700">Customer Money</label>
                                                <input type="number" id="customer-money" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Enter amount">
                                            </div>
                                            <div class="mb-4">
                                                <p class="text-base font-medium text-gray-900">Change: <span id="change-amount">₱00.00</span></p>
                                            </div>
                                            <div class="flex justify-end space-x-4">
                                                <button id="confirm-payment" class="bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700">Print</button>
                                                <button id="close-payment" class="bg-gray-300 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-400">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div id="receipt-modal" class="fixed inset-0 hidden z-50">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="bg-white rounded-lg shadow-lg w-96 p-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Receipt</h2>
                        <ul id="receipt-items" class="space-y-4"></ul>
                        <div class="mt-4">
                            <div class="flex justify-between text-base font-medium text-gray-900">
                                <p>Total</p>
                                <p id="receipt-total">₱00.00</p>
                            </div>
                        </div>
                        <div class="mt-6">
                            <button id="close-receipt" class="block w-full text-center bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            









                    
               <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6  gap-4 p-4">
                    @foreach($products as $product)
                        <div class="bg-white rounded-lg shadow-md p-4">
                            <img src="{{ Str::startsWith($product->image, ['http://', 'https://', 'data:image']) ? $product->image : asset('storage/' . $product->image) }}" alt="Product Image" class="w-full h-48 object-cover rounded-md">
                            <h3 class="mt-4 text-lg font-medium text-gray-900">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $product->description }}</p>
                            <p class="mt-2 text-lg font-semibold text-gray-900">₱ {{ number_format($product->price, 2) }}</p>
                            <button class="mt-4 w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 add-to-cart">
                                Add to Cart
                            </button>
                        </div>
                    @endforeach
                </div>
        </div>
    </div>
    
<div id="toast" class="fixed top-8 right-8 z-50 hidden bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg transition-opacity duration-300"></div>

    <script>

const placeOrderButton = document.querySelector('.bg-indigo-600.text-white'); 
const paymentModal = document.getElementById('payment-modal');
const paymentTotal = document.getElementById('payment-total');
const customerMoneyInput = document.getElementById('customer-money');
const changeAmount = document.getElementById('change-amount');
const confirmPaymentButton = document.getElementById('confirm-payment');
const closePaymentButton = document.getElementById('close-payment');

placeOrderButton.addEventListener('click', (e) => {
    e.preventDefault();
    paymentTotal.textContent = subtotal.textContent; 
    paymentModal.classList.remove('hidden');
});

customerMoneyInput.addEventListener('input', () => {
    const customerMoney = parseFloat(customerMoneyInput.value) || 0;
    const totalAmount = parseFloat(subtotal.textContent.replace(/[₱,]/g, '')) || 0;
    const change = customerMoney - totalAmount;

    changeAmount.textContent = `₱${change.toFixed(2)}`;
    changeAmount.style.color = change >= 0 ? 'green' : 'red';
});

confirmPaymentButton.addEventListener('click', () => {
    const customerMoney = parseFloat(customerMoneyInput.value) || 0;
    const totalAmount = parseFloat(subtotal.textContent.replace(/[₱,]/g, '')) || 0;

    if (customerMoney >= totalAmount) {
        // Send sales data to backend
        fetch('/sales/store', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ products: cart })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('Sales recorded!');
            }
        });

        alert('Payment successful!');
        cart = []; 
        total = 0; 
        updateCart(); 
        paymentModal.classList.add('hidden');
    } else {
        alert('Insufficient amount!');
    }
});

closePaymentButton.addEventListener('click', () => {
    paymentModal.classList.add('hidden');
});
        document.addEventListener('DOMContentLoaded', () => {
    const cartButton = document.getElementById('cart-button');
    const cartPanel = document.getElementById('cart-panel');
    const closeCart = document.getElementById('close-cart');
    const continueShopping = document.getElementById('continue-shopping');
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    const cartItems = document.getElementById('cart-items');
    const subtotal = document.getElementById('subtotal');

    let cart = [];
    let total = 0;

    cartButton.addEventListener('click', () => {
        cartPanel.classList.remove('hidden');
    });

    closeCart.addEventListener('click', () => {
        cartPanel.classList.add('hidden');
    });

    continueShopping.addEventListener('click', () => {
        cartPanel.classList.add('hidden');
    });

    addToCartButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            const product = e.target.closest('.bg-white');
            const name = product.querySelector('h3').textContent;
            const priceText = product.querySelector('.text-lg.font-semibold').textContent.trim();
            const price = parseFloat(priceText.replace(/[₱,]/g, '')); 
            const image = product.querySelector('img').src;

            const existingProduct = cart.find(item => item.name === name);
            if (existingProduct) {
                existingProduct.quantity++;
                total += price;
            } else {
                cart.push({ name, price, image, quantity: 1 });
                total += price;
            }

            updateCart();

            // Show toast notification
            showToast(`${name} added to cart!`);
        });
    });

    // Toast function
    function showToast(message) {
        const toast = document.getElementById('toast');
        toast.textContent = message;
        toast.classList.remove('hidden');
        toast.style.opacity = 1;
        setTimeout(() => {
            toast.style.opacity = 0;
            setTimeout(() => toast.classList.add('hidden'), 300);
        }, 3000);
    }

    function updateCart() {
        cartItems.innerHTML = '';
        cart.forEach(item => {
            const li = document.createElement('li');
            li.classList.add('flex', 'items-center');
            li.innerHTML = `
                <div class="w-16 h-16 overflow-hidden rounded-md border border-gray-200">
                    <img src="${item.image}" alt="Product Image" class="w-full h-full object-cover">
                </div>
                <div class="ml-4 flex-1">
                    <h3 class="text-sm font-medium text-gray-900">${item.name}</h3>
                    <p class="text-sm text-green-500">Qty: ${item.quantity}</p>
                </div>
                <p class="text-sm font-medium text-gray-900">₱${(item.price * item.quantity).toFixed(2)}</p>
                <button class="ml-4 text-red-500 hover:text-red-600 remove-item">Remove</button>
            `;
            cartItems.appendChild(li);
        });

        subtotal.textContent = `₱${total.toFixed(2)}`;
    }
    function updateCartCount() {
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        if (totalItems > 0) {
            cartCount.textContent = totalItems;
            cartCount.classList.remove('hidden');
        } else {
            cartCount.classList.add('hidden');
        }
    }


    cartItems.addEventListener('click', (e) => {
        if (e.target.classList.contains('remove-item')) {
            const itemName = e.target.closest('li').querySelector('h3').textContent;
            const itemIndex = cart.findIndex(item => item.name === itemName);

            if (itemIndex > -1) {
                total -= cart[itemIndex].price * cart[itemIndex].quantity;
                cart.splice(itemIndex, 1);
                updateCart();
            }
        }
    });
});
    </script>
</body>
</html>

