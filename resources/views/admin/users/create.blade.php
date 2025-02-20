@extends('admin.layouts.layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Create New User</h5>
            </div>
            <div class="card-body">
                <form action="javascript:" id="createUserForm">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control"
                               id="email" name="email" value="{{ old('email') }}">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control"
                               id="password" name="password">
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control"
                               id="password_confirmation" name="password_confirmation">
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('js-stack')
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                let $createUserForm = $("form#createUserForm");

                $createUserForm.on("submit", async function (e) {
                    e.preventDefault();

                    $createUserForm.find("button[type=submit]").attr("disabled", "disabled");
                    $.ajax({
                        url: "{{ route('admin.users.store') }}",
                        method: 'POST',
                        data: $createUserForm.serialize(),
                        success: function () {
                            window.location.href = "{{ route('admin.users.index') }}";
                        },
                        error: function (e) {
                            $createUserForm.find("button[type=submit]").removeAttr("disabled")
                            ajaxDefaultErrorCallback(e);
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
