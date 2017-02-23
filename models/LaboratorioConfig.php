<?php

namespace app\models;

use Yii;
use app\components\core\IdentificableInterface;
use app\modules\inventario\models\core\TipoItem;
/**
 * This is the model class for table "TBL_LABORATORIOCONFIGS".
 *
 * @property integer $LACO_ID
 * @property integer $PERI_ID
 * @property double $LACO_STOCKMIN
 * @property double $LACO_STOCKMAX
 * @property integer $LABO_ID
 * @property integer $TIIT_ID
 * @property integer $LACO_MAXINVENTARIOS
 * @property string $LACO_EXTRADATA
 */
class LaboratorioConfig extends \yii\db\ActiveRecord implements IdentificableInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_LABORATORIOCONFIGS';
    }

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['PERI_ID', 'LABO_ID'], 'required'],
            [['PERI_ID', 'LABO_ID', 'TIIT_ID', 'LACO_MAXINVENTARIOS'], 'integer'],
            [['LACO_STOCKMIN', 'LACO_STOCKMAX'], 'number'],
            [['LACO_EXTRADATA'], 'string'],
            [['LABO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Laboratorio::className(), 'targetAttribute' => ['LABO_ID' => 'LABO_ID']],
            [['TIIT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TipoItem::className(), 'targetAttribute' => ['TIIT_ID' => 'TIIT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'LACO_ID'       => 'CONFIGURACION',
            'PERI_ID'       => 'PERIODO',
            'LACO_STOCKMIN' => 'EXISTENCIAS MINIMAS',
            'LACO_STOCKMAX' => 'EXISTENCIAS MAXIMAS',
            'LABO_ID'       => 'LABORATORIO',
            'TIIT_ID'       => 'TIPO DE ITEM',
            'LACO_MAXINVENTARIOS'   => 'N° INVENTARIOS MAXIMOS',
            'LACO_EXTRADATA'        => 'METADATOS',
        ];
    }

    public function getId() {
        return $this->LACO_ID;
    }
    public function setId($value = '') {
         $this->LACO_ID = $value;
    }

    public function getMin() {
        return $this->LACO_STOCKMIN;
    }
    public function setMin($value = '') {
         $this->LACO_STOCKMIN = $value;
    }

    public function getMax() {
        return $this->LACO_STOCKMAX;
    }
    public function setMax($value = '') {
         $this->LACO_STOCKMAX = $value;
    }

    public function init()
    {
        // Set current period
        $this->PERI_ID              = Periodo::getCurrentPeriod()->PERI_ID;
        $this->LACO_STOCKMIN        = 50;
        $this->LACO_STOCKMAX        = 100;
        $this->LACO_MAXINVENTARIOS  = 10;
        
        // parent initialization
        parent::init();
    }

    public static function getConfigByLaboratory($id = null)
    {
        $config = static::find()
                    ->where( [ "LABO_ID" => $id ] )
                    ->andWhere( "PERI_ID = getCurrentPeriod()" )
                    ->orderBy( [ "LACO_ID" => SORT_DESC ] )
                    ->one();

        if( !isset($config) ) {
            return new LaboratorioConfig(
                [ 
                    "LABO_ID" => $id, 
                ]
            );
        }
        
        return $config;
        
    }

}
