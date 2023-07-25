@extends('layouts.app')
@section('content')
               <div class="container teamlist-page">
                     <div class="row pl-3 pr-3">
                        <a class="brand-title">Teams</a>

                    </div>
                    <div class="row pl-3 pr-3">
                        <div class="col-md-8 mt-4">
                           <!--  <form class="form-inline">
                                <a class="brand-title">Manage Teams</a>

                                <div class="input-group">

                                    <input class="form-control mr-2" type="text" placeholder="Area Manager">
                                </div>
                                <div class="input-group">

                                    <input class="form-control" type="search" placeholder="Regional Manager"
                                        aria-label="Search">
                                    <button type="button" class="input-group-text"><i class="fa fa-search"
                                            aria-hidden="true"></i></button>
                                </div>
                            </form> -->

                        </div>
                       <!--  <div class="col-md-4 d-flex align-items-end">
                           <a href="admin-manage-team-detail.html"><button type="button" class="btn btn-dark">Form Team
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </button></a> 
                            <button type="button" class="btn btn-orange" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Add Team
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </button>
                            <form class="dropdown-menu  dropdown-menu-right p-3">
                                <div class="form-group">
                                    <label for="regionName">Enter Team Name</label>
                                    <input type="email" class="form-control" id="exampleDropdownFormEmail2"
                                        placeholder="Enter Region">
                                </div>

                                <div class="add-rx-btn">
                                    <button type="submit" class="btn btn-warning">ADD</button>
                                </div>
                            </form>
                        </div> -->
                    </div>
                    <div class="brand-list-content2">
                        <div class="card mt-3">
                            <div class="brandlist-table table-responsive">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col" class="col-md-1">S.No</th>
                                            <th scope="col" class="col-md-1">Team</th>
                                            <th scope="col" class="col-md-2">Total members</th>
                                            <th scope="col" class="col-md-3">Total Brands</th>
                                            <th scope="col" class="col-md-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($team_list as $key => $value)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$value->team}}</td>
                                            <td>{{$value->member_count}}</td>
                                            <td>{{$value->brand_count}}</td>
                                            <td class="actions">
                                                <button class="teamView" type="button"><a href="{{url('teams/' . encrypt($value->id)).'/edit' }}" class="teamView"><svg width="25" height="18" viewBox="0 0 25 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M23.9128 8.28773C21.2956 2.77454 17.3395 0 12.0361 0C6.72997 0 2.7766 2.77454 0.159419 8.29049C0.0544435 8.51278 0 8.75555 0 9.00138C0 9.24721 0.0544435 9.48998 0.159419 9.71227C2.7766 15.2255 6.73273 18 12.0361 18C17.3422 18 21.2956 15.2255 23.9128 9.70951C24.1254 9.26227 24.1254 8.74325 23.9128 8.28773V8.28773ZM12.0361 16.0123C7.58304 16.0123 4.32261 13.754 2.02292 9C4.32261 4.24601 7.58304 1.98773 12.0361 1.98773C16.4892 1.98773 19.7496 4.24601 22.0493 9C19.7524 13.754 16.4919 16.0123 12.0361 16.0123ZM11.9257 4.1411C9.24224 4.1411 7.06678 6.31656 7.06678 9C7.06678 11.6834 9.24224 13.8589 11.9257 13.8589C14.6091 13.8589 16.7846 11.6834 16.7846 9C16.7846 6.31656 14.6091 4.1411 11.9257 4.1411ZM11.9257 12.092C10.2168 12.092 8.83365 10.7089 8.83365 9C8.83365 7.2911 10.2168 5.90798 11.9257 5.90798C13.6346 5.90798 15.0177 7.2911 15.0177 9C15.0177 10.7089 13.6346 12.092 11.9257 12.092Z" fill="#818181"/>
                                                        </svg></a></button>
                                            </td>
                                        </tr>
                                         @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                       
                    </div>
                </div>
 @endsection

@push('scripts')

    
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
   
    <script>
        $(function () {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function (start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' +
                    end.format('YYYY-MM-DD'));
            });
        });
    </script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'click'
            })
        })
    </script>
@endpush