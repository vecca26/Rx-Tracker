@extends('layouts.app')
@section('content')
<div class="container brandlist-page">
    <div class="row pl-3 pr-3">
        <div class="col-md-6">
            <form class="form-inline">
                <a class="brand-title">Manage Notifications</a>
                <div class="input-group">
                    <input class="form-control" type="search" placeholder="Search by Name" aria-label="Search">
                    <button type="button" class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
            </form>
        </div>
        <div class="col-md-1"></div>

    </div>
    <div class="brand-list-content">
        <div class="card mt-3">
            <div class="brandlist-table table-responsive">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="col-md-2">S.NO</th>
                            <th scope="col" class="col-md-5">Title</th>
                            <th scope="col" class="col-md-3">Date</th>
                            <th scope="col" class="col-md-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($notifications->count() > 0)
                        @foreach($notifications as $key=> $value)
                        <tr>
                            <td>{{ (($notifications->currentPage() - 1 ) * $notifications->perPage() ) + $loop->iteration }}</td>
                            <td>{{ isset($value->description) ? $value->description : '-' }}</td>
                            <td>{{ isset($value->created_at) ? date('d-m-Y', strtotime($value->created_at)) : '-' }}</td>
                            <td class="actions">
<!--                                 <a href="{{ Route('notifications.edit' ,encrypt($value->id) ) }}">
                                    
                                    <button type="button" class="edit"><img src="images/icons/edit.svg"></button>
                                </a> -->

                                <span>
                                    <button onclick=deleteNotifications({{ $value->id }}) class="delete"><img src="images/icons/delete.svg"></button>
                                </span>



                                <button type="button" class="add"><img src="images/icons/add.svg"></button>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="btn-notification-add">
                    <a href="{{ Route('notifications.create') }}" class="btn btn-orange">Create Notification</a>
                </div>
                {{ $notifications->render() }}
            </div>
        </div>

        <!-- <div class="row dataTables_info justify-content-between" id="showingBrandEntries">
            <div class="col-md-3">
                <div class="listed-pages">

                    <p>Showing 1 - 10 out of 50</p>
                </div>
            </div>
            <div class="col-md-3 pagintion">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div> -->
    </div>
</div>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>

<script type="text/javascript">
    let token = "{{ csrf_token() }}";
  
    function deleteNotifications(id) {
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this !",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    (function($) {
                    $.ajax({
                        type: "DELETE",
                        url: '/notifications/destroy',
                        async: true,
                        data: {
                            '_token': token,
                            'id': id
                        },
                        success: function(response) {
                            if (response) {
                                if (response == "Success") {
                                    swal("Success!", "Notifications deleted successfully.", "success", {
                                        button: "Ok",
                                    }).then(function() {
                                        window.location.reload();
                                    });
                                }
                                if (response == "Error") {
                                    swal("Error!", "Error deleting Notifications!.", "error", {
                                        button: "Ok",
                                    })
                                }
                            } else {
                                console.log("Error");
                            }
                        }
                    });
                     })(jQuery);
                } else {
                    swal("Cancelled!", "You cancelled the operation.", "error", {
                        button: "Ok",
                    })
                }
            });
    }
</script>
@endpush