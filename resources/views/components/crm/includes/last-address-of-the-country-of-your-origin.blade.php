@if(\Illuminate\Support\Facades\Route::currentRouteName() == 'clients->insert')

    <div class="row mb-3">

        <div class="col-3">

            <h6>Last Address Of The Country Of Your Origin</h6>

        </div>


        <div class="col-9">


            <div class="row">

                <div class="col-1 text-secondary"></div>

                <div class="col-3">
                    <div>
                        Number and street
                    </div>
                </div>
                <div class="col-8 text-secondary">
                    <input type="text" class="form-control" name="last_address_of_the_country_of_your_origin__number_and_street" value="{{ old('last_address_of_the_country_of_your_origin__number_and_street') }}" />
                </div>


                <div class="col-1"></div>

                <div class="col-3">
                    <div class="mt-2">
                        City / Town
                    </div>
                </div>
                <div class="col-8 text-secondary">
                    <input type="text" class="form-control mt-2" name="last_address_of_the_country_of_your_origin__city_town" value="{{ old('last_address_of_the_country_of_your_origin__city_town') }}" />
                </div>

                <div class="col-1"></div>


                <div class="col-3">
                    <div class="mt-2">
                        Department, Province or State
                    </div>
                </div>
                <div class="col-8 text-secondary">
                    <input type="text" class="form-control mt-2" name="last_address_of_the_country_of_your_origin__department_province_or_state" value="{{ old('last_address_of_the_country_of_your_origin__department_province_or_state')  }}" />
                </div>

                <div class="col-1"></div>

                <div class="col-3">
                    <div class="mt-2">
                        Country
                    </div>
                </div>
                <div class="col-8 text-secondary mt-1">
                    <select class="form-select single-select" aria-label="Default select example" name="last_address_of_the_country_of_your_origin__country_id">
                        <option selected disabled value="">Select</option>
                        @foreach(\App\Models\Crm\Country::all() as $country)
                            <option value="{{ old('last_address_of_the_country_of_your_origin__country') != '' ? old('last_address_of_the_country_of_your_origin__country') : $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>


            </div>

            <div class="row mb-3 entry_date_first_block_class" id="entry_date_first_block_id">

                <div class="col-1"></div>

                <div class="col-sm-3"></div>

                <div class="col-sm-4 text-secondary">
                    <div class="mt-2">
                        From
                    </div>
                    <input type="date" class="form-control" name="last_address_of_the_country_of_your_origin__from" value="{{ old('last_address_of_the_country_of_your_origin__from') }}" />
                    <div class="text-muted">Click the calendar icon</div>
                </div>
                <div class="col-sm-4 text-secondary">
                    <div class="mt-2">
                        To
                    </div>
                    <input type="date" class="form-control" name="last_address_of_the_country_of_your_origin__to" value="{{ old('last_address_of_the_country_of_your_origin__to') }}" />
                    <div class="text-muted">Click the calendar icon</div>
                </div>

            </div>

        </div>

    </div>

@elseif(\Illuminate\Support\Facades\Route::currentRouteName() == 'clients->edit')

    <div class="row mb-3">

        <div class="col-3">

            <h6>Last Address Of The Country Of Your Origin</h6>

        </div>


        <div class="col-9">


            <div class="row">

                <div class="col-1 text-secondary"></div>

                <div class="col-3">
                    <div>
                        Number and street
                    </div>
                </div>
                <div class="col-8 text-secondary">
                    <input type="text" class="form-control" name="last_address_of_the_country_of_your_origin__number_and_street" value="{{ $client->last_address_o_t_c_o_y_o__number_and_street }}" />
                </div>


                <div class="col-1"></div>

                <div class="col-3">
                    <div class="mt-2">
                        City / Town
                    </div>
                </div>
                <div class="col-8 text-secondary">
                    <input type="text" class="form-control mt-2" name="last_address_of_the_country_of_your_origin__city_town" value="{{ $client->last_address_o_t_c_o_y_o__city_town }}" />
                </div>

                <div class="col-1"></div>


                <div class="col-3">
                    <div class="mt-2">
                        Department, Province or State
                    </div>
                </div>
                <div class="col-8 text-secondary">
                    <input type="text" class="form-control mt-2" name="last_address_of_the_country_of_your_origin__department_province_or_state" value="{{ $client->last_address_o_t_c_o_y_o__department_province_or_state }}" />
                </div>

                <div class="col-1"></div>

                <div class="col-3">
                    <div class="mt-2">
                        Country
                    </div>
                </div>
                <div class="col-8 text-secondary mt-1">
                    <select class="form-select single-select" aria-label="Default select example" name="last_address_of_the_country_of_your_origin__country_id">
                        <option value="">Select</option>
                        @foreach(\App\Models\Crm\Country::all() as $country)
                            <option value="{{ $country->id }}" {{ $client->last_address_o_t_c_o_y_o__country_id == $country->id ? 'selected' : '' }}>{{ $country->name }} @if($client->last_address_o_t_c_o_y_o__country_id == $country->id ? 'selected' : '') @endif</option>
                        @endforeach
                    </select>
                </div>


            </div>

            <div class="row mb-3 entry_date_first_block_class" id="entry_date_first_block_id">

                <div class="col-1"></div>

                <div class="col-sm-3"></div>

                <div class="col-sm-4 text-secondary">
                    <div class="mt-2">
                        From
                    </div>
                    <input type="date" class="form-control" name="last_address_of_the_country_of_your_origin__from" value="{{ $client->last_address_o_t_c_o_y_o__from }}" />
                    <div class="text-muted">Click the calendar icon</div>
                </div>
                <div class="col-sm-4 text-secondary">
                    <div class="mt-2">
                        To
                    </div>
                    <input type="date" class="form-control" name="last_address_of_the_country_of_your_origin__to" value="{{ $client->last_address_o_t_c_o_y_o__to }}" />
                    <div class="text-muted">Click the calendar icon</div>
                </div>

            </div>

        </div>

    </div>

@endif


