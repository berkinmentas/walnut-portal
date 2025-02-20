<section class="topbar fixed-top">
    <nav class="navbar">
        <div class="container-fluid justify-content-end py-3 pe-5">
            <div class="dropdown">
                @auth('admin')
                    <a class="btn btn-primary dropdown-toggle" href="#" role="button"
                       id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user"></i>
                        <span class="ms-2">{{ Auth::guard('admin')->user()->email }}</span>
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li>
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fa-solid fa-sign-out-alt"></i> {{ __('Logout') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </nav>
</section>
