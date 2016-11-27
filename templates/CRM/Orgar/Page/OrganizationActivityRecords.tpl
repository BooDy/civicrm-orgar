<h3>Activities assigned to Contacts who has a relationship with: {$organization}</h3>

{ts} You can configure which relationships 
and what kind of activities to be tracked here 
through <a href="{$baseUrl}civicrm/admin/setting/org-activity-records"> The settings </a> {/ts}



{foreach from=$contacts item=row}


<div class="section contact-tasks-section">

 <div class="content">

  <table class="contact-activities">
    <thead>
<h3>
    <a href="{$baseUrl}/civicrm/contact/view?reset=1&cid={$row.id}">{$row.name}</a>
</h3>
    <tr>
      <th data-data="subject" cell-class="crmf-subject crm-editable" class="crm-contact-activity_subject">{ts}Subject{/ts}</th>
      <th data-data="activity_date_time" class="crm-contact-activity-activity_date">{ts}Date{/ts}</th>
      <th data-data="status_id" cell-class="crmf-status_id crm-editable" cell-data-type="select" cell-data-refresh="true" class="crm-contact-activity-activity_status">{ts}Status{/ts}</th>
    </tr>
    </thead>
<tbody>
{foreach from=$row.activities item=Activity}
<tr>
<td> {$Activity.subject} </td>
<td> {$Activity.activity_date_time} </td>
<td> <a href="{$baseUrl}/civicrm/contact/activity?atype=1&action=view&reset=1&id=4&cid=6&context=activity&searchContext=activity" class="action-item crm-hover-button">{ts} View {/ts}</a></td>
</tr>
{/foreach}
</tbody> 
 </table>
 </div>
</div>


{/foreach}
