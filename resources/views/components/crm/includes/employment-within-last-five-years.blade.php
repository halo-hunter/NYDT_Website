@if(\Illuminate\Support\Facades\Route::currentRouteName() == 'clients->insert')

    <div class="row mb-3">

        <div class="col-3">

            <h6 class="text-capitalize">Employment Within Last 5 Years</h6>

        </div>

        <div class="col-9">

            <div class="row">

                <div class="col-12" id="employment_within_last_five_years_first_block_id">
                    <div class="row">
                        <div class="col-1 text-secondary">
                            <button class="btn btn-primary float-start" id="employment_within_last_five_years_first_block_add_id"> + </button>
                        </div>

                        <div class="col-3 text-capitalize">
                            <div>
                                Name
                            </div>
                        </div>
                        <div class="col-8 text-secondary">
                            <input type="text" class="form-control" name="employment_within_last_five_years__name[]" />
                        </div>

                        <div class="col-1"></div>

                        <div class="col-3">
                            <div class="mt-2 text-capitalize">
                                Address of Employer
                            </div>
                        </div>
                        <div class="col-8 text-secondary">
                            <input type="text" class="form-control mt-2" name="employment_within_last_five_years__address_of_employer[]" />
                        </div>

                        <div class="col-1"></div>

                        <div class="col-3">
                            <div class="mt-2 text-capitalize">
                                Your Occupation
                            </div>
                        </div>
                        <div class="col-8 text-secondary">
                            <input type="text" class="form-control mt-2" name="employment_within_last_five_years__your_occupation[]" />
                        </div>
                    </div>

                    <div class="row mb-3 entry_date_first_block_class" id="entry_date_first_block_id">
                        <div class="col-1"></div>
                        <div class="col-sm-3"></div>

                        <div class="col-sm-4 text-secondary">
                            <div class="mt-2 text-capitalize">
                                From
                            </div>
                            <input type="date" class="form-control" name="employment_within_last_five_years__from[]" />
                            <div class="text-muted">Click the calendar icon</div>
                        </div>
                        <div class="col-sm-4 text-secondary">
                            <div class="mt-2 text-capitalize">
                                To
                            </div>
                            <input type="date" class="form-control" name="employment_within_last_five_years__to[]" />
                            <div class="text-muted">Click the calendar icon</div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

@elseif(\Illuminate\Support\Facades\Route::currentRouteName() == 'clients->edit')

    <div class="row mb-3">

        <div class="col-3">

            <h6 class="text-capitalize">Employment Within Last 5 Years</h6>

        </div>

        <div class="col-9">

            <div class="row">

                <div class="col-12" id="employment_within_last_five_years_first_block_id">
                    <div class="row">
                        <div class="col-1 text-secondary">
                            <button class="btn btn-primary float-start" id="employment_within_last_five_years_first_block_add_id"> + </button>
                        </div>

                        <div class="col-3 text-capitalize">
                            <div>
                                Name
                            </div>
                        </div>
                        <div class="col-8 text-secondary">
                            <input type="text" class="form-control" name="employment_within_last_five_years__name[]" />
                        </div>

                        <div class="col-1"></div>

                        <div class="col-3">
                            <div class="mt-2 text-capitalize">
                                Address of Employer
                            </div>
                        </div>
                        <div class="col-8 text-secondary">
                            <input type="text" class="form-control mt-2" name="employment_within_last_five_years__address_of_employer[]" />
                        </div>

                        <div class="col-1"></div>

                        <div class="col-3">
                            <div class="mt-2 text-capitalize">
                                Your Occupation
                            </div>
                        </div>
                        <div class="col-8 text-secondary">
                            <input type="text" class="form-control mt-2" name="employment_within_last_five_years__your_occupation[]" />
                        </div>
                    </div>

                    <div class="row mb-3 entry_date_first_block_class" id="entry_date_first_block_id">
                        <div class="col-1"></div>
                        <div class="col-sm-3"></div>

                        <div class="col-sm-4 text-secondary">
                            <div class="mt-2 text-capitalize">
                                From
                            </div>
                            <input type="date" class="form-control" name="employment_within_last_five_years__from[]" />
                            <div class="text-muted">Click the calendar icon</div>
                        </div>
                        <div class="col-sm-4 text-secondary">
                            <div class="mt-2 text-capitalize">
                                To
                            </div>
                            <input type="date" class="form-control" name="employment_within_last_five_years__to[]" />
                            <div class="text-muted">Click the calendar icon</div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    @if(count($client_employment_within_last_five_years_data))

        <div class="row">
            <div class="col-3"></div>

            <div class="col-9">
                <table class="table table-bordered">
                    <thead>
                    <tr class="text-capitalize">
                        <th scope="col" class="text-uppercase">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Address of Employer</th>
                        <th scope="col">Your Occupation</th>
                        <th scope="col">From</th>
                        <th scope="col">To</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($client_employment_within_last_five_years_data as $item)

                        <tr>
                            <th>{{ $item->id }}</th>
                            <td>{{ $item->employment_w_l_f_y__name }}</td>
                            <td>{{ $item->employment_w_l_f_y__address_of_employer }}</td>
                            <td>{{ $item->employment_w_l_f_y__your_occupation }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->employment_w_l_f_y__from)->format('m/d/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->employment_w_l_f_y__to)->format('m/d/Y') }}</td>
                            <td class="w-auto">
                                <a class="btn btn-warning btn-sm" href="{{ route('employment_within_last_five_years->edit', $item->id) }}" role="button">Edit</a>
                                <a class="btn btn-danger btn-sm" href="{{ route('employment_within_last_five_years->delete', $item->id) }}" role="button">Delete</a>
                            </td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    @endif

@endif


