@extends('layouts.poapp')
@section('content')
<div class="container datalisting-page mt-4">
    <div class="row pl-3 pr-3">
        <div class="col-md-12">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <a class="brand-title">Institutes</a>
                        </div>
                        <div class="col-md-7">
                            <form class="mt-3">
                                <div class="form-group">
                                    <select id="ins_id" name="ins_id" onchange="getval(this);" class="form-select">
                                        <option value="">Choose Institute</option>
                                        @foreach($institutes as $key=> $value)
                                        <option value="{{$value->id}}">{{$value->institute_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
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
                    @include('po_entry.podetails')
                </div>
            </div>
            {{ $po_entry->render() }}
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