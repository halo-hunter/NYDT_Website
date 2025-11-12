@if(\Illuminate\Support\Facades\Route::currentRouteName() == 'clients->insert')

    <div class="row mb-3">

        <div class="col-3">

            <h6 class="text-capitalize">Residency Within 5 Year</h6>

        </div>


        <div class="col-9">



            <div class="row">

                <div class="col-12" id="residency_within_five_years_first_block_id">

                    <div class="row">

                        <div class="col-1 text-secondary">
                            <button class="btn btn-primary float-start" id="residency_within_five_years_first_block_add_button_id"> + </button>
                        </div>
                        <div class="col-3 text-capitalize">
                            <div>
                                Number and street
                            </div>
                        </div>
                        <div class="col-8 text-secondary">
                            <input type="text" class="form-control" name="residency_within_five_year__number_and_street[]" />
                        </div>


                        <div class="col-1"></div>

                        <div class="col-3">
                            <div class="mt-2 text-capitalize">
                                City / Town
                            </div>
                        </div>
                        <div class="col-8 text-secondary">
                            <input type="text" class="form-control mt-2" name="residency_within_five_year__city_town[]" />
                        </div>

                        <div class="col-1"></div>


                        <div class="col-3">
                            <div class="mt-2 text-capitalize">
                                Department, Province or State
                            </div>
                        </div>
                        <div class="col-8 text-secondary">
                            <input type="text" class="form-control mt-2" name="residency_within_five_year__department_province_or_state[]" />
                        </div>

                        <div class="col-1"></div>

                        <div class="col-3">
                            <div class="mt-2 text-capitalize">
                                Country
                            </div>
                        </div>
                        <div class="col-8 text-secondary mt-1">
                            <select class="form-select single-select residency_within_five_year__country_select_class" aria-label="Default select example" name="residency_within_five_year__country[]">
                                <option selected disabled value="">Select</option>
                            </select>
                        </div>


                    </div>

                    <div class="row mb-3 entry_date_first_block_class" id="entry_date_first_block_id">

                        <div class="col-1"></div>

                        <div class="col-sm-3"></div>

                        <div class="col-sm-4 text-secondary">
                            <div class="mt-2 text-capitalize">
                                From
                            </div>
                            <input type="date" class="form-control" name="residency_within_five_year__from[]" />
                            <div class="text-muted">Click the calendar icon</div>
                        </div>
                        <div class="col-sm-4 text-secondary">
                            <div class="mt-2 text-capitalize">
                                To
                            </div>
                            <input type="date" class="form-control" name="residency_within_five_year__to[]" />
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

            <h6 class="text-capitalize">Residency Within 5 Year</h6>

        </div>


        <div class="col-9">



            <div class="row">

                <div class="col-12" id="residency_within_five_years_first_block_id">

                    <div class="row">

                        <div class="col-1 text-secondary">
                            <button class="btn btn-primary float-start" id="residency_within_five_years_first_block_add_button_id"> + </button>
                        </div>
                        <div class="col-3 text-capitalize">
                            <div>
                                Number and street
                            </div>
                        </div>
                        <div class="col-8 text-secondary">
                            <input type="text" class="form-control" name="residency_within_five_year__number_and_street[]" />
                        </div>


                        <div class="col-1"></div>

                        <div class="col-3">
                            <div class="mt-2 text-capitalize">
                                City / Town
                            </div>
                        </div>
                        <div class="col-8 text-secondary">
                            <input type="text" class="form-control mt-2" name="residency_within_five_year__city_town[]" />
                        </div>

                        <div class="col-1"></div>


                        <div class="col-3">
                            <div class="mt-2 text-capitalize">
                                Department, Province or State
                            </div>
                        </div>
                        <div class="col-8 text-secondary">
                            <input type="text" class="form-control mt-2" name="residency_within_five_year__department_province_or_state[]" />
                        </div>

                        <div class="col-1"></div>

                        <div class="col-3">
                            <div class="mt-2 text-capitalize">
                                Country
                            </div>
                        </div>
                        <div class="col-8 text-secondary mt-1">
                            <select class="form-select single-select residency_within_five_year__country_select_class" aria-label="Default select example" name="residency_within_five_year__country[]">
                                <option selected disabled value="">Select</option>
                            </select>
                        </div>


                    </div>

                    <div class="row mb-3 entry_date_first_block_class" id="entry_date_first_block_id">

                        <div class="col-1"></div>

                        <div class="col-sm-3"></div>

                        <div class="col-sm-4 text-secondary">
                            <div class="mt-2 text-capitalize">
                                From
                            </div>
                            <input type="date" class="form-control" name="residency_within_five_year__from[]" />
                            <div class="text-muted">Click the calendar icon</div>
                        </div>
                        <div class="col-sm-4 text-secondary">
                            <div class="mt-2 text-capitalize">
                                To
                            </div>
                            <input type="date" class="form-control" name="residency_within_five_year__to[]" />
                            <div class="text-muted">Click the calendar icon</div>
                        </div>

                    </div>

                </div>

            </div>




        </div>

    </div>

    @if(count($client_residency_within_five_years_data))

        <div class="row">
            <div class="col-3"></div>

            <div class="col-9">
                <table class="table table-bordered">
                    <thead>
                    <tr class="text-capitalize">
                        <th scope="col" class="text-uppercase">ID</th>
                        <th scope="col">Number and street</th>
                        <th scope="col">City / Town</th>
                        <th scope="col">Department, Province or State</th>
                        <th scope="col">Country</th>
                        <th scope="col">From</th>
                        <th scope="col">To</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($client_residency_within_five_years_data as $item)

                        <tr>
                            <th>{{ $item->id }}</th>
                            <td>{{ $item->number_and_street }}</td>
                            <td>{{ $item->city_town }}</td>
                            <td>{{ $item->department_province_or_state }}</td>
                            <td>{{ \App\Models\Crm\Country::find($item->country_id)->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->from)->format('m/d/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->to)->format('m/d/Y') }}</td>
                            <td class="w-auto">
                                <a class="btn btn-warning btn-sm" href="{{ route('residency_within_five_years->edit', $item->id) }}" role="button">Edit</a>
                                <a class="btn btn-danger btn-sm" href="{{ route('residency_within_five_years->delete', $item->id) }}" role="button">Delete</a>
                            </td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    @endif

@endif
