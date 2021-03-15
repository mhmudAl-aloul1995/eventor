var token = '{{csrf_token()}}'
var $loading = $('.ok');
$(document)
    .ajaxStart(function () {
        $loading.prop('disabled', true);
    })
    .ajaxStop(function () {
        $loading.prop('disabled', false);
        $('.buttons-page-length').on('click', function (e) {
        });
    });
$(document).ready(function () {
    $('#clickmewow').click(function () {
        $('#radio1003').attr('checked', 'checked');
    });
})

function submitForm(formName) {
    $('#' + formName + 'Form').data('bootstrapValidator').validate();
    if (!$('#' + formName + 'Form').data('bootstrapValidator').isValid()) {
        return true;
    } else {
        var $form = $('#' + formName + 'Form'),
            formData = new FormData(),
            params = $form.serializeArray();
        formData.append('_token', '{{csrf_token()}}');
        $.each(params, function (i, obj) {
            formData.append(obj.name, obj.value);
        });
        var file = $('#' + formName + 'Form').find('[type="file"]');
        if (file.length > 0) {
            formData.append(file.attr('name'), file[0].files[0]);
        }
        var id = $('#' + formName + 'Form').find('[name="id"]').val();
        $.ajax({
            url: $form.attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function (data) {
                if (data.success) {
                    $('#' + formName + 'Form').bootstrapValidator('resetForm', true);
                    $('#' + formName + 'Modal').modal('hide');
                    $('.' + formName + 'Table').click()
                    showAlertMessage('alert-success', null, data.message);
                    return false;
                }
                showAlertMessage('alert-danger', null, data.message);


            },
            error: function (data) {
                console.log(data.message);

                /* var errors="";
                 data.errors.each(function(index, value) {
                     errors+=value;
                 });*/
                showAlertMessage('alert-danger', null, data.message);
            },
            statusCode: {
                500: function (data) {
                    console.log(data);
                }
            }
        });
    }
}

function deleteThis(formName, id) {
    if (!confirm('هل انت متاكد؟')) {
        return false;
    } else {
        $.ajax({
            url: "{{url('')}}/" + formName + '/' + id,
            data: {_token: token},
            type: "DELETE",
            success: function (data, textStatus, jqXHR) {
                $('.' + formName + 'Table').click()
                showAlertMessage('alert-success', null, data.message);
            },
            error: function (data, textStatus, jqXHR) {
                console.log(data)
                showAlertMessage('alert-danger', "ERROR FATAL", data.message);
            },
        });
    }
}

function showModal(formName, id) {

    $('#' + formName + 'Form').find('select').val(null).trigger('change');
    if (id == null) {
        $('#' + formName + 'Modal').modal('show', {backdrop: 'static'});
        $('#' + formName + 'Form').attr('action', "{{url('')}}/" + formName);
        $('#' + formName + 'Form').find('[name="id"]').val(null);
        $('#' + formName + 'Form').bootstrapValidator('resetForm', true);
    } else {
        $('#' + formName + 'Form').bootstrapValidator('resetForm', true);
        $.get("{{url('')}}/" + formName + '/' + id, {}, function (data) {
            if (data) {
                $('#' + formName + 'Form').attr('action', "{{url('')}}/update_" + formName);
                var selects = $('#' + formName + 'Form').find('select').serializeArray();
                var inputs = $('#' + formName + 'Form').find('textarea,input').serializeArray();

                $.each(selects, function (i, field) {
                    var fieldName = field.name
                    $('#' + formName + 'Form').find('select').val(data[formName][fieldName]).trigger('change');
                });
                $.each(inputs, function (i, field) {
                    var fieldName = field.name
                    $('#' + formName + 'Form').find('[name="' + fieldName + '"]').val(data[formName][fieldName]);
                });
                $('#' + formName + 'Modal').modal('show', {backdrop: 'static'});
            }
        }).fail(function () {
            showAlertMessage('alert-danger', null, data.message);
        })
    }
}
$('.dropdown-trigger').dropdown({
        inDuration: 300,
        outDuration: 225,
        constrainWidth: false, // Does not change width of dropdown to that of the activator
        hover: true, // Activate on hover
        gutter: 0, // Spacing from edge
        coverTrigger: false, // Displays dropdown below the button
        alignment: 'left', // Displays dropdown with edge aligned to the left of button
        stopPropagation: false // Stops event propagation
    }
);
