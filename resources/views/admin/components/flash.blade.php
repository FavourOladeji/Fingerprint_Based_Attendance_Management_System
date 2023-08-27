@if (session()->has('flash_message'))
    {{-- @dd('here') --}}
    <script>
        toastr.options = {
            timeOut: 3000,
            progressBar: true,
            showMethod: "slideDown",
            hideMethod: "slideUp",
            showDuration: 200,
            hideDuration: 200,
            "preventDuplicates": true
        };

        // toastr.success('Successfully completed');
        toastr.{{ session('flash_message.level') }}("{{ session('flash_message.message') }}");
    </script>
@endif

<script>
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script>
