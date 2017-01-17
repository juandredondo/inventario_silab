<?php

namespace app\modules\inventario\models;

use Yii;

/**
 * This is the model class for table "TBL_CADUCIDADES".
 *
 * @property integer $CADU_ID
 * @property string $CADU_NOMBRE
 * @property integer $CADU_MIN
 * @property integer $CADU_MAX
 *
 * @property TBLREACTIVOS[] $tBLREACTIVOSs
 */
class Caducidad extends \yii\db\ActiveRecord
{
    const Vigente       = 1;
    const ProximoVencer = 2;
    const Vencido       = 3;

    public static $types = [ 
        "vigente"       => self::Vigente, 
        "proximoVencer" => self::ProximoVencer,
        "vencido"       => self::Vencido,
    ];

    public static function getTypes()
    {
        return [
            [ "id" => self::Vigente,        'name' => "VIGENTE" ],
            [ "id" => self::ProximoVencer,  'name' => "PROXIMO A VENCER" ],
            [ "id" => self::Vencido,        'name' => "VENCIDO" ],
        ];
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_CADUCIDADES';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CADU_NOMBRE'], 'required'],
            [['CADU_MIN', 'CADU_MAX'], 'integer'],
            [['CADU_NOMBRE'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CADU_ID' => 'ID',
            'CADU_NOMBRE' => 'CADUCIDAD',
            'CADU_MIN' => 'MIN',
            'CADU_MAX' => 'MAX',
        ];
    }

    public function getId(){ 
        return $this->CADU_ID; 
    }
    public function setId($value){ 
        $this->CADU_ID = $value; 
    }

    public function getNombre(){ 
        return $this->CADU_NOMBRE; 
    }
    public function setSerial($value){ 
        $this->CADU_NOMBRE = $value; 
    }

    public function getMin(){ 
        return $this->CADU_MIN; 
    }
    public function setMin($value){ 
        return $this->CADU_MIN = $value; 
    }

    public function getMax() {
        return $this->CADU_MAX;
    }
    public function setMax($value = '') {
         $this->CADU_MAX = $value;
    }

    public static function getCaducado($date)
    {
        /* Obsolete
            $diff  = $today->diff( $date );

            $rest = $diff->format('%R');
            $days = $diff->days;


            if($days <= 0)
            {
                return self::findOne(self::Vencido);
            }
            else if($days >= 1 && $days <= 50)
            {
                return self::findOne(self::ProximoVencer);
            }

            return self::findOne(self::Vigente);
            $today = new \DateTime("today");
        */
        $date  = new \DateTime($date);
        
        return self::find()
                ->where("CADU_ID = getCaducidad(:date)" )
                ->addParams([ ":date" => $date->format('y-m-d') ])
                ->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReactivos()
    {
        return $this->hasMany(Reactivo::className(), ['CADU_ID' => 'CADU_ID']);
    }
}
