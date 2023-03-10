@extends('layout/index')

@section('title', 'Dashboard')

  @section('content')
    <div class="bg-gray-900 opacity-50 hidden fixed inset-0 z-10" id="sidebarBackdrop"></div>
      <div id="main-chart" class="h-full w-full bg-gray-50 relative overflow-y-auto lg:ml-64">
        <main>
            <div class="pt-6 px-4">                
              <div class="grid grid-cols-1 xl:gap-4 my-4">                    
                  <div class="flex flex-col gap-6 bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                    <div class="flex justify-between items-center">
                      <h3 class="text-xl leading-none font-bold text-gray-900">Daftar Barang</h3>
                      <button id="openModal" onClick="changeAction('/tambah-barang')" class="ml-5 text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center items-center mr-3">Tambah Barang</button>
                    </div>
                    <div class="block w-full overflow-x-auto">
                        <table id="user-table" class="items-center w-full bg-transparent border-collapse">
                          <thead>
                              <tr>
                                <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Nama Barang</th>
                                <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Deskripsi</th>
                                <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Jenis Barang</th>
                                <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Stock</th>
                                <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Harga Jual</th>
                                <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Harga Beli</th>
                                <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Gambar Barang</th>
                                <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap min-w-140-px">Action</th>
                              </tr>
                          </thead>
                          <tbody class="divide-y divide-gray-100">
                            @foreach($data as $d)
                              <tr class="text-gray-500">
                                <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">{{ $d->nama }}</th>
                                <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">{{ $d->deskripsi }}</th>
                                <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">{{ $d->jenis }}</th>
                                <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">{{ $d->stock }}</th>
                                <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">{{ $d->harga_jual }}</th>
                                <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">{{ $d->harga_beli }}</th>
                                <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">
                                  <img src="{{ $d->gambar }}" alt="Product Image" class="max-w-[64px] object-cover object-center">
                                </th>
                                <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">
                                  <div class="flex gap-2">
                                    <a href="#!" id="openModalEdit" data-nama="{{ $d->nama }}" data-deskripsi="{{ $d->deskripsi }}" 
                                    data-jenis="{{ $d->jenis }}" data-stock="{{ $d->stock }}" data-harga_beli="{{ $d->harga_beli }}" 
                                    data-harga_jual="{{ $d->harga_jual }}" class="text-green-500 edit-button" onClick="changeAction('/edit-barang', {{ $d->id_barang }})">Edit</a> |                                       
                                    <a href="/hapus-barang/{{ $d->id_barang }}" class="text-red-400">Delete</a>
                                  </div>
                                </th>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                  </div>
              </div>
            </div>
        </main>          
      </div>
  </div>    

  <!-- Modal -->
  <div class="hidden py-12 bg-gray-700 bg-opacity-75 transition duration-150 ease-in-out absolute top-0 right-0 bottom-0 left-0 z-50" id="modal">
      <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg">
          <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">    
          <form id="my-form" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
              <input id="id_barang" name="id_barang" type="hidden" />            
              <h1 class="text-gray-800 font-lg font-bold tracking-normal leading-tight mb-4">Input Barang</h1>
              <label for="nama" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Nama Barang</label>
              <input id="nama" name="nama" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="Masukkan Nama Barang" />                
              <label for="deskripsi" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Deskripsi Barang</label>
              <input id="deskripsi" name="deskripsi" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="Masukkan Deskripsi Barang" />
              <label for="jenis" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Jenis Barang</label>
              <input id="jenis" name="jenis" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="Masukkan Jenis Barang" />
              <label for="stock" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Stock</label>
              <input id="stock" type="number" name="stock" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="Masukkan Stock Barang" />
              <label for="harga_jual" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Harga Jual</label>
              <input id="harga_jual" type="number" name="harga_jual" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="Masukkan Harga Jual Barang" />
              <label for="harga_beli" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Harga Beli</label>
              <input id="harga_beli" type="number" name="harga_beli" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="Masukkan Harga Beli Barang" />
              <label for="gambar" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Gambar Barang</label>
              <input id="gambar" name="gambar" type="file" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="Foto Barang" />
              
              <div class="flex items-center justify-start w-full">
                  <button type="submit" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-8 py-2 text-sm">Submit</button>
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
  @endsection
  
  @section('script')
  <script type="text/javascript">
    $(document).ready(function () {  
      // Modal

      let modal = document.getElementById("modal");
      $(".closeModal").on("click", function () {
        modalHandler();
      })
      $("#openModal, #openModalEdit").on("click", function () {
        modalHandler(true);
      })

      $('.edit-button').click((e) => {
        $('#nama').val(e.currentTarget.dataset.nama);
        $('#deskripsi').val(e.currentTarget.dataset.deskripsi);
        $('#jenis').val(e.currentTarget.dataset.jenis);
        $('#stock').val(e.currentTarget.dataset.stock);
        $('#harga_beli').val(e.currentTarget.dataset.harga_beli);
        $('#harga_jual').val(e.currentTarget.dataset.harga_jual);
      })
      
    });

    function changeAction(action, id_barang = null){
      $(':input.text-gray-600').val("");
      $('#my-form').attr('action', action);
      $('#id_barang').val(id_barang);
    }

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
  @endsection
  