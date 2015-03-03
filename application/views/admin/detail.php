<table class="table table-striped">
<thead>
<tr><th>Name (UMID)</th><th>Amount</th><th>Date</th><th>Category</th><th>Cleared</th></tr>
</thead><tbody>
<?php
    $d = date('F j, Y g:i:s a', $charge->stripe_created);
    echo "<tr>
        <td>{$charge->patron_name} ($charge->umid)</td>
        <td class='text-right'>\${$charge->hshsl_amount_dollar}.{$charge->hshsl_amount_cents}</td>
        <td>{$d}</td>
        <td>{$charge->hshsl_category}</td>
        <td>{$charge->hshsl_cleared}</td>
    </tr>";
?>
</tbody>
</table>
