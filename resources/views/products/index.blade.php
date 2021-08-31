<x-app-layout>
   
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
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

                {{-- Botón Crear nuevo Producto --}}
                <div style="display: flex; justify-content: center; padding-top: 20px; ">
                    <a href="{{route('products.create')}}" style="background: #6875F5; padding: 10px; color: white; border-radius: 15px;">New Product</a>
                </div>


                    
                {{-- Vista Producto --}}
                <!-- component -->
                <section class="container mx-auto p-6 font-mono" style="text-align: center;">
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
                                        <th class="px-4 py-3">Created At</th>
                                        <th class="px-4 py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach ($products as $product)
                                        
                                    <tr class="text-gray-700">
                                        <td class=" border">
                                            <div class="flex items-center text-sm" style="justify-content: center;">
                                                <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                                                    <img class="object-cover w-full h-full rounded-full"
                                                        src="{{asset($product->featured_img_url)}}" alt="" loading="lazy" />
                                                    <div class="absolute inset-0 rounded-full shadow-inner"
                                                        aria-hidden="true"></div>
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-black my-0">{{$product->id}}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class=" text-ms font-semibold border">{{$product->name}}</td>
                                        <td class=" text-xs border">
                                            <span
                                                class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm">
                                                {{$product->price}} </span>
                                        </td>
                                        <td class=" text-sm border">{{$product->created_at}}</td>
                                        <td class=" text-sm border">
                                            <div class="justify-center my-8 select-none flex">
                                                <a href="{{route('products.edit', ['product' => $product])}}" class="px-3 ">Edit</a>
                                                
                                                <form action="{{ route('products.destroy', ['product' => $product])}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-3 ">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                {{-- End Vista Producto --}}

            </div>
        </div>
    </div>
</x-app-layout>
