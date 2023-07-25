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
                            <form class="form-inline" method='post' action="{{route('regional_manager.search')}}">
                                @csrf
                                <a class="brand-title">Manage ZSM</a>
                                <div class="input-group">

                                    <input class="form-control" type="search" placeholder="Search by Name, Region"
                                        aria-label="Search" name="keyword" id="keyword">
                                    <button type="submit" class="input-group-text"><i class="fa fa-search"
                                            aria-hidden="true"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-2 top-section">
                            <div class="btn-group">
                            </div>
                              <div class="btn-group">
                                <a class="btn btn-warning" href="{{url('regional_manager/').'/create' }}">ADD NEW</a>
                               
                              </div>
                              
                                <div class="modal fade bd-example-modal-lg" id="editRegionalManagerModal" tabindex="-1" role="dialog"
                                    aria-labelledby="brandManagerModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Regional Manager</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method='post' action="{{route('regional_manager.edit')}}">
                                               @csrf
                                               <div class="form-row">
                                                     <div class="form-group col-md-6">
                                                        <label for="">First Name</label>
                                                        <input type="text" class="form-control" name="first_names" id="first_names"
                                                            placeholder="Enter Manager Name" required minlength="2" minlength="30">
                                                    </div>
                                                     <div class="form-group col-md-6">
                                                        <label for="">Last Name</label>
                                                        <input type="text" class="form-control" name="last_names" id="last_names"
                                                            placeholder="Enter Manager Name" required minlength="1" minlength="30">
                                                    </div>
                                                </div>
                                               
                                                <div class="form-row">
                                                     <div class="form-group col-md-6">
                                                        <label for="">Phone</label>
                                                        <input type="number" class="form-control" name="phones" id="phones" placeholder="Enter Phone Number" required minlength="2" minlength="10">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="">Email</label>
                                                        <input type="email" class="form-control" name="emails" id="emails" placeholder="Enter Email" required minlength="2" minlength="50">
                                                    </div>
                                                    
                                                </div>
                                                <div class="form-row">
                                                       <div class="form-group col-md-6">
                                                        <label for="teamSelect">Select Region</label>
                                                        <select id="region_selects" name="region_selects" required="required" class="form-select" >
                                                        </select>
                                                      </div>
                                                        <div class="form-group col-md-6">
                                                        <label for="teamSelect">Select HQ</label>
                                                        <select id="hq_selects" name="hq_selects" required="required" class="form-select" >
                                                        </select>
                                                      </div>
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
                    <div class="brand-list-content">
                        <div class="card mt-3">
                            <div class="brandlist-table table-responsive">
                                <table class="table">
                                   <thead class="thead-dark">
                                        <tr>
                                            <th scope="col" class="col-md-1">SL.NO</th>
                                            <th scope="col" class="col-md-2">Name</th>
                                            <th scope="col" class="col-md-3">Hq </th>
                                            <th scope="col" class="col-md-2">Team </th>
                                            <th scope="col" class="col-md-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach ($userData as $key => $value)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$value->first_name}} {{$value->last_name}}</td>
                                            <td>{{$value->hq}}</td>
                                            <td>{{$value->team}}</td>
                                            <td class="actions">
                                                <button type="button" class="edit edit_regional_manager" id="{{$value->user_id}}" data-toggle="modal"
                                                data-target="#editRegionalManagerModal"><img
                                                        src="images/icons/edit.svg"></button>
                                               
                                                <button type="button" class="delete" id="{{$value->user_id}}"><img src="images/icons/delete.svg"></button>
                                                <button type="button" class="add"><a href="{{url('regional_manager/' . encrypt($value->user_id)) }}"><img
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
  $(".edit_regional_manager").click(function () {
            let token = "{{csrf_token()}}";
            var id = this.id; 
             $.ajax({
                type: "get",
                url: '/fetch_regional_manager_data',
                async: true,
                data: {
                    _token  : token,
                    user_id : id
                },
                success: function(response) { 
                     if (response.success == '1') {
                        var data = response.data;
                        var option1 = "<option selected value="+data.userData[0].hq_ids+">"+data.userData[0].hq+"</option>";
                        $.each(data.hq_list, function(index, value) {
                            option1 = option1 + "<option value=" + value['id'] + ">" + value['hq'] + "</option>";
                        });
                        $("#hq_selects").html(option1);
                        var option2 = "<option selected value="+data.userData[0].region_id+">"+data.userData[0].region+"</option>";
                        $.each(data.region_list, function(index, value) {
                            option2 = option2 + "<option value=" + value['id'] + ">" + value['region'] + "</option>";
                        });
                        $("#region_selects").html(option2);
                        $("#user_id").val(id);
                      }  
               }

            });
        });
</script>
@endpush
