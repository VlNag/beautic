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
        <div class="col-lg-6 col-md-6 col-sm-12 pe-0">
            <h5 class="ms-2 mb-0 mb-sm-2">
                Ваши данные
            </h5>
            {* <form method="post" action="/restuser/changepass/" class="me-1">*}
            <div class="me-1">
                <div class="input-group  ms-1  mb-0 mb-sm-2">
            <span class="input-group-text col-3 col-sm-4">E-Mail
                <span class="d-none d-sm-block">&nbsp;адрес</span>
            </span>
                    <input type="email" class="form-control me-2 col-9 col-sm-8"
                           placeholder="E-Mail адрес" id="emailSupport"
                           aria-label="E-Mail адрес" aria-describedby="button-addon2" name="emailSupport"
                           value="{$dialog['email']}" {if $dialog['user_id']==0} required {/if}>
                </div>
                <div class="input-group  ms-1  {if $allDialog} mb-0 {else} {/if} mb-sm-2">
                    <span class="input-group-text  col-3 col-sm-4">Имя</span>
                    <input type="text" class="form-control me-2 col-9 col-sm-8" placeholder="Имя"
                           aria-label="Имя" aria-describedby="button-addon2" name="nameSupport"
                           value="{$dialog['name']}" id="nameSupport" {*required*}>
                </div>
                {if $allDialog}
                    <div class="input-group  ms-1  mb-1 mb-sm-2">
                        <label class="input-group-text col-3 col-sm-4" for="inputGroupSelect01">
                            <span class="d-block d-sm-none d-md-block  d-lg-none">Запросы</span>
                            <span class="d-none d-sm-block d-md-none  d-lg-block">История запросов</span>
                        </label>
                        <select class="form-select me-0 col-8 col-sm-7" id="selectSupport">
                            <option selected>Выберите...</option>
                            {foreach $allDialog as $curDialog}
                                <option value="{$curDialog['support_id']}">
                                    {$curDialog['content'][0]['question']}
                                </option>
                            {/foreach}
                        </select>
                        <button class="btn bg-nav-btn col-nav nv-navbar col-1 col-sm-1 me-2 px-0"
                                type="submit" onclick="chooseSupport();">
                            ОК
                        </button>
                    </div>
                {/if}
            </div>


            {*
            <p class="ms-2">
            lorem
            </p>
            <form method="post"  class="me-2"action="/restuser/forgotpass/">
                <div class="input-group ms-1 mb-1">
                    <span class="input-group-text">Вопрос</span>
                    <textarea class="form-control" aria-label="Сообщение" name="message" required></textarea>
                    <button class="btn bg-nav-btn col-nav nv-navbar" type="submit"
                        id="button-addon3">
                        Отправить
                    </button>
                </div>
            </form>
            *}
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 pe-0">
            <div class="row ms-0 ms-md-2 me-0">
                {include file='chat.tpl'}
            </div>
        </div>
    </div>

</div>