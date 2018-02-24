


<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="frmTransaction" id="frmTransaction">
    <input type="hidden" name="business" value="Blueskymgmnt@gmail.com">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" value="{{$product->name}}">
    <input type="hidden" name="item_number" value="{{$product->id}}">
    <input type="hidden" name="amount" value="{{$product->price}}">
{{--  <input type="text" name="currency_code" value="USD">--}}
    <input type="hidden" name="cancel_return" value="http://127.0.0.1:8000/cancel">
<input type="hidden" name="return" value="http://127.0.0.1:8000/payment-status">
</form>





    <script>
        document.frmTransaction.submit();
    </script>

