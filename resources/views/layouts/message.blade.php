@if(!empty(session()->has('success')))
    <script>
        $(document).ready(function () {
            $.toast({
                text: '{{ session()->get('success') }}',
                icon: 'success',
                position: 'top-right'
            })
        })
    </script>
@endif
@if(!empty($errors->any()))
    @foreach ($errors->all() as $error)
        <script>
            $(document).ready(function () {
                $.toast({
                    text: '{{$error}}',
                    icon: 'error',
                    position: 'top-right'
                })
            })
        </script>
    @endforeach
@endif
