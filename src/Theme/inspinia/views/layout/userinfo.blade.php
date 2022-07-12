<li class="nav-header m-t-xxl">
    <div class="dropdown profile-element">
        <div class="img-style text-center">
            <img alt="image" class="rounded-circle img-fluid" src="{{ Adw\Theme\Theme::profile()->mpr_logo }}">
        </div>
        <div class="row qr-code">
            <div class="col-md-6 text-center">
                <img src="{{ asset('inspinia/assets/img/qr-code.png') }}" width="65" alt="">
            </div>
            <div class="col-md-6 qr-text">
                <span>Scan this QR for logging in via mobile</span>
            </div>
        </div>
        <div class="administrator-information text-center">
            <h4 class="font-bold">{{ auth()->user()->uem_firstname }}</h4>
            <span class="block">
                <small>
                    Login Terakhir Anda:
                    <br />2021-10-14 14:04:09
                </small>
            </span>
            <ul class="list-group border-0 text-left">
                <li class="list-group-item border-0 d-flex">
                    <div>
                        <strong>1</strong>
                    </div>
                    <div>
                        Administrator
                    </div>
                </li>
                <li class="list-group-item border-0 d-flex">
                    <div>
                        <strong>22</strong>
                    </div>
                    <div>
                        Director Commercial
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="logo-element">
        <img alt="image" class="rounded-circle" src="{{ asset('inspinia/assets/img/logo-small-white.png') }}">
    </div>
</li>