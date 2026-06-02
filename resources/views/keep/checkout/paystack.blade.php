@if($paystack->isActive())
<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var handler = PaystackPop.setup({
            key: '{{ $paystack->getPublicKey() }}',
            email: '{{ Auth::guard("customer")->user()->email }}',
            amount: {{ intval($order->total * 100) }},
            currency: "NGN",
            ref: '{{ $order->order_no }}',
            callback: function(response){
                window.location.href = "{{ route('paystack.callback', $order->id) }}?reference=" + response.reference;
            },
            onClose: function(){
                alert('Payment window closed.');
            }
        });

        handler.openIframe();
    });
</script>
@endif
