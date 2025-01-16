<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title }} Page</title>
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
  @include('/partials/main_css')
  @stack('css-dependencies')
  
</head>
<style>
  #timezone-clocks {
    position: fixed;
    bottom: 0;
    width: 100%;
    background-color: #343a40;
    color: white;
    text-align: center;
    padding: 10px;
    font-size: 16px;
    z-index: 1000;
    display: flex;
    justify-content: space-evenly;
}

.timezone-clock {
    font-family: 'Courier New', Courier, monospace;
}
</style>

<style>
  #timezone-clocks {
    position: fixed;
    bottom: 0;
    width: 100%;
    background-color: #343a40;
    color: white;
    text-align: center;
    padding: 10px;
    font-size: 16px;
    z-index: 1000;
    display: flex;
    justify-content: space-evenly;
}
.timezone-clock {
    font-family: 'Courier New', Courier, monospace;
}
</style>

<body class="sb-nav-fixed">
  <div id="loading" style="display: none"></div>
  {{-- topbar --}}
  @include('/partials/topbar')
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      {{-- sidebar --}}
      @include('/partials/sidebar')
    </div>
    <div id="layoutSidenav_content">
      {{-- content --}}
      @yield("content")
      {{-- footer --}}
      @include('/partials/footer')
    </div>
  </div>

  @stack('modals-dependencies')

  @can('is_admin')
  <!-- Clock for Admin -->
  <div id="timezone-clocks">
      <div class="timezone-clock">
          <span id="clock-jakarta"></span> <small>(Jakarta)</small>
      </div>
      <div class="timezone-clock">
          <span id="clock-newyork"></span> <small>(New York)</small>
      </div>
      <div class="timezone-clock">
          <span id="clock-japan"></span> <small>(Japan)</small>
      </div>
  </div>
  @endcan

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
  </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="/js/datatables-simple.js"></script>

  <script src="/js/scripts.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  @stack('scripts-dependencies')

  @can('is_admin')
    <script>
        async function fetchTimeWithOffset(timezone, elementId) {
            try {
                const response = await fetch(`https://worldtimeapi.org/api/timezone/${timezone}`);
                if (response.ok) {
                    const data = await response.json();
                    const currentTime = new Date(data.datetime);
                    const offset = data.utc_offset;
                    const clockElement = document.getElementById(elementId);
                    clockElement.dataset.initialTime = currentTime.getTime();
                    clockElement.dataset.offset = offset;
                }
            } catch (error) {
                console.error("Error fetching time:", error);
            }
        }
        function updateClocks() {
            const clockElements = document.querySelectorAll("[id^=clock-]");
            clockElements.forEach((clockElement) => {
                const initialTime = parseInt(clockElement.dataset.initialTime, 10);
                const offset = clockElement.dataset.offset;
                if (!initialTime || !offset) return;
                const offsetInMs = parseOffsetToMs(offset);
                const now = new Date().getTime();
                const adjustedTime = new Date(initialTime + offsetInMs + (now - initialTime));
                const formattedTime = adjustedTime.toLocaleTimeString("en-US", { hour12: false });
                clockElement.textContent = formattedTime;
            });
        }
        function parseOffsetToMs(offset) {
            const sign = offset.startsWith("-") ? -1 : 1;
            const [hours, minutes] = offset.slice(1).split(":").map(Number);
            return sign * ((hours * 60 + minutes) * 60 * 1000);
        }
        async function initializeClocks() {
            await fetchTimeWithOffset("Asia/Jakarta", "clock-jakarta");
            await fetchTimeWithOffset("America/New_York", "clock-newyork");
            await fetchTimeWithOffset("Asia/Tokyo", "clock-japan");
            updateClocks();
            setInterval(updateClocks, 1000);
        }
        initializeClocks();
    </script>
  @endcan
</body>

</html>