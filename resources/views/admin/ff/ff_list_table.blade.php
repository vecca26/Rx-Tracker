<div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="col-md-1">S.NO</th>
                <th scope="col" class="col-md-2">Name</th>
                <th scope="col" class="col-md-2">Area(HQ)</th>
                <th scope="col" class="col-md-5">Team</th>
                <th scope="col" class="col-md-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @if($users->count() > 0)
            <?php $i = 1; ?>
            @foreach($users as $key=> $value)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ isset($value->first_name) ? $value->first_name : '-' }}</td>
                <td>{{ isset($value->hq) ? $value->hq : '-' }}</td>
                <td>{{ isset($value->team) ? $value->team : '-' }}</td>
                <td class="actions">
                    <a href="{{ Route('ff.edit' ,encrypt($value->id) ) }}"><button type="button" class="edit"><img src="images/icons/edit.svg"></button></a>
                    <span>
                        <button onclick=deleteFf({{ $value->id }}) class="delete"><img src="images/icons/delete.svg"></button>
                    </span>
                    <!-- <button type="button" class="delete"><img src="images/icons/delete.svg"></button> -->
                    <!-- <button type="button" class="add"><img src="images/icons/add.svg"></button> -->
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
<div class='col-12'>{{ $users->links() }}</div>