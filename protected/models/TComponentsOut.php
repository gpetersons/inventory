<?php

/**
 * This is the model class for table "t_components_out".
 *
 * The followings are the available columns in table 't_components_out':
 * @property integer $id_trans
 * @property string $qty
 * @property string $date_time
 * @property string $decsription
 * @property string $balance_history
 * @property integer $component_id
 * @property integer $transaction_type
 * @property integer $goods_id
 * @property integer $goods_t_id
 * @property integer $user_id
 * @property integer $warehouse_from
 * @property integer $warehouse_to
 *
 * The followings are the available model relations:
 * @property Warehouse $warehouseTo
 * @property Components $component
 * @property Goods $goods
 * @property GoodsTransaction $goodsT
 * @property TransactionType $transactionType
 * @property Warehouse $warehouseFrom
 */
class TComponentsOut extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return TComponentsOut the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 't_components_out';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('qty, date_time, decsription, balance_history, component_id, transaction_type, warehouse_from, warehouse_to', 'required'),
            array('component_id, transaction_type, goods_id, goods_t_id, user_id, warehouse_from, warehouse_to', 'numerical', 'integerOnly'=>true),
            array('qty, balance_history', 'length', 'max'=>20),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_trans, qty, date_time, decsription, balance_history, component_id, transaction_type, goods_id, goods_t_id, user_id, warehouse_from, warehouse_to', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'warehouseTo' => array(self::BELONGS_TO, 'Warehouse', 'warehouse_to'),
            'component' => array(self::BELONGS_TO, 'Components', 'component_id'),
            'goods' => array(self::BELONGS_TO, 'Goods', 'goods_id'),
            'goodsT' => array(self::BELONGS_TO, 'GoodsTransaction', 'goods_t_id'),
            'transactionType' => array(self::BELONGS_TO, 'TransactionType', 'transaction_type'),
            'warehouseFrom' => array(self::BELONGS_TO, 'Warehouse', 'warehouse_from'),         
			'stockComponents' => array(self::HAS_MANY, 'StockComponents', 'warehouse_id'),
        );
    } 
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_trans' => 'Id Trans',
			'qty' => 'Qty',
			'date_time' => 'Date Time',
			'decsription' => 'Decsription',
			'balance_history' => 'Balance History',
			'component_id' => 'Component',
			'transaction_type' => 'Transaction Type',
			'goods_id' => 'Goods',
			'goods_t_id' => 'Goods T',
			'user_id' => 'User',
			'warehouse_from' => 'Warehouse From',
			'warehouse_to' => 'Warehouse To',
		);
	}
	
	/*public function afterSave(){
		$component_id = $this->getAttribute('component_id');
		$stok = StockComponents::model()->findAllByAttributes(array('component_id'=>$component_id));
		$stokComponentsFrom= StockComponents::model()->findByAttributes(array('component_id'=>$component_id,'warehouse_id'=>$this->warehouse_to));
		$balance = 0;
		if($stok != null){
			foreach($stok as $dataStockW){
				$balance += $dataStockW->stock; 
				//echo $dataStockW->stock; 
			}			
		}else
		$balance = intval($this->getAttribute('qty'));
		$stokComponentsFrom = intval($this->getAttribute('stock'));
		//echo $this->getAttribute('stok');
		//echo $this->getAttribute('qty');
		
		$balance_warehouse = $stokComponentsFrom + intval($this->getAttribute('qty'));
		Components::model()->updateByPk($component_id,array('stock'=>$balance));
		StockComponents::model()->updateByPk($component_id,array('stock'=>$balance));
		$this->updateByPk($this->id_trans,array('balance_history'=>$balance_warehouse));		
	}*/
	
	public function afterSave(){
		$component_id = $this->getAttribute('component_id');
		$stok = intval(Components::model()->findByPk($component_id)->stock);
		$balance = $stok + intval($this->getAttribute('qty'));
		Components::model()->updateByPk($component_id,array('stock'=>$balance));
		StockComponents::model()->updateByPk($component_id,array('stock'=>$balance));
		$this->updateByPk($this->id_trans,array('balance_history'=>$balance));		
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_trans',$this->id_trans);
		$criteria->compare('qty',$this->qty,true);
		$criteria->compare('date_time',$this->date_time,true);
		$criteria->compare('decsription',$this->decsription,true);
		$criteria->compare('balance_history',$this->balance_history,true);
		$criteria->compare('component_id',$this->component_id);
		$criteria->compare('transaction_type',$this->transaction_type);
		$criteria->compare('goods_id',$this->goods_id);
		$criteria->compare('goods_t_id',$this->goods_t_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('warehouse_from',$this->warehouse_from);
		$criteria->compare('warehouse_to',$this->warehouse_to);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}