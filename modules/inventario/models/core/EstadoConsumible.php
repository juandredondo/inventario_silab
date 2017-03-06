<?php

namespace app\modules\inventario\models\core;

use Yii;
use app\components\core as AppCore;
/**
 * This is the model class for table "TBL_ESTADOSCONSUMIBLE".
 *
 * @property integer $ESCO_ID
 * @property string $ESCO_NOMBRE
 * @property integer $ESCO_MIN
 * @property integer $ESCO_MAX
 *
 * @property TBLITEMSCONSUMIBLES[] $tBLITEMSCONSUMIBLESs
 */
class EstadoConsumible extends \yii\db\ActiveRecord implements AppCore\IdentificableInterface
{

    const Agotado       = 1;
    const Reponer       = 2;
    const Minimas       = 3;
    const Suficiente    = 4;

    public static $types = [
        "Agotado"       => self::Agotado,
        "Reponer"       => self::Reponer,
        "Minimas"       => self::Minimas,
        "Suficiente"    => self::Suficiente
    ];
    
    public static function getTypes()
    {
        return [
            [ 'id' => self::Agotado,        'name' => 'Agotado' ],
            [ 'id' => self::Reponer,   	    'name' => 'Reponer' ],
            [ 'id' => self::Minimas,        'name' => 'Minimas' ],
            [ 'id' => self::Suficiente,    'name' =>  'Suficiente' ]
        ];
    }

    public static function getEstadosById()
    {
        $types = [
            self::Agotado => [
                'name'      => "Agotado",
            ],      
            self::Reponer => [
                'name'      => "Reponer",
            ], 
            self::Minimas => [
                'name'      => "Minimas",
            ], 
            self::Suficiente => [
                'name'      => "Suficientes",
            ]
        ];

        return $types;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TBL_ESTADOSCONSUMIBLE';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ESCO_NOMBRE'], 'required'],
            [['ESCO_MIN', 'ESCO_MAX'], 'integer'],
            [['ESCO_NOMBRE'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ESCO_ID' => 'Esco  ID',
            'ESCO_NOMBRE' => 'Esco  Nombre',
            'ESCO_MIN' => 'Esco  Min',
            'ESCO_MAX' => 'Esco  Max',
        ];
    }

    public function getId() {
        return $this->ESCO_ID;
    }
    public function setId($value = '') {
         $this->ESCO_ID = $value;
    }

    public function getNombre() {
        return $this->ESCO_NOMBRE;
    }
    public function setNombre($value = '') {
         $this->ESCO_NOMBRE = $value;
    }

    public function getMin() {
        return $this->ESCO_MIN;
    }
    public function setMin($value = '') {
         $this->ESCO_MIN = $value;
    }

    public function getMax() {
        return $this->ESCO_MAX;
    }
    public function setMax($value = '') {
         $this->ESCO_MAX = $value;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsConsumibles()
    {
        return $this->hasMany(ItemConsumible::className(), ['ESCO_ID' => 'ESCO_ID']);
    }

    /**
    * Obtiene los estados de los items (agotados o suficientes)
    * @param integer $inventarioId El id del inventario
    * @param integer $tipoItem     El tipo de item, definido en las constantes de TipoItem
    * @return array  retorna un arreglo con informacion de los estados de cada item en un inventario
    */
    public static function getEstadosItems($invetarioId, $tipoItem)
    {
        $stocks = (new \yii\db\Query)
                    ->select("*")
                    ->from("vm_stocks_actuales")
                    ->where([ "INVE_ID" => $invetarioId  ])
                    ->all();
        
        $tiposItems = TipoItem::getTypesById();

        $fnEstado = new \yii\db\Query;

        $estados = [];

        foreach( $stocks as $stock )
        {
            $tipo = $tiposItems[ $stock[ "TIIT_ID" ] ];

            if( $tipo[ "parent" ] == $tipoItem  )
            {
                $estadoId = $fnEstado->select( "silab_db.getConsumibleState(:amount)" )
                                            ->addParams([ ":amount" => $stock[ "STOC_CANTIDAD" ]  ])
                                            ->scalar();
                array_push( $estados, [ 
                        "estado"        => [
                            "id"     => $estadoId,
                            "nombre" => static::getEstadosById()[ $estadoId ]
                        ],
                        "inventario"    => $stock[ "INVE_ID" ],
                        "item"          => [
                            "id"     => $stock[ "ITEM_ID" ],
                            "nombre" => $stock[ "ITEM_NOMBRE" ]
                        ],
                        "cantidad"      => $stock[ "STOC_CANTIDAD" ]
                    ]
                );
            }
        }

        return $estados;
    }
}

/*
$inventarios = laboratorio->inventarios;
foreach($ivnetarios)
$estado = EstadoConsumible::getEstados( 11 );

foreach($estados as $estado)
{
    if($estado[ "estado-id" ] == EstadoConsumible::Agotado)
    {   
        echo "item esta agotaod en el inventairo " . 
                (Inventario::findOne( $estado[ "inventario" ] ))->INVE_NOMBRE
    }
}
*/

//1. Buscar el laboratorio
//2. Obtener los inventarios
    //3. Obtener los estados
        //3.1 
/*
[
    [
        "INVE_ID" => 1,
        [
            "ITEMS" => [
                [
                    "id" => 1,
                    "estados" => [
                        
                    ]
                ]
            ]
        ]
    ],
    [

    ]
]
*/