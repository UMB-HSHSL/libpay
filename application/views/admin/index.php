<?php echo flash_message()?>
<?php echo form_open('admin/clear')?>

<div class="row row-centered">
<div class="col-sm-12">

<table class="table table-striped" id="tx_table">
<thead>
<tr><th>Name</th><th>Phone</th><th>Amount</th><th>Date</th><th>Category</th><th>Cleared</th></tr>
</thead><tbody>
<?php
foreach ($charges as $charge)
{
    $clear = ($charge->hshsl_cleared ? '&#x2713;' : "<input type='checkbox' name='id[]' value='{$charge->id}'>");
    $phone = substr($charge->phone, 0, 3) . '-' . substr($charge->phone, 3, 3) . '-' . substr($charge->phone, 6, 4);

    $d = date('F j, Y g:i:s a', $charge->stripe_created);
    echo "<tr>
        <td>", xss_clean($charge->patron_name), "</a></td>
        <td>{$phone}</td>
        <td class='text-right'>", anchor("admin/details/{$charge->id}", "\${$charge->hshsl_amount_dollar}.{$charge->hshsl_amount_cents}"), "</span></td>
        <td data-order='{$charge->stripe_created}'>{$d}</td>
        <td>{$charge->hshsl_category}</td>
        <td>{$clear}</td>
    </tr>";
}
?>
</tbody>
</table>
</div>

<div class="col-sm-12 text-right">
    <?php echo form_submit('submit', 'Save', 'class="btn btn-default"')?>
</div>

</div>
<?php echo form_close(); ?>