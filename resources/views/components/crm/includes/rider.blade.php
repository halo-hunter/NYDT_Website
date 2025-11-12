<div class="row mb-3">
    <div class="col-sm-3">
        <h6 class="mb-0">Rider</h6>
    </div>

    <div class="col-sm-9 text-secondary">
        <div class="row rider_first_block_class" id="rider_first_block_id">
            <div class="col-3">
                <label for="">Relation</label>
                <input type="text" class="form-control rider_relation_input_class" name="rider[][relation]" />
            </div>
            <div class="col-3">
                <label for="">Select</label>
                <select class="form-select text-capitalize select_rider_class" aria-label="Default select example" name="rider[][riders]" id="select_rider_id" data-clientid="{{ $clientid }}"></select>
            </div>
            <div class="col-3">
                <button type="button" class="btn btn-primary btn create_a_rider_profile_button_class text-capitalize" id="create_a_rider_profile_button_id"><i class="bx bx-file"></i> Create a rider profile </button>
            </div>
            <div class="col-3">
                <button class="btn btn-primary btn rider_add_class" id="rider_add_button_id">
                    <i class="fadeIn animated bx bx-plus-circle"></i>
                </button>
            </div>
        </div>
        <span id="rider_additional_block_id"></span>
    </div>
</div>

@if(count($riders) > 0)

    <div class="row mb-3">

        <div class="col-sm-3"></div>

        <div class="col-sm-9 text-secondary">

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Relation</th>
                    <th scope="col">Rider</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>

                @foreach($riders as $rider)

                    @php
                        $rider = \App\Models\Crm\Rider::find($rider->id);
                        if ($rider->relations()->count() != 0) {
                            $relation = $rider->relations()->first();
                        }
                    @endphp

                    @if($rider->relations()->count() != 0)

                        <tr class="text-capitalize">
                            <td>
                                {{ $relation->name }}
                            </td>
                            <td>{{ $rider->firstname }} {{ $rider->lastname }}</td>
                            <td class="w-auto">
                                <a class="btn btn-warning btn-sm" href="{{ route('riders->edit', $rider->id) }}" role="button">Edit</a>
                                <a class="btn btn-danger btn-sm" href="{{ route('riders->delete', $rider->id) }}" role="button">Delete</a>
                            </td>
                        </tr>

                    @endif

                @endforeach

                </tbody>
            </table>

        </div>



    </div>

@endif


