@extends('layouts.app')
@section('content')
  <div class="container areamanage-page">
                    <div class="row pl-3 pr-3">
                        <a class="brand-title">Team Detail</a>

                    </div>
                    <div class="brand-list-content">
                        <div class="card mt-3">
                            <div class="team-detail p-4">
                            <form class="form-inline" method='post' action="{{route('teams.search')}}">
                                @csrf
                                <div class="input-group">
                                    <label for="members" class="tm-members pr-1">All Members</label>
                                    <input type="text" name="daterange" class="form-control"
                                        value="" placeholder="dd-mm-yy"/>
                                    <button type="button" class="input-group-text mr-2">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>

                                    </button>
                                </div>
                                <div class="input-group">
                                    <!-- <label for="members" class="tm-members pr-1">Total 257</label> -->

                                    <input type="text" name="keyword" id="keyword" class="form-control" type="search" placeholder="Search Team"
                                        aria-label="Search">
                                         <input type="hidden" name="team_id" value="{{$search_id}}">
                                    <button type="submit" class="input-group-text"><i class="fa fa-search"
                                            aria-hidden="true"></i></button>
                                </div>
                            </form>
                            </div>
                            <div class="brandlist-table table-responsive">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col" class="col-md-1">S.NO</th>
                                            <th scope="col" class="col-md-2">Members Name</th>
                                            <th scope="col" class="col-md-2">Employee id</th>
                                            <th scope="col" class="col-md-3">Email</th>
                                            <th scope="col" class="col-md-2">Phone</th>
                                            <th scope="col" class="col-md-3">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach ($userData as $key => $value)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$value->first_name}} {{$value->last_name}}</td>
                                            <td>{{$value->employee_id}}</td>
                                            <td>{{$value->email}}</td>
                                            <td>{{$value->phone}}</td>
                                            <td class="actions">
                                              
                                                <button type="button" class="btn btn-blank delete" id="{{$value->user_id}}"><svg width="19" height="20"
                                                        viewBox="0 0 19 20" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M9.1358 6.88907e-09C9.95569 -5.36758e-05 10.7445 0.313634 11.3405 0.876713C11.9364 1.43979 12.2943 2.20957 12.3407 3.02815L12.3457 3.20988H17.5309C17.7185 3.20993 17.8992 3.28123 18.0363 3.40936C18.1735 3.53748 18.2569 3.71289 18.2697 3.90013C18.2824 4.08737 18.2237 4.27249 18.1053 4.41807C17.9868 4.56366 17.8175 4.65886 17.6316 4.68444L17.5309 4.69136H16.7447L15.4805 17.5506C15.4172 18.1917 15.128 18.7894 14.6647 19.237C14.2013 19.6846 13.594 19.9529 12.9511 19.9941L12.7773 20H5.49432C4.84984 20 4.22636 19.7708 3.73531 19.3534C3.24427 18.936 2.91765 18.3575 2.81383 17.7215L2.79111 17.5496L1.52593 4.69136H0.740741C0.561741 4.69135 0.388798 4.62653 0.253896 4.50887C0.118993 4.39122 0.0312576 4.2287 0.00691355 4.05136L0 3.95062C7.54854e-06 3.77162 0.0648322 3.59867 0.182486 3.46377C0.30014 3.32887 0.462663 3.24113 0.64 3.21679L0.740741 3.20988H5.92593C5.92593 2.35856 6.26411 1.54212 6.86608 0.940151C7.46805 0.338182 8.28449 6.88907e-09 9.1358 6.88907e-09ZM15.2563 4.69136H3.01432L4.26568 17.4044C4.29339 17.6881 4.41839 17.9535 4.61948 18.1554C4.82057 18.3574 5.08535 18.4836 5.36889 18.5126L5.49432 18.5185H12.7773C13.3699 18.5185 13.8726 18.0988 13.9872 17.5289L14.0069 17.4044L15.2553 4.69136H15.2563ZM10.8642 7.40741C11.0432 7.40741 11.2161 7.47224 11.351 7.58989C11.4859 7.70755 11.5737 7.87007 11.598 8.04741L11.6049 8.14815V15.0617C11.6049 15.2494 11.5336 15.4301 11.4055 15.5672C11.2773 15.7043 11.1019 15.7877 10.9147 15.8005C10.7274 15.8133 10.5423 15.7546 10.3967 15.6361C10.2512 15.5177 10.156 15.3484 10.1304 15.1625L10.1235 15.0617V8.14815C10.1235 7.95169 10.2015 7.76328 10.3404 7.62437C10.4793 7.48545 10.6677 7.40741 10.8642 7.40741ZM7.40741 7.40741C7.58641 7.40741 7.75935 7.47224 7.89425 7.58989C8.02915 7.70755 8.11689 7.87007 8.14123 8.04741L8.14815 8.14815V15.0617C8.14809 15.2494 8.0768 15.4301 7.94867 15.5672C7.82054 15.7043 7.64514 15.7877 7.4579 15.8005C7.27066 15.8133 7.08554 15.7546 6.93995 15.6361C6.79436 15.5177 6.69916 15.3484 6.67358 15.1625L6.66667 15.0617V8.14815C6.66667 7.95169 6.74471 7.76328 6.88363 7.62437C7.02254 7.48545 7.21095 7.40741 7.40741 7.40741ZM9.1358 1.48148C8.70203 1.4815 8.28413 1.64461 7.96505 1.93845C7.64596 2.23229 7.44903 2.63536 7.41333 3.06765L7.40741 3.20988H10.8642C10.8642 2.75148 10.6821 2.31185 10.358 1.98772C10.0338 1.66358 9.5942 1.48148 9.1358 1.48148Z"
                                                            fill="#818181" />
                                                    </svg>
                                                </button>
                                                <button type="button" class="add"><a href="{{url('teams/' . encrypt($value->user_id)) }}"><svg width="25" height="18" viewBox="0 0 25 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M23.9128 8.28773C21.2956 2.77454 17.3395 0 12.0361 0C6.72997 0 2.7766 2.77454 0.159419 8.29049C0.0544435 8.51278 0 8.75555 0 9.00138C0 9.24721 0.0544435 9.48998 0.159419 9.71227C2.7766 15.2255 6.73273 18 12.0361 18C17.3422 18 21.2956 15.2255 23.9128 9.70951C24.1254 9.26227 24.1254 8.74325 23.9128 8.28773V8.28773ZM12.0361 16.0123C7.58304 16.0123 4.32261 13.754 2.02292 9C4.32261 4.24601 7.58304 1.98773 12.0361 1.98773C16.4892 1.98773 19.7496 4.24601 22.0493 9C19.7524 13.754 16.4919 16.0123 12.0361 16.0123ZM11.9257 4.1411C9.24224 4.1411 7.06678 6.31656 7.06678 9C7.06678 11.6834 9.24224 13.8589 11.9257 13.8589C14.6091 13.8589 16.7846 11.6834 16.7846 9C16.7846 6.31656 14.6091 4.1411 11.9257 4.1411ZM11.9257 12.092C10.2168 12.092 8.83365 10.7089 8.83365 9C8.83365 7.2911 10.2168 5.90798 11.9257 5.90798C13.6346 5.90798 15.0177 7.2911 15.0177 9C15.0177 10.7089 13.6346 12.092 11.9257 12.092Z" fill="#818181"/>
                                                        </svg></a></button>
                                            </td>
                                        </tr>
                                         @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class='col-12'>{{ $userData->links() }}</div>
                        </div>
                       
                    </div>
                </div>
                 @endsection
                 @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="js/dashboard.js"></script>
    <script>
        $(function () {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function (start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' +
                    end.format('YYYY-MM-DD'));
               
            });
        });
  
        $(function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'click'
            })
        })
   
  $(".delete").click(function(){
    var deleteConfirm = confirm('Are you sure to delete user');
    if(deleteConfirm){
         let token = "{{csrf_token()}}";
            var id = this.id;
    $.ajax({
                type: "delete",
                url: '/delete_manager',
                async: true,
                data: {
                    _token: token,
                      user_id: id
                },
                success: function(response) {   console.log(response.success);
                     if (response.success == '1') {
                        alert("deleted");
                        location.reload();
                     }
                }
            });
    }

  });
  </script>
@endpush