<main class="content">
    <div class="container p-0">
        <h5 class=" mb-0 mb-sm-2">
            <div class="row">
            <span class="col-6"> Вопрос {if $dialog['support_id']==0}№ {$dialog['support_id']}{/if} </span>
            <a href="/user/support/?new=1" class=" nv-hover col-nav col-6">
                <p class="text-break">/ Новый вопрос</p>
            </a>
            </div>
        </h5>
        <div class="card mb-1">
            <div class="row g-0">
                <div class="col-12">

                    <div class="flex-grow-0 py-3 px-4 border-top">
                        <div class="input-group">

                            <input type="text" class="form-control" placeholder="Вопрос" id="questionSupport">

                            <button class="btn bg-nav-btn col-nav nv-navbar"
                                    type="submit" onclick="sendSupport({$dialog['support_id']}, {$dialog['user_id']});">
                                Отправить
                            </button>
                        </div>
                    </div>

                    <div class="position-relative">
                        <div class="chat-messages p-4">

                            {*Вопрос*}
                            <div class="chat-message-right pb-4">
                                <div>
                                    {*<img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                         class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">*}
                                    <div class="text-muted small text-nowrap mt-2">12/03/23</br>14:03</div>
                                </div>
                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                    <div class="font-weight-bold mb-1">{$dialog['name']}</div>
                                    Lorem ipsum dolor sit amet, vis erat denique in, dicunt prodesset te vix.
                                </div>
                            </div>

                            {*Ответ*}
                            <div class="chat-message-left pb-4">
                                <div>
                                    <img src="{$templateWebPath}images/logo_dark.png" class="rounded-circle mr-1"
                                         alt="Sharon Lessman" width="40" height="40">
                                    <div class="text-muted small text-nowrap mt-2">13/03/23</br>17:05</div>
                                </div>
                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                    <div class="font-weight-bold mb-1">beautic</div>
                                    Sit meis deleniti eu, pri vidit meliore docendi ut, an eum erat animal commodo.
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>