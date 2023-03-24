<div class="container my-auto px-0 bg-nav h-100 mb-1">
    <nav aria-label="breadcrumb" class="ms-2">
        <ol class="breadcrumb mb-1 mb-sm-2 mb-lg-3">
            <li class="breadcrumb-item">
                <a href="/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-house-door col-nav nv-hover" viewBox="0 0 16 16">
                        <path
                                d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
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
        <span class="flex-fill me-2" id="vn-line"></span>
    </h3>
    <div class="row me-0">
        <div class="col-lg-6 col-md-12 col-sm-12 pe-0">
            <div class="row ms-0 ms-md-2 me-0">
                {include file='chatadmin.tpl'}
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12 pe-0">
            <a data-bs-toggle="collapse" href="#adminSupport" aria-expanded="true"
               aria-controls="emailShow" role="button"
               class='nv-a nv-a2 col-nav-hover nv-hover'>
                <h5 class="ms-2 mb-0 mb-sm-2">
                    Запросы
                </h5>
            </a>
            <div class="collapse show me-1" id="adminSupport">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th> {*location.href='/user/support/?token=' + support_id;*}
                        <th scope="col">Имя</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">ID польз</th>
                        <th scope="col" class="d-none d-sm-block">Последняя активность</th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach $activeDialog as $aDialog name="aDialogs"}
                        <tr>
                            <th scope="row">{$smarty.foreach.aDialogs.iteration}</th>

                            <td {if !$aDialog['answer']}class="table-danger"{/if}>
                                <a href="/user/supportadmin/?token={$aDialog['token']}" class='col-nav-hover nv-hover'>
                                    {$aDialog['support_id']}
                                </a>
                            </td>
                            <td>
                                <a href="/user/supportadmin/?token={$aDialog['token']}" class='col-nav-hover nv-hover'>
                                    {$aDialog['name']}
                                </a>
                            </td>
                            <td>
                                <a href="/user/supportadmin/?token={$aDialog['token']}" class='col-nav-hover nv-hover'>
                                    {$aDialog['email']}
                                </a>
                            </td>
                            <td>
                                <a href="/user/supportadmin/?token={$aDialog['token']}" class='col-nav-hover nv-hover'>
                                    {$aDialog['user_id']}
                                </a>
                            </td>
                            <td class="d-none d-sm-block">
                                <a href="/user/supportadmin/?token={$aDialog['token']}" class='col-nav-hover nv-hover'>
                                    {$aDialog['date_added']}
                                </a>
                            </td>
                        </tr>
                    {/foreach}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>