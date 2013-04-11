<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>Value</th>
        <th>Short Value</th>
        <th>Long Value</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($values as $key=>$value):?>
    <tr>
        <td><?=$key+1?></td>
        <td><?=$value['Value']?></td>
        <td><?=$value['ShortValue']?></td>
        <td><?=$value['LongValue']?></td>
    </tr>
    <?php endforeach;?>
    </tbody>
</table>