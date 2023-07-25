@extends('layouts.app')
@section('content')
        <div class="container brandlist-page">

                    <div class="row pl-3 pr-3">
                        <div class="col-md-9">
                             @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                           @endif
                            <form class="form-inline" method='post' action="{{route('brand_manager.search')}}">
                                @csrf
                                <a class="brand-title">Manage Brand Managers</a>
                                <div class="input-group">

                                    <input class="form-control" type="search" placeholder="Search by Name, Brand"
                                        aria-label="Search" name="keyword" id="keyword">
                                    <button type="submit" class="input-group-text"><i class="fa fa-search"
                                            aria-hidden="true"></i></button>
                                </div>
                            </form>

                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-2 top-section">
                            <div class="btn-group">
                                  <div class="btn-group">
                                <a class="btn btn-warning" href="{{url('brand_manager/').'/create' }}">ADD NEW</a>
                               
                              </div>                     

                               
                                 <div class="modal fade bd-example-modal-lg" id="brandManagerEdit" tabindex="-1" role="dialog"
                                    aria-labelledby="brandManagerEditLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Brand Manager</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method='post' action="{{route('brand_manager.edit')}}">
                                               @csrf
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="">Enter First Name</label>
                                                        <input type="text" class="form-control" name="first_names" id="first_names"
                                                            placeholder="First Name" required>
                                                    </div>
                                                      <div class="form-group col-md-6">
                                                        <label for="">Enter Last Name</label>
                                                        <input type="text" class="form-control" name="last_names" id="last_names"
                                                            placeholder="Last Name" required>
                                                    </div>
                                                </div>
                                                <!-- <div class="form-row">
                                                      <div class="form-group col-md-6">
                                                        <label for="">Email</label>
                                                        <input type="email" class="form-control" id="emails" name="emails"
                                                            placeholder="Enter Email" required>
                                                    </div>
                                                      <div class="form-group col-md-6">
                                                        <label for="">Password</label>
                                                        <input type="password" class="form-control" name="passwords" id="passwords" placeholder="Enter Password" >
                                                    </div>
                                                </div> -->
                                                <div class="form-row">
                                                     <div class="form-group col-md-6">
                                                        <label for="">Email</label>
                                                        <input type="email" class="form-control" id="emails" name="emails"
                                                            placeholder="Enter Email" required>
                                                    </div>
                                                      <div class="form-group col-md-6">
                                                        <label for="">Phone</label>
                                                        <input type="phone" class="form-control" name="phones" id="phones" placeholder="Enter Phone Number">
                                                    </div>
                                                    <!--  <div class="form-group col-md-6">
                                                        <label for="">Employee id</label>
                                                        <input type="text" class="form-control" name="employe_ids" id="employe_ids" placeholder="Enter employee id">
                                                    </div> -->
                                                </div>
                                                     <div class="form-group">
                                                        <label for="teamSelect">Select Brand</label>
                                                        <select id="brand_selects" name="brand_selects" required="required" class="form-select" >
                                                          
                                                        </select>
                                                      </div>
                                                      <input type="hidden" name="user_id" id="user_id" value="">
                                                      <div class="modal-footer">
                                                <div class="add-rx-btn">
                                                    <button type="submit" class="btn btn-add">EDIT</button>
                                                </div>
                                            </div>
                                                </form>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="brand-list-content">
                        <div class="card mt-3">
                            <div class="brandlist-table table-responsive">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col" class="col-md-1">SL.NO</th>
                                            <th scope="col" class="col-md-2">Name</th>
                                            <th scope="col" class="col-md-2">Brand </th>
                                            <th scope="col" class="col-md-3">Email </th>
                                            <th scope="col" class="col-md-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach ($userData as $key => $value)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$value->first_name}} {{$value->last_name}}</td>
                                            <td>{{$value->brand_name}}</td>
                                             <td>{{$value->email}}</td>
                                            <td class="actions">
                                              
                                                         <button class="edit" type="button"><a href="{{url('brand_manager/' . encrypt($value->user_id)).'/edit' }}"><img
                                                        src="images/icons/edit.svg"></a></button>
                                                 <form  class="dropdown-menu  dropdown-menu-right p-3" action="{{ route('delete_manager', $value->user_id) }}" method="post" id="deleteform">
                                                  @csrf @method('DELETE')
                                                </form>
                                                <button type="button" class="delete" id="{{$value->user_id}}"><img src="images/icons/delete.svg"></button>
                                                <button type="button" class="add"><a href="{{url('brand_manager/' . encrypt($value->user_id)) }}"><img
                                                        src="images/icons/add.svg"></a></button>
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
<script type="text/javascript">
  $(".delete").click(function(){
    var deleteConfirm = confirm('Are you sure to delete brand manager');
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
  $(".edit_brand_manager").click(function () {
            let token = "{{csrf_token()}}";
            var id = this.id;
             $.ajax({
                type: "get",
                url: '/fetch_brand_manager_data',
                async: true,
                data: {
                    _token  : token,
                    user_id : id
                },
                success: function(response) { 
                     if (response.success == '1') {
                        var data = response.data;console.log(data);
                        $("#first_names").val(data.userData[0].first_name);
                        $("#last_names").val(data.userData[0].last_name);
                        $("#emails").val(data.userData[0].email);
                        $("#phones").val(data.userData[0].phone);
                        $("#employe_ids").val(data.userData[0].employee_id);
                        $("#passwords").val(data.userData[0].password);
                        var option1 = "<option selected value="+data.userData[0].brand_id+">"+data.userData[0].brand_name+"</option>";
                        $.each(data.brand_list, function(index, value) {
                            option1 = option1 + "<option value=" + value['id'] + ">" + value['brand_name'] + "</option>";
                        });
                        $("#brand_selects").html(option1);
                        $("#user_id").val(id);
                      }  
               }

            });
        });
</script>
@endpush