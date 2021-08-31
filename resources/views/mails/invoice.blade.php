<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail Invoice</title>
</head>
<body>
    <h1>Invoice Details # {{$invoice->id}}</h1>
    <h2>Hello # {{$invoice->buyer->name}}</h2>
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
                            
                            @foreach ($details as $detail)
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
        </section>
        {{-- End Vista Invoices Detail --}}
    </div>
</body>
</html>