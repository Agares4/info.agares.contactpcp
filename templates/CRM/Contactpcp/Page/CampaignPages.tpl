<h3>Personal campaign pages</h3>

<table id="options" class="display">
  <thead>
    <tr>
    <th>{ts}Page Title{/ts}</th>
    <th>{ts}Status{/ts}</th>
    <th>{ts}Contribution Page / Event{/ts}</th>
    <th>{ts}Contribution count{/ts}</th>
    <th>{ts}Amount raised{/ts}</th>
    <th>{ts}Goal amount{/ts}</th>
    <th></th>
    </tr>
  </thead>
  <tbody>
  {foreach from=$pages item=row}
  <tr>
    <td><a href="{crmURL p='civicrm/pcp/info' q="reset=1&id=`$row.id`" fe='true'}" title="{ts}View Personal Campaign Page{/ts}" target="_blank">{$row.title}</a></td>
    <td>{$row.status}</td>
    <td>{$row.page}</td>
    <td>{$row.contribution_count}</td>
    <td>{$row.amount_raised}</td>
    <td>{$row.goal_amount}</td>
    <td><a href="{crmURL p='civicrm/pcp/info' q="reset=1&action=update&id=`$row.id`" fe='true'}">{ts}Edit{/ts}</td>
  </tr>
  {/foreach}
  </tbody>
</table>
