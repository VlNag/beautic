<div class="container my-auto px-0 bg-nav h-100 mb-1">
    <nav aria-label="breadcrumb" class="ms-2">
        <ol class="breadcrumb mb-1 mb-sm-2 mb-lg-3">
            <li class="breadcrumb-item">
                <a href="/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" 
                        fill="currentColor" viewBox="0 0 16 16"
                        class="bi bi-house-door col-nav nv-hover">
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

    <div class="row mx-0 mx-sm-1 ">
        <div class="col-12 col-lg-5 px-1 px-sm-3">
            <h5 class="heading col-nav ms-2 mb-1 mb-sm-2 mb-lg-4 d-flex">
                <a data-bs-toggle="collapse" href="#emailShow" aria-expanded="true" 
                    aria-controls="emailShow" role="button"
                    class='nv-a nv-a2 col-nav-hover nv-hover'>
                    <h5 class="pe-2 mb-0" data-bs-toggle="tooltip" data-bs-placement="bottom" 
                        data-bs-title="Развернуть/Скрыть" data-bs-custom-class="custom-tooltip">
                        E-mail
                    </h5>
                </a>
                <div class=" flex-fill me-2" id="vn-line"> </div>
            </h5>
            <div class="collapse show" id="emailShow"> 
                {if $email} 
                    {foreach $email as $mail name="email"}
                        <div class="input-group ms-0 ms-sm-1 mb-2 mb-sm-2 mb-lg-3" 
                            id="email{$smarty.foreach.email.index}">

                            <input type="email" class="form-control col-12 col-sm-4 border border-col rounded" 
                                placeholder="E-Mail адрес" aria-label="E-Mail адрес" 
                                aria-describedby="button-addon{$smarty.foreach.email.index}" 
                                data-bs-toggle="tooltip" data-bs-placement="bottom" 
                                data-bs-title="E-mail" data-bs-custom-class="custom-tooltip"
                                id="emailContact{$smarty.foreach.email.index}" value="{$mail['content']|@htmlspecialchars}">
                            <span class="input-group-text col-12 col-sm-1 d-block d-sm-none py-0" 
                                id="button-addon{$smarty.foreach.email.index}" >
                            </span>
                            <input type="text" class="form-control  col-9 col-sm-4 border border-col rounded placeholder-transparent" 
                                placeholder="Комментарий" aria-label="Комментарий" 
                                aria-describedby="button-addon{$smarty.foreach.email.index}" 
                                data-bs-toggle="tooltip" data-bs-placement="bottom" 
                                data-bs-title="Комментарий" data-bs-custom-class="custom-tooltip"
                                id="commentEmail{$smarty.foreach.email.index}" value="{$mail['comment']|@htmlspecialchars}">
                            {if $smarty.foreach.email.total > 1}
                                {if !$smarty.foreach.email.last}   
                                    <button type="" id="button-addon{$smarty.foreach.email.index}"
                                        class="btn bg-nav-btn col-nav nv-navbar col-1 d-none d-sm-block border border-col rounded px-0" 
                                        onclick='moveContact({$smarty.foreach.email.index}, 0, "email")'>{*НИЖЕ*}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-caret-down col-nav nv-hover" viewBox="0 0 16 16">
                                            <path
                                                d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z" />
                                        </svg>
                                    </button>
                                {else}
                                    <div class="col-1 bg-nav-btn d-none d-sm-block border border-col rounded"> </div>
                                {/if}
                                {if !$smarty.foreach.email.first}
                                    <button type="" id="button-addon{$smarty.foreach.email.index}"
                                        class="btn bg-nav-btn col-nav nv-navbar col-1 d-none d-sm-block border border-col rounded px-0" 
                                        onclick='moveContact({$smarty.foreach.email.index}, 1, "email")'>{*ВЫШЕ*}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-caret-up col-nav nv-hover" viewBox="0 0 16 16">
                                            <path
                                                d="M3.204 11h9.592L8 5.519 3.204 11zm-.753-.659 4.796-5.48a1 1 0 0 1 1.506 0l4.796 5.48c.566.647.106 1.659-.753 1.659H3.204a1 1 0 0 1-.753-1.659z" />
                                        </svg>
                                    </button>
                                {else}
                                    <div class="col-1 bg-nav-btn d-none d-sm-block border border-col rounded"> </div>
                                {/if}    
                            {else} {*одно значение*}
                                {*<button class="btn bg-nav-btn col-nav nv-navbar col-1" type="" id="button-addon2">*ДОБАВИТЬ*
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                                        class="bi bi-plus-circle col-nav nv-hover" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg>
                                </button>

                                <div class="col-1 bg-nav-btn d-none d-sm-block border border-col"> </div>
                                <div class="col-1 bg-nav-btn d-none d-sm-block border border-col"> </div>*}
                            {/if}    
                            <button type="" id="button-addon{$smarty.foreach.email.index}"
                                class="btn bg-nav-btn col-nav nv-navbar col-1 border border-col rounded px-0" 
                                onclick='removeContact({$smarty.foreach.email.index}, "email")'>{*УДАЛИТЬ*}
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash3 col-nav nv-hover" viewBox="0 0 16 16">
                                    <path
                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                </svg>
                            </button>
                        </div>
                    {/foreach}
                    {assign var="emailLast" value="{$smarty.foreach.email.total}"}
                {else}
                    {assign var="emailLast" value="0"}
                {/if}
                <div class="input-group ms-0 ms-sm-1 mb-2 mb-sm-2 mb-lg-3" 
                    id="email{$emailLast}" name="emailAdd" > 
                    <input type="email" class="form-control col-12 col-sm-4 border border-col rounded placeholder-transparent" 
                        placeholder="E-Mail адрес" aria-label="E-Mail адрес" 
                        aria-describedby="button-addon{$emailLast}" 
                        data-bs-toggle="tooltip" data-bs-placement="bottom" 
                        data-bs-title="E-mail" data-bs-custom-class="custom-tooltip"
                        id="emailContact{$emailLast}" value="">
                    <span class="input-group-text col-12 col-sm-1 d-block d-sm-none py-0" 
                        id="button-addon{$smarty.foreach.email.index}" >
                    </span>
                    <input type="text" class="form-control col-9 col-sm-4 border border-col rounded placeholder-transparent" 
                        placeholder="Комментарий" aria-label="Комментарий" 
                        aria-describedby="button-addon{$emailLast}" 
                        data-bs-toggle="tooltip" data-bs-placement="bottom" 
                        data-bs-title="Комментарий" data-bs-custom-class="custom-tooltip"
                        id="commentEmail{$emailLast}" value="">
                        {if $smarty.foreach.email.total > 1}
                            <div class="col-1 bg-nav-btn d-none d-sm-block border border-col rounded"> </div>
                            <div class="col-1 bg-nav-btn d-none d-sm-block border border-col rounded"> </div>
                        {/if}
                        <button type="" id="button-addon{$emailLast}"
                            class="btn bg-nav-btn col-nav nv-navbar col-1 border border-col rounded px-0"
                            onclick='removeContact({$emailLast}, "email", 1)'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-trash3 col-nav nv-hover" viewBox="0 0 16 16">
                                <path
                                    d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                            </svg>
                        </button> 
                </div>

                <div class="input-group  ms-0 ms-sm-1 mb-1 mb-sm-2 mb-lg-3" id="addEmail" > 
                    <button type=""  
                        class="btn bg-nav-btn col-nav nv-navbar col-1 border border-col rounded px-0 pt-0"
                        onclick='showContact({$emailLast}, "email")'>{*ДОБАВИТЬ*}
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                            class="bi bi-plus-circle col-nav nv-hover" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                    </button>
                    {*сделать ссылкой*} 
                    <span class="input-group-text  rounded" id="basic-addon1">Добавить<span class=" d-none d-sm-block">&#160;E-mail</span></span>
                </div>
                {*
                <div class=" d-flex justify-content-center">
                    <button type="" class="btn bg-nav-btn col-nav nv-navbar col-6 col-lg-6 mb-1"
                            onclick='saveContact({$emailLast}, "email");document.location.reload();'> 
                        Сохранить
                    </button>
                </div>*}
            </div>     
        </div>

        <div class="col-12 col-lg-7 px-1 px-sm-3">
            <h5 class="heading col-nav ms-2 mb-1 mb-sm-2 mb-lg-4 d-flex">
                <a data-bs-toggle="collapse" href="#phoneShow" aria-expanded="true" aria-controls="phoneShow" role="button"
                    class='nv-a nv-a2 col-nav-hover nv-hover'>
                    <h5 class="pe-2 mb-0" data-bs-toggle="tooltip" data-bs-placement="bottom" 
                        data-bs-title="Развернуть/Скрыть" data-bs-custom-class="custom-tooltip">
                        Телефоны
                    </h5>
                </a>
                <div class=" flex-fill me-2" id="vn-line"> </div>
            </h5>

            <div class="collapse show" id="phoneShow">
                {if $phone}
                    {foreach $phone as $phon name="phone"}
                        <div class="input-group ms-0 ms-sm-1 mb-2 mb-sm-2 mb-lg-3" id="phone{$smarty.foreach.phone.index}">
                            <div class="col-9 col-sm-4">
                                <input type="tel" class="form-control col-12 col-sm-4 border border-col rounded"
                                    placeholder="Телефон" aria-label="Телефон"
                                    aria-describedby="ariaPhone{$smarty.foreach.phone.index}" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" data-bs-title="Телефон" data-bs-custom-class="custom-tooltip"
                                    id="phoneContact{$smarty.foreach.phone.index}" value="{$phon['content']}">
                            </div>        
                            <div class="col-3 col-sm-2">
                                <select class="form-select border border-col rounded" 
                                        id="kindPhone{$smarty.foreach.phone.index}" data-bs-toggle="tooltip" 
                                        data-bs-placement="bottom" data-bs-title="Вид телефона" 
                                        data-bs-custom-class="custom-tooltip">
                                    <option selected disabled>Выберите</option>
                                    {foreach $typeContacts as $typeContact}
                                        {if $typeContact['option'] != 2}
                                            <option value={$typeContact['value']} 
                                                {if $typeContact['value'] == $phon['view_contact']}selected{/if}>
                                                {$typeContact['name']}
                                            </option>
                                        {/if}
                                    {/foreach} 
                                </select>
                            </div>    
                            <div class=" col-12 col-sm-6 ">
                                <div class="row mx-0 flex-nowrap">
                                    {if $smarty.foreach.phone.total > 1}
                                    <div class="col-11 col-sm-9 px-0">
                                    {else}
                                    <div class="col-11  px-0">   
                                    {/if}
                                        <input type="text" class="form-control  col-9 col-sm-4 border border-col rounded placeholder-transparent"
                                            placeholder="Комментарий" aria-label="Комментарий"
                                            aria-describedby="ariaPhone{$smarty.foreach.phone.index}" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" data-bs-title="Комментарий" data-bs-custom-class="custom-tooltip"
                                            id="commentPhone{$smarty.foreach.phone.index}" value="{$phon['comment']|@htmlspecialchars}">
                                    </div> 
                                    {if $smarty.foreach.phone.total > 1}
                                        {if !$smarty.foreach.phone.last}
                                            <button type="" id="ariaPhone{$smarty.foreach.phone.index}"
                                                class="btn bg-nav-btn col-nav nv-navbar col-1 d-none d-sm-block border border-col rounded px-0"
                                                onclick='moveContact({$smarty.foreach.phone.index}, 0, "phone")'>{*НИЖЕ*}
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                    class="bi bi-caret-down col-nav nv-hover" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z" />
                                                </svg>
                                            </button>
                                        {else}
                                            <div class="col-1 bg-nav-btn d-none d-sm-block border border-col rounded"> </div>
                                        {/if}
                                        {if !$smarty.foreach.phone.first}
                                            <button type="" id="ariaPhone{$smarty.foreach.phone.index}"
                                                class="btn bg-nav-btn col-nav nv-navbar col-1 d-none d-sm-block border border-col rounded px-0"
                                                onclick='moveContact({$smarty.foreach.phone.index}, 1, "phone")'>{*ВЫШЕ*}
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                    class="bi bi-caret-up col-nav nv-hover" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.204 11h9.592L8 5.519 3.204 11zm-.753-.659 4.796-5.48a1 1 0 0 1 1.506 0l4.796 5.48c.566.647.106 1.659-.753 1.659H3.204a1 1 0 0 1-.753-1.659z" />
                                                </svg>
                                            </button>
                                        {else}
                                            <div class="col-1 bg-nav-btn d-none d-sm-block border border-col rounded"> </div>
                                        {/if}
                                    {/if}
                                    <button type="" id="ariaPhone{$smarty.foreach.phone.index}"
                                        class="btn bg-nav-btn col-nav nv-navbar col-1 border border-col rounded px-0"
                                        onclick='removeContact({$smarty.foreach.phone.index}, "phone")'>{*УДАЛИТЬ*}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-trash3 col-nav nv-hover" viewBox="0 0 16 16">
                                            <path
                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    {/foreach}
                    {assign var="phoneLast" value="{$smarty.foreach.phone.total}"}
                {else}
                    {assign var="phoneLast" value="0"}
                {/if}

                <div class="input-group ms-0 ms-sm-1 mb-2 mb-sm-2 mb-lg-3" id="phone{$phoneLast}" name="phoneAdd">
                    <div class="col-9 col-sm-4">
                        <input type="tel" class="form-control border border-col rounded px-lg-1  px-xl-2 placeholder-transparent"
                               placeholder="Телефон" aria-label="E-Mail адрес" aria-describedby="ariaPhone{$phoneLast}"
                               data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Телефон"
                               data-bs-custom-class="custom-tooltip" id="phoneContact{$phoneLast}" value="">
                    </div>
                    <div class="col-3 col-sm-2">
                        <select class="form-select border border-col rounded" 
                                id="kindPhone{$phoneLast}" data-bs-toggle="tooltip" data-bs-placement="bottom" 
                                data-bs-title="Вид телефона" data-bs-custom-class="custom-tooltip">
                                <option selected disabled>Выберите</option>
                            {foreach $typeContacts as $typeContact}
                                {if $typeContact['option'] != 2}
                                    <option value={$typeContact['value']}>{$typeContact['name']}</option>
                                {/if}
                            {/foreach}    
                        </select>
                    </div>
                    <div class=" col-12 col-sm-6 ">

                        <div class="row mx-0 flex-nowrap">
                        {if $smarty.foreach.phone.total > 1}
                        <div class="col-11 col-sm-9 px-0">
                        {else}
                            <div class="col-11  px-0">   
                        {/if}
                            <input type="text" class="form-control border border-col rounded  placeholder-transparent"
                                placeholder="Комментарий" aria-label="Комментарий" aria-describedby="ariaPhone{$phoneLast}"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Комментарий"
                                data-bs-custom-class="custom-tooltip" id="commentPhone{$phoneLast}" value="">
                        </div>        
                            {if $smarty.foreach.phone.total > 1}
                                <div class=" bg-nav-btn d-none d-sm-block border border-col rounded col-1"> </div>
                                <div class=" bg-nav-btn d-none d-sm-block border border-col rounded col-1"> </div>
                            {/if}
                            {*<div class="col-1">*} 
                            <button type="" id="ariaPhone{$phoneLast}"
                                class="btn bg-nav-btn col-nav nv-navbar border col-1 border-col rounded px-0"
                                onclick='removeContact({$phoneLast}, "phone", 1)'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash3 col-nav nv-hover" viewBox="0 0 16 16">
                                    <path
                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                </svg>
                            </button>
                            {*</div>*}
                        </div>
                    </div>
                </div>

                <div class="input-group  ms-0 ms-sm-1 mb-1 mb-sm-2 mb-lg-3" id="addPhone">
                    <button type="" class="btn bg-nav-btn col-nav nv-navbar col-1 border border-col rounded px-0 pt-0"
                        onclick='showContact({$phoneLast}, "phone")'>{*ДОБАВИТЬ*}
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-plus-circle col-nav nv-hover" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg>
                    </button>
                    {*сделать ссылкой*}
                    <span class="input-group-text rounded" id="basic-addon1">
                        Добавить <span class=" d-none d-sm-block">&#160;телефон</span>
                    </span>
                </div>
                {*<div class=" d-flex justify-content-center">
                    <button type="" class="btn bg-nav-btn col-nav nv-navbar col-6 col-lg-6 mb-1"
                        onclick='saveContact({$phoneLast}, "phone");document.location.reload();'>
                        Сохранить
                    </button>
                </div>*}
            </div>

        </div>
    </div>  

    <div class="row mx-0 mx-sm-1">
        <div class="col-12 px-1 px-sm-3">
            <h5 class="heading col-nav ms-2 mb-1 mb-sm-2 mb-lg-4 d-flex">
                <a data-bs-toggle="collapse" href="#addressShow" aria-expanded="true" aria-controls="addressShow" role="button"
                    class='nv-a nv-a2 col-nav-hover nv-hover'>
                    <h5 class="pe-2 mb-0" data-bs-toggle="tooltip" data-bs-placement="bottom" 
                        data-bs-title="Развернуть/Скрыть" data-bs-custom-class="custom-tooltip">
                        Адреса
                    </h5>
                </a>
                <div class=" flex-fill me-2" id="vn-line"> </div>
            </h5>

            <div class="collapse show" id="addressShow" name="addressShow">
                {if $address}
                    {foreach $address as $addr name="address"}
                        <div class="input-group ms-0 ms-sm-1 mb-2 mb-sm-2 mb-lg-3" id="address{$smarty.foreach.address.index}">
                            <div class="col-12 col-lg-5">
                                {*<input type="text" class="form-control col-12 col-sm-4 border border-col rounded"
                                    placeholder="Адрес" aria-label="Адрес"
                                    aria-describedby="ariaAddress{$smarty.foreach.address.index}" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" data-bs-title="Адрес" data-bs-custom-class="custom-tooltip"
                                    id="addressContact{$smarty.foreach.address.index}" value="{$addr['content']}">
                                *} 



                                <textarea class="form-control col-12 col-sm-4 border border-col rounded" aria-label="Адрес" rows="1"
                                    aria-describedby="ariaAddress{$smarty.foreach.address.index}" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" data-bs-title="Адрес" data-bs-custom-class="custom-tooltip"
                                    id="addressContact{$smarty.foreach.address.index}">{$addr['content']}</textarea>

                            </div>        
                            <div class="col-3 col-lg-2">
                                <select class="form-select border border-col rounded" 
                                        id="kindAddress{$smarty.foreach.address.index}" data-bs-toggle="tooltip" 
                                        data-bs-placement="bottom" data-bs-title="Вид адреса" 
                                        data-bs-custom-class="custom-tooltip">
                                    <option selected disabled>Выберите</option>
                                    {foreach $typeContacts as $typeContact}
                                        {if $typeContact['option'] != 1}
                                            <option value={$typeContact['value']} 
                                                {if $typeContact['value'] == $addr['view_contact']}selected{/if}>
                                                {$typeContact['name']}
                                            </option>
                                        {/if}
                                    {/foreach} 
                                </select>
                            </div>    
                            <div class="col-9 col-lg-5">
                                <div class="row mx-0 flex-nowrap">
                                    {if $smarty.foreach.address.total > 1}
                                    <div class="col-11 col-sm-9 px-0">
                                    {else}
                                    <div class="col-11  px-0">   
                                    {/if}
                                        <input type="text" class="form-control  col-9 col-sm-4 border border-col rounded placeholder-transparent"
                                            placeholder="Комментарий" aria-label="Комментарий"
                                            aria-describedby="ariaAddress{$smarty.foreach.address.index}" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" data-bs-title="Комментарий" data-bs-custom-class="custom-tooltip"
                                            id="commentAddress{$smarty.foreach.address.index}" value="{$addr['comment']|@htmlspecialchars}">
                                    </div> 
                                    {if $smarty.foreach.address.total > 1}
                                        {if !$smarty.foreach.address.last}
                                            <button type="" id="ariaAddress{$smarty.foreach.address.index}"
                                                class="btn bg-nav-btn col-nav nv-navbar col-1 d-none d-sm-block border border-col rounded px-0"
                                                onclick='moveContact({$smarty.foreach.address.index}, 0, "address")'>{*НИЖЕ*}
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                    class="bi bi-caret-down col-nav nv-hover" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z" />
                                                </svg>
                                            </button>
                                        {else}
                                            <div class="col-1 bg-nav-btn d-none d-sm-block border border-col rounded"> </div>
                                        {/if}
                                        {if !$smarty.foreach.address.first}
                                            <button type="" id="ariaAddress{$smarty.foreach.address.index}"
                                                class="btn bg-nav-btn col-nav nv-navbar col-1 d-none d-sm-block border border-col rounded px-0"
                                                onclick='moveContact({$smarty.foreach.address.index}, 1, "address")'>{*ВЫШЕ*}
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                    class="bi bi-caret-up col-nav nv-hover" viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.204 11h9.592L8 5.519 3.204 11zm-.753-.659 4.796-5.48a1 1 0 0 1 1.506 0l4.796 5.48c.566.647.106 1.659-.753 1.659H3.204a1 1 0 0 1-.753-1.659z" />
                                                </svg>
                                            </button>
                                        {else}
                                            <div class="col-1 bg-nav-btn d-none d-sm-block border border-col rounded"> </div>
                                        {/if}
                                    {/if}
                                    <button type="" id="ariaAddress{$smarty.foreach.address.index}"
                                        class="btn bg-nav-btn col-nav nv-navbar col-1 border border-col rounded px-0"
                                        onclick='removeContact({$smarty.foreach.address.index}, "address")'>{*УДАЛИТЬ*}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-trash3 col-nav nv-hover" viewBox="0 0 16 16">
                                            <path
                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    {/foreach}
                    {assign var="addressLast" value="{$smarty.foreach.address.total}"}
                {else}
                    {assign var="addressLast" value="0"}
                {/if}

                <div class="input-group ms-0 ms-sm-1 mb-2 mb-sm-2 mb-lg-3" id="address{$addressLast}" name="addressAdd">
                    <div class="col-12 col-lg-5">
                        <input type="tel" class="form-control border border-col rounded px-lg-1  px-xl-2 placeholder-transparent"
                               placeholder="Адрес" aria-label="Адрес" aria-describedby="ariaAddress{$addressLast}"
                               data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Адрес"
                               data-bs-custom-class="custom-tooltip" id="addressContact{$addressLast}" value="">
                    </div>
                    <div class="col-3 col-lg-2">
                        <select class="form-select border border-col rounded" 
                                id="kindAddress{$addressLast}" data-bs-toggle="tooltip" data-bs-placement="bottom" 
                                data-bs-title="Вид адреса" data-bs-custom-class="custom-tooltip">
                                <option selected disabled>Выберите</option>
                            {foreach $typeContacts as $typeContact}
                                {if $typeContact['option'] != 1}
                                    <option value={$typeContact['value']}>{$typeContact['name']}</option>
                                {/if}
                            {/foreach}    
                        </select>
                    </div>
                    <div class="col-9 col-lg-5">

                        <div class="row mx-0 flex-nowrap">
                        {if $smarty.foreach.address.total > 1}
                        <div class="col-11 col-sm-9 px-0">
                        {else}
                            <div class="col-11  px-0">   
                        {/if}
                            <input type="text" class="form-control border border-col rounded  placeholder-transparent"
                                placeholder="Комментарий" aria-label="Комментарий" aria-describedby="ariaAddress{$addressLast}"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Комментарий"
                                data-bs-custom-class="custom-tooltip" id="commentAddress{$addressLast}" value="">
                        </div>        
                            {if $smarty.foreach.address.total > 1}
                                <div class=" bg-nav-btn d-none d-sm-block border border-col rounded col-1"> </div>
                                <div class=" bg-nav-btn d-none d-sm-block border border-col rounded col-1"> </div>
                            {/if}
                            {*<div class="col-1">*} 
                            <button type="" id="ariaAddress{$addressLast}"
                                class="btn bg-nav-btn col-nav nv-navbar border col-1 border-col rounded px-0"
                                onclick='removeContact({$addressLast}, "address", 1)'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash3 col-nav nv-hover" viewBox="0 0 16 16">
                                    <path
                                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                </svg>
                            </button>
                            {*</div>*}
                        </div>
                    </div>
                </div>

                <div class="input-group  ms-0 ms-sm-1 mb-1 mb-sm-2 mb-lg-3" id="addAddress">
                    <button type="" class="btn bg-nav-btn col-nav nv-navbar col-1 border border-col rounded px-0 pt-0"
                        onclick='showContact({$addressLast}, "address")'>{*ДОБАВИТЬ*}
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-plus-circle col-nav nv-hover" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg>
                    </button>
                    {*сделать ссылкой*}
                    <span class="input-group-text rounded" id="basic-addon1">
                        Добавить <span class=" d-none d-sm-block">&#160;адрес</span>
                    </span>
                </div>
                {*
                <div class=" d-flex justify-content-center">
                    <button type="" class="btn bg-nav-btn col-nav nv-navbar col-6 col-lg-6 mb-1"
                        onclick='saveContact({$addressLast}, "address");document.location.reload();'>
                        Сохранить
                    </button>
                </div>*}
            </div>
        </div>
    </div>   
    <div class=" d-flex justify-content-center">
    <button type="" class="btn bg-nav-btn col-nav nv-navbar col-6 col-lg-6 mb-1"
        onclick='saveContacts({$emailLast}, {$phoneLast}, {$addressLast});document.location.reload();'> 
        Сохранить
    </button>
</div>
</div>