//CREATE TESTIMONIALS
function aboutStoreRecord() {
    var form = $('#esta-create-about-record-form');
    $(".form-group .form-control").removeClass("has-error");
    $(".error").html("");
    var formNode = document.getElementById('esta-create-about-record-form');
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: new FormData(formNode),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            KTApp.block('#restaurant-block', {
                overlayColor: '#000000',
                state: 'primary',
                message: 'Enregistrement en cours...'
            })

            $('#text-fix').addClass('text-hide');
            $('#text-load').removeClass('text-hide');
            $('#sender').addClass('spinner spinner-white spinner-right').attr("disabled", true);
        },
        success: function(result) {
            $("#orange-restauration-modal-container div.modal").modal('hide');
            var type = result.type;
            var message = result.message;
            var btn = KTUtil.getById("button");
            KTUtil.btnRelease(btn);
            switch (type) {
                case 'info':
                    swal("Info", message, "info");
                    break;
                case 'warning':
                    swal("Attention", message, "warning");
                    break;
                case 'success':
                    $.confirm({
                        icon: 'fa fa-check',
                        title: 'Succès',
                        content: message,
                        type: 'green',
                        typeAnimated: true,
                        autoClose: 'OK|4000',
                        theme: 'material',
                        buttons: {
                            OK: function() {}
                        }
                    });

                    KTApp.block('#restaurant-block', {
                        overlayColor: '#000000',
                        state: 'primary',
                        message: 'Chargement...'
                    });

                    setTimeout(function() {
                        window.location.href = "/administration/generalities/about";
                        //window.location.href = "{{ route('companies.index')}}";
                        KTApp.unblock('#restaurant-block');
                    }, 1000);

                    break;
                case 'error':
                    swal("Erreur", message, "error");
                    break;
            }

            $('#text-load').addClass('text-hide');
            $('#text-fix').removeClass('text-hide');
            $('#sender').removeClass('spinner spinner-white spinner-right').attr("disabled", false);

            //$('#orange-datatable').DataTable().ajax.reload(null, true);
            KTApp.unblock('#restaurant-block');

        },
        error: function(xhr, status, error) {
            var response = xhr.responseJSON;
            $.each(response, function(key, value) {
                $('.' + key + '_err').text(value);
                $('#text-load').addClass('text-hide');
                $('#text-fix').removeClass('text-hide');
                $('#sender').removeClass('spinner spinner-white spinner-right').attr("disabled", false)
            });
            KTApp.unblock('#restaurant-block');
        }
    });
}