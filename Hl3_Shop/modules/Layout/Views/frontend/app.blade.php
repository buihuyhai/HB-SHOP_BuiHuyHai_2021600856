@extends("Layout::frontend.index")

@section("body")

<!-- Begin Body Wrapper -->
<div class="body-wrapper">

    <!-- Begin Header Area -->
    @include("Layout::frontend.parts.header")
    <!-- Header Area End Here -->

    @yield("content")

    <!-- Begin Footer Area -->
    @include("Layout::frontend.parts.footer")
    <!-- Footer Area End Here -->

</div>
<!-- Body Wrapper End Here -->
@endsection
