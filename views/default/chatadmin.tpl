<main class="content">
    <div class="container p-0">
        <h5 class=" mb-0 mb-sm-2">
            <div class="row">
                <span class="col-7"> Вопрос {if $dialog['support_id']!=0}№ {$dialog['support_id']}{/if}
                {if $dialog['status'] == 2}
                   | Закрыт
                {else}
                    {if $dialog['support_id']!=0}
                        <button class="bg-nav col-nav c-button " type="submit"
                            onclick=
                            "deactiveSupport({$dialog['support_id']});
                                    location.href='/user/supportadmin/';">
                                    <h5>| Закрыть</h5>
                        </button>
                    {/if}
                {/if}
                  </span>
                <span class="text-break col-5">{$dialog["email"]}</span>
                {*if $dialog['support_id']!=0}
                    <a href="/user/support/?new=1" class=" nv-hover col-nav col-5">
                        <p class="text-break">/ Новый вопрос</p>
                    </a>
                {/if*}
            </div>
        </h5>
        <div class="card mb-1">
            <div class="row g-0">
                <div class="col-12">
                    {if $dialog['status'] != 2}
                        <div class="flex-grow-0 py-3 px-4 border-top">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Ответ" id="questionSupportAdm">
                                <button class="btn bg-nav-btn col-nav nv-navbar" type="submit"
                                        onclick=
                                        "sendSupportAdm({$dialog['support_id']}, {$dialog['user_id']},
                                                       '{$dialog["token"]}', '{$dialog["email"]}');
                                                location.href='/user/supportadmin/?token={$dialog["token"]}';">
                                    Отправить
                                </button>
                            </div>
                        </div>
                    {/if}
                    <div class="position-relative">
                        <div class="chat-messages p-4">
                            {foreach $dialog['content'] as $content}
                                {if $content['question']}
                                    <div class="chat-message-right pb-4">
                                        <div>
                                            {*<img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                              class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">*}
                                            <div class="text-muted small text-nowrap mt-2">
                                                {$content['date_added']|replace:' ':'</br>'}
                                            </div>
                                        </div>
                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                            <div class="font-weight-bold mb-1">{$dialog['name']}</div>
                                            {$content['question']}
                                        </div>
                                    </div>
                                {else}
                                    <div class="chat-message-left pb-4">
                                        <div>
                                            <img src="{$templateWebPath}images/logo_dark.png"
                                                 class="rounded-circle mr-1"
                                                 alt="Sharon Lessman" width="40" height="40">
                                            <div class="text-muted small text-nowrap mt-2">
                                                {$content['date_added']|replace:' ':'</br>'}
                                            </div>
                                        </div>
                                        <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                            <div class="font-weight-bold mb-1">ID: {$content['answering_id']}</div>
                                            {$content['answer']}
                                        </div>
                                    </div>
                                {/if}
                            {/foreach}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>