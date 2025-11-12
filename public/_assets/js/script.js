$(document).ready(function(){

    const current_page_url = window.location.href

    function show_hide_password(element_id) {
        if (element_id != '') {
            var element_id_var = "#" + element_id;
            $(element_id_var + " a").on('click', function (event) {
                event.preventDefault();
                if ($(element_id_var + " input").attr("type") == "text") {
                    $(element_id_var + ' input').attr('type', 'password');
                    $(element_id_var + ' i').addClass("bx-hide");
                    $(element_id_var + ' i').removeClass("bx-show");
                } else if ($(element_id_var + ' input').attr("type") == "password") {
                    $(element_id_var + ' input').attr('type', 'text');
                    $(element_id_var + ' i').removeClass("bx-hide");
                    $(element_id_var + ' i').addClass("bx-show");
                }
            });
        }
    }

    show_hide_password('show_hide_password')
    show_hide_password('show_hide_new_password')
    show_hide_password('show_hide_repeat_password')
    show_hide_password('show_hide_password_1')
    show_hide_password('show_hide_password_2')

    function button_loading_animation(element_class) {
        if (element_class != '') {
            var element_id_var = "." + element_class;
            $(element_id_var).click(function () {
                $(element_id_var).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading');
            })
        }
    }

    button_loading_animation('button_loading_animation_class')
    button_loading_animation('button_loading_animation_update_profile_data_class')
    button_loading_animation('button_loading_animation_update_profile_password_class')
    button_loading_animation('button_loading_animation_defence_asylum_class')

    function button_loading_animation_only_spinner(element_class) {
        if (element_class != '') {
            var element_id_var = "." + element_class;
            $(element_id_var).click(function () {
                $(element_id_var).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
            })
        }
    }

    button_loading_animation_only_spinner('button_loading_animation_notes_class')
    button_loading_animation_only_spinner('button_loading_animation_internal_comments_class')
    button_loading_animation_only_spinner('button_loading_animation_upload_document_class')

    $('.single-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });

    $('.multiple-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });

    $('#attorney_phone_number_input_id').mask('(000) 000-0000', {placeholder: "(___) ___-____"})
    $('#attorney_secondary_phone_number_input_id').mask('(000) 000-0000', {placeholder: "(___) ___-____"})
    $('.attorneys_table__phone_number').mask('(000) 000-0000', {placeholder: "(___) ___-____"})
    $('#customer_social_security_input_id').mask('000-00-0000', {placeholder: "123-45-6789"})
    $('#bank_card_payment_card_number_input_id').mask('0000-0000-0000-0000', {placeholder: "____-____-____-____"})
    $('#bank_card_payment_card_code_input_id').mask('0000')
    $('#bank_card_payment_card_exp_date_input_id').mask('0000-00')

    function upload_single_file_size_validation_2_mb(select_file_input_class, error_message_element_class) {
        var upload_retainer = $('.' + select_file_input_class)
        var upload_retainer_reference_text_file_size = $('.' + error_message_element_class)
        upload_retainer.change(function (e) {
            var upload_retainer_ = e.target
            var selected_file_size = (upload_retainer_.files[0].size / 1024) / 1024;
            if (selected_file_size > 10) {
                upload_retainer_reference_text_file_size.removeClass('text-muted')
                upload_retainer_reference_text_file_size.addClass('text-danger')
                upload_retainer.addClass('border-danger')
            } else {
                upload_retainer_reference_text_file_size.removeClass('text-danger')
                upload_retainer.removeClass('border-danger')
                upload_retainer_reference_text_file_size.addClass('text-muted')
            }
        })
    }

    function upload_single_file_size_validation_25_mb(select_file_input_class, error_message_element_class) {
        var upload_retainer = $('.' + select_file_input_class)
        var upload_retainer_reference_text_file_size = $('.' + error_message_element_class)
        upload_retainer.change(function (e) {
            var upload_retainer_ = e.target
            var selected_file_size = (upload_retainer_.files[0].size / 1024) / 1024;
            if (selected_file_size > 25) {
                upload_retainer_reference_text_file_size.removeClass('text-muted')
                upload_retainer_reference_text_file_size.addClass('text-danger')
                upload_retainer.addClass('border-danger')
            } else {
                upload_retainer_reference_text_file_size.removeClass('text-danger')
                upload_retainer.removeClass('border-danger')
                upload_retainer_reference_text_file_size.addClass('text-muted')
            }
        })
    }

    upload_single_file_size_validation_2_mb('upload_retainer', 'upload_retainer_reference_text_file_size')
    upload_single_file_size_validation_2_mb('document', 'upload_document_reference_text_file_size')
    upload_single_file_size_validation_2_mb('upload_a_form', 'exists_defence_asylum_reference_text_file_size')
    upload_single_file_size_validation_2_mb('upload_a_form', 'not_exists_defence_asylum_reference_text_file_size')

    upload_single_file_size_validation_25_mb('profile_photo', 'profile_photo_reference_text_file_size')
    upload_single_file_size_validation_25_mb('upload_retainer', 'upload_retainer_reference_text_file_size')
    upload_single_file_size_validation_25_mb('upload_a_form', 'exists_defence_asylum_reference_text_file_size')
    upload_single_file_size_validation_25_mb('upload_a_form', 'not_exists_defence_asylum_reference_text_file_size')
    upload_single_file_size_validation_25_mb('document', 'upload_document_reference_text_file_size')

    var uploader_document_delete_button_class = $('.uploader_document_delete_button_class')
    uploader_document_delete_button_class.click(function (e) {
        e.preventDefault()
        if (confirm('Are you sure?')) {
            this.form.submit()
        }
    })

    var payment_type_select_id = $('#payment_type_select_id')
    var payment_form_body_if_cash = $('#payment_form_body_if_cash')
    var payment_form_body_if_bank_card = $('#payment_form_body_if_bank_card')
    if (payment_type_select_id.val() == 'bank_card') {
        payment_form_body_if_cash.addClass('d-none')
        payment_form_body_if_bank_card.removeClass('d-none')
    } else if (payment_type_select_id.val() == 'cash') {
        payment_form_body_if_cash.removeClass('d-none')
        payment_form_body_if_bank_card.addClass('d-none')
    }
    payment_type_select_id.change(function (e) {
        e.preventDefault()
        if (payment_type_select_id.val() == 'bank_card') {
            payment_form_body_if_cash.addClass('d-none')
            payment_form_body_if_bank_card.removeClass('d-none')
        } else if (payment_type_select_id.val() == 'cash') {
            payment_form_body_if_cash.removeClass('d-none')
            payment_form_body_if_bank_card.addClass('d-none')
        }
    })
    var customer_payment_form_pay_button_id = $('#customer_payment_form_pay_button_id')
    customer_payment_form_pay_button_id.click(function (e) {

        var payment_type_select_id = $('#payment_type_select_id').val()

        var bank_card_payment_invoice_number_input_id = $('#bank_card_payment_invoice_number_input_id').val()
        var bank_card_payment_amount_input_id = $('#bank_card_payment_amount_input_id').val()
        var bank_card_payment_description_input_id = $('#bank_card_payment_description_input_id').val()
        var bank_card_payment_card_number_input_id = $('#bank_card_payment_card_number_input_id').val()
        var bank_card_payment_card_exp_date_input_id = $('#bank_card_payment_card_exp_date_input_id').val()
        var bank_card_payment_card_code_input_id = $('#bank_card_payment_card_code_input_id').val()
        var bank_card_payment_firstname_input_id = $('#bank_card_payment_firstname_input_id').val()
        var bank_card_payment_lastname_input_id = $('#bank_card_payment_lastname_input_id').val()
        var bank_card_payment_customer_select_id = $('#bank_card_payment_customer_select_id').val()
        var bank_card_payment_input_customer_id = $('#bank_card_payment_input_customer_id').val()

        var cash_payment_invoice_number_input_id = $('#cash_payment_invoice_number_input_id').val()
        var cash_payment_amount_input_id = $('#cash_payment_amount_input_id').val()
        var cash_payment_description_input_id = $('#cash_payment_description_input_id').val()
        var cash_payment_firstname_input_id = $('#cash_payment_firstname_input_id').val()
        var cash_payment_lastname_input_id = $('#cash_payment_lastname_input_id').val()
        var cash_payment_customer_select_id = $('#cash_payment_customer_select_id').val()
        var cash_payment_input_customer_id = $('#cash_payment_input_customer_id').val()

        if (payment_type_select_id == 'bank_card') {
            $.ajax({
                type:'POST',
                url:'/customers/make-a-payment',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    payment_type_select_id: payment_type_select_id,
                    payment_invoice_number_input_id: bank_card_payment_invoice_number_input_id,
                    payment_amount_input_id: bank_card_payment_amount_input_id,
                    payment_description_input_id: bank_card_payment_description_input_id,
                    bank_card_payment_card_number_input_id: bank_card_payment_card_number_input_id,
                    bank_card_payment_card_exp_date_input_id: bank_card_payment_card_exp_date_input_id,
                    bank_card_payment_card_code_input_id: bank_card_payment_card_code_input_id,
                    payment_firstname_input_id: bank_card_payment_firstname_input_id,
                    payment_lastname_input_id: bank_card_payment_lastname_input_id,
                    payment_customer_select_id: bank_card_payment_customer_select_id,
                    payment_input_customer_id: bank_card_payment_input_customer_id,
                },
                success:function(data){
                    if (JSON.parse(data)['code'] == 1) {
                        //console.log(JSON.parse(data)['message'])
                    } else if (JSON.parse(data)['code'] == 2) {
                        customer_payment_form_pay_button_id.remove()
                        $('#payment_success_message_message_id').removeClass('d-none')
                        $('#payment_success_message_message_text_id').text(JSON.parse(data)['message'])
                        //console.log(JSON.parse(data)['message'])
                    } else if (JSON.parse(data)['code'] == 0) {
                        customer_payment_form_pay_button_id.remove()
                        $('#payment_error_message_message_id').removeClass('d-none')
                        $('#payment_error_message_message_text_id').text(JSON.parse(data)['message'])
                        //console.log(JSON.parse(data)['message'])
                    } else {
                        //console.log(data)
                    }
                }
            })
        } else if (payment_type_select_id == 'cash') {
            $.ajax({
                type:'POST',
                url:'/customers/make-a-payment',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    payment_type_select_id: payment_type_select_id,
                    payment_invoice_number_input_id: cash_payment_invoice_number_input_id,
                    payment_amount_input_id: cash_payment_amount_input_id,
                    payment_description_input_id: cash_payment_description_input_id,
                    payment_firstname_input_id: cash_payment_firstname_input_id,
                    payment_lastname_input_id: cash_payment_lastname_input_id,
                    payment_customer_select_id: cash_payment_customer_select_id,
                    payment_input_customer_id: cash_payment_input_customer_id,
                },
                success:function(data){
                    if (JSON.parse(data)['code'] == 1) {
                        //console.log(JSON.parse(data)['message'])
                    }
                    else if (JSON.parse(data)['code'] == 3) {
                        customer_payment_form_pay_button_id.remove()
                        $('#payment_success_message_message_id').removeClass('d-none')
                        //console.log(JSON.parse(data)['message'])
                    } else {
                        //console.warn('Error, contact developer!')
                    }
                }
            })
        }
    })

    $('#customer_make_a_paymant_button_id').modal({
        backdrop: 'static',
        keyboard: false
    })

    $('#payment_modal_close_id').click(function (e) {
        e.preventDefault()
        location.reload()
    })

    $('#payment_modal_footer_close_button_id').click(function (e) {
        e.preventDefault()
        location.reload()
    })

    var other_block_input_id = $('#other_block_input_id')
    other_block_input_id.keyup('change', function () {
        var other_block_input_add_button_class = $('.other_block_input_add_button_class')
        if (other_block_input_id.val().length > 0) {
            other_block_input_add_button_class.attr('disabled', false)
        } else {
            other_block_input_add_button_class.attr('disabled', true)
        }
    })

    var other_block_input_add_button_class = $('.other_block_input_add_button_class')
    var other_block_class = $('.other_block_class')
    var cloned_other_blocks = $('.cloned_other_blocks')
    other_block_input_add_button_class.click(function () {
        var other_block_input_class = $('.other_block_input_class')
        var max_allowed_document_types_message_class = $('.max_allowed_document_types_message_class')
        if (other_block_input_class.length != 10) {
            var cl = other_block_class.clone()
            var cl = cl.removeClass('d-none')
            cloned_other_blocks.append(cl)
            max_allowed_document_types_message_class.addClass('d-none')
        } else {
            max_allowed_document_types_message_class.removeClass('d-none')
        }
        var other_block_input_remove_button_class = $('.other_block_input_remove_button_class')
        other_block_input_remove_button_class.click(function () {
            var other_block_input_class = $('.other_block_input_class')
            $(this).parent().closest('.other_block_class').remove()
            if (other_block_input_class.length != 10) {
                max_allowed_document_types_message_class.addClass('d-none')
            } else {
                max_allowed_document_types_message_class.removeClass('d-none')
            }
        })
    })

    var requested_documents_modal_close_button_class = $('.requested_documents_modal_close_button_class')
    requested_documents_modal_close_button_class.click(function () {
        document.location.reload()
    })

    var request_documents_form_id = $('#request_documents_form_id')
    request_documents_form_id.click(function () {

        request_documents_form_id.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading')
        request_documents_form_id.attr('disabled', true)

        var customer_document_checkbox_class = $('.customer_document_checkbox_class')
        var form_required_checkbox_elements = []
        var form_required_checkbox_values = []
        customer_document_checkbox_class.each(function (index, value) {
            if (!$(value).is(':checked')) {
                form_required_checkbox_elements.push(0)
            } else {
                form_required_checkbox_elements.push(1)
                form_required_checkbox_values.push($(value).val())
            }
        })

        var other_block_input_class_for_required_check = $('.other_block_input_class_for_required_check')
        var form_required_input_elements = []
        var form_required_input_values = []
        other_block_input_class_for_required_check.each(function (index, value) {
            if (!$(value).val() != '') {
                form_required_input_elements.push(0)
            } else {
                form_required_input_elements.push(1)
                form_required_input_values.push($(value).val())
            }
        })

        var required_message = $('#required_message')

        if (form_required_checkbox_elements.includes(1) || form_required_input_elements.includes(1)) {
            required_message.addClass('d-none')
            var case_id = $('#case_id')
            var success_message_id = $('#success_message_id')
            var error_message_id = $('#error_message_id')

            $.ajax({
                type:'POST',
                url:'/cases/send-required-documents',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    case_id: case_id.val(),
                    checkbox_values_array: form_required_checkbox_values,
                    input_value_array: form_required_input_values
                },
                success:function(data){
                    if (JSON.parse(data)['code'] == 1) {
                        success_message_id.removeClass('d-none')
                        success_message_id.text(JSON.parse(data)['message'])
                        request_documents_form_id.text('Send Email')
                        request_documents_form_id.attr('disabled', false)
                    } else {
                        error_message_id.removeClass('d-none')
                        error_message_id.text(JSON.parse(data)['message'])
                        request_documents_form_id.text('Send Email')
                        request_documents_form_id.attr('disabled', false)
                    }
                }
            })
        } else {
            required_message.removeClass('d-none')
            request_documents_form_id.text('Send Email')
            request_documents_form_id.attr('disabled', false)
        }
    })

    $('#portal_customer_phone_number_input_id').mask('+1 000 000 - 0000', {placeholder: "+1 ___ ___ - ____"})
    $('#portal_secondarycustomer_phone_number_input_id').mask('+1 000 000 - 0000', {placeholder: "+1 ___ ___ - ____"})

    var requested_documents_submit_button_id = $('#requested_documents_submit_button_id')
    requested_documents_submit_button_id.click(function () {
        var requested_documents_form_file_inputs_class = $('.requested_documents_form_file_inputs_class')
        var success_input_values_array = []
        requested_documents_form_file_inputs_class.each(function (index, value) {
            if ($(value).val() != '') {
                success_input_values_array.push(index)
            }
        })
        if (requested_documents_form_file_inputs_class.length == success_input_values_array.length) {
            requested_documents_submit_button_id.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading')
        }
    })

    if (current_page_url.includes('clients/add')) {

        const family_member_add_button_id = $('#family_member_add_button_id')
        const family_member_first_block_id = $('#family_member_first_block_id')
        const family_member_additional_block_id = $('#family_member_additional_block_id')

        const family_member_row_template = '<div class="row mt-3 family_member_first_block_class"> <div class="col-3"> <label for="">Relation</label> <input type="text" class="form-control family_member_relation_input_class" name="family_member[][relation]"/> </div><div class="col-3"> <label for="">First name</label> <input type="text" class="form-control family_member_first_name_input_class" name="family_member[][first_name]"/> </div><div class="col-3"> <label for="">Last name</label> <input type="text" class="form-control family_member_last_name_input_class" name="family_member[][last_name]"/> </div><div class="col-3"> <button class="btn btn-danger btn family_member_remove_class" id="family_member_delete_button_id"><i class="fadeIn animated bx bx-trash"></i></button> </div></div>'

        family_member_add_button_id.click(function (e) {

            const family_member_add_button = $(this)
            e.preventDefault()
            family_member_additional_block_id.append(family_member_row_template)

            $('.family_member_remove_class').click(function (e) {
                e.preventDefault()
                $(this).closest('.family_member_first_block_class').remove()
                if ($('.family_member_first_block_class').length != 20) {
                    family_member_add_button.show()
                }
            })

            if ($('.family_member_first_block_class').length == 20) {
                family_member_add_button.hide()
            }

        })

        $('#client_add_form_button_id').click(function (e) {

            const client_add_form_button = $(this)

            $.each($('.family_member_first_block_class'), function (index, element) {

                var family_member_block = $(element)

                if (family_member_block.find('.family_member_relation_input_class').val() != '') {
                    if (family_member_block.find('.family_member_first_name_input_class').val() == '' || family_member_block.find('.family_member_last_name_input_class').val() == '') {

                        e.preventDefault()

                        if (family_member_block.find('.family_member_first_name_input_class').val() == '') {
                            family_member_block.find('.family_member_first_name_input_class').addClass('border-danger')
                        } else {
                            family_member_block.find('.family_member_first_name_input_class').removeClass('border-danger')
                        }

                        if (family_member_block.find('.family_member_last_name_input_class').val() == '') {
                            family_member_block.find('.family_member_last_name_input_class').addClass('border-danger')
                        } else {
                            family_member_block.find('.family_member_last_name_input_class').removeClass('border-danger')
                        }

                        client_add_form_button.text('Add')

                    } else {
                        family_member_block.find('.family_member_first_name_input_class').removeClass('border-danger')
                        family_member_block.find('.family_member_last_name_input_class').removeClass('border-danger')
                    }
                }

                if (family_member_block.find('.family_member_first_name_input_class').val() != '') {
                    if (family_member_block.find('.family_member_relation_input_class').val() == '' || family_member_block.find('.family_member_last_name_input_class').val() == '') {

                        e.preventDefault()

                        if (family_member_block.find('.family_member_relation_input_class').val() == '') {
                            family_member_block.find('.family_member_relation_input_class').addClass('border-danger')
                        } else {
                            family_member_block.find('.family_member_relation_input_class').removeClass('border-danger')
                        }

                        if (family_member_block.find('.family_member_last_name_input_class').val() == '') {
                            family_member_block.find('.family_member_last_name_input_class').addClass('border-danger')
                        } else {
                            family_member_block.find('.family_member_last_name_input_class').removeClass('border-danger')
                        }

                        client_add_form_button.text('Add')

                    } else {
                        family_member_block.find('.family_member_relation_input_class').removeClass('border-danger')
                        family_member_block.find('.family_member_last_name_input_class').removeClass('border-danger')
                    }
                }

                if (family_member_block.find('.family_member_last_name_input_class').val() != '') {
                    if (family_member_block.find('.family_member_first_name_input_class').val() == '' || family_member_block.find('.family_member_relation_input_class').val() == '') {

                        e.preventDefault()

                        if (family_member_block.find('.family_member_relation_input_class').val() == '') {
                            family_member_block.find('.family_member_relation_input_class').addClass('border-danger')
                        } else {
                            family_member_block.find('.family_member_relation_input_class').removeClass('border-danger')
                        }

                        if (family_member_block.find('.family_member_first_name_input_class').val() == '') {
                            family_member_block.find('.family_member_first_name_input_class').addClass('border-danger')
                        } else {
                            family_member_block.find('.family_member_first_name_input_class').removeClass('border-danger')
                        }

                        client_add_form_button.text('Add')

                    } else {
                        family_member_block.find('.family_member_relation_input_class').removeClass('border-danger')
                        family_member_block.find('.family_member_first_name_input_class').removeClass('border-danger')
                    }
                }

            })




        })

        function add_countries_to_country_select() {

            fetch(document.location.origin + '/api/countries')
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {

                    const options = data

                    const residency_within_five_year__country_select_class = document.querySelectorAll('.residency_within_five_year__country_select_class')

                    residency_within_five_year__country_select_class.forEach(function (item) {

                        const select = item

                        options.forEach(function(option) {
                            const optionElement = document.createElement('option');
                            optionElement.value = option.id;
                            optionElement.textContent = option.name;
                            select.appendChild(optionElement);
                        });


                    })

                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation: ' + error.message);
                })

        }

        add_countries_to_country_select()

        const employment_within_last_five_years_first_block = document.getElementById('employment_within_last_five_years_first_block_id')
        const employment_within_last_five_years_first_block_add = document.getElementById('employment_within_last_five_years_first_block_add_id')

        const employment_within_last_five_years_first_block_template = '<div class="col-12 employment_within_last_five_years_additional_block_class"> <div class="row"> <div class="col-1 text-secondary"> <button class="btn btn-danger float-start employment_within_last_five_years_additional_block_remove_button_class"> - </button> </div> <div class="col-3"> <div> Name </div> </div> <div class="col-8 text-secondary"> <input type="text" class="form-control" name="employment_within_last_five_years__name[]" /> </div> <div class="col-1"></div> <div class="col-3"> <div class="mt-2"> Address of Employer </div> </div> <div class="col-8 text-secondary"> <input type="text" class="form-control mt-2" name="employment_within_last_five_years__address_of_employer[]" /> </div> <div class="col-1"></div> <div class="col-3"> <div class="mt-2"> Your Occupation </div> </div> <div class="col-8 text-secondary"> <input type="text" class="form-control mt-2" name="employment_within_last_five_years__your_occupation[]" /> </div> </div> <div class="row mb-3 entry_date_first_block_class" id="entry_date_first_block_id"> <div class="col-1"></div> <div class="col-sm-3"></div> <div class="col-sm-4 text-secondary"> <div class="mt-2"> From </div> <input type="date" class="form-control" name="employment_within_last_five_years__from[]" /> <div class="text-muted">Click the calendar icon</div> </div> <div class="col-sm-4 text-secondary"> <div class="mt-2"> To </div> <input type="date" class="form-control" name="employment_within_last_five_years__to[]" /> <div class="text-muted">Click the calendar icon</div> </div> </div> </div>'

        employment_within_last_five_years_first_block_add.addEventListener('click', function (e) {

            e.preventDefault()

            const max_employment_within_last_five_years_additional_blocks_length = 15

            function count_employment_within_last_five_years_additional_blocks__add() {

                const employment_within_last_five_years_additional_block_remove_button_class = document.querySelectorAll('.employment_within_last_five_years_additional_block_remove_button_class')

                return  Number(employment_within_last_five_years_additional_block_remove_button_class.length + 1)

            }

            function count_employment_within_last_five_years_additional_blocks__remove() {

                const employment_within_last_five_years_additional_block_remove_button_class = document.querySelectorAll('.employment_within_last_five_years_additional_block_remove_button_class')

                return  Number(employment_within_last_five_years_additional_block_remove_button_class.length)

            }

            if (count_employment_within_last_five_years_additional_blocks__add() >= max_employment_within_last_five_years_additional_blocks_length) {

                employment_within_last_five_years_first_block_add.classList.add('d-none')

            }

            employment_within_last_five_years_first_block.insertAdjacentHTML('afterend', employment_within_last_five_years_first_block_template)

            const employment_within_last_five_years_additional_block_remove_button_class = document.querySelectorAll('.employment_within_last_five_years_additional_block_remove_button_class')

            employment_within_last_five_years_additional_block_remove_button_class.forEach(function (item) {

                const remove_button = item

                remove_button.addEventListener('click', function (e) {
                    e.preventDefault()

                    if (count_employment_within_last_five_years_additional_blocks__remove() <= max_employment_within_last_five_years_additional_blocks_length) {

                        employment_within_last_five_years_first_block_add.classList.remove('d-none')

                    }

                    const whole_block = this.parentElement.parentElement.parentElement

                    whole_block.remove()

                })

            })

        })

        const residency_within_five_years_first_block = document.getElementById('residency_within_five_years_first_block_id')
        const residency_within_five_years_first_block_add_button = document.getElementById('residency_within_five_years_first_block_add_button_id')

        const residency_within_five_years_first_block_template = '<div class="col-12 residency_within_five_years_first_block_class"><div class="row"><div class="col-1 text-secondary"><button class="btn btn-danger float-start residency_within_five_years_first_block_remove_button_class">-</button></div><div class="col-3"><div>Number and street</div></div><div class="col-8 text-secondary"><input type="text" class="form-control" name="residency_within_five_year__number_and_street[]"></div><div class="col-1"></div><div class="col-3"><div class="mt-2">City / Town</div></div><div class="col-8 text-secondary"><input type="text" class="form-control mt-2" name="residency_within_five_year__city_town[]"></div><div class="col-1"></div><div class="col-3"><div class="mt-2">Department, Province or State</div></div><div class="col-8 text-secondary"><input type="text" class="form-control mt-2" name="residency_within_five_year__department_province_or_state[]"></div><div class="col-1"></div><div class="col-3"><div class="mt-2">Country</div></div><div class="col-8 text-secondary mt-1"><select class="form-select single-select residency_within_five_year__country_select_class" aria-label="Default select example" name="residency_within_five_year__country[]"><option selected="selected" disabled="disabled" value="">Select</option></select></div></div><div class="row mb-3 entry_date_first_block_class" id="entry_date_first_block_id"><div class="col-1"></div><div class="col-sm-3"></div><div class="col-sm-4 text-secondary"><div class="mt-2">From</div><input type="date" class="form-control" name="residency_within_five_year__from[]"><div class="text-muted">Click the calendar icon</div></div><div class="col-sm-4 text-secondary"><div class="mt-2">To</div><input type="date" class="form-control" name="residency_within_five_year__to[]"><div class="text-muted">Click the calendar icon</div></div></div></div>'

        residency_within_five_years_first_block_add_button.addEventListener('click', function (e) {

            e.preventDefault()

            const max_within_five_years_first_blocks_length = 15

            function count_within_five_years_first_blocks__add() {

                const residency_within_five_years_first_block_remove_button_class = document.querySelectorAll('.residency_within_five_years_first_block_remove_button_class')

                return  Number(residency_within_five_years_first_block_remove_button_class.length + 1)

            }

            function count_within_five_years_first_blocks__remove() {

                const residency_within_five_years_first_block_remove_button_class = document.querySelectorAll('.residency_within_five_years_first_block_remove_button_class')

                return  Number(residency_within_five_years_first_block_remove_button_class.length)

            }

            if (count_within_five_years_first_blocks__add() >= max_within_five_years_first_blocks_length) {

                residency_within_five_years_first_block_add_button.classList.add('d-none')

            }

            residency_within_five_years_first_block.insertAdjacentHTML('afterend', residency_within_five_years_first_block_template)

            $('.single-select').select2({
                theme: 'bootstrap4',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
            });

            add_countries_to_country_select()

            const residency_within_five_years_first_block_remove_button_class = document.querySelectorAll('.residency_within_five_years_first_block_remove_button_class')

            residency_within_five_years_first_block_remove_button_class.forEach(function (item) {

                const remove_button = item

                remove_button.addEventListener('click', function (e) {
                    e.preventDefault()

                    if (count_within_five_years_first_blocks__remove() <= max_within_five_years_first_blocks_length) {

                        residency_within_five_years_first_block_add_button.classList.remove('d-none')

                    }

                    const whole_block = this.parentElement.parentElement.parentElement

                    whole_block.remove()

                })

            })

        })

    }

    if (current_page_url.includes('clients/edit')) {

        const family_member_add_button_id = $('#family_member_add_button_id')
        const family_member_first_block_id = $('#family_member_first_block_id')
        const family_member_additional_block_id = $('#family_member_additional_block_id')

        const family_member_row_template = '<div class="row mt-3 mb-3 family_member_first_block_class"> <div class="col-3"> <label for="">Relation</label> <input type="text" class="form-control family_member_relation_input_class" name="family_member[][relation]"/> </div><div class="col-3"> <label for="">First name</label> <input type="text" class="form-control family_member_first_name_input_class" name="family_member[][first_name]"/> </div><div class="col-3"> <label for="">Last name</label> <input type="text" class="form-control family_member_last_name_input_class" name="family_member[][last_name]"/> </div><div class="col-3"> <button class="btn btn-danger btn family_member_remove_class" id="family_member_delete_button_id"><i class="fadeIn animated bx bx-trash"></i></button> </div></div>'

        family_member_add_button_id.click(function (e) {

            const family_member_add_button = $(this)
            e.preventDefault()
            family_member_additional_block_id.append(family_member_row_template)

            $('.family_member_remove_class').click(function (e) {
                e.preventDefault()
                $(this).closest('.family_member_first_block_class').remove()
                if ($('.family_member_first_block_class').length != 20) {
                    family_member_add_button.show()
                }
            })

            if ($('.family_member_first_block_class').length == 20) {
                family_member_add_button.hide()
            }

        })

        $('#client_update_form_button_id').click(function (e) {

            const client_add_form_button = $(this)

            $.each($('.family_member_first_block_class'), function (index, element) {

                var family_member_block = $(element)

                if (family_member_block.find('.family_member_relation_input_class').val() != '') {
                    if (family_member_block.find('.family_member_first_name_input_class').val() == '' || family_member_block.find('.family_member_last_name_input_class').val() == '') {

                        e.preventDefault()

                        if (family_member_block.find('.family_member_first_name_input_class').val() == '') {
                            family_member_block.find('.family_member_first_name_input_class').addClass('border-danger')
                        } else {
                            family_member_block.find('.family_member_first_name_input_class').removeClass('border-danger')
                        }

                        if (family_member_block.find('.family_member_last_name_input_class').val() == '') {
                            family_member_block.find('.family_member_last_name_input_class').addClass('border-danger')
                        } else {
                            family_member_block.find('.family_member_last_name_input_class').removeClass('border-danger')
                        }

                        client_add_form_button.text('Update')

                    } else {
                        family_member_block.find('.family_member_first_name_input_class').removeClass('border-danger')
                        family_member_block.find('.family_member_last_name_input_class').removeClass('border-danger')
                    }
                }

                if (family_member_block.find('.family_member_first_name_input_class').val() != '') {
                    if (family_member_block.find('.family_member_relation_input_class').val() == '' || family_member_block.find('.family_member_last_name_input_class').val() == '') {

                        e.preventDefault()

                        if (family_member_block.find('.family_member_relation_input_class').val() == '') {
                            family_member_block.find('.family_member_relation_input_class').addClass('border-danger')
                        } else {
                            family_member_block.find('.family_member_relation_input_class').removeClass('border-danger')
                        }

                        if (family_member_block.find('.family_member_last_name_input_class').val() == '') {
                            family_member_block.find('.family_member_last_name_input_class').addClass('border-danger')
                        } else {
                            family_member_block.find('.family_member_last_name_input_class').removeClass('border-danger')
                        }

                        client_add_form_button.text('Update')

                    } else {
                        family_member_block.find('.family_member_relation_input_class').removeClass('border-danger')
                        family_member_block.find('.family_member_last_name_input_class').removeClass('border-danger')
                    }
                }

                if (family_member_block.find('.family_member_last_name_input_class').val() != '') {
                    if (family_member_block.find('.family_member_first_name_input_class').val() == '' || family_member_block.find('.family_member_relation_input_class').val() == '') {

                        e.preventDefault()

                        if (family_member_block.find('.family_member_relation_input_class').val() == '') {
                            family_member_block.find('.family_member_relation_input_class').addClass('border-danger')
                        } else {
                            family_member_block.find('.family_member_relation_input_class').removeClass('border-danger')
                        }

                        if (family_member_block.find('.family_member_first_name_input_class').val() == '') {
                            family_member_block.find('.family_member_first_name_input_class').addClass('border-danger')
                        } else {
                            family_member_block.find('.family_member_first_name_input_class').removeClass('border-danger')
                        }

                        client_add_form_button.text('Update')

                    } else {
                        family_member_block.find('.family_member_relation_input_class').removeClass('border-danger')
                        family_member_block.find('.family_member_first_name_input_class').removeClass('border-danger')
                    }
                }

            })




        })


        const employment_within_last_five_years_first_block = document.getElementById('employment_within_last_five_years_first_block_id')
        const employment_within_last_five_years_first_block_add = document.getElementById('employment_within_last_five_years_first_block_add_id')

        const employment_within_last_five_years_first_block_template = '<div class="col-12 employment_within_last_five_years_additional_block_class"> <div class="row"> <div class="col-1 text-secondary"> <button class="btn btn-danger float-start employment_within_last_five_years_additional_block_remove_button_class"> - </button> </div> <div class="col-3"> <div> Name </div> </div> <div class="col-8 text-secondary"> <input type="text" class="form-control" name="employment_within_last_five_years__name[]" /> </div> <div class="col-1"></div> <div class="col-3"> <div class="mt-2"> Address of Employer </div> </div> <div class="col-8 text-secondary"> <input type="text" class="form-control mt-2" name="employment_within_last_five_years__address_of_employer[]" /> </div> <div class="col-1"></div> <div class="col-3"> <div class="mt-2"> Your Occupation </div> </div> <div class="col-8 text-secondary"> <input type="text" class="form-control mt-2" name="employment_within_last_five_years__your_occupation[]" /> </div> </div> <div class="row mb-3 entry_date_first_block_class" id="entry_date_first_block_id"> <div class="col-1"></div> <div class="col-sm-3"></div> <div class="col-sm-4 text-secondary"> <div class="mt-2"> From </div> <input type="date" class="form-control" name="employment_within_last_five_years__from[]" /> <div class="text-muted">Click the calendar icon</div> </div> <div class="col-sm-4 text-secondary"> <div class="mt-2"> To </div> <input type="date" class="form-control" name="employment_within_last_five_years__to[]" /> <div class="text-muted">Click the calendar icon</div> </div> </div> </div>'

        employment_within_last_five_years_first_block_add.addEventListener('click', function (e) {

            e.preventDefault()

            const max_employment_within_last_five_years_additional_blocks_length = 15

            function count_employment_within_last_five_years_additional_blocks__add() {

                const employment_within_last_five_years_additional_block_remove_button_class = document.querySelectorAll('.employment_within_last_five_years_additional_block_remove_button_class')

                return  Number(employment_within_last_five_years_additional_block_remove_button_class.length + 1)

            }

            function count_employment_within_last_five_years_additional_blocks__remove() {

                const employment_within_last_five_years_additional_block_remove_button_class = document.querySelectorAll('.employment_within_last_five_years_additional_block_remove_button_class')

                return  Number(employment_within_last_five_years_additional_block_remove_button_class.length)

            }

            if (count_employment_within_last_five_years_additional_blocks__add() >= max_employment_within_last_five_years_additional_blocks_length) {

                employment_within_last_five_years_first_block_add.classList.add('d-none')

            }

            employment_within_last_five_years_first_block.insertAdjacentHTML('afterend', employment_within_last_five_years_first_block_template)

            const employment_within_last_five_years_additional_block_remove_button_class = document.querySelectorAll('.employment_within_last_five_years_additional_block_remove_button_class')

            employment_within_last_five_years_additional_block_remove_button_class.forEach(function (item) {

                const remove_button = item

                remove_button.addEventListener('click', function (e) {
                    e.preventDefault()

                    if (count_employment_within_last_five_years_additional_blocks__remove() <= max_employment_within_last_five_years_additional_blocks_length) {

                        employment_within_last_five_years_first_block_add.classList.remove('d-none')

                    }

                    const whole_block = this.parentElement.parentElement.parentElement

                    whole_block.remove()

                })

            })

        })





    }


    if (current_page_url.includes('cases/edit')) {

        const add_todo_task_form = document.getElementById('add_todo_task_form_id')
        const todo_add_task_button = document.getElementById('todo_add_task_button_id')
        const todo_add_task_task_definition_option = document.getElementById('todo_add_task_task_definition_option_id')
        const todo_add_task_select_a_user_select = document.getElementById('todo_add_task_select_a_user_select_id')

        todo_add_task_button.addEventListener('click', function () {

            if (todo_add_task_task_definition_option.value != '' && todo_add_task_select_a_user_select.value != '') {

                todo_add_task_button.setAttribute('disabled', true)
                todo_add_task_button.textContent = 'Loading...'
                add_todo_task_form.submit()


            }

        })

        $('#mark_as_complete_minutes_input_id').mask('00', {placeholder: "__"})

        const todo_task_id_input = document.getElementById('todo_task_id_input_id')
        const mark_as_complete_todo_task_button = document.getElementById('mark_as_complete_todo_task_button_id')

        if (mark_as_complete_todo_task_button) {

            todo_task_id_input.value = mark_as_complete_todo_task_button.dataset.todo_task_id

            const completion_date = document.getElementById('completion_date_input_id')
            const mark_as_complete_hours = document.getElementById('mark_as_complete_hours_input_id')
            const mark_as_complete_todo_task_form = document.getElementById('mark_as_complete_todo_task_form_id')

            const modal_mark_as_complete_todo_task_button = document.getElementById('modal_mark_as_complete_todo_task_button_id')

            modal_mark_as_complete_todo_task_button.addEventListener('click', function () {

                if (todo_task_id_input.value != '' && completion_date.value != '' && mark_as_complete_hours.value != '') {

                    modal_mark_as_complete_todo_task_button.setAttribute('disabled', true)
                    modal_mark_as_complete_todo_task_button.textContent = 'Loading...'
                    mark_as_complete_todo_task_form.submit()

                }

            })

        }

        function show_hide_case_type_select() {

            const case_type_select = document.getElementById('case_type_select_id')

            const case_type_block = document.getElementById('case_type_block_id')

            if (case_type_select.value == 'Immigration') {

                case_type_block.classList.remove('d-none')

            } else {

                case_type_block.classList.add('d-none')

            }

        }

        show_hide_case_type_select()

        const case_type_select = document.getElementById('case_type_select_id')

        case_type_select.addEventListener('change', function () {

            show_hide_case_type_select()

        })

    }

    const notification_blocks = document.querySelectorAll('.notification_block_class')

    notification_blocks.forEach(function (item, index) {

        item.addEventListener('click',function (e) {

            e.preventDefault()

            window.location.href = this.dataset.url + '?record_id=' + this.dataset.id

        })

    })

    if (current_page_url.includes('clients/edit')) {

        function fill_rider_select_options() {

            const clientId = document.getElementById('select_rider_id').dataset.clientid

            function postWithData(url) {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

                const data = {
                    clientId: clientId
                }

                const jsonData = JSON.stringify(data)

                const fetchOptions = {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: jsonData
                };

                return fetch(url, fetchOptions)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        throw error;
                    });
            }

            const url = document.location.origin + '/riders'

            postWithData(url)
                .then(responseData => {

                    const riders = responseData

                    const selects = document.querySelectorAll('.select_rider_class')

                    selects.forEach(function (item) {

                        const select = item

                        // while (select.options.length > 0) {
                        //
                        //     select.remove(0)
                        //
                        // }

                        function addOptionToSelect(selectElement, value, text) {
                            const option = document.createElement('option');
                            option.value = value;
                            option.textContent = text;
                            selectElement.appendChild(option);
                        }

                        addOptionToSelect(select, '', 'Select');

                        let currentValue = select.value;

                        riders.forEach(function (item) {
                            let option = document.createElement('option');
                            option.value = item.id;
                            option.textContent = item.firstname + ' ' + item.lastname;
                            select.appendChild(option);
                        });

                        select.value = currentValue;

                        function removeDuplicateOptions(selectElement) {
                            let existingOptions = {};
                            Array.from(selectElement.options).forEach(option => {
                                if (existingOptions[option.value]) {
                                    selectElement.removeChild(option);
                                } else {
                                    existingOptions[option.value] = true;
                                }
                            });
                        }

                        removeDuplicateOptions(select);

                    })

                })
                .catch(error => {
                    console.error('Error in fetching data:', error)
                })

        }

        fill_rider_select_options()

        const create_a_rider_profile_button = document.getElementById('create_a_rider_profile_button_id')

        create_a_rider_profile_button.addEventListener('click', function (e) {

            const create_a_rider_profile = this

            e.preventDefault()

            const myModal = new bootstrap.Modal(document.getElementById('create_a_rider_profile_modal_id'));

            myModal.show()

            const clientId = document.getElementById('select_rider_id').dataset.clientid

            const create_a_rider_modal_client_id = document.getElementById('create_a_rider_modal_client_id')

            create_a_rider_modal_client_id.value = clientId

            const add_rider_button = document.getElementById('add_rider_button_id')
            const add_rider_firstname_input = document.getElementById('add_rider_firstname_input_id')
            const add_rider_lastname_input = document.getElementById('add_rider_lastname_input_id')

            const add_rider_close_button = document.getElementById('add_rider_close_button_id')

            add_rider_button.addEventListener('click', function (e) {

                e.preventDefault()

                add_rider_button.setAttribute('disabled', true)

                if (!add_rider_firstname_input.checkValidity()) {

                    add_rider_button.removeAttribute('disabled')

                    add_rider_firstname_input.classList.add('border-danger')

                } else {

                    add_rider_button.removeAttribute('disabled')

                    add_rider_firstname_input.classList.remove('border-danger')

                }

                if (!add_rider_lastname_input.checkValidity()) {

                    add_rider_button.removeAttribute('disabled')

                    add_rider_lastname_input.classList.add('border-danger')

                } else {

                    add_rider_button.removeAttribute('disabled')

                    add_rider_lastname_input.classList.remove('border-danger')

                }

                if (add_rider_firstname_input.checkValidity() && add_rider_lastname_input.checkValidity()) {

                    fill_rider_select_options()

                    function postWithData(url, firstname, lastname, client_id) {
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        const data = {
                            firstname: firstname,
                            lastname: lastname,
                            client_id: client_id
                        };
                        const jsonData = JSON.stringify(data);
                        const fetchOptions = {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: jsonData
                        };

                        return fetch(url, fetchOptions)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(`HTTP error! status: ${response.status}`);
                                }
                                return response.json();
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                throw error;
                            });
                    }

                    const add_rider_url = document.location.origin + '/riders/add'

                    const rider_exists_alert = document.getElementById('rider_exists_alert_id')

                    postWithData(add_rider_url, add_rider_firstname_input.value, add_rider_lastname_input.value, create_a_rider_modal_client_id.value)
                        .then(responseData => {

                            const result = responseData

                            if (result == 1) {

                                add_rider_firstname_input.value = ''
                                add_rider_lastname_input.value = ''

                                rider_exists_alert.classList.remove('d-none')

                                add_rider_button.removeAttribute('disabled')

                            } else {

                                fill_rider_select_options()

                                add_rider_firstname_input.value = ''
                                add_rider_lastname_input.value = ''

                                add_rider_close_button.click()

                            }

                        })
                        .catch(error => {
                            console.error('Error in fetching data:', error);
                        });

                }

            }, { once: true })


        })

        const add_rider_close_button = document.getElementById('add_rider_close_button_id')

        add_rider_close_button.addEventListener('click', function () {

            const rider_exists_alert = document.getElementById('rider_exists_alert_id')
            const add_rider_firstname_input = document.getElementById('add_rider_firstname_input_id')
            const add_rider_lastname_input = document.getElementById('add_rider_lastname_input_id')

            add_rider_firstname_input.value = ''
            add_rider_lastname_input.value = ''
            rider_exists_alert.classList.add('d-none')

            add_rider_firstname_input.classList.remove('border-danger')
            add_rider_lastname_input.classList.remove('border-danger')

        })

        const rider_add_button_id = $('#rider_add_button_id')
        const rider_first_block_id = $('#rider_first_block_id')
        const rider_additional_block_id = $('#rider_additional_block_id')

        const rider_row_template = '<div class="row rider_first_block_class" id="rider_first_block_id"> <div class="col-3"> <label for="">Relation</label> <input type="text" class="form-control rider_relation_input_class" name="rider[][relation]" /> </div> <div class="col-3"> <label for="">Select</label> <select class="form-select text-capitalize select_rider_class" aria-label="Default select example" name="rider[][riders]" id="select_rider_id"></select> </div> <div class="col-3"> <button class="btn btn-danger btn rider_remove_class" id="rider_delete_button_id"><i class="fadeIn animated bx bx-trash"></i></button> </div> </div>'

        rider_add_button_id.click(function (e) {

            fill_rider_select_options()

            const rider_add_button = $(this)
            e.preventDefault()
            rider_additional_block_id.append(rider_row_template)

            $('.rider_remove_class').click(function (e) {
                e.preventDefault()
                $(this).closest('.rider_first_block_class').remove()
                if ($('.rider_first_block_class').length != 20) {
                    rider_add_button.show()
                }
            })

            if ($('.rider_first_block_class').length == 20) {
                rider_add_button.hide()
            }

        })

        function add_countries_to_country_select() {

            fetch(document.location.origin + '/api/countries')
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {

                    const options = data

                    const residency_within_five_year__country_select_class = document.querySelectorAll('.residency_within_five_year__country_select_class')

                    residency_within_five_year__country_select_class.forEach(function (item) {

                        const select = item

                        options.forEach(function(option) {
                            const optionElement = document.createElement('option');
                            optionElement.value = option.id;
                            optionElement.textContent = option.name;
                            select.appendChild(optionElement);
                        });


                    })

                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation: ' + error.message);
                })

        }

        add_countries_to_country_select()

        const residency_within_five_years_first_block = document.getElementById('residency_within_five_years_first_block_id')
        const residency_within_five_years_first_block_add_button = document.getElementById('residency_within_five_years_first_block_add_button_id')

        const residency_within_five_years_first_block_template = '<div class="col-12 residency_within_five_years_first_block_class"><div class="row"><div class="col-1 text-secondary"><button class="btn btn-danger float-start residency_within_five_years_first_block_remove_button_class">-</button></div><div class="col-3"><div>Number and street</div></div><div class="col-8 text-secondary"><input type="text" class="form-control" name="residency_within_five_year__number_and_street[]"></div><div class="col-1"></div><div class="col-3"><div class="mt-2">City / Town</div></div><div class="col-8 text-secondary"><input type="text" class="form-control mt-2" name="residency_within_five_year__city_town[]"></div><div class="col-1"></div><div class="col-3"><div class="mt-2">Department, Province or State</div></div><div class="col-8 text-secondary"><input type="text" class="form-control mt-2" name="residency_within_five_year__department_province_or_state[]"></div><div class="col-1"></div><div class="col-3"><div class="mt-2">Country</div></div><div class="col-8 text-secondary mt-1"><select class="form-select single-select residency_within_five_year__country_select_class" aria-label="Default select example" name="residency_within_five_year__country[]"><option selected="selected" disabled="disabled" value="">Select</option></select></div></div><div class="row mb-3 entry_date_first_block_class" id="entry_date_first_block_id"><div class="col-1"></div><div class="col-sm-3"></div><div class="col-sm-4 text-secondary"><div class="mt-2">From</div><input type="date" class="form-control" name="residency_within_five_year__from[]"><div class="text-muted">Click the calendar icon</div></div><div class="col-sm-4 text-secondary"><div class="mt-2">To</div><input type="date" class="form-control" name="residency_within_five_year__to[]"><div class="text-muted">Click the calendar icon</div></div></div></div>'

        residency_within_five_years_first_block_add_button.addEventListener('click', function (e) {

            e.preventDefault()

            const max_within_five_years_first_blocks_length = 15

            function count_within_five_years_first_blocks__add() {

                const residency_within_five_years_first_block_remove_button_class = document.querySelectorAll('.residency_within_five_years_first_block_remove_button_class')

                return  Number(residency_within_five_years_first_block_remove_button_class.length + 1)

            }

            function count_within_five_years_first_blocks__remove() {

                const residency_within_five_years_first_block_remove_button_class = document.querySelectorAll('.residency_within_five_years_first_block_remove_button_class')

                return  Number(residency_within_five_years_first_block_remove_button_class.length)

            }

            if (count_within_five_years_first_blocks__add() >= max_within_five_years_first_blocks_length) {

                residency_within_five_years_first_block_add_button.classList.add('d-none')

            }

            residency_within_five_years_first_block.insertAdjacentHTML('afterend', residency_within_five_years_first_block_template)

            $('.single-select').select2({
                theme: 'bootstrap4',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
            });

            add_countries_to_country_select()

            const residency_within_five_years_first_block_remove_button_class = document.querySelectorAll('.residency_within_five_years_first_block_remove_button_class')

            residency_within_five_years_first_block_remove_button_class.forEach(function (item) {

                const remove_button = item

                remove_button.addEventListener('click', function (e) {
                    e.preventDefault()

                    if (count_within_five_years_first_blocks__remove() <= max_within_five_years_first_blocks_length) {

                        residency_within_five_years_first_block_add_button.classList.remove('d-none')

                    }

                    const whole_block = this.parentElement.parentElement.parentElement

                    whole_block.remove()

                })

            })

        })







    }


    if (current_page_url.includes('cases/add') || current_page_url.includes('cases/edit')) {

        function toggle_entry_date_add_button(action) {

            const limit = 100

            if (action === 'add_button') {

                const count_elements = document.querySelectorAll('.entry_date_first_block_class').length + 2

                if (count_elements > limit) {

                    document.getElementById('entry_date_add_button_id').classList.add('d-none')

                }

            }

            if (action === 'remove_button') {

                const count_elements = document.querySelectorAll('.entry_date_first_block_class').length - 1

                if (count_elements < limit) {

                    document.getElementById('entry_date_add_button_id').classList.remove('d-none')

                }

            }

        }

        const entry_date_add_button = document.getElementById('entry_date_add_button_id')
        const entry_date_first_block = document.getElementById('entry_date_first_block_id')

        entry_date_add_button.addEventListener('click', function (e) {
            e.preventDefault()

            toggle_entry_date_add_button('add_button')

            const template = '<div class="row mb-3 mt-3 entry_date_first_block_class"> <div class="col-sm-3"> <h6 class="mb-0 text-capitalize">Entry date</h6> </div> <div class="col-sm-4 text-secondary"> <input type="date" class="form-control" name="entry_date[]" /> <div class="text-muted">Click the calendar icon</div> </div> <div class="col-sm-4"> <div class="row"> <div class="col-3"><h6 class="mb-0">Entry place</h6></div> <div class="col-9"> <textarea class="form-control" rows="2" name="entry_place[]"></textarea> </div> </div> </div> <div class="col-sm-1"> <button class="btn btn-danger entry_date_delete_button_class"> - </button> </div> </div>'

            entry_date_first_block.insertAdjacentHTML('afterend', template)

            const entry_date_delete_buttons = document.querySelectorAll('.entry_date_delete_button_class')

            entry_date_delete_buttons.forEach(function (item) {

                const entry_date_delete_button = item

                entry_date_delete_button.addEventListener('click', function (e) {

                    e.preventDefault()

                    const entry_row = this.parentElement.parentElement

                    entry_row.remove()

                    toggle_entry_date_add_button('remove_button')

                })
            })

        })



        function show_hide_case_type_select() {

            const case_type_select = document.getElementById('case_type_select_id')

            const case_type_block = document.getElementById('case_type_block_id')

            if (case_type_select.value == 'Immigration') {

                case_type_block.classList.remove('d-none')

            } else {

                case_type_block.classList.add('d-none')

            }

        }

        show_hide_case_type_select()

        const case_type_select = document.getElementById('case_type_select_id')

        case_type_select.addEventListener('change', function () {

            show_hide_case_type_select()

        })

    }


    if (current_page_url.includes('calendar')) {

        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content')


        fetch(document.location.origin + '/calendar/get-records', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
        })
            .then(response => response.json())
            .then(data => {

                const calendarEl = document.getElementById('calendar_div_id')

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                    },
                    initialDate: new Date(),
                    editable: false,
                    selectable: false,
                    businessHours: false,
                    dayMaxEvents: false,
                    events: data
                })

                calendar.render()

            })
            .catch(error => console.error('Error:', error));



    }







});
