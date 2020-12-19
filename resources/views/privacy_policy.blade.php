@extends('layouts.master')
@section('content')
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{ url('/') }}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Privacy policy</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<div class="row m-t-25">
    <div class="col-lg-12">
        <p class="not_found">
            404, Page not found!
        </p>
    </div>
</div>

<!-- /.container-fluid-->
@endsection

@section('js')
<script type="text/javascript">


</script>
@endsection