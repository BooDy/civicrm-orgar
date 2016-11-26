<h3>Activities assigned to Contacts who has a relationship with: {$organization}</h3>

{ts} You can configure which relationships 
and what kind of activities to be tracked here 
through <a href="{$baseUrl}civicrm/admin/setting/org-activity-records"> The settings </a> {/ts}



{foreach from=$contacts item=row}


<div class="section contact-tasks-section">
<h3>
    <a href="{$baseUrl}/civicrm/contact/view?reset=1&cid={$row.id}">{$row.name}</a>
</h3>
 <div class="content">
{foreach from=$row.activities item=Activity}
<a href="{$baseUrl}/civicrm/contact/activity?atype=1&action=view&reset=1&id=4&cid=6&context=activity&searchContext=activity" class="action-item crm-hover-button">{$Activity.subject}</a>
{/foreach}
 </div>
</div>


{/foreach}
