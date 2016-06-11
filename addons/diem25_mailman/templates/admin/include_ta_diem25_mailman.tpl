<form role="form" class="form-horizontal" action="tiki-admin.php?page=ta_diem25_mailman" method="post">
    <input type="hidden" name="ticket" value="{$ticket|escape}">
    {tabset name="admin_mailman"}
    {tab name="{tr}Mailman configuration{/tr}"}
        <br/>
        {preference name=ta_diem25_mailman_pearpath}
        {preference name=ta_diem25_mailman_MailmanList}
    {/tab}
    {/tabset}
    <br/>
    <div class="t_navbar margin-bottom-md text-center">
        <input type="submit" class="btn btn-primary btn-sm" title="{tr}Apply Changes{/tr}" value="{tr}Apply{/tr}">
    </div>
</form>