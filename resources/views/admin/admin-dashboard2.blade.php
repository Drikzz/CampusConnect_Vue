<x-adminLayout2>
  <body class="bg-gray-100 min-h-screen text-gray-800">
    <div class="flex">
      <div class="bg-white rounded-lg p-5 flex flex-col items-center gap-4 shadow-md sidebar">
        <div class="w-11 h-11 rounded-lg flex items-center justify-center text-gray-500 cursor-pointer transition-all duration-200 relative hover:bg-indigo-100 hover:text-indigo-600 transform hover:-translate-y-1 active:bg-indigo-600 active:text-white" data-tooltip="Home" onclick="setActive(this)">
          <i class="bx bx-home"></i>
        </div>
        <div class="w-11 h-11 rounded-lg flex items-center justify-center text-gray-500 cursor-pointer transition-all duration-200 relative hover:bg-indigo-100 hover:text-indigo-600 transform hover:-translate-y-1 active:bg-indigo-600 active:text-white" data-tooltip="Dashboard" onclick="setActive(this)">
          <i class="bx bx-grid-alt"></i>
        </div>
        <div class="w-11 h-11 rounded-lg flex items-center justify-center text-gray-500 cursor-pointer transition-all duration-200 relative hover:bg-indigo-100 hover:text-indigo-600 transform hover:-translate-y-1 active:bg-indigo-600 active:text-white" data-tooltip="Projects" onclick="setActive(this)">
          <i class="bx bx-briefcase"></i>
        </div>
        <div class="w-11 h-11 rounded-lg flex items-center justify-center text-gray-500 cursor-pointer transition-all duration-200 relative hover:bg-indigo-100 hover:text-indigo-600 transform hover:-translate-y-1 active:bg-indigo-600 active:text-white" data-tooltip="Payments" onclick="setActive(this)">
          <i class="bx bx-credit-card"></i>
        </div>
        <div class="w-11 h-11 rounded-lg flex items-center justify-center text-gray-500 cursor-pointer transition-all duration-200 relative hover:bg-indigo-100 hover:text-indigo-600 transform hover:-translate-y-1 active:bg-indigo-600 active:text-white" data-tooltip="Analytics" onclick="setActive(this)">
          <i class="bx bx-bar-chart"></i>
        </div>
        <div class="w-11 h-11 rounded-lg flex items-center justify-center text-gray-500 cursor-pointer transition-all duration-200 relative hover:bg-indigo-100 hover:text-indigo-600 transform hover:-translate-y-1 active:bg-indigo-600 active:text-white" data-tooltip="Settings" onclick="setActive(this)">
          <i class="bx bx-cog"></i>
        </div>
        <div class="w-11 h-11 rounded-lg flex items-center justify-center text-gray-500 cursor-pointer transition-all duration-200 relative hover:bg-indigo-100 hover:text-indigo-600 transform hover:-translate-y-1 active:bg-indigo-600 active:text-white" data-tooltip="Help" onclick="setActive(this)">
          <i class="bx bx-help-circle"></i>
        </div>
        <div class="w-11 h-11 rounded-lg flex items-center justify-center text-gray-500 cursor-pointer transition-all duration-200 relative hover:bg-indigo-100 hover:text-indigo-600 transform hover:-translate-y-1 active:bg-indigo-600 active:text-white" data-tooltip="Logout" onclick="setActive(this)">
          <i class="bx bx-log-in-circle"></i>
        </div>
      </div>
      <div class="flex-1 p-6">
        <div class="flex flex-col gap-4">
          <div class="bg-white p-4 rounded-lg flex justify-between items-center shadow-md">
            <h1 class="text-2xl font-semibold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-indigo-400">Dashboard</h1>
            <div class="bg-gray-100 rounded-lg p-2 flex items-center gap-2 w-64 transition-all duration-300 border-2 border-transparent focus-within:border-indigo-600 focus-within:bg-white focus-within:shadow-outline">
              <span>🔍</span>
              <input type="text" placeholder="Search" class="border-none bg-transparent outline-none text-sm w-full text-gray-800" />
            </div>
          </div>

          <div class="flex gap-4">
            <div class="bg-white p-2 rounded-lg shadow-md transition-all duration-300 relative overflow-hidden hover:transform hover:-translate-y-1 hover:shadow-lg w-1/5">
              <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-600 to-indigo-400"></div>
              <h3 class="text-gray-500 text-sm mb-2 font-medium">Total Revenue</h3>
              <div class="text-lg font-semibold text-gray-800 flex items-baseline gap-2">
                $1200
                <span class="text-sm text-green-500 font-medium p-1 bg-green-100 rounded">+45%</span>
              </div>
            </div>
            <div class="bg-white p-2 rounded-lg shadow-md transition-all duration-300 relative overflow-hidden hover:transform hover:-translate-y-1 hover:shadow-lg w-1/5">
              <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-600 to-indigo-400"></div>
              <h3 class="text-gray-500 text-sm mb-2 font-medium">Listed Products</h3>
              <div class="text-lg font-semibold text-gray-800 flex items-baseline gap-2">
                4.500K
                <span class="text-sm text-green-500 font-medium p-1 bg-green-100 rounded">+45%</span>
              </div>
            </div>
            <div class="bg-white p-2 rounded-lg shadow-md transition-all duration-300 relative overflow-hidden hover:transform hover:-translate-y-1 hover:shadow-lg w-1/5">
              <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-600 to-indigo-400"></div>
              <h3 class="text-gray-500 text-sm mb-2 font-medium">Reports</h3>
              <div class="text-lg font-semibold text-gray-800 flex items-baseline gap-2">
                6.100k
                <span class="text-sm text-green-500 font-medium p-1 bg-green-100 rounded">+45%</span>
              </div>
            </div>
            <div class="bg-white p-2 rounded-lg shadow-md transition-all duration-300 relative overflow-hidden hover:transform hover:-translate-y-1 hover:shadow-lg w-1/5">
              <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-600 to-indigo-400"></div>
              <h3 class="text-gray-500 text-sm mb-2 font-medium">Total Users</h3>
              <div class="text-lg font-semibold text-gray-800 flex items-baseline gap-2">
                1.2K
                <span class="text-sm text-green-500 font-medium p-1 bg-green-100 rounded">+10%</span>
              </div>
            </div>
          </div>
          <div class="flex gap-4">
            <div class="relative flex flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md w-1/2">
              <div class="relative mx-4 mt-4 flex flex-col gap-4 overflow-hidden rounded-none bg-transparent bg-clip-border text-gray-700 shadow-none md:flex-row md:items-center justify-between">
                <div>
                  <h6 class="block font-sans text-base font-semibold leading-relaxed tracking-normal text-blue-gray-900 antialiased">Transaction Overview</h6>
                  <p class="block max-w-sm font-sans text-sm font-normal leading-normal text-gray-700 antialiased"></p>
                </div>
                <div class="relative">
                  <button class="text-gray-500 hover:text-gray-700 focus:outline-none" onclick="toggleDropdown('dropdown1')">
                    <i class="bx bx-dots-horizontal-rounded text-xl"></i>
                  </button>
                  <div id="dropdown1" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Daily</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Weekly</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Monthly</a>
                  </div>
                </div>
              </div>
              <div class="pt-6 px-2 pb-0">
                <div id="line-chart"></div>
              </div>
            </div>
            <div class="relative flex flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md w-1/2">
              <div class="relative mx-4 mt-4 flex flex-col gap-4 overflow-hidden rounded-none bg-transparent bg-clip-border text-gray-700 shadow-none md:flex-row md:items-center justify-between">
                <div>
                  <h6 class="block font-sans text-base font-semibold leading-relaxed tracking-normal text-blue-gray-900 antialiased">User Registrations</h6>
                  <p class="block max-w-sm font-sans text-sm font-normal leading-normal text-gray-700 antialiased"></p>
                </div>
                <div class="relative">
                  <button class="text-gray-500 hover:text-gray-700 focus:outline-none" onclick="toggleDropdown('dropdown2')">
                    <i class="bx bx-dots-horizontal-rounded text-xl"></i>
                  </button>
                  <div id="dropdown2" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Daily</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Weekly</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Monthly</a>
                  </div>
                </div>
              </div>
              <div class="pt-6 px-2 pb-0">
                <div id="bar-chart"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
      function toggleDropdown(id) {
        const dropdown = document.getElementById(id);
        dropdown.classList.toggle('hidden');
      }

      document.addEventListener('click', function(event) {
        const dropdowns = ['dropdown1', 'dropdown2'];
        dropdowns.forEach(id => {
          const dropdown = document.getElementById(id);
          const button = dropdown.previousElementSibling;
          if (!button.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
          }
        });
      });

      const lineChartConfig = {
        series: [
          {
            name: "Transactions",
            data: [50, 40, 300, 320, 500, 350, 200, 230, 500],
          },
        ],
        chart: {
          type: "line",
          height: 240,
          toolbar: {
            show: false,
          },
        },
        title: {
          show: "",
        },
        dataLabels: {
          enabled: false,
        },
        colors: ["#020617"],
        stroke: {
          lineCap: "round",
          curve: "smooth",
        },
        markers: {
          size: 0,
        },
        xaxis: {
          axisTicks: {
            show: false,
          },
          axisBorder: {
            show: false,
          },
          labels: {
            style: {
              colors: "#616161",
              fontSize: "12px",
              fontFamily: "inherit",
              fontWeight: 400,
            },
          },
          categories: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        },
        yaxis: {
          labels: {
            style: {
              colors: "#616161",
              fontSize: "12px",
              fontFamily: "inherit",
              fontWeight: 400,
            },
          },
        },
        grid: {
          show: true,
          borderColor: "#dddddd",
          strokeDashArray: 5,
          xaxis: {
            lines: {
              show: true,
            },
          },
          padding: {
            top: 5,
            right: 20,
          },
        },
        fill: {
          opacity: 0.8,
        },
        tooltip: {
          theme: "dark",
        },
      };

      const barChartConfig = {
        series: [
          {
            name: "User Registrations",
            data: [30, 50, 80, 120, 150, 200, 250, 300, 350],
          },
        ],
        chart: {
          type: "bar",
          height: 240,
          toolbar: {
            show: false,
          },
        },
        title: {
          show: "",
        },
        dataLabels: {
          enabled: false,
        },
        colors: ["#020617"],
        plotOptions: {
          bar: {
            columnWidth: "40%",
            borderRadius: 2,
          },
        },
        xaxis: {
          axisTicks: {
            show: false,
          },
          axisBorder: {
            show: false,
          },
          labels: {
            style: {
              colors: "#616161",
              fontSize: "12px",
              fontFamily: "inherit",
              fontWeight: 400,
            },
          },
          categories: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        },
        yaxis: {
          labels: {
            style: {
              colors: "#616161",
              fontSize: "12px",
              fontFamily: "inherit",
              fontWeight: 400,
            },
          },
        },
        grid: {
          show: true,
          borderColor: "#dddddd",
          strokeDashArray: 5,
          xaxis: {
            lines: {
              show: true,
            },
          },
          padding: {
            top: 5,
            right: 20,
          },
        },
        fill: {
          opacity: 0.8,
        },
        tooltip: {
          theme: "dark",
        },
      };

      const lineChart = new ApexCharts(document.querySelector("#line-chart"), lineChartConfig);
      lineChart.render();

      const barChart = new ApexCharts(document.querySelector("#bar-chart"), barChartConfig);
      barChart.render();
    </script>
  </body>
</x-adminLayout2>