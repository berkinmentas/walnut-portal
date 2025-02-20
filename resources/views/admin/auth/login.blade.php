@extends('admin.layouts.auth')
@section('content')
    <section class="login">
        <div class="login-wrapper">
            <div class="login-form shadow">
                <form class="form" id="loginForm" enctype="multipart/form-data">
                    <div class="mb-3 d-flex align-items-center justify-content-center">
                        <div class="logo">
                            <img src="{{Vite::asset('resources/images/logo.png')}}" alt="">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email Adresi</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-4">
                        <label for="exampleInputPassword1" class="form-label">Şifre</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                    </div>
                    <div class="d-flex align-items-center justify-content-end">
                        <button type="submit" class="btn btn-primary">Giriş Yap</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    @push('js-stack')
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                let $projects = $("form#loginForm");

                $projects.on("submit", function (e) {
                    e.preventDefault();
                    let $form = $(this);
                    let formData = new FormData($form[0]);
                    $projects.find("button[type=submit]").attr("disabled", "disabled");
                    $.ajax({
                        url: '{{ route('admin.login.post') }}',
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function () {
                            window.location = "{{ route('admin.dashboard') }}";
                        },
                        error: function (e) {
                            $projects.find("button[type=submit]").removeAttr("disabled")
                            ajaxDefaultErrorCallback(e);
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
