@foreach(json_decode($order->cart, true) as $item)
  <li>
    {{ $item['name'] }} (x{{ $item['qty'] }}) - 
    ₹{{ $item['discounted_price'] ?? $item['actual_price'] }} each
    → Subtotal: ₹{{ ($item['discounted_price'] ?? $item['actual_price']) * $item['qty'] }}
  </li>
@endforeach
