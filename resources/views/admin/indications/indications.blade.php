@extends('layouts.app')
@section('content')
                 <div class="container brandlist-page">

                    <div class="row pl-3 pr-3">
                        <div class="col-md-9">
                            <form class="form-inline">
                                <a class="brand-title">Manage Indications</a>
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
                                                <form method='post' action="{{route('indications.store') }}" >
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="teamSelect">Select Brand</label>
                                                        <select class="form-select" id="brandSelect" name="brandSelect">
                                                          <option selected value="">Choose...</option>
                                                           @foreach ($brands as $key => $value1)
                                                            <option value="{{$value1->id}}">{{$value1->brand_name}}</option>
                                                           @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Enter Indication name</label>
                                                        <input type="text" class="form-control" id="indication" name="indication"
                                                            placeholder="Enter indication">
                                                    </div>
                                                     <div class="form-group">
                                                        <label for="">Enter Sub Indication name</label>
                                                    <input type="text" name="subindications[]" class="form-control m-input subcategory"
                                                                    placeholder="Enter subindications"  autocomplete="off">
                                                                <div class="">
                                                                    <button id="addRow" type="button" class="btn btn-success m-2 btn-sm">
                                                                        <i class="ti-plus"></i>Add</button>
                                                                         <div id="newRow"></div>
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
                                            <th scope="col" class="col-md-1">SL.NO</th>
                                            <th scope="col" class="col-md-2">Indication</th>
                                            <th scope="col" class="col-md-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($indications as $key => $value)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$value->name}}</td>
                                            <td class="actions">
                                                <!-- <button type="button" class="edit edit_indication" id="{{$value->id}}" data-toggle="modal"
                                                data-target="#editIndicationModal"><img
                                                        src="images/icons/edit.svg"></button> -->
                                               
                                                <button type="button" class="delete" id="{{$value->id}}"><img src="images/icons/delete.svg"></button>
                                                
                                            </td>
                                        </tr>
                                         @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                         <div class="modal fade" id="editIndicationModal" tabindex="-1" role="dialog"
                                    aria-labelledby="editIndicationModal" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">EDIT</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method='post' action="{{route('indications.store') }}" >
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="teamSelect">Select Brand</label>
                                                        <select class="form-select" id="brandSelect" name="brandSelect">
                                                          <option selected value="">Choose...</option>
                                                           @foreach ($brands as $key => $value1)
                                                            <option value="{{$value1->id}}">{{$value1->brand_name}}</option>
                                                           @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Enter Indication name</label>
                                                        <input type="text" class="form-control" id="indication" name="indication"
                                                            placeholder="Enter indication">
                                                    </div>
                                                     <div class="form-group">
                                                        <label for="">Enter Sub Indication name</label>
                                                    <input type="text" name="subindications[]" class="form-control m-input subcategory"
                                                                    placeholder="Enter subindications" required autocomplete="off">
                                                                <div class="">
                                                                    <button id="addRow" type="button" class="btn btn-success m-2 btn-sm">
                                                                        <i class="ti-plus"></i>Add</button>
                                                                         <div id="newRowedit"></div>
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
                       <!--  <div class="row dataTables_info justify-content-between" id="showingBrandEntries">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
  $(".delete").click(function(){ 
    var deleteConfirm = confirm('Are you sure to delete indication?');
    if(deleteConfirm){
         let token = "{{csrf_token()}}";
            var id = this.id;
             $.ajax({
                type: "delete",
                url: '/delete_indication',
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
