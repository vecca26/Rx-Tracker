@extends('layouts.app')
@section('content')
       <div class="container areamanage-page">
                    <div class="row pl-3 pr-3">
                        <div class="col-md-8">
                            <form class="form-inline" method='post' action="{{route('admin_bdm.search')}}">
                                @csrf
                                <a class="brand-title">Manage BDM Listing</a>
                                <div class="input-group">
                                    <select class="form-select mr-3" id="region_listing" name="region_listing">
                                        <option value="">Select region</option>
                                    @foreach ($regions as $key => $regions)
                                                            <option value="{{$regions->id}}">{{$regions->region}}</option>
                                                           @endforeach  
                                      </select>
                                </div>
                                <div class="input-group">
                                    <!-- <input class="form-control" type="search" placeholder="Search by BDM Name"
                                        aria-label="Search"  name="keyword" id="keyword"> -->
                                    <button type="submit" class="input-group-text"><i class="fa fa-search"
                                            aria-hidden="true"></i></button>
                                </div>
                            </form>

                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-2 top-section">
                            <div class="btn-group">
                             <!--   <button type="button" class="btn btn-warning" data-toggle="modal"
                                    data-target="#brandManagerModal">ADD USER
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                </button> -->
                                  <a class="btn btn-warning" href="{{url('admin_bdm/').'/create' }}">ADD NEW</a>
                              <!--  <div class="modal fade bd-example-modal-lg" id="brandManagerModal" tabindex="-1" role="dialog"
                                    aria-labelledby="brandManagerModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">ADD NEW</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method='post' action="{{ Route('admin_bdm.store') }}">
                                               @csrf
                                               <div class="form-row">
                                                     <div class="form-group col-md-6">
                                                        <label for="">Enter First Name</label>
                                                        <input type="text" class="form-control" name="first_name" id="first_name"
                                                            placeholder="Enter Manager Name" required minlength="1" maxlength="20">
                                                    </div>
                                                     <div class="form-group col-md-6">
                                                        <label for="">Enter Last Name</label>
                                                        <input type="text" class="form-control" name="last_name" id="last_name"
                                                            placeholder="Enter Manager Name" required minlength="1" maxlength="20">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                     <div class="form-group col-md-6">
                                                        <label for="">Email</label>
                                                        <input type="email" class="form-control" id="email" name="email"
                                                            placeholder="Enter Email" required minlength="4" maxlength="100">
                                                    </div>
                                                     <div class="form-group col-md-6">
                                                        <label for="">Password</label>
                                                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required minlength="3" maxlength="10">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                     <div class="form-group col-md-6">
                                                        <label for="">Phone</label>
                                                        <input type="number" class="form-control" name="phone" id="phone" placeholder="Enter Phone Number" required minlength="10" maxlength="10">
                                                    </div>
                                                     <div class="form-group col-md-6">
                                                        <label for="">Employee id</label>
                                                        <input type="text" class="form-control" name="employe_id" id="employe_id" placeholder="Enter employee id" required minlength="4" maxlength="8">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                      <div class="form-group col-md-6">
                                                        <label for="teamSelect">Select Team</label>
                                                        <select id="team_select" name="team_select" required="required" class="form-select" >
                                                           @foreach ($teams as $key => $teams)
                                                            <option value="{{$teams->id}}">{{$teams->team}}</option>
                                                           @endforeach  
                                                        </select>
                                                      </div>
                                                       <div class="form-group col-md-6">
                                                        <label for="teamSelect">Select Region</label>
                                                        <select id="region_select" name="region_select" required="required" class="form-select" >
                                                           @foreach ($region_list as $key => $region_list)
                                                            <option value="{{$region_list->id}}">{{$region_list->region}}</option>
                                                           @endforeach  
                                                        </select>
                                                      </div>
                                                  </div>
                                                  <div class="form-row">
                                                       
                                                      <div class="form-group col-md-6">
                                                        <label for="teamSelect">Select HQ</label>
                                                        <select id="hq_select" name="hq_select" required="required" class="form-select" >
                                                       
                                                           @foreach ($hq_list as $key => $hq_list)
                                                            <option value="{{$hq_list->id}}">{{$hq_list->hq}}</option>
                                                           @endforeach  
                                                        </select>
                                                      </div>
                                                      <div class="form-group col-md-6">
                                                        <label for="teamSelect">Select ZSM</label>
                                                        <select id="zsm_select" name="zsm_select" required="required" class="form-select" >
                                                       
                                                           @foreach ($zsm_list as $key => $zsm_list)
                                                            <option value="{{$zsm_list->id}}">{{$zsm_list->first_name}} {{$zsm_list->last_name}}</option>
                                                           @endforeach  
                                                        </select>
                                                      </div>
                                                      </div>
                                                      <div class="modal-footer">
                                                <div class="add-rx-btn">
                                                    <button type="submit" class="btn btn-add">ADD</button>
                                                </div>
                                            </div>
                                                </form>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div> -->
                                <div class="modal fade bd-example-modal-lg" id="editBDMModal" tabindex="-1" role="dialog"
                                    aria-labelledby="editBDMModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit BDM</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method='post' action="{{route('admin_bdm.update')}}">
                                               @csrf
                                               <div class="form-row">
                                                     <div class="form-group col-md-6">
                                                        <label for="">Enter First Name</label>
                                                        <input type="text" class="form-control" name="first_names" id="first_names"
                                                            placeholder="Enter Manager Name" required minlength="1" maxlength="20">
                                                    </div>
                                                     <div class="form-group col-md-6">
                                                        <label for="">Enter Last Name</label>
                                                        <input type="text" class="form-control" name="last_names" id="last_names"
                                                            placeholder="Enter Manager Name" required minlength="1" maxlength="20">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                     <div class="form-group col-md-6">
                                                        <label for="">Phone</label>
                                                        <input type="text" class="form-control" name="phones" id="phones" placeholder="Enter Phone Number" required minlength="1" maxlength="20">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="">Email</label>
                                                        <input type="email" class="form-control" name="emails" id="emails" placeholder="Enter Email" required minlength="1" maxlength="20">
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
                                                  <div class="form-row">
                                                      <div class="form-group col-md-6">
                                                        <label for="teamSelect">Select ZSM</label>
                                                        <select id="zsm_lists" name="zsm_lists" required="required" class="form-select" >
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
                                            <th scope="col" class="col-md-3">Team </th>
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
                                               <button type="button" class="edit edit_bdm" id="{{$value->user_id}}" data-toggle="modal"
                                                data-target="#editBDMModal"><img
                                                        src="images/icons/edit.svg"></button>
                                                 
                                                <button type="button" class="delete" id="{{$value->user_id}}"><img src="images/icons/delete.svg"></button>
                                                <button type="button" class="add"><a href="{{url('admin_bdm/' . encrypt($value->user_id)) }}"><img
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
  $(".edit_bdm").click(function () {
            let token = "{{csrf_token()}}";
            var id = this.id; 
             $.ajax({
                type: "get",
                url: '/fetch_bdm_data',
                async: true,
                data: {
                    _token  : token,
                    user_id : id
                },
                success: function(response) { 
                     if (response.success == '1') {//console.log(response);return false;
                        var data = response.data;
                        $("#first_names").val(data.userData[0].first_name);
                        $("#last_names").val(data.userData[0].last_name);
                        $("#emails").val(data.userData[0].email);
                        $("#phones").val(data.userData[0].phone);
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
                        var option3 = "<option selected value="+data.userData[0].zsm_id+">"+data.zsm_name[0].first_name +"</option>";
                        $.each(data.zsm_list, function(index, value) {
                            option3 = option3 + "<option value=" + value['id'] + ">" + value['first_name'] + "</option>";
                        });
                        $("#zsm_lists").html(option3);

                        $("#user_id").val(id);
                      }  
               }

            });
        });
</script>
@endpush
