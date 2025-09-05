@extends('layouts.users')



@section('content')

@endsection


@push('script')
    <script type="text/javascript">
        var text = '{{ route('home') }}?invite_code={{ auth()->user()->ref_code }}';
        $('.btncopy').click(function() {
            copy(text)
        });
    </script>
@endpush
