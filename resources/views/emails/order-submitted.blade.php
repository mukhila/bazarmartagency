{{-- resources/views/emails/order-submitted.blade.php --}}

{{-- Debugging --}}
{{-- dd($payload); --}}

{{-- resources/views/emails/order-submitted.blade.php --}}

<h2>New Order</h2>

<p><strong>Name:</strong> {{ $payload['customer']['name'] ?? '-' }}</p>
<p><strong>Phone:</strong> {{ $payload['customer']['phone'] ?? '-' }}</p>
<p><strong>Email:</strong> {{ $payload['customer']['email'] ?? '-' }}</p>
<p><strong>Address:</strong> {{ $payload['customer']['address'] ?? '-' }}</p>

<hr>

<h3>Items</h3>
<table border="1" cellpadding="6" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th align="left">Product</th>
        <th align="right">Qty</th>
        <th align="right">Price</th>
        <th align="right">Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($payload['items'] as $it)
        <tr>
            <td>
                {{-- Product name may not exist, so fallback to product_id --}}
                {{ $it['name'] ?? 'Product #' . $it['product_id'] }}
            </td>
            <td align="right">{{ $it['quantity'] }}</td>
            <td align="right">₹{{ number_format($it['price'], 2) }}</td>
            <td align="right">
                ₹{{ number_format(($it['price'] * $it['quantity']), 2) }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<p><strong>Total Products:</strong> {{ $payload['totals']['total_products'] }}</p>
<p><strong>Total Amount:</strong> ₹{{ number_format($payload['totals']['total_amount'], 2) }}</p>
<p><strong>Savings:</strong> ₹{{ number_format($payload['totals']['total_savings'], 2) }}</p>
<p><strong>Order Date:</strong> {{ $payload['order_date'] ?? now() }}</p>
