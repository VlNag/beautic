<div class="container my-auto px-0 bg-nav h-100 mb-1">
    <nav aria-label="breadcrumb" class="ms-2">
        <ol class="breadcrumb mb-1 mb-sm-2 mb-lg-3">
            <li class="breadcrumb-item">
                <a href="/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-house-door col-nav nv-hover" viewBox="0 0 16 16">
                        <path
                            d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z" />
                    </svg>
                </a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
                <a href="/user/" class='col-nav-hover nv-hover'>
                    Личный кабинет
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {$pageTitle}
            </li>
        </ol>
    </nav>

    <h3 class="heading col-nav ms-2 mb-1 mb-sm-2 mb-lg-4 d-flex">
        <span class="pe-2">{$pageTitle}</span>
        <div class=" flex-fill me-2" id="vn-line"> </div>
    </h3>

    <div class="row me-0">
        <div class="col-lg-6 col-md-8 col-sm-12 pe-0">
            <form method="post" action="/restuser/changepass/">
                <div class="input-group  mb-1 mb-sm-2 mb-lg-4  me-1 ms-1 me-sm-2 ms-sm-2 me-lg-5 ms-lg-2">
                    <span class="input-group-text col-12 col-sm-4 col-md-5 col-lg-5 col-xl-4" id="basic-addon1">
                        Текущий пароль
                    </span>
                    <input type="password" class="form-control   col-12 col-sm-8 col-md-7  col-lg-7 col-xl-8  me-2 me-sm-3 me-lg-5"
                        placeholder="Пароль" aria-label="Пароль" aria-describedby="basic-addon1" name="pass" value="" required>
                </div>
                <div class="input-group  mb-1 mb-sm-2 mb-lg-4  me-1 ms-1 me-sm-2 ms-sm-2 me-lg-5 ms-lg-2">
                    <span class="input-group-text col-12 col-sm-4 col-md-5 col-lg-5 col-xl-4" id="basic-addon2">
                        Новый пароль
                    </span>
                    <input type="password" class="form-control col-12 col-sm-8 col-md-7 col-lg-7 col-xl-8 me-2 me-sm-3 me-lg-5"
                        placeholder="Новый пароль" aria-label="Пароль" aria-describedby="basic-addon2" name="newpass" value=""
                        required>
                </div>

                <div class="input-group  mb-1 mb-sm-2 mb-lg-4  me-1 ms-1 me-sm-2 ms-sm-2 me-lg-5 ms-lg-2">
                    <span class="input-group-text col-12 col-sm-4 col-md-5 col-lg-5 col-xl-4" id="basic-addon3">
                        Подтвердите пароль
                    </span>
                    <input type="password" class="form-control  col-12 col-sm-8 col-md-7  col-lg-7 col-xl-8  me-2 me-sm-3 me-lg-5"
                        placeholder="Повтор пароля" aria-label="Пароль" aria-describedby="basic-addon3" name="newpass2" value=""
                        required>
                </div>

                <div class=" d-flex justify-content-center">
                    <button type="submit" class="btn bg-nav-btn col-nav nv-navbar col-11 col-lg-4 mb-1">
                        Сохранить
                    </button>
                </div>
            </form>
        </div>
        <div class="col-lg-6 col-md-4 col-sm-0 pe-0">
            <div class="row ms-0 ms-md-2 me-0 d-none d-md-block">
                {include file='userlink.tpl'}
            </div>
        </div>
    </div>
</div>