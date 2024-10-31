<x-layout>

    <div class="flex items-center justify-between w-full">
        <div class="splash"> <!-- This is the div where the content will be displayed -->
            <h1>WELCOME TO CAMPUS CONNECT!</h1>
            <h2 class="splashtext">BROWSE CAMPUS<br>CONNECT NOW.</h2>
            <h3 class="smalltext">Browse through our diverse range of affordable student items here!</h3>
            <br>
            <button class="primary-btn"><a href="#">SHOP NOW</a></button>
        </div>
    
        <div class="wmsulogo flex justify-end mr-[250px]">
            <svg class="star1" width="104" height="93" viewBox="0 0 104 93" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M52 0.626999C53.7654 25.3579 76.0448 45.068 104 46.6297C76.0448 48.1915 53.7654 67.9014 52 92.6325C50.2347 67.9014 27.955 48.1915 0 46.6297C27.955 45.068 50.2347 25.3579 52 0.626999Z" fill="white"/>
            </svg>
    
            <img src="{{ asset('imgs/wmsu_logo.png') }}" alt="logo" class="w-[250px] h-auto">
            
            <svg class ="star2" width="104" height="93" viewBox="0 0 104 93" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M52 0.626999C53.7654 25.3579 76.0448 45.068 104 46.6297C76.0448 48.1915 53.7654 67.9014 52 92.6325C50.2347 67.9014 27.955 48.1915 0 46.6297C27.955 45.068 50.2347 25.3579 52 0.626999Z" fill="white"/>
            </svg>
        </div>
    </div>
    
</x-layout>