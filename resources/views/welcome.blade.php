<x-layout>

 <div class="max-w-full mx-auto font-FontSpring-bold font-extrabold bg-primary-color text-white">
    <div class="flex flex-col justify-between w-full h-[40vh]">
    <div class="flex items-center justify-between w-full flex-grow">
        <div class="text-left ml-[250px] p-16"> <!-- This is the div where the content will be displayed -->
            <h1>WELCOME TO CAMPUS CONNECT!</h1>
            <h2 class="font-Welcome-Font text-6xl">BROWSE CAMPUS<br>CONNECT NOW.</h2>
            <h3 class="font-Satoshi text-base font-normal">Browse through our diverse range of affordable student items here!</h3>
            <br>
            <button class="flex w-1/4 justify-center rounded-md bg-white px-4 py-3 font-semibold leading-6 shadow-sm hover:bg-neutral-100">
                <a href="#" class="text-red font-Satoshi">SHOP NOW</a>
            </button>
        </div>
    
        <div class="wmsulogo flex justify-end mr-[250px]">
            <svg class="translate-y-[120px] w-20 h-auto" width="104" height="93" viewBox="0 0 104 93" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M52 0.626999C53.7654 25.3579 76.0448 45.068 104 46.6297C76.0448 48.1915 53.7654 67.9014 52 92.6325C50.2347 67.9014 27.955 48.1915 0 46.6297C27.955 45.068 50.2347 25.3579 52 0.626999Z" fill="white"/>
            </svg>
    
            <img src="{{ asset('imgs/wmsu_logo.png') }}" alt="logo" class="w-[250px] h-auto">
            
            <svg class ="star2" width="104" height="93" viewBox="0 0 104 93" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M52 0.626999C53.7654 25.3579 76.0448 45.068 104 46.6297C76.0448 48.1915 53.7654 67.9014 52 92.6325C50.2347 67.9014 27.955 48.1915 0 46.6297C27.955 45.068 50.2347 25.3579 52 0.626999Z" fill="white"/>
            </svg>
        </div>
    </div>
    </div>
 </div>

 <div class="nums p-[50px] max-w-full font-Satoshi font-normal bg-primary-color text-white">
        <div class="text-left flex space-x-8 ml-[260px]">
    <div class="itemNum">
    <h1 class="text-4xl">300+</h1>
    <h2 class="text-sm">Items</h2>
    </div>

    <div class="itemNum">
    <h1 class="text-4xl">500+</h1>
    <h2 class="text-sm">High Quality Items</h2>
    </div>
 </div>
</div>
   <section class="m-10 pb-5">
    <div class="font-FontSpring-bold-oblique text-4xl text-center p-10">Recently Uploaded</div>

    <div class="flex flex-wrap justify-center gap-10 font-Satoshi"> <!-- Increased gap -->
        <!-- Card 1 -->
        <div class="bg-white rounded-lg shadow-lg p-4 w-56 h-[350px]">
            <img src="{{ asset('imgs/placeholder_img/200.png') }}" alt="Image 1" class="rounded-t-lg">
            <h2 class="text-lg font-bold mt-1">CCS Uniform Male</h2>
            <p class="text-gray-700 mt-2 font-bold">P500</p>
            <button class="mt-4 bg-black text-white py-2 px-4 rounded hover:bg-neutral-800">Buy Now!</button>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-lg shadow-lg p-4 w-56 h-[350px]">
            <img src="{{ asset('imgs/placeholder_img/200.png') }}" alt="Image 1" class="rounded-t-lg">
            <h2 class="text-lg font-bold mt-1">CCS Uniform Male</h2>
            <p class="text-gray-700 mt-2 font-bold">P500</p>
            <button class="mt-4 bg-black text-white py-2 px-4 rounded hover:bg-neutral-800">Buy Now!</button>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-lg shadow-lg p-4 w-56 h-[350px]">
            <img src="{{ asset('imgs/placeholder_img/200.png') }}" alt="Image 1" class="rounded-t-lg">
            <h2 class="text-lg font-bold mt-1">CCS Uniform Male</h2>
            <p class="text-gray-700 mt-2 font-bold">P500</p>
            <button class="mt-4 bg-black text-white py-2 px-4 rounded hover:bg-neutral-800">Buy Now!</button>
        </div>

        <!-- Card 4 -->
        <div class="bg-white rounded-lg shadow-lg p-4 w-56 h-[350px]">
            <img src="{{ asset('imgs/placeholder_img/200.png') }}" alt="Image 1" class="rounded-t-lg">
            <h2 class="text-lg font-bold mt-1">CCS Uniform Male</h2>
            <p class="text-gray-700 mt-2 font-bold">P500</p>
            <button class="mt-4 bg-black text-white py-2 px-4 rounded hover:bg-neutral-800">Buy Now!</button>
        </div>
    </div>

</section>
         <hr class="border-1 border-gray-300 m-2">   
<section class="pb-10">
    <div class="font-FontSpring-bold-oblique text-4xl text-center p-10">Deals</div>
    <div class="flex flex-wrap justify-center gap-10 font-Satoshi"> <!-- Increased gap -->
        <!-- Card 1 -->
        <div class="bg-white rounded-lg shadow-lg p-4 w-56 h-[350px]">
            <img src="{{ asset('imgs/placeholder_img/200.png') }}" alt="Image 1" class="rounded-t-lg">
            <h2 class="text-lg font-bold mt-1">CCS Uniform Male</h2>
            <p class="text-gray-700 mt-2 font-bold">P500</p>
            <button class="mt-4 bg-black text-white py-2 px-4 rounded hover:bg-neutral-800">Buy Now!</button>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-lg shadow-lg p-4 w-56 h-[350px]">
            <img src="{{ asset('imgs/placeholder_img/200.png') }}" alt="Image 1" class="rounded-t-lg">
            <h2 class="text-lg font-bold mt-1">CCS Uniform Male</h2>
            <p class="text-gray-700 mt-2 font-bold">P500</p>
            <button class="mt-4 bg-black text-white py-2 px-4 rounded hover:bg-neutral-800">Buy Now!</button>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-lg shadow-lg p-4 w-56 h-[350px]">
            <img src="{{ asset('imgs/placeholder_img/200.png') }}" alt="Image 1" class="rounded-t-lg">
            <h2 class="text-lg font-bold mt-1">CCS Uniform Male</h2>
            <p class="text-gray-700 mt-2 font-bold">P500</p>
            <button class="mt-4 bg-black text-white py-2 px-4 rounded hover:bg-neutral-800">Buy Now!</button>
        </div>

        <!-- Card 4 -->
        <div class="bg-white rounded-lg shadow-lg p-4 w-56 h-[350px]">
            <img src="{{ asset('imgs/placeholder_img/200.png') }}" alt="Image 1" class="rounded-t-lg">
            <h2 class="text-lg font-bold mt-1">CCS Uniform Male</h2>
            <p class="text-gray-700 mt-2 font-bold">P500</p>
            <button class="mt-4 bg-black text-white py-2 px-4 rounded hover:bg-neutral-800">Buy Now!</button>
        </div>
    </div>

</section>
   
</x-layout>