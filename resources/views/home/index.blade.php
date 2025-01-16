@extends('/layouts/main')

@push('css-dependencies')
<link rel="stylesheet" type="text/css" href="/css/home.css" />
    @can('is_admin')
        <!-- Include DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
        <style>
            #timezone-clocks {
                position: fixed;
                bottom: 0;
                width: 100%;
                background-color: #343a40; /* Dark background */
                color: white;
                text-align: center;
                padding: 10px;
                font-size: 16px;
                z-index: 1000; /* Ensure it's above other content */
                box-shadow: 0px -2px 5px rgba(0, 0, 0, 0.1); /* Optional shadow for effect */
                display: flex;
                justify-content: space-evenly;
            }
        
            .timezone-clock {
                font-family: 'Courier New', Courier, monospace;
            }
        </style>
    @endcan
@endpush

@can('is_admin')
@push('scripts-dependencies')
<script src="/js/sales_chart.js"></script>
<script src="/js/profits_chart.js"></script>
<script src="/js/income_chart.js"></script>
<script src="/js/outcome_chart.js"></script>
<script src="/js/best_seller_chart.js"></script>
@endpush
@endcan

@section('content')

<div class="mx-3">
    @if(session()->has('message'))
    {!! session("message") !!}
    @endif
</div>

@can('is_admin')
    @include('/partials/home/home_admin')
@elsecan('is_supplier')
    @yield('content')
@else
    @include('/partials/home/home_customers')
@endcan
@endsection