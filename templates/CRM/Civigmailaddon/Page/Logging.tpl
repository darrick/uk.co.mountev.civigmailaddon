<table id="log" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th>Date Time</th>
      <th>Entity</th>
      <th>Action</th>
      <th>Request Type</th>
      <th>Request</th>
      <th>Response</th>
      <th>Params</th>
    </tr>
  </thead>

  <tbody>
    {foreach from=$log item=data}
      <tr>
        <td>{$data.datetime}</td>
        <td>{$data.entity}</td>
        <td>{$data.action}</td>
        <td>{$data.request_type}</td>
        <td>{$data.request}</td>
        <td>{$data.response}</td>
        <td>{$data.params}</td>
      </tr>
    {/foreach}
  </tbody>
</table>

{literal}
<script>
CRM.$(document).ready(function() {
  var table = CRM.$('#log').DataTable( {
    scrollY:        "60vh",
    scrollX:        true,
    scrollCollapse: true,
    paging:         true,
    order:          [[ 0, "desc" ]],
    pagingType:     "full_numbers",
    columnDefs: [
        { width: '30%', targets: 0 }
    ]
  } );
  new CRM.$.fn.dataTable.FixedColumns( table );
} );
</script>
{/literal}