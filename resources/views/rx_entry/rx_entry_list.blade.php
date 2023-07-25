@extends('layouts.app')
@section('content')
<div class="container datalisting-page mt-4">
    <div class="row pl-3 pr-3">
        <div class="col-md-12">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <a class="brand-title">Rx Entries</a>
                        </div>
                        <div class="col-md-7">
                            <form class="mt-3">
                                <div class="form-group">
                                    <select id="brand_id" name="brand_id" class="form-select">
                                        <option value="">Choose Brands</option>
                                        @foreach($brand_list as $key=> $value)
                                        <option value="{{$value->brands->id}}">{{$value->brands->brand_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 data-brand-names">
                    <ul>
                        @foreach($brand_list as $key=> $value)
                        <li>
                            <form method="GET" action="{{ url('fetch_brandwise_rx') }}">
                            @csrf
                            <input type="hidden" value="{{$value->brands->id}}" id="brand_id" name="brand_id">
                            <input type="submit" class="btn btn-outline-dark active" value="{{ $value->brands->brand_name }}">
                            <!-- <a href="#"  class="btn btn-outline-dark active">{{ $value->brands->brand_name }}</a> -->
                            </form>

                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="brand-list-content">
        <div class="card mt-3">
            @if( Session::has("success") )
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ Session::get("success") }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if( Session::has("error") )
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ Session::get("error") }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="datalist-table table-responsive">
                <div id="list_table">
                    @include('rx_entry.rx_entry_list_table')
                </div>
            </div>
            {{ $rx_entry->render() }}
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
    let token = "{{csrf_token()}}";
    (function($) {
        $('#brand_id').on('change', function(e) {
            $.ajax({
                type: "get",
                url: "{{url('/fetch_brandwise_rx')}}",
                // url: '/fetch_brandwise_rx',
                async: true,
                data: {
                    _token: token,
                    brand_id: $('#brand_id').val()
                },
                success: function(response) {
                    $('#list_table').html(response);
                },
                error: function(error_message) {
                    console.log(error_message);
                }
            });
        });
    })(jQuery);
</script>

@endsection