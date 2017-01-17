<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TBL_PERIODOS".
 *
 * @property integer $PERI_ID
 * @property integer $PERI_SEMESTRE
 * @property string $PERI_FECHA
 *
 * @property TBLINVENTARIOS[] $tBLINVENTARIOSs
 */
class Periodo extends \yii\db\ActiveRecord
{
    public static $Semestres = [
        1 => "PRIMER SEMESTRE",
        2 => "SEGUNDO SEMESTRE",
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_PERIODOS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PERI_SEMESTRE'], 'required'],
            [['PERI_SEMESTRE'], 'integer'],
            [['PERI_FECHA'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PERI_ID' => 'Peri  ID',
            'PERI_SEMESTRE' => 'Peri  Semestre',
            'PERI_FECHA' => 'Peri  Fecha',
        ];
    }

    public function getId() {
        return $this->PERI_ID;
    }
    public function setId($value = '') {
         $this->PERI_ID = $value;
    }

    public function getSemestre() {
        return $this->PERI_SEMESTRE;
    }
    public function setSemestre($value = '') {
         $this->PERI_SEMESTRE = $value;
    }

    public function getFecha() {
        return $this->PERI_FECHA;
    }
    public function setFecha($value = '') {
         $this->PERI_FECHA = $value;
    }

    public function getAlias() {
        return self::$Semestres[ $this->Semestre ] . " - " . (new \DateTime($this->Fecha))->format("Y") ;
    }

    public function esVigente()
    {
        $monthsBySemester = [
            1 => [ 1, 2, 3, 4, 5, 6 ],
            2 => [ 7, 8, 9, 10, 11, 12 ]
        ];

        $currentDate        = new \DateTime("today");
        $modelDate          = new \DateTime($this->Fecha);
        $currentSemester    = $this->semestre;
        $_esVigente         = in_array( $currentDate->format("m"), $monthsBySemester[ $currentSemester ] ) 
                                && $modelDate->format("Y") == $currentDate->format("Y");
        return $_esVigente;
    }

    public static function generatePeriod()
    {
        $monthsBySemester = [
            1 => [ 1, 2, 3, 4, 5, 6 ],
            2 => [ 7, 8, 9, 10, 11, 12 ]
        ];

        $currentDate        = new \DateTime("2017-09-26");
        $currentSemester    = $currentDate->format("m") <= 6 ? 1 : 2; 
        $currentDate->setDate($currentDate->format("Y"), $currentSemester == 1 ? 1 : 7 , 1);
                                
        
        $period             = new Periodo();
        $period->load([
            "PERI_SEMESTRE" => $currentSemester,
            "PERI_FECHA"    => $currentDate->format("Y-m-d")
        ], '');

        return $period;
    }

    public static function getCurrentPeriod()
    {
        $period = self::find()
                ->where("PERI_ID = getCurrentPeriod()" )
                ->one();
        
        if($period === null)
        {
            $period = static::generatePeriod();

            if($period->validate() && $period->save())
                return $period;
        }
        else
            return $period;
        
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventarios()
    {
        return $this->hasMany(Inventario::className(), ['PERI_ID' => 'PERI_ID']);
    }

    public function getStocks()
    {
        return $this->hasMany(Stock::className(), ['PERI_ID' => 'PERI_ID']);
    }
}
