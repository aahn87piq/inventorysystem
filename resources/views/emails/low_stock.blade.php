@component('mail::message')
# Daily Low Stock Report

@foreach ($report as $item)
    - **{{ $item['Product Name'] }} ({{ $item['SKU'] }})**
    Quantity: {{ $item['Current Quantity'] }}
    Minimum: {{ $item['Minimum Required'] }}
    Warehouse: {{ $item['Warehouse'] }}
    Country: {{ $item['Country'] }}
    Supplier: {{ $item['Supplier Contact'] ?? 'N/A' }}

@endforeach

Thanks,
{{ config('app.name') }}
@endcomponent
