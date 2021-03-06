<?php
$this->breadcrumbs=array(
	'Component Supplier'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->title='Update Component Supplier';
$this->menu=array(
	array('label'=>'Create Component Supplier', 'url'=>array('create')),
	array('label'=>'View Component Supplier', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Component Supplier', 'url'=>array('index')),
);
?>

    <!-- #PORTLETS START -->
    <div id="portlets">
    <!-- FIRST SORTABLE COLUMN START -->
      <div class="column" id="left">
      <!--THIS IS A PORTLET-->
        <div class="portlet">
		<div class="portlet-header">Update Component Supplier <?php echo $model->id; ?></div>
		<div class="portlet-content">
			<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
		</div>
        </div>
      </div>
      <!-- FIRST SORTABLE COLUMN END -->
      <!-- SECOND SORTABLE COLUMN START -->
      <div class="column">
                          
    </div>
	<!--  SECOND SORTABLE COLUMN END -->
    <div class="clear"></div>
    <!--THIS IS A WIDE PORTLET-->
    <div class="portlet">
        <div class="portlet-header fixed"><img src="<?php echo Yii::app()->request->baseUrl."/assets/default/"; ?>images/icons/supplier.gif" alt="Latest Registered Users" /> Table List Supplier</div>
		<div class="portlet-content nopadding">
			<?php $this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'component-suplier-grid',
				'dataProvider'=>$model->search(),
				'filter'=>$model,
					'columns'=>array(
						array(
		            	'header'=>'No',
		            	'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
						'htmlOptions'=>array(
							'valign'=>'top',
							'width'=>'2px'
						)
		      
		            ),
						array(
							'header'=>'Suplier',
							'name'=>'suplier_id',
							'value'=>'$data->suplier->suplier_name',
						),
						array(
							'header'=>'Components',
							'name'=>'component_id',
							'value'=>'$data->component->component_name',
						),
						'price',
					array(
						'class'=>'CButtonColumn',
					),
				),
			)); ?>
			
		</div>
      </div>
<!--  END #PORTLETS -->  
   </div>
    <div class="clear"> </div>
<!-- END CONTENT-->    
