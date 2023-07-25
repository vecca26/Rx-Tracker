<div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="col-md-1">S.NO</th>
                <th scope="col" class="col-md-2">Brand</th>
                <th scope="col" class="col-md-2">Doctor</th>
                <th scope="col" class="col-md-2">Patient Details</th>
                <!-- <th scope="col" class="col-md-5">Patient Type</th> -->
                <th scope="col" class="col-md-2"></th>
            </tr>
        </thead>
        <tbody>
            @if($rx_entry->count() > 0)
            @foreach($rx_entry as $key=> $value)
            <tr>
                <td>{{ (($rx_entry->currentPage() - 1 ) * $rx_entry->perPage() ) + $loop->iteration }}</td>
                <td>{{ isset($value->brands->id) ? $value->brands->brand_name : '-' }}</td>
                <td>{{ isset($value->doctors->id) ? $value->doctors->doctor_name : '-' }}</td>
                <td style="font-size:11px;"><span>Patient: </span>{{ isset($value->patient_name) ? $value->patient_name:'-' }}</br>
                    <span>Phone: </span>{{ isset($value->patient_name) ? $value->phone:'-' }}</br><span>Type: </span>{{ isset($value->patient_name) ? $value->contact_type:'-' }}
                </td>
                <td class="actions">
                    <button type="button" class="option" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/icons/icon15.svg"></button>
                    <div class="dropdown-menu">
                        <a href="{{url('rx_entries/' . encrypt($value->id)).'/edit' }}"><button class="dropdown-item" type="button">Edit</button></a>
                        <a href="{{url('rx_entries/' . encrypt($value->id)) }}"><button class="dropdown-item" type="button">View</button></a>
                        @if(auth()->user()->team_id!='3')
                        <a href="{{url('add_cycle/' . encrypt($value->id)) }}"><button class="dropdown-item" type="button">Add Cycle</button></a>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="5" class="text-bold text-danger text-center">
                    No Data Found
                </td>
            </tr>
            @endif
        </tbody>
    </table>
</div>