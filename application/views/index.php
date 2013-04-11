<div class="row-fluid">
    <div class="hero-unit">
        <h2>Server Information</h2>
        <hr>
        
        <div class="span5">
            <strong>Server Name</strong>: <?=$server['SystemDescription']?><br>
            <strong>System ID</strong>: <?=$server['SystemID']?><br>
            
            <strong>System Comment</strong>: <?=$server['Comments'] == '' ? 'N/A' : $server['Comments']?><br>
            <strong>RETS Version</strong>: <?=$rets_version?><br>
            <strong>TimeZone Offset</strong>: <?=$server['TimeZoneOffset'] == '' ? 'N/A' : $server['TimeZoneOffset']?><br>
            <strong>Version</strong>: <?=$server['TimeZoneOffset'] == '' ? "N/A" : $server['TimeZoneOffset']?><br>
            <strong>Server Software</strong> : <?=$server_software?> <br>
        </div>
        <div class="span5">
            <strong>Transactions Supported</strong>:    <?= implode(', ', $transactions) ?><br>
            <strong>MetaData Resources</strong>:
            <?php foreach ($resources as $resource): ?>
            <a href="#<?='meta-re-' . $resource['ResourceID']?>"><?=$resource['Description']?></a>,
            <?php endforeach; ?>
            <br>
            <strong>Member Name</strong>: <?=$member_name?><br>
            <strong>Server Timeout</strong>: <?=$timeout?><br>
            <strong>Metadata Version</strong>: <?=$metadata_version?>
        </div>
        <div class="span10"><strong>Login URL</strong>: <?=$login_url?></div>
        <div class="clearfix"></div>
    </div>

    <div class="hero-unit">

        <h2>MetaData Information</h2>
        <?php foreach ($resources as $resource): ?>
        <div id="<?='meta-re-' . $resource['ResourceID']?>" class="box">
            <h4><?=$resource['ResourceID']?></h4>

            <?php if (!empty($resource['classes'])): ?>

            <?php foreach ($resource['classes'] as $class):

                ?>
                <a href="#<?=$class['ClassName']?>" class="resource_class_link" data-keyfield="<?=$resource['KeyField']?>" data-class="<?=$class['ClassName']?>"
                   data-resourceid="<?=$resource['ResourceID']?>"><?=$class['ClassName']?></a>
                - <?= $class['VisibleName'] ?> - <?= $class['Description'] ?>
                <p style="font-size: 12px">
                    <b>Standard Name</b> : <?=$class['StandardName']?> <br>
                    <b>Visible Name</b> : <?=$class['VisibleName']?> <br>
                    <b>Table Date</b> : <?=$class['TableDate'] ?>, <br>
                    <b>Update Date</b> : <?=$class['UpdateDate'] ?>
                    <b>Version</b> : <?=$class['TableVersion'] ?>

                </p>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <?php endforeach;?>

    </div>
    <div class="hero-unit" id="content_details">
        <div id="resource_content"></div>
    </div>
</div><!--/row-->


<div class="modal hide fade" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3></h3>
    </div>
    <div class="modal-body">

    </div>
    <div class="modal-footer">
        <button class="btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>

</div>
