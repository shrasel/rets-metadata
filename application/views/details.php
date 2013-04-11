    <div class="span12" style="border: 1px solid #efefef; background-color: #f5f7f7; margin-bottom: 8px; padding: 8px; border-radius: 8px">
        <div class="span5">
            <ul class="unstyled">
                <li><b>Resource</b> : <?=$resource?></li>
                <li><b>Class</b> : <?=$class?></li>
                <li><b># of Fields</b> : <?=count($fields)?></li>
                <li><b>Key Field</b> : <?=$KeyField?></li>
                <li><b>Object Types</b> : <a href="#object" id="object-popup" data-resource="<?=$resource?>" title="View available media/object types for the '<?=$resource?>' resource">View Media Object</a></li>
               
            </ul>
            
        </div>
        <div class="span5">
            
            <ul class="unstyled">
                <li><a href="<?=site_url("users/export/$resource/$class")?>">Export Field Data</a></li>
                <li>Download the metadata in CSV format</li>
            </ul>
        </div>
    </div>
     <div class="clearfix"></div>
<div class="span12" style="border: 1px solid #efefef; background-color: #f5f7f7; margin-left: 0;  margin-bottom: 8px; padding: 8px; border-radius: 8px">
   
<table class="table table-bordered table-hover table-condensed metadata_details_fields" style="background-color:#fff"  id="metadata_details_fields">
    <tbody>
        <tr class="info">
            <th class="det_sysname"><b>SystemName</b></th>
            <th class="det_stdname"><b>StandardName</b></th>
            <th><b>Description</b></th>
            <th><b>DB Name</b></th>
            <th><b>Type</b></th>
            <th><b>Length</b></th>
            <th><b>Lookup</b></th>
        </tr>
        <?php /*debug($fields);*/foreach($fields as $field):?>
	<tr>
            <td class="det_sysname"><?=$field['SystemName']?>
                <?if($field['Searchable']==1):?>
                    <i title="Searchabel Field" class="icon-search"></i>
                    <?php endif; ?>
                <?if($field['Required']==1):?>
                    <i title="Required Field" class="icon-star"></i>
                    <?php endif; ?>
                <?if($field['SystemName']==$KeyField):?>
                    <i title="Key Field" class="icon-check"></i>
                <?php endif; ?>
            </td>
	        <td class="det_stdname"><?=$field['StandardName']?></td>
            <td class="det_longname"><?=$field['LongName']?></td>
            <td class="det_longname"><?=$field['DBName']?></td>
            <td><?=$field['DataType']?></td>
            <td><?=$field['MaximumLength']?></td>
	    <td><?if(strtolower($field['Interpretation'])=='lookup'):?><a href="" data-lookup_name="<?=$field['LookupName']?>" data-resource="<?=$resource?>" data-class="<?=$class?>" class="lookup_popup">Check Values</a><?php endif; ?></td>
	</tr>
        <?php endforeach;?>
    </tbody>
</table>
</div>
 <div class="clearfix"></div>