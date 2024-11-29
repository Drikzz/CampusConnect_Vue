<x-layout>


<div class="max-w-full bg-primary-color px-16 py-20 flex justify-evenly items-center">
    <div class="w-[60%]] flex flex-col justify-center items-start">
        <div>
            <p class="font-Satoshi-bold text-lg text-white">
                WELCOME TO CAMPUS CONNECT!
            </p>

        </div>
        
        <div class="mt-4 mb-8 w-[30rem]">
            <p class="font-FontSpring-bold text-5xl gap-0 text-white">
                BROWSE CAMPUS CONNECT NOW <span class="font-Satoshi-bold text-5xl">!</span> 
            </p>
        </div>
        
        <div>
            <p class="font-Satoshi text-base text-white">
                Browse through our diverse range of affordable items here!
            </p>
        </div>
        
        <div class="mt-12 mb-12">
            <a href="{{ route('products') }}" class="font-Satoshi-bold px-8 py-4 bg-white rounded-md text-primary-color text-sm">
                SHOP NOW
            </a>
        </div>
        
        <div class="flex justify-center items-center gap-4">
            <p class="text-white">
                Affordable items!
            </p>
            <p class="text-white">
                High Quality Products!
            </p>
        </div>
    </div>

    <div class="w-[40%] flex flex-col justify-evenly items-center">
        <div class="w-full flex justify-end items-center">
            <svg class ="w-20 h-20" viewBox="0 0 104 93" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M52 0.626999C53.7654 25.3579 76.0448 45.068 104 46.6297C76.0448 48.1915 53.7654 67.9014 52 92.6325C50.2347 67.9014 27.955 48.1915 0 46.6297C27.955 45.068 50.2347 25.3579 52 0.626999Z" fill="white"/>
            </svg>
        </div>
            
            <img class="w-[250px] h-auto" src="{{ asset('imgs/wmsu_logo.png') }}" alt="logo">

        <div class="w-full flex justify-start items-center">
            <svg class="w-12 h-12" viewBox="0 0 104 93" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M52 0.626999C53.7654 25.3579 76.0448 45.068 104 46.6297C76.0448 48.1915 53.7654 67.9014 52 92.6325C50.2347 67.9014 27.955 48.1915 0 46.6297C27.955 45.068 50.2347 25.3579 52 0.626999Z" fill="white"/>
            </svg>
        </div>
    </div>
</div>


<section class="px-16 mt-16">
    <div class="text-center">
        <p class="font-FontSpring-extra-bold text-4xl">
            Recently Uploaded
        </p>
    </div>



    <div class="flex flex-wrap justify-center gap-10 font-Satoshi mt-16"> <!-- Increased gap -->
        <!-- Card 1 -->
        <div class="w-60 h-[30rem] p-4 flex flex-col justify-between items-start gap-4 hover:shadow-lg rounded">
            <div class="relative">
                <a href="{{ route('prod.details') }}">
                    <img src="{{ asset('imgs/img1.jpg') }}" alt="" class="w-52 h-64 object-cover">
                </a>
                <div class="absolute bottom-2 right-2 rounded-2xl bg-white px-3 py-1">
                    <p class="font-Satoshi-bold text-sm text-black">
                        -20%
                    </p>
                </div>

                <div class="absolute top-3 right-3 bg-white p-2 rounded-full hover:shadow-md hover:ring-2 hover:ring-black hover:transition-all">
                    <svg class="w-5 h-5 fill-black cursor-pointer bookmarked" xmlns="http://www.w3.org/2000/svg" id="Filled" viewBox="0 0 24 24" width="512" height="512">
                        <path d="M2.849,23.55a2.954,2.954,0,0,0,3.266-.644L12,17.053l5.885,5.853a2.956,2.956,0,0,0,2.1.881,3.05,3.05,0,0,0,1.17-.237A2.953,2.953,0,0,0,23,20.779V5a5.006,5.006,0,0,0-5-5H6A5.006,5.006,0,0,0,1,5V20.779A2.953,2.953,0,0,0,2.849,23.55Z"/>
                    </svg>
    
                    <svg class="w-5 h-5 fill-black cursor-pointer hidden unbookmark" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512">
                        <path d="m21,19.586V3c0-1.654-1.346-3-3-3H6.559c-1.393,0-2.566.954-2.903,2.242L1.457.043.043,1.457l22.5,22.5,1.414-1.414-2.957-2.957Zm-10.083-3.661l-7.917,8.075v-15.991l7.917,7.916Z"/>
                    </svg>
                </div>
            </div>

            <div>
                <p class="font-Satoshi-bold text-xl">
                    UNIQLO Skinny Ezy Jeans Khaki
                </p>
            </div>

            <div class="flex justify-center items-center w-fit gap-2">
                <p class="font-Satoshi-bold text-2xl">
                    &#8369;62
                </p>

                <p class="font-Satoshi-bold line-through text-2xl text-gray-400">
                    &#8369;70
                </p>
            </div>

            <div class="flex justify-between items-center w-full">
                <a href="#" class="py-2 px-3 bg-black rounded-lg hover:opacity-80 hover:transition-all focus:opacity-60 focus:transition-all">
                    <button class="font-Satoshi text-white">Buy Now!</button>
                </a>

                <a href="#" class="py-2 px-3 bg-black rounded-lg hover:opacity-80 hover:transition-all focus:opacity-60 focus:transition-all">
                    <button class="font-Satoshi text-white">Trade Now!</button>
                </a>
            </div>
        </div>
          
        <!-- Card 2 -->
        <div class="w-60 h-[30rem] p-4 flex flex-col justify-between items-start gap-4 hover:shadow-lg rounded">
            <div class="relative">
                <a href="#">
                    <img src=" {{ asset('imgs/img2.jpg') }}" alt="" class="w-52 h-64 object-cover">
                </a>
                {{-- <div class="absolute bottom-2 right-2 rounded-2xl bg-white px-3 py-1">
                    <p class="font-Satoshi-bold text-sm text-black">
                        -20%
                    </p>
                </div>   --}}

                <div class="absolute top-3 right-3 bg-white p-2 rounded-full hover:shadow-md hover:ring-2 hover:ring-black hover:transition-all">
                    <svg class="w-5 h-5 fill-black cursor-pointer bookmarked" xmlns="http://www.w3.org/2000/svg" id="Filled" viewBox="0 0 24 24" width="512" height="512">
                        <path d="M2.849,23.55a2.954,2.954,0,0,0,3.266-.644L12,17.053l5.885,5.853a2.956,2.956,0,0,0,2.1.881,3.05,3.05,0,0,0,1.17-.237A2.953,2.953,0,0,0,23,20.779V5a5.006,5.006,0,0,0-5-5H6A5.006,5.006,0,0,0,1,5V20.779A2.953,2.953,0,0,0,2.849,23.55Z"/>
                    </svg>
    
                    <svg class="w-5 h-5 fill-black cursor-pointer hidden unbookmark" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512">
                        <path d="m21,19.586V3c0-1.654-1.346-3-3-3H6.559c-1.393,0-2.566.954-2.903,2.242L1.457.043.043,1.457l22.5,22.5,1.414-1.414-2.957-2.957Zm-10.083-3.661l-7.917,8.075v-15.991l7.917,7.916Z"/>
                    </svg>
                </div>
            </div>

            <div>
                <p class="font-Satoshi-bold text-xl">
                    TANK TOP DOUBLE LINING
                </p>
            </div>

            <div class="flex justify-center items-center w-fit gap-2">
                <p class="font-Satoshi-bold text-2xl">
                    &#8369;100
                </p>

                <p class="font-Satoshi-bold line-through text-2xl text-gray-400">
                    &#8369;110
                </p>
            </div>

            <div class="flex justify-between items-center w-full">
                <a href="#" class="py-2 px-3 bg-black rounded-lg hover:opacity-80 hover:transition-all focus:opacity-60 focus:transition-all">
                    <button class="font-Satoshi text-white">Buy Now!</button>
                </a>

                {{-- <a href="#" class="py-2 px-3 bg-black rounded-lg hover:opacity-80 hover:transition-all focus:opacity-60 focus:transition-all">
                    <button class="font-Satoshi text-white">Trade Now!</button>
                </a> --}}
            </div>
        </div>


        <!-- Card 3 -->
        <div class="w-60 h-[30rem] p-4 flex flex-col justify-between items-start gap-4 hover:shadow-lg rounded">
            <div class="relative">
                <a href="#">
                    <img src=" {{ asset('imgs/img3.jpg') }}" alt="" class="w-52 h-64 object-cover">
                </a>
                <div class="absolute bottom-2 right-2 rounded-2xl bg-white px-3 py-1">
                    <p class="font-Satoshi-bold text-sm text-black">
                        -9%
                    </p>
                </div>  

                <div class="absolute top-3 right-3 bg-white p-2 rounded-full hover:shadow-md hover:ring-2 hover:ring-black hover:transition-all">
                    <svg class="w-5 h-5 fill-black cursor-pointer bookmarked" xmlns="http://www.w3.org/2000/svg" id="Filled" viewBox="0 0 24 24" width="512" height="512">
                        <path d="M2.849,23.55a2.954,2.954,0,0,0,3.266-.644L12,17.053l5.885,5.853a2.956,2.956,0,0,0,2.1.881,3.05,3.05,0,0,0,1.17-.237A2.953,2.953,0,0,0,23,20.779V5a5.006,5.006,0,0,0-5-5H6A5.006,5.006,0,0,0,1,5V20.779A2.953,2.953,0,0,0,2.849,23.55Z"/>
                    </svg>
    
                    <svg class="w-5 h-5 fill-black cursor-pointer hidden unbookmark" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512">
                        <path d="m21,19.586V3c0-1.654-1.346-3-3-3H6.559c-1.393,0-2.566.954-2.903,2.242L1.457.043.043,1.457l22.5,22.5,1.414-1.414-2.957-2.957Zm-10.083-3.661l-7.917,8.075v-15.991l7.917,7.916Z"/>
                    </svg>
                </div>
            </div>

            <div>
                <p class="font-Satoshi-bold text-xl">
                    Men's Sando
                </p>
            </div>

            <div class="flex justify-center items-center w-fit gap-2">
                <p class="font-Satoshi-bold text-2xl">
                    &#8369;130
                </p>

                {{-- <p class="font-Satoshi-bold line-through text-2xl text-gray-400">
                    &#8369;70
                </p> --}}
            </div>

            <div class="flex justify-between items-center w-full">
                <a href="#" class="py-2 px-3 bg-black rounded-lg hover:opacity-80 hover:transition-all focus:opacity-60 focus:transition-all">
                    <button class="font-Satoshi text-white">Buy Now!</button>
                </a>

                {{-- <a href="#" class="py-2 px-3 bg-black rounded-lg hover:opacity-80 hover:transition-all focus:opacity-60 focus:transition-all">
                    <button class="font-Satoshi text-white">Trade Now!</button>
                </a> --}}
            </div>
        </div>

        <!-- Card 4 -->
        <div class="w-60 h-[30rem] p-4 flex flex-col justify-between items-start gap-4 hover:shadow-lg rounded">
            <div class="relative">
                <a href="#">
                    <img src=" {{ asset('imgs/img4.jpg') }}" alt="" class="w-52 h-64 object-cover">
                </a>
                <div class="absolute bottom-2 right-2 rounded-2xl bg-white px-3 py-1">
                    <p class="font-Satoshi-bold text-sm text-black">
                        -23%
                    </p>
                </div>  

                <div class="absolute top-3 right-3 bg-white p-2 rounded-full hover:shadow-md hover:ring-2 hover:ring-black hover:transition-all">
                    <svg class="w-5 h-5 fill-black cursor-pointer bookmarked" xmlns="http://www.w3.org/2000/svg" id="Filled" viewBox="0 0 24 24" width="512" height="512">
                        <path d="M2.849,23.55a2.954,2.954,0,0,0,3.266-.644L12,17.053l5.885,5.853a2.956,2.956,0,0,0,2.1.881,3.05,3.05,0,0,0,1.17-.237A2.953,2.953,0,0,0,23,20.779V5a5.006,5.006,0,0,0-5-5H6A5.006,5.006,0,0,0,1,5V20.779A2.953,2.953,0,0,0,2.849,23.55Z"/>
                    </svg>
    
                    <svg class="w-5 h-5 fill-black cursor-pointer hidden unbookmark" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512">
                        <path d="m21,19.586V3c0-1.654-1.346-3-3-3H6.559c-1.393,0-2.566.954-2.903,2.242L1.457.043.043,1.457l22.5,22.5,1.414-1.414-2.957-2.957Zm-10.083-3.661l-7.917,8.075v-15.991l7.917,7.916Z"/>
                    </svg>
                </div>
            </div>

            <div>
                <p class="font-Satoshi-bold text-xl">
                    Nat Geo Short
                </p>
            </div>

            <div class="flex justify-center items-center w-fit gap-2">
                <p class="font-Satoshi-bold text-2xl">
                    &#8369;500
                </p>

                <p class="font-Satoshi-bold line-through text-2xl text-gray-400">
                    &#8369;650
                </p>
            </div>

            <div class="flex justify-between items-center w-full">
                <a href="#" class="py-2 px-3 bg-black rounded-lg hover:opacity-80 hover:transition-all focus:opacity-60 focus:transition-all">
                    <button class="font-Satoshi text-white">Buy Now!</button>
                </a>

                <a href="#" class="py-2 px-3 bg-black rounded-lg hover:opacity-80 hover:transition-all focus:opacity-60 focus:transition-all">
                    <button class="font-Satoshi text-white">Trade Now!</button>
                </a>
            </div>
        </div>

    </div>

</section>


<section class="px-16 mt-16 mb-28">
    <div class="text-center p-10">
        <p class="font-FontSpring-extra-bold text-4xl">
            Deals
        </p>
    </div>

    <div class="flex flex-wrap justify-center gap-10 font-Satoshi"> <!-- Increased gap -->
        
        <!-- Card 1 -->
        <div class="w-60 h-[30rem] p-4 flex flex-col justify-between items-start gap-4 hover:shadow-lg rounded">
            <div class="relative">
                <a href="{{ route('prod.details') }}">
                    <img src="{{ asset('imgs/img1.jpg') }}" alt="" class="w-52 h-64 object-cover">
                </a>
                <div class="absolute bottom-2 right-2 rounded-2xl bg-white px-3 py-1">
                    <p class="font-Satoshi-bold text-sm text-black">
                        -20%
                    </p>
                </div>

                <div class="absolute top-3 right-3 bg-white p-2 rounded-full hover:shadow-md hover:ring-2 hover:ring-black hover:transition-all">
                    <svg class="w-5 h-5 fill-black cursor-pointer bookmarked" xmlns="http://www.w3.org/2000/svg" id="Filled" viewBox="0 0 24 24" width="512" height="512">
                        <path d="M2.849,23.55a2.954,2.954,0,0,0,3.266-.644L12,17.053l5.885,5.853a2.956,2.956,0,0,0,2.1.881,3.05,3.05,0,0,0,1.17-.237A2.953,2.953,0,0,0,23,20.779V5a5.006,5.006,0,0,0-5-5H6A5.006,5.006,0,0,0,1,5V20.779A2.953,2.953,0,0,0,2.849,23.55Z"/>
                    </svg>
    
                    <svg class="w-5 h-5 fill-black cursor-pointer hidden unbookmark" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512">
                        <path d="m21,19.586V3c0-1.654-1.346-3-3-3H6.559c-1.393,0-2.566.954-2.903,2.242L1.457.043.043,1.457l22.5,22.5,1.414-1.414-2.957-2.957Zm-10.083-3.661l-7.917,8.075v-15.991l7.917,7.916Z"/>
                    </svg>
                </div>
            </div>

            <div>
                <p class="font-Satoshi-bold text-xl">
                    UNIQLO Skinny Ezy Jeans Khaki
                </p>
            </div>

            <div class="flex justify-center items-center w-fit gap-2">
                <p class="font-Satoshi-bold text-2xl">
                    &#8369;62
                </p>

                <p class="font-Satoshi-bold line-through text-2xl text-gray-400">
                    &#8369;70
                </p>
            </div>

            <div class="flex justify-between items-center w-full">
                <a href="#" class="py-2 px-3 bg-black rounded-lg hover:opacity-80 hover:transition-all focus:opacity-60 focus:transition-all">
                    <button class="font-Satoshi text-white">Buy Now!</button>
                </a>

                <a href="#" class="py-2 px-3 bg-black rounded-lg hover:opacity-80 hover:transition-all focus:opacity-60 focus:transition-all">
                    <button class="font-Satoshi text-white">Trade Now!</button>
                </a>
            </div>
        </div>
        
        <!-- Card 2 -->
        <div class="w-60 h-[30rem] p-4 flex flex-col justify-between items-start gap-4 hover:shadow-lg rounded">
            <div class="relative">
                <a href="#">
                    <img src=" {{ asset('imgs/img2.jpg') }}" alt="" class="w-52 h-64 object-cover">
                </a>
                {{-- <div class="absolute bottom-2 right-2 rounded-2xl bg-white px-3 py-1">
                    <p class="font-Satoshi-bold text-sm text-black">
                        -20%
                    </p>
                </div>   --}}

                <div class="absolute top-3 right-3 bg-white p-2 rounded-full hover:shadow-md hover:ring-2 hover:ring-black hover:transition-all">
                    <svg class="w-5 h-5 fill-black cursor-pointer bookmarked" xmlns="http://www.w3.org/2000/svg" id="Filled" viewBox="0 0 24 24" width="512" height="512">
                        <path d="M2.849,23.55a2.954,2.954,0,0,0,3.266-.644L12,17.053l5.885,5.853a2.956,2.956,0,0,0,2.1.881,3.05,3.05,0,0,0,1.17-.237A2.953,2.953,0,0,0,23,20.779V5a5.006,5.006,0,0,0-5-5H6A5.006,5.006,0,0,0,1,5V20.779A2.953,2.953,0,0,0,2.849,23.55Z"/>
                    </svg>
    
                    <svg class="w-5 h-5 fill-black cursor-pointer hidden unbookmark" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512">
                        <path d="m21,19.586V3c0-1.654-1.346-3-3-3H6.559c-1.393,0-2.566.954-2.903,2.242L1.457.043.043,1.457l22.5,22.5,1.414-1.414-2.957-2.957Zm-10.083-3.661l-7.917,8.075v-15.991l7.917,7.916Z"/>
                    </svg>
                </div>
            </div>

            <div>
                <p class="font-Satoshi-bold text-xl">
                    TANK TOP DOUBLE LINING
                </p>
            </div>

            <div class="flex justify-center items-center w-fit gap-2">
                <p class="font-Satoshi-bold text-2xl">
                    &#8369;100
                </p>

                <p class="font-Satoshi-bold line-through text-2xl text-gray-400">
                    &#8369;110
                </p>
            </div>

            <div class="flex justify-between items-center w-full">
                <a href="#" class="py-2 px-3 bg-black rounded-lg hover:opacity-80 hover:transition-all focus:opacity-60 focus:transition-all">
                    <button class="font-Satoshi text-white">Buy Now!</button>
                </a>

                {{-- <a href="#" class="py-2 px-3 bg-black rounded-lg hover:opacity-80 hover:transition-all focus:opacity-60 focus:transition-all">
                    <button class="font-Satoshi text-white">Trade Now!</button>
                </a> --}}
            </div>
        </div>


        <!-- Card 3 -->
        <div class="w-60 h-[30rem] p-4 flex flex-col justify-between items-start gap-4 hover:shadow-lg rounded">
            <div class="relative">
                <a href="#">
                    <img src=" {{ asset('imgs/img3.jpg') }}" alt="" class="w-52 h-64 object-cover">
                </a>
                <div class="absolute bottom-2 right-2 rounded-2xl bg-white px-3 py-1">
                    <p class="font-Satoshi-bold text-sm text-black">
                        -9%
                    </p>
                </div>  

                <div class="absolute top-3 right-3 bg-white p-2 rounded-full hover:shadow-md hover:ring-2 hover:ring-black hover:transition-all">
                    <svg class="w-5 h-5 fill-black cursor-pointer bookmarked" xmlns="http://www.w3.org/2000/svg" id="Filled" viewBox="0 0 24 24" width="512" height="512">
                        <path d="M2.849,23.55a2.954,2.954,0,0,0,3.266-.644L12,17.053l5.885,5.853a2.956,2.956,0,0,0,2.1.881,3.05,3.05,0,0,0,1.17-.237A2.953,2.953,0,0,0,23,20.779V5a5.006,5.006,0,0,0-5-5H6A5.006,5.006,0,0,0,1,5V20.779A2.953,2.953,0,0,0,2.849,23.55Z"/>
                    </svg>
    
                    <svg class="w-5 h-5 fill-black cursor-pointer hidden unbookmark" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512">
                        <path d="m21,19.586V3c0-1.654-1.346-3-3-3H6.559c-1.393,0-2.566.954-2.903,2.242L1.457.043.043,1.457l22.5,22.5,1.414-1.414-2.957-2.957Zm-10.083-3.661l-7.917,8.075v-15.991l7.917,7.916Z"/>
                    </svg>
                </div>
            </div>

            <div>
                <p class="font-Satoshi-bold text-xl">
                    Men's Sando
                </p>
            </div>

            <div class="flex justify-center items-center w-fit gap-2">
                <p class="font-Satoshi-bold text-2xl">
                    &#8369;130
                </p>

                {{-- <p class="font-Satoshi-bold line-through text-2xl text-gray-400">
                    &#8369;70
                </p> --}}
            </div>

            <div class="flex justify-between items-center w-full">
                <a href="#" class="py-2 px-3 bg-black rounded-lg hover:opacity-80 hover:transition-all focus:opacity-60 focus:transition-all">
                    <button class="font-Satoshi text-white">Buy Now!</button>
                </a>

                {{-- <a href="#" class="py-2 px-3 bg-black rounded-lg hover:opacity-80 hover:transition-all focus:opacity-60 focus:transition-all">
                    <button class="font-Satoshi text-white">Trade Now!</button>
                </a> --}}
            </div>
        </div>

        <!-- Card 4 -->
        <div class="w-60 h-[30rem] p-4 flex flex-col justify-between items-start gap-4 hover:shadow-lg rounded">
            <div class="relative">
                <a href="#">
                    <img src=" {{ asset('imgs/img4.jpg') }}" alt="" class="w-52 h-64 object-cover">
                </a>
                <div class="absolute bottom-2 right-2 rounded-2xl bg-white px-3 py-1">
                    <p class="font-Satoshi-bold text-sm text-black">
                        -23%
                    </p>
                </div>  

                <div class="absolute top-3 right-3 bg-white p-2 rounded-full hover:shadow-md hover:ring-2 hover:ring-black hover:transition-all">
                    <svg class="w-5 h-5 fill-black cursor-pointer bookmarked" xmlns="http://www.w3.org/2000/svg" id="Filled" viewBox="0 0 24 24" width="512" height="512">
                        <path d="M2.849,23.55a2.954,2.954,0,0,0,3.266-.644L12,17.053l5.885,5.853a2.956,2.956,0,0,0,2.1.881,3.05,3.05,0,0,0,1.17-.237A2.953,2.953,0,0,0,23,20.779V5a5.006,5.006,0,0,0-5-5H6A5.006,5.006,0,0,0,1,5V20.779A2.953,2.953,0,0,0,2.849,23.55Z"/>
                    </svg>
    
                    <svg class="w-5 h-5 fill-black cursor-pointer hidden unbookmark" xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="512" height="512">
                        <path d="m21,19.586V3c0-1.654-1.346-3-3-3H6.559c-1.393,0-2.566.954-2.903,2.242L1.457.043.043,1.457l22.5,22.5,1.414-1.414-2.957-2.957Zm-10.083-3.661l-7.917,8.075v-15.991l7.917,7.916Z"/>
                    </svg>
                </div>
            </div>

            <div>
                <p class="font-Satoshi-bold text-xl">
                    Nat Geo Short
                </p>
            </div>

            <div class="flex justify-center items-center w-fit gap-2">
                <p class="font-Satoshi-bold text-2xl">
                    &#8369;500
                </p>

                <p class="font-Satoshi-bold line-through text-2xl text-gray-400">
                    &#8369;650
                </p>
            </div>

            <div class="flex justify-between items-center w-full">
                <a href="#" class="py-2 px-3 bg-black rounded-lg hover:opacity-80 hover:transition-all focus:opacity-60 focus:transition-all">
                    <button class="font-Satoshi text-white">Buy Now!</button>
                </a>

                <a href="#" class="py-2 px-3 bg-black rounded-lg hover:opacity-80 hover:transition-all focus:opacity-60 focus:transition-all">
                    <button class="font-Satoshi text-white">Trade Now!</button>
                </a>
            </div>
        </div>
    </div>

</section>
   
</x-layout>