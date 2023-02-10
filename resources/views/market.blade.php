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
            <a href="/market" class="text-xl font-bold flex items-center lg:ml-2.5">
              <img src="{{url('/images/tugas-logo.svg')}}" class="h-6 mr-2" alt="Windster Logo">
              <span class="self-center whitespace-nowrap">Tokoku</span>
            </a>                
          </div>
          <div class="flex items-center">
            <a href="/history" class="hidden sm:flex ml-5 text-cyan-600 bg-white border border-solid border-x-cyan-600 hover:bg-cyan-600 hover:text-white focus:ring-4 focus:ring-cyan-200 font-medium r6unded-lg text-sm px-5 py-2.5 text-center items-center mr-3">                    
              History Pembelian
            </a a>
            <a href="/logout" class="hidden sm:flex ml-5 text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center items-center mr-3">                    
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
      @foreach($data as $d)
        <div class="group relative">
          <div class="min-h-80 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:aspect-none lg:h-80">
            <img src="{{ $d->gambar }}" alt="Product Image" class="h-full w-full object-cover object-center lg:h-full lg:w-full">
          </div>
          <div class="mt-4 flex justify-between">
            <div>
              <h2 class="text-base text-gray-700">{{ $d->nama }}</h2>
              <p class="mt-1 text-sm text-gray-500">{{ $d->harga_jual }}</p>
            </div>
            <button class="openModal beli-button flex items-center py-2 px-6 font-medium border border-solid 
            border-gray-800 rounded-md hover:text-white hover:bg-gray-800" data-id_barang="{{ $d->id_barang }}" data-nama="{{ $d->nama }}"
            data-deskripsi="{{ $d->deskripsi }}" data-stock="{{ $d->stock }}" data-harga_jual="{{ $d->harga_jual }}">Beli</button>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    <!-- Modal -->
    <div class="hidden py-12 bg-gray-700 bg-opacity-75 transition duration-150 ease-in-out absolute top-0 right-0 bottom-0 left-0 z-50" id="modal">
        <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg">
            <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">                
                <h1 class="openModal text-gray-800 font-lg font-bold tracking-normal leading-tight mb-4">Detail Barang</h1>
                <div class="flex flex-col gap-2 mb-4">
                  <h3 class="text-gray-800 font-bold leading-tight tracking-normal">Nama Barang</h3>
                  <p id="nama" class="text-gray-800 text-sm font-normal leading-tight">Cosmetic Bundle 1</p>  
                </div>
                <div class="flex flex-col gap-2 mb-4">
                  <h3 class="text-gray-800 font-bold leading-tight tracking-normal">Deskripsi Barang</h3>
                  <p id="deskripsi" class="text-gray-800 text-sm font-normal leading-tight">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt, expedita!</p>  
                </div>
                <div class="flex flex-col gap-2 mb-4">
                  <h3 class="text-gray-800 font-bold leading-tight tracking-normal">Stock Tersedia</h3>
                  <p id="stock" class="text-gray-800 text-sm font-normal leading-tight">12</p>
                </div>
                <div class="flex flex-col gap-2 mb-4">
                  <h3 class="text-gray-800 font-bold leading-tight tracking-normal">Harga Barang</h3>
                  <p id="harga_jual" class="text-gray-800 text-sm font-normal leading-tight">-</p>  
                </div>
                <form id="my-form" action="/beli-barang" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="flex gap-6 justify-between">
                  <div class="flex flex-col items-start gap-2 mb-4">
                    <label for="jumlah_beli" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Jumlah yang ingin dibeli</label>
                    <input id="id_barang" name="id_barang" type="hidden" />
                    <input id="total_harga" name="total_harga" type="hidden" />
                    <input id="jumlah_beli" name="jumlah_beli" type="number" class="text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="Masukkan jumlah" />
                  </div>     
                  <div class="flex flex-col gap-2">
                    <h4 class="text-gray-800 font-bold">Total</h4>
                    <p id="total-harga" class="text-gray-800 text-sm font-medium leading-tight">-</p> 
                  </div> 
                </div>          
                    
                <div class="flex items-center justify-start w-full">
                    <button type="submit" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-8 py-2 text-sm">Checkout</button>
                    <button type="button" class="closeModal focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-400 ml-3 bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-8 py-2 text-sm" onclick="modalHandler()">Cancel</button>
                </div>
                </form>

                <button class="closeModal cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600" onclick="modalHandler()" aria-label="close modal" role="button">
                    <svg  xmlns="http://www.w3.org/2000/svg"  class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
  </section>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    
  <script type="text/javascript">
    $(document).ready(function () {  
      // Modal
      let modal = document.getElementById("modal");
      $(".closeModal").on("click", function () {
        modalHandler();
      })
      $(".openModal").on("click", function () {
        modalHandler(true);
      })

      let harga_jual = 0;
      $('.beli-button').click((e) => {
        $('#id_barang').val(e.currentTarget.dataset.id_barang);
        $('#nama').text(e.currentTarget.dataset.nama);
        $('#deskripsi').text(e.currentTarget.dataset.deskripsi);
        $('#stock').text(e.currentTarget.dataset.stock);
        $('#harga_jual').text(e.currentTarget.dataset.harga_jual);
        harga_jual = parseInt(e.currentTarget.dataset.harga_jual);
      })

      $('#jumlah_beli').keyup(() => {
        let jumlah_bayar = harga_jual * parseInt($('#jumlah_beli').val())
        jumlah_bayar != NaN ? $('#total-harga').text(jumlah_bayar) : $('#total-harga').text('-')
        jumlah_bayar != NaN ? $('#total_harga').val(jumlah_bayar) : $('#total_harga').val(0)
      })
    });

    function modalHandler(val) {
        if (val) {
            fadeIn(modal);
        } else {
            fadeOut(modal);
        }
    }
    function fadeOut(el) {
        el.style.opacity = 1;
        (function fade() {
            if ((el.style.opacity -= 0.1) < 0) {
                el.style.display = "none";
            } else {
                requestAnimationFrame(fade);
            }
        })();
    }
    function fadeIn(el, display) {
        el.style.opacity = 0;
        el.style.display = display || "flex";
        (function fade() {
            let val = parseFloat(el.style.opacity);
            if (!((val += 0.2) > 1)) {
                el.style.opacity = val;
                requestAnimationFrame(fade);
            }
        })();
    }
  </script>
</body>
</html>