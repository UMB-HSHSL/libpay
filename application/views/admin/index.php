<?php echo form_open('admin/clear')?>

<div class="row row-centered">
<div class="col-sm-12">

<table class="table table-striped" id="tx_table">
<thead>
<tr><th>Name (UMID)</th><th>Amount</th><th>Date</th><th>Category</th><th>Cleared</th></tr>
</thead><tbody>
<?php
foreach ($charges as $charge)
{
    $clear = ($charge->hshsl_cleared ? '&#x2713;' : "<input type='checkbox' name='id[]' value='{$charge->id}'>");
    $category = strtolower($charge->hshsl_category) == 'other' ? "{$charge->hshsl_category} ({$charge->hshsl_category_other})" : $charge->hshsl_category;

    $d = date('F j, Y g:i:s a', $charge->stripe_created);
    echo "<tr>
        <td>{$charge->patron_name} ($charge->umid)</td>
        <td class='text-right'>\${$charge->hshsl_amount_dollar}.{$charge->hshsl_amount_cents}</td>
        <td>{$d}</td>
        <td>{$category}</td>
        <td>{$clear}</td>
    </tr>";
}
?>
</tbody>
</table>
</div>

<div class="col-sm-12 text-right">
    <?php echo form_submit('submit', 'Clear Checked Charges')?>
</div>

</div>
<?php echo form_close(); ?>