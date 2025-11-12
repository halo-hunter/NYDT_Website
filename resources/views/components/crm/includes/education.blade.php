@if(\Illuminate\Support\Facades\Route::currentRouteName() == 'clients->insert')

    <div class="row mb-3">

        <div class="col-3">

            <h6>Education</h6>

        </div>


        <div class="col-9">


            <div class="row">

                <div class="col-1 text-secondary"></div>

                <div class="col-3">
                    <div>
                        Name of School
                    </div>
                </div>
                <div class="col-8 text-secondary">
                    <input type="text" class="form-control" name="education__name_of_school" value="{{ old('education__name_of_school') }}" />
                </div>


                <div class="col-1"></div>

                <div class="col-3">
                    <div class="mt-2">
                        Type of School
                    </div>
                </div>
                <div class="col-8 text-secondary">
                    <input type="text" class="form-control mt-2" name="education__type_of_school" value="{{ old('education__type_of_school') }}"/>
                </div>

                <div class="col-1"></div>


                <div class="col-3">
                    <div class="mt-2">
                        Location
                    </div>
                </div>
                <div class="col-8 text-secondary">
                    <input type="text" class="form-control mt-2" name="education__location" value="{{ old('education__location') }}" />
                </div>

                <div class="col-1"></div>

                <div class="col-3">
                    <div class="mt-2">
                        Major
                    </div>
                </div>
                <div class="col-8 text-secondary">
                    <input type="text" class="form-control mt-2" name="education__major" value="{{ old('education__major') }}"/>
                </div>


            </div>

            <div class="row mb-3 entry_date_first_block_class" id="entry_date_first_block_id">

                <div class="col-1"></div>

                <div class="col-sm-3"></div>

                <div class="col-sm-4 text-secondary">
                    <div class="mt-2">
                        From
                    </div>
                    <input type="date" class="form-control" name="education__from" value="{{ old('education__from') }}" />
                    <div class="text-muted">Click the calendar icon</div>
                </div>
                <div class="col-sm-4 text-secondary">
                    <div class="mt-2">
                        To
                    </div>
                    <input type="date" class="form-control" name="education__to" value="{{ old('education__to') }}" />
                    <div class="text-muted">Click the calendar icon</div>
                </div>

            </div>

        </div>

    </div>

@elseif(\Illuminate\Support\Facades\Route::currentRouteName() == 'clients->edit')

    <div class="row mb-3">

        <div class="col-3">

            <h6>Education</h6>

        </div>


        <div class="col-9">


            <div class="row">

                <div class="col-1 text-secondary"></div>

                <div class="col-3">
                    <div>
                        Name of School
                    </div>
                </div>
                <div class="col-8 text-secondary">
                    <input type="text" class="form-control" name="education__name_of_school" value="{{ $client->education__name_of_school }}" />
                </div>


                <div class="col-1"></div>

                <div class="col-3">
                    <div class="mt-2">
                        Type of School
                    </div>
                </div>
                <div class="col-8 text-secondary">
                    <input type="text" class="form-control mt-2" name="education__type_of_school" value="{{ $client->education__type_of_school }}"/>
                </div>

                <div class="col-1"></div>


                <div class="col-3">
                    <div class="mt-2">
                        Location
                    </div>
                </div>
                <div class="col-8 text-secondary">
                    <input type="text" class="form-control mt-2" name="education__location" value="{{ $client->education__location }}" />
                </div>

                <div class="col-1"></div>

                <div class="col-3">
                    <div class="mt-2">
                        Major
                    </div>
                </div>
                <div class="col-8 text-secondary">
                    <input type="text" class="form-control mt-2" name="education__major" value="{{ $client->education__major }}"/>
                </div>


            </div>

            <div class="row mb-3 entry_date_first_block_class" id="entry_date_first_block_id">

                <div class="col-1"></div>

                <div class="col-sm-3"></div>

                <div class="col-sm-4 text-secondary">
                    <div class="mt-2">
                        From
                    </div>
                    <input type="date" class="form-control" name="education__from" value="{{ $client->education__from }}" />
                    <div class="text-muted">Click the calendar icon</div>
                </div>
                <div class="col-sm-4 text-secondary">
                    <div class="mt-2">
                        To
                    </div>
                    <input type="date" class="form-control" name="education__to" value="{{ $client->education__to }}" />
                    <div class="text-muted">Click the calendar icon</div>
                </div>

            </div>

        </div>

    </div>

@endif


