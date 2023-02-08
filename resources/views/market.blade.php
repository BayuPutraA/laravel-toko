<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
  <!-- navbar goes here -->
  <nav class="bg-white border-b border-gray-200 fixed z-30 w-full">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
          <div class="flex items-center justify-between">
              <div class="flex items-center justify-start">
                <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar" class="lg:hidden mr-2 text-gray-600 hover:text-gray-900 cursor-pointer p-2 hover:bg-gray-100 focus:bg-gray-100 focus:ring-2 focus:ring-gray-100 rounded">
                    <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <svg id="toggleSidebarMobileClose" class="w-6 h-6 hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
                <a href="#" class="text-xl font-bold flex items-center lg:ml-2.5">
                <img src="{{url('/images/tugas-logo.svg')}}" class="h-6 mr-2" alt="Windster Logo">
                <span class="self-center whitespace-nowrap">Tokoku</span>
                </a>                
              </div>
              <div class="flex items-center">                                
                <a href="#" class="hidden sm:inline-flex ml-5 text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center items-center mr-3">                    
                  Logout
                </a>
              </div>
          </div>
        </div>
    </nav>
  <section class="bg-white w-full h-screen">
    <div class="mx-auto max-w-2xl py-8 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
      <h2 class="text-2xl font-bold tracking-tight text-gray-900">Our Product</h2>
      <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
        <div class="group relative">
          <div class="min-h-80 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:aspect-none lg:h-80">
            <img src="{{url('/images/product-1.jpg')}}" alt="Product Image" class="h-full w-full object-cover object-center lg:h-full lg:w-full">
          </div>
          <div class="mt-4 flex justify-between">
            <div>
              <h2 class="text-base text-gray-700">Cosmetics bundle 1</h2>
              <p class="mt-1 text-sm text-gray-500">$35</p>
            </div>
            <button class="flex items-center py-2 px-3 font-medium border border-solid border-gray-800 rounded-md hover:text-white hover:bg-gray-800">Add To Cart</button>
          </div>
        </div>
        <div class="group relative">
          <div class="min-h-80 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:aspect-none lg:h-80">
            <img src="{{url('/images/product-2.jpg')}}" alt="Product Image" class="h-full w-full object-cover object-center lg:h-full lg:w-full">
          </div>
          <div class="mt-4 flex justify-between">
            <div>
              <h2 class="text-base text-gray-700">Product 2</h2>
              <p class="mt-1 text-sm text-gray-500">$32</p>
            </div>
            <button class="flex items-center py-2 px-3 font-medium border border-solid border-gray-800 rounded-md hover:text-white hover:bg-gray-800">Add To Cart</button>
          </div>
        </div>
        <div class="group relative">
          <div class="min-h-80 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:aspect-none lg:h-80">
            <img src="{{url('/images/product-3.jpg')}}" alt="Product Image" class="h-full w-full object-cover object-center lg:h-full lg:w-full">
          </div>
          <div class="mt-4 flex justify-between">
            <div>
              <h2 class="text-base text-gray-700">Product 3</h2>
              <p class="mt-1 text-sm text-gray-500">$21</p>
            </div>
            <button class="flex items-center py-2 px-3 font-medium border border-solid border-gray-800 rounded-md hover:text-white hover:bg-gray-800">Add To Cart</button>
          </div>
        </div>
        <div class="group relative">
          <div class="min-h-80 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:aspect-none lg:h-80">
            <img src="{{url('/images/product-4.jpg')}}" alt="Product Image" class="h-full w-full object-cover object-center lg:h-full lg:w-full">
          </div>
          <div class="mt-4 flex justify-between">
            <div>
              <h2 class="text-base text-gray-700">Product 4</h2>
              <p class="mt-1 text-sm text-gray-500">$16</p>
            </div>
            <button class="flex items-center py-2 px-3 font-medium border border-solid border-gray-800 rounded-md hover:text-white hover:bg-gray-800">Add To Cart</button>
          </div>
        </div>
        <div class="group relative">
          <div class="min-h-80 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:aspect-none lg:h-80">
            <img src="{{url('/images/product-5.jpg')}}" alt="Product Image" class="h-full w-full object-cover object-center lg:h-full lg:w-full">
          </div>
          <div class="mt-4 flex justify-between">
            <div>
              <h2 class="text-base text-gray-700">Product 5</h2>
              <p class="mt-1 text-sm text-gray-500">$25</p>
            </div>
            <button class="flex items-center py-2 px-3 font-medium border border-solid border-gray-800 rounded-md hover:text-white hover:bg-gray-800">Add To Cart</button>
          </div>
        </div>
        <div class="group relative">
          <div class="min-h-80 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:aspect-none lg:h-80">
            <img src="{{url('/images/product-6.jpg')}}" alt="Product Image" class="h-full w-full object-cover object-center lg:h-full lg:w-full">
          </div>
          <div class="mt-4 flex justify-between">
            <div>
              <h2 class="text-base text-gray-700">Product 6</h2>
              <p class="mt-1 text-sm text-gray-500">$41</p>
            </div>
            <button class="flex items-center py-2 px-3 font-medium border border-solid border-gray-800 rounded-md hover:text-white hover:bg-gray-800">Add To Cart</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>
</html>