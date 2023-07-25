@extends('layouts.app')
@section('content')
                 <div class="container brandlist-page">

                    <div class="row pl-3 pr-3">
                        <div class="col-md-9">
                            <form class="form-inline">
                                <a class="brand-title">Manage Institutions</a>
                                <div class="input-group">
                                </div>
                            </form>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-2 top-section">
                            <div class="btn-group">
                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                    data-target="#exampleModal">ADD NEW
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                </button>


                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">ADD NEW</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method='post' action="{{route('institute.store') }}" >
                                                    @csrf
                                                   
                                                    <div class="form-group">
                                                        <label for="">Enter Institute name</label>
                                                        <input type="text" class="form-control" id="institute" name="institute"
                                                            placeholder="Enter institute" required>

                                                    </div>
                                                      <div class="form-group">
                        <label for="institute_type">Institute Type</label>
                        <!-- <input type="text" class="form-control" id="institute_type" value="{{ old('institute_type') }}" name="institute_type" readonly> -->
                           <select id="institute_type" name="institute_type" class="form-select">
                            <option value="">Choose institute type</option>
                            <option value="government">Government</option>
                            <option value="corperate">Corperate</option>
                            <option value="trade">Trade</option>
                            </select>
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
                                            <th >SL.NO</th>
                                            <th>Institute</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($institute as $key => $value)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$value->institute_name}}</td>
                                            <td class="actions">
                                                <button type="button" class="delete" id="{{$value->id}}"><img src="images/icons/delete.svg"></button>
                                                
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
  $(".delete").click(function(){ 
    var deleteConfirm = confirm('Are you sure to delete institute?');
    if(deleteConfirm){
         let token = "{{csrf_token()}}";
            var id = this.id; 
             $.ajax({
                type: "delete",
                url: '/delete_institute',
                async: true,
                data: {
                    _token: token,
                      id: id
                },
                success: function(response) {   console.log(response);
                     if (response.success == '1') {
                        alert("deleted");
                        location.reload();
                     }
                }
            });
    }

  });
  
   $("#addRow").click(function () {
                var html = '';
                html += '<div id="inputFormRow" class="subcat_parent_div">';
                html += '<div class="input-group mb-3 d-flex">';
                html += '<input type="text" name="subindications[]" class="form-control m-input" placeholder="Enter subcategory"  autocomplete="off">';
                html += '<div class="">';
                html += '</div>';
                html += '</div>';
                html += '</div>';

                $('#newRow').prepend(html);
            });
   $(".edit_indication").click(function () {
            let token = "{{csrf_token()}}";
            var id = this.id;
            $.ajax({
                type: "get",
                url: '/fetch_indication_data',
                async: true,
                data: {
                    _token   : token,
                    id : id
                },
                success: function(response) {console.log(response);
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
