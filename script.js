$(document).ready(function(){
    $(document).on('click', '.onglet', function(e){
        e.preventDefault()
        
        $('.onglet').removeClass('active')
        $('.onglet').addClass('text-light')
        $(this).addClass('active')
        $(this).removeClass('text-light')

        $('.tab-pane').removeClass('active')
        $($(this).attr('href')).addClass('active')
    })

    $(document).on('submit', '#formAjouterQuartier', function(e){
        e.preventDefault()

        let form = $(this)
        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: form.serialize(),
            success: function (data) {
                loadQuartierListing()
                loadQuartierOption()
                form.trigger('reset')
                toastr.success('Ajouté !')
            },
            error: function(data) {
                toastr.error('Erreur !')
                console.log(data)
            }
        });
    })

    $(document).on('click', '.del-quartier', function(e){
        e.preventDefault()

        let id = $(this).data('id')
        $.ajax({
            type: "POST",
            url: "ajax/delQuartier.php",
            data: {id},
            success: function (data) {
                loadQuartierListing()
                loadQuartierOption()
                loadRueListing()
                loadRueOption()
                loadClientListing()
                loadClientOption()
                toastr.success(data)
            },
            error: function(data) {
                toastr.error('Erreur !')
                console.log(data)
            }
        });
    })

    loadQuartierListing()
    loadQuartierOption()

    $(document).on('submit', '#formAjouterRue', function(e){
        e.preventDefault()

        let form = $(this)
        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: form.serialize(),
            success: function (data) {
                loadRueListing()
                loadRueOption()
                form.trigger('reset')
                toastr.success('Ajouté !')
            },
            error: function(data) {
                toastr.error('Erreur !')
                console.log(data)
            }
        });
    })

    $(document).on('click', '.del-rue', function(e){
        e.preventDefault()

        let id = $(this).data('id')
        $.ajax({
            type: "POST",
            url: "ajax/delRue.php",
            data: {id},
            success: function (data) {
                loadRueListing()
                loadClientListing()
                loadClientOption()
                toastr.success(data)
            },
            error: function(data) {
                toastr.error('Erreur !')
                console.log(data)
            }
        });
    })

    loadRueListing()
    loadRueOption()

    
    $(document).on('submit', '#formAjouterClient', function(e){
        e.preventDefault()

        let form = $(this)
        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: form.serialize(),
            success: function (data) {
                loadClientListing()
                loadClientOption()
                form.trigger('reset')
                toastr.success('Ajouté !')
            },
            error: function(data) {
                toastr.error('Erreur !')
                console.log(data)
            }
        });
    })

    $(document).on('click', '.del-client', function(e){
        e.preventDefault()

        let id = $(this).data('id')
        $.ajax({
            type: "POST",
            url: "/ajax/delClient.php",
            data: {id},
            success: function (data) {
                loadClientListing()
                loadClientOption()
                loadAchatListing()
                toastr.success(data)
            },
            error: function(data) {
                toastr.error('Erreur !')
                console.log(data)
            }
        });

    })

    loadClientListing()
    loadClientOption()

    $(document).on('submit', '#formAjouterAchat', function(e){
        e.preventDefault()

        let form = $(this)
        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: form.serialize(),
            success: function (data) {
                loadAchatListing()
                form.trigger('reset')
                toastr.success(data)
            },
            error: function(data) {
                toastr.error('Erreur !')
                console.log(data)
            }
        });
    })

    $(document).on('click', '.detail-achat', function(e){
        e.preventDefault()

        let client_id = $(this).data('client_id')
        let annee = $(this).data('annee')

        $.ajax({
            type: "POST",
            url: "/ajax/getAchatDetailListing.php",
            data: {client_id, annee},
            success: function (data) {
                $('#detailListing').html(data)
                $('#detailModal').modal('show')
            },
            error: function(data) {
                toastr.error('Erreur !')
                console.log(data)
            }
        });
    })

    $(document).on('click', '.del-achat', function(e){
        e.preventDefault()

        let btn = $(this).data('btn')

        let id = $(this).data('id')
        $.ajax({
            type: "POST",
            url: "/ajax/delAchat.php",
            data: {id},
            success: function (data) {
                toastr.success(data)
                loadAchatListing()
                $("#"+btn).trigger('click')
            },
            error: function(data) {
                toastr.error('Erreur !')
                console.log(data)
            }
        });
    })

    loadAchatListing()

})

function loadQuartierListing()
{
    $.ajax({
        type: "GET",
        url: "/ajax/getQuartierListing.php",
        success: function (data) {
            $('#quartierListing').html(data)

            $('#quartierTable').DataTable({
                "destroy" : true,
                'searching': true,
                'paging': true,
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "all"] ],
                pageLength: -1,
                columnDefs: [
                    // {orderable: false, targets: 2}, 
                    // {type: "num", targets: [0]}
                ],
                "aaSorting": [],
            });
        },
        error: function(data) {
            toastr.error('Erreur !')
            console.log(data)
        }
    });
}

function loadQuartierOption()
{
    $.ajax({
        type: "GET",
        url: "/ajax/getQuartierOption.php",
        success: function (data) {
            $('#selectRueQuartier').html(data)
        },
        error: function(data) {
            toastr.error('Erreur !')
            console.log(data)
        }
    });
}

function loadRueListing()
{
    $.ajax({
        type: "GET",
        url: "/ajax/getRueListing.php",
        success: function (data) {
            $('#rueListing').html(data)

            $('#rueTable').DataTable({
                "destroy" : true,
                'searching': true,
                'paging': true,
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "all"] ],
                pageLength: -1,
                columnDefs: [
                    {orderable: false, targets: 3}, 
                    {type: "num", targets: [0]}
                ],
                "aaSorting": [],
            });
        },
        error: function(data) {
            toastr.error('Erreur !')
            console.log(data)
        }
    });
}

function loadRueOption()
{
    $.ajax({
        type: "GET",
        url: "/ajax/getRueOption.php",
        success: function (data) {
            $('#selectClientRue').html(data)
        },
        error: function(data) {
            toastr.error('Erreur !')
            console.log(data)
        }
    });
}

function loadClientListing()
{
    $.ajax({
        type: "GET",
        url: "/ajax/getClientListing.php",
        success: function (data) {
            $('#clientListing').html(data)

            $('#clientTable').DataTable({
                "destroy" : true,
                'searching': true,
                'paging': true,
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "all"] ],
                pageLength: -1,
                columnDefs: [
                    {orderable: false, targets: 6}, 
                    {type: "num", targets: [0]}
                ],
                "aaSorting": [],
            });
        },
        error: function(data) {
            toastr.error('Erreur !')
            console.log(data)
        }
    });
}

function loadClientOption()
{
    $.ajax({
        type: "GET",
        url: "/ajax/getClientOption.php",
        success: function (data) {
            $('#selectClientAchat').html(data)
        },
        error: function(data) {
            toastr.error('Erreur !')
            console.log(data)
        }
    });
}

function loadAchatListing()
{
    $.ajax({
        type: "GET",
        url: "/ajax/getAchatListing.php",
        success: function (data) {
            $('#achatListing').html(data)

            $('#achatTable').DataTable({
                "destroy" : true,
                'searching': true,
                'paging': true,
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "all"] ],
                pageLength: -1,
                columnDefs: [
                    {orderable: false, targets: 7}, 
                    {type: "num", targets: [5]},
                    {type: "num-fmt", targets: [6]}
                ],
                "aaSorting": [],
            });
        },
        error: function(data) {
            toastr.error('Erreur !')
            console.log(data)
        }
    });
}