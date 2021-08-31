<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if($buyer->id) 
            {{ __('Buyers | Update |') }} 
            @else
            {{ __('Buyers | New |') }} 
            @endif
            <a href="{{route('buyers.index')}}" style="background: #6875F5; font-size:0.8rem; padding: 8px; color: white; border-radius: 15px;">Go Back</a>
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                {{-- Vista PRODUCT.CREATE --}}
                <!-- component -->
                <div  class="flex pt-10 pb-10 items-center justify-center">
                    <form  @if($buyer->id) 
                            action="{{route('buyers.update', ['buyer' => $buyer])}}" 
                            @else 
                            action="{{route('buyers.store')}}" 
                            @endif
                        method="POST"
                        class="grid bg-white rounded-lg shadow-xl w-11/12 md:w-9/12 lg:w-1/2">

                        @if($buyer->id)
                            @method('PUT')
                        @endif

                        @csrf
                        <div class="flex justify-center py-4">
                            <div class="flex bg-purple-200 rounded-full md:p-4 p-2 border-2 border-purple-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 mt-5 mx-7">
                            <div class="grid grid-cols-1">
                                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">DNI</label>
                                <input
                                    class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    type="text"
                                    name="dni" id="dni"
                                    @if($buyer->id)
                                    value="{{old('dni', $buyer->dni)}}"
                                    @else
                                    value="{{old('dni')}}"
                                    @endif />
                            </div>
                            @error('dni')
                                <span class="text-sm text-red-600" role="alert">
                                    <strong> {{$message}}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 mt-5 mx-7">
                            <div class="grid grid-cols-1">
                                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Name</label>
                                <input
                                    class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    type="text"
                                    name="name" id="name"
                                    @if($buyer->id)
                                    value="{{old('name', $buyer->name)}}"
                                    @else
                                    value="{{old('name')}}"
                                    @endif  
                                />
                            </div>
                            @error('name')
                                <span class="text-sm text-red-600" role="alert">
                                    <strong> {{$message}}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 mt-5 mx-7">
                            <div class="grid grid-cols-1">
                                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Email</label>
                                <input
                                    class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    type="text"
                                    name="email" id="email"
                                    @if($buyer->id)
                                    value="{{old('email', $buyer->email)}}"
                                    @else
                                    value="{{old('email')}}"
                                    @endif  
                                />
                            </div>
                            @error('email')
                                <span class="text-sm text-red-600" role="alert">
                                    <strong> {{$message}}</strong>
                                </span>
                            @enderror
                        </div>



                        <div class='flex items-center justify-center  md:gap-8 gap-4 pt-5 pb-5'>
                            @if($buyer->id) 
                                <button type="submit" class='w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Update</button>
                            @else
                                <button type="submit" class='w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Create</button>
                            @endif
                        </div> 

                    </form>
                </div>

                {{-- End Vista PRODUCT.CREATE --}}

            </div>
        </div>
    </div>
</x-app-layout>
