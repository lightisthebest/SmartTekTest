<?php
/**
 * @var ApiController $this
 */

use App\Components\Errors;
use App\Controllers\ApiController;

$error = Errors::get(true);
if (!empty($error)) {
    $this->render('error', ['error' => $error]);
}
?>
<table>
    <thead>
    <tr>
        <th>CustomerId</th>
        <th>Number of calls within the same continent</th>
        <th>Total Duration of calls within the same continent, seconds</th>
        <th>Total number of all calls</th>
        <th>The total duration of all calls, seconds</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($this->data as $id => $item) : ?>
        <tr>
            <td><?= $id ?></td>
            <td><?= $item['continent']['calls'] ?? '' ?></td>
            <td><?= $item['continent']['duration'] ?? '' ?></td>
            <td><?= $item['all']['calls'] ?? '' ?></td>
            <td><?= $item['all']['duration'] ?? '' ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
