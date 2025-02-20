@extends('admin.layouts.layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Edit User</h5>
            </div>
            <div class="card-body">
                <form  id="editUserForm">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control"
                               id="email" name="email" value="{{ $user->email }}">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password (leave blank to keep current)</label>
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
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('js-stack')
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                let $editUserForm = $("form#editUserForm");

                $editUserForm.on("submit", function (e) {
                    e.preventDefault();

                    $editUserForm.find("button[type=submit]").attr("disabled", "disabled");

                    setTimeout(() => {
                        $.ajax({
                            url: "{{ route('admin.users.update', $user->id) }}",
                            method: 'POST',
                            data: $editUserForm.serialize() + "&_method=PUT",
                            success: function () {
                                window.location.href = "{{ route('admin.users.index') }}";
                            },
                            error: function (e) {
                                $editUserForm.find("button[type=submit]").removeAttr("disabled")
                                ajaxDefaultErrorCallback(e);
                            }
                        });
                    });
                });
            });
        </script>
    @endpush
@endsection
