@extends('layout.base')

@section('content')

@include('partials.header')
@include('partials.hero')

<main>

    @include('partials.members')
    @include('partials.contact')
    @include('partials.partner')

</main>

@include("partials.footer")

@endsection

@push('scripts')
<script>
    $(() => {

        $("#nots .delete").click(() => {
            closeMessage();
        });

        $("#frmContact").on("submit", e => {
            e.preventDefault();

            var dados = $("#frmContact").serialize();

            $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route("postContact") }}',
                    type: 'POST',
                    data: dados,
                })
                .done(function(res) {
                    if (res) {
                        showMessage(res);
                    }
                })
                .fail(function(err) {
                    if (err.status == 422) {
                        var msg = JSON.parse(err.responseText);
                        var errors = "Die angegebenen Daten waren ungültig.<br />";
                        Object.keys(msg.errors).map(error => {
                            errors = errors + "<br /> " + msg.errors[error][0];
                            return true
                        })
                        showMessage(errors, 'error')
                    } else {
                        showMessage(err.responseText, 'error')
                    }
                });
        })

        $("#frmZipCode").on("submit", e => {
            e.preventDefault();

            var dados = $("#frmZipCode").serialize();

            $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route("getZipCode") }}',
                    type: 'POST',
                    data: dados,
                })
                .done(function(res) {
                    if (res > 0) {
                        toggleModalSuccess(res);
                    } else {
                        toggleModalError();
                    }
                })
                .fail(function() {
                    toggleModalError();
                });
        });

        closeMessage = (e) => {
            $("#nots").hide();
            $("#nots span").text("");
            $("#nots").removeClass("is-primary");
            $("#nots").removeClass("is-danger");
        }

        showMessage = (msg, type = "success") => {
            if (!msg) return false;

            closeMessage()
            if (type == "success") $("#nots").addClass("is-primary");
            if (type == "error") $("#nots").addClass("is-danger");
            $("#nots span").html(msg);
            $.when($("#nots").show().delay(5000).fadeOut())
                .done(function() {
                    closeMessage();
                });
        }

        toggleModalSuccess = (value) => {
            event.preventDefault();
            $("#amount_loyalty").text(value);
            toggleModal($("#modalSuccess"));
        }

        toggleModalError = () => {
            event.preventDefault();
            toggleModal($("#modalError"));
        }

        toggleModal = (target) => {
            target.toggleClass("is-active");
        }

    });
</script>
@endpush

@push('modals')

<div class="modal" id="modalSuccess">
    <div class="modal-background"></div>
    <div class="modal-content">
        <div class="box">
            <div class="image"></div>
            <div class="box-inner">
                <h2 class="title">
                    Glückwunsch!
                </h2>
                <h4 class="subtitle">
                    In Ihrer Nachbarschaft gibt es ca. <span id="amount_loyalty"></span> Douglas Loyalty Card Nutzer
                </h4>
                <p>
                    Treten Sie jetzt mit uns in Kontakt und schöpfen Sie dieses Kundenportenzial zusammem mit Douglas
                    und
                    Shore voll aus.
                </p>
                <button class="button is-black">
                    Jetzt unverbindlich anfragen
                </button>
            </div>
        </div>
        <button class="modal-close is-large" onclick="toggleModalSuccess()" aria-label="close"></button>
    </div>
</div>

<div class="modal" id="modalError">
    <div class="modal-background"></div>
    <div class="modal-content">
        <div class="box">
            <div class="image"></div>
            <div class="box-inner">
                <h4 class="subtitle">
                    Leider konnten wir diese Postleitzahl nicht finden.
                </h4>
                <p>
                    Melden Sie sich bei unverbindlich bei uns.<br>
                    Germeinsam finden wir heraus wie auch Sie von Douglas-kunden in Ihrer Nähe profitieren können.
                </p>
                <button class="button is-black">
                    Jetzt unverbindlich anfragen
                </button>
                <a href="#" onclick="toggleModalError()">
                    Nochmal versuchen
                </a>
            </div>
        </div>
        <button class="modal-close is-large" onclick="toggleModalError()" aria-label="close"></button>
    </div>
</div>
@endpush