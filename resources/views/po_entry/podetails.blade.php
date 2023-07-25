<div>
    <div>{{$po_entry}}</div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="col-md-1">S.NO</th>
                <th scope="col" class="col-md-2">Institute</th>
                <th scope="col" class="col-md-2">Po Date</th>
                <th scope="col" class="col-md-2">Po amount</th>
                <th scope="col" class="col-md-2"></th>
            </tr>
        </thead>
        <tbody>
            @if($po_entry->count() > 0)
            @foreach($po_entry as $key=> $value)
            <tr>
                <td>{{ (($po_entry->currentPage() - 1 ) * $po_entry->perPage() ) + $loop->iteration }}</td>
                <td>{{ isset($value->id) ? $value->institute_name : '-' }}</td>
                <td>{{ isset($value->id) ? $value->po_date : '-' }}</td>
                <td>{{ isset($value->id) ? $value->po_amountlakhs : '-' }}<span>Lac</span></td>
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

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>