@if ($message = Session::get('success'))

<script>
    console.log('çalıştı');
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
    Toast.fire({
          icon: 'success',
          title: {{''.$message.'' }}
        });
</script>

@endif

@if ($message = Session::get('error'))

<script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
    Toast.fire({
          icon: 'error',
          title: {{ $message }}
        });
</script>
@endif

@if ($message = Session::get('warning'))

<script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
    Toast.fire({
          icon: 'warning',
          title: {{ $message }}
        });
</script>
@endif

@if ($message = Session::get('info'))
<script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
    Toast.fire({
          icon: 'info',
          title: {{ $message }}
        });
</script>
@endif

@if ($errors->any())


@endif

@section('scriptAdd')


@endsection
