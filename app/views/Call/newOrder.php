<h2>Информация о заказах клиента <?=$data_customer[0]['name']?></h2>


<table class="table table-striped success">
    <thead>
    <tr>
        <th>Заказы клиента</th>
        <th>Текущий статус заказа</th>
        <th>Изменить статус заказа</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $client = $data_customer[0]['id'];
    foreach ($data_customer as $order)
    {

        ?>
    <tr>
        <td><?=$order['orders']?></td>
        <td><?=$order['status']?></td>
        <?php
        if ($order['status'] == "Получен")
        {
            ?><td>Нельзя изменить статус</td> <?php
        }
        else
        {
            $href = 'http://www.call/call/change-status/?id='.$order['orders'].'&client='.$client.'&status='.$order['status'];
            ?><td><a href="<?=$href?>" class="btn btn-info" role="button">Изменить статус</a></td> <?php
        }
        ?>

    </tr>
    <?php } ?>
    </tbody>
</table>







