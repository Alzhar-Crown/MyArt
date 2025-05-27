<form id="autoSubmitForm" action="{{ route('cart.co1') }}" method="POST">
    @csrf
    <input type="hidden" name="catalog_ids" value="{{ $id  }}">
</form>

<script>
    window.onload = function() {
        document.getElementById('autoSubmitForm').submit();
    }
</script>
