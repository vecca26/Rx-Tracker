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
                            <form class="form-inline" method='post' action="{{route('brand_list.search')}}">
                                @csrf
                                <a class="brand-title">Manage Brands</a>
                                <div class="input-group">

                                    <input class="form-control" type="search" placeholder="Search Keywords"
                                        aria-label="Search" name="keyword" id="keyword">
                                    <button type="submit" class="input-group-text"><i class="fa fa-search"
                                            aria-hidden="true"></i></button>
                                </div>
                            </form>

                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-2 top-section">
                            <div class="btn-group">
                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                    data-target="#brandModal">ADD NEW BRAND
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                </button>
                    

                               <div class="modal fade" id="brandModal" tabindex="-1" role="dialog"
                                    aria-labelledby="brandModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="brandModalLabel">ADD NEW</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                               <form method='post' action="{{route('brand.add')}}">
                                               @csrf
                                                    <div class="form-group">
                                                        <label for="teamSelect">Select Team</label>
                                                        <select id="team_select" name="team_select" required="required" class="form-select">
                                                          <option selected value="">Choose...</option>
                                                          <option value="1">Team A</option>
                                                          <option value="2">Team B</option>
                                                          <option value="3">Team E</option>
                                                           
                                                        </select>
                                                      </div>
                                                    <div class="form-group">
                                                        <label for="">Enter Brand Name</label>
                                                        <input type="text" class="form-control"
                                                            id="brandname" name="brandname"
                                                            placeholder="Enter Brand" required>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Enter Dose Unit</label>
                                                        <input type="text" class="form-control"
                                                            id="dose_unit" name="dose_unit"
                                                            placeholder="Enter Dose unit" >

                                                    </div>
                                                     <div class="form-group">
                                                <div class="modal-footer">
                                                    
                                                <div class="add-rx-btn">
                                                    <button type="submit" class="btn btn-add">ADD</button>
                                                </div></div>
                                            </div>
                                                 
                                                </form>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="brandEdit" tabindex="-1" role="dialog"
                        aria-labelledby="giftAddCenterTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="brandModalLabel">Edit Brand Details</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                                <div class="modal-body">
                                               <form method='post' action="{{route('brand.update')}}">
                                               @csrf
                                               <div class="form-group".
                                                        <label for="teamSelect">Select Team</label>
                                                        <select id="team_selects" name="team_selects" required="required" class="form-select">
                                                         <option value="1">Team A</option>
                                                          <option value="2">Team B</option>
                                                          <option value="3">Team E</option>
                                                        </select>
                                                      </d>
                                                    <div class="form-group">
                                                        <label for="">Enter Brand Name</label>
                                                        <input type="text" class="form-control"
                                                            id="brandnames" name="brandnames"
                                                            placeholder="Enter Brand" required>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Enter Dose Unit</label>
                                                        <input type="text" class="form-control"
                                                            id="dose_units" name="dose_units"
                                                            placeholder="Enter Dose unit" required>

                                                    </div>
                                                    
                                                    <input type="hidden" name="brand_id" id="brand_id" value="">
                                                <div class="modal-footer">
                                                <div class="add-rx-btn">
                                                    <button type="submit" class="btn btn-add">UPDATE</button>
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
                                            <th scope="col" class="col-md-2">SL.NO</th>
                                            <th scope="col" class="col-md-4">Brand Name</th>
                                            <th scope="col" class="col-md-2">Dose Unit</th>
                                            <th scope="col" class="col-md-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $x=1 ?>
                            @foreach ($brand_list as $key => $value)
                              <tr>
                              <td>{{$key+1}}</td>
                              <td>{{$value->brand_name}}</td>
                              <td>{{$value->dose_unit}}</td>
                                <td class="actions">
                                                <button class="edit brand_edit"  data-toggle="modal"
                                                data-target="#brandEdit" id="{{ $value->id }}" type="button"><img
                                                        src="images/icons/edit.svg"></button>
                                            
                                                 <form method="POST" class="dropdown-menu  dropdown-menu-right p-3" action="{{ route('brand.delete', $value->id) }}"  id="deleteform">
                                                  @csrf @method('DELETE')
                                                </form>
                                                <button type="button" class="delete" id="{{ $value->id }}"><img src="images/icons/delete.svg"></button>
                                           
                                </td>
                               </tr>
                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class='col-12'>{{ $brand_list->links() }}</div>
                        </div>
                       
                    </div>
                </div>
 @endsection
 @push('scripts')

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
     <script>

$(".delete").click(function() {
    console.log(this.id);
        var deleteConfirm = confirm('Are you sure to delete this Brand?');

        if (deleteConfirm) {
            let token = "{{csrf_token()}}";
            var id = this.id;
            $.ajax({
                type: "delete",
                url: '/brands/destroy',
                async: true,
                data: {
                    _token: token,
                    id: id
                },
                success: function(response) {
                    if (response == '1') {
                        alert("deleted");
                        location.reload();
                    }
                }
            });
        }

    });





$(".brand_edit").click(function () {
            let token = "{{csrf_token()}}";
            var id = this.id;
            $.ajax({
                type: "get",
                url: '/fetch_brand_data',
                async: true,
                data: {
                    _token   : token,
                    brand_id : id
                },
                success: function(response) {
                    console.log(response);
                 if (response.success == '1') { 
                             var data = response.data;
                        $("#brandnames").val(data.brand_list[0].brand_name);
                        $("#dose_units").val(data.brand_list[0].dose_unit);
                    var option1 = "<option selected value="+data.brand_list[0].team_id+">"+data.brand_list[0].team+"</option>";
                          
                        $("#team_selects").append(option1);
                         $("#brand_id").val(id);
                    }
                }

            });
 });
</script>
@endpush