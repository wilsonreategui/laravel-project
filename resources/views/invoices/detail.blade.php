<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invoice Detail -') }} {{$invoice->id}} {{ __('|') }} 
            <a href="{{route('invoices.index')}}" style="background: #6875F5; font-size:0.8rem; padding: 8px; color: white; border-radius: 15px;">Go Back</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Status Message --}}
            @if (session('status'))
                <div class="container" id="alertbox" style="margin: 0 auto;">
                    <div class="container bg-green-500 flex items-center text-white text-sm font-bold px-4 py-3 relative"
                        role="alert">
                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path
                                d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
                        </svg>
                        <p>{{ session('message')}}</p>
                
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3 closealertbutton">
                            <svg class="fill-current h-6 w-6 text-white" role="button" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <title>Close</title>
                                <path
                                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                            </svg>
                        </span>
                    </div>
                </div>
                
                
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"
                integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous">
                </script>
                
                <script>
                $(".closealertbutton").click(function (e) {
                // $('.alertbox')[0].hide()
                // e.preventDefault();
                pid = $(this).parent().parent().hide(500)
                console.log(pid)
                // $(".alertbox", this).hide()
                })
                </script>
            @endif
            {{-- END Status Message --}}
        

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">  
                {{-- Vista  Invoices--}}
                <section class="container mx-auto p-6 font-mono" style="text-align: center;">
                    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                        <div class="w-full">
                            
                            <table class="w-full">
                                <thead>
                                    <tr
                                        class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600"
                                        style="text-align: center;">
                                        <th class="px-4 py-3">ID</th>
                                        <th class="px-4 py-3">Serie</th>
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-4 py-3">Buyer ID</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                        
                                    <tr class="text-gray-700">
                                        <td class=" border">
                                            <div class="flex items-center text-sm" style="justify-content: center;">
                                                <div>
                                                    <p class="font-semibold text-black my-0">{{$invoice->id}}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class=" text-xs border">
                                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm">
                                                {{$invoice->serie}} 
                                            </span>
                                        </td>
                                        <td class=" text-ms font-semibold border">{{$invoice->status}}</td>
                                        <td class=" text-sm border">{{$invoice->buyer->name}}</td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
                {{-- End Vista Invoices --}}
            </div>

            @if ($invoice->status == "Active")
            <div  class="flex pt-10 pb-10 items-center justify-center">
                {{-- Vista Product --}}
                    <form  action="{{route('invoices_detail.store')}}" 
                        method="POST"
                        class="grid bg-white rounded-lg shadow-xl w-11/12 md:w-9/12 lg:w-1/2">
                        @csrf

                        <div class="grid grid-cols-1 mt-5 mx-7">
                            <div class="grid grid-cols-1">
                                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Product</label>
                                <select
                                    class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    type="text"
                                    name="product_id" id="product_id">
                                        @foreach ($products as $product)               
                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                        @endforeach
                                </select>
                            </div>
                            @error('product_id')
                                <span class="text-sm text-red-600" role="alert">
                                    <strong> {{$message}}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 mt-5 mx-7">
                            <div class="grid grid-cols-1">
                                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Quantity</label>
                                <input
                                    class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    type="text"
                                    name="quantity" id="quantity"  
                                    value="{{old('quantity')}}"
                                />
                            </div>
                            @error('quantity')
                                <span class="text-sm text-red-600" role="alert">
                                    <strong> {{$message}}</strong>
                                </span>
                            @enderror
                        </div>

                        <input type="hidden" name="invoice_id" id="invoice_id" value="{{$invoice->id}}">

                        <div class='flex items-center justify-center  md:gap-8 gap-4 pt-5 pb-5'>
                            
                                <button type="submit" class='w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Add Product</button>
                            
                        </div> 

                    </form>
                {{-- Vista Product --}}
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">  
                
                {{-- Vista  Invoices Detail--}}
                <section class="container mx-auto p-6 font-mono" style="text-align: center;">
                    <div class="flex justify-center py-4">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail</h2>
                    </div>
                    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                        <div class="w-full">
                            
                            <table class="w-full">
                                <thead>
                                    <tr
                                        class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600"
                                        style="text-align: center;">
                                        <th class="px-4 py-3">ID</th>
                                        <th class="px-4 py-3">Product</th>
                                        <th class="px-4 py-3">Price</th>
                                        <th class="px-4 py-3">Quantity</th>
                                        <th class="px-4 py-3">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @php
                                        $total = 0;
                                    @endphp
                                    
                                    @foreach ($invoice_detail as $detail)
                                        <tr class="text-gray-700">
                                                <td class=" border">
                                                    <div class="flex items-center text-sm" style="justify-content: center;">
                                                        <div>
                                                            <p class="font-semibold text-black my-0">{{$detail->id}}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class=" text-xs border">
                                                    <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm">
                                                        {{$detail->product->name}} 
                                                    </span>
                                                </td>
                                                <td class=" text-ms font-semibold border">{{$detail->price}}</td>
                                                <td class=" text-sm border">{{$detail->quantity}}</td>
                                                <td class=" text-sm border">{{$detail->total_product}}</td>      
                                                @php
                                                    $total = $total + $detail->total_product;
                                                @endphp
                                        </tr>
                                    @endforeach

                                    <tr class="text-gray-700">
                                        <td colspan="4" class="py-3 px-6 text-left whitespace-nowrap">Total</td>
                                        <td class="py-3 px-6 text-center whitespace-nowrap">{{$total}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if ($invoice->status == "Active")
                    <div class='flex items-center justify-center  md:gap-8 gap-4 pt-5 pb-5'>
                         
                        <form method="POST" action="{{route('invoices.complete', ['invoice' => $invoice])}}">
                            @csrf                      
                                <button type="submit" class='w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Complete & Send</a>
                        </form>
                    </div> 
                    @endif
                </section>
                {{-- End Vista Invoices Detail --}}
            </div>
        </div>
    </div>
</x-app-layout> 