<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>Type</th>
        <th>Description</th>
        <th>MIME Type</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($values as $key=>$value):?>
    <tr>
        <td><?=$key+1?></td>
        <td><?=$value['ObjectType']?></td>
        <td><?=$value['Description']?></td>
        <td><?=$value['MimeType']?></td>
    </tr>
        <?php endforeach;?>
    </tbody>
</table>