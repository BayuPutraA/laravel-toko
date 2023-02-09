@extends('layout/index')

@section('title', 'Dashboard')

  @section('content')
  <div class="bg-gray-900 opacity-50 hidden fixed inset-0 z-10" id="sidebarBackdrop"></div>
  <div class="h-full w-full bg-gray-50 relative overflow-y-auto lg:ml-64">
    <main>
        <div class="pt-6 px-4">
          <div class="w-full grid grid-cols-2 md:grid-cols-2 xl:grid-cols-2 gap-4">
              <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8  ">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex-shrink-0">
                      <span class="text-2xl sm:text-2xl leading-none font-bold text-gray-900">Grafik Penjualan Barang</span>
                    </div>
                </div>
                <canvas id="main-chart"></canvas>
              </div>    
              <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8  ">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex-shrink-0">
                      <span class="text-2xl sm:text-2xl leading-none font-bold text-gray-900">Grafik Keuntungan Penjualan</span>
                    </div>
                </div>
                <canvas id="second-chart"></canvas>
              </div>                   
          </div>
          <div class="mt-4 w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
              <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                      <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{ count($barang) }}</span>
                      <h3 class="text-base font-normal text-gray-500">Total Barang</h3>
                    </div>
                </div>
              </div>
              <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                      <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{ $all_terjual }}</span>
                      <h3 class="text-base font-normal text-gray-500">Total Barang Terjual</h3>
                    </div>
                </div>
              </div>
              <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                      <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{ $all_keuntungan }}</span>
                      <h3 class="text-base font-normal text-gray-500">Keuntungan Penjualan</h3>
                    </div>
                </div>
              </div>
          </div>
          <div class="grid grid-cols-1 2xl:grid-cols-2 xl:gap-4 my-4">                    
              <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                <h3 class="text-xl leading-none font-bold text-gray-900 mb-10">Acquisition Overview</h3>
                <div class="block w-full overflow-x-auto">
                    <table class="items-center w-full bg-transparent border-collapse">
                      <thead>
                          <tr>
                            <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Barang</th>
                            <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap">Total Terjual</th>
                            <th class="px-4 bg-gray-50 text-gray-700 align-middle py-3 text-xs font-semibold text-left uppercase border-l-0 border-r-0 whitespace-nowrap min-w-140-px"></th>
                          </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-100">
                        @foreach($barang as $b)
                          <tr class="text-gray-500">
                            <th class="border-t-0 px-4 align-middle text-sm font-normal whitespace-nowrap p-4 text-left">{{ $b->nama }}</th>
                            <td class="border-t-0 px-4 align-middle text-xs font-medium text-gray-900 whitespace-nowrap p-4">{{ $b->terjual }}</td>
                            <td class="border-t-0 px-4 align-middle text-xs whitespace-nowrap p-4">
                                <div class="flex items-center">
                                  <span class="mr-2 text-xs font-medium">{{ $b->terjual != 0 ? round(($b->terjual / $all_terjual) * 100) : 0 }}%</span>
                                  <div class="relative w-full">
                                      <div class="w-full bg-gray-200 rounded-sm h-2">
                                        <div class="bg-cyan-600 h-2 rounded-sm" style="width: {{ $b->terjual != 0 ? round(($b->terjual / $all_terjual) * 100) : 0 }}%"></div>
                                      </div>
                                  </div>
                                </div>
                            </td>
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
  @endsection
  
  @section('script')
  <script type="text/javascript">
    $(document).ready(function () {
      var dataTerjualHarian = @json($dataTerjualHarian);
      var dataKeuntunganHarian = @json($dataKeuntunganHarian);

      var ctx = document.getElementById("main-chart").getContext('2d');
      var barChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sst", "Sun"],
          datasets: [{
            label: 'Penjualan Barang',
            data: dataTerjualHarian,
            backgroundColor: "rgba(255,0,0,1)"
          }]
        }
      });

      var ctx2 = document.getElementById("second-chart").getContext('2d');
      var barChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
          labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sst", "Sun"],
          datasets: [ {
            label: 'Keuntungan Penjualan',
            data: dataKeuntunganHarian,
            backgroundColor: "rgba(0,0,255,1)"
          }]
        },
      });
    });
  </script>
  @endsection
