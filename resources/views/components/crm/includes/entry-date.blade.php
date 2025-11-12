@if(\Illuminate\Support\Facades\Route::currentRouteName() == 'cases->insert')

    <div class="row mb-3 entry_date_first_block_class" id="entry_date_first_block_id">
        <div class="col-sm-3">
            <h6 class="mb-0 text-capitalize">Entry date</h6>
        </div>
        <div class="col-sm-4 text-secondary">
            <input type="date" class="form-control" name="entry_date[]" />
            <div class="text-muted">Click the calendar icon</div>
        </div>
        <div class="col-sm-4">
            <div class="row">
                <div class="col-3"><h6 class="mb-0">Entry place</h6></div>
                <div class="col-9">
                    <textarea class="form-control" rows="2" name="entry_place[]"></textarea>
                </div>
            </div>
        </div>
        <div class="col-sm-1">
            <button class="btn btn-primary" id="entry_date_add_button_id"> + </button>
        </div>
    </div>

@elseif(\Illuminate\Support\Facades\Route::currentRouteName() == 'cases->edit')

    <div class="row mb-3 entry_date_first_block_class" id="entry_date_first_block_id">
        <div class="col-sm-3">
            <h6 class="mb-0 text-capitalize">Entry date</h6>
        </div>
        <div class="col-sm-4 text-secondary">
            <input type="date" class="form-control" name="entry_date[]" />
            <div class="text-muted">Click the calendar icon</div>
        </div>
        <div class="col-sm-4">
            <div class="row">
                <div class="col-3"><h6 class="mb-0">Entry place</h6></div>
                <div class="col-9">
                    <textarea class="form-control" rows="2" name="entry_place[]"></textarea>
                </div>
            </div>
        </div>
        <div class="col-sm-1">
            <button class="btn btn-primary" id="entry_date_add_button_id"> + </button>
        </div>
    </div>


    @if(count($entry_dates))

        <div class="row">
            <div class="col-3"></div>

            <div class="col-9">
                <table class="table table-bordered">
                    <thead>
                    <tr class="text-capitalize">
                        <th scope="col" class="text-uppercase">ID</th>
                        <th scope="col">Entry date</th>
                        <th scope="col">Entry Place</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($entry_dates as $entry_date)

                        <tr>
                            <th>{{ $entry_date->id }}</th>
                            <td>{{ $entry_date->date }}</td>
                            <td>{{ $entry_date->place }}</td>
                            <td class="w-auto">
                                <a class="btn btn-warning btn-sm" href="{{ route('entry_date->edit', $entry_date->id) }}" role="button">Edit</a>
                                <a class="btn btn-danger btn-sm" href="{{ route('entry_date->delete', $entry_date->id) }}" role="button">Delete</a>
                            </td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    @endif

@endif


