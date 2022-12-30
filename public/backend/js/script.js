function createRecord(link) {
    $.ajax({
        url: link,
        type: "GET",
        success: function(html) {
            $("#app-modal-container").html(html);
            $("#app-modal-container div.modal").modal('toggle');
        }
    });
}

function storeRecord() {
    var form = $('#app-record-form-datatable');
    $("#app-modal-container div.modal .form-group .form-control").removeClass("is-invalid");
    $(".error").html("");
    var formNode = document.getElementById('app-record-form-datatable');
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: new FormData(formNode),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('#text-fix').addClass('text-hide');
            $('#text-load').removeClass('text-hide');
            $('#btn-load').removeClass('d-none');
            $('#sender').addClass('disabled');
        },
        success: function(result) {
            $("div.modal").modal('hide');
            var type = result.type;
            var message = result.message;
            switch (type) {
                case 'info':
                    $.confirm({
                        icon: 'fa fa-check',
                        title: 'Info',
                        content: message,
                        typeAnimated: false,
                        autoClose: 'OK|4000',
                        theme: 'material',
                        buttons: {
                            OK: function() {}
                        }
                    });
                    break;
                case 'warning':
                    $.confirm({
                        icon: 'fa fa-check',
                        title: 'Attention',
                        content: message,
                        type: 'yellow',
                        typeAnimated: true,
                        autoClose: 'OK|4000',
                        theme: 'material',
                        buttons: {
                            OK: function() {}
                        }
                    });
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
                    break;
                case 'error':
                    $.confirm({
                        icon: 'fa fa-check',
                        title: 'Erreur',
                        content: message,
                        type: 'red',
                        typeAnimated: true,
                        autoClose: 'OK|4000',
                        theme: 'material',
                        buttons: {
                            OK: function() {}
                        }
                    });
                    break;
            }
            $('#text-load').addClass('text-hide');
            $('#text-fix').removeClass('text-hide');
            $('#sender').addClass('enabled');
            $('#btn-load').addClass('d-none');
            $('#app-datatable').DataTable().ajax.reload(null, true);

        },
        error: function(xhr, status, error) {
            var response = xhr.responseJSON;
            $.each(response, function(key, value) {
                $("#app-modal-container div.modal .form-group." + key + " .form-control").addClass("is-invalid");
                $('.' + key + '_err').text(value);
                $('#text-load').addClass('text-hide');
                $('#text-fix').removeClass('text-hide');
                $('#btn-load').addClass('d-none');
                $('#sender').removeClass('disabled');
            });
        }
    });
}

function statusConfirm(link) {
    $.confirm({
        columnClass: 'small',
        icon: 'flaticon-danger',
        title: 'Etes-vous sûr de vouloir changer le status ?',
        content: 'Activation/Désactivation.',
        confirmButton: 'Oui',
        buttons: {
            tryAgain: {
                text: 'Oui, changer',
                btnClass: 'btn-primary',
                action: function() {
                    AccountStatusRecord(link);
                }
            },
            Annuler: function() {}
        }
    });

}

function AccountStatusRecord(link) {
    $.ajax({
        url: link,
        type: "GET",
        data: {
            "_token": $('#token').val()
        },
        beforeSend: function() {
            $('#loader').removeClass('display-none')
        },
        success: function(result) {
            var type = result.type;
            var message = result.message;
            switch (type) {
                case 'info':
                    $.confirm({
                        icon: 'fa fa-check',
                        title: 'Info',
                        content: message,
                        typeAnimated: false,
                        autoClose: 'OK|4000',
                        theme: 'material',
                        buttons: {
                            OK: function() {}
                        }
                    });
                    break;
                case 'warning':
                    $.confirm({
                        icon: 'fa fa-check',
                        title: 'Attention',
                        content: message,
                        type: 'yellow',
                        typeAnimated: true,
                        autoClose: 'OK|4000',
                        theme: 'material',
                        buttons: {
                            OK: function() {}
                        }
                    });
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
                    break;
                case 'error':
                    $.confirm({
                        icon: 'fa fa-check',
                        title: 'Erreur',
                        content: message,
                        type: 'red',
                        typeAnimated: true,
                        autoClose: 'OK|4000',
                        theme: 'material',
                        buttons: {
                            OK: function() {}
                        }
                    });
                    break;
            }
            $('#app-datatable').DataTable().ajax.reload(null, true);
        }
    });
}

function editRecord(link) {
    $.ajax({
        url: link,
        type: "GET",
        success: function(html) {
            $("#app-modal-container").html(html);
            $("#app-modal-container div.modal").modal('toggle');

            var type = html.type;
            var message = html.message;
            switch (type) {
                case 'info':
                    Swal.fire(message, "", "info");
                    break;
                case 'warning':
                    Swal.fire("Attention!", message, "warning");
                    break;
                case 'success':
                    Swal.fire(message, "", "success");
                    break;
                case 'error':
                    Swal.fire("Attention!", message, "error");
                    break;
            }
        },
        error: function(xhr, status, error) {
            swal("Attention!", error, "error");
        }
    });
}

function updateRecord() {
    var form = $('#app-edit-record-form');
    $("#app-modal-container div.modal .form-group .form-control").removeClass("is-invalid");
    $(".error").html("");
    var formNode = document.getElementById('app-edit-record-form');

    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: new FormData(formNode),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('#text-fix').addClass('text-hide');
            $('#text-load').removeClass('text-hide');
            $('#btn-load').removeClass('d-none');
            $('#sender').addClass('disabled');
        },
        success: function(result) {
            $("div.modal").modal('hide');
            var type = result.type;
            var message = result.message;
            switch (type) {
                case 'info':
                    $.confirm({
                        icon: 'fa fa-check',
                        title: 'Info',
                        content: message,
                        typeAnimated: false,
                        autoClose: 'OK|4000',
                        theme: 'material',
                        buttons: {
                            OK: function() {}
                        }
                    });
                    break;
                case 'warning':
                    $.confirm({
                        icon: 'fa fa-check',
                        title: 'Attention',
                        content: message,
                        type: 'yellow',
                        typeAnimated: true,
                        autoClose: 'OK|4000',
                        theme: 'material',
                        buttons: {
                            OK: function() {}
                        }
                    });
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
                    break;
                case 'error':
                    $.confirm({
                        icon: 'fa fa-check',
                        title: 'Erreur',
                        content: message,
                        type: 'red',
                        typeAnimated: true,
                        autoClose: 'OK|4000',
                        theme: 'material',
                        buttons: {
                            OK: function() {}
                        }
                    });
                    break;
            }
            $('#text-load').addClass('text-hide');
            $('#text-fix').removeClass('text-hide');
            $('#btn-load').addClass('d-none');
            $('#sender').addClass('enabled');
            $('#sender').removeClass('disabled');
            $('#app-datatable').DataTable().ajax.reload(null, true);

        },
        error: function(xhr, status, error) {
            var response = xhr.responseJSON;
            $.each(response, function(key, value) {
                $("#app-modal-container div.modal .form-group." + key + " .form-control").addClass("is-invalid");
                $('.' + key + '_err').text(value);
                $('#text-load').addClass('text-hide');
                $('#text-fix').removeClass('text-hide');
                $('#btn-load').addClass('d-none');
                $('#sender').removeClass('disabled');

            });
        }
    });
}

function deleteRecordConfirm(link) {
    $.confirm({
        columnClass: 'medium',
        icon: 'flaticon-danger',
        title: 'Etes-vous sûr de vouloir supprimer cet enregistrement ?',
        content: 'Il ne vous sera plus possible de le récupérer.',
        confirmButton: 'Oui',
        buttons: {
            tryAgain: {
                text: 'Oui, supprimer',
                btnClass: 'btn-danger',
                action: function() {
                    deleteRecord(link);
                }
            },
            Annuler: function() {}
        }
    });
}

function deleteRecord(link) {
    $.ajax({
        url: link,
        type: "DELETE",
        data: {
            "_token": $('#token').val()
        },
        success: function(result) {
            var type = result.type;
            var message = result.message;
            switch (type) {
                case 'info':
                    $.confirm({
                        icon: 'fa fa-check',
                        title: 'Info',
                        content: message,
                        typeAnimated: false,
                        autoClose: 'OK|4000',
                        theme: 'material',
                        buttons: {
                            OK: function() {}
                        }
                    });
                    break;
                case 'warning':
                    $.confirm({
                        icon: 'fa fa-check',
                        title: 'Attention',
                        content: message,
                        type: 'yellow',
                        typeAnimated: true,
                        autoClose: 'OK|4000',
                        theme: 'material',
                        buttons: {
                            OK: function() {}
                        }
                    });
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
                    break;
                case 'error':
                    $.confirm({
                        icon: 'fa fa-check',
                        title: 'Erreur',
                        content: message,
                        type: 'red',
                        typeAnimated: true,
                        autoClose: 'OK|4000',
                        theme: 'material',
                        buttons: {
                            OK: function() {}
                        }
                    });
                    break;
            }

            $('#app-datatable').DataTable().ajax.reload(null, true);
        }
    });
}

//CREATE CONFIGURATION
function configStoreRecord() {
    var form = $('#app-create-record-form');
    $(".form-group .form-control").removeClass("has-error");
    $(".error").html("");
    var formNode = document.getElementById('app-create-record-form');
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
                        window.location.href = "/administration/config";
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


//CREATE PROFILE
function profileStoreRecord() {
    var form = $('#app-create-record-form');
    $(".form-group .form-control").removeClass("has-error");
    $(".error").html("");
    var formNode = document.getElementById('app-create-record-form');
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
                        window.location.href = "/administration/profile";
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